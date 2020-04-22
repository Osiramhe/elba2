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
$id = $_GET["id"];

// define variables and set to empty values


if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
                if ($fileSize < 9000000000000){
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
        $date = date("y/m/d");
        $time = date("h:i:sa");
        $product_id_uniq = uniqid();
        $product_id = substr_replace ($p_name, $product_id_uniq, 2, 2);
        // Insert Statement
        $id = $_SESSION["Uploadid"];
        $sql = "UPDATE farmproduce SET name='$p_name', category='$p_category', price='$p_price', packaging='$p_packaging', image='$p_image',location='$p_location', rating='$p_rating', quantity='$p_quantity', description='$p_description', date='$date', time='$time' WHERE product_id= '".$id."'";
        // --Insert Statement
        if ($connProduce->query($sql) === TRUE) {
            header("Location:adminProduct.php?New record created successfully");
        } else {
            echo "Error: " . $sql . "<br>" . $connProduce->error;
        }
    }else{
        echo "Unsuccessful";
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
                <div class="col-lg-12 col-md-12 col-sm-12">
                    
<?php
                    
include "db-conn.php";
    $id = $_GET["id"];
    $_SESSION["Uploadid"] = $id;
    $sqlProduct = "SELECT * FROM farmproduce WHERE product_id ='$id' ";
    $resultProduct = $conn->query($sqlProduct);
    while ($row = mysqli_fetch_array($resultProduct)){
        $EditName = $row["name"];
        $EditCategory = $row["category"];
        $EditPrice = $row["price"];
        $EditPackaging = $row["packaging"];
        $EditImage = $row["image"];
        $EditLocation = $row["location"];
        $EditRating = $row["rating"];
        $EditQuantity = $row["quantity"];
        $EditDescription = $row["description"];
        
    }
?>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                    <div class="food__menu__container">
                        <div class="food__menu__inner d-flex flex-wrap flex-md-nowrap flex-lg-nowrap">
                            <div class="food__menu__thumb">
                                <img src="uploads/<?php echo $EditImage; ?>" alt="images" width="350px" height="300px">
                                <input class="form-control" type="file" name="p_image" value="" required>
                                
                            </div>
                            <div class="food__menu__details">
                                <div class="food__menu__content mt-3">
                                    <label> <span style="font-size:1.4em;">Product Name</span>
                                    <input type="text" name="p_name" class="form-control mt-3" placeholder="Product Name" required="required" data-validation-required-message="Please enter the product name." value="<?php echo $EditName; ?>"> 
                                    </label>
                                    <label> <span style="font-size:1.4em;">Product Location</span>
                                    <input type="text" name="p_location" class="form-control mt-3" value="<?php echo $EditLocation; ?>" readonly> 
                                    </label>
                                    <ul class="food__dtl__prize d-flex">
                                        <li>
                                            <label> <span style="font-size:1em;" class="text-muted">Product Price</span>
                                            <input type="text" name="p_price" class="form-control mt-3" placeholder="Product price" value="<?php echo $EditPrice; ?>" required>
                                            </label>
                                        </li>
                                        <li class="mt-5"><span style="font-size:.7em;" class="text-muted">per</span></li>
                                        <li>
                                            <label> <span style="font-size:1em;" class="text-muted">Product Packaging</span>
                                            <input type="text" name="p_packaging" class="form-control mt-3" placeholder="Product packaging" required value="<?php echo $EditPackaging; ?>">
                                            </label>
                                        </li>
                                    </ul>
                                    <ul class="rating">
                                        <label> <span style="font-size:1.4em;">Product rating</span>
                                        <select class="form-control" name="p_rating" required v>
                                            <option value="<?php echo $EditRating; ?>" selected><?php echo $EditRating; ?></option>
                                        </select>
                                        </label>
                                    </ul>
                                    <p>
                                        <label><span style="font-size:1.4em;">Description</span>
                                        <textarea name="p_description" col="55" rows="3" class="form-control" ><?php echo $EditDescription; ?></textarea>
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
                                                <option value="<?php echo $EditCategory; ?>" selected><?php echo $EditCategory; ?></option>
                                                <?php echo fill_category($conn); ?>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="product-quantity">
                                            <div class="product-quantity">
                                                <label class="mt-3" style="font-size:1.4em;">Available Quantity</label>
                                                <div class="cart-plus-minus" style="margin-top:0px;">
                                                    <input class="cart-plus-minus-box" type="text" name="p_quantity" value="<?php echo $EditQuantity; ?>">
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
                                Edit Product
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

</body>

</html>
