<?php
session_start();

include('db.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
$username = $_POST['username'];


$sql = "SELECT user_name FROM admin WHERE user_name = ?";
$stmt = $path->prepare($sql);

if ($stmt === false) {
die("Prepare failed: " . $path->error);
}

$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {

$_SESSION['success_message'] = "Successfully logged in!";
header("Location: admin.html");
exit();
} else {

$_SESSION['error_message'] = "Invalid username";
header("Location: adminlogin.html");
exit();
}

$stmt->close();
$path->close();
}
?>
