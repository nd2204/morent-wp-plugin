# OpenAPI\Client\AdminApi

All URIs are relative to https://localhost:7083, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiAdminCarsCarIdImagesImageIdPost()**](AdminApi.md#apiAdminCarsCarIdImagesImageIdPost) | **POST** /api/admin/cars/{carId}/images/{imageId} |  |
| [**apiAdminCarsCarIdImagesImageIdSetPrimaryPut()**](AdminApi.md#apiAdminCarsCarIdImagesImageIdSetPrimaryPut) | **PUT** /api/admin/cars/{carId}/images/{imageId}/set-primary |  |
| [**apiAdminCarsCarIdImagesPost()**](AdminApi.md#apiAdminCarsCarIdImagesPost) | **POST** /api/admin/cars/{carId}/images |  |
| [**apiAdminCarsCarIdImagesReorderPut()**](AdminApi.md#apiAdminCarsCarIdImagesReorderPut) | **PUT** /api/admin/cars/{carId}/images/reorder |  |
| [**apiAdminCarsIdDelete()**](AdminApi.md#apiAdminCarsIdDelete) | **DELETE** /api/admin/cars/{id} |  |
| [**apiAdminCarsIdPut()**](AdminApi.md#apiAdminCarsIdPut) | **PUT** /api/admin/cars/{id} |  |
| [**apiAdminCarsPost()**](AdminApi.md#apiAdminCarsPost) | **POST** /api/admin/cars |  |
| [**apiAdminRentalsGet()**](AdminApi.md#apiAdminRentalsGet) | **GET** /api/admin/rentals |  |
| [**apiAdminUsersGet()**](AdminApi.md#apiAdminUsersGet) | **GET** /api/admin/users |  |


## `apiAdminCarsCarIdImagesImageIdPost()`

```php
apiAdminCarsCarIdImagesImageIdPost($car_id, $image_id)
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
    $apiInstance->apiAdminCarsCarIdImagesImageIdPost($car_id, $image_id);
} catch (Exception $e) {
    echo 'Exception when calling AdminApi->apiAdminCarsCarIdImagesImageIdPost: ', $e->getMessage(), PHP_EOL;
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

## `apiAdminCarsCarIdImagesImageIdSetPrimaryPut()`

```php
apiAdminCarsCarIdImagesImageIdSetPrimaryPut($car_id, $image_id): \OpenAPI\Client\models\CarImageDto
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
    $result = $apiInstance->apiAdminCarsCarIdImagesImageIdSetPrimaryPut($car_id, $image_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AdminApi->apiAdminCarsCarIdImagesImageIdSetPrimaryPut: ', $e->getMessage(), PHP_EOL;
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

## `apiAdminCarsCarIdImagesPost()`

```php
apiAdminCarsCarIdImagesPost($car_id, $image, $image_url, $set_as_primary): \OpenAPI\Client\models\CarImageDto
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
    $result = $apiInstance->apiAdminCarsCarIdImagesPost($car_id, $image, $image_url, $set_as_primary);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AdminApi->apiAdminCarsCarIdImagesPost: ', $e->getMessage(), PHP_EOL;
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

## `apiAdminCarsCarIdImagesReorderPut()`

```php
apiAdminCarsCarIdImagesReorderPut($car_id, $car_image_order_item)
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
    $apiInstance->apiAdminCarsCarIdImagesReorderPut($car_id, $car_image_order_item);
} catch (Exception $e) {
    echo 'Exception when calling AdminApi->apiAdminCarsCarIdImagesReorderPut: ', $e->getMessage(), PHP_EOL;
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

## `apiAdminCarsIdDelete()`

```php
apiAdminCarsIdDelete($id)
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
    $apiInstance->apiAdminCarsIdDelete($id);
} catch (Exception $e) {
    echo 'Exception when calling AdminApi->apiAdminCarsIdDelete: ', $e->getMessage(), PHP_EOL;
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

## `apiAdminCarsIdPut()`

```php
apiAdminCarsIdPut($id, $update_car_command)
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
    $apiInstance->apiAdminCarsIdPut($id, $update_car_command);
} catch (Exception $e) {
    echo 'Exception when calling AdminApi->apiAdminCarsIdPut: ', $e->getMessage(), PHP_EOL;
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

## `apiAdminCarsPost()`

```php
apiAdminCarsPost($create_car_command)
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
    $apiInstance->apiAdminCarsPost($create_car_command);
} catch (Exception $e) {
    echo 'Exception when calling AdminApi->apiAdminCarsPost: ', $e->getMessage(), PHP_EOL;
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

## `apiAdminRentalsGet()`

```php
apiAdminRentalsGet($page, $page_size): \OpenAPI\Client\models\RentalDetailDto[]
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
$page = 56; // int
$page_size = 56; // int

try {
    $result = $apiInstance->apiAdminRentalsGet($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AdminApi->apiAdminRentalsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **page** | **int**|  | [optional] |
| **page_size** | **int**|  | [optional] |

### Return type

[**\OpenAPI\Client\models\RentalDetailDto[]**](../Model/RentalDetailDto.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiAdminUsersGet()`

```php
apiAdminUsersGet($page, $page_size): \OpenAPI\Client\models\UserDto[]
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
$page = 56; // int
$page_size = 56; // int

try {
    $result = $apiInstance->apiAdminUsersGet($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AdminApi->apiAdminUsersGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **page** | **int**|  | [optional] |
| **page_size** | **int**|  | [optional] |

### Return type

[**\OpenAPI\Client\models\UserDto[]**](../Model/UserDto.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
