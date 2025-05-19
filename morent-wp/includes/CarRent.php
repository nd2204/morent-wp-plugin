<?php
require_once(MR_PLUGIN_DIR . '/include/http/vendor/autoload.php');
require_once(MR_PLUGIN_DIR . '/include/http/lib/apis/CarApi.php');

$apiInstance = new OpenAPI\Client\apis\CarApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

$car_filter_brand = null; // string
$car_filter_type = null; // string
$car_filter_capacity = null; // int
$car_filter_fuel_type = null; // string
$car_filter_gearbox = null; // string
$car_filter_min_price = null; // float
$car_filter_max_price = null; // float
$car_filter_rating = null; // int
$car_filter_location = null; // string
$car_filter_search = null; // string
$car_filter_sort = null; // string
$paged_query_page = null; // int
$paged_query_page_size = null; // int

$cars = []; 

try {
    $result = $apiInstance->apiCarsGet($car_filter_brand, $car_filter_type, $car_filter_capacity, $car_filter_fuel_type, $car_filter_gearbox, $car_filter_min_price, $car_filter_max_price, $car_filter_rating, $car_filter_location, $car_filter_search, $car_filter_sort, $paged_query_page, $paged_query_page_size);
    foreach ($result as $key => $car) {
        echo "Key: $key - Value: $car <br>";
    }
    $cars = $result;
} catch (Exception $e) {
    echo 'Exception when calling CarApi->apiCarsGet: ', $e->getMessage(), PHP_EOL;
}

// Handle form submission for adding a new car
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_car'])) {
    $newCar = [
        'id' => count($cars) + 1,
        'name' => $_POST['car_name'],
        'category' => $_POST['category'],
        'price' => (float)$_POST['price'],
        'seats' => (int)$_POST['seats'],
        'fuel' => $_POST['fuel_capacity'] . 'L',
        'transmission' => $_POST['transmission'],
        'status' => isset($_POST['available']) ? 'Available' : 'Not Available',
        'image' => $_POST['image_url'] ?: 'https://via.placeholder.com/50x50?text=New'
    ];
    
    // In a real application, you would save this to a database
    // For this example, we'll just add it to our array (which will be lost when the page refreshes)
    $cars[] = $newCar;
    
    // Redirect to prevent form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Filter cars based on current tab
$currentTab = isset($_GET['tab']) ? $_GET['tab'] : 'all';
$filteredCars = $cars;

if ($currentTab === 'available') {
    $filteredCars = array_filter($cars, function($car) {
        return $car['is_available'] === true;
    });
} elseif ($currentTab === 'rented') {
    $filteredCars = array_filter($cars, function($car) {
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
            <button class="btn btn-primary" id="openModalBtn">
                <span>+</span> Add New Car
            </button>
        </header>
        
        <div class="search-filter">
            <div class="search-bar">
                <input type="text" placeholder="Search cars...">
            </div>
            <button class="filter-btn">
                <span>Filter</span>
            </button>
        </div>
        
        <div class="tabs">
            <a href="admin.php?page=Morent_Car_Rent&tab=all" class="tab <?php echo $currentTab === 'all' ? 'active' : ''; ?>">All Cars</a>
            <a href="admin.php?page=Morent_Car_Rent&tab=available" class="tab <?php echo $currentTab === 'available' ? 'active' : ''; ?>">Available</a>
            <a href="admin.php?page=Morent_Car_Rent&tab=rented" class="tab <?php echo $currentTab === 'rented' ? 'active' : ''; ?>">Rented</a>
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
                                <button class="dropdown-action update-action" style="width: 100%; padding: 8px 12px; border: none; background: none; text-align: left; cursor: pointer;">Update</button>
                                <button class="dropdown-action delete-action" style="width: 100%; padding: 8px 12px; border: none; background: none; text-align: left; color: #d00; cursor: pointer;">Delete</button>
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
                <button class="close-btn" id="closeModalBtn">&times;</button>
            </div>
            <p style="margin-bottom: 20px; color: var(--text-light);">Fill in the details of the new car to add to your fleet.</p>
            
            <form method="POST" action="">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="title">Car Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Nissan GT-R" required>
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
                        <label class="form-label" for="average_rating">Average Rating</label>
                        <input type="number" class="form-control" id="average_rating" name="average_rating" step="0.1" min="0" max="5">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="reviews_count">Reviews Count</label>
                        <input type="number" class="form-control" id="reviews_count" name="reviews_count" min="0">
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
    
    <script>
        // JavaScript for modal functionality
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const modal = document.getElementById('addCarModal');
        
        openModalBtn.addEventListener('click', function() {
            modal.style.display = 'flex';
        });
        
        closeModalBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });
        
        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
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
        updateActions.forEach(btn => btn.addEventListener('click', function(e) {
            e.stopPropagation();
            alert('Chức năng Update sẽ được triển khai sau!');
        }));
        deleteActions.forEach(btn => btn.addEventListener('click', function(e) {
            e.stopPropagation();
            if (confirm('Are you sure to delete this car?')) {
                alert('Chức năng Xóa sẽ được triển khai sau!');
            }
        }));
    </script>
</body>
</html>