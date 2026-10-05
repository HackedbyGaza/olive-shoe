<?php
require_once __DIR__ . '/includes/functions.php';

$productId = $_GET['id'] ?? null;
$product = $productId ? get_product($productId) : null;

if (!$product) {
    header('Location: shop.php');
    exit;
}

$pageTitle = $product['name'];
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

$sizes = explode(',', $product['available_sizes'] ?? '39,40,41,42,43,44,45');
$relatedProducts = array_filter(get_all_products($product['category_id']), fn($p) => $p['id'] != $product['id']);
$relatedProducts = array_slice($relatedProducts, 0, 3);
?>

<div class="bg-white border-b border-zinc-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav class="text-xs text-zinc-500 flex items-center gap-2">
            <a href="index.php" class="hover:text-olive-800">Home</a>
            <i class="fa-solid fa-chevron-right text-[9px] text-zinc-400"></i>
            <a href="shop.php" class="hover:text-olive-800">Footwear</a>
            <i class="fa-solid fa-chevron-right text-[9px] text-zinc-400"></i>
            <a href="shop.php?category=<?= $product['category_id'] ?>" class="hover:text-olive-800"><?= htmlspecialchars($product['category_name']) ?></a>
            <i class="fa-solid fa-chevron-right text-[9px] text-zinc-400"></i>
            <span class="text-zinc-800 font-medium truncate max-w-xs"><?= htmlspecialchars($product['name']) ?></span>
        </nav>
    </div>
