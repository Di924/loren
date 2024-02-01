<?php
    session_start();

    require_once('../lib/Db.php');
    use lib\Db;
    $db = new Db;

    $results = [
        'users' => $db->row("SELECT * FROM `loren`.`users` ORDER BY id ASC"),
        'shift' => $db->row("SELECT * FROM `loren`.`shift` ORDER BY id DESC LIMIT 31"),
        'orders' => $db->row("SELECT * FROM `loren`.`orders` ORDER BY id ASC LIMIT 100"),
        'menu' => $db->row("SELECT * FROM `loren`.`menu` ORDER BY id ASC"),
        'roles' => $db->row("SELECT * FROM `loren`.`roles` ORDER BY id ASC"),
        'categories' => $db->row("SELECT DISTINCT `category` FROM `loren`.`menu`"),
        'waiter' => $db->row("SELECT * FROM `loren`.`staff` WHERE `roleId` = 1 OR `roleId` = 2 ORDER BY id ASC"),
    ];

    $results += [
        'staffCount' => count($results['users']),
        'shiftCount' => count($results['shift']),
        'ordersCount' => count($results['orders']),
        'menuCount' => count($results['menu']),
        'rolesCount' => count($results['roles']),
        'categoriesCount' => count($results['categories']),
        'waiterCount' => count($results['waiter']),
    ];

    function PHPInputBox($input, $labelName)
    {
        return "<div class='input-box'>
            {$input}
            <label>{$labelName}</label>
        </div>";
    }

    function OptionsRoles($roleId = 0)
    {
        global $results;
        $string = "<option label='Должность' value='0' selected></option>";

        foreach ($results['roles'] as $row) {
            $selected = $row['id'] == $roleId ? "selected" : "";
            $string .= "<option label='{$row['roleName']}' value='{$row['id']}' {$selected}></option>";
        }

        return $string;
    }

    function OptionsCategory($category)
    {
        global $results;
        $string = "";

        foreach ($results['categories'] as $row) {
            $selected = $row['category'] == $category ? "selected" : "";
            $string .= "<option label='{$row['category']}' value='{$row['category']}' {$selected}></option>";
        }

        return $string;
    }

    function OptionsStaff($staffId)
    {
        global $results;
        $string = "<option label='Выберите официанта' value='0' selected></option>";

        foreach ($results['waiter'] as $row) {
            $selected = $row['id'] == $staffId ? "selected" : "";
            $string .= "<option label='{$row['lname']} {$row['fname']} {$row['mname']}' value='{$row['id']}' {$selected}></option>";
        }

        return $string;
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <?php include("../templates/head.php") ?>
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <main class="main">
            <div class="main__container container">
                <div class="tab">
                    <button class="tablinks" onclick="openTable(event, 'users')">Персонал</button>
                    <button class="tablinks" onclick="openTable(event, 'shift')">Смены</button>
                    <button class="tablinks" onclick="openTable(event, 'orders')">Заказы</button>
                    <button class="tablinks" onclick="openTable(event, 'menu')">Меню</button>
                    <button class="tablinks" onclick="openTable(event, 'roles')">Должности</button>
                </div>
                
                <div id="users" class="tabcontent">
                    <?php echo "<p>Количество персонала: {$results['staffCount']}</p>"; ?>

                    <div class="table">
                        <div class="table-header staff-table">
                            <div>ID</div>
                            <div>Фамилия</div>
                            <div>Имя</div>
                            <div>Отчество</div>
                            <div>Логин</div>
                            <div>Пароль</div>
                            <div>Фотография</div>
                            <div>Должность</div>
                            <div><button onclick="AddTR(`staff-table-body`,
                                                        `<input type='hidden' name='formName' value='users'>`,
                                                        `<div>ID</div>`,
                                                        InputBox(`<input type='text' name='lname' placeholder=' ' autocomplete='off'>`, 'Фамилия'),
                                                        InputBox(`<input type='text' name='fname' placeholder=' ' autocomplete='off'>`, 'Имя'),
                                                        InputBox(`<input type='text' name='mname' placeholder=' ' autocomplete='off'>`, 'Отчество'),
                                                        InputBox(`<input type='text' name='login' placeholder=' ' autocomplete='off'>`, 'Логин'),
                                                        InputBox(`<input type='password' name='password' placeholder=' ' autocomplete='off'>`, 'Пароль'),
                                                        `<input type='file' name='photoFile' autocomplete='off'>`,
                                                        `<select name='roleId'><option label='Должность' value='0' selected><option label='Администратор' value='1'></option></option><option label='Официант' value='2'></option><option label='Повар' value='3'></option>`,
                                                        `<div><button type='submit' name='insert' value='true'>Зап.</button><button onclick='this.parentNode.parentNode.remove();'>Уд.</button></div>`
                                                    ); this.setAttribute('disabled', 'disabled');">Добавить</button>
                            </div>
                        </div>
                        <div class="table-body staff-table" id="staff-table-body">
                            <?php
                                for ($i = 0; $i < $results['staffCount']; $i++){
                                    $row = $results['users'][$i];
                                    echo "<form action='/handlers/tablesHandler.php' method='POST'>
                                            <input type='hidden' name='formName' value='users'>
                                            <div>{$row['id']}</div>
                                            " . PHPInputBox("<input type='text' name='lname' placeholder=' ' autocomplete='off'>", $row['lname']) . "
                                            " . PHPInputBox("<input type='text' name='fname' placeholder=' ' autocomplete='off'>", $row['fname']) . "
                                            " . PHPInputBox("<input type='text' name='mname' placeholder=' ' autocomplete='off'>", $row['mname']) . "
                                            " . PHPInputBox("<input type='text' name='login' placeholder=' ' autocomplete='off'>", $row['login']) . "
                                            " . PHPInputBox("<input type='password' name='password' placeholder=' ' autocomplete='off'>", $row['password']) . "
                                            " . PHPInputBox("<input type='file' name='photoFile' placeholder=' ' autocomplete='off'>", $row['photoFile']) . "
                                            <select name='roleId'>" . OptionsRoles($row['roleId']) . "</select>
                                            <div>
                                                <button type='submit' name='update' value='{$row['id']}'>Из.</button>
                                                <button type='submit' name='delete' value='{$row['id']}'>Уд.</button>
                                            </div>
                                        </form>";
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <div id="shift" class="tabcontent">
                    <?php echo "<p>Отображается количество строк: {$results['shiftCount']}</p>"; ?>

                    <div class="table">
                        <div class="table-header shift-table">
                            <div>ID</div>
                            <div>Создание смены</div>
                            <div>Начало смены</div>
                            <div>Конец смены</div>
                            <div><button onclick="AddTR(`shift-table-body`,
                                                        `<input type='hidden' name='formName' value='shift'>`,
                                                        `<div>ID</div>`,
                                                        `<div>Дата и время</div>`,
                                                        InputBox(`<input type='datetime-local' name='openDate' placeholder=' ' autocomplete='off'>`, 'Начало смены'),
                                                        InputBox(`<input type='datetime-local' name='closeDate' placeholder=' ' autocomplete='off'>`, 'Конец смены'),
                                                        `<div><button type='submit' name='insert' value='true'>Зап.</button><button onclick='this.parentNode.parentNode.remove();'>Уд.</button></div>`
                                                    ); this.setAttribute('disabled', 'disabled');">Добавить</button>
                            </div>
                        </div>
                        <div class="table-body shift-table" id="shift-table-body">
                            <?php
                                for ($i = 0; $i < $results['shiftCount']; $i++){
                                    $row = $results['shift'][$i];
                                    echo "<form action='/handlers/tablesHandler.php' method='POST'>
                                            <input type='hidden' name='formName' value='shift'>
                                            <div>{$row['id']}</div>
                                            <div>{$row["createDate"]}</div>
                                            " . PHPInputBox("<input type='datetime-local' name='openDate' placeholder=' ' autocomplete='off'>", $row['openDate']) . "
                                            " . PHPInputBox("<input type='datetime-local' name='closeDate' placeholder=' ' autocomplete='off'>", $row['closeDate']) . "
                                            <div>
                                                <button type='submit' name='update' value='{$row['id']}'>Из.</button>
                                                <button type='submit' name='delete' value='{$row['id']}'>Уд.</button>
                                            </div>
                                        </form>";
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <div id="orders" class="tabcontent">
                    <?php echo "<p>Отображается количество строк: {$results['ordersCount']}</p>"; ?>

                    <div class="table">
                        <div class="table-header orders-table">
                            <div>ID</div>
                            <div>Оформлен в</div>
                            <div>Смена</div>
                            <div>Стол</div>
                            <div>Работник</div>
                            <div><button disabled onclick="AddTR(`orders-table-body`,
                                                                `<input type='hidden' name='formName' value='orders'>`,
                                                                `<div>ID</div>`,
                                                                `<div>Время</div>`,
                                                                `<div>Смена</div>`,
                                                                InputBox(`<input type='number' name='tableId' placeholder=' ' autocomplete='off'>`, 'Стол'),
                                                                InputBox(`<input type='number' name='staffId' placeholder=' ' autocomplete='off'>`, 'Работник'),
                                                                `<div><button type='submit' name='insert' value='true'>Зап.</button><button onclick='this.parentNode.parentNode.remove();'>Уд.</button></div>`
                                                            ); this.setAttribute('disabled', 'disabled');">Добавить</button>
                            </div>
                        </div>
                        <div class="table-body orders-table" id="orders-table-body">
                            <?php
                                for ($i = 0; $i < $results['ordersCount']; $i++){
                                    $row = $results['orders'][$i];
                                    echo "<form action='/handlers/tablesHandler.php' method='POST'>
                                            <input type='hidden' name='formName' value='orders'>
                                            <div>{$row['id']}</div>
                                            <div>{$row['time']}</div>
                                            <div>{$row['shiftId']}</div>
                                            " . PHPInputBox("<input type='number' name='tableId' placeholder=' ' autocomplete='off'>", $row['tableId']) . "
                                            <select name='staffId'>" . OptionsStaff($row['staffId']) . "</select>
                                            <div>
                                                <button type='submit' name='update' value='{$row['id']}'>Из.</button>
                                                <button type='submit' name='delete' value='{$row['id']}'>Уд.</button>
                                            </div>
                                        </form>";
                                }   
                            ?>
                        </div>
                    </div>
                </div>

                <div id="menu" class="tabcontent">
                    <?php echo "<p>Отображается количество строк: {$results['menuCount']}</p>"; ?>

                    <div class="table">
                        <div class="table-header menu-table">
                            <div>ID</div>
                            <div>Категория</div>
                            <div>Название</div>
                            <div>Цена</div>
                            <div><button onclick="AddTR(`menu-table-body`,
                                                        `<input type='hidden' name='formName' value='menu'>`,
                                                        `<div>ID</div>`,
                                                        InputBox(`<input type='text' name='category' placeholder=' ' autocomplete='off'>`, 'Категория'),
                                                        InputBox(`<input type='text' name='name' placeholder=' ' autocomplete='off'>`, 'Название'),
                                                        InputBox(`<input type='number' name='price' placeholder=' ' autocomplete='off' min='0'>`, 'Цена'),
                                                        `<div><button type='submit' name='insert' value='true'>Зап.</button><button onclick='this.parentNode.parentNode.remove();'>Уд.</button></div>`
                                                    ); this.setAttribute('disabled', 'disabled');">Добавить</button>
                            </div>
                        </div>
                        <div class="table-body menu-table" id="menu-table-body">
                            <?php
                                for ($i = 0; $i < $results['menuCount']; $i++){
                                    $row = $results['menu'][$i];
                                    echo "<form action='/handlers/tablesHandler.php' method='POST'>
                                            <input type='hidden' name='formName' value='menu'>
                                            <div>{$row['id']}</div>
                                            " . PHPInputBox("<input type='text' name='category' placeholder=' ' autocomplete='off' list='category'>", $row['category']) . "
                                            " . PHPInputBox("<input type='text' name='name' placeholder=' ' autocomplete='off'>", $row['name']) . "
                                            " . PHPInputBox("<input type='number' name='price' placeholder=' ' autocomplete='off' min='0'>", $row['price']) . "
                                            <div>
                                                <button type='submit' name='update' value='{$row['id']}'>Из.</button>
                                                <button type='submit' name='delete' value='{$row['id']}'>Уд.</button>
                                            </div>
                                        </form>";
                                }

                                echo '<datalist id="category">' . OptionsCategory($row['category']) . '</datalist>';
                            ?>
                        </div>
                    </div>
                </div>

                <div id="roles" class="tabcontent">
                    <?php echo "<p>Отображается количество строк: {$results['rolesCount']}</p>"; ?>

                    <div class="table">
                        <div class="table-header roles-table">
                            <div>ID</div>
                            <div>Должность</div>
                            <div><button onclick="AddTR(`roles-table-body`,
                                                        `<input type='hidden' name='formName' value='roles'>`,
                                                        `<div>ID</div>`,
                                                        InputBox(`<input type='text' name='roleName' placeholder=' ' autocomplete='off'>`, 'Должность'),
                                                        `<div><button type='submit' name='insert' value='true'>Зап.</button><button onclick='this.parentNode.parentNode.remove();'>Уд.</button></div>`
                                                    ); this.setAttribute('disabled', 'disabled');">Добавить</button>
                            </div>
                        </div>
                        <div class="table-body roles-table" id="roles-table-body">
                            <?php
                                for ($i = 0; $i < $results['rolesCount']; $i++){
                                    $row = $results['roles'][$i];
                                    echo "<form action='/handlers/tablesHandler.php' method='POST'>
                                            <input type='hidden' name='formName' value='roles'>
                                            <div>{$row['id']}</div>
                                            " . PHPInputBox("<input type='text' name='roleName' placeholder=' ' autocomplete='off'>", $row['roleName']) . "
                                            <div>
                                                <button type='submit' name='update' value='{$row['id']}'>Из.</button>
                                                <button type='submit' name='delete' value='{$row['id']}'>Уд.</button>
                                            </div>
                                        </form>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            <div>
        </main>
    </div>
    <script src="/js/staff.js"></script>
    <script src="/js/tabs.js"></script>
</body>
</html>