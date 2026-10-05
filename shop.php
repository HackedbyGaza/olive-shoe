<?php
$pageTitle = "Footwear Catalog & Collections";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

$categoryId = isset($_GET['category']) && is_numeric($_GET['category']) ? (int)$_GET['category'] : null;
$sort = $_GET['sort'] ?? 'newest';
$search = trim($_GET['q'] ?? '');

$products = get_all_products($categoryId, $sort, $search);
$categories = get_categories();
?>

<!-- Shop Header Banner -->
<div class="bg-olive-950 py-12 border-b border-gold-500/20 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <nav class="text-xs text-gold-400/80 mb-2 flex items-center gap-2">
                    <a href="index.php" class="hover:text-gold-300">Home</a>
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    <span class="text-zinc-400">Footwear Catalog</span>
                </nav>
                <h1 class="font-serif text-3xl sm:text-4xl font-bold">The Olive & Gold Collections</h1>
            </div>
            <p class="text-xs text-zinc-400 max-w-md">
                Every silhouette is precision-balanced, fashioned in full-grain olive leather, and adorned with bespoke 14k gold-electroplated hardware.
            </p>
        </div>
    </div>
</div>

<!-- Main Shop Container -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex-1">
    
    <!-- Controls Bar (Filters & Sorting) -->
    <div class="bg-white p-4 sm:p-6 rounded-xl border border-zinc-200 shadow-sm mb-8 flex flex-col lg:flex-row items-center justify-between gap-4">
        
        <!-- Category Pills -->
        <div class="flex items-center gap-2 overflow-x-auto w-full lg:w-auto pb-2 lg:pb-0 scrollbar-none">
            <a href="shop.php" 
               class="px-4 py-2 rounded-full text-xs font-semibold uppercase tracking-wider whitespace-nowrap transition-all <?= !$categoryId ? 'bg-olive-900 text-gold-400 shadow' : 'bg-zinc-100 text-zinc-600 hover:bg-zinc-200' ?>">
                All Footwear (<?= count(get_all_products()) ?>)
            </a>
            <?php foreach ($categories as $cat): ?>
                <a href="shop.php?category=<?= $cat['id'] ?><?= $sort ? '&sort='.$sort : '' ?>" 
                   class="px-4 py-2 rounded-full text-xs font-semibold uppercase tracking-wider whitespace-nowrap transition-all <?= ($categoryId == $cat['id']) ? 'bg-olive-900 text-gold-400 shadow' : 'bg-zinc-100 text-zinc-600 hover:bg-zinc-200' ?>">
                    <?= htmlspecialchars($cat['name']) ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Sort & Search Status -->
        <div class="flex items-center justify-between w-full lg:w-auto gap-4">
            <span class="text-xs text-zinc-500 font-medium">
                Showing <strong class="text-zinc-900"><?= count($products) ?></strong> creations
            </span>

            <form method="GET" action="shop.php" class="flex items-center gap-2">
                <?php if ($categoryId): ?>
                    <input type="hidden" name="category" value="<?= $categoryId ?>">
                <?php endif; ?>
                <?php if ($search): ?>
                    <input type="hidden" name="q" value="<?= htmlspecialchars($search) ?>">
                <?php endif; ?>
                
                <select name="sort" onchange="this.form.submit()" 
                        class="bg-zinc-50 border border-zinc-300 rounded-lg text-xs py-2 px-3 focus:outline-none focus:ring-1 focus:ring-gold-500 text-zinc-700">
                    <option value="newest" <?= $sort === 'newest' ? 'selected' : '' ?>>Newest Arrivals</option>
                    <option value="price_asc" <?= $sort === 'price_asc' ? 'selected' : '' ?>>Price: Low to High</option>
                    <option value="price_desc" <?= $sort === 'price_desc' ? 'selected' : '' ?>>Price: High to Low</option>
                </select>
            </form>
        </div>

    </div>

    <!-- Active Search Filter Pill -->
    <?php if ($search): ?>
        <div class="mb-6 flex items-center gap-3">
            <span class="text-xs text-zinc-500">Searching for: <strong>"<?= htmlspecialchars($search) ?>"</strong></span>
            <a href="shop.php<?= $categoryId ? '?category='.$categoryId : '' ?>" class="text-xs text-gold-600 hover:underline">
                <i class="fa-solid fa-xmark mr-1"></i> Clear search
            </a>
        </div>
    <?php endif; ?>

    <!-- Product Grid -->
    <?php if (empty($products)): ?>
        <div class="text-center py-24 bg-white rounded-2xl border border-zinc-200">
            <div class="w-16 h-16 rounded-full bg-olive-50 text-olive-800 flex items-center justify-center mx-auto text-2xl mb-4">
                <i class="fa-solid fa-shoe-prints"></i>
            </div>
            <h3 class="font-serif text-xl font-bold text-olive-950 mb-2">No Footwear Found</h3>
            <p class="text-xs text-zinc-500 max-w-sm mx-auto mb-6">We could not find any models matching your criteria. Explore our full catalog or contact the concierge for custom bespoke requests.</p>
            <a href="shop.php" class="inline-flex items-center gap-2 bg-olive-900 text-gold-400 text-xs font-semibold px-6 py-3 rounded-lg hover:bg-olive-950">
                <span>View All Shoes</span>
            </a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($products as $item): ?>
                <div class="group bg-white rounded-xl overflow-hidden border border-zinc-200/90 hover:border-gold-500/70 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col">
                    
                    <!-- Image -->
                    <div class="relative overflow-hidden bg-zinc-100 aspect-square">
                        <img src="<?= htmlspecialchars($item['image_url']) ?>" 
                             alt="<?= htmlspecialchars($item['name']) ?>" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        
                        <!-- Badges -->
                        <div class="absolute top-3 left-3 flex flex-col gap-1.5">
                            <?php if (!empty($item['is_new'])): ?>
                                <span class="bg-olive-950 text-gold-400 text-[10px] font-bold tracking-wider uppercase px-2.5 py-0.5 rounded shadow">
                                    New Edition
                                </span>
                            <?php endif; ?>
                            <?php if (!empty($item['sale_price'])): ?>
                                <span class="bg-gold-500 text-olive-950 text-[10px] font-bold tracking-wider uppercase px-2.5 py-0.5 rounded shadow">
                                    Special Offer
                                </span>
                            <?php endif; ?>
                        </div>

                        <!-- Quick Size Preview -->
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-olive-950/80 to-transparent p-3 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                            <span class="text-[10px] uppercase tracking-wider text-gold-300 font-semibold block text-center">
                                Available Sizes (EU): <?= htmlspecialchars($item['available_sizes'] ?? '39 - 45') ?>
                            </span>
                        </div>
                    </div>

                    <!-- Details Body -->
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                        <div>
                            <div class="flex items-center justify-between text-xs mb-1.5">
                                <span class="text-[11px] font-semibold tracking-wider uppercase text-olive-700">
                                    <?= htmlspecialchars($item['category_name']) ?>
                                </span>
                                <span class="text-gold-600 text-xs font-medium flex items-center gap-1">
                                    <i class="fa-solid fa-star text-[10px]"></i> <?= $item['rating'] ?>
                                </span>
                            </div>

                            <h3 class="font-serif font-bold text-lg text-zinc-900 group-hover:text-olive-700 transition-colors">
                                <a href="product.php?id=<?= $item['id'] ?>"><?= htmlspecialchars($item['name']) ?></a>
                            </h3>
                            
                            <p class="text-xs text-zinc-500 mt-2 line-clamp-2 leading-relaxed">
                                <?= htmlspecialchars($item['short_description']) ?>
                            </p>
                            
                            <div class="mt-3 text-[11px] text-zinc-600 flex items-center gap-3">
                                <span><i class="fa-solid fa-palette text-gold-500 mr-1"></i> <?= htmlspecialchars($item['color'] ?? 'Olive & Gold') ?></span>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-zinc-100 flex items-center justify-between">
                            <div>
                                <?php if (!empty($item['sale_price'])): ?>
                                    <div class="text-base font-bold text-olive-950"><?= format_price($item['sale_price']) ?></div>
                                    <div class="text-xs text-zinc-400 line-through"><?= format_price($item['price']) ?></div>
                                <?php else: ?>
                                    <div class="text-base font-bold text-olive-950"><?= format_price($item['price']) ?></div>
                                <?php endif; ?>
                            </div>

                            <a href="product.php?id=<?= $item['id'] ?>" 
                               class="inline-flex items-center gap-2 bg-olive-900 hover:bg-gold-500 text-gold-300 hover:text-olive-950 text-xs font-semibold py-2.5 px-4 rounded-lg transition-all duration-200 shadow-sm">
                                <span>Select Size</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
