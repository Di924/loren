<?php
print <<<_FORM_
    <h3>Пожалуйста, введите своё имя пользователя и пароль</h3>
    <form method="post" action="secret.php">
    <table border="1">
    <tr>
        <th> Имя пользователя </th>
        <td> <input type="text" name="name" required placeholder="Логин"> </td>
    </tr>
    <tr>
        <th> Пароль </th>
        <td> <input type="password" name="password" required > </td>
    </tr>
    <tr>
        <td colspan = "2" align="center">
            <input type="submit" value="Войти">
        </td>
    </tr>
    </table>
    </form>
_FORM_;
?>