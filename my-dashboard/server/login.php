<?php
    $database = "simple_app";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $connect = new mysqli($servername, $username, $password, $database);
    if ($connect->connect_error){
        die("Sorry, Connection failed: ". $connect->connect_error);
    }
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $ans = $connect->query($sql);

    if($ans && $ans->num_rows > 0){
        $row = $ans->fetch_assoc();
        if (password_verify($password, $row['passwords'])) {
            header("Location: ../dashboard.html");
            exit();
        } else {
            echo "Invalid Username or Password";
        }
    }else{
        echo "Invalid Username or Password";
    }
    $connect->close();
?>
