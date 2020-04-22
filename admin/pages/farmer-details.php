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
// Selecting farmers's details
$id=$_GET['id'];
$sqlFarmer = "SELECT * FROM farmers WHERE farmer_id = '$id'";
$resultFarmer = mysqli_query($conn, $sqlFarmer);

while($rowFarmer = mysqli_fetch_array($resultFarmer))
    {
        $_SESSION["FarmerName"]=$rowFarmer['name'];
        $_SESSION["FarmerPhone"]=$rowFarmer['phone'];
        $_SESSION["FarmerLocation"]=$rowFarmer['location'];
        $_SESSION["FarmerSize"]=$rowFarmer['size'];
        $_SESSION["FarmerProducts"]=$rowFarmer['products'];
        $_SESSION["Farmer_id"]=$rowFarmer['farmer_id'];
        // $time=$row['time'];
    }
// --Selecting farmers's details



function fill_category ($conn){
    $output = '';
    $sqlCat = "SELECT * FROM category";
    $resultCat = $conn->query($sqlCat);
    while ($rowCat = mysqli_fetch_array($resultCat)){
        $output .= '<option value="'.$rowCat["category_value"].'">'.$rowCat["category_name"].'</option>';
    }
    return $output;
}
function fill_product ($conn){
    $id=$_GET['id'];
    $output = '';
    $sqlProduct = "SELECT * FROM farmproduce WHERE farmer_id = '$id'";
    $resultProduct = $conn->query($sqlProduct);
    while ($row = mysqli_fetch_array($resultProduct)){
        $output .= '
        <!-- Start Single Popular Food -->
          <div class="col-lg-4 col-md-6 col-sm-12 foo">
             <div class="popular__food">
                <div class="pp_food__thumb">
                   <a href="menu-details.html">
                   <img src="uploads/'.$row["image"].'" alt="popular food" height="211px">
                   </a>
                   <div class="pp__food__prize" title="Available Quantity">
                      <span>'.$row["quantity"].'R</span>
                   </div>
                </div>
                <div class="pp__food__inner">
                   <div class="pp__food__details">
                      <h4><a href="menu-details.html">'.$row["name"].'</a></h4>
                      <ul class="rating">';
                        $ratingNum = $row["rating"];
                        $chgnum = 0;
                        while ($chgnum < $ratingNum){
                            $output .= '
                                <li><i class="fa fa-star"></i></li>
                            ';
                            $chgnum = $chgnum + 1;
                        }
                      $output .= '</ul>
                       <p>'.$row["price"].' <i>per</i> '.$row["packaging"].'</p>
                      <div class="pp__food__bottom d-flex justify-content-between align-items-center">
                         <div class="pp__btn">
                            <a class="food__btn btn--transparent btn__hover--theme btn__hover--theme" href="#">More</a>
                         </div>
                         <ul class="pp__meta d-flex">
                            <li><a href="#"><i class="fa  fa-file-text-o"></i>Edit</a></li>
                            <li><a href="#"><i class="fa fa-trash-o"></i>Delete</a></li>
                         </ul>
                      </div>
                   </div>
                </div>
             </div>
          </div>
        <!-- End Single Popular Food -->
        ';
        $row["ID"];
    }
    return $output;
}
// Total goods
    $sqlCount = "SELECT * FROM farmproduce WHERE farmer_id = '$id'";
    $resultCount = $conn->query($sqlCount);
    $datas = array();
    $count = mysqli_num_rows($resultCount);
    echo $count;

// Sold goods

    $sqlCount = "SELECT * FROM farmproduce WHERE farmer_id = '$id'";
    $resultCount = $conn->query($sqlCount);
    $datas = array();
    $count = mysqli_num_rows($resultCount);
    echo $count;

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

        <title>Farmers Details || ElbaMarket</title>
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
                <div class="col-lg-12">
                    <h1 class="page-header">Farmer's Details</h1>
                </div>
                
                <div class="row">
                    <div class="col-xs-6 p-4">
                        <h3>Name: 
                            <input type="text" class="form-control" value="<?php
                                echo $_SESSION["FarmerName"];
                            ?>" readonly>
                        </h3>
                    </div>
                    <div class="col-xs-6 p-4">
                        <i>Phone: 
                            <input type="text" class="form-control" value="<?php
                                echo $_SESSION["FarmerPhone"];
                            ?>" readonly>
                            
                        </i>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 p-4">
                        <h4>Address: 
                            <input type="text" class="form-control" value="<?php
                                echo $_SESSION["FarmerLocation"];
                            ?>" readonly>
                            
                        </h4>
                    </div>
                    <div class="col-xs-6 p-4">
                        <h4>Farm Size: 
                            <input type="text" class="form-control" value="<?php
                                echo $_SESSION["FarmerSize"];
                            ?>" readonly>
                            
                        </h4>
                    </div>
                
                </div>
                <div class="row">
                    <div class="col-xs-6 p-4">
                        <h4>Products: 
                            <input type="text" class="form-control" value="<?php
                                echo $_SESSION["FarmerProducts"];
                            ?>" readonly>
                            
                        </h4>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- Start Counter Up Area -->
        <section class="fd__counterup__area funfact--2" >
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="counter__up__inner d-flex flex-wrap flex-lg-nowrap flex-md-nowrap justify-content-between text-center" style="padding-top:0px;padding-bottom:40px">
                            <!-- Start Single Fact -->
                            <div class="funfact">
                                <div class="fact__details">
                                    <div class="funfact__count__inner">
                                        <div class="fact__icon">
                                            <img src="../../images/icon/flat-icon/newspaper.png" alt="flat icon">
                                        </div>
                                        <div class="fact__count ">
                                            <span class="count"><?php echo $count; ?></span>
                                        </div>
                                    </div>
                                    <div class="fact__title">
                                        <h2>Total</h2>
                                    </div>
                                </div>
                            </div> 
                            <!-- End Single Fact -->
                            <!-- Start Single Fact -->
                            <div class="funfact">
                                <div class="fact__details">
                                    <div class="funfact__count__inner">
                                        <div class="fact__icon">
                                            <img src="../../images/icon/flat-icon/sold.png" alt="flat icon">
                                        </div>
                                        <div class="fact__count">
                                            <span class="count">0</span>
                                        </div>
                                    </div>
                                    <div class="fact__title">
                                        <h2>Sold</h2>
                                    </div>
                                </div>
                            </div> 
                            <!-- End Single Fact -->
                            <!-- Start Single Fact -->
                            <div class="funfact">
                                <div class="fact__details">
                                    <div class="funfact__count__inner">
                                        <div class="fact__icon">
                                            <img src="../../images/icon/flat-icon/diet(2).png" alt="flat icon">
                                        </div>
                                        <div class="fact__count ">
                                            <span class="count">0</span>
                                        </div>
                                    </div>
                                    <div class="fact__title">
                                        <h2>Remainder</h2>
                                    </div>
                                </div>
                            </div> 
                            <!-- End Single Fact -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Counter Up Area -->
            <div class="row" id="product" style="padding-top:0px">
                <h3>A list of all your products</h3>
                <?php echo fill_product($conn); ?>
                <!-- End Single Popular Food -->
            </div>
        </div>
        <!-- /#page-wrapper -->

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
