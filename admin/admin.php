<!-- admin.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sản phẩm</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <h1>Quản lý Quản trị</h1>
    <nav>
        <ul>
            <li><a href="?page=products">Quản lý Sản phẩm</a></li>
            <li><a href="?page=product_types">Quản lý Loại Sản phẩm</a></li>
        </ul>
    </nav>

    <div>
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            if ($page == 'products') {
                include 'products.php';
            } elseif ($page == 'product_types') {
                include 'product_types.php';
            } else {
                echo "<p>Trang không tồn tại!</p>";
            }
        } else {
            echo "<p>Vui lòng chọn mục quản lý.</p>";
        }
        ?>
    </div>
</body>
</html>
