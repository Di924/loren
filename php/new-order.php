<!-- при нажатии на кнопку добавить открывается эта страница -->
<!-- в ней выпадающие списки - по категориям из меню -->
<!-- в каждой строке есть кнопки + и - и счетчик -->
<!-- в верху кнопка готово, по нажатию на которую получаются выбраные строки из меню и их количество -->
<!-- эти строки записываются в таблицу position -->
<!-- 1 строка 1 блюдо меню и количество -->


<?php
    session_start();
    
    require_once('../lib/Db.php');
    use lib\Db;
    $db = new Db;

    $results = [
        'menu' => $db->row("SELECT * FROM `loren`.`menu` ORDER BY id ASC"),
    ];
    $results += [
        'menuCount' => count($results['menu']),
    ];
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
                    <div class="table">
                        <div class="table-header menu-orders-table">
                            <div>ID</div>
                            <div>Категория</div>
                            <div>Название</div>
                            <div>Цена</div>
                            <div><button onclick="AddOrder();"> Готово</button></div><!-- такой функции пока нет, может и не будет -->
                            <div>Статус</div>
                        </div>
                        <div class="table-body menu-orders-table" id="menu-table-body">
                            <?php
                                for ($i = 0; $i < $results['menuCount']; $i++){
                                    $row = $results['menu'][$i];
                                    echo "<form action='/handlers/tablesHandler.php' method='POST'>
                                            <input type='hidden' name='formName' value='position'>
                                            <div>{$row['id']}</div>
                                            <div>{$row['category']}</div>
                                            <div>{$row['name']}</div>
                                            <div>{$row['price']}</div>
                                            <div>" . PHPInputBox("<input type='number' name='tableId' placeholder=' ' autocomplete='off'>", "0") . "</div>
                                            <div><button type='submit' name='insert' value='true'>Зап.</button></div>
                                        </form>";
                                }
                            ?>
                        </div>
                    </div>
    <script src="/js/staff.js"></script>
    <script src="/js/tabs.js"></script>
</body>
</html>