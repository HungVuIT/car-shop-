<?php
    $host = "localhost";
    $user = "root";         // phpMyAdmin userName, if in local => probably "root"
    $passwd = "";           // password
    $db = "Web";            // DB name

    // Create connection
    $conn = mysqli_connect($host, $user, $passwd, $db);
    
    // Check connection
    if (!$conn)
        die("Connection failed: " . mysqli_connect_error());
?>