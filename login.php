<?php
session_start(); 

include('db.php'); 

if (isset($_POST['username']) && isset($_POST['password'])) {
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM login WHERE username = ?";
$stmt = $path->prepare($sql);

if ($stmt === false) {
die("Prepare failed: " . $path->error);
}

$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
$user = $result->fetch_assoc();


if (password_verify($password, $user['password'])) {
$_SESSION['username'] = $username;
$_SESSION['success_message'] = "Successfully logged in!";
header("Location: youracc.html"); 
exit(); 
}
} else {
$_SESSION['error_message'] = "Invalid username or password";
header("Location: youracc.html");
exit();
}

$stmt->close();
}

$path->close();
?>
