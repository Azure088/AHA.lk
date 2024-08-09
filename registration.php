<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "campusdatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$fullname = $_POST['full'];
$nic = $_POST['nic'];
$contact = $_POST['contact_no'];
$address = $_POST['address'];
$user_name = $_POST['user_name']; 
$course_name = $_POST['course_name'];
$password = $_POST['password'];

if (isset($_POST['save'])) {
$stmt = $conn->prepare("INSERT INTO students (full_name, nic, contact_no, address, user_name, course_name, password) VALUES (?, ?, ?, ?, ?, ?, ?)");

if ($stmt === false) {
die("Error preparing the statement: " . $conn->error);
}

$stmt->bind_param("sssssss", $fullname, $nic, $contact, $address, $user_name, $course_name, $password);

if ($stmt->execute()) {
$success_message = "Registration Successful"; 
} else {
$error_message = "Error: " . $stmt->error;
}
$stmt->close(); 
}
    
$conn->close();
}

if (!empty($success_message)) {
    echo "<p style='color: green;'>$success_message</p>";
}
if (!empty($error_message)) {
    echo "<p style='color: red;'>$error_message</p>";
}
?>
