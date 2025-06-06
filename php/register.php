<?php
session_start();

// Database connection
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "haf_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $conn->exec("SET NAMES utf8mb4");
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Set default language
$valid_langs = ['en', 'zh', 'es', 'ar', 'fr', 'ru', 'pt', 'de', 'ja', 'hi'];
if (!isset($_SESSION['lang']) || !in_array($_SESSION['lang'], $valid_langs)) {
    $_SESSION['lang'] = 'zh';
}
$lang = $_SESSION['lang'];
$site_dir = ($lang === 'ar') ? 'rtl' : 'ltr';

// Translation array
$translations = [
    'en' => [
        'site_title' => 'HAF - Register',
        'meta_description' => 'Register for a HAF account',
        'nav_home' => 'Home',
        'nav_history' => 'History',
        'nav_art' => 'Art',
        'nav_fashion' => 'Fashion',
        'nav_shop' => 'Shop',
        'nav_cart' => 'Cart',
        'nav_orders' => 'Orders',
        'nav_login' => 'Login',
        'nav_register' => 'Register',
        'register_title' => 'User Registration',
        'username_label' => 'Username',
        'email_label' => 'Email',
        'password_label' => 'Password',
        'confirm_password_label' => 'Confirm Password',
        'submit_button' => 'Register',
        'username_error' => 'Username is required and must be 3-100 characters.',
        'email_error' => 'Valid email is required.',
        'password_error' => 'Password must be at least 6 characters.',
        'confirm_password_error' => 'Passwords do not match.',
        'username_exists' => 'Username already exists.',
        'email_exists' => 'Email already exists.',
        'success_message' => 'Registration successful! You can now log in.',
        'error_message' => 'Registration failed. Please try again.',
        'login_link' => 'Already have an account? Log in.',
    ],
    'zh' => [
        'site_title' => 'HAF - 注册',
        'meta_description' => '注册您的HAF账户',
        'nav_home' => '首页',
        'nav_history' => '历史',
        'nav_art' => '艺术',
        'nav_fashion' => '时尚',
        'nav_shop' => '商店',
        'nav_cart' => '购物车',
        'nav_orders' => '订单',
        'nav_login' => '登录',
        'nav_register' => '注册',
        'register_title' => '用户注册',
        'username_label' => '用户名',
        'email_label' => '电子邮件',
        'password_label' => '密码',
        'confirm_password_label' => '确认密码',
        'submit_button' => '注册',
        'username_error' => '用户名必填，长度需为3-100个字符。',
        'email_error' => '请输入有效的电子邮件地址。',
        'password_error' => '密码长度至少为6个字符。',
        'confirm_password_error' => '两次输入的密码不一致。',
        'username_exists' => '用户名已存在。',
        'email_exists' => '电子邮件已存在。',
        'success_message' => '注册成功！您现在可以登录。',
        'error_message' => '注册失败，请重试。',
        'login_link' => '已有账户？登录。',
    ],
    'es' => [
        'site_title' => 'HAF - Registro',
        'meta_description' => 'Regístrate para obtener una cuenta HAF',
        'nav_home' => 'Inicio',
        'nav_history' => 'Historia',
        'nav_art' => 'Arte',
        'nav_fashion' => 'Moda',
        'nav_shop' => 'Tienda',
        'nav_cart' => 'Carrito',
        'nav_orders' => 'Pedidos',
        'nav_login' => 'Iniciar Sesión',
        'nav_register' => 'Registrarse',
        'register_title' => 'Registro de Usuario',
        'username_label' => 'Nombre de usuario',
        'email_label' => 'Correo electrónico',
        'password_label' => 'Contraseña',
        'confirm_password_label' => 'Confirmar Contraseña',
        'submit_button' => 'Registrarse',
        'username_error' => 'El nombre de usuario es obligatorio y debe tener entre 3 y 100 caracteres.',
        'email_error' => 'Se requiere un correo electrónico válido.',
        'password_error' => 'La contraseña debe tener al menos 6 caracteres.',
        'confirm_password_error' => 'Las contraseñas no coinciden.',
        'username_exists' => 'El nombre de usuario ya existe.',
        'email_exists' => 'El correo electrónico ya existe.',
        'success_message' => '¡Registro exitoso! Ahora puedes iniciar sesión.',
        'error_message' => 'El registro falló. Por favor, intenta de nuevo.',
        'login_link' => '¿Ya tienes una cuenta? Inicia sesión.',
    ],
    'ar' => [
        'site_title' => 'HAF - التسجيل',
        'meta_description' => 'سجل للحصول على حساب HAF',
        'nav_home' => 'الرئيسية',
        'nav_history' => 'التاريخ',
        'nav_art' => 'الفن',
        'nav_fashion' => 'الموضة',
        'nav_shop' => 'المتجر',
        'nav_cart' => 'سلة التسوق',
        'nav_orders' => 'الطلبات',
        'nav_login' => 'تسجيل الدخول',
        'nav_register' => 'التسجيل',
        'register_title' => 'تسجيل المستخدم',
        'username_label' => 'اسم المستخدم',
        'email_label' => 'البريد الإلكتروني',
        'password_label' => 'كلمة المرور',
        'confirm_password_label' => 'تأكيد كلمة المرور',
        'submit_button' => 'التسجيل',
        'username_error' => 'اسم المستخدم مطلوب ويجب أن يكون بين 3 و100 حرف.',
        'email_error' => 'البريد الإلكتروني الصحيح مطلوب.',
        'password_error' => 'يجب أن تكون كلمة المرور 6 أحرف على الأقل.',
        'confirm_password_error' => 'كلمتا المرور غير متطابقتين.',
        'username_exists' => 'اسم المستخدم موجود بالفعل.',
        'email_exists' => 'البريد الإلكتروني موجود بالفعل.',
        'success_message' => 'تم التسجيل بنجاح! يمكنك الآن تسجيل الدخول.',
        'error_message' => 'فشل التسجيل. حاول مرة أخرى.',
        'login_link' => 'هل لديك حساب بالفعل؟ تسجيل الدخول.',
    ],
    'fr' => [
        'site_title' => 'HAF - Inscription',
        'meta_description' => 'Inscrivez-vous pour un compte HAF',
        'nav_home' => 'Accueil',
        'nav_history' => 'Histoire',
        'nav_art' => 'Art',
        'nav_fashion' => 'Mode',
        'nav_shop' => 'Boutique',
        'nav_cart' => 'Panier',
        'nav_orders' => 'Commandes',
        'nav_login' => 'Connexion',
        'nav_register' => 'Inscription',
        'register_title' => 'Inscription Utilisateur',
        'username_label' => 'Nom d’utilisateur',
        'email_label' => 'Email',
        'password_label' => 'Mot de passe',
        'confirm_password_label' => 'Confirmer le mot de passe',
        'submit_button' => 'S’inscrire',
        'username_error' => 'Le nom d’utilisateur est requis et doit contenir entre 3 et 100 caractères.',
        'email_error' => 'Un email valide est requis.',
        'password_error' => 'Le mot de passe doit contenir au moins 6 caractères.',
        'confirm_password_error' => 'Les mots de passe ne correspondent pas.',
        'username_exists' => 'Le nom d’utilisateur existe déjà.',
        'email_exists' => 'L’email existe déjà.',
        'success_message' => 'Inscription réussie ! Vous pouvez maintenant vous connecter.',
        'error_message' => 'L’inscription a échoué. Veuillez réessayer.',
        'login_link' => 'Vous avez déjà un compte ? Connectez-vous.',
    ],
    'ru' => [
        'site_title' => 'HAF - Регистрация',
        'meta_description' => 'Зарегистрируйтесь для создания аккаунта HAF',
        'nav_home' => 'Главная',
        'nav_history' => 'История',
        'nav_art' => 'Искусство',
        'nav_fashion' => 'Мода',
        'nav_shop' => 'Магазин',
        'nav_cart' => 'Корзина',
        'nav_orders' => 'Заказы',
        'nav_login' => 'Вход',
        'nav_register' => 'Регистрация',
        'register_title' => 'Регистрация пользователя',
        'username_label' => 'Имя пользователя',
        'email_label' => 'Электронная почта',
        'password_label' => 'Пароль',
        'confirm_password_label' => 'Подтвердить пароль',
        'submit_button' => 'Зарегистрироваться',
        'username_error' => 'Имя пользователя обязательно и должно содержать от 3 до 100 символов.',
        'email_error' => 'Требуется действительный адрес электронной почты.',
        'password_error' => 'Пароль должен содержать не менее 6 символов.',
        'confirm_password_error' => 'Пароли не совпадают.',
        'username_exists' => 'Имя пользователя уже существует.',
        'email_exists' => 'Электронная почта уже существует.',
        'success_message' => 'Регистрация прошла успешно! Теперь вы можете войти.',
        'error_message' => 'Регистрация не удалась. Пожалуйста, попробуйте снова.',
        'login_link' => 'Уже есть аккаунт? Войдите.',
    ],
    'pt' => [
        'site_title' => 'HAF - Registro',
        'meta_description' => 'Registre-se para uma conta HAF',
        'nav_home' => 'Início',
        'nav_history' => 'História',
        'nav_art' => 'Arte',
        'nav_fashion' => 'Moda',
        'nav_shop' => 'Loja',
        'nav_cart' => 'Carrinho',
        'nav_orders' => 'Pedidos',
        'nav_login' => 'Login',
        'nav_register' => 'Registrar',
        'register_title' => 'Registro de Usuário',
        'username_label' => 'Nome de usuário',
        'email_label' => 'Email',
        'password_label' => 'Senha',
        'confirm_password_label' => 'Confirmar Senha',
        'submit_button' => 'Registrar',
        'username_error' => 'O nome de usuário é obrigatório e deve ter entre 3 e 100 caracteres.',
        'email_error' => 'É necessário um email válido.',
        'password_error' => 'A senha deve ter pelo menos 6 caracteres.',
        'confirm_password_error' => 'As senhas não coincidem.',
        'username_exists' => 'O nome de usuário já existe.',
        'email_exists' => 'O email já existe.',
        'success_message' => 'Registro bem-sucedido! Agora você pode fazer login.',
        'error_message' => 'O registro falhou. Por favor, tente novamente.',
        'login_link' => 'Já tem uma conta? Faça login.',
    ],
    'de' => [
        'site_title' => 'HAF - Registrierung',
        'meta_description' => 'Registrieren Sie sich für ein HAF-Konto',
        'nav_home' => 'Startseite',
        'nav_history' => 'Geschichte',
        'nav_art' => 'Kunst',
        'nav_fashion' => 'Mode',
        'nav_shop' => 'Shop',
        'nav_cart' => 'Warenkorb',
        'nav_orders' => 'Bestellungen',
        'nav_login' => 'Anmeldung',
        'nav_register' => 'Registrieren',
        'register_title' => 'Benutzerregistrierung',
        'username_label' => 'Benutzername',
        'email_label' => 'Email',
        'password_label' => 'Passwort',
        'confirm_password_label' => 'Passwort bestätigen',
        'submit_button' => 'Registrieren',
        'username_error' => 'Der Benutzername ist erforderlich und muss zwischen 3 und 100 Zeichen lang sein.',
        'email_error' => 'Eine gültige Email ist erforderlich.',
        'password_error' => 'Das Passwort muss mindestens 6 Zeichen lang sein.',
        'confirm_password_error' => 'Die Passwörter stimmen nicht überein.',
        'username_exists' => 'Der Benutzername existiert bereits.',
        'email_exists' => 'Die Email existiert bereits.',
        'success_message' => 'Registrierung erfolgreich! Sie können sich jetzt anmelden.',
        'error_message' => 'Registrierung fehlgeschlagen. Bitte versuchen Sie es erneut.',
        'login_link' => 'Haben Sie schon ein Konto? Melden Sie sich an.',
    ],
    'ja' => [
        'site_title' => 'HAF - 登録',
        'meta_description' => 'HAFアカウントに登録',
        'nav_home' => 'ホーム',
        'nav_history' => '歴史',
        'nav_art' => 'アート',
        'nav_fashion' => 'ファッション',
        'nav_shop' => 'ショップ',
        'nav_cart' => 'カート',
        'nav_orders' => '注文',
        'nav_login' => 'ログイン',
        'nav_register' => '登録',
        'register_title' => 'ユーザー登録',
        'username_label' => 'ユーザー名',
        'email_label' => 'メール',
        'password_label' => 'パスワード',
        'confirm_password_label' => 'パスワードの確認',
        'submit_button' => '登録',
        'username_error' => 'ユーザー名は必須で、3～100文字である必要があります。',
        'email_error' => '有効なメールアドレスが必要です。',
        'password_error' => 'パスワードは6文字以上である必要があります。',
        'confirm_password_error' => 'パスワードが一致しません。',
        'username_exists' => 'ユーザー名はすでに存在します。',
        'email_exists' => 'メールアドレスはすでに存在します。',
        'success_message' => '登録が成功しました！これでログインできます。',
        'error_message' => '登録に失敗しました。もう一度お試しください。',
        'login_link' => 'すでにアカウントをお持ちですか？ログインしてください。',
    ],
    'hi' => [
        'site_title' => 'HAF - पंजीकरण',
        'meta_description' => 'HAF खाते के लिए पंजीकरण करें',
        'nav_home' => 'होम',
        'nav_history' => 'इतिहास',
        'nav_art' => 'कला',
        'nav_fashion' => 'फैशन',
        'nav_shop' => 'दुकान',
        'nav_cart' => 'कार्ट',
        'nav_orders' => 'आदेश',
        'nav_login' => 'लॉगिन',
        'nav_register' => 'पंजीकरण',
        'register_title' => 'उपयोगकर्ता पंजीकरण',
        'username_label' => 'उपयोगकर्ता नाम',
        'email_label' => 'ईमेल',
        'password_label' => 'पासवर्ड',
        'confirm_password_label' => 'पासवर्ड की पुष्टि',
        'submit_button' => 'पंजीकरण',
        'username_error' => 'उपयोगकर्ता नाम आवश्यक है और 3-100 अक्षरों का होना चाहिए।',
        'email_error' => 'मान्य ईमेल आवश्यक है।',
        'password_error' => 'पासवर्ड कम से कम 6 अक्षरों का होना चाहिए।',
        'confirm_password_error' => 'पासवर्ड मेल नहीं खाते।',
        'username_exists' => 'उपयोगकर्ता नाम पहले से मौजूद है।',
        'email_exists' => 'ईमेल पहले से मौजूद है।',
        'success_message' => 'पंजीकरण सफल! अब आप लॉगिन कर सकते हैं।',
        'error_message' => 'पंजीकरण विफल। कृपया पुनः प्रयास करें।',
        'login_link' => 'पहले से खाता है? लॉगिन करें।',
    ],
];

