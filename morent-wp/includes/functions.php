<?php

require_once MR_INCLUDE_DIR . 'api-client.php';

function mr_is_logged_in() {
    return isset($_SESSION['Morent_user']);
}

add_action('init', function () {
    if (!session_id()) session_start();
});

function get_page_callback($filename) {
    return function () use ($filename) {
        if (!mr_is_logged_in()) {
            include MR_TEMPLATES_DIR . 'login-form.php';
        } else {
            $path = MR_TEMPLATES_DIR . $filename . '.php';
            if (file_exists($path)) {
                include $path;
            } else {
                echo "<div class='notice notice-error'><p>File not found: {$filename}.php</p></div>";
            }
        }
    };
}

// function mr_car_rent_page() {
//     include MR_TEDIR . 'CarRent.php';
// }

// function mr_insights_page() {
//     include MR_DIR . 'insights.php';
// }

// function mr_reimburse_page() {
//     include MR_DIR . 'reimburse.php';
// }
