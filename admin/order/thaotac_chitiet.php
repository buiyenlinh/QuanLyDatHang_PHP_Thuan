<?php include '../layout/header.php' ?>

<?php 
$sodondh = $_GET['sodondh'];
$hanghoa = $db->query("SELECT * FROM hanghoa");

if (isset($_GET['delete'])) {
  $db->query("DELETE FROM chitietdathang WHERE MaChiTiet = " . $_GET['delete']);
  Header("Location: " . BASE . 'admin/order/chitiet.php?sodondh=' . $sodondh);
  exit();
}

$chitiet = [
  'MaChiTiet' => '',
  'MSHH' => '',
  'SoLuong' => 0,
  'GiaDatHang' => 0,
  'GiamGia' => 0
];

$error = false;

if (isset($_GET['mct']) && !empty($_GET['mct'])) {
  $chitiet = $db->query("SELECT * from chitietdathang where MaChiTiet=" . $_GET['mct'])->fetch_assoc();
}

if (isset($_POST['thao_tac_form'])) {
  $masochitiet = isset($_POST['masochitiet']) ? $_POST['masochitiet'] : '' ;
  $mshh = isset($_POST['mshh']) ? $_POST['mshh'] : '' ;
  $soluong = isset($_POST['soluong']) ? $_POST['soluong'] : '' ;
  
  $hh = $db->query("SELECT * FROM hanghoa WHERE MSHH = " . $mshh)->fetch_assoc();
  $giamgia = isset($_POST['giamgia']) ? $_POST['giamgia'] : '' ;

  if ($hh['SoLuongHang'] == 0) {
    $error = true;
  }

  if (!$error) {
    if ($soluong > $hh['SoLuongHang']) {
      $soluong = $hh['SoLuongHang'];
    }

    if (!empty($masochitiet)) {
      $str = "UPDATE chitietdathang SET MSHH = " . $mshh . ", SoLuong = " . $soluong . ", GiaDatHang = " . $hh['Gia'] . ", GiamGia= " . $giamgia . " WHERE MaChiTiet = " . $masochitiet;
      
      $db->query($str);
    } else {
      $str = "INSERT INTO chitietdathang(SoDonDH, MSHH, SoLuong, GiaDatHang, GiamGia) VALUES (" . $sodondh . ", "
      . $mshh . ", " . $soluong . ", " . $hh['Gia'] . ", " . $giamgia . ")";
      $db->query($str);
    }
    $conlai = $hh['SoLuongHang'] - $soluong;
    $db->query("UPDATE hanghoa SET SoLuongHang = " . $conlai . " WHERE MSHH = " . $mshh);

    Header("Location: " . BASE . 'admin/order/chitiet.php?sodondh=' . $sodondh);
    exit();
  }
  
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
              <div class="text-danger"><?php if ($error) echo "Sản phẩm đã hết" ?></div>
              <form action="./thaotac_chitiet.php?sodondh=<?php echo $sodondh ?>" method="POST">
                <input type="hidden" value="1" name="thao_tac_form">
                <input type="hidden" name="masochitiet" value="<?php echo $chitiet['MaChiTiet'] ?>">
                
                <div class="form-group">
                  <label for="">Hàng hóa <span class="text-danger">*</span></label>
                  <select name="mshh" id="" class="form-control">
                    <?php if($hanghoa->num_rows > 0):
                      while($hh = $hanghoa->fetch_assoc()): ?>
                      <option value="<?php echo $hh['MSHH'] ?>" <?php if($hh['MSHH'] == $chitiet['MSHH']) echo 'selected' ?>>
                        <?php echo $hh['TenHH'] ?>
                      </option>
                    <?php endwhile; endif; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="">Số lượng <span class="text-danger">*</span></label>
                  <input name="soluong" type="number" class="form-control" value="<?php echo $chitiet['SoLuong'] ?>" required>
                </div>

                <div class="form-group">
                  <label for="">Giảm giá <span class="text-danger">*</span></label>
                  <input name="giamgia" type="number" class="form-control" value="<?php echo $chitiet['GiamGia'] ?>" required>
                </div>

                <div class="form-group">
                  <button class="btn btn-info btn-sm rounded-0">Thêm/Cập nhật</button>
                  <a href="./chitiet.php?sodondh=<?php echo $sodondh?>" class="btn btn-secondary btn-sm rounded-0">Trở về</a>
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