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
        'site_title' => 'HAF - 我的订单',
        'meta_description' => '查看您的HAF订单历史',
        'nav_history' => '历史',
        'nav_art' => '艺术',
        'nav_fashion' => '时尚',
        'nav_shop' => '商店',
        'nav_cart' => '购物车',
        'nav_wishlist' => '愿望清单',
        'nav_orders' => '订单',
        'nav_logout' => '登出',
        'welcome_user' => '欢迎',
        'orders_title' => '我的订单',
        'order_id' => '订单编号',
        'total' => '总金额',
        'status' => '状态',
        'date' => '日期',
        'details' => '详情',
        'items' => '订单项目',
        'product' => '产品',
        'quantity' => '数量',
        'price' => '价格',
        'subtotal' => '小计',
        'no_orders' => '您还没有订单',
        'status_pending' => '待处理',
        'status_completed' => '已完成',
        'status_cancelled' => '已取消',
        'error_db' => '数据库操作失败，请联系管理员',
        'previous' => '上一页',
        'next' => '下一页'
    ],
    'en' => [
        'site_title' => 'HAF - My Orders',
        'meta_description' => 'View your HAF order history',
        'nav_history' => 'History',
        'nav_art' => 'Art',
        'nav_fashion' => 'Fashion',
        'nav_shop' => 'Shop',
        'nav_cart' => 'Cart',
        'nav_wishlist' => 'Wishlist',
        'nav_orders' => 'Orders',
        'nav_logout' => 'Logout',
        'welcome_user' => 'Welcome',
        'orders_title' => 'My Orders',
        'order_id' => 'Order ID',
        'total' => 'Total',
        'status' => 'Status',
        'date' => 'Date',
        'details' => 'Details',
        'items' => 'Order Items',
        'product' => 'Product',
        'quantity' => 'Quantity',
        'price' => 'Price',
        'subtotal' => 'Subtotal',
        'no_orders' => 'You have no orders yet',
        'status_pending' => 'Pending',
        'status_completed' => 'Completed',
        'status_cancelled' => 'Cancelled',
        'error_db' => 'Database operation failed, please contact the administrator',
        'previous' => 'Previous',
        'next' => 'Next'
    ],
    'ms' => [
        'site_title' => 'HAF - Pesanan Saya',
        'meta_description' => 'Lihat sejarah pesanan HAF anda',
        'nav_history' => 'Sejarah',
        'nav_art' => 'Seni',
        'nav_fashion' => 'Fesyen',
        'nav_shop' => 'Kedai',
        'nav_cart' => 'Troli',
        'nav_wishlist' => 'Senarai Hati',
        'nav_orders' => 'Pesanan',
        'nav_logout' => 'Log Keluar',
        'welcome_user' => 'Selamat Datang',
        'orders_title' => 'Pesanan Saya',
        'order_id' => 'ID Pesanan',
        'total' => 'Jumlah',
        'status' => 'Status',
        'date' => 'Tarikh',
        'details' => 'Butiran',
        'items' => 'Item Pesanan',
        'product' => 'Produk',
        'quantity' => 'Kuantiti',
        'price' => 'Harga',
        'subtotal' => 'Jumlah Kecil',
        'no_orders' => 'Anda belum mempunyai pesanan',
        'status_pending' => 'Menunggu',
        'status_completed' => 'Selesai',
        'status_cancelled' => 'Dibatalkan',
        'error_db' => 'Operasi pangkalan data gagal, sila hubungi pentadbir',
        'previous' => 'Sebelumnya',
        'next' => 'Seterusnya'
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

// Pagination
$page = isset($_GET['page']) ? max(1, filter_var($_GET['page'], FILTER_VALIDATE_INT)) : 1;
$per_page = 10;
$offset = ($page - 1) * $per_page;

// Fetch orders
try {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM orders WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $total_orders = $stmt->fetchColumn();
    $total_pages = ceil($total_orders / $per_page);

    $stmt = $pdo->prepare("SELECT id, total_$lang AS total, status, created_at 
                           FROM orders 
                           WHERE user_id = ? 
                           ORDER BY created_at DESC 
                           LIMIT ? OFFSET ?");
    $stmt->execute([$_SESSION['user_id'], $per_page, $offset]);
    $orders = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log('Fetch orders failed: ' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
    $_SESSION['error'] = $texts['error_db'];
    $orders = [];
}

// Fetch order details if requested
$order_details = [];
if (isset($_GET['order_id']) && filter_var($_GET['order_id'], FILTER_VALIDATE_INT)) {
    try {
        $stmt = $pdo->prepare("SELECT oi.product_id, p.name_$lang AS name, oi.quantity, oi.price 
                               FROM order_items oi 
                               JOIN products p ON oi.product_id = p.id 
                               WHERE oi.order_id = ?");
        $stmt->execute([$_GET['order_id']]);
        $order_details = $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log('Fetch order details failed: ' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
        $_SESSION['error'] = $texts['error_db'];
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
        h2, h3 {
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
        .table-responsive {
            background: var(--snow);
            border-radius: 12px;
            box-shadow: var(--shadow-normal);
            padding: 20px 10px;
            margin-bottom: 30px;
        }
        .table {
            font-family: 'Raleway', sans-serif;
            font-size: 1rem;
            color: var(--charcoal);
            background: transparent;
        }
        .table th {
            background: var(--old-lace);
            font-weight: 700;
            font-size: 1.08rem;
            color: var(--charcoal);
            text-align: center;
        }
        .table td {
            text-align: center;
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
        .pagination {
            justify-content: center;
            margin-top: 20px;
        }
        .page-link {
            color: var(--charcoal);
            background: var(--seashell);
            border: 1px solid var(--old-lace);
            border-radius: 6px;
            font-family: 'Raleway', sans-serif;
            transition: background 0.2s, color 0.2s;
        }
        .page-item.active .page-link, .page-link:hover {
            background: var(--accent-pink);
            color: var(--charcoal);
            border-color: var(--accent-pink);
        }
        .alert {
            font-family: 'Raleway', sans-serif;
            font-size: 1.05rem;
            border-radius: 8px;
            box-shadow: var(--shadow-normal);
        }
        @media (max-width: 900px) {
            .container {
                padding: 18px 2vw 10px 2vw;
            }
            h2 {
                font-size: 2rem;
            }
            .table-responsive {
                padding: 10px 2px;
            }
        }
        @media (max-width: 600px) {
            .container {
                padding: 8px 1vw 4px 1vw;
            }
            h2 {
                font-size: 1.5rem;
            }
            .table {
                font-size: 0.95rem;
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
                        <a class="nav-link animate-jitter" href="wishlist.php" data-lang-key="nav_wishlist"><?php echo htmlspecialchars($texts['nav_wishlist']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate-jitter active" href="orders.php" data-lang-key="nav_orders"><?php echo htmlspecialchars($texts['nav_orders']); ?></a>
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
        <h2><?php echo htmlspecialchars($texts['orders_title']); ?></h2>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th><?php echo htmlspecialchars($texts['order_id']); ?></th>
                        <th><?php echo htmlspecialchars($texts['total']); ?></th>
                        <th><?php echo htmlspecialchars($texts['status']); ?></th>
                        <th><?php echo htmlspecialchars($texts['date']); ?></th>
                        <th><?php echo htmlspecialchars($texts['details']); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($orders)): ?>
                        <tr>
                            <td colspan="5" class="text-center"><?php echo htmlspecialchars($texts['no_orders']); ?></td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($order['id']); ?></td>
                                <td><?php echo $lang === 'zh' ? '¥' : ($lang === 'en' ? '$' : 'RM'); ?><?php echo number_format($order['total'], 2); ?></td>
                                <td class="status-<?php echo htmlspecialchars($order['status']); ?>">
                                    <?php
                                    $status_map = [
                                        'pending' => $texts['status_pending'],
                                        'completed' => $texts['status_completed'],
                                        'cancelled' => $texts['status_cancelled']
                                    ];
                                    echo htmlspecialchars($status_map[$order['status']] ?? $order['status']);
                                    ?>
                                </td>
                                <td><?php echo htmlspecialchars(date('Y-m-d H:i:s', strtotime($order['created_at']))); ?></td>
                                <td>
                                    <a href="orders.php?order_id=<?php echo htmlspecialchars($order['id']); ?>" class="btn btn-sm btn-primary"><?php echo htmlspecialchars($texts['details']); ?></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                        <a class="page-link" href="orders.php?page=<?php echo $page - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true"><?php echo htmlspecialchars($texts['previous']); ?></span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                            <a class="page-link" href="orders.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?php echo $page >= $total_pages ? 'disabled' : ''; ?>">
                        <a class="page-link" href="orders.php?page=<?php echo $page + 1; ?>" aria-label="Next">
                            <span aria-hidden="true"><?php echo htmlspecialchars($texts['next']); ?></span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>

        <!-- Order Details -->
        <?php if (!empty($order_details)): ?>
            <div class="table-responsive details-table">
                <h3><?php echo htmlspecialchars($texts['items']); ?></h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th><?php echo htmlspecialchars($texts['product']); ?></th>
                            <th><?php echo htmlspecialchars($texts['quantity']); ?></th>
                            <th><?php echo htmlspecialchars($texts['price']); ?></th>
                            <th><?php echo htmlspecialchars($texts['subtotal']); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_details as $item): ?>
                            <?php $subtotal = $item['quantity'] * $item['price']; ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                                <td><?php echo $lang === 'zh' ? '¥' : ($lang === 'en' ? '$' : 'RM'); ?><?php echo number_format($item['price'], 2); ?></td>
                                <td><?php echo $lang === 'zh' ? '¥' : ($lang === 'en' ? '$' : 'RM'); ?><?php echo number_format($subtotal, 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
    });
    </script>
</body>
</html>