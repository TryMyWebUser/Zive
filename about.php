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
                                    <li>About Us</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ===============  breadcrumb area start =============== -->

            <!-- ======================= About Us Detail ======================== -->
            <section class="middle">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="abt_caption">
                                <img src="assets/img/about-1.png" class="img-fluid rounded" alt="" />
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="abt_caption">
								<h6 class="ft-medium mb-1">About Us!</h6>
                                <h2 class="ft-medium mb-4">Zive <strong>Wear The Comfort</strong></h2>
                                <p class="mb-4">
                                    At ZIVE, we believe fashion is not just about looking good - it's about feeling good. Rooted in the philosophy of "Wear the Comfort", ZIVE blends timeless elegance with everyday ease, delivering fashion that fits seamlessly into your lifestyle.
                                </p>
                                <p class="mb-4">
                                    Our boutique is a celebration of individuality and effortless style. Each piece in our collection is thoughtfully curated and designed to offer a unique blend of comfort, quality, and sophistication. Whether you're dressing up for a special occasion or embracing the beauty of casual minimalism, ZIVE ensures you never have to choose between style and comfort.
                                </p>
								<p class="mb-4">
									We cater to those who appreciate subtle luxury - from breathable fabrics and flattering silhouettes to finely crafted details. At ZIVE, comfort is never an afterthought. It is the foundation of our design.
								</p>
                                <div class="form-group mt-4">
                                    <a href="https://wa.me/9952467399" class="btn btn-dark">For Enquiry</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ======================= About Us End ======================== -->

            <!-- ===============  Services area start =============== -->
            <section class="py-5 br-top">
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