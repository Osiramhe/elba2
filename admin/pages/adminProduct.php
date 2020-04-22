<?php
if(empty($_SESSION)){ // if the session not yet started
   session_start();
}
if(!isset($_SESSION['AdminId'])) { //if not yet logged in
   header("Location:login.php?Not logged in");// send to login page
   exit;
}
if ($_SESSION["welcome"] != ""){
    $welcome = $_SESSION["welcome"];
    echo "<script type='text/javascript'>alert('$welcome');</script>";
    $_SESSION["welcome"] = "";
}
?>
<?php
include "db-conn.php";

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
    $output = '';
    $sqlProduct = "SELECT * FROM farmproduce";
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
                      <span>'.$row["quantity"].'</span>
                   </div>
                </div>
                <div class="pp__food__inner">
                   <div class="pp__food__details">
                      <h4><a href="menu-details.html">'.$row["name"].'</a></h4>
                       <p>&#8358 '.$row["price"].' <i>per</i> '.$row["packaging"].' kg</p>
                      <div class="pp__food__bottom d-flex justify-content-between align-items-center">
                         <div class="pp__btn">
                            <a class="food__btn btn--transparent btn__hover--theme btn__hover--theme" href="#">More</a>
                         </div>
                         <ul class="pp__meta d-flex">
                            <li><a href="editProduct.php?id='.$row["product_id"].'"><i class="fa  fa-file-text-o"></i>Edit</a></li>
                            <li><a href="deleteProduce.php?id='.$row["ID"].'"><i class="fa fa-trash-o"></i>Delete</a></li>
                         </ul>
                      </div>
                   </div>
                </div>
             </div>
          </div>
        <!-- End Single Popular Food -->
        ';
    }
    return $output;
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

    <title>Products || ElbaMarket</title>
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
    <link rel="stylesheet" href="../plugins.css">
    <link rel="stylesheet" href="../style.css">
    <!-- Cusom css -->
    <link rel="stylesheet" href="../custom.css">
    <!-- Modernizer js -->
    <script src="../../js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="../vendor/jquery/jquery.min.js"></script>

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
                    <h1 class="page-header">Products</h1>
                </div>
                <div class="col-xs-6 pl-5 pb-3">
                    <label for="cat" class="m-3">Category</label>
                    <a href="#" class="btn btn-danger accountbox-trigger m-2">New Category</a>
                    <a href="addDeliveryRate.php" class="btn btn-success m-2">Add Delivery Cost</a>
                    <a href="addkilo.php" class="btn btn-primary m-2">Refresh Kilogram</a>
                    <select name="product_category" id="cat" class="form-control">
                        <option selected value="All">All</option>
                        <?php echo fill_category($conn); ?>
                    </select>
                </div>
                <div class="col-xs-6 pt-5 pb-4 ">
                    <a href="addProductIni.php" class="btn btn-danger pull-right">
                        Add new product
                    </a>
                </div>
                
                <!-- /.col-lg-12 -->
            </div>
            
            <div class="row" id="show_product">
                <?php echo fill_product($conn); ?>
            </div>
      
        </div>
        <!-- /#page-wrapper -->
        
        <!-- Login Form -->
        <div class="accountbox-wrapper">
        <div class="accountbox text-center">
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
            
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Categories
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
<?php
include "db-conn.php";
function fill_catTable ($conn){
    $output = '';
    $sqlProduct = "SELECT * FROM category";
    $resultProduct = $conn->query($sqlProduct);
    $IncID = 1;
    while ($row = mysqli_fetch_array($resultProduct)){
        $output .= '
            <tr class="odd gradeX">
            <form action="" method="POST">
                <td>'.$IncID.'</td>
                <td>'.$row["category_name"].'</td>
                <td class="center">
                    <a href="deleteCat.php?id='.$row["id"].'" class="btn btn-danger">Delete</a>
                </td>
            </form>
            </tr>
        ';
        $IncID ++;
    }
    return $output;
}
?>
                                    
                                    <?php echo fill_catTable($conn) ?>
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
    <script>
        $(document).ready(function(){
            $('#cat').change(function(){
                var cat_value = $(this).val();
                $.ajax({
                    url: "category.php",
                    method:"POST",
                    data:{cat_value:cat_value},
                    success: function(data){
                        $("#show_product").html(data);
                    }
                });
            });
        });
    </script>

</body>

</html>
