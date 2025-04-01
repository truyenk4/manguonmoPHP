
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Chỉnh nền navbar thành đen và chữ thành trắng */
        .navbar {
            background-color: #343a40; /* Màu nền đen */
        }

        .navbar-brand, .nav-link {
            color: #ffffff !important; /* Màu chữ trắng */
        }

        /* Thay đổi màu khi hover vào các liên kết trong navbar */
        .nav-link:hover {
            color: #f8f9fa !important; /* Màu chữ sáng khi hover */
        }

        /* Thêm màu nền cho badge */
        .badge-pill {
            background-color: #ff5733; /* Màu nền cam */
            color: #fff; /* Màu chữ trắng */
        }

        /* Thay đổi màu nền khi hover vào badge */
        .badge-pill:hover {
            background-color: #c0392b; /* Màu nền khi hover (đỏ tối) */
        }

        /* Thêm khoảng cách giữa biểu tượng và văn bản trong navbar */
        .nav-link i {
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <a class="navbar-brand" href="#">Quản lý sản phẩm</a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Các mục còn lại được căn giữa -->
            <ul class="navbar-nav mx-auto"> <!-- Căn giữa các mục này -->
                <!-- Mục Danh mục -->
                

                <!-- Danh sách sản phẩm -->
                <li class="nav-item">
                    <a class="nav-link" href="/webbanhang/Product/">
                        <i class="fas fa-list-ul"></i>Danh sách sản phẩm
                    </a>
                </li>

                <!-- Kiểm tra vai trò người dùng trước khi hiển thị "Thêm sản phẩm" -->
                <?php if (SessionHelper::isAdmin()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product/add">
                            <i class="fas fa-plus-circle"></i>Thêm sản phẩm
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Thêm giỏ hàng với biểu tượng -->
                <li class="nav-item">
                    <a class="nav-link" href="/webbanhang/Product/cart">
                        <i class="fas fa-shopping-cart"></i>Giỏ hàng
                        <span class="badge badge-pill badge-primary">
                            <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : '0'; ?>
                        </span>
                    </a>
                </li>

                <!-- Mục thanh toán, yêu cầu đăng nhập -->
                <?php if (isset($_SESSION['username'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product/checkout">
                            <i class="fas fa-credit-card"></i>Thanh toán
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/account/login">
                            <i class="fas fa-credit-card"></i>Thanh toán
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Chức năng tìm kiếm -->
                <li class="nav-item">
                    <form class="form-inline my-2 my-lg-0" action="/webbanhang/Product/search" method="get">
                        <input class="form-control mr-sm-2" type="search" placeholder="Tìm sản phẩm" aria-label="Search" name="search" />
                        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </li>

                <?php if (isset($_SESSION['username'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/account/logout">
                            <i class="fas fa-sign-out-alt"></i> Logout (<?php echo $_SESSION['username']; ?>)
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/account/login">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/account/register">
                            <i class="fas fa-user-plus"></i> Đăng ký
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Thêm script JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

