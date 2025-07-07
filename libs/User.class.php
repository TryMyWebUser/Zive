<?php

class User
{
    public static function register($name, $password, $email, $phone, $location)
    {
        $options = [
            'cost' => 9,
        ];
        $pass = password_hash($password, PASSWORD_BCRYPT, $options);
        $conn = Database::getConnect();

        $avatar = "uploads/avatars/user.png";
        $sql = "INSERT INTO `users`(`username`, `email`, `phone`, `password`, `avatar`, `location`, `uploaded_time`)
        VALUES ('$name', '$email', '$phone', '$pass', '$avatar', '$location', NOW())";
        try {
            if ($conn->query($sql)) {
                Session::regenerate();
                Session::set('accountUser', $name);
                header("Location: index.php");
                exit;
                // return "Account Created Please Login Your Account.";
            } else {
                throw new Exception("Error creating user profile: " . $conn->error);
            }
        } catch (Exception $e) {
            echo "Error Message: " . $e->getMessage();
            echo "Connection Error: " . $sql . "<br>" . $conn->error;
            return false;
        }
    }

    public static function loginUser($username, $password)
    {
        Session::start();
        $conn = Database::getConnect();
        
        $sql = "SELECT `id`, `password` FROM `users` WHERE `username` = '$username' OR `email` = '$username'";
        $res = $conn->query($sql);
        if ($res->num_rows === 1)
        {
            $row = $res->fetch_assoc();
            if (password_verify($password, $row['password']))
            {
                Session::regenerate();
                Session::set('accountUser', $username);
                header("Location: index.php");
                exit;
            }
        }

        return "Invalid Username and Password";
    }

    public static function login($username, $password)
    {
        Session::start();
        $conn = Database::getConnect();
        
        $sql = "SELECT `id`, `password` FROM `auth` WHERE `username` = '$username' OR `email` = '$username'";
        $res = $conn->query($sql);
        if ($res->num_rows === 1)
        {
            $row = $res->fetch_assoc();
            if ($password === $row['password'])
            {
                Session::regenerate();
                Session::set('login_user', $username);
                header("Location: welcome.php");
                exit;
            }
        }

        return "Invalid Username and Password";
    }

    public static function setUser($user, $email, $phone, $locat)
    {
        $conn = Database::getConnect();
        $currentUser = Operations::getUser();
        $uid = $currentUser['id']; // Retrieve the user ID from the current session
        
        // Update the users table with new profile data
        $query = "UPDATE `users` SET `username` = '$user', `email` = '$email', `phone` = '$phone', `location` = '$locat' WHERE `id` = '$uid'";
            
        try {
            if ($conn->query($query)) {
                Session::regenerate();
                Session::set('accountUser', $user);
                header("Location: profile.php");
                return "Updated successfully!";
            } else {
                return "Error updating user profile in 'users' table: " . $conn->error;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public static function setNewPass($old, $new, $conf)
    {
        if ($new === $conf) {
            $db = Database::getConnect();
            $currentUser = Operations::getUser();
            $id = $currentUser['id']; // Retrieve the user ID from the current session
            $query = "SELECT `password` FROM `users` WHERE `id` = '$id'";
            $result = $db->query($query);
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if (password_verify($old, $row['password'])) {
                    $options = [
                        'cost' => 9,
                    ];
                    $password = password_hash($new, PASSWORD_BCRYPT, $options);
                    $update_profile = "UPDATE `users` SET `password` = '$password' WHERE `id` = '$id'";
                    try {
                        if ($db->query($update_profile)) {
                            echo "<script>alert('Password has been changed.');</script>";
                            header("Location: profile.php");
                            return true;
                        } else {
                            throw new Exception('Password Update Error: ' . mysqli_error($db));
                            return false;
                        }
                    } catch (Exception $e) {
                        echo "<script>alert('Password Error: {$e->getMessage()}');</script>";
                        return false;
                    }
                } else {
                    return 'Verify Password Error.';
                }
            } else {
                return false;
            }
        } else {
            echo "<script>alert('Confirmation does not match the password.');</script>";
            return 'Confirmation does not match the password.';
        }
    }

    public static function setAvatar($avatar, $fileSize)
    {
        $conn = Database::getConnect();
        $currentUser = Operations::getUser();
        $id = $currentUser['id'];

        $targetDir = "uploads/avatars/";

        // Create the directory if it doesn't exist
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); // Create directory with proper permissions
        }

        // Check if a file is uploaded
        if (!empty($_FILES["avatar"]["name"])) {
            $fileName = basename($_FILES["avatar"]["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            // Check file size (4MB max)
            if ($fileSize > 8 * 1024 * 1024) {
                $error = "File size should be below 8 MB.";
            } else {
                // Allowable file types
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

                if (in_array($fileType, $allowTypes)) {
                    // Generate a unique file name to avoid overwriting existing files
                    $newFileName = uniqid('avatar_', true) . '.' . $fileType;
                    $targetFilePath = $targetDir . $newFileName;
                    // Move the uploaded file to the target directory
                    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFilePath)) {
                        // Update the user's avatar in the database
                        $sql = "UPDATE `users` SET `avatar` = '$targetFilePath' WHERE `id` = '$id'";

                        if ($conn->query($sql)) {
                            header("Location: profile.php");
                            return "The file has been uploaded and the avatar updated successfully.";
                        } else {
                            return "Database insertion failed: " . $conn->error;
                        }
                    } else {
                        return "Sorry, there was an error uploading your file.";
                    }
                } else {
                    return "Only JPG, JPEG, PNG, & GIF files are allowed.";
                }
            }
        } else {
            return "No file selected for upload.";
        }
    }

