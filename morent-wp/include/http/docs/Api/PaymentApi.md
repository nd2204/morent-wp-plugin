# OpenAPI\Client\PaymentApi

All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiPaymentsMethodsGet()**](PaymentApi.md#apiPaymentsMethodsGet) | **GET** /api/payments/methods |  |
| [**apiPaymentsPost()**](PaymentApi.md#apiPaymentsPost) | **POST** /api/payments |  |


## `apiPaymentsMethodsGet()`

```php
apiPaymentsMethodsGet(): \OpenAPI\Client\models\PaymentMethodDto[]
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\PaymentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->apiPaymentsMethodsGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PaymentApi->apiPaymentsMethodsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\models\PaymentMethodDto[]**](../Model/PaymentMethodDto.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiPaymentsPost()`

```php
apiPaymentsPost()
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\PaymentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $apiInstance->apiPaymentsPost();
} catch (Exception $e) {
    echo 'Exception when calling PaymentApi->apiPaymentsPost: ', $e->getMessage(), PHP_EOL;
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
