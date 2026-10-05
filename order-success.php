<?php
require_once __DIR__ . '/includes/functions.php';

$order = $_SESSION['last_order'] ?? null;

// If accessed directly without an order, create a demo receipt for instant review
if (!$order) {
    $order = [
        'order_number' => 'OLV-8A2F941C',
        'date' => date('F j, Y, g:i a'),
        'customer' => [
            'customer_name' => 'Lord Arthur Sterling',
            'customer_email' => 'sterling@luxury-ateliers.com',
            'customer_phone' => '+1 (555) 789-0142',
            'shipping_address' => '450 Kensington High Street, Suite 4B',
            'shipping_city' => 'London',
            'shipping_state' => 'Greater London',
            'shipping_postal_code' => 'W8 7NX',
            'shipping_country' => 'United Kingdom',
            'shipping_method' => 'Express Air Courier',
        ],
        'items' => [
            [
                'id' => 1,
                'name' => 'The Sovereign Olive Penny Loafer',
                'image_url' => 'https://images.unsplash.com/photo-1533867617858-e7b97e060509?auto=format&fit=crop&w=900&q=80',
                'size' => '42',
                'price' => 385.00,
                'quantity' => 1
            ]
        ],
        'subtotal' => 385.00,
        'shipping_cost' => 0.00,
        'total' => 385.00,
        'payment_method' => 'card'
    ];
}

$pageTitle = "Order Confirmation & Tracking #" . $order['order_number'];
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<div class="bg-olive-950 py-12 text-white border-b border-gold-500/20 text-center">
    <div class="max-w-4xl mx-auto px-4">
        <div class="w-16 h-16 rounded-full bg-olive-900 border-2 border-gold-400 text-gold-400 flex items-center justify-center mx-auto text-2xl shadow-xl mb-4 animate-bounce">
            <i class="fa-solid fa-check"></i>
        </div>
        <span class="text-xs font-bold tracking-widest text-gold-400 uppercase">Payment Authorized & Order Confirmed</span>
        <h1 class="font-serif text-3xl sm:text-4xl font-bold mt-1">Thank You For Your Patronage</h1>
        <p class="text-xs text-zinc-300 mt-2">
            Order Reference: <strong class="text-gold-300 font-mono text-sm tracking-wider"><?= htmlspecialchars($order['order_number']) ?></strong>
        </p>
    </div>
</div>

