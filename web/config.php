<?php
// Database connection parameters
$host = "localhost";
$username = "root";
$password = "";
$database = "quanlysinhvien";

// Create a connection
$connection = new mysqli($host, $username, $password, $database);

// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
 // You can remove this line in a production environment.
?>