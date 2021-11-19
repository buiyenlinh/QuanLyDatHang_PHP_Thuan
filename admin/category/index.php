<?php include '../layout/header.php' ?>

<?php 
$categories = $db->query("select * from loaihanghoa");

?>

<div class="layout">
  <div class="layout-left">
    <div class="category-sidebar">
      <?php include '../layout/sidebar.php' ?>
    </div>
  </div>
  <div class="layout-right">
    <?php include '../layout/header-top.php' ?>
    <div class="layout-right-relative">
      <div class="layout-right-absolute mt-3">
        <div class="product">
          <div class="d-flex justify-content-between mb-2">
            <h4 class="mb-0">Danh sách loại hàng hóa</h4>
            <a href="./thaotac.php"
              class="btn btn-info btn-sm rounded-0 mb-1"
            >Thêm</a>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <th>Mã loại hàng</th>
                <th>Tên loại hàng</th>
                <th>Thao tác</th>
              </thead>
              <tbody>
                <?php if ($categories->num_rows > 0):  ?>
                  <?php while($row = $categories->fetch_assoc()): ?>
                    <tr>
                      <td><?php echo $row['MaLoaiHang'] ?></td>
                      <td><?php echo $row['TenLoaiHang'] ?></td>
                      <td>
                        <a href="./thaotac.php?mlh=<?php echo $row['MaLoaiHang'] ?>" class="text-info mr-1"><b>Sửa</b></a>
                        <a href="./thaotac.php?delete=<?php echo $row['MaLoaiHang'] ?>" class="text-danger"><b>Xóa</b></a>
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