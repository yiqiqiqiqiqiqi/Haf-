<?php
session_start();
require_once 'config.php';

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
        'site_title' => 'HAF - 管理员面板',
        'meta_description' => '管理HAF的订单和用户',
        'nav_history' => '历史',
        'nav_art' => '艺术',
        'nav_fashion' => '时尚',
        'nav_shop' => '商店',
        'nav_cart' => '购物车',
        'nav_orders' => '订单',
        'nav_admin' => '管理员面板',
        'nav_add_product' => '添加产品',
        'nav_edit_product' => '编辑产品',
        'nav_logout' => '登出',
        'welcome_user' => '欢迎',
        'admin_title' => '管理员面板',
        'admin_order_id' => '订单编号',
        'admin_user' => '用户',
        'admin_total' => '总金额',
        'admin_status' => '状态',
        'admin_date' => '日期',
        'admin_actions' => '操作',
        'admin_products' => '产品管理',
        'product_id' => '产品编号',
        'product_name' => '产品名称',
        'product_price' => '价格',
        'product_stock' => '库存',
        'status_pending' => '待处理',
        'status_completed' => '已完成',
        'status_cancelled' => '已取消',
        'error_unauthorized' => '请以管理员身份登录',
        'error_product_delete' => '删除产品失败',
        'success_product_delete' => '产品已删除',
        'no_orders' => '暂无订单',
        'no_products' => '暂无产品',
        'edit_product' => '编辑',
        'delete_product' => '删除',
        'previous' => '上一页',
        'next' => '下一页'
    ],
    'en' => [
        'site_title' => 'HAF - Admin Panel',
        'meta_description' => 'Manage HAF orders and users',
        'nav_history' => 'History',
        'nav_art' => 'Art',
        'nav_fashion' => 'Fashion',
        'nav_shop' => 'Shop',
        'nav_cart' => 'Cart',
        'nav_orders' => 'Orders',
        'nav_admin' => 'Admin Panel',
        'nav_add_product' => 'Add Product',
        'nav_edit_product' => 'Edit Product',
        'nav_logout' => 'Logout',
        'welcome_user' => 'Welcome',
        'admin_title' => 'Admin Panel',
        'admin_order_id' => 'Order ID',
        'admin_user' => 'User',
        'admin_total' => 'Total',
        'admin_status' => 'Status',
        'admin_date' => 'Date',
        'admin_actions' => 'Actions',
        'admin_products' => 'Product Management',
        'product_id' => 'Product ID',
        'product_name' => 'Product Name',
        'product_price' => 'Price',
        'product_stock' => 'Stock',
        'status_pending' => 'Pending',
        'status_completed' => 'Completed',
        'status_cancelled' => 'Cancelled',
        'error_unauthorized' => 'Please log in as an admin',
        'error_product_delete' => 'Failed to delete product',
        'success_product_delete' => 'Product deleted successfully',
        'no_orders' => 'No orders found',
        'no_products' => 'No products found',
        'edit_product' => 'Edit',
        'delete_product' => 'Delete',
        'previous' => 'Previous',
        'next' => 'Next'
    ],
    'ms' => [
        'site_title' => 'HAF - Panel Admin',
        'meta_description' => 'Urus pesanan dan pengguna HAF',
        'nav_history' => 'Sejarah',
        'nav_art' => 'Seni',
        'nav_fashion' => 'Fesyen',
        'nav_shop' => 'Kedai',
        'nav_cart' => 'Troli',
        'nav_orders' => 'Pesanan',
        'nav_admin' => 'Panel Admin',
        'nav_add_product' => 'Tambah Produk',
        'nav_edit_product' => 'Edit Produk',
        'nav_logout' => 'Log Keluar',
        'welcome_user' => 'Selamat Datang',
        'admin_title' => 'Panel Admin',
        'admin_order_id' => 'ID Pesanan',
        'admin_user' => 'Pengguna',
        'admin_total' => 'Jumlah',
        'admin_status' => 'Status',
        'admin_date' => 'Tarikh',
        'admin_actions' => 'Tindakan',
        'admin_products' => 'Pengurusan Produk',
        'product_id' => 'ID Produk',
        'product_name' => 'Nama Produk',
        'product_price' => 'Harga',
        'product_stock' => 'Stok',
        'status_pending' => 'Menunggu',
        'status_completed' => 'Selesai',
        'status_cancelled' => 'Dibatalkan',
        'error_unauthorized' => 'Sila log masuk sebagai admin',
        'error_product_delete' => 'Gagal memadam produk',
        'success_product_delete' => 'Produk berjaya dipadam',
        'no_orders' => 'Tiada pesanan ditemui',
        'no_products' => 'Tiada produk ditemui',
        'edit_product' => 'Edit',
        'delete_product' => 'Padam',
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

// Check if user is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['error'] = $texts['error_unauthorized'];
    header("Location: admin_login.php");
    exit;
}

