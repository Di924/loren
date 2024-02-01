<?php
    if(!isset($_POST['name']) && !isset($_POST['password'])) {
        include "form.php";
    } else {
        $name = $_POST['name'];
        $password = sha1($_POST['password']);
        $mysql = new mysqli('localhost', 'root', '', 'auth');
        if (mysqli_connect_errno()) {
            echo 'Ошибка: Не удалось установить соединение с базой данных';
            exit;    
        }
        $selected = mysqli_select_db( $mysql, 'auth' );
        if(!mysql) {
            echo 'Ошибка: Неввозможно выбрать базу данных.';
            exit;
        }
        $query = "select count(*) from authorised_users where
                 name = '$name' and
                 password = '$password'";
        $result = mysqli_query($mysql,$query);
        if(!result) {
            echo 'Ошибка: Невозможно выполнить запрос.';
            exit;
        }
        $row = mysqli_fetch_row($result);
        $count = $row[0];
        if ($count > 0) {
            echo '<h1>Вход выполнен!</h1>';
            echo 'Секретный ресурс доступен.';
        } else {
            echo '<h1>Вход не выполнен :)</h1>';
            echo 'Вам не разрешино просматривать данный ресурс';
        }
    }
?>