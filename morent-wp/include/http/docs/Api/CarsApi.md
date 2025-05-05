# OpenAPI\Client\CarsApi

All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiCarsGet()**](CarsApi.md#apiCarsGet) | **GET** /api/cars |  |
| [**apiCarsIdDelete()**](CarsApi.md#apiCarsIdDelete) | **DELETE** /api/cars/{id} |  |
| [**apiCarsIdGet()**](CarsApi.md#apiCarsIdGet) | **GET** /api/cars/{id} |  |
| [**apiCarsIdPut()**](CarsApi.md#apiCarsIdPut) | **PUT** /api/cars/{id} |  |
| [**apiCarsPost()**](CarsApi.md#apiCarsPost) | **POST** /api/cars |  |


## `apiCarsGet()`

```php
apiCarsGet($car_filter_brand, $car_filter_type, $car_filter_capacity, $car_filter_fuel_type, $car_filter_gearbox, $car_filter_min_price, $car_filter_max_price, $car_filter_rating, $car_filter_location, $car_filter_search, $car_filter_sort, $paged_query_page, $paged_query_page_size): \OpenAPI\Client\models\CarDto[]
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\CarsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$car_filter_brand = 'car_filter_brand_example'; // string
$car_filter_type = 'car_filter_type_example'; // string
$car_filter_capacity = 56; // int
$car_filter_fuel_type = 'car_filter_fuel_type_example'; // string
$car_filter_gearbox = 'car_filter_gearbox_example'; // string
$car_filter_min_price = 3.4; // float
$car_filter_max_price = 3.4; // float
$car_filter_rating = 56; // int
$car_filter_location = 'car_filter_location_example'; // string
$car_filter_search = 'car_filter_search_example'; // string
$car_filter_sort = 'car_filter_sort_example'; // string
$paged_query_page = 56; // int
$paged_query_page_size = 56; // int

try {
    $result = $apiInstance->apiCarsGet($car_filter_brand, $car_filter_type, $car_filter_capacity, $car_filter_fuel_type, $car_filter_gearbox, $car_filter_min_price, $car_filter_max_price, $car_filter_rating, $car_filter_location, $car_filter_search, $car_filter_sort, $paged_query_page, $paged_query_page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CarsApi->apiCarsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **car_filter_brand** | **string**|  | [optional] |
| **car_filter_type** | **string**|  | [optional] |
| **car_filter_capacity** | **int**|  | [optional] |
| **car_filter_fuel_type** | **string**|  | [optional] |
| **car_filter_gearbox** | **string**|  | [optional] |
| **car_filter_min_price** | **float**|  | [optional] |
| **car_filter_max_price** | **float**|  | [optional] |
| **car_filter_rating** | **int**|  | [optional] |
| **car_filter_location** | **string**|  | [optional] |
| **car_filter_search** | **string**|  | [optional] |
| **car_filter_sort** | **string**|  | [optional] |
| **paged_query_page** | **int**|  | [optional] |
| **paged_query_page_size** | **int**|  | [optional] |

### Return type

[**\OpenAPI\Client\models\CarDto[]**](../Model/CarDto.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiCarsIdDelete()`

```php
apiCarsIdDelete($id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\CarsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string

try {
    $apiInstance->apiCarsIdDelete($id);
} catch (Exception $e) {
    echo 'Exception when calling CarsApi->apiCarsIdDelete: ', $e->getMessage(), PHP_EOL;
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

## `apiCarsIdGet()`

```php
apiCarsIdGet($id): \OpenAPI\Client\models\CarDetailDto
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\CarsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string

try {
    $result = $apiInstance->apiCarsIdGet($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CarsApi->apiCarsIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |

### Return type

[**\OpenAPI\Client\models\CarDetailDto**](../Model/CarDetailDto.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiCarsIdPut()`

```php
apiCarsIdPut($id, $update_car_command)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\CarsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string
$update_car_command = new \OpenAPI\Client\models\UpdateCarCommand(); // \OpenAPI\Client\models\UpdateCarCommand

try {
    $apiInstance->apiCarsIdPut($id, $update_car_command);
} catch (Exception $e) {
    echo 'Exception when calling CarsApi->apiCarsIdPut: ', $e->getMessage(), PHP_EOL;
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

## `apiCarsPost()`

```php
apiCarsPost($create_car_command)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\CarsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$create_car_command = new \OpenAPI\Client\models\CreateCarCommand(); // \OpenAPI\Client\models\CreateCarCommand

try {
    $apiInstance->apiCarsPost($create_car_command);
} catch (Exception $e) {
    echo 'Exception when calling CarsApi->apiCarsPost: ', $e->getMessage(), PHP_EOL;
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
