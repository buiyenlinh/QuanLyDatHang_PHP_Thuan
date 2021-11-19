<?php include '../layout/header.php' ?>

<?php 

if (isset($_GET['delete'])) {
  $pd = $db->query("SELECT * FROM hanghoa WHERE MaLoaiHang = " . $_GET['delete']);
  if ($pd->num_rows > 0) {
    while($row = $pd->fetch_assoc()) {
      $hinhhanghoa = $db->query("SELECT * FROM hinhhanghoa WHERE MSHH = " . $row['MSHH']);
      if ($hinhhanghoa->num_rows > 0) {
        while($img = $hinhhanghoa->fetch_assoc()) {
          $db->query("DELETE FROM hinhhanghoa WHERE MaHinh = " . $img['MaHinh']);
        }
      }
      $db->query("DELETE FROM hanghoa WHERE MSHH = " . $row['MSHH']);
    }
  }

  $db->query("DELETE FROM loaihanghoa WHERE MaLoaiHang=" . $_GET['delete']);

  Header("Location: " . BASE . 'admin/category');
  exit();
}

$loaihanghoa = [
  'MaLoaiHang' => '',
  'TenLoaiHang' => ''
];
if (isset($_GET['mlh'])) {
  $loaihanghoa = $db->query("SELECT * from loaihanghoa where maloaihang=" . $_GET['mlh'])->fetch_assoc();
}

if (isset($_POST['thaotac_form'])) {
  $tenloaihang = isset($_POST['tenloaihang']) ? $_POST['tenloaihang'] : '' ;
  $maloaihang = isset($_POST['maloaihang']) ? $_POST['maloaihang'] : '' ;

  if ($maloaihang != "") {
    $db->query("UPDATE loaihanghoa SET TenLoaiHang='" . $tenloaihang . "' WHERE MaLoaiHang=" . $maloaihang);
  } else {
    $db->query("insert into loaihanghoa(TenLoaiHang) values ('" . $tenloaihang . "')");
  }
  Header("Location: " . BASE . 'admin/category');
  exit();
}
?>

<div class="layout">
  <div class="layout-left">
    <div class="category-sidebar">
      <?php include '../layout/sidebar.php' ?>
    </div>
  </div>
  <div class="layout-right">
    <?php include '../layout/header-top.php' ?>
    <div class="layout-right-relative">
      <div class="layout-right-absolute mt-3">
        <div class="product">
          <h4>Thêm/Cập nhật loại hàng hóa</h4>
          <div class="row">
            <div class="col-md-6">
              <form action="./thaotac.php" method="POST">
                <input type="hidden" value="1" name="thaotac_form">
                <input type="hidden" name="maloaihang" value="<?php echo $loaihanghoa['MaLoaiHang'] ?>">
                <div class="form-group">
                  <label for="">Tên loại hàng <span class="text-danger">*</span></label>
                  <input type="text" name="tenloaihang" class="form-control" value="<?php echo $loaihanghoa['TenLoaiHang'] ?>" required>
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