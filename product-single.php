<?php
include "db-conn.php";
$id=$_GET['id'];
$sql = "SELECT * FROM farmproduce WHERE product_id = '$id'";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result))
    {
        $_SESSION["D_name"]=$row['name'];
        $_SESSION['D_image']=$row['image'];
        $_SESSION["D_category"]=$row['category'];
        $_SESSION["D_price"]=$row['price'];
        $_SESSION["D_description"]=$row['description'];
        $D_name=$row['name'];
        $D_image=$row['image'];
        $D_category=$row['category'];
        $D_price=$row['price'];
        $D_description=$row['description'];
        $D_ID=$row['product_id'];
        $D_packaging=$row['packaging'];
        $D_productID=$row['product_id'];
        // $time=$row['time'];
    }
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if(empty($_SESSION)){ // if the session not yet started
   session_start();
}
//Refill category database
$sqlGenre1 = "SELECT * FROM farmproduce";
$resultGenre1 = $conn->query($sqlGenre1);

if ($resultGenre1->num_rows > 0) {
    // output data of each row
    while($rowGenre1 = $resultGenre1->fetch_assoc()) {
        $genre1 = $rowGenre1["category"];
        // check if the category already exist in category database
        $sqlGenre1New = "SELECT * FROM category WHERE category_name = '$genre1'";
        $resultGenre1New = $conn->query($sqlGenre1New);
        if ($resultGenre1New->num_rows > 0) {
            
        }else{
            $sqlInsertGenre1 = "INSERT INTO category (category_name,category_value)
            VALUES ('$genre1','$genre1')";

            if ($conn->query($sqlInsertGenre1) === TRUE) {
            } else {
            }
        }
    }
} else {
}


/* fillCategory */
function fillCategory ($conn){
    $outputGenres = '';
    $sql = "SELECT * FROM category ORDER BY category_name ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $incr =2;
        
        $sqlUpload = "SELECT count(product_id) FROM farmproduce";
        $resultUpload = $conn->query($sqlUpload);
        while ($row = mysqli_fetch_array($resultUpload)){
            $output = $row["count(product_id)"];
        }
        $outputGenres .= '
            <li class="p-b-5">
                <button class="flex-sb-m flex-w txt-s-101 cl6 hov-cl10 trans-04 p-tb-3" style="width:100%" data-filter="*">
                    <span class="m-r-10">
                        All Products
                    </span>

                    <span>
                        '.$output.'
                    </span>
                </button>
            </li>
        ';
        while($row = $result->fetch_assoc()) {
            $sqlUpload = "SELECT count(category) FROM farmproduce WHERE category = '".$row["category_name"]."'";
            $resultUpload = $conn->query($sqlUpload);
            while ($rowOut = mysqli_fetch_array($resultUpload)){
                $output = $rowOut["count(category)"];
            }
            $outputGenres .= '
                <li class="p-b-5">
                    <button class="cat flex-sb-m flex-w txt-s-101 cl6 hov-cl10 trans-04 p-tb-3" style="width:100%" data-filter=".'.$row["category_value"].'">
                        <span class="m-r-10">
                            '.$row["category_name"].'
                        </span>

                        <span>
                            '.$output.'
                        </span>
                    </button>
                </li>
            ';
            $incr ++;
        }
    } else {
    }
    return $outputGenres;
}


