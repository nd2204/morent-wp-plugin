<?php
// Sample data for dashboard
$totalRevenue = 37100;
$revenueTrend = 12.5;
$totalCars = 7;
$carsTrend = 2.2;
$totalRentals = 17;
$rentalsTrend = -2.3;
$userEngagement = 82;
$engagementTrend = 1.1;

// Car categories data
$categoryData = [
    'Sport Car' => 71,
    'SUV' => 29,
    'Coupe' => 0,
    'Hatchback' => 0,
    'MPV' => 0
];

// Car pricing data
$pricingData = [
    'Nissan GT-R' => 80,
    'Porsche 911' => 92,
    'Range Rover Sport' => 98,
    'Ferrari F8' => 120,
    'Koenigsegg' => 98,
    'Rolls-Royce' => 95,
    'CR-V' => 78
];

// Revenue and rentals data for chart (simplified)
$monthlyData = [
    'Jan' => ['revenue' => 4500, 'rentals' => 200],
    'Feb' => ['revenue' => 3500, 'rentals' => 180],
    'Mar' => ['revenue' => 6000, 'rentals' => 320],
    'Apr' => ['revenue' => 3500, 'rentals' => 190],
    'May' => ['revenue' => 2800, 'rentals' => 150],
    'Jun' => ['revenue' => 2700, 'rentals' => 140],
    'Jul' => ['revenue' => 3800, 'rentals' => 200],
    'Aug' => ['revenue' => 4500, 'rentals' => 240],
    'Sep' => ['revenue' => 3200, 'rentals' => 170],
    'Oct' => ['revenue' => 2800, 'rentals' => 150],
    'Nov' => ['revenue' => 3500, 'rentals' => 180],
    'Dec' => ['revenue' => 4300, 'rentals' => 230]
];

// Convert data to JSON for JavaScript
$categoryDataJSON = json_encode($categoryData);
$pricingDataJSON = json_encode($pricingData);
$monthlyDataJSON = json_encode($monthlyData);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insight Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
</head>
<body>
    <div class="header">
        <h1>Insight Dashboard</h1>
        <div class="header-actions">
            <button class="btn btn-outline">
                <i class="fas fa-calendar"></i> Pick a date range
            </button>
            <button class="btn btn-primary">
                <i class="fas fa-download"></i> Export Report
            </button>
        </div>
    </div>

    <div class="card-container">
        <div class="card">
            <p class="card-title">Total Revenue</p>
            <div class="card-value">
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

        <div class="card">
            <p class="card-title">Total Cars</p>
            <div class="card-value">
                <div class="card-icon icon-car">
                    <i class="fas fa-car"></i>
                </div>
                <?php echo $totalCars; ?>
            </div>
            <div class="trend <?php echo $carsTrend >= 0 ? 'trend-up' : 'trend-down'; ?>">
                <?php if ($carsTrend >= 0): ?>
                    <i class="fas fa-arrow-up"></i>
                <?php else: ?>
                    <i class="fas fa-arrow-down"></i>
                <?php endif; ?>
                <?php echo abs($carsTrend); ?>% from last week
            </div>
        </div>

        <div class="card">
            <p class="card-title">Total Rentals</p>
            <div class="card-value">
                <div class="card-icon icon-rental">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <?php echo $totalRentals; ?>
            </div>
            <div class="trend <?php echo $rentalsTrend >= 0 ? 'trend-up' : 'trend-down'; ?>">
                <?php if ($rentalsTrend >= 0): ?>
                    <i class="fas fa-arrow-up"></i>
                <?php else: ?>
                    <i class="fas fa-arrow-down"></i>
                <?php endif; ?>
                <?php echo abs($rentalsTrend); ?>% from last month
            </div>
        </div>

        <div class="card">
            <p class="card-title">User Engagement</p>
            <div class="card-value">
                <div class="card-icon icon-user">
                    <i class="fas fa-users"></i>
                </div>
                <?php echo $userEngagement; ?>%
            </div>
            <div class="trend <?php echo $engagementTrend >= 0 ? 'trend-up' : 'trend-down'; ?>">
                <?php if ($engagementTrend >= 0): ?>
                    <i class="fas fa-arrow-up"></i>
                <?php else: ?>
                    <i class="fas fa-arrow-down"></i>
                <?php endif; ?>
                <?php echo abs($engagementTrend); ?>% from last month
            </div>
        </div>
    </div>

    <div class="content-container">
        <div class="chart-header">
            <div>
                <h2 class="chart-title">Revenue & Rentals Overview</h2>
                <p class="chart-subtitle">Analyze rental performance over time</p>
            </div>
            <div class="chart-filter">
                <select>
                    <option>Monthly</option>
                    <option>Weekly</option>
                    <option>Daily</option>
                </select>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="revenueChart" class="chart-canvas"></canvas>
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

    <div class="chart-grid">
        <div class="content-container">
            <div class="chart-header">
                <div>
                    <h2 class="chart-title">Car Categories Distribution</h2>
                    <p class="chart-subtitle">Breakdown of cars by category</p>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="categoryChart" class="chart-canvas"></canvas>
            </div>
            <div class="legend">
                <?php foreach ($categoryData as $category => $value): ?>
                    <?php if ($value > 0): ?>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: 
                            <?php 
                            switch($category) {
                                case 'Sport Car': echo 'rgba(25, 51, 153, 0.8)'; break;
                                case 'SUV': echo 'rgba(65, 105, 225, 0.8)'; break;
                                case 'Coupe': echo 'rgba(100, 149, 237, 0.8)'; break;
                                case 'Hatchback': echo 'rgba(135, 206, 250, 0.8)'; break;
                                case 'MPV': echo 'rgba(173, 216, 230, 0.8)'; break;
                                default: echo 'rgba(70, 130, 180, 0.8)';
                            }
                            ?>;"></div>
                        <span><?php echo $category; ?>: <?php echo $value; ?>%</span>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="content-container">
            <div class="chart-header">
                <div>
                    <h2 class="chart-title">Car Pricing Analysis</h2>
                    <p class="chart-subtitle">Price comparison by car type</p>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="pricingChart" class="chart-canvas"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Parse data from PHP
        const categoryData = <?php echo $categoryDataJSON; ?>;
        const pricingData = <?php echo $pricingDataJSON; ?>;
        const monthlyData = <?php echo $monthlyDataJSON; ?>;

        // Revenue & Rentals Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: Object.keys(monthlyData),
                datasets: [
                    {
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

        // Car Pricing Chart
        const pricingCtx = document.getElementById('pricingChart').getContext('2d');
        const pricingChart = new Chart(pricingCtx, {
            type: 'bar',
            data: {
                labels: Object.keys(pricingData),
                datasets: [{
                    label: 'Price per day ($)',
                    data: Object.values(pricingData),
                    backgroundColor: 'rgba(25, 51, 153, 0.8)',
                    borderColor: 'rgba(25, 51, 153, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
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
</body>
</html>