<?php

    include "../libs/load.php";

    // Start a session
    Session::start();

    if (!Session::get('login_user'))
    {
        header("Location: index.php");
        exit;
    }

    $category = Operations::getCategory();

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
                        <style>
                            .card {
                                padding: 20px;
                                background: #fff;
                                border-radius: 20px;
                                box-shadow: 0 0 30px rgba(0, 0, 0, .04);
                                transition: .4s ease;
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                text-align: center;
                            }

                            .card:hover {
                                transform: scale(1.05);
                            }

                            .card .card-image {
                                position: relative;
                                width: 100%;
                                height: auto;
                                padding: 20px;
                                background: #f4f7f8;
                                border-radius: 12px;
                                /* display: flex;
                                justify-content: center;
                                align-items: center; */
                            }

                            .card-content {
                                width: -webkit-fill-available;
                            }

                            .card .card-image img {
                                max-width: 100%;
                                height: auto;
                                transition: .4s ease;
                            }

                            .card:hover .card-image img {
                                transform: scale(1.02) rotate(-3deg) translateX(-5px);
                            }

                            .card-content h3 {
                                color: #222;
                                font-size: 22px;
                                margin-top: 15px;
                            }

                            .card-content p {
                                color: #555;
                                /* font-size: 18px; */
                                font-weight: 500;
                                margin: 8px 0 15px;
                                text-align: justify;
                            }

                            .card-content button.whatsapp-order {
                                cursor: pointer;
                                color: #fff;
                                width: 100%;
                                height: 50px;
                                font-size: 18px;
                                font-weight: 600;
                                border-radius: 12px;
                                border: none;
                                background: #128c7e;
                            }

                            @media (max-width: 768px) {
                                .card {
                                    width: 100%;
                                }
                            }
                        </style>
                        
                        <!-- Row starts -->
                        <div class="row">
                            <?php
                                if (!empty($category)) {
                                    foreach ($category as $cate) {
                            ?>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card">
                                    <div class="card-image p-0">
                                        <img src="<?= $cate['img']; ?>" alt="Image Not Found">
                                    </div>
                                    <div class="card-content">
                                        <h3 class="product-title"><?= $cate['category']; ?></h3>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <a href="deleteCate.php?delete_id=<?= $cate['id']; ?>">
                                                <button type="button" class="btn btn-square btn-outline-danger ms-1 p-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32"><path fill="currentColor" d="M13.5 6.5V7h5v-.5a2.5 2.5 0 0 0-5 0m-2 .5v-.5a4.5 4.5 0 1 1 9 0V7H28a1 1 0 1 1 0 2h-1.508L24.6 25.568A5 5 0 0 1 19.63 30h-7.26a5 5 0 0 1-4.97-4.432L5.508 9H4a1 1 0 0 1 0-2zM9.388 25.34a3 3 0 0 0 2.98 2.66h7.263a3 3 0 0 0 2.98-2.66L24.48 9H7.521zM13 12.5a1 1 0 0 1 1 1v10a1 1 0 1 1-2 0v-10a1 1 0 0 1 1-1m7 1a1 1 0 1 0-2 0v10a1 1 0 1 0 2 0z"/></svg>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } } else { echo "<p>Category Not Found</p>"; } ?>
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