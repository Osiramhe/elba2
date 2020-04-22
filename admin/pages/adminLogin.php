               
<?php
include "db-conn.php";
if(empty($_SESSION)){ // if the session not yet started
   session_start();
}
// define variables and set to empty values
$nameErr = $passwordErr =  "";

if (isset($_POST["log_submit"])) {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        
    }
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
// This is in the PHP file and sends a Javascript alert to the client
        echo "<script type='text/javascript'>alert('$passwordErr');</script>";
        $_SESSION["passR"] = "Password is required";
        header("Location:registerCustomers.php?Password is required");
    } else {
        $password2 = test_input($_POST["password"]);
        $name2 = test_input($_POST["name"]);
        $sqlCheck = "SELECT * FROM admin";
        
        $resultCheck = $conn->query($sqlCheck);
        if ($resultCheck->num_rows > 0) {
            // output data of each row
            while($row = $resultCheck->fetch_assoc()) {
                $dehashed = password_verify($password2, $row["password"]);
                if ($row["email"] == $name2 && $dehashed ==1){
                    $_SESSION["welcome2"] = "Welcome to ELBAMARKET";
                    $_SESSION["welcome"] = "";
                    header("Location:index.html?Welcome'.$row[name].'");
                    $_SESSION["AdminName"] = $row["name"];
                    $_SESSION["CustomerId"] = $row["id"];
                }else{
                    $passwordErr ="Incorrect details. Check your email or password";
                    $_SESSION["passR"] = "Incorrect details. Check your email or password";
                    header("Location:login.php?Password is required");
                }
            }
        } else {
            echo "0 results";
        }
        
    }
    
    
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>  