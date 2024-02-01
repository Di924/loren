<?php
print <<<_HTML_
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
_HTML_;
?>