<?php

include "../libs/load.php";

// Secure delete operation
if (isset($_GET['delete_id'])) {
    $conn = Database::getConnect();
    
    $delete_id = intval($_GET['delete_id']); // Convert to integer to prevent SQL injection
    $sql = "DELETE FROM `cart` WHERE `id` = '$delete_id'";
    $result = $conn->query($sql);
    if ($result) {
        header("Location: carts.php");
    } else {
        header("Location: carts.php?error=Failed to delete");
    }
} 

?>