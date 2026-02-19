<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "RealmeC20";
$dbname = "project";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$vote = $_GET['var1'];
$tableName = $_SESSION['tablename'];
$sql1= "SELECT Votes FROM $tableName WHERE CandidateId=$vote";
$result = $conn->query($sql1);
if (!$result) {
    die("Query failed: " . $conn->error);
}
$row = $result->fetch_assoc();
$v = $row["Votes"];
$v++;
$voterid=$_SESSION['vid'];
$tablename = $_SESSION['tableName'];
$sql = "INSERT INTO $tablename(VoterId) VALUES (?)";
$stmt = $conn->prepare($sql);
if ($stmt) {
  // Bind parameters and execute the statement
  $stmt->bind_param("s", $voterid);
}
  if ($stmt->execute()) {
     //
  } else {
    echo "Error: " . $stmt->error;
  }
$sql="UPDATE $tableName SET Votes=$v WHERE CandidateId=$vote";
if($conn->query($sql))
{
header("Location:voterpageresults.html");
}
?>