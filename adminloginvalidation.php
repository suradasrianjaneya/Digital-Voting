<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "RealmeC20";
$dbname = "project";
// Create a new mysqli connection
$mysqli=new mysqli($servername, $username, $password, $dbname);// Coentials)

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$username = $_POST['number'];
$password = $_POST['password'];
$code=$_POST['code'];
$_SESSION['code']=$code;
$_SESSION['code1']=$code;
$query = "SELECT * FROM admin WHERE Number= ? AND Password= ? AND Code= ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("sss", $username, $password,$code);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    header('Location:adminpage.html');
} else {
    header('Location:data.html');
}
?>