<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chatbox</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
    <div id="chat-box"></div>

    <form id="chat-form">
        <input type="text" id="message" placeholder="Type a message..." autocomplete="off">
        <button type="submit">Send</button>
    </form>

    <a href="logout.php">Logout</a>

    <script>
        function loadMessages() {
            fetch('get_messages.php')
                .then(res => res.text())
                .then(data => {
                    document.getElementById('chat-box').innerHTML = data;
                });
        }

        document.getElementById('chat-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const msg = document.getElementById('message').value;
            fetch('send_message.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'message=' + encodeURIComponent(msg)
            }).then(() => {
                document.getElementById('message').value = '';
                loadMessages();
            });
        });

        setInterval(loadMessages, 1000);
        loadMessages();
    </script>
</body>
</html>