/* fillproduct */
function fillProduct ($conn){
    $outputGenres = '';
    $sql = "SELECT * FROM farmproduce LIMIT 10";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $incr =2;
        while($row = $result->fetch_assoc()) {

            $outputGenres .= '
            
					<!-- - -->
					<div class="item-slick9 p-all-15">
						<!-- Block1 -->
						<div class="block1">
							<div class="block1-bg wrap-pic-w bo-all-1 bocl12 hov3 trans-04">
								<img src="admin/pages/uploads/'.$row["image"].'" class="p-img" alt="IMG">

								<div class="block1-content flex-col-c-m p-b-46">
									<a href="product-single.php?id='.$row['product_id'].'" class="txt-m-103 cl3 txt-center hov-cl10 trans-04 js-name-b2">
										'.$row["name"].'
									</a>

									<span class="block1-content-more txt-m-104 cl9 p-t-21 trans-04">
										&#8358 '.$row['price'].' per '.$row['packaging'].'kg
									</span>

									<div class="block1-wrap-icon flex-c-m flex-w trans-05">
										<a href="product-single.php?id='.$row['product_id'].'" class="block1-icon flex-c-m wrap-pic-max-w">
											<img src="images/icons/icon-view.png" alt="ICON">
										</a>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="text" name="otherID" value="'.$row['product_id'].'" style="display:none">
                                            <button type="submit"  name="submitOther" href="product-single.php?id2='.$row['product_id'].'" class="block1-icon flex-c-m wrap-pic-max-w js-addcart-b2">
                                                <img src="images/icons/icon-cart.png" alt="ICON">
                                            </button>    
                                        </form>
									</div>
								</div>
							</div>
						</div>
					</div>
            ';
            $incr ++;
        }
    } else {
    }
    return $outputGenres;
}

/* fillVegetableSpecial */
function fillVegSpecial ($conn){
    $outputGenres = '';
    $sql = "SELECT * FROM farmproduce WHERE category = 'Vegetables' LIMIT 3";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $incr =2;
        while($row = $result->fetch_assoc()) {

            $outputGenres .= '
            
                <li class="flex-w flex-sb-t p-b-30">
                    <a href="product-single.php?id='.$row['product_id'].'" class="size-w-50 wrap-pic-w bo-all-1 bocl12 hov8 trans-04">
                        <img src="admin/pages/uploads/'.$row["image"].'" alt="IMG" class="ps-img">
                    </a>

                    <div class="size-w-51 flex-col-l p-t-12">
                        <a href="product-single.php" class="txt-m-103 cl3 hov-cl10 trans-04 p-b-12">
                            '.$row["name"].'
                        </a>

                        <span class="txt-m-104 cl9">
                            &#8358 '.$row['price'].' per '.$row['packaging'].'kg
                        </span>
                    </div>
                </li>
            ';
            $incr ++;
        }
    } else {
    }
    return $outputGenres;
}

/* fillTuberSpecial */
function fillTubSpecial ($conn){
    $outputGenres = '';
    $sql = "SELECT * FROM farmproduce WHERE category = 'Tubers' LIMIT 3";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $incr =2;
        while($row = $result->fetch_assoc()) {

            $outputGenres .= '
                <!-- item product2 -->
                <a href="product-single.php?id='.$row['product_id'].'" class="flex-w flex-str size-h-1 bo-all-1 bocl12 hov3 trans-04 m-b-30">
                    <div class="size-w-6 flex-c-m wrap-pic-max-s">
                        <img src="admin/pages/uploads/'.$row["image"].'" alt="IMG" class="ps-img">
                    </div>

                    <div class="size-w-7 flex-col-m p-l-30 p-tb-15 p-r-15 p-l-0-ssm">
                        <span class="txt-m-103 cl3">
                            '.$row["name"].'
                        </span>

                        <div class="how-line1 m-t-14 m-b-19"></div>

                        <span class="txt-m-104 cl9">
                            &#8358 '.$row['price'].' per '.$row['packaging'].'kg
                        </span>
                    </div>
                </a>
            ';
            $incr ++;
        }
    } else {
    }
    return $outputGenres;
}

