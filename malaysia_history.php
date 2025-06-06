<?php
// Enhance session security
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1); // Ensure HTTPS in production
ini_set('session.use_strict_mode', 1);

session_start();

// Set language based on user selection or default to English
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$current_lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';

// Set text direction based on language
$site_dir = ($current_lang === 'ar') ? 'rtl' : 'ltr'; // Arabic uses rtl, others use ltr
$text_direction = $site_dir;

// Translation array for English, Malay, and Mandarin
$translations = [
    'en' => [
        'meta_description' => 'Uncover the rich history of Malaysia with HAF, from ancient kingdoms to modern nationhood',
        'hero_title' => 'Malaysia Historical Saga',
        'hero_subtitle' => 'Discover Malaysia journey through time with HAF',
        'nav_history' => 'History',
        'nav_world_history' => 'World History',
        'nav_malaysia_history' => 'Malaysia History',
        'nav_history_game' => 'History Game',
        'nav_art' => 'Art',
        'nav_fashion' => 'Fashion',
        'nav_shop' => 'Shop',
        'timeline_title' => 'Malaysia History Timeline',
        'timeline_subtitle' => 'Explore key periods in Malaysia historical journey',
        'footer_copyright' => '© 2025 History, Art & Fashion. All rights reserved.'
    ],
    'ms' => [
        'meta_description' => 'Terokai sejarah Malaysia yang kaya dengan HAF, dari kerajaan purba hingga kebangsaan moden',
        'hero_title' => 'Saga Sejarah Malaysia',
        'hero_subtitle' => 'Temui perjalanan Malaysia melalui masa bersama HAF',
        'nav_history' => 'Sejarah',
        'nav_world_history' => 'Sejarah Dunia',
        'nav_malaysia_history' => 'Sejarah Malaysia',
        'nav_history_game' => 'Permainan Sejarah',
        'nav_art' => 'Seni',
        'nav_fashion' => 'Fesyen',
        'nav_shop' => 'Kedai',
        'timeline_title' => 'Garis Masa Sejarah Malaysia',
        'timeline_subtitle' => 'Terokai tempoh utama dalam perjalanan sejarah Malaysia',
        'footer_copyright' => '© 2025 Sejarah, Seni & Fesyen. Semua hak terpelihara.'
    ],
    'zh' => [
        'meta_description' => '通过HAF探索马来西亚的丰富历史，从古老王国到现代国家',
        'hero_title' => '马来西亚历史传奇',
        'hero_subtitle' => '与HAF一起发现马来西亚的时光之旅',
        'nav_history' => '历史',
        'nav_world_history' => '世界历史',
        'nav_malaysia_history' => '马来西亚历史',
        'nav_history_game' => '历史游戏',
        'nav_art' => '艺术',
        'nav_fashion' => '时尚',
        'nav_shop' => '商店',
        'timeline_title' => '马来西亚历史时间线',
        'timeline_subtitle' => '探索马来西亚历史旅程中的关键时期',
        'footer_copyright' => '© 2025 历史、艺术与时尚。版权所有。'
    ],
    'es' => [
        'meta_description' => 'Descubre la rica historia de Malasia con HAF, desde los reinos antiguos hasta la nación moderna',
        'hero_title' => 'Saga Histórica de Malasia',
        'hero_subtitle' => 'Descubre el viaje de Malasia a través del tiempo con HAF',
        'nav_history' => 'Historia',
        'nav_world_history' => 'Historia Mundial',
        'nav_malaysia_history' => 'Historia de Malasia',
        'nav_history_game' => 'Juego de Historia',
        'nav_art' => 'Arte',
        'nav_fashion' => 'Moda',
        'nav_shop' => 'Tienda',
        'timeline_title' => 'Línea de Tiempo de la Historia de Malasia',
        'timeline_subtitle' => 'Explora períodos clave en el viaje histórico de Malasia',
        'footer_copyright' => '© 2025 Historia, Arte y Moda. Todos los derechos reservados.'
    ],
    'ar' => [
        'meta_description' => 'اكتشف تاريخ ماليزيا الغني مع HAF، من الممالك القديمة إلى الدولة الحديثة',
        'hero_title' => 'ملحمة تاريخ ماليزيا',
        'hero_subtitle' => 'اكتشف رحلة ماليزيا عبر الزمن مع HAF',
        'nav_history' => 'التاريخ',
        'nav_world_history' => 'تاريخ العالم',
        'nav_malaysia_history' => 'تاريخ ماليزيا',
        'nav_history_game' => 'لعبة التاريخ',
        'nav_art' => 'الفن',
        'nav_fashion' => 'الأزياء',
        'nav_shop' => 'المتجر',
        'timeline_title' => 'الخط الزمني لتاريخ ماليزيا',
        'timeline_subtitle' => 'استكشف الفترات الرئيسية في رحلة ماليزيا التاريخية',
        'footer_copyright' => '© 2025 التاريخ والفن والأزياء. جميع الحقوق محفوظة.'
    ],
    'fr' => [
        'meta_description' => 'Découvrez la riche histoire de la Malaisie avec HAF, des royaumes anciens à la nation moderne',
        'hero_title' => 'Saga Historique de la Malaisie',
        'hero_subtitle' => 'Découvrez le voyage de la Malaisie à travers le temps avec HAF',
        'nav_history' => 'Histoire',
        'nav_world_history' => 'Histoire Mondiale',
        'nav_malaysia_history' => 'Histoire de la Malaisie',
        'nav_history_game' => 'Jeu d\'Histoire',
        'nav_art' => 'Art',
        'nav_fashion' => 'Mode',
        'nav_shop' => 'Boutique',
        'timeline_title' => 'Chronologie de l\'Histoire de la Malaisie',
        'timeline_subtitle' => 'Explorez les périodes clés du voyage historique de la Malaisie',
        'footer_copyright' => '© 2025 Histoire, Art et Mode. Tous droits réservés.'
    ],
    'ru' => [
        'meta_description' => 'Откройте для себя богатую историю Малайзии с HAF, от древних королевств до современного государства',
        'hero_title' => 'Историческая Сага Малайзии',
        'hero_subtitle' => 'Откройте для себя путешествие Малайзии во времени с HAF',
        'nav_history' => 'История',
        'nav_world_history' => 'Мировая История',
        'nav_malaysia_history' => 'История Малайзии',
        'nav_history_game' => 'Историческая Игра',
        'nav_art' => 'Искусство',
        'nav_fashion' => 'Мода',
        'nav_shop' => 'Магазин',
        'timeline_title' => 'Хронология Истории Малайзии',
        'timeline_subtitle' => 'Исследуйте ключевые периоды в историческом путешествии Малайзии',
        'footer_copyright' => '© 2025 История, Искусство и Мода. Все права защищены.'
    ],
    'pt' => [
        'meta_description' => 'Descubra a rica história da Malásia com HAF, dos reinos antigos à nação moderna',
        'hero_title' => 'Saga Histórica da Malásia',
        'hero_subtitle' => 'Descubra a jornada da Malásia através do tempo com HAF',
        'nav_history' => 'História',
        'nav_world_history' => 'História Mundial',
        'nav_malaysia_history' => 'História da Malásia',
        'nav_history_game' => 'Jogo de História',
        'nav_art' => 'Arte',
        'nav_fashion' => 'Moda',
        'nav_shop' => 'Loja',
        'timeline_title' => 'Linha do Tempo da História da Malásia',
        'timeline_subtitle' => 'Explore períodos-chave na jornada histórica da Malásia',
        'footer_copyright' => '© 2025 História, Arte e Moda. Todos os direitos reservados.'
    ],
    'de' => [
        'meta_description' => 'Entdecken Sie die reiche Geschichte Malaysias mit HAF, von antiken Königreichen bis zur modernen Nation',
        'hero_title' => 'Historische Saga Malaysias',
        'hero_subtitle' => 'Entdecken Sie Malaysias Reise durch die Zeit mit HAF',
        'nav_history' => 'Geschichte',
        'nav_world_history' => 'Weltgeschichte',
        'nav_malaysia_history' => 'Geschichte Malaysias',
        'nav_history_game' => 'Geschichtsspiel',
        'nav_art' => 'Kunst',
        'nav_fashion' => 'Mode',
        'nav_shop' => 'Shop',
        'timeline_title' => 'Zeitleiste der Geschichte Malaysias',
        'timeline_subtitle' => 'Erkunden Sie wichtige Perioden in Malaysias historischer Reise',
        'footer_copyright' => '© 2025 Geschichte, Kunst und Mode. Alle Rechte vorbehalten.'
    ],
    'ja' => [
        'meta_description' => 'HAFで古代王国から現代国家までのマレーシアの豊かな歴史を探る',
        'hero_title' => 'マレーシア歴史物語',
        'hero_subtitle' => 'HAFでマレーシアの時を超えた旅を発見',
        'nav_history' => '歴史',
        'nav_world_history' => '世界史',
        'nav_malaysia_history' => 'マレーシアの歴史',
        'nav_history_game' => '歴史ゲーム',
        'nav_art' => '芸術',
        'nav_fashion' => 'ファッション',
        'nav_shop' => 'ショップ',
        'timeline_title' => 'マレーシア歴史年表',
        'timeline_subtitle' => 'マレーシアの歴史的な旅の重要な時期を探る',
        'footer_copyright' => '© 2025 歴史・芸術・ファッション。全著作権所有。'
    ],
    'hi' => [
        'meta_description' => 'HAF के साथ मलेशिया के समृद्ध इतिहास की खोज करें, प्राचीन राज्यों से लेकर आधुनिक राष्ट्र तक',
        'hero_title' => 'मलेशिया की ऐतिहासिक गाथा',
        'hero_subtitle' => 'HAF के साथ समय के माध्यम से मलेशिया की यात्रा की खोज करें',
        'nav_history' => 'इतिहास',
        'nav_world_history' => 'विश्व इतिहास',
        'nav_malaysia_history' => 'मलेशिया का इतिहास',
        'nav_history_game' => 'इतिहास खेल',
        'nav_art' => 'कला',
        'nav_fashion' => 'फैशन',
        'nav_shop' => 'दुकान',
        'timeline_title' => 'मलेशिया के इतिहास की समयरेखा',
        'timeline_subtitle' => 'मलेशिया की ऐतिहासिक यात्रा में प्रमुख अवधियों की खोज करें',
        'footer_copyright' => '© 2025 इतिहास, कला और फैशन। सर्वाधिकार सुरक्षित।'
    ]
];

