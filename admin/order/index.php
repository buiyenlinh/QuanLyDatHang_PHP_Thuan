<?php include '../layout/header.php' ?>

<?php 
$dathang = $db->query("select * from dathang");

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
          <div class="d-flex justify-content-between mb-2">
            <h4 class="mb-0">Danh sách đặt hàng</h4>
            <a href="./thaotac.php"
              class="btn btn-info btn-sm rounded-0 mb-1"
            >Thêm</a>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <th>Mã đơn</th>
                <th>Khách hàng</th>
                <th>Nhân viên</th>
                <th>Ngày đặt hàng</th>
                <th>Ngày giao hàng</th>
                <th>Địa chỉ</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
              </thead>
              <tbody>
                <?php if ($dathang->num_rows > 0):  ?>
                  <?php while($row = $dathang->fetch_assoc()): ?>
                    <tr>
                      <td><?php echo $row['SoDonDH'] ?></td>
                      <?php $kh = $db->query("SELECT * FROM khachhang WHERE MSKH = " . $row['MSKH'])->fetch_assoc(); ?>
                      <td><?php echo $kh['HoTenKH'] ?></td>
                      <?php $nv = $db->query("SELECT * FROM nhanvien WHERE MSNV = " . $row['MSNV'])->fetch_assoc(); ?>
                      <td><?php echo $nv['HoTenNV'] ?></td>
                      <td><?php echo $row['NgayDH'] ?></td>
                      <td><?php echo $row['NgayGH'] ?></td>
                      <td><?php echo $row['DiaChiGiaoHang'] ?></td>
                      <td><?php echo $row['TrangThaiDH'] ?></td>
                      <td>
                        <a href="./chitiet.php?sodondh=<?php echo $row['SoDonDH'] ?>" class="text-success mr-1"><b>Chi tiết</b></a>
                        <a href="./thaotac.php?sodondh=<?php echo $row['SoDonDH'] ?>" class="text-info mr-1"><b>Sửa</b></a>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>  
    </div>
  </div>
</div>


<?php include '../layout/footer.php' ?>