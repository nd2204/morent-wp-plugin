# OpenAPI\Client\CarApi

All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiCarsCarIdImagesGet()**](CarApi.md#apiCarsCarIdImagesGet) | **GET** /api/cars/{carId}/images |  |
| [**apiCarsGet()**](CarApi.md#apiCarsGet) | **GET** /api/cars |  |
| [**apiCarsIdGet()**](CarApi.md#apiCarsIdGet) | **GET** /api/cars/{id} |  |
| [**apiCarsIdReviewsGet()**](CarApi.md#apiCarsIdReviewsGet) | **GET** /api/cars/{id}/reviews |  |


## `apiCarsCarIdImagesGet()`

```php
apiCarsCarIdImagesGet($car_id): \OpenAPI\Client\models\CarImageDto[]
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\CarApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$car_id = 'car_id_example'; // string

try {
    $result = $apiInstance->apiCarsCarIdImagesGet($car_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CarApi->apiCarsCarIdImagesGet: ', $e->getMessage(), PHP_EOL;
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

## `apiCarsGet()`

```php
apiCarsGet($car_filter_brand, $car_filter_type, $car_filter_capacity, $car_filter_fuel_type, $car_filter_gearbox, $car_filter_min_price, $car_filter_max_price, $car_filter_rating, $car_filter_location, $car_filter_search, $car_filter_sort, $paged_query_page, $paged_query_page_size): \OpenAPI\Client\models\CarDto[]
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\CarApi(
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
    echo 'Exception when calling CarApi->apiCarsGet: ', $e->getMessage(), PHP_EOL;
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

## `apiCarsIdGet()`

```php
apiCarsIdGet($id): \OpenAPI\Client\models\CarDetailDto
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\CarApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string

try {
    $result = $apiInstance->apiCarsIdGet($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CarApi->apiCarsIdGet: ', $e->getMessage(), PHP_EOL;
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

## `apiCarsIdReviewsGet()`

```php
apiCarsIdReviewsGet($id, $car_id): \OpenAPI\Client\models\ReviewDto[]
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\CarApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string
$car_id = 'car_id_example'; // string

try {
    $result = $apiInstance->apiCarsIdReviewsGet($id, $car_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CarApi->apiCarsIdReviewsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **car_id** | **string**|  | [optional] |

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