</div>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex-1">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        
        <!-- Left: Product Image Gallery -->
        <div class="lg:col-span-7 space-y-4">
            <div class="bg-zinc-100 rounded-2xl overflow-hidden border border-zinc-200 shadow-sm relative group aspect-[4/3] sm:aspect-[1/1]">
                <img id="mainProductImage" 
                     src="<?= htmlspecialchars($product['image_url']) ?>" 
                     alt="<?= htmlspecialchars($product['name']) ?>" 
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                
                <div class="absolute top-4 left-4 flex flex-col gap-2">
                    <?php if (!empty($product['is_new'])): ?>
                        <span class="bg-olive-950 text-gold-400 text-xs font-bold uppercase tracking-wider px-3 py-1 rounded shadow-md">
                            Atelier Release
                        </span>
                    <?php endif; ?>
                    <?php if (!empty($product['sale_price'])): ?>
                        <span class="bg-gold-500 text-olive-950 text-xs font-bold uppercase tracking-wider px-3 py-1 rounded shadow-md">
                            Special Price
                        </span>
                    <?php endif; ?>
                </div>

                <div class="absolute bottom-4 right-4 bg-olive-950/80 backdrop-blur text-gold-300 text-xs px-3 py-1.5 rounded-full border border-gold-500/30 flex items-center gap-1.5">
                    <i class="fa-solid fa-certificate text-gold-400"></i> Handcrafted in Italy
                </div>
            </div>

            <!-- Trust Features Row -->
            <div class="grid grid-cols-3 gap-4 pt-4 text-center">
                <div class="p-3 bg-[#f7f6f0] rounded-xl border border-zinc-200">
                    <i class="fa-solid fa-box text-olive-700 text-base mb-1"></i>
                    <p class="text-[11px] font-bold text-zinc-800">Cedar Trees Included</p>
                    <p class="text-[10px] text-zinc-500">Free with every pair</p>
                </div>
                <div class="p-3 bg-[#f7f6f0] rounded-xl border border-zinc-200">
                    <i class="fa-solid fa-rotate-left text-olive-700 text-base mb-1"></i>
                    <p class="text-[11px] font-bold text-zinc-800">30-Day Sizing Guarantee</p>
                    <p class="text-[10px] text-zinc-500">Complimentary exchange</p>
                </div>
                <div class="p-3 bg-[#f7f6f0] rounded-xl border border-zinc-200">
                    <i class="fa-solid fa-plane-departure text-olive-700 text-base mb-1"></i>
                    <p class="text-[11px] font-bold text-zinc-800">Insured Worldwide</p>
                    <p class="text-[10px] text-zinc-500">Tracked air express</p>
                </div>
            </div>
        </div>

        <!-- Right: Purchase Controls & Specs -->
        <div class="lg:col-span-5 space-y-6">
            
            <div>
                <span class="text-xs font-bold tracking-widest uppercase text-olive-700"><?= htmlspecialchars($product['category_name']) ?></span>
                <h1 class="font-serif text-3xl sm:text-4xl font-bold text-olive-950 mt-1"><?= htmlspecialchars($product['name']) ?></h1>
                
                <div class="flex items-center gap-3 mt-3">
                    <div class="flex items-center text-gold-500 text-xs">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <span class="text-xs text-zinc-500 font-medium"><?= $product['rating'] ?> rating (48 verified owners)</span>
                </div>
            </div>

            <!-- Price -->
            <div class="flex items-baseline gap-3 py-3 border-y border-zinc-200">
                <?php if (!empty($product['sale_price'])): ?>
                    <span class="text-3xl font-bold text-olive-900"><?= format_price($product['sale_price']) ?></span>
                    <span class="text-lg text-zinc-400 line-through"><?= format_price($product['price']) ?></span>
                    <span class="text-xs font-semibold text-gold-700 bg-gold-100 px-2 py-0.5 rounded ml-2">Save <?= format_price($product['price'] - $product['sale_price']) ?></span>
                <?php else: ?>
                    <span class="text-3xl font-bold text-olive-900"><?= format_price($product['price']) ?></span>
                <?php endif; ?>
                <span class="text-xs text-zinc-500 ml-auto font-medium">Taxes & Duties Calculated at Checkout</span>
            </div>

            <!-- Description -->
            <p class="text-sm text-zinc-600 leading-relaxed">
                <?= nl2br(htmlspecialchars($product['description'])) ?>
            </p>

            <!-- Color & Material Badges -->
            <div class="space-y-3 bg-[#faf9f5] p-4 rounded-xl border border-zinc-200 text-xs">
                <div class="flex items-center justify-between">
                    <span class="text-zinc-500">Color Palette:</span>
                    <span class="font-semibold text-olive-950 flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded-full bg-olive-800 border border-gold-400"></span>
                        <?= htmlspecialchars($product['color']) ?>
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-zinc-500">Upper Leather:</span>
                    <span class="font-semibold text-olive-950"><?= htmlspecialchars($product['material']) ?></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-zinc-500">Hardware:</span>
                    <span class="font-semibold text-gold-700">14k Electroplated Gold Finish</span>
                </div>
            </div>

            <!-- Add to Cart Form -->
            <form action="cart.php" method="POST" class="space-y-6 pt-2">
                <input type="hidden" name="action" value="add">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

                <!-- Size Selector -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="text-xs font-bold uppercase tracking-wider text-zinc-800">Select European Size (EU)</label>
                        <a href="#sizing-guide" class="text-xs text-olive-700 hover:text-gold-600 underline font-medium">Size Calculator</a>
                    </div>
                    
                    <div class="grid grid-cols-4 sm:grid-cols-7 gap-2">
                        <?php foreach ($sizes as $idx => $s): $s = trim($s); ?>
                            <label class="cursor-pointer">
                                <input type="radio" name="size" value="<?= $s ?>" <?= $idx === 1 ? 'checked' : '' ?> class="peer sr-only" required>
                                <div class="py-2.5 text-center text-xs font-bold rounded-lg border border-zinc-300 peer-checked:border-gold-500 peer-checked:bg-olive-900 peer-checked:text-gold-300 hover:border-gold-400 transition-all">
                                    <?= $s ?>
                                </div>
                            </label>
                        <?php endforeach; ?>
                    </div>
                    <p class="text-[11px] text-zinc-500 mt-2 flex items-center gap-1.5">
                        <i class="fa-solid fa-circle-info text-olive-700"></i> Standard Italian Last fit. If between sizes, choose your usual dress shoe size.
                    </p>
                </div>

                <!-- Quantity & Buttons -->
                <div class="flex flex-col sm:flex-row items-stretch gap-3">
                    
                    <!-- Quantity Input -->
                    <div class="flex items-center border border-zinc-300 rounded-lg overflow-hidden bg-white sm:w-32 justify-between">
                        <button type="button" onclick="const q=document.getElementById('qty'); if(q.value>1) q.value--;" class="px-3 py-3 text-zinc-600 hover:bg-zinc-100"><i class="fa-solid fa-minus text-xs"></i></button>
                        <input type="number" id="qty" name="quantity" value="1" min="1" max="10" class="w-12 text-center text-xs font-bold text-zinc-900 focus:outline-none bg-transparent">
                        <button type="button" onclick="const q=document.getElementById('qty'); q.value++;" class="px-3 py-3 text-zinc-600 hover:bg-zinc-100"><i class="fa-solid fa-plus text-xs"></i></button>
                    </div>

                    <!-- Add to Bag -->
                    <button type="submit" 
                            class="flex-1 bg-olive-900 hover:bg-olive-950 text-gold-300 hover:text-gold-200 border border-gold-500/50 py-3.5 px-6 rounded-lg text-xs font-bold tracking-widest uppercase flex items-center justify-center gap-2 shadow-lg transition-all hover:scale-[1.01]">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <span>Add To Bag</span>
                    </button>

                </div>

            </form>

            <!-- Accordion Details -->
            <div class="space-y-3 pt-6 border-t border-zinc-200 text-xs">
                
                <details class="group bg-white p-4 rounded-xl border border-zinc-200" open>
                    <summary class="font-bold text-zinc-800 cursor-pointer flex items-center justify-between list-none">
                        <span class="flex items-center gap-2"><i class="fa-solid fa-hammer text-gold-600"></i> Craftsmanship & Materials</span>
                        <i class="fa-solid fa-chevron-down text-zinc-400 group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <p class="text-zinc-600 mt-3 leading-relaxed">
                        Hand-built using full-grain Tuscan calfskin leather tanned in natural olive leaf extracts. Fitted with Goodyear welted dual leather outsoles, solid brass gold-plated hardware, and cork footbeds that mold to your foot contours over time.
                    </p>
                </details>

                <details class="group bg-white p-4 rounded-xl border border-zinc-200">
                    <summary class="font-bold text-zinc-800 cursor-pointer flex items-center justify-between list-none">
                        <span class="flex items-center gap-2"><i class="fa-solid fa-truck-fast text-gold-600"></i> Shipping & Delivery Timeline</span>
                        <i class="fa-solid fa-chevron-down text-zinc-400 group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <p class="text-zinc-600 mt-3 leading-relaxed">
                        Orders are dispatched in signature Olive Shoe velvet-lined boxes with solid cedar shoe trees and cotton dust bags. Standard insured ground delivery arrives in 3-5 business days; Express air courier arrives in 1-2 business days.
                    </p>
                </details>

                <details class="group bg-white p-4 rounded-xl border border-zinc-200">
                    <summary class="font-bold text-zinc-800 cursor-pointer flex items-center justify-between list-none">
                        <span class="flex items-center gap-2"><i class="fa-solid fa-shield-halved text-gold-600"></i> Atelier Guarantee & Returns</span>
                        <i class="fa-solid fa-chevron-down text-zinc-400 group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <p class="text-zinc-600 mt-3 leading-relaxed">
                        If your sizing is not impeccably tailored, we provide complimentary size swaps within 30 days of receipt. All pairs include lifetime welt resoling support through our master repair network.
                    </p>
                </details>

            </div>

        </div>

    </div>

    <!-- Related Footwear Suggestions -->
    <?php if (!empty($relatedProducts)): ?>
        <div class="mt-24 pt-12 border-t border-zinc-200">
            <h3 class="font-serif text-2xl font-bold text-olive-950 mb-8">Complementary Creations</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <?php foreach ($relatedProducts as $rel): ?>
                    <div class="bg-white rounded-xl overflow-hidden border border-zinc-200 hover:border-gold-500/60 shadow-sm transition-all group p-4 flex gap-4 items-center">
                        <img src="<?= htmlspecialchars($rel['image_url']) ?>" alt="<?= htmlspecialchars($rel['name']) ?>" class="w-20 h-20 object-cover rounded-lg">
                        <div class="flex-1">
                            <h4 class="font-serif font-bold text-sm text-zinc-900 group-hover:text-olive-700 line-clamp-1">
                                <a href="product.php?id=<?= $rel['id'] ?>"><?= htmlspecialchars($rel['name']) ?></a>
                            </h4>
                            <div class="text-xs font-bold text-olive-900 mt-1"><?= format_price($rel['sale_price'] ?? $rel['price']) ?></div>
                            <a href="product.php?id=<?= $rel['id'] ?>" class="text-[11px] text-gold-600 font-semibold hover:underline mt-1 inline-block">
                                View Details &rarr;
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
