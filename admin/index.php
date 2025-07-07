<?php

    include "../libs/load.php";

    // Start a session
    Session::start();

    // Redirect if the user is already logged in
    if (Session::get('login_user'))
    {
        header('Location: welcome.php');
        exit;
    }

    $error = "";

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        // Check if both username and password keys exist in $_POST
        if (isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['password']))
        {
            $username = $_POST['username'] ?? "";
            $password = $_POST['password'] ?? "";
            $error = User::login($username, $password);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Admin - Login</title>

        <link rel="shortcut icon" href="../assets/images/favicon.png" />

        <!-- *************
			************ CSS Files *************
		************* -->
        <link rel="stylesheet" href="assets/fonts/bootstrap/bootstrap-icons.min.css" />
        <link rel="stylesheet" href="assets/css/main.min.css" />
    </head>

    <body class="login-bg">
        <!-- Page wrapper starts -->
        <div class="page-wrapper">
            <!-- Auth container starts -->
            <div class="auth-container">
                <div class="d-flex justify-content-center">
                    <!-- Form starts -->
                    <form method="POST">
                        <!-- Logo starts -->
                        <a href="index.php" class="auth-logo mt-5 mb-3">
                            <h4 class="text-white">Zive</h4>
                        </a>
                        <!-- Logo ends -->

                        <!-- Authbox starts -->
                        <div class="auth-box">
                            <h4 class="mb-4">Welcome back,</h4>

                            <div class="mb-3">
                                <label class="form-label" for="email">Username <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text" id="email" name="username" class="form-control" placeholder="Enter your Username" required/>
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required/>
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" name="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>
                        <!-- Authbox ends -->
                    </form>
                    <!-- Form ends -->
                </div>
            </div>
            <!-- Auth container ends -->
        </div>
        <!-- Page wrapper ends -->
    </body>
</html>