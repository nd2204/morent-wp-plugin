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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }
        body {
            background-color: #f5f7fa;
            padding: 20px;
            display: flex;
            justify-content: center;
        }
        .dashboard {
            display: flex;
            width: 100%;
            gap: 20px;
            justify-content: center;
        }
        .card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 40px;
            margin-bottom: 20px;
        }
        .left-panel, .right-panel {
            flex: 1;
            display: flex;
        }
        .left-panel {
            justify-content: center;
        }
        .right-panel {
            flex-direction: column;
        }
        h2 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .car-info {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .car-image {
            width: 100px;
            height: 60px;
            background-color: #4285f4;
            border-radius: 10px;
            margin-right: 15px;
            overflow: hidden;
        }
        .car-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .car-details h3 {
            font-size: 18px;
            font-weight: 600;
        }
        .car-details p {
            font-size: 14px;
            color: #6b7280;
        }

        /* Left panel styles */
        
        #map {
            height: 200px;
            border-radius: 12px;
            margin-bottom: 16px;
        }

        .car-info {
            display: flex;
            align-items: center;
            margin-bottom: 16px;
        }

        .car-info img {
            width: 90px;
            height: auto;
            border-radius: 8px;
            margin-right: 16px;
        }

        .car-details h3 {
            margin: 0;
        }

        .section {
            margin-bottom: 16px;
        }

        .section label {
            font-weight: bold;
            display: block;
            margin-bottom: 4px;
        }

        .inputs {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        select, input {
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 6px;
            width: 100%;
        }

        .price {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.4rem;
            font-weight: bold;
            margin-top: 40px;
        }

        .top-label {
            font-size: 1.3rem;
            margin: 0;
        }

        .sub-label {
            font-size: 0.75rem;
            margin: 0;
            font-weight: 100;
            color: #999;
        }

        .radio-section {
            margin-bottom: 10px;
            font-weight: bold;
        }

        .radio-section span {
            margin-left: 8px;
        }
        
        /* Right panel styles */
        .donut-chart {
            position: relative;
            width: 200px;
            height: 200px;
            margin: 0 auto 30px;
        }
        .donut-chart-value {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
        .donut-chart-value h3 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .donut-chart-value p {
            font-size: 14px;
            color: #6b7280;
        }
        .car-type-list {
            margin-bottom: 30px;
        }
        .car-type-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }
        .car-type-indicator {
            display: flex;
            align-items: center;
        }
        .car-type-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .car-type-name {
            font-size: 14px;
            color: #6b7280;
        }
        .car-type-count {
            font-size: 14px;
            font-weight: 500;
        }
        .recent-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .view-all {
            font-size: 14px;
            color: #4285f4;
            text-decoration: none;
        }
        .transaction {
            display: flex;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f3f4f6;
        }
        .transaction:last-child {
            border-bottom: none;
        }
        .transaction-car-image {
            width: 60px;
            height: 40px;
            border-radius: 8px;
            overflow: hidden;
            margin-right: 15px;
            background-color: #f3f4f6;
        }
        .transaction-car-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .transaction-details {
            flex: 1;
        }
        .transaction-car-name {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 4px;
        }
        .transaction-car-type {
            font-size: 12px;
            color: #6b7280;
        }
        .transaction-meta {
            text-align: right;
        }
        .transaction-date {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 4px;
        }
        .transaction-price {
            font-size: 14px;
            font-weight: 600;
        }

        /* SVG Donut Chart */
        .donut-segment {
            fill: none;
            stroke-width: 35;
            stroke-dasharray: 0 100;
            stroke-dashoffset: 25;
            animation: donut-fill 1s ease-in-out forwards;
        }
        @keyframes donut-fill {
            to {
                stroke-dasharray: var(--segment-percent) 100;
            }
        }
        .legend {
            list-style: none;
            padding: 0;
        }
        .legend li {
            display: flex;
            align-items: center;
            margin: 8px 0;
        }
        .legend span {
            width: 12px;
            height: 12px;
            display: inline-block;
            margin-right: 10px;
            border-radius: 50%;
        }
        .total {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            position: absolute;
            bottom: 130px;
        }
    </style>
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
