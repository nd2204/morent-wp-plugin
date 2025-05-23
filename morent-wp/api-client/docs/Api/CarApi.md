# OpenAPI\Client\CarApi

All URIs are relative to https://localhost:7083, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiCarsCarIdGet()**](CarApi.md#apiCarsCarIdGet) | **GET** /api/cars/{carId} |  |
| [**apiCarsCarIdImagesGet()**](CarApi.md#apiCarsCarIdImagesGet) | **GET** /api/cars/{carId}/images |  |
| [**apiCarsCarIdReviewsGet()**](CarApi.md#apiCarsCarIdReviewsGet) | **GET** /api/cars/{carId}/reviews |  |
| [**apiCarsGet()**](CarApi.md#apiCarsGet) | **GET** /api/cars |  |
| [**apiCarsModelsGet()**](CarApi.md#apiCarsModelsGet) | **GET** /api/cars/models |  |
| [**apiCarsNearGet()**](CarApi.md#apiCarsNearGet) | **GET** /api/cars/near |  |


## `apiCarsCarIdGet()`

```php
apiCarsCarIdGet($car_id): \OpenAPI\Client\models\CarDetailDto
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
    $result = $apiInstance->apiCarsCarIdGet($car_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CarApi->apiCarsCarIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **car_id** | **string**|  | |

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

## `apiCarsCarIdReviewsGet()`

```php
apiCarsCarIdReviewsGet($car_id): \OpenAPI\Client\models\ReviewDto[]
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
    $result = $apiInstance->apiCarsCarIdReviewsGet($car_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CarApi->apiCarsCarIdReviewsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **car_id** | **string**|  | |

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

## `apiCarsGet()`

```php
apiCarsGet($car_filter_brand, $car_filter_type, $car_filter_capacity, $car_filter_fuel_type, $car_filter_gearbox, $car_filter_min_price, $car_filter_max_price, $car_filter_rating, $car_filter_near_lat, $car_filter_near_lon, $car_filter_max_distance_km, $car_filter_search, $car_filter_sort, $paged_query_page, $paged_query_page_size): \OpenAPI\Client\models\CarDto[]
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
$car_filter_near_lat = 3.4; // float
$car_filter_near_lon = 3.4; // float
$car_filter_max_distance_km = 56; // int
$car_filter_search = 'car_filter_search_example'; // string
$car_filter_sort = 'car_filter_sort_example'; // string
$paged_query_page = 56; // int
$paged_query_page_size = 56; // int

try {
    $result = $apiInstance->apiCarsGet($car_filter_brand, $car_filter_type, $car_filter_capacity, $car_filter_fuel_type, $car_filter_gearbox, $car_filter_min_price, $car_filter_max_price, $car_filter_rating, $car_filter_near_lat, $car_filter_near_lon, $car_filter_max_distance_km, $car_filter_search, $car_filter_sort, $paged_query_page, $paged_query_page_size);
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
| **car_filter_near_lat** | **float**|  | [optional] |
| **car_filter_near_lon** | **float**|  | [optional] |
| **car_filter_max_distance_km** | **int**|  | [optional] |
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

## `apiCarsModelsGet()`

```php
apiCarsModelsGet($page, $page_size): \OpenAPI\Client\models\CarModelDto[]
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
$page = 56; // int
$page_size = 56; // int

try {
    $result = $apiInstance->apiCarsModelsGet($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CarApi->apiCarsModelsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **page** | **int**|  | [optional] |
| **page_size** | **int**|  | [optional] |

### Return type

[**\OpenAPI\Client\models\CarModelDto[]**](../Model/CarModelDto.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiCarsNearGet()`

```php
apiCarsNearGet($longitude, $latitude, $max_distance_km): \OpenAPI\Client\models\CarLocationDto[]
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
$longitude = 3.4; // float
$latitude = 3.4; // float
$max_distance_km = 3.4; // float

try {
    $result = $apiInstance->apiCarsNearGet($longitude, $latitude, $max_distance_km);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CarApi->apiCarsNearGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **longitude** | **float**|  | [optional] |
| **latitude** | **float**|  | [optional] |
| **max_distance_km** | **float**|  | [optional] |

### Return type

[**\OpenAPI\Client\models\CarLocationDto[]**](../Model/CarLocationDto.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `text/plain`, `application/json`, `text/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
