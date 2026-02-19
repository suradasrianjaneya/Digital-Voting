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
$username = $_POST['Username1'];
$email = $_POST['Email1'];
$password = $_POST['Password1'];
$mobile = $_POST['Mobile1'];
$_SESSION['value']=$mobile;
$randomNumber = rand(100000,1000000);
$_SESSION['vid']=$randomNumber;
// Use prepared statements to insert data safely
$sql = "INSERT INTO registration (Name, Email, Number, Password,VoterId) VALUES ( ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
  // Bind parameters and execute the statement
  $stmt->bind_param("sssss", $username, $email, $mobile, $password,$randomNumber);

  if ($stmt->execute()) {
    header("Location:voterpage1.html");
  } else {
    header("Location:data.html"); 
  }

  // Close the statement
  $stmt->close();
} else {
  echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
