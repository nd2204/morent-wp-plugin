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

    private Client $client;
    private Configuration $config;

    public function __construct() {
        $stack = HandlerStack::create();
        $stack->push($this->getMiddleware());

        $this->client = new Client([
            'handler' => $stack,
        ]);

        $this->config = Configuration::getDefaultConfiguration()
            ->setHost($this->base_url);
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
        return get_option($this->access_token_option);
    }

    public function saveAccessToken(string $token): void {
        $this->config->setAccessToken($token);
        update_option($this->access_token_option, $token);
    }

    private function getRefreshToken(): ?string {
        return get_option($this->refresh_token_option);
    }

    private function refreshAccessToken(): ?string {
        $refreshToken = $this->getRefreshToken();

        if (!$refreshToken) {
            return null;
        }

        $authApi = new AuthApi($this->client, $this->config);
        try {
            $result = $authApi->apiAuthRefreshPost(
                new RefreshTokenRequest(["refresh_token" => $refreshToken])
            );

            print_r($result);
            $access_token = $result->getAccessToken();
            if (!empty($access_token)) {
                $this->saveAccessToken($access_token);
                return $access_token;
            }

            return null;
        } catch (Exception $e) {
            echo 'Exception when calling AuthApi->apiAuthRefreshPost: ', $e->getMessage(), PHP_EOL;
            return null;
        }
    }

    private function getMiddleware(): callable
    {
        return function (callable $handler) {
            return function (RequestInterface $request, array $options) use ($handler) {
                error_log('Request URL: ' . $request->getUri());
                error_log('Request Headers: ' . json_encode($request->getHeaders()));

                $accessToken = $this->getAccessToken();
                if ($accessToken) {
                    $request = $request->withHeader('Authorization', 'Bearer ' . $accessToken);
                }

                return $handler($request, $options)->then(
                    function (ResponseInterface $response) {
                        return $response;
                    },
                    function ($reason) use ($request, $options, $handler) {
                        if (
                            $reason instanceof RequestException &&
                            $reason->hasResponse() &&
                            $reason->getResponse()->getStatusCode() === 401
                        ) {
                            $newToken = $this->refreshAccessToken();
                            if ($newToken) {
                                $newRequest = $request->withHeader('Authorization', 'Bearer ' . $newToken);
                                return $handler($newRequest, $options);
                            }
                        }

                        return \GuzzleHttp\Promise\Create::rejectionFor($reason);
                    }
                );
            };
        };
    }
}
