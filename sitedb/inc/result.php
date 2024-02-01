<?php
$searchtype = $_POST['searchtype'];
$searchterm = $_POST['searchterm'];
$searchterm = trim($searchterm);
if(!$searchtype || !$searchterm){
    echo 'Вы не ввели параметры поиска. Пожалуйста, вернитесь на пердыдущую страницу и повторите ввод.';
    exit;
}
if (!get_magic_quotes_gpc()){
    $searchterm = addslashes($searchterm);
    $searchtype = addslashes($searchtype);
}
@ $db = new mysqli('localhost','root','','db_books');
if(mysqli_connect_errno()){
    echo 'Ошибка: Не удалось установить соединение с базой данных. Пожалуйста, повторите попытку позже.';
    exit;
}
mysqli_connect_errno($db, 'utf8');
include 'result_html.php'
?>