<?php
    session_start();
    
    require_once('../lib/Db.php');
    use lib\Db;
    $db = new Db;

    $results = [
        'orders' => $db->row("SELECT * FROM `loren`.`orders` WHERE `staffId` = :id", ['id' => $_SESSION['user']['id']]),
    ];

    $results['ordersCount'] = count($results['orders']);
    
    function PHPInputBox($input, $labelName)
    {
        return '<div class="input-box">
            ' . $input . '
            <label>' . $labelName . '</label>
        </div>';
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
            <?php echo '<p>Отображается количество строк: ' . $results['ordersCount'] . '</p>'; ?>
            <div class="table">
                <div class="table-header orders-table">
                    <div>ID</div>
                    <div>Зарегистрирован в</div>
                    <div>ID стола</div>
                    <div><button onclick="AddTR('orders-table-body',
                                                '<input type=\'hidden\' name=\'formName\' value=\'orders\'>',
                                                '<div>ID</div>',
                                                '<div>Время</div>',
                                                InputBox('<input type=\'number\' name=\'tableId\' placeholder=\' \'>', 'ID стола'),
                                                '<div><button type=`submit` name=\'insert\' value=\'true\'>Зап.</button><button onclick=\'this.parentNode.parentNode.remove();\'>Уд.</button></div>'
                                            ); this.setAttribute('disabled', 'disabled');">Добавить</button>
                    </div>
                </div>
                <div class="table-body orders-table" id="orders-table-body">
                    <?php
                        for ($i = 0;$i < $results['ordersCount']; $i++){
                            $row = $results['orders'][$i];
                            echo '<form action="/handlers/tablesHandler.php" method="POST">
                                    <input type="hidden" name="formName" value="orders">
                                    <div>' . $row['id'] . '</div>
                                    <div>' . $row['time'] . '</div>
                                    ' . PHPInputBox("<input type='number' name='tableId' placeholder=' '>", $row['tableId']) . '
                                    <div>
                                        <button type="submit" name="update" value="' . $row['id'] . '">Из.</button>
                                        <button type="submit" name="delete" value="' . $row['id'] . '">Уд.</button>
                                    </div>
                                </form>';
                        }
                    ?>
                </div>
            </div>
            </div>
        </main>
    </div>
    <script src="/js/staff.js"></script>
    <script src="/js/tabs.js"></script>
</body>
</html>