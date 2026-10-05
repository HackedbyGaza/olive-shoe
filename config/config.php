<?php
/**
 * Olive Shoe - Global Configuration
 * Designed for local development and seamless cPanel hosting deployment.
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// App Settings
define('APP_NAME', 'Olive Shoe');
define('APP_TAGLINE', 'Handcrafted Luxury in Olive & Gold');
define('APP_CURRENCY', '$');
define('APP_EMAIL', 'concierge@oliveshoe.com');
define('APP_PHONE', '+1 (800) 456-OLIVE');

// Environment Detection
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'] ?? 'localhost:8000';
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
$baseUrl = rtrim($protocol . $host . $scriptDir, '/');

// Base URL definition
if (!defined('BASE_URL')) {
    // If running in root, ensure no trailing slash issue
    define('BASE_URL', $baseUrl);
}

// Payment Settings (Mock / Sandbox ready)
define('STRIPE_ENABLED', true);
define('PAYPAL_ENABLED', true);
define('COD_ENABLED', true);
define('BANK_TRANSFER_ENABLED', true);

// Initialize cart if empty
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
