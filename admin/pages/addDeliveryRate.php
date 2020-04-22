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
function fill_product ($conn){
    $output = '';
    $sqlProduct = "SELECT * FROM adddelivery";
    $resultProduct = $conn->query($sqlProduct);
    $IncID = 1;
    while ($row = mysqli_fetch_array($resultProduct)){
        $output .= '
            <tr class="odd gradeX">
            <form action="editRate.php" method="POST">
                <td>'.$IncID.'</td>
                <td class="d-none"><input type="number" value="'.$row["id"].'" class="form-control" name="ID"></td>
                <td><input type="number" value="'.$row["kilo"].'" class="form-control" name="kilo"></td>
                <td>
                <select class="form-control" name="geopolitical" required>
                    <option value="'.$row["geopolitical"].'" selected>'.$row["geopolitical"].'</option>
                    <option value="North-Central">North-Central</option>
                    <option value="North-East">North-East</option>
                    <option value="North-West">North-West</option>
                    <option value="South-East">South-East</option>
                    <option value="South-West">South-West</option>
                    <option value="South">South</option>
                    <option value="South-East">South-East</option>
                </select>
                </td>
                <td><input type="number" value="'.$row["cost"].'" class="form-control" name="cost"></td>
                <td class="center">
                    <button class="btn btn-primary" type="submit">Edit</button>
                </td>
                <td class="center">
                    <a href="deleteRate.php?id='.$row["id"].'" class="btn btn-danger">Delete</a>
                </td>
            </form>
            </tr>
        ';
        $IncID ++;
    }
    return $output;
}
?>
<?php
include "db-conn.php";
$kg_Err = $geopolitical_Err = $cost_Err = $exist_Err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Form validation
    if (empty($_POST["kg"])) {
        $kg_Err = "Weight is required";
    } else {
        $kg1 = test_input($_POST["kg"]);
        if ($kg1 <= 0) { 
            $kg_Err = "Can't accept weight less then 0";
        }else{
            $kg = test_input($_POST["kg"]);
        }
        
    }
    if (empty($_POST["cost"])) {
        $cost_Err = "Delivery cost is required";
    } else {
        $cost1 = test_input($_POST["cost"]);
        if ($cost1 < 0) { 
            $cost_Err = "Can't accept cost less then 0";
        }else{
            $cost = test_input($_POST["cost"]);
        }
        
    }
    if (empty($_POST["geopolitical"])) {
        $geopolitical_Err = "Price is required";
    } else {
        $geopolitical = test_input($_POST["geopolitical"]);
        
    }
    
    // --Form validation
    
    
    // Inserting data into the database
    if ($geopolitical_Err == "" && $cost_Err == "" && $kg_Err == ""){
        
        /// Checking if data already exist
        $sqlCheck = "SELECT * FROM adddelivery WHERE geopolitical = '$geopolitical'";
        $resultCheck = $conn->query($sqlCheck);
        if ($resultCheck->num_rows > 0) {
            // output data of each row
            while($row = $resultCheck->fetch_assoc()) {
                echo $row["kilo"];
                if ($row["kilo"] === $kg && $row["geopolitical"] === $geopolitical){
                    $exist_Err = "Data already exist";
                }else{
                    // Inserting into delivery rate table
                    $sqlRate = "INSERT INTO adddelivery (kilo, geopolitical,cost) VALUES ('$kg','$geopolitical','$cost')";
                    if ($conn->query($sqlRate) === TRUE) {
                        header("Location:addDeliveryRate.php?New record created successfully");exit;
                    } else {
                        echo "Error: " . $sqlRate . "<br>" . $conn->error;
                    }
                    
                }
            }

        }else{
            // Inserting into delivery rate table
            $sqlRate = "INSERT INTO adddelivery (kilo, geopolitical,cost) VALUES ('$kg','$geopolitical','$cost')";
            if ($conn->query($sqlRate) === TRUE) {
                header("Location:addDeliveryRate.php?New record created successfully");exit;
            } else {
                echo "Error: " . $sqlRate . "<br>" . $conn->error;
            }
        }

    }else{
        echo "Unsuccessful";
    }
    // --Inserting data into the database
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

    <title>Delivery Rate || ElbaMarket</title>
  <link rel="shortcut icon" href="../../images/logo/elba.png">

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../css/plugins.css">
    <link rel="stylesheet" href="../../style.css">
    <!-- Cusom css -->
    <link rel="stylesheet" href="../../css/custom.css">
    <!-- Modernizer js -->
    <script src="../../js/vendor/modernizr-3.5.0.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php
            include "header.php";
        ?>
        <div id="page-wrapper">
            <div class="row">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                    <div class="col-xs-6">
                        <label>
                            <h3>Per Kilogram</h3>
                            <input type="number" required class="form-control" placeholder="Kg in numbers" name="kg">
                        </label>
                        <span class="farmerErr">
                            <?php echo $kg_Err; ?>
                        </span>
                        
                    </div>
                    <div class="col-xs-6">
                        <label>
                            <h3>Geopolitical Zones</h3>
                            <select class="form-control" name="geopolitical" required>
                                <option value="North-Central">North-Central</option>
                                <option value="North-East">North-East</option>
                                <option value="North-West">North-West</option>
                                <option value="South-East">South-East</option>
                                <option value="South-West">South-West</option>
                                <option value="South">South</option>
                            </select>
                            
                        </label>
                    </div>
                    <div class="col-xs-6">
                        <label>
                            <h3>Delivery cost</h3>
                            <input type="number" required class="form-control" placeholder="Delivery cost" name="cost">
                            <span class="farmerErr">
                                <?php echo $cost_Err; ?>
                            </span>
                        </label>
                    </div>
                    <div class="col-xs-6 mt-3">
                        <button class="btn btn-primary btn-lg" type="submit" name="addDeliveryCost">Submit</button>
                    </div>
                    <div class="col-xs-6 mt-3">
                        <a href="addkilo.php" class="btn btn-success">Refresh Kilogram</a>
                    </div>
                    <div class="col-xs-6 mt-3">
                        <a href="addkiloDelete.php" class="btn btn-danger">Format Kg table</a>
                    </div>
                    <div class = "farmerErr">
                        <?php echo $exist_Err; ?>
                    </div>
                </form>
            </div>
            
            
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Delivery Cost Table
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Per Kilogram</th>
                                        <th>Geopolitical Zone</th>
                                        <th>Cost</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo fill_product($conn) ?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->
        
        <!-- Login Form -->
        <div class="accountbox-wrapper">
        <div class="accountbox text-left">
            <span class="accountbox-close-button"><i class="zmdi zmdi-close"></i></span>
            
