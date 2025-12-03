<?php
include 'database.php';
$db = new Database();
$conn = $db->conn;

session_start();

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access. Please log in.");
}

$user_id = $_SESSION['user_id'];

// Validate GET parameter
if (!isset($_GET['course_id'])) {
    die("Invalid request.");
}

$course_id = intval($_GET['course_id']);

// Prepared statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO registrations (user_id, course_id) VALUES (?, ?)");
$stmt->bind_param("ii", $user_id, $course_id);

if ($stmt->execute()) {
    echo "Course successfully added! <br><br>";
    echo "<a href='courses.php'>Back to Courses</a><br>";
    echo "<a href='my_courses.php'>View My Courses</a>";
} else {
    echo "Error adding course: " . $conn->error;
}
?>
