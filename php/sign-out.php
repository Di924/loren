<!DOCTYPE html>
<html lang="ru">
<head>
    <?php include("../templates/head.php") ?>
    <title>Document</title>
</head>
<body>
<?php
    // session_destroy();
    unset($_SESSION['user']);
    echo 'Обработка запроса...';
    echo '<a class="nav-scroll_item" href="../index.php">На главную</a>';
?>
</body>
</html>