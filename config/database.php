<?php
/**
 * Olive Shoe - Database Connection Handler
 * For cPanel: Update DB_NAME, DB_USER, and DB_PASS with your cPanel MySQL details.
 */

// Database credentials
define('DB_HOST', 'localhost');
define('DB_NAME', 'olive_shoe');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_PORT', '3306');
define('DB_CHARSET', 'utf8mb4');

/**
 * Returns a PDO connection instance or false if unavailable.
 */
function get_db_connection() {
    static $pdo = null;
    static $attempted = false;

    if ($pdo !== null) {
        return $pdo;
    }

    if ($attempted) {
        return null;
    }

    $attempted = true;

    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT . ";charset=" . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        return $pdo;
    } catch (PDOException $e) {
        // If MySQL is not running or not yet configured (e.g., during quick preview before database creation)
        error_log("Database connection failed: " . $e->getMessage());
        return null;
    }
}
