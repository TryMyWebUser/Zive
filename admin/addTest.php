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
        if (isset($_POST['submit']) && isset($_POST['rating']) && isset($_POST['name']) && isset($_POST['review']) && isset($_POST['gender']))
        {
            $rating = $_POST['rating'] ?? "";
            $name = $_POST['name'] ?? "";
            $review = $_POST['review'] ?? "";
            $gender = $_POST['gender'] ?? "";

            $error = User::setReviews($rating, $name, $review, $gender);
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
                                        <form class="form needs-validation" method="POST">
                                            <div class="mb-3">
                                                <label class="form-label">Star Rating *</label>
                                                <input type="number" class="form-control" name="rating" max="5" min="1" value="1" placeholder="Enter Rating" required>
                                                <div class="invalid-feedback">Please enter a rating.</div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label class="form-label">Name *</label>
                                                <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                                                <div class="invalid-feedback">Please enter a name.</div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Gender *</label>
                                                <select class="form-control" name="gender" required>
                                                    <option value="" selected disabled>Select a Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                                <div class="invalid-feedback">Please select a gender.</div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Review *</label>
                                                <textarea class="form-control" name="review" rows="6" required></textarea>
                                                <div class="invalid-feedback">Please enter a review.</div>
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