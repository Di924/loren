<?php
session_start();
if(isset($_GET['exit'])){
    session_destroy();
    header('Location: /sitedb/');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/index.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>Document</title>
</head>
<body>
<div id="header">
    <div class="item_header_main">
        <p>Интернет-магазин "Букинист"</p>
    </div>
    <div id="nav">
        <ul>
            <li><a onClick="careshow('idmain',this)" class="curret">Главная</a></li>
            <li><a onClick="careshow('idbook',this)">Добавить кнгиу</a></li>
            <li><a onClick="careshow('idsearch',this)">Найти книгу</a></li>
            <li><a onClick="careshow('idbooks',this)">Прейскурант</a></li>
        </ul>
    </div>
    <div class="item_header_auth">
        <p id="btn_modal_window">Вход</p>
        <p id="btn_out">Выход</p>
    </div>
</div>
<div class="modal" id="my_modal">
    <div class="modal_content">
        <span id="close_modal" class="close_modal_window">&#10062;</span>
        <h3>Авторизация</h3>
        <?php
            if(!isset($_SESSION['valid_user'])){
                include 'login/auth.php';
            }
        ?>
    </div>
</div>
<div class="container">
    <div id="content">
        <div id='idmain' style="display:block;"> <!-- Главная страница -->
        <h2>Структура базы данных Books</h2>
            <img src="images/base.png" alt="Структура базы данных Books">
            <p><ol>
            <li>Таблица <b>Customers</b> - Клиенты</li>
            <li>Таблица <b>Order_Items</b> - Заказ</li>
            <li>Таблица <b>Customers</b> - Заказано экземпляров</li>
            <li>Таблица <b>Books</b> - Книги</li>
            <li>Таблица <b>Books_Reviews</b> - Рецензии книг</li>
        </ol></p>
    </div> <!-- end idmain -->
    <?php
        if(isset($_SESSION['valid_user'])){
            echo "<script>load(1);</script>"
    ?>
    <div id='idbook' style="display:none;"><!-- Добавить книгу -->
        <h2>Добавить книгу в базу данных Books</h2>
        <?php include 'inc/newbook.php'; ?>
    </div><!-- end idbook -->
    <div id='idsearch' style="display:none;"><!-- Найти книгу -->
        <h2>Найти книгу из базы данных Books</h2>
        <?php include 'inc/searchbook.php'; ?>
    </div><!-- end idsearch -->
    <div id='idbooks' style="display:none;"><!-- Вывести список -->
        <h2>Список книг</h2>
        <?php include 'inc/booklist.php'; ?>
    </div><!-- end list -->
</div><!-- end content -->
<?php
    }else{echo "<script>load(0);</script>";}
?>
</div><!-- end container  -->
<div id="footer"> Copyright 2023 Колледж АлтГУ</div>
<script src="js/auth.js"></script>
</body>
</html>