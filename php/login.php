<?php
// Configure session settings before starting the session
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => false, // Set to false for local development
    'httponly' => true,
    'samesite' => 'Lax' // Use Lax for better compatibility
]);

session_start();
require_once 'config.php';

// Ensure PDO connection
try {
    if (!isset($pdo) || $pdo === null) {
        $host = 'localhost';
        $db = 'haf_db';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';
        
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        
        $pdo = new PDO($dsn, $user, $pass, $options);
    }
} catch (PDOException $e) {
    error_log('Database connection failed: ' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
    die("Connection failed: " . $e->getMessage());
}

// Regenerate session ID for security
session_regenerate_id(true);

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: shop.php");
    exit;
}

// Set default language
$valid_langs = ['en', 'zh', 'es', 'ar', 'fr', 'ru', 'pt', 'de', 'ja', 'hi'];
if (!isset($_SESSION['lang']) || !in_array($_SESSION['lang'], $valid_langs)) {
    $_SESSION['lang'] = 'zh';
}
$lang = $_SESSION['lang'];
$site_dir = ($lang === 'ar') ? 'rtl' : 'ltr';

// Generate CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Define translation texts
$languages = [
    'en' => [
        'site_title' => 'HAF - Login',
        'meta_description' => 'Log in to your HAF account',
        'nav_home' => 'Home',
        'nav_history' => 'History',
        'nav_art' => 'Art',
        'nav_fashion' => 'Fashion',
        'nav_shop' => 'Shop',
        'nav_cart' => 'Cart',
        'nav_orders' => 'Orders',
        'nav_login' => 'Login',
        'nav_register' => 'Register',
        'login_title' => 'User Login',
        'username' => 'Username',
        'password' => 'Password',
        'login_button' => 'Login',
        'register_link' => 'No account? Register now',
        'error_invalid' => 'Invalid username or password',
        'error_db' => 'Unable to connect to the database, please contact the administrator',
        'error_csrf' => 'Invalid CSRF token'
    ],
    'zh' => [
        'site_title' => 'HAF - 登录',
        'meta_description' => '登录到您的HAF账户',
        'nav_home' => '首页',
        'nav_history' => '历史',
        'nav_art' => '艺术',
        'nav_fashion' => '时尚',
        'nav_shop' => '商店',
        'nav_cart' => '购物车',
        'nav_orders' => '订单',
        'nav_login' => '登录',
        'nav_register' => '注册',
        'login_title' => '用户登录',
        'username' => '用户名',
        'password' => '密码',
        'login_button' => '登录',
        'register_link' => '没有账户？立即注册',
        'error_invalid' => '用户名或密码无效',
        'error_db' => '无法连接到数据库，请联系管理员',
        'error_csrf' => '无效的CSRF令牌'
    ],
    // Placeholder translations for other languages (to be expanded as needed)
    'es' => [
        'site_title' => 'HAF - Iniciar Sesión',
        'meta_description' => 'Inicia sesión en tu cuenta HAF',
        'nav_home' => 'Inicio',
        'nav_history' => 'Historia',
        'nav_art' => 'Arte',
        'nav_fashion' => 'Moda',
        'nav_shop' => 'Tienda',
        'nav_cart' => 'Carrito',
        'nav_orders' => 'Pedidos',
        'nav_login' => 'Iniciar Sesión',
        'nav_register' => 'Registrarse',
        'login_title' => 'Inicio de Sesión de Usuario',
        'username' => 'Nombre de usuario',
        'password' => 'Contraseña',
        'login_button' => 'Iniciar Sesión',
        'register_link' => '¿No tienes cuenta? Regístrate ahora',
        'error_invalid' => 'Nombre de usuario o contraseña inválidos',
        'error_db' => 'No se puede conectar a la base de datos, contacta al administrador',
        'error_csrf' => 'Token CSRF inválido'
    ],
    'ar' => [
        'site_title' => 'HAF - تسجيل الدخول',
        'meta_description' => 'تسجيل الدخول إلى حسابك في HAF',
        'nav_home' => 'الرئيسية',
        'nav_history' => 'التاريخ',
        'nav_art' => 'الفن',
        'nav_fashion' => 'الموضة',
        'nav_shop' => 'المتجر',
        'nav_cart' => 'سلة التسوق',
        'nav_orders' => 'الطلبات',
        'nav_login' => 'تسجيل الدخول',
        'nav_register' => 'التسجيل',
        'login_title' => 'تسجيل دخول المستخدم',
        'username' => 'اسم المستخدم',
        'password' => 'كلمة المرور',
        'login_button' => 'تسجيل الدخول',
        'register_link' => 'ليس لديك حساب؟ سجل الآن',
        'error_invalid' => 'اسم المستخدم أو كلمة المرور غير صالحة',
        'error_db' => 'غير قادر على الاتصال بقاعدة البيانات، يرجى التواصل مع المسؤول',
        'error_csrf' => 'رمز CSRF غير صالح'
    ],
    'fr' => [
        'site_title' => 'HAF - Connexion',
        'meta_description' => 'Connectez-vous à votre compte HAF',
        'nav_home' => 'Accueil',
        'nav_history' => 'Histoire',
        'nav_art' => 'Art',
        'nav_fashion' => 'Mode',
        'nav_shop' => 'Boutique',
        'nav_cart' => 'Panier',
        'nav_orders' => 'Commandes',
        'nav_login' => 'Connexion',
        'nav_register' => 'Inscription',
        'login_title' => 'Connexion Utilisateur',
        'username' => 'Nom d’utilisateur',
        'password' => 'Mot de passe',
        'login_button' => 'Connexion',
        'register_link' => 'Pas de compte ? Inscrivez-vous maintenant',
        'error_invalid' => 'Nom d’utilisateur ou mot de passe invalide',
        'error_db' => 'Impossible de se connecter à la base de données, veuillez contacter l’administrateur',
        'error_csrf' => 'Jeton CSRF invalide'
    ],
    'ru' => [
        'site_title' => 'HAF - Вход',
        'meta_description' => 'Войдите в свой аккаунт HAF',
        'nav_home' => 'Главная',
        'nav_history' => 'История',
        'nav_art' => 'Искусство',
        'nav_fashion' => 'Мода',
        'nav_shop' => 'Магазин',
        'nav_cart' => 'Корзина',
        'nav_orders' => 'Заказы',
        'nav_login' => 'Вход',
        'nav_register' => 'Регистрация',
        'login_title' => 'Вход пользователя',
        'username' => 'Имя пользователя',
        'password' => 'Пароль',
        'login_button' => 'Войти',
        'register_link' => 'Нет аккаунта? Зарегистрируйтесь сейчас',
        'error_invalid' => 'Неверное имя пользователя или пароль',
        'error_db' => 'Не удалось подключиться к базе данных, обратитесь к администратору',
        'error_csrf' => 'Недействительный токен CSRF'
    ],
    'pt' => [
        'site_title' => 'HAF - Login',
        'meta_description' => 'Faça login na sua conta HAF',
        'nav_home' => 'Início',
        'nav_history' => 'História',
        'nav_art' => 'Arte',
        'nav_fashion' => 'Moda',
        'nav_shop' => 'Loja',
        'nav_cart' => 'Carrinho',
        'nav_orders' => 'Pedidos',
        'nav_login' => 'Login',
        'nav_register' => 'Registrar',
        'login_title' => 'Login do Usuário',
        'username' => 'Nome de usuário',
        'password' => 'Senha',
        'login_button' => 'Entrar',
        'register_link' => 'Não tem conta? Registre-se agora',
        'error_invalid' => 'Nome de usuário ou senha inválidos',
        'error_db' => 'Não foi possível conectar ao banco de dados, entre em contato com o administrador',
        'error_csrf' => 'Token CSRF inválido'
    ],
    'de' => [
        'site_title' => 'HAF - Anmeldung',
        'meta_description' => 'Melden Sie sich bei Ihrem HAF-Konto an',
        'nav_home' => 'Startseite',
        'nav_history' => 'Geschichte',
        'nav_art' => 'Kunst',
        'nav_fashion' => 'Mode',
        'nav_shop' => 'Shop',
        'nav_cart' => 'Warenkorb',
        'nav_orders' => 'Bestellungen',
        'nav_login' => 'Anmeldung',
        'nav_register' => 'Registrieren',
        'login_title' => 'Benutzeranmeldung',
        'username' => 'Benutzername',
        'password' => 'Passwort',
        'login_button' => 'Anmelden',
        'register_link' => 'Kein Konto? Jetzt registrieren',
        'error_invalid' => 'Ungültiger Benutzername oder Passwort',
        'error_db' => 'Verbindung zur Datenbank fehlgeschlagen, bitte kontaktieren Sie den Administrator',
        'error_csrf' => 'Ungültiges CSRF-Token'
    ],
    'ja' => [
        'site_title' => 'HAF - ログイン',
        'meta_description' => 'HAFアカウントにログイン',
        'nav_home' => 'ホーム',
        'nav_history' => '歴史',
        'nav_art' => 'アート',
        'nav_fashion' => 'ファッション',
        'nav_shop' => 'ショップ',
        'nav_cart' => 'カート',
        'nav_orders' => '注文',
        'nav_login' => 'ログイン',
        'nav_register' => '登録',
        'login_title' => 'ユーザーログイン',
        'username' => 'ユーザー名',
        'password' => 'パスワード',
        'login_button' => 'ログイン',
        'register_link' => 'アカウントがありませんか？今すぐ登録',
        'error_invalid' => 'ユーザー名またはパスワードが無効です',
        'error_db' => 'データベースに接続できません。管理者に連絡してください',
        'error_csrf' => '無効なCSRFトークン'
    ],
    'hi' => [
        'site_title' => 'HAF - लॉगिन',
        'meta_description' => 'अपने HAF खाते में लॉगिन करें',
        'nav_home' => 'होम',
        'nav_history' => 'इतिहास',
        'nav_art' => 'कला',
        'nav_fashion' => 'फैशन',
        'nav_shop' => 'दुकान',
        'nav_cart' => 'कार्ट',
        'nav_orders' => 'आदेश',
        'nav_login' => 'लॉगिन',
        'nav_register' => 'रजिस्टर',
        'login_title' => 'उपयोगकर्ता लॉगिन',
        'username' => 'उपयोगकर्ता नाम',
        'password' => 'पासवर्ड',
        'login_button' => 'लॉगिन',
        'register_link' => 'कोई खाता नहीं है? अभी रजिस्टर करें',
        'error_invalid' => 'अमान्य उपयोगकर्ता नाम या पासवर्ड',
        'error_db' => 'डेटाबेस से कनेक्ट करने में असमर्थ, कृपया व्यवस्थापक से संपर्क करें',
        'error_csrf' => 'अमान्य CSRF टोकन'
    ]
];

