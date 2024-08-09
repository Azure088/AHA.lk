<?php
session_start();
if (isset($_SESSION['success_message'])) {
echo "<p>" . $_SESSION['success_message'] . "</p>";
unset($_SESSION['success_message']);
} elseif (isset($_SESSION['error_message'])) {
echo "<p>" . $_SESSION['error_message'] . "</p>";
unset($_SESSION['error_message']);
}
?>
