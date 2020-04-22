<?php
session_start();
include "db-conn.php";

 $outcost = "";

if (isset($_POST["state"])){
    $state = $_POST["state"];
    if ($state != ''){
        $sqlState = "SELECT * FROM states WHERE name= '$state'";
        
    }else{
        echo "Error";
    }
    $resultState = $conn->query($sqlState);

    if ($resultState->num_rows > 0) {
        // output data of each row
        while($rowState = $resultState->fetch_assoc()) {
            $state_id = $rowState["state_id"];
            $sqlCost ="SELECT * FROM locals WHERE state_id = $state_id";
            
            $resultCost = $conn->query($sqlCost);

            if ($resultCost->num_rows > 0) {
                // output data of each row
                while($rowCost = $resultCost->fetch_assoc()) {
                        $outcost .= '
                            <option value = "'.$rowCost["local_name"].'">'.$rowCost["local_name"].'</option>
                        ';
                }
            } else {
                echo "0 results";
            }
        }
    } else {
        echo "0 results";
    }
    echo $outcost;
}
?>