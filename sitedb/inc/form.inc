<?php
print <<<_HTML_
<form action="inc/newbook.php" method="post">
    <table borde="0">
        <tr>
            <td>ISBN</td>
            <td><input type="text" name="id" maxlength="13" size="13"></td>
        </tr>
        <tr>
            <td>Автор</td>
            <td><input type="text" name="author" maxlength="30" size="30"></td>
        </tr>
        <tr>
            <td>Название</td>
            <td><input type="text" name="title" maxlength="60" size="50"></td>
        </tr>
        <tr>
            <td>Цена, руб.</td>
            <td><input type="text" name="price" maxlength="7" size="7" patter="\d+(\.\d{2})?"></td>
        </tr>
        <tr>
            <td colspan="2" align="right"><br><input type="submit" value="Зарегистрировать"></td>
        </tr>
    </table>
</form>
_HTML_;
?>