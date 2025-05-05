# OpenAPI\Client\CarImagesApi

All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiCarsCarIdImagesGet()**](CarImagesApi.md#apiCarsCarIdImagesGet) | **GET** /api/cars/{carId}/images |  |
| [**apiCarsCarIdImagesImageIdDelete()**](CarImagesApi.md#apiCarsCarIdImagesImageIdDelete) | **DELETE** /api/cars/{carId}/images/{imageId} |  |
| [**apiCarsCarIdImagesImageIdSetPrimaryPut()**](CarImagesApi.md#apiCarsCarIdImagesImageIdSetPrimaryPut) | **PUT** /api/cars/{carId}/images/{imageId}/set-primary |  |
| [**apiCarsCarIdImagesPost()**](CarImagesApi.md#apiCarsCarIdImagesPost) | **POST** /api/cars/{carId}/images |  |
| [**apiCarsCarIdImagesReorderPut()**](CarImagesApi.md#apiCarsCarIdImagesReorderPut) | **PUT** /api/cars/{carId}/images/reorder |  |


## `apiCarsCarIdImagesGet()`

```php
apiCarsCarIdImagesGet($car_id): \OpenAPI\Client\models\CarImageDto[]
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\CarImagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$car_id = 'car_id_example'; // string

try {
    $result = $apiInstance->apiCarsCarIdImagesGet($car_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CarImagesApi->apiCarsCarIdImagesGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **car_id** | **string**|  | |

### Return type

[**\OpenAPI\Client\models\CarImageDto[]**](../Model/CarImageDto.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiCarsCarIdImagesImageIdDelete()`

```php
apiCarsCarIdImagesImageIdDelete($car_id, $image_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\CarImagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$car_id = 'car_id_example'; // string
$image_id = 'image_id_example'; // string

try {
    $apiInstance->apiCarsCarIdImagesImageIdDelete($car_id, $image_id);
} catch (Exception $e) {
    echo 'Exception when calling CarImagesApi->apiCarsCarIdImagesImageIdDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **car_id** | **string**|  | |
| **image_id** | **string**|  | |

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

## `apiCarsCarIdImagesImageIdSetPrimaryPut()`

```php
apiCarsCarIdImagesImageIdSetPrimaryPut($car_id, $image_id): \OpenAPI\Client\models\CarImageDto
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\CarImagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$car_id = 'car_id_example'; // string
$image_id = 'image_id_example'; // string

try {
    $result = $apiInstance->apiCarsCarIdImagesImageIdSetPrimaryPut($car_id, $image_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CarImagesApi->apiCarsCarIdImagesImageIdSetPrimaryPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **car_id** | **string**|  | |
| **image_id** | **string**|  | |

### Return type

[**\OpenAPI\Client\models\CarImageDto**](../Model/CarImageDto.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiCarsCarIdImagesPost()`

```php
apiCarsCarIdImagesPost($car_id, $image, $image_url, $set_as_primary): \OpenAPI\Client\models\CarImageDto
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\CarImagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$car_id = 'car_id_example'; // string
$image = '/path/to/file.txt'; // \SplFileObject
$image_url = 'image_url_example'; // string
$set_as_primary = True; // bool

try {
    $result = $apiInstance->apiCarsCarIdImagesPost($car_id, $image, $image_url, $set_as_primary);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CarImagesApi->apiCarsCarIdImagesPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **car_id** | **string**|  | |
| **image** | **\SplFileObject****\SplFileObject**|  | [optional] |
| **image_url** | **string**|  | [optional] |
| **set_as_primary** | **bool**|  | [optional] |

### Return type

[**\OpenAPI\Client\models\CarImageDto**](../Model/CarImageDto.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/x-www-form-urlencoded`
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiCarsCarIdImagesReorderPut()`

```php
apiCarsCarIdImagesReorderPut($car_id, $car_image_order_item)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\CarImagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$car_id = 'car_id_example'; // string
$car_image_order_item = array(new \OpenAPI\Client\models\CarImageOrderItem()); // \OpenAPI\Client\models\CarImageOrderItem[]

try {
    $apiInstance->apiCarsCarIdImagesReorderPut($car_id, $car_image_order_item);
} catch (Exception $e) {
    echo 'Exception when calling CarImagesApi->apiCarsCarIdImagesReorderPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **car_id** | **string**|  | |
| **car_image_order_item** | [**\OpenAPI\Client\models\CarImageOrderItem[]**](../Model/CarImageOrderItem.md)|  | |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`, `text/json`, `application/*+json`
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
