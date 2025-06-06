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
        'site_title' => 'HAF - 商店',
        'meta_description' => '探索HAF的艺术、历史和时尚',
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
        'shop_title' => '商店',
        'shop_add_to_cart' => '加入购物车',
        'shop_add_to_wishlist' => '加入愿望清单',
        'shop_remove_from_wishlist' => '从愿望清单移除',
        'no_products' => '暂无产品',
        'error_message' => '操作失败，请重试',
        'success_message' => '已加入购物车',
        'wishlist_success' => '已加入愿望清单',
        'wishlist_remove_success' => '已从愿望清单移除',
        'review_success' => '评论提交成功',
        'db_error' => '数据库连接失败，请联系管理员',
        'filter_by_price' => '按价格筛选',
        'filter_by_category' => '按类别筛选',
        'search_placeholder' => '搜索产品...',
        'sort_by' => '排序方式',
        'sort_name_asc' => '名称 (A-Z)',
        'sort_name_desc' => '名称 (Z-A)',
        'sort_price_asc' => '价格 (低到高)',
        'sort_price_desc' => '价格 (高到低)',
        'category_all' => '所有类别',
        'stock_available' => '有货',
        'out_of_stock' => '无货',
        'apply_filters' => '应用筛选',
        'reset_filters' => '重置筛选',
        'products_per_page' => '每页产品数',
        'previous' => '上一页',
        'next' => '下一页',
        'discount_label' => '折扣',
        'original_price' => '原价',
        'submit_review' => '提交评论',
        'rating' => '评分',
        'comment' => '评论',
        'no_reviews' => '暂无评论',
        'average_rating' => '平均评分'
    ],
    'en' => [
        'site_title' => 'HAF - Shop',
        'meta_description' => 'Explore HAF\'s art, history, and fashion',
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
        'shop_title' => 'Shop',
        'shop_add_to_cart' => 'Add to Cart',
        'shop_add_to_wishlist' => 'Add to Wishlist',
        'shop_remove_from_wishlist' => 'Remove from Wishlist',
        'no_products' => 'No products found',
        'error_message' => 'Operation failed, please try again',
        'success_message' => 'Added to cart',
        'wishlist_success' => 'Added to wishlist',
        'wishlist_remove_success' => 'Removed from wishlist',
        'review_success' => 'Review submitted successfully',
        'db_error' => 'Database connection failed, please contact the administrator',
        'filter_by_price' => 'Filter by Price',
        'filter_by_category' => 'Filter by Category',
        'search_placeholder' => 'Search products...',
        'sort_by' => 'Sort By',
        'sort_name_asc' => 'Name (A-Z)',
        'sort_name_desc' => 'Name (Z-A)',
        'sort_price_asc' => 'Price (Low to High)',
        'sort_price_desc' => 'Price (High to Low)',
        'category_all' => 'All Categories',
        'stock_available' => 'In Stock',
        'out_of_stock' => 'Out of Stock',
        'apply_filters' => 'Apply Filters',
        'reset_filters' => 'Reset Filters',
        'products_per_page' => 'Products per Page',
        'previous' => 'Previous',
        'next' => 'Next',
        'discount_label' => 'Discount',
        'original_price' => 'Original Price',
        'submit_review' => 'Submit Review',
        'rating' => 'Rating',
        'comment' => 'Comment',
        'no_reviews' => 'No reviews yet',
        'average_rating' => 'Average Rating'
    ],
    'ms' => [
        'site_title' => 'HAF - Kedai',
        'meta_description' => 'Terokai seni, sejarah, dan fesyen HAF',
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
        'shop_title' => 'Kedai',
        'shop_add_to_cart' => 'Tambah ke Troli',
        'shop_add_to_wishlist' => 'Tambah ke Senarai Hajat',
        'shop_remove_from_wishlist' => 'Buang dari Senarai Hajat',
        'no_products' => 'Tiada produk ditemui',
        'error_message' => 'Operasi gagal, sila cuba lagi',
        'success_message' => 'Ditambah ke troli',
        'wishlist_success' => 'Ditambah ke senarai hajat',
        'wishlist_remove_success' => 'Dibuang dari senarai hajat',
        'review_success' => 'Ulasan berjaya dihantar',
        'db_error' => 'Sambungan pangkalan data gagal, sila hubungi pentadbir',
        'filter_by_price' => 'Tapis mengikut Harga',
        'filter_by_category' => 'Tapis mengikut Kategori',
        'search_placeholder' => 'Cari produk...',
        'sort_by' => 'Susun Mengikut',
        'sort_name_asc' => 'Nama (A-Z)',
        'sort_name_desc' => 'Nama (Z-A)',
        'sort_price_asc' => 'Harga (Rendah ke Tinggi)',
        'sort_price_desc' => 'Harga (Tinggi ke Rendah)',
        'category_all' => 'Semua Kategori',
        'stock_available' => 'Ada Stok',
        'out_of_stock' => 'Kehabisan Stok',
        'apply_filters' => 'Gunakan Penapis',
        'reset_filters' => 'Set Semula Penapis',
        'products_per_page' => 'Produk setiap Muka Surat',
        'previous' => 'Sebelumnya',
        'next' => 'Seterusnya',
        'discount_label' => 'Diskaun',
        'original_price' => 'Harga Asal',
        'submit_review' => 'Hantar Ulasan',
        'rating' => 'Penilaian',
        'comment' => 'Komen',
        'no_reviews' => 'Tiada ulasan lagi',
        'average_rating' => 'Penilaian Purata'
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

// Handle filters, sorting, and pagination
$search = isset($_GET['search']) ? trim(filter_var($_GET['search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) : '';
$min_price = isset($_GET['min_price']) ? filter_var($_GET['min_price'], FILTER_VALIDATE_FLOAT) : null;
$max_price = isset($_GET['max_price']) ? filter_var($_GET['max_price'], FILTER_VALIDATE_FLOAT) : null;
$category = isset($_GET['category']) ? trim(filter_var($_GET['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'name_asc';
$page = isset($_GET['page']) ? max(1, filter_var($_GET['page'], FILTER_VALIDATE_INT)) : 1;
$per_page = 9; // Products per page

// Build the query
$query = "SELECT p.*, 
                 (SELECT AVG(rating) FROM product_reviews WHERE product_id = p.id) AS average_rating,
                 (SELECT COUNT(*) FROM product_reviews WHERE product_id = p.id) AS review_count
          FROM products p WHERE 1=1";
$params = [];

// Apply search filter
if ($search) {
    $query .= " AND (p.name_zh LIKE ? OR p.name_en LIKE ? OR p.name_ms LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

// Apply price filter
if ($min_price !== null) {
    $query .= " AND p.price_$lang >= ?";
    $params[] = $min_price;
}
if ($max_price !== null) {
    $query .= " AND p.price_$lang <= ?";
    $params[] = $max_price;
}

// Apply category filter
if ($category && $category !== 'all') {
    $query .= " AND p.category = ?";
    $params[] = $category;
}

// Apply sorting
$sort_options = [
    'name_asc' => "p.name_$lang ASC",
    'name_desc' => "p.name_$lang DESC",
    'price_asc' => "p.price_$lang ASC",
    'price_desc' => "p.price_$lang DESC"
];
$order_by = $sort_options[$sort] ?? $sort_options['name_asc'];
$query .= " ORDER BY $order_by";

// Pagination
$offset = ($page - 1) * $per_page;
$query .= " LIMIT ? OFFSET ?";
$params[] = $per_page;
$params[] = $offset;

// Fetch total number of products for pagination
$total_query = "SELECT COUNT(*) FROM products WHERE 1=1";
$total_params = [];
if ($search) {
    $total_query .= " AND (name_zh LIKE ? OR name_en LIKE ? OR name_ms LIKE ?)";
    $total_params[] = "%$search%";
    $total_params[] = "%$search%";
    $total_params[] = "%$search%";
}
if ($min_price !== null) {
    $total_query .= " AND price_$lang >= ?";
    $total_params[] = $min_price;
}
if ($max_price !== null) {
    $total_query .= " AND price_$lang <= ?";
    $total_params[] = $max_price;
}
if ($category && $category !== 'all') {
    $total_query .= " AND category = ?";
    $total_params[] = $category;
}

// Fetch products and images
$products = [];
$product_images = [];
$total_products = 0;
if (isset($pdo) && $pdo !== null) {
    try {
        // Fetch total count
        $stmt = $pdo->prepare($total_query);
        $stmt->execute($total_params);
        $total_products = $stmt->fetchColumn();

        // Fetch products
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Fetch images for all products
        $product_ids = array_column($products, 'id');
        if (!empty($product_ids)) {
            $placeholders = str_repeat('?,', count($product_ids) - 1) . '?';
            $stmt = $pdo->prepare("SELECT * FROM product_images WHERE product_id IN ($placeholders) ORDER BY product_id, is_primary DESC, id");
            $stmt->execute($product_ids);
            while ($image = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $product_images[$image['product_id']][] = $image;
            }
        }

        // Fetch reviews for all products
        $reviews = [];
        if (!empty($product_ids)) {
            $placeholders = str_repeat('?,', count($product_ids) - 1) . '?';
            $stmt = $pdo->prepare("SELECT r.*, u.username 
                                   FROM product_reviews r 
                                   JOIN users u ON r.user_id = u.id 
                                   WHERE r.product_id IN ($placeholders) 
                                   ORDER BY r.created_at DESC");
            $stmt->execute($product_ids);
            while ($review = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $reviews[$review['product_id']][] = $review;
            }
        }

        // Check wishlist status
        $wishlist = [];
        if (isset($_SESSION['user_id']) && !empty($product_ids)) {
            $placeholders = str_repeat('?,', count($product_ids) - 1) . '?';
            $stmt = $pdo->prepare("SELECT product_id FROM wishlist WHERE user_id = ? AND product_id IN ($placeholders)");
            $stmt->execute(array_merge([$_SESSION['user_id']], $product_ids));
            $wishlist = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'product_id');
        }

        // Log product view action
        if (isset($_SESSION['user_id'])) {
            $stmt = $pdo->prepare("INSERT INTO logs (user_id, action, details) VALUES (?, ?, ?)");
            $stmt->execute([
                $_SESSION['user_id'],
                'view_products',
                json_encode(['page' => $page, 'search' => $search, 'category' => $category, 'sort' => $sort])
            ]);
        }
    } catch (PDOException $e) {
        error_log('查询产品失败：' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
        $_SESSION['error'] = $texts['error_message'];
    }
} else {
    error_log('PDO 未定义或为 null', 3, 'C:/wamp64/logs/php_error.log');
    $_SESSION['error'] = $texts['db_error'];
}

// Fetch categories for filter
$categories = [];
if (isset($pdo) && $pdo !== null) {
    try {
        $stmt = $pdo->query("SELECT DISTINCT category FROM products ORDER BY category");
        $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);
    } catch (PDOException $e) {
        error_log('查询类别失败：' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
    }
}

// Calculate total pages
$total_pages = ceil($total_products / $per_page);

// Rate limiting for cart additions and wishlist
if (!isset($_SESSION['cart_add_attempts'])) {
    $_SESSION['cart_add_attempts'] = [];
}
if (!isset($_SESSION['wishlist_attempts'])) {
    $_SESSION['wishlist_attempts'] = [];
}
$now = time();
$_SESSION['cart_add_attempts'] = array_filter($_SESSION['cart_add_attempts'], function($timestamp) use ($now) {
    return ($now - $timestamp) < 3600;
});
$_SESSION['wishlist_attempts'] = array_filter($_SESSION['wishlist_attempts'], function($timestamp) use ($now) {
    return ($now - $timestamp) < 3600;
});
$max_attempts = 50;

// Handle adding products to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_to_cart' && isset($_POST['product_id'], $_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error'] = $texts['error_message'];
        header("Location: login.php");
        exit;
    }
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

// Handle adding/removing from wishlist
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && in_array($_POST['action'], ['add_to_wishlist', 'remove_from_wishlist']) && isset($_POST['product_id'], $_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error'] = $texts['error_message'];
        header("Location: login.php");
        exit;
    }
    if (count($_SESSION['wishlist_attempts']) >= $max_attempts) {
        $_SESSION['error'] = $texts['error_message'] . ' (Too many attempts, please try again later)';
    } elseif (isset($pdo) && $pdo !== null) {
        try {
            $product_id = filter_var($_POST['product_id'], FILTER_VALIDATE_INT);
            $user_id = $_SESSION['user_id'];

            if ($product_id) {
                if ($_POST['action'] === 'add_to_wishlist') {
                    $stmt = $pdo->prepare("INSERT INTO wishlist (user_id, product_id) VALUES (?, ?) ON DUPLICATE KEY UPDATE created_at = NOW()");
                    $stmt->execute([$user_id, $product_id]);
                    $_SESSION['success'] = $texts['wishlist_success'];
                } else {
                    $stmt = $pdo->prepare("DELETE FROM wishlist WHERE user_id = ? AND product_id = ?");
                    $stmt->execute([$user_id, $product_id]);
                    $_SESSION['success'] = $texts['wishlist_remove_success'];
                }

                // Log wishlist action
                $stmt = $pdo->prepare("INSERT INTO logs (user_id, action, details) VALUES (?, ?, ?)");
                $stmt->execute([
                    $user_id,
                    $_POST['action'],
                    json_encode(['product_id' => $product_id])
                ]);

                // Record attempt
                $_SESSION['wishlist_attempts'][] = $now;

                header("Location: shop.php?page=$page&search=" . urlencode($search) . "&min_price=" . urlencode($min_price ?? '') . "&max_price=" . urlencode($max_price ?? '') . "&category=" . urlencode($category) . "&sort=" . urlencode($sort));
                exit;
            } else {
                $_SESSION['error'] = $texts['error_message'];
            }
        } catch (PDOException $e) {
            error_log('愿望清单操作失败：' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
            $_SESSION['error'] = $texts['error_message'];
        }
    } else {
        error_log('PDO 未定义或为 null 无法操作愿望清单', 3, 'C:/wamp64/logs/php_error.log');
        $_SESSION['error'] = $texts['db_error'];
    }
}

// Handle review submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'submit_review' && isset($_POST['product_id'], $_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error'] = $texts['error_message'];
        header("Location: login.php");
        exit;
    }
    if (isset($pdo) && $pdo !== null) {
        try {
            $product_id = filter_var($_POST['product_id'], FILTER_VALIDATE_INT);
            $rating = filter_var($_POST['rating'] ?? 0, FILTER_VALIDATE_INT);
            $comment = filter_var($_POST['comment'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $user_id = $_SESSION['user_id'];

            if ($product_id && $rating >= 1 && $rating <= 5) {
                $stmt = $pdo->prepare("INSERT INTO product_reviews (product_id, user_id, rating, comment) VALUES (?, ?, ?, ?)");
                $stmt->execute([$product_id, $user_id, $rating, $comment]);

                // Log review submission
                $stmt = $pdo->prepare("INSERT INTO logs (user_id, action, details) VALUES (?, ?, ?)");
                $stmt->execute([
                    $user_id,
                    'submit_review',
                    json_encode(['product_id' => $product_id, 'rating' => $rating])
                ]);

                $_SESSION['success'] = $texts['review_success'];
                header("Location: shop.php?page=$page&search=" . urlencode($search) . "&min_price=" . urlencode($min_price ?? '') . "&max_price=" . urlencode($max_price ?? '') . "&category=" . urlencode($category) . "&sort=" . urlencode($sort));
                exit;
            } else {
                $_SESSION['error'] = $texts['error_message'];
            }
        } catch (PDOException $e) {
            error_log('评论提交失败：' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
            $_SESSION['error'] = $texts['error_message'];
        }
    } else {
        error_log('PDO 未定义或为 null 无法提交评论', 3, 'C:/wamp64/logs/php_error.log');
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
        .btn, .btn-primary, .btn-wishlist, .btn-secondary {
            background: var(--ivory) !important;
            color: var(--charcoal) !important;
            border: 2px solid var(--charcoal) !important;
            border-radius: 10px !important;
            font-family: 'Raleway', sans-serif;
            font-size: 1.1rem;
            font-weight: 500;
            padding: 12px 32px !important;
            box-shadow: var(--shadow-normal) !important;
            transition: background 0.2s, border 0.2s, box-shadow 0.2s, color 0.2s;
            display: inline-block;
        }
        .btn:hover, .btn-primary:hover, .btn-wishlist:hover, .btn-secondary:hover {
            background: var(--old-lace) !important;
            color: var(--charcoal) !important;
            border-color: var(--accent-pink) !important;
            box-shadow: var(--shadow-hover) !important;
        }
        .btn:disabled, .btn-primary:disabled, .btn-wishlist:disabled, .btn-secondary:disabled {
            background: #f3f3f3 !important;
            color: #aaa !important;
            border-color: #eee !important;
            cursor: not-allowed !important;
            box-shadow: none !important;
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
        footer, .footer {
            background: var(--papaya-whip);
            color: var(--charcoal);
            text-align: center;
            padding: 30px 0 20px 0;
            border-top: 2px solid var(--old-lace);
            box-shadow: none;
            font-family: 'Raleway', sans-serif;
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
        .spinner-border {
            display: none;
            margin: 20px auto;
            position: absolute;
            left: 50%;
            top: 120px;
            transform: translateX(-50%);
            z-index: 10;
        }
        .review-section, .input-group, .stock-status, .card-text.price, .card-text, .btn, .btn-wishlist {
            margin-bottom: 8px;
        }
        .review-section {
            background: linear-gradient(135deg, var(--linen) 70%, var(--seashell) 100%);
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.10);
            border: 2px solid var(--old-lace);
            padding: 18px 16px 14px 16px;
            margin-top: 12px;
            color: var(--charcoal);
            font-size: 1.05rem;
        }
        .review-section h6, .review-section label {
            color: var(--charcoal);
            font-weight: bold;
            font-family: 'Playfair Display', serif;
        }
        .review-section .btn, .review-section .btn-primary {
            margin-top: 10px;
            font-size: 1.08rem;
            padding: 8px 24px;
            border-radius: 6px;
            background: var(--old-lace);
            color: var(--charcoal);
            border: 2px solid var(--old-lace);
            box-shadow: var(--shadow-normal);
            transition: all 0.3s;
        }
        .review-section .btn:hover, .review-section .btn-primary:hover {
            background: var(--ivory);
            color: var(--charcoal);
            border-color: var(--accent-pink);
            box-shadow: var(--shadow-hover);
        }
        .review-section .form-control, .review-section .form-select {
            background: var(--seashell);
            border: 2px solid var(--old-lace);
            border-radius: 6px;
            color: var(--charcoal);
            margin-bottom: 8px;
            font-size: 1rem;
            font-family: 'Raleway', sans-serif;
        }
        .review-section .form-control:focus, .review-section .form-select:focus {
            border-color: var(--papaya-whip);
            box-shadow: 0 0 0 2px var(--papaya-whip);
            outline: none;
        }
        .review-section .star-rating {
            color: #ffc107;
            font-size: 1.15rem;
            letter-spacing: 1px;
        }
        .form-select, .form-control, textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px 12px;
            font-size: 1rem;
            border-radius: 10px;
            border: 2px solid var(--old-lace);
            background: var(--snow);
            color: var(--charcoal);
            font-family: 'Raleway', sans-serif;
            box-shadow: none;
            transition: border 0.2s, box-shadow 0.2s, background 0.2s;
        }
        .form-select:focus, .form-control:focus, textarea:focus {
            border-color: var(--accent-blue);
            background: #fff;
            box-shadow: 0 0 0 2px var(--accent-blue);
            outline: none;
        }
        /* 商品列表区块标题和表头美化 */
        .shop-section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--charcoal);
            margin-bottom: 18px;
            letter-spacing: 1px;
            text-align: left;
        }
        .shop-table thead {
            background: var(--old-lace);
        }
        .shop-table th {
            font-family: 'Raleway', sans-serif;
            font-size: 1.08rem;
            font-weight: 700;
            color: var(--charcoal);
            letter-spacing: 0.5px;
            vertical-align: middle;
            text-align: center;
        }
        .shop-table td {
            font-family: 'Raleway', sans-serif;
            font-size: 1rem;
            color: var(--charcoal);
            vertical-align: middle;
            text-align: center;
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
                        <a class="nav-link animate-jitter active" href="shop.php" data-lang-key="nav_shop"><?php echo htmlspecialchars($texts['nav_shop']); ?></a>
                    </li>
                    <?php if (isset($_SESSION['user_id'])): ?>
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
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link animate-jitter" href="login.php" data-lang-key="nav_login"><?php echo htmlspecialchars($texts['nav_login']); ?></a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <select id="language-switcher" class="form-select w-auto">
                            <option value="zh" <?php echo $lang === 'zh' ? 'selected' : ''; ?>>中文</option>
                            <option value="en" <?php echo $lang === 'en' ? 'selected' : ''; ?>>English</option>
                            <option value="ms" <?php echo $lang === 'ms' ? 'selected' : ''; ?>>Bahasa Melayu</option>
                        </select>
                    </li>
                </ul>
                <div class="navbar-lang">
                    <!-- 语言切换器已在上方 -->
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center"><?php echo htmlspecialchars($texts['shop_title']); ?></h2>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
        <?php elseif (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <!-- Filters and Sorting -->
        <div class="row">
            <div class="col-md-3">
                <div class="sidebar">
                    <h5><?php echo htmlspecialchars($texts['filter_by_price']); ?></h5>
                    <form id="filter-form" method="GET">
                        <div class="mb-3">
                            <input type="number" name="min_price" class="form-control" placeholder="Min Price" value="<?php echo htmlspecialchars($min_price ?? ''); ?>" step="0.01">
                        </div>
                        <div class="mb-3">
                            <input type="number" name="max_price" class="form-control" placeholder="Max Price" value="<?php echo htmlspecialchars($max_price ?? ''); ?>" step="0.01">
                        </div>
                        <h5><?php echo htmlspecialchars($texts['filter_by_category']); ?></h5>
                        <select name="category" class="form-select mb-3">
                            <option value="all"><?php echo htmlspecialchars($texts['category_all']); ?></option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo htmlspecialchars($cat); ?>" <?php echo $category === $cat ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cat); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <h5><?php echo htmlspecialchars($texts['sort_by']); ?></h5>
                        <select name="sort" class="form-select mb-3">
                            <option value="name_asc" <?php echo $sort === 'name_asc' ? 'selected' : ''; ?>><?php echo htmlspecialchars($texts['sort_name_asc']); ?></option>
                            <option value="name_desc" <?php echo $sort === 'name_desc' ? 'selected' : ''; ?>><?php echo htmlspecialchars($texts['sort_name_desc']); ?></option>
                            <option value="price_asc" <?php echo $sort === 'price_asc' ? 'selected' : ''; ?>><?php echo htmlspecialchars($texts['sort_price_asc']); ?></option>
                            <option value="price_desc" <?php echo $sort === 'price_desc' ? 'selected' : ''; ?>><?php echo htmlspecialchars($texts['sort_price_desc']); ?></option>
                        </select>
                        <button type="submit" class="btn btn-primary w-100"><?php echo htmlspecialchars($texts['apply_filters']); ?></button>
                        <a href="shop.php" class="btn btn-secondary w-100 mt-2"><?php echo htmlspecialchars($texts['reset_filters']); ?></a>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <!-- Search Bar -->
                <div class="mb-4">
                    <form method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="<?php echo htmlspecialchars($texts['search_placeholder']); ?>" value="<?php echo htmlspecialchars($search); ?>">
                            <button type="submit" class="btn btn-primary"><?php echo htmlspecialchars($texts['apply_filters']); ?></button>
                        </div>
                        <?php if ($search || $min_price !== null || $max_price !== null || $category): ?>
                            <input type="hidden" name="min_price" value="<?php echo htmlspecialchars($min_price ?? ''); ?>">
                            <input type="hidden" name="max_price" value="<?php echo htmlspecialchars($max_price ?? ''); ?>">
                            <input type="hidden" name="category" value="<?php echo htmlspecialchars($category); ?>">
                            <input type="hidden" name="sort" value="<?php echo htmlspecialchars($sort); ?>">
                        <?php endif; ?>
                    </form>
                </div>

                <!-- Loading Spinner -->
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>

                <!-- Products -->
                <div class="shop-section-title"><?php echo htmlspecialchars($texts['shop_title']); ?></div>
                <?php if (empty($products)): ?>
                    <div class="alert alert-info"><?php echo htmlspecialchars($texts['no_products']); ?></div>
                <?php else: ?>
                    <div class="row shop-table" id="products-container">
                        <?php foreach ($products as $product): ?>
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <?php if (!empty($product_images[$product['id']]) && count($product_images[$product['id']]) > 1): ?>
                                        <div id="carousel-<?php echo $product['id']; ?>" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <?php foreach ($product_images[$product['id']] as $index => $image): ?>
                                                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                                        <img src="../<?php echo htmlspecialchars($image['image_path']); ?>" class="d-block w-100 card-img-top" alt="<?php echo htmlspecialchars($image['alt_' . $lang]); ?>">
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
                                        <?php
                                        $image_path = '';
                                        if (!empty($product['image'])) {
                                            $image_path = '../' . $product['image'];
                                            $image_full_path = dirname(__DIR__) . '/' . $product['image'];
                                            if (!file_exists($image_full_path)) {
                                                $base = preg_replace('/\.[a-zA-Z0-9]+$/', '', $image_full_path);
                                                $found = false;
                                                foreach (['jpg', 'png', 'gif'] as $ext) {
                                                    $test_path = $base . '.' . $ext;
                                                    if (file_exists($test_path)) {
                                                        $image_path = '../' . preg_replace('/\.[a-zA-Z0-9]+$/', '', $product['image']) . '.' . $ext;
                                                        $found = true;
                                                        break;
                                                    }
                                                }
                                                if (!$found) {
                                                    $image_path = 'https://via.placeholder.com/400x300?text=No+Image';
                                                }
                                            }
                                        } else {
                                            $image_path = 'https://via.placeholder.com/400x300?text=No+Image';
                                        }
                                        ?>
                                        <img src="<?php echo htmlspecialchars((string)$image_path); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['alt_' . $lang] ?? ''); ?>">
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($product['name_' . $lang]); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($product['description_' . $lang] ?? ''); ?></p>
                                        <?php
                                        $final_price = $product['price_' . $lang];
                                        ?>
                                        <p class="card-text price"><?php echo $lang === 'zh' ? '¥' : ($lang === 'en' ? '$' : 'RM'); ?><?php echo number_format($final_price, 2); ?></p>
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
                                        <?php if (isset($_SESSION['user_id'])): ?>
                                            <form method="POST" class="mt-2">
                                                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                                                <input type="hidden" name="action" value="<?php echo in_array($product['id'], $wishlist) ? 'remove_from_wishlist' : 'add_to_wishlist'; ?>">
                                                <button type="submit" class="btn btn-wishlist w-100">
                                                    <?php echo in_array($product['id'], $wishlist) ? htmlspecialchars($texts['shop_remove_from_wishlist']) : htmlspecialchars($texts['shop_add_to_wishlist']); ?>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                        <div class="review-section">
                                            <h6><?php echo $texts['no_reviews']; ?></h6>
                                            <?php if (!empty($reviews[$product['id']])): ?>
                                                <?php foreach ($reviews[$product['id']] as $review): ?>
                                                    <div class="review mb-2">
                                                        <p><strong><?php echo htmlspecialchars($review['username']); ?>:</strong> 
                                                           <span class="star-rating"><?php echo str_repeat('★', $review['rating']); ?><?php echo str_repeat('☆', 5 - $review['rating']); ?></span>
                                                           (<?php echo date('Y-m-d', strtotime($review['created_at'])); ?>)
                                                        </p>
                                                        <p><?php echo htmlspecialchars($review['comment'] ?? ''); ?></p>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <p><?php echo $texts['no_reviews']; ?></p>
                                            <?php endif; ?>
                                            <?php if (isset($_SESSION['user_id'])): ?>
                                                <div class="review-form">
                                                    <h6><?php echo $texts['submit_review']; ?></h6>
                                                    <form method="POST">
                                                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                                                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                                                        <input type="hidden" name="action" value="submit_review">
                                                        <div class="mb-3">
                                                            <label for="rating-<?php echo $product['id']; ?>" class="form-label"><?php echo $texts['rating']; ?></label>
                                                            <select name="rating" id="rating-<?php echo $product['id']; ?>" class="form-select" required>
                                                                <option value="5">5 ★</option>
                                                                <option value="4">4 ★</option>
                                                                <option value="3">3 ★</option>
                                                                <option value="2">2 ★</option>
                                                                <option value="1">1 ★</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="comment-<?php echo $product['id']; ?>" class="form-label"><?php echo $texts['comment']; ?></label>
                                                            <textarea name="comment" id="comment-<?php echo $product['id']; ?>" class="form-control"></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary"><?php echo $texts['submit_review']; ?></button>
                                                    </form>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                                <a class="page-link" href="shop.php?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>&min_price=<?php echo urlencode($min_price ?? ''); ?>&max_price=<?php echo urlencode($max_price ?? ''); ?>&category=<?php echo urlencode($category); ?>&sort=<?php echo urlencode($sort); ?>"><?php echo htmlspecialchars($texts['previous']); ?></a>
                            </li>
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                                    <a class="page-link" href="shop.php?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&min_price=<?php echo urlencode($min_price ?? ''); ?>&max_price=<?php echo urlencode($max_price ?? ''); ?>&category=<?php echo urlencode($category); ?>&sort=<?php echo urlencode($sort); ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item <?php echo $page >= $total_pages ? 'disabled' : ''; ?>">
                                <a class="page-link" href="shop.php?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>&min_price=<?php echo urlencode($min_price ?? ''); ?>&max_price=<?php echo urlencode($max_price ?? ''); ?>&category=<?php echo urlencode($category); ?>&sort=<?php echo urlencode($sort); ?>"><?php echo htmlspecialchars($texts['next']); ?></a>
                            </li>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
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
                document.querySelector('.spinner-border').style.display = 'block';
                document.querySelector('#products-container').style.opacity = '0.5';
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.spinner-border').style.display = 'none';
        });
    });
    </script>
</body>
</html>