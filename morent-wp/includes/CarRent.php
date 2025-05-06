<?php
// Sample car data - in a real application this would come from a database
$cars = [
    [
        'id' => 1,
        'name' => 'Nissan GT-R',
        'category' => 'Sport Car',
        'price' => 80.00,
        'seats' => 2,
        'fuel' => '80L',
        'transmission' => 'Manual',
        'status' => 'Available',
        'image' => 'https://via.placeholder.com/50x50?text=GT-R'
    ],
    [
        'id' => 2,
        'name' => 'Porsche 911',
        'category' => 'Sport Car',
        'price' => 92.00,
        'seats' => 2,
        'fuel' => '64L',
        'transmission' => 'Auto',
        'status' => 'Available',
        'image' => 'https://via.placeholder.com/50x50?text=911'
    ],
    [
        'id' => 3,
        'name' => 'Range Rover Sport',
        'category' => 'SUV',
        'price' => 100.00,
        'seats' => 5,
        'fuel' => '90L',
        'transmission' => 'Auto',
        'status' => 'Available',
        'image' => 'https://via.placeholder.com/50x50?text=RR'
    ],
    [
        'id' => 4,
        'name' => 'Ferrari F8',
        'category' => 'Sport Car',
        'price' => 120.00,
        'seats' => 2,
        'fuel' => '78L',
        'transmission' => 'Auto',
        'status' => 'Available',
        'image' => 'https://via.placeholder.com/50x50?text=F8'
    ],
    [
        'id' => 5,
        'name' => 'Koenigsegg',
        'category' => 'Sport Car',
        'price' => 99.00,
        'seats' => 2,
        'fuel' => '82L',
        'transmission' => 'Auto',
        'status' => 'Available',
        'image' => 'https://via.placeholder.com/50x50?text=K'
    ],
    [
        'id' => 6,
        'name' => 'Rolls-Royce',
        'category' => 'Luxury Car',
        'price' => 96.00,
        'seats' => 4,
        'fuel' => '90L',
        'transmission' => 'Auto',
        'status' => 'Available',
        'image' => 'https://via.placeholder.com/50x50?text=RR'
    ],
    [
        'id' => 7,
        'name' => 'CR-V',
        'category' => 'SUV',
        'price' => 80.00,
        'seats' => 5,
        'fuel' => '65L',
        'transmission' => 'Auto',
        'status' => 'Available',
        'image' => 'https://via.placeholder.com/50x50?text=CRV'
    ],
];

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
        return $car['status'] === 'Available';
    });
} elseif ($currentTab === 'rented') {
    $filteredCars = array_filter($cars, function($car) {
        return $car['status'] === 'Rented';
    });
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Management System</title>
    <style>
        :root {
            --primary-color: #3b82f6;
            --light-bg: #f9fafb;
            --border-color: #e5e7eb;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --text-green: #10b981;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        
        body {
            background-color: var(--light-bg);
            color: var(--text-dark);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        h1 {
            font-size: 24px;
            font-weight: bold;
        }
        
        .search-filter {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        
        .search-bar {
            flex-grow: 1;
            margin-right: 20px;
            position: relative;
        }
        
        .search-bar input {
            width: 100%;
            padding: 10px 10px 10px 40px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 14px;
        }
        
        .search-bar::before {
            content: "🔍";
            position: absolute;
            left: 15px;
            top: 10px;
            color: var(--text-light);
        }
        
        .filter-btn {
            padding: 10px 20px;
            background-color: white;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        
        .tabs {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .tab {
            padding: 10px 0;
            cursor: pointer;
            color: var(--text-light);
            border-bottom: 2px solid transparent;
        }
        
        .tab.active {
            color: var(--text-dark);
            border-bottom: 2px solid var(--primary-color);
            font-weight: 500;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        th, td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }
        
        th {
            font-weight: 500;
            color: var(--text-light);
        }
        
        td {
            color: var(--text-dark);
        }
        
        .car-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
        }
        
        .car-name {
            font-weight: 500;
        }
        
        .car-id {
            color: var(--text-light);
            font-size: 12px;
        }
        
        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--text-green);
            display: inline-block;
        }
        
        .actions-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
        }
        
        .btn {
            padding: 10px 15px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            display: none;
        }
        
        .modal {
            background-color: white;
            border-radius: 8px;
            padding: 24px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .modal-title {
            font-size: 20px;
            font-weight: 600;
        }
        
        .close-btn {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: var(--text-light);
        }
        
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-group {
            flex: 1;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-dark);
        }
        
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 14px;
        }
        
        .form-text {
            font-size: 12px;
            color: var(--text-light);
            margin-top: 4px;
        }
        
        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }
        
        .submit-btn {
            padding: 10px 20px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-left: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Car Management</h1>
            <button class="btn" id="openModalBtn">
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
                            <img src="<?php echo htmlspecialchars($car['image']); ?>" alt="<?php echo htmlspecialchars($car['name']); ?>" class="car-image">
                            <div>
                                <div class="car-name"><?php echo htmlspecialchars($car['name']); ?></div>
                                <div class="car-id">#<?php echo $car['id']; ?></div>
                            </div>
                        </div>
                    </td>
                    <td><?php echo htmlspecialchars($car['category']); ?></td>
                    <td>$<?php echo number_format($car['price'], 2); ?></td>
                    <td><?php echo $car['seats']; ?></td>
                    <td><?php echo htmlspecialchars($car['fuel']); ?></td>
                    <td><?php echo htmlspecialchars($car['transmission']); ?></td>
                    <td><span class="status"><?php echo htmlspecialchars($car['status']); ?></span></td>
                    <td><button class="actions-btn">⋮</button></td>
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
                        <label class="form-label" for="car_name">Car Name</label>
                        <input type="text" class="form-control" id="car_name" name="car_name" placeholder="Nissan GT-R" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="category">Category</label>
                        <select class="form-control" id="category" name="category">
                            <option value="Sport Car">Sport Car</option>
                            <option value="SUV">SUV</option>
                            <option value="Sedan">Sedan</option>
                            <option value="Luxury Car">Luxury Car</option>
                            <option value="Compact">Compact</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="form-label" for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="A brief description of the car">
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="price">Price Per Day</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="100" min="0" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="image_url">Image URL</label>
                        <input type="text" class="form-control" id="image_url" name="image_url" placeholder="https://images.unsplash.com/photo-16...">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="seats">Seats</label>
                        <input type="number" class="form-control" id="seats" name="seats" placeholder="4" min="1" max="10" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="fuel_capacity">Fuel Capacity (L)</label>
                        <input type="number" class="form-control" id="fuel_capacity" name="fuel_capacity" placeholder="50" min="1" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="transmission">Transmission</label>
                        <select class="form-control" id="transmission" name="transmission">
                            <option value="Automatic">Automatic</option>
                            <option value="Manual">Manual</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="form-label" for="features">Features</label>
                    <input type="text" class="form-control" id="features" name="features" placeholder="Bluetooth, Navigation, Leather Seats">
                    <small class="form-text">Separate features with commas</small>
                </div>
                
                <div class="form-check">
                    <input type="checkbox" id="available" name="available" checked>
                    <label for="available">Available for Rent</label>
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
    </script>
</body>
</html>