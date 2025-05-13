<?php
// Khởi tạo session nếu chưa có
if (!session_id()) session_start();

// Xử lý khi submit form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sm_login'])) {
    global $wpdb;
    $username = sanitize_text_field($_POST['username']);
    $password = sanitize_text_field($_POST['password']);

    // Truy vấn user trong bảng tbluser
    $table = 'tbluser';
    $user = $wpdb->get_row("SELECT * FROM $table WHERE username = '$username'");

    // So sánh mật khẩu không mã hóa
    if ($user && $password === $user->password) {
        // Đăng nhập thành công, lưu session và chuyển đến dashboard
        $_SESSION['Morent_user'] = $user;
        echo "<script>location.href='" . admin_url('admin.php?page=Morent_dashboard') . "'</script>";
        exit;
    } else {
        // Sai thông tin
        echo "<div class='sm-login-error'>Sai tài khoản hoặc mật khẩu!</div>";
    }
}
?>

<div class="sm-login-container">
    <form method="post" class="sm-login-form">
        <h2>Đăng nhập hệ thống Morent</h2>
        <input type="text" name="username" placeholder="Tên đăng nhập" required>
        <input type="password" name="password" placeholder="Mật khẩu" required>
        <button type="submit" name="sm_login">Đăng nhập</button>
    </form>
</div>
