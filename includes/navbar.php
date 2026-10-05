<!-- Announcement Banner -->
<div class="bg-olive-950 text-gold-300 text-xs tracking-widest py-2 px-4 border-b border-gold-500/20">
    <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center text-center gap-2">
        <p class="flex items-center gap-2">
            <i class="fa-solid fa-crown text-gold-400"></i>
            <span>COMPLIMENTARY INSURED EXPRESS SHIPPING & CEDAR SHOE TREES ON ORDERS OVER $300</span>
        </p>
        <div class="hidden md:flex items-center gap-4 text-zinc-400 text-[11px]">
            <span><i class="fa-solid fa-phone text-gold-500/70 mr-1"></i> <?= APP_PHONE ?></span>
            <span>|</span>
            <span class="hover:text-gold-400 cursor-pointer">Global Concierge</span>
        </div>
    </div>
</div>

<!-- Main Luxury Navigation Header -->
<header class="sticky top-0 z-50 bg-olive-900/95 backdrop-blur-md border-b border-gold-500/30 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            
            <!-- Mobile Menu Button -->
            <div class="flex items-center lg:hidden">
                <button type="button" id="mobileMenuBtn" class="text-gold-300 hover:text-gold-400 p-2 focus:outline-none">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
            </div>

            <!-- Brand Logo -->
            <div class="flex-shrink-0 flex items-center gap-3">
                <a href="index.php" class="group flex items-center gap-3">
                    <div class="w-11 h-11 rounded-full bg-olive-950 border border-gold-500/60 flex items-center justify-center text-gold-400 shadow-lg group-hover:border-gold-400 group-hover:scale-105 transition-all">
                        <i class="fa-solid fa-leaf text-lg"></i>
                    </div>
                    <div>
                        <span class="font-serif text-2xl font-bold tracking-wider text-white group-hover:text-gold-300 transition-colors">
                            OLIVE <span class="gold-gradient-text font-normal">SHOE</span>
                        </span>
                        <span class="block text-[10px] tracking-[0.25em] text-gold-400/80 uppercase font-sans -mt-1">
                            Fine Footwear Atelier
                        </span>
                    </div>
                </a>
            </div>

            <!-- Desktop Nav Links -->
            <nav class="hidden lg:flex items-center space-x-8">
                <a href="index.php" class="text-sm font-medium tracking-wide uppercase text-zinc-200 hover:text-gold-400 transition-colors">Home</a>
                <a href="shop.php" class="text-sm font-medium tracking-wide uppercase text-zinc-200 hover:text-gold-400 transition-colors">All Collections</a>
                <a href="shop.php?category=1" class="text-sm font-medium tracking-wide uppercase text-zinc-200 hover:text-gold-400 transition-colors">Loafers</a>
                <a href="shop.php?category=2" class="text-sm font-medium tracking-wide uppercase text-zinc-200 hover:text-gold-400 transition-colors">Boots</a>
                <a href="shop.php?category=3" class="text-sm font-medium tracking-wide uppercase text-zinc-200 hover:text-gold-400 transition-colors">Oxfords</a>
                <a href="index.php#artisan" class="text-sm font-medium tracking-wide uppercase text-zinc-200 hover:text-gold-400 transition-colors">Craftsmanship</a>
            </nav>

            <!-- Actions (Search & Cart) -->
            <div class="flex items-center space-x-5">
                
                <!-- Quick Search Form -->
                <form action="shop.php" method="GET" class="hidden md:flex items-center relative">
                    <input type="text" name="q" placeholder="Search footwear..." 
                           class="bg-olive-950/70 border border-olive-700 focus:border-gold-500 rounded-full py-1.5 pl-4 pr-9 text-xs text-zinc-200 placeholder-zinc-400 focus:outline-none focus:ring-1 focus:ring-gold-500 transition-all w-40 lg:w-48">
                    <button type="submit" class="absolute right-3 text-gold-400/80 hover:text-gold-300">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </button>
                </form>

                <!-- Cart Button -->
                <a href="cart.php" class="relative group flex items-center gap-2 bg-olive-950 border border-gold-500/50 hover:border-gold-400 text-zinc-100 hover:text-gold-300 px-4 py-2 rounded-full transition-all duration-200 shadow-md">
                    <i class="fa-solid fa-bag-shopping text-gold-400 text-sm group-hover:scale-110 transition-transform"></i>
                    <span class="text-xs font-semibold tracking-wider uppercase hidden sm:inline">Bag</span>
                    <span class="bg-gold-500 text-olive-950 text-[11px] font-bold px-2 py-0.5 rounded-full min-w-[20px] text-center">
                        <?= $cartCount ?>
                    </span>
                </a>
            </div>

        </div>
    </div>

    <!-- Mobile Drawer Menu -->
    <div id="mobileMenu" class="hidden lg:hidden bg-olive-950 border-b border-gold-500/30 px-6 py-6 space-y-4">
        <form action="shop.php" method="GET" class="mb-4">
            <div class="relative">
                <input type="text" name="q" placeholder="Search shoes..." class="w-full bg-olive-900 border border-gold-500/40 rounded-lg py-2 pl-4 pr-10 text-sm text-white placeholder-zinc-400 focus:outline-none">
                <button type="submit" class="absolute right-3 top-2.5 text-gold-400"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
        <div class="flex flex-col space-y-3 font-medium text-zinc-200">
            <a href="index.php" class="hover:text-gold-400 py-1 border-b border-olive-800">Home</a>
            <a href="shop.php" class="hover:text-gold-400 py-1 border-b border-olive-800">Complete Catalog</a>
            <a href="shop.php?category=1" class="hover:text-gold-400 py-1 border-b border-olive-800">Artisan Loafers</a>
            <a href="shop.php?category=2" class="hover:text-gold-400 py-1 border-b border-olive-800">Heritage Boots</a>
            <a href="shop.php?category=3" class="hover:text-gold-400 py-1 border-b border-olive-800">Formal Oxford & Derby</a>
            <a href="shop.php?category=4" class="hover:text-gold-400 py-1 border-b border-olive-800">Luxury Sneakers</a>
            <a href="cart.php" class="text-gold-400 py-1 flex items-center justify-between">
                <span>Your Shopping Bag</span>
                <span class="bg-gold-500 text-olive-950 text-xs px-2 py-0.5 rounded-full font-bold"><?= $cartCount ?></span>
            </a>
        </div>
    </div>
</header>

<script>
    document.getElementById('mobileMenuBtn')?.addEventListener('click', function() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
    });
</script>
