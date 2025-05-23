<?php
$adminApi = new MorentApiClient()->AdminApi();

$reimbursements = [];

try {
    $page = 1;
    $page_size = 20;
    $reimbursements = $adminApi->apiAdminRentalsGet($page, $page_size);


    print_r($reimbursements[0]);
} catch (Exception $e) {
    echo 'Rentals Error: ', $e->getMessage(), PHP_EOL;
}

$carOptions = [
    "Toyota Camry",
    "Honda Accord",
    "Ford Fusion",
    "Chevrolet Malibu",
    "Nissan Altima"
];

// Count reimbursements by status
$active_count = 0;
$completed_count = 0;
$cancelled_count = 0;
$reserved_count = 0;

foreach ($reimbursements as $reimbursement) {
    if ($reimbursement['status'] === 'Active') {
        $active_count++;
    } elseif ($reimbursement['status'] === 'Completed') {
        $completed_count++;
    } elseif ($reimbursement['status'] === 'Cancelled') {
        $cancelled_count++;
    } elseif ($reimbursement['status'] === 'Reserved') {
        $reserved_count++;
    }
}

// Handle form submission
$modal = '';
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if ($action === 'new') {
        $modal = 'new-reimbursement';
    } elseif ($action === 'view' && $id !== null) {
        foreach ($reimbursements as $reimbursement) {
            if ($reimbursement['id'] == $id) {
                $view_reimbursement = $reimbursement;
                $modal = 'view-reimbursement';
                break;
            }
        }
    }
}

