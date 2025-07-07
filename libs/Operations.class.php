<?php

class Operations
{
    public $conn;

    public static function getCategory()
    {
        $conn = Database::getConnect();
        $sql = "SELECT * FROM `category` ORDER BY `created_at` ASC";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }
    public static function getCategoryChecker()
    {
        $conn = Database::getConnect();
        $sql = "SELECT * FROM `category` ORDER BY `created_at` ASC";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }

    public static function getProducts()
    {
        $conn = Database::getConnect();
        $sql = "SELECT * FROM `products` ORDER BY `created_at` ASC";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }
    public static function getProductChecker()
    {
        $conn = Database::getConnect();
        $sql = "SELECT * FROM `products` ORDER BY `created_at` ASC";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }
    public static function getProductWhere()
    {
        $conn = Database::getConnect();
        $cate = $_GET['data'];
        $sql = "SELECT * FROM `products` WHERE `category` = '$cate'";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }
    public static function getRV()
    {
        $conn = Database::getConnect();
        $sql = "SELECT * FROM `reviews` ORDER BY `created_at` ASC";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }
    public static function getRating()
    {
        $conn = Database::getConnect();
        $sql = "SELECT * FROM `reviews` ORDER BY `created_at` ASC";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }
    public static function getRatings()
    {
        $getID = $_GET['edit_id'];
        $conn = Database::getConnect();
        $sql = "SELECT * FROM `reviews` WHERE `id` = '$getID'";
        $result = $conn->query($sql);
        return $result ? $result->fetch_assoc() : null;
    }
   
    public static function getProduct()
    {
        $getID = $_GET['edit_id'];
        $conn = Database::getConnect();
        $sql = "SELECT * FROM `products` WHERE `id` = '$getID'";
        $result = $conn->query($sql);
        return $result ? $result->fetch_assoc() : null;
    }

    public static function getUsersCount()
    {
        $conn = Database::getConnect();
        $sql = "SELECT COUNT(*) as total FROM `users`";
        $result = $conn->query($sql);

        if ($result && $row = $result->fetch_assoc()) {
            return (int)$row['total'];
        }

        return 0;
    }

    public static function getCartCount()
    {
        $conn = Database::getConnect();
        $sql = "SELECT COUNT(*) as total FROM `cart`";
        $result = $conn->query($sql);

        if ($result && $row = $result->fetch_assoc()) {
            return (int)$row['total'];
        }

        return 0;
    }

    public static function getOrdersCount()
    {
        $conn = Database::getConnect();
        $sql = "SELECT COUNT(*) as total FROM `orders`";
        $result = $conn->query($sql);

        if ($result && $row = $result->fetch_assoc()) {
            return (int)$row['total'];
        }

        return 0;
    }

    public static function getPriceCount()
    {
        $conn = Database::getConnect();
        $sql = "SELECT SUM(`amount_paise`) as total FROM `orders`";
        $result = $conn->query($sql);

        if ($result && $row = $result->fetch_assoc()) {
            return (float)$row['total']; // Use float to allow decimal values
        }

        return 0;
    }

    public static function getUser()
    {
        $conn = Database::getConnect();
        $user = Session::get('accountUser');
        $sql = "SELECT * FROM `users` WHERE `email` = '$user' OR `username` = '$user' OR `phone` = '$user'"; // Fetch only the most recent user
        $result = $conn->query($sql);

        // Check if the query returned any result
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc(); // Get the first row as an associative array
            return $user;
        }

        return null; // Return null if no user is found
    }

    // public static function getUserAccount()
    // {
        // $conn = Database::getConnect();
    //     $loguser = Session::get('accountUser');
    //     $sql = "SELECT * FROM `users` WHERE `user` = '$loguser'";
    //     $result = $conn->query($sql);
    //     return $result->fetch_assoc();
    // }

    public static function getuserProfile()
    {
        $conn = Database::getConnect();
        $username = $_GET['username'];
        // $db = Database::getConnect();
        $sql = "SELECT * FROM `users` WHERE `owner`='$username'";
        $result = $conn->query($sql);
        return $result->fetch_assoc();
    }

    public static function getUserCartCount()
    {
        $conn = Database::getConnect();
        $sql = "SELECT COUNT(*) as total FROM `cart` WHERE `user` = '" . Session::get('accountUser') . "'";
        $result = $conn->query($sql);

        if ($result && $row = $result->fetch_assoc()) {
            return (int)$row['total'];
        }

        return 0;
    }

    public static function getUserCart(): array
    {
        $conn = Database::getConnect();
        $user = Operations::getUser();
        $uname = $user['username'];      // we’ll use the username string here

        /*  cart:     id | user_id(varchar) | product_id | quantity
        *  products: id | name | price | img | …         */
        $sql = "SELECT p.*, c.quantity
            FROM cart   AS c
            JOIN products AS p ON p.id = c.product_id
            WHERE c.user = ?
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $uname); // 's' because user_id is stored as the username (varchar)
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);   // always returns an array (empty if no rows)
    }

    public static function getUserOrders(): array
    {
        $conn = Database::getConnect();

        // 1. Ensure user is logged‑in
        $user = Operations::getUser();        // or Session::getUser()
        if (!$user || !isset($user['id'])) {
            return [];                        // not logged in
        }
        $uid = (int)$user['id'];

        /*  We pull ONE ROW PER *order‑item*
        *  ┌───────────── order_items (oi) ────────────┐
        *  │ order_items.order_id                      │
        *  │ order_items.product_id, order_items.qty   │
        *  └───────────────────────────────────────────┘
        *  join → orders (o)  → to filter by user_id & get status/created_at
        *  join → products (p)→ to fetch title, img, price                   */

        $sql = "SELECT
                /* ---------- orders (o) ---------- */
                o.id                 AS order_id,
                o.user_id,
                o.amount_paise,
                o.gateway,
                o.gateway_order_id,
                o.payment_id,
                o.status             AS order_status,
                o.paid_at,
                o.created_at         AS order_created_at,

                /* ---------- users (u) ---------- */
                u.id                 AS customer_id,
                u.username               AS customer_name,
                u.email              AS customer_email,
                u.phone              AS customer_phone,
                u.location               AS customer_location,

                /* ---------- products (p) ---------- */
                p.id                 AS product_id,
                p.img,
                p.title              AS product_name,
                p.price              AS unit_price,                 -- VARCHAR in DB
                `p`.`sub-price`      AS sub_price,                  -- back‑tick because of hyphen
                p.discount,
                p.category,
                p.status             AS product_status,
                p.latest             AS product_latest,
                p.created_at         AS product_created_at,

                /* ---------- order_items (oi) ---------- */
                oi.quantity

            FROM order_items  oi
            JOIN orders       o  ON o.id      = oi.order_id
            JOIN products     p  ON p.id      = oi.product_id
            JOIN users        u  ON u.id      = o.user_id          /* NEW join */
            WHERE o.user_id = ?
            ORDER BY o.id DESC, oi.id
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $uid);         // integer
        $stmt->execute();
        $res = $stmt->get_result();

        return $res->fetch_all(MYSQLI_ASSOC); // always an array (even if empty)
    }

}

?>