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
$id = $_GET["id"];
// sql to delete a record
$sql = "DELETE FROM farmproduce WHERE ID='$id'";
if (mysqli_query($connProduce, $sql)) {
    echo "Record deleted successfully";
    header("Location:adminProduct.php");
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);

?>