    public static function setCategory($img, $cate)
    {
        $conn = Database::getConnect();
        $targetDir = "../uploads/category/";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif', 'webp'];

        $requiredFiles = [
            'img' => $_FILES["img"]
        ];

        foreach ($requiredFiles as $key => $file) {
            $fileName = basename($file["name"]);
            $filePath = $targetDir . $fileName;
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            if (!in_array(strtolower($fileType), $allowImageTypes) || !move_uploaded_file($file["tmp_name"], $filePath)) {
                return "Error uploading required file: $key.";
            }

            $$key = $filePath;
        }

        $sql = "INSERT INTO `category` (`img`, `category`, `created_at`) 
                VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $filePath, $cate);

        if ($stmt->execute()) {
            header("Location: viewCate.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $stmt->error;
        }
    }

    public static function setProducts($img, $title, $price, $sub, $discount, $cate, $status, $latest)
    {
        $conn = Database::getConnect();
        $targetDir = "../uploads/products/";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif', 'webp'];

        $requiredFiles = [
            'img' => $_FILES["img"]
        ];

        foreach ($requiredFiles as $key => $file) {
            $fileName = basename($file["name"]);
            $filePath = $targetDir . $fileName;
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            if (!in_array(strtolower($fileType), $allowImageTypes) || !move_uploaded_file($file["tmp_name"], $filePath)) {
                return "Error uploading required file: $key.";
            }

            $$key = $filePath;
        }

        $sql = "INSERT INTO `products` (`img`, `title`, `price`, `sub-price`, `discount`, `category`, `status`, `latest`, `created_at`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $img, $title, $price, $sub, $discount, $cate, $status, $latest);

        if ($stmt->execute()) {
            header("Location: viewProduct.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $stmt->error;
        }
    }

    public static function updateProducts($img, $title, $price, $sub, $discount, $cate, $status, $latest, $getID)
    {
        $conn = Database::getConnect();
        $targetDir = "../uploads/products/";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $qry = $conn->query("SELECT * FROM `products` WHERE `id` = '$getID'")->fetch_array();

        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif', 'webp'];

        $imgPath = $qry['img'];

        // Update img if a new file is uploaded
        if (!empty($_FILES["img"]["name"])) {
            $fileName = basename($_FILES["img"]["name"]);
            $filePath = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if (!in_array($fileType, $allowImageTypes)) {
                return "Error: Invalid image format for img.";
            }

            if ($_FILES["img"]["size"] > 5 * 1024 * 1024) {
                return "Error: img exceeds 5MB.";
            }

            if (!move_uploaded_file($_FILES["img"]["tmp_name"], $filePath)) {
                return "Error: Failed to upload img.";
            }

            if (!empty($imgPath) && file_exists($imgPath)) {
                unlink($imgPath);
            }

            $imgPath = $filePath;
        }

        $sql = "UPDATE `products` SET `img` = ?, `title` = ?, `price` = ?, `sub-price` = ?, `discount` = ?, `category` = ?, `status` = ?, `latest` = ?, `created_at` = NOW() WHERE `id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssi", $imgPath, $title, $price, $sub, $discount, $cate, $status, $latest, $getID);

        if ($stmt->execute()) {
            header("Location: viewProduct.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $stmt->error;
        }
    }

    public static function setReviews($rating, $name, $review, $gender)
    {
        $conn = Database::getConnect();

        $sql = "INSERT INTO `reviews` (`rating`, `name`, `review`, `gender`, `created_at`) 
                VALUES (?, ?, ?, ?, NOW())";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $rating, $name, $review, $gender);

        if ($stmt->execute()) {
            header("Location: viewTest.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $stmt->error;
        }
    }

    public static function updateReviews($rating, $name, $review, $gender, $getID)
    {
        $conn = Database::getConnect();
        $sql = "UPDATE `reviews` SET `rating` = ?, `name` = ?, `review` = ?, `gender` = ?, `created_at` = NOW() WHERE `id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $rating, $name, $review, $gender, $getID);

        if ($stmt->execute()) {
            header("Location: viewTest.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $stmt->error;
        }
    }

    public static function addToCart($productID, $quantity) {
        Session::start();
        $conn = Database::getConnect();
        $user = Session::get('accountUser');

        if (!$user) {
            return ['ok' => false, 'msg' => 'Please login to add items to your cart.'];
        }

        // Check if item exists
        $check = $conn->prepare("SELECT quantity FROM cart WHERE user = ? AND product_id = ?");
        $check->bind_param("si", $user, $productID);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $sql = "UPDATE cart SET quantity = quantity + ? WHERE user = ? AND product_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isi", $quantity, $user, $productID);
        } else {
            $sql = "INSERT INTO cart (user, product_id, quantity, created_at) VALUES (?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sii", $user, $productID, $quantity);
        }

        if ($stmt->execute()) {
            return ['ok' => true, 'msg' => 'Product added/updated successfully.'];
        } else {
            return ['ok' => false, 'msg' => 'Error: ' . $stmt->error];
        }
    }

    public static function updateCart($productID, $quantity) {
        Session::start();
        $conn = Database::getConnect();
        $user = Session::get('accountUser');

        if (!$user) {
            return ['ok' => false, 'msg' => 'Please login to update your cart.'];
        }

        $sql = "UPDATE cart SET quantity = ? WHERE user = ? AND product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isi", $quantity, $user, $productID);

        if ($stmt->execute()) {
            return ['ok' => true, 'msg' => 'Cart updated.'];
        } else {
            return ['ok' => false, 'msg' => 'Error: ' . $stmt->error];
        }
    }

    public static function removeFromCart($productID) {
        Session::start();
        $conn = Database::getConnect();
        $user = Session::get('accountUser');

        if (!$user) {
            return ['ok' => false, 'msg' => 'Please login to remove items.'];
        }

        $sql = "DELETE FROM cart WHERE user = ? AND product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $user, $productID);

        if ($stmt->execute()) {
            return ['ok' => true, 'msg' => 'Item removed.'];
        } else {
            return ['ok' => false, 'msg' => 'Error: ' . $stmt->error];
        }
    }

}

?>