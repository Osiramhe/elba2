<?php
/*
    $dbServerName = "66.147.238.141";
    $dbUserName ="elbamark_admin";
    $dbPassword = "X0P!A85iNf3(aq";
    $dbName = "elbamark_elbamarket";
    $conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $connProduce = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);
    if ($connProduce->connect_error) {
        die("Connection failed: " . $connProduce->connect_error);
    }
*/
?>

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