<?php

require_once('../lib/Db.php');
use lib\Db;
$db = new Db;

$sqlQueries = [
    'insert' => [
        'users' => "INSERT INTO `loren`.`users` (`name`, `login`, `password`, `roleID`) VALUES (:name, :login, :password, :roleId)",
        //'shift' => "INSERT INTO `loren`.`shift` (`createDate`, `openDate`, `closeDate`) VALUES (now(), :openDate, :closeDate)",
        // 'orders' => "INSERT INTO `loren`.`orders` (`time`, `tableId`, `staffId`) VALUES (CURTIME(), :tableId, :staffId)",
        //'menu' => "INSERT INTO `loren`.`menu` (`category`, `name`, `price`) VALUES (:category, :name, :price)",
        'roles' => "INSERT INTO `loren`.`roles` (`roleName`) VALUES (:roleName)",
        //'position' => "INSERT INTO `loren`.`roles` (`roleName`) VALUES (:roleName)",
    ],
    'update' => [
        'users' => "UPDATE `loren`.`users` SET `name` = COALESCE(:lname, `lname`), `login` = COALESCE(:login, `login`), `password` = COALESCE(:password, `password`), `roleID` = COALESCE(:roleId, `roleId`) WHERE `id` = :id",
        //'shift' => "UPDATE `loren`.`shift` SET `openDate` = COALESCE(:openDate, `openDate`), `closeDate` = COALESCE(:closeDate, `closeDate`) WHERE `id` = :id",
        //'orders' => "UPDATE `loren`.`orders` SET `tableId` = COALESCE(:tableId, `tableId`), `staffId` = COALESCE(:staffId, `staffId`) WHERE `id` = :id",
        //'menu' => "UPDATE `loren`.`menu` SET `category` = COALESCE(:category, `category`), `name` = COALESCE(:name, `name`), `price` = COALESCE(:price, `price`) WHERE `id` = :id",
        'roles' => "UPDATE `loren`.`roles` SET `roleName` = COALESCE(:roleName, `roleName`) WHERE `id` = :id",
    ],
];

function isEmpty($value)
{
    return empty($value) && $value != 0;
}

$formName = $_POST['formName'] ?? null;
$insert = $_POST['insert'] ?? null;
$update = $_POST['update'] ?? null;
$delete = $_POST['delete'] ?? null;

if (!$delete){

    $params = [];
    $sql = '';

    if ($insert){
        $sql = $sqlQueries['insert'];
    } elseif ($update){
        $sql = $sqlQueries['update'];
        $params = ["id" => $update];
    }

    $fields = [
        'users' => ["name", "login", "password",  "roleID"],
        'orders' => ["tableId", "staffId"],
        'menu' => ["category", "name", "price"],
        'roles' => ["roleName"],
        'position' => ["orderId", "value", "menuId"],
    ];

    foreach ($fields[$formName] as $field) {
        if (isset($_POST[$field])){
            $params[$field] = isEmpty($_POST[$field]) ? null : $_POST[$field];
        }
    }

    $db->row($sql[$formName], $params);
} elseif ($formName && !$update && $delete){
    $db->row("DELETE FROM `loren`.`{$formName}` WHERE `id` = :id", ["id" => $delete]);
}

header("Location: /php/tables.php");

?>
