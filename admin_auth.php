<?php
include("db.php");
session_start();

function Destroy() {
    unset($_SESSION['UID']);
    unset($_SESSION['LOGIN']);
    header("location: index.php");
}

if(isset($_SESSION['UID']) && isset($_SESSION['LOGIN'])) {
    $UID = $_SESSION['UID'];
    $login = $_SESSION['LOGIN'];
    $query = mysqli_query($conn,"SELECT * FROM `user_auth` WHERE `uid` = '$UID' AND `login` = '$login' AND `is_admin` = 'Y'");
    if(mysqli_num_rows($query) != 1) { Destroy(); }
} else{ Destroy(); }
?>