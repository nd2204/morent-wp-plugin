<?php

$carApi = new MorentApiClient()->carApi();
$adminApi = new MorentApiClient()->AdminApi();

$carList = [];
$rentals = [];

$rental_labels = [];

$totalRentals = count($rentals);

$completedRentals = 0;
$cancelledRentals = 0;
$activeRentals = 0;

$totalRevenue = 0.0;
$currency = 'USD'; // Assume same currency for all

$colors = [
    '#102E7A',
    '#1A4393',
    '#2A60B7',
    '#3D81DB',
    '#54A6FF'
];

try {
    $carList = $carApi->apiCarsGet(null, null, null, null, null, null, null, null, null, null, null, null, null, 1, 1000);
} catch (Exception $e) {
    echo 'Exception when calling CarApi->apiCarsGet: ', $e->getMessage(), PHP_EOL;
}


try {
    $rentals = $adminApi->apiAdminRentalsGet(1, 100);

    $totalRentals = count($rentals);

    $top5 = array_slice(getCarTypesCount($rentals, function ($item) {
        return $item->getCar()->getCarModel()->getType();
    }), 0, 5, true);

    foreach ($rentals as $rental) {
        $status = $rental->getStatus();
        // $userId = $rental->getUser()->getUserId();
        $totalRevenue += $rental->getTotalCost();
        // $rental_labels += $rental->getCar()->getCarModel()->getType();

        if ($status === 'Completed') {
            $completedRentals++;
            $totalRevenue += $cost;
        } elseif ($status === 'Cancelled') {
            $cancelledRentals++;
        } else {
            $activeRentals++;
        }

        // if (!isset($userRentalCounts[$userId])) {
        //     $userRentalCounts[$userId] = 0;
        // }
        // $userRentalCounts[$userId]++;
    }
} catch (Exception $e) {
    echo 'Rentals Error: ', $e->getMessage(), PHP_EOL;
}

$view = $_GET['view'] ?? 'monthly';
switch ($view) {
    case 'daily':
        $data = summarizeDailyRentals($rentals);
        break;
    case 'weekly':
        $data = summarizeWeeklyRentals($rentals);
        break;
    default:
        $data = summarizeMonthlyRentals($rentals);
        break;
}

$categoryData = array_slice(getCarTypesCount($carList, function ($item) {
    return $item->getCarModel()->getType();
}), 0, 5, true);
$categoryDataJSON = json_encode($categoryData);
$monthlyDataJSON = json_encode($data);
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <style>
    </style>
</head>

