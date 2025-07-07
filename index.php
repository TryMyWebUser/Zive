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

			<!-- ======================= All Category ======================== -->
			<section class="middle border-top border-bottom py-3">
				<div class="container">
					
					<!--<div class="row justify-content-center">-->
					<!--	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">-->
					<!--		<div class="sec_title position-relative text-center">-->
					<!--			<h2 class="off_title">Products</h2>-->
					<!--			<h3 class="ft-bold pt-3">Categories</h3>-->
					<!--		</div>-->
					<!--	</div>-->
					<!--</div>-->
					
					<div class="row align-items-center justify-content-center">
						<?php
							if (!empty($category)) {
								foreach ($category as $cate) {
						?>
						<div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-4">
							<div class="cats_side_wrap text-center mx-auto mb-3">
								<div class="sl_cat_01">
									<div class="d-inline-flex align-items-center justify-content-center circle mb-2 border">
										<a href="product.php?data=<?= $cate['category'] ?>" class="d-block">
											<img src="assets/<?= $cate['img']; ?>" class="img-fluid" style="border-radius: 5rem; box-shadow: 0 0 0 2px #000; width: 6rem; height: 6rem;" alt="">
										</a>
									</div>
								</div>
								<div class="sl_cat_02">
									<h6 class="m-0 ft-medium fs-sm">
										<a href="product.php?data=<?= $cate['category'] ?>"><?= $cate['category']; ?></a>
									</h6>
								</div>
							</div>
						</div>
						<?php } } else { echo "<p>Category Not Found</p>"; } ?>
					</div>
					
				</div>
			</section>
			<!-- ======================= All Category ======================== -->

            <!-- ============================ Hero Banner  Start================================== -->
			<div class="home-slider margin-bottom-0">

				<!-- Slide -->
				<div data-background-image="assets/img/bg/bg-1.png" class="item"></div>
				<!-- Slide -->
				<div data-background-image="assets/img/bg/bg-2.png" class="item"></div>
				<!-- Slide -->
				<div data-background-image="assets/img/bg/bg-3.png" class="item"></div>
				<!-- Slide -->
				<div data-background-image="assets/img/bg/bg-4.png" class="item"></div>
				<!-- Slide -->
				<div data-background-image="assets/img/bg/bg-5.png" class="item"></div>

			</div>
			<!-- ============================ Hero Banner End ================================== -->

            <!-- ======================= Product List ======================== -->
            <section class="middle">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="sec_title position-relative text-center">
                                <h2 class="off_title">Trendy Products</h2>
                                <h3 class="ft-bold pt-3">Our Trending Products</h3>
                            </div>
                        </div>
                    </div>

                    <!-- row -->
                    <div class="row align-items-center rows-products">
                        <?php
                            $products = Operations::getProductChecker();
                            foreach ($products as $pro) {
                                if ($pro['latest'] != 'Best Collections') {
                        ?>
                        <!-- Single -->
                        <div class="col-xl-3 col-lg-4 col-md-6 col-6">
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
                                        <a class="card-img-top d-block overflow-hidden" href="product.php?data=<?= $pro['category'] ?>">
                                            <img class="card-img-top" src="assets/<?= $pro['img'] ?>" alt="<?= $pro['title'] ?>" />
                                        </a>
                                        <div class="product-hover-overlay bg-dark d-flex align-items-center justify-content-center">
                                            <div class="edlio">
                                                <a href="javascript:void(0)" class="text-white fs-sm ft-medium"
                                                    data-add-to-cart data-id="<?= $pro['id']; ?>"><i class="fas fa-shopping-cart me-1"></i>Add to Cart</a>
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
                        <?php } } ?>
                    </div>
                    <!-- row -->

                    <!-- <div class="row justify-content-center">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="position-relative text-center">
                                <a href="shop-style-1.html" class="btn stretched-links borders">Explore More<i class="lni lni-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                    </div> -->
                </div>
            </section>
            <!-- ======================= Product List ======================== -->

			<!-- ======================= Best Start ============================ -->
			<section class="space gray">
				<div class="container">
					
					<div class="row justify-content-center">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="sec_title position-relative text-center">
								<h2 class="off_title">Products</h2>
								<h3 class="ft-bold pt-3">Best Collections</h3>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="slide_items">
								<?php
                                    $products = Operations::getProductChecker();
                                    foreach ($products as $pro) {
                                        if ($pro['latest'] == 'Best Collections') {
                                ?>
								<!-- single Item -->
								<div class="single_itesm">
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
                                                <a class="card-img-top d-block overflow-hidden" href="product.php?data=<?= $pro['category'] ?>">
                                                    <img class="card-img-top" src="assets/<?= $pro['img'] ?>" alt="<?= $pro['title'] ?>" />
                                                </a>
                                                <div class="product-hover-overlay bg-dark d-flex align-items-center justify-content-center">
                                                    <div class="edlio">
                                                        <a href="javascript:void(0)" class="text-white fs-sm ft-medium"
                                                            data-add-to-cart data-id="<?= $pro['id']; ?>"><i class="fas fa-shopping-cart me-1"></i>Add to Cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<div class="card-footer b-0 p-3 pb-0 d-flex align-items-start justify-content-center">
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
								<?php } } ?>
							</div>
						</div>
					</div>
					
				</div>
			</section>
			<!-- ======================= Best End ============================ -->

            <!-- ======================= Customer Review ======================== -->
            <section class="gray">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="sec_title position-relative text-center">
                                <h2 class="off_title">Testimonials</h2>
                                <h3 class="ft-bold pt-3">What Our Customers Say</h3>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12">
                            <div class="reviews-slide px-3">
								<?php $testimonial = Operations::getRating(); if (!empty($testimonial)) { foreach ($testimonial as $test) { ?>
                                <!-- single review -->
                                <div class="single_review">
                                    <div class="sng_rev_thumb">
                                        <figure>
											<?php if ($test['gender'] === 'Male') { ?>
												<img src="assets/img/profil-img-1.png" class="img-fluid circle" alt="Reviewer Male Image">
											<?php } else { ?>
												<img src="assets/img/profil-img-2.png" class="img-fluid circle" alt="Reviewer Female Image">
											<?php } ?>
										</figure>
                                    </div>
                                    <div class="sng_rev_caption text-center">
                                        <div class="rev_desc mb-4">
                                            <p class="fs-md">
                                                <?= $test['review'] ?>
                                            </p>
                                        </div>
                                        <div class="rev_author">
                                            <h4 class="mb-0"><?= $test['name'] ?></h4>
											<ul class="review-rating d-flex justify-content-center flex-row mb-0 p-0">
												<?php for ($i = 1; $i <= $test['rating']; $i++) { ?>
												<li><i class="fas fa-star text-warning"></i></li>
												<?php } $less = 5 - $test['rating']; for ($i = 1; $i <= $less; $i++) { ?>
												<li><i class="fas fa-star-half-alt text-warning"></i></li>
												<?php } ?>
											</ul>
                                        </div>
                                    </div>
                                </div>
								<?php } } else { echo "<p>Testimonials Not Found!</p>"; } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ======================= Customer Review ======================== -->

            <?php include "temp/footer.php" ?>

	</body>
</html>