<main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex-1">
    
    <!-- Timeline Stepper -->
    <div class="bg-white rounded-2xl p-6 sm:p-8 border border-zinc-200 shadow-sm mb-10">
        <h2 class="text-xs font-bold uppercase tracking-wider text-zinc-500 mb-6 text-center">Atelier Dispatch Pipeline</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 text-center relative">
            <div class="space-y-2">
                <div class="w-10 h-10 rounded-full bg-olive-900 text-gold-400 border border-gold-500 flex items-center justify-center mx-auto font-bold text-sm">
                    <i class="fa-solid fa-check text-xs"></i>
                </div>
                <h4 class="font-bold text-xs text-olive-950">1. Order Placed</h4>
                <p class="text-[11px] text-zinc-400">Payment captured</p>
            </div>

            <div class="space-y-2">
                <div class="w-10 h-10 rounded-full bg-gold-500 text-olive-950 flex items-center justify-center mx-auto font-bold text-sm shadow-md ring-4 ring-gold-200">
                    <i class="fa-solid fa-feather text-xs"></i>
                </div>
                <h4 class="font-bold text-xs text-olive-950">2. Bench Preparation</h4>
                <p class="text-[11px] text-olive-700 font-semibold">Atelier Lasting</p>
            </div>

            <div class="space-y-2 opacity-60">
                <div class="w-10 h-10 rounded-full bg-zinc-100 text-zinc-400 border border-zinc-300 flex items-center justify-center mx-auto font-bold text-sm">
                    <i class="fa-solid fa-certificate text-xs"></i>
                </div>
                <h4 class="font-bold text-xs text-zinc-700">3. Wax Crest Inspection</h4>
                <p class="text-[11px] text-zinc-400">Quality verification</p>
            </div>

            <div class="space-y-2 opacity-60">
                <div class="w-10 h-10 rounded-full bg-zinc-100 text-zinc-400 border border-zinc-300 flex items-center justify-center mx-auto font-bold text-sm">
                    <i class="fa-solid fa-plane-departure text-xs"></i>
                </div>
                <h4 class="font-bold text-xs text-zinc-700">4. Courier Handover</h4>
                <p class="text-[11px] text-zinc-400">Insured air delivery</p>
            </div>
        </div>
    </div>

    <!-- Printable Invoice & Receipt Card -->
    <div class="bg-white rounded-2xl border border-zinc-200 shadow-md overflow-hidden print:border-none print:shadow-none">
        
        <div class="p-6 sm:p-8 border-b border-zinc-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-[#faf9f5]">
            <div>
                <span class="text-[10px] uppercase tracking-widest text-olive-700 font-bold">Official Acquisition Document</span>
                <h3 class="font-serif text-2xl font-bold text-olive-950">Order Invoice</h3>
                <p class="text-xs text-zinc-500 mt-0.5">Date: <?= htmlspecialchars($order['date']) ?></p>
            </div>
            
            <div class="flex items-center gap-3 print:hidden">
                <button onclick="window.print()" class="inline-flex items-center gap-2 bg-zinc-100 hover:bg-zinc-200 text-zinc-700 text-xs font-semibold py-2 px-4 rounded-lg border border-zinc-300 transition-colors">
                    <i class="fa-solid fa-print"></i>
                    <span>Print Receipt</span>
                </button>
                <a href="shop.php" class="inline-flex items-center gap-2 bg-olive-900 hover:bg-olive-950 text-gold-300 text-xs font-semibold py-2 px-4 rounded-lg transition-colors">
                    <span>Continue Browsing</span>
                </a>
            </div>
        </div>

        <!-- Recipient & Delivery Details -->
        <div class="p-6 sm:p-8 grid grid-cols-1 md:grid-cols-2 gap-8 border-b border-zinc-100 text-xs">
            <div>
                <h4 class="font-bold uppercase tracking-wider text-zinc-400 text-[10px] mb-2">Delivery Destination</h4>
                <div class="font-bold text-zinc-900 text-sm"><?= htmlspecialchars($order['customer']['customer_name']) ?></div>
                <p class="text-zinc-600 mt-1"><?= htmlspecialchars($order['customer']['shipping_address']) ?></p>
                <p class="text-zinc-600"><?= htmlspecialchars($order['customer']['shipping_city']) ?>, <?= htmlspecialchars($order['customer']['shipping_state'] ?? '') ?> <?= htmlspecialchars($order['customer']['shipping_postal_code']) ?></p>
                <p class="text-zinc-600"><?= htmlspecialchars($order['customer']['shipping_country']) ?></p>
                <p class="text-zinc-600 mt-2"><i class="fa-solid fa-phone text-olive-700 mr-1"></i> <?= htmlspecialchars($order['customer']['customer_phone']) ?></p>
                <p class="text-zinc-600"><i class="fa-solid fa-envelope text-olive-700 mr-1"></i> <?= htmlspecialchars($order['customer']['customer_email']) ?></p>
            </div>

            <div class="space-y-4">
                <div>
                    <h4 class="font-bold uppercase tracking-wider text-zinc-400 text-[10px] mb-1">Shipping Tier</h4>
                    <p class="text-zinc-800 font-semibold"><?= htmlspecialchars($order['customer']['shipping_method'] ?? 'Standard Ground Delivery') ?></p>
                    <p class="text-zinc-500 text-[11px]">Includes custom-fitted aromatic cedar shoe trees & dust bag</p>
                </div>

                <div>
                    <h4 class="font-bold uppercase tracking-wider text-zinc-400 text-[10px] mb-1">Payment Method</h4>
                    <p class="text-zinc-800 font-semibold capitalize"><?= htmlspecialchars($order['payment_method']) ?> (Paid / Authorized)</p>
                    <p class="text-zinc-500 text-[11px]">PCI-DSS Compliant Encrypted Settlement</p>
                </div>
            </div>
        </div>

        <!-- Items Breakdown -->
        <div class="p-6 sm:p-8">
            <h4 class="font-bold uppercase tracking-wider text-zinc-400 text-[10px] mb-4">Acquired Creations</h4>
            
            <div class="divide-y divide-zinc-100">
                <?php foreach ($order['items'] as $item): ?>
                    <div class="py-4 flex items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="w-14 h-14 object-cover rounded-lg border border-zinc-200">
                            <div>
                                <h5 class="font-serif font-bold text-sm text-zinc-900"><?= htmlspecialchars($item['name']) ?></h5>
                                <div class="text-[11px] text-zinc-500">EU Size <?= htmlspecialchars($item['size']) ?> &bull; Qty: <?= $item['quantity'] ?></div>
                            </div>
                        </div>
                        <div class="text-sm font-bold text-olive-950">
                            <?= format_price($item['price'] * $item['quantity']) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Totals -->
            <div class="border-t border-zinc-200 pt-6 mt-4 space-y-2 text-xs">
                <div class="flex justify-between text-zinc-600">
                    <span>Footwear Subtotal</span>
                    <span class="font-semibold text-zinc-900"><?= format_price($order['subtotal']) ?></span>
                </div>
                <div class="flex justify-between text-zinc-600">
                    <span>Shipping Fee</span>
                    <span class="font-semibold text-zinc-900">
                        <?= ($order['shipping_cost'] > 0) ? format_price($order['shipping_cost']) : '<span class="text-olive-700 font-bold">Complimentary</span>' ?>
                    </span>
                </div>
                <div class="flex justify-between text-zinc-600">
                    <span>Taxes & Customs</span>
                    <span class="text-zinc-500">Fully Paid</span>
                </div>
                <div class="flex justify-between text-base font-bold text-olive-950 pt-3 border-t border-zinc-200">
                    <span class="font-serif">Total Amount Paid</span>
                    <span class="font-serif text-xl"><?= format_price($order['total']) ?></span>
                </div>
            </div>
        </div>

    </div>

    <!-- Support Box -->
    <div class="text-center mt-12 text-xs text-zinc-500 space-y-2">
        <p>A copy of your official acquisition certificate and tracking ID has been dispatched to <strong><?= htmlspecialchars($order['customer']['customer_email']) ?></strong>.</p>
        <p>Need bespoke assistance? Contact our Concierge at <a href="mailto:<?= APP_EMAIL ?>" class="text-olive-800 underline"><?= APP_EMAIL ?></a> or call <?= APP_PHONE ?>.</p>
    </div>

</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
