<?php include '../layout/header.php' ?>

<?php 

$khachhang = $db->query("SELECT * FROM khachhang");

$dathang = [
  'SoDonDH' => '',
  'MSKH' => '',
  'MSNV' => '',
  'NgayDH' => '',
  'NgayGH' => '',
  'TrangThaiDH' => '',
  'DiaChiGiaoHang' => '',
];

if (isset($_GET['sodondh']) && !empty($_GET['sodondh'])) {
  $dathang = $db->query("SELECT * from dathang where SoDonDH=" . $_GET['sodondh'])->fetch_assoc();
}

if (isset($_POST['thao_tac_form'])) {
  $sodondh = isset($_POST['sodondh']) ? $_POST['sodondh'] : '' ;
  $mskh = isset($_POST['mskh']) ? $_POST['mskh'] : '' ;
  $msnv = $_SESSION['user']['nhanvien']['MSNV'];
  $ngayDH = isset($_POST['ngayDH']) ? $_POST['ngayDH'] : '' ;
  $ngayGH = isset($_POST['ngayGH']) ? $_POST['ngayGH'] : '' ;
  $trangthaidh = isset($_POST['trangthaidh']) ? $_POST['trangthaidh'] : '' ;
  $diachikh = isset($_POST['diachikh']) ? $_POST['diachikh'] : '' ; 

  if (!empty($sodondh)) {
    $db->query("UPDATE dathang SET NgayDH = '" . $ngayDH . "', NgayGH = '" . $ngayGH . "', TrangThaiDH = '" . $trangthaidh . "', DiaChiGiaoHang = '" . $diachikh . "' WHERE SoDonDH = " . $sodondh);
  } else {
    $db->query("INSERT INTO dathang(MSKH, MSNV, NgayDH, NgayGH, TrangThaiDH, DiaChiGiaoHang) VALUES (" . $mskh . ", " . $msnv . ", '" . $ngayDH . "', '" . $ngayGH . "', '" . $trangthaidh . "', '" . $diachikh . "')");
  }

  Header("Location: " . BASE . 'admin/order');
  exit();
}
?>

<div class="layout">
  <div class="layout-left">
    <div class="order-sidebar">
      <?php include '../layout/sidebar.php' ?>
    </div>
  </div>
  <div class="layout-right">
    <?php include '../layout/header-top.php' ?>
    <div class="layout-right-relative">
      <div class="layout-right-absolute mt-3">
        <div class="order">
          <h4>Thêm/Cập nhật đặt hàng</h4>
          <div class="row">
            <div class="col-md-6">
              <form action="./thaotac.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" value="1" name="thao_tac_form">
                <input type="hidden" name="sodondh" value="<?php echo $dathang['SoDonDH'] ?>">
                
                <div class="form-group">
                  <label for="">Khách hàng <span class="text-danger">*</span></label>
                  <select name="mskh" id="" class="form-control" <?php if(!empty($dathang['SoDonDH'])) echo 'disabled' ?>>
                    <?php if($khachhang->num_rows > 0):
                      while($kh = $khachhang->fetch_assoc()): ?>
                      <option value="<?php echo $kh['MSKH'] ?>" <?php if($kh['MSKH'] == $dathang['MSKH']) echo 'selected' ?>>
                        <?php echo $kh['HoTenKH'] ?>
                      </option>
                    <?php endwhile; endif; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="">Địa chỉ giao hàng <span class="text-danger">*</span></label>
                  <input name="diachikh" type="text" class="form-control" value="<?php echo $dathang['DiaChiGiaoHang'] ?>" required>
                </div>

                <div class="form-group">
                  <label for="">Ngày đặt hàng <span class="text-danger">*</span></label>
                  <input type="date" name="ngayDH" class="form-control" value="<?php echo $dathang['NgayDH'] ?>" required>
                </div>

                <div class="form-group">
                  <label for="">Ngày giao hàng <span class="text-danger">*</span></label>
                  <input type="date" name="ngayGH" class="form-control" value="<?php echo $dathang['NgayGH'] ?>" required>
                </div>

                <div class="form-group">
                  <label for="">Trạng thái đơn hàng <span class="text-danger">*</span></label>
                  <select name="trangthaidh" id="" class="form-control">
                    <option value="Chưa giao" <?php if($dathang['TrangThaiDH'] == "Chưa giao") echo "selected" ?> >
                      Chưa giao
                    </option>
                    <option value="Đang giao" <?php if($dathang['TrangThaiDH'] == "Đang giao") echo "selected" ?>>
                      Đang giao
                    </option>
                    <option value="Đã giao" <?php if($dathang['TrangThaiDH'] == "Đã giao") echo "selected" ?>>
                      Đã giao
                    </option>
                  </select>
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