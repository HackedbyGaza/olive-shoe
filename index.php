<?php
$pageTitle = "Artisanal Footwear in Olive & Gold";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

$featuredProducts = get_featured_products(4);
$categories = get_categories();
?>

<!-- Hero Section -->
<section class="relative bg-olive-950 text-white overflow-hidden py-24 lg:py-32 border-b border-gold-500/20">
    <!-- Ambient Gold & Olive Glow -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-olive-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 -right-40 w-96 h-96 bg-gold-500/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Copy -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 bg-olive-900/80 border border-gold-500/40 px-3.5 py-1.5 rounded-full text-gold-300 text-xs font-semibold tracking-widest uppercase shadow-md">
                    <span class="w-2 h-2 rounded-full bg-gold-400 animate-pulse"></span>
                    Autumn / Winter Haute Collection
                </div>

                <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white leading-[1.15]">
                    Where Master Craft Meets <span class="gold-gradient-text italic font-normal">Burnished Gold</span>
                </h1>

                <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 font-light leading-relaxed">
                    Sculpted from select Italian olive calfskin and elevated with handcrafted gold-tone accents. Discover footwear designed to command attention with quiet majesty.
                </p>

                <!-- CTAs -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-4">
                    <a href="shop.php" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 rounded-md text-xs font-bold tracking-widest uppercase bg-gold-500 hover:bg-gold-400 text-olive-950 shadow-lg hover:shadow-gold-500/30 hover:scale-[1.02] transition-all duration-200">
                        <span>Explore Collection</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                    <a href="#artisan" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 rounded-md text-xs font-bold tracking-widest uppercase border border-gold-500/40 text-gold-300 hover:bg-olive-900/60 hover:border-gold-400 transition-all duration-200">
                        <span>Our Craftsmanship</span>
                    </a>
                </div>

                <!-- Trust Micro-Badges -->
                <div class="pt-6 border-t border-olive-900 flex flex-wrap items-center justify-center lg:justify-start gap-6 text-xs text-zinc-400">
                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-check text-gold-400"></i> Benchmade Goodyear Welt
                    </span>
                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-check text-gold-400"></i> 100% Full-Grain Olive Leather
                    </span>
                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-check text-gold-400"></i> Free Global Express Shipping
                    </span>
                </div>
            </div>

            <!-- Right Showcase Visual -->
            <div class="lg:col-span-5 relative">
                <div class="relative mx-auto max-w-md lg:max-w-none">
                    <!-- Decorative Golden Frame -->
                    <div class="absolute -inset-2 rounded-2xl bg-gradient-to-tr from-gold-600/30 to-olive-600/20 blur-md"></div>
                    
                    <div class="relative rounded-2xl overflow-hidden border border-gold-500/50 shadow-2xl bg-olive-900">
                        <img src="https://images.unsplash.com/photo-1533867617858-e7b97e060509?auto=format&fit=crop&w=800&q=80" 
                             alt="The Sovereign Olive Penny Loafer" 
                             class="w-full h-[440px] object-cover object-center transform hover:scale-105 transition-transform duration-700">
                        
                        <!-- Floating Highlight Card -->
                        <div class="absolute bottom-4 left-4 right-4 bg-olive-950/90 backdrop-blur-md border border-gold-500/40 p-4 rounded-xl flex items-center justify-between shadow-xl">
                            <div>
                                <span class="text-[10px] uppercase tracking-widest text-gold-400 font-semibold">Signature Atelier Edition</span>
                                <h3 class="font-serif text-white font-medium text-sm">The Sovereign Penny Loafer</h3>
                                <div class="text-gold-300 text-xs font-bold">$385.00 USD</div>
                            </div>
                            <a href="product.php?id=1" class="bg-gold-500 hover:bg-gold-400 text-olive-950 p-2.5 rounded-lg text-xs font-bold transition-colors">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Curated Categories -->
<section class="py-20 bg-[#f7f6f0]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14 space-y-3">
            <span class="text-xs font-bold tracking-widest text-olive-700 uppercase">Curated Portfolios</span>
            <h2 class="font-serif text-3xl sm:text-4xl font-bold text-olive-950">Categories of Distinction</h2>
            <div class="w-16 h-0.5 bg-gold-500 mx-auto"></div>
            <p class="text-sm text-zinc-600">Engineered with timeless proportions, custom shoe lasts, and signature olive patina.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($categories as $cat): ?>
                <a href="shop.php?category=<?= $cat['id'] ?>" class="group block relative rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 bg-white border border-zinc-200 hover:border-gold-500/60">
                    <div class="h-64 overflow-hidden relative">
                        <img src="<?= htmlspecialchars($cat['image_url'] ?? 'https://images.unsplash.com/photo-1549298916-b41d501d3772?auto=format&fit=crop&w=600&q=80') ?>" 
                             alt="<?= htmlspecialchars($cat['name']) ?>" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-olive-950/90 via-olive-950/30 to-transparent"></div>
                        
                        <div class="absolute bottom-4 left-4 right-4 text-white">
                            <h3 class="font-serif text-lg font-bold group-hover:text-gold-300 transition-colors">
                                <?= htmlspecialchars($cat['name']) ?>
                            </h3>
                            <span class="text-xs text-gold-400 font-medium inline-flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                                View Collection <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            </span>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Featured Handcrafted Footwear -->
