<?php
function mr_dashboard_page() {
    include MR_PLUGIN_DIR . 'includes/dashboard.php';
    // if (!mr_is_logged_in()) {
    //     include MR_PLUGIN_DIR . 'includes/login-form.php';
    // } else {
    // }
}

function mr_is_logged_in() {
    return isset($_SESSION['Morent_user']);
}

add_action('init', function () {
    if (!session_id()) session_start();
});

function mr_car_rent_page() {
    include MR_PLUGIN_DIR . 'includes/CarRent.php';
}

function mr_insights_page() {
    include MR_PLUGIN_DIR . 'includes/insights.php';
}

function mr_reimburse_page() {
    include MR_PLUGIN_DIR . 'includes/reimburse.php';
}
