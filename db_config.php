<?php
$host = "localhost"; // e.g., localhost
$username = "root";
$password = "";
$database = "vanet";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
