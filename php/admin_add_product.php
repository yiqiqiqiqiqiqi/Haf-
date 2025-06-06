<?php
session_start();
require_once 'config.php';

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
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
        'site_title' => 'HAF - 添加产品',
        'meta_description' => '添加新产品到HAF商店',
        'nav_history' => '历史',
        'nav_art' => '艺术',
        'nav_fashion' => '时尚',
        'nav_shop' => '商店',
        'nav_cart' => '购物车',
        'nav_orders' => '订单',
        'nav_admin' => '管理员面板',
        'nav_add_product' => '添加产品',
        'nav_logout' => '登出',
        'welcome_user' => '欢迎',
        'add_product_title' => '添加新产品',
        'name_zh' => '名称（中文）',
        'name_en' => '名称（英文）',
        'name_ms' => '名称（马来文）',
        'description_zh' => '描述（中文）',
        'description_en' => '描述（英文）',
        'description_ms' => '描述（马来文）',
        'price_zh' => '价格（人民币 ¥）',
        'price_en' => '价格（美元 $）',
        'price_ms' => '价格（马币 RM）',
        'image' => '产品图片',
        'alt_zh' => '图片描述（中文）',
        'alt_en' => '图片描述（英文）',
        'alt_ms' => '图片描述（马来文）',
        'category' => '类别',
        'stock' => '库存数量',
        'add_button' => '添加产品',
        'success_message' => '产品添加成功',
        'error_invalid_input' => '无效的输入数据，请检查所有字段',
        'error_image_upload' => '图片上传失败',
        'error_db' => '数据库操作失败，请联系管理员'
    ],
    'en' => [
        'site_title' => 'HAF - Add Product',
        'meta_description' => 'Add a new product to the HAF shop',
        'nav_history' => 'History',
        'nav_art' => 'Art',
        'nav_fashion' => 'Fashion',
        'nav_shop' => 'Shop',
        'nav_cart' => 'Cart',
        'nav_orders' => 'Orders',
        'nav_admin' => 'Admin Panel',
        'nav_add_product' => 'Add Product',
        'nav_logout' => 'Logout',
        'welcome_user' => 'Welcome',
        'add_product_title' => 'Add New Product',
        'name_zh' => 'Name (Chinese)',
        'name_en' => 'Name (English)',
        'name_ms' => 'Name (Malay)',
        'description_zh' => 'Description (Chinese)',
        'description_en' => 'Description (English)',
        'description_ms' => 'Description (Malay)',
        'price_zh' => 'Price (CNY ¥)',
        'price_en' => 'Price (USD $)',
        'price_ms' => 'Price (MYR RM)',
        'image' => 'Product Image',
        'alt_zh' => 'Alt Text (Chinese)',
        'alt_en' => 'Alt Text (English)',
        'alt_ms' => 'Alt Text (Malay)',
        'category' => 'Category',
        'stock' => 'Stock Quantity',
        'add_button' => 'Add Product',
        'success_message' => 'Product added successfully',
        'error_invalid_input' => 'Invalid input data, please check all fields',
        'error_image_upload' => 'Image upload failed',
        'error_db' => 'Database operation failed, please contact the administrator'
    ],
    'ms' => [
        'site_title' => 'HAF - Tambah Produk',
        'meta_description' => 'Tambah produk baru ke kedai HAF',
        'nav_history' => 'Sejarah',
        'nav_art' => 'Seni',
        'nav_fashion' => 'Fesyen',
        'nav_shop' => 'Kedai',
        'nav_cart' => 'Troli',
        'nav_orders' => 'Pesanan',
        'nav_admin' => 'Panel Admin',
        'nav_add_product' => 'Tambah Produk',
        'nav_logout' => 'Log Keluar',
        'welcome_user' => 'Selamat Datang',
        'add_product_title' => 'Tambah Produk Baru',
        'name_zh' => 'Nama (Cina)',
        'name_en' => 'Nama (Inggeris)',
        'name_ms' => 'Nama (Melayu)',
        'description_zh' => 'Penerangan (Cina)',
        'description_en' => 'Penerangan (Inggeris)',
        'description_ms' => 'Penerangan (Melayu)',
        'price_zh' => 'Harga (CNY ¥)',
        'price_en' => 'Harga (USD $)',
        'price_ms' => 'Harga (MYR RM)',
        'image' => 'Gambar Produk',
        'alt_zh' => 'Teks Alt (Cina)',
        'alt_en' => 'Teks Alt (Inggeris)',
        'alt_ms' => 'Teks Alt (Melayu)',
        'category' => 'Kategori',
        'stock' => 'Kuantiti Stok',
        'add_button' => 'Tambah Produk',
        'success_message' => 'Produk berjaya ditambah',
        'error_invalid_input' => 'Data input tidak sah, sila semak semua medan',
        'error_image_upload' => 'Muat naik gambar gagal',
        'error_db' => 'Operasi pangkalan data gagal, sila hubungi pentadbir'
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

// Handle form submission
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    if (isset($pdo) && $pdo !== null) {
        try {
            $name_zh = filter_var($_POST['name_zh'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $name_en = filter_var($_POST['name_en'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $name_ms = filter_var($_POST['name_ms'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $description_zh = filter_var($_POST['description_zh'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $description_en = filter_var($_POST['description_en'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $description_ms = filter_var($_POST['description_ms'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $price_zh = filter_var($_POST['price_zh'] ?? 0, FILTER_VALIDATE_FLOAT);
            $price_en = filter_var($_POST['price_en'] ?? 0, FILTER_VALIDATE_FLOAT);
            $price_ms = filter_var($_POST['price_ms'] ?? 0, FILTER_VALIDATE_FLOAT);
            $alt_zh = filter_var($_POST['alt_zh'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $alt_en = filter_var($_POST['alt_en'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $alt_ms = filter_var($_POST['alt_ms'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $category = filter_var($_POST['category'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $stock = filter_var($_POST['stock'] ?? 0, FILTER_VALIDATE_INT);

            // Handle image upload
            $image_paths = [];
            if (isset($_FILES['image']) && isset($_FILES['image']['tmp_name']) && is_array($_FILES['image']['tmp_name'])) {
                $allowed_types = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/gif' => 'gif'];
                $max_size = 5 * 1024 * 1024; // 5MB
                foreach ($_FILES['image']['tmp_name'] as $idx => $tmp_name) {
                    if ($_FILES['image']['error'][$idx] === UPLOAD_ERR_OK) {
                        $file_type = mime_content_type($tmp_name);
                        $file_size = $_FILES['image']['size'][$idx];
                        $extension = strtolower(pathinfo($_FILES['image']['name'][$idx], PATHINFO_EXTENSION));
                        if (!$extension && isset($allowed_types[$file_type])) {
                            $extension = $allowed_types[$file_type];
                        }
                        if (isset($allowed_types[$file_type]) && $file_size <= $max_size && in_array($extension, $allowed_types)) {
                            $filename = 'product_' . uniqid() . '.' . $extension;
                            $upload_dir = dirname(__DIR__) . '/images/';
                            if (!is_dir($upload_dir)) {
                                mkdir($upload_dir, 0777, true);
                            }
                            $image_path = 'images/' . $filename;
                            $full_path = $upload_dir . $filename;
                            if (move_uploaded_file($tmp_name, $full_path)) {
                                $image_paths[] = $image_path;
                            }
                        }
                    }
                }
            }

            // Validate inputs
            if ($name_zh && $name_en && $name_ms && $price_zh !== false && $price_en !== false && $price_ms !== false && $stock !== false && $category) {
                $main_image = $image_paths[0] ?? '';
                $stmt = $pdo->prepare("INSERT INTO products (name_zh, name_en, name_ms, description_zh, description_en, description_ms, price_zh, price_en, price_ms, image, alt_zh, alt_en, alt_ms, category, stock) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$name_zh, $name_en, $name_ms, $description_zh, $description_en, $description_ms, $price_zh, $price_en, $price_ms, $main_image, $alt_zh, $alt_en, $alt_ms, $category, $stock]);
                $success = $texts['success_message'];
                $product_id = $pdo->lastInsertId();
                // 新增：同步写入 product_images 表
                foreach ($image_paths as $i => $img_path) {
                    $stmt = $pdo->prepare("INSERT INTO product_images (product_id, image_path, alt_zh, alt_en, alt_ms, is_primary) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$product_id, $img_path, $alt_zh, $alt_en, $alt_ms, $i === 0 ? 1 : 0]);
                }
                // Log the action
                $stmt = $pdo->prepare("INSERT INTO logs (user_id, action, details) VALUES (?, ?, ?)");
                $stmt->execute([
                    $_SESSION['user_id'],
                    'add_product',
                    json_encode(['name_zh' => $name_zh, 'category' => $category, 'stock' => $stock])
                ]);
            } else {
                $error = $texts['error_invalid_input'];
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            error_log('添加产品失败：' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
        }
    } else {
        $error = $texts['error_db'];
        error_log('PDO 未定义或为 null 无法添加产品', 3, 'C:/wamp64/logs/php_error.log');
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
            max-width: 800px;
        }
        h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--charcoal);
            margin-bottom: 24px;
            letter-spacing: 1px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control, .form-select {
            background: var(--ivory);
            border: 2px solid var(--old-lace);
            border-radius: 8px;
            font-family: 'Raleway', sans-serif;
            font-size: 1rem;
            color: var(--charcoal);
            padding: 8px 12px;
            transition: border 0.2s, box-shadow 0.2s, background 0.2s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--accent-blue);
            background: #fff;
            box-shadow: 0 0 0 2px var(--accent-blue);
            outline: none;
        }
        label {
            font-family: 'Raleway', sans-serif;
            font-size: 1.1rem;
            color: var(--charcoal);
            margin-bottom: 8px;
            display: block;
        }
        .btn-primary {
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
        }
        .btn-primary:hover {
            background: var(--old-lace) !important;
            color: var(--charcoal) !important;
            border-color: var(--accent-pink) !important;
            box-shadow: var(--shadow-hover) !important;
        }
        .alert {
            background: var(--linen);
            color: var(--charcoal);
            border: 1.5px solid var(--old-lace);
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 20px;
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
            <div class="navbar-content-center">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link animate-jitter" href="../history.php" data-lang-key="nav_history"><?php echo htmlspecialchars(
                            $texts['nav_history']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate-jitter" href="../art.php" data-lang-key="nav_art"><?php echo htmlspecialchars(
                            $texts['nav_art']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate-jitter" href="../fashion.php" data-lang-key="nav_fashion"><?php echo htmlspecialchars(
                            $texts['nav_fashion']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate-jitter" href="shop.php" data-lang-key="nav_shop"><?php echo htmlspecialchars(
                            $texts['nav_shop']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate-jitter active" href="admin_add_product.php" data-lang-key="nav_add_product"><?php echo htmlspecialchars(
                            $texts['nav_add_product']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate-jitter" href="admin.php" data-lang-key="nav_admin"><?php echo htmlspecialchars(
                            $texts['nav_admin']); ?></a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link"><?php echo htmlspecialchars($texts['welcome_user'] . ' ' . ($_SESSION['username'] ?? '')); ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate-jitter" href="logout.php" data-lang-key="nav_logout"><?php echo htmlspecialchars(
                            $texts['nav_logout']); ?></a>
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
        <h2><?php echo htmlspecialchars($texts['add_product_title']); ?></h2>
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php elseif ($error): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

            <!-- Multilingual Name -->
            <div class="form-group">
                <label for="name_zh"><?php echo htmlspecialchars($texts['name_zh']); ?></label>
                <input type="text" name="name_zh" id="name_zh" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="name_en"><?php echo htmlspecialchars($texts['name_en']); ?></label>
                <input type="text" name="name_en" id="name_en" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="name_ms"><?php echo htmlspecialchars($texts['name_ms']); ?></label>
                <input type="text" name="name_ms" id="name_ms" class="form-control" required>
            </div>

            <!-- Multilingual Description -->
            <div class="form-group">
                <label for="description_zh"><?php echo htmlspecialchars($texts['description_zh']); ?></label>
                <textarea name="description_zh" id="description_zh" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="description_en"><?php echo htmlspecialchars($texts['description_en']); ?></label>
                <textarea name="description_en" id="description_en" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="description_ms"><?php echo htmlspecialchars($texts['description_ms']); ?></label>
                <textarea name="description_ms" id="description_ms" class="form-control"></textarea>
            </div>

            <!-- Multilingual Price -->
            <div class="form-group">
                <label for="price_zh"><?php echo htmlspecialchars($texts['price_zh']); ?></label>
                <input type="number" name="price_zh" id="price_zh" class="form-control" step="0.01" min="0" required>
            </div>
            <div class="form-group">
                <label for="price_en"><?php echo htmlspecialchars($texts['price_en']); ?></label>
                <input type="number" name="price_en" id="price_en" class="form-control" step="0.01" min="0" required>
            </div>
            <div class="form-group">
                <label for="price_ms"><?php echo htmlspecialchars($texts['price_ms']); ?></label>
                <input type="number" name="price_ms" id="price_ms" class="form-control" step="0.01" min="0" required>
            </div>

            <!-- Image Upload -->
            <div class="form-group">
                <label for="image"><?php echo htmlspecialchars($texts['image']); ?></label>
                <input type="file" name="image[]" id="image" class="form-control" accept="image/jpeg,image/png,image/gif" multiple required>
            </div>

            <!-- Multilingual Alt Text -->
            <div class="form-group">
                <label for="alt_zh"><?php echo htmlspecialchars($texts['alt_zh']); ?></label>
                <input type="text" name="alt_zh" id="alt_zh" class="form-control">
            </div>
            <div class="form-group">
                <label for="alt_en"><?php echo htmlspecialchars($texts['alt_en']); ?></label>
                <input type="text" name="alt_en" id="alt_en" class="form-control">
            </div>
            <div class="form-group">
                <label for="alt_ms"><?php echo htmlspecialchars($texts['alt_ms']); ?></label>
                <input type="text" name="alt_ms" id="alt_ms" class="form-control">
            </div>

            <!-- Category and Stock -->
            <div class="form-group">
                <label for="category"><?php echo htmlspecialchars($texts['category']); ?></label>
                <input type="text" name="category" id="category" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="stock"><?php echo htmlspecialchars($texts['stock']); ?></label>
                <input type="number" name="stock" id="stock" class="form-control" min="0" required>
            </div>

            <button type="submit" class="btn btn-primary"><?php echo htmlspecialchars($texts['add_button']); ?></button>
        </form>
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