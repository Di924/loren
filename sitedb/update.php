
<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_books";

// $conn = mysqli_connect($servername, $username, $password, $dbname);
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Получение данных из формы
$id = $_POST['id'];
$author = $_POST['author'];
$title = $_POST['title'];
$price = $_POST['price'];

// Обновление данных
// $sql = "UPDATE `books` SET (`author` = $author, `title` = $title, `price` = $price) VALUES () WHERE `id` = $id";
$sql = "UPDATE `books` SET `author` = " . mysqli_real_escape_string($conn, $author) . "`title` = " . mysqli_real_escape_string($conn, $title) . ", `price` = " . mysqli_real_escape_string($conn, $price) . " WHERE `books`.`id` = " . mysqli_real_escape_string($conn, $id);




if (mysqli_query($conn, $sql)) {
  echo "Данные успешно обновлены";
} else {
  echo "Ошибка при обновлении данных: " . mysqli_error($conn);
}

// Закрытие соединения
mysqli_close($conn);
?>