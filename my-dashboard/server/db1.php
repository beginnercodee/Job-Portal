<?php
    $database = "simple_app";
    $servername = "localhost";
    $username = "root";
    $password = "";

    $connect = new mysqli($servername, $username, $password);

    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    $drop = "DROP DATABASE IF EXISTS `$database`";
    if ($connect->query($drop) === TRUE) {
        echo "Old database dropped successfully.<br>";
    } else {
        die("Error Dropping Database: " . $connect->error . "<br>");
    }

    $create = "CREATE DATABASE `$database`";
    if ($connect->query($create) === TRUE) {
        echo "Database created successfully.<br>";
    } else {
        die("Error Creating Database: " . $connect->error . "<br>");
    }

    $connect->select_db($database);

    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(5) AUTO_INCREMENT PRIMARY KEY,
        fullname VARCHAR(50) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        passwords VARCHAR(255) NOT NULL,
        Created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if ($connect->query($sql) === TRUE) {
        echo "Users table created successfully.<br>";
    } else {
        die("Error Creating Users Table: " . $connect->error . "<br>");
    }

    $connect->close();
?>
