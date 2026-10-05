-- ========================================================
-- Olive Shoe - Luxury Footwear eCommerce Database Schema
-- Ready for MySQL 5.7+ / MariaDB / cPanel phpMyAdmin
-- ========================================================

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS shipping_methods;
SET FOREIGN_KEY_CHECKS = 1;

-- 1. Categories Table
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Products Table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    slug VARCHAR(150) NOT NULL UNIQUE,
    category_id INT NOT NULL,
    description TEXT NOT NULL,
    short_description VARCHAR(255),
    price DECIMAL(10,2) NOT NULL,
    sale_price DECIMAL(10,2) DEFAULT NULL,
    image_url VARCHAR(500) NOT NULL,
    additional_images TEXT, -- JSON array of image URLs
    available_sizes VARCHAR(100) DEFAULT '39,40,41,42,43,44,45',
    color VARCHAR(50) DEFAULT 'Olive & Burnished Gold',
    material VARCHAR(100) DEFAULT 'Full Grain Calfskin Leather',
    stock_quantity INT DEFAULT 50,
    is_featured BOOLEAN DEFAULT FALSE,
    is_new BOOLEAN DEFAULT FALSE,
    rating DECIMAL(2,1) DEFAULT 4.9,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Shipping Methods Table
CREATE TABLE shipping_methods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(255),
    cost DECIMAL(10,2) NOT NULL,
    estimated_days VARCHAR(50) NOT NULL,
    is_active BOOLEAN DEFAULT TRUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Orders Table
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_number VARCHAR(30) NOT NULL UNIQUE,
    customer_name VARCHAR(150) NOT NULL,
    customer_email VARCHAR(150) NOT NULL,
    customer_phone VARCHAR(50) NOT NULL,
    shipping_address TEXT NOT NULL,
    shipping_city VARCHAR(100) NOT NULL,
    shipping_state VARCHAR(100) NOT NULL,
    shipping_postal_code VARCHAR(30) NOT NULL,
    shipping_country VARCHAR(100) NOT NULL,
    shipping_method VARCHAR(100) NOT NULL,
    shipping_cost DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    subtotal DECIMAL(10,2) NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL, -- 'card', 'paypal', 'bank_transfer', 'cod'
    payment_status VARCHAR(50) DEFAULT 'pending', -- 'pending', 'paid', 'failed'
    order_status VARCHAR(50) DEFAULT 'processing', -- 'processing', 'shipped', 'delivered', 'cancelled'
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Order Items Table
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    product_name VARCHAR(150) NOT NULL,
    product_image VARCHAR(500),
    selected_size VARCHAR(10) NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================================
-- Seed Initial Data (Olive & Gold luxury catalog)
-- ========================================================

INSERT INTO categories (id, name, slug, description, image_url) VALUES
(1, 'Artisan Loafers', 'loafers', 'Hand-stitched leather loafers trimmed with gold-tone hardware.', 'https://images.unsplash.com/photo-1533867617858-e7b97e060509?auto=format&fit=crop&w=600&q=80'),
(2, 'Heritage Boots', 'boots', 'Rugged elegance engineered with patina olive pull-up leather.', 'https://images.unsplash.com/photo-1608256246200-53e635b5b65f?auto=format&fit=crop&w=600&q=80'),
(3, 'Formal Oxford & Derby', 'oxford-derby', 'Refined gala footwear with hand-painted gold burnished accents.', 'https://images.unsplash.com/photo-1614252235316-8c857d38b5f4?auto=format&fit=crop&w=600&q=80'),
(4, 'Luxury Minimalist Sneakers', 'luxury-sneakers', 'Buttery soft olive suede and gold foil stamped insoles.', 'https://images.unsplash.com/photo-1549298916-b41d501d3772?auto=format&fit=crop&w=600&q=80');

INSERT INTO shipping_methods (name, description, cost, estimated_days) VALUES
('Standard Ground Delivery', 'Insured tracked delivery via national carrier', 15.00, '3 - 5 Business Days'),
('Express Air Courier', 'Expedited courier delivery with priority handling', 35.00, '1 - 2 Business Days'),
('Artisan White-Glove VIP', 'Scheduled delivery with bespoke gift packaging', 65.00, 'Next Business Day');

