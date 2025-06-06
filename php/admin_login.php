<?php
session_start();
require_once 'config.php';

// Set strict session settings
session_regenerate_id(true);
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);

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
        'site_title' => 'HAF - 管理员登录',
        'meta_description' => 'HAF管理员登录页面',
        'nav_history' => '历史',
        'nav_art' => '艺术',
        'nav_fashion' => '时尚',
        'nav_shop' => '商店',
        'nav_cart' => '购物车',
        'nav_orders' => '订单',
        'nav_login' => '登录',
        'nav_register' => '注册',
        'admin_login_title' => '管理员登录',
        'username' => '用户名',
        'password' => '密码',
        'login_button' => '登录',
        'error_invalid' => '用户名或密码无效',
        'error_db' => '数据库操作失败，请联系管理员',
        'error_csrf' => '无效的CSRF令牌'
    ],
    'en' => [
        'site_title' => 'HAF - Admin Login',
        'meta_description' => 'HAF Admin Login Page',
        'nav_history' => 'History',
        'nav_art' => 'Art',
        'nav_fashion' => 'Fashion',
        'nav_shop' => 'Shop',
        'nav_cart' => 'Cart',
        'nav_orders' => 'Orders',
        'nav_login' => 'Login',
        'nav_register' => 'Register',
        'admin_login_title' => 'Admin Login',
        'username' => 'Username',
        'password' => 'Password',
        'login_button' => 'Login',
        'error_invalid' => 'Invalid username or password',
        'error_db' => 'Database operation failed, please contact the administrator',
        'error_csrf' => 'Invalid CSRF token'
    ],
    'ms' => [
        'site_title' => 'HAF - Log Masuk Admin',
        'meta_description' => 'Halaman Log Masuk Admin HAF',
        'nav_history' => 'Sejarah',
        'nav_art' => 'Seni',
        'nav_fashion' => 'Fesyen',
        'nav_shop' => 'Kedai',
        'nav_cart' => 'Troli',
        'nav_orders' => 'Pesanan',
        'nav_login' => 'Log Masuk',
        'nav_register' => 'Daftar',
        'admin_login_title' => 'Log Masuk Admin',
        'username' => 'Nama Pengguna',
        'password' => 'Kata Laluan',
        'login_button' => 'Log Masuk',
        'error_invalid' => 'Nama pengguna atau kata laluan tidak sah',
        'error_db' => 'Operasi pangkalan data gagal, sila hubungi pentadbir',
        'error_csrf' => 'Token CSRF tidak sah'
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

// Handle login
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    if (isset($pdo) && $pdo !== null) {
        try {
            $username = filter_var($_POST['username'] ?? '', FILTER_SANITIZE_STRING);
            $password = $_POST['password'] ?? '';

            if ($username && $password) {
                $stmt = $pdo->prepare("SELECT id, username, password, role FROM users WHERE username = ? AND role = 'admin'");
                $stmt->execute([$username]);
                $user = $stmt->fetch();

                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];

                    // Log successful login
                    $stmt = $pdo->prepare("INSERT INTO logs (user_id, action, details) VALUES (?, ?, ?)");
                    $stmt->execute([$user['id'], 'admin_login', 'Admin logged in successfully']);

                    header("Location: admin.php");
                    exit;
                } else {
                    $error = $texts['error_invalid'];

                    // Log failed login attempt
                    $stmt = $pdo->prepare("INSERT INTO logs (user_id, action, details) VALUES (?, ?, ?)");
                    $stmt->execute([null, 'admin_login_failed', json_encode(['username' => $username])]);
                }
            } else {
                $error = $texts['error_invalid'];
            }
        } catch (PDOException $e) {
            $error = $texts['error_db'];
            error_log('Admin login failed: ' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
        }
    } else {
        $error = $texts['error_db'];
        error_log('PDO is undefined or null in admin_login.php', 3, 'C:/wamp64/logs/php_error.log');
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = $texts['error_csrf'];
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
            --color-1: #ffd6e8;
            --color-2: #ffeceb;
            --color-3: #fffbf5;
            --color-4: #ebfff0;
            --color-5: #d1f5ff;
            --text-dark: #333333;
            --fashion-bg: linear-gradient(135deg, #fffbf5 0%, #ffd6e8 50%, #d1f5ff 100%);
        }
        body {
            font-family: Arial, sans-serif;
            background: var(--fashion-bg);
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
            max-width: 500px;
            margin-top: 50px;
        }
        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            width: 100%;
            padding: 8px;
            font-size: 1rem;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 4px;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .alert {
            margin-bottom: 15px;
        }
        @media (max-width: 768px) {
            .container {
                padding: 10px;
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
                        <a class="nav-link animate-jitter active" href="admin_login.php" data-lang-key="nav_login"><?php echo htmlspecialchars($texts['nav_login']); ?></a>
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

    <div class="container">
        <div class="card">
            <h2 class="text-center"><?php echo htmlspecialchars($texts['admin_login_title']); ?></h2>
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                <div class="form-group">
                    <label for="username"><?php echo htmlspecialchars($texts['username']); ?></label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password"><?php echo htmlspecialchars($texts['password']); ?></label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo htmlspecialchars($texts['login_button']); ?></button>
            </form>
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