<?php
            
include "db-conn.php";
            
$cat_nameErr ="";
$cat_name = "";
// Form validation
if (isset($_POST['addCategory'])) {
if (empty($_POST["cat_name"])) {
    $cat_nameErr = "Name is required";
} else {
    $cat_name1 = test_input($_POST["cat_name"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$cat_name1)) {
        $cat_nameErr = "Only letters and white space allowed";
    }else{
        $cat_name = test_input($_POST["cat_name"]);
    }

}
    if ($cat_nameErr ==""){
        $cat_value = $cat_name;
        $sql = "INSERT INTO category(category_name, category_value) VALUES ('$cat_name','$cat_value')";
        // --Insert Statement
        if ($connProduce->query($sql) === TRUE) {
            echo "New category created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $connProduce->error;
        }
    }else{
        echo "Unsuccessful";
    }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}          
?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <label>
                    Add new Category
                    <input class="form-control" type="text" placeholder="New Category" name="cat_name" value="<?php echo $cat_name;?>" required>
                </label>
                <button type="submit" name="addCategory" class="btn btn-success">Add</button>
            </form>
        </div>
        </div>
        <!-- //Login Form -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/plugins.js"></script>
    <script src="../../js/jquery.yu2fvl.js"></script>
    <script src="../../js/active.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
    <script>
        $(document).ready(function(){
            $('#cat').change(function(){
                var category_value = $(this).val();
                
                $.ajax({
                    url:"loadProduct.php",
                    method:"POST",
                    data:{category_value:category_value},
                    success:function(data){
                        $('product').html(data);
                    }
                    
                });
            });
        });
    </script>

</body>

</html>
