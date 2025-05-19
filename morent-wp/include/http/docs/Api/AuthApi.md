# OpenAPI\Client\AuthApi

All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiAuthGoogleCallbackGet()**](AuthApi.md#apiAuthGoogleCallbackGet) | **GET** /api/auth/google-callback |  |
| [**apiAuthGoogleLoginGet()**](AuthApi.md#apiAuthGoogleLoginGet) | **GET** /api/auth/google-login |  |
| [**apiAuthLoginPost()**](AuthApi.md#apiAuthLoginPost) | **POST** /api/auth/login |  |
| [**apiAuthLogoutPost()**](AuthApi.md#apiAuthLogoutPost) | **POST** /api/auth/logout |  |
| [**apiAuthRefreshPost()**](AuthApi.md#apiAuthRefreshPost) | **POST** /api/auth/refresh |  |
| [**apiAuthRegisterPost()**](AuthApi.md#apiAuthRegisterPost) | **POST** /api/auth/register |  |


## `apiAuthGoogleCallbackGet()`

```php
apiAuthGoogleCallbackGet()
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\AuthApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $apiInstance->apiAuthGoogleCallbackGet();
} catch (Exception $e) {
    echo 'Exception when calling AuthApi->apiAuthGoogleCallbackGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiAuthGoogleLoginGet()`

```php
apiAuthGoogleLoginGet()
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\AuthApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $apiInstance->apiAuthGoogleLoginGet();
} catch (Exception $e) {
    echo 'Exception when calling AuthApi->apiAuthGoogleLoginGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiAuthLoginPost()`

```php
apiAuthLoginPost($login_request): \OpenAPI\Client\models\ValidationProblemDetails
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\AuthApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$login_request = new \OpenAPI\Client\models\LoginRequest(); // \OpenAPI\Client\models\LoginRequest

try {
    $result = $apiInstance->apiAuthLoginPost($login_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthApi->apiAuthLoginPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **login_request** | [**\OpenAPI\Client\models\LoginRequest**](../Model/LoginRequest.md)|  | |

### Return type

[**\OpenAPI\Client\models\ValidationProblemDetails**](../Model/ValidationProblemDetails.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`, `text/json`, `application/*+json`
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiAuthLogoutPost()`

```php
apiAuthLogoutPost()
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\AuthApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $apiInstance->apiAuthLogoutPost();
} catch (Exception $e) {
    echo 'Exception when calling AuthApi->apiAuthLogoutPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiAuthRefreshPost()`

```php
apiAuthRefreshPost($refresh_token_request): \OpenAPI\Client\models\AuthResponse
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\AuthApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$refresh_token_request = new \OpenAPI\Client\models\RefreshTokenRequest(); // \OpenAPI\Client\models\RefreshTokenRequest

try {
    $result = $apiInstance->apiAuthRefreshPost($refresh_token_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthApi->apiAuthRefreshPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **refresh_token_request** | [**\OpenAPI\Client\models\RefreshTokenRequest**](../Model/RefreshTokenRequest.md)|  | |

### Return type

[**\OpenAPI\Client\models\AuthResponse**](../Model/AuthResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`, `text/json`, `application/*+json`
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiAuthRegisterPost()`

```php
apiAuthRegisterPost($register_user_command): \OpenAPI\Client\models\AuthResponse
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\AuthApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$register_user_command = new \OpenAPI\Client\models\RegisterUserCommand(); // \OpenAPI\Client\models\RegisterUserCommand

try {
    $result = $apiInstance->apiAuthRegisterPost($register_user_command);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthApi->apiAuthRegisterPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **register_user_command** | [**\OpenAPI\Client\models\RegisterUserCommand**](../Model/RegisterUserCommand.md)|  | |

### Return type

[**\OpenAPI\Client\models\AuthResponse**](../Model/AuthResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`, `text/json`, `application/*+json`
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
