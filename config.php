<?php
/**
 * Database Configuration
 * Loads credentials from config.local.php (gitignored)
 */

$configFile = __DIR__ . '/config.local.php';

if (!file_exists($configFile)) {
    die('config.local.php not found. Copy config.local.example.php to config.local.php and update the values.');
}

$config = require $configFile;

define('DB_HOST', $config['db_host']);
define('DB_NAME', $config['db_name']);
define('DB_USER', $config['db_user']);
define('DB_PASS', $config['db_pass']);
define('ADMIN_PASSWORD', $config['admin_password']);

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    $pdo = null;
}
