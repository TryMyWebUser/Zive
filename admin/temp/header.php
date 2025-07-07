<div class="app-header d-flex align-items-center">
    <!-- Toggle buttons starts -->
    <div class="d-flex">
        <button type="button" class="toggle-sidebar">
            <i class="bi bi-list lh-1"></i>
        </button>
        <button type="button" class="pin-sidebar">
            <i class="bi bi-list lh-1"></i>
        </button>
    </div>
    <!-- Toggle buttons ends -->

    <!-- App brand sm starts -->
    <div class="app-brand-sm d-lg-none d-flex">
        <!-- Logo sm starts -->
        <a href="index.php">
            <img src="../assets/img/favicon.png" class="logo" alt="Bootstrap Gallery" />
        </a>
        <!-- Logo sm end -->
    </div>
    <!-- App brand sm ends -->

    <!-- Page title starts -->
    <h5 class="m-0 ms-2 fw-semibold">Admin Dashboard</h5>
    <!-- Page title ends -->

    <!-- App header actions starts -->
    <div class="header-actions">
        <!-- Header action bar starts -->
        <div class="bg-white p-2 rounded-4 d-flex align-items-center">
            <!-- Header actions start -->
            <div class="d-sm-flex d-none">
                <div class="dropdown">
                    <a class="dropdown-toggle d-flex p-3 position-relative" href="notifications.php">
                        <i class="bi bi-bell fs-4 lh-1"></i>
                        <span class="count-label bg-danger">9</span>
                    </a>
                </div>
            </div>
            <!-- Header actions end -->

            <!-- User settings start -->
            <div class="dropdown ms-2">
                <a id="userSettings" class="dropdown-toggle user-settings" href="#!" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="me-2 text-truncate d-lg-block d-none">Admin, Zive</span>
                    <div class="icon-box md rounded-4 fw-bold bg-primary-subtle text-primary">
                        <i class="bi bi-person-circle"></i>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end shadow-lg">
                    <div class="mx-3 my-2 d-grid">
                        <a href="logout.php" class="btn btn-warning">Logout</a>
                    </div>
                </div>
            </div>
            <!-- User settings end -->
        </div>
        <!-- Header action bar ends -->
    </div>
    <!-- App header actions ends -->
</div>