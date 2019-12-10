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
    <title>Регистрация</title>
</head>
<body>
<form action='reg.php' method='post'>
    <table align="center">
        <tr>
            <td><?php echo $err; ?></td>
        </tr>
        <tr>
            <td>Login</td>
            <td><input type='text' name='login'></td>
        </tr>
        <tr>
            <td>Полное имя</td>
            <td><input type='text' name='full_name'></td>
        </tr>
        <tr>
            <td>E-mail</td>
            <td><input type='text' name='email'></td>
        </tr>
        <tr>
            <td>Пароль</td>
            <td><input type='password' name='password'></td>
        </tr>
        <tr>
            <td>Повтор пароля</td>
            <td><input type='password' name='r_password'></td>
        </tr>
        <tr>
            <td><input type='submit' value='Зарегистрировать'></td>
            <td><a href="login.php">У меня есть аккаунт</a></td>
        </tr>
    </table>
</form>
</body>
</html>