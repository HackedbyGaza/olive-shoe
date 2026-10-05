<?php
require_once __DIR__ . '/includes/functions.php';

$action = $_POST['action'] ?? $_GET['action'] ?? null;
$message = null;

// Handle Actions
if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = (int)($_POST['product_id'] ?? 0);
    $size = trim($_POST['size'] ?? '42');
    $quantity = (int)($_POST['quantity'] ?? 1);
    
    if (cart_add($productId, $size, $quantity)) {
        $message = "Footwear successfully added to your shopping bag.";
    }
} elseif ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartKey = $_POST['cart_key'] ?? '';
    $quantity = (int)($_POST['quantity'] ?? 1);
    cart_update($cartKey, $quantity);
    $message = "Shopping bag updated.";
} elseif ($action === 'remove') {
    $cartKey = $_GET['key'] ?? '';
    cart_remove($cartKey);
    $message = "Item removed from bag.";
} elseif ($action === 'clear') {
    cart_clear();
    $message = "Shopping bag cleared.";
}

$cart = get_cart();
$subtotal = get_cart_subtotal();
$freeShippingThreshold = 300.00;
$qualifiesForFreeShipping = $subtotal >= $freeShippingThreshold;
$estimatedShipping = ($subtotal > 0) ? ($qualifiesForFreeShipping ? 0.00 : 15.00) : 0.00;
$total = $subtotal + $estimatedShipping;

$pageTitle = "Your Shopping Bag";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<div class="bg-olive-950 py-10 text-white border-b border-gold-500/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-serif text-3xl font-bold">Shopping Bag</h1>
        <p class="text-xs text-zinc-400 mt-1">Review your handcrafted footwear selection before proceeding to concierge checkout.</p>
    </div>
