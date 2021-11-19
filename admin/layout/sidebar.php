<div id="side-bar">
    <div class="side-bar">
        <div style="border-bottom: 1px solid #fff">
            <h4 class="m-3" style="text-transform: uppercase;"><?php echo $_SESSION['user']['nhanvien']['ChucVu'] ?></h4>
        </div>
        <div class="p-3">
            <b class="">DANH MỤC</b>
        </div>
        <ul class="nav justify-content-center flex-column">
            <li class="nav-item nav-item-product">
                <a class="nav-link " href="<?php echo BASE?>admin/product/">
                <i class="fab fa-accessible-icon"></i>&nbsp; Hàng hóa
                </a>
            </li>
            <li class="nav-item nav-item-category">
                <a class="nav-link " href="<?php echo BASE?>admin/category/">
                    <i class="fas fa-frog"></i>&nbsp; Loại hàng hóa
                </a>
            </li>
            <li class="nav-item nav-item-customer">
                <a class="nav-link " href="<?php echo BASE?>admin/customer">
                <i class="fas fa-user-tie"></i>&nbsp; Khách hàng
                </a>
            </li>
            <li class="nav-item nav-item-employee">
                <a class="nav-link " href="<?php echo BASE?>admin/employee">
                <i class="fas fa-users"></i>&nbsp; Nhân viên
                </a>
            </li>

            <li class="nav-item nav-item-order">
                <a class="nav-link " href="<?php echo BASE?>admin/order">
                <i class="fas fa-users"></i>&nbsp; Đặt hàng
                </a>
            </li>

            <li class="nav-item nav-item-profile">
                <a class="nav-link " href="<?php echo BASE?>admin/profile">
                <i class="fas fa-user-circle"></i>&nbsp; Tài khoản
                </a>
            </li>
        </ul>
    </div>
</div>