<?php include '../layout/header.php' ?>

<?php 

$categories = $db->query("SELECT * FROM loaihanghoa");

if (isset($_GET['delete'])) {
  $images = $db->query("SELECT * FROM hinhhanghoa WHERE MSHH=" . $_GET['delete']);
  if ($images->num_rows > 0) {
    while($row = $images->fetch_assoc()) {
      $db->query("DELETE FROM hinhhanghoa WHERE MaHinh = " . $row['MaHinh']);
    }
  }

  $db->query("DELETE FROM hanghoa WHERE MSHH= " . intval($_GET['delete']));

  Header("Location: " . BASE . 'admin/product');
  exit();
}

$hanghoa = [
  'MSHH' => '',
  'TenHH' => '',
  'QuyCach' => '',
  'Gia' => '',
  'SoLuongHang' => '',
  'MaLoaiHang' => '',
];

$hinhhanghoa = [];
if (isset($_GET['mshh'])) {
  $hanghoa = $db->query("SELECT * from hanghoa where MSHH=" . $_GET['mshh'])->fetch_assoc();
  $hinhhanghoa = $db->query("SELECT * FROM hinhhanghoa WHERE MSHH = " . intval($_GET['mshh']));
}

if (isset($_POST['thao_tac_form'])) {
  $mshh = isset($_POST['mshh']) ? $_POST['mshh'] : '' ;
  $tenhh = isset($_POST['tenhh']) ? $_POST['tenhh'] : '' ;
  $quycach = isset($_POST['quycach']) ? $_POST['quycach'] : '' ;
  $gia = isset($_POST['gia']) ? $_POST['gia'] : '' ;
  $soluonghang = isset($_POST['soluonghang']) ? $_POST['soluonghang'] : '' ;
  $maloaihang = isset($_POST['maloaihang']) ? $_POST['maloaihang'] : '' ;
  
  $hh = $mshh;
  if ($mshh != "") {
    $str = "update hanghoa set TenHH='" . $tenhh . "', QuyCach='" . $quycach . "', Gia=" . intval($gia) . ", SoLuongHang=" . intval($soluonghang) . ", MaLoaiHang=" . intval($maloaihang) . " where MSHH=" . intval($mshh);

    $db->query($str);
  } else {
    $db->query("insert into hanghoa(TenHH, QuyCach, Gia, SoLuongHang, MaLoaiHang) 
      values ('" . $tenhh . "', '" . $quycach . "', " . $gia . ", " . $soluonghang . ", " . $maloaihang . ")");
    $hanghoa = $db->query("select * from hanghoa where TenHH = '" . $tenhh . "' and MaLoaiHang = " . $maloaihang . " and QuyCach = '" . $quycach . "' and Gia = " . $gia . " and SoLuongHang = " . intval($soluonghang))->fetch_assoc();
    $hh = $hanghoa['MSHH'];
  }

  if (isset($_FILES['images']) && !empty($_FILES['images'])) {
    $images_tmp_name = $_FILES['images']['tmp_name'];
    $images_name = $_FILES['images']['name'];

    for($i = 0; $i < count($images_tmp_name); $i++) {
      if (!empty($images_name[$i])) {
        $file = $images_tmp_name[$i];
        $path = "../../uploads/" . $images_name[$i];
        move_uploaded_file($file, $path);

        $db->query("INSERT INTO hinhhanghoa(TenHinh, MSHH) values('" . "/uploads/" . $images_name[$i] . "', " . $hh . ")");
      }
    }
  }

  Header("Location: " . BASE . 'admin/product');
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
          <h4>Thêm/Cập nhật loại hàng hóa</h4>
          <div class="row">
            <div class="col-md-6">
              <form action="./thaotac.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" value="1" name="thao_tac_form">
                <input type="hidden" name="mshh" value="<?php echo $hanghoa['MSHH'] ?>">
                <div class="form-group">
                  <label for="">Tên hàng hóa <span class="text-danger">*</span></label>
                  <input type="text" name="tenhh" class="form-control" value="<?php echo $hanghoa['TenHH'] ?>" required>
                </div>

                <div class="form-group">
                  <label for="">Quy cách <span class="text-danger">*</span></label>
                  <input type="text" name="quycach" class="form-control" value="<?php echo $hanghoa['QuyCach'] ?>" required>
                </div>

                <div class="form-group">
                  <label for="">Giá <span class="text-danger">*</span></label>
                  <input type="text" name="gia" class="form-control" value="<?php echo $hanghoa['Gia'] ?>" required>
                </div>

                <div class="form-group">
                  <label for="">Số lượng <span class="text-danger">*</span></label>
                  <input type="text" name="soluonghang" class="form-control" value="<?php echo $hanghoa['SoLuongHang'] ?>" required>
                </div>

                <div class="form-group">
                  <label for="">Mã loại hàng <span class="text-danger">*</span></label>
                  <select name="maloaihang" id="" class="form-control" value="<?php echo $hanghoa['MaLoaiHang'] ?>">
                  <?php if ($categories->num_rows > 0):  ?>
                    <?php while($row = $categories->fetch_assoc()): ?>
                      <option value="<?php echo $row['MaLoaiHang'] ?>" <?php if($hanghoa['MaLoaiHang'] == $row['MaLoaiHang'] ) echo 'selected'; ?>>
                        <?php echo $row['TenLoaiHang'] ?>
                      </option>
                    <?php endwhile; ?>
                  <?php endif; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="">Ảnh hàng hóa <span class="text-danger">*</span></label><br>
                  <input type="file" multiple name="images[]">
                  <div class="product-update-image mt-2">
                    <?php if ($hinhhanghoa): ?>
                      <?php
                        if ($hinhhanghoa->num_rows > 0):
                          while($img = $hinhhanghoa->fetch_assoc()):
                      ?>
                        <span class="product-update-image-item">
                          <img src="<?php echo BASE . $img['TenHinh'] ?>"
                            class="mr-1"
                            style="width: 100px; height: 100px; object-fit: cover; border: 1px solid #333;"
                          >
                          <a
                            class="text-danger product-update-image-icon-delete"
                            href="./delete_image.php?mshh=<?php echo $hanghoa['MSHH'] ?>&mh=<?php echo $img['MaHinh'] ?>"
                          >X</a>
                        </span>
                      <?php
                          endwhile;
                        endif;
                      ?>
                      <?php endif; ?>
                  </div>
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