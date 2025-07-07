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
                                        <h5 class="card-title">Order History</h5>
                                    </div>
                                    <div class="card-body">
                                        <!-- Table start -->
                                        <div class="table-outer">
                                            <div class="table-responsive">
                                                <table class="table truncate align-middle">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Product</th>
                                                            <th>Category</th>
                                                            <th>Order ID</th>
                                                            <th>Order User</th>
                                                            <th>User Email</th>
                                                            <th>User Phone</th>
                                                            <th>Location</th>
                                                            <th>Order Date</th>
                                                            <th>Payment</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        $orders = Operations::getUserOrders();
                                                        if (!empty($orders)) {
                                                            $i = 1;
                                                            foreach ($orders as $row) {
                                                    ?>
                                                        <tr>
                                                            <td><?= $i++ ?></td>

                                                            <!-- Product title -->
                                                            <td><?= htmlspecialchars($row['product_name']) ?></td>

                                                            <!-- Product category -->
                                                            <td><?= htmlspecialchars($row['category'] ?? '-') ?></td>

                                                            <!-- Order ID -->
                                                            <td>#<?= htmlspecialchars($row['payment_id']) ?></td>

                                                            <!-- User info (assuming current user only) -->
                                                            <td><?= htmlspecialchars($row['customer_name'] ?? 'User') ?></td>

                                                            <!-- User email -->
                                                            <td><?= htmlspecialchars($row['customer_email']) ?></td>

                                                            <!-- User phone -->
                                                            <td><?= htmlspecialchars($row['customer_phone']) ?></td>
                                                            
                                                            <!-- User Location -->
                                                            <td><?= htmlspecialchars($row['customer_location']) ?></td>
                                                            
                                                            <!-- Order Date -->
                                                            <td><?= date('Y/m/d', strtotime($row['paid_at'])) ?></td>

                                                            <!-- Payment Status -->
                                                            <td>
                                                                <?php
                                                                    $status = strtolower($row['order_status']);
                                                                    $badgeClass = match($status) {
                                                                        'paid'     => 'success',
                                                                        'pending'  => 'warning',
                                                                        'failed'   => 'danger',
                                                                        default    => 'secondary'
                                                                    };
                                                                ?>
                                                                <span class="badge border bg-<?= $badgeClass ?> text-white text-capitalize">
                                                                    <?= $row['order_status'] ?>
                                                                </span>
                                                            </td>

                                                            <!-- Action column (custom label or icon) -->
                                                            <td>
                                                                <span class="badge bg-primary">View</span>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        }
                                                    } else {
                                                        echo '<tr><td colspan="8" class="text-center">No orders found</td></tr>';
                                                    }
                                                    ?>
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