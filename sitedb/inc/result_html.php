<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результат поиска</title>
</head>
<body>
    <?php
        $query = "select * from books where ".$searchtype." like '%".$searchterm."%'";
        $result = $db->query($query);
        $num_results = $result->num_rows;
        echo '<p>Найдено книг: '.$num_results.'</p>';
        for ($i=0; $i < $num_results; $i++){
            $row = $result->fetch_assoc();
            echo '<p><strong>'.($i+1).'. Название: ';
            echo htmlspecialchars(stripslashes($row['title']));
            echo '</strong><br>Автор: ';
            echo stripslashes($row['author']);
            echo '<br>ISBN: ';
            echo stripslashes($row['id']);
            echo '<br>Цена: ';
            echo stripslashes($row['price']);
            echo '</p>';
        }
        $result->free();
        $db->close();
    ?>
</body>
</html>