// Placeholder image
$placeholder_image = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8DwHwAEhQGAaR9lOQAAAABJRU5ErkJggg==';

// Helper function to get translations
function get_translation($lang, $key) {
    global $translations;
    return isset($translations[$lang][$key]) ? htmlspecialchars($translations[$lang][$key]) : "Missing translation for $key";
}

// Get current page for active nav link
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="<?php echo $current_lang; ?>" dir="<?php echo $site_dir; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo get_translation($current_lang, 'meta_description'); ?>">
    <meta property="og:title" content="HAF - <?php echo get_translation($current_lang, 'nav_malaysia_history'); ?>">
    <meta property="og:description" content="<?php echo get_translation($current_lang, 'meta_description'); ?>">
    <meta property="og:image" content="<?php echo $placeholder_image; ?>">
    <title>HAF - <?php echo get_translation($current_lang, 'nav_malaysia_history'); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&family=Playfair+Display:wght@400;700&family=Raleway:wght@300;400;500&family=Noto+Sans+SC:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--charcoal);
            background: var(--custom-light);
            line-height: 1.6;
            min-height: 100vh;
        }

        html[lang="zh"] body {
            font-family: 'Noto Sans SC', 'Poppins', sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        nav.navbar {
            background: var(--papaya-whip);
            border-bottom: 2px solid var(--old-lace);
            box-shadow: var(--shadow-normal);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--charcoal);
        }

        .navbar-nav .nav-link {
            font-family: 'Raleway', sans-serif;
            font-size: 1.1rem;
            color: var(--charcoal);
            margin: 0 15px;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link:hover, .navbar-nav .nav-link.active {
            color: var(--old-lace);
        }

        .dropdown-menu {
            background: var(--papaya-whip);
            border: 1px solid var(--old-lace);
        }

        .dropdown-item {
            font-family: 'Raleway', sans-serif;
            color: var(--charcoal);
            padding: 8px 20px;
            transition: background 0.3s;
        }

        .dropdown-item:hover {
            background: var(--old-lace);
        }

        .hero {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: var(--gradient), url('images/hero_background.jpg') center/cover no-repeat fixed;
            border-bottom: 5px solid var(--old-lace);
            padding: 120px 20px;
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 700;
            color: var(--charcoal);
            margin-bottom: 20px;
            animation: fadeIn 1s ease-in-out;
        }

        .hero p {
            font-family: 'Raleway', sans-serif;
            font-size: 1.6rem;
            font-weight: 300;
            color: var(--charcoal);
            max-width: 600px;
            margin: 0 auto;
            animation: fadeIn 1s ease-in-out 0.5s;
            animation-fill-mode: both;
        }

        section {
            padding: 80px 0;
            background: var(--linen);
        }

        section h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            color: var(--charcoal);
            text-align: center;
            margin-bottom: 20px;
        }

        section p.lead {
            font-family: 'Raleway', sans-serif;
            font-size: 1.3rem;
            font-weight: 300;
            color: #666;
            text-align: center;
            margin-bottom: 40px;
        }

        .timeline {
            position: relative;
            max-width: 900px;
            margin: 0 auto;
        }

        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 4px;
            background: var(--old-lace);
            transform: translateX(-50%);
        }

        .timeline-item {
            position: relative;
            margin: 50px 0;
            width: 48%;
            padding: 25px;
            background: var(--snow);
            border: 5px solid var(--old-lace);
            border-radius: 16px;
            box-shadow: var(--shadow-normal);
            transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
            cursor: pointer;
        }

        html[dir="rtl"] .timeline-item {
            text-align: right;
        }

        .timeline-item:hover {
            transform: scale(1.03) rotate(-1deg);
            border-color: var(--papaya-whip);
            box-shadow: var(--shadow-hover);
        }

        .timeline-left {
            left: 0;
            text-align: right;
            border-right: none;
        }

        .timeline-right {
            left: 52%;
            border-left: none;
        }

        html[dir="rtl"] .timeline-left {
            text-align: left;
            border-left: none;
            border-right: 5px solid var(--old-lace);
        }

        html[dir="rtl"] .timeline-right {
            border-right: none;
            border-left: 5px solid var(--old-lace);
        }

        .timeline-item img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border: 2px solid var(--old-lace);
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .timeline-item h5 {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            color: var(--charcoal);
            margin-bottom: 10px;
        }

        .timeline-item p {
            font-family: 'Raleway', sans-serif;
            font-size: 1.05rem;
            color: #444;
            background: var(--old-lace-opaque);
            padding: 10px;
            border-radius: 5px;
        }

        .timeline-item .details {
            display: none;
            margin-top: 10px;
            padding: 10px;
            background: var(--seashell);
            border-radius: 5px;
        }

        .timeline-item.active .details {
            display: block;
            animation: fadeIn 0.5s ease-in-out;
        }

        footer {
            background: var(--papaya-whip);
            border-top: 2px solid var(--old-lace);
            padding: 30px 0;
            text-align: center;
        }

        footer p {
            font-family: 'Raleway', sans-serif;
            font-size: 1rem;
            color: var(--charcoal);
            margin-bottom: 10px;
        }

        footer .social-icons a {
            color: var(--charcoal);
            font-size: 1.2rem;
            margin: 0 10px;
            transition: color 0.3s;
        }

        footer .social-icons a:hover {
            color: var(--old-lace);
        }

        .btn {
            display: inline-block;
            padding: 12px 32px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 6px;
            text-decoration: none;
            transition: background 0.3s, color 0.3s, box-shadow 0.3s;
            box-shadow: 0 2px 8px var(--shadow);
            margin-top: 24px;
        }
        .btn-primary {
            background: var(--primary);
            color: var(--secondary);
            border: none;
        }
        .btn-primary:hover, .btn-primary:focus {
            background: var(--secondary);
            color: var(--primary);
            box-shadow: 0 4px 16px var(--shadow);
        }
        .mt-4 {
            margin-top: 1.5rem;
        }

        @media (max-width: 900px) {
            .timeline-item {
                width: 90%;
            }
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.3rem;
            }

            .timeline::before {
                left: 25px;
            }

            .timeline-item {
                width: 100%;
                left: 0 !important;
                text-align: left !important;
                padding: 20px 40px;
            }

            .timeline-item:nth-child(odd), .timeline-item:nth-child(even) {
                border: 5px solid var(--old-lace);
            }

            .navbar-nav .nav-link {
                margin: 10px 0;
                text-align: center;
            }
        }

        @media (max-width: 600px) {
            .timeline-item {
                border-left: 5px solid var(--old-lace);
                border-right: none;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg" role="navigation" aria-label="Main navigation">
        <div class="container">
            <a class="navbar-brand" href="index.php" aria-current="<?php echo $current_page === 'index.php' ? 'page' : ''; ?>">HAF</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'history.php' ? 'active' : ''; ?>" href="history.php"><?php echo get_translation($current_lang, 'nav_history'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'world_history.php' ? 'active' : ''; ?>" href="world_history.php"><?php echo get_translation($current_lang, 'nav_world_history'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'malaysia_history.php' ? 'active' : ''; ?>" href="malaysia_history.php"><?php echo get_translation($current_lang, 'nav_malaysia_history'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'history_game.php' ? 'active' : ''; ?>" href="history_game.php"><?php echo get_translation($current_lang, 'nav_history_game'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'art.php' ? 'active' : ''; ?>" href="art.php"><?php echo get_translation($current_lang, 'nav_art'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'fashion.php' ? 'active' : ''; ?>" href="fashion.php"><?php echo get_translation($current_lang, 'nav_fashion'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'shop.php' ? 'active' : ''; ?>" href="php/shop.php"><?php echo get_translation($current_lang, 'nav_shop'); ?></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-globe"></i> <?php echo strtoupper($current_lang); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                            <li><a class="dropdown-item" href="?lang=en">English</a></li>
                            <li><a class="dropdown-item" href="?lang=ms">Bahasa Melayu</a></li>
                            <li><a class="dropdown-item" href="?lang=zh">中文 (简体)</a></li>
                            <li><a class="dropdown-item" href="?lang=es">Español</a></li>
                            <li><a class="dropdown-item" href="?lang=ar">العربية</a></li>
                            <li><a class="dropdown-item" href="?lang=fr">Français</a></li>
                            <li><a class="dropdown-item" href="?lang=ru">Русский</a></li>
                            <li><a class="dropdown-item" href="?lang=pt">Português</a></li>
                            <li><a class="dropdown-item" href="?lang=de">Deutsch</a></li>
                            <li><a class="dropdown-item" href="?lang=ja">日本語</a></li>
                            <li><a class="dropdown-item" href="?lang=hi">हिन्दी</a></li>
                        </ul>
                    </li>
            </ul>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <h1 class="animate__animated animate__fadeIn"><?php echo get_translation($current_lang, 'hero_title'); ?></h1>
            <p class="animate__animated animate__fadeIn"><?php echo get_translation($current_lang, 'hero_subtitle'); ?></p>
            <a href="#timeline" class="btn btn-primary mt-4 animate__animated animate__fadeIn" data-animate-delay="1s"><?php echo get_translation($current_lang, 'nav_world_history'); ?></a>
        </div>
    </section>

    <section id="timeline" role="region" aria-label="Historical timeline">
        <div class="container">
            <h2><?php echo get_translation($current_lang, 'timeline_title'); ?></h2>
            <p class="lead"><?php echo get_translation($current_lang, 'timeline_subtitle'); ?></p>
            <div class="timeline">
                <?php
                $periods = [
                    [
                        'title' => [
                            'en' => 'Ancient Malacca Sultanate (1400-1511)',
                            'ms' => 'Kesultanan Melaka Purba (1400-1511)',
                            'zh' => '古马六甲苏丹王朝（1400-1511）',
                            'es' => 'Sultanato Antiguo de Malaca (1400-1511)',
                            'ar' => 'سلطنة ملقا القديمة (1400-1511)',
                            'fr' => 'Ancien Sultanat de Malacca (1400-1511)'
                        ],
                        'text' => [
                            'en' => 'The golden age of Malacca.',
                            'ms' => 'Zaman keemasan Melaka.',
                            'zh' => '马六甲的黄金时代。',
                            'es' => 'La edad de oro de Malaca.',
                            'ar' => 'العصر الذهبي لملقا.',
                            'fr' => 'L\'âge d\'or de Malacca.'
                        ],
                        'details' => [
                            'en' => 'The Malacca Sultanate was founded by Parameswara and became a major trading port. Its strategic location along the Strait of Malacca made it a crucial point for East-West maritime trade.',
                            'ms' => 'Kesultanan Melaka diasaskan oleh Parameswara dan menjadi pelabuhan perdagangan utama. Lokasinya yang strategik di sepanjang Selat Malaka menjadikannya titik penting untuk perdagangan maritim Timur-Barat.',
                            'zh' => '马六甲苏丹王朝由巴里米苏拉建立，成为重要的贸易港口。其在马六甲海峡的战略位置使其成为东西方海上贸易的重要枢纽。',
                            'es' => 'El Sultanato de Malaca fue fundado por Parameswara y se convirtió en un importante puerto comercial. Su ubicación estratégica a lo largo del Estrecho de Malaca lo convirtió en un punto crucial para el comercio marítimo Este-Oeste.',
                            'ar' => 'تأسست سلطنة ملقا على يد باراميسوارا وأصبحت ميناءً تجارياً رئيسياً. موقعها الاستراتيجي على طول مضيق ملقا جعلها نقطة محورية للتجارة البحرية بين الشرق والغرب.',
                            'fr' => 'Le Sultanat de Malacca a été fondé par Parameswara et est devenu un port commercial majeur. Sa position stratégique le long du détroit de Malacca en a fait un point crucial pour le commerce maritime Est-Ouest.'
                        ],
                        'image' => 'images/malaysiahistory/1.png'
                    ],
                    [
                        'title' => [
                            'en' => 'Portuguese Colonial Era (1511-1641)',
                            'ms' => 'Era Penjajahan Portugis (1511-1641)',
                            'zh' => '葡萄牙殖民时期（1511-1641）',
                            'es' => 'Era Colonial Portuguesa (1511-1641)',
                            'ar' => 'العصر الاستعماري البرتغالي (1511-1641)',
                            'fr' => 'Ère Coloniale Portugaise (1511-1641)'
                        ],
                        'text' => [
                            'en' => 'Portuguese conquest and rule.',
                            'ms' => 'Penaklukan dan pemerintahan Portugis.',
                            'zh' => '葡萄牙征服和统治。',
                            'es' => 'Conquista y gobierno portugués.',
                            'ar' => 'الغزو والحكم البرتغالي.',
                            'fr' => 'Conquête et règne portugais.'
                        ],
                        'details' => [
                            'en' => 'The Portuguese captured Malacca in 1511, marking the beginning of European colonization in Malaysia. They built the A Famosa fortress and established Catholic missions.',
                            'ms' => 'Portugis menawan Melaka pada tahun 1511, menandakan permulaan penjajahan Eropah di Malaysia. Mereka membina kubu A Famosa dan menubuhkan misi Katolik.',
                            'zh' => '1511年葡萄牙占领马六甲，标志着欧洲在马来西亚殖民统治的开始。他们修建了葡萄牙城堡（A Famosa）并建立天主教传教站。',
                            'es' => 'Los portugueses capturaron Malaca en 1511, marcando el comienzo de la colonización europea en Malasia. Construyeron la fortaleza A Famosa y establecieron misiones católicas.',
                            'ar' => 'استولى البرتغاليون على ملقا في عام 1511، مما يمثل بداية الاستعمار الأوروبي في ماليزيا. قاموا ببناء حصن A Famosa وأسسوا البعثات الكاثوليكية.',
                            'fr' => 'Les Portugais ont capturé Malacca en 1511, marquant le début de la colonisation européenne en Malaisie. Ils ont construit la forteresse A Famosa et établi des missions catholiques.'
                        ],
                        'image' => 'images/malaysiahistory/2.png'
                    ],
                    [
                        'title' => [
                            'en' => 'Dutch Period (1641-1824)',
                            'ms' => 'Zaman Belanda (1641-1824)',
                            'zh' => '荷兰统治时期（1641-1824）',
                            'es' => 'Período Holandés (1641-1824)',
                            'ar' => 'الفترة الهولندية (1641-1824)',
                            'fr' => 'Période Néerlandaise (1641-1824)'
                        ],
                        'text' => [
                            'en' => 'Dutch East India Company control.',
                            'ms' => 'Kawalan Syarikat Hindia Timur Belanda.',
                            'zh' => '荷兰东印度公司控制。',
                            'es' => 'Control de la Compañía Holandesa de las Indias Orientales.',
                            'ar' => 'سيطرة شركة الهند الشرقية الهولندية.',
                            'fr' => 'Contrôle de la Compagnie des Indes orientales néerlandaises.'
                        ],
                        'details' => [
                            'en' => 'The Dutch defeated the Portuguese and controlled Malacca. They focused on maintaining trade monopolies and established administrative systems that influenced local governance.',
                            'ms' => 'Belanda mengalahkan Portugis dan mengawal Melaka. Mereka memberi tumpuan kepada mengekalkan monopoli perdagangan dan menubuhkan sistem pentadbiran yang mempengaruhi pemerintahan tempatan.',
                            'zh' => '荷兰击败葡萄牙并控制马六甲。他们专注于维持贸易垄断，并建立了影响当地治理的行政系统。',
                            'es' => 'Los holandeses derrotaron a los portugueses y controlaron Malaca. Se centraron en mantener monopolios comerciales y establecieron sistemas administrativos que influyeron en la gobernanza local.',
                            'ar' => 'هزم الهولنديون البرتغاليين وسيطروا على ملقا. ركزوا على الحفاظ على الاحتكارات التجارية وأسسوا أنظمة إدارية أثرت على الحكم المحلي.',
                            'fr' => 'Les Néerlandais ont vaincu les Portugais et contrôlé Malacca. Ils se sont concentrés sur le maintien des monopoles commerciaux et ont établi des systèmes administratifs qui ont influencé la gouvernance locale.'
                        ],
                        'image' => 'images/malaysiahistory/3.png'
                    ],
                    [
                        'title' => [
                            'en' => 'British Colonial Era (1824-1957)',
                            'ms' => 'Era Penjajahan British (1824-1957)',
                            'zh' => '英国殖民时期（1824-1957）'
                        ],
                        'text' => [
                            'en' => 'British expansion and influence.',
                            'ms' => 'Pengembangan dan pengaruh British.',
                            'zh' => '英国扩张和影响。'
                        ],
                        'details' => [
                            'en' => 'The British established the Straits Settlements and gradually extended their influence through treaties with local rulers. They introduced modern administration, education, and infrastructure.',
                            'ms' => 'British menubuhkan Negeri-negeri Selat dan secara beransur-ansur memperluaskan pengaruh mereka melalui perjanjian dengan pemerintah tempatan. Mereka memperkenalkan pentadbiran moden, pendidikan, dan infrastruktur.',
                            'zh' => '英国建立海峡殖民地，并通过与当地统治者的条约逐步扩大其影响力。他们引入了现代行政、教育和基础设施。'
                        ],
                        'image' => 'images/malaysiahistory/4.png'
                    ],
                    [
                        'title' => [
                            'en' => '1402: Malacca Sultanate Established',
                            'ms' => '1402: Kesultanan Melaka Ditubuhkan',
                            'zh' => '1402年：马六甲苏丹国建立'
                        ],
                        'text' => [
                            'en' => 'Malacca Sultanate was founded.',
                            'ms' => 'Kesultanan Melaka ditubuhkan.',
                            'zh' => '马六甲苏丹国成立。'
                        ],
                        'details' => [
                            'en' => 'Founded by Parameswara, the Malacca Sultanate quickly rose as a major trading port, attracting merchants from China, India, and the Middle East. Its strategic position and adoption of Islam made it a cultural and economic powerhouse.',
                            'ms' => 'Ditubuhkan oleh Parameswara, Kesultanan Melaka cepat berkembang sebagai pelabuhan perdagangan utama, menarik pedagang dari China, India, dan Timur Tengah. Kedudukan strategik dan penerimaan Islam menjadikannya kuasa budaya dan ekonomi.',
                            'zh' => '由巴拉米苏拉创立，马六甲苏丹国迅速崛起为主要贸易港口，吸引了来自中国、印度和中东的商人。其战略位置和对伊斯兰教的采纳使其成为文化和经济强国。'
                        ],
                        'image' => 'images/malaysiahistory/5.png'
                    ],
                    [
                        'title' => [
                            'en' => 'Mid-15th Century: Peak of Malacca Sultanate',
                            'ms' => 'Pertengahan Abad 15: Kemuncak Kesultanan Melaka',
                            'zh' => '15世纪中期：马六甲苏丹国巅峰'
                        ],
                        'text' => [
                            'en' => 'Malacca reached its cultural and economic peak.',
                            'ms' => 'Melaka mencapai kemuncak budaya dan ekonomi.',
                            'zh' => '马六甲达到文化和经济巅峰。'
                        ],
                        'details' => [
                            'en' => 'Under Sultan Mansur Shah, Malacca became a center of Islamic learning and trade, with a diverse population of traders from across Asia. The sultanate legal code, the Undang-Undang Melaka, influenced governance in the region.',
                            'ms' => 'Di bawah Sultan Mansur Shah, Melaka menjadi pusat pembelajaran Islam dan perdagangan, dengan populasi pedagang yang pelbagai dari seluruh Asia. Kod undang-undang kesultanan, Undang-Undang Melaka, mempengaruhi pentadbiran di rantau ini.',
                            'zh' => '在苏丹曼苏尔沙统治下，马六甲成为伊斯兰学习和贸易中心，拥有来自亚洲各地的多元化商人群体。苏丹国的法律代码《马六甲法典》影响了该地区的治理。'
                        ],
                        'image' => 'images/malaysiahistory/6.png'
                    ],
                    [
                        'title' => [
                            'en' => '1511: Portuguese Conquest of Malacca',
                            'ms' => '1511: Penaklukan Portugis ke atas Melaka',
                            'zh' => '1511年：葡萄牙征服马六甲',
                            'es' => '1511: Conquista Portuguesa de Malaca'
                        ],
                        'text' => [
                            'en' => 'Portuguese conquered Malacca.',
                            'ms' => 'Portugis menakluk Melaka.',
                            'zh' => '葡萄牙征服马六甲。',
                            'es' => 'Los portugueses conquistaron Malaca.'
                        ],
                        'details' => [
                            'en' => 'Led by Afonso de Albuquerque, the Portuguese captured Malacca to control the spice trade, marking the start of European colonization in Malaysia. Their rule introduced Christianity and European architecture, such as the A Famosa fort.',
                            'ms' => 'Dipimpin oleh Afonso de Albuquerque, Portugis menawan Melaka untuk mengawal perdagangan rempah, menandakan permulaan penjajahan Eropah di Malaysia. Pemerintahan mereka memperkenalkan agama Kristian dan seni bina Eropah, seperti kubu A Famosa.',
                            'zh' => '在阿方索·德·阿尔布克尔克的领导下，葡萄牙人占领马六甲以控制香料贸易，标志着欧洲在马来西亚殖民的开始。他们的统治引入了基督教和欧洲建筑，如著名的A Famosa堡垒。',
                            'es' => 'Dirigidos por Afonso de Albuquerque, los portugueses capturaron Malaca para controlar el comercio de especias, marcando el inicio de la colonización europea en Malasia. Su gobierno introdujo el cristianismo y la arquitectura europea, como el fuerte A Famosa.'
                        ],
                        'image' => 'images/malaysiahistory/7.png'
                    ],
                    [
                        'title' => [
                            'en' => '1641: Dutch Takeover of Malacca',
                            'ms' => '1641: Pengambilalihan Belanda ke atas Melaka',
                            'zh' => '1641年：荷兰接管马六甲'
                        ],
                        'text' => [
                            'en' => 'Dutch took control from the Portuguese.',
                            'ms' => 'Belanda mengambil alih dari Portugis.',
                            'zh' => '荷兰从葡萄牙手中接管。'
                        ],
                        'details' => [
                            'en' => 'The Dutch, allied with Johor, overthrew the Portuguese to dominate trade in the region, focusing on commerce rather than cultural influence. Their legacy includes structures like the Stadthuys, reflecting Dutch colonial architecture.',
                            'ms' => 'Belanda, bersekutu dengan Johor, menumbangkan Portugis untuk menguasai perdagangan di rantau ini, dengan tumpuan kepada perdagangan berbanding pengaruh budaya. Warisan mereka termasuk struktur seperti Stadthuys, yang mencerminkan seni bina kolonial Belanda.',
                            'zh' => '荷兰人与柔佛结盟，推翻葡萄牙人以主导该地区的贸易，注重商业而非文化影响。他们的遗产包括Stadthuys等建筑，反映了荷兰殖民建筑风格。'
                        ],
                        'image' => 'images/malaysiahistory/8.png'
                    ],
                    [
                    'title' => [
                        'en' => 'Late 18th Century: British Occupation of Penang',
                        'ms' => 'Akhir Abad 18: Pendudukan British di Pulau Pinang',
                        'zh' => '18世纪末：英国占领槟城',
                        'es' => 'Finales del Siglo XVIII: Ocupación Británica de Penang',
                        'ar' => 'أواخر القرن الثامن عشر: الاحتلال البريطاني لبينانج',
                        'fr' => 'Fin du XVIIIe Siècle: Occupation Britannique de Penang'
                    ],
                    'text' => [
                        'en' => 'British occupied Penang.',
                        'ms' => 'British menduduki Pulau Pinang.',
                        'zh' => '英国占领槟城。',
                        'es' => 'Los británicos ocuparon Penang.',
                        'ar' => 'احتل البريطانيون بينانج.',
                        'fr' => 'Les Britanniques ont occupé Penang.'
                    ],
                    'details' => [
                        'en' => 'In 1786, Francis Light established Penang as a British trading post, marking the beginning of British influence in Malaysia. Penang free port status attracted diverse communities, shaping its multicultural identity.',
                        'ms' => 'Pada 1786, Francis Light menubuhkan Pulau Pinang sebagai pos perdagangan British, menandakan permulaan pengaruh British di Malaysia. Status pelabuhan bebas Pulau Pinang menarik pelbagai komuniti, membentuk identiti multikulturalnya.',
                        'zh' => '1786年，弗朗西斯·莱特将槟城建立为英国贸易据点，标志着英国在马来西亚影响的开始。槟城的自由港地位吸引了多元社区，塑造了其多元文化身份。',
                        'es' => 'En 1786, Francis Light estableció Penang como un puesto comercial británico, marcando el inicio de la influencia británica en Malasia. El estatus de puerto libre de Penang atrajo a diversas comunidades, moldeando su identidad multicultural.',
                        'ar' => 'في عام 1786، أسس فرانسيس لايت بينانج كمركز تجاري بريطاني، مما يمثل بداية النفوذ البريطاني في ماليزيا. جذب وضع ميناء بينانج الحر مجتمعات متنوعة، مما شكل هويتها متعددة الثقافات.',
                        'fr' => 'En 1786, Francis Light établit Penang comme comptoir commercial britannique, marquant le début de l\'influence britannique en Malaisie. Le statut de port franc de Penang attira diverses communautés, façonnant son identité multiculturelle.'
                    ],
                    'image' => 'images/malaysiahistory/9.png'
                    ],
                    [
                        'title' => [
                            'en' => '1824: Anglo-Dutch Treaty',
                            'ms' => '1824: Perjanjian Anglo-Belanda',
                            'zh' => '1824年：英荷条约'
                        ],
                        'text' => [
                            'en' => 'Anglo-Dutch Treaty was signed.',
                            'ms' => 'Perjanjian Anglo-Belanda ditandatangani.',
                            'zh' => '英荷条约签署。'
                        ],
                        'details' => [
                            'en' => 'The treaty resolved colonial disputes, ceding Malacca to the British and Bencoolen to the Dutch, solidifying British control over the Malay Peninsula. This agreement paved the way for the formation of the Straits Settlements.',
                            'ms' => 'Perjanjian ini menyelesaikan pertikaian kolonial, menyerahkan Melaka kepada British dan Bencoolen kepada Belanda, mengukuhkan kawalan British ke atas Semenanjung Tanah Melayu. Perjanjian ini membuka jalan kepada pembentukan Penempatan Selat.',
                            'zh' => '该条约解决了殖民争端，将马六甲割让给英国，将明古连割让给荷兰，巩固了英国对马来半岛的控制。这一协议为海峡殖民地的形成铺平了道路。'
                        ],
                        'image' => 'images/malaysiahistory/10.png'
                    ],
                    [
                        'title' => [
                            'en' => '1941: Japanese Invasion',
                            'ms' => '1941: Pencerobohan Jepun',
                            'zh' => '1941年：日本入侵'
                        ],
                        'text' => [
                            'en' => 'Japan invaded Malaysia.',
                            'ms' => 'Jepun menyerang Malaysia.',
                            'zh' => '日本入侵马来西亚。'
                        ],
                        'details' => [
                            'en' => 'Japanese forces landed in Kelantan on December 8, 1941, quickly overpowering British defenses as part of their Southeast Asian campaign. The invasion disrupted colonial rule and introduced harsh wartime policies.',
                            'ms' => 'Pasukan Jepun mendarat di Kelantan pada 8 Disember 1941, dengan cepat mengatasi pertahanan British sebagai sebahagian daripada kempen Asia Tenggara mereka. Pencerobohan ini mengganggu pemerintahan kolonial dan memperkenalkan dasar perang yang keras.',
                            'zh' => '日本军队于1941年12月8日在吉兰丹登陆，迅速压倒英国防御，作为其东南亚战役的一部分。入侵打断了殖民统治，并引入了苛刻的战时政策。'
                        ],
                        'image' => 'images/malaysiahistory/11.png'
                    ],
                    [
                        'title' => [
                            'en' => '1942-1945: Japanese Occupation and Resistance',
                            'ms' => '1942-1945: Pendudukan Jepun dan Perlawanan',
                            'zh' => '1942-1945年：日本占领与抵抗'
                        ],
                        'text' => [
                            'en' => 'Japan occupied Malaysia with local resistance.',
                            'ms' => 'Jepun menduduki Malaysia dengan perlawanan tempatan.',
                            'zh' => '日本占领马来西亚并遭遇当地抵抗。'
                        ],
                        'details' => [
                            'en' => 'The Japanese occupation brought economic hardship and forced labor, but also spurred resistance movements like the Malayan People Anti-Japanese Army (MPAJA). This period fostered a sense of nationalism among locals.',
                            'ms' => 'Pendudukan Jepun membawa kesusahan ekonomi dan kerja paksa, tetapi juga memicu pergerakan perlawanan seperti Tentera Anti-Jepun Rakyat Malaya (MPAJA). Tempoh ini memupuk rasa nasionalisme dalam kalangan penduduk tempatan.',
                            'zh' => '日本占领带来了经济困难和强迫劳动，但也引发了马来亚人民抗日军（MPAJA）等抵抗运动。这一时期培养了当地人的民族主义意识。'
                        ],
                        'image' => 'images/malaysiahistory/12.png'
                    ],
                    [
                        'title' => [
                            'en' => '1945: British Return after Japanese Surrender',
                            'ms' => '1945: British Kembali selepas Jepun Menyerah Kalah',
                            'zh' => '1945年：日本投降后英国返回'
                        ],
                        'text' => [
                            'en' => 'British returned after Japan surrender.',
                            'ms' => 'British kembali selepas Jepun menyerah kalah.',
                            'zh' => '日本投降后英国返回。'
                        ],
                        'details' => [
                            'en' => 'Following Japan surrender in September 1945, the British re-established control through the British Military Administration. However, their return faced challenges due to growing anti-colonial sentiment.',
                            'ms' => 'Selepas Jepun menyerah kalah pada September 1945, British menubuhkan semula kawalan melalui Pentadbiran Tentera British. Walau bagaimanapun, kepulangan mereka menghadapi cabaran kerana meningkatnya sentimen anti-kolonial.',
                            'zh' => '1945年9月日本投降后，英国通过英国军事管理重新建立控制。然而，由于日益增长的反殖民情绪，他们的返回面临挑战。'
                        ],
                        'image' => 'images/malaysiahistory/13.png'
                    ],
                    [
                        'title' => [
                            'en' => '1948: Malayan Communist Insurgency',
                            'ms' => '1948: Pemberontakan Komunis Malaya',
                            'zh' => '1948年：马来亚共产主义叛乱'
                        ],
                        'text' => [
                            'en' => 'Communist insurgency began.',
                            'ms' => 'Pemberontakan komunis bermula.',
                            'zh' => '共产主义叛乱开始。'
                        ],
                        'details' => [
                            'en' => 'The Malayan Communist Party launched an armed struggle against British rule, leading to the Malayan Emergency (1948-1960). The conflict forced the British to implement social reforms to win local support.',
                            'ms' => 'Parti Komunis Malaya melancarkan perjuangan bersenjata menentang pemerintahan British, yang membawa kepada Darurat Malaya (1948-1960). Konflik ini memaksa British melaksanakan pembaharuan sosial untuk mendapat sokongan tempatan.',
                            'zh' => '马来亚共产党发动了对英国统治的武装斗争，导致了马来亚紧急状态（1948-1960年）。这场冲突迫使英国实施社会改革以赢得当地支持。'
                        ],
                        'image' => 'images/malaysiahistory/14.png'
                    ],
                    [
                        'title' => [
                            'en' => '16 Sep 1963: Formation of Malaysia',
                            'ms' => '16 Sep 1963: Pembentukan Malaysia',
                            'zh' => '1963年9月16日：马来西亚成立'
                        ],
                        'text' => [
                            'en' => 'Malaysia was officially formed.',
                            'ms' => 'Malaysia secara rasmi ditubuhkan.',
                            'zh' => '马来西亚正式成立。'
                        ],
                        'details' => [
                            'en' => 'The Federation of Malaysia was established, uniting Malaya, Sabah, Sarawak, and initially Singapore, under Tunku Abdul Rahman\'s leadership. This union aimed to create a stronger, unified Southeast Asian nation.',
                            'ms' => 'Persekutuan Malaysia ditubuhkan, menyatukan Tanah Melayu, Sabah, Sarawak, dan pada mulanya Singapura, di bawah kepimpinan Tunku Abdul Rahman. Kesatuan ini bertujuan untuk mewujudkan sebuah negara Asia Tenggara yang lebih kukuh dan bersatu.',
                            'zh' => '马来西亚联邦成立，在敦·阿都·拉曼的领导下，联合了马来亚、沙巴、砂拉越及最初的新加坡。这一联合旨在创建一个更强大、统一的东南亚国家。'
                        ],
                        'image' => 'images/malaysiahistory/15.png'
                    ],
                    [
                        'title' => [
                            'en' => '9 Aug 1965: Separation of Singapore',
                            'ms' => '9 Ogos 1965: Pemisahan Singapura',
                            'zh' => '1965年8月9日：新加坡分离'
                        ],
                        'text' => [
                            'en' => 'Singapore separated from Malaysia.',
                            'ms' => 'Singapura berpisah dari Malaysia.',
                            'zh' => '新加坡从马来西亚分离。'
                        ],
                        'details' => [
                            'en' => 'Due to political and economic differences, Singapore was expelled from Malaysia, becoming an independent nation under Lee Kuan Yew. The separation allowed both nations to pursue distinct paths of development.',
                            'ms' => 'Disebabkan perbezaan politik dan ekonomi, Singapura diusir dari Malaysia, menjadi negara merdeka di bawah Lee Kuan Yew. Pemisahan ini membolehkan kedua-dua negara mengejar laluan pembangunan yang berbeza.',
                            'zh' => '由于政治和经济差异，新加坡被驱逐出马来西亚，在李光耀领导下成为独立国家。分离使两国能够追求各自的发展道路。'
                        ],
                        'image' => 'images/malaysiahistory/166.png'
                    ],
                    [
                        'title' => [
                            'en' => '31 Aug 1957: Independence of Malaya',
                            'ms' => '31 Ogos 1957: Kemerdekaan Tanah Melayu',
                            'zh' => '1957年8月31日：马来亚独立'
                        ],
                        'text' => [
                            'en' => 'Malaya gained independence.',
                            'ms' => 'Tanah Melayu mencapai kemerdekaan.',
                            'zh' => '马来亚获得独立。'
                        ],
                        'details' => [
                            'en' => 'Malaya achieved independence from Britain, with Tunku Abdul Rahman as its first Prime Minister, marking a historic moment at Merdeka Stadium. The event symbolized the end of colonial rule and the start of self-governance.',
                            'ms' => 'Tanah Melayu mencapai kemerdekaan dari Britain, dengan Tunku Abdul Rahman sebagai Perdana Menteri pertama, menandakan detik bersejarah di Stadium Merdeka. Peristiwa ini melambangkan berakhirnya pemerintahan kolonial dan permulaan pemerintahan sendiri.',
                            'zh' => '马来亚从英国获得独立，敦·阿都·拉曼成为首任总理，在默迪卡体育场标志着历史性时刻。这一事件象征着殖民统治的结束和自治的开始。'
                        ],
                        'image' => 'images/malaysiahistory/177.png'
                    ],
                    [
                        'title' => [
                            'en' => 'Mid-19th Century: Rubber Plantations',
                            'ms' => 'Pertengahan Abad 19: Ladang Getah',
                            'zh' => '19世纪中期：橡胶种植园'
                        ],
                        'text' => [
                            'en' => 'Rubber plantations expanded.',
                            'ms' => 'Ladang getah berkembang.',
                            'zh' => '橡胶种植园扩展。'
                        ],
                        'details' => [
                            'en' => 'The introduction of rubber plantations by the British transformed Malaysia\'s economy, making it a leading global supplier. This industry attracted immigrant labor, particularly from India and China, shaping Malaysia\'s demographic diversity.',
                            'ms' => 'Pengenalan ladang getah oleh British mengubah ekonomi Malaysia, menjadikannya pembekal utama global. Industri ini menarik tenaga kerja pendatang, terutamanya dari India dan China, membentuk kepelbagaian demografi Malaysia.',
                            'zh' => '英国引入橡胶种植园，改变了马来西亚的经济，使其成为全球主要供应商。这一行业吸引了移民劳工，尤其是来自印度和中国的劳工，塑造了马来西亚的人口多样性。'
                        ],
                        'image' => 'images/malaysiahistory/18.png'
                    ],
                    [
                        'title' => [
                            'en' => 'Early 20th Century: Nationalist Movement',
                            'ms' => 'Awal Abad 20: Pergerakan Nasionalis',
                            'zh' => '20世纪初：民族主义运动'
                        ],
                        'text' => [
                            'en' => 'Nationalist movements grew.',
                            'ms' => 'Pergerakan nasionalis berkembang.',
                            'zh' => '民族主义运动兴起。'
                        ],
                        'details' => [
                            'en' => 'Influenced by global anti-colonial ideas, groups like Kesatuan Melayu Muda (KMM) emerged, advocating for Malay rights and independence. These movements laid the groundwork for the push toward self-governance.',
                            'ms' => 'Dipengaruhi oleh idea anti-kolonial global, kumpulan seperti Kesatuan Melayu Muda (KMM) muncul, memperjuangkan hak Melayu dan kemerdekaan. Pergerakan ini meletakkan asas untuk usaha ke arah pemerintahan sendiri.',
                            'zh' => '受全球反殖民思想影响，诸如马来青年联盟（KMM）等团体出现，倡导马来人权利和独立。这些运动为迈向自治奠定了基础。'
                        ],
                        'image' => 'images/malaysiahistory/19.png'
                    ],
                    [
                        'title' => [
                            'en' => '2025: Modern Malaysia',
                            'ms' => '2025: Malaysia Moden',
                            'zh' => '2025年：现代马来西亚'
                        ],
                        'text' => [
                            'en' => 'Malaysia thrives as a modern nation.',
                            'ms' => 'Malaysia berkembang sebagai negara moden.',
                            'zh' => '马来西亚作为现代国家蓬勃发展。'
                        ],
                        'details' => [
                            'en' => 'By 2025, Malaysia has become a global economic player, balancing modernization with its rich cultural heritage. Initiatives like Vision 2020 have driven progress in technology, education, and infrastructure.',
                            'ms' => 'Menjelang 2025, Malaysia telah menjadi pemain ekonomi global, mengimbangi pemodenan dengan warisan budaya yang kaya. Inisiatif seperti Wawasan 2020 telah mendorong kemajuan dalam teknologi, pendidikan, dan infrastruktur.',
                            'zh' => '到2025年，马来西亚已成为全球经济参与者，在现代化与其丰富的文化传统之间取得平衡。2020年愿景等倡议推动了技术、教育和基础设施的进步。'
                        ],
                        'image' => 'images/malaysiahistory/20.png'
                    ]
                ];
                // Define language fallback function
                function getTranslation($period, $field, $lang, $fallback = 'en') {
                    if (isset($period[$field][$lang])) {
                        return $period[$field][$lang];
                    }
                    // Log missing translations
                    error_log("Missing translation for {$field} in {$lang}");
                    return $period[$field][$fallback];
                }

                foreach ($periods as $index => $period) {
                    $is_odd = $index % 2 === 0;
                    $title = getTranslation($period, 'title', $current_lang);
                    $text = getTranslation($period, 'text', $current_lang);
                    $details = getTranslation($period, 'details', $current_lang);
                    ?>
                <div class="timeline-item<?php echo $is_odd ? ' timeline-left' : ' timeline-right'; ?>" dir="<?php echo $text_direction; ?>">
                    <img src="<?php echo file_exists($period['image']) ? $period['image'] : $placeholder_image; ?>" alt="<?php echo $title; ?> illustration" onerror="this.src='<?php echo $placeholder_image; ?>'">
                    <h5><?php echo $title; ?></h5>
                    <p><?php echo $text; ?></p>
                    <div class="details">
                        <p><?php echo $details; ?></p>
                    </div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>

    <footer role="contentinfo">
        <div class="container">
            <p><?php echo get_translation($current_lang, 'footer_copyright'); ?></p>
            <div class="social-icons">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        // Toggle timeline item details
        document.querySelectorAll('.timeline-item').forEach(item => {
            item.addEventListener('click', () => {
                item.classList.toggle('active');
            });
        });
    </script>
</body>
</html>