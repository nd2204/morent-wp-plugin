<?php

use OpenAPI\Client\models\CreateCarCommand;
use OpenAPI\Client\models\LocationDto;
use OpenAPI\Client\models\UploadCarImageRequest;

$apiInstance = new MorentApiClient()->carApi();
$apiInstanceAdmin = new MorentApiClient()->adminApi();

// Handle form submission for adding a new car
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_car'])) {
    $imageToUpload = [];

    foreach (explode(',', $_POST['images']) as $image) {
        array_push($imageToUpload, new UploadCarImageRequest([
            "image_url" => $image,
        ]));
    }

    $create_car_command = new CreateCarCommand(
        [
            // 'is_available' => isset($_POST['is_available']) ? true : false,
            'year' => $_POST['year'],
            'license_plate' => $_POST['license_plate'],
            'price_per_day' => $_POST['price_per_day'],
            'currency' => $_POST['currency'],
            'images' => $imageToUpload,
            'location' => new LocationDto([
                'address' => $_POST['address'],
                'city' => $_POST['city'],
                'country' => $_POST['country'],
                'longitude' => $_POST['longitude'] ?? 105,
                'latitude' => $_POST['latitude'] ?? 21
            ]),
            'model_id' => $_POST['model_id']
        ]
    );

    try {
        $apiInstanceAdmin->apiAdminCarsPost($create_car_command);
    } catch (Exception $e) {
        echo 'Exception when calling AdminApi->apiAdminCarsPost: ', $e->getMessage(), PHP_EOL;
    }
}

// Handle form submission for deleting a car
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_car'])) {
    $carIdToDelete = $_POST['delete_car'];

    try {
        $apiInstanceAdmin->apiAdminCarsIdDelete($carIdToDelete);
    } catch (Exception $e) {
        echo 'Exception when calling AdminApi->apiAdminCarsIdDelete: ', $e->getMessage(), PHP_EOL;
    }
}

$car_filter_brand = null; // string
$car_filter_type = null; // string
$car_filter_capacity = null; // int
$car_filter_fuel_type = null; // string
$car_filter_gearbox = null; // string
$car_filter_min_price = null; // float
$car_filter_max_price = null; // float
$car_filter_rating = null; // int
$car_filter_lon = null; // string
$car_filter_search = null; // string
$car_filter_sort = null; // string
$paged_query_page = null; // int
$paged_query_page_size = null; // int

$cars = [];
$car_models = [];

try {
    $cars = $apiInstance->apiCarsGet($car_filter_brand, $car_filter_type, $car_filter_capacity, $car_filter_fuel_type, $car_filter_gearbox, $car_filter_min_price, $car_filter_max_price, $car_filter_rating, $car_filter_location, $car_filter_search, $car_filter_sort, $paged_query_page, $paged_query_page_size);
} catch (Exception $e) {
    echo 'Exception when calling CarApi->apiCarsGet: ', $e->getMessage(), PHP_EOL;
}

try {
    $page = 1;
    $page_size = 20;
    $car_models = $apiInstance->apiCarsModelsGet($page, $page_size);

    foreach ($car_models as $key => $carModel) {
        echo "Key: $key - Value: $carModel <br>";
    }
} catch (Exception $e) {
    echo 'Exception when calling CarApi->apiCarModelsGet: ', $e->getMessage(), PHP_EOL;
}

// Filter cars based on current tab
$currentTab = isset($_GET['tab']) ? $_GET['tab'] : 'all';
$filteredCars = $cars;

