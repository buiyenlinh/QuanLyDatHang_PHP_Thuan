<?php include '../layout/header.php' ?>

<?php 
$khachhang = $db->query("select * from khachhang");

?>

<div class="layout">
  <div class="layout-left">
    <div class="customer-sidebar">
      <?php include '../layout/sidebar.php' ?>
    </div>
  </div>
  <div class="layout-right">
    <?php include '../layout/header-top.php' ?>
    <div class="layout-right-relative">
      <div class="layout-right-absolute mt-3">
        <div class="product">
          <div class="d-flex justify-content-between mb-2">
            <h4 class="mb-0">Danh sách khách hàng</h4>
            <a href="./thaotac.php"
              class="btn btn-info btn-sm rounded-0 mb-1"
            >Thêm</a>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <th>Mã khách hang</th>
                <th>Họ tên</th>
                <th>Tên công ty</th>
                <th>Số điện thoại</th>
                <th>Số Fax</th>
                <th>Thao tác</th>
              </thead>
              <tbody>
                <?php if ($khachhang->num_rows > 0):  ?>
                  <?php while($row = $khachhang->fetch_assoc()): ?>
                    <tr>
                      <td><?php echo $row['MSKH'] ?></td>
                      <td><?php echo $row['HoTenKH'] ?></td>
                   
                      <td><?php echo $row['TenCongTy'] ?></td>
                      <td><?php echo $row['SoDienThoai'] ?></td>
                      <td><?php echo $row['SoFax'] ?></td>
                      <td><a href="./thaotac.php?mskh=<?php echo $row['MSKH'] ?>" class="text-info mr-1"><b>Sửa</b></a></td>
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