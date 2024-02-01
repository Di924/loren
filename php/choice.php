<?php
    session_start();
    
    require_once('../lib/Db.php');
    use lib\Db;
    $db = new Db;

    function PHPtext($labelName){
        return '<p>' . $labelName . '</p>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("../templates/head.php") ?>
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <main class="main">
            <div class="main__container container">
            <div class="group_block">
                    <div class="photo_block">
                        <div class="profile_img"></div>
                        <div class="info_text"><p>Добро пожаловать</p></div>
                        <div class="info_text">
                            <?php echo $_SESSION['user']['name']; ?> 
                        </div>
                        <div class="choice_block_schedule">
                            <div class="choice_schedule">
                                <a href="../index.php"><button type="submit">Перейти к заказам</button></a>
                                <a href="profile.php"><button type="submit">В профиль</button></a> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>