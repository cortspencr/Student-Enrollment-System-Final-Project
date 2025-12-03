<?php
include 'database.php';
$db = new Database();
$conn = $db->conn;

session_start();

$email = $_POST['email'];
$password = $_POST['password'];

// Prepared statement
$stmt = $conn->prepare("SELECT id, first_name, password_hash FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        echo "Login successful! Welcome, " . htmlspecialchars($user['first_name']);
        echo "<br><a href='courses.php'>View Courses</a>";
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "User not found.";
}
?>
