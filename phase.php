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
$code = $_SESSION['code'];
$sql = "SELECT CAST(Status AS SIGNED) AS Status FROM admin WHERE Code = ?";
$stmt = $conn->prepare($sql);

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
            $status = (int)$row['Status'];
           }
       }
   }
if ($status===0)
 {
$sql = "UPDATE admin SET Status = 1 WHERE Code = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind the parameters
    $stmt->bind_param("s", $code);

    // Execute the statement
    if ($stmt->execute()) {
        // The update was successful
        $status=1;
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}
}
else
{
$sql = "UPDATE admin SET Status = 0 WHERE Code = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind the parameters
    $stmt->bind_param("s", $code);

    // Execute the statement
    if ($stmt->execute()) {
        // The update was successful
        $status=0;
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}
}
echo json_encode($status);
$conn->close();
?>
