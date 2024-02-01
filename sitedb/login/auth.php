<?php
    @ session_start();
    if (isset($_POST['userid']) && isset($_POST['password'])) {
        //Аутентификация (попытка)
        $userid = $_POST['userid'];
        $password = sha1($_POST['password']);
        $mysql = new mysqli('localhost','root','','auth');
        if (mysqli_connect_errno()) {
            echo 'Невозможно подключиться к базе данных: '.mysqli_connect_error();
            exit();
        }
        $query = "select count(*) from authorised_users where name = '$userid' and password = '$password'";
        //возвращает набор результатов "ОбъектБД,Запрос"
        $result = mysqli_query($mysql, $query);
        if(!$result) {
            echo 'Ошибка: Невозможно выполнить запрос.';
            exit;
        }
        //Получение строки результирующей таблицы в виде массива
        $row = mysqli_fetch_row($result);
        $count = $row[0]; //читаем первую строку, если Имя и Пароль совпали
        if ($count > 0) {
            // Если пользователь найден в базе данных, регистрируем его идентификатор
            $_SESSION['valid_user'] = strval($userid);
        }
        $mysql->close();
    } //end isset
    if (isset($_SESSION['valid_user'])) {
        //редирект
        header("Location: http://".$_SERVER['HTTP_HOST']."/sitedb/index.php");
        exit();
    }else{
        if (isset($userid)) {
            // Была предпринята неудачная попытка зарегистрироваться
            echo 'Указан неверный Логин или Пароль.<br />';
            echo "<p><a href='../'>На главную</a></p>";
        }else {
            // Форма для входа в систему
            include "form.inc";
        }
    } //end else
?>