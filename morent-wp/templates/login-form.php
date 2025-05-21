<?php

use OpenAPI\Client\models\LoginRequest;
use OpenAPI\Client\models\AuthResponse;

// Khởi tạo session nếu chưa có
if (!session_id()) session_start();

$client = new MorentApiClient();
$authApi = $client->AuthApi();

// Xử lý khi submit form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sm_login'])) {
    $username = sanitize_text_field($_POST['username']);
    $password = sanitize_text_field($_POST['password']);

    $request = new LoginRequest([
        "login_id" => $username,
        "password" => $password
    ]);

    // get authentication api response

    try {
        $result = $authApi->apiAuthLoginPost($request);
        print_r($result);

        // Đăng nhập thành công, lưu session và chuyển đến dashboard
        $_SESSION['Morent_user'] = $result->getUser()->getUserId();
        echo "<script>location.href='" . admin_url('admin.php?page=morent_menu') . "'</script>";
        update_option('morent_api_access_token', $result->getAccessToken());
        update_option('morent_api_refresh_token', $result->getRefreshToken());
        exit;
    } catch (Exception $e) {
        echo 'Exception when calling AuthApi->apiAuthLoginPost: ', $e->getMessage(), PHP_EOL;
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