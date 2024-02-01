<?php
    $isbn = htmlspecialchars($_POST['id']);
    $author = htmlspecialchars($_POST['author']);
    $title = htmlspecialchars($_POST['title']);
    $price = $_POST['price'];
    if(!get_magic_quotes_gpc()){
        $isbn = addslashes($isbn);
        $author = addslashes($author);
        $title = addslashes($title);
        $price = addslashes($price);
    }
    if(!$isbn || !$author || !$title || !$price){
        echo 'Вы ввели не все необходимсые сведения.</br>';
        echo 'Пожалуйста, вернитесь на предыдущую страницу.</br>';
        exit;
    }
    try{
        $conn = new PDO("mysql:host=localhost;dbname=db_books","root","", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "INSERT INTO books (id,author,title,price) VALUES ('$isbn','$author','$title','$price')";
        $affectedRowsNumber = $conn->exec($sql);
        if($affectedRowsNumber > 0){
            echo "Данные записаны!";
            $conn = null;
        }
    }
    catch (PDOException $e){
        echo "Database error".$e->getMessage();
    }
?>