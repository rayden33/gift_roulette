<?php
session_start();
if(isset($_SESSION['ERRMSG']) &&is_array($_SESSION['ERRMSG']) &&count($_SESSION['ERRMSG']) >0 ) {
    $err = "<table>";
    foreach($_SESSION['ERRMSG'] as $msg) {
        $err .= "<tr><td>" . $msg . "</td></tr>";
    }
    $err .= "</table>";
    unset($_SESSION['ERRMSG']);
}
?>
<html>
<head>
    <title>Форма входа</title>
</head>
<body>
<form action='check.php' method='post'>
    <table align="center">
        <tr>
            <td><?php echo $err; ?></td>
        </tr>
        <tr>
            <td>Логин</td>
            <td><input type='text' name='login'></td>
        </tr>
        <tr>
            <td>Пароль</td>
            <td><input type='password'name='password'></td>
        </tr>
        <tr>
            <td><input type='submit'value='Войти'></td>
            <td><a href="register.php">Регистрация</a></td>
        </tr>
    </table>
</form>
</body>
</html>