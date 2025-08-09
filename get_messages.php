<?php
require 'db.php';

$result = $conn->query("SELECT messages.message, messages.timestamp, users.username 
                        FROM messages 
                        JOIN users ON messages.user_id = users.id 
                        ORDER BY messages.timestamp DESC LIMIT 50");

while ($row = $result->fetch_assoc()) {
    echo "<p><strong>" . htmlspecialchars($row['username']) . "</strong>: " . 
         htmlspecialchars($row['message']) . " <em>(" . $row['timestamp'] . ")</em></p>";
}
?>