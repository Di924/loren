<?php
    session_start();
    
    require_once('../lib/Db.php');
    use lib\Db;
    $db = new Db;

    $params = [
        'login' => $_POST['login'],
        'password' => $_POST['password']
    ];

    $result = $db->row("SELECT * FROM `loren`.`users` WHERE `login` = :login AND `password` = :password", $params);
    $params = [
        'roleId' => $result[0]['roleID']
    ];
    if ($result) {
        $result2 = $db->row("SELECT * FROM `loren`.`roles` WHERE `roles`.`id` = :roleId", $params);

        $_SESSION['user'] = [
            'id' => $result[0]['id'],
            'name' => $result[0]['name'],
            'login' => $result[0]['login'],
            'password' => $result[0]['password'],
            'roleId' => $result2[0]['roleName'],
        ];
        header('Location: http://'.$_SERVER["HTTP_HOST"].'/php/choice.php');
        exit;
    }

    header('Location: http://'.$_SERVER["HTTP_HOST"].'/php/sign-in.php');
    exit;
?>