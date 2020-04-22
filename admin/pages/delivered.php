<?php
include "db-conn.php";
$id=$_GET["id"];
$sqlDelivered = "UPDATE delivery SET delivered = 'Yes' WHERE delivery_id = '$id'";
$result = $conn->query($sqlDelivered);
if ($conn->query($sqlDelivered) === TRUE){
    header("Location:latestOrder.php: Delivered Successfully");
}else{
    echo "Error updating record: ".$conn->error;
}


?>