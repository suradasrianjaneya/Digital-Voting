<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "RealmeC20";
$dbname = "project";

// Create a new mysqli connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Get the VoterId from the session
$code = $_SESSION['code'];

// Use a prepared statement to fetch data
$stmt = $conn->prepare("SELECT * FROM admin WHERE Code = ?");
$stmt->bind_param("s", $code);
$stmt->execute();

$result = $stmt->get_result();
$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close the prepared statement
$stmt->close();

// Close the database connection
$conn->close();

// Send the data as JSON response
header('Content-Type: application/json');
echo json_encode($data);
?>
