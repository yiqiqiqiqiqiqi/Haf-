<?php
// 先设置会话配置，再启动会话
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
session_start();
require_once 'config.php';

// Set strict session settings
session_regenerate_id(true);

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Set default language
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'zh';
}
$lang = $_SESSION['lang'];

// Generate CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Define translation texts
$languages = [
    'zh' => [
        'site_title' => 'HAF - 购物车',
        'meta_description' => '查看和管理您的HAF购物车',
        'nav_history' => '历史',
        'nav_art' => '艺术',
        'nav_fashion' => '时尚',
        'nav_shop' => '商店',
        'nav_cart' => '购物车',
        'nav_wishlist' => '愿望清单',
        'nav_orders' => '订单',
        'nav_logout' => '登出',
        'welcome_user' => '欢迎',
        'cart_title' => '您的购物车',
        'product' => '产品',
        'price' => '价格',
        'quantity' => '数量',
        'total' => '总计',
        'actions' => '操作',
        'remove' => '移除',
        'checkout' => '结账',
        'empty_cart' => '您的购物车是空的',
        'error_update' => '更新购物车失败',
        'error_remove' => '移除产品失败',
        'error_stock' => '库存不足',
        'success_update' => '购物车已更新',
        'error_db' => '数据库错误'  // 添加这一行
    ],
    'en' => [
        'site_title' => 'HAF - Cart',
        'meta_description' => 'View and manage your HAF shopping cart',
        'nav_history' => 'History',
        'nav_art' => 'Art',
        'nav_fashion' => 'Fashion',
        'nav_shop' => 'Shop',
        'nav_cart' => 'Cart',
        'nav_wishlist' => 'Wishlist',
        'nav_orders' => 'Orders',
        'nav_logout' => 'Logout',
        'welcome_user' => 'Welcome',
        'cart_title' => 'Your Cart',
        'product' => 'Product',
        'price' => 'Price',
        'quantity' => 'Quantity',
        'total' => 'Total',
        'actions' => 'Actions',
        'remove' => 'Remove',
        'checkout' => 'Checkout',
        'empty_cart' => 'Your cart is empty',
        'error_update' => 'Failed to update cart',
        'error_remove' => 'Failed to remove product',
        'error_stock' => 'Insufficient stock',
        'success_update' => 'Cart updated successfully',
        'error_db' => 'Database error'  // 添加这一行
    ],
    'ms' => [
        'site_title' => 'HAF - Troli',
        'meta_description' => 'Lihat dan urus troli beli-belah HAF anda',
        'nav_history' => 'Sejarah',
        'nav_art' => 'Seni',
        'nav_fashion' => 'Fesyen',
        'nav_shop' => 'Kedai',
        'nav_cart' => 'Troli',
        'nav_wishlist' => 'Senarai Hati',
        'nav_orders' => 'Pesanan',
        'nav_logout' => 'Log Keluar',
        'welcome_user' => 'Selamat Datang',
        'cart_title' => 'Troli Anda',
        'product' => 'Produk',
        'price' => 'Harga',
        'quantity' => 'Kuantiti',
        'total' => 'Jumlah',
        'actions' => 'Tindakan',
        'remove' => 'Buang',
        'checkout' => 'Daftar Keluar',
        'empty_cart' => 'Troli anda kosong',
        'error_update' => 'Gagal mengemas kini troli',
        'error_remove' => 'Gagal membuang produk',
        'error_stock' => 'Stok tidak mencukupi',
        'success_update' => 'Troli berjaya dikemas kini',
        'error_db' => 'Ralat pangkalan data'  // 添加这一行
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

// Handle quantity update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_quantity' && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    $product_id = filter_var($_POST['product_id'] ?? 0, FILTER_VALIDATE_INT);
    $quantity = filter_var($_POST['quantity'] ?? 0, FILTER_VALIDATE_INT);

    if ($product_id && $quantity >= 1) {
        try {
            // Check stock
            $stmt = $pdo->prepare("SELECT stock FROM products WHERE id = ?");
            $stmt->execute([$product_id]);
            $product = $stmt->fetch();
            if ($product && $quantity <= $product['stock']) {
                $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
                $stmt->execute([$quantity, $_SESSION['user_id'], $product_id]);
                echo json_encode(['success' => true, 'message' => $texts['success_update']]);
            } else {
                echo json_encode(['success' => false, 'message' => $texts['error_stock']]);
            }
        } catch (PDOException $e) {
            error_log('Update cart failed: ' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
            echo json_encode(['success' => false, 'message' => $texts['error_update']]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => $texts['error_update']]);
    }
    exit;
}

// Handle remove item
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'remove' && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    $product_id = filter_var($_POST['product_id'] ?? 0, FILTER_VALIDATE_INT);
    if ($product_id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
            $stmt->execute([$_SESSION['user_id'], $product_id]);
            $_SESSION['success'] = $texts['success_update'];
        } catch (PDOException $e) {
            error_log('Remove from cart failed: ' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
            $_SESSION['error'] = $texts['error_remove'];
        }
    }
    header("Location: cart.php");
    exit;
}

// Fetch cart items
try {
    $stmt = $pdo->prepare("SELECT c.product_id, p.name_$lang AS name, p.price_$lang AS price, c.quantity, p.image, p.stock 
                           FROM cart c 
                           JOIN products p ON c.product_id = p.id 
                           WHERE c.user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $cart_items = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log('Fetch cart failed: ' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
    $_SESSION['error'] = $texts['error_db'];
    $cart_items = [];
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
            --accent-blue: #B8E0FF;
            --accent-pink: #FFD6E0;
            --shadow-normal: 0 4px 16px rgba(0,0,0,0.10);
            --shadow-hover: 0 8px 32px rgba(0,0,0,0.15);
        }
        body {
            font-family: 'Poppins', 'Raleway', Arial, sans-serif;
            background: var(--custom-light);
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
            background: #fff;
            border-radius: 12px;
            box-shadow: var(--shadow-normal);
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
        .container {
            padding: 32px 10px;
        }
        h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--charcoal);
            margin-bottom: 24px;
            letter-spacing: 1px;
        }
        .table-responsive {
            background: var(--snow);
            border-radius: 14px;
            box-shadow: var(--shadow-normal);
            padding: 18px 10px 10px 10px;
            margin-bottom: 32px;
        }
        table.table {
            background: var(--linen);
            border-radius: 12px;
            margin-bottom: 0;
        }
        table.table thead {
            background: var(--old-lace);
        }
        table.table th {
            font-family: 'Raleway', sans-serif;
            font-size: 1.08rem;
            font-weight: 700;
            color: var(--charcoal);
            letter-spacing: 0.5px;
            vertical-align: middle;
            text-align: center;
        }
        table.table td {
            font-family: 'Raleway', sans-serif;
            font-size: 1rem;
            color: var(--charcoal);
            vertical-align: middle;
            text-align: center;
        }
        .product-image {
            width: 50px;
            height: auto;
            border-radius: 6px;
            margin-right: 8px;
        }
        .quantity-input, .form-control {
            width: 70px;
            text-align: center;
            border-radius: 8px;
            border: 2px solid var(--old-lace);
            background: var(--snow);
            color: var(--charcoal);
            font-family: 'Raleway', sans-serif;
            font-size: 1rem;
            padding: 8px 10px;
            transition: border 0.2s, box-shadow 0.2s, background 0.2s;
        }
        .quantity-input:focus, .form-control:focus {
            border-color: var(--accent-blue);
            background: #fff;
            box-shadow: 0 0 0 2px var(--accent-blue);
            outline: none;
        }
        .btn, .btn-primary, .btn-danger, .btn-checkout {
            background: var(--ivory) !important;
            color: var(--charcoal) !important;
            border: 2px solid var(--charcoal) !important;
            border-radius: 10px !important;
            font-family: 'Raleway', sans-serif;
            font-size: 1.1rem;
            font-weight: 500;
            padding: 10px 30px !important;
            box-shadow: var(--shadow-normal) !important;
            transition: background 0.2s, border 0.2s, box-shadow 0.2s, color 0.2s;
            display: inline-block;
        }
        .btn:hover, .btn-primary:hover, .btn-danger:hover, .btn-checkout:hover {
            background: var(--old-lace) !important;
            color: var(--charcoal) !important;
            border-color: var(--accent-pink) !important;
            box-shadow: var(--shadow-hover) !important;
        }
        .btn:disabled, .btn-primary:disabled, .btn-danger:disabled, .btn-checkout:disabled {
            background: #f3f3f3 !important;
            color: #aaa !important;
            border-color: #eee !important;
            cursor: not-allowed !important;
            box-shadow: none !important;
        }
        .alert-success {
            background: var(--linen);
            color: var(--charcoal);
            border: 1.5px solid var(--old-lace);
        }
        .alert-danger {
            background: var(--accent-pink);
            color: var(--charcoal);
            border: 1.5px solid var(--old-lace);
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
                        <a class="nav-link animate-jitter active" href="cart.php" data-lang-key="nav_cart"><?php echo htmlspecialchars($texts['nav_cart']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate-jitter" href="wishlist.php" data-lang-key="nav_wishlist"><?php echo htmlspecialchars($texts['nav_wishlist']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate-jitter" href="orders.php" data-lang-key="nav_orders"><?php echo htmlspecialchars($texts['nav_orders']); ?></a>
                    </li>
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
        <h2><?php echo htmlspecialchars($texts['cart_title']); ?></h2>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
        <?php elseif (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th><?php echo htmlspecialchars($texts['product']); ?></th>
                        <th><?php echo htmlspecialchars($texts['price']); ?></th>
                        <th><?php echo htmlspecialchars($texts['quantity']); ?></th>
                        <th><?php echo htmlspecialchars($texts['total']); ?></th>
                        <th><?php echo htmlspecialchars($texts['actions']); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($cart_items)): ?>
                        <tr>
                            <td colspan="5" class="text-center"><?php echo htmlspecialchars($texts['empty_cart']); ?></td>
                        </tr>
                    <?php else: ?>
                        <?php $grand_total = 0; ?>
                        <?php foreach ($cart_items as $item): ?>
                            <?php $subtotal = $item['price'] * $item['quantity']; $grand_total += $subtotal; ?>
                            <tr>
                                <td>
                                    <?php if ($item['image']): ?>
                                        <img src="../<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="product-image">
                                    <?php endif; ?>
                                    <?php echo htmlspecialchars($item['name']); ?>
                                </td>
                                <td><?php echo $lang === 'zh' ? '¥' : ($lang === 'en' ? '$' : 'RM'); ?><?php echo number_format($item['price'], 2); ?></td>
                                <td>
                                    <input type="number" class="form-control quantity-input" data-product-id="<?php echo htmlspecialchars($item['product_id']); ?>" value="<?php echo htmlspecialchars($item['quantity']); ?>" min="1" max="<?php echo htmlspecialchars($item['stock']); ?>">
                                </td>
                                <td><?php echo $lang === 'zh' ? '¥' : ($lang === 'en' ? '$' : 'RM'); ?><?php echo number_format($subtotal, 2); ?></td>
                                <td>
                                    <form method="POST" class="d-inline">
                                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                                        <input type="hidden" name="action" value="remove">
                                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($item['product_id']); ?>">
                                        <button type="submit" class="btn btn-sm btn-danger"><?php echo htmlspecialchars($texts['remove']); ?></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="3" class="text-end"><strong><?php echo htmlspecialchars($texts['total']); ?>:</strong></td>
                            <td><strong><?php echo $lang === 'zh' ? '¥' : ($lang === 'en' ? '$' : 'RM'); ?><?php echo number_format($grand_total, 2); ?></strong></td>
                            <td></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if (!empty($cart_items)): ?>
            <div class="text-end mt-3">
                <a href="place_order.php" class="btn btn-checkout"><?php echo htmlspecialchars($texts['checkout']); ?></a>
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
                element.textContent = languages[lang][key] || languages['zh'][key] || key;
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
                .catch(error => console.error('Language switch failed:', error));
            });
        }

        // Handle quantity updates
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', (e) => {
                const productId = e.target.dataset.productId;
                const quantity = parseInt(e.target.value);
                if (quantity < 1 || isNaN(quantity)) {
                    e.target.value = 1;
                    return;
                }
                fetch('', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `action=update_quantity&product_id=${encodeURIComponent(productId)}&quantity=${encodeURIComponent(quantity)}&csrf_token=${encodeURIComponent('<?php echo $_SESSION['csrf_token']; ?>')}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert(data.message);
                        e.target.value = e.target.defaultValue;
                    }
                })
                .catch(error => {
                    console.error('Update quantity failed:', error);
                    alert('<?php echo $texts['error_update']; ?>');
                    e.target.value = e.target.defaultValue;
                });
            });
        });
    });
    </script>
</body>
</html>