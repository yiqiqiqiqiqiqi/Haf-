<?php
// Start session with explicit configuration
ini_set('session.gc_maxlifetime', 1440);
ini_set('session.cookie_lifetime', 0);
session_start();

// Database connection
require_once dirname(__DIR__) . '/config.php';

// Generate CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Set default language
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'zh';
}
$lang = $_SESSION['lang'];

// Define translation texts
$languages = [
    'zh' => [
        'site_title' => 'HAF - 愿望清单',
        'meta_description' => '查看您在HAF商店的愿望清单',
        'nav_history' => '历史',
        'nav_art' => '艺术',
        'nav_fashion' => '时尚',
        'nav_shop' => '商店',
        'nav_cart' => '购物车',
        'nav_orders' => '订单',
        'nav_admin' => '管理员面板',
        'nav_wishlist' => '愿望清单',
        'nav_logout' => '登出',
        'nav_login' => '登录',
        'welcome_user' => '欢迎',
        'wishlist_title' => '我的愿望清单',
        'no_products' => '愿望清单为空',
        'error_message' => '操作失败，请重试',
        'success_message' => '已加入购物车',
        'wishlist_remove_success' => '已从愿望清单移除',
        'db_error' => '数据库连接失败，请联系管理员',
        'shop_add_to_cart' => '加入购物车',
        'shop_remove_from_wishlist' => '从愿望清单移除',
        'stock_available' => '有货',
        'out_of_stock' => '无货',
        'average_rating' => '平均评分',
        'no_reviews' => '暂无评论'
    ],
    'en' => [
        'site_title' => 'HAF - Wishlist',
        'meta_description' => 'View your wishlist in the HAF shop',
        'nav_history' => 'History',
        'nav_art' => 'Art',
        'nav_fashion' => 'Fashion',
        'nav_shop' => 'Shop',
        'nav_cart' => 'Cart',
        'nav_orders' => 'Orders',
        'nav_admin' => 'Admin Panel',
        'nav_wishlist' => 'Wishlist',
        'nav_logout' => 'Logout',
        'nav_login' => 'Login',
        'welcome_user' => 'Welcome',
        'wishlist_title' => 'My Wishlist',
        'no_products' => 'Your wishlist is empty',
        'error_message' => 'Operation failed, please try again',
        'success_message' => 'Added to cart',
        'wishlist_remove_success' => 'Removed from wishlist',
        'db_error' => 'Database connection failed, please contact the administrator',
        'shop_add_to_cart' => 'Add to Cart',
        'shop_remove_from_wishlist' => 'Remove from Wishlist',
        'stock_available' => 'In Stock',
        'out_of_stock' => 'Out of Stock',
        'average_rating' => 'Average Rating',
        'no_reviews' => 'No reviews yet'
    ],
    'ms' => [
        'site_title' => 'HAF - Senarai Hajat',
        'meta_description' => 'Lihat senarai hajat anda di kedai HAF',
        'nav_history' => 'Sejarah',
        'nav_art' => 'Seni',
        'nav_fashion' => 'Fesyen',
        'nav_shop' => 'Kedai',
        'nav_cart' => 'Troli',
        'nav_orders' => 'Pesanan',
        'nav_admin' => 'Panel Admin',
        'nav_wishlist' => 'Senarai Hajat',
        'nav_logout' => 'Log Keluar',
        'nav_login' => 'Log Masuk',
        'welcome_user' => 'Selamat Datang',
        'wishlist_title' => 'Senarai Hajat Saya',
        'no_products' => 'Senarai hajat anda kosong',
        'error_message' => 'Operasi gagal, sila cuba lagi',
        'success_message' => 'Ditambah ke troli',
        'wishlist_remove_success' => 'Dibuang dari senarai hajat',
        'db_error' => 'Sambungan pangkalan data gagal, sila hubungi pentadbir',
        'shop_add_to_cart' => 'Tambah ke Troli',
        'shop_remove_from_wishlist' => 'Buang dari Senarai Hajat',
        'stock_available' => 'Ada Stok',
        'out_of_stock' => 'Kehabisan Stok',
        'average_rating' => 'Penilaian Purata',
        'no_reviews' => 'Tiada ulasan lagi'
    ]
];
$texts = $languages[$lang] ?? $languages['zh'];

