<?php include 'config.php' ?>

<?php
if(isset($_SESSION['user'])) {
  header('Location: ' . BASE . 'admin/product/');
}

$error_login = "";
if(isset($_POST['login_input'])) {
  $username = isset($_POST['username']) ? $_POST['username'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';
  $password = md5($password);
  if (!empty($username) && !empty($password)) {
    $row = $db->query("select * from user where username='" . $username . "' and password='" . $password . "' AND type=0");
    $user = $row->fetch_assoc();
    if (empty($user)) {
      $error_login = "Tên đăng nhập hoặc mật khẩu sai";
    } else {
      $thongtin = $db->query("SELECT * FROM nhanvien WHERE UserID = " . $user['id'])->fetch_assoc();
      if (empty($thongtin)) {
        $error_login = "Thông tin người dùng không tồn tại";
      } else {
        $_SESSION['user'] = [
          'nhanvien' => $thongtin,
          'dangnhap' => $user
        ];
        Header("Location: " . BASE . 'admin/product');
        exit();
      }
    }  
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Quản lý đặt hàng</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div id="login">
  <div class="login">
    <div class="login-form">
      <form action="./login.php" method="POST">
        <div class="text-danger"><?php echo $error_login?></div>
        <input type="hidden" value="1" name="login_input">
        <div class="form-group">
          <label for="">Tên đăng nhập <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="username">
        </div>
        <div class="form-group">
          <label for="">Mật khẩu <span class="text-danger">*</span></label>
          <input type="password" class="form-control" name="password">
        </div>
        <div class="form-group">
          <button class="btn btn-primary btn-sm rounded-0" type="submit">Đăng nhập</button>
          <button class="btn btn-secondary btn-sm rounded-0" type="reset">Đặt lại</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="main.js"></script>
</body>
</html>