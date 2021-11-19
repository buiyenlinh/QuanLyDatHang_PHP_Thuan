<?php
  include './config.php';
  if ($_SESSION['user']) {
    unset($_SESSION['user']);
    header('Location: login.php');
    exit();
  }
?>