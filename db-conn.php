<?php
    $dbServerName = "localhost";
    $dbUserName ="root";
    $dbPassword = "";
    $dbName = "elbamarket";
    $conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $connProduce = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);
    if ($connProduce->connect_error) {
        die("Connection failed: " . $connProduce->connect_error);
    }

?>