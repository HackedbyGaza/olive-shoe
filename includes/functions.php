<?php
/**
 * Olive Shoe - Core Helper Functions & Data Layer
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';

// Fallback seed catalog (guarantees preview works immediately out-of-the-box before MySQL setup)
function get_fallback_catalog() {
    return [
        1 => [
            'id' => 1,
            'name' => 'The Sovereign Olive Penny Loafer',
            'slug' => 'sovereign-olive-penny-loafer',
            'category_id' => 1,
            'category_name' => 'Artisan Loafers',
            'description' => 'Handcrafted in Tuscany from vegetable-tanned olive calfskin, The Sovereign features custom brass-gold hardware across the vamp and Goodyear welted leather soles. Designed for the connoisseur who commands distinction.',
            'short_description' => 'Vegetable-tanned olive calfskin with bespoke gold hardware accent.',
            'price' => 385.00,
            'sale_price' => null,
            'image_url' => 'https://images.unsplash.com/photo-1533867617858-e7b97e060509?auto=format&fit=crop&w=900&q=80',
            'available_sizes' => '39,40,41,42,43,44,45',
            'color' => 'Deep Olive / Muted Gold',
            'material' => 'Tuscan Calf Leather',
            'stock_quantity' => 24,
            'is_featured' => 1,
            'is_new' => 1,
            'rating' => 5.0
        ],
        2 => [
            'id' => 2,
            'name' => 'The Aureus Chelsea Boot in Forest Patina',
            'slug' => 'aureus-chelsea-boot',
            'category_id' => 2,
            'category_name' => 'Heritage Boots',
            'description' => 'Cut from oiled nubuck leather in a rich dark olive tone, complemented by gold-thread woven pull tabs and dual stretch gussets. Finished with a durable Vibram lug sole for effortless transitions from atelier to city streets.',
            'short_description' => 'Oiled nubuck leather in dark olive with gold-threaded pull tabs.',
            'price' => 440.00,
            'sale_price' => 395.00,
            'image_url' => 'https://images.unsplash.com/photo-1608256246200-53e635b5b65f?auto=format&fit=crop&w=900&q=80',
            'available_sizes' => '40,41,42,43,44',
            'color' => 'Forest Patina Olive',
            'material' => 'Oiled Nubuck & Vibram Sole',
            'stock_quantity' => 18,
            'is_featured' => 1,
            'is_new' => 0,
            'rating' => 4.9
        ],
        3 => [
            'id' => 3,
            'name' => 'The Gilded Monks Double Buckle',
            'slug' => 'gilded-monks-double-buckle',
            'category_id' => 3,
            'category_name' => 'Formal Oxford & Derby',
            'description' => 'A masterpiece of formal shoemaking. Hand-burnished deep olive boxcalf leather finished with solid 14k-electroplated gold buckles and fiddleback beveled waists. Perfect for black-tie gatherings and momentous milestones.',
            'short_description' => 'Hand-burnished boxcalf with 14k-gold finished double monk straps.',
            'price' => 480.00,
            'sale_price' => null,
            'image_url' => 'https://images.unsplash.com/photo-1614252235316-8c857d38b5f4?auto=format&fit=crop&w=900&q=80',
            'available_sizes' => '39,40,41,42,43,44',
            'color' => 'Olive Burnish & Gold Buckle',
            'material' => 'Italian Boxcalf',
            'stock_quantity' => 15,
            'is_featured' => 1,
            'is_new' => 1,
            'rating' => 5.0
        ],
        4 => [
            'id' => 4,
            'name' => 'Verdant Court Low-Top Sneaker',
            'slug' => 'verdant-court-low-top',
            'category_id' => 4,
            'category_name' => 'Luxury Minimalist Sneakers',
            'description' => 'An elevated interpretation of the court shoe. Crafted with velvety Italian olive suede, butter-soft leather lining, gold foil embossed serial numbers, and a Margom rubber cupsole.',
            'short_description' => 'Italian olive suede court sneaker with gold foil stamped detailing.',
            'price' => 295.00,
            'sale_price' => null,
            'image_url' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?auto=format&fit=crop&w=900&q=80',
            'available_sizes' => '39,40,41,42,43,44,45',
            'color' => 'Soft Sage & Gold Foil',
            'material' => 'Italian Velour Suede',
            'stock_quantity' => 35,
            'is_featured' => 1,
            'is_new' => 0,
            'rating' => 4.8
        ],
        5 => [
            'id' => 5,
            'name' => 'The Versailles Tassel Loafer',
            'slug' => 'versailles-tassel-loafer',
            'category_id' => 1,
            'category_name' => 'Artisan Loafers',
            'description' => 'Double-tasseled perfection with woven olive leather apron and miniature gold ring cinch. Designed with cushioned cork footbeds that mold to your foot over time.',
            'short_description' => 'Hand-woven apron loafer with olive leather tassels and gold accents.',
            'price' => 395.00,
            'sale_price' => 350.00,
            'image_url' => 'https://images.unsplash.com/photo-1560343090-f0409e92791a?auto=format&fit=crop&w=900&q=80',
            'available_sizes' => '40,41,42,43,44',
            'color' => 'Vintage Olive Oil Wash',
            'material' => 'Calfskin & Cork Insole',
            'stock_quantity' => 20,
            'is_featured' => 0,
            'is_new' => 1,
            'rating' => 4.9
        ],
        6 => [
            'id' => 6,
            'name' => 'The Olympus Wingtip Brogue',
            'slug' => 'olympus-wingtip-brogue',
            'category_id' => 3,
            'category_name' => 'Formal Oxford & Derby',
            'description' => 'Intricate decorative perforations meet deep woodland olive cordovan leather. Finished with brass lace eyelets and hand-waxed laces.',
            'short_description' => 'Classic full brogue wingtip in rich olive tones with subtle gold eyelets.',
            'price' => 465.00,
            'sale_price' => null,
            'image_url' => 'https://images.unsplash.com/photo-1543163521-1bf539c55dd2?auto=format&fit=crop&w=900&q=80',
            'available_sizes' => '41,42,43,44,45',
            'color' => 'Woodland Olive',
            'material' => 'Cordovan Leather',
            'stock_quantity' => 12,
            'is_featured' => 0,
            'is_new' => 0,
            'rating' => 4.7
        ]
    ];
}

function get_fallback_categories() {
    return [
        ['id' => 1, 'name' => 'Artisan Loafers', 'slug' => 'loafers', 'count' => 2],
        ['id' => 2, 'name' => 'Heritage Boots', 'slug' => 'boots', 'count' => 1],
        ['id' => 3, 'name' => 'Formal Oxford & Derby', 'slug' => 'oxford-derby', 'count' => 2],
        ['id' => 4, 'name' => 'Luxury Minimalist Sneakers', 'slug' => 'luxury-sneakers', 'count' => 1]
    ];
}

function get_shipping_methods() {
    $db = get_db_connection();
    if ($db) {
        try {
            $stmt = $db->query("SELECT * FROM shipping_methods WHERE is_active = 1 ORDER BY cost ASC");
            $methods = $stmt->fetchAll();
            if (!empty($methods)) return $methods;
        } catch (Exception $e) {}
    }
    return [
        ['id' => 1, 'name' => 'Standard Ground Delivery', 'description' => 'Insured delivery via national carrier', 'cost' => 15.00, 'estimated_days' => '3 - 5 Business Days'],
        ['id' => 2, 'name' => 'Express Air Courier', 'description' => 'Priority expedited courier with gold seal packaging', 'cost' => 35.00, 'estimated_days' => '1 - 2 Business Days'],
        ['id' => 3, 'name' => 'Artisan White-Glove VIP', 'description' => 'Bespoke hand delivery with cedar shoe trees included', 'cost' => 65.00, 'estimated_days' => 'Next Business Day']
    ];
}

/**
 * Fetch all products, with optional filtering
 */
