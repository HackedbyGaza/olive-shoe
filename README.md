# 🌿 Olive Shoe — Handcrafted Footwear Atelier

A luxury eCommerce web application built with **PHP**, **MySQL**, and **Tailwind CSS**, designed with an olive green and warm gold aesthetic.

---

## 🌟 Features Included

1. **Brand Aesthetic:**
   - Deep Tuscan Olive (`#1f2a13`, `#384623`) with 14k Burnished Gold gradients (`#d4af37`, `#f3df95`).
   - Serif typography (`Playfair Display`) paired with crisp interface typography (`Plus Jakarta Sans`).

2. **Full eCommerce Flow:**
   - **Homepage (`index.php`)**: Editorial hero section, curated categories, featured arrivals, artisan craftsmanship story, patron testimonials.
   - **Catalog & Shop (`shop.php`)**: Dynamic category filtering (Loafers, Boots, Oxfords, Sneakers), search bar, and price sorting.
   - **Product Page (`product.php`)**: European shoe size selector (EU 39–45), quantity picker, craftsmanship breakdown, and return guarantees.
   - **Shopping Bag (`cart.php`)**: Session-based bag management, dynamic free shipping progress bar, promo code placeholder, and line item removal.
   - **Checkout & Shipping (`checkout.php`)**:
     - Customer contact & delivery address (Street, City, Country, Postal code).
     - Live shipping tier calculation (Standard Ground, Express Air Courier, White-Glove VIP).
     - Multi-option payment gateway (Credit/Debit Card via Stripe UI, PayPal Express, Direct Atelier Wire, and Cash/Courier on Delivery).
   - **Order Confirmation & Tracking (`order-success.php`)**: Official acquisition invoice with order number, printable receipt, and 4-step dispatch pipeline.

3. **Hybrid Database Engine:**
   - **Works out-of-the-box locally**: Built-in fallback catalog ensures the site runs immediately on `php -S localhost:8000` even before MySQL is set up.
   - **Production Ready for cPanel**: Automatically connects to MySQL database with PDO prepared statements once credentials are provided.

---

## 🚀 How to Run Locally

You already have PHP installed on your machine! Simply open PowerShell or terminal inside this folder:

```powershell
cd C:\Users\tiens\.gemini\antigravity\scratch\olive-shoe
php -S localhost:8000
```

Then visit [http://localhost:8000](http://localhost:8000) in your browser.

---

## 📦 How to Deploy to cPanel (Step-by-Step)

### Step 1: Create Database in cPanel
1. Log in to your **cPanel**.
2. Under the **Databases** section, click **MySQL® Database Wizard**.
3. Create a new database (e.g. `yourcpaneluser_oliveshoe`).
4. Create a database user & password, and grant **ALL PRIVILEGES**. Note down the database name, username, and password.

### Step 2: Import the Database Schema
1. Back in cPanel, open **phpMyAdmin**.
2. Select your newly created database in the left sidebar.
3. Click the **Import** tab at the top.
4. Click **Choose File**, select `database/schema.sql` from this project, and click **Import** (or **Go**).
5. All tables (`products`, `categories`, `orders`, `order_items`, `shipping_methods`) and luxury sample shoes will be created automatically.

### Step 3: Configure Database Credentials
Open `config/database.php` in a text editor (or via cPanel File Manager) and update these lines:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'yourcpaneluser_oliveshoe');
define('DB_USER', 'yourcpaneluser_dbuser');
define('DB_PASS', 'YourSecurePasswordHere');
```

### Step 4: Upload to cPanel File Manager
1. In cPanel, click **File Manager**.
2. Navigate to **`public_html`** (or your subdomain folder).
3. Zip the contents of the `olive-shoe` folder, upload the `.zip` file, and click **Extract**.
4. That's it! Visit your domain (e.g., `https://yourdomain.com`) and your Olive Shoe luxury store is live!
