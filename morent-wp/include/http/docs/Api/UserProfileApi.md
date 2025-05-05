# OpenAPI\Client\UserProfileApi

All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiUsersUserIdProfileImageDelete()**](UserProfileApi.md#apiUsersUserIdProfileImageDelete) | **DELETE** /api/users/{userId}/profile-image |  |
| [**apiUsersUserIdProfileImageGet()**](UserProfileApi.md#apiUsersUserIdProfileImageGet) | **GET** /api/users/{userId}/profile-image |  |
| [**apiUsersUserIdProfileImagePost()**](UserProfileApi.md#apiUsersUserIdProfileImagePost) | **POST** /api/users/{userId}/profile-image |  |


## `apiUsersUserIdProfileImageDelete()`

```php
apiUsersUserIdProfileImageDelete($user_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\UserProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string

try {
    $apiInstance->apiUsersUserIdProfileImageDelete($user_id);
} catch (Exception $e) {
    echo 'Exception when calling UserProfileApi->apiUsersUserIdProfileImageDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_id** | **string**|  | |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiUsersUserIdProfileImageGet()`

```php
apiUsersUserIdProfileImageGet($user_id): \OpenAPI\Client\models\UserProfileImageDto
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\UserProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string

try {
    $result = $apiInstance->apiUsersUserIdProfileImageGet($user_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserProfileApi->apiUsersUserIdProfileImageGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_id** | **string**|  | |

### Return type

[**\OpenAPI\Client\models\UserProfileImageDto**](../Model/UserProfileImageDto.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiUsersUserIdProfileImagePost()`

```php
apiUsersUserIdProfileImagePost($user_id, $image): \OpenAPI\Client\models\UserProfileImageDto
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\UserProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string
$image = '/path/to/file.txt'; // \SplFileObject

try {
    $result = $apiInstance->apiUsersUserIdProfileImagePost($user_id, $image);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserProfileApi->apiUsersUserIdProfileImagePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_id** | **string**|  | |
| **image** | **\SplFileObject****\SplFileObject**|  | [optional] |

### Return type

[**\OpenAPI\Client\models\UserProfileImageDto**](../Model/UserProfileImageDto.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
