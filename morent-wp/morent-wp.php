<?php
/*
Plugin Name: morent-wp
Description: Morent admin client for wordpress
Version: 1.0
Author: nd2204
*/
if (!defined('ABSPATH')) exit;

// Định nghĩa đường dẫn plugin
define('MR_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('MR_PLUGIN_URL', plugin_dir_url(__FILE__));


// Kích hoạt và hủy kích hoạt plugin.
register_activation_hook(__FILE__, 'mr_activate_plugin');
register_deactivation_hook(__FILE__, 'mr_deactivate_plugin');

function mr_activate_plugin() {
}

function mr_deactivate_plugin() {
    // Tùy chọn: xóa bảng khi hủy kích hoạt.
}

// Load style
add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('mr-style', MR_PLUGIN_URL . 'assets/css/style.css');
});

// Load các file chức năng
require_once MR_PLUGIN_DIR . 'includes/functions.php';

// Thêm menu admin
add_action('admin_menu', 'mr_register_admin_menu');
function mr_register_admin_menu() {
    add_menu_page('Morent - Trang chủ', 'Dashboard', 'manage_options', 'Morent_dashboard', 'mr_dashboard_page');
    add_submenu_page('Morent_dashboard', 'Car Rent', 'Car Rent', 'manage_options', 'Morent_Car_Rent', 'mr_car_rent_page');
    add_submenu_page('Morent_dashboard', 'Insights', 'Insights', 'manage_options', 'Morent_insights', 'mr_insights_page');
    add_submenu_page('Morent_dashboard', 'Reimburse', 'Reimburse', 'manage_options', 'Morent_reimburse', 'mr_reimburse_page');
}