// Handle language switching
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lang'])) {
    $lang = in_array($_POST['lang'], $valid_langs) ? $_POST['lang'] : 'zh';
    $_SESSION['lang'] = $lang;
    header('Location: register.php');
    exit;
}

// Form processing
$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validation
    if (empty($username) || strlen($username) < 3 || strlen($username) > 100) {
        $errors[] = $translations[$lang]['username_error'];
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = $translations[$lang]['email_error'];
    }

    if (strlen($password) < 6) {
        $errors[] = $translations[$lang]['password_error'];
    }

    if ($password !== $confirm_password) {
        $errors[] = $translations[$lang]['confirm_password_error'];
    }

    // Check for existing username or email
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        $existing_user = $stmt->fetch();

        if ($existing_user) {
            if ($stmt->rowCount() > 0) {
                $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
                $stmt->execute([$username]);
                if ($stmt->rowCount() > 0) {
                    $errors[] = $translations[$lang]['username_exists'];
                } else {
                    $errors[] = $translations[$lang]['email_exists'];
                }
            }
        }
    }

    // Insert user if no errors
    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'user')");
        try {
            $stmt->execute([$username, $email, $password]);
            $success = $translations[$lang]['success_message'];
        } catch (PDOException $e) {
            $errors[] = $translations[$lang]['error_message'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>" dir="<?php echo htmlspecialchars($site_dir); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($translations[$lang]['meta_description']); ?>">
    <title><?php echo htmlspecialchars($translations[$lang]['site_title']); ?></title>
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

        .login-link {
            font-family: 'Raleway', sans-serif;
            font-size: 1rem;
            color: var(--charcoal);
            text-decoration: none;
            text-align: center;
            display: block;
        }

        .login-link:hover {
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
                        <a class="nav-link animate__animated animate__jitter" href="../index.php" data-lang-key="nav_home"><?php echo htmlspecialchars($translations[$lang]['nav_home']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__jitter" href="../history.php" data-lang-key="nav_history"><?php echo htmlspecialchars($translations[$lang]['nav_history']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__jitter" href="../art.php" data-lang-key="nav_art"><?php echo htmlspecialchars($translations[$lang]['nav_art']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__jitter" href="../fashion.php" data-lang-key="nav_fashion"><?php echo htmlspecialchars($translations[$lang]['nav_fashion']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__jitter" href="shop.php" data-lang-key="nav_shop"><?php echo htmlspecialchars($translations[$lang]['nav_shop']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__jitter" href="cart.php" data-lang-key="nav_cart"><?php echo htmlspecialchars($translations[$lang]['nav_cart']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__jitter" href="orders.php" data-lang-key="nav_orders"><?php echo htmlspecialchars($translations[$lang]['nav_orders']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__jitter" href="login.php" data-lang-key="nav_login"><?php echo htmlspecialchars($translations[$lang]['nav_login']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__jitter active" href="register.php" data-lang-key="nav_register"><?php echo htmlspecialchars($translations[$lang]['nav_register']); ?></a>
                    </li>
                    <li class="nav-item">
                        <form action="register.php" method="post" class="d-inline">
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
        <h1 class="text-center animate__animated animate__fadeIn"><?php echo htmlspecialchars($translations[$lang]['register_title']); ?></h1>
        <div class="form-container animate__animated animate__fadeIn" data-animate-delay="0.5s">
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form method="post" action="register.php">
                <div class="mb-3">
                    <label for="username" class="form-label"><?php echo htmlspecialchars($translations[$lang]['username_label']); ?></label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label"><?php echo htmlspecialchars($translations[$lang]['email_label']); ?></label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label"><?php echo htmlspecialchars($translations[$lang]['password_label']); ?></label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label"><?php echo htmlspecialchars($translations[$lang]['confirm_password_label']); ?></label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo htmlspecialchars($translations[$lang]['submit_button']); ?></button>
            </form>
            <p class="mt-3 text-center">
                <a href="login.php" class="login-link"><?php echo htmlspecialchars($translations[$lang]['login_link']); ?></a>
            </p>
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
        const translations = <?php echo json_encode($translations); ?>;
        const translateElements = () => {
            document.querySelectorAll('[data-lang-key]').forEach(element => {
                const key = element.getAttribute('data-lang-key');
                if (translations[lang] && translations[lang][key]) {
                    element.textContent = translations[lang][key];
                } else if (translations['zh'] && translations['zh'][key]) {
                    element.textContent = translations['zh'][key];
                }
            });
            
            document.title = translations[lang] ? translations[lang].site_title : '';
            const metaDesc = document.querySelector('meta[name="description"]');
            if (metaDesc && translations[lang] && translations[lang].meta_description) {
                metaDesc.setAttribute('content', translations[lang].meta_description);
            }
            
            document.documentElement.lang = lang === 'zh' ? 'zh-CN' : lang;
        };
        
        translateElements();
    });
    </script>
</body>
</html>