</div>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex-1">
    
    <?php if ($message): ?>
        <div class="mb-6 p-4 bg-olive-50 border border-olive-200 text-olive-900 rounded-xl text-xs flex items-center justify-between">
            <span class="flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-olive-600"></i> <?= htmlspecialchars($message) ?>
            </span>
            <button onclick="this.parentElement.remove()" class="text-zinc-400 hover:text-zinc-700">&times;</button>
        </div>
    <?php endif; ?>

    <?php if (empty($cart)): ?>
        <div class="text-center py-24 bg-white rounded-2xl border border-zinc-200">
            <div class="w-16 h-16 rounded-full bg-olive-50 text-gold-600 flex items-center justify-center mx-auto text-2xl mb-4">
                <i class="fa-solid fa-bag-shopping"></i>
            </div>
            <h2 class="font-serif text-2xl font-bold text-olive-950 mb-2">Your Bag is Empty</h2>
            <p class="text-xs text-zinc-500 max-w-sm mx-auto mb-6">Explore our curated collections of olive calfskin loafers, boots, and gala oxfords.</p>
            <a href="shop.php" class="inline-flex items-center gap-2 bg-olive-900 hover:bg-gold-500 text-gold-300 hover:text-olive-950 text-xs font-bold uppercase tracking-widest px-8 py-3.5 rounded-lg shadow transition-all">
                <span>Discover Creations</span>
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>
    <?php else: ?>
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            
            <!-- Left: Cart Items List -->
            <div class="lg:col-span-8 bg-white rounded-xl border border-zinc-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-zinc-100 flex items-center justify-between">
                    <h2 class="font-serif font-bold text-lg text-olive-950">Curated Items (<?= get_cart_count() ?>)</h2>
                    <a href="cart.php?action=clear" onclick="return confirm('Clear entire bag?');" class="text-xs text-zinc-400 hover:text-red-600 transition-colors">
                        Clear All
                    </a>
                </div>

                <div class="divide-y divide-zinc-100">
                    <?php foreach ($cart as $key => $item): ?>
                        <div class="p-6 flex flex-col sm:flex-row items-center gap-6">
                            
                            <!-- Thumbnail -->
                            <div class="w-24 h-24 rounded-lg overflow-hidden bg-zinc-100 flex-shrink-0 border border-zinc-200">
                                <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="w-full h-full object-cover">
                            </div>

                            <!-- Info -->
                            <div class="flex-1 text-center sm:text-left">
                                <h3 class="font-serif font-bold text-base text-zinc-900 hover:text-olive-700">
                                    <a href="product.php?id=<?= $item['id'] ?>"><?= htmlspecialchars($item['name']) ?></a>
                                </h3>
                                <div class="text-xs text-zinc-500 mt-1 flex flex-wrap gap-4 justify-center sm:justify-start">
                                    <span>EU Size: <strong class="text-zinc-800"><?= htmlspecialchars($item['size']) ?></strong></span>
                                    <span>Colorway: <strong class="text-zinc-800">Olive & Gold</strong></span>
                                </div>
                                <div class="text-xs font-bold text-olive-900 mt-2 sm:hidden">
                                    <?= format_price($item['price']) ?> each
                                </div>
                            </div>

                            <!-- Quantity update form -->
                            <form action="cart.php" method="POST" class="flex items-center gap-2">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="cart_key" value="<?= htmlspecialchars($key) ?>">
                                
                                <div class="flex items-center border border-zinc-300 rounded-lg overflow-hidden">
                                    <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" max="10" 
                                           onchange="this.form.submit()"
                                           class="w-14 text-center text-xs font-bold py-2 focus:outline-none">
                                </div>
                            </form>

                            <!-- Subtotal -->
                            <div class="text-right hidden sm:block min-w-[90px]">
                                <div class="text-sm font-bold text-olive-950"><?= format_price($item['price'] * $item['quantity']) ?></div>
                                <div class="text-[11px] text-zinc-400"><?= format_price($item['price']) ?> each</div>
                            </div>

                            <!-- Remove button -->
                            <div>
                                <a href="cart.php?action=remove&key=<?= urlencode($key) ?>" 
                                   title="Remove item" 
                                   class="text-zinc-400 hover:text-red-600 p-2 text-sm transition-colors">
                                    <i class="fa-regular fa-trash-can"></i>
                                </a>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Shipping threshold nudge -->
                <div class="p-4 bg-[#f8f7f2] border-t border-zinc-200 text-xs flex items-center justify-between text-zinc-700">
                    <?php if ($qualifiesForFreeShipping): ?>
                        <span class="text-olive-700 font-semibold flex items-center gap-2">
                            <i class="fa-solid fa-crown text-gold-500"></i> Your order qualifies for Complimentary Insured Express Shipping!
                        </span>
                    <?php else: ?>
                        <span>
                            Add <strong><?= format_price($freeShippingThreshold - $subtotal) ?></strong> more to unlock <strong>Complimentary Express Delivery</strong>
                        </span>
                    <?php endif; ?>
                    <a href="shop.php" class="text-xs font-bold text-olive-800 hover:text-gold-600 uppercase tracking-wider">
                        + Add Shoes
                    </a>
                </div>

            </div>

            <!-- Right: Order Summary Sidebar -->
            <div class="lg:col-span-4 bg-white rounded-xl border border-zinc-200 shadow-sm p-6 space-y-6">
                <h2 class="font-serif font-bold text-lg text-olive-950 border-b border-zinc-100 pb-3">Order Summary</h2>

                <div class="space-y-3 text-xs">
                    <div class="flex justify-between text-zinc-600">
                        <span>Items Subtotal</span>
                        <span class="font-semibold text-zinc-900"><?= format_price($subtotal) ?></span>
                    </div>
                    <div class="flex justify-between text-zinc-600">
                        <span>Estimated Shipping</span>
                        <span class="font-semibold text-zinc-900">
                            <?= $estimatedShipping > 0 ? format_price($estimatedShipping) : '<span class="text-olive-700 font-bold">Complimentary</span>' ?>
                        </span>
                    </div>
                    <div class="flex justify-between text-zinc-600">
                        <span>Luxury Cedar Shoe Trees</span>
                        <span class="text-gold-600 font-bold">Included Free</span>
                    </div>
                    <div class="flex justify-between text-zinc-600">
                        <span>Estimated Taxes</span>
                        <span class="text-zinc-400">Calculated at checkout</span>
                    </div>
                </div>

                <div class="border-t border-zinc-200 pt-4 flex justify-between items-baseline">
                    <span class="font-serif font-bold text-base text-zinc-900">Estimated Total</span>
                    <span class="font-serif text-2xl font-bold text-olive-950"><?= format_price($total) ?></span>
                </div>

                <!-- Proceed Button -->
                <a href="checkout.php" 
                   class="w-full inline-flex items-center justify-center gap-2 bg-olive-900 hover:bg-olive-950 text-gold-300 border border-gold-500/50 py-4 px-6 rounded-lg text-xs font-bold tracking-widest uppercase shadow-lg hover:shadow-xl transition-all">
                    <span>Proceed to Concierge Checkout</span>
                    <i class="fa-solid fa-lock text-xs"></i>
                </a>

                <!-- Security Assurance -->
                <div class="pt-2 text-center text-[11px] text-zinc-400 space-y-2">
                    <p class="flex items-center justify-center gap-1.5">
                        <i class="fa-solid fa-shield-check text-olive-600"></i> Bank-Grade 256-Bit SSL Encrypted
                    </p>
                    <p>30-Day Bespoke Fit Exchange Guarantee</p>
                </div>
            </div>

        </div>

    <?php endif; ?>

</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
