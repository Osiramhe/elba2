<?php
session_start();
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Farmshop ||  ElbaMarket</title>
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
        <div class="ht__bradcaump__area bg-image--11">
            <div class="ht__bradcaump__wrap d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title" style="color:white;">bridging the gap between buyers and consumers</h2>
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html" style="color:white;">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-long-arrow-right" style="color:white;"></i></span>
                                  <span class="breadcrumb-item active" style="color:#acacac;">Farmshop</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area --> 
        <!-- Start Menu Grid Area -->
        <section class="food__menu__grid__area section-padding--lg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="grid__show d-flex justify-content-between align-items-center">
                            <div class="grid__show__item">
                                <p>Showing 1-9 of 18 Result </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt--30">
                    <?php
                        include_once "../../database/FarmProduce-conn.php";
                        $sqlProduce = "SELECT * FROM farmproduce";
                        $result = $connProduce->query($sqlProduce);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                if ($row["ID"] === 0){
                                    echo '
                                        <h2 class="bradcaump-title" style="color:black;">There is currently no produce for sale.</h2>
                                    ';
                                }elseif($row["ID"] > 0){
                                    $_SESSION["name"] = $row["name"];
                                    $_SESSION["image"] = $row["image"];
                                    $_SESSION["category"] = $row["category"];
                                    $_SESSION["price"] = $row["price"];
                                    $_SESSION["brief"] = $row["brief"];
                                    $_SESSION["rating"] = $row["rating"];
                                    $_SESSION["special"] = $row["special"];
                                    $_SESSION["description"] = $row["description"];
                                    
                                    if ($row["special"] === "Yes"){
                                        echo '
                                        
                                            <div class="col-lg-4 col-sm-12 col-md-6">
                                                <div class="menu__grid__item wow fadeInLeft">
                                                    <div class="menu__grid__thumb">
                                                        <a href="menu-details.html">
                                                            <img src="../../admin/pages/uploads/'.$row["image"].'" alt="grid item images" style="max-height:230px;min-height:230px">
                                                        </a>
                                                        <div class="grid__item__offer">
                                                            <span>Special</span>
                                                            <span>Offer</span>
                                                        </div>
                                                    </div>
                                                    <div class="menu__grid__inner">
                                                        <div class="menu__grid__details" style="max-height:227px;min-height:227px;overflow:hidden">
                                                            <h2><a href="menu-details.html">'.$row["name"].'</a></h2>
                                                            <ul class="grid__prize__list">
                                                                <li>#'.$row["price"].'</li>
                                                            </ul>
                                                            <p>'.$row["brief"].'</p>
                                                        </div>
                                                        <div class="grid__addto__cart__btn mb-3">
                                                            <a href="menu-details.php">Buy Now</a>
                                                        </div>
                                                        <div class="grid__addto__cart__btn">
                                                            <a href="cart.html">Add to Cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        ';
                                    }elseif ($row["special"] === "No"){
                                        echo '
                                        
                                            <div class="col-lg-4 col-sm-12 col-md-6">
                                                <div class="menu__grid__item wow fadeInUp">
                                                    <div class="menu__grid__thumb">
                                                        <a href="menu-details.html">
                                                            <img src="../../images/menu-grid/b%20(1).jpg" alt="grid item images">
                                                        </a>
                                                    </div>
                                                    <div class="menu__grid__inner">
                                                        <div class="menu__grid__details">
                                                            <h2><a href="menu-details.html">'.$row["name"].'</a></h2>
                                                            <ul class="grid__prize__list"> <li>'.$row["price"].'</li>
                                                            </ul>
                                                            <p>'.$row["brief"].'</p>
                                                        </div>
                                                        <div class="grid__addto__cart__btn mb-3">
                                                            <a href="menu-details.php">Buy Now</a>
                                                        </div>
                                                        <div class="grid__addto__cart__btn">
                                                            <a href="cart.html">Add to Cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        ';
                                    }
                                }
                            }
                        }
                    ?>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="food__pagination d-flex justify-content-center align-items-center mt--130">
                            <li><a href="#"><i class="zmdi zmdi-chevron-left"></i></a></li>
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">...</a></li>
                            <li><a href="#">7</a></li>
                            <li><a href="#"><i class="zmdi zmdi-chevron-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Menu Grid Area -->
        <!-- Start Subscribe Area -->
         <section class="fd__subscribe__wrapper bg__cat--6 subs--4">
            <div class="fd__subscribe__area">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-12 col-md-12">
                        <div class="subscribe__inner subscribe--3">
                           <h2>Subscribe to our newsletter</h2>
                           <div id="mc_embed_signup">
                             <div id="enter__email__address">
                                    <form action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                        <div id="mc_embed_signup_scroll" class="htc__news__inner">
                                            <div class="news__input">
                                            <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Enter Your E-mail Address" required>
                                            </div>
                                            <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" tabindex="-1" value=""></div>
                                            <div class="clearfix subscribe__btn"><input type="submit" value="Send Now" name="subscribe" id="mc-embedded-subscribe" class="sign__up food__btn">
                                            </div>
                                        </div>
                                    </form>
                              </div>
                            </div>
                           <div class="subs__address__content d-flex justify-content-between">
                              <div class="subs__address d-flex">
                                 <div class="sbs__address__icon">
                                    <i class="zmdi zmdi-home"></i>
                                 </div>
                                 <div class="subs__address__details">
                                    <p>34 Shuaibu Afegbua Samaru<br> Zaria, Kaduna</p>
                                 </div>
                              </div>
                              <div class="subs__address d-flex">
                                 <div class="sbs__address__icon">
                                    <i class="zmdi zmdi-phone"></i>
                                 </div>
                                 <div class="subs__address__details">
                                    <p><a href="#">+234 8123221687</a></p>
                                    <p><a href="#">+088 8154445599</a></p>
                                 </div>
                              </div>
                              <div class="subs__address d-flex">
                                 <div class="sbs__address__icon">
                                    <i class="zmdi zmdi-email"></i>
                                 </div>
                                 <div class="subs__address__details">
                                    <p><a href="#">osiramhe@gmail.com</a></p>
                                    <p><a href="#">oomokogie1999@gmail.com</a></p>
                                 </div>
                              </div>
                               <div class="subs__address d-flex">
                                <ul class="social__icon">
                                    <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-google"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-instagram"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-rss"></i></a></li>
                                </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- End Subscribe Area -->
	</div><!-- //Main wrapper -->

	<!-- JS Files -->
	<script src="../../js/vendor/jquery-3.2.1.min.js"></script>
	<script src="../../js/popper.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
	<script src="../../js/plugins.js"></script>
	<script src="../../js/active.js"></script>
</body>
</html>
