<?php

//database credentials
$serverName = 'localhost:3307';
$userName = 'root';
$password = 12345;
$dbName = 'company';

//creating connections
$conn = mysqli_connect($serverName, $userName, $password, $dbName);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_errno());
}

// Optionally, configure other settings
date_default_timezone_set('America/New_York'); // Set the default timezone

?>