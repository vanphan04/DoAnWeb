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
                            <a href="/DoAnChuyenNganh/MyWeb/templates/dangnhap.html">Đăng nhập</a>
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
                <div class="row ">
                    <div class="col-8">
                        <table class="table" style="margin-top: 150px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="table-cart-body"></tbody>
                        </table>
                    </div>
                    <div class="col-4">
                        <table class="table" style="margin-top: 150px;">
                            <tr>
                                <th>Đơn hàng</th>
                            </tr>
                            <tr>
                                <th>Tổng sản phẩm</th>
                                <td>
                                    <p id="total-SP"></p>
                                </td>
                            </tr>
                            <tr>
                                <th>Tạm tính</th>
                                <td>
                                    <p id="sub-Total-Price"></p>
                                </td>
                            </tr>
                            <tr>
                                <th>Tông tiền</th>
                                <td>
                                    <p id="total-Price"></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-end"><a href="./dathang.php" class="btn btn-primary">Thanh toán</a></td>
                            </tr>
                        </table>
                    </div>
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
    <script src="../js/jquery-3.7.1.min.js"></script>
    <script>
        $(function() {
            let cart = JSON.parse(localStorage.getItem("cart") || "[]");
            let htmlStr = '';
            let totalSP = 0;
            let totalPrice = 0;
            if (cart) {
                for (let i = 0; i < cart.length; i++) {
                    let data = JSON.parse(cart[i].product);

                    totalSP += cart[i].quantity;
                    totalPrice += parseInt(data.price) * parseInt(cart[i].quantity);
                    htmlStr += `<tr><td>${i+1}</td>
                    <td>${data.name}</td>
                    <td><p>${formatCR(parseInt(data.price))}</p></td>
                    <td>
                    <input type="hidden" class="price" value="${data.price}" >
                    <input type="number" class="quantity form-control" data-index='${i}' data-product='${cart[i].product}' data-price='${data.price}' value="${cart[i].quantity}" min="1">
                    </td>
                    <td><p class="subTotal" id='subTotal_${i}'>${formatCR(parseInt(data.price) * parseInt(cart[i].quantity))} </p></td>
                    <td><span class="xoasp" data-product='${cart[i].product}'>X</span></td>
                    </tr>`;
                }
            } else {
                htmlStr = '<tr><td colspan="6">Chưa có sản phẩm trong giỏ hàng</td></tr>';
            }

            $('#table-cart-body').html(htmlStr);
            $('#total-SP').html(totalSP);
            $('#total-Price').html(`${formatCR(totalPrice)}`);
            $('#sub-Total-Price').html(`${formatCR(totalPrice)}`);

            $('.xoasp').click(function() {
                let cart = JSON.parse(localStorage.getItem("cart") || "[]");
                const product = $(this).data('product');
                const exSP = cart.findIndex(x => x.product == JSON.stringify(product));
                cart.splice(exSP, 1);
                localStorage.setItem("cart", JSON.stringify(cart));
                window.location.reload();
            })

            $('.quantity').change(function() {
                let cart = JSON.parse(localStorage.getItem("cart") || "[]");
                const index = $(this).data('index');
                const price = $(this).data('price');
                const product = $(this).data('product');
                cart[index].quantity = parseInt($(this).val());
                $('#subTotal_' + index).html(`${formatCR(parseInt($(this).val()) * parseInt(price))}`);
                localStorage.setItem("cart", JSON.stringify(cart));
                setCart()
            })
        })


        function setCart() {
            let cart = JSON.parse(localStorage.getItem("cart") || "[]");
            let totalSP = 0;
            let totalPrice = 0;
            for (let i = 0; i < cart.length; i++) {
                let data = JSON.parse(cart[i].product);
                totalSP += cart[i].quantity;
                totalPrice += parseInt(data.price) * parseInt(cart[i].quantity);
            }
            $('#total-SP').html(totalSP);
            $('#total-Price').html(`${formatCR(totalPrice)}`);
            $('#sub-Total-Price').html(`${formatCR(totalPrice)}`);
        }

        function formatCR(value) {
            return value.toLocaleString('it-IT', {
                style: 'currency',
                currency: 'VND'
            });
        }
    </script>
</body>

</html>