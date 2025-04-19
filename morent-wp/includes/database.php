<?php


function sm_init_database() {
  global $wpdb;
  $charset_collate = $wpdb->get_charset_collate();

  sm_create_table(
    $wpdb->prefix . 'tblUser',
    "
    CREATE TABLE $table_name (
      id INT NOT NULL AUTO_INCREMENT,
      student_id VARCHAR(20) NOT NULL,
      name VARCHAR(100) NOT NULL,
      email VARCHAR(100),
      phone VARCHAR(20),
      PRIMARY KEY (id)
    ) $charset_collate; 
    "
  );
}

function sm_create_table($table_name, $sql) {
  global $wpdb;
  require_once ABSPATH . 'wp-admin/includes/upgrade.php';
  dbDelta($sql);
}

function sm_drop_student_table() {
  global $wpdb;
  $table_name = $wpdb->prefix . 'students';
  $wpdb->query("DROP TABLE IF EXISTS $table_name");
}
