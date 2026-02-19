<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "RealmeC20";
$dbname = "project";
// Create a new mysqli connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get user input
$username = $_POST['Name'];
$email = $_POST['BelongsTo'];
$password = $_POST['DoB'];
$mobile = $_POST['Occupation'];
$randomNumber = rand(100000,1000000);
$code= $_SESSION['code'];
$tableName = "table_" . $code; 
$sql = "INSERT INTO $tableName(Name, BelongsTo, DoB, Occupation,CandidateId) VALUES (?, ?, ?, ?,?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
  // Bind parameters and execute the statement
  $stmt->bind_param("sssss", $username, $email, $password, $mobile,$randomNumber);

  if ($stmt->execute()) {
     header("Location: adminpage.html");
  } else {
    echo "Error: " . $stmt->error;
  }

  // Close the statement
  $stmt->close();
} else {
  echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
