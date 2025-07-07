<?php

    include "../libs/load.php";

    // Start a session
    Session::start();

    if (!Session::get('login_user'))
    {
        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <?php include "temp/head.php" ?>

    </head>

    <body>
        <!-- Page wrapper starts -->
        <div class="page-wrapper">
            <!-- Main container starts -->
            <div class="main-container">
                <!-- Sidebar wrapper starts -->
                <?php include "temp/sideheader.php" ?>
                <!-- Sidebar wrapper ends -->

                <!-- App container starts -->
                <div class="app-container">
                    <!-- App header starts -->
                    <?php include "temp/header.php" ?>
                    <!-- App header ends -->

                    <!-- App body starts -->
                    <div class="app-body">
                        <!-- Row starts -->
                        <div class="row gx-4" style="padding: 0 0 1.5rem 0;">
                            <div class="col-xxl-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-3 mt-2">Welcome, Admin.</h5>
                                        <p class="f-s-14 text-dark pb-0 mb-2 txt-ellipsis-2">
                                            Here's what's happening with your store today.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Row ends -->

                        <!-- Row starts -->
                        <div class="row gx-4">
                            <div class="col-xl-3 col-sm-6 col-12">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="p-2 border border-danger rounded-circle me-3">
                                                <div class="icon-box md bg-danger-subtle rounded-5">
                                                    <i class="bi bi-people-fill fs-4 text-danger"></i>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h2 class="lh-1"><?= Operations::getUsersCount(); ?></h2>
                                                <p class="m-0 opacity-50">Total Users</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-end mt-1">
                                            <a class="text-danger" href="javascript:void(0);">
                                                <span>View All</span>
                                                <i class="bi bi-arrow-right ms-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="p-2 border border-danger rounded-circle me-3">
                                                <div class="icon-box md bg-danger-subtle rounded-5">
                                                    <i class="bi bi-basket fs-4 text-danger"></i>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h2 class="lh-1"><?= Operations::getCartCount(); ?></h2>
                                                <p class="m-0 opacity-50">Total Carts</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-end mt-1">
                                            <a class="text-danger" href="javascript:void(0);">
                                                <span>View All</span>
                                                <i class="bi bi-arrow-right ms-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="p-2 border border-danger rounded-circle me-3">
                                                <div class="icon-box md bg-danger-subtle rounded-5">
                                                    <i class="bi bi-box fs-4 text-danger"></i>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h2 class="lh-1"><?= Operations::getOrdersCount(); ?></h2>
                                                <p class="m-0 opacity-50">Total Orders</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-end mt-1">
                                            <a class="text-danger" href="orders.php">
                                                <span>View All</span>
                                                <i class="bi bi-arrow-right ms-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12">
                                <div class="card mb-4 bg-primary">
                                    <div class="card-body text-white">
                                        <div class="d-flex align-items-center">
                                            <div class="p-2 border border-white rounded-circle me-3">
                                                <div class="icon-box md bg-white rounded-5">
                                                    <i class="bi bi-credit-card fs-4 text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h2 class="m-0 lh-1">₹<?= Operations::getPriceCount(); ?></h2>
                                                <p class="m-0 opacity-50">Total Payments</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-end mt-1">
                                            <a class="text-white" href="javascript:void(0);">
                                                <span>View All</span>
                                                <i class="bi bi-arrow-right ms-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Row ends -->
                    </div>
                    <!-- App body ends -->

                    <!-- App footer starts -->
                    <div class="app-footer">
                        <span class="small">Designed and Developed by <a href="https://trymywebsites.com/">Trymywebsites</a></span>
                    </div>
                    <!-- App footer ends -->
                </div>
                <!-- App container ends -->
            </div>
            <!-- Main container ends -->
        </div>
        <!-- Page wrapper ends -->

        <?php include "temp/footer.php" ?>

    </body>
</html>