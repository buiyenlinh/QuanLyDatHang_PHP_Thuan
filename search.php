<?php 
include './config.php';

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$hanghoa = $db->query("SELECT * FROM hanghoa WHERE TenHH LIKE '%" . $keyword . "%'");
?>  

<html lang="en">
<head>
  <title>Tìm kiếm</title>
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
      <div class="content mt-5">
        <h3>Kết quả tìm kiếm của '<?php echo $keyword ?>'</h3>
        <div class="row mt-3">
          <?php
          if ($hanghoa->num_rows > 0):
            while($row = $hanghoa->fetch_assoc()):
              $images = $db->query("SELECT * FROM hinhhanghoa WHERE MSHH = " . $row['MSHH']);
              $img = $images->fetch_assoc();
          ?>
            <div class="col-md-3">
              <div class="item">
                <div class="img">
                  <a href="<?php echo BASE . 'chitiet.php?mshh=' . $row['MSHH'] ?>">
                    <img src="<?php echo BASE . $img['TenHinh'] ?>" alt="" style="border-bottom: 1px solid #ddd">
                  </a>
                </div>
                <div class="info text-center p-3">
                  <b><?php echo $row['TenHH'] ?></b>
                  <div>Giá: <b class="text-danger"><?php echo $row['Gia'] ?></b> VNĐ</div>
                </div>
              </div>
            </div>
          <?php endwhile; else:?>
            <p class="ml-3">Không có hàng hóa</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <div id="footer">
    <div class="footer">
      <div class="text-center p-3" style="border-top: 1px solid #ddd">
        <span>Quản Lý Đặt Hàng</span>
      </div>
    </div>
  </div>
</body>
</html>