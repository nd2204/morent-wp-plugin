# OpenAPI\Client\CarReviewApi

All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiReviewsCarIdGet()**](CarReviewApi.md#apiReviewsCarIdGet) | **GET** /api/reviews/car/{id} |  |
| [**apiReviewsCarIdPost()**](CarReviewApi.md#apiReviewsCarIdPost) | **POST** /api/reviews/car/{id} |  |


## `apiReviewsCarIdGet()`

```php
apiReviewsCarIdGet($id): \OpenAPI\Client\models\ReviewDto[]
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\CarReviewApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string

try {
    $result = $apiInstance->apiReviewsCarIdGet($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CarReviewApi->apiReviewsCarIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |

### Return type

[**\OpenAPI\Client\models\ReviewDto[]**](../Model/ReviewDto.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiReviewsCarIdPost()`

```php
apiReviewsCarIdPost($id, $leave_review_command): string
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\CarReviewApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string
$leave_review_command = new \OpenAPI\Client\models\LeaveReviewCommand(); // \OpenAPI\Client\models\LeaveReviewCommand

try {
    $result = $apiInstance->apiReviewsCarIdPost($id, $leave_review_command);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CarReviewApi->apiReviewsCarIdPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **leave_review_command** | [**\OpenAPI\Client\models\LeaveReviewCommand**](../Model/LeaveReviewCommand.md)|  | |

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
