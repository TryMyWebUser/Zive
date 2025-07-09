<nav id="sidebar" class="sidebar-wrapper">
    <!-- App brand starts -->
    <div class="app-brand p-3 my-2">
        <a href="index.php" class="d-flex align-items-end">
            <img src="../assets/img/favicon.png" width="40" class="logo" alt="Admin Dashboards" />
            <h4 class="m-0">Zive</h4>
        </a>
    </div>
    <!-- App brand ends -->

    <!-- Sidebar menu starts -->
    <div class="sidebarMenuScroll">
        <ul class="sidebar-menu">
            <li class="active current-page">
                <a href="index.php">
                    <i class="bi bi-bar-chart-line"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#!">
                    <i class="bi bi-box"></i>
                    <span class="menu-text">Category</span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="addCate.php">Add Category</a>
                    </li>
                    <li>
                        <a href="viewCate.php">View Category</a>
                    </li>
                </ul>
            </li>   
            <li class="treeview">
                <a href="#!">
                    <i class="bi bi-ui-checks-grid"></i>
                    <span class="menu-text">Products</span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="addProduct.php">Add Product</a>
                    </li>
                    <li>
                        <a href="viewProduct.php">View Products</a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#!">
                    <i class="bi bi-star-half"></i>
                    <span class="menu-text">Testimonial</span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="addTest.php">Add Testimonial</a>
                    </li>
                    <li>
                        <a href="viewTest.php">View Testimonial</a>
                    </li>
                </ul>
            </li>
            <!--<li>-->
            <!--    <a href="notifications.php">-->
            <!--      <i class="bi bi-bell"></i>-->
            <!--      <span class="menu-text">Notifications</span>-->
            <!--    </a>-->
            <!-- </li>-->
        </ul>
    </div>
    <!-- Sidebar menu ends -->
</nav>