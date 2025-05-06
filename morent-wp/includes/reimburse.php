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
            display: inline-block;
        }
        
        .status-approved {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--text-green);
        }
        
        .status-pending {
            background-color: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }
        
        .status-rejected {
            background-color: rgba(239, 68, 68, 0.1);
            color: #ef4444;
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
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-outline {
            background-color: white;
            color: var(--text-dark);
            border: 1px solid var(--border-color);
        }
        
        .btn-success {
            background-color: var(--text-green);
        }
        
        .btn-danger {
            background-color: #ef4444;
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
        
        /* Stats cards */
        .stats-container {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }
        
        .stat-card {
            flex: 1;
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }
        
        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        
        .icon-pending {
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--primary-color);
        }
        
        .icon-approved {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--text-green);
        }
        
        .icon-rejected {
            background-color: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }
        
        .stat-info h3 {
            font-size: 24px;
            margin: 0;
            font-weight: bold;
        }
        
        .stat-info p {
            margin: 5px 0 0;
            color: var(--text-light);
        }
        
        /* Modal details */
        .detail-label {
            color: var(--text-light);
            font-size: 14px;
            margin-bottom: 4px;
        }
        
        .detail-value {
            font-weight: 500;
            margin-bottom: 15px;
        }
        
        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }
    </style>
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
                <button class="btn" id="openModalBtn">
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
                        <a href="admin.php?page=Morent_search&action=view&id=<?php echo $reimbursement['id']; ?>" class="btn btn-outline" style="padding: 6px 12px; font-size: 14px;">View</a>
                        
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
            <p style="margin-bottom: 20px; color: var(--text-light);">Fill in the details for the new reimbursement request.</p>
            
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
    
    <script>
        // JavaScript for modal functionality
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const modal = document.getElementById('newReimbursementModal');
        
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>