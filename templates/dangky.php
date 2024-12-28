<?php
require('../common/database.php');
$db = new Database();
$isSuccess = false;
if (isset($_POST['signup'])) {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $query = "INSERT INTO `user` (`name`, `phone`, `username`, `pass`) VALUES ('" . $name . "', '" . $phone . "', '" . $username . "', '" . $password . "')";
    $result = $db->query($query);
    $isSuccess = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/reset.css">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<style>
    .login {
        background-color: rgb(243, 240, 235);
        max-width: 500px;
        margin: auto;
        padding: 10px 10px;
        text-align: center;
        margin-top: 120px;
        border-radius: 3px;
        margin-bottom: 30px;
    }

    .login h1 {
        padding-bottom: 10px;
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-weight: 600;
    }

    .login input {
        display: inline-block;
        width: 450px;
        padding: 10px;
        font-size: 15px;
        border-radius: 7px;
        border: 1px solid #777;
        margin-bottom: 15px;
        border-radius: 7px;
    }

    .login .submit {
        font-size: 15px;
        padding: 10px;
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-weight: 600;
        text-transform: uppercase;
        text-align: center;
    }

    .login .submit:hover {
        background-color: #4267b2;
        color: white;
    }

    .-or {
        display: inline-block;
        width: 42%;
        border-bottom: solid 1px #333;
        justify-content: center;
        align-items: center;
    }

    .or {
        color: #333;
        margin: 0 1px;
        font-size: 14px;
        font-family: Georgia, 'Times New Roman', Times, serif;
    }

    .login a {
        text-decoration: none;
    }

    .login .sighup {
        margin-top: 15px;
        display: inline-block;
        width: 450px;
        padding: 10px;
        font-size: 15px;
        border-radius: 7px;
        border: 1px solid #777;
        margin-bottom: 5px;
        background-color: #52cfdf;
        color: white;
        font-size: 20px;
        font-family: Georgia, 'Times New Roman', Times, serif;
        background-image: url(icons8-facebook.svg);
        background-repeat: no-repeat;
        background-size: 35px;
        background-position: 3px;
    }

    .login .sighup:hover {
        background-color: aqua;
        color: red;
    }


    /* ------------------Sighup---------------------- */

    .form-contact {
        width: 100%;
        max-width: 350px;
        margin: auto;
        padding: 28px;
        border-radius: 10px;
    }

    .sighup {
        background-color: rgb(220, 233, 245);
        max-width: 600px;
        margin: auto;
        padding: 10px 10px;
        text-align: center;
        margin-top: 10px;
        border-radius: 3px;
        margin-bottom: 30px;
    }

    .sighup h1 {
        padding-bottom: 10px;
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-weight: 600;
    }

    .sighup input {
        display: inline-block;
        width: 500px;
        padding: 10px;
        font-size: 15px;
        border-radius: 7px;
        border: 1px solid #777;
        margin-bottom: 15px;
        border-radius: 7px;
    }

    .sighup .submit {
        font-size: 15px;
        padding: 10px;
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-weight: 600;
        text-transform: uppercase;
        text-align: center;
    }

    .sighup .submit:hover {
        background-color: #4267b2;
        color: white;
    }

    .-or {
        display: inline-block;
        width: 42%;
        border-bottom: solid 1px #333;
        justify-content: center;
        align-items: center;
    }

    .or {
        color: #333;
        margin: 0 1px;
        font-size: 14px;
        font-family: Georgia, 'Times New Roman', Times, serif;
    }

    .sighup a {
        text-decoration: none;
    }
</style>

<body>
    <!-- menu -->
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
                            <i class="fa-solid fa-angle-down"></i>
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
        <div class="login">
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                <h1>Đăng Ký</h1>
                <?php if (isset($isSuccess) && $isSuccess): ?>
                    <div class="alert alert-success">
                        Đăng ký tài khoản thành công
                    </div>
                <?php endif; ?>
                <input type="text" name="name" placeholder="Nhập họ tên" required> <br>
                <input type="text" name="phone" placeholder="Số điện thoại" required> <br>
                <input type="text" name="username" placeholder="Tài khoản" required> <br>
                <input type="password" name="password" placeholder="Mật khẩu" required><br>
                <button type="submit" name="signup" class=" sighup">Đăng ký </button><br>
                <div>
                    <p>Bạn đã có tài khoản<span><a href="./dangnhap.php" style="color: blue;"> Login</a></span></p>
                </div>
            </form>
        </div>
</body>

</html>