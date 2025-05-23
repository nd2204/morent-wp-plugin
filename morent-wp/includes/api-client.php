<?php

use OpenAPI\Client\apis\CarApi;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Exception\RequestException;
use OpenAPI\Client\apis\AdminApi;
use OpenAPI\Client\apis\AuthApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\models\RefreshTokenRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class MorentApiClient {
    public static $access_token_option = 'morent_api_access_token';
    public static $refresh_token_option = 'morent_api_refresh_token';

    private $base_url = 'https://coral-unbiased-scarcely.ngrok-free.app';

    private $client;
    private $config;

    public function __construct() {
        $stack = HandlerStack::create();
        $stack->push($this->getMiddleware());

        $this->client = new Client([
            'handler' => $stack,
        ]);

        $this->config = Configuration::getDefaultConfiguration()
            ->setHost($this->base_url)
            ->setAccessToken($this->getAccessToken());
    }

    /**
     * Example: Create the CarApi instance
     */
    public function carApi(): CarApi {
        return new CarApi($this->client, $this->config);
    }

    public function AdminApi(): AdminApi {
        return new AdminApi($this->client, $this->config);
    }

    public function AuthApi(): AuthApi {
        return new AuthApi($this->client, $this->config);
    }

    private function getAccessToken(): ?string {
        return get_option(self::$access_token_option);
    }

    public function saveAccessToken(string $token): void {
        update_option(self::$access_token_option, $token);
    }

    private function getRefreshToken(): ?string {
        return get_option(self::$refresh_token_option);
    }

    private function saveRefreshToken(string $token): void {
        update_option(self::$refresh_token_option, $token);
    }

    private function refreshAccessToken(): ?string {
        error_log('Refreshing Access Token...');
        $refreshToken = $this->getRefreshToken();

        if (!$refreshToken) {
            error_log('No Request Token Found: ');
            return null;
        }

        $authApi = new AuthApi($this->client, $this->config);
        try {
            $result = $authApi->apiAuthRefreshPost(
                new RefreshTokenRequest(["refresh_token" => $refreshToken])
            );

            error_log($result);
            $access_token = $result->getAccessToken();
            $refreshToken = $result->getRefreshToken();

            if (!empty($refresh_token)) {
                error_log('Saving new refresh token: ' . $refresh_token);
                $this->saveRefreshToken($refresh_token);
            }
            if (!empty($access_token)) {
                error_log('Saving new access token: ' . $access_token);
                $this->saveAccessToken($access_token);
                return $access_token;
            }

            return null;
        } catch (Exception $e) {
            error_log('Exception when calling AuthApi->apiAuthRefreshPost: ' . $e->getMessage() . PHP_EOL);
            return null;
        }
    }

    private function getMiddleware(): callable
    {
        return function (callable $handler) {
            return function (RequestInterface $request, array $options) use ($handler) {
                error_log('Request URL: ' . $request->getUri());
                // error_log('Request Headers: ' . json_encode($request->getHeaders()));

                $accessToken = $this->getAccessToken();
                if ($accessToken) {
                    $request = $request->withHeader('Authorization', 'Bearer ' . $accessToken);
                }

                return $handler($request, $options)->then(
                    function (ResponseInterface $response) use ($request, $options, $handler) {
                        if ($response->getStatusCode() === 302) {
                            $newToken = $this->refreshAccessToken();
                            if ($newToken) {
                                $newRequest = $request->withHeader('Authorization', 'Bearer ' . $newToken);
                                return $handler($newRequest, $options); // ✅ retry the request
                            } else {
                                error_log('Refresh token failed, deleting session tokens.');
                                if (mr_is_logged_in()) {
                                    mr_logout();
                                }
                                return \GuzzleHttp\Promise\Create::rejectionFor(
                                    new RequestException('Refresh token failed, unable to redirect.', $request));
                            }
                        }
                        return $response;
                    },
                    function ($reason) use ($request, $options, $handler) {
                        if (
                            $reason instanceof RequestException &&
                            $reason->hasResponse()
                        ) {
                            error_log('Error Response: ' . $reason->getResponse()->getStatusCode());
                        }
                        if (
                            $reason instanceof RequestException &&
                            $reason->hasResponse() &&
                            $reason->getResponse()->getStatusCode() === 401
                        ) {
                            $newToken = $this->refreshAccessToken();
                            if ($newToken) {
                                $newRequest = $request->withHeader('Authorization', 'Bearer ' . $newToken);
                                return $handler($newRequest, $options);
                            } else {
                                error_log('Refresh token failed, deleting session tokens.');
                                if (mr_is_logged_in()) {
                                    mr_logout();
                                }
                            }

                            // Return rejected promise if redirect not possible
                            return \GuzzleHttp\Promise\Create::rejectionFor(
                                new RequestException('Refresh token failed, unable to redirect.', $request)
                            );
                        }

                        return \GuzzleHttp\Promise\Create::rejectionFor($reason);
                    }
                );
            };
        };
    }
}
