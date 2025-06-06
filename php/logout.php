<?php
// Configure session settings before starting
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
session_start();
require_once 'config.php';

// Regenerate session ID for security
session_regenerate_id(true);

// Set default language
$valid_langs = ['en', 'zh', 'es', 'ar', 'fr', 'ru', 'pt', 'de', 'ja', 'hi'];
if (!isset($_SESSION['lang']) || !in_array($_SESSION['lang'], $valid_langs)) {
    $_SESSION['lang'] = 'zh';
}
$lang = $_SESSION['lang'];
$site_dir = ($lang === 'ar') ? 'rtl' : 'ltr';

// Define translation texts
$languages = [
    'en' => [
        'site_title' => 'HAF - Logout',
        'meta_description' => 'Log out from your HAF account',
        'nav_home' => 'Home',
        'nav_history' => 'History',
        'nav_art' => 'Art',
        'nav_fashion' => 'Fashion',
        'nav_shop' => 'Shop',
        'nav_cart' => 'Cart',
        'nav_orders' => 'Orders',
        'nav_login' => 'Login',
        'nav_register' => 'Register',
        'logout_message' => 'You have successfully logged out',
        'login_button' => 'Login'
    ],
    'zh' => [
        'site_title' => 'HAF - 登出',
        'meta_description' => '从您的HAF账户登出',
        'nav_home' => '首页',
        'nav_history' => '历史',
        'nav_art' => '艺术',
        'nav_fashion' => '时尚',
        'nav_shop' => '商店',
        'nav_cart' => '购物车',
        'nav_orders' => '订单',
        'nav_login' => '登录',
        'nav_register' => '注册',
        'logout_message' => '您已成功登出',
        'login_button' => '登录'
    ],
    'es' => [
        'site_title' => 'HAF - Cerrar Sesión',
        'meta_description' => 'Cerrar sesión en tu cuenta HAF',
        'nav_home' => 'Inicio',
        'nav_history' => 'Historia',
        'nav_art' => 'Arte',
        'nav_fashion' => 'Moda',
        'nav_shop' => 'Tienda',
        'nav_cart' => 'Carrito',
        'nav_orders' => 'Pedidos',
        'nav_login' => 'Iniciar Sesión',
        'nav_register' => 'Registrarse',
        'logout_message' => 'Has cerrado sesión exitosamente',
        'login_button' => 'Iniciar Sesión'
    ],
    'ar' => [
        'site_title' => 'HAF - تسجيل الخروج',
        'meta_description' => 'تسجيل الخروج من حسابك في HAF',
        'nav_home' => 'الرئيسية',
        'nav_history' => 'التاريخ',
        'nav_art' => 'الفن',
        'nav_fashion' => 'الموضة',
        'nav_shop' => 'المتجر',
        'nav_cart' => 'سلة التسوق',
        'nav_orders' => 'الطلبات',
        'nav_login' => 'تسجيل الدخول',
        'nav_register' => 'التسجيل',
        'logout_message' => 'لقد تم تسجيل خروجك بنجاح',
        'login_button' => 'تسجيل الدخول'
    ],
    'fr' => [
        'site_title' => 'HAF - Déconnexion',
        'meta_description' => 'Se déconnecter de votre compte HAF',
        'nav_home' => 'Accueil',
        'nav_history' => 'Histoire',
        'nav_art' => 'Art',
        'nav_fashion' => 'Mode',
        'nav_shop' => 'Boutique',
        'nav_cart' => 'Panier',
        'nav_orders' => 'Commandes',
        'nav_login' => 'Connexion',
        'nav_register' => 'Inscription',
        'logout_message' => 'Vous vous êtes déconnecté avec succès',
        'login_button' => 'Connexion'
    ],
    'ru' => [
        'site_title' => 'HAF - Выход',
        'meta_description' => 'Выйти из вашего аккаунта HAF',
        'nav_home' => 'Главная',
        'nav_history' => 'История',
        'nav_art' => 'Искусство',
        'nav_fashion' => 'Мода',
        'nav_shop' => 'Магазин',
        'nav_cart' => 'Корзина',
        'nav_orders' => 'Заказы',
        'nav_login' => 'Вход',
        'nav_register' => 'Регистрация',
        'logout_message' => 'Вы успешно вышли из системы',
        'login_button' => 'Вход'
    ],
    'pt' => [
        'site_title' => 'HAF - Sair',
        'meta_description' => 'Sair da sua conta HAF',
        'nav_home' => 'Início',
        'nav_history' => 'História',
        'nav_art' => 'Arte',
        'nav_fashion' => 'Moda',
        'nav_shop' => 'Loja',
        'nav_cart' => 'Carrinho',
        'nav_orders' => 'Pedidos',
        'nav_login' => 'Login',
        'nav_register' => 'Registrar',
        'logout_message' => 'Você saiu com sucesso',
        'login_button' => 'Login'
    ],
    'de' => [
        'site_title' => 'HAF - Abmeldung',
        'meta_description' => 'Melden Sie sich aus Ihrem HAF-Konto ab',
        'nav_home' => 'Startseite',
        'nav_history' => 'Geschichte',
        'nav_art' => 'Kunst',
        'nav_fashion' => 'Mode',
        'nav_shop' => 'Shop',
        'nav_cart' => 'Warenkorb',
        'nav_orders' => 'Bestellungen',
        'nav_login' => 'Anmeldung',
        'nav_register' => 'Registrieren',
        'logout_message' => 'Sie haben sich erfolgreich abgemeldet',
        'login_button' => 'Anmeldung'
    ],
    'ja' => [
        'site_title' => 'HAF - ログアウト',
        'meta_description' => 'HAFアカウントからログアウト',
        'nav_home' => 'ホーム',
        'nav_history' => '歴史',
        'nav_art' => 'アート',
        'nav_fashion' => 'ファッション',
        'nav_shop' => 'ショップ',
        'nav_cart' => 'カート',
        'nav_orders' => '注文',
        'nav_login' => 'ログイン',
        'nav_register' => '登録',
        'logout_message' => '正常にログアウトしました',
        'login_button' => 'ログイン'
    ],
    'hi' => [
        'site_title' => 'HAF - लॉगआउट',
        'meta_description' => 'अपने HAF खाते से लॉगआउट करें',
        'nav_home' => 'होम',
        'nav_history' => 'इतिहास',
        'nav_art' => 'कला',
        'nav_fashion' => 'फैशन',
        'nav_shop' => 'दुकान',
        'nav_cart' => 'कार्ट',
        'nav_orders' => 'आदेश',
        'nav_login' => 'लॉगिन',
        'nav_register' => 'पंजीकरण',
        'logout_message' => 'आपने सफलतापूर्वक लॉग आउट कर लिया है',
        'login_button' => 'लॉगिन'
    ]
];

