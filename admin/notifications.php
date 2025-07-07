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
                                <div class="card">
                                    <div class="card-body">
                                        <!-- Search starts -->
                                        <div class="row gx-3 justify-content-end">
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" id="searchNotification" placeholder="Search Notifications" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Search ends -->

                                        <!-- Notifications Container Start -->
                                        <ul class="list-group">
                                            <!-- <li class="list-group-item">
                                                <h5 class="m-0 text-primary py-2">Today</h5>
                                            </li> -->
                                            <li class="list-group-item">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="assets/images/user1.png" alt="Admin Dashboard Templates" class="img-3xx rounded-circle" />
                                                    <div class="flex-1 flex flex-col">
                                                        <h6 class="fw-semibold mb-2">Angelica Ramos</h6>
                                                        <p class="mb-1">
                                                            Appriciated the project. "Great work. Keep on developing great themes."
                                                        </p>
                                                        <span class="badge bg-primary-subtle text-primary">
                                                            2 days ago.
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="assets/images/user2.png" alt="Admin Dashboard Templates" class="img-3xx rounded-circle" />
                                                    <div class="flex-1 flex flex-col">
                                                        <h6 class="fw-semibold mb-2">Brenden Wagner</h6>
                                                        <p class="mb-1">
                                                            Appriciated the project. "For dedication and hard work."
                                                        </p>
                                                        <span class="badge bg-primary-subtle text-primary">
                                                            2 days ago.
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="assets/images/user3.png" alt="Admin Dashboard Templates" class="img-3xx rounded-circle" />
                                                    <div class="flex-1 flex flex-col">
                                                        <h6 class="fw-semibold mb-2">Cedric Kelly</h6>
                                                        <p class="mb-1">
                                                            Appriciated the project. "Great admin theme."
                                                        </p>
                                                        <span class="badge bg-primary-subtle text-primary">
                                                            3 days ago.
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="assets/images/user.png" alt="Admin Dashboard Templates" class="img-3xx rounded-circle" />
                                                    <div class="flex-1 flex flex-col">
                                                        <h6 class="fw-semibold mb-2">Paul Byrd</h6>
                                                        <p class="mb-1">
                                                            Appriciated the project. "For creativity and outstanding work."
                                                        </p>
                                                        <span class="badge bg-primary-subtle text-primary">
                                                            4 days ago.
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="assets/images/user4.png" alt="Admin Dashboard Templates" class="img-3xx rounded-circle" />
                                                    <div class="flex-1 flex flex-col">
                                                        <h6 class="fw-semibold mb-2">Lorie Maxwell</h6>
                                                        <p class="mb-1">
                                                            Appriciated the project. "For quality work and effort."
                                                        </p>
                                                        <span class="badge bg-primary-subtle text-primary">
                                                            5 days ago.
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- <li class="list-group-item">
                                                <h5 class="m-0 text-primary py-2">Yesterday</h5>
                                            </li> -->
                                            <li class="list-group-item">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="assets/images/user1.png" alt="Admin Dashboard Templates" class="img-3xx rounded-circle" />
                                                    <div class="flex-1 flex flex-col">
                                                        <h6 class="fw-semibold mb-2">Angelica Ramos</h6>
                                                        <p class="mb-1">
                                                            Appriciated the project. "Great work. Keep on developing great themes."
                                                        </p>
                                                        <span class="badge bg-danger-subtle text-danger">
                                                            2 days ago.
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="assets/images/user2.png" alt="Admin Dashboard Templates" class="img-3xx rounded-circle" />
                                                    <div class="flex-1 flex flex-col">
                                                        <h6 class="fw-semibold mb-2">Brenden Wagner</h6>
                                                        <p class="mb-1">
                                                            Appriciated the project. "For dedication and hard work."
                                                        </p>
                                                        <span class="badge bg-danger-subtle text-danger">
                                                            2 days ago.
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="assets/images/user3.png" alt="Admin Dashboard Templates" class="img-3xx rounded-circle" />
                                                    <div class="flex-1 flex flex-col">
                                                        <h6 class="fw-semibold mb-2">Cedric Kelly</h6>
                                                        <p class="mb-1">
                                                            Appriciated the project. "Great admin theme."
                                                        </p>
                                                        <span class="badge bg-danger-subtle text-danger">
                                                            3 days ago.
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="assets/images/user.png" alt="Admin Dashboard Templates" class="img-3xx rounded-circle" />
                                                    <div class="flex-1 flex flex-col">
                                                        <h6 class="fw-semibold mb-2">Paul Byrd</h6>
                                                        <p class="mb-1">
                                                            Appriciated the project. "For creativity and outstanding work."
                                                        </p>
                                                        <span class="badge bg-danger-subtle text-danger">
                                                            4 days ago.
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="assets/images/user4.png" alt="Admin Dashboard Templates" class="img-3xx rounded-circle" />
                                                    <div class="flex-1 flex flex-col">
                                                        <h6 class="fw-semibold mb-2">Lorie Maxwell</h6>
                                                        <p class="mb-1">
                                                            Appriciated the project. "For quality work and effort."
                                                        </p>
                                                        <span class="badge bg-danger-subtle text-danger">
                                                            5 days ago.
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <!-- Notifications Container End -->
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