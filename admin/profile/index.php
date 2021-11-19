<?php include '../layout/header.php' ?>

<?php 

$error_info = "";
$error_pass = "";
if (isset($_POST['profile_info'])) {
  $username = isset($_POST['username']) ? $_POST['username'] : '';
  $hoten = isset($_POST['hoten']) ? $_POST['hoten'] : '';
  $diachi = isset($_POST['diachi']) ? $_POST['diachi'] : '';
  $sodienthoai = isset($_POST['sodienthoai']) ? $_POST['sodienthoai'] : '';

  if ($username == "" || $hoten == "" || $diachi == "" || $sodienthoai == "") {
    $error_info = "Vui lòng nhập đủ thông tin trước khi cập nhật";
  } else {
    $db->query("UPDATE user SET username = '" . $username . "' WHERE id = " . $_SESSION['user']['dangnhap']['id']);
    $db->query("UPDATE nhanvien SET HoTenNV = '" . $hoten . "', DiaChi = '" . $diachi . "', SoDienThoai = '" . $sodienthoai . "' WHERE MSNV = " . $_SESSION['user']['nhanvien']['MSNV']);
  }
}

if (isset($_POST['profile_change_password'])) {
  $password = isset($_POST['password']) ? $_POST['password'] : '';
  $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : '';
  $re_new_password = isset($_POST['re_new_password']) ? $_POST['re_new_password'] : '';

  $password = md5($password);
  $check = $db->query("SELECT * FROM user WHERE id = " . $_SESSION['user']['dangnhap']['id'] . " AND password = '" . $password . "'");
  if ($check->num_rows == 0) {
    $error_pass = "Mật khẩu cũ không chính xác";
  }

  if ($new_password != $re_new_password) {
    $error_pass = "Xác thực mật khẩu mới không chính xác";
  }

  if (empty($error_pass)) {
    $new_password = md5($new_password);
    $db->query("UPDATE user SET password = '" . $new_password . "' WHERE id = " . $_SESSION['user']['dangnhap']['id']);
  }

}

$profile = $db->query("SELECT * FROM nhanvien WHERE MSNV = " . $_SESSION['user']['nhanvien']['MSNV'])->fetch_assoc();
$user = $db->query("SELECT * FROM user WHERE id = " . $_SESSION['user']['dangnhap']['id'])->fetch_assoc();

?>

<div class="layout">
  <div class="layout-left">
    <div class="profile-sidebar">
      <?php include '../layout/sidebar.php' ?>
    </div>
  </div>
  <div class="layout-right">
    <?php include '../layout/header-top.php' ?>
    <div class="layout-right-relative">
      <div class="layout-right-absolute mt-3">
        <div class="profile">
          <div class="row">
              <div class="col-md-6">
                <h4>Cập nhật thông tin cá nhân</h4>
                <form action="./index.php" method="POST" class="mt-3">
                  <div class="text-danger"><?php echo  $error_info ?></div>
                  <input type="hidden" value="1" name="profile_info">

                  <div class="form-group">
                    <label for="">Tên đăng nhập <span class="text-danger">*</span></label>
                    <input type="text" name="username" class="form-control"  value="<?php echo $user['username'] ?>" required>
                  </div>

                  <div class="form-group">
                    <label for="">Họ tên <span class="text-danger">*</span></label>
                    <input type="text" name="hoten" class="form-control" value="<?php echo $profile['HoTenNV'] ?>" required>
                  </div>

                  <div class="form-group">
                    <label for="">Địa chỉ <span class="text-danger">*</span></label>
                    <input type="text" name="diachi" class="form-control" value="<?php echo $profile['DiaChi'] ?>" required>
                  </div>

                  <div class="form-group">
                    <label for="">Số điện thoại <span class="text-danger">*</span></label>
                    <input type="text" name="sodienthoai" class="form-control" value="<?php echo $profile['SoDienThoai'] ?>" required>
                  </div>

                  <div class="form-group">
                    <button class="btn btn-info btn-sm rounded-0">Thêm/Cập nhật</button>
                  </div>
                </form>
              </div>

              <div class="col-md-6">
                <h4>Đổi mật khẩu</h4>
                <form action="./index.php" method="POST" class="mt-3">
                  <div class="text-danger"><?php echo  $error_pass ?></div>
                  <input type="hidden" value="1" name="profile_change_password">

                  <div class="form-group">
                    <label for="">Mật khẩu cũ <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control" required>
                  </div>

                  <div class="form-group">
                    <label for="">Mật khẩu mới <span class="text-danger">*</span></label>
                    <input type="password" name="new_password" class="form-control" required>
                  </div>

                  <div class="form-group">
                    <label for="">Xác nhận mật khẩu mới <span class="text-danger">*</span></label>
                    <input type="password" name="re_new_password" class="form-control" required>
                  </div>

                  <div class="form-group">
                    <button class="btn btn-info btn-sm rounded-0">Đổi mật khẩu</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>  
    </div>
  </div>
</div>


<?php include '../layout/footer.php' ?>