if ($currentTab === 'available') {
    $filteredCars = array_filter($cars, function ($car) {
        return $car['is_available'] === true;
    });
} elseif ($currentTab === 'rented') {
    $filteredCars = array_filter($cars, function ($car) {
        return $car['is_available'] === false;
    });
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Management System</title>
</head>

<body>
    <div class="container">
        <header>
            <h1>Car Management</h1>
            <div>
                <button class="btn btn-primary" id="openNewCarModelModalBtn">
                    <i class="fas fa-plus"></i> Add New Car's Model
                </button>
                <button class="btn btn-primary" id="openNewCarModalBtn">
                    <i class="fas fa-plus"></i> Add New Car
                </button>
            </div>
        </header>

        <div class="search-filter">
            <div class="searchbar">
                <svg viewBox="0 0 24 24" aria-hidden="true" class="searchbar__icon">
                    <g>
                        <path
                            d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                    </g>
                </svg>

                <input
                    id="query"
                    class="searchbar__input"
                    type="search"
                    placeholder="Search..."
                    name="searchbar" />
            </div>
        </div>

        <div class="tabs">
            <a href="admin.php?page=morent_car_rent&tab=all" class="tab <?php echo $currentTab === 'all' ? 'active' : ''; ?>">All Cars</a>
            <a href="admin.php?page=morent_car_rent&tab=available" class="tab <?php echo $currentTab === 'available' ? 'active' : ''; ?>">Available</a>
            <a href="admin.php?page=morent_car_rent&tab=rented" class="tab <?php echo $currentTab === 'rented' ? 'active' : ''; ?>">Rented</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Car</th>
                    <th>Category</th>
                    <th>Price/Day</th>
                    <th>Seats</th>
                    <th>Fuel</th>
                    <th>Transmission</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filteredCars as $car): ?>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="<?php echo htmlspecialchars($car['images'][0]['url']); ?>" alt="<?php echo htmlspecialchars($car['title']); ?>" class="car-image">
                                <div>
                                    <div class="car-name"><?php echo htmlspecialchars($car['title']); ?></div>
                                    <div class="car-id">#<?php echo $car['id']; ?></div>
                                </div>
                            </div>
                        </td>
                        <td><?php echo htmlspecialchars($car['car_model']['type']); ?></td>
                        <td>$<?php echo number_format($car['price_per_day'], 2); ?></td>
                        <td><?php echo $car['car_model']['seat_capacity']; ?></td>
                        <td><?php echo htmlspecialchars($car['car_model']['fuel_tank_capacity']); ?></td>
                        <td><?php echo htmlspecialchars($car['car_model']['gear_box']); ?></td>
                        <td><span class="status"><?php echo htmlspecialchars($car['is_available'] ? "Available" : "Unavailable"); ?></span></td>
                        <td>
                            <div class="actions-dropdown-wrapper" style="position: relative;">
                                <button class="actions-btn">⋮</button>
                                <div class="actions-dropdown" style="display: none; position: absolute; right: 0; top: 100%; background: #fff; border: 1px solid #ddd; box-shadow: 0 2px 8px rgba(0,0,0,0.1); z-index: 10; min-width: 120px;">
                                    <button id="updateCarBtn" type="button" value="<?php echo htmlspecialchars($car['id']); ?>" class="dropdown-action update-action" style="width: 100%; padding: 8px 12px; border: none; background: none; text-align: left; cursor: pointer;"><i class="fa-solid fa-pen-to-square"></i> Update</button>
                                    <form method="POST" action="" id="deleteCarForm">
                                        <input type="hidden" name="delete_car" value="<?php echo htmlspecialchars($car['id']); ?>">
                                        <button type="button" class="dropdown-action delete-action" style="width: 100%; padding: 8px 12px; border: none; background: none; text-align: left; color: #d00; cursor: pointer;"><i class="fa-solid fa-trash"></i> Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Add New Car Modal -->
    <div class="modal-overlay" id="addCarModal">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title">Add New Car</h3>
                <button class="close-btn" id="closeNewCarModalBtn">&times;</button>
            </div>
            <p style="margin-bottom: 20px; color: var(--text-light);">Fill in the details of the new car to add to your fleet.</p>

            <form method="POST" action="">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="year">Year</label>
                        <input type="number" class="form-control" id="year" name="year" placeholder="1999" min="1900" step="1" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="license_plate">License Plate</label>
                        <input type="text" class="form-control" id="license_plate" name="license_plate" placeholder="XYZ-1234" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="price_per_day">Price Per Day</label>
                        <input type="number" class="form-control" id="price_per_day" name="price_per_day" placeholder="100" min="0" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="currency">Currency</label>
                        <select class="form-control" id="currency" name="currency" required>
                            <option value="USD">USD</option>
                            <option value="EUR">EUR</option>
                            <option value="VND">VND</option>
                            <option value="JPY">JPY</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="images">Image URLs</label>
                        <input type="text" class="form-control" id="images" name="images" placeholder="Comma-separated URLs" required>
                        <small class="form-text">Separate multiple image URLs with commas</small>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="123 Main St, City" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="country">Country</label>
                        <input type="text" class="form-control" id="country" name="country" placeholder="Country" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="model_id">Car's Model</label>
                        <select class="form-control" id="model_id" name="model_id" required>
                            <?php foreach ($car_models as $car_model): ?>
                                <option value="<?php echo htmlspecialchars($car_model['model_id']); ?>">
                                    <?php echo htmlspecialchars($car_model['model']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-check" style="margin-top: 20px;">
                    <input type="checkbox" id="is_available" name="is_available" checked>
                    <label for="is_available">Available for Rent</label>
                </div>

                <button type="submit" class="submit-btn" name="add_car">
                    <span>✓</span> Add Car
                </button>
            </form>
        </div>
    </div>

    <!-- Add New Car Model Modal -->
    <div class="modal-overlay" id="addCarModelModal">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title">Add New Car's Model</h3>
                <button class="close-btn" id="closeNewCarModelModalBtn">&times;</button>
            </div>
            <p style="margin-bottom: 20px; color: var(--text-light);">Fill in the details of the new car model to add to your fleet.</p>

            <form method="POST" action="">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="brand">Brand</label>
                        <input type="text" class="form-control" id="brand" name="brand" placeholder="Nissan" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="model">Model</label>
                        <input type="text" class="form-control" id="model" name="model" placeholder="GT-R" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="fuel_type">Fuel Type</label>
                        <select class="form-control" id="fuel_type" name="fuel_type" required>
                            <option value="Petrol">Petrol</option>
                            <option value="Diesel">Diesel</option>
                            <option value="Electric">Electric</option>
                            <option value="Hybrid">Hybrid</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="gear_box">Gear Box</label>
                        <select class="form-control" id="gear_box" name="gear_box" required>
                            <option value="Automatic">Automatic</option>
                            <option value="Manual">Manual</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="fuel_tank_capacity">Fuel Tank Capacity (L)</label>
                        <input type="number" class="form-control" id="fuel_tank_capacity" name="fuel_tank_capacity" placeholder="50" min="1" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="year">Year</label>
                        <input type="number" class="form-control" id="year" name="year" placeholder="2022" min="1900" max="2100" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="seat_capacity">Seat Capacity</label>
                        <input type="number" class="form-control" id="seat_capacity" name="seat_capacity" placeholder="4" min="1" max="10" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="type">Type</label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="Sport Car">Sport Car</option>
                            <option value="SUV">SUV</option>
                            <option value="Sedan">Sedan</option>
                            <option value="Luxury Car">Luxury Car</option>
                            <option value="Compact">Compact</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="submit-btn" name="add_car_model">
                    <span>✓</span> Add Car Model
                </button>
            </form>
        </div>

        <div style="height: 470px; overflow-y: auto; border-radius: 8px;">
            <table>
                <thead>
                    <tr>
                        <th>Model</th>
                        <th>Brand</th>
                        <th>Fuel type</th>
                        <th>Gear box</th>
                        <th>Fuel tank capacity</th>
                        <th>Year</th>
                        <th>Seat capacity</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($car_models as $car_model): ?>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div>
                                        <div class="car-name"><?php echo $car_model['model']; ?></div>
                                        <div class="car-id">#<?php echo htmlspecialchars($car_model['model_id']); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo $car_model['brand']; ?></td>
                            <td><?php echo htmlspecialchars($car_model['fuel_type']); ?></td>
                            <td><?php echo htmlspecialchars($car_model['gear_box']); ?></td>
                            <td><?php echo number_format($car_model['fuel_tank_capacity'], 2); ?></td>
                            <td><?php echo $car_model['year']; ?></td>
                            <td><?php echo $car_model['seat_capacity']; ?></td>
                            <td><?php echo $car_model['type']; ?></td>
                            <td>
                                <div class="actions-dropdown-wrapper" style="position: relative;">
                                    <button class="actions-btn">⋮</button>
                                    <div class="actions-dropdown" style="display: none; position: absolute; right: 0; top: 100%; background: #fff; border: 1px solid #ddd; box-shadow: 0 2px 8px rgba(0,0,0,0.1); z-index: 10; min-width: 120px;">
                                        <button class="dropdown-action update-action" style="width: 100%; padding: 8px 12px; border: none; background: none; text-align: left; cursor: pointer;"><i class="fa-solid fa-pen-to-square"></i> Update</button>
                                        <form method="POST" action="">
                                            <input type="hidden" name="delete_car_model" value="<?php echo htmlspecialchars($car_model['model_id']); ?>">
                                            <button type="button" class="dropdown-action delete-action" style="width: 100%; padding: 8px 12px; border: none; background: none; text-align: left; color: #d00; cursor: pointer;"><i class="fa-solid fa-trash"></i> Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // JavaScript for modal functionality
        const openNewCarModalBtn = document.getElementById('openNewCarModalBtn');
        const openNewCarModelModalBtn = document.getElementById('openNewCarModelModalBtn');
        const closeNewCarModalBtn = document.getElementById('closeNewCarModalBtn');
        const closeNewCarModelModalBtn = document.getElementById('closeNewCarModelModalBtn');
        const modal = document.getElementById('addCarModal');
        const modalModel = document.getElementById('addCarModelModal');

        openNewCarModalBtn.addEventListener('click', function() {
            modal.style.display = 'flex';
        });
        openNewCarModelModalBtn.addEventListener('click', function() {
            modalModel.style.display = 'flex';
        });

        closeNewCarModalBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });
        closeNewCarModelModalBtn.addEventListener('click', function() {
            modalModel.style.display = 'none';
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
        window.addEventListener('click', function(event) {
            if (event.target === modalModel) {
                modalModel.style.display = 'none';
            }
        });

        // Dropdown actions for each car row
        const actionButtons = document.querySelectorAll('.actions-btn');
        actionButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                // Close all other dropdowns
                document.querySelectorAll('.actions-dropdown').forEach(drop => drop.style.display = 'none');
                // Toggle this dropdown
                const dropdown = btn.nextElementSibling;
                if (dropdown) {
                    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                }
            });
        });
        // Close dropdown when clicking outside
        window.addEventListener('click', function() {
            document.querySelectorAll('.actions-dropdown').forEach(drop => drop.style.display = 'none');
        });
        // Placeholder for Update and Delete actions
        const updateActions = document.querySelectorAll('.update-action');
        const deleteActions = document.querySelectorAll('.delete-action');
        // updateActions.forEach(btn => btn.addEventListener('click', function(e) {
        //     e.stopPropagation();
        //     modal.style.display = 'flex';
        //     const carId = btn.value;
        //     console.log('Car ID to update:', carId);
        //     document.getElementById('year').value = carId; // Example of setting a value, replace with actual data
        // }));
        updateActions.forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                document.getElementById('year').value = row.querySelector('.car-name').textContent; // Example of setting a value, replace with actual data
                document.getElementById('license_plate').value = row.querySelector('.car-id').textContent; // Example of setting a value, replace with actual data
                document.getElementById('price_per_day').value = row.children[2].textContent; // Example of setting a value, replace with actual data
                document.getElementById('currency').value = "USD"; // Example of setting a value, replace with actual data
                document.getElementById('images').value = ""; // Example of setting a value, replace with actual data
                document.getElementById('address').value = ""; // Example of setting a value, replace with actual data
                document.getElementById('city').value = ""; // Example of setting a value, replace with actual data
                document.getElementById('country').value = ""; // Example of setting a value, replace with actual data
                document.getElementById('model_id').value = row.children[1].textContent; // Example of setting a value, replace with actual data
                modal.style.display = 'flex';
            });
        });
        deleteActions.forEach(btn => btn.addEventListener('click', function(e) {
            e.stopPropagation();
            if (confirm('Are you sure to delete?')) {
                // Submit the parent form
                btn.closest('form').submit();
            }
            // Nếu không xác nhận thì không làm gì, không reload trang
        }));

        // Search functionality
        const searchInput = document.getElementById('query');
        searchInput.addEventListener('input', function() {
            const query = searchInput.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const carName = row.querySelector('.car-name').textContent.toLowerCase();
                if (carName.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>