<?php

include "../libs/load.php";

// Secure delete operation
if (isset($_GET['delete_id'])) {
    $conn = Database::getConnect();
    
    $delete_id = intval($_GET['delete_id']); // Convert to integer to prevent SQL injection
    $qry = $conn->query("SELECT * FROM `users` where `id` = '$delete_id' ")->fetch_array();
    $sql = "DELETE FROM `users` WHERE `id` = '$delete_id'";
    $result = $conn->query($sql);
    if ($result) {
        if(!empty($qry['avatar'])){
            if(is_file($qry['avatar'])) {
                if ($qry['avatar'] != 'uploads/avatars/user.png') {
                    unlink($qry['avatar']);
                }
                header("Location: allUsers.php");
            }
        }
    } else {
        header("Location: allUsers.php?error=Failed to delete");
    }
} 

?>