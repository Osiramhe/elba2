<?php
require "db-conn.php";
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
        $outputGenres .= '
            <button class="txt-m-104 cl9 hov2 trans-04 p-rl-27 p-b-10 how-active1" data-filter="*">
                All Products
            </button>
        ';
        while($row = $result->fetch_assoc()) {

            $outputGenres .= '
                <button class="txt-m-104 cl9 hov2 trans-04 p-rl-27 p-b-10" data-filter=".'.$row["category_value"].'">
                    '.$row["category_name"].'
                </button>
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
    $sql = "SELECT * FROM farmproduce LIMIT 8";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $incr =2;
        while($row = $result->fetch_assoc()) {

            $outputGenres .= '
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-75 isotope-item fruit-juic-fill '.$row["category"].'">
                    <!-- Block1 -->
                    <div class="block1">
                        <div class="block1-bg wrap-pic-w bo-all-1 bocl12 hov3 trans-04">
                            <img src="admin/pages/uploads/'.$row["image"].'" alt="IMG" class="p-img">

                            <div class="block1-content flex-col-c-m p-b-46">
                                <a href="product-single.php?id='.$row['product_id'].'" class="txt-m-103 cl3 txt-center hov-cl10 trans-04 js-name-b1">
                                    '.$row["name"].'
                                </a>

                                <span class="block1-content-more txt-m-104 cl9 p-t-21 trans-04" style="font-weight:600;color:white">
                                    &#8358 '.$row['price'].' per '.$row['packaging'].'kg
                                </span>

                                <div class="block1-wrap-icon flex-c-m flex-w trans-05">
                                    <a href="product-single.php?id='.$row['product_id'].'" class="block1-icon flex-c-m wrap-pic-max-w">
                                        <img src="images/icons/icon-view.png" alt="ICON">
                                    </a>

                                    <a href="index.php?id='.$row['product_id'].'" class="block1-icon flex-c-m wrap-pic-max-w js-addcart2-b1">
                                        <img src="images/icons/icon-cart.png" alt="ICON">
                                    </a>
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

								<div class="size-w-14 flex-b">
									<a href="deleteHomeCart.php?id='.$row["id"].'" class="lh-10">
										<img src="images/icons/icon-close.png" alt="CLOSE">
									</a>
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
	<title>Elba Market</title>
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
	<link rel="stylesheet" type="text/css" href="vendor/revolution/css/layers.css">
	<link rel="stylesheet" type="text/css" href="vendor/revolution/css/navigation.css">
	<link rel="stylesheet" type="text/css" href="vendor/revolution/css/settings.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
    
    <style>
        .p-img{
            width: 268px;
            height: 352px;
        }
        .ps-img{
            width: 116px;
            height: 67px;
        }
    </style>
</head>
<body class="animsition">
    <?php include "header.php" ?>

	
	<!-- Slider -->
	<section class="sec-slider">
		<div class="rev_slider_wrapper fullwidthbanner-container">
			<div id="rev_slider_1" class="rev_slide fullwidthabanner" data-version="5.4.5" style="display:none">
				<ul>
					<!-- Slide 1 -->
					<li data-transition="fade">
						<!--  -->
						<img src="images/bg-slide-01.jpg" alt="IMG-BG" class="rev-slidebg">
						
						<!--  -->
						<div class="tp-caption tp-resizeme layer1" 
						data-frames='[{"delay":1300,"speed":1300,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'

						data-visibility="['on', 'on', 'on', 'on']"
 
					    data-fontsize="['35', '35', '35', '35']" 
					    data-lineheight="['42', '42', '42', '42']"
					    data-color="['#333']" 
					    data-textAlign="['left', 'left', 'center', 'center']"
					 
					    data-x="['left']" 
					    data-y="['center']" 
					    data-hoffset="['310', '80', '0', '0']" 
					    data-voffset="['-78', '-78', '-78', '-150']"
					 
					    data-width="['650','650','768','576']"
					    data-height="['auto']" 
					    data-whitespace="['normal']" 
					 
					    data-paddingtop="[0, 0, 0, 0]"
					    data-paddingright="[15, 15, 15, 15]"
					    data-paddingbottom="[0, 0, 0, 0]"
					    data-paddingleft="[15, 15, 15, 15]"

					    data-basealign="slide" 
    					data-responsive_offset="on"
					    >
					    	<span class="child1">We</span> <span class="child2">Are</span>
					    </div>
						
						<!--  -->
						<h2 class="tp-caption tp-resizeme layer2" 
						data-frames='[{"delay":500,"speed":1500,"frame":"0","from":"x:[175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:1;","mask":"x:[-100%];y:0;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'

						data-visibility="['on', 'on', 'on', 'on']"
 
					    data-fontsize="['75', '75', '75', '75']" 
					    data-lineheight="['82', '82', '82', '82']"
					    data-color="['#333']" 
					    data-textAlign="['left', 'left', 'center', 'center']"
					 
					    data-x="['left']" 
					    data-y="['center']" 
					    data-hoffset="['310', '80', '0', '0']" 
					    data-voffset="['0', '0', '0', '-30']"
					 
					    data-width="['650','650','768','576']"
					    data-height="['auto']" 
					    data-whitespace="['normal']" 
					 
					    data-paddingtop="[0, 0, 0, 0]"
					    data-paddingright="[15, 15, 15, 15]"
					    data-paddingbottom="[0, 0, 0, 0]"
					    data-paddingleft="[15, 15, 15, 15]"

					    data-basealign="slide" 
    					data-responsive_offset="on"
					    >
					    	Elba M<span>a</span>rket 
					    </h2>
						
						<!--  -->
						<p class="tp-caption tp-resizeme layer3" 
						data-frames='[{"delay":1300,"speed":1300,"frame":"0","from":"y:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'

						data-visibility="['on', 'on', 'on', 'on']"
 
					    data-fontsize="['15', '15', '15', '15']" 
					    data-lineheight="['24', '24', '24', '24']"
					    data-color="['#666']" 
					    data-textAlign="['left', 'left', 'center', 'center']"
					 
					    data-x="['left']" 
					    data-y="['center']" 
					    data-hoffset="['310', '80', '0', '0']"  
					    data-voffset="['95', '95', '95', '95']" 
					 
					    data-width="['650','650','768','576']"
					    data-height="['auto', 'auto', 'auto', 'auto']" 
					    data-whitespace="['normal']" 
					 
					    data-paddingtop="[0, 0, 0, 0]"
					    data-paddingright="[15, 15, 35, 15]"
					    data-paddingbottom="[0, 0, 0, 0]"
					    data-paddingleft="[15, 15, 35, 15]"

					    data-basealign="slide" 
    					data-responsive_offset="on"
					    >
					    	Nigeria's disruptive fast growing agro-commerce with an innovative approach in solving Africa's food crises
					    </p>

					    <!--  -->	
						<div class="tp-caption tp-resizeme flex-w layer4"
						data-frames='[{"delay":2500,"speed":1500,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.6;sY:0.6;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'

					   	data-x="['left']"
					    data-y="['center']" 
					    data-hoffset="['310', '80', '0', '0']" 
					    data-voffset="['203', '203', '203', '203']"
					 
					    data-width="['650','650','768','576']"
					    data-height="['auto']" 
					 
					    data-paddingtop="[0, 0, 0, 0]"
					    data-paddingright="[15, 15, 15, 15]"
					    data-paddingbottom="[0, 0, 0, 0]"
					    data-paddingleft="[15, 15, 15, 15]"

					    data-basealign="slide" 
    					data-responsive_offset="on"
					    >
						    <a href="shop.php" class="btn-slide flex-c-m">
						    	Shop now
						    	<span class="fa fa-chevron-right m-l-7"></span>
						    	<span class="fa fa-chevron-right"></span>
						    </a>
						</div>
					</li>

					<!-- Slide 2 -->
					<li data-transition="fade">
						<!--  -->
						<img src="images/bg-slide-01.jpg" alt="IMG-BG" class="rev-slidebg">
						
						<!--  -->
						<div class="tp-caption tp-resizeme layer1" 
						data-frames='[{"delay":500,"speed":1300,"frame":"0","from":"y:150px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'

						data-visibility="['on', 'on', 'on', 'on']"
 
					    data-fontsize="['35', '35', '35', '35']" 
					    data-lineheight="['42', '42', '42', '42']"
					    data-color="['#333']" 
					    data-textAlign="['left', 'left', 'center', 'center']"
					 
					    data-x="['left']" 
					    data-y="['center']" 
					    data-hoffset="['310', '80', '0', '0']" 
					    data-voffset="['-78', '-78', '-78', '-150']"
					 
					    data-width="['650','650','768','576']"
					    data-height="['auto']" 
					    data-whitespace="['normal']" 
					 
					    data-paddingtop="[0, 0, 0, 0]"
					    data-paddingright="[15, 15, 15, 15]"
					    data-paddingbottom="[0, 0, 0, 0]"
					    data-paddingleft="[15, 15, 15, 15]"

					    data-basealign="slide" 
    					data-responsive_offset="on"
					    >
					    	<span class="child1">We</span> <span class="child2">Are</span>
					    </div>
						
						<!--  -->
						<h2 class="tp-caption tp-resizeme layer2" 
						data-frames='[{"delay":1300,"speed":1300,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'

						data-visibility="['on', 'on', 'on', 'on']"
 
					    data-fontsize="['75', '75', '75', '75']" 
					    data-lineheight="['82', '82', '82', '82']"
					    data-color="['#333']" 
					    data-textAlign="['left', 'left', 'center', 'center']"
					 
					    data-x="['left']" 
					    data-y="['center']" 
					    data-hoffset="['310', '80', '0', '0']" 
					    data-voffset="['0', '0', '0', '-30']"
					 
					    data-width="['650','650','768','576']"
					    data-height="['auto']" 
					    data-whitespace="['normal']" 
					 
					    data-paddingtop="[0, 0, 0, 0]"
					    data-paddingright="[15, 15, 15, 15]"
					    data-paddingbottom="[0, 0, 0, 0]"
					    data-paddingleft="[15, 15, 15, 15]"

					    data-basealign="slide" 
    					data-responsive_offset="on"
					    >
					    	Elba M<span>a</span>rket 
					    </h2>
						
						<!--  -->
						<p class="tp-caption tp-resizeme layer3" 
						data-frames='[{"delay":500,"speed":1300,"frame":"0","from":"y:-150px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'

						data-visibility="['on', 'on', 'on', 'on']"
 
					    data-fontsize="['15', '15', '15', '15']" 
					    data-lineheight="['24', '24', '24', '24']"
					    data-color="['#666']" 
					    data-textAlign="['left', 'left', 'center', 'center']"
					 
					    data-x="['left']" 
					    data-y="['center']" 
					    data-hoffset="['310', '80', '0', '0']"  
					    data-voffset="['95', '95', '95', '95']" 
					 
					    data-width="['650','650','768','576']"
					    data-height="['auto', 'auto', 'auto', 'auto']" 
					    data-whitespace="['normal']" 
					 
					    data-paddingtop="[0, 0, 0, 0]"
					    data-paddingright="[15, 15, 35, 15]"
					    data-paddingbottom="[0, 0, 0, 0]"
					    data-paddingleft="[15, 15, 35, 15]"

					    data-basealign="slide" 
    					data-responsive_offset="on"
					    >
					    	Nigeria's disruptive fast growing agro-commerce with an innovative approach in solving Africa's food crises
					    </p>

					    <!--  -->	
						<div class="tp-caption tp-resizeme flex-w layer4"
						data-frames='[{"delay":2000,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'

					   	data-x="['left']"
					    data-y="['center']" 
					    data-hoffset="['310', '80', '0', '0']" 
					    data-voffset="['203', '203', '203', '203']"
					 
					    data-width="['650','650','768','576']"
					    data-height="['auto']" 
					 
					    data-paddingtop="[0, 0, 0, 0]"
					    data-paddingright="[15, 15, 15, 15]"
					    data-paddingbottom="[0, 0, 0, 0]"
					    data-paddingleft="[15, 15, 15, 15]"

					    data-basealign="slide" 
    					data-responsive_offset="on"
					    >
						    <a href="shop.php" class="btn-slide flex-c-m">
						    	Shop now
						    	<span class="fa fa-chevron-right m-l-7"></span>
						    	<span class="fa fa-chevron-right"></span>
						    </a>
						</div>
					</li>
				</ul>				
			</div>
		</div>
	</section>

	<!-- Welcome -->
	<section class="sec-welcome bg0 p-t-145 p-b-95" id="WhatWeOffer">
		<div class="container">
			<div class="size-a-1 flex-col-c-m p-b-90">
				<div class="txt-center txt-m-201 cl10 how-pos1-parent m-b-14">
					Green Agriculture
				</div>

				<h3 class="txt-center txt-l-101 cl3 respon1">
					welcome to Elba market
				</h3>
			</div>

			<div class="wrap-pic-max-w flex-c-t flex-w p-t-255 item-welcome-parent">
				<img class="size-w-1" src="images/other-01.jpg" alt="IMG">

				<!-- item welcome -->
				<div class="item-welcome one">
					<div class="item-welcome-pic pos-relative">
						<div class="wrap-pic-max-w flex-c-m item-welcome-pic-dark trans-04">
							<img src="images/icons/icon1.png" alt="IMG">
						</div>

						<div class="wrap-pic-max-w flex-c-m s-full ab-t-l item-welcome-pic-light trans-04">
							<img src="images/icons/icon1.1.png" alt="IMG">
						</div>
					</div>

					<div class="item-welcome-txt p-t-27">
						<h4 class="txt-m-101 cl3 txt-center p-b-11">
							100% Organic
						</h4>
					</div>
				</div>

				<!-- item welcome -->
				<div class="item-welcome two">
					<div class="item-welcome-pic pos-relative">
						<div class="wrap-pic-max-w flex-c-m item-welcome-pic-dark trans-04">
							<img src="images/icons/icon2.png" alt="IMG">
						</div>

						<div class="wrap-pic-max-w flex-c-m s-full ab-t-l item-welcome-pic-light trans-04">
							<img src="images/icons/icon2.2.png" alt="IMG">
						</div>
					</div>

					<div class="item-welcome-txt p-t-27">
						<h4 class="txt-m-101 cl3 txt-center p-b-11">
							family healthy
						</h4>
					</div>
				</div>

				<!-- item welcome -->
				<div class="item-welcome three">
					<div class="item-welcome-pic pos-relative">
						<div class="wrap-pic-max-w flex-c-m item-welcome-pic-dark trans-04">
							<img src="images/icons/icon3.png" alt="IMG">
						</div>

						<div class="wrap-pic-max-w flex-c-m s-full ab-t-l item-welcome-pic-light trans-04">
							<img src="images/icons/icon3.3.png" alt="IMG">
						</div>
					</div>

					<div class="item-welcome-txt p-t-27">
						<h4 class="txt-m-101 cl3 txt-center p-b-11">
							Always Fresh
						</h4>
					</div>
				</div>

				<!-- item welcome -->
				<div class="item-welcome four">
					<div class="item-welcome-pic pos-relative">
						<div class="wrap-pic-max-w flex-c-m item-welcome-pic-dark trans-04">
							<img src="images/icons/icon4.png" alt="IMG">
						</div>

						<div class="wrap-pic-max-w flex-c-m s-full ab-t-l item-welcome-pic-light trans-04">
							<img src="images/icons/icon4.4.png" alt="IMG">
						</div>
					</div>

					<div class="item-welcome-txt p-t-27">
						<h4 class="txt-m-101 cl3 txt-center p-b-11">
							Food safety
						</h4>
					</div>
				</div>

			</div>
		</div>
	</section>

	<!-- Item -->
	<div class="sec-item flex-w">
		<!--  -->
		<div class="of-hidden size-w-2 respon2">
			<div class="hov-img1 pos-relative">
				<img src="images/bg-item-01.jpg" alt="IMG">

				<a href="shop-product-grid.html" class="s-full ab-t-l flex-col-c-m bg11 p-all-15 hov1-parent">
					<div class="wrap-pic-max-w">
						<img src="images/icons/symbol-03.png" alt="IMG">
					</div>

					<span class="txt-l-102 cl0 txt-center p-t-30 p-b-13">
						VEGETABLES
					</span>
					
					<div class="hov1 trans-04">
						<div class="txt-m-102 cl0 txt-center hov1-child trans-04">
							- <?php echo count_veg ($conn) ?> Items -
						</div>
					</div>
				</a>
			</div>
		</div>	
		
		<!--  -->
		<div class="of-hidden size-w-2 respon2">
			<div class="hov-img1 pos-relative">
				<img src="images/bg-item-02.jpg" alt="IMG">

				<a href="shop-product-grid.html" class="s-full ab-t-l flex-col-c-m bg11 p-all-15 hov1-parent">
					<div class="wrap-pic-max-w">
						<img src="images/icons/symbol-04.png" alt="IMG">
					</div>

					<span class="txt-l-102 cl0 txt-center p-t-30 p-b-13">
						fruits
					</span>
					
					<div class="hov1 trans-04">
						<div class="txt-m-102 cl0 txt-center hov1-child trans-04">
							- <?php echo count_fruits ($conn) ?> Items -
						</div>
					</div>
				</a>
			</div>
		</div>	

		<!--  -->
		<div class="of-hidden size-w-2 respon2">
			<div class="hov-img1 pos-relative">
				<img src="images/product-12.jpg" alt="IMG">

				<a href="shop-product-grid.html" class="s-full ab-t-l flex-col-c-m bg11 p-all-15 hov1-parent">
					<div class="wrap-pic-max-w">
						<img src="images/icons/symbol-29.png" alt="IMG">
					</div>

					<span class="txt-l-102 cl0 txt-center p-t-30 p-b-13">
						Tubers
					</span>
					
					<div class="hov1 trans-04">
						<div class="txt-m-102 cl0 txt-center hov1-child trans-04">
							- <?php echo count_tub ($conn) ?> Items -
						</div>
					</div>
				</a>
			</div>
		</div>	

		<!--  -->
		<div class="of-hidden size-w-2 respon2">
			<div class="hov-img1 pos-relative">
				<img src="images/bg-item-04.jpg" alt="IMG">

				<a href="shop-product-grid.html" class="s-full ab-t-l flex-col-c-m bg11 p-all-15 hov1-parent">
					<div class="wrap-pic-max-w">
						<img src="images/icons/symbol-06.png" alt="IMG">
					</div>

					<span class="txt-l-102 cl0 txt-center p-t-30 p-b-13">
						Spices
					</span>
					
					<div class="hov1 trans-04">
						<div class="txt-m-102 cl0 txt-center hov1-child trans-04">
							- <?php echo count_spices ($conn) ?> Items -
						</div>
					</div>
				</a>
			</div>
		</div>	
	</div>

	<!-- Product -->
	<div class="sec-product bg0 p-t-145 p-b-25">
		<div class="container">
			<div class="size-a-1 flex-col-c-m p-b-48">
				<div class="txt-center txt-m-201 cl10 how-pos1-parent m-b-14">
					Featured Products
				</div>

				<h3 class="txt-center txt-l-101 cl3 respon1">
					Our products
				</h3>
			</div>

			<div class="p-b-46">
				<div class="flex-w flex-c-m filter-tope-group">
					<?php echo fillCategory ($conn) ?>
				</div>
			</div>
			
			<div class="row isotope-grid">
                <?php echo fillProduct ($conn) ?>
			</div>
		</div>
	</div>

	<!-- Deal -->
	<section class="sec-deal bg-img1" style="background-image: url('images/bg-01.jpg');">
		<div class="flex-w flex-m how-pos2-parent">
			<img class="how-pos2 respon4 dis-none-xl" src="images/other-03.png" alt="IMG">

			<div class="size-w-3 txt-center wrap-pic-max-s w-full-lg">
				<img src="images/other-02.png" alt="IMG">
			</div>

			<div class="size-w-4 p-t-105 p-b-90 p-r-15 respon3">
				<div class="size-a-1 flex-col-l-m p-b-35">
					<div class="txt-m-201 cl10 how-pos1-parent m-b-14">
						Facts For You
					</div>

					<h3 class="txt-l-101 cl3 respon1">
						Did you know that,
					</h3>
				</div>

				<div class="p-b-32">
					<a href="#" class="txt-m-105 cl6 hov-cl10 trans-04">
						Roasted corn
					</a>

					<p class="txt-s-102 cl9">
						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.
					</p>
				</div>
				
				<div class="flex-w">
					<a href="shop-sidebar-grid.html" class="flex-c-m txt-s-103 cl6 size-a-2 how-btn1 bo-all-1 bocl11 hov-btn1 trans-04">
						Shop now
						<span class="fa fa-chevron-right m-l-7"></span>
						<span class="fa fa-chevron-right"></span>
					</a>
				</div>
					
			</div>
		</div>
	</section>

	<!-- Product2 -->
	<section class="sec-product2 bg0 p-t-113 p-b-35">
		<div class="container">
			<div class="row">
				<div class="col-sm-10 col-md-6 col-lg-4 p-b-20 m-rl-auto-md">
					<div class="p-r-20 p-rl-0-xl">
						<!-- slide2 -->
						<div class="wrap-slick2">
							<div class="p-b-20 p-rl-15">
								<div class="flex-w flex-t p-t-5">
									<h4 class="size-w-5 m-r-20">
										<span class="txt-l-103 cl6">
											Vegetable 
										</span>

										<span class="txt-l-104 cl3">
											special
										</span>
									</h4>

									<div class="wrap-arrow-slick2 flex-w m-t-6"></div>
								</div>
							</div>

							<div class="slick2">
								<div class="item-slick2 p-all-15">
									<?php echo fillVegSpecial ($conn) ?>
								</div>
							</div>
						</div>
					</div>		
				</div>

				<div class="col-sm-10 col-md-6 col-lg-4 p-b-20 m-rl-auto-md">
					<div class="p-rl-10 p-rl-0-xl">
						<!-- slide2 -->
						<div class="wrap-slick2">
							<div class="p-b-20 p-rl-15">
								<div class="flex-w flex-t p-t-5">
									<h4 class="size-w-5 m-r-20">
										<span class="txt-l-103 cl6">
											Tuber 
										</span>

										<span class="txt-l-104 cl3">
											special
										</span>
									</h4>

									<div class="wrap-arrow-slick2 flex-w m-t-6"></div>
								</div>
							</div>

							<div class="slick2">
								<div class="item-slick2 p-all-15">
									<?php echo fillTubSpecial ($conn) ?>
								</div>
							</div>
						</div>
					</div>		
				</div>

				<div class="col-sm-10 col-md-6 col-lg-4 p-b-20 m-rl-auto-md">
					<div class="p-l-20 p-rl-0-xl">
						<!-- slide2 -->
						<div class="wrap-slick2">
							<div class="p-b-20 p-rl-15">
								<div class="flex-w flex-t p-t-5">
									<h4 class="size-w-5 m-r-20">
										<span class="txt-l-103 cl6">
											Grains 
										</span>

										<span class="txt-l-104 cl3">
											special
										</span>
									</h4>

									<div class="wrap-arrow-slick2 flex-w m-t-6"></div>
								</div>
							</div>

							<div class="slick2">
								<div class="item-slick2 p-all-15">
									<?php echo fillGrainsSpecial ($conn) ?>
								</div>
							</div>
						</div>
					</div>		
				</div>
			</div>
		</div>
	</section>

	<!-- Testimonials -->
	<div class="sec-testimonials bg12 p-t-120 p-b-80 how-pos3-parent how-pos4-parent">
		<img class="how-pos3 dis-none-xl" src="images/other-04.png" alt="IMG">
		<img class="how-pos4 dis-none-xl" src="images/other-05.png" alt="IMG">
	
		<div class="container">
			<!-- Slide3 -->
				<div class="wrap-slick3">
					<div class="slick3">
						<div class="item-slick3">
							<div class="flex-col-c-m">
								<div class="layer-slick3 animated visible-false" data-appear="zoomIn" data-delay="100">
									<div class="wrap-pic-s size-a-3 bo-3-rad-50per bocl10 of-hidden">
										<img src="images/avatar-01.jpg" alt="AVATAR">
									</div>
								</div>

								<div class="layer-slick3 animated visible-false" data-appear="fadeInUp" data-delay="800">
									<div class="flex-col-c-m p-t-33 p-b-25">
										<span class="txt-l-105 cl3 txt-center p-b-9">
											Idoga Emmanuel
										</span>

										<span class="fs-16 cl11 txt-center" style="text-transform: uppercase;font-weight: 600;color: black">
											Founder
										</span>
									</div>
								</div>

								<div class="layer-slick3 animated visible-false" data-appear="fadeInUp" data-delay="1600">
									<p class="txt-center txt-s-104 cl6 size-w-8">
										Idoga Emmanuel is a seasoned business professional with years of experience. He has frontiered certain business projects such as; DePhoenix Agro enterprise Ellites Foods He has trained several entrepreneurs who are now doing well in their businesses. Among them are; Opecstat.com, Menorah Collections. A business prodigy of Strive Masiyiwa (Chairman, ECONET GLOBAL).
									</p>
								</div>
							</div>
						</div>

						<div class="item-slick3">
							<div class="flex-col-c-m">
								<div class="layer-slick3 animated visible-false" data-appear="zoomIn" data-delay="100">
									<div class="wrap-pic-s size-a-3 bo-3-rad-50per bocl10 of-hidden">
										<img src="images/avatar-01-2.jpeg" alt="AVATAR">
									</div>
								</div>

								<div class="layer-slick3 animated visible-false" data-appear="fadeInUp" data-delay="800">
									<div class="flex-col-c-m p-t-33 p-b-25">
										<span class="txt-l-105 cl3 txt-center p-b-9">
											Emmanuel Nwobodo
										</span>

										<span class="fs-16 cl11 txt-center" style="text-transform: uppercase;font-weight: 600;color: black">
											CHIEF MARKETING OFFICER
										</span>
									</div>
								</div>

								<div class="layer-slick3 animated visible-false" data-appear="fadeInUp" data-delay="1600">
									<p class="txt-center txt-s-104 cl6 size-w-8">
										An entrepreneur who have always had an independent thinking and a drive to solve problems. He is skilled at Human and organizational psychology. He has held leadership positions from his childhood and has stood out every time. He has; Certificate in Entrepreneurship and family business, Certificate in financial literacy, Certificate in financial planning, Certificate in Media Production from Lucxnia media consults.
									</p>
								</div>
							</div>
						</div>

						<div class="item-slick3">
							<div class="flex-col-c-m">
								<div class="layer-slick3 animated visible-false" data-appear="zoomIn" data-delay="100">
									<div class="wrap-pic-s size-a-3 bo-3-rad-50per bocl10 of-hidden">
										<img src="images/avatar-01-3.jpg" alt="AVATAR">
									</div>
								</div>

								<div class="layer-slick3 animated visible-false" data-appear="fadeInUp" data-delay="800">
									<div class="flex-col-c-m p-t-33 p-b-25">
										<span class="txt-l-105 cl3 txt-center p-b-9">
											Emmanuel Mbamali
										</span>

										<span class="fs-16 cl11 txt-center" style="text-transform: uppercase;font-weight: 600;color: black">
											BUSINESS DEVELOPMENT OFFICER
										</span>
									</div>
								</div>

								<div class="layer-slick3 animated visible-false" data-appear="fadeInUp" data-delay="1600">
									<p class="txt-center txt-s-104 cl6 size-w-8">
										An astute entrepreneur with vast experience in business development, he has worked with teams in finding solutions to agriculture problems. His technology exposure also makes him key in frontiering our tech innovations.
									</p>
								</div>
							</div>
						</div>
					</div>

					<div class="wrap-slick3-dots p-t-50"></div>
				</div>
		</div>
	</div>


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
					<form class="flex-w flex-m h-full" action="" method="post" enctype="multipart/form-data">
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
							<img src="images/icons/elba.png" alt="LOGO" width="120px" height="120px">
						</a>
					</div>

					<p class="txt-s-101 cl6 size-w-10 p-b-16">
						We are an ecommerce company operating in the agriculture NICHE. We are Nigeria's disruptive fast growing agro-commerce with an innovative approach in solving Africa's food crises by bridging the gap between farmers and consumers.
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
								Office 008, Furniture Plaza, AB, 2 Constitution Rd, Kaduna State, Nigeria.
							</span>
						</li>

						<li class="txt-s-101 cl6 flex-t p-b-10">
							<span class="size-w-11">
								<img src="images/icons/icon-phone.png" alt="ICON-MAIL">
							</span>
							
							<span class="size-w-12 p-t-1">
                                +234 8185324897, +234 8174265864
							</span>
						</li>
					</ul>
				</div>
				<div class="footer-col2">
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
	<script src="vendor/revolution/js/jquery.themepunch.tools.min.js"></script>
	<script src="vendor/revolution/js/jquery.themepunch.revolution.min.js"></script>
	<script src="vendor/revolution/js/extensions/revolution.extension.video.min.js"></script>
	<script src="vendor/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
	<script src="vendor/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
	<script src="vendor/revolution/js/extensions/revolution.extension.actions.min.js"></script>
	<script src="vendor/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
	<script src="vendor/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
	<script src="vendor/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
	<script src="vendor/revolution/js/extensions/revolution.extension.migration.min.js"></script>
	<script src="vendor/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
	<script src="js/revo-custom.js"></script>
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
	<script src="vendor/countdowntime/moment.min.js"></script>
	<script src="vendor/countdowntime/moment-timezone.min.js"></script>
	<script src="vendor/countdowntime/moment-timezone-with-data.min.js"></script>
	<script src="vendor/countdowntime/jquery.countdown.min.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<!--===============================================================================================-->
    
<?php
if(empty($_SESSION)){ // if the session not yet started
   session_start();
}

/* add to cart */
if(isset($_GET['id'])){
    $id=$_GET['id'];
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
                    
                    $('.js-addcart2-b1').each(function(){
                        var nameProduct = $(this).parent().parent().find('.js-name-b1').html();
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