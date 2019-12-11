<?php
include("db.php");
session_start();

function Fix($str,$connect) {
    $str = @trim($str);
    $str = addslashes($str);
    return mysqli_real_escape_string($connect, $str);
}

$errmsg = array();

$errflag = false;

$UID = "34534514";
$login = Fix($_POST['login'],$conn);
$email = $_POST['email'];
$password = Fix($_POST['password'],$conn);
$r_password = Fix($_POST['r_password'],$conn);

if($login == '') {
    $errmsg[] = 'Login missing';
    $errflag = true;
}

if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)) {
    $errmsg[] = 'Invalid Email';
    $errflag = true;
}

if($password == '') {
    $errmsg[] = 'Password missing';
    $errflag = true;
}

if($r_password == '') {
    $errmsg[] = 'Repeated password missing';
    $errflag = true;
}

if(strcmp($password, $r_password) != 0 ) {
    $errmsg[] = 'Passwords do not match';
    $errflag = true;
}

if($login != '') {
    $qry = "SELECT * FROM `user_auth` WHERE `login` = '$login'";
    $result = mysqli_query($conn,$qry);
    if($result) {
        if(mysqli_num_rows($result) > 0) {
            $errmsg[] = 'Login already used';
            $errflag = true;
        }
        mysqli_free_result($result);
    }
}

if($errflag) {
    $_SESSION['ERRMSG'] = $errmsg;
    session_write_close();
    header("location: register.php");
    exit();
}

$qry = "INSERT INTO `php_task`.`user_auth`(`uid`, `login`, `password`) VALUES('$UID','$login','" . md5($password) . "')";
$result = mysqli_query($conn,$qry);

if($result) {
    echo "Welcome , " .$login . ". Click this <a href=\"login.php\">link</a>";
    exit();
} else {
    die("Error, try later".mysqli_error($conn));
}
?>
