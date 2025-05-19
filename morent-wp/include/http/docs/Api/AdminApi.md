# OpenAPI\Client\AdminApi

All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiAdminCarCarIdImagesImageIdPost()**](AdminApi.md#apiAdminCarCarIdImagesImageIdPost) | **POST** /api/admin/car/{carId}/images/{imageId} |  |
| [**apiAdminCarCarIdImagesImageIdSetPrimaryPut()**](AdminApi.md#apiAdminCarCarIdImagesImageIdSetPrimaryPut) | **PUT** /api/admin/car/{carId}/images/{imageId}/set-primary |  |
| [**apiAdminCarCarIdImagesPost()**](AdminApi.md#apiAdminCarCarIdImagesPost) | **POST** /api/admin/car/{carId}/images |  |
| [**apiAdminCarCarIdImagesReorderPut()**](AdminApi.md#apiAdminCarCarIdImagesReorderPut) | **PUT** /api/admin/car/{carId}/images/reorder |  |
| [**apiAdminCarIdDelete()**](AdminApi.md#apiAdminCarIdDelete) | **DELETE** /api/admin/car/{id} |  |
| [**apiAdminCarIdPut()**](AdminApi.md#apiAdminCarIdPut) | **PUT** /api/admin/car/{id} |  |
| [**apiAdminCarPost()**](AdminApi.md#apiAdminCarPost) | **POST** /api/admin/car |  |


## `apiAdminCarCarIdImagesImageIdPost()`

```php
apiAdminCarCarIdImagesImageIdPost($car_id, $image_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\AdminApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$car_id = 'car_id_example'; // string
$image_id = 'image_id_example'; // string

try {
    $apiInstance->apiAdminCarCarIdImagesImageIdPost($car_id, $image_id);
} catch (Exception $e) {
    echo 'Exception when calling AdminApi->apiAdminCarCarIdImagesImageIdPost: ', $e->getMessage(), PHP_EOL;
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

## `apiAdminCarCarIdImagesImageIdSetPrimaryPut()`

```php
apiAdminCarCarIdImagesImageIdSetPrimaryPut($car_id, $image_id): \OpenAPI\Client\models\CarImageDto
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\AdminApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$car_id = 'car_id_example'; // string
$image_id = 'image_id_example'; // string

try {
    $result = $apiInstance->apiAdminCarCarIdImagesImageIdSetPrimaryPut($car_id, $image_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AdminApi->apiAdminCarCarIdImagesImageIdSetPrimaryPut: ', $e->getMessage(), PHP_EOL;
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

## `apiAdminCarCarIdImagesPost()`

```php
apiAdminCarCarIdImagesPost($car_id, $image, $image_url, $set_as_primary): \OpenAPI\Client\models\CarImageDto
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\AdminApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$car_id = 'car_id_example'; // string
$image = '/path/to/file.txt'; // \SplFileObject
$image_url = 'image_url_example'; // string
$set_as_primary = True; // bool

try {
    $result = $apiInstance->apiAdminCarCarIdImagesPost($car_id, $image, $image_url, $set_as_primary);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AdminApi->apiAdminCarCarIdImagesPost: ', $e->getMessage(), PHP_EOL;
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

## `apiAdminCarCarIdImagesReorderPut()`

```php
apiAdminCarCarIdImagesReorderPut($car_id, $car_image_order_item)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\AdminApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$car_id = 'car_id_example'; // string
$car_image_order_item = array(new \OpenAPI\Client\models\CarImageOrderItem()); // \OpenAPI\Client\models\CarImageOrderItem[]

try {
    $apiInstance->apiAdminCarCarIdImagesReorderPut($car_id, $car_image_order_item);
} catch (Exception $e) {
    echo 'Exception when calling AdminApi->apiAdminCarCarIdImagesReorderPut: ', $e->getMessage(), PHP_EOL;
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

## `apiAdminCarIdDelete()`

```php
apiAdminCarIdDelete($id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\AdminApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string

try {
    $apiInstance->apiAdminCarIdDelete($id);
} catch (Exception $e) {
    echo 'Exception when calling AdminApi->apiAdminCarIdDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |

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

## `apiAdminCarIdPut()`

```php
apiAdminCarIdPut($id, $update_car_command)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\AdminApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string
$update_car_command = new \OpenAPI\Client\models\UpdateCarCommand(); // \OpenAPI\Client\models\UpdateCarCommand

try {
    $apiInstance->apiAdminCarIdPut($id, $update_car_command);
} catch (Exception $e) {
    echo 'Exception when calling AdminApi->apiAdminCarIdPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **update_car_command** | [**\OpenAPI\Client\models\UpdateCarCommand**](../Model/UpdateCarCommand.md)|  | |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`, `text/json`, `application/*+json`
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiAdminCarPost()`

```php
apiAdminCarPost($create_car_command)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\AdminApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$create_car_command = new \OpenAPI\Client\models\CreateCarCommand(); // \OpenAPI\Client\models\CreateCarCommand

try {
    $apiInstance->apiAdminCarPost($create_car_command);
} catch (Exception $e) {
    echo 'Exception when calling AdminApi->apiAdminCarPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **create_car_command** | [**\OpenAPI\Client\models\CreateCarCommand**](../Model/CreateCarCommand.md)|  | |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`, `text/json`, `application/*+json`
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
