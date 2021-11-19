<?php include '../layout/header.php' ?>

<?php 

$khachhang = [
  'MSKH' => '',
  'HoTenKH' => '',
  'TenCongTy' => '',
  'SoDienThoai' => '',
  'SoFax' => ''
];

if (isset($_GET['mskh']) && !empty($_GET['mskh'])) {
  $khachhang = $db->query("SELECT * from khachhang where MSKH=" . $_GET['mskh'])->fetch_assoc();
}

if (isset($_POST['thao_tac_form'])) {
  $mskh = isset($_POST['mskh']) ? $_POST['mskh'] : '' ;
  $hoten = isset($_POST['hoten']) ? $_POST['hoten'] : '' ;
  $congty = isset($_POST['congty']) ? $_POST['congty'] : '' ;
  $sofax = isset($_POST['sofax']) ? $_POST['sofax'] : '' ;
  $sodienthoai = isset($_POST['sodienthoai']) ? $_POST['sodienthoai'] : '' ;

  $username = isset($_POST['username']) ? $_POST['username'] : '' ;
  $password = isset($_POST['password']) ? $_POST['password'] : '' ;
  $password = md5($password);

  $db->query("INSERT INTO user(username, password, type) VALUES ('" . $username . "', '" . $password . "', 1)");
  $userID = $db->query("SELECT * FROM user WHERE username = '" . $username . "' AND password = '" . $password . "'")->fetch_assoc();

  if (!empty($mskh)) {
    $db->query("UPDATE khachhang SET HoTenKH = '" . $hoten . "', TenCongTy = '" . $congty . "', SoFax = '" . $sofax. "', SoDienThoai='" . $sodienthoai . "' WHERE MSKH = " . $mskh);
  } else {
    $db->query("INSERT INTO khachhang(HoTenKH, TenCongTy, SoFax, SoDienThoai, UserID) Values ('" . 
      $hoten . "', '" . $congty . "', '" . $sofax . "', '" . $sodienthoai . "', " . $userID['id'] . ")");
  }

  Header("Location: " . BASE . 'admin/customer');
  exit();
}
?>

<div class="layout">
  <div class="layout-left">
    <div class="customer-sidebar">
      <?php include '../layout/sidebar.php' ?>
    </div>
  </div>
  <div class="layout-right">
    <?php include '../layout/header-top.php' ?>
    <div class="layout-right-relative">
      <div class="layout-right-absolute mt-3">
        <div class="product">
          <h4>Thêm/Cập nhật khách hàng</h4>
          <div class="row">
            <div class="col-md-6">
              <form action="./thaotac.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" value="1" name="thao_tac_form">
                <input type="hidden" name="mskh" value="<?php echo $khachhang['MSKH'] ?>">
                
                <?php if (empty($khachhang['MSKH'])): ?>
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
                  <input type="text" name="hoten" class="form-control" value="<?php echo $khachhang['HoTenKH'] ?>" required>
                </div>

                <div class="form-group">
                  <label for="">Tên công ty <span class="text-danger">*</span></label>
                  <input type="text" name="congty" class="form-control" value="<?php echo $khachhang['TenCongTy'] ?>" required>
                </div>

                <div class="form-group">
                  <label for="">Số điện thoại <span class="text-danger">*</span></label>
                  <input type="text" name="sodienthoai" class="form-control" value="<?php echo $khachhang['SoDienThoai'] ?>" required>
                </div>

                <div class="form-group">
                  <label for="">Số fax <span class="text-danger">*</span></label>
                  <input type="text" name="sofax" class="form-control" value="<?php echo $khachhang['SoFax'] ?>" required>
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