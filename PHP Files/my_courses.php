<?php
include 'database.php';
$db = new Database();
$conn = $db->conn;

session_start();

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT r.id AS reg_id, c.course_code, c.course_name, c.instructor, c.credits
        FROM registrations r
        JOIN courses c ON r.course_id = c.id
        WHERE r.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
<title>My Courses</title>
</head>
<body>

<h2>My Registered Courses</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>Course Code</th>
        <th>Course Name</th>
        <th>Instructor</th>
        <th>Credits</th>
        <th>Action</th>
    </tr>

    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['course_code']); ?></td>
        <td><?= htmlspecialchars($row['course_name']); ?></td>
        <td><?= htmlspecialchars($row['instructor']); ?></td>
        <td><?= htmlspecialchars($row['credits']); ?></td>
        <td><a href="delete_course.php?reg_id=<?= $row['reg_id']; ?>">Delete</a></td>
    </tr>
    <?php endwhile; ?>
</table>

<br>
<a href="courses.php">Add More Courses</a>

</body>
</html>
