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
//Change Image
function chgImage($connProduce){
    $outImage = '';
    $outImage .= '<img src="../../images/banner/details/1.jpg" alt="images" width="350px" height="400px" id="show_image">';
    
    return $outImage;
}

$id = $_GET["id"];
                    
$sqlfarm = "SELECT * FROM farmers WHERE farmer_id = '$id'";
$resultfarm = mysqli_query($connProduce, $sqlfarm);

while($rowfarm = mysqli_fetch_array($resultfarm))
{
        $_SESSION["Farm_location"]=$rowfarm['location'];
        $_SESSION["Farm_id"]=$rowfarm['farmer_id'];
}

// define variables and set to empty values


if (isset($_POST['addProduct'])) {
    $p_imageErr = $p_nameErr = $p_priceErr = $p_ratingErr = $p_quantityErr = $p_locationErr = $p_categoryErr = $p_packagingErr = $p_descriptionErr = "";
    // Form validation
    if (empty($_POST["p_name"])) {
        $p_nameErr = "Name is required";
    } else {
        $p_name1 = test_input($_POST["p_name"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$p_name1)) { 
            $p_nameErr = "Only letters and white space allowed";
        }else{
            $p_name = test_input($_POST["p_name"]);
        }
        
    }
    if (empty($_POST["p_category"])) {
        $p_categoryErr = "Category is required";
    } else {
        $p_category = test_input($_POST["p_category"]);
        
    }
    if (empty($_POST["p_price"])) {
        $p_priceErr = "Price is required";
    } else {
        $p_price = test_input($_POST["p_price"]);
        
    }
    if (empty($_POST["p_packaging"])) {
        $p_packagingErr = "Name is required";
    } else {
        $p_packaging = test_input($_POST["p_packaging"]);
        
    }
    if (empty($_POST["p_rating"])) {
        $p_ratingErr = "rating is required";
    } else {
        $p_rating = test_input($_POST["p_rating"]);
        
    }
    if (empty($_POST["p_description"])) {
        $p_descriptionErr = "description is required";
    } else {
        $p_description = test_input($_POST["p_description"]);
        
    }
    if (empty($_POST["p_location"])) {
        $p_locationErr = "location is required";
    } else {
        $p_location = test_input($_POST["p_location"]);
        
    }
    if (empty($_POST["p_quantity"])) {
        $p_quantityErr = "quantity is required";
    } else {
        $p_quantity = test_input($_POST["p_quantity"]);
        
    }
    // --Form validation
    
    // Image Uploader
     if (isset($_POST["addProduct"])){
        $file = $_FILES['p_image'];
        $fileName = $_FILES['p_image']['name'];
        $fileTmpName = $_FILES['p_image']['tmp_name'];
        $fileSize = $_FILES['p_image']['size'];
        $fileError = $_FILES['p_image']['error'];
        $fileType = $_FILES['p_image']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'jfif');

        if (in_array($fileActualExt, $allowed)){
            if($fileError === 0){
                if ($fileSize < 10000000000000){
                    $p_image = uniqid('', true).".".$fileActualExt;
                    $fileDest = "../pages/uploads/".$p_image;
                    move_uploaded_file($fileTmpName, $fileDest);
                } else {
                    echo "File size is more than the required";
                }
            } else {
                echo "There was an error uploading your file";
            }
        } else{
            echo "You can not upload files of this type!";
        }

    }    
    // --Image Uploader
    
    // Inserting data into the database
    if ($p_nameErr == "" && $p_categoryErr == "" && $p_priceErr == "" && $p_packagingErr == "" && $p_ratingErr == "" && $p_descriptionErr == "" && $p_locationErr == "" && $p_quantityErr == ""){
        date_default_timezone_set("Africa/Lagos");
        $date = date("y/m/d");
        $time = date("h:i:sa");
        $product_id_uniq = uniqid();
        $product_id = substr_replace ($p_name, $product_id_uniq, 2, 2);
        
            // Insert Statement into farmproduce table
            $id2 = $_SESSION["Farm_id"];
            $sql = "INSERT INTO farmproduce(name, category, price, packaging, image, location, rating, quantity, description, date, time, product_id,farmer_id) VALUES ('$p_name','$p_category','$p_price','$p_packaging','$p_image','$p_location','$p_rating','$p_quantity','$p_description','$date','$time', '$product_id','$id2')";
            // --Insert Statement
            if ($connProduce->query($sql) === TRUE) {
                header("Location:adminProduct.php?New record created successfully");
            } else {
                echo "Error: " . $sql . "<br>" . $connProduce->error;
            }
        

    }else{
        echo "Unsuccessful";
        echo $p_imageErr.$p_nameErr.$p_priceErr.$p_ratingErr.$p_quantityErr.$p_locationErr.$p_categoryErr.$p_packagingErr.$p_descriptionErr;
    }
    // --Inserting data into the database
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

    <title>Add Products || ElbaMarket</title>
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
    <link rel="stylesheet" href="../style.css">
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
                <div class="col-lg-12 col-md-12 col-sm-12">
                    


                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <?php echo chgImage($connProduce) ?>

                                        
                                        <input class="form-control mt-3" type="file" name="p_image" required id="image">
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="food__menu__content mt-3">
                                            <label> <span style="font-size:1.4em;">Product Name</span>
                                            <input type="text" name="p_name" class="form-control mt-3" placeholder="Product Name" required="require" data-validation-required-message="Please enter the product name."> 
                                            </label>
                                            <label> <span style="font-size:1.4em;">Product Location</span>
                                            <input type="text" name="p_location" class="form-control mt-3" value="<?php echo $_SESSION["Farm_location"] ?>" readonly> 
                                            </label>
                                            <ul class="food__dtl__prize d-flex">
                                                <li>
                                                    <label> <span style="font-size:1em;" class="text-muted">Product Price</span>
                                                    <input type="text" name="p_price" class="form-control mt-3" placeholder="Product price" required="require" data-validation-required-message="Please enter the product price.">
                                                    </label>
                                                </li>
                                                
        <!-- category selector -->
        <?php
        include "db-conn.php";
        function fill_Kilo ($conn){
            $output = '';
            $sqlKilo = "SELECT * FROM kilo";
            $resultKilo = $conn->query($sqlKilo);
            while ($rowKilo = mysqli_fetch_array($resultKilo)){
                $output .= '<option value="'.$rowKilo["kilo"].'">'.$rowKilo["kilo"].'</option>';
            }
            return $output;
        }
        ?>
                                                
                                                <li class="mt-5"><span style="font-size:.7em;" class="text-muted">per</span></li>
                                                <li>
                                                    <label> <span style="font-size:1em;" class="text-muted">Product Packaging</span>
                                                    <select name="p_packaging" class="form-control" required>
                                                        <?php echo fill_Kilo($conn); ?>
                                                    </select>
                                                    </label>
                                                </li>
                                            </ul>
                                            <ul class="rating">
                                                <label> <span style="font-size:1.4em;">Product rating</span>
                                                <select class="form-control" name="p_rating" required>
                                                    <option value="1" selected>1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                                </label>
                                            </ul>
                                            <p>
                                                <label><span style="font-size:1.4em;">Description</span>
                                                <textarea name="p_description" col="55" rows="3" class="form-control"></textarea>
                                                </label>
                                            </p>
        <!-- category selector -->
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
        ?>

                                            <div class="product-action-wrap">
                                                <div class="prodict-statas"><label for="category" style="font-size:1.4em;">Food Category :   
                                                </label>
                                                <div>
                                                    <select class="form-control" id="category" name="p_category" required>
                                                        <?php echo fill_category($conn); ?>
                                                    </select>
                                                </div>
                                                </div>
                                                <div class="product-quantity">
                                                    <div class="product-quantity">
                                                        <label class="mt-3" style="font-size:1.4em;">Available Quantity</label>
                                                        <div class="cart-plus-minus" style="margin-top:0px;">
                                                            <input class="cart-plus-minus-box" type="text" name="p_quantity" value="02">
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Start Product Descrive Area -->
                        <div class="col-lg-12 text-center mt-5 mb-5">
                            <button type="submit" name="addProduct" class="btn btn-danger">
                                Add New Product
                            </button>
                        </div>
                        <!-- End Product Descrive Area -->
                    </div>
                    </form>
                </div>
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
            $('#image').click(function(){
                var fd = new FormData();
                var files = $('#file')[0].files[0];
                fd.append('file',files);
                $.ajax({
                    url: "addProduct.php",
                    method: "POST",
                    data: fd,
                    success: function(data){
                        $('#show_image').php(data);
                    }
                });
            });
        });
    </script>

</body>

</html>