<section class="py-20 bg-white border-t border-zinc-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-4">
            <div>
                <span class="text-xs font-bold tracking-widest text-olive-700 uppercase">Master Works</span>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-olive-950 mt-1">Featured Creations</h2>
                <div class="w-16 h-0.5 bg-gold-500 mt-3"></div>
            </div>
            <a href="shop.php" class="inline-flex items-center gap-2 text-xs font-bold tracking-widest uppercase text-olive-800 hover:text-gold-600 transition-colors">
                <span>Browse All Models</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach ($featuredProducts as $item): ?>
                <div class="group bg-[#faf9f5] rounded-xl overflow-hidden border border-zinc-200/80 hover:border-gold-500/60 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col">
                    
                    <!-- Image Card -->
                    <div class="relative overflow-hidden bg-zinc-100 aspect-square">
                        <img src="<?= htmlspecialchars($item['image_url']) ?>" 
                             alt="<?= htmlspecialchars($item['name']) ?>" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        
                        <!-- Badges -->
                        <div class="absolute top-3 left-3 flex flex-col gap-1.5">
                            <?php if (!empty($item['is_new'])): ?>
                                <span class="bg-olive-900 text-gold-300 text-[10px] font-bold tracking-wider uppercase px-2.5 py-0.5 rounded shadow">
                                    New Edition
                                </span>
                            <?php endif; ?>
                            <?php if (!empty($item['sale_price'])): ?>
                                <span class="bg-gold-500 text-olive-950 text-[10px] font-bold tracking-wider uppercase px-2.5 py-0.5 rounded shadow">
                                    Atelier Sale
                                </span>
                            <?php endif; ?>
                        </div>

                        <!-- Quick Action overlay -->
                        <div class="absolute inset-x-0 bottom-3 px-3 translate-y-12 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 flex gap-2">
                            <a href="product.php?id=<?= $item['id'] ?>" 
                               class="w-full text-center bg-olive-900/90 hover:bg-olive-950 text-white text-xs font-semibold py-2.5 px-4 rounded-lg shadow backdrop-blur transition-colors">
                                View Details
                            </a>
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <span class="text-[11px] uppercase tracking-wider text-olive-600 font-semibold block mb-1">
                                <?= htmlspecialchars($item['category_name']) ?>
                            </span>
                            <h3 class="font-serif font-bold text-base text-zinc-900 group-hover:text-olive-700 transition-colors line-clamp-1">
                                <a href="product.php?id=<?= $item['id'] ?>"><?= htmlspecialchars($item['name']) ?></a>
                            </h3>
                            <p class="text-xs text-zinc-500 mt-1 line-clamp-2 leading-relaxed">
                                <?= htmlspecialchars($item['short_description']) ?>
                            </p>
                        </div>

                        <div class="pt-4 mt-4 border-t border-zinc-200/80 flex items-center justify-between">
                            <div>
                                <?php if (!empty($item['sale_price'])): ?>
                                    <span class="text-sm font-bold text-olive-900"><?= format_price($item['sale_price']) ?></span>
                                    <span class="text-xs text-zinc-400 line-through ml-1"><?= format_price($item['price']) ?></span>
                                <?php else: ?>
                                    <span class="text-sm font-bold text-olive-900"><?= format_price($item['price']) ?></span>
                                <?php endif; ?>
                            </div>
                            <span class="text-xs text-gold-600 font-medium flex items-center gap-1">
                                <i class="fa-solid fa-star text-[10px]"></i> <?= $item['rating'] ?>
                            </span>
                        </div>

                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Craftsmanship Story Section -->
