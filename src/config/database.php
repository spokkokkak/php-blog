<?php
    $host = 'mysql-container';
    $db = 'blog_db';
    $username = 'root_user';
    $password = 'root_password';

    // $conn = new mysqli($host, $username, $password, $dbname);
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }

    try {

        $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
?>
