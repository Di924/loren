<?php
print <<<_HTML_
<form action="inc/result.php" method="post">
    Выберите тип поиска:<br>
    <select name="searchtype">
        <option value="author">По автору</option>
        <option value="title">По названию</option>
        <option value="id">По ISBN</option>
    </select>
    <br>
    Введите информацию для поиска:<br>
    <input name="searchterm" type="text" maxlength="30" size="30">
    <br><br>
    <input type="submit" value="Найти">
</form>
_HTML_;
?>