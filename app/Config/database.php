<?php

$dbHost = "localhost";
$dbName = "bd_prueba";
$dbUser = "root";
$dbPassword = "";

global $dbHost, $dbName, $dbUser, $dbPassword;

$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

return $conn;