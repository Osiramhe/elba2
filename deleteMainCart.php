<?php
session_start();
require"db-conn.php";
$id=$_GET['id'];
$sql = "DELETE FROM addcart WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Record deleted successfully')</script>";
    header("Location:shop-cart.php?Deleted successfully");
} else {
    echo "Error deleting record: " . $conn->error;
}


?>