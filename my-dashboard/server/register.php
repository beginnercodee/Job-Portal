<?php
    $database = "simple_app";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $connect = new mysqli($servername, $username, $password, $database);
    if ($connect->connect_error){
        die("Sorry, Connection failed: ". $connect->connect_error);
    }
    $fullname = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (fullname, email, passwords) VALUES ('$fullname', '$email', '$hashedPassword')";
    if($connect->query($sql) === TRUE){
        header("Location: ../login.html");
        exit();
    }else{
        echo "Incorrect: ".$sql.$connect->error;
    }
    $connect->close();
?>