<section id="artisan" class="py-24 bg-olive-950 text-white relative overflow-hidden border-t border-gold-500/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <div class="space-y-6">
                <span class="text-xs font-bold tracking-widest text-gold-400 uppercase">The Atelier Philosophy</span>
                <h2 class="font-serif text-3xl sm:text-5xl font-bold leading-tight">
                    The Sacred Union of <br><span class="gold-gradient-text italic font-normal">Olive Leather & Pure Gold</span>
                </h2>
                <p class="text-sm sm:text-base text-zinc-300 leading-relaxed font-light">
                    At Olive Shoe, we reject the disposable nature of modern fast fashion. Every pair begins with select Tuscan hides, submerged in natural olive tree leaf extracts through our sustainable tanning protocol.
                </p>
                
                <div class="space-y-4 pt-2">
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 rounded-full bg-olive-900 border border-gold-500/50 flex items-center justify-center text-gold-400 flex-shrink-0 mt-1">
                            <i class="fa-solid fa-feather text-xs"></i>
                        </div>
                        <div>
                            <h4 class="font-serif font-bold text-white text-base">Hand-Patinated Olive Tones</h4>
                            <p class="text-xs text-zinc-400 mt-0.5">Layers of proprietary wax dyes applied by brush to produce deep emerald and forest olive gradations.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 rounded-full bg-olive-900 border border-gold-500/50 flex items-center justify-center text-gold-400 flex-shrink-0 mt-1">
                            <i class="fa-solid fa-shield text-xs"></i>
                        </div>
                        <div>
                            <h4 class="font-serif font-bold text-white text-base">Electroplated Solid Gold Hardware</h4>
                            <p class="text-xs text-zinc-400 mt-0.5">Buckles, eyelets, and vamp straps forged in brass and electroplated in 14k gold for rust-proof brilliance.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 rounded-full bg-olive-900 border border-gold-500/50 flex items-center justify-center text-gold-400 flex-shrink-0 mt-1">
                            <i class="fa-solid fa-hammer text-xs"></i>
                        </div>
                        <div>
                            <h4 class="font-serif font-bold text-white text-base">Benchmade Goodyear Welt Construction</h4>
                            <p class="text-xs text-zinc-400 mt-0.5">Constructed with cork filling that contours to the sole of your foot, easily resoleable for decades of wear.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <a href="shop.php" class="inline-flex items-center gap-3 px-8 py-3.5 rounded text-xs font-bold tracking-widest uppercase bg-gold-500 hover:bg-gold-400 text-olive-950 transition-all">
                        Experience The Craft
                    </a>
                </div>
            </div>

            <!-- Visual Artistry -->
            <div class="grid grid-cols-2 gap-4">
                <img src="https://images.unsplash.com/photo-1614252235316-8c857d38b5f4?auto=format&fit=crop&w=600&q=80" 
                     alt="Shoemaker at work" class="rounded-xl object-cover h-72 w-full border border-gold-500/30 shadow-lg">
                <img src="https://images.unsplash.com/photo-1608256246200-53e635b5b65f?auto=format&fit=crop&w=600&q=80" 
                     alt="Handmade leather shoes" class="rounded-xl object-cover h-72 w-full mt-8 border border-gold-500/30 shadow-lg">
            </div>

        </div>
    </div>
</section>

<!-- Reviews & Accolades -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-xs font-bold tracking-widest text-olive-700 uppercase">Patron Testimonials</span>
        <h2 class="font-serif text-3xl font-bold text-olive-950 mt-1 mb-12">Words of Acclaim</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
            <div class="bg-[#faf9f5] p-8 rounded-xl border border-zinc-200 space-y-4">
                <div class="text-gold-500 flex gap-1">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-sm text-zinc-600 italic">"The Sovereign Loafers in deep olive are unlike anything in my collection. The gold horsebit detail is subtle yet radiant. Outstanding comfort straight out of the box."</p>
                <div>
                    <h4 class="font-bold text-sm text-olive-950">Julian Vance</h4>
                    <span class="text-xs text-zinc-400">London, United Kingdom</span>
                </div>
            </div>

            <div class="bg-[#faf9f5] p-8 rounded-xl border border-zinc-200 space-y-4">
                <div class="text-gold-500 flex gap-1">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-sm text-zinc-600 italic">"Packaging alone felt like receiving jewelry. The cedar trees, handwritten card, and the olive patina on the Aureus boots are world-class."</p>
                <div>
                    <h4 class="font-bold text-sm text-olive-950">Marcus Sterling</h4>
                    <span class="text-xs text-zinc-400">New York, USA</span>
                </div>
            </div>

            <div class="bg-[#faf9f5] p-8 rounded-xl border border-zinc-200 space-y-4">
                <div class="text-gold-500 flex gap-1">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-sm text-zinc-600 italic">"I wore the Gilded Monks to my wedding gala. Received compliments throughout the night. The olive hue pairs exquisitely with navy and charcoal suits."</p>
                <div>
                    <h4 class="font-bold text-sm text-olive-950">Alessandro Rossi</h4>
                    <span class="text-xs text-zinc-400">Milan, Italy</span>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
