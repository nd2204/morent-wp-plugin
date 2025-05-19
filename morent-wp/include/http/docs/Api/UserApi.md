# OpenAPI\Client\UserApi

All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiUsersMeGet()**](UserApi.md#apiUsersMeGet) | **GET** /api/users/me |  |
| [**apiUsersMeProfileImageDelete()**](UserApi.md#apiUsersMeProfileImageDelete) | **DELETE** /api/users/me/profile-image |  |
| [**apiUsersMeProfileImageGet()**](UserApi.md#apiUsersMeProfileImageGet) | **GET** /api/users/me/profile-image |  |
| [**apiUsersMeProfileImagePost()**](UserApi.md#apiUsersMeProfileImagePost) | **POST** /api/users/me/profile-image |  |
| [**apiUsersMeRentalsGet()**](UserApi.md#apiUsersMeRentalsGet) | **GET** /api/users/me/rentals |  |
| [**apiUsersMeRentalsPost()**](UserApi.md#apiUsersMeRentalsPost) | **POST** /api/users/me/rentals |  |
| [**apiUsersMeReviewsGet()**](UserApi.md#apiUsersMeReviewsGet) | **GET** /api/users/me/reviews |  |
| [**apiUsersMeReviewsPost()**](UserApi.md#apiUsersMeReviewsPost) | **POST** /api/users/me/reviews |  |
| [**apiUsersMeReviewsReviewIdPut()**](UserApi.md#apiUsersMeReviewsReviewIdPut) | **PUT** /api/users/me/reviews/{reviewId} |  |
| [**apiUsersUserIdProfileImageGet()**](UserApi.md#apiUsersUserIdProfileImageGet) | **GET** /api/users/{userId}/profile-image |  |


## `apiUsersMeGet()`

```php
apiUsersMeGet(): \OpenAPI\Client\models\UserDto
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\UserApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->apiUsersMeGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserApi->apiUsersMeGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\models\UserDto**](../Model/UserDto.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiUsersMeProfileImageDelete()`

```php
apiUsersMeProfileImageDelete($user_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\UserApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string

try {
    $apiInstance->apiUsersMeProfileImageDelete($user_id);
} catch (Exception $e) {
    echo 'Exception when calling UserApi->apiUsersMeProfileImageDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_id** | **string**|  | [optional] |

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

## `apiUsersMeProfileImageGet()`

```php
apiUsersMeProfileImageGet()
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\UserApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $apiInstance->apiUsersMeProfileImageGet();
} catch (Exception $e) {
    echo 'Exception when calling UserApi->apiUsersMeProfileImageGet: ', $e->getMessage(), PHP_EOL;
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
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiUsersMeProfileImagePost()`

```php
apiUsersMeProfileImagePost($user_id, $image): \OpenAPI\Client\models\UserProfileImageDto
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\UserApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string
$image = '/path/to/file.txt'; // \SplFileObject

try {
    $result = $apiInstance->apiUsersMeProfileImagePost($user_id, $image);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserApi->apiUsersMeProfileImagePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_id** | **string**|  | [optional] |
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

## `apiUsersMeRentalsGet()`

```php
apiUsersMeRentalsGet(): \OpenAPI\Client\models\RentalDto[]
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\UserApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->apiUsersMeRentalsGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserApi->apiUsersMeRentalsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\models\RentalDto[]**](../Model/RentalDto.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiUsersMeRentalsPost()`

```php
apiUsersMeRentalsPost($create_rental_request): \OpenAPI\Client\models\RentalDto
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\UserApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$create_rental_request = new \OpenAPI\Client\models\CreateRentalRequest(); // \OpenAPI\Client\models\CreateRentalRequest

try {
    $result = $apiInstance->apiUsersMeRentalsPost($create_rental_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserApi->apiUsersMeRentalsPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **create_rental_request** | [**\OpenAPI\Client\models\CreateRentalRequest**](../Model/CreateRentalRequest.md)|  | |

### Return type

[**\OpenAPI\Client\models\RentalDto**](../Model/RentalDto.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`, `text/json`, `application/*+json`
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiUsersMeReviewsGet()`

```php
apiUsersMeReviewsGet(): \OpenAPI\Client\models\UserCarsReviewDto[]
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\UserApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->apiUsersMeReviewsGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserApi->apiUsersMeReviewsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\models\UserCarsReviewDto[]**](../Model/UserCarsReviewDto.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiUsersMeReviewsPost()`

```php
apiUsersMeReviewsPost($leave_review_request): \OpenAPI\Client\models\ReviewDto
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\UserApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$leave_review_request = new \OpenAPI\Client\models\LeaveReviewRequest(); // \OpenAPI\Client\models\LeaveReviewRequest

try {
    $result = $apiInstance->apiUsersMeReviewsPost($leave_review_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserApi->apiUsersMeReviewsPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **leave_review_request** | [**\OpenAPI\Client\models\LeaveReviewRequest**](../Model/LeaveReviewRequest.md)|  | |

### Return type

[**\OpenAPI\Client\models\ReviewDto**](../Model/ReviewDto.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`, `text/json`, `application/*+json`
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiUsersMeReviewsReviewIdPut()`

```php
apiUsersMeReviewsReviewIdPut($review_id, $update_review_request): string
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\UserApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$review_id = 'review_id_example'; // string
$update_review_request = new \OpenAPI\Client\models\UpdateReviewRequest(); // \OpenAPI\Client\models\UpdateReviewRequest

try {
    $result = $apiInstance->apiUsersMeReviewsReviewIdPut($review_id, $update_review_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserApi->apiUsersMeReviewsReviewIdPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **review_id** | **string**|  | |
| **update_review_request** | [**\OpenAPI\Client\models\UpdateReviewRequest**](../Model/UpdateReviewRequest.md)|  | |

### Return type

**string**

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`, `text/json`, `application/*+json`
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



$apiInstance = new OpenAPI\Client\Api\UserApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string

try {
    $result = $apiInstance->apiUsersUserIdProfileImageGet($user_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserApi->apiUsersUserIdProfileImageGet: ', $e->getMessage(), PHP_EOL;
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
