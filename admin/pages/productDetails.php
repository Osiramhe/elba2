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
$id=$_GET['id'];
$sql = "SELECT * FROM farmproduce WHERE image = '$id'";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result))
    {
        $_SESSION["D_name"]=$row['name'];
        $_SESSION["D_image"]=$row['image'];
        $_SESSION["D_category"]=$row['category'];
        $_SESSION["D_price"]=$row['price'];
        $_SESSION["D_rating"]=$row['rating'];
        $_SESSION["D_location"]=$row['location'];
        $_SESSION["D_quantity"]=$row['quantity'];
        $_SESSION["D_farmer_id"]=$row['farmer_id'];
        $_SESSION["D_date"]=$row['date'];
        $_SESSION["D_time"]=$row['time'];
    
        $_SESSION["D_packaging"]=$row['packaging'];
        $_SESSION["D_description"]=$row['description'];
        // $time=$row['time'];
    }

// Getting farmer's details

$sqlFarmers = "SELECT * FROM farmers WHERE farmer_id = '$id'";
$resultFarmers = mysqli_query($conn, $sqlFarmers);

while($rowFarmers = mysqli_fetch_array($resultFarmers))
    {
        $_SESSION["D_farmer_name"]=$rowFarmers['name'];
    $_SESSION["D_farmer_location"]=$rowFarmers['location'];
        // $time=$row['time'];
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

    <title>Product Details || ElbaMarket Admin Page</title>

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
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <img src="uploads/<?php echo $_SESSION["D_image"] ?>" alt="images">
                        </div>
                        <div class="col-lg-12 pl-4">
                            <h3 class="text-muted ml-5 mt-3">Description</h3>
                            <p>
                                <?php echo $_SESSION["D_description"] ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-lg-12 p-2">
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="name" style="font-size:1.4em" class="text-muted mt-3">Name</label>
                                    <input type="text" readonly class="form-control" value="<?php echo $_SESSION["D_name"] ?>" style="font-size:1.4em" id="name">
                                </div>
                                <div class="col-xs-6">
                                    <label for="location" style="font-size:1.4em" class="text-muted mt-3">Location</label>
                                    <input type="text" readonly class="form-control" value="<?php echo $_SESSION["D_location"] ?>" style="font-size:1.4em" id="location">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 p-2">
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="cat" style="font-size:1.4em" class="text-muted mt-3">Category</label>
                                    <input type="text" readonly class="form-control" value="<?php echo $_SESSION["D_category"] ?>" style="font-size:1.4em" id="cat">
                                </div>
                                <div class="col-xs-6">
                                    <label for="available" style="font-size:1.4em" class="text-muted mt-3">Available</label>
                                    <input type="text" readonly class="form-control" value="<?php echo $_SESSION["D_quantity"] ?>" style="font-size:1.4em" id="available">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 p-2">
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="cat" style="font-size:1.4em" class="text-muted mt-3">Category</label>
                                    <input type="text" readonly class="form-control" value="<?php echo $_SESSION["D_farmer_name"] ?>" style="font-size:1.4em" id="cat">
                                </div>
                                <div class="col-xs-6">
                                    <label for="available" style="font-size:1.4em" class="text-muted mt-3">Available</label>
                                    <input type="text" readonly class="form-control" value="<?php echo $_SESSION["D_farmer_location"] ?>" style="font-size:1.4em" id="available">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 p-2">
                            <input type="text" readonly value="#<?php echo $_SESSION["D_price"] ?>" style="font-size:1.4em;width:40%;">
                            <i>per</i>
                            <input type="text" readonly value="<?php echo $_SESSION["D_packaging"] ?>" style="font-size:1.4em;width:40%;">
                        </div>
                        <div class="col-lg-12 p-2">
                            <div class="row">
                            <ul class="rating col-xs-6">
                                            <?php
                                                $ratingNum = $_SESSION["D_rating"];
                                                $chgnum = 0;
                                                while ($chgnum < $ratingNum){
                                                    echo'
                                                        <li><i class="fa fa-star"></i></li>
                                                    ';
                                                    $chgnum = $chgnum + 1;
                                                }
                                            ?>
                            </ul>
                                <div class="col-xs-3">
                                    <input type="text" readonly value="<?php echo $_SESSION["D_date"] ?>" class="form-control">
                                </div>
                                <div class="col-xs-3">
                                    <input type="text" readonly value="<?php echo $_SESSION["D_time"] ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-4">
                            <div class="row">
                                <div class="col-xs-4">
                                    <a href="#" class="btn btn-success">Orders</a>
                                </div>
                                <div class="col-xs-4">
                                    <a href="#" class="btn btn-primary">Edit</a>
                                </div>
                                <div class="col-xs-4">
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

</body>

</html>
