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

            <!-- ======================= Top Breadcrubms ======================== -->
            <div class="gray py-3">
                <div class="container">
                    <div class="row">
                        <div class="colxl-12 col-lg-12 col-md-12">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li><a href="index.php">Home</a></li>
									<li> / </li>
                                    <li>Contact Us</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ======================= Top Breadcrubms ======================== -->

            <!-- ======================= Contact Page Detail ======================== -->
            <section class="middle">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="sec_title position-relative text-center">
                                <h2 class="off_title">Contact Us</h2>
                                <h3 class="ft-bold pt-3">Get In Touch</h3>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-start justify-content-between">
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                            <div class="card-wrap-body mb-4">
                                <h4 class="ft-medium mb-3 theme-cl">Reach Us</h4>
                                <p>
									<a href="https://maps.app.goo.gl/smRZ3pCgHuMBCEAi7?g_st=iw">
										D23, Ahuja haven, Nanjundapuram Road, Ramanathapuram, Coimbatore - 641045
									</a>
                                </p>
                            </div>

                            <div class="card-wrap-body mb-3">
                                <h4 class="ft-medium mb-3 theme-cl">Make a Call</h4>
                                <h6 class="ft-medium mb-1">Customer Care:</h6>
                                <p class="mb-2"><a href="tel:9952467399">+91 9952 467 399</a></p>
                            </div>

                            <div class="card-wrap-body mb-3">
                                <h4 class="ft-medium mb-3 theme-cl">Drop A Mail</h4>
                                <p class="lh-1 text-dark"><a href="zivewearthecomfort@gmail.com">Zivewearthecomfort@gmail.com</a></p>
                            </div>
                        </div>

                        <div class="col-xl-7 col-lg-8 col-md-12 col-sm-12">
                            <form class="row g-3">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="small text-dark ft-medium mb-2">Your Name *</label>
                                        <input type="text" class="form-control" placeholder="Your Name" />
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="small text-dark ft-medium mb-2">Your Email *</label>
                                        <input type="text" class="form-control" placeholder="Your Email" />
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="small text-dark ft-medium mb-2">Subject</label>
                                        <input type="text" class="form-control" placeholder="Type Your Subject" />
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="small text-dark ft-medium mb-2">Message</label>
                                        <textarea class="form-control ht-80"></textarea>
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-dark">Send Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ======================= Contact Page End ======================== -->

            <?php include "temp/footer.php" ?>

    </body>
</html>