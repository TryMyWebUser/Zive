<?php
    include "../libs/load.php";

    // Start a session
    Session::start();

    if (!Session::get('login_user')) {
        header("Location: index.php");
        exit;
    }

    $products = Operations::getProductChecker();
    $category = Operations::getCategoryChecker();
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

                        <div class="container my-5">
                            <!-- Place this filter button section ONCE, above your product cards -->
                            <div class="filters mb-4">
                                <a class="filter_link text-dark me-2" href="#" data-filter="all">
                                    <button type="button" class="btn btn-outline-primary mb-2">
                                        All
                                    </button>
                                </a>
                                <?php
                                if (!empty($category)) {
                                    foreach ($category as $cate) {
                                ?>
                                <a class="filter_link text-dark me-2" href="#" data-filter="<?= strtolower(str_replace([' ', '-', '_', '&'], '', $cate['category'])); ?>">
                                    <button type="button" class="btn btn-outline-info mb-2">
                                        <?= $cate['category'] ?>
                                    </button>
                                </a>
                                <?php } } ?>
                            </div>
                            <div class="row d-flex justify-content-center g-4">
                                <?php
                                    if (!empty($products)) {
                                        foreach ($products as $item) {
                                ?>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 pro-card <?= strtolower(str_replace([' ', '-', '_', '&'], '', $item['category'])); ?>">
                                    <div class="card">
                                        <div class="card-image p-0">
                                            <img src="<?= $item['img']; ?>" alt="Image Not Found">
                                        </div>
                                        <div class="card-content">
                                            <h3 class="product-title"><?= $item['title']; ?></h3>
                                            <p class="card-text"><?php if (!empty($item['sub-price'])) { ?><del>₹<?= $item['sub-price']; ?></del> / <?php } if (!empty($item['price'])) { ?>₹<?= $item['price']; ?><?php } ?></p>
                                            <p class="card-text"><?= $item['category']; ?></p>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <a href="editProduct.php?edit_id=<?= $item['id']; ?>">
                                                    <button type="button" class="btn btn-square btn-outline-info me-1 p-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.5" d="m14.36 4.079l.927-.927a3.932 3.932 0 0 1 5.561 5.561l-.927.927m-5.56-5.561s.115 1.97 1.853 3.707C17.952 9.524 19.92 9.64 19.92 9.64m-5.56-5.561L12 6.439m7.921 3.2l-5.26 5.262L11.56 18l-.16.161c-.578.577-.867.866-1.185 1.114a6.6 6.6 0 0 1-1.211.749c-.364.173-.751.302-1.526.56l-3.281 1.094m0 0l-.802.268a1.06 1.06 0 0 1-1.342-1.342l.268-.802m1.876 1.876l-1.876-1.876m0 0l1.094-3.281c.258-.775.387-1.162.56-1.526q.309-.647.749-1.211c.248-.318.537-.607 1.114-1.184L8.5 9.939"/></svg>
                                                    </button>
                                                </a>
                                                <a href="deletePro.php?delete_id=<?= $item['id']; ?>">
                                                    <button type="button" class="btn btn-square btn-outline-danger ms-1 p-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32"><path fill="currentColor" d="M13.5 6.5V7h5v-.5a2.5 2.5 0 0 0-5 0m-2 .5v-.5a4.5 4.5 0 1 1 9 0V7H28a1 1 0 1 1 0 2h-1.508L24.6 25.568A5 5 0 0 1 19.63 30h-7.26a5 5 0 0 1-4.97-4.432L5.508 9H4a1 1 0 0 1 0-2zM9.388 25.34a3 3 0 0 0 2.98 2.66h7.263a3 3 0 0 0 2.98-2.66L24.48 9H7.521zM13 12.5a1 1 0 0 1 1 1v10a1 1 0 1 1-2 0v-10a1 1 0 0 1 1-1m7 1a1 1 0 1 0-2 0v10a1 1 0 1 0 2 0z"/></svg>
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } } else { echo "Products Not Found"; } ?>
                            </div>
                            <!-- Row ends -->
                        </div>
                        <!-- App body ends -->
                    </div>

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

        <!-- Place this script ONCE, at the bottom of your page -->
        <script>
            $(document).ready(function () {
                var $mediaElements = $(".pro-card");
                var $container = $(".container .row");
                
                var $noResultsMessage = $("<p class='no-results text-center mt-4'>Products Not Found</p>").hide();
                $container.append($noResultsMessage);

                $(".filter_link").click(function (e) {
                    e.preventDefault();
                    var filterVal = $(this).data("filter");
                    
                    if (filterVal === "all") {
                        $mediaElements.slideDown("slow");
                        $noResultsMessage.hide();
                    } else {
                        var $filteredItems = $mediaElements.filter("." + filterVal);
                        
                        // Hide all first
                        $mediaElements.hide("slow");
                        
                        if ($filteredItems.length > 0) {
                            $filteredItems.slideDown("slow");
                            $noResultsMessage.hide();
                        } else {
                            $noResultsMessage.show();
                        }
                    }
                });
            });
        </script>
    </body>
</html>