<?php

$server = "localhost";
$user = "root";
$password = "";

$conn = mysqli_connect($server, $user, $password);
$db = mysqli_select_db($conn, "php_task");

if(!$db) {
    echo "Ошибка: ".mysqli_error($conn);
    exit();
}

?>