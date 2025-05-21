<?php
/*
Plugin Name: morent-wp
Description: Morent admin client for wordpress
Version: 1.0
Author: nd2204
Requires PHP: 8.4
*/
if (!defined('ABSPATH')) exit;

// Định nghĩa đường dẫn plugin
define('MR_DIR', plugin_dir_path(__FILE__));
define('MR_URL', plugin_dir_url(__FILE__));

define('MR_INCLUDE_DIR', MR_DIR . 'includes/');
define('MR_API_CLIENT_DIR', MR_DIR . 'api-client/');
define('MR_TEMPLATES_DIR', MR_DIR . 'templates/');

// Kích hoạt và hủy kích hoạt plugin.
register_activation_hook(__FILE__, 'mr_activate_plugin');
register_deactivation_hook(__FILE__, 'mr_deactivate_plugin');

function mr_activate_plugin() {
}

function mr_deactivate_plugin() {
    // Tùy chọn: xóa bảng khi hủy kích hoạt.
}

function mr_enqueue_style() {
    wp_enqueue_style(
        'mr-style',
        MR_URL. 'assets/css/style.css',
        array(),
        '1.0.0'
    );
}

// Load style
add_action('admin_enqueue_scripts', 'mr_enqueue_style');

// Include Composer autoloader if it exists
if (file_exists(MR_API_CLIENT_DIR . 'vendor/autoload.php')) {
    require_once MR_API_CLIENT_DIR . 'vendor/autoload.php';
} else {
    // Handle the error - maybe add an admin notice about missing dependencies
    add_action('admin_notices', function() {
        echo '<div class="error"><p>' . 
             esc_html__('My API Plugin: Composer dependencies are missing. Please run "composer install" in the plugin directory.', 'my-api-plugin') . 
             '</p></div>';
    });
    return;
}

// Load các file chức năng
require_once MR_INCLUDE_DIR . 'functions.php';

// Thêm menu admin
function mr_register_admin_menu() {
    $menu_slug = "morent_menu";
    $dashboard_callback = get_page_callback("dashboard");
    add_menu_page('Morent - Dashboard', 'Morent', 'manage_options', $menu_slug, $dashboard_callback, 'dashicons-car');
    add_submenu_page($menu_slug, 'Morent - Dashboard', 'Dashboard', 'manage_options', $menu_slug, $dashboard_callback);
    add_submenu_page($menu_slug, 'Morent - Manage Cars', 'Manage Cars', 'manage_options', 'morent_car_rent', get_page_callback("CarRent"));
    add_submenu_page($menu_slug, 'Morent - Insights', 'Insights', 'manage_options', 'morent_insights', get_page_callback('insights'));
    add_submenu_page($menu_slug, 'Morent - Reimburse', 'Reimburse', 'manage_options', 'morent_reimburse', get_page_callback('reimburse'));
}

add_action('admin_menu', 'mr_register_admin_menu');
