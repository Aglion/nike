<?php 
    session_start();
    require "connect.php";
    
    if(isset($_POST['username']) and isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
        $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
        $count = mysqli_num_rows($result);
    
        if($count == 1) {
            $_SESSION['username'] = $username;
            $user = mysqli_fetch_assoc($result);
            $_SESSION['user'] = [
                "id" => $user['id'],
                "username" => $user['username'],
                "email" => $user['email'],
            ];
        } else {
            echo "<script>alert('Логин или Пароль неверный!!!');</script>";
        }
    }

    if(isset($_POST['username_reg']) and isset($_POST['password_reg']) and isset($_POST['password_reg'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password = $_POST['password'];

        $exam_user = "SELECT * FROM users WHERE login = '$login'";
        $exam_result = mysqli_query($connect, $exam_user); 
        $num = mysqli_num_rows($exam_result);
        
        if($num == 0) {
            $sql = "INSERT INTO users (login, email, password, name_command) VALUES ('$login', '$email', '$password', '$name_command')";
            $result = mysqli_query($connect, $sql);
            if($result) { 
                echo "<script>alert('Регистрация прошла успешна'); location.href='index.php';</script>"; 
            } else { 
                echo "<script>alert('Произошла ошибка при регистрации!')</script>"; 
            }    
        } else { 
            echo "<script>alert('Пользователь с таким именем существует!')</script>"; 
        }
    }

    if(isset($_POST['username_reg']) and isset($_POST['password_reg']) and isset($_POST['email_reg'])) {
        $username_reg = $_POST['username_reg'];
        $password_reg = $_POST['password_reg'];
        $email_reg = $_POST['email_reg'];

        $exam_user = "SELECT * FROM users WHERE username = '$username_reg'";
        $exam_result = mysqli_query($connect, $exam_user); 
        $num = mysqli_num_rows($exam_result);
        
        if($num == 0) {
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username_reg', '$email_reg', '$password_reg')";
            $result = mysqli_query($connect, $sql);
            if($result) { 
                echo "<script>alert('Регистрация прошла успешна'); location.href='account.php';</script>"; 
            } 
        } else { 
            echo "<script>alert('Пользователь с таким именем существует!')</script>"; 
        }
    }

    if(isset($_SESSION['username'])) {
        $username = $_SESSION['index'];
        header('Location: personal.php');
    }
    
    ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/eb2a8518ca.js"></script>
        <link rel="stylesheet" href="account.css">
        <title>Nike</title>
    </head>
    <body>
        <!-- Header Section -->
        <header>
            <div class="container">
                <div class="navbar">
                    <div class="logo">
                        <a href="index.html">
                            <img src="img/pngwing.com.png" width="125px">
                        </a>
                    </div>
                    <nav>
                        <ul id="MenuItems">
                            <li><a class="a" href="products.html">Продукты</a></li>
                            <li><a class="a" href="#">Мужчины</a></li>
                            <li><a class="a" href="#">Женщины</a></li>
                            <li><a class="a" href="#">Дети</a></li>
                            <li><a class="a" href="#">Новинки</a></li>
                            <li><a class="a" href="account.html">Аккаунт</a></li>
                        </ul>
                    </nav>
                    <a href="cart.html">
                        <img src="img/cart.png">
                    </a>
                    <img src="img/menu.png" class="menu-icon" onclick="menutoggle()">
                </div>
            </div>
        </header>
        <!-- End Header Section -->

        <div class="account">
            <div class="container">
                <div class="row">
                    <div class="col-2">
                        <img src="img/image1.png" width="100%">
                    </div>
                    <div class="col-2">
                        <div class="form-container">

                            <div class="form-btn">
                                <span onclick="login()" class="span">Login</span>
                                <span onclick="register()" class="span">Register</span>
                                <hr id="Indicator">
                            </div>
                            <form id="LoginForm" method="POST" class="log">
                                <input type="text" name="username" placeholder="Имя пользователя">
                                <input type="password" name="password" placeholder="Пароль">
                                <button class="btn">Войти</button>
                                <a href="">Забыли пароль</a>
                            </form>
                            <form method="POST" id="RegForm" class="log">
                                <input type="text" name="username_reg" placeholder="Имя пользователя">
                                <input type="email" name="email_reg" placeholder="Email">
                                <input type="password" name="password_reg" placeholder="Пароль">
                                <button type="submit" class="btn">Зарегистрироваться</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer>
            <div class="row-footer">
                <div class="col">
                    <img src="img/nike_PNG9.png" class="logo-footer">
                    <p class="p-footer">
                        Наша миссия - это то, что побуждает нас делать все возможное для расширения человеческого потенциала. Мы делаем это, создавая новаторские спортивные инновации, делая наши продукты более устойчивыми, создавая творческую и разнообразную глобальную команду и оказывая положительное влияние в сообществах, где мы живем и работаем.
                    </p>
                </div>
                <div class="col">
                    <h3>ПОМОЩЬ <div class="underline"><span></span></div></h3>
                    <ul>
                        <li><a href="">Статус заказа</a></li>
                        <li><a href="">Доставка</a></li>
                        <li><a href="">Возврат</a></li>
                        <li><a href="">Способы оплаты</a></li>
                        <li><a href="">Связаться с нами</a></li>
                    </ul>
                    </div>
                <div class="col">
                <h3>О NIKE <div class="underline"><span></span></div></h3>
                <ul>
                    <li><a href="">Новости</a></li>
                    <li><a href="">Карьера</a></li>
                    <li><a href="">Инвесторам</a></li>
                    <li><a href="">Забота об окружающей среде</a></li>
                </ul>
                </div>
                <div class="col">
                    <h3>Письмо <div class="underline"><span></span></div></h3>
                    <form class="form">
                        <i class="far fa-envelope"></i>
                        <input type="email" placeholder="Введите свой email" required>
                        <button type="submit"><i class="fas fa-arrow-right"></i></button>
                    </form>
                    <div class="social-icons">
                        <i class="fab fa-facebook-f"></i>
                        <i class="fab fa-twitter"></i>
                        <i class="fab fa-whatsapp"></i>
                        <i class="fab fa-instagram"></i>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->
        <script src="main.js"></script>
    </body>
</html>