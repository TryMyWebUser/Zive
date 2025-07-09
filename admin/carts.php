<?php

include "../libs/load.php";

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
                        <div class="row gx-4">
                            <div class="col-xl-12 col-sm-12">
                                <!-- Card start -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Carts History</h5>
                                    </div>
                                    <div class="card-body">
                                        <!-- Table start -->
                                        <div class="table-outer">
                                            <div class="table-responsive">
                                                <table class="table truncate align-middle">
                                                    <?php
                                                        $allCarts = Operations::getAuthCarts();
                                                    ?>
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>User</th>
                                                            <th>Email</th>
                                                            <th>Product</th>
                                                            <th>Qty</th>
                                                            <th>Price</th>
                                                            <th>Subtotal</th>
                                                            <th>Location</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if (!empty($allCarts)) {
                                                            $i = 1;
                                                            foreach ($allCarts as $row) { ?>
                                                            <tr>
                                                                <td><?= $i++ ?></td>
                                                                <td><?= htmlspecialchars($row['username']) ?></td>
                                                                <td><?= htmlspecialchars($row['user_email'] ?? '-') ?></td>
                                                                <td><?= htmlspecialchars($row['product_name']) ?></td>
                                                                <td><?= (int)$row['quantity'] ?></td>
                                                                <td>₹<?= number_format($row['unit_price'], 2) ?></td>
                                                                <td>₹<?= number_format($row['unit_price'] * $row['quantity'], 2) ?></td>
                                                                <td><?= htmlspecialchars($row['user_location'] ?? '-') ?></td>
                                                                <td>
                                                                    <a href="deleteCarts.php?delete_id=<?= $row['cart_id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                                                </td>
                                                            </tr>
                                                    <?php } 
                                                       } else {
                                                            echo '<tr><td colspan="8" class="text-center">No cart entries found</td></tr>';
                                                       } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- Table end -->
                                    </div>
                                </div>
                                <!-- Card end -->
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