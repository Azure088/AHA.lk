<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "campusdatabase";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nic'])) {
$nic = $_POST['nic'];


$sql = "SELECT * FROM students WHERE nic = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nic);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
$sql = "DELETE FROM students WHERE nic = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nic);

if ($stmt->execute()) {
echo "<p style='color:green;'> Student with NIC: $nic has been deleted successfully.</p>";
} 
else 
{
echo "<p style='color:red;'>Error deleting student: " . $stmt->error . "</p>";
}

} 
else 
{
echo "<p style='color:red;'>No student found with NIC: $nic</p>";
}
}

$conn->close();
?>