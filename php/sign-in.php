<?php 
    if (isset($_SESSION["user"])){
        session_destroy();
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <?php include("../templates/head.php") ?>
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <main class="main">
            <div class="main__container container">
                <div class="sign-in-box">
                    <?php echo '<a class="nav-scroll_item" href="../index.php"> << На главную</a>' ?>
                    <form action="../handlers/auth.php" method="POST" class="sign-in-form">
                        <div class="input-box">
                            <input type="text" name="login" placeholder=" " required id="">
                            <label>Логин</label>
                        </div>
                        <div class="input-box">
                            <input type="password" name="password" placeholder=" " required id="">
                            <label>Пароль</label>
                        </div>
                        <button type="submit">Войти</button>
                        <p>Забыли что-то? Обратитесь к администратору ресторана.</p>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>