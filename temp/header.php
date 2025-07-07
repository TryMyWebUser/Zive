<?php

include "libs/load.php";

$userAccount = Operations::getUser();
$category = Operations::getCategoryChecker();

// Check if the user is logged in
$isLoggedIn = Session::get('accountUser');

?>

<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== -->
<!-- Top Header -->
<div class="py-2 bg-dark">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-between">
            <style>
                @media (max-width: 992px) {
                    .medium.text-light.mail {
                        display: none;
                    }
                }
            </style>
            <div class="col hide-ipad d-flex align-items-center">
                <div class="top_first"><a href="mailto:zivewearthecomfort@gmail.com" class="medium text-light mail"><i class="fa fa-envelope"></i> Zivewearthecomfort@gmail.com</a></div>
                <div class="top_first ms-3"><a href="tel:9952467399" class="medium text-light"><i class="fa fa-phone"></i> +91 9952 467 399</a></div>
            </div>
            
            <!-- Right Menu col-xl-6 col-lg-6 col-md-6 col-sm-12 -->
            <div class="col">
                <ul class="d-flex align-items-center justify-content-end m-0 p-0">
                    <li style="margin-right: 20px;">
                        <a href="#" class="text-white"><i class="fab fa-facebook"></i></a>
                    </li>
                    <li style="margin-right: 20px;">
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                    </li>
                    <li style="margin-right: 20px;">
                        <a href="https://wa.me/9952467399" class="text-white"><i class="fab fa-whatsapp" style="font-size: medium;"></i></a>
                    </li>
                    <li style="margin-right: 20px;">
                        <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                    </li>
                </ul>
            </div>
            
        </div>
    </div>
</div>
<!-- Start Navigation -->
<div class="header header-light dark-text">
    <div class="container">
        <nav id="navigation" class="navigation navigation-landscape">
            <div class="nav-header">
                <a class="nav-brand" href="#">
                    <img src="assets/img/logo.png" width="40" class="logo" alt="" />
                </a>
                <div class="nav-toggle"></div>
                <div class="mobile_nav">
                    <ul>
                        <li>
                            <!--<a href="#" onclick="openCart()"> <i class="lni lni-shopping-basket"></i><span class="dn-counter">0</span> </a>-->
                            <!--<a href="tel:9952467399" class="btn btn-dark rounded" style="padding-right: 25px;">Get a Quate</a>-->
                        </li>
                    </ul>
                </div>
            </div>
            <div class="nav-menus-wrapper" style="transition-property: none;">
                <ul class="nav-menu">
                    <li>
                        <a href="index.php">Home</a>
                    </li>

                    <li>
                        <a href="about.php">About Us</a>
                    </li>

                    <li>
                        <a href="javascript:void(0);">Product</a>
                        <ul class="nav-dropdown nav-submenu">
                            <?php foreach ($category as $cate) { ?>
                                <li><a href="product.php?data=<?= $cate['category'] ?>"><?= $cate['category'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>

                    <li><a href="services.php">Services</a></li>

                    <li><a href="testimonial.php">Testimonial</a></li>
                    
                    <!-- <li><a href="pay.php">Pay Now</a></li> -->
                    
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>

            </div>
            <ul class="nav-menu nav-menu-social align-to-right">
                <li>
                    <a href="<?= $isLoggedIn ? 'profile.php' : 'login.php'; ?>">
                        <i class="lni lni-user"></i>
                    </a>
                </li>
                <li> 
                    <?php if ($isLoggedIn) { ?>
                        <a href="#" onclick="openCart()">
                            <i class="lni lni-shopping-basket"></i><span class="dn-counter"><?= Operations::getUserCartCount() ?></span>
                        </a>
                    <?php } ?>
                    <!-- <div class="mt-2">
                        <a href="tel:9952467399" class="btn btn-dark rounded" style="padding-right: 25px;">Get a Quate</a>
                    </div> -->
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- End Navigation -->
<div class="clearfix"></div>
<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== -->