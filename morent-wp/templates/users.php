<?php

use OpenAPI\Client\models\RegisterUserCommand;

$adminApi = new MorentApiClient()->AdminApi();
$authApi = new MorentApiClient()->AuthApi();
$users = [];

if (isset($_POST['add_user'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $images = explode(',', $_POST['images']);
    // $role = $_POST['role'];

    try {
        $register_request = new RegisterUserCommand([
            "name" => $name,
            "username" => $name,
            "email" => $email,
            "password" => $password
        ]);
        $response = $authApi->apiAuthRegisterPost($register_request);

        echo "<script>alert('User added successfully!');</script>";
    } catch (Exception $e) {
        echo "<script>alert('Error adding user: " . htmlspecialchars($e->getMessage()) . "');</script>";
    }
}
$user_id = null;
if (isset($_POST['delete_user'])) {
    $user_id = $_POST['delete_user'];

    try {
        // $response = $authApi->apiAdminUsersIdDelete($register_request);
        echo "<script>alert('User deleted successfully!');</script>";
    } catch (Exception $e) {
        echo "<script>alert('Error deleting user: " . htmlspecialchars($e->getMessage()) . "');</script>";
    }
}

try {
    $page = 1;
    $page_size = 20;

    $result = $adminApi->apiAdminUsersGet($page, $page_size);
    print_r($result);
    $users = $result;
    unset($users[1]);
} catch (Exception $e) {
    echo 'Exception when calling AdminApi->apiAdminUsersGet: ', $e->getMessage(), PHP_EOL;
}


?>
<div class="container">
    <!-- Header -->
    <header>
        <h1>User Management</h1>
        <div style="display: flex; gap: 10px;">
            <button class="btn btn-primary" id="openModalBtn">
                <i class="fas fa-plus"></i> Add User
            </button>
        </div>
    </header>

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

    <!-- Table Container -->
    <div class="table-container" style="margin-top: 30px;">
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox" class="checkbox" id="selectAll"></th>
                    <th>Name</th>
                    <!-- <th>User Role</th> -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                <?php
                foreach ($users as $user): ?>
                    <tr>
                        <td><input type="checkbox" class="checkbox" value="<?php echo $user['id']; ?>"></td>
                        <td>
                            <div class="user-info">
                                <img src="<?php echo $user['image_url']; ?>" alt="<?php echo $user['name']; ?>" class="user-avatar">
                                <div class="user-details">
                                    <h4><?php echo htmlspecialchars($user['name']); ?></h4>
                                    <p><?php echo htmlspecialchars($user['email']); ?></p>
                                </div>
                                <?php if ($user['status'] === 'Not Logged in'): ?>
                                    <span class="status-badge status-offline">Not Logged in</span>
                                <?php endif; ?>
                            </div>
                        </td>
                        <!-- <td>
                      <div class="role-badges">
                          <?php foreach ($user['roles'] as $role): ?>
                              <span class="badge badge-<?php echo strtolower($role); ?>">
                                  <?php echo $role; ?>
                              </span>
                          <?php endforeach; ?>
                      </div>
                  </td> -->
                        <td>
                            <div class="actions">
                                <!-- <button class="action-btn" onclick="modifyRoles(<?php echo $user['id']; ?>)">
                              <i class="fa-solid fa-gear"></i> Modify Roles
                          </button> -->
                                <form method="post" action="">
                                    <input type="hidden" name="delete_user" value="<?php echo $user['id']; ?>">
                                    <button type="button" class="action-btn delete-action">
                                        <i class="fa-solid fa-trash"></i> Remove User
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <!-- <div class="pagination">
          <div class="pagination-controls">
              <button class="page-btn">First</button>
              <button class="page-btn">‹</button>
              <button class="page-btn">10</button>
              <button class="page-btn active">11</button>
              <button class="page-btn">...</button>
              <button class="page-btn">25</button>
              <button class="page-btn">26</button>
              <button class="page-btn">›</button>
              <button class="page-btn">Last</button>
          </div>
      </div> -->
    </div>
</div>

<!-- Add New User Modal -->
<div class="modal-overlay" id="addUserModal">
    <div class="modal">
        <div class="modal-header">
            <h3 class="modal-title">Add New User</h3>
            <button class="close-btn" id="closeUserModalBtn">&times;</button>
        </div>
        <p style="margin-bottom: 20px; color: var(--text-light);">Fill in the details of the new user to add to your fleet.</p>

        <form method="POST" action="">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Ikienkinzero" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="example@gmail.com" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="images">Image URLs</label>
                    <input type="text" class="form-control" id="images" name="images" placeholder="Comma-separated URLs" required>
                    <small class="form-text">Separate multiple image URLs with commas</small>
                </div>
            </div>

            <!-- <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="role">Role</label>
                    <input type="text" class="form-control" id="role" name="role" placeholder="Admin" required>
                </div>
            </div> -->

            <button type="submit" class="submit-btn" name="add_user">
                <span>✓</span> Add User
            </button>
        </form>
    </div>
</div>

<script>
    document.getElementById('openModalBtn').addEventListener('click', function() {
        document.getElementById('addUserModal').style.display = 'flex';
    });

    document.getElementById('closeUserModalBtn').addEventListener('click', function() {
        document.getElementById('addUserModal').style.display = 'none';
    });

    // Close modal when clicking outside of it
    window.addEventListener('click', function(event) {
        if (event.target == document.getElementById('addUserModal')) {
            document.getElementById('addUserModal').style.display = 'none';
        }
    });

    // Search functionality
    document.getElementById('query').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        const rows = document.querySelectorAll('#userTableBody tr');

        rows.forEach(row => {
            const name = row.querySelector('h4').textContent.toLowerCase();
            const email = row.querySelector('p').textContent.toLowerCase();

            if (name.includes(query) || email.includes(query)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    const deleteActions = document.querySelectorAll('.delete-action');
    deleteActions.forEach(action => {
        action.addEventListener('click', function(event) {
            event.preventDefault();
            const userId = this.closest('form').querySelector('input[name="delete_user"]').value;
            if (confirm('Are you sure you want to delete this user?')) {
                this.closest('form').submit();
            }
        });
    });
</script>