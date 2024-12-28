<?php
require('../helper/ProductHelper.php');
$productHelper = new ProductHelper();
$product = null;
if (isset($_GET['id'])) {
  $product = $productHelper->findById((int)$_GET['id']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/chitiet.css">


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
        <a href="../index.php"><img src="../images/Black & White Minimalist Business Logo.png" style="width: 150px;" alt=""> </a>
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
              <a href="../templates/lienhe.html">Liên hệ</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>

    <!-- chi tiet san pham  -->
    <div class="product">
      <div class="container">
       
        <div class="product-content" style="display: flex;">
          <div class="product-content-left" style="display: flex;">
            <div class="product-content-left-big-img">
              <img src="../images/<?= $product['image'] ?>" alt="">
            </div>
          <div class="product-content-right">
            <input type="hidden" name="product" value='<?= json_encode($product, true) ?>'>
            <div class="product-content-right-product-name">
              <h1><?= $product['name'] ?></h1>
            </div>
            <div class="product-content-right-product-price">
              <p><?= number_format((int)$product['price'], 0, ',', '.') ?> <sup> đ</sup></p>
            </div>
            <div class="quantity">
              <p style="font-weight: bold;">Số lượng:</p>
              <input type="number" min="1" value="1" name="quantity">
            </div>
            <div class="product-content-right-product-button">
              <a href="javascript:void(0)" id="btn-add-to-cart" style="text-decoration: none;"><button><i class="fa-solid fa-cart-shopping"></i>
                  <p style="width: 150px;">MUA HÀNG</p>
                </button></a>
            </div>

          </div>
        </div>
      </div>
      <!--END CHI TIET-->
      <div id="lowerbar">
        <ul id="box">
          <li>
            <div class="box-item">
              <div class="box-top">
                <a href="" class="box-thumb">
                  <img src="../images/yonex.jpg" style="width: 400px; height: 350px;" alt="">
                </a>

                <a href="" class="item-box">YONEX</a>
              </div>
            </div>
          </li>
          <li>
            <div class="box-item">
              <div class="box-top">
                <a href="" class="box-thumb">
                  <img src="../images/lining.png" style="width: 400px; height: 350px;" alt="">
                </a>

                <a href="" class="item-box">LINING</a>
              </div>
            </div>
          </li>
          <li>
            <div class="box-item">
              <div class="box-top">
                <a href="" class="box-thumb">
                  <img src="../images/kumpoo12.png" style="width: 400px; height: 350px;" alt="">
                </a>

                <a href="" class="item-box">KUMPOO</a>

              </div>
          </li>
        </ul>
      </div>
      <div id="callbtn">
        <img src="../images/z5488168519001_3c654cf7b5d2d607c90f10281b4f618f.jpg" class="d-block" height="50px"
          width="50px" alt="">
      </div>

      <div id="zalobtn">
        <img src="../images/z5488166793905_478a9ff4da4e29fcafddde74ab7253bf.jpg" class="d-block" height="50px"
          width="50px" alt="">
      </div>
    </div>
    <!-- Footer -->
    <div class="container-full footer">
      <div class="container row content__footer">

        <div class="icon__group col-8">
          <i class="fa-brands fa-facebook"></i>
          <i class="fa-brands fa-twitter"></i>
          <i class="fa-brands fa-google-plus-g"></i>
          <i class="fa-brands fa-github"></i>
          <i class="fa-brands fa-instagram"></i>
        </div>
      </div>
    </div>
  </div>
  <script src="../js/jquery-3.7.1.min.js"></script>
  <script>
    $('#btn-add-to-cart').click(function() {
      let cart = JSON.parse(localStorage.getItem("cart") || "[]");
      const product = $('input[name="product"]').val();
      const quantity = $('input[name="quantity"]').val();
      let exits = cart.find(x => x.product == product);
      if (exits) {
        exits.quantity += parseInt(quantity);
      } else {
        cart[cart.length] = {
          quantity: parseInt(quantity),
          product: product,
        };
      }
      localStorage.setItem('cart', JSON.stringify(cart));
      alert('Thêm giỏ hàng thành công');
    })
  </script>
</body>


</html>