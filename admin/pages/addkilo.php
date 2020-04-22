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
$sqlKg = "SELECT * FROM adddelivery";
$resultKg = $conn->query($sqlKg);

if ($resultKg->num_rows > 0) {
    // output data of each row
    while($rowKg = $resultKg->fetch_assoc()) {
        /// Check if kg exists in kilo table
        $idKilo = $rowKg["kilo"];
        $sqlKilo = "SELECT * FROM kilo WHERE kilo = $idKilo";
        $resultKilo = $conn->query($sqlKilo);

        if ($resultKilo->num_rows <= 0) { 
            
            $sqlAdd = "INSERT INTO kilo (kilo)
            VALUES ('$idKilo')";

            if ($conn->query($sqlAdd) === TRUE) {
                echo "New record created successfully";
                header("Location:adminProduct.php? Successful");
            } else {
                echo "Error: " . $sqlAdd . "<br>" . $conn->error;
                header("Location:adminProduct.php? Successful");
            }
            
        } else {
            echo "0 results";
            header("Location:adminProduct.php? Successful");
        }
        
        
    }
} else {
    echo "0 results";
}
$conn->close();

?>