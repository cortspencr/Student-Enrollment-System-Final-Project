<?php
include 'database.php';
$db = new Database();
$conn = $db->conn;

$courses = $conn->query("SELECT * FROM courses");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Available Courses</title>
</head>
<body>
<h2>Available Courses</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Course Code</th>
        <th>Course Name</th>
        <th>Instructor</th>
        <th>Credits</th>
        <th>Action</th>
    </tr>

    <?php while($row = $courses->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['course_code']); ?></td>
        <td><?= htmlspecialchars($row['course_name']); ?></td>
        <td><?= htmlspecialchars($row['instructor']); ?></td>
        <td><?= htmlspecialchars($row['credits']); ?></td>
        <td><a href="add_course.php?course_id=<?= $row['id']; ?>">Add</a></td>
    </tr>
    <?php endwhile; ?>
</table>

<br>
<a href="my_courses.php">View My Courses</a>

</body>
</html>
