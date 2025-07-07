<?php
/**
 * Cart.class.php
 * ---------------------------------------------------
 * All cart CRUD in one secure, testable class.
 */
class Cart
{
    /** @var mysqli */
    private static mysqli $db;

    /** set up mysqli once per request */
    private static function init(): void
    {
        if (!isset(self::$db)) {
            self::$db = Database::getConnect();      // <- your helper
            self::$db->set_charset('utf8mb4');
        }
    }

    /** login guard */
    private static function currentUser(): string|false
    {
        Session::start();
        return Session::get('accountUser');
    }

    /* ---------- Public cart API ---------- */

    /** Add OR increment an item */
    public static function add(int $productId, int $qty = 1): array
    {
        if (!$user = self::currentUser()) {
            return ['ok' => false, 'msg' => 'Please login to add items.'];
        }
        if ($qty < 1) $qty = 1;                       // no negatives

        self::init();

        // Unique (user, product_id) index is required for this trick!
        $sql = "
          INSERT INTO cart (user, product_id, quantity, created_at)
          VALUES (?, ?, ?, NOW())
          ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)
        ";
        $stmt = self::$db->prepare($sql);
        $stmt->bind_param('sii', $user, $productId, $qty);

        return $stmt->execute()
             ? ['ok' => true,  'msg' => 'Added to cart.']
             : ['ok' => false, 'msg' => 'DB error: '.$stmt->error];
    }

    /** Set ABSOLUTE quantity */
    public static function update(int $productId, int $qty): array
    {
        if (!$user = self::currentUser()) {
            return ['ok' => false, 'msg' => 'Please login to update cart.'];
        }
        if ($qty < 1) {                               // treat 0/neg as delete
            return self::remove($productId);
        }

        self::init();
        $sql = "UPDATE cart SET quantity = ? WHERE user = ? AND product_id = ?";
        $stmt = self::$db->prepare($sql);
        $stmt->bind_param('isi', $qty, $user, $productId);

        return $stmt->execute()
             ? ['ok' => true,  'msg' => 'Quantity updated.']
             : ['ok' => false, 'msg' => 'DB error: '.$stmt->error];
    }

    /** Remove item */
    public static function remove(int $productId): array
    {
        if (!$user = self::currentUser()) {
            return ['ok' => false, 'msg' => 'Please login to remove items.'];
        }

        self::init();
        $sql = "DELETE FROM cart WHERE user = ? AND product_id = ?";
        $stmt = self::$db->prepare($sql);
        $stmt->bind_param('si', $user, $productId);

        return $stmt->execute()
             ? ['ok' => true,  'msg' => 'Item removed.']
             : ['ok' => false, 'msg' => 'DB error: '.$stmt->error];
    }

    /** Return cart rows + product data */
    public static function items(): array
    {
        if (!$user = self::currentUser()) {
            return ['ok' => false, 'msg' => 'Please login'];
        }

        self::init();
        $sql = "
          SELECT  c.product_id AS id,
                  c.quantity,
                  p.title,
                  p.price,
                  p.img
          FROM    cart c
          JOIN    products p ON p.id = c.product_id
          WHERE   c.user = ?
        ";
        $stmt = self::$db->prepare($sql);
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        // massage data
        $items = [];
        foreach ($rows as $r) {
            $items[] = [
                'id'       => (int)$r['id'],
                'title'    => $r['title'],
                'price'    => (float)$r['price'],
                'image'    => 'assets/'.$r['img'],
                'quantity' => (int)$r['quantity']
            ];
        }
        return ['ok' => true, 'items' => $items];
    }
}