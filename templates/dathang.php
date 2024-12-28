<?php
require dirname(__DIR__) . '/helper/OrderHelper.php';
$orderHelper = new OrderHelper();

if (isset($_POST['submit'])) {
  $data = [
    'product' => isset($_POST['product']) ? $_POST['product'] : []
  ];

  $orderHelper->checkout($data);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đặt hàng</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/reset.css">
</head>

<body>
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
              <a href="./index.php">Sản phẩm</a>
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
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" id="formCheckout" class="row g-3" style="width: 1100px; margin: 0 auto; margin-top: 100px;">
      <h3 style="text-align: center;">ĐIỀN THÔNG TIN CÁ NHÂN</h3>
      <div class="col-md-6">
        <label for="inputEmail4" class="form-label">Email</label>
        <input type="email" class="form-control" id="inputEmail4">
      </div>
      <div class="col-md-6">
        <label for="inputPassword4" class="form-label">Họ và tên</label>
        <input type="name" class="form-control" id="name">
      </div>
      <div class="form-group">
        <label for="PhoneNumber">Số điện thoại</label>
        <input type="tel" class="form-control" id="PhoneNumber" placeholder="">
      </div>
      <div class="col-12">
        <label for="inputAddress" class="form-label">Tỉnh</label>
        <input type="text" class="form-control" id="inputAddress" placeholder="">
      </div>
      <div class="col-12">
        <label for="inputAddress2" class="form-label">Huyện</label>
        <input type="text" class="form-control" id="inputAddress2" placeholder="">
      </div>
      <div class="col-md-6">
        <label for="inputCity" class="form-label">Xã</label>
        <input type="text" class="form-control" id="inputCity">
      </div>
      <div class="col-md-4">
        <label for="inputState" class="form-label">Đường</label>
        <input type="text" class="form-control" id="inputCity">
        </select>
      </div>
      <div id="form-payment">
      </div>

      <div class="col-12">
        <button type="submit" id="btnSubmit" name="submit" class="btn btn-primary">Đặt hàng</button>
        <button type="button" id="btnPrint" class="btn btn-primary">Xem hóa đơn</button>
      </div>
    </form>
  </div>
  <script src="../js/jquery-3.7.1.min.js"></script>
  <script>
    $(function() {
      let cart = JSON.parse(localStorage.getItem("cart") || "[]");
      let htmlStr = '';

      if (cart) {
        for (let i = 0; i < cart.length; i++) {
          let data = JSON.parse(cart[i].product);
          const dataIP = {
            quantity: cart[i].quantity,
            product: data
          }
          htmlStr += `<input type="hidden" name="product[]" value='${JSON.stringify(dataIP)}' >`;
        }
      }
      $('#form-payment').html(htmlStr);

      $('#formCheckout').on('submit', function() {
        localStorage.removeItem('cart');
        alert('Đặt hàng thành công');
      });

      $('#btnPrint').click(function() {
        var divToPrint = $('#formCheckout');
        let cart = JSON.parse(localStorage.getItem("cart") || "[]");
        let htmlStr = '';
        if (cart) {
          for (let i = 0; i < cart.length; i++) {
            let data = JSON.parse(cart[i].product);

            htmlStr += `<tr><td style="width:5%;text-align:center">${i+1}</td>
                    <td style="width:55%;text-align:left">${data.name}</td>
                    <td style="width:15%"><p>${formatCR(parseInt(data.price))}</p></td>
                    <td style="width:15%;text-align:center">${cart[i].quantity}</td>
                    <td style="width:15%"><p class="subTotal" id='subTotal_${i}'>${formatCR(parseInt(data.price) * parseInt(cart[i].quantity))} </p></td>
                    </tr>`;
          }
        } else {
          htmlStr = '<tr><td colspan="5">Chưa có sản phẩm trong giỏ hàng</td></tr>';
        }

        var newWin = window.open('', 'Print-Window');
        newWin.document.open();
        newWin.document.write('<html><body onload="window.print()"><table class="table" style="margin-top: 150px;"><thead><tr><th>#</th><th>Tên sản phẩm</th><th>Đơn giá</th><th>Số lượng</th><th>Thành tiền</th></tr></thead><tbody id="table-cart-body">' + htmlStr + '</tbody></table></body></html>');
        newWin.document.close();
        setTimeout(function() {
          newWin.close();
        }, 10);
      })

      function formatCR(value) {
        return value.toLocaleString('it-IT', {
          style: 'currency',
          currency: 'VND'
        });
      }
    })
  </script>
</body>

</html>