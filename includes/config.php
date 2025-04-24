<?php
$hostname = "localhost";
$username = "root";
$pass = "";
$database = "project_2024";

// Establish connection
$conn = mysqli_connect($hostname, $username, $pass, $database);

// Check connection
if (!$conn) {
    // If the connection fails, stop script execution and display an error message
    die("Connection failed: " . mysqli_connect_error());
}

?> 


