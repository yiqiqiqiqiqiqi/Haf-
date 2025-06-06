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

// Check if user is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['error'] = '请以管理员身份登录';
    header("Location: admin_login.php");
    exit;
}

// Define translation texts
$languages = [
    'zh' => [
        'site_title' => 'HAF - 编辑产品',
        'meta_description' => '编辑HAF产品信息',
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
        'edit_product' => '编辑产品',
        'name_zh' => '产品名称 (中文)',
        'name_en' => '产品名称 (英文)',
        'name_ms' => '产品名称 (马来文)',
        'description_zh' => '产品描述 (中文)',
        'description_en' => '产品描述 (英文)',
        'description_ms' => '产品描述 (马来文)',
        'price_zh' => '价格 (人民币 ¥)',
        'price_en' => '价格 (美元 $)',
        'price_ms' => '价格 (马币 RM)',
        'image' => '产品图片',
        'alt_zh' => '图片说明 (中文)',
        'alt_en' => '图片说明 (英文)',
        'alt_ms' => '图片说明 (马来文)',
        'category' => '产品类别',
        'stock' => '库存数量',
        'update_button' => '更新产品',
        'error_product_not_found' => '找不到产品',
        'error_db' => '数据库错误',
        'success_update' => '产品更新成功'
    ],
    'en' => [
        'site_title' => 'HAF - Edit Product',
        'meta_description' => 'Edit HAF product information',
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
        'edit_product' => 'Edit Product',
        'name_zh' => 'Product Name (Chinese)',
        'name_en' => 'Product Name (English)',
        'name_ms' => 'Product Name (Malay)',
        'description_zh' => 'Product Description (Chinese)',
        'description_en' => 'Product Description (English)',
        'description_ms' => 'Product Description (Malay)',
        'price_zh' => 'Price (CNY ¥)',
        'price_en' => 'Price (USD $)',
        'price_ms' => 'Price (MYR RM)',
        'image' => 'Product Image',
        'alt_zh' => 'Image Alt Text (Chinese)',
        'alt_en' => 'Image Alt Text (English)',
        'alt_ms' => 'Image Alt Text (Malay)',
        'category' => 'Product Category',
        'stock' => 'Stock Quantity',
        'update_button' => 'Update Product',
        'error_product_not_found' => 'Product not found',
        'error_db' => 'Database error',
        'success_update' => 'Product updated successfully'
    ],
    'ms' => [
        'site_title' => 'HAF - Edit Produk',
        'meta_description' => 'Edit maklumat produk HAF',
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
        'edit_product' => 'Edit Produk',
        'name_zh' => 'Nama Produk (Cina)',
        'name_en' => 'Nama Produk (Inggeris)',
        'name_ms' => 'Nama Produk (Melayu)',
        'description_zh' => 'Penerangan Produk (Cina)',
        'description_en' => 'Penerangan Produk (Inggeris)',
        'description_ms' => 'Penerangan Produk (Melayu)',
        'price_zh' => 'Harga (CNY ¥)',
        'price_en' => 'Harga (USD $)',
        'price_ms' => 'Harga (MYR RM)',
        'image' => 'Imej Produk',
        'alt_zh' => 'Teks Alt Imej (Cina)',
        'alt_en' => 'Teks Alt Imej (Inggeris)',
        'alt_ms' => 'Teks Alt Imej (Melayu)',
        'category' => 'Kategori Produk',
        'stock' => 'Kuantiti Stok',
        'update_button' => 'Kemaskini Produk',
        'error_product_not_found' => 'Produk tidak dijumpai',
        'error_db' => 'Ralat pangkalan data',
        'success_update' => 'Produk berjaya dikemaskini'
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

// Initialize product data
$product = [
    'id' => null,
    'name_zh' => '',
    'name_en' => '',
    'name_ms' => '',
    'description_zh' => '',
    'description_en' => '',
    'description_ms' => '',
    'price_zh' => '',
    'price_en' => '',
    'price_ms' => '',
    'image' => '',
    'alt_zh' => '',
    'alt_en' => '',
    'alt_ms' => '',
    'category' => '',
    'stock' => ''
];

// Fetch product data if ID is provided
$product_id = filter_var($_GET['id'] ?? 0, FILTER_VALIDATE_INT);
if ($product_id) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$product_id]);
        $fetched_product = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($fetched_product) {
            $product = $fetched_product;
        } else {
            $_SESSION['error'] = $texts['error_product_not_found'];
            header("Location: admin_edit_product.php");
            exit;
        }
    } catch (PDOException $e) {
        error_log('查询产品失败：' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
        $_SESSION['error'] = $texts['error_db'];
        header("Location: admin_edit_product.php");
        exit;
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    try {
        $stmt = $pdo->prepare("UPDATE products SET 
            name_zh = ?, name_en = ?, name_ms = ?,
            description_zh = ?, description_en = ?, description_ms = ?,
            price_zh = ?, price_en = ?, price_ms = ?,
            category = ?, stock = ?
            WHERE id = ?");
        
        $stmt->execute([
            $_POST['name_zh'],
            $_POST['name_en'],
            $_POST['name_ms'],
            $_POST['description_zh'],
            $_POST['description_en'],
            $_POST['description_ms'],
            $_POST['price_zh'],
            $_POST['price_en'],
            $_POST['price_ms'],
            $_POST['category'],
            $_POST['stock'],
            $product_id
        ]);

        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = '../images/';
            $file_extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $new_filename = 'product_' . uniqid() . '.' . $file_extension;
            $upload_path = $upload_dir . $new_filename;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                $stmt = $pdo->prepare("UPDATE products SET image = ? WHERE id = ?");
                $stmt->execute(['images/' . $new_filename, $product_id]);
            }
        }

        // Update alt text
        $stmt = $pdo->prepare("UPDATE products SET 
            alt_zh = ?, alt_en = ?, alt_ms = ?
            WHERE id = ?");
        $stmt->execute([
            $_POST['alt_zh'],
            $_POST['alt_en'],
            $_POST['alt_ms'],
            $product_id
        ]);

        $_SESSION['success'] = $texts['success_update'];
        header("Location: admin.php");
        exit;
    } catch (PDOException $e) {
        error_log('更新产品失败：' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--charcoal) !important;
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
        .navbar-nav.flex-row {
            display: flex !important;
            flex-direction: row !important;
            flex-wrap: nowrap !important;
            align-items: center;
            gap: 32px;
        }
        .navbar-lang {
            margin-left: 32px;
            flex-shrink: 0;
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
        .form-container, .product-table-container {
            background: var(--snow);
            border-radius: 12px;
            box-shadow: var(--shadow-normal);
            padding: 24px 20px 20px 20px;
            margin-top: 24px;
        }
        .product-table-container {
            margin-bottom: 32px;
        }
        .product-table-container h4 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--charcoal);
            margin-bottom: 18px;
            letter-spacing: 1px;
        }
        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
        }
        table.table {
            margin-bottom: 0;
            background: var(--linen);
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
        table.table tbody tr:hover {
            background: var(--seashell);
            transition: background 0.2s;
        }
        .btn-primary {
            background: var(--old-lace);
            color: var(--charcoal);
            border: 2px solid var(--old-lace);
            border-radius: 5px;
            font-family: 'Raleway', sans-serif;
            font-size: 1.1rem;
            font-weight: 500;
            padding: 10px 30px;
            box-shadow: var(--shadow-normal);
            transition: background 0.2s, border 0.2s, box-shadow 0.2s;
        }
        .btn-primary:hover {
            background: var(--ivory);
            border: 2px solid var(--charcoal);
            color: var(--charcoal);
            box-shadow: var(--shadow-hover);
        }
        h2.text-center, h4 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }
        label, .form-label {
            font-family: 'Raleway', sans-serif;
            font-weight: 500;
        }
        .form-control, .form-select {
            border-radius: 5px;
            border: 1.5px solid var(--old-lace);
            background: var(--seashell);
            color: var(--charcoal);
            font-family: 'Raleway', sans-serif;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--papaya-whip);
            box-shadow: 0 0 0 2px var(--old-lace-opaque);
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
            .navbar-nav.flex-row {
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
            .navbar-nav.flex-row {
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
            .navbar-nav.flex-row {
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
                <ul class="navbar-nav flex-row align-items-center">
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
                        <a class="nav-link animate-jitter active" href="admin_edit_product.php" data-lang-key="nav_edit_product"><?php echo htmlspecialchars($texts['nav_edit_product']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate-jitter" href="admin.php" data-lang-key="nav_admin"><?php echo htmlspecialchars($texts['nav_admin']); ?></a>
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
        <h2 class="text-center"><?php echo htmlspecialchars($texts['edit_product']); ?></h2>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
        <?php elseif (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <?php if (!$product_id): ?>
            <!-- 产品列表 -->
            <div class="product-table-container">
                <h4><?php echo htmlspecialchars($texts['admin_products'] ?? '产品管理'); ?></h4>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><?php echo htmlspecialchars($texts['product_name'] ?? '产品名称'); ?></th>
                            <th><?php echo htmlspecialchars($texts['product_price'] ?? '价格'); ?></th>
                            <th><?php echo htmlspecialchars($texts['product_stock'] ?? '库存'); ?></th>
                            <th><?php echo htmlspecialchars($texts['edit_product'] ?? '编辑'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        try {
                            $stmt = $pdo->query("SELECT id, name_$lang AS name, price_$lang AS price, stock FROM products ORDER BY id DESC");
                            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        } catch (PDOException $e) {
                            $products = [];
                        }
                        if (empty($products)):
                        ?>
                        <tr><td colspan="5" class="text-center"><?php echo htmlspecialchars($texts['no_products'] ?? '暂无产品'); ?></td></tr>
                        <?php else:
                        foreach ($products as $p): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($p['id']); ?></td>
                            <td><?php echo htmlspecialchars($p['name']); ?></td>
                            <td><?php echo $lang === 'zh' ? '¥' : ($lang === 'en' ? '$' : 'RM'); ?><?php echo number_format($p['price'], 2); ?></td>
                            <td><?php echo htmlspecialchars($p['stock']); ?></td>
                            <td><a href="admin_edit_product.php?id=<?php echo htmlspecialchars($p['id']); ?>" class="btn btn-sm btn-primary"><?php echo htmlspecialchars($texts['edit_product'] ?? '编辑'); ?></a></td>
                        </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
        <div class="form-container">
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                
                <!-- Multilingual Name -->
                <div class="form-group mb-3">
                    <label for="name_zh"><?php echo htmlspecialchars($texts['name_zh']); ?></label>
                    <input type="text" name="name_zh" id="name_zh" class="form-control" value="<?php echo htmlspecialchars($product['name_zh']); ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="name_en"><?php echo htmlspecialchars($texts['name_en']); ?></label>
                    <input type="text" name="name_en" id="name_en" class="form-control" value="<?php echo htmlspecialchars($product['name_en']); ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="name_ms"><?php echo htmlspecialchars($texts['name_ms']); ?></label>
                    <input type="text" name="name_ms" id="name_ms" class="form-control" value="<?php echo htmlspecialchars($product['name_ms']); ?>" required>
                </div>

                <!-- Multilingual Description -->
                <div class="form-group mb-3">
                    <label for="description_zh"><?php echo htmlspecialchars($texts['description_zh']); ?></label>
                    <textarea name="description_zh" id="description_zh" class="form-control" rows="3"><?php echo htmlspecialchars($product['description_zh']); ?></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="description_en"><?php echo htmlspecialchars($texts['description_en']); ?></label>
                    <textarea name="description_en" id="description_en" class="form-control" rows="3"><?php echo htmlspecialchars($product['description_en']); ?></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="description_ms"><?php echo htmlspecialchars($texts['description_ms']); ?></label>
                    <textarea name="description_ms" id="description_ms" class="form-control" rows="3"><?php echo htmlspecialchars($product['description_ms']); ?></textarea>
                </div>

                <!-- Multilingual Price -->
                <div class="form-group mb-3">
                    <label for="price_zh"><?php echo htmlspecialchars($texts['price_zh']); ?></label>
                    <input type="number" name="price_zh" id="price_zh" class="form-control" step="0.01" min="0" value="<?php echo htmlspecialchars($product['price_zh']); ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="price_en"><?php echo htmlspecialchars($texts['price_en']); ?></label>
                    <input type="number" name="price_en" id="price_en" class="form-control" step="0.01" min="0" value="<?php echo htmlspecialchars($product['price_en']); ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="price_ms"><?php echo htmlspecialchars($texts['price_ms']); ?></label>
                    <input type="number" name="price_ms" id="price_ms" class="form-control" step="0.01" min="0" value="<?php echo htmlspecialchars($product['price_ms']); ?>" required>
                </div>

                <!-- Product Image -->
                <div class="form-group mb-3">
                    <label for="image"><?php echo htmlspecialchars($texts['image']); ?></label>
                    <input type="file" name="image" id="image" class="form-control">
                    <?php if (!empty($product['image'])): ?>
                        <div class="mt-2">
                            <img src="../<?php echo htmlspecialchars($product['image']); ?>" alt="Current product image" style="max-width: 200px;">
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Multilingual Alt Text -->
                <div class="form-group mb-3">
                    <label for="alt_zh"><?php echo htmlspecialchars($texts['alt_zh']); ?></label>
                    <input type="text" name="alt_zh" id="alt_zh" class="form-control" value="<?php echo htmlspecialchars($product['alt_zh']); ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="alt_en"><?php echo htmlspecialchars($texts['alt_en']); ?></label>
                    <input type="text" name="alt_en" id="alt_en" class="form-control" value="<?php echo htmlspecialchars($product['alt_en']); ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="alt_ms"><?php echo htmlspecialchars($texts['alt_ms']); ?></label>
                    <input type="text" name="alt_ms" id="alt_ms" class="form-control" value="<?php echo htmlspecialchars($product['alt_ms']); ?>">
                </div>

                <!-- Category and Stock -->
                <div class="form-group mb-3">
                    <label for="category"><?php echo htmlspecialchars($texts['category']); ?></label>
                    <input type="text" name="category" id="category" class="form-control" value="<?php echo htmlspecialchars($product['category']); ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="stock"><?php echo htmlspecialchars($texts['stock']); ?></label>
                    <input type="number" name="stock" id="stock" class="form-control" min="0" value="<?php echo htmlspecialchars($product['stock']); ?>" required>
                </div>

                <button type="submit" class="btn btn-primary"><?php echo htmlspecialchars($texts['update_button']); ?></button>
            </form>
        </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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