// Handle order status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['status'], $_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    $order_id = filter_var($_POST['order_id'], FILTER_VALIDATE_INT);
    $status = in_array($_POST['status'], ['pending', 'completed', 'cancelled']) ? $_POST['status'] : 'pending';
    try {
        $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmt->execute([$status, $order_id]);
        $_SESSION['success'] = $texts['status_' . $status];
    } catch (PDOException $e) {
        error_log('更新订单状态失败：' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
        $_SESSION['error'] = '更新订单状态失败';
    }
}

// Handle product deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product_id'], $_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    $product_id = filter_var($_POST['delete_product_id'], FILTER_VALIDATE_INT);
    try {
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$product_id]);
        $_SESSION['success'] = $texts['success_product_delete'];
    } catch (PDOException $e) {
        error_log('删除产品失败：' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
        $_SESSION['error'] = $texts['error_product_delete'];
    }
}

// Pagination for orders
$page = isset($_GET['page']) ? max(1, filter_var($_GET['page'], FILTER_VALIDATE_INT)) : 1;
$per_page = 10;
$offset = ($page - 1) * $per_page;

// Fetch orders
try {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM orders o JOIN users u ON o.user_id = u.id");
    $stmt->execute();
    $total_orders = $stmt->fetchColumn();
    $total_pages = ceil($total_orders / $per_page);

    $stmt = $pdo->prepare("SELECT o.id, o.user_id, u.username, o.total_$lang AS total, o.status, o.created_at 
                           FROM orders o JOIN users u ON o.user_id = u.id 
                           ORDER BY o.created_at DESC LIMIT ? OFFSET ?");
    $stmt->execute([$per_page, $offset]);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log('查询订单失败：' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
    $orders = [];
    $_SESSION['error'] = '无法加载订单';
}

// Fetch products
try {
    $stmt = $pdo->query("SELECT id, name_$lang AS name, price_$lang AS price, stock FROM products ORDER BY id DESC");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log('查询产品失败：' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
    $products = [];
    $_SESSION['error'] = '无法加载产品';
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
            --gradient: linear-gradient(135deg, var(--papaya-whip) 0%, var(--snow) 100%);
            --shadow-normal: 0 4px 16px rgba(0,0,0,0.10);
            --shadow-hover: 0 8px 32px rgba(0,0,0,0.15);
        }
        html, body {
            background: var(--custom-light);
            font-family: 'Poppins', 'Raleway', Arial, sans-serif;
            color: var(--charcoal);
            box-sizing: border-box;
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
        h2, h3 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--charcoal);
            letter-spacing: 1px;
        }
        h2 {
            font-size: 2.2rem;
            margin-bottom: 24px;
        }
        h3 {
            font-size: 1.5rem;
            margin-bottom: 18px;
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
        .btn, .btn-primary, .btn-danger {
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
        .btn:hover, .btn-primary:hover, .btn-danger:hover {
            background: var(--old-lace) !important;
            color: var(--charcoal) !important;
            border-color: var(--accent-pink) !important;
            box-shadow: var(--shadow-hover) !important;
        }
        .btn:disabled, .btn-primary:disabled, .btn-danger:disabled {
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
        select, .form-select {
            background: var(--ivory);
            border: 2px solid var(--old-lace);
            border-radius: 8px;
            font-family: 'Raleway', sans-serif;
            font-size: 1rem;
            color: var(--charcoal);
            padding: 6px 12px;
            transition: border 0.2s, box-shadow 0.2s, background 0.2s;
        }
        select:focus, .form-select:focus {
            border-color: var(--accent-blue);
            background: #fff;
            box-shadow: 0 0 0 2px var(--accent-blue);
            outline: none;
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
                        <a class="nav-link animate-jitter" href="admin_add_product.php" data-lang-key="nav_add_product"><?php echo htmlspecialchars($texts['nav_add_product']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate-jitter" href="admin_edit_product.php" data-lang-key="nav_edit_product"><?php echo htmlspecialchars($texts['nav_edit_product']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate-jitter active" href="admin.php" data-lang-key="nav_admin"><?php echo htmlspecialchars($texts['nav_admin']); ?></a>
                    </li>
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
        <h2 class="text-center"><?php echo htmlspecialchars($texts['admin_title']); ?></h2>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
        <?php elseif (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <!-- Orders Section -->
        <h3><?php echo htmlspecialchars($texts['admin_title']); ?></h3>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th><?php echo htmlspecialchars($texts['admin_order_id']); ?></th>
                    <th><?php echo htmlspecialchars($texts['admin_user']); ?></th>
                    <th><?php echo htmlspecialchars($texts['admin_total']); ?></th>
                    <th><?php echo htmlspecialchars($texts['admin_status']); ?></th>
                    <th><?php echo htmlspecialchars($texts['admin_date']); ?></th>
                    <th><?php echo htmlspecialchars($texts['admin_actions']); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($orders)): ?>
                    <tr>
                        <td colspan="6" class="text-center"><?php echo htmlspecialchars($texts['no_orders']); ?></td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['id']); ?></td>
                            <td><?php echo htmlspecialchars($order['username']); ?></td>
                            <td><?php echo $lang === 'zh' ? '¥' : ($lang === 'en' ? '$' : 'RM'); ?><?php echo number_format($order['total'], 2); ?></td>
                            <td><?php echo htmlspecialchars($texts['status_' . $order['status']] ?? $order['status']); ?></td>
                            <td><?php echo htmlspecialchars($order['created_at']); ?></td>
                            <td>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                                    <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['id']); ?>">
                                    <select name="status" onchange="this.form.submit()">
                                        <option value="pending" <?php echo $order['status'] === 'pending' ? 'selected' : ''; ?>><?php echo htmlspecialchars($texts['status_pending']); ?></option>
                                        <option value="completed" <?php echo $order['status'] === 'completed' ? 'selected' : ''; ?>><?php echo htmlspecialchars($texts['status_completed']); ?></option>
                                        <option value="cancelled" <?php echo $order['status'] === 'cancelled' ? 'selected' : ''; ?>><?php echo htmlspecialchars($texts['status_cancelled']); ?></option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                    <a class="page-link" href="admin.php?page=<?php echo $page - 1; ?>"><?php echo htmlspecialchars($texts['previous']); ?></a>
                </li>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                        <a class="page-link" href="admin.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php echo $page >= $total_pages ? 'disabled' : ''; ?>">
                    <a class="page-link" href="admin.php?page=<?php echo $page + 1; ?>"><?php echo htmlspecialchars($texts['next']); ?></a>
                </li>
            </ul>
        </nav>

        <!-- Products Section -->
        <h3 class="mt-5"><?php echo htmlspecialchars($texts['admin_products']); ?></h3>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th><?php echo htmlspecialchars($texts['product_id']); ?></th>
                    <th><?php echo htmlspecialchars($texts['product_name']); ?></th>
                    <th><?php echo htmlspecialchars($texts['product_price']); ?></th>
                    <th><?php echo htmlspecialchars($texts['product_stock']); ?></th>
                    <th><?php echo htmlspecialchars($texts['admin_actions']); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                    <tr>
                        <td colspan="5" class="text-center"><?php echo htmlspecialchars($texts['no_products']); ?></td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($product['id']); ?></td>
                            <td><?php echo htmlspecialchars($product['name']); ?></td>
                            <td><?php echo $lang === 'zh' ? '¥' : ($lang === 'en' ? '$' : 'RM'); ?><?php echo number_format($product['price'], 2); ?></td>
                            <td><?php echo htmlspecialchars($product['stock']); ?></td>
                            <td>
                                <a href="admin_edit_product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-sm btn-primary"><?php echo htmlspecialchars($texts['edit_product']); ?></a>
                                <form method="POST" class="d-inline" onsubmit="return confirm('确定要删除此产品吗？');">
                                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                                    <input type="hidden" name="delete_product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                                    <button type="submit" class="btn btn-sm btn-danger"><?php echo htmlspecialchars($texts['delete_product']); ?></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
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
                .catch(error => console.error('语言切换失败：', error));
            });
        }
    });
    </script>
</body>
</html>