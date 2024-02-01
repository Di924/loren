<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_books";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Проверка соединения
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Получение идентификатора записи
$id = $_GET['id'];

// Получение данных из базы данных
$sql = "SELECT * FROM books WHERE id = $id";
$result = mysqli_query($conn, $sql);

  // echo '<br><br>';
  // var_dump($result);

if ($result) {
  // Отображение формы редактирования
  $row = mysqli_fetch_assoc($result);
  $id = $row['id'];
  $author = $row['author'];
  $title = $row['title'];
  $price = $row['price'];
?>
    <form action="update.php" method="post">
      <input type="hidden" name="id" value="<?php echo $id; ?>"> 
      <label>Автор:</label>
      <input type="text" name="author" value="<?php echo $author; ?>"><br>
      <label>Название:</label>
      <input type="text" name="title" value="<?php echo $title; ?>"><br>
      <label>Цена:</label>
      <input type="text" name="price" value="<?php echo $price; ?>"><br>
      <input type="submit" value="Сохранить">
    </form>
<?php 
} else {
  echo "Запись не найдена";
}

// Закрытие соединения
mysqli_close($conn);
?>


