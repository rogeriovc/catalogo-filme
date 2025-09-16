<?php

$host = "localhost";
$port= "3306";
$dbName = "filmesdb";
$user="root";
$pass="";

$connUrl = "mysql:host=$host;port=$port;dbname=$dbName;charset=utf8mb4";

$pdo = new PDO($connUrl, $user, $pass);