function get_all_products($categoryId = null, $sort = 'newest', $search = '') {
    $db = get_db_connection();
    if ($db) {
        try {
            $sql = "SELECT p.*, c.name AS category_name FROM products p JOIN categories c ON p.category_id = c.id WHERE 1=1";
            $params = [];
            if ($categoryId) {
                $sql .= " AND p.category_id = ?";
                $params[] = $categoryId;
            }
            if ($search) {
                $sql .= " AND (p.name LIKE ? OR p.description LIKE ?)";
                $params[] = "%$search%";
                $params[] = "%$search%";
            }
            if ($sort === 'price_asc') {
                $sql .= " ORDER BY COALESCE(p.sale_price, p.price) ASC";
            } elseif ($sort === 'price_desc') {
                $sql .= " ORDER BY COALESCE(p.sale_price, p.price) DESC";
            } else {
                $sql .= " ORDER BY p.id DESC";
            }
            $stmt = $db->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (Exception $e) {}
    }

    // Fallback in-memory filter
    $products = get_fallback_catalog();
    if ($categoryId) {
        $products = array_filter($products, fn($p) => $p['category_id'] == $categoryId);
    }
    if ($search) {
        $s = strtolower($search);
        $products = array_filter($products, fn($p) => str_contains(strtolower($p['name']), $s) || str_contains(strtolower($p['description']), $s));
    }
    if ($sort === 'price_asc') {
        usort($products, fn($a, $b) => ($a['sale_price'] ?? $a['price']) <=> ($b['sale_price'] ?? $b['price']));
    } elseif ($sort === 'price_desc') {
        usort($products, fn($a, $b) => ($b['sale_price'] ?? $b['price']) <=> ($a['sale_price'] ?? $a['price']));
    }
    return array_values($products);
}

/**
 * Fetch product by ID or Slug
 */
function get_product($idOrSlug) {
    $db = get_db_connection();
    if ($db) {
        try {
            $col = is_numeric($idOrSlug) ? 'p.id' : 'p.slug';
            $sql = "SELECT p.*, c.name AS category_name FROM products p JOIN categories c ON p.category_id = c.id WHERE $col = ? LIMIT 1";
            $stmt = $db->prepare($sql);
            $stmt->execute([$idOrSlug]);
            $res = $stmt->fetch();
            if ($res) return $res;
        } catch (Exception $e) {}
    }

    $catalog = get_fallback_catalog();
    foreach ($catalog as $p) {
        if ($p['id'] == $idOrSlug || $p['slug'] == $idOrSlug) {
            return $p;
        }
    }
    return null;
}

/**
 * Fetch featured products
 */
function get_featured_products($limit = 4) {
    $all = get_all_products();
    $featured = array_filter($all, fn($p) => !empty($p['is_featured']));
    return array_slice($featured, 0, $limit);
}

/**
 * Fetch categories
 */
function get_categories() {
    $db = get_db_connection();
    if ($db) {
        try {
            $stmt = $db->query("SELECT c.*, COUNT(p.id) as count FROM categories c LEFT JOIN products p ON c.id = p.category_id GROUP BY c.id");
            $cats = $stmt->fetchAll();
            if (!empty($cats)) return $cats;
        } catch (Exception $e) {}
    }
    return get_fallback_categories();
}

/**
 * Formatting price
 */
function format_price($amount) {
    return APP_CURRENCY . number_format((float)$amount, 2);
}

/**
 * Cart Operations
 */
function cart_add($productId, $size, $quantity = 1) {
    $product = get_product($productId);
    if (!$product) return false;

    $cartKey = $productId . '_' . $size;
    $unitPrice = $product['sale_price'] ?? $product['price'];

    if (isset($_SESSION['cart'][$cartKey])) {
        $_SESSION['cart'][$cartKey]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$cartKey] = [
            'id' => $product['id'],
            'name' => $product['name'],
            'slug' => $product['slug'],
            'image_url' => $product['image_url'],
            'price' => (float)$unitPrice,
            'size' => $size,
            'quantity' => (int)$quantity
        ];
    }
    return true;
}

