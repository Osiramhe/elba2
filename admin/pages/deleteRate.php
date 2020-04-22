<?php
include "db-conn.php";
$id = $_GET["id"];
// sql to delete a record
$sql = "DELETE FROM adddelivery WHERE id='$id'";
if (mysqli_query($connProduce, $sql)) {
    echo "Record deleted successfully";
    header("Location:addDeliveryRate.php");
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);

?>