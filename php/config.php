<?php
// Database configuration
$host = 'localhost';
$dbname = 'haf_db';
$username = 'root';
$password = '';

// Initialize $pdo as global
global $pdo;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    // Verify database connection
    $pdo->query("SELECT 1");

    // Create tables if they don't exist
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL UNIQUE,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            role ENUM('user', 'admin') DEFAULT 'user',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );

        CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name_zh VARCHAR(255) NOT NULL,
            name_en VARCHAR(255) NOT NULL,
            name_ms VARCHAR(255) NOT NULL,
            description_zh TEXT,
            description_en TEXT,
            description_ms TEXT,
            price_zh DECIMAL(10,2) NOT NULL,
            price_en DECIMAL(10,2) NOT NULL,
            price_ms DECIMAL(10,2) NOT NULL,
            image VARCHAR(255),
            alt_zh VARCHAR(255),
            alt_en VARCHAR(255),
            alt_ms VARCHAR(255),
            category VARCHAR(100),
            stock INT NOT NULL DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );

        CREATE TABLE IF NOT EXISTS cart (
            user_id INT,
            product_id INT,
            quantity INT NOT NULL,
            PRIMARY KEY (user_id, product_id),
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
        );

        CREATE TABLE IF NOT EXISTS orders (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            total_zh DECIMAL(10,2) NOT NULL,
            total_en DECIMAL(10,2) NOT NULL,
            total_ms DECIMAL(10,2) NOT NULL,
            status ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending',
            address_id INT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );

        CREATE TABLE IF NOT EXISTS order_items (
            id INT AUTO_INCREMENT PRIMARY KEY,
            order_id INT,
            product_id INT,
            quantity INT NOT NULL,
            price DECIMAL(10,2) NOT NULL,
            FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
            FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
        );

        CREATE TABLE IF NOT EXISTS logs (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            action VARCHAR(100),
            details TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
        );

        CREATE TABLE IF NOT EXISTS addresses (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            address_line1 VARCHAR(255) NOT NULL,
            address_line2 VARCHAR(255),
            city VARCHAR(100) NOT NULL,
            state VARCHAR(100) NOT NULL,
            postal_code VARCHAR(20) NOT NULL,
            country VARCHAR(100) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );
    ");
} catch (PDOException $e) {
    $errorMessage = 'Database connection failed: ' . $e->getMessage() . ' | Host: ' . $host . ' | Database: ' . $dbname . ' | Username: ' . $username;
    error_log($errorMessage, 3, 'C:/wamp64/logs/php_error.log');
    $pdo = null;
    throw new Exception('Database connection failed. Please contact the administrator.');
}
?>