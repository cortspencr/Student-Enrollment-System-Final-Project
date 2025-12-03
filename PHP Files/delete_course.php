<?php
include 'database.php';
$db = new Database();
$conn = $db->conn;

session_start();

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

$reg_id = intval($_GET['reg_id']);

$stmt = $conn->prepare("DELETE FROM registrations WHERE id = ?");
$stmt->bind_param("i", $reg_id);

if ($stmt->execute()) {
    echo "Course successfully deleted! <br><br>";
    echo "<a href='my_courses.php'>Back to My Courses</a>";
} else {
    echo "Error: " . $conn->error;
}
?>
