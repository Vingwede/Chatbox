<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    if ($username) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            $stmt = $conn->prepare("INSERT INTO users (username) VALUES (?)");
            $stmt->bind_param("s", $username);
            $stmt->execute();
        }

        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($user_id);
        $stmt->fetch();

        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        header("Location: chat.php");
        exit;
    }
}
?>

<form method="POST">
    <input type="text" name="username" placeholder="Enter username" required>
    <button type="submit">Login</button>
</form>