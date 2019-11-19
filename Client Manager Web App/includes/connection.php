<?php
    
    $serverName = 'localhost';
    $userName = 'root';
    $userPassword = '';
    $databaseName = 'clientdb';

    $conn = mysqli_connect($serverName, $userName, $userPassword, $databaseName);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
?>