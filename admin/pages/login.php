
 
<?php

include "db-conn.php";
if(empty($_SESSION)){ // if the session not yet started
   session_start();
}
// define variables and set to empty values
$nameErr = $passwordErr =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        
    }
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password2 = test_input($_POST["password"]);
        $name2 = test_input($_POST["name"]);
        $sqlCheck = "SELECT * FROM admin";
        
        $resultCheck = $conn->query($sqlCheck);
        if ($resultCheck->num_rows > 0) {
            // output data of each row
            while($row = $resultCheck->fetch_assoc()) {
                if ($row["name"] == $name2 && $password2 == $row["password"]){
                    $_SESSION["welcome"] = "Welcome to ELBAMARKET";
                    $_SESSION["welcome2"] = "";
                    header("Location:adminProduct.php?Welcome'.$row[name].'");
                    $_SESSION["AdminName"] = $row["name"];
                    $_SESSION["AdminId"] = $row["id"];
                }else{
                    $passwordErr ="Incorrect details. Check your email or password";
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
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin || ElbaMarket</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="name" type="text" autofocus required>
                                    <span>
                                        <?php
                                             echo $nameErr;
                                        ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
                                    <div class="text-danger">
                                        <?php
                                             echo $passwordErr;
                                        ?>
                                    </div>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button name="submit" class="btn btn-lg btn-success btn-block" type="submit">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
