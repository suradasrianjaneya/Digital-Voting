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
$tableName="table_".$code;
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