/* fillGrainsSpecial */
function fillGrainsSpecial ($conn){
    $outputGenres = '';
    $sql = "SELECT * FROM farmproduce WHERE category = 'Grains' LIMIT 3";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $incr =2;
        while($row = $result->fetch_assoc()) {

            $outputGenres .= '
                <!-- item product2 -->
                <a href="product-single.php?id='.$row['product_id'].'" class="flex-w flex-str size-h-1 bo-all-1 bocl12 hov3 trans-04 m-b-30">
                    <div class="size-w-6 flex-c-m wrap-pic-max-s">
                        <img src="admin/pages/uploads/'.$row["image"].'" alt="IMG" class="ps-img">
                    </div>

                    <div class="size-w-7 flex-col-m p-l-30 p-tb-15 p-r-15 p-l-0-ssm">
                        <span class="txt-m-103 cl3">
                            '.$row["name"].'
                        </span>

                        <div class="how-line1 m-t-14 m-b-19"></div>

                        <span class="txt-m-104 cl9">
                            &#8358 '.$row['price'].' per '.$row['packaging'].'kg
                        </span>
                    </div>
                </a>
            ';
            $incr ++;
        }
    } else {
    }
    return $outputGenres;
}

//Count vegetables
function count_veg ($conn){
    $output = '';
    //$user_id = $_SESSION["user_id"];
    $sqlUpload = "SELECT count(category) FROM farmproduce WHERE category = 'Vegetables'";
    $resultUpload = $conn->query($sqlUpload);
    while ($row = mysqli_fetch_array($resultUpload)){
        $output .= $row["count(category)"];
    }
    return $output;
}

//Count fruits
function count_fruits ($conn){
    $output = '';
    //$user_id = $_SESSION["user_id"];
    $sqlUpload = "SELECT count(category) FROM farmproduce WHERE category = 'Fruits'";
    $resultUpload = $conn->query($sqlUpload);
    while ($row = mysqli_fetch_array($resultUpload)){
        $output .= $row["count(category)"];
    }
    return $output;
}

//Count tubers
function count_tub ($conn){
    $output = '';
    //$user_id = $_SESSION["user_id"];
    $sqlUpload = "SELECT count(category) FROM farmproduce WHERE category = 'Tubers'";
    $resultUpload = $conn->query($sqlUpload);
    while ($row = mysqli_fetch_array($resultUpload)){
        $output .= $row["count(category)"];
    }
    return $output;
}

//Count spices
function count_spices ($conn){
    $output = '';
    //$user_id = $_SESSION["user_id"];
    $sqlUpload = "SELECT count(category) FROM farmproduce WHERE category = 'Spices'";
    $resultUpload = $conn->query($sqlUpload);
    while ($row = mysqli_fetch_array($resultUpload)){
        $output .= $row["count(category)"];
    }
    return $output;
}


/* End PHP Script */
?>

