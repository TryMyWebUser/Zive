<?php

include "libs/load.php";

// Start a session
Session::start();

if (Session::get('accountUser')) {
    header("Location: index.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit']) &&isset($_POST['location']) && isset($_POST['name']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['phone'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
		$location = $_POST['location'];

        // Call the register method
        $error = User::register($name, $password, $email, $phone, $location);
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
                                    <li>Login</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
			<!-- ======================= Top Breadcrubms ======================== -->

			<!-- ======================= Login Detail ======================== -->
			<section class="middle">
				<div class="container">
					<div class="row align-items-start justify-content-center">
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mfliud">
							<p style="color: <?= $error ? 'red' : 'green'; ?>;"><?= $error ?></p>
							<form class="border p-3 rounded" method="POST">
								<div class="row g-3 mb-3">
									<div class="form-group col-md-6">
										<label class="mb-2">Full Name *</label>
										<input type="text" name="name" class="form-control" placeholder="Full Name" required/>
									</div>
									<div class="form-group col-md-6">
										<label class="mb-2">Phone Number</label>
										<input type="number" name="phone" class="form-control" placeholder="Phone Number" required/>
									</div>
								</div>

								<div class="form-group mb-3">
									<label class="mb-2">Email *</label>
									<input type="email" name="email" class="form-control" placeholder="Email Address" required/>
								</div>

								<div class="form-group mb-3">
									<label class="mb-2">Password *</label>
									<input type="password" name="password" class="form-control" placeholder="Password" required/>
								</div>

								<div class="form-group mb-3">
									<label class="mb-2">Address *</label>
									<input type="text" name="location" class="form-control" placeholder="Enter Your Full Address" required/>
								</div>

								<div class="form-group mb-3">
									<p>By registering your details, you agree with our Terms & Conditions, and Privacy and Cookie Policy.</p>

								</div>

								<div class="form-group">
									<button type="submit" name="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Create An Account</button>
								</div>

								<div class="form-group text-center mb-0 mt-3">
									<p class="extra">or <a href="login.php" class="text-dark"> Login</a></p>
								</div>
							</form>
						</div>
					</div>
				</div>
			</section>
			<!-- ======================= Login End ======================== -->
			 
            <?php include "temp/footer.php" ?>

    </body>
</html>