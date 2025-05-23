<?php
if (mr_is_logged_in()) {
    echo "<script>location.href='" . admin_url('admin.php?page=morent_login') . "'</script>";
    mr_logout();
    exit;
}
?>