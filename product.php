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
                                    <li><?= $_GET['data'] ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ===============  breadcrumb area start =============== -->

            <!-- ======================= Product List ======================== -->
            <section class="middle">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="sec_title position-relative text-center">
                                <h2 class="off_title">Products</h2>
                                <h3 class="ft-bold pt-3"><?= $_GET['data'] ?></h3>
                            </div>
                        </div>
                    </div>

                    <!-- row -->
                    <div class="row align-items-center rows-products" data-masonry='{"percentPosition": true }'>
                        <?php
                            $products = Operations::getProductWhere();
                            if (!empty($products)) {
                                foreach ($products as $pro) {
                        ?>
                        <!-- Single -->
                        <div class="col-xl-3 col-lg-4 col-md-6 col-6 mb-4">
                            <div class="product_grid card b-0 mb-0">
                                <div class="position-absolute d-flex flex-column">
                                    <?php if (!empty($pro['discount'])) { ?>
                                    <div class="badge bg-hot text-white position-relative ft-regular ab-left text-upper mb-2"><?= $pro['discount'] ?>%</div>
                                    <?php } if (!empty($pro['status'])) { if ($pro['status'] == 'Sale') { ?>
                                    <div class="badge bg-new text-white position-relative ft-regular ab-left text-upper mb-2">Sale</div>
                                    <?php } else { ?>
                                    <div class="badge bg-sold text-white position-relative ft-regular ab-left text-upper mb-2">Sold Out</div>
                                    <?php } } ?>
                                </div>
                                <div class="card-body p-0">
                                    <div class="shop_thumb position-relative">
                                        <a class="card-img-top d-block overflow-hidden" data-add-to-cart href="product.php?data=<?= $pro['category'] ?>"
                                            data-id="<?= $pro['id']; ?>">
                                            <img class="card-img-top" src="assets/<?= $pro['img'] ?>" alt="<?= $pro['title'] ?>" />
                                        </a>
                                        <div class="product-hover-overlay bg-dark d-flex align-items-center justify-content-center">
                                            <div class="edlio">
                                                <a href="javascript:void(0)" class="text-white fs-sm ft-medium" data-add-to-cart data-id="<?= $pro['id']; ?>">
                                                    <i class="fas fa-shopping-cart me-1"></i>Add to Cart
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footers b-0 pt-3 px-2 bg-white d-flex align-items-start justify-content-center">
                                    <div class="text-left">
                                        <div class="text-center">
                                            <h5 class="fw-normal fs-md mb-0 lh-1 mb-1">
                                                <a href="product.php?data=<?= $pro['category'] ?>">
                                                    <?= $pro['title'] ?>
                                                </a>
                                            </h5>
                                            <div class="elis_rty">
                                                <?php if (!empty($pro['sub-price'])) { ?>
                                                <del class="fw-medium fs-md text-secondary">₹<?= $pro['sub-price'] ?></del>
                                                <?php } if (!empty($pro['price'])) { ?>
                                                <span class="fw-medium fs-md text-dark">₹<?= $pro['price'] ?></span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } } else { echo "<p>Product Not Found!</p>"; } ?>
                    </div>
                    <!-- row -->
                </div>
            </section>
            <!-- ======================= Product List ======================== -->

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

        <!-- <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const orderButtons = document.querySelectorAll(".whatsapp-order");

                orderButtons.forEach(button => {
                    button.addEventListener("click", () => {
                        const title = button.getAttribute("data-title");
                        const cate = button.getAttribute("data-cate");
                        const price = parseFloat(button.getAttribute("data-price"));
                        const discount = parseFloat(button.getAttribute("data-discount")) || 0;
                        const remarks = "-";

                        // Calculate discount amount and grand total
                        const discountAmount = (price * discount) / 100;
                        const grandTotal = price - discountAmount;

                        const message = 
                            `Hello Zive, I would like to order:  
Product Name: *${title}*  
Category: *${cate}*
Price per qty: Rs.${price.toFixed(2)}
Discount: ${discount}% (Rs.${discountAmount.toFixed(2)})
Grand Total: Rs.${grandTotal.toFixed(2)}  
Remarks: ${remarks}`;

                        const encodedMessage = encodeURIComponent(message);
                        const whatsappNumber = "919952467399";
                        const whatsappURL = `https://wa.me/${whatsappNumber}?text=${encodedMessage}`;

                        window.open(whatsappURL, "_blank");
                    });
                });
            });
        </script> -->
	</body>
</html>