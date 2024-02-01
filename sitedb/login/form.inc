<?php
    echo '<form name="auth_form" method="post" action="login/auth.php">';
    echo '<table>';
    echo '<tr><td><p>Имя:</p></td><br>';
    echo '<td><input type="text" name="userid" required><td></tr>';
    echo '<tr><td><p>Пароль:</p></td>';
    echo '<td><input type="password" value="" name="password" required></td></tr>';
    echo '<tr><td colspan="2" align="center"><br>';
    echo '<input type="submit" value="Вход"></tr></tr>';
    echo '</table></form>';
?>