// Handle language switching
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lang'])) {
    $lang = in_array($_POST['lang'], $valid_langs) ? $_POST['lang'] : 'zh';
    $_SESSION['lang'] = $lang;
    header('Location: logout.php');
    exit;
}

// Log logout action
if (isset($_SESSION['user_id']) && isset($pdo) && $pdo !== null) {
    try {
        $stmt = $pdo->prepare("INSERT INTO logs (user_id, action, details) VALUES (?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], 'logout', 'User logged out']);
    } catch (PDOException $e) {
        error_log('Log logout failed: ' . $e->getMessage(), 3, 'C:/wamp64/logs/php_error.log');
    }
}

// Clear session
$_SESSION = [];
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();

// Start new session for language persistence
session_start();
$_SESSION['lang'] = $lang;
?>

<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>" dir="<?php echo htmlspecialchars($site_dir); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($languages[$lang]['meta_description']); ?>">
    <title><?php echo htmlspecialchars($languages[$lang]['site_title']); ?></title>
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

        .message-container {
            background-color: var(--snow);
            border: 2px solid var(--old-lace);
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--shadow-normal);
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
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

            .message-container {
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
                        <a class="nav-link animate__animated animate__jitter" href="login.php" data-lang-key="nav_login"><?php echo htmlspecialchars($languages[$lang]['nav_login']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__jitter" href="register.php" data-lang-key="nav_register"><?php echo htmlspecialchars($languages[$lang]['nav_register']); ?></a>
                    </li>
                    <li class="nav-item">
                        <form action="logout.php" method="post" class="d-inline">
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
        <h1 class="text-center animate__animated animate__fadeIn"><?php echo htmlspecialchars($languages[$lang]['logout_message']); ?></h1>
        <div class="message-container animate__animated animate__fadeIn" data-animate-delay="0.5s">
            <a href="login.php" class="btn btn-primary"><?php echo htmlspecialchars($languages[$lang]['login_button']); ?></a>
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
            
            document.title = languages[lang] ? languages[lang].site_title : '';
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