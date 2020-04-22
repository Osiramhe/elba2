<?php
    include "db-conn.php";
    $geopolitical = mysqli_real_escape_string($conn,$_POST["geopolitical"]);

    $id =  mysqli_real_escape_string($conn,$_POST["ID"]);
    $kilo =  mysqli_real_escape_string($conn,$_POST["kilo"]);
    $cost =  mysqli_real_escape_string($conn,$_POST["cost"]);
$sqlProduce = "UPDATE adddelivery SET kilo='$kilo', geopolitical='$geopolitical', cost='$cost' WHERE id='$id'";
$result = $conn->query($sqlProduce);
if ($conn->query($sqlProduce) === TRUE) {
    echo "Record updated successfully";
    header("Location:addDeliveryRate.php?Edited successfully");
} else {
    echo "Error updating record: " . $conn->error;
}






$conn->close();
?>