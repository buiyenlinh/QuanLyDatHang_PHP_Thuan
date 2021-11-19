<?php
include './config.php';
$hanghoa = $db->query("SELECT * FROM hanghoa");

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
  <div id="banner" class="mt-3">
    <div class="banner">
      <img src="./images/images-01.jpg" style="width: 100%; height: 650px; object-fit: cover" alt="">
    </div>
  </div>
  <div id="content">
    <div class="container"> 
      <div class="content mt-5">
        <div class="row">
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
          <?php endwhile; endif;?>
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