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
$sql = "SELECT Title FROM admin WHERE Code=$code";

$result = $conn->query($sql);

// Check if a result was found
if ($result->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();

    // Get the title
    $data = $row["Title"];
} else {
    // Handle the case when no data is found
    $data = "Default Title"; // You can set a default title if needed
}
$tableName = "table_" . $code;
$_SESSION['tablename'] = $tableName; 
$tablename = "table" . $code;
$_SESSION['tableName'] = $tablename; 
$sql = "SELECT * FROM $tableName";
$result = $conn->query($sql);
$data =[];
if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
echo json_encode($data);

// Close the database connection
$conn->close();
?>
