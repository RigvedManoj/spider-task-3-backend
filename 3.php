<?php
$servername = "localhost";
$username = "root";
$password = "";//enter mysql password
$dbname = "spider1";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
$_SESSION['username'] =0;
//sql to drop table
$sql="DROP TABLE SIGNUP";
mysqli_query($conn, $sql);
$sql="DROP TABLE JOURNAL";
mysqli_query($conn, $sql);
// sql to create table
$sql = "CREATE TABLE SIGNUP(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
pass VARCHAR(100) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
    echo  "Table SIGNUP created successfully  ";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
$sql = "CREATE TABLE JOURNAL(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
lat INT(6) SIGNED,
lng INT(6) SIGNED,
name VARCHAR(30) NOT NULL,
privacy  VARCHAR(30) NOT NULL,
title VARCHAR(30) NOT NULL,
entry TEXT NOT NULL,
reg_date TIMESTAMP
)";
if (mysqli_query($conn, $sql)) {
    echo "Table JOURNAL created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
mysqli_close($conn);
?>
