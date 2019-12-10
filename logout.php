<?php
session_start();

unset($_SESSION['UID']);
unset($_SESSION['LOGIN']);
header("location: login.php");
?>