// Get active tab from query parameters or default to "All Requests"
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'all';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reimbursement Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <!-- Header -->
        <header>
            <h1>Reimbursement Management</h1>
            <div style="display: flex; gap: 10px;">
                <button class="btn btn-outline">
                    <i class="far fa-calendar"></i> Pick a date
                </button>
                <button class="btn btn-primary" id="openModalBtn">
                    <i class="fas fa-plus"></i> New Reimbursement
                </button>
                <button class="btn btn-outline">
                    <i class="fas fa-download"></i> Export
                </button>
            </div>
        </header>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon icon-active">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $active_count; ?></h3>
                    <p>Active Reimbursements</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-completed">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $completed_count; ?></h3>
                    <p>Completed Reimbursements</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-reserved">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $reserved_count; ?></h3>
                    <p>Reserved Reimbursements</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-cancelled">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $cancelled_count; ?></h3>
                    <p>Cancelled Reimbursements</p>
                </div>
            </div>
        </div>

        <!-- Search Bar -->
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


        <!-- Tabs -->
        <div class="tabs" style="margin-top: 20px;">
            <div class="tab <?php echo $active_tab === 'all' ? 'active' : ''; ?>">
                <a href="admin.php?page=morent_reimburse&tab=all" style="text-decoration: none; color: inherit;">All Requests</a>
            </div>
            <div class="tab <?php echo $active_tab === 'active' ? 'active' : ''; ?>">
                <a href="admin.php?page=morent_reimburse&tab=active" style="text-decoration: none; color: inherit;">Active</a>
            </div>
            <div class="tab <?php echo $active_tab === 'completed' ? 'active' : ''; ?>">
                <a href="admin.php?page=morent_reimburse&tab=completed" style="text-decoration: none; color: inherit;">Completed</a>
            </div>
            <div class="tab <?php echo $active_tab === 'cancelled' ? 'active' : ''; ?>">
                <a href="admin.php?page=morent_reimburse&tab=cancelled" style="text-decoration: none; color: inherit;">Cancelled</a>
            </div>
        </div>

        <!-- Table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Car</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reimbursements as $reimbursement):
                    // Skip if we're filtering by tab
                    if (
                        ($active_tab === 'active' && $reimbursement['status'] !== 'Active') ||
                        ($active_tab === 'completed' && $reimbursement['status'] !== 'Completed') ||
                        ($active_tab === 'cancelled' && $reimbursement['status'] !== 'Cancelled')
                    ) {
                        continue;
                    }
                    $pickupDate = new DateTime($reimbursement['pickupDate']);
                    $dropoffDate = new DateTime($reimbursement['dropoffDate']);
                ?>
                    <tr>
                        <td>#<?php echo $reimbursement['id']; ?></td>
                        <td>
                            <div class="cell_flex">
                                <img src="<?php echo $reimbursement->getCar()->getImages()[0]->getUrl(); ?>" alt="<?php echo $reimbursement['car']['title']; ?>" class="car-image">
                                <span class="car-name"><?php echo $reimbursement['car']['title']; ?></span>
                            </div>
                        </td>
                        <td><?php echo $reimbursement['user']['name']; ?></td>
                        <td>$<?php echo number_format($reimbursement['total_cost'], 2); ?></td>
                        <td>
                            <div class="cell_flex">
                                <div>
                                    <p>Pickup Date:</p>
                                    <time class="bold_text" datetime="<?= $pickupDate->format(DATE_ATOM) ?>">
                                        <?= $pickupDate->format('d M Y, H:i') ?>
                                    </time>
                                </div>
                                <div>
                                    <p>Dropoff Date:</p>
                                    <time class="bold_text" datetime="<?= $dropoffDate->format(DATE_ATOM) ?>">
                                        <?= $dropoffDate->format('d M Y, H:i') ?>
                                    </time>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="cell_flex">
                                <div>
                                    <p>Pick up location:</p>
                                    <span class="bold_text">
                                        <?php echo $reimbursement['pickupLocation']['address']; ?>, <?php echo $reimbursement['pickup_location']['city']; ?>
                                    </span>
                                </div>
                                <div>
                                    <p>Drop off location:</p>
                                    <span class="bold_text">
                                        <?php echo $reimbursement['dropoffLocation']['address']; ?>, <?php echo $reimbursement['dropoff_location']['city']; ?>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="status status-<?php echo strtolower($reimbursement['status']); ?>">
                                <?php echo $reimbursement['status']; ?>
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-outline" style="padding: 6px 12px; font-size: 14px;" id="openViewBtn">View</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal for New Reimbursement -->
    <div class="modal-overlay" id="newReimbursementModal">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title">Create New Reimbursement</h3>
                <button class="close-btn" id="closeModalBtn">&times;</button>
            </div>
            <p class="modal-small-header">Fill in the details for the new reimbursement request.</p>

            <form method="POST" action="">
                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="form-label" for="customer">Customer</label>
                    <input type="text" class="form-control" id="customer" name="customer" placeholder="Customer Name" required>
                </div>
                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="form-label" for="customer">Car</label>
                    <select class="form-control" id="category" name="category">
                        <option value="Sport Car">Sport Car</option>
                        <option value="SUV">SUV</option>
                        <option value="Sedan">Sedan</option>
                        <option value="Luxury Car">Luxury Car</option>
                        <option value="Compact">Compact</option>
                    </select>
                </div>
                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="form-label" for="customer">Amount</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="0.00" min="0" step="0.01" required>
                </div>
                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="form-label" for="customer">Reason</label>
                    <input type="text" class="form-control" id="customer" name="customer" placeholder="Customer Name" required>
                </div>

                <button type="submit" class="submit-btn" name="add_car">
                    Create Request
                </button>
            </form>
        </div>
    </div>

    <!-- Modal for View Reimbursement -->
    <div class="modal-overlay" id="viewReimbursementModal">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title">Reimbursement Details</h3>
                <button class="close-btn closeViewModalBtn">&times;</button>
            </div>
            <p class="modal-small-header">Complete information about the reimbursement request.</p>
            <div class="image-row">
                <img id="viewCarImg" src="" alt="Car Image">
                <div>
                    <h4 id="viewCar" style="margin: 0; font-size: 16px; font-weight: bold;"></h4>
                    <p id="viewCarId" style="margin: 0; color: #666; font-size: 14px;">ID: #</p>
                    <span id="viewStatus" style="display: inline-block; margin-top: 5px; padding: 5px 10px; border-radius: 12px; font-size: 12px; font-weight: bold;"></span>
                </div>
            </div>
            <div class="detail-row">
                <div>
                    <label>Customer</label>
                    <p id="viewCustomer" style="margin: 0"></p>
                </div>
                <div>
                    <label>Amount</label>
                    <p id="viewAmount" style="margin: 0"></p>
                </div>
            </div>
            <div class="detail-row">
                <div>
                    <label>Date Submitted</label>
                    <p id="viewDate" style="margin: 0; color: #333;"></p>
                </div>
                <div>
                    <label>Car ID</label>
                    <p id="viewCarIdValue" style="margin: 0; color: #333;"></p>
                </div>
            </div>
            <div class="detail-row">
                <div>
                    <label>Location</label>
                    <p id="viewLocation" style="margin: 0; color: #333; background: #f9f9f9; padding: 10px; border-radius: 4px;"></p>
                </div>
            </div>
            <div class="modal-footer" style="margin-top: 20px; display: flex; justify-content: flex-end;">
                <button class="btn btn-primary closeViewModalBtn">Close</button>
            </div>
        </div>
    </div>

    <script>
        // JavaScript for modal functionality
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const modal = document.getElementById('newReimbursementModal');
        const viewModal = document.getElementById('viewReimbursementModal');
        const closeViewModalBtn = document.getElementsByClassName('closeViewModalBtn');

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

        Array.from(closeViewModalBtn).forEach(function(button) {
            button.addEventListener('click', function() {
                viewModal.style.display = 'none';
            });
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
            if (event.target === viewModal) {
                viewModal.style.display = 'none';
            }
        });

        // Handle "View" button click
        document.querySelectorAll('.btn-outline[id="openViewBtn"]').forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                document.getElementById('viewCar').textContent = row.querySelector('.car-name').textContent;
                document.getElementById('viewCarImg').src = row.querySelector('img').src;
                document.getElementById('viewCustomer').textContent = row.children[2].textContent;
                document.getElementById('viewAmount').textContent = row.children[3].textContent;
                document.getElementById('viewDate').textContent = row.children[4].textContent;
                document.getElementById('viewLocation').textContent = row.children[5].textContent;
                document.getElementById('viewStatus').textContent = row.children[6].textContent.trim();
                document.getElementById('viewCarId').textContent = `ID: ${row.children[0].textContent}`;
                document.getElementById('viewCarIdValue').textContent = row.children[0].textContent.replace('#', '');
                const status = row.children[6].textContent.trim().toLowerCase();
                const statusElement = document.getElementById('viewStatus');
                statusElement.className = `status status-${status}`;
                viewModal.style.display = 'flex';
            });
        });

        // Search functionality
        const searchInput = document.getElementById('query');
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                let found = false;

                cells.forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(query)) {
                        found = true;
                    }
                });

                if (found) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>