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
$code= $_SESSION['usercode']; 
$sql = "SELECT Title FROM admin WHERE Code= $code";
$result = $conn->query($sql);
if (!$result) {
    die("Query failed: " . $conn->error);
}
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title= $row["Title"];
    $data = array("Title" => $title);

} else {
    echo "No results found";
}
echo json_encode($data);
// Close the database connection
$conn->close();
?>
