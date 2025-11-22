<?php
session_start();

$database = "simple_app";
$servername = "localhost";
$username = "root";
$password = "";

$connect = new mysqli($servername, $username, $password, $database);

if ($connect->connect_error) {
    die("Sorry, Connection failed: " . $connect->connect_error);
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $connect->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    
    $row = $result->fetch_assoc();

    if (password_verify($password, $row['passwords'])) {

        $_SESSION['user_id'] = $row['id'];       
        $_SESSION['user_name'] = $row['fullname']; 

        header("Location: ../dashboard.html");
        exit();

    } else {
        header("Location: ../login.html?error=invalid");
        exit();
    }

} else {
    header("Location: ../login.html?error=invalid");
    exit();
}

$stmt->close();
$connect->close();
?>