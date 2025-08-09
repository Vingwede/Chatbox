<?php
$host = 'localhost';
$db   = 'chatbox';
$user = 'root';
$pass = 'nkh0m@1t'; // Change if needed

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
