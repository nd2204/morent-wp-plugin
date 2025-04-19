<?php
/*
Plugin Name: morent-wp
Description: Morent admin client for wordpress
Version: 1.0
Author: nd2204
*/

if (!defined('ABSPATH')) {
    exit; // Ngăn truy cập trực tiếp.
}

// Định nghĩa đường dẫn plugin.
define('SM_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Kích hoạt và hủy kích hoạt plugin.
register_activation_hook(__FILE__, 'sm_activate_plugin');
register_deactivation_hook(__FILE__, 'sm_deactivate_plugin');

function sm_activate_plugin() {
    require_once SM_PLUGIN_DIR . 'includes/database.php';
    sm_init_database();
}

function sm_deactivate_plugin() {
    // Tùy chọn: xóa bảng khi hủy kích hoạt.
    require_once SM_PLUGIN_DIR . 'includes/database.php';
    sm_drop_student_table();
}

// Load admin page.
if (is_admin()) {
    require_once SM_PLUGIN_DIR . 'includes/admin-page.php';
}

/**
 * Thêm phần hiển thị FE
 */
// Đăng ký shortcode
add_shortcode('student_list', 'msp_student_list_shortcode');

// Hàm xử lý shortcode
function msp_student_list_shortcode() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'students';

    // Lấy danh sách sinh viên từ cơ sở dữ liệu
    $students = $wpdb->get_results("SELECT * FROM $table_name");

    // Tạo HTML hiển thị danh sách
    $output = '<div class="student-list">';
    $output .= '<h2>Danh sách Sinh viên</h2>';
    $output .= '<table style="width: 100%; border-collapse: collapse;">';
    $output .= '<thead>
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px;">ID</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Mã SV</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Họ và Tên</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Email</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">SĐT</th>
                    </tr>
                </thead>';
    $output .= '<tbody>';

    // Lặp qua danh sách sinh viên
    foreach ($students as $student) {
        $output .= "<tr>
                        <td style='border: 1px solid #ddd; padding: 8px;'>{$student->id}</td>
                        <td style='border: 1px solid #ddd; padding: 8px;'>{$student->student_id}</td>
                        <td style='border: 1px solid #ddd; padding: 8px;'>{$student->name}</td>
                        <td style='border: 1px solid #ddd; padding: 8px;'>{$student->email}</td>
                        <td style='border: 1px solid #ddd; padding: 8px;'>{$student->phone}</td>
                    </tr>";
    }

    $output .= '</tbody></table>';
    $output .= '</div>';

    // Trả về HTML
    return $output;
}

// Đăng ký CSS cho frontend
add_action('wp_enqueue_scripts', 'msp_enqueue_styles');
function msp_enqueue_styles() {
    wp_enqueue_style('msp-styles', plugin_dir_url(__FILE__) . 'assets/style.css');
}

