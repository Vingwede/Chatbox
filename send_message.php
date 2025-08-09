<?php
session_start();
require 'db.php';

if (isset($_SESSION['user_id']) && isset($_POST['message'])) {
    $user_id = $_SESSION['user_id'];
    $message = trim($_POST['message']);

    if ($message !== '') {
        $stmt = $conn->prepare("INSERT INTO messages (user_id, message) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $message);
        $stmt->execute();
    }
}
?>