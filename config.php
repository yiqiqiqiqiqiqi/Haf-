<?php
// config.php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'haf_db');
define('DB_USER', 'root');
define('DB_PASS', '');

try {
    // First try to connect without database name to check if MySQL is running
    $pdo = new PDO(
        "mysql:host=" . DB_HOST,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );

    // Check if database exists
    $stmt = $pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . DB_NAME . "'");
    if (!$stmt->fetch()) {
        // Create database if it doesn't exist
        $pdo->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    }

    // Now connect to the specific database
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

    // Check if tables exist
    $tables = ['users', 'products', 'cart', 'orders', 'order_items', 'addresses', 'product_images', 'product_reviews', 'wishlist'];
    foreach ($tables as $table) {
        $stmt = $pdo->query("SHOW TABLES LIKE '$table'");
        if (!$stmt->fetch()) {
            // If any table is missing, we need to import the SQL file
            $sql_file = __DIR__ . '/sql/haf_db (3).sql';
            if (!file_exists($sql_file)) {
                throw new Exception("SQL file not found: $sql_file");
            }
            $sql = file_get_contents($sql_file);
            if ($sql === false) {
                throw new Exception("Failed to read SQL file: $sql_file");
            }
            if (empty($sql)) {
                throw new Exception("SQL file is empty: $sql_file");
            }

            // Disable foreign key checks temporarily
            $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");

            // Split SQL into individual statements
            $statements = array_filter(
                array_map(
                    'trim',
                    explode(';', $sql)
                )
            );

            // Execute each statement
            foreach ($statements as $statement) {
                if (!empty($statement)) {
                    $pdo->exec($statement);
                }
            }

            // Re-enable foreign key checks
            $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
            break;
        }
    }

} catch (PDOException $e) {
    error_log('Database connection failed: ' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
    
    // More detailed error message for debugging
    if (strpos($e->getMessage(), "Unknown database") !== false) {
        die('Database "haf_db" does not exist. Please create it first.');
    } elseif (strpos($e->getMessage(), "Access denied") !== false) {
        die('Access denied. Please check your database username and password.');
    } elseif (strpos($e->getMessage(), "Could not connect") !== false) {
        die('Could not connect to MySQL server. Please make sure MySQL is running.');
    } else {
        die('Database connection failed: ' . $e->getMessage());
    }
} catch (Exception $e) {
    error_log('SQL file error: ' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
    die('Error loading database structure: ' . $e->getMessage());
}

// Site configuration
define('SITE_LANG', 'zh'); // Options: en, zh, es, ar, fr, ru, pt, de, ja, hi
define('SITE_DIR', SITE_LANG === 'ar' ? 'rtl' : 'ltr');
?>