<!-- Cart PHP Script -->
<?php
function fillCart ($conn){
    $outputGenres = '';
    // -- Get ip details
    if(!isset($_SESSION['user_id'])) { //if not yet logged in
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{

            $ip = $_SERVER['REMOTE_ADDR'];
        }
    }else{
        $ip = $_SESSION['user_id'];
    }
    $sql = "SELECT * FROM addCart WHERE address = '$ip'";
    $result = $conn->query($sql);
    $total =0;
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $beat_id = $row["p_id"];
            $sqlImage = "SELECT * FROM farmproduce WHERE product_id = '$beat_id'";
            $resultImage = $conn->query($sqlImage);

            if ($resultImage->num_rows > 0) {
                // output data of each row
                while($rowImage = $resultImage->fetch_assoc()) {
                    $image = $rowImage["image"];
                }
            }
            $outputGenres .= '
							<div class="flex-w flex-str m-b-25">
								<div class="size-w-15 flex-w flex-t">
									<a href="product-single.php" class="wrap-pic-w bo-all-1 bocl12 size-w-16 hov3 trans-04 m-r-14">
										<img src="admin/pages/uploads/'.$image.'" alt="PRODUCT">
									</a>

									<div class="size-w-17 flex-col-l">
										<a href="product-single.php" class="txt-s-108 cl3 hov-cl10 trans-04">
											'.$row["p_name"].'
										</a>

										<span class="txt-s-101 cl9">
											&#8358 '.$row["price"].'
										</span>

										<span class="txt-s-109 cl12">
											x'.$row["quantity"].'
										</span>
									</div>
								</div>
							</div>
            ';
        }
    } else {
    }
    return $outputGenres;

}
//Total prices
function total ($conn){
    $outputGenres = '';
    // -- Get ip details
    if(!isset($_SESSION['user_id'])) { //if not yet logged in
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{

            $ip = $_SERVER['REMOTE_ADDR'];
        }
    }else{
        $ip = $_SESSION['user_id'];
    }
    $sql = "SELECT SUM(price) FROM addCart WHERE address = '$ip'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $outputGenres .= $row["SUM(price)"];
        }
    } else {
    }
    return $outputGenres;

}
//Count all cart
function count_cart ($conn){
    $output = '';
    // -- Get ip details
    if(!isset($_SESSION['user_id'])) { //if not yet logged in
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{

            $ip = $_SERVER['REMOTE_ADDR'];
        }
    }else{
        $ip = $_SESSION['user_id'];
    }
    $sqlBeat = "SELECT count(p_name) FROM addCart WHERE address = '$ip'";
    $resultBeat = $conn->query($sqlBeat);
    while ($row = mysqli_fetch_array($resultBeat)){
        $output .= $row["count(p_name)"];
    }
    return $output;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Product Details</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/elba.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/lightbox2/css/lightbox.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/noui/nouislider.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slide100/slide100.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
    <style>
        .p-img{
            width: 245px;
            height: 323px;
        }
        .ps-img{
            width: 116px;
            height: 67px;
        }
    </style>
</head>
<body class="animsition">

	<!-- Header -->
	<?php include "header.php" ?>

	<!-- Product detail -->
	<section class="sec-product-detail bg0 p-t-105 p-b-70">
		<div class="container">
			<div class="row">
				<div class="col-md-7 col-lg-6">
					<div class="m-r--30 m-r-0-lg">
						<!-- Slide 100 -->
						<div id="slide100-01">
							<div class="wrap-main-pic-100 bo-all-1 bocl12 pos-relative">
								<div class="main-frame">
									<div class="wrap-main-pic">
										<div class="main-pic">
											<img src="admin/pages/uploads/<?php echo $D_image; ?>" alt="IMG-SLIDE">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-5 col-lg-6">
					<div class="p-l-70 p-t-35 p-l-0-lg">
						<h4 class="js-name2 txt-l-104 cl3 p-b-16">
							<?php
                                echo $D_name;
                            ?>
						</h4>

						<span class="txt-m-117 cl9">
                            &#8358 <?php echo $D_price;?>
						</span>

						<div class="flex-w flex-m p-t-55 p-b-30">
                            <form action="" method="post" enctype="multipart/form-data">
							<div class="wrap-num-product flex-w flex-m bg12 p-rl-10 m-r-30 m-b-30">
								<div class="btn-num-product-down flex-c-m fs-29"></div>

								<input class="txt-m-102 cl6 txt-center num-product" type="number" name="num-product" value="1">
								<div class="btn-num-product-up flex-c-m fs-16"></div>
                                <input type="text" value="<?php echo $D_productID;?>" name="productID" style="display:none">
							</div>

							<button type="submit" name="submitCart" class="flex-c-m txt-s-103 cl0 bg10 size-a-2 hov-btn2 trans-04 m-b-30 js-addcart2">
								Add to cart
							</button>
                            </form>
						</div>
						<div class="txt-s-107 p-b-6">
							<span class="cl6">
								Category:
							</span>

							<span class="cl9">
                                <?php
                                    echo $D_category;
                                ?> 
							</span>
						</div>
					</div>
				</div>
			</div>

			<!-- Tab01 -->
			<div class="tab02 p-t-80">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#info" role="tab">Additional Information</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<!-- - -->
					<div class="tab-pane fade show active" id="description" role="tabpanel">
						<div class="p-t-30">
							<p class="txt-s-112 cl9">
                                <?php echo $D_description;?>
							</p>
						</div>
					</div>

					<!-- - -->
					<div class="tab-pane fade" id="info" role="tabpanel">
						<ul class="p-t-21">
							<li class="txt-s-101 flex-w how-bor2 p-tb-14">
								<span class="cl6 size-w-54">
									Weight
								</span>

								<span class="cl9 size-w-55">
									<?php echo $D_packaging;?> kg
								</span>
							</li>

							<li class="txt-s-101 flex-w how-bor2 p-tb-14">
								<span class="cl6 size-w-54">
									Counrty of Origin
								</span>

								<span class="cl9 size-w-55">
									Nigeria
								</span>
							</li>

							<li class="txt-s-101 flex-w how-bor2 p-tb-14">
								<span class="cl6 size-w-54">
									Quality
								</span>

								<span class="cl9 size-w-55">
									Standard
								</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<!-- Related product -->
	<section class="sec-related bg0 p-b-85">
		<div class="container">
			<!-- slide9 -->
			<div class="wrap-slick9">
				<div class="flex-w flex-sb-m p-b-33 p-rl-15">
					<h3 class="txt-l-112 cl3 m-r-20 respon1 p-tb-15">
						Other PRODUCTS
					</h3>

					<div class="wrap-arrow-slick9 flex-w m-t-6"></div>
				</div>

				<div class="slick9" style="height:350px">
                    <?php echo fillProduct($conn) ?>
				</div>
			</div>
		</div>
	</section>

	<!-- Subscribe -->
	<section class="sec-subscribe bg13 p-t-65 p-b-65">
		<div class="container">
			<div class="row">
				<div class="col-md-5 p-tb-15">
					<div class="h-full flex-col-m">
						<h4 class="txt-m-110 cl3 p-b-4">
							Subscribe Newsletter.
						</h4>

						<p class="txt-s-101 cl6">
							Get e-mail updates about our latest shop and special offers.
						</p>
					</div>
				</div>

				<div class="col-md-7 p-tb-15">
					<form action="" method="post" enctype="multipart/form-data" class="flex-w flex-m h-full">
						<input class="size-a-6 txt-s-106 cl6 plh0 p-rl-30 w-full-sm" type="text" name="email" placeholder="Your email address">
						<button class="bg10 size-a-5 txt-s-107 cl0 p-rl-15 trans-04 hov-btn2 mt-4 mt-sm-0">
							Subscribe
						</button>
					</form>
				</div>
			</div>
		</div>
	</section>

	<!-- Footer -->
	<footer class="bg12">
		<div class="container">
			<div class="wrap-footer flex-w p-t-60 p-b-62">
				<div class="footer-col1">
					<div class="footer-col-title">
						<a href="#">
							<img src="images/icons/logo-01.png" alt="LOGO">
						</a>
					</div>

					<p class="txt-s-101 cl6 size-w-10 p-b-16">
						There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
					</p>

					<ul>
						<li class="txt-s-101 cl6 flex-t p-b-10">
							<span class="size-w-11">
								<img src="images/icons/icon-mail.png" alt="ICON-MAIL">
							</span>
							
							<span class="size-w-12 p-t-1">
								markrussell@example.com
							</span>
						</li>

						<li class="txt-s-101 cl6 flex-t p-b-10">
							<span class="size-w-11">
								<img src="images/icons/icon-pin.png" alt="ICON-MAIL">
							</span>
							
							<span class="size-w-12 p-t-1">
								No 40 Baria Sreet 133/2, NewYork
							</span>
						</li>

						<li class="txt-s-101 cl6 flex-t p-b-10">
							<span class="size-w-11">
								<img src="images/icons/icon-phone.png" alt="ICON-MAIL">
							</span>
							
							<span class="size-w-12 p-t-1">
								(785) 977 5767
							</span>
						</li>
					</ul>
				</div>

				<div class="footer-col2">
					<div class="footer-col-title flex-m">
						<span class="txt-m-109 cl3">
							Information
						</span>
					</div>

					<ul>
						<li class="p-b-16">
							<a href="#" class="txt-s-101 cl6 hov-cl10 trans-04 p-tb-5">
								About our shop
							</a>
						</li>

						<li class="p-b-16">
							<a href="#" class="txt-s-101 cl6 hov-cl10 trans-04 p-tb-5">
								Top sellers
							</a>
						</li>

						<li class="p-b-16">
							<a href="#" class="txt-s-101 cl6 hov-cl10 trans-04 p-tb-5">
								Our blog
							</a>
						</li>

						<li class="p-b-16">
							<a href="#" class="txt-s-101 cl6 hov-cl10 trans-04 p-tb-5">
								New products
							</a>
						</li>

						<li class="p-b-16">
							<a href="#" class="txt-s-101 cl6 hov-cl10 trans-04 p-tb-5">
								Secure shopping
							</a>
						</li>
					</ul>
				</div>

				<div class="footer-col3">
					<div class="footer-col-title flex-m">
						<span class="txt-m-109 cl3">
							My Account
						</span>
					</div>

					<ul>
						<li class="p-b-16">
							<a href="#" class="txt-s-101 cl6 hov-cl10 trans-04 p-tb-5">
								My account
							</a>
						</li>

						<li class="p-b-16">
							<a href="#" class="txt-s-101 cl6 hov-cl10 trans-04 p-tb-5">
								Discount
							</a>
						</li>

						<li class="p-b-16">
							<a href="#" class="txt-s-101 cl6 hov-cl10 trans-04 p-tb-5">
								Personal information
							</a>
						</li>

						<li class="p-b-16">
							<a href="#" class="txt-s-101 cl6 hov-cl10 trans-04 p-tb-5">
								My address
							</a>
						</li>

						<li class="p-b-16">
							<a href="#" class="txt-s-101 cl6 hov-cl10 trans-04 p-tb-5">
								Order history
							</a>
						</li>
					</ul>
				</div>

				<div class="footer-col4">
					<div class="footer-col-title flex-m">
						<span class="txt-m-109 cl3">
							Instagram
						</span>
					</div>

					<div class="flex-w flex-sb p-t-6">
						<div class="size-w-13 m-b-10">
							<a href="#" class="dis-block size-a-7 bg-img1 hov4"
							style="background-image: url('images/instagram-01.jpg');"></a>
						</div>
						
						<div class="size-w-13 m-b-10">
							<a href="#" class="dis-block size-a-7 bg-img1 hov4"
							style="background-image: url('images/instagram-02.jpg');"></a>
						</div>

						<div class="size-w-13 m-b-10">
							<a href="#" class="dis-block size-a-7 bg-img1 hov4"
							style="background-image: url('images/instagram-03.jpg');"></a>
						</div>

						<div class="size-w-13 m-b-10">
							<a href="#" class="dis-block size-a-7 bg-img1 hov4"
							style="background-image: url('images/instagram-04.jpg');"></a>
						</div>

						<div class="size-w-13 m-b-10">
							<a href="#" class="dis-block size-a-7 bg-img1 hov4"
							style="background-image: url('images/instagram-05.jpg');"></a>
						</div>

						<div class="size-w-13 m-b-10">
							<a href="#" class="dis-block size-a-7 bg-img1 hov4"
							style="background-image: url('images/instagram-06.jpg');"></a>
						</div>
					</div>
				</div>
			</div>

			<div class="flex-w flex-sb-m bo-t-1 bocl14 p-tb-14">
				<span class="txt-s-101 cl9 p-tb-10 p-r-29">
					Copyright © 2017 Organive. All rights reserved.
				</span>

				<div class="flex-w flex-m">
					<a href="#" class="m-r-29 m-tb-10">
						<img src="images/icons/icon-pay-01.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-r-29 m-tb-10">
						<img src="images/icons/icon-pay-02.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-r-29 m-tb-10">
						<img src="images/icons/icon-pay-03.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-r-29 m-tb-10">
						<img src="images/icons/icon-pay-04.png" alt="ICON-PAY">
					</a>

					<a href="#">
						<img src="images/icons/icon-pay-05.png" alt="ICON-PAY">
					</a>
				</div>
			</div>
		</div>
	</footer>
	

	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<span class="fa fa-chevron-up"></span>
		</span>
	</div>

	

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/slick/slick.min.js"></script>
	<script src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script src="vendor/parallax100/parallax100.js"></script>
<!--===============================================================================================-->
	<script src="vendor/lightbox2/js/lightbox.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/sweetalert/sweetalert.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/noui/nouislider.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/slide100/slide100.js"></script>
	<script src="js/slide100-custom.js"></script>
<!--===============================================================================================-->
    
<?php
if(empty($_SESSION)){ // if the session not yet started
   session_start();
}

/* add to cart */
if(isset($_POST['submitCart'])){
    $id=$_POST['productID'];
    $Quantity=$_POST['num-product'];
    // Get upload details
    $sqlProduct = "SELECT * FROM farmproduce WHERE product_id = '$id'";
    $result = mysqli_query($conn, $sqlProduct);

    while($row = mysqli_fetch_array($result))
        {
            $D_name=$row['name'];
            $D_price=$row['price'] * $Quantity;
        } 
    // -- Get product details

    // Insert into cart table
    // -- Get ip details
    if(!isset($_SESSION['user_id'])) { //if not yet logged in
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{

            $ip = $_SERVER['REMOTE_ADDR'];
        }
    }else{
        $ip = $_SESSION['user_id'];
    }
    date_default_timezone_set("Africa/Lagos");
    $time = date("h:i:sa");
    $date = date("Y.m.d");
    $sqlCart2 = "INSERT INTO addcart(p_name,p_id,address,price,quantity,date,time) VALUES ('$D_name','$id','$ip','$D_price','$Quantity','$date','$time')";
    if ($conn->query($sqlCart2) === TRUE) {
        echo "
            <script>
                $(function(){
                    
                    $('.js-addcart2').each(function(){
                        var nameProduct = $(this).parent().parent().parent().parent().find('.js-name2').html();
                        $(this).on('click', function(e){
                            swal(nameProduct, \"is added to cart !\", \"success\");
                        });
                    });
                })
            </script>
        ";
    } else {
        echo "Error: " . $sqlCart . "<br>" . $conn->error;
    }

}

?>
    
<?php
if(empty($_SESSION)){ // if the session not yet started
   session_start();
}

/* add to cart */
if(isset($_POST['submitOther'])){
    $id=$_POST['otherID'];
    // Get upload details
    $sqlProduct = "SELECT * FROM farmproduce WHERE product_id = '$id'";
    $result = mysqli_query($conn, $sqlProduct);

    while($row = mysqli_fetch_array($result))
        {
            $D_name=$row['name'];
            $D_price=$row['price'];
        } 
    // -- Get product details

    // Insert into cart table
    // -- Get ip details
    if(!isset($_SESSION['user_id'])) { //if not yet logged in
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{

            $ip = $_SERVER['REMOTE_ADDR'];
        }
    }else{
        $ip = $_SESSION['user_id'];
    }
    date_default_timezone_set("Africa/Lagos");
    $time = date("h:i:sa");
    $date = date("Y.m.d");
    $sqlCart2 = "INSERT INTO addcart(p_name,p_id,address,price,quantity,date,time) VALUES ('$D_name','$id','$ip','$D_price',1,'$date','$time')";
    if ($conn->query($sqlCart2) === TRUE) {
        echo "
            <script>
                $(function(){
                    
                    $('.js-addcart-b2').each(function(){
                        var nameProduct = $(this).parent().parent().parent().find('.js-name-b2').html();
                        $(this).on('click', function(e){
                            swal(nameProduct, \"is added to cart !\", \"success\");
                        });
                    });
                })
            </script>
        ";
    } else {
        echo "Error: " . $sqlCart . "<br>" . $conn->error;
    }

}

?>
    
	<script src="js/main.js"></script>

</body>
</html>