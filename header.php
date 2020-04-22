


	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop">
					<div class="left-header">
						<!-- Logo desktop -->		
						<div class="logo">
							<a href="index.php"><img src="images/icons/elba.png" width="80px" height="100px" alt="IMG-LOGO"></a>
						</div>	
					</div>
						
					<div class="center-header">
						<!-- Menu desktop -->
						<div class="menu-desktop">
							<ul class="main-menu" style="font-weight:600;">
								<li class="active-menu">
									<a href="index.php">Home</a>
								</li>

								<li>
									<a href="about.php">Who are we?</a>
								</li>

								<li>
									<a href="shop.php">Shop</a>
								</li>

								<li>
									<a href="index.php#WhatWeOffer">What we offer?</a>
								</li>

								<li>
									<a href="contact.php">Contact us</a>
								</li>
							</ul>
						</div>
					</div>
						
					<div class="right-header">
						<!-- Icon header -->
						<div class="wrap-icon-header flex-w flex-r-m h-full wrap-menu-click p-t-8">
							<div class="h-full flex-m">
								<div class="icon-header-item flex-c-m trans-04 js-show-modal-search">
									<img src="images/icons/icon-search.png" alt="SEARCH">
								</div>
							</div>
                            
                            <div class="h-full flex-m">
								<div class="icon-header-item flex-c-m trans-04">
									<a href="account.php" class="fa fa-user" style="color:black;font-size:16px"></a>
								</div>
							</div>
								
							<div class="wrap-cart-header h-full flex-m m-l-10 menu-click">
								<div class="icon-header-item flex-c-m trans-04 icon-header-noti" data-notify="<?php echo count_cart($conn) ?>">
									<img src="images/icons/icon-cart-2.png" alt="CART">
								</div>

								<div class="cart-header menu-click-child trans-04">
									<div class="bo-b-1 bocl15">
										<div class="size-h-2 js-pscroll m-r--15 p-r-15">
											<!-- cart header item -->
											<?php echo fillCart($conn) ?>
										</div>
									</div>
										

									<div class="flex-w flex-sb-m p-t-22 p-b-12">
										<span class="txt-m-103 cl3 p-r-20">
											Subtotal
										</span>

										<span class="txt-m-111 cl6">
											&#8358 <?php echo total($conn) ?>
										</span>
									</div>

									<div class="flex-w flex-sb-m p-b-31">
										<span class="txt-m-103 cl3 p-r-20">
											Total
										</span>

										<span class="txt-m-111 cl10">
											&#8358 <?php echo total($conn) ?>
										</span>
									</div>
									
									<a href="shop-cart.php" class="flex-c-m size-a-8 bg10 txt-s-105 cl13 hov-btn2 trans-04">
										check out
									</a>	
								</div>
							</div>
						</div>
					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="index.php"><img src="images/icons/elba.png" width="80px" height="100px" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m h-full wrap-menu-click m-r-15">
				<div class="h-full flex-m">
					<div class="icon-header-item flex-c-m trans-04 js-show-modal-search">
						<img src="images/icons/icon-search.png" alt="SEARCH">
					</div>
				</div>
                            
                <div class="h-full flex-m">
                    <div class="icon-header-item flex-c-m trans-04">
                        <a href="account.php" class="fa fa-user" style="color:black;font-size:16px"></a>
                    </div>
                </div>

				<div class="wrap-cart-header h-full flex-m m-l-5 menu-click">
					<div class="icon-header-item flex-c-m trans-04 icon-header-noti" data-notify="<?php echo count_cart($conn) ?>">
						<img src="images/icons/icon-cart-2.png" alt="CART">
					</div>

					<div class="cart-header menu-click-child trans-04">
						<div class="bo-b-1 bocl15">
							<!-- cart header item -->
                            <?php echo fillCart($conn) ?>
						</div>

						<div class="flex-w flex-sb-m p-t-22 p-b-12">
							<span class="txt-m-103 cl3 p-r-20">
								Subtotal
							</span>

							<span class="txt-m-111 cl6">
                                &#8358 <?php echo total($conn) ?>
							</span>
						</div>

						<div class="flex-w flex-sb-m p-b-31">
							<span class="txt-m-103 cl3 p-r-20">
								Total
							</span>

							<span class="txt-m-111 cl10">
                                &#8358 <?php echo total($conn) ?>
							</span>
						</div>

						<a href="shop-cart.php" class="flex-c-m size-a-8 bg10 txt-s-105 cl13 hov-btn2 trans-04">
							check out
						</a>	
					</div>
				</div>
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
            <ul class="main-menu-m" style="font-weight:600;">
                <li class="active-menu">
                    <a href="index.php">Home</a>
                </li>

                <li>
                    <a href="about.php">Who are we?</a>
                </li>

                <li>
                    <a href="shop.php">Shop</a>
                </li>

                <li>
                    <a href="index.php#WhatWeOffer">What we offer?</a>
                </li>

                <li>
                    <a href="contact.php">Contact us</a>
                </li>
            </ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
				<span class="fa fa-times"></span>
			</button>
			
			<div class="container-search-header">
				<form action="" method="post" enctype="multipart/form-data" class="wrap-search-header flex-w">
					<button class="flex-c-m trans-04">
						<span class="fa fa-search"></span>
					</button>
					<input class="plh1" type="text" name="search" placeholder="Search...">
				</form>
			</div>
		</div>
	</header>