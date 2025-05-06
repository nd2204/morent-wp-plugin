<?php
/*
Plugin Name: Morent
Description: Plugin Morent cho WordPress.
Version: 1.0
Author: buidinhhuy
*/

if (!defined('ABSPATH')) exit;

// Định nghĩa đường dẫn plugin
define('SM_PLUGIN_DIR', plugin_dir_path(__FILE__));


// Kích hoạt và hủy kích hoạt plugin.
register_activation_hook(__FILE__, 'sm_activate_plugin');
register_deactivation_hook(__FILE__, 'sm_deactivate_plugin');

function sm_activate_plugin() {
    require_once SM_PLUGIN_DIR . 'includes/database.php';
    sm_create_khoa_table();
    sm_create_lop_table();
    sm_create_sinhvien_table();
    sm_create_user_table();
}

function sm_deactivate_plugin() {
    // Tùy chọn: xóa bảng khi hủy kích hoạt.
    require_once SM_PLUGIN_DIR . 'includes/database.php';
    sm_drop_khoa_table();
    sm_drop_lop_table();
    sm_drop_sinhvien_table();
    sm_drop_user_table();
}

// Load style
add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('sm-style', plugin_dir_url(__FILE__) . 'assets/style1.css');
});

// Load các file chức năng
require_once SM_PLUGIN_DIR . 'includes/functions.php';

// Thêm menu admin
add_action('admin_menu', 'sm_register_admin_menu');
function sm_register_admin_menu() {
    add_menu_page('Morent - Trang chủ', 'Dashboard', 'manage_options', 'Morent_dashboard', 'sm_dashboard_page');
    add_submenu_page('Morent_dashboard', 'Car Rent', 'Car Rent', 'manage_options', 'Morent_Car_Rent', 'sm_car_rent_page');
    add_submenu_page('Morent_dashboard', 'Insights', 'Insights', 'manage_options', 'Morent_insights', 'sm_insights_page');
    add_submenu_page('Morent_dashboard', 'Reimburse', 'Reimburse', 'manage_options', 'Morent_reimburse', 'sm_reimburse_page');
}