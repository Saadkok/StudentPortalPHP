<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "login-register";

// Establish database connection
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Return the connection object
return $conn;
?>
