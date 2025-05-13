<?php
function sm_create_khoa_table() {
    global $wpdb;
    $table_name = 'tblkhoa';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        makhoa INT NOT NULL AUTO_INCREMENT,
        tenkhoa TEXT NOT NULL,
        PRIMARY KEY (makhoa)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}

function sm_create_lop_table() {
    global $wpdb;
    $table_name = 'tbllop';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        malop INT NOT NULL AUTO_INCREMENT,
        makhoa INT NOT NULL,
        tenlop TEXT NOT NULL,
        PRIMARY KEY (malop),
        FOREIGN KEY (makhoa) REFERENCES {$wpdb->prefix}tblkhoa(makhoa) ON DELETE CASCADE ON UPDATE CASCADE
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}

function sm_create_sinhvien_table() {
    global $wpdb;
    $table_name = 'tblsinhvien';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        masv INT NOT NULL AUTO_INCREMENT,
        ho_ten VARCHAR(255) NOT NULL,
        ngay_sinh DATE,
        gioi_tinh ENUM('Nam', 'Nu', 'Khac'),
        que_quan VARCHAR(255),
        email VARCHAR(100) UNIQUE,
        so_dien_thoai VARCHAR(15) UNIQUE,
        malop INT NOT NULL,
        PRIMARY KEY (masv),
        FOREIGN KEY (malop) REFERENCES {$wpdb->prefix}tbllop(malop) ON DELETE CASCADE ON UPDATE CASCADE
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}

function sm_create_user_table() {
    global $wpdb;
    $table_name = 'tbluser';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT NOT NULL AUTO_INCREMENT,
        fullname TEXT NOT NULL,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);

    // Insert default admin user if not exists
    $admin_exists = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE username = 'admin'");
    if ($admin_exists == 0) {
        $wpdb->insert($table_name, [
            'fullname' => 'Admin',
            'username' => 'admin',
            'password' => 'admin123', // Mật khẩu mặc định
        ]);
    }
}

function sm_drop_khoa_table() {
    global $wpdb;
    $table_name = 'tblkhoa';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
}

function sm_drop_lop_table() {
    global $wpdb;
    $table_name = 'tbllop';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
}

function sm_drop_sinhvien_table() {
    global $wpdb;
    $table_name = 'tblsinhvien';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
}

function sm_drop_user_table() {
    global $wpdb;
    $table_name = 'tbluser';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
}

// Call the function to create the table
sm_create_khoa_table();
sm_create_lop_table();
sm_create_sinhvien_table();
sm_create_user_table();