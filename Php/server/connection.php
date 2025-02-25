<?php

// Database connection

$host = "localhost";
$user = "root";
$password = "";
$database = "php_project";

// Connect using MySQLi
$conn = mysqli_connect($host, $user, $password, $database);

// Check if the connection is successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>