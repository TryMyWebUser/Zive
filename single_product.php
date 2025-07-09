<?php

include "libs/load.php";

// Start a session
Session::start();

$pro = Operations::getProWhere();

$images = explode(',', $pro['img']);

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

            <!-- ======================= Product Detail ======================== -->
            <section class="middle">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12">
                            <div class="sp-loading">
                                <img src="<?= $images[0] ?>" alt="Product Image" /><br />
                            </div>
                            <div class="sp-wrap">
                                <?php foreach ($images as $img) { ?>
                                <a href="<?= $img ?>"><img src="<?= $img ?>" alt="Product Images" /></a>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12">
                            <div class="prd_details ps-xl-5">
                                <?php if (!empty($pro['discount'])) { ?>
                                <div class="prt_01 mb-3"><span class="text-danger bg-light-danger rounded px-2 py-1"><?= $pro['discount'] ?>%</span></div>
                                <?php } if (!empty($pro['status'])) { if ($pro['status'] == 'Sale') { ?>
                                <div class="prt_01 mb-3"><span class="text-success bg-light-success rounded px-2 py-1">Sale</span></div>
                                <?php } else { ?>
                                <div class="prt_01 mb-3"><span class="text-danger bg-light-danger rounded px-2 py-1">Sold Out</span></div>
                                <?php } } ?>
                                <div class="prt_02 mb-3">
                                    <h2 class="ft-bold mb-1"><?= $pro['title'] ?></h2>
                                    <div class="text-left">
                                        <div class="elis_rty">
                                            <?php if (!empty($pro['sub-price'])) { ?>
                                            <span class="ft-medium text-muted line-through fs-md me-2">₹<?= $pro['sub-price'] ?></span>
                                            <?php } if (!empty($pro['price'])) { ?>
                                            <span class="ft-bold theme-cl fs-lg">₹<?= $pro['price'] ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="prt_03 mb-4">
                                    <p>
                                        <?= $pro['dec'] ?>
                                    </p>
                                </div>

                                <div class="prt_05 mb-4">
                                    <div class="form-row row g-3 mb-7">
                                        <div class="col-12 col-md-12 col-lg-6">
                                            <!-- Submit -->
                                            <button type="button" data-add-to-cart data-id="<?= $pro['id']; ?>" class="btn btn-block custom-height bg-dark mb-2 w-100"><i class="lni lni-shopping-basket me-2"></i>Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ======================= Product Detail End ======================== -->

        <?php include "temp/footer.php" ?>
    </body>
</html>