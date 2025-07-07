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
                                    <li>Testimonials</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ===============  breadcrumb area start =============== -->

            <!-- =============== Testimonial area start =============== -->
            <div class="testimonial-area my-5 py-5">
                <div class="container">
                    <div class="row justify-content-center">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="sec_title position-relative text-center">
								<h2 class="off_title">Testimonials</h2>
                                <h3 class="ft-bold pt-3">What Our Customers Say</h3>
							</div>
						</div>
					</div>
                    <div class="row gy-4" data-masonry='{"percentPosition": true }'>
                        <?php $testimonial = Operations::getRating(); if (!empty($testimonial)) { foreach ($testimonial as $test) { ?>
                        <!-- Testimonial -->
                        <div class="col-md-6 col-lg-6">
                            <div class="testimonial-item text-center p-4 border rounded">
                                <div class="reviewer-image mb-3">
                                    <?php if ($test['gender'] === 'Male') { ?>
                                        <img src="assets/img/profil-img-1.png" alt="Reviewer Male Image" class="img-fluid rounded-circle" width="100">
                                    <?php } else { ?>
                                        <img src="assets/img/profil-img-2.png" alt="Reviewer Female Image" class="img-fluid rounded-circle" width="100">
                                    <?php } ?>
                                </div>
                                <div class="d-flex align-items-center flex-column">
                                    <h5 class="mb-2"><?= $test['name'] ?></h5>
                                    <ul class="review-rating d-flex justify-content-center flex-row mb-0 p-0">
                                        <?php for ($i = 1; $i <= $test['rating']; $i++) { ?>
                                        <li><i class="fas fa-star text-warning"></i></li>
                                        <?php } $less = 5 - $test['rating']; for ($i = 1; $i <= $less; $i++) { ?>
                                        <li><i class="fas fa-star-half-alt text-warning"></i></li>
                                        <?php } ?>
                                    </ul>
                                    <p><?= $test['review'] ?></p>
                                </div>
                            </div>
                        </div>
                        <?php } } else { echo "<p>Testimonials Not Found!</p>"; } ?>
                    </div>
                </div>
            </div>
            <!-- =============== Testimonial area end =============== -->


        <?php include "temp/footer.php" ?>

        <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>

    </body>
</html>