function cart_update($cartKey, $quantity) {
    if (isset($_SESSION['cart'][$cartKey])) {
        if ($quantity <= 0) {
            unset($_SESSION['cart'][$cartKey]);
        } else {
            $_SESSION['cart'][$cartKey]['quantity'] = (int)$quantity;
        }
    }
}

function cart_remove($cartKey) {
    if (isset($_SESSION['cart'][$cartKey])) {
        unset($_SESSION['cart'][$cartKey]);
    }
}

function cart_clear() {
    $_SESSION['cart'] = [];
}

function get_cart() {
    return $_SESSION['cart'] ?? [];
}

function get_cart_count() {
    $count = 0;
    foreach (get_cart() as $item) {
        $count += $item['quantity'];
    }
    return $count;
}

function get_cart_subtotal() {
    $subtotal = 0;
    foreach (get_cart() as $item) {
        $subtotal += ($item['price'] * $item['quantity']);
    }
    return $subtotal;
}

/**
 * Create Order (Stores to database or session, returns created order info)
 */
function create_order($orderData, $items) {
    $orderNumber = 'OLV-' . strtoupper(bin2hex(random_bytes(4)));
    $subtotal = get_cart_subtotal();
    $shippingCost = (float)($orderData['shipping_cost'] ?? 15.00);
    $totalAmount = $subtotal + $shippingCost;

    $db = get_db_connection();
    if ($db) {
        try {
            $db->beginTransaction();

            $sql = "INSERT INTO orders (
                order_number, customer_name, customer_email, customer_phone,
                shipping_address, shipping_city, shipping_state, shipping_postal_code,
                shipping_country, shipping_method, shipping_cost, subtotal, total_amount,
                payment_method, payment_status, order_status, notes
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $db->prepare($sql);
            $stmt->execute([
                $orderNumber,
                $orderData['customer_name'],
                $orderData['customer_email'],
                $orderData['customer_phone'],
                $orderData['shipping_address'],
                $orderData['shipping_city'],
                $orderData['shipping_state'],
                $orderData['shipping_postal_code'],
                $orderData['shipping_country'],
                $orderData['shipping_method'] ?? 'Standard Ground Delivery',
                $shippingCost,
                $subtotal,
                $totalAmount,
                $orderData['payment_method'] ?? 'card',
                'paid', // Marked paid for immediate feedback
                'processing',
                $orderData['notes'] ?? ''
            ]);

            $orderId = $db->lastInsertId();

            $itemSql = "INSERT INTO order_items (order_id, product_id, product_name, product_image, selected_size, unit_price, quantity, subtotal) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $itemStmt = $db->prepare($itemSql);

            foreach ($items as $item) {
                $itemSubtotal = $item['price'] * $item['quantity'];
                $itemStmt->execute([
                    $orderId,
                    $item['id'],
                    $item['name'],
                    $item['image_url'],
                    $item['size'],
                    $item['price'],
                    $item['quantity'],
                    $itemSubtotal
                ]);
            }

            $db->commit();
        } catch (Exception $e) {
            if ($db->inTransaction()) {
                $db->rollBack();
            }
            error_log("Order insert error: " . $e->getMessage());
        }
    }

    // Cache order details in session so order-success.php can display instant receipt
    $receipt = [
        'order_number' => $orderNumber,
        'date' => date('F j, Y, g:i a'),
        'customer' => $orderData,
        'items' => $items,
        'subtotal' => $subtotal,
        'shipping_cost' => $shippingCost,
        'total' => $totalAmount,
        'payment_method' => $orderData['payment_method'] ?? 'Credit / Debit Card'
    ];

    $_SESSION['last_order'] = $receipt;
    cart_clear();

    return $receipt;
}
