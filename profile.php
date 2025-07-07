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
        $error = User::setUser($_POST['username'], $_POST['email'], $_POST['phone'], $_POST['location']);
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

    </head>

    <body>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader"></div>

        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
            <?php include "temp/header.php" ?>

            <!-- ======================= Top Breadcrubms ======================== -->
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
            <!-- ======================= Top Breadcrubms ======================== -->

            <!-- ======================= Dashboard Detail ======================== -->
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
											<a href="#profile" class="active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><i class="lni lni-user me-2"></i>Profile Info</a>
										</li>
										<li>
											<a href="#orders" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab" aria-controls="orders" aria-selected="false"><i class="lni lni-shopping-basket me-2"></i>My Order</a>
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
								<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
													<button type="button" name="submit_info" class="btn btn-dark">Save Changes</button>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
									<!-- Single Order List -->
									<div class="ord_list_wrap border mb-4 mfliud">
										<div class="ord_list_body text-left">
										<?php
											$items = Operations::getUserOrders();

											if (empty($items)) {
												echo '<p>Orders Not Found!</p>';
												return;
											}

											/* Group by order_id so we can print an “Order #” header once */
											$currentOrder = null;

											foreach ($items as $it) {

												if ($currentOrder !== $it['order_id']) {          // new order block
													if ($currentOrder !== null) {
														echo '<hr class="my-3">';                 // line between orders
													}
													$currentOrder = $it['order_id'];
													?>
													<h5 class="mb-3 px-2 pt-2">Order #<?= $currentOrder ?>
														<small class="text-muted">(<?= date('d M Y H:i', strtotime($it['created_at'])) ?>)</small>
														<span class="badge bg-<?=
															$it['status']==='paid'     ? 'success' :
															($it['status']==='pending' ? 'warning' : 'danger')
														?> ms-2 text-capitalize"><?= $it['status'] ?></span>
													</h5>
												<?php } ?>

												<!-- one product line -->
												<div class="row align-items-center m-0 py-3 br-bottom px-2">
													<div class="col-md-5 col-12 d-flex">
														<img src="assets/<?= htmlspecialchars($it['img']) ?>"
															class="img-fluid rounded me-3" width="75" alt="">
														<div>
															<h6 class="mb-1"><?= htmlspecialchars($it['product_name']) ?></h6>
															<div class="small text-muted">Qty: <?= (int)$it['quantity'] ?></div>
														</div>
													</div>

													<div class="col-md-3 col-6">
														<!-- single‑item total -->
														₹<?= number_format($it['unit_price'] * $it['quantity'], 2) ?>
													</div>
												</div>
											<?php } ?>
										</div>
										<!-- <div class="ord_list_footer d-flex align-items-center justify-content-between br-top px-3 text-start">
											<div class="col-xl-3 col-lg-3 col-md-4 olf_flex text-left px-0 py-2 br-right"><a href="javascript:void(0);" class="ft-medium fs-sm"><i class="ti-close me-2"></i>Cancel Order</a></div>
											<div class="col-xl-9 col-lg-9 col-md-8 pe-0 ps-2 py-2 olf_flex d-flex align-items-center justify-content-between">
												<div class="olf_flex_inner hide_mob"><p class="m-0 p-0"><span class="text-muted medium">Paid using debit card ending with 6472</span></p></div>
												<div class="olf_inner_right"><h5 class="mb-0 fs-sm ft-bold">Total: $4510</h5></div>
											</div>
										</div> -->
									</div>
									<!-- End Order List -->
									
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
											<div class="row align-items-center justify-content-center m-0 py-4">
												<div class="col-xl-5 col-lg-5 col-md-5 col-12">
													<div class="cart_single d-flex align-items-start">
														<div class="cart_selected_single_thumb">
															<a href="#">
																<img src="assets/<?= htmlspecialchars($cart['img']) ?>"
																	class="img-fluid rounded" width="75" alt="">
															</a>
														</div>

														<div class="cart_single_caption text-start ps-3">
															<!-- example extra field; omit if you don’t have it -->
															<?php if (isset($cart['category'])) { ?>
																<p class="mb-0"><span class="text-muted small">
																	<?= htmlspecialchars($cart['category']) ?>
																</span></p>
															<?php } ?>

															<h4 class="product_title fs-sm ft-medium mb-1 lh-1">
																<?= htmlspecialchars($cart['title']) ?>
															</h4>

															<p class="mb-2">
																<span class="text-dark medium">Qty: <?= (int)$cart['quantity'] ?></span>
															</p>

															<h4 class="fs-sm ft-bold mb-0 lh-1">
																₹<?= number_format($cart['price'], 2) ?>
															</h4>
														</div>
													</div>
												</div>

												<!-- add any extra columns (status, dates…) as you wish -->
											</div>
											<?php } } else { echo '<p>Cart Not Found!</p>'; } ?>
										</div>
										<!-- <div class="ord_list_footer d-flex align-items-center justify-content-between br-top px-3">
											<div class="col-xl-12 col-lg-12 col-md-12 ps-0 py-2 olf_flex d-flex align-items-center justify-content-between">
												<div class="olf_flex_inner"><p class="m-0 p-0"><span class="text-muted medium text-left">Paid using debit card ending with 6472</span></p></div>
												<div class="olf_inner_right"><h5 class="mb-0 fs-sm ft-bold">Total: $4510</h5></div>
											</div>
										</div> -->
									</div>
									<!-- End Order List -->
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
													<button type="button" name="submit_password" class="btn btn-dark">Update Password</button>
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
            <!-- ======================= Dashboard Detail End ======================== -->

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
    </body>
</html>