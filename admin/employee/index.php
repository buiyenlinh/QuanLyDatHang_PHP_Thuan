<?php include '../layout/header.php' ?>

<?php 
$employees = $db->query("select * from nhanvien");

?>

<div class="layout">
  <div class="layout-left">
    <div class="employee-sidebar">
      <?php include '../layout/sidebar.php' ?>
    </div>
  </div>
  <div class="layout-right">
    <?php include '../layout/header-top.php' ?>
    <div class="layout-right-relative">
      <div class="layout-right-absolute mt-3">
        <div class="product">
          <div class="d-flex justify-content-between mb-2">
            <h4 class="mb-0">Danh sách nhân viên</h4>
            <?php if($_SESSION['user']['nhanvien']['ChucVu'] == "Quản lý"): ?>
              <a href="./thaotac.php"
                class="btn btn-info btn-sm rounded-0 mb-1"
              >Thêm</a>
            <?php endif; ?>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <th>Mã số</th>
                <th>Họ tên</th>
                <th>Chức vụ</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Thao tác</th>
              </thead>
              <tbody>
                <?php if ($employees->num_rows > 0):  ?>
                  <?php while($row = $employees->fetch_assoc()): ?>
                    <tr>
                      <td><?php echo $row['MSNV'] ?></td>
                      <td><?php echo $row['HoTenNV'] ?></td>
                   
                      <td><?php echo $row['ChucVu'] ?></td>
                      <td><?php echo $row['DiaChi'] ?></td>
                      <td><?php echo $row['SoDienThoai'] ?></td>
                      <?php if($_SESSION['user']['nhanvien']['ChucVu'] == "Quản lý"): ?>
                        <td>
                          <?php if ($row['ChucVu'] == "Nhân viên"): ?>
                            <a href="./thaotac.php?msnv=<?php echo $row['MSNV'] ?>" class="text-info mr-1"><b>Sửa</b></a>
                          <?php endif ?>
                        </td>
                      <?php else: ?>
                        <td></td>
                      <?php endif; ?>
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