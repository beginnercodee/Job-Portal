<?php
    $database = "simple_app";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $connect = new mysqli($servername, $username, $password);
    if ($connect->connect_error){
        die("Sorry, Connection failed: ". $connect->connect_error);
    }
    if($connect->select_db($database)){
        echo "Database '{$database}' selected successfully.<br>";
    }else{
        die("Error Selecting Database: ".$connect->error."<br>");
    }
    $sql = "CREATE TABLE IF NOT EXISTS tasks (
    task_id INT(5) AUTO_INCREMENT PRIMARY KEY,
    id INT(5) NOT NULL,
    title VARCHAR(255) NOT NULL,
    task_priority VARCHAR(50),
    task_status VARCHAR(50),
    Created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id) REFERENCES users(id)
    )";
    if($connect->query($sql) === TRUE){
        echo "Table created successfully.<br>";
    }else{
        die("Error Creating Table: ".$connect->error."<br>");
    }
    $connect->close();
?>