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
        if (isset($_POST['submit']) && isset($_POST['category']) && isset($_FILES['img']))
        {
            $img = $_FILES['img'] ?? null;
            $cate = $_POST['category'] ?? "";
            $error = User::setCategory($img, $cate);
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
                        <!-- Row starts -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-body">
                                    <form class="form-horizontal needs-validation" method="POST" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label class="form-label">Image Upload *</label>
                                            <input type="file" class="form-control" name="img" accept="image/*" required>
                                            <div class="invalid-feedback">Please upload an image.</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Category *</label>
                                            <input type="text" class="form-control" placeholder="Enter Category Name" name="category" required>
                                            <div class="invalid-feedback">Please enter a category name.</div>
                                        </div>
                                        <p class="<?= $error ? 'text-danger' : 'text-success' ?>"><?= $error ?></p>
                                        <div class="col-12">
                                            <div class="d-md-flex align-items-center">
                                                <div class="ms-auto mt-3 mt-md-0">
                                                    <button type="submit" name="submit" class="btn btn-primary hstack gap-6">
                                                        Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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