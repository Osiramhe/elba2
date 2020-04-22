<?php
session_start();


?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Menu Details ||  Aahar Food Delivery Html5 Template</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicons -->
	<link rel="shortcut icon" href="../../images/favicon.ico">
	<link rel="apple-touch-icon" href="../../images/icon.png">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" href="../../css/plugins.css">
	<link rel="stylesheet" href="../../style.css">

	<!-- Cusom css -->
   <link rel="stylesheet" href="../../css/custom.css">

	<!-- Modernizer js -->
	<script src="../../js/vendor/modernizr-3.5.0.min.js"></script>
</head>
<body>
	<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->

	<!-- Add your site or application content here -->
	
	<!-- <div class="fakeloader"></div> -->

	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
		<!-- Start Header Area -->
        <header class="htc__header bg--white">
                <!-- Start Mainmenu Area -->
                <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2 col-sm-4 col-md-6 order-1 order-lg-1">
                                <div class="logo">
                                    <a href="index-4.html">
                                        <img src="../../images/logo/elba.png" alt="logo images" width="114px" height="110px">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-9 col-sm-4 col-md-2 order-3 order-lg-2">
                                <div class="main__menu__wrap">
                                    <nav class="main__menu__nav d-none d-lg-block">
                                        <ul class="mainmenu">
                                            <li class="drop"><a href="Homepage.php">Home</a>
                                            </li>
                                            <li><a href="about-us.html">About</a></li>
                                            <li class="drop"><a href="menu.php">Farmshop</a>
                                            </li>
                                            <li class="drop"><a href="service.php">Services</a>
                                            </li>
                                            <li><a href="contact.php">Contact</a></li>
                                        </ul>
                                    </nav>
                                    
                                </div>
                            </div>
                            <div class="col-lg-1 col-sm-4 col-md-4 order-2 order-lg-3">
                                <div class="header__right d-flex justify-content-end">
                                    <div class="log__in">
                                        <a class="accountbox-trigger" href="#"><i class="zmdi zmdi-account-o"></i></a>
                                    </div>
                                    <div class="shopping__cart">
                                        <a class="minicart-trigger" href="#"><i class="zmdi zmdi-shopping-basket"></i></a>
                                        <div class="shop__qun">
                                            <span>03</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                            <div class="mobile-menu d-block d-lg-none"></div>
                        <!-- Mobile Menu -->
                    </div>
                </div>
                <!-- End Mainmenu Area -->
        </header>
        <!-- End Header Area -->
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--18">
            <div class="ht__bradcaump__wrap d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title" style="color:white;">bridging the gap between buyers and consumers</h2>
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html" style="color:white;">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-long-arrow-right" style="color:white;"></i></span>
                                    <a class="breadcrumb-item" href="menu.php" style="color:white;">Farmshop</a>
                                    <span class="brd-separetor"><i class="zmdi zmdi-long-arrow-right" style="color:white;"></i></span>
                                  <span class="breadcrumb-item active" style="color:#acacac;">Details</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area --> 
        <!-- Start Blog List View Area -->
        <section class="blog__list__view section-padding--lg menudetails-right-sidebar bg--white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <form action="../database/addProduct.php" method="post" enctype="multipart/form-data">
                        <div class="food__menu__container">
                            <div class="food__menu__inner d-flex flex-wrap flex-md-nowrap flex-lg-nowrap">
                                <div class="food__menu__thumb">
                                    <img src="../../images/banner/details/1.jpg" alt="images">
                                    <input class="form-control" type="file" name="p_image" required>
                                </div>
                                <div class="food__menu__details">
                                    <div class="food__menu__content mt-3">
                                        <label> <span style="font-size:1.4em;">Product Name</span>
                                        <input type="text" name="p_name" class="form-control mt-3" placeholder="Product Name" required="require" data-validation-required-message="Please enter the product name."> 
                                        </label>
                                        <ul class="food__dtl__prize d-flex">
                                            <li>
                                                <label> <span style="font-size:1em;" class="text-muted">Product Price</span>
                                                <input type="text" name="p_price" class="form-control mt-3" placeholder="Product price" required="require" data-validation-required-message="Please enter the product price.">
                                                </label>
                                            </li>
                                            <li>
                                                <label> <span style="font-size:1em;" class="text-muted">Product Packaging</span>
                                                <input type="text" name="p_packaging" class="form-control mt-3" placeholder="Product packaging" required="required" data-validation-required-message="Please enter the product packaging.">
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
                                            <label><span style="font-size:1.4em;">Brief Description</span>
                                            <textarea name="p_brief" col="55" rows="3" class="form-control"></textarea>
                                            </label>
                                        </p>
                                        <div class="product-action-wrap">
                                            <div class="prodict-statas"><label for="special" style="font-size:1.4em;">Special :   
                                            </label>
                                            <div>
                                                <select class="form-control" id="special" name="p_special" required>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                            </div>
                                            <div class="prodict-statas"><label for="category" style="font-size:1.4em;">Food Category :   
                                            </label>
                                            <div>
                                                <select class="form-control" id="category" name="p_category" required>
                                                    <option value="Vegetables">Vegetables</option>
                                                    <option value="Rice">Rice</option>
                                                    <option value="Fruits">Fruits</option>
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
                            <!-- Start Product Descrive Area -->
                            <div class="menu__descrive__area ">
                                <div class="menu__nav nav nav-tabs" role="tablist">
                                    <a class="active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab">Description</a>
                                </div>
                                <!-- Start Tab Content -->
                                <div class="menu__tab__content tab-content" id="nav-tabContent">
                                    <!-- Start Single Content -->
                                    <div class="single__dec__content fade show active" id="nav-all" role="tabpanel">
                                        <p>
                                            <label><span style="font-size:1.4em;"> Description</span>
                                            <textarea name="p_description" col="85" rows="6" class="form-control"></textarea>
                                            </label>
                                        </p>
                                    </div>
                                    <!-- End Single Content -->
                                </div>
                                <!-- End Tab Content -->
                            </div>
                            <button type="submit" name="addProduct" class="btn btn-danger">
                                Add New Product
                            </button>
                            <!-- End Product Descrive Area -->
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="popupal__menu">
                                    <h4>Popular Menu</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row mt--30">
                            <!-- Start Single Product -->
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="beef_product">
                                    <div class="beef__thumb">
                                        <a href="menu-details.html">
                                            <img src="images/beef/1.jpg" alt="beef images">
                                        </a>
                                    </div>
                                    <div class="beef__hover__info">
                                        <div class="beef__hover__inner">
                                            <span>Special</span>
                                            <span>offer</span>
                                        </div>
                                    </div>
                                    <div class="beef__details">
                                        <h4><a href="menu-details.html">Beef Burger</a></h4>
                                        <ul class="beef__prize">
                                            <li class="old__prize">$30</li>
                                            <li>$30</li>
                                        </ul>
                                        <p>erve armesan may be added to the top of apLem ip, consectetur</p>
                                        <div class="beef__cart__btn">
                                            <a href="cart.html">Add To Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Product -->
                            <!-- Start Single Product -->
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="beef_product">
                                    <div class="beef__thumb">
                                        <a href="menu-details.html">
                                            <img src="images/beef/2.jpg" alt="beef images">
                                        </a>
                                    </div>
                                    <div class="beef__details">
                                        <h4><a href="menu-details.html">Beef Burger</a></h4>
                                        <ul class="beef__prize">
                                            <li class="old__prize">$30</li>
                                            <li>$30</li>
                                        </ul>
                                        <p>erve armesan may be added to the top of apLem ip, consectetur</p>
                                        <div class="beef__cart__btn">
                                            <a href="cart.html">Add To Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Product -->
                            <!-- Start Single Product -->
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="beef_product">
                                    <div class="beef__thumb">
                                        <a href="menu-details.html">
                                            <img src="images/beef/3.jpg" alt="beef images">
                                        </a>
                                    </div>
                                    <div class="beef__hover__info">
                                        <div class="beef__hover__inner">
                                            <span>Special</span>
                                            <span>offer</span>
                                        </div>
                                    </div>
                                    <div class="beef__details">
                                        <h4><a href="menu-details.html">Beef Burger</a></h4>
                                        <ul class="beef__prize">
                                            <li class="old__prize">$30</li>
                                            <li>$30</li>
                                        </ul>
                                        <p>erve armesan may be added to the top of apLem ip, consectetur</p>
                                        <div class="beef__cart__btn">
                                            <a href="cart.html">Add To Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Product -->
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Blog List View Area -->
	</div><!-- //Main wrapper -->

	<!-- JS Files -->
	<script src="../../js/vendor/jquery-3.2.1.min.js"></script>
	<script src="../../js/popper.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
	<script src="../../js/plugins.js"></script>
	<script src="../../js/active.js"></script>
</body>
</html>
