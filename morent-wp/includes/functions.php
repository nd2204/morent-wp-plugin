<?php
function sm_dashboard_page() {
    if (!sm_is_logged_in()) {
        include SM_PLUGIN_DIR . 'includes/login-form.php';
    } else {
        include SM_PLUGIN_DIR . 'includes/dashboard.php';
    }
}

function sm_is_logged_in() {
    return isset($_SESSION['Morent_user']);
}

add_action('init', function () {
    if (!session_id()) session_start();
});

function sm_car_rent_page() {
    include SM_PLUGIN_DIR . 'includes/CarRent.php';
}

function sm_insights_page() {
    include SM_PLUGIN_DIR . 'includes/insights.php';
}

function sm_reimburse_page() {
    include SM_PLUGIN_DIR . 'includes/reimburse.php';
}
