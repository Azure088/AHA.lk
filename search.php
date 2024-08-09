<?php
include('db.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "campusdatabase";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$nic = $_POST['nic'];

$sql = "SELECT * FROM students WHERE nic = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nic);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
        
echo "<h2> Student Details </h2>";
while ($row = $result->fetch_assoc()) {
echo "<p>Full Name: " . htmlspecialchars($row['full_name']) . "</p>";
echo "<p>NIC: " . htmlspecialchars($row['nic']) . "</p>";
echo "<p>Contact No: " . htmlspecialchars($row['contact_no']) . "</p>";
echo "<p>Address: " . htmlspecialchars($row['address']) . "</p>";
echo "<p>Course Name: " . htmlspecialchars($row['course_name']) . "</p>";
}
} 
else 
{
echo "<p>No student can be found with this NIC: " . htmlspecialchars($nic) . "</p>";
}

$stmt->close();
}

$conn->close();
?>