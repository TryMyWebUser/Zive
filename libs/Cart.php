<?php
/**
 * Cart helper – session + DB hybrid.
 *
 * Requires:
 *   - Database::getConnect()  (mysqli)
 *   - Operations::getUser()   (returns user array or null)
 *
 * SQL for cart_items:
 * --------------------------------------------------------
 * CREATE TABLE cart_items (
 *   id         INT AUTO_INCREMENT PRIMARY KEY,
 *   user_id    INT          NOT NULL,
 *   product_id INT          NOT NULL,
 *   quantity   INT          NOT NULL,
 *   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 *   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
 *                        ON UPDATE CURRENT_TIMESTAMP,
 *   UNIQUE KEY uniq_user_prod (user_id, product_id),
 *   FOREIGN KEY (user_id)    REFERENCES users(id)    ON DELETE CASCADE,
 *   FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
 * );
 * --------------------------------------------------------
 */

class ReCart
{
    /** Where guest carts live */
    private const SESSION_KEY = 'cart_items';

    /** -------------------------------------------------- items */
    public static function items(): array
    {
        $uid = self::uid();
        if ($uid) {
            return self::itemsFromDb($uid);
        }
        return self::itemsFromSession();
    }

    /** -------------------------------------------------- add */
    public static function add(int $productId, int $qty = 1): array
    {
        $qty = max(1, $qty);
        $uid = self::uid();

        return $uid
            ? self::addDb($uid, $productId, $qty)
            : self::addSession($productId, $qty);
    }

    /** -------------------------------------------------- update */
    public static function update(int $productId, int $qty): array
    {
        $qty = max(1, $qty);
        $uid = self::uid();

        return $uid
            ? self::updateDb($uid, $productId, $qty)
            : self::updateSession($productId, $qty);
    }

    /** -------------------------------------------------- remove */
    public static function remove(int $productId): array
    {
        $uid = self::uid();

        return $uid
            ? self::removeDb($uid, $productId)
            : self::removeSession($productId);
    }

    /** -------------------------------------------------- clear */
    public static function clear(): void
    {
        $u = Operations::getUser();
        $uid = $u['username'];
        if ($uid) {
            $db = Database::getConnect();
            $st = $db->prepare("DELETE FROM cart WHERE user = ?");
            $st->bind_param('i', $uid);
            $st->execute();
        } else {
            unset($_SESSION[self::SESSION_KEY]);
        }
    }

    /* ==========================================================
       ========== internal helpers – database branch ============
       ========================================================== */

    private static function itemsFromDb(int $uid): array
    {
        $db = Database::getConnect();
        $sql = "
            SELECT p.id, p.name  AS title, p.price, p.image,
                   ci.quantity
            FROM cart_items ci
            JOIN products p ON p.id = ci.product_id
            WHERE ci.user_id = ?
        ";
        $st = $db->prepare($sql);
        $st->bind_param('i', $uid);
        $st->execute();
        $items = $st->get_result()->fetch_all(MYSQLI_ASSOC);

        return ['ok' => true, 'items' => $items];
    }

    private static function addDb(int $uid, int $pid, int $qty): array
    {
        $db = Database::getConnect();
        // Upsert pattern
        $sql = "
            INSERT INTO cart_items (user_id, product_id, quantity)
            VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)
        ";
        $st = $db->prepare($sql);
        $st->bind_param('iii', $uid, $pid, $qty);
        $ok = $st->execute();
        return $ok ? self::itemsFromDb($uid) : ['ok'=>false,'msg'=>'DB add failed'];
    }

    private static function updateDb(int $uid, int $pid, int $qty): array
    {
        $db = Database::getConnect();
        $st = $db->prepare("UPDATE cart_items SET quantity = ? WHERE user_id = ? AND product_id = ?");
        $st->bind_param('iii', $qty, $uid, $pid);
        $ok = $st->execute();
        return $ok ? self::itemsFromDb($uid) : ['ok'=>false,'msg'=>'DB update failed'];
    }

    private static function removeDb(int $uid, int $pid): array
    {
        $db = Database::getConnect();
        $st = $db->prepare("DELETE FROM cart_items WHERE user_id = ? AND product_id = ?");
        $st->bind_param('ii', $uid, $pid);
        $ok = $st->execute();
        return $ok ? self::itemsFromDb($uid) : ['ok'=>false,'msg'=>'DB remove failed'];
    }

    /* ==========================================================
       ========== internal helpers – session branch =============
       ========================================================== */

    private static function itemsFromSession(): array
    {
        $cart = $_SESSION[self::SESSION_KEY] ?? [];
        $ids  = array_keys($cart);

        if (!$ids) {
            return ['ok' => true, 'items' => []];
        }

        // Pull product data in one query
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $types        = str_repeat('i', count($ids));

        $db = Database::getConnect();
        $st = $db->prepare("SELECT id, name AS title, price, image FROM products WHERE id IN ($placeholders)");
        $st->bind_param($types, ...$ids);
        $st->execute();
        $rows = $st->get_result()->fetch_all(MYSQLI_ASSOC);

        // Merge quantity
        $items = array_map(function ($prod) use ($cart) {
            $prod['quantity'] = $cart[$prod['id']];
            return $prod;
        }, $rows);

        return ['ok' => true, 'items' => $items];
    }

    private static function addSession(int $pid, int $qty): array
    {
        $c = &$_SESSION[self::SESSION_KEY];
        $c[$pid] = ($c[$pid] ?? 0) + $qty;
        return self::itemsFromSession();
    }

    private static function updateSession(int $pid, int $qty): array
    {
        $c = &$_SESSION[self::SESSION_KEY];
        if (isset($c[$pid])) $c[$pid] = $qty;
        return self::itemsFromSession();
    }

    private static function removeSession(int $pid): array
    {
        $c = &$_SESSION[self::SESSION_KEY];
        unset($c[$pid]);
        return self::itemsFromSession();
    }

    /* ==========================================================
       ========== utility =======================================
       ========================================================== */

    /** Current user id or null */
    private static function uid(): ?int
    {
        $u = Operations::getUser();
        return $u['id'] ?? null;
    }
}