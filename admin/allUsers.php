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
                                        <h5 class="card-title">All Users</h5>
                                    </div>
                                    <div class="card-body">
                                        <!-- Table start -->
                                        <div class="table-outer">
                                            <div class="table-responsive">
                                                <table class="table truncate align-middle">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Username</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Location</th>
                                                            <th>Avatar</th>
                                                            <th>Uploaded Time</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $users = Operations::getAllUsers(); if (!empty($users)) {
                                                        $i = 1;
                                                        foreach ($users as $user): ?>
                                                            <tr>
                                                                <td><?= $i++ ?></td>
                                                                <td><?= htmlspecialchars($user['username']) ?></td>
                                                                <td><?= htmlspecialchars($user['email']) ?></td>
                                                                <td><?= htmlspecialchars($user['phone']) ?></td>
                                                                <td><?= htmlspecialchars($user['location'] ?? '-') ?></td>
                                                                <td>
                                                                    <?php if (!empty($user['avatar'])): ?>
                                                                        <img src="../<?= htmlspecialchars($user['avatar']) ?>" width="50" height="50" class="rounded-circle" alt="Avatar">
                                                                    <?php else: ?>
                                                                        <span class="text-muted">No avatar</span>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td><?= date('Y-m-d H:i:s', strtotime($user['uploaded_time'])) ?></td>
                                                                <td>
                                                                    <!--<a href="#" class="btn btn-sm btn-primary">View</a>-->
                                                                    <a href="deleteUser.php?delete_id=<?= $user['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach;
                                                    } else {
                                                        echo '<tr><td colspan="8" class="text-center">No users found</td></tr>';
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