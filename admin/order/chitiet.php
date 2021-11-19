<?php include '../layout/header.php' ?>

<?php
$sodondh = $_GET['sodondh'];
$chitiet = $db->query("select * from chitietdathang WHERE SoDonDH = " . $sodondh);

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
            <h4 class="mb-0">Chi tiết đơn hàng</h4>
            <div>
              <a href="./thaotac_chitiet.php?sodondh=<?php echo $sodondh ?>"
                class="btn btn-info btn-sm rounded-0 mb-1"
              >Thêm</a>
              <a href="./index.php" class="btn btn-success btn-sm rounded-0 mb-1">Trở lại</a>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <th>Mã hàng hóa</th>
                <th>Tên hàng hóa</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Giảm giá</th>
                <th>Thao tác</th>
              </thead>
              <tbody>
                <?php if ($chitiet->num_rows > 0):  ?>
                  <?php while($row = $chitiet->fetch_assoc()): ?>
                    <tr>
                      <?php $hh = $db->query("SELECT * FROM hanghoa WHERE MSHH = " . $row['MSHH'])->fetch_assoc(); ?>
                      <td><?php echo $hh['MSHH'] ?></td>
                      <td><?php echo $hh['TenHH'] ?></td>
                      <td><?php echo $row['SoLuong'] ?></td>
                      <td><?php echo $row['GiaDatHang'] ?></td>
                      <td><?php echo $row['GiamGia'] ?></td>
                      <td>
                        <a href="./thaotac_chitiet.php?sodondh=<?php echo $row['SoDonDH']?>&mct=<?php echo $row['MaChiTiet'] ?>" class="text-info mr-1"><b>Sửa</b></a>
                        <a href="./thaotac_chitiet.php?sodondh=<?php echo $row['SoDonDH']?>&delete=<?php echo $row['MaChiTiet'] ?>" class="text-danger mr-1"><b>Xóa</b></a>
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