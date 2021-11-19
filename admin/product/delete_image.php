<?php 
include '../config.php';
$mshh = isset($_GET['mshh']) ? $_GET['mshh'] : '';
$mh = isset($_GET['mh']) ? $_GET['mh'] : '';

$db->query("DELETE FROM hinhhanghoa WHERE MaHinh = " . intval($mh));

Header('Location: ' . BASE . 'admin/product/thaotac.php?mshh=' . intval($mshh));
exit();
?>