<body>
    <div class="dashboard">
        <div id="map"></div>
        <div class="dashboard__blur-overlay"></div>
        <div class="dashboard__content">

            <div class="dashboard__content--row">

                <div class="dashboard__card">
                    <p class="dashboard__card__title">Total Rentals</p>
                    <div class="dashboard__card__value">
                        <div class="dashboard__card__icon icon-rental">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div>
                            <?php echo $totalRentals; ?> Rentals
                        </div>
                    </div>
                    <div class="rental-status-row">
                        <div class="status-box cancelled">
                            <i class="fas fa-times-circle"></i>
                            <span><?php echo $cancelledRentals; ?></span>
                        </div>
                        <div class="status-box completed">
                            <i class="fas fa-check-circle"></i>
                            <span><?php echo $completedRentals; ?></span>
                        </div>
                        <div class="status-box active">
                            <i class="fas fa-spinner"></i>
                            <span><?php echo $activeRentals; ?></span>
                        </div>
                    </div>
                </div>

                <div class="dashboard__card">
                    <p class="dashboard__card__title">Total Cars</p>
                    <div class="card-value">
                        <div class="dashboard__card__icon icon-car">
                            <i class="fas fa-car"></i>
                        </div>
                        <?php echo count($carList); ?> Cars
                    </div>
                </div>

                <div class="dashboard__card">
                    <p class="dashboard__card__title">Total Revenue</p>
                    <div class="dashboard__card__value">
                        <div class="card-icon icon-money">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        $<?php echo number_format($totalRevenue); ?>
                    </div>
                    <div class="trend <?php echo $revenueTrend >= 0 ? 'trend-up' : 'trend-down'; ?>">
                        <?php if ($revenueTrend >= 0): ?>
                            <i class="fas fa-arrow-up"></i>
                        <?php else: ?>
                            <i class="fas fa-arrow-down"></i>
                        <?php endif; ?>
                        <?php echo abs($revenueTrend); ?>% from last month
                    </div>
                </div>
            </div>


            <div class="dashboard__content--row" style="flex: 1;">
                <div class="dashboard__card" style="display: flex; flex-direction: column;">
                    <div class="chart-header">
                        <div>
                            <h2 class="chart-title">Revenue & Rentals Overview</h2>
                            <p class="chart-subtitle">Analyze rental performance over time</p>
                        </div>
                        <div class="chart-filter">
                            <select id="timeViewSelect">
                                <option value="monthly" <?= $view === 'monthly' ? 'selected' : '' ?>>Monthly</option>
                                <option value="weekly" <?= $view === 'weekly' ? 'selected' : '' ?>>Weekly</option>
                                <option value="daily" <?= $view === 'daily' ? 'selected' : '' ?>>Daily</option>
                            </select>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="revenueChart"></canvas>
                    </div>
                    <div class="legend">
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: rgba(67, 97, 238, 0.7);"></div>
                            <span>Revenue ($)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: rgba(114, 9, 183, 0.5);"></div>
                            <span>Rentals</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dashboard__content--row">
                <div class="dashboard__card">
                    <h3>Top 5 Car Rental</h3>
                    <div style="height: 200px;" style="position: relative;">
                        <canvas id="carChart" width="300" height="300"></canvas>
                        <div class="chart__total"><?php echo $totalRentals ?><br><span style="font-size:14px;color:gray;">Rental Car</span></div>
                    </div>
                    <ul class="legend" style="flex-wrap: wrap;">
                        <?php
                        $index = 0;
                        foreach ($top5 as $type => $count) { ?>
                            <div class="legend-item">
                                <div class="legend-color" style="background:<?php echo $colors[$index] ?>;"></div> <?php echo "$type $count" ?>
                            </div>
                        <?php
                            $index++;
                        }
                        ?>
                    </ul>
                </div>

                <div class="dashboard__card">
                    <div class="chart-header">
                        <div>
                            <h2 class="chart-title">Car Categories Distribution</h2>
                        </div>
                    </div>
                    <div style="height: 200px">
                        <canvas id="categoryChart" class="chart-canvas"></canvas>
                    </div>
                    <div class="legend">
                        <?php foreach ($categoryData as $category => $value): ?>
                            <?php if ($value > 0): ?>
                                <div class="legend-item">
                                    <div class="legend-color" style="background-color: 
                            <?php
                                switch ($category) {
                                    case 'Sport Car':
                                        echo 'rgba(25, 51, 153, 0.8)';
                                        break;
                                    case 'SUV':
                                        echo 'rgba(65, 105, 225, 0.8)';
                                        break;
                                    case 'Coupe':
                                        echo 'rgba(100, 149, 237, 0.8)';
                                        break;
                                    case 'Hatchback':
                                        echo 'rgba(135, 206, 250, 0.8)';
                                        break;
                                    case 'MPV':
                                        echo 'rgba(173, 216, 230, 0.8)';
                                        break;
                                    default:
                                        echo 'rgba(70, 130, 180, 0.8)';
                                }
                            ?>;"></div>
                                    <span><?php echo $category; ?>: <?php echo $value; ?>%</span>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('carChart').getContext('2d');
        const carChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [
                    <?php
                    $lastIndex = count($top5) - 1;
                    foreach (array_keys($top5) as $i => $type) {
                        echo "'$type'";
                        if ($i != $lastIndex)
                            echo ',';
                    }
                    ?>
                ],
                datasets: [{
                    data: [
                        <?php
                        $lastIndex = count($top5) - 1;
                        foreach (array_values($top5) as $i => $count) {
                            echo "$count";
                            if ($i != $lastIndex)
                                echo ',';
                        }
                        ?>
                    ],
                    backgroundColor: [
                        <?php
                        $lastIndex = count($colors) - 1;
                        foreach ($colors as $i => $color) {
                            echo "'$color'";
                            if ($i != $lastIndex)
                                echo ',';
                        }
                        ?>
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

        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager_labels_under/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
            subdomains: 'abcd',
            maxZoom: 20
        }).addTo(map);

        const cars = <?php echo json_encode($carList); ?>;

        cars.forEach(car => {
            const lat = car.location.latitude;
            const lng = car.location.longitude;

            if (lat && lng) {
                L.marker([lat, lng])
                    .addTo(map)
                    .bindPopup(`<strong>${car.name}</strong><br>${car.model}`);
            }
        });

        if (cars.length > 0) {
            const first = cars[0].location;
            map.setView([first.latitude, first.longitude - 0.01], 15); // focus on first car
        }

        let routingControl = null;
        let clickCount = 0;
        let waypoints = [];
        let markers = [];
        let addresses = []; // ✅ Địa chỉ nơi đi / đến

        map.on('click', function(e) {
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
                            createMarker: function(i, wp) {
                                const marker = L.marker(wp.latLng, {
                                    draggable: false
                                });
                                const label = i === 0 ? "Nơi đi" : "Nơi đến";

                                // Gọi API lấy địa chỉ
                                getAddress(wp.latLng, function(address) {
                                    marker.bindPopup(`${label}<br>${address}`).openPopup();
                                });

                                return marker;
                            }
                        })
                        .on('routesfound', function(e) {
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
        document.getElementById('reset_map').addEventListener('click', function() {
            // Xóa markers
            markers.forEach(marker => map.removeLayer(marker));
            markers = [];

            // Xóa tuyến đường
            if (routingControl) {
                map.removeControl(routingControl);
                routingControl = null;
            }

            // Xóa polyline
            map.eachLayer(function(layer) {
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

    <script>
        document.getElementById('timeViewSelect').addEventListener('change', function() {
            const selected = this.value;
            const url = new URL(window.location.href);
            url.searchParams.set('view', selected);
            window.location.href = url.toString();
        });

        // Parse data from PHP
        const monthlyData = <?php echo $monthlyDataJSON; ?>;

        // Revenue & Rentals Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: Object.keys(monthlyData),
                datasets: [{
                        label: 'Revenue',
                        data: Object.values(monthlyData).map(item => item.revenue),
                        borderColor: 'rgba(67, 97, 238, 1)',
                        backgroundColor: 'rgba(67, 97, 238, 0.2)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Rentals',
                        data: Object.values(monthlyData).map(item => item.rentals),
                        borderColor: 'rgba(114, 9, 183, 1)',
                        backgroundColor: 'rgba(114, 9, 183, 0.2)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        position: 'left',
                        beginAtZero: true,
                        title: {
                            display: false,
                            text: 'Revenue ($)'
                        },
                        grid: {
                            drawBorder: false
                        }
                    },
                    y1: {
                        position: 'right',
                        beginAtZero: true,
                        title: {
                            display: false,
                            text: 'Rentals'
                        },
                        grid: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
    <script>
        const categoryData = <?php echo $categoryDataJSON; ?>;
        // Car Categories Chart
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        const categoryChart = new Chart(categoryCtx, {
            type: 'pie',
            data: {
                labels: Object.keys(categoryData),
                datasets: [{
                    data: Object.values(categoryData),
                    backgroundColor: [
                        'rgba(25, 51, 153, 0.8)',
                        'rgba(65, 105, 225, 0.8)',
                        'rgba(100, 149, 237, 0.8)',
                        'rgba(135, 206, 250, 0.8)',
                        'rgba(173, 216, 230, 0.8)'
                    ],
                    borderColor: 'white',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.raw}%`;
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>