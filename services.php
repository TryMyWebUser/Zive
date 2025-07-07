<?php

include "libs/load.php";

// Start a session
Session::start();

?>

<!DOCTYPE html>
<html lang="zxx">
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="Themezhub" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <?php include "temp/head.php" ?>

    </head>

    <body>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader"></div>

        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
            <?php include "temp/header.php" ?>

            <!-- ===============  breadcrumb area start =============== -->
            <div class="gray py-3">
                <div class="container">
                    <div class="row">
                        <div class="colxl-12 col-lg-12 col-md-12">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li><a href="index.php">Home</a></li>
                                    <li> / </li>
                                    <li>Services</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ===============  breadcrumb area start =============== -->

            <!-- ===============  Services area start =============== -->
            <section class="my-5 py-5">
				<div class="container">
					<div class="row">
						
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
							<div class="d-flex align-items-center justify-content-start py-2">
								<div class="d_ico">
									<i class="fas fa-scissors theme-cl"></i>
								</div>
								<div class="d_capt">
									<h5 class="mb-0">Custom Tailoring</h5>
									<span class="text-muted">Expertly tailored outfits to match your personal style and fit preferences.</span>
								</div>
							</div>
						</div>
						
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
							<div class="d-flex align-items-center justify-content-start py-2">
								<div class="d_ico">
									<i class="fas fa-user-tie theme-cl"></i>
								</div>
								<div class="d_capt">
									<h5 class="mb-0">Exclusive Designs</h5>
									<span class="text-muted">Explore unique boutique pieces crafted by our in-house designers.</span>
								</div>
							</div>
						</div>
						
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
							<div class="d-flex align-items-center justify-content-start py-2">
								<div class="d_ico">
									<i class="fas fa-shield-alt theme-cl"></i>
								</div>
								<div class="d_capt">
									<h5 class="mb-0">Personalized Styling</h5>
									<span class="text-muted">Get one-on-one fashion advice tailored to your needs and occasions.</span>
								</div>
							</div>
						</div>
						
						<!-- Include this in the head -->
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

                        <!-- Icon block -->
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="d-flex align-items-center justify-content-start py-2">
                                <div class="d_ico">
                                    <i class="fas fa-truck-fast theme-cl"></i>
                                </div>
                                <div class="d_capt">
                                    <h5 class="mb-0">Doorstep Delivery</h5>
                                    <span class="text-muted">Receive your customized and ready-to-wear outfits at your doorstep.</span>
                                </div>
                            </div>
                        </div>
						
					</div>
				</div>
			</section>
            <!-- ===============  Services area end =============== -->


        <?php include "temp/footer.php" ?>

    </body>
</html>