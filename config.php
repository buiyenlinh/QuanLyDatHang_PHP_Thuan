<?php
date_default_timezone_set('Asia/Saigon');
session_start();

$db = new mysqli("localhost","root","","quanlydathang");

// Check connection
if ($db->connect_errno) {
  echo "Failed to connect to MySQL: " . $db->connect_error;
  exit();
}

define('BASE', '/B1808283_LeThiCamLinh_CT42801_BaiTapLon/');

?>