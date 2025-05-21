<?php
// Database connection would normally go here
// For this example, we'll use hard-coded data

// Sample reimbursement data
$reimbursements = [
    [
        'id' => 1,
        'car' => 'Nissan GT-R',
        'car_img' => 'nissan-gtr.jpg',
        'customer' => 'John Smith',
        'amount' => 35.00,
        'date' => 'Jul 15, 2022',
        'reason' => 'Unexpected fuel charge',
        'status' => 'Approved'
    ],
    [
        'id' => 2,
        'car' => 'Porsche 911',
        'car_img' => 'porsche-911.jpg',
        'customer' => 'Emma Johnson',
        'amount' => 120.00,
        'date' => 'Jul 14, 2022',
        'reason' => 'Maintenance during rental period',
        'status' => 'Pending'
    ],
    [
        'id' => 3,
        'car' => 'Range Rover Sport',
        'car_img' => 'range-rover.jpg',
        'customer' => 'Michael Brown',
        'amount' => 68.50,
        'date' => 'Jul 12, 2022',
        'reason' => 'Unauthorized extension of rental',
        'status' => 'Rejected'
    ],
    [
        'id' => 4,
        'car' => 'Ferrari F8',
        'car_img' => 'ferrari-f8.jpg',
        'customer' => 'Sophia Davis',
        'amount' => 95.20,
        'date' => 'Jul 10, 2022',
        'reason' => 'Incorrect billing amount',
        'status' => 'Approved'
    ],
    [
        'id' => 5,
        'car' => 'Koenigsegg',
        'car_img' => 'koenigsegg.jpg',
        'customer' => 'William Taylor',
        'amount' => 55.75,
        'date' => 'Jul 08, 2022',
        'reason' => 'Additional cleaning charges dispute',
        'status' => 'Pending'
    ],
];
// Sample car options for dropdown
$carOptions = [
    "Toyota Camry",
    "Honda Accord",
    "Ford Fusion",
    "Chevrolet Malibu",
    "Nissan Altima"
];

// Count reimbursements by status
$pending_count = 0;
$approved_count = 0;
$rejected_count = 0;

foreach ($reimbursements as $reimbursement) {
    if ($reimbursement['status'] === 'Pending') {
        $pending_count++;
    } elseif ($reimbursement['status'] === 'Approved') {
        $approved_count++;
    } elseif ($reimbursement['status'] === 'Rejected') {
        $rejected_count++;
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

        <!-- Search Bar -->
        <div class="search-filter">
            <div class="search-bar">
                <input type="text" placeholder="Search by customer or reason...">
            </div>
        </div>

        <!-- Tabs -->
        <div class="tabs">
            <div class="tab <?php echo $active_tab === 'all' ? 'active' : ''; ?>">
                <a href="admin.php?page=Morent_search&tab=all" style="text-decoration: none; color: inherit;">All Requests</a>
            </div>
            <div class="tab <?php echo $active_tab === 'pending' ? 'active' : ''; ?>">
                <a href="admin.php?page=Morent_search&tab=pending" style="text-decoration: none; color: inherit;">Pending</a>
            </div>
            <div class="tab <?php echo $active_tab === 'approved' ? 'active' : ''; ?>">
                <a href="admin.php?page=Morent_search&tab=approved" style="text-decoration: none; color: inherit;">Approved</a>
            </div>
            <div class="tab <?php echo $active_tab === 'rejected' ? 'active' : ''; ?>">
                <a href="admin.php?page=Morent_search&tab=rejected" style="text-decoration: none; color: inherit;">Rejected</a>
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
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reimbursements as $reimbursement): 
                    // Skip if we're filtering by tab
                    if (
                        ($active_tab === 'pending' && $reimbursement['status'] !== 'Pending') ||
                        ($active_tab === 'approved' && $reimbursement['status'] !== 'Approved') ||
                        ($active_tab === 'rejected' && $reimbursement['status'] !== 'Rejected')
                    ) {
                        continue;
                    }
                ?>
                <tr>
                    <td>#<?php echo $reimbursement['id']; ?></td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <img src="<?php echo $reimbursement['car_img']; ?>" alt="<?php echo $reimbursement['car']; ?>" class="car-image">
                            <span class="car-name"><?php echo $reimbursement['car']; ?></span>
                        </div>
                    </td>
                    <td><?php echo $reimbursement['customer']; ?></td>
                    <td>$<?php echo number_format($reimbursement['amount'], 2); ?></td>
                    <td><?php echo $reimbursement['date']; ?></td>
                    <td><?php echo $reimbursement['reason']; ?></td>
                    <td>
                        <span class="status status-<?php echo strtolower($reimbursement['status']); ?>">
                            <?php echo $reimbursement['status']; ?>
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-outline" style="padding: 6px 12px; font-size: 14px;"  id="openViewBtn">View</button>
                        <?php if ($reimbursement['status'] === 'Pending'): ?>
                        <button class="btn btn-success" style="padding: 6px 12px; font-size: 14px;">Approve</button>
                        <button class="btn btn-danger" style="padding: 6px 12px; font-size: 14px;">Reject</button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon icon-pending">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $pending_count; ?></h3>
                    <p>Pending Reimbursements</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon icon-approved">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $approved_count; ?></h3>
                    <p>Approved Reimbursements</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon icon-rejected">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $rejected_count; ?></h3>
                    <p>Rejected Reimbursements</p>
                </div>
            </div>
        </div>
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
                    <label>Reason</label>
                    <p id="viewReason" style="margin: 0; color: #333; background: #f9f9f9; padding: 10px; border-radius: 4px;"></p>
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
                document.getElementById('viewReason').textContent = row.children[5].textContent;
                document.getElementById('viewStatus').textContent = row.children[6].textContent.trim();
                document.getElementById('viewCarId').textContent = `ID: ${row.children[0].textContent}`;
                document.getElementById('viewCarIdValue').textContent = row.children[0].textContent.replace('#', '');
                const status = row.children[6].textContent.trim().toLowerCase();
                const statusElement = document.getElementById('viewStatus');
                statusElement.style.backgroundColor = status === 'approved' ? '#d4edda' : status === 'pending' ? '#fff3cd' : '#f8d7da';
                statusElement.style.color = status === 'approved' ? '#155724' : status === 'pending' ? '#856404' : '#721c24';
                statusElement.textContent = row.children[6].textContent.trim();
                viewModal.style.display = 'flex';
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>