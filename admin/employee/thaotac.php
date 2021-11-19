<?php include '../layout/header.php' ?>

<?php 

$nhanvien = [
  'MSNV' => '',
  'HoTenNV' => '',
  'ChucVu' => '',
  'DiaChi' => '',
  'SoDienThoai' => ''
];

if (isset($_GET['msnv']) && !empty($_GET['msnv'])) {
  $nhanvien = $db->query("SELECT * from nhanvien where MSNV=" . $_GET['msnv'])->fetch_assoc();
}

if (isset($_POST['thao_tac_form'])) {
  $msnv = isset($_POST['msnv']) ? $_POST['msnv'] : '' ;
  $hoten = isset($_POST['hoten']) ? $_POST['hoten'] : '' ;
  $diachi = isset($_POST['diachi']) ? $_POST['diachi'] : '' ;
  $chucvu = isset($_POST['chucvu']) ? $_POST['chucvu'] : '' ;
  $sodienthoai = isset($_POST['sodienthoai']) ? $_POST['sodienthoai'] : '' ;

  $username = isset($_POST['username']) ? $_POST['username'] : '' ;
  $password = isset($_POST['password']) ? $_POST['password'] : '' ;
  $password = md5($password);

  $db->query("INSERT INTO user(username, password, type) VALUES ('" . $username . "', '" . $password . "', 0)");
  $userID = $db->query("SELECT * FROM user WHERE username = '" . $username . "' AND password = '" . $password . "'")->fetch_assoc();

  if (!empty($msnv)) {
    $db->query("UPDATE nhanvien SET HoTenNV = '" . $hoten . "', ChucVu = '" . $chucvu . "', DiaChi = '" . $diachi. "', SoDienThoai='" . $sodienthoai . "' WHERE MSNV = " . $msnv);
  } else {
    $db->query("INSERT INTO nhanvien(HoTenNV, ChucVu, DiaChi, SoDienThoai, UserID) Values ('" . 
      $hoten . "', '" . $chucvu . "', '" . $diachi . "', '" . $sodienthoai . "', " . $userID['id'] . ")");
  }

  Header("Location: " . BASE . 'admin/employee');
  exit();
}
?>

<div class="layout">
  <div class="layout-left">
    <div class="product-sidebar">
      <?php include '../layout/sidebar.php' ?>
    </div>
  </div>
  <div class="layout-right">
    <?php include '../layout/header-top.php' ?>
    <div class="layout-right-relative">
      <div class="layout-right-absolute mt-3">
        <div class="product">
          <h4>Thêm/Cập nhật nhân viên</h4>
          <div class="row">
            <div class="col-md-6">
              <form action="./thaotac.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" value="1" name="thao_tac_form">
                <input type="hidden" name="msnv" value="<?php echo $nhanvien['MSNV'] ?>">
                
                <?php if (empty($nhanvien['MSNV'])): ?>
                  <div class="form-group">
                    <label for="">Tên đăng nhập <span class="text-danger">*</span></label>
                    <input type="text" name="username" class="form-control" required>
                  </div>

                  <div class="form-group">
                    <label for="">Mật khẩu <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control" required>
                  </div>
                <?php endif; ?>

                <div class="form-group">
                  <label for="">Họ tên <span class="text-danger">*</span></label>
                  <input type="text" name="hoten" class="form-control" value="<?php echo $nhanvien['HoTenNV'] ?>" required>
                </div>

                <div class="form-group">
                  <label for="">Chức vụ <span class="text-danger">*</span></label>
                  <select name="chucvu" id="" class="form-control">
                    <option value="Nhân viên">Nhân viên</option>
                    <option value="Quản lý">Quản lý</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="">Địa chỉ <span class="text-danger">*</span></label>
                  <input type="text" name="diachi" class="form-control" value="<?php echo $nhanvien['DiaChi'] ?>" required>
                </div>

                <div class="form-group">
                  <label for="">Số điện thoại <span class="text-danger">*</span></label>
                  <input type="text" name="sodienthoai" class="form-control" value="<?php echo $nhanvien['SoDienThoai'] ?>" required>
                </div>

                <div class="form-group">
                  <button class="btn btn-info btn-sm rounded-0">Thêm/Cập nhật</button>
                  <a href="./index.php" class="btn btn-secondary btn-sm rounded-0">Trở về</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>  
    </div>
  </div>
</div>


<?php include '../layout/footer.php' ?>