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
$code = $_SESSION['usercode'];
$sql = "SELECT Status FROM admin WHERE Code = ? LIMIT 1";
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
            $status =$row['Status'];
        }
    }
}
echo json_encode($status);
$conn->close();
?>
