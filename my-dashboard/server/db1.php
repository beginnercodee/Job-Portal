<?php
    $database = "simple_app";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $connect = new mysqli($servername, $username, $password);
    if ($connect->connect_error){
        die("Sorry, Connection failed: ". $connect->connect_error);
    }
    $drop = "DROP DATABASE IF EXISTS $database";
    if($connect->query($drop) === TRUE){
        echo "Old database dropped successfully.<br>";
    }else{
        die("Error Dropping Database: ".$connect->error."<br>");
    }
    $create = "CREATE DATABASE $database";
    if($connect->query($create) === TRUE){
        echo "Database created successfully.<br>";
    }else{
        die("Error Creating Database: ".$connect->error."<br>");
    }
    if($connect->select_db($database)){
        echo "Database '{$database}' selected successfully.<br>";
    }else{
        die("Error Selecting Database: ".$connect->error."<br>");
    }
    $sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(5) AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(25),
    email VARCHAR(30),
    passwords VARCHAR(255),
    Created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    if($connect->query($sql) === TRUE){
        echo "Table created successfully.<br>";
    }else{
        die("Error Creating Table: ".$connect->error."<br>");
    }
    $connect->close();
?>