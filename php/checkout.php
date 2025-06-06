<?php
// Enable output buffering to prevent headers issue
ob_start();

// Start session with explicit configuration
ini_set('session.gc_maxlifetime', 1440);
ini_set('session.cookie_lifetime', 0);
session_start();

// Debug logging
error_log('Request Method: ' . $_SERVER['REQUEST_METHOD'], 3, 'C:\wamp64\logs\php_error.log');
error_log('POST Data: ' . print_r($_POST, true), 3, 'C:\wamp64\logs\php_error.log');
error_log('Session Data: ' . print_r($_SESSION, true), 3, 'C:\wamp64\logs\php_error.log');

// Log session for debugging
error_log('Checkout.php Session: ' . print_r($_SESSION, true), 3, 'C:\wamp64\logs\php_error.log');

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
        'site_title' => 'HAF - 结账',
        'meta_description' => '选择马来西亚地址和输入付款信息以完成HAF订单',
        'nav_history' => '历史',
        'nav_art' => '艺术',
        'nav_fashion' => '时尚',
        'nav_shop' => '商店',
        'nav_cart' => '购物车',
        'nav_wishlist' => '愿望清单',
        'nav_orders' => '订单',
        'nav_admin' => '管理员面板',
        'nav_logout' => '登出',
        'nav_login' => '登录',
        'welcome_user' => '欢迎',
        'checkout_title' => '结账',
        'address_section' => '送货地址（马来西亚）',
        'select_address' => '选择已有地址',
        'new_address' => '添加新地址',
        'full_name' => '全名',
        'house_number' => '门牌号',
        'state' => '州',
        'city' => '城市',
        'postal_code' => '邮政编码',
        'payment_section' => '付款信息（信用卡）',
        'card_number' => '信用卡号',
        'card_number_format' => '格式：xxxx xxxx xxxx xxxx',
        'expiry_date' => '有效期（MM/YY）',
        'cvv' => 'CVV',
        'cvv_format' => '3位数字',
        'submit_payment' => '提交订单',
        'error_not_logged_in' => '请登录以继续结账',
        'error_invalid_csrf' => '无效的请求，请重试',
        'error_missing_fields' => '请填写所有必填字段',
        'error_invalid_card_number' => '信用卡号格式无效（需要16位数字，格式为xxxx xxxx xxxx xxxx）',
        'error_invalid_expiry' => '有效期无效或已过期',
        'error_invalid_cvv' => 'CVV必须为3位数字',
        'error_no_address' => '请选择或输入一个送货地址',
        'error_invalid_state_city' => '请选择有效的州和城市',
        'error_address_save_failed' => '无法保存新地址，请重试'
    ],
    'en' => [
        'site_title' => 'HAF - Checkout',
        'meta_description' => 'Select Malaysia address and enter payment details to complete your HAF order',
        'nav_history' => 'History',
        'nav_art' => 'Art',
        'nav_fashion' => 'Fashion',
        'nav_shop' => 'Shop',
        'nav_cart' => 'Cart',
        'nav_wishlist' => 'Wishlist',
        'nav_orders' => 'Orders',
        'nav_admin' => 'Admin Panel',
        'nav_logout' => 'Logout',
        'nav_login' => 'Login',
        'welcome_user' => 'Welcome',
        'checkout_title' => 'Checkout',
        'address_section' => 'Shipping Address (Malaysia)',
        'select_address' => 'Select Saved Address',
        'new_address' => 'Add New Address',
        'full_name' => 'Full Name',
        'house_number' => 'House Number',
        'state' => 'State',
        'city' => 'City',
        'postal_code' => 'Postal Code',
        'payment_section' => 'Payment Information (Credit Card)',
        'card_number' => 'Credit Card Number',
        'card_number_format' => 'Format: xxxx xxxx xxxx xxxx',
        'expiry_date' => 'Expiry Date (MM/YY)',
        'cvv' => 'CVV',
        'cvv_format' => '3 digits',
        'submit_payment' => 'Submit Order',
        'error_not_logged_in' => 'Please log in to proceed to checkout',
        'error_invalid_csrf' => 'Invalid request, please try again',
        'error_missing_fields' => 'Please fill in all required fields',
        'error_invalid_card_number' => 'Invalid card number format (requires 16 digits, format xxxx xxxx xxxx xxxx)',
        'error_invalid_expiry' => 'Invalid or expired expiry date',
        'error_invalid_cvv' => 'CVV must be 3 digits',
        'error_no_address' => 'Please select or enter a shipping address',
        'error_invalid_state_city' => 'Please select a valid state and city',
        'error_address_save_failed' => 'Failed to save new address, please try again'
    ],
    'ms' => [
        'site_title' => 'HAF - Pembayaran',
        'meta_description' => 'Pilih alamat Malaysia dan masukkan butiran pembayaran untuk melengkapkan pesanan HAF anda',
        'nav_history' => 'Sejarah',
        'nav_art' => 'Seni',
        'nav_fashion' => 'Fesyen',
        'nav_shop' => 'Kedai',
        'nav_cart' => 'Troli',
        'nav_wishlist' => 'Senarai Hati',
        'nav_orders' => 'Pesanan',
        'nav_admin' => 'Panel Admin',
        'nav_logout' => 'Log Keluar',
        'nav_login' => 'Log Masuk',
        'welcome_user' => 'Selamat Datang',
        'checkout_title' => 'Pembayaran',
        'address_section' => 'Alamat Penghantaran (Malaysia)',
        'select_address' => 'Pilih Alamat Tersimpan',
        'new_address' => 'Tambah Alamat Baru',
        'full_name' => 'Nama Penuh',
        'house_number' => 'Nombor Rumah',
        'state' => 'Negeri',
        'city' => 'Bandar',
        'postal_code' => 'Poskod',
        'payment_section' => 'Maklumat Pembayaran (Kad Kredit)',
        'card_number' => 'Nombor Kad Kredit',
        'card_number_format' => 'Format: xxxx xxxx xxxx xxxx',
        'expiry_date' => 'Tarikh Luput (MM/YY)',
        'cvv' => 'CVV',
        'cvv_format' => '3 digit',
        'submit_payment' => 'Hantar Pesanan',
        'error_not_logged_in' => 'Sila log masuk untuk meneruskan pembayaran',
        'error_invalid_csrf' => 'Permintaan tidak sah, sila cuba lagi',
        'error_missing_fields' => 'Sila isi semua medan yang diperlukan',
        'error_invalid_card_number' => 'Format nombor kad tidak sah (memerlukan 16 digit, format xxxx xxxx xxxx xxxx)',
        'error_invalid_expiry' => 'Tarikh luput tidak sah atau telah tamat tempoh',
        'error_invalid_cvv' => 'CVV mestilah 3 digit',
        'error_no_address' => 'Sila pilih atau masukkan alamat penghantaran',
        'error_invalid_state_city' => 'Sila pilih negeri dan bandar yang sah',
        'error_address_save_failed' => 'Gagal menyimpan alamat baru, sila cuba lagi'
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
    error_log('未登录，重定向到 login.php', 3, 'C:\wamp64\logs\php_error.log');
    header("Location: /hsbm/php/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$errors = [];
$debug_info = [];

// Malaysian states and cities
$malaysian_states = [
    'Johor' => ['Johor Bahru', 'Muar', 'Batu Pahat', 'Kluang', 'Segamat'],
    'Kedah' => ['Alor Setar', 'Sungai Petani', 'Kulim', 'Langkawi', 'Jitra'],
    'Kelantan' => ['Kota Bharu', 'Pasir Mas', 'Tumpat', 'Bachok', 'Gua Musang'],
    'Malacca' => ['Malacca City', 'Alor Gajah', 'Jasin', 'Masjid Tanah', 'Ayer Keroh'],
    'Negeri Sembilan' => ['Seremban', 'Port Dickson', 'Nilai', 'Tampin', 'Bahau'],
    'Pahang' => ['Kuantan', 'Temerloh', 'Bentong', 'Raub', 'Jerantut'],
    'Penang' => ['George Town', 'Butterworth', 'Bukit Mertajam', 'Nibong Tebal', 'Bayan Lepas'],
    'Perak' => ['Ipoh', 'Taiping', 'Teluk Intan', 'Lumut', 'Kampar'],
    'Perlis' => ['Kangar', 'Arau', 'Padang Besar'],
    'Sabah' => ['Kota Kinabalu', 'Sandakan', 'Tawau', 'Lahad Datu', 'Keningau'],
    'Sarawak' => ['Kuching', 'Miri', 'Sibu', 'Bintulu', 'Sri Aman'],
    'Selangor' => ['Shah Alam', 'Petaling Jaya', 'Klang', 'Subang Jaya', 'Kajang'],
    'Terengganu' => ['Kuala Terengganu', 'Kemaman', 'Dungun', 'Marang', 'Chukai'],
    'Kuala Lumpur' => ['Kuala Lumpur'],
    'Labuan' => ['Victoria'],
    'Putrajaya' => ['Putrajaya']
];

// Fetch saved addresses
try {
    $stmt = $pdo->prepare("SELECT * FROM addresses WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $saved_addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    error_log('已获取保存的地址：' . count($saved_addresses) . ' 条', 3, 'C:\wamp64\logs\php_error.log');
} catch (PDOException $e) {
    error_log('查询地址失败：' . $e->getMessage(), 3, 'C:\wamp64\logs\php_error.log');
    $saved_addresses = [];
    $errors[] = $texts['error_no_address'];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token'])) {
    error_log('收到 POST 请求，表单数据：' . print_r($_POST, true), 3, 'C:\wamp64\logs\php_error.log');

    // Validate CSRF token
    if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $errors[] = $texts['error_invalid_csrf'];
        $debug_info[] = 'CSRF 令牌无效';
        error_log('CSRF 验证失败', 3, 'C:\wamp64\logs\php_error.log');
    } else {
        $address_id = filter_var($_POST['address_id'] ?? 0, FILTER_VALIDATE_INT);

        // Validate address
        if ($address_id > 0) {
            try {
                $stmt = $pdo->prepare("SELECT id FROM addresses WHERE id = ? AND user_id = ?");
                $stmt->execute([$address_id, $user_id]);
                if (!$stmt->fetch()) {
                    $errors[] = $texts['error_no_address'];
                    $debug_info[] = "无效的地址 ID: $address_id";
                    error_log("无效的地址 ID: $address_id", 3, 'C:\wamp64\logs\php_error.log');
                }
            } catch (PDOException $e) {
                error_log('验证地址失败：' . $e->getMessage(), 3, 'C:\wamp64\logs\php_error.log');
                $errors[] = $texts['error_no_address'];
            }
        } else {
            // New address
            $full_name = trim($_POST['full_name'] ?? '');
            $house_number = trim($_POST['house_number'] ?? '');
            $state = trim($_POST['state'] ?? '');
            $city = trim($_POST['city'] ?? '');
            $postal_code = trim($_POST['postal_code'] ?? '');

            $debug_info[] = "新地址数据: full_name=$full_name, house_number=$house_number, state=$state, city=$city, postal_code=$postal_code";
            error_log('新地址验证：state=' . $state . ', city=' . $city, 3, 'C:\wamp64\logs\php_error.log');

            if (empty($full_name) || empty($house_number) || empty($state) || empty($city) || empty($postal_code)) {
                $errors[] = $texts['error_missing_fields'];
                $debug_info[] = '缺少必填字段';
            } elseif (!array_key_exists($state, $malaysian_states)) {
                $errors[] = $texts['error_invalid_state_city'];
                $debug_info[] = "无效的州: $state";
                error_log('无效的州: ' . $state, 3, 'C:\wamp64\logs\php_error.log');
            } elseif (!in_array($city, $malaysian_states[$state])) {
                $errors[] = $texts['error_invalid_state_city'];
                $debug_info[] = "无效的城市: $city for state: $state";
                error_log('无效的城市: ' . $city . ' for state: ' . $state, 3, 'C:\wamp64\logs\php_error.log');
            } else {
                try {
                    $stmt = $pdo->prepare("INSERT INTO addresses (user_id, full_name, house_number, city, state, postal_code) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$user_id, $full_name, $house_number, $city, $state, $postal_code]);
                    $address_id = $pdo->lastInsertId();
                    error_log('新地址保存成功，address_id: ' . $address_id, 3, 'C:\wamp64\logs\php_error.log');
                } catch (PDOException $e) {
                    error_log('保存地址失败：' . $e->getMessage(), 3, 'C:\wamp64\logs\php_error.log');
                    $errors[] = $texts['error_address_save_failed'];
                    $debug_info[] = '保存地址失败: ' . $e->getMessage();
                }
            }
        }

        // Validate credit card
        $card_number = trim($_POST['card_number'] ?? '');
        $expiry_date = trim($_POST['expiry_date'] ?? '');
        $cvv = trim($_POST['cvv'] ?? '');

        $debug_info[] = "信用卡数据: card_number=$card_number, expiry_date=$expiry_date, cvv=$cvv";

        // Card number (xxxx xxxx xxxx xxxx)
        $card_number_clean = str_replace(' ', '', $card_number);
        if (!preg_match('/^\d{16}$/', $card_number_clean)) {
            $errors[] = $texts['error_invalid_card_number'];
            $debug_info[] = '无效的信用卡号';
        }

        // Expiry date (MM/YY, not expired)
        if (!preg_match('/^(0[1-9]|1[0-2])\/[0-9]{2}$/', $expiry_date)) {
            $errors[] = $texts['error_invalid_expiry'];
            $debug_info[] = '无效的有效期格式';
        } else {
            list($month, $year) = explode('/', $expiry_date);
            $year = 2000 + (int)$year;
            $current_year = 2025; // As of May 11, 2025
            $current_month = 5;
            if ($year < $current_year || ($year == $current_year && (int)$month < $current_month)) {
                $errors[] = $texts['error_invalid_expiry'];
                $debug_info[] = '有效期已过期';
            }
        }

        // CVV (3 digits)
        if (!preg_match('/^\d{3}$/', $cvv)) {
            $errors[] = $texts['error_invalid_cvv'];
            $debug_info[] = '无效的 CVV';
        }

        // Log validation result
        error_log('验证结果，错误数：' . count($errors) . ', 错误：' . print_r($errors, true), 3, 'C:\wamp64\logs\php_error.log');

        // Proceed if no errors
        if (empty($errors)) {
            // 保存结账数据到会话
            $_SESSION['checkout_data'] = [
                'address_id' => (int)$address_id,
                'card_number' => substr($card_number_clean, -4), // 只保存最后4位数字，出于安全考虑
                'expiry_date' => $expiry_date
            ];
            error_log('验证通过，设置 checkout_data: ' . print_r($_SESSION['checkout_data'], true), 3, 'C:\wamp64\logs\php_error.log');
            
            // 确保输出缓冲区是干净的
            while (ob_get_level()) {
                ob_end_clean();
            }
            
            // 执行重定向
            header("Location: /hsbm/php/place_order.php");
            exit();
        } else {
            error_log('验证失败，错误：' . print_r($errors, true), 3, 'C:\wamp64\logs\php_error.log');
        }
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
            --danger: #dc3545;
            --success: #28a745;
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
            max-width: 600px;
            margin: 0 auto;
        }
        h2, h4 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--charcoal);
        }
        h2 {
            font-size: 2.2rem;
            margin-bottom: 20px;
        }
        h4 {
            font-size: 1.3rem;
            margin-top: 32px;
            margin-bottom: 18px;
        }
        .form-label {
            font-family: 'Raleway', sans-serif;
            font-weight: 500;
            color: var(--charcoal);
        }
        .form-control, .form-select {
            background: var(--linen);
            border: 2px solid var(--old-lace);
            color: var(--charcoal);
            font-family: 'Raleway', sans-serif;
            border-radius: 8px;
            box-shadow: none;
            transition: border 0.2s, box-shadow 0.2s, background 0.2s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--accent-blue);
            background: #fff;
            box-shadow: 0 0 0 2px var(--accent-blue);
            outline: none;
        }
        .form-control.is-invalid, .form-select.is-invalid {
            border-color: var(--danger);
            background: #fff0f0;
        }
        .btn, .btn-primary {
            background: var(--old-lace) !important;
            color: var(--charcoal) !important;
            border: 2px solid var(--old-lace) !important;
            border-radius: 8px !important;
            font-family: 'Raleway', sans-serif;
            font-size: 1.1rem;
            font-weight: 500;
            padding: 12px 30px !important;
            box-shadow: var(--shadow-normal) !important;
            transition: background 0.2s, border 0.2s, box-shadow 0.2s, color 0.2s;
        }
        .btn:hover, .btn-primary:hover {
            background: var(--ivory) !important;
            color: var(--charcoal) !important;
            border-color: var(--accent-pink) !important;
            box-shadow: var(--shadow-hover) !important;
        }
        .btn:disabled, .btn-primary:disabled {
            background: #f3f3f3 !important;
            color: #aaa !important;
            border-color: #eee !important;
            cursor: not-allowed !important;
            box-shadow: none !important;
        }
        .alert {
            font-family: 'Raleway', sans-serif;
            font-size: 1.05rem;
            border-radius: 8px;
            box-shadow: var(--shadow-normal);
            padding: 16px 18px;
        }
        .alert-danger {
            background: #fff0f0;
            color: var(--danger);
            border: 2px solid var(--danger);
        }
        .alert-success {
            background: #f0fff0;
            color: var(--success);
            border: 2px solid var(--success);
        }
        .alert-warning {
            background: #fffbe6;
            color: #b8860b;
            border: 2px solid #ffe58f;
        }
        .mb-3 {
            margin-bottom: 1.2rem !important;
        }
        .mb-4 {
            margin-bottom: 2rem !important;
        }
        .input-group {
            margin-bottom: 10px;
        }
        small {
            color: #888;
        }
        @media (max-width: 900px) {
            .container {
                padding: 18px 2vw 10px 2vw;
            }
            h2 {
                font-size: 1.5rem;
            }
        }
        @media (max-width: 600px) {
            .container {
                padding: 8px 1vw 4px 1vw;
            }
            h2 {
                font-size: 1.1rem;
            }
            .btn, .btn-primary {
                font-size: 1rem;
                padding: 10px 10px !important;
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
        <h2><?php echo htmlspecialchars($texts['checkout_title']); ?></h2>
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <!-- Debug output (remove in production) -->
        <?php if (!empty($debug_info)): ?>
            <div class="alert alert-warning">
                <p><strong>Debug Info:</strong></p>
                <?php foreach ($debug_info as $info): ?>
                    <p><?php echo htmlspecialchars($info); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form method="POST" id="checkout-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
            <h4><?php echo htmlspecialchars($texts['address_section']); ?></h4>
            <?php if (!empty($saved_addresses)): ?>
                <div class="mb-3">
                    <label for="address_id" class="form-label"><?php echo htmlspecialchars($texts['select_address']); ?></label>
                    <select class="form-select" id="address_id" name="address_id" onchange="toggleAddressForm()">
                        <option value="0"><?php echo htmlspecialchars($texts['new_address']); ?></option>
                        <?php foreach ($saved_addresses as $address): ?>
                            <option value="<?php echo htmlspecialchars($address['id']); ?>">
                                <?php echo htmlspecialchars($address['full_name'] . ', ' . $address['house_number'] . ', ' . $address['city'] . ', ' . $address['state']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>
            <div id="new-address-form" <?php echo !empty($saved_addresses) ? 'style="display:none;"' : ''; ?>>
                <div class="mb-3">
                    <label for="full_name" class="form-label"><?php echo htmlspecialchars($texts['full_name']); ?> *</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" 
                           value="<?php echo isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : ''; ?>" 
                           required>
                </div>
                <div class="mb-3">
                    <label for="house_number" class="form-label"><?php echo htmlspecialchars($texts['house_number']); ?> *</label>
                    <input type="text" class="form-control" id="house_number" name="house_number" 
                           value="<?php echo isset($_POST['house_number']) ? htmlspecialchars($_POST['house_number']) : ''; ?>" 
                           required>
                </div>
                <div class="mb-3">
                    <label for="state" class="form-label"><?php echo htmlspecialchars($texts['state']); ?> *</label>
                    <select class="form-select" id="state" name="state" onchange="updateCities()" required>
                        <option value=""><?php echo $lang === 'zh' ? '请选择州' : ($lang === 'en' ? 'Select State' : 'Pilih Negeri'); ?></option>
                        <?php foreach (array_keys($malaysian_states) as $state): ?>
                            <option value="<?php echo htmlspecialchars($state); ?>" <?php echo (isset($_POST['state']) && $_POST['state'] === $state) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($state); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label"><?php echo htmlspecialchars($texts['city']); ?> *</label>
                    <select class="form-select" id="city" name="city" required>
                        <option value=""><?php echo $lang === 'zh' ? '请选择城市' : ($lang === 'en' ? 'Select City' : 'Pilih Bandar'); ?></option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="postal_code" class="form-label"><?php echo htmlspecialchars($texts['postal_code']); ?> *</label>
                    <input type="text" class="form-control" id="postal_code" name="postal_code" 
                           value="<?php echo isset($_POST['postal_code']) ? htmlspecialchars($_POST['postal_code']) : ''; ?>" 
                           required>
                </div>
            </div>
            <h4><?php echo htmlspecialchars($texts['payment_section']); ?></h4>
            <div class="mb-3">
                <label for="card_number" class="form-label"><?php echo htmlspecialchars($texts['card_number']); ?> *</label>
                <input type="text" class="form-control" id="card_number" name="card_number" 
                       value="<?php echo isset($_POST['card_number']) ? htmlspecialchars($_POST['card_number']) : ''; ?>" 
                       placeholder="<?php echo htmlspecialchars($texts['card_number_format']); ?>" 
                       required>
                <small><?php echo htmlspecialchars($texts['card_number_format']); ?></small>
            </div>
            <div class="mb-3">
                <label for="expiry_date" class="form-label"><?php echo htmlspecialchars($texts['expiry_date']); ?> *</label>
                <input type="text" class="form-control" id="expiry_date" name="expiry_date" 
                       value="<?php echo isset($_POST['expiry_date']) ? htmlspecialchars($_POST['expiry_date']) : ''; ?>" 
                       placeholder="MM/YY" 
                       required>
            </div>
            <!-- 添加缺失的CVV输入框 -->
            <div class="mb-3">
                <label for="cvv" class="form-label"><?php echo htmlspecialchars($texts['cvv']); ?> *</label>
                <input type="text" class="form-control" id="cvv" name="cvv" 
                       value="<?php echo isset($_POST['cvv']) ? htmlspecialchars($_POST['cvv']) : ''; ?>" 
                       placeholder="<?php echo htmlspecialchars($texts['cvv_format']); ?>" 
                       required>
                <small><?php echo htmlspecialchars($texts['cvv_format']); ?></small>
            </div>
            <button type="button" style="background:red;color:white;"></button>
            <button type="submit" class="btn btn-primary btn-lg w-100 mb-4" id="submit-btn"><?php echo htmlspecialchars($texts['submit_payment']); ?></button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
    function toggleAddressForm() {
        const addressId = document.getElementById('address_id');
        const newAddressForm = document.getElementById('new-address-form');
        if (addressId && newAddressForm) {
            newAddressForm.style.display = addressId.value === '0' ? 'block' : 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Malaysian states and cities
        const malaysianStates = {
            'Johor': ['Johor Bahru', 'Muar', 'Batu Pahat', 'Kluang', 'Segamat'],
            'Kedah': ['Alor Setar', 'Sungai Petani', 'Kulim', 'Langkawi', 'Jitra'],
            'Kelantan': ['Kota Bharu', 'Pasir Mas', 'Tumpat', 'Bachok', 'Gua Musang'],
            'Malacca': ['Malacca City', 'Alor Gajah', 'Jasin', 'Masjid Tanah', 'Ayer Keroh'],
            'Negeri Sembilan': ['Seremban', 'Port Dickson', 'Nilai', 'Tampin', 'Bahau'],
            'Pahang': ['Kuantan', 'Temerloh', 'Bentong', 'Raub', 'Jerantut'],
            'Penang': ['George Town', 'Butterworth', 'Bukit Mertajam', 'Nibong Tebal', 'Bayan Lepas'],
            'Perak': ['Ipoh', 'Taiping', 'Teluk Intan', 'Lumut', 'Kampar'],
            'Perlis': ['Kangar', 'Arau', 'Padang Besar'],
            'Sabah': ['Kota Kinabalu', 'Sandakan', 'Tawau', 'Lahad Datu', 'Keningau'],
            'Sarawak': ['Kuching', 'Miri', 'Sibu', 'Bintulu', 'Sri Aman'],
            'Selangor': ['Shah Alam', 'Petaling Jaya', 'Klang', 'Subang Jaya', 'Kajang'],
            'Terengganu': ['Kuala Terengganu', 'Kemaman', 'Dungun', 'Marang', 'Chukai'],
            'Kuala Lumpur': ['Kuala Lumpur'],
            'Labuan': ['Victoria'],
            'Putrajaya': ['Putrajaya']
        };

        // Language switcher
        const languageSwitcher = document.getElementById('language-switcher');
        if (languageSwitcher) {
            languageSwitcher.addEventListener('change', function(e) {
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

        // Update city dropdown based on state
        function updateCities() {
            const stateSelect = document.getElementById('state');
            const citySelect = document.getElementById('city');
            const state = stateSelect.value;

            citySelect.innerHTML = '<option value=""><?php echo $lang === "zh" ? "请选择城市" : ($lang === "en" ? "Select City" : "Pilih Bandar"); ?></option>';

            if (state && malaysianStates[state]) {
                malaysianStates[state].forEach(city => {
                    const option = document.createElement('option');
                    option.value = city;
                    option.textContent = city;
                    citySelect.appendChild(option);
                });
                console.log(`Updated cities for state: ${state}`, malaysianStates[state]);
            } else {
                console.log(`No cities for state: ${state}`);
            }
        }

        // Initialize city dropdown
        const stateSelect = document.getElementById('state');
        if (stateSelect) {
            updateCities();
            stateSelect.addEventListener('change', updateCities);
        } else {
            console.error('State select element not found');
        }

        // Form input formatting
        const cardNumber = document.getElementById('card_number');
        const expiryDate = document.getElementById('expiry_date');
        const cvv = document.getElementById('cvv');

        cardNumber.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 16) value = value.slice(0, 16);
            let formatted = '';
            for (let i = 0; i < value.length; i++) {
                if (i > 0 && i % 4 === 0) formatted += ' ';
                formatted += value[i];
            }
            e.target.value = formatted;
        });

        expiryDate.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 4) value = value.slice(0, 4);
            if (value.length > 2) {
                e.target.value = value.slice(0, 2) + '/' + value.slice(2);
            } else {
                e.target.value = value;
            }
        });

        cvv.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 3) value = value.slice(0, 3);
            e.target.value = value;
        });

        // Form submission
        const form = document.getElementById('checkout-form');
        const submitBtn = document.getElementById('submit-btn');

        if (!form) {
            console.error('Form element not found!');
        }

        if (!submitBtn) {
            console.error('Submit button not found!');
        }

        form.addEventListener('submit', function(e) {
            console.log('Form submission started');
                e.preventDefault();

            let hasErrors = false;
            let errors = [];

            // 只校验当前选择的地址类型
            const addressIdElem = document.getElementById('address_id');
            const addressId = addressIdElem ? addressIdElem.value : '0';

            if (addressId === '0') {
                // 新地址模式，校验新地址表单
                const requiredFields = ['full_name', 'house_number', 'state', 'city', 'postal_code'];
                requiredFields.forEach(field => {
                    const elem = document.getElementById(field);
                    if (!elem || !elem.value.trim()) {
                        if (elem) elem.classList.add('is-invalid');
                        hasErrors = true;
                        errors.push(`请填写 ${field}`);
                    } else {
                        elem.classList.remove('is-invalid');
                    }
                });
                // 校验州和城市有效性
                const state = document.getElementById('state').value;
                const city = document.getElementById('city').value;
                if (!state || !city || !malaysianStates[state] || !malaysianStates[state].includes(city)) {
                    errors.push('<?php echo addslashes($texts['error_invalid_state_city']); ?>');
                }
            }

            // 支付信息始终校验
            const cardNumberClean = cardNumber.value.replace(/\s/g, '');
            if (!/^\d{16}$/.test(cardNumberClean)) {
                errors.push('<?php echo addslashes($texts['error_invalid_card_number']); ?>');
            }

            if (!/^(0[1-9]|1[0-2])\/[0-9]{2}$/.test(expiryDate.value)) {
                errors.push('<?php echo addslashes($texts['error_invalid_expiry']); ?>');
            } else {
                const [month, year] = expiryDate.value.split('/');
                const fullYear = 2000 + parseInt(year);
                if (fullYear < 2025 || (fullYear === 2025 && parseInt(month) < 5)) {
                    errors.push('<?php echo addslashes($texts['error_invalid_expiry']); ?>');
                }
            }

            if (!/^\d{3}$/.test(cvv.value)) {
                errors.push('<?php echo addslashes($texts['error_invalid_cvv']); ?>');
            }

            if (hasErrors || errors.length > 0) {
                console.log('Validation errors:', errors);
                alert('提交失败，请检查以下错误：\n' + errors.join('\n'));
                return false;
            }

            // 如果验证通过，手动提交表单
            console.log('Validation passed, submitting form...');
            form.submit();
        });

        // 添加按钮点击事件监听器
        submitBtn.addEventListener('click', function(e) {
            console.log('Submit button clicked');
            // 触发表单提交
            form.dispatchEvent(new Event('submit'));
        });
    });
    </script>
</body>
</html>
<?php
// Clean output buffer
ob_end_flush();
?>