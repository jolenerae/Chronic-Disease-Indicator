<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "chronic_disease_indicator";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Retrieve username from session
$username = $_SESSION["username"];

// Delete user account from the database
$sql = "DELETE FROM user WHERE Username='$username'";
if ($conn->query($sql) === TRUE) {
    // Account deleted successfully, redirect to login page
    session_destroy(); // Destroy session
    header("Location: Login.php");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

// Close connection
$conn->close();
?>
