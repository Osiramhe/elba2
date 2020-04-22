<?php
session_start();
include "db-conn.php";

 $outcost = "";
$kg = $_SESSION["E_kg"];
$total_kg =$_SESSION["E_total_kg"];

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
            $geopolitical = $rowState["geopolitical"];
            $sqlCost ="SELECT * FROM adddelivery WHERE geopolitical = '$geopolitical' AND kilo = $kg";
            
            $resultCost = $conn->query($sqlCost);

            if ($resultCost->num_rows > 0) {
                // output data of each row
                while($rowCost = $resultCost->fetch_assoc()) {
                    $deliveryCost = $rowCost["cost"];
                    $cart = $_SESSION["E_cart"];
                    $sub = $_SESSION["E_sub"];
                    $quan = $_SESSION["E_quantity"];
                    $deliveryCost = $quan * $deliveryCost;
                    $total =$deliveryCost + $sub;
                    $_SESSION["newTotal"] = $total;
                    
                    $sqlProduce = "UPDATE cart SET delivery_cost='$deliveryCost', total = '$total' WHERE cart_id='$cart'";
                    $result = $conn->query($sqlProduce);
                        $outcost .= '

                            <li><p class="strong">product</p><p class="strong">details (#)</p></li>
                            <li><p>'.$_SESSION["E_name"].'</p><p>'.$_SESSION["E_price"].' per '.$kg.' kg</p></li>
                            <li><p class="strong">cart subtotal</p><p class="strong">'.$_SESSION["E_sub"] .'</p></li>
                            <li><p class="strong">cart quantity</p><p class="strong">'.$_SESSION["E_quantity"].'</p></li>
                            <li><p class="strong">cart delivery cost</p><p class="strong">'.$deliveryCost.'</p></li>
                            <li><p class="strong"> total</p><p class="strong">' .$total.'</p></li>

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