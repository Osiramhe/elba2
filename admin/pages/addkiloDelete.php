<?php
if(empty($_SESSION)){ // if the session not yet started
   session_start();
}
if(!isset($_SESSION['AdminId'])) { //if not yet logged in
   header("Location:login.php?Not logged in");// send to login page
   exit;
}
?>
<?php
include "db-conn.php";
$sqlKilo = "SELECT * FROM kilo";
$resultKilo = $conn->query($sqlKilo);

if ($resultKilo->num_rows > 0) { 
    while($rowKilo = $resultKilo->fetch_assoc()) {
        $id = $rowKilo["id"];
        $sql = "DELETE FROM kilo WHERE id = '$id'";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header("Location:addDeliveryRate.php? Successful");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            header("Location:addDeliveryRate.php? Unsuccessful");
        }
    }
}


?>