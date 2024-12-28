<?php
require('../helper/ProductHelper.php');
$productHelper = new ProductHelper();

$products = $productHelper->Products();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zăn sport</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/reset.css">
  <!-- nhung thu vien font chu poppins -->
  <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
  <!-- thu vien font awesome 6.3 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>

<body>
  <!-- nav menu -->
  <div class="containerfull">
    <div class="container-full top__header">
      <nav class="container nav__menu">
        <a href="./index.php"><img src="../images/Black & White Minimalist Business Logo.png" style="width: 150px;" alt=""> </a>
        <div class="nav__mobile">
          <i class="nav__icon fa-solid fa-bars"></i>
          <ul class="nav__list">
            <li class="nav__item">
              <a href="./index.php">Trang chủ</a>
            </li>
            <li class="nav__item">
              <a href="#">Sản phẩm</a>
            </li>
            <li class="nav__item">
              <a href="#">Giới thiệu</a>
            </li>
            <li class="nav__item">
              <a href="./cart.php">Giỏ hàng</a>
            </li>
            <li class="nav__item">
              <a href="./dangnhap.php">Đăng nhập</a>
            </li>
            <li class="nav__item">
              <a href="../templates/lienhe.html">Liên hệ</a>
            </li>
          </ul>
        </div>
      </nav>

    </div>
    <!-- hết top header -->
    <div id="body">
      <div id="content">

        <div class="healine">
          <h2 style="text-align: center; color: black;">SẢN PHẨN BÁN CHẠY</h2>
        </div>
        <ul class="product">
          <?php if ($products): ?>
            <?php foreach ($products as $item): ?>
              <li>
                <div class="product-item">
                  <div class="product-top">
                    <a href="" class="product-thumb">
                      <img src="../images/<?= $item['image'] ?>"
                        style="width: 250px; height: 250px;" alt="">
                    </a>
                    <!-- Mua ngay  -->
                    <a href="../templates/chitiet.php?id=<?= $item['id_product'] ?>" target="_parent" class="buy-now">Mua ngay</a>
                  </div>
                  <div class="product-info">
                    <a href="" class="product-cat"><?= $item['ptName'] ?></a>
                    <a href="" class="product-name"><?= $item['name'] ?></a>
                    <div class="product-price"><?= number_format((int)$item['price'], 0, ',', '.') ?> <sup> đ</sup></div>
                  </div>
                </div>
              </li>
            <?php endforeach; ?>
          <?php endif; ?>
        </ul>
        </iframe>
      </div>
      <div id="lowerbar">
        <ul id="box">
          <li>
            <div class="box-item">
              <div class="box-top">
                <a href="#" class="box-thumb">
                  <img src="../images/yonex.jpg" style="width: 400px; height: 350px;"
                    alt="">
                </a>

                <a href="#" class="item-box">Yonex</a>
              </div>
            </div>
          </li>
          <li>
            <div class="box-item">
              <div class="box-top">
                <a href="#" class="box-thumb">
                  <img src="../images/lining.png" style="width: 400px; height: 350px;"
                    alt="">
                </a>

                <a href="" class="item-box">Lining</a>
              </div>
            </div>
          </li>
          <li>
            <div class="box-item">
              <div class="box-top">
                <a href="#" class="box-thumb">
                  <img src="../images/kumpoo12.png"
                    style="width: 400px; height: 350px;" alt="">
                </a>

                <a href="#" class="item-box">Kumpoo</a>

              </div>
          </li>
        </ul>
        <div id="callbtn">
          <img src="../images/z5488168519001_3c654cf7b5d2d607c90f10281b4f618f.jpg" class="d-block" height="50px"
            width="50px" alt="">
        </div>

        <div id="zalobtn">
          <img src="../images/z5488166793905_478a9ff4da4e29fcafddde74ab7253bf.jpg" class="d-block" height="50px"
            width="50px" alt="">
        </div>

      </div>
    </div>
    <!-- Footer -->
    <div id="footer">
      <div class="box">
        <div class="logo">
          <img src="assets/logo.png" alt="">
        </div>
        <p>Địa chỉ: 180 Cao Lỗ, Phường 4, Quận 8, Thành phố Hồ Chí Minh </p>
        <p>Thành viên: Nguyễn Huỳnh Kha - Phan Thành Văn</p>
        <p>Số điện thoại: 0764164487 or 0868254679</p>
      </div>
      <div class="box">
        <h3>LIÊN HỆ</h3>
        <form action="">
          <input type="text" placeholder="Địa chỉ email">
          <button>Nhận tin</button>
        </form>
      </div>
    </div>


  </div>
</body>

</html>