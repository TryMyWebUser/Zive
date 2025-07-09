<?php
include "libs/load.php";
Session::start();

if (!Session::get('accountUser')) {
    header("Location: login.php");
    exit;
}

$user = Operations::getUser();
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['avatar']) && isset($_POST['submit_profile'])) {
        $error = User::setAvatar($_FILES['avatar'], $_FILES['avatar']['size']);
    }

    if (isset($_POST['submit_info'])) {
        $user = $_POST['username'] ?? "";
        $email = $_POST['email'] ?? "";
        $phone = $_POST['phone'] ?? "";
        $locat = $_POST['location'] ?? "";
        $error = User::setUser($user, $email, $phone, $locat);
    }

    if (isset($_POST['submit_password'])) {
        $error = User::setNewPass($_POST['old'], $_POST['new'], $_POST['conf']);
    }
}
?>

<!DOCTYPE html>
<html lang="zxx">
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="Themezhub" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <?php include "temp/head.php" ?>
        
        <style>
            .order-group {
                margin-bottom: 20px;
            }
            
            #paginationControls {
                /*border-top: 1px solid #eee;*/
                padding-bottom: 15px;
            }
            
            .d-none {
                display: none !important;
            }
            
            #pageNumbers {
                margin-top: 10px;
            }
            
            #pageNumbers button {
                margin: 0 3px;
                min-width: 35px;
            }
        </style>
    </head>

    <body>
        <div class="preloader"></div>

        <div id="main-wrapper">
            <?php include "temp/header.php" ?>

            <div class="gray py-3">
                <div class="container">
                    <div class="row">
                        <div class="colxl-12 col-lg-12 col-md-12">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li><a href="index.php">Home</a></li>
                                    <li> / </li>
                                    <li>Profile Page</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <section class="middle">
                <div class="container">
                    <div class="row align-items-start justify-content-between">
                        <div class="col-12 col-md-12 col-lg-4 col-xl-4 text-center miliods">
                            <div class="d-block border rounded mfliud-bot">
                                <div class="dashboard_author px-2 py-5">
                                    <div class="dash_auth_thumb circle p-1 border d-inline-flex mx-auto mb-2">
                                        <img id="avatar-preview" src="<?= $user['avatar']; ?>" class="img-fluid circle" width="100" alt="Profile Picture" style="object-fit: cover;" />
                                    </div>
                                    <div class="dash_caption">
                                        <h4 class="fs-md ft-medium mb-0 lh-1"><?= $user['username']; ?></h4>
                                        <span class="text-muted smalls"><?= $user['email'] ?></span>
                                    </div>
                                    <form method="POST" enctype="multipart/form-data" class="mt-3 d-flex align-items-start justify-content-between">
                                        <input type="file" name="avatar" id="avatar-upload" hidden onchange="previewImage(this)">
                                        <label for="avatar-upload" class="btn btn-outline-info btn-sm rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                                                <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z"/>
                                                <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                                            </svg>
                                        </label>
                                        <button type="submit" name="submit_profile" class="btn btn-sm btn-primary rounded">Save Photo</button>
                                    </form>
                                </div>

                                <div class="dashboard_author">
                                    <h4 class="px-3 py-2 mb-0 lh-2 gray fs-sm ft-medium text-muted text-uppercase text-left">Settings Navigation</h4>
                                    <ul class="dahs_navbar"  role="tablist">
                                        <li>
                                            <a href="#orders" class="active" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab" aria-controls="orders" aria-selected="false"><i class="lni lni-shopping-basket me-2"></i>My Order</a>
                                        </li>
                                        <li>
                                            <a href="#profile" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><i class="lni lni-user me-2"></i>Profile Info</a>
                                        </li>
                                        <li>
                                            <a href="#newpassword" id="new-tab" data-bs-toggle="tab" data-bs-target="#newpassword" type="button" role="tab" aria-controls="newpassword" aria-selected="false"><i class="lni lni-key me-2"></i>Change Password</a>
                                        </li>
                                        <li>
                                            <a href="logout.php"><i class="lni lni-power-switch me-2"></i>Log Out</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 col-lg-8 col-xl-8">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                    <div class="ord_list_wrap border mb-4 mfliud">
                                        <div class="ord_list_head gray d-flex align-items-center justify-content-between px-3 py-3">
                                            <div class="olh_flex">
                                                <p class="m-0 p-0"><span class="text-muted">Orders List</span></p>
                                            </div>        
                                        </div>
                                        <div class="ord_list_body text-left" id="ordersContainer">
                                            <!-- Orders will be loaded via JavaScript -->
                                        </div>
                                        <div class="text-center" id="paginationControls">
                                            <button id="viewMoreBtn" class="btn btn-primary">View More Orders</button>
                                            <div id="pageNumbers" class="mt-2 d-none"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Single Order List -->
									<div class="ord_list_wrap border mb-4">
										<div class="ord_list_head gray d-flex align-items-center justify-content-between px-3 py-3">
											<div class="olh_flex">
												<p class="m-0 p-0"><span class="text-muted">Cart List</span></p>
												<!-- <h6 class="mb-0 ft-medium">#1250004122</h6> -->
											</div>		
										</div>
										<div class="ord_list_body text-left">
                                            <?php
                                                $carts = Operations::getUserCart();
                                                if (!empty($carts)) {
                                                    foreach ($carts as $cart) { ?>
                                                        <div class="row align-items-center m-0 py-3 br-bottom px-2">
        													<div class="col-md-5 col-12 d-flex">
        														<img src="assets/<?= htmlspecialchars($cart['img']) ?>"
        															class="img-fluid rounded me-3" width="75" alt="">
        														<div>
        														    <?php if (isset($cart['category'])) { ?>
                                                                        <p class="cart-category"><?= htmlspecialchars($cart['category']) ?></p>
                                                                    <?php } ?>
        															<h6 class="mb-1"><?= htmlspecialchars($cart['title']) ?></h6>
        															<div class="small text-muted">Qty: <?= (int)$cart['quantity'] ?></div>
        														</div>
        													</div>
        
        													<div class="col-md-3 col-6">
        														<!-- single‑item total -->
        														₹<?= number_format($cart['price'], 2) ?>
        													</div>
        												</div>
                                            <?php } } else {
                                                echo '<p class="text-center pt-3">Cart Not Found!</p>';
                                            } ?>
                                        </div>
									</div>
									<!-- End Order List -->
                                </div>
                                
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row align-items-center">
										<form method="POST">
											<div class="row">
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
													<label for="username" class="form-label">Username *</label>
													<input type="text" name="username" class="form-control" value="<?= $user['username']; ?>" required>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
													<label for="email" class="form-label">Email *</label>
													<input type="email" name="email" class="form-control" value="<?= $user['email']; ?>" required>
												</div>
											</div>
											<div class="mb-3">
												<label for="phone" class="form-label">Phone *</label>
												<input type="text" name="phone" class="form-control" value="<?= $user['phone']; ?>" required>
											</div>
											<div class="mb-3">
												<label for="location" class="form-label">Full Address With Pincode *</label>
												<input type="text" name="location" class="form-control" value="<?= $user['location']; ?>" required>
											</div>
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
												<div class="form-group float-end">
													<button type="submit" name="submit_info" class="btn btn-dark">Save Changes</button>
												</div>
											</div>
										</form>
									</div>
                                </div>
                                
                                <div class="tab-pane fade" id="newpassword" role="tabpanel" aria-labelledby="new-tab">
                                    <div class="row align-items-center">
										<form method="POST">
											<div class="mb-3">
												<label for="current" class="form-label">Current Password *</label>
												<input type="password" name="old" class="form-control" placeholder="Current Password" required>
											</div>
											<div class="row">
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
													<label for="new" class="form-label">New Password *</label>
													<input type="password" name="new" class="form-control" placeholder="New Password" required>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
													<label for="confirm" class="form-label">Confirm Password *</label>
													<input type="password" name="conf" class="form-control" placeholder="Confirm Password" required>
												</div>
											</div>
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
												<div class="form-group float-end">
													<button type="submit" name="submit_password" class="btn btn-dark">Update Password</button>
												</div>
											</div>
										</form>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <?php include "temp/footer.php" ?>

            <script>
                function previewImage(input) {
                    const file = input.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            document.getElementById('avatar-preview').src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                }
            </script>
            
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const ordersContainer = document.getElementById('ordersContainer');
                    const viewMoreBtn = document.getElementById('viewMoreBtn');
                    const pageNumbersDiv = document.getElementById('pageNumbers');
                    
                    let currentPage = 1;
                    const ordersPerPage = 3; // Show 3 orders at a time
                    let allOrders = [];
                    
                    // Initialize orders
                    function initializeOrders() {
                        // Get orders from PHP
                        allOrders = <?php 
                            $orders = Operations::getUserOrders();
                            echo json_encode($orders, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
                        ?>;
                        
                        if (allOrders.length === 0) {
                            ordersContainer.innerHTML = '<p class="text-center pt-3">Orders Not Found!</p>';
                            viewMoreBtn.classList.add('d-none');
                            return;
                        }
                        
                        // Group orders by order_id
                        const groupedOrders = {};
                        allOrders.forEach(order => {
                            if (!groupedOrders[order.order_id]) {
                                groupedOrders[order.order_id] = [];
                            }
                            groupedOrders[order.order_id].push(order);
                        });
                        
                        // Convert to array of order groups
                        allOrders = Object.values(groupedOrders).reverse();
                        
                        // Initial load
                        loadOrders();
                        
                        // Show view more button if there are more orders
                        if (allOrders.length <= ordersPerPage) {
                            viewMoreBtn.classList.add('d-none');
                        }
                    }
                    
                    // 1 Load orders for the current page
                    function loadOrders() {
                        const startIndex = (currentPage - 1) * ordersPerPage;
                        const endIndex   = startIndex + ordersPerPage;
                        const ordersToShow = allOrders.slice(startIndex, endIndex);
                    
                        if (currentPage === 1) ordersContainer.innerHTML = '';
                    
                        // ⬇ Pass the running index (1‑based) to the HTML builder
                        ordersToShow.forEach((orderGroup, idx) => {
                            const displayNumber = startIndex + idx + 1;   // 1, 2, 3 …
                            const orderHTML = createOrderHTML(orderGroup, displayNumber);
                            ordersContainer.insertAdjacentHTML('beforeend', orderHTML);
                        });
                    
                        updatePaginationControls();
                    }
                    
                    // 2 Accept the extra parameter and use it
                    function createOrderHTML(orderGroup, displayNumber) {
                        const firstItem = orderGroup[0];
                        let itemsHTML = '';
                    
                        orderGroup.forEach(item => {
                            itemsHTML += `
                                <div class="row align-items-center m-0 py-3 br-bottom px-2">
                                    <div class="col-md-5 col-12 d-flex">
                                        <img src="assets/${escapeHtml(item.img)}"
                                             class="img-fluid rounded me-3" width="75" alt="">
                                        <div>
                                            <h6 class="mb-1">${escapeHtml(item.product_name)}</h6>
                                            <div class="small text-muted">Qty: ${item.quantity}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        ₹${(item.unit_price * item.quantity).toFixed(2)}
                                    </div>
                                </div>`;
                        });
                    
                        return `
                            <div class="order-group">
                                <h5 class="mb-3 px-2 pt-2">
                                    Order #${displayNumber}
                                    <small class="text-muted">
                                        (${firstItem.order_created_at ? formatDate(firstItem.order_created_at) : 'Date not available'})
                                    </small>
                                    <span class="badge bg-${getStatusColor(firstItem.order_status)} ms-2 text-capitalize">
                                        ${firstItem.order_status}
                                    </span>
                                </h5>
                                ${itemsHTML}
                                <hr class="my-3">
                            </div>`;
                    }
                    
                    // Update pagination controls
                    function updatePaginationControls() {
                        const totalPages = Math.ceil(allOrders.length / ordersPerPage);
                        
                        if (totalPages > 1) {
                            // Show page numbers after first load
                            if (currentPage > 1) {
                                viewMoreBtn.classList.add('d-none');
                                pageNumbersDiv.classList.remove('d-none');
                                
                                let pageNumbersHTML = '';
                                for (let i = 1; i <= totalPages; i++) {
                                    pageNumbersHTML += `
                                        <button class="btn btn-sm ${i === currentPage ? 'btn-primary' : 'btn-outline-primary'} mx-1" 
                                                onclick="goToPage(${i})">
                                            ${i}
                                        </button>
                                    `;
                                }
                                pageNumbersDiv.innerHTML = pageNumbersHTML;
                            }
                        } else {
                            viewMoreBtn.classList.add('d-none');
                        }
                        
                        // Hide view more button if we've reached the end
                        if (currentPage >= totalPages) {
                            viewMoreBtn.classList.add('d-none');
                        }
                    }
                    
                    // Helper functions
                    function escapeHtml(unsafe) {
                        return unsafe
                            .replace(/&/g, "&amp;")
                            .replace(/</g, "&lt;")
                            .replace(/>/g, "&gt;")
                            .replace(/"/g, "&quot;")
                            .replace(/'/g, "&#039;");
                    }
                    
                    function formatDate(dateString) {
                        const date = new Date(dateString);
                        return date.toLocaleDateString('en-US', { 
                            day: 'numeric', 
                            month: 'short', 
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    }
                    
                    function getStatusColor(status) {
                        return status === 'paid' ? 'success' : 
                               status === 'pending' ? 'warning' : 'danger';
                    }
                    
                    // Event handlers
                    viewMoreBtn.addEventListener('click', function() {
                        currentPage++;
                        loadOrders();
                    });
                    
                    // Global function for page navigation
                    window.goToPage = function(page) {
                        currentPage = page;
                        ordersContainer.innerHTML = '';
                        loadOrders();
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    };
                    
                    // Initialize
                    initializeOrders();
                });
            </script>
        </div>
    </body>
</html>