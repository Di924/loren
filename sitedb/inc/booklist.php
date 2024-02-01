
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        @ $db = new mysqli('localhost','root','','db_books');
        if(mysqli_connect_errno()){
            echo 'Ошибка: Не удалось установить соединение с базой данных. Пожалуйста, повторите попытку позже.';
            exit;
        }
        mysqli_set_charset($db,'utf8');
        $query = "SELECT * FROM `books` ORDER BY price ASC";
        $result = $db->query($query);
        $num_results = $result->num_rows;
        echo '<p>'.'Количество книг:'.$num_results.'</p>';
    ?>
    <table class="pricetable">
        <thead>
            <tr>
                <th>ISBN</th>
                <th>Автор</th>
                <th>Название</th>
                <th>Цена,руб.</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                header("Location: edit.php?id=$id");
              }
                for ($i = 0;$i < $num_results; $i++){
                    $row = $result->fetch_assoc();
                    $as = $row['id'];
                    $id = $row['id'];
                    echo '<tr><td>'.stripslashes($row['id']).'</td>';
                    echo '<td>'.stripslashes($row['author']).'</td>';
                    echo '<td>'.htmlspecialchars(stripslashes($row['title'])).'</td>';
                    echo '<td>'.stripslashes($row['price']).'</td>';
                    echo '<td><a href="delete.php?id='.$as.'" name='.$as.'>Удалить</a></td>';
                    echo '<td><a href="edit.php?id='.$id.'" name='.$id.'>Редактировать</a></td></tr>';
                }
                $result->free();
                $db->close()
            ?>
        </tbody>
    </table>
</body>
</html>