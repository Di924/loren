<?php
@ $db = new mysqli('localhost','root','','db_books');
if(mysqli_connect_errno()){
    echo 'Ошибка: Не удалось установить соединение с базой данных. Пожалуйста, повторите попытку позже.';
    exit;
}
mysqli_set_charset($db,'utf8');
$id = $_GET['id'];
$query = "DELETE FROM `books` WHERE `id` = '$id'";
$result = $db->query($query);
header("Location: /sitedb/");
?>