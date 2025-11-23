<?php
$database = "simple_app";
$servername = "localhost";
$username = "root";
$password = "";
$connect = new mysqli($servername, $username, $password, $database);

if ($connect->connect_error) {
    die("Sorry, Connection failed: " . $connect->connect_error);
}

$fullname = $_POST['fullName'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

if ($password !== $confirmPassword) {
    echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
    exit();
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $connect->prepare("INSERT INTO users (fullname, email, passwords) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $fullname, $email, $hashedPassword);

if ($stmt->execute()) {
    header("Location: ../login.html?status=registered");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$connect->close();
?>