INSERT INTO products (id, name, slug, category_id, description, short_description, price, sale_price, image_url, additional_images, available_sizes, color, material, stock_quantity, is_featured, is_new, rating) VALUES
(1, 'The Sovereign Olive Penny Loafer', 'sovereign-olive-penny-loafer', 1, 
'Handcrafted in Tuscany from vegetable-tanned olive calfskin, The Sovereign features custom brass-gold hardware across the vamp and Goodyear welted leather soles. Designed for the connoisseur who commands distinction.', 
'Vegetable-tanned olive calfskin with bespoke gold hardware accent.', 
385.00, NULL, 
'https://images.unsplash.com/photo-1533867617858-e7b97e060509?auto=format&fit=crop&w=900&q=80',
'["https://images.unsplash.com/photo-1533867617858-e7b97e060509?auto=format&fit=crop&w=900&q=80","https://images.unsplash.com/photo-1614252235316-8c857d38b5f4?auto=format&fit=crop&w=900&q=80"]',
'39,40,41,42,43,44,45', 'Deep Olive / Muted Gold', 'Tuscan Calf Leather', 24, TRUE, TRUE, 5.0),

(2, 'The Aureus Chelsea Boot in Forest Patina', 'aureus-chelsea-boot', 2, 
'Cut from oiled nubuck leather in a rich dark olive tone, complemented by gold-thread woven pull tabs and dual stretch gussets. Finished with a durable Vibram lug sole for effortless transitions from atelier to city streets.', 
'Oiled nubuck leather in dark olive with gold-threaded pull tabs.', 
440.00, 395.00, 
'https://images.unsplash.com/photo-1608256246200-53e635b5b65f?auto=format&fit=crop&w=900&q=80',
'["https://images.unsplash.com/photo-1608256246200-53e635b5b65f?auto=format&fit=crop&w=900&q=80"]',
'40,41,42,43,44', 'Forest Patina Olive', 'Oiled Nubuck & Vibram Sole', 18, TRUE, FALSE, 4.9),

(3, 'The Gilded Monks Double Buckle', 'gilded-monks-double-buckle', 3, 
'A masterpiece of formal shoemaking. Hand-burnished deep olive boxcalf leather finished with solid 14k-electroplated gold buckles and fiddleback beveled waists. Perfect for black-tie gatherings and momentous milestones.', 
'Hand-burnished boxcalf with 14k-gold finished double monk straps.', 
480.00, NULL, 
'https://images.unsplash.com/photo-1614252235316-8c857d38b5f4?auto=format&fit=crop&w=900&q=80',
'["https://images.unsplash.com/photo-1614252235316-8c857d38b5f4?auto=format&fit=crop&w=900&q=80"]',
'39,40,41,42,43,44', 'Olive Burnish & Gold Buckle', 'Italian Boxcalf', 15, TRUE, TRUE, 5.0),

(4, 'Verdant Court Low-Top Sneaker', 'verdant-court-low-top', 4, 
'An elevated interpretation of the court shoe. Crafted with velvety Italian olive suede, butter-soft leather lining, gold foil embossed serial numbers, and a Margom rubber cupsole.', 
'Italian olive suede court sneaker with gold foil stamped detailing.', 
295.00, NULL, 
'https://images.unsplash.com/photo-1549298916-b41d501d3772?auto=format&fit=crop&w=900&q=80',
'["https://images.unsplash.com/photo-1549298916-b41d501d3772?auto=format&fit=crop&w=900&q=80"]',
'39,40,41,42,43,44,45', 'Soft Sage & Gold Foil', 'Italian Velour Suede', 35, TRUE, FALSE, 4.8),

(5, 'The Versailles Tassel Loafer', 'versailles-tassel-loafer', 1, 
'Double-tasseled perfection with woven olive leather apron and miniature gold ring cinch. Designed with cushioned cork footbeds that mold to your foot over time.', 
'Hand-woven apron loafer with olive leather tassels and gold accents.', 
395.00, 350.00, 
'https://images.unsplash.com/photo-1560343090-f0409e92791a?auto=format&fit=crop&w=900&q=80',
'["https://images.unsplash.com/photo-1560343090-f0409e92791a?auto=format&fit=crop&w=900&q=80"]',
'40,41,42,43,44', 'Vintage Olive Oil Wash', 'Calfskin & Cork Insole', 20, FALSE, TRUE, 4.9),

(6, 'The Olympus Wingtip Brogue', 'olympus-wingtip-brogue', 3, 
'Intricate decorative perforations meet deep woodland olive cordovan leather. Finished with brass lace eyelets and hand-waxed laces.', 
'Classic full brogue wingtip in rich olive tones with subtle gold eyelets.', 
465.00, NULL, 
'https://images.unsplash.com/photo-1543163521-1bf539c55dd2?auto=format&fit=crop&w=900&q=80',
'["https://images.unsplash.com/photo-1543163521-1bf539c55dd2?auto=format&fit=crop&w=900&q=80"]',
'41,42,43,44,45', 'Woodland Olive', 'Cordovan Leather', 12, FALSE, FALSE, 4.7);