// Handle language switching
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lang'])) {
    $lang = in_array($_POST['lang'], $valid_langs) ? $_POST['lang'] : 'zh';
    $_SESSION['lang'] = $lang;
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'lang' => $lang]);
    exit;
}

// Handle login
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    if (!isset($pdo) || $pdo === null) {
        $error = $languages[$lang]['error_db'];
        error_log('PDO is undefined or null in login.php', 3, 'C:/wamp64/logs/php_error.log');
    } else {
        try {
            $username = htmlspecialchars(strip_tags(trim($_POST['username'] ?? '')));
            $password = $_POST['password'] ?? '';

            if ($username && $password) {
                $stmt = $pdo->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
                $stmt->execute([$username]);
                $user = $stmt->fetch();
                
                error_log('Login attempt: ' . $username, 3, 'C:/wamp64/logs/php_error.log');
                error_log('User found: ' . ($user ? 'Yes' : 'No'), 3, 'C:/wamp64/logs/php_error.log');
                if ($user) {
                    error_log('Password comparison: ' . ($password === $user['password'] ? 'Success' : 'Failed'), 3, 'C:/wamp64/logs/php_error.log');
                }
                
                // Compare plain text password (for testing)
                if ($user && $password === $user['password']) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];

                    // Log successful login
                    $stmt = $pdo->prepare("INSERT INTO logs (user_id, action, details) VALUES (?, ?, ?)");
                    $stmt->execute([$user['id'], 'login', 'User logged in successfully']);

                    header("Location: shop.php");
                    exit;
                } else {
                    $error = $languages[$lang]['error_invalid'];

                    // Log failed login attempt
                    $stmt = $pdo->prepare("INSERT INTO logs (user_id, action, details) VALUES (?, ?, ?)");
                    $stmt->execute([null, 'login_failed', json_encode(['username' => $username])]);
                }
            } else {
                $error = $languages[$lang]['error_invalid'];
            }
        } catch (PDOException $e) {
            $error = $languages[$lang]['error_db'];
            error_log('Login failed: ' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = $languages[$lang]['error_csrf'];
}
?>

<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>" dir="<?php echo htmlspecialchars($site_dir); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($languages[$lang]['meta_description']); ?>">
    <title><?php echo htmlspecialchars($languages[$lang]['site_title']); ?> - HAF</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&family=Playfair+Display:wght@400;700&family=Raleway:wght@300;400;500&family=Noto+Sans+Arabic:wght@400;700&family=Noto+Sans+JP:wght@400;700&family=Noto+Sans+Devanagari:wght@400;700&display=swap" rel="stylesheet">
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
            --gradient: linear-gradient(135deg, var(--papaya-whip) 0%, var(--snow) 100%);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--custom-light);
            color: var(--charcoal);
            line-height: 1.6;
            box-sizing: border-box;
            scroll-behavior: smooth;
            text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        .navbar {
            background-color: var(--papaya-whip);
            border-bottom: 2px solid var(--old-lace);
            box-shadow: var(--shadow-normal);
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--charcoal);
        }

        .nav-link {
            font-family: 'Raleway', sans-serif;
            font-size: 1.1rem;
            color: var(--charcoal);
            margin: 0 15px;
        }

        .nav-link:hover {
            color: var(--old-lace);
        }

        .language-selector {
            background-color: var(--ivory);
            border: 2px solid var(--old-lace);
            padding: 5px 10px;
            border-radius: 5px;
            font-family: 'Raleway', sans-serif;
        }

        section {
            padding: 80px 0;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 700;
            color: var(--charcoal);
            margin-bottom: 20px;
            animation: fadeIn 1s ease-in;
        }

        .form-container {
            background-color: var(--snow);
            border: 2px solid var(--old-lace);
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--shadow-normal);
            max-width: 600px;
            margin: 0 auto;
        }

        .form-label {
            font-family: 'Raleway', sans-serif;
            font-size: 1.1rem;
            color: var(--charcoal);
        }

        .form-control {
            font-family: 'Raleway', sans-serif;
            font-size: 1rem;
            border: 2px solid var(--old-lace);
            border-radius: 5px;
            background-color: var(--ivory);
        }

        .form-control:focus {
            border-color: var(--papaya-whip);
            box-shadow: var(--shadow-hover);
        }

        .btn-primary {
            background-color: var(--old-lace);
            border: 2px solid var(--old-lace);
            color: var(--charcoal);
            font-family: 'Raleway', sans-serif;
            font-size: 1.1rem;
            padding: 10px 30px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--ivory);
            border-color: var(--charcoal);
            box-shadow: var(--shadow-hover);
        }

        .alert {
            font-family: 'Raleway', sans-serif;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .register-link {
            font-family: 'Raleway', sans-serif;
            font-size: 1rem;
            color: var(--charcoal);
            text-decoration: none;
            text-align: center;
            display: block;
        }

        .register-link:hover {
            color: var(--old-lace);
        }

        [lang="ar"] {
            font-family: 'Noto Sans Arabic', sans-serif;
        }

        [lang="ja"] {
            font-family: 'Noto Sans JP', sans-serif;
        }

        [lang="hi"] {
            font-family: 'Noto Sans Devanagari', sans-serif;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }

            .form-container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand animate__animated animate__jitter" href="../index.php">HAF</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__jitter" href="../index.php" data-lang-key="nav_home"><?php echo htmlspecialchars($languages[$lang]['nav_home']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__jitter" href="../history.php" data-lang-key="nav_history"><?php echo htmlspecialchars($languages[$lang]['nav_history']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__jitter" href="../art.php" data-lang-key="nav_art"><?php echo htmlspecialchars($languages[$lang]['nav_art']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__jitter" href="../fashion.php" data-lang-key="nav_fashion"><?php echo htmlspecialchars($languages[$lang]['nav_fashion']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__jitter" href="shop.php" data-lang-key="nav_shop"><?php echo htmlspecialchars($languages[$lang]['nav_shop']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__jitter" href="cart.php" data-lang-key="nav_cart"><?php echo htmlspecialchars($languages[$lang]['nav_cart']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__jitter" href="orders.php" data-lang-key="nav_orders"><?php echo htmlspecialchars($languages[$lang]['nav_orders']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__jitter active" href="login.php" data-lang-key="nav_login"><?php echo htmlspecialchars($languages[$lang]['nav_login']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__jitter" href="register.php" data-lang-key="nav_register"><?php echo htmlspecialchars($languages[$lang]['nav_register']); ?></a>
                    </li>
                    <li class="nav-item">
                        <form action="login.php" method="post" class="d-inline">
                            <select name="lang" class="language-selector" onchange="this.form.submit()">
                                <?php foreach ($valid_langs as $l): ?>
                                    <option value="<?php echo htmlspecialchars($l); ?>" <?php echo $lang === $l ? 'selected' : ''; ?>><?php echo strtoupper($l); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="container">
        <h1 class="text-center animate__animated animate__fadeIn"><?php echo htmlspecialchars($languages[$lang]['login_title']); ?></h1>
        <div class="form-container animate__animated animate__fadeIn" data-animate-delay="0.5s">
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                <div class="mb-3">
                    <label for="username" class="form-label"><?php echo htmlspecialchars($languages[$lang]['username']); ?></label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label"><?php echo htmlspecialchars($languages[$lang]['password']); ?></label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo htmlspecialchars($languages[$lang]['login_button']); ?></button>
            </form>
            <a href="register.php" class="register-link"><?php echo htmlspecialchars($languages[$lang]['register_link']); ?></a>
        </div>
    </section>

    <footer class="text-center" style="background-color: var(--papaya-whip); border-top: 2px solid var(--old-lace); padding: 30px 0;">
        <p>© <?php echo date('Y'); ?> HAF. All rights reserved.</p>
        <div>
            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const lang = '<?php echo $lang; ?>';
        const languages = <?php echo json_encode($languages); ?>;
        const translateElements = () => {
            document.querySelectorAll('[data-lang-key]').forEach(element => {
                const key = element.getAttribute('data-lang-key');
                if (languages[lang] && languages[lang][key]) {
                    element.textContent = languages[lang][key];
                } else if (languages['zh'] && languages['zh'][key]) {
                    element.textContent = languages['zh'][key];
                }
            });
            
            document.title = (languages[lang] ? languages[lang].site_title : '') + ' - HAF';
            const metaDesc = document.querySelector('meta[name="description"]');
            if (metaDesc && languages[lang] && languages[lang].meta_description) {
                metaDesc.setAttribute('content', languages[lang].meta_description);
            }
            
            document.documentElement.lang = lang === 'zh' ? 'zh-CN' : lang;
        };
        
        translateElements();
    });
    </script>
</body>
</html>