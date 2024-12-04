<?php

$server = "localhost";
$user = "root";
$pass = "";
$database = "fruteria";
$conex = new PDO("mysql:host=".$server.";dbname=".$database,$user,$pass);
?>