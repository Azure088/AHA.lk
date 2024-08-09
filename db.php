<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "campusdatabase";


$path = new mysqli($servername, $username, $password, $dbname);

if ($path->connect_error) {
    die("Connection failed: " . $path->connect_error);
}


$path->set_charset("utf8");



?>
