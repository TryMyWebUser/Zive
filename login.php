<?php

include "libs/load.php";

// Start a session
Session::start();

if (Session::get('accountUser')) {
    header("Location: index.php");
    exit;
}

$error = "";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if both username and password keys exist in $_POST
    if (isset($_POST['user']) && isset($_POST['password'])) {

        $username = $_POST['user'] ?? "";
        $password = $_POST['password'] ?? "";

		// Call User::login
		$error = User::loginUser($username, $password);
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
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <p style="color: <?= $error ? 'red' : 'green'; ?>;"><?= $error ?></p>
							<form class="border p-3 rounded" method="POST">
								<div class="form-group mb-3">
									<label class="mb-2">User Name *</label>
									<input type="text" name="user" class="form-control" placeholder="Username or Email" required/>
								</div>

								<div class="form-group mb-3">
									<label class="mb-2">Password *</label>
									<input type="password" name="password" class="form-control" placeholder="Password*" required/>
								</div>

								<div class="form-group">
									<button type="submit" name="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Login</button>
								</div>
								<div class="form-group text-center mb-0 mt-3">
									<p class="extra">or <a href="register.php" class="text-dark"> Register</a></p>
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