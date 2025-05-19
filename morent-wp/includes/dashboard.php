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
    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Leaflet Routing Machine CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.min.js"></script>
</head>
<body>
    <div class="dashboard">
        <!-- Left Panel - Rental Details -->
        <div class="left-panel">
            <div class="card">
                <div class="card-header">
                    <h3>Details Rental</h3>
                    <button class="btn btn-outline" id="reset_map">Reset</button>
                </div>
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
                        <input type="text" id="pickup_location"/>
                        <input type="date" value="2022-07-20" />
                        <input type="time" value="07:00" />
                    </div>
                </div>
                <div class="section">
                    <div class="radio-section">🔘 <span>Drop - Off</span></div>
                    <div class="inputs">
                        <input type="text" id="dropoff_location"/>
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
                        <span style="font-size: 1.6rem;" id="total_price">$0.00</span>
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

    <script>
        function getAddress(latlng, callback) {
            const url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latlng.lat}&lon=${latlng.lng}`;
            fetch(url)
                .then(res => res.json())
                .then(data => callback(data.display_name))
        }

        function getAddressPromise(latlng) {
            return fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latlng.lat}&lon=${latlng.lng}`)
                .then(res => res.json())
                .then(data => data.display_name || "Không rõ địa chỉ")
                .catch(() => "Không tìm thấy địa chỉ");
        }


        const defaultLatLng = [21.0285, 105.8542]; // Hà Nội
        const map = L.map('map').setView(defaultLatLng, 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let routingControl = null;
        let clickCount = 0;
        let waypoints = [];
        let markers = [];
        let addresses = []; // ✅ Địa chỉ nơi đi / đến

        map.on('click', function (e) {
            const latlng = e.latlng;

            if (clickCount < 2) {
                waypoints.push(latlng);
                clickCount++;

                if (clickCount === 2) {
                    if (routingControl) {
                        map.removeControl(routingControl);
                    }

                    routingControl = L.Routing.control({
                        waypoints: waypoints,
                        routeWhileDragging: false,
                        showAlternatives: false,
                        addWaypoints: false,
                        language: 'en',
                        createMarker: function (i, wp) {
                            const marker = L.marker(wp.latLng, { draggable: false });
                            const label = i === 0 ? "Nơi đi" : "Nơi đến";

                            // Gọi API lấy địa chỉ
                            getAddress(wp.latLng, function (address) {
                                marker.bindPopup(`${label}<br>${address}`).openPopup();
                            });

                            return marker;
                        }
                    })
                    .on('routesfound', function (e) {
                        const route = e.routes[0];
                        const distance = (route.summary.totalDistance / 1000).toFixed(2);
                        const time = Math.round(route.summary.totalTime / 60);

                        // Lấy địa chỉ sau khi đã có route
                        Promise.all([
                            getAddressPromise(waypoints[0]),
                            getAddressPromise(waypoints[1])
                        ]).then(([addr1, addr2]) => {
                            document.getElementById('pickup_location').value = addr1;
                            document.getElementById('dropoff_location').value = addr2;
                            console.log(
                                `Nơi đi: ${addr1}\n` +
                                `Nơi đến: ${addr2}\n` +
                                `Quãng đường: ${distance} km\n` +
                                `Thời gian dự kiến: ${time} phút`
                            );
                            document.getElementById('total_price').innerText = `$${(time * 0.5).toFixed(2)}`;
                        });
                    })
                    .addTo(map);
                }
            }
        });

        // Nút Reset
        document.getElementById('reset_map').addEventListener('click', function () {
            // Xóa markers
            markers.forEach(marker => map.removeLayer(marker));
            markers = [];

            // Xóa tuyến đường
            if (routingControl) {
                map.removeControl(routingControl);
                routingControl = null;
            }

            // Xóa polyline
            map.eachLayer(function (layer) {
                if (layer instanceof L.Polyline && !(layer instanceof L.Polygon)) {
                    map.removeLayer(layer);
                }
            });

            // Reset biến
            waypoints = [];
            clickCount = 0;
            addresses = [];

            // Đặt lại bản đồ về Hà Nội
            map.setView(defaultLatLng, 13);
        });
    </script>

</body>
</html>
