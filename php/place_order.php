<?php
// Enable output buffering
ob_start();

// Start session with explicit configuration
ini_set('session.gc_maxlifetime', 1440);
ini_set('session.cookie_lifetime', 0);
session_start();

// Database connection
try {
    $pdo = new PDO('mysql:host=localhost;dbname=haf_db', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES utf8mb4');
} catch (PDOException $e) {
    error_log('数据库连接失败：' . $e->getMessage(), 3, 'C:\wamp64\logs\php_error.log');
    die('数据库连接失败，请联系管理员');
}

// CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Language settings
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'zh';
}
$lang = $_SESSION['lang'];

$languages = [
    'zh' => [
        'site_title' => 'HAF - 下单',
        'meta_description' => '完成您的HAF订单',
        'nav_history' => '历史',
        'nav_art' => '艺术',
        'nav_fashion' => '时尚',
        'nav_shop' => '商店',
        'nav_cart' => '购物车',
        'nav_orders' => '订单',
        'nav_admin' => '管理员面板',
        'nav_logout' => '登出',
        'nav_login' => '登录',
        'welcome_user' => '欢迎',
        'place_order_title' => '下单',
        'place_order_success' => '订单已成功提交！',
        'place_order_error' => '无法下单，请重试。',
        'orders_title' => '查看订单',
        'error_not_logged_in' => '请登录以继续下单',
        'cart_empty' => '您的购物车是空的',
        'error_no_checkout_data' => '未提供结账信息'
    ],
    'en' => [
        'site_title' => 'HAF - Place Order',
        'meta_description' => 'Complete your HAF order',
        'nav_history' => 'History',
        'nav_art' => 'Art',
        'nav_fashion' => 'Fashion',
        'nav_shop' => 'Shop',
        'nav_cart' => 'Cart',
        'nav_orders' => 'Orders',
        'nav_admin' => 'Admin Panel',
        'nav_logout' => 'Logout',
        'nav_login' => 'Login',
        'welcome_user' => 'Welcome',
        'place_order_title' => 'Place Order',
        'place_order_success' => 'Order placed successfully!',
        'place_order_error' => 'Failed to place order, please try again.',
        'orders_title' => 'View Orders',
        'error_not_logged_in' => 'Please log in to place an order',
        'cart_empty' => 'Your cart is empty',
        'error_no_checkout_data' => 'No checkout data provided'
    ],
    'ms' => [
        'site_title' => 'HAF - Membuat Pesanan',
        'meta_description' => 'Lengkapkan pesanan HAF anda',
        'nav_history' => 'Sejarah',
        'nav_art' => 'Seni',
        'nav_fashion' => 'Fesyen',
        'nav_shop' => 'Kedai',
        'nav_cart' => 'Troli',
        'nav_orders' => 'Pesanan',
        'nav_admin' => 'Panel Admin',
        'nav_logout' => 'Log Keluar',
        'nav_login' => 'Log Masuk',
        'welcome_user' => 'Selamat Datang',
        'place_order_title' => 'Membuat Pesanan',
        'place_order_success' => 'Pesanan berjaya dibuat!',
        'place_order_error' => 'Gagal membuat pesanan, sila cuba lagi.',
        'orders_title' => 'Lihat Pesanan',
        'error_not_logged_in' => 'Sila log masuk untuk membuat pesanan',
        'cart_empty' => 'Troli anda kosong',
        'error_no_checkout_data' => 'Tiada data pembayaran disediakan'
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
    $_SESSION['error'] = $texts['error_not_logged_in'];
    header("Location: /hsbm/php/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$errors = [];

// Check for checkout data
if (!isset($_SESSION['checkout_data']) || !isset($_SESSION['checkout_data']['address_id']) || 
    (int)$_SESSION['checkout_data']['address_id'] <= 0) {
    $errors[] = $texts['error_no_checkout_data'];
    error_log('No valid checkout data, redirecting to checkout.php: ' . print_r($_SESSION['checkout_data'] ?? 'not set', true), 3, 'C:\wamp64\logs\php_error.log');
    header("Location: /hsbm/php/checkout.php");
    exit;
}

$address_id = (int)$_SESSION['checkout_data']['address_id'];

// Validate address
try {
    $stmt = $pdo->prepare("SELECT id FROM addresses WHERE id = ? AND user_id = ?");
    $stmt->execute([$address_id, $user_id]);
    if (!$stmt->fetch()) {
        $errors[] = $texts['error_no_checkout_data'];
        error_log('Invalid address ID: ' . $address_id, 3, 'C:\wamp64\logs\php_error.log');
    }
} catch (PDOException $e) {
    error_log('Address validation failed: ' . $e->getMessage(), 3, 'C:\wamp64\logs\php_error.log');
    $errors[] = $texts['place_order_error'];
}

// Fetch cart items
try {
    $stmt = $pdo->prepare("SELECT c.product_id, c.quantity, p.price_zh, p.price_en, p.price_ms 
                           FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = ?");
    $stmt->execute([$user_id]);
    $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log('查询购物车失败：' . $e->getMessage(), 3, 'C:\wamp64\logs\php_error.log');
    $errors[] = $texts['place_order_error'];
}

// Validate cart
if (empty($cart_items)) {
    $errors[] = $texts['cart_empty'];
}

// Process order if no errors
if (empty($errors)) {
    $total_zh = $total_en = $total_ms = 0;
    foreach ($cart_items as $item) {
        $total_zh += $item['price_zh'] * $item['quantity'];
        $total_en += $item['price_en'] * $item['quantity'];
        $total_ms += $item['price_ms'] * $item['quantity'];
    }

    try {
        $pdo->beginTransaction();

        // 修改订单插入语句，添加 address_id 字段
        $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_zh, total_en, total_ms, status, address_id) VALUES (?, ?, ?, ?, 'pending', ?)");
        $stmt->execute([$user_id, $total_zh, $total_en, $total_ms, $address_id]);
        $order_id = $pdo->lastInsertId();

        // Insert order items
        $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        foreach ($cart_items as $item) {
            $stmt->execute([$order_id, $item['product_id'], $item['quantity'], $item["price_$lang"]]);
        }

        // Clear cart
        $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->execute([$user_id]);

        $pdo->commit();

        // Clear checkout data
        unset($_SESSION['checkout_data']);
        error_log('Checkout data cleared', 3, 'C:\wamp64\logs\php_error.log');

        $message = $texts['place_order_success'];
    } catch (Exception $e) {
        $pdo->rollBack();
        error_log('下单失败：' . $e->getMessage(), 3, 'C:\wamp64\logs\php_error.log');
        $errors[] = $texts['place_order_error'] . ': ' . $e->getMessage();
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&family=Playfair+Display:wght@400;700&family=Raleway:wght@300;400;500;700&display=swap" rel="stylesheet">
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
        html, body {
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
        .container {
            padding: 40px 10px 24px 10px;
            max-width: 1200px;
            margin: 0 auto;
        }
        h2, h3, h5 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--charcoal);
        }
        h2 {
            font-size: 2.8rem;
            margin-bottom: 20px;
        }
        h3 {
            font-size: 1.8rem;
            margin-bottom: 18px;
        }
        h5 {
            font-size: 1.25rem;
            margin-bottom: 12px;
        }
        .card {
            background: var(--snow);
            border: 2px solid var(--old-lace);
            border-radius: 12px;
            box-shadow: var(--shadow-normal);
            margin-bottom: 24px;
        }
        .card-header {
            background: var(--old-lace);
            border-radius: 12px 12px 0 0;
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--charcoal);
        }
        .card-body {
            font-family: 'Raleway', sans-serif;
            font-size: 1.05rem;
            color: var(--charcoal);
        }
        .btn, .btn-primary {
            background: var(--old-lace) !important;
            color: var(--charcoal) !important;
            border: 2px solid var(--old-lace) !important;
            border-radius: 6px !important;
            font-family: 'Raleway', sans-serif;
            font-size: 1.1rem;
            font-weight: 500;
            padding: 10px 30px !important;
            box-shadow: var(--shadow-normal) !important;
            transition: background 0.2s, border 0.2s, box-shadow 0.2s, color 0.2s;
        }
        .btn:hover, .btn-primary:hover {
            background: var(--ivory) !important;
            color: var(--charcoal) !important;
            border-color: var(--accent-pink) !important;
            box-shadow: var(--shadow-hover) !important;
        }
        .alert {
            font-family: 'Raleway', sans-serif;
            font-size: 1.05rem;
            border-radius: 8px;
            box-shadow: var(--shadow-normal);
        }
        ul {
            font-family: 'Raleway', sans-serif;
            font-size: 1.05rem;
            color: var(--charcoal);
            margin-bottom: 0;
        }
        @media (max-width: 900px) {
            .container {
                padding: 18px 2vw 10px 2vw;
            }
            h2 {
                font-size: 2rem;
            }
            .card {
                margin-bottom: 16px;
            }
        }
        @media (max-width: 600px) {
            .container {
                padding: 8px 1vw 4px 1vw;
            }
            h2 {
                font-size: 1.5rem;
            }
            .card-body, ul {
                font-size: 0.98rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand animate-jitter" href="../index.php">HAF</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
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
                    <li class="nav-item">
                        <select id="language-switcher" class="form-select w-auto">
                            <option value="zh" <?php echo $lang === 'zh' ? 'selected' : ''; ?>>中文</option>
                            <option value="en" <?php echo $lang === 'en' ? 'selected' : ''; ?>>English</option>
                            <option value="ms" <?php echo $lang === 'ms' ? 'selected' : ''; ?>>Bahasa Melayu</option>
                        </select>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2><?php echo htmlspecialchars($texts['place_order_title']); ?></h2>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php elseif (isset($message)): ?>
            <div class="alert alert-success">
                <p><?php echo htmlspecialchars($message); ?></p>
                <p><a href="orders.php" class="btn btn-primary"><?php echo htmlspecialchars($texts['orders_title']); ?></a></p>
            </div>
        <?php else: ?>
            <!-- 添加表单和提交按钮 -->
            <form id="place-order-form" method="POST" action="place_order.php">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">
                <input type="hidden" name="place_order" value="1">
                
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>订单信息</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>总金额:</strong> <?php echo htmlspecialchars($total_zh); ?> 元 / $<?php echo htmlspecialchars($total_en); ?> / RM<?php echo htmlspecialchars($total_ms); ?></p>
                        
                        <h5>购物车商品:</h5>
                        <ul>
                            <?php foreach ($cart_items as $item): ?>
                                <li><?php echo htmlspecialchars($item['quantity']); ?> x 商品ID: <?php echo htmlspecialchars($item['product_id']); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary" id="submit-btn">提交订单</button>
            </form>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        // 语言切换器
        document.getElementById('language-switcher')?.addEventListener('change', function() {
            const lang = this.value;
            fetch('place_order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `lang=${lang}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            });
        });
        
        // 提交订单表单验证
        document.getElementById('place-order-form')?.addEventListener('submit', function(e) {
            // 可以在这里添加额外的表单验证逻辑
            console.log('提交订单表单');
            return true; // 允许表单提交
        });
    </script>
</body>
</html>
<?php
// Clean output buffer
ob_end_flush();
?>