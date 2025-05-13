<?php
if (!sm_is_logged_in()) {
    echo "<script>location.href='" . admin_url('admin.php?page=Morent_dashboard') . "'</script>";
    exit;
}

$user = $_SESSION['Morent_user'];
?>

<?php
// Sample data for the car rental dashboard
$rentalDetails = [
    'carModel' => 'Nissan GT - R',
    'carType' => 'Sport Car',
    'rentalId' => '#9761',
    'pickupLocation' => 'Kota Semarang',
    'pickupDate' => '20 July 2022',
    'pickupTime' => '07:00',
    'dropoffLocation' => 'Kota Semarang',
    'dropoffDate' => '21 July 2022',
    'dropoffTime' => '01:00',
    'totalPrice' => '$80.00'
];

$topCarRentals = [
    ['type' => 'Sport Car', 'count' => 17439, 'color' => '#0A2463'],
    ['type' => 'SUV', 'count' => 9478, 'color' => '#1E5EB6'],
    ['type' => 'Coupe', 'count' => 18197, 'color' => '#1D84FF'],
    ['type' => 'Hatchback', 'count' => 12510, 'color' => '#89C2FF'],
    ['type' => 'MPV', 'count' => 14406, 'color' => '#C3DCFF']
];
$totalRentals = array_sum(array_column($topCarRentals, 'count'));

$recentTransactions = [
    [
        'car' => 'Nissan GT - R',
        'type' => 'Sport Car',
        'date' => '20 July',
        'price' => '$80.00',
        'image' => 'nissan-gtr.jpg'
    ],
    [
        'car' => 'Koegnigsegg',
        'type' => 'Sport Car',
        'date' => '19 July',
        'price' => '$99.00',
        'image' => 'koegnigsegg.jpg'
    ],
    [
        'car' => 'Rolls - Royce',
        'type' => 'Sport Car',
        'date' => '18 July',
        'price' => '$96.00',
        'image' => 'rolls-royce.jpg'
    ],
    [
        'car' => 'CR - V',
        'type' => 'SUV',
        'date' => '17 July',
        'price' => '$80.00',
        'image' => 'cr-v.jpg'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Car Rental Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>
<body>
    <div class="dashboard">
        <!-- Left Panel - Rental Details -->
        <div class="left-panel">
            <div class="card">
                <h3>Details Rental</h3>
                <div id="map"></div>
                <div class="car-info">
                    <img src="https://i.imgur.com/ZyTJ2gC.png" alt="Car" />
                    <div class="car-details">
                        <h3>Nissan GT – R</h3>
                        <div style="color: gray;">Sport Car</div>
                        <div style="font-size: small; color: #999;">#9761</div>
                    </div>
                </div>
                <div class="section">
                    <div class="radio-section">🔵 <span>Pick - Up</span></div>
                    <div class="inputs">
                        <select><option>Kota Semarang</option></select>
                        <input type="date" value="2022-07-20" />
                        <input type="time" value="07:00" />
                    </div>
                </div>
                <div class="section">
                    <div class="radio-section">🔘 <span>Drop - Off</span></div>
                    <div class="inputs">
                        <select><option>Kota Semarang</option></select>
                        <input type="date" value="2022-07-21" />
                        <input type="time" value="01:00" />
                    </div>
                </div>
                <div class="price">
                    <div>
                        <p class="top-label">Total Rental Price</p>
                        <p class="sub-label">Overall price and includes rental discount</p>
                    </div>
                    <div>
                        <span style="font-size: 1.6rem;">$80.00</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Panel - Statistics -->
        <div class="right-panel">
            <!-- Top 5 Car Rental Card -->
            <div class="card" style="height:400px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <h3>Top 5 Car Rental</h3>
                <canvas id="carChart" width="1" height="1"></canvas>
                <div class="total">72,030<br><span style="font-size:14px;color:gray;">Rental Car</span></div>
            </div>
            
            <!-- Recent Transaction Card -->
            <div class="card">
                <div class="recent-header">
                    <h2>Recent Transaction</h2>
                    <a href="#" class="view-all">View All</a>
                </div>
                <?php foreach ($recentTransactions as $transaction): ?>
                <div class="transaction">
                    <div class="transaction-car-image">
                        <img src="https://via.placeholder.com/60x40/4285f4/ffffff?text=Car" alt="<?php echo $transaction['car']; ?>">
                    </div>
                    <div class="transaction-details">
                        <div class="transaction-car-name"><?php echo $transaction['car']; ?></div>
                        <div class="transaction-car-type"><?php echo $transaction['type']; ?></div>
                    </div>
                    <div class="transaction-meta">
                        <div class="transaction-date"><?php echo $transaction['date']; ?></div>
                        <div class="transaction-price"><?php echo $transaction['price']; ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('carChart').getContext('2d');
        const carChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Sport Car', 'SUV', 'Coupe', 'Hatchback', 'MPV'],
                datasets: [{
                    data: [17439, 9478, 18197, 12510, 14406],
                    backgroundColor: [
                        '#003f5c',
                        '#2f4b7c',
                        '#665191',
                        '#a05195',
                        '#d45087'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '75%',
                plugins: {
                    legend: {
                        display: true
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    </script>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        const map = L.map('map').setView([-6.9667, 110.4167], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                const userLocation = L.latLng(lat, lng);
                L.marker(userLocation, {
                    icon: L.icon({
                        iconUrl: 'https://cdn-icons-png.flaticon.com/512/64/64113.png',
                        iconSize: [32, 32],
                        iconAnchor: [16, 32]
                    })
                }).addTo(map).bindPopup("Vị trí của bạn").openPopup();

                map.setView(userLocation, 14);
            }, function(error) {
                alert("Không thể lấy vị trí hiện tại: " + error.message);
            });
        } else {
            const pointA = L.latLng(-6.9667, 110.4167);
            const pointB = L.latLng(-6.9567, 110.4267);
            const polyline = L.polyline([pointA, pointB], { color: 'blue' }).addTo(map);
            L.marker(pointB).addTo(map);
            map.fitBounds(polyline.getBounds());
            alert("Trình duyệt không hỗ trợ định vị.");
        }
    </script>
</body>
</html>

<?php
if (isset($_GET['logout'])) {
    unset($_SESSION['Morent_user']);
    echo "<script>location.href='" . admin_url('admin.php?page=Morent_dashboard') . "'</script>";
}
?>
