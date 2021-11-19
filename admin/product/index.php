<?php include '../layout/header.php' ?>

<?php 
$products = $db->query("select * from hanghoa");

?>

<div class="layout">
  <div class="layout-left">
    <div class="product-sidebar">
      <?php include '../layout/sidebar.php' ?>
    </div>
  </div>
  <div class="layout-right">
    <?php include '../layout/header-top.php' ?>
    <div class="layout-right-relative">
      <div class="layout-right-absolute mt-3">
        <div class="product">
          <div class="d-flex justify-content-between mb-2">
            <h4 class="mb-0">Danh sách hàng hóa</h4>
            <a href="./thaotac.php"
              class="btn btn-info btn-sm rounded-0 mb-1"
            >Thêm</a>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <th>Mã hàng hóa</th>
                <th>Tên hàng hóa</th>
                <th>Hình ảnh</th>
                <th>Quy cách</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Loại hàng</th>
                <th>Thao tác</th>
              </thead>
              <tbody>
                <?php if ($products->num_rows > 0):  ?>
                  <?php while($row = $products->fetch_assoc()): ?>
                    <tr>
                      <td><?php echo $row['MSHH'] ?></td>
                      <td><?php echo $row['TenHH'] ?></td>
                      <td>
                        <?php 
                          $images = $db->query("SELECT * FROM hinhhanghoa WHERE MSHH = " . intval($row['MSHH']));
                          if ($images->num_rows > 0):
                            while($img = $images->fetch_assoc()):
                        ?>
                          <img src="<?php echo BASE . $img['TenHinh'] ?>" alt="" class="mr-1" style="width: 35px; height: 35px; object-fit: cover; border: 1px solid #ddd">
                        <?php
                            endwhile;
                          endif;
                        ?>
                      </td>
                      <td><?php echo $row['QuyCach'] ?></td>
                      <td><?php echo $row['Gia'] ?></td>
                      <td><?php echo $row['SoLuongHang'] ?></td>
                      <?php
                        $loaihang = $db->query("SELECT * FROM loaihanghoa 
                          WHERE maloaihang = '" . $row['MaLoaiHang'] . "'"
                        )->fetch_assoc();
                      ?>
                      <td><?php echo $loaihang['TenLoaiHang'] ?></td>
                      <td>
                        <a href="./thaotac.php?mshh=<?php echo $row['MSHH'] ?>" class="text-info mr-1"><b>Sửa</b></a>
                        <a href="./thaotac.php?delete=<?php echo $row['MSHH'] ?>" class="text-danger"><b>Xóa</b></a>
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