<?php

    include "../libs/load.php";

    // Start a session
    Session::start();

    if (!Session::get('login_user'))
    {
        header("Location: index.php");
        exit;
    }

    $pro = Operations::getProduct();

    $error = "";

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        // Check if both username and password keys exist in $_POST
        if (isset($_POST['submit']) && isset($_POST['cate']) && isset($_POST['title']) && isset($_POST['status']))
        {
            $getID = $_GET['edit_id'];
            $img = $_FILES['img'] ?? "";
            $title = $_POST['title'] ?? "";
            $price = $_POST['price'] ?? "";
            $sub = $_POST['sub'] ?? "";
            $cate = $_POST['cate'] ?? "";
            $latest = $_POST['latest'] ?? "";
            $discount = $_POST['discount'] ?? "";
            $status = $_POST['status'] ?? "";

            $error = User::updateProducts($img, $title, $price, $sub, $discount, $cate, $status, $latest, $getID);
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
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="d-sm-flex align-items-center justify-space-between">
                                    <p class="<?= $error ? 'text-danger' : 'text-success' ?> p-0 m-0"><?= $error ?></p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form class="form needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                                            <!-- Title -->
                                            <div class="mb-3">
                                                <label class="form-label">Title *</label>
                                                <input type="text" class="form-control" name="title" placeholder="Enter Title" value="<?= htmlspecialchars($pro['title']) ?>" required>
                                                <div class="invalid-feedback">Please enter a title.</div>
                                            </div>

                                            <!-- Price -->
                                            <div class="mb-3">
                                                <label class="form-label">Price</label>
                                                <input type="number" class="form-control" name="price" placeholder="Enter Price" value="<?= htmlspecialchars($pro['price']) ?>">
                                            </div>

                                            <!-- Product Category -->
                                            <div class="mb-3">
                                                <label class="form-label">Sub Price</label>
                                                <input type="number" class="form-control" name="sub" placeholder="Enter Sub Price" value="<?= htmlspecialchars($pro['sub-price']) ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Discount (%)</label>
                                                <input type="number" class="form-control" name="discount" placeholder="Enter Discount" value="<?= htmlspecialchars($pro['discount']) ?>">
                                            </div>

                                            <!-- Category Dropdown -->
                                            <?php $cateList = Operations::getCategoryChecker(); if (!empty($cateList)) { ?>
                                            <div class="mb-3">
                                                <label class="form-label">Product Category *</label>
                                                <select class="form-control" name="cate" required>
                                                    <option value="<?= htmlspecialchars($pro['category']) ?>">Select Product Category</option>
                                                    <?php
                                                        foreach ($cateList as $c) { ?>
                                                            <option value="<?= $c['category'] ?>">
                                                                <?= $c['category'] ?>
                                                            </option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback">Please Select a Category.</div>
                                            </div>
                                            <?php } ?>

                                            <div class="mb-3">
                                                <label class="form-label">Products Status *</label>
                                                <select class="form-control" name="status" required>
                                                    <option value="<?= htmlspecialchars($pro['status']) ?>">Select Product Status</option>
                                                    <option value="Sale">Sale</option>
                                                    <option value="Sold Out">Sold Out</option>
                                                </select>
                                                <div class="invalid-feedback">Please Select a Status.</div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Latest Products</label>
                                                <select class="form-control" name="latest">
                                                    <option value="<?= htmlspecialchars($pro['latest']) ?>">Select Product Type</option>
                                                    <option value="Top Products">Top Products</option>
                                                    <option value="New Arrival">New Arrival</option>
                                                    <option value="Best Collections">Best Collections</option>
                                                </select>
                                            </div>

                                            <!-- Image Upload -->
                                            <div class="mb-3">
                                                <label class="form-label">Image Upload <?= $pro['img'] ? '' : '*' ?></label><br>
                                                <?php if ($pro['img']) { ?>
                                                    <img src="<?= $pro['img'] ?>" alt="Current image" class="mb-2" style="width:6rem; box-shadow:0 0 0 2px #0001; border-radius:5px;">
                                                <?php } ?>
                                                <input type="file" class="form-control" name="img" accept="image/*" <?= $pro['img'] ? '' : 'required' ?>>
                                                <div class="invalid-feedback">Please upload an image.</div>
                                            </div>

                                            <div class="d-flex justify-content-end">
                                                <button type="submit" name="submit" class="btn btn-primary">
                                                    Save
                                                </button>
                                            </div>
                                        </form>
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

        <!-- Bootstrap validation (same as Add page) -->
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
    </body>
</html>