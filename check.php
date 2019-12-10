<?php
include("db.php");
session_start();

function Fix($str, $conn) {
    $str = trim($str);
    if(get_magic_quotes_gpc()) {
        $str = stripslashes($str);
    }
    return mysqli_real_escape_string($conn,$str);
}

$errmsg = array();

$errflag = false;

$login = Fix($_POST['login'],$conn);
$password = Fix($_POST['password'],$conn);

if($login == '') {
    $errmsg[] = 'Login missing';
    $errflag = true;
}

if($password == '') {
    $errmsg[] = 'Password missing';
    $errflag = true;
}

if($errflag) {
    $_SESSION['ERRMSG'] = $errmsg;
    session_write_close();
    header("location: login.php");
    exit();
}

$query = "SELECT * FROM `user_auth` WHERE `login` = '$login' AND `password` = '" . md5($password) . "'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 1) {
    while($row = mysqli_fetch_assoc($result)) {
        $_SESSION['UID'] = $row['uid'];
        $_SESSION['LOGIN'] = $login;
        session_write_close();
        header("location: member.php");
    }
} else {
    $_SESSION['ERRMSG'] = "Invalid login or password";
    session_write_close();
    header("location: login.php");
    exit();
}
?>