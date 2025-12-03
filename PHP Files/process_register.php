<?php
include 'database.php';
$db = new Database();
$conn = $db->conn;

$first = trim($_POST['first_name']);
$last = trim($_POST['last_name']);
$email = $_POST['email'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password_hash) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $first, $last, $email, $pass);

if ($stmt->execute()) {
    echo "Registration successful! <a href='login.php'>Login here</a>";
} else {
    echo "Error: " . $conn->error;
}
?>
