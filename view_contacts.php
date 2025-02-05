<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "user_data";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM contacts ORDER BY submitted_at DESC";
$result = $conn->query($sql);

echo "<h2>Submitted Messages</h2>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p><strong>Name:</strong> " . $row["name"] . "<br>";
        echo "<strong>Email:</strong> " . $row["email"] . "<br>";
        echo "<strong>Subject:</strong> " . $row["subject"] . "<br>";
        echo "<strong>Message:</strong> " . $row["message"] . "<br>";
        echo "<strong>Submitted At:</strong> " . $row["submitted_at"] . "</p><hr>";
    }
} else {
    echo "No messages yet.";
}

$conn->close();
?>
