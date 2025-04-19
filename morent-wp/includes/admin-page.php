<?php
function sm_register_menu() {
  add_menu_page(
    'Quản lý sinh viên',
    'Sinh viên',
    'manage_options',
    'student-management',
    'sm_render_admin_page',
    'dashicons-welcome-learn-more',
    20
  );
}
add_action('admin_menu', 'sm_register_menu');

function sm_render_admin_page() {
  global $wpdb;
  $table_name = $wpdb->prefix . 'students';

  // Thêm, sửa, xóa sinh viên.
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add') {
      $wpdb->insert($table_name, [
        'student_id' => sanitize_text_field($_POST['student_id']),
        'name' => sanitize_text_field($_POST['name']),
        'email' => sanitize_email($_POST['email']),
        'phone' => sanitize_text_field($_POST['phone']),
      ]);
    } elseif ($_POST['action'] === 'delete') {
      $wpdb->delete($table_name, ['id' => intval($_POST['id'])]);
    }
  }

  // Lấy danh sách sinh viên.
  $students = $wpdb->get_results("SELECT * FROM $table_name");

  // Giao diện quản trị.
  ?>
  <div class="wrap">
    <h1>Quản lý sinh viên</h1>
    <form method="POST">
      <input type="hidden" name="action" value="add">
      <table class="form-table">
        <tr>
          <th><label for="student_id">Mã sinh viên</label></th>
          <td><input type="text" name="student_id" required></td>
        </tr>
        <tr>
          <th><label for="name">Họ và tên</label></th>
          <td><input type="text" name="name" required></td>
        </tr>
        <tr>
          <th><label for="email">Email</label></th>
          <td><input type="email" name="email"></td>
        </tr>
        <tr>
          <th><label for="phone">Số điện thoại</label></th>
          <td><input type="text" name="phone"></td>
        </tr>
      </table>
      <button type="submit" class="button button-primary">Thêm sinh viên</button>
    </form>

    <h2>Danh sách sinh viên</h2>
    <table class="wp-list-table widefat fixed striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Mã sinh viên</th>
          <th>Họ và tên</th>
          <th>Email</th>
          <th>Số điện thoại</th>
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($students as $student): ?>
        <tr>
          <td><?php echo $student->id; ?></td>
          <td><?php echo $student->student_id; ?></td>
          <td><?php echo $student->name; ?></td>
          <td><?php echo $student->email; ?></td>
          <td><?php echo $student->phone; ?></td>
          <td>
            <form method="POST" style="display:inline;">
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="id" value="<?php echo $student->id; ?>">
              <button type="submit" class="button button-link-delete">Xóa</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <?php
}