// Handle language switching
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lang'])) {
    $lang = in_array($_POST['lang'], ['zh', 'en', 'ms']) ? $_POST['lang'] : 'zh';
    $_SESSION['lang'] = $lang;
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'lang' => $lang]);
    exit;
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = $texts['error_message'];
    header("Location: login.php");
    exit;
}

// Rate limiting for wishlist and cart actions
if (!isset($_SESSION['wishlist_attempts'])) {
    $_SESSION['wishlist_attempts'] = [];
}
if (!isset($_SESSION['cart_add_attempts'])) {
    $_SESSION['cart_add_attempts'] = [];
}
$now = time();
$_SESSION['wishlist_attempts'] = array_filter($_SESSION['wishlist_attempts'], function($timestamp) use ($now) {
    return ($now - $timestamp) < 3600;
});
$_SESSION['cart_add_attempts'] = array_filter($_SESSION['cart_add_attempts'], function($timestamp) use ($now) {
    return ($now - $timestamp) < 3600;
});
$max_attempts = 50;

// Fetch wishlist items
$wishlist_items = [];
$product_images = [];
if (isset($pdo) && $pdo !== null) {
    try {
        $stmt = $pdo->prepare("SELECT p.*, 
                              (SELECT AVG(rating) FROM product_reviews WHERE product_id = p.id) AS average_rating,
                              (SELECT COUNT(*) FROM product_reviews WHERE product_id = p.id) AS review_count
                              FROM wishlist w 
                              JOIN products p ON w.product_id = p.id 
                              WHERE w.user_id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $wishlist_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Fetch images for all wishlist products
        $product_ids = array_column($wishlist_items, 'id');
        if (!empty($product_ids)) {
            $placeholders = str_repeat('?,', count($product_ids) - 1) . '?';
            $stmt = $pdo->prepare("SELECT * FROM product_images WHERE product_id IN ($placeholders) ORDER BY product_id, is_primary DESC, id");
            $stmt->execute($product_ids);
            while ($image = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $product_images[$image['product_id']][] = $image;
            }
        }

        // Log wishlist view action
        $stmt = $pdo->prepare("INSERT INTO logs (user_id, action, details) VALUES (?, ?, ?)");
        $stmt->execute([
            $_SESSION['user_id'],
            'view_wishlist',
            json_encode(['product_count' => count($wishlist_items)])
        ]);
    } catch (PDOException $e) {
        error_log('查询愿望清单失败：' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
        $_SESSION['error'] = $texts['db_error'];
    }
} else {
    error_log('PDO 未定义或为 null', 3, 'C:/wamp64/logs/php_error.log');
    $_SESSION['error'] = $texts['db_error'];
}

// Handle removing from wishlist
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'remove_from_wishlist' && isset($_POST['product_id'], $_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    if (count($_SESSION['wishlist_attempts']) >= $max_attempts) {
        $_SESSION['error'] = $texts['error_message'] . ' (Too many attempts, please try again later)';
    } elseif (isset($pdo) && $pdo !== null) {
        try {
            $product_id = filter_var($_POST['product_id'], FILTER_VALIDATE_INT);
            $user_id = $_SESSION['user_id'];

            if ($product_id) {
                $stmt = $pdo->prepare("DELETE FROM wishlist WHERE user_id = ? AND product_id = ?");
                $stmt->execute([$user_id, $product_id]);

                // Log wishlist removal
                $stmt = $pdo->prepare("INSERT INTO logs (user_id, action, details) VALUES (?, ?, ?)");
                $stmt->execute([
                    $user_id,
                    'remove_from_wishlist',
                    json_encode(['product_id' => $product_id])
                ]);

                // Record attempt
                $_SESSION['wishlist_attempts'][] = $now;

                $_SESSION['success'] = $texts['wishlist_remove_success'];
                header("Location: wishlist.php");
                exit;
            } else {
                $_SESSION['error'] = $texts['error_message'];
            }
        } catch (PDOException $e) {
            error_log('愿望清单移除失败：' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
            $_SESSION['error'] = $texts['error_message'];
        }
    } else {
        error_log('PDO 未定义或为 null 无法移除愿望清单', 3, 'C:/wamp64/logs/php_error.log');
        $_SESSION['error'] = $texts['db_error'];
    }
}

// Handle adding products to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_to_cart' && isset($_POST['product_id'], $_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    if (count($_SESSION['cart_add_attempts']) >= $max_attempts) {
        $_SESSION['error'] = $texts['error_message'] . ' (Too many attempts, please try again later)';
    } elseif (isset($pdo) && $pdo !== null) {
        try {
            $product_id = filter_var($_POST['product_id'], FILTER_VALIDATE_INT);
            $quantity = filter_var($_POST['quantity'] ?? 1, FILTER_VALIDATE_INT) ?: 1;
            $user_id = $_SESSION['user_id'];

            // Check stock
            $stmt = $pdo->prepare("SELECT stock FROM products WHERE id = ?");
            $stmt->execute([$product_id]);
            $stock = $stmt->fetchColumn();

            if ($stock === false || $stock < $quantity) {
                $_SESSION['error'] = $texts['out_of_stock'];
            } elseif ($product_id && $quantity > 0) {
                $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE quantity = quantity + ?");
                $stmt->execute([$user_id, $product_id, $quantity, $quantity]);

                // Update stock
                $stmt = $pdo->prepare("UPDATE products SET stock = stock - ? WHERE id = ? AND stock >= ?");
                $stmt->execute([$quantity, $product_id, $quantity]);

                // Log cart addition
                $stmt = $pdo->prepare("INSERT INTO logs (user_id, action, details) VALUES (?, ?, ?)");
                $stmt->execute([
                    $user_id,
                    'add_to_cart',
                    json_encode(['product_id' => $product_id, 'quantity' => $quantity])
                ]);

                // Record attempt
                $_SESSION['cart_add_attempts'][] = $now;

                $_SESSION['success'] = $texts['success_message'];
                header("Location: cart.php");
                exit;
            } else {
                $_SESSION['error'] = $texts['error_message'];
            }
        } catch (PDOException $e) {
            error_log('添加购物车失败：' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
            $_SESSION['error'] = $texts['error_message'];
        }
    } else {
        error_log('PDO 未定义或为 null 无法添加购物车', 3, 'C:/wamp64/logs/php_error.log');
        $_SESSION['error'] = $texts['db_error'];
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo $lang === 'zh' ? 'zh-CN' : ($lang === 'en' ? 'en' : 'ms'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($texts['meta_description']); ?>">
    <title><?php echo htmlspecialchars($texts['site_title']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        :root {
            --custom-light: #FBF7F0;
            --papaya-whip: #FFEFD5;
            --old-lace: #FDF5E6;
            --linen: #FAF0E6;
            --seashell: #FFF5EE;
            --snow: #FFFAFA;
            --ivory: #FFFFF0;
            --charcoal: #333333;
            --old-lace-opaque: rgba(253, 245, 230, 0.8);
            --shadow-normal: 0 4px 16px rgba(0,0,0,0.10);
            --shadow-hover: 0 8px 32px rgba(0,0,0,0.15);
            --accent-blue: #B8E0FF;
            --accent-pink: #FFD6E0;
        }
        body {
            font-family: 'Poppins', 'EB Garamond', Arial, sans-serif;
            background: var(--custom-light) !important;
            color: var(--charcoal);
            margin: 0;
            padding: 0;
        }
        .navbar {
            background: var(--papaya-whip);
            border-bottom: 2px solid var(--old-lace);
            box-shadow: none;
            min-height: 80px;
        }
        .navbar .container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 95vw;
            max-width: 1400px;
            min-width: 320px;
            margin: 18px auto 0 auto;
            padding: 0 40px;
            background: #fff !important;
            border-radius: 12px !important;
            box-shadow: var(--shadow-normal) !important;
            height: 64px;
            position: relative;
        }
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: var(--charcoal);
            font-weight: 700;
            margin-right: 24px;
            flex-shrink: 0;
        }
        .navbar-content-center {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1 1 auto;
            min-width: 0;
        }
        .navbar-nav {
            display: flex !important;
            flex-direction: row !important;
            flex-wrap: nowrap !important;
            align-items: center;
            gap: 32px;
        }
        .nav-item {
            width: auto !important;
            text-align: center;
            margin: 0 !important;
            flex-shrink: 0;
        }
        .nav-link {
            font-family: 'Raleway', sans-serif;
            font-size: 1.1rem;
            color: var(--charcoal) !important;
            margin: 0 !important;
            transition: color 0.2s;
            white-space: nowrap;
            padding: 10px 0;
            border-bottom: 2px solid transparent;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--old-lace);
            background: none;
            font-weight: bold;
            border-bottom: 2px solid var(--old-lace);
        }
        .navbar-lang {
            margin-left: 32px;
            flex-shrink: 0;
        }
        #language-switcher {
            background: var(--ivory);
            border: 2px solid var(--old-lace);
            padding: 5px 10px;
            border-radius: 5px;
            font-family: 'Raleway', sans-serif;
            width: 120px;
            display: inline-block;
            vertical-align: middle;
            flex-shrink: 0;
        }
        @media (max-width: 1200px) {
            .navbar .container {
                width: 99vw;
                padding: 0 10px;
            }
            .navbar-nav {
                gap: 18px;
            }
            .navbar-lang {
                margin-left: 16px;
            }
        }
        @media (max-width: 900px) {
            .navbar .container {
                padding: 0 2vw;
            }
            .navbar-nav {
                gap: 10px;
            }
            #language-switcher {
                width: 90px;
            }
            .navbar-lang {
                margin-left: 8px;
            }
        }
        @media (max-width: 600px) {
            .navbar .container {
                padding: 0 1vw;
                height: auto;
            }
            .navbar-nav {
                gap: 6px;
            }
            .nav-link {
                font-size: 1rem;
                padding: 8px 0;
            }
            #language-switcher {
                width: 70px;
            }
            .navbar-lang {
                margin-left: 4px;
            }
        }
        .container, .sidebar, .card, .card-body, .row, .col-md-3, .col-md-9, .mb-4, .pagination, .alert, .input-group, .form-control, .form-select, .btn, .btn-primary, .btn-secondary {
            background: transparent !important;
            box-shadow: none !important;
            border-radius: 0 !important;
            border: none !important;
        }
        .container {
            padding: 24px 10px;
        }
        .card, .card:hover {
            background: none;
            border: none;
            box-shadow: none;
            border-radius: 0;
            margin-bottom: 24px;
            transition: none;
        }
        .card-img-top, .carousel-item img {
            border-radius: 0;
            height: 220px;
            object-fit: cover;
            background: var(--linen);
        }
        .card-body {
            background: var(--snow);
            border-radius: 12px;
            box-shadow: var(--shadow-normal);
            padding: 22px 18px 18px 18px;
            margin-top: -8px;
            margin-bottom: 0;
            min-height: 320px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }
        .card-body > *:not(:last-child) {
            margin-bottom: 10px;
        }
        .card-title {
            font-size: 1.18rem;
            margin-bottom: 10px;
            color: var(--charcoal);
            font-family: 'Playfair Display', serif;
        }
        .card-text {
            font-size: 1rem;
            color: #666;
            font-family: 'Raleway', sans-serif;
        }
        .card-text.price {
            font-weight: bold;
            color: var(--accent-blue);
            font-size: 1.08rem;
        }
        .card-text.original-price {
            text-decoration: line-through;
            color: #999;
            font-size: 0.9rem;
        }
        .card-text.discount {
            color: #dc3545;
            font-weight: bold;
        }
        .stock-status {
            font-size: 0.95rem;
            margin-top: 5px;
            font-family: 'Raleway', sans-serif;
        }
        .stock-status.available {
            color: green;
        }
        .stock-status.out-of-stock {
            color: #dc3545;
        }
        .btn-primary {
            background: var(--old-lace);
            border: 2px solid var(--old-lace);
            color: var(--charcoal);
            font-family: 'Raleway', sans-serif;
            border-radius: 6px;
            box-shadow: var(--shadow-normal);
            transition: all 0.3s;
        }
        .btn-primary:hover {
            background: var(--ivory);
            color: var(--charcoal);
            border-color: var(--accent-pink);
            box-shadow: var(--shadow-hover);
        }
        .btn-primary:disabled {
            background: #f3f3f3;
            color: #aaa;
            border-color: #eee;
            cursor: not-allowed;
        }
        .btn-wishlist {
            background: var(--accent-pink);
            border: none;
            color: var(--charcoal);
            border-radius: 6px;
            font-family: 'Raleway', sans-serif;
            transition: background 0.3s, color 0.3s;
        }
        .btn-wishlist:hover {
            background: var(--accent-blue);
            color: var(--charcoal);
        }
        .form-select, .form-control {
            width: 100%;
            margin-bottom: 10px;
            padding: 7px;
            font-size: 1rem;
            border-radius: 6px;
            border: 2px solid var(--old-lace);
            background: var(--linen);
            color: var(--charcoal);
            font-family: 'Raleway', sans-serif;
        }
        .form-select:focus, .form-control:focus {
            border-color: var(--papaya-whip);
            outline: none;
            box-shadow: 0 0 0 2px var(--papaya-whip);
        }
        .input-group {
            margin-bottom: 10px;
        }
        @media (max-width: 900px) {
            .card-img-top, .carousel-item img {
                height: 150px;
            }
            .container {
                padding: 10px 2px;
            }
            .card-body {
                min-height: 220px;
                padding: 14px 6px 10px 6px;
            }
        }
        @media (max-width: 600px) {
            .card-img-top, .carousel-item img {
                height: 100px;
            }
            .sidebar {
                margin-bottom: 20px;
            }
            .card-body {
                min-height: 120px;
                padding: 8px 2px 6px 2px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand animate-jitter" href="../index.php">HAF</a>
            <div class="navbar-content-center">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link animate-jitter" href="../history.php" data-lang-key="nav_history"><?php echo htmlspecialchars($texts['nav_history']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate-jitter" href="../art.php" data-lang-key="nav_art"><?php echo htmlspecialchars($texts['nav_art']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate-jitter" href="../fashion.php" data-lang-key="nav_fashion"><?php echo htmlspecialchars($texts['nav_fashion']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate-jitter" href="shop.php" data-lang-key="nav_shop"><?php echo htmlspecialchars($texts['nav_shop']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate-jitter" href="cart.php" data-lang-key="nav_cart"><?php echo htmlspecialchars($texts['nav_cart']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate-jitter" href="wishlist.php" data-lang-key="nav_wishlist"><?php echo htmlspecialchars($texts['nav_wishlist']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate-jitter" href="orders.php" data-lang-key="nav_orders"><?php echo htmlspecialchars($texts['nav_orders']); ?></a>
                    </li>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link animate-jitter" href="admin.php" data-lang-key="nav_admin"><?php echo htmlspecialchars($texts['nav_admin']); ?></a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <span class="nav-link"><?php echo htmlspecialchars($texts['welcome_user'] . ' ' . ($_SESSION['username'] ?? '')); ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate-jitter" href="logout.php" data-lang-key="nav_logout"><?php echo htmlspecialchars($texts['nav_logout']); ?></a>
                    </li>
                </ul>
                <div class="navbar-lang">
                    <select id="language-switcher" class="form-select w-auto">
                        <option value="zh" <?php echo $lang === 'zh' ? 'selected' : ''; ?>>中文</option>
                        <option value="en" <?php echo $lang === 'en' ? 'selected' : ''; ?>>English</option>
                        <option value="ms" <?php echo $lang === 'ms' ? 'selected' : ''; ?>>Bahasa Melayu</option>
                    </select>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center"><?php echo htmlspecialchars($texts['wishlist_title']); ?></h2>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
        <?php elseif (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <!-- Wishlist Items -->
        <?php if (empty($wishlist_items)): ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($texts['no_products']); ?></div>
        <?php else: ?>
            <div class="row" id="wishlist-container">
                <?php foreach ($wishlist_items as $product): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <?php if (!empty($product_images[$product['id']])): ?>
                                <div id="carousel-<?php echo $product['id']; ?>" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php foreach ($product_images[$product['id']] as $index => $image): ?>
                                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                                <img src="../<?php echo htmlspecialchars($image['image_path']); ?>" class="d-block w-100" alt="<?php echo htmlspecialchars($image['alt_' . $lang]); ?>">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?php echo $product['id']; ?>" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?php echo $product['id']; ?>" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            <?php else: ?>
                                <img src="../<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['alt_' . $lang]); ?>">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['name_' . $lang]); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($product['description_' . $lang] ?? ''); ?></p>
                                <p class="card-text price"><?php echo $lang === 'zh' ? '¥' : ($lang === 'en' ? '$' : 'RM'); ?><?php echo number_format($product['price_' . $lang], 2); ?></p>
                                <p class="stock-status <?php echo $product['stock'] > 0 ? 'available' : 'out-of-stock'; ?>">
                                    <?php echo $product['stock'] > 0 ? htmlspecialchars($texts['stock_available']) : htmlspecialchars($texts['out_of_stock']); ?>
                                </p>
                                <p class="card-text">
                                    <?php echo $texts['average_rating']; ?>: 
                                    <?php if ($product['average_rating']): ?>
                                        <span class="star-rating"><?php echo str_repeat('★', round($product['average_rating'])); ?><?php echo str_repeat('☆', 5 - round($product['average_rating'])); ?></span>
                                        (<?php echo $product['review_count']; ?>)
                                    <?php else: ?>
                                        <?php echo $texts['no_reviews']; ?>
                                    <?php endif; ?>
                                </p>
                                <form method="POST">
                                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                                    <input type="hidden" name="action" value="add_to_cart">
                                    <div class="input-group mb-3">
                                        <input type="number" name="quantity" class="form-control" value="1" min="1" max="<?php echo htmlspecialchars($product['stock']); ?>">
                                        <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo htmlspecialchars($texts['shop_add_to_cart']); ?>" <?php echo $product['stock'] <= 0 ? 'disabled' : ''; ?>>
                                            <?php echo htmlspecialchars($texts['shop_add_to_cart']); ?>
                                        </button>
                                    </div>
                                </form>
                                <form method="POST" class="mt-2">
                                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                                    <input type="hidden" name="action" value="remove_from_wishlist">
                                    <button type="submit" class="btn btn-wishlist w-100">
                                        <?php echo htmlspecialchars($texts['shop_remove_from_wishlist']); ?>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const lang = localStorage.getItem('language') || '<?php echo $lang; ?>';
        const languages = <?php echo json_encode($languages); ?>;
        const translateElements = () => {
            document.querySelectorAll('[data-lang-key]').forEach(element => {
                const key = element.getAttribute('data-lang-key');
                const text = languages[lang][key] || languages['zh'][key] || key;
                element.textContent = text;
            });
            document.title = languages[lang].site_title || languages['zh'].site_title;
            const metaDesc = document.querySelector('meta[name="description"]');
            if (metaDesc) {
                metaDesc.setAttribute('content', languages[lang].meta_description || languages['zh'].meta_description);
            }
            document.documentElement.lang = lang === 'zh' ? 'zh-CN' : (lang === 'en' ? 'en' : 'ms');
        };
        translateElements();

        const languageSwitcher = document.getElementById('language-switcher');
        if (languageSwitcher) {
            languageSwitcher.addEventListener('change', (e) => {
                const newLang = e.target.value;
                localStorage.setItem('language', newLang);
                fetch('', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `lang=${encodeURIComponent(newLang)}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        translateElements();
                        window.location.reload();
                    }
                })
                .catch(error => console.error('语言切换失败：', error));
            });
        }

        // Initialize tooltips
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

        // Show loading spinner during form submission
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', () => {
                document.querySelector('.spinner-border')?.style.display = 'block';
                document.querySelector('#wishlist-container')?.style.opacity = '0.5';
            });
        });
    });
    </script>
</body>
</html> 