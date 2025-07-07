<?php

    include "../libs/load.php";

    // Start a session
    Session::start();

    if (!Session::get('login_user'))
    {
        header("Location: index.php");
        exit;
    }

    $error = "";

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        // Check if both username and password keys exist in $_POST
        if (isset($_POST['submit']) && isset($_POST['cate']) && isset($_POST['title']) && isset($_FILES['img']) && isset($_POST['status']))
        {
            $img = $_FILES['img'] ?? "";
            $title = $_POST['title'] ?? "";
            $price = $_POST['price'] ?? "";
            $sub = $_POST['sub'] ?? "";
            $cate = $_POST['cate'] ?? "";
            $latest = $_POST['latest'] ?? "";
            $discount = $_POST['discount'] ?? "";
            $status = $_POST['status'] ?? "";

            $error = User::setProducts($img, $title, $price, $sub, $discount, $cate, $status, $latest);
        } else {
            $error = "Invalid form submission";
        }
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
                        <div class="row">
                            <div class="col-12">
                                <div class="d-sm-flex align-items-center justify-space-between">
                                    <p class="<?= $error ? 'text-danger' : 'text-success' ?> p-0 m-0"><?= $error ?></p>
                                </div>
                            </div>
                            <div class="col-12">
                                <!-- start Default Basic Forms -->
                                <div class="card">
                                    <div class="card-body">
                                        <form class="form needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                                            <div class="mb-3">
                                                <label class="form-label">Title *</label>
                                                <input type="text" class="form-control" name="title" placeholder="Enter Title" required>
                                                <div class="invalid-feedback">Please enter a title.</div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Price</label>
                                                <input type="number" class="form-control" name="price" placeholder="Enter Price">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Sub Price</label>
                                                <input type="number" class="form-control" name="sub" placeholder="Enter Sub Price">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Discount (%)</label>
                                                <input type="number" class="form-control" name="discount" placeholder="Enter Discount">
                                            </div>

                                            <?php $cate = Operations::getCategory(); if (!empty($cate)) { ?>
                                            <div class="mb-3">
                                                <label class="form-label">Product Category *</label>
                                                <select class="form-control" name="cate" required>
                                                    <option selected disabled>Select Product Category</option>
                                                    <?php foreach ($cate as $c) { ?>
                                                    <option value="<?= $c['category'] ?>"><?= $c['category'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback">Please Select a Category.</div>
                                            </div>
                                            <?php } ?>

                                            <div class="mb-3">
                                                <label class="form-label">Products Status *</label>
                                                <select class="form-control" name="status" required>
                                                    <option value="" selected disabled>Select Product Status</option>
                                                    <option value="Sale">Sale</option>
                                                    <option value="Sold Out">Sold Out</option>
                                                </select>
                                                <div class="invalid-feedback">Please Select a Status.</div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Latest Products</label>
                                                <select class="form-control" name="latest">
                                                    <option value="" selected disabled>Select Product Type</option>
                                                    <option value="Top Products">Top Products</option>
                                                    <option value="New Arrival">New Arrival</option>
                                                    <option value="Best Collections">Best Collections</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Image Upload *</label>
                                                <input type="file" class="form-control" name="img" accept="image/*" required>
                                                <div class="invalid-feedback">Please upload an image.</div>
                                            </div>

                                            <div class="col-12">
                                                <div class="d-md-flex align-items-center">
                                                    <div class="ms-auto mt-3 mt-md-0">
                                                        <button type="submit" name="submit" class="btn btn-primary hstack gap-6">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <!-- Bootstrap Validation Script -->
                                        <script>
                                            (() => {
                                                'use strict';
                                                const forms = document.querySelectorAll('.needs-validation');
                                                Array.from(forms).forEach(form => {
                                                    form.addEventListener('submit', event => {
                                                        if (!form.checkValidity()) {
                                                            event.preventDefault();
                                                            event.stopPropagation();
                                                        }
                                                        form.classList.add('was-validated');
                                                    }, false);
                                                });
                                            })();
                                        </script>
                                    </div>
                                </div>
                                <!-- end Default Basic Forms -->
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