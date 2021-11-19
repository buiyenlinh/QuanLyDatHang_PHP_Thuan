<?php
include './config.php';
$hanghoa = [
  'MSHH',
  'TENHH',
  'QuyCach',
  'Gia',
  'SoLuongHang'
];
if (isset($_GET['mshh'])) {
  $hanghoa = $db->query("SELECT * FROM hanghoa WHERE MSHH = " . $_GET['mshh'])->fetch_assoc();
  $images = $db->query("SELECT * FROM hinhhanghoa WHERE MSHH = " . $_GET['mshh']);
  $loaihang = $db->query("SELECT * FROM loaihanghoa WHERE MaLoaiHang = " . $hanghoa['MaLoaiHang'])->fetch_assoc();
}
?>

<html lang="en">
<head>
  <title>Đặt hàng</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="./home_style.css">
</head>
<body>
  <?php include './header.php' ?>
  <div id="content">
    <div class="container"> 
      <div class="content mt-5 mb-5">
          <div class="row">
            <div class="col-md-5">
              <?php $img = $images->fetch_assoc(); ?>
              <div class="chi-tiet-anh">
                <img src="<?php echo BASE . $img['TenHinh'] ?>" alt="" style="width: 100%; object-fix: cover; border: 1px solid #ddd">
              </div>
            </div>
            <div class="col-md-7">
              <h3><?php echo $hanghoa['TenHH'] ?></h3>
              <ul>
                <li>Giá: <?php echo $hanghoa['Gia'] ?> VNĐ</li>
                <li>Quy cách hàng hóa: <?php echo $hanghoa['QuyCach'] ?></li>
                <li>Số lượng còn lại: <?php echo $hanghoa['SoLuongHang'] ?></li>
                <li>Thuộc loại hàng: <?php echo $loaihang['TenLoaiHang'] ?></li>
              </ul>

              <div class="chi-tiet-anh-nho mt-3">
                <div class="row m-0 p-0" style="border: 1px solid #ddd;">
                  <div class="col-md-3 m-0 p-0">
                    <img src="<?php echo BASE . $img['TenHinh'] ?>" onclick="changeImage('<?php echo BASE . $img['TenHinh'] ?>')" style="width: 100%; object-fix: cover; border: 1px solid #ddd;">
                  </div>
                  <?php
                    if($images->num_rows > 0):
                      while($img = $images->fetch_assoc()):?>
                  <div class="col-md-3 m-0 p-0">
                    <img
                      src="<?php echo BASE . $img['TenHinh'] ?>" alt=""
                      style="width: 100%; object-fix: cover; border: 1px solid #ddd;"
                      onclick="changeImage('<?php echo BASE . $img['TenHinh'] ?>')"
                    >
                  </div>
                  <?php endwhile; endif; ?>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
                        <div class="test"></div>
  <div id="footer">
    <div class="footer">
      <div class="text-center p-3" style="border-top: 1px solid #ddd">
        <span>Quản Lý Đặt Hàng</span>
      </div>
    </div>
  </div>


  <script>
    function changeImage(img) {
      $('.chi-tiet-anh img').attr('src', img);
    }
  </script>
</body>
</html>