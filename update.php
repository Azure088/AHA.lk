<?php
session_start();

include('db.php'); 

if (isset($_POST['update'])) {
$nic = $_POST['nic'];
$full_name = $_POST['full_name'];
$contact_no = $_POST['contact_no'];
$address = $_POST['address'];
$course_name = $_POST['course_name'];
$password = $_POST['password']; 

$sql = "UPDATE students SET full_name = ?, contact_no = ?, address = ?, course_name = ?, password = ? WHERE nic = ?";


$stmt = $path->prepare($sql);

if ($stmt === false) {
die("Prepare failed: " . $path->error);
}


if (empty($password)) {
$password = null; 
} else {
        
$password = password_hash($password, PASSWORD_DEFAULT);
}


$stmt->bind_param("ssssss", $full_name, $contact_no, $address, $course_name, $password, $nic);


if ($stmt->execute()) {
$_SESSION['success_message'] = "Student details updated successfully!";
header("Location: updateconfirm.php");
exit();
} else {
$_SESSION['error_message'] = "Failed to update student details: " . $stmt->error;
header("Location: updateconfirm.php");
exit();
}
$stmt->close();
$path->close();
}
?>
