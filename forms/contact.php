<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Database connection details
$host = "localhost"; // Change if your database is hosted remotely
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password (leave empty if using XAMPP default)
$dbname = "user_database"; // The database you created
$port = 3307; // Ensure this matches the MySQL port in XAMPP

// Connect to MySQL database
$conn = new mysqli($host, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        echo "<div style='color: green; font-weight: bold;'>Your message has been sent successfully!</div>";
    } else {
        echo "<div style='color: red; font-weight: bold;'>Error: " . $stmt->error . "</div>";
    }
    

    // Close the statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>
