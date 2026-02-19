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
$username = $_POST['voterid'];
$_SESSION['vid'] = $username; 
$password = $_POST['password'];
$code=$_POST['code'];
$_SESSION['usercode'] =$code;
$_SESSION['code1'] =$code;
$tableName="table".$code;
$count=0;
$sql = "SELECT Status FROM admin WHERE Code = ? LIMIT 1";
$stmt = $mysqli->prepare($sql);

if ($stmt) {
    // Bind the parameters
    $stmt->bind_param("s", $code);

    // Execute the statement
    if ($stmt->execute()) {
        // Fetch the result
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            // Fetch the "Status" as an integer
            $row = $result->fetch_assoc();
            $status =$row['Status'];
        }
    }
}
if($status===1)
{
header('Location:voterpageresults.html');
}
else
{
$sql = "SELECT VoterId FROM $tableName";
$result = mysqli_query($mysqli, $sql);
if (!$result) {
        header('Location:data.html');
}
while ($row = mysqli_fetch_assoc($result)) 
{
    $value = $row['VoterId'];
    if($value===$username)
{
$count++;
}
}
if($count===0)
{
$query = "SELECT * FROM registration WHERE VoterId= ? AND Password= ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 1)
{
    header('Location:voterpage.html');
}
}
else
{ 
 header('Location:voterpageresults.html');
}
}
?>