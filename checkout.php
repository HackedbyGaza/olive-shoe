<?php
require_once __DIR__ . '/includes/functions.php';

$cart = get_cart();
if (empty($cart)) {
    header('Location: cart.php');
    exit;
}

$subtotal = get_cart_subtotal();
$shippingMethods = get_shipping_methods();

// Process Checkout Form Submission
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    
    // Sanitize shipping details
    $customerName = trim($_POST['customer_name'] ?? '');
    $customerEmail = filter_var(trim($_POST['customer_email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $customerPhone = trim($_POST['customer_phone'] ?? '');
    $shippingAddress = trim($_POST['shipping_address'] ?? '');
    $shippingCity = trim($_POST['shipping_city'] ?? '');
    $shippingState = trim($_POST['shipping_state'] ?? '');
    $shippingPostalCode = trim($_POST['shipping_postal_code'] ?? '');
    $shippingCountry = trim($_POST['shipping_country'] ?? '');
    $shippingMethodId = (int)($_POST['shipping_method'] ?? 1);
    $paymentMethod = trim($_POST['payment_method'] ?? 'card');
    $notes = trim($_POST['order_notes'] ?? '');

    // Validation
    if (empty($customerName)) $errors[] = "Please provide your full name.";
    if (!$customerEmail) $errors[] = "Please provide a valid email address for delivery updates.";
    if (empty($customerPhone)) $errors[] = "Please provide a telephone number for the delivery carrier.";
    if (empty($shippingAddress)) $errors[] = "Please enter your street address.";
    if (empty($shippingCity)) $errors[] = "Please enter your delivery city.";
    if (empty($shippingPostalCode)) $errors[] = "Please enter your postal/zip code.";

    if (empty($errors)) {
        // Resolve chosen shipping method & price
        $selectedMethodName = "Standard Ground Delivery";
        $selectedShippingCost = ($subtotal >= 300) ? 0.00 : 15.00;

        foreach ($shippingMethods as $method) {
            if ($method['id'] == $shippingMethodId) {
                $selectedMethodName = $method['name'];
                $selectedShippingCost = ($method['id'] == 1 && $subtotal >= 300) ? 0.00 : (float)$method['cost'];
                break;
            }
        }

        $orderPayload = [
            'customer_name' => $customerName,
            'customer_email' => $customerEmail,
            'customer_phone' => $customerPhone,
            'shipping_address' => $shippingAddress,
            'shipping_city' => $shippingCity,
            'shipping_state' => $shippingState,
            'shipping_postal_code' => $shippingPostalCode,
            'shipping_country' => $shippingCountry,
            'shipping_method' => $selectedMethodName,
            'shipping_cost' => $selectedShippingCost,
            'payment_method' => $paymentMethod,
            'notes' => $notes
        ];

        $receipt = create_order($orderPayload, $cart);

        // Redirect to success receipt
        header('Location: order-success.php');
        exit;
    }
}

$pageTitle = "Secure Checkout & Shipping";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<!-- Checkout Banner -->
<div class="bg-olive-950 py-10 text-white border-b border-gold-500/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <nav class="text-xs text-gold-400 mb-1 flex items-center gap-2">
                <a href="cart.php" class="hover:underline">Shopping Bag</a>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <span class="text-zinc-400">Concierge Checkout</span>
            </nav>
            <h1 class="font-serif text-3xl font-bold">Secure Checkout</h1>
        </div>
        <div class="flex items-center gap-2 text-xs text-gold-300 bg-olive-900/80 px-4 py-2 rounded-full border border-gold-500/30 w-fit">
            <i class="fa-solid fa-lock text-gold-400"></i>
            <span>Encrypted SSL 256-bit Transaction</span>
        </div>
    </div>
</div>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex-1">
    
    <?php if (!empty($errors)): ?>
        <div class="mb-8 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl text-xs space-y-1">
            <p class="font-bold flex items-center gap-2"><i class="fa-solid fa-triangle-exclamation"></i> Please correct the following:</p>
            <ul class="list-disc list-inside pl-2">
                <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="checkout.php" id="checkoutForm" class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        
        <!-- Left: Shipping & Payment Information -->
        <div class="lg:col-span-7 space-y-10">
            
            <!-- Section 1: Customer Contact & Shipping Details -->
            <div class="bg-white p-6 sm:p-8 rounded-2xl border border-zinc-200 shadow-sm space-y-6">
                <div class="flex items-center gap-3 border-b border-zinc-100 pb-4">
                    <span class="w-8 h-8 rounded-full bg-olive-900 text-gold-400 font-bold text-xs flex items-center justify-center border border-gold-500/50">1</span>
                    <h2 class="font-serif font-bold text-xl text-olive-950">Shipping Destination</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 mb-1.5">Recipient Full Name *</label>
                        <input type="text" name="customer_name" required value="<?= htmlspecialchars($_POST['customer_name'] ?? 'Lord Arthur Sterling') ?>"
                               class="w-full bg-zinc-50 border border-zinc-300 rounded-lg py-2.5 px-3.5 text-xs text-zinc-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-gold-500 focus:border-gold-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 mb-1.5">Email Address *</label>
                        <input type="email" name="customer_email" required value="<?= htmlspecialchars($_POST['customer_email'] ?? 'sterling@luxury-ateliers.com') ?>"
                               class="w-full bg-zinc-50 border border-zinc-300 rounded-lg py-2.5 px-3.5 text-xs text-zinc-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-gold-500 focus:border-gold-500">
                        <span class="text-[10px] text-zinc-400 mt-1 block">Tracking number sent here</span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 mb-1.5">Phone Number *</label>
                        <input type="tel" name="customer_phone" required value="<?= htmlspecialchars($_POST['customer_phone'] ?? '+1 (555) 789-0142') ?>"
                               class="w-full bg-zinc-50 border border-zinc-300 rounded-lg py-2.5 px-3.5 text-xs text-zinc-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-gold-500 focus:border-gold-500">
                        <span class="text-[10px] text-zinc-400 mt-1 block">For delivery carrier coordination</span>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 mb-1.5">Street Address *</label>
                        <input type="text" name="shipping_address" required placeholder="Apartment, suite, unit, building, street address" 
                               value="<?= htmlspecialchars($_POST['shipping_address'] ?? '450 Kensington High Street, Suite 4B') ?>"
                               class="w-full bg-zinc-50 border border-zinc-300 rounded-lg py-2.5 px-3.5 text-xs text-zinc-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-gold-500 focus:border-gold-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 mb-1.5">City *</label>
                        <input type="text" name="shipping_city" required value="<?= htmlspecialchars($_POST['shipping_city'] ?? 'London') ?>"
                               class="w-full bg-zinc-50 border border-zinc-300 rounded-lg py-2.5 px-3.5 text-xs text-zinc-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-gold-500 focus:border-gold-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 mb-1.5">State / County / Region</label>
                        <input type="text" name="shipping_state" value="<?= htmlspecialchars($_POST['shipping_state'] ?? 'Greater London') ?>"
                               class="w-full bg-zinc-50 border border-zinc-300 rounded-lg py-2.5 px-3.5 text-xs text-zinc-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-gold-500 focus:border-gold-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 mb-1.5">Postal / Zip Code *</label>
                        <input type="text" name="shipping_postal_code" required value="<?= htmlspecialchars($_POST['shipping_postal_code'] ?? 'W8 7NX') ?>"
                               class="w-full bg-zinc-50 border border-zinc-300 rounded-lg py-2.5 px-3.5 text-xs text-zinc-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-gold-500 focus:border-gold-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 mb-1.5">Country *</label>
                        <select name="shipping_country" class="w-full bg-zinc-50 border border-zinc-300 rounded-lg py-2.5 px-3.5 text-xs text-zinc-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-gold-500 focus:border-gold-500">
                            <option value="United States">United States</option>
                            <option value="United Kingdom" selected>United Kingdom</option>
                            <option value="Canada">Canada</option>
                            <option value="Australia">Australia</option>
                            <option value="France">France</option>
                            <option value="Germany">Germany</option>
                            <option value="Italy">Italy</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="Japan">Japan</option>
                            <option value="Singapore">Singapore</option>
                        </select>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 mb-1.5">Delivery Notes & Gate Codes (Optional)</label>
                        <textarea name="order_notes" rows="2" placeholder="Instructions for carrier or bespoke gift note..."
                                  class="w-full bg-zinc-50 border border-zinc-300 rounded-lg py-2 px-3 text-xs text-zinc-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-gold-500 focus:border-gold-500"><?= htmlspecialchars($_POST['order_notes'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>

            <!-- Section 2: Shipping Method Selection -->
            <div class="bg-white p-6 sm:p-8 rounded-2xl border border-zinc-200 shadow-sm space-y-6">
                <div class="flex items-center gap-3 border-b border-zinc-100 pb-4">
                    <span class="w-8 h-8 rounded-full bg-olive-900 text-gold-400 font-bold text-xs flex items-center justify-center border border-gold-500/50">2</span>
                    <h2 class="font-serif font-bold text-xl text-olive-950">Shipping Method</h2>
                </div>

                <div class="space-y-3">
                    <?php foreach ($shippingMethods as $idx => $m): 
                        $effectiveCost = ($m['id'] == 1 && $subtotal >= 300) ? 0.00 : (float)$m['cost'];
                        $isDefault = ($idx === 0);
                    ?>
                        <label class="cursor-pointer block">
                            <input type="radio" name="shipping_method" value="<?= $m['id'] ?>" 
                                   data-cost="<?= $effectiveCost ?>" 
                                   <?= $isDefault ? 'checked' : '' ?> 
                                   onchange="updateTotalCost()" 
                                   class="peer sr-only">
                            <div class="p-4 rounded-xl border border-zinc-200 peer-checked:border-gold-500 peer-checked:bg-olive-50/50 hover:border-gold-400 transition-all flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-4 h-4 rounded-full border border-zinc-400 peer-checked:border-gold-600 peer-checked:bg-gold-500 flex items-center justify-center"></div>
                                    <div>
                                        <div class="text-xs font-bold text-olive-950"><?= htmlspecialchars($m['name']) ?></div>
                                        <div class="text-[11px] text-zinc-500"><?= htmlspecialchars($m['description']) ?> &bull; <strong><?= htmlspecialchars($m['estimated_days']) ?></strong></div>
                                    </div>
                                </div>
                                <div class="text-xs font-bold text-olive-900">
                                    <?= ($effectiveCost == 0) ? '<span class="text-olive-700">FREE (Atelier Perk)</span>' : format_price($effectiveCost) ?>
                                </div>
                            </div>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Section 3: Payment System -->
            <div class="bg-white p-6 sm:p-8 rounded-2xl border border-zinc-200 shadow-sm space-y-6">
                <div class="flex items-center gap-3 border-b border-zinc-100 pb-4">
                    <span class="w-8 h-8 rounded-full bg-olive-900 text-gold-400 font-bold text-xs flex items-center justify-center border border-gold-500/50">3</span>
                    <h2 class="font-serif font-bold text-xl text-olive-950">Payment System</h2>
                </div>

                <!-- Payment Options Radio Accordion -->
                <div class="space-y-4">
                    
                    <!-- Option 1: Credit / Debit Card -->
                    <div class="border border-zinc-200 rounded-xl overflow-hidden">
                        <label class="flex items-center justify-between p-4 bg-zinc-50 cursor-pointer border-b border-zinc-200">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="payment_method" value="card" checked onchange="togglePaymentPanels('card')" class="text-olive-900 focus:ring-gold-500">
                                <span class="text-xs font-bold text-zinc-900">Credit / Debit Card (Stripe Integrated)</span>
                            </div>
                            <div class="flex gap-2 text-zinc-500 text-base">
                                <i class="fa-brands fa-cc-visa text-blue-900"></i>
                                <i class="fa-brands fa-cc-mastercard text-red-600"></i>
                                <i class="fa-brands fa-cc-amex text-blue-600"></i>
                            </div>
                        </label>

                        <div id="cardPanel" class="p-6 space-y-4 bg-white">
                            <div>
                                <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-600 mb-1">Card Number</label>
                                <div class="relative">
                                    <input type="text" placeholder="4242 &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; 4242" value="4242 8891 0023 9104"
                                           class="w-full bg-zinc-50 border border-zinc-300 rounded-lg py-2.5 pl-3.5 pr-10 text-xs text-zinc-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-gold-500">
                                    <i class="fa-solid fa-lock absolute right-3 top-3 text-gold-500 text-xs"></i>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-600 mb-1">Expiration Date</label>
                                    <input type="text" placeholder="MM/YY" value="12/28"
                                           class="w-full bg-zinc-50 border border-zinc-300 rounded-lg py-2.5 px-3.5 text-xs text-zinc-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-gold-500">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-600 mb-1">Security Code (CVC)</label>
                                    <input type="text" placeholder="3 digits" value="842"
                                           class="w-full bg-zinc-50 border border-zinc-300 rounded-lg py-2.5 px-3.5 text-xs text-zinc-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-gold-500">
                                </div>
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-600 mb-1">Cardholder Name</label>
                                <input type="text" placeholder="Name as shown on card" value="Lord Arthur Sterling"
                                       class="w-full bg-zinc-50 border border-zinc-300 rounded-lg py-2.5 px-3.5 text-xs text-zinc-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-gold-500">
                            </div>
                        </div>
                    </div>

                    <!-- Option 2: PayPal -->
                    <div class="border border-zinc-200 rounded-xl overflow-hidden">
                        <label class="flex items-center justify-between p-4 bg-zinc-50 cursor-pointer">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="payment_method" value="paypal" onchange="togglePaymentPanels('paypal')" class="text-olive-900 focus:ring-gold-500">
                                <span class="text-xs font-bold text-zinc-900">PayPal Express Checkout</span>
                            </div>
                            <i class="fa-brands fa-cc-paypal text-blue-700 text-xl"></i>
                        </label>
                        <div id="paypalPanel" class="hidden p-6 text-xs text-zinc-600 bg-white space-y-2 border-t border-zinc-200">
                            <p>You will be redirected securely to PayPal to authenticate your purchase through your PayPal Wallet or credit line.</p>
                        </div>
                    </div>

                    <!-- Option 3: Direct Atelier Bank Wire -->
                    <div class="border border-zinc-200 rounded-xl overflow-hidden">
                        <label class="flex items-center justify-between p-4 bg-zinc-50 cursor-pointer">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="payment_method" value="bank_transfer" onchange="togglePaymentPanels('bank')" class="text-olive-900 focus:ring-gold-500">
                                <span class="text-xs font-bold text-zinc-900">Direct Atelier Wire Transfer (BACS / IBAN)</span>
                            </div>
                            <i class="fa-solid fa-building-columns text-zinc-600"></i>
                        </label>
                        <div id="bankPanel" class="hidden p-6 text-xs text-zinc-600 bg-white space-y-2 border-t border-zinc-200">
                            <p>For orders over $1,000, private wire settlement is supported. Bank transfer details and pro-forma invoice will be generated upon order placement.</p>
                        </div>
                    </div>

                    <!-- Option 4: Cash / Courier on Delivery -->
                    <div class="border border-zinc-200 rounded-xl overflow-hidden">
                        <label class="flex items-center justify-between p-4 bg-zinc-50 cursor-pointer">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="payment_method" value="cod" onchange="togglePaymentPanels('cod')" class="text-olive-900 focus:ring-gold-500">
                                <span class="text-xs font-bold text-zinc-900">Courier Inspection & Payment on Delivery (COD)</span>
                            </div>
                            <i class="fa-solid fa-hand-holding-dollar text-olive-800"></i>
                        </label>
                        <div id="codPanel" class="hidden p-6 text-xs text-zinc-600 bg-white space-y-2 border-t border-zinc-200">
                            <p>Inspect your olive calfskin footwear in person before handing cash or card payment to the white-glove courier.</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <!-- Right: Order Summary Sticky Card -->
        <div class="lg:col-span-5 sticky top-28 space-y-6">
            
            <div class="bg-white p-6 sm:p-8 rounded-2xl border border-zinc-200 shadow-sm space-y-6">
                <h3 class="font-serif font-bold text-xl text-olive-950 border-b border-zinc-100 pb-4">
                    Your Selection (<?= get_cart_count() ?>)
                </h3>

                <!-- Items Mini List -->
                <div class="space-y-4 max-h-72 overflow-y-auto pr-1">
                    <?php foreach ($cart as $it): ?>
                        <div class="flex items-center gap-3">
                            <img src="<?= htmlspecialchars($it['image_url']) ?>" alt="<?= htmlspecialchars($it['name']) ?>" class="w-14 h-14 object-cover rounded-lg border border-zinc-200">
                            <div class="flex-1 min-w-0">
                                <h4 class="font-serif font-bold text-xs text-zinc-900 truncate"><?= htmlspecialchars($it['name']) ?></h4>
                                <div class="text-[11px] text-zinc-500">EU Size <?= htmlspecialchars($it['size']) ?> &bull; Qty: <?= $it['quantity'] ?></div>
                            </div>
                            <div class="text-xs font-bold text-olive-950">
                                <?= format_price($it['price'] * $it['quantity']) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Price Calculations -->
                <div class="space-y-2.5 pt-4 border-t border-zinc-100 text-xs">
                    <div class="flex justify-between text-zinc-600">
                        <span>Bag Subtotal</span>
                        <span class="font-semibold text-zinc-900"><?= format_price($subtotal) ?></span>
                    </div>

                    <div class="flex justify-between text-zinc-600">
                        <span>Shipping Service</span>
                        <span id="shippingDisplay" class="font-semibold text-zinc-900">
                            <?= ($subtotal >= 300) ? '<span class="text-olive-700">FREE</span>' : format_price(15.00) ?>
                        </span>
                    </div>

                    <div class="flex justify-between text-zinc-600">
                        <span>Cedar Trees & Gift Packaging</span>
                        <span class="text-gold-600 font-bold">Complimentary</span>
                    </div>

                    <div class="flex justify-between text-zinc-600">
                        <span>Import Duties & Taxes</span>
                        <span class="text-zinc-500">Included</span>
                    </div>
                </div>

                <!-- Total Amount -->
                <div class="pt-4 border-t border-zinc-200 flex justify-between items-baseline">
                    <span class="font-serif font-bold text-lg text-zinc-900">Grand Total</span>
                    <span id="grandTotalDisplay" class="font-serif text-3xl font-bold text-olive-950">
                        <?= format_price($subtotal + (($subtotal >= 300) ? 0.00 : 15.00)) ?>
                    </span>
                </div>

                <!-- Place Order Button -->
                <button type="submit" name="place_order" 
                        class="w-full bg-olive-900 hover:bg-olive-950 text-gold-300 hover:text-gold-200 border border-gold-500/60 py-4 px-6 rounded-xl text-xs font-bold tracking-widest uppercase shadow-xl hover:shadow-2xl transition-all flex items-center justify-center gap-2 group">
                    <i class="fa-solid fa-lock text-gold-400 group-hover:scale-110 transition-transform"></i>
                    <span>Authorize & Confirm Order</span>
                </button>

                <p class="text-[11px] text-zinc-400 text-center leading-relaxed">
                    By clicking confirm, you authorize Olive Shoe Atelier to charge the stated amount and accept our 30-day handcrafted guarantee.
                </p>
            </div>

            <!-- Trust Badge Box -->
            <div class="bg-[#f7f6f0] p-4 rounded-xl border border-zinc-200 text-xs text-zinc-600 flex items-center gap-3">
                <i class="fa-solid fa-award text-gold-600 text-2xl flex-shrink-0"></i>
                <p class="text-[11px] leading-snug">
                    <strong>Every pair is individually inspected</strong> before sealing with our wax crest and dispatched in tamper-evident gold courier packaging.
                </p>
            </div>

        </div>

    </form>
</main>

<script>
    const subtotal = <?= $subtotal ?>;

    function updateTotalCost() {
        const selectedMethod = document.querySelector('input[name="shipping_method"]:checked');
        const cost = selectedMethod ? parseFloat(selectedMethod.dataset.cost) : 15.00;
        
        const shippingDisplay = document.getElementById('shippingDisplay');
        if (cost === 0) {
            shippingDisplay.innerHTML = '<span class="text-olive-700 font-bold">FREE</span>';
        } else {
            shippingDisplay.textContent = '$' + cost.toFixed(2);
        }

        const total = subtotal + cost;
        document.getElementById('grandTotalDisplay').textContent = '$' + total.toFixed(2);
    }

    function togglePaymentPanels(type) {
        document.getElementById('cardPanel').classList.toggle('hidden', type !== 'card');
        document.getElementById('paypalPanel').classList.toggle('hidden', type !== 'paypal');
        document.getElementById('bankPanel').classList.toggle('hidden', type !== 'bank');
        document.getElementById('codPanel').classList.toggle('hidden', type !== 'cod');
    }
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
