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
$date = $_POST['date1'];
$title = $_POST['title'];
$randomNumber = rand(100000,1000000);
$_SESSION['code']=$randomNumber;
$_SESSION['code1']=$randomNumber;

// Use prepared statements to insert data safely
$sql = "INSERT INTO admin (Name, Email, Number, Password,Date,Code,Title) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if ($stmt) {
  // Bind parameters and execute the statement
  $stmt->bind_param("sssssss", $username, $email, $mobile, $password,$date,$randomNumber,$title);
 if ($stmt->execute()) {
     //
  } else {
    echo "Error: " . $stmt->error;
  }
 $stmt->close();
} else {
  echo "Error: " . $conn->error;
}
$sql = "INSERT INTO elections(Codes) VALUES (?)";
$stmt = $conn->prepare($sql);
if ($stmt) {
  // Bind parameters and execute the statement
  $stmt->bind_param("s",$randomNumber);
 if ($stmt->execute()) {
     //
  } else {
    echo "Error: " . $stmt->error;
  }
 $stmt->close();
} else {
  echo "Error: " . $conn->error;
}

$tableName = "table_" . $randomNumber; 
$tablename= "table" . $randomNumber; 
$sql2 = "CREATE TABLE $tableName(
    Name VARCHAR(255) NOT NULL,
    BelongsTo VARCHAR(255) NOT NULL,
    DoB VARCHAR(255) NOT NULL,
    Occupation VARCHAR(255) NOT NULL,
    CandidateId VARCHAR(255) NOT NULL,
    Votes INT(6) 
)";
$sql3= "CREATE TABLE $tablename(
    VoterId INT(6) NOT NULL
)";
if ($conn->query($sql3) === TRUE) {
   
} else {
    echo "Error creating table: " . $conn->error;
}

if ($conn->query($sql2) === TRUE) {
    header('Location:adminpage.html');
} else {
     header('Location:data.html');
}
// Close the database connection
$conn->close();
?>
