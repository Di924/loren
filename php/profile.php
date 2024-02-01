<?php
    session_start();
    
    require_once('../lib/Db.php');
    use lib\Db;
    $db = new Db;

    // $RId = $db->row("SELECT `roleName` FROM `loren`.`roles` WHERE `id` = :id", ['id' => $_SESSION['user']['roleId']]);
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
                    <div class="info_block">
                        <div class="info_text_block">
                            <div class="info_text_block_push">
                                ФИО
                            </div>
                            <div class="info_text_block_pull">
                            <?php echo $_SESSION['user']['name']; ?> 
                            </div>
                        </div>
                        <div class="info_text_block">
                            <div class="info_text_block_push">
                                роль
                            </div>
                            <div class="info_text_block_pull">
                            <?php echo $_SESSION['user']['roleId']; ?> 
                            </div>
                        </div>
                        <div class="info_text_block">
                            <div class="info_text_block_push">
                                Почта
                            </div>
                            <div class="info_text_block_pull">
                            <?php echo $_SESSION['user']['login']; ?> 
                            </div>
                        </div>
                        
                        <div class="profile_block_schedule">
                            <div class="profile_schedule">
                                <a href="../index.php"><button type="submit">Перейти к каталогу</button></a>
                                <a href="sign-in.php"><button type="submit">Выйти из профиля</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>


</body>
</html>