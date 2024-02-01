<?php
if (isset($_POST['id']) || isset($_POST['author']) || isset($_POST['title']) || isset($_POST['price'])){
    include 'addbase.php';
}else {
    include 'form.inc';
}
?>