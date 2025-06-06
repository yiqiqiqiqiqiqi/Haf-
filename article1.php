<?php
session_start();

// Default language set to Chinese
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'zh';
}

// Handle language switching
if (isset($_POST['lang'])) {
    $valid_langs = ['en', 'zh'];
    $_SESSION['lang'] = in_array($_POST['lang'], $valid_langs) ? $_POST['lang'] : 'zh';
}

$current_lang = $_SESSION['lang'];
$site_dir = $current_lang === 'zh' ? 'ltr' : 'ltr'; // Both en and zh use LTR

// Translation array for article1
$translations = [
    'en' => [
        'meta_description' => 'Detailed analysis of the fall of the Roman Empire',
        'title' => 'The Fall of the Roman Empire',
        'subtitle' => 'An in-depth look at the decline of one of history\'s greatest empires',
        'section1_title' => 'Economic Challenges',
        'section1_content' => 'The Roman Empire faced significant economic strain due to overexpansion, heavy taxation, and reliance on slave labor, which weakened its economic foundation by the 3rd century.',
        'section2_title' => 'Military Decline',
        'section2_content' => 'Military overreach and the inability to defend vast borders led to invasions by barbarian tribes, notably the Visigoths in 410 CE, marking a critical blow.',
        'section3_title' => 'Political Instability',
        'section3_content' => 'Frequent changes in leadership and corruption eroded the empire stability, culminating in the deposition of Romulus Augustulus in 476 CE.',
        'back_link' => 'Back to History',
    ],
    'zh' => [
        'meta_description' => '对罗马帝国衰落的详细分析',
        'title' => '罗马帝国的衰落',
        'subtitle' => '深入探讨历史上最伟大帝国之一的衰落',
        'section1_title' => '经济挑战',
        'section1_content' => '罗马帝国因过度扩张、重税和对奴隶劳动的依赖而面临严重的经济压力，到3世纪其经济基础受到削弱。',
        'section2_title' => '军事衰退',
        'section2_content' => '军事过度扩张和无法防御广阔边境导致蛮族部落入侵，特别是在公元410年西哥特人的入侵，标志着关键一击。',
        'section3_title' => '政治不稳定',
        'section3_content' => '领导层的频繁更替和腐败侵蚀了帝国的稳定性，最终在公元476年罗慕路斯·奥古斯都斯被废黜。',
        'back_link' => '返回历史',
    ]
];

// Helper function to get translations
function get_translation($lang, $key) {
    global $translations;
    return isset($translations[$lang][$key]) ? $translations[$lang][$key] : (isset($translations['en'][$key]) ? $translations['en'][$key] : '');
}
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($current_lang); ?>" dir="<?php echo $site_dir; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars(get_translation($current_lang, 'meta_description')); ?>">
    <meta property="og:title" content="HAF - <?php echo htmlspecialchars(get_translation($current_lang, 'title')); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars(get_translation($current_lang, 'meta_description')); ?>">
    <meta property="og:image" content="images/article-1.jpg">
    <title>HAF - <?php echo htmlspecialchars(get_translation($current_lang, 'title')); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@400&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            --gradient: linear-gradient(135deg, var(--papaya-whip) 0%, var(--snow) 100%);
            --shadow-normal: 0 4px 16px rgba(0,0,0,0.10);
            --shadow-hover: 0 8px 32px rgba(0,0,0,0.15);
        }

        [data-theme="dark"] {
            --custom-light: #2C2C2C;
            --papaya-whip: #3C2F2F;
            --old-lace: #3A3A3A;
            --linen: #2F2F2F;
            --seashell: #2E2E2E;
            --snow: #333333;
            --ivory: #2D2D2D;
            --charcoal: #E0E0E0;
            --old-lace-opaque: rgba(58, 58, 58, 0.8);
            --gradient: linear-gradient(135deg, #3C2F2F 0%, #333333 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--charcoal);
            line-height: 1.6;
            background: var(--custom-light);
            transition: background 0.3s, color 0.3s;
            direction: <?php echo $site_dir; ?>;
        }

        [lang="zh"] body, [lang="zh"] h1, [lang="zh"] p, [lang="zh"] a {
            font-family: 'Noto Sans JP', sans-serif;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        nav {
            background: var(--papaya-whip);
            padding: 80px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: var(--shadow-normal);
        }

        nav .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav a {
            color: var(--charcoal);
            text-decoration: none;
            margin: 0 20px;
            font-family: 'Raleway', sans-serif;
            font-size: 1.1rem;
        }

        nav a:hover {
            color: var(--ivory);
        }

        .language-form {
            display: flex;
            align-items: center;
        }

        .language-form::before {
            content: '🌐';
            margin-right: 8px;
            font-size: 1.2rem;
        }

        nav select {
            padding: 10px;
            font-family: 'Raleway', sans-serif;
            background: var(--old-lace);
            border: 1px solid var(--linen);
            border-radius: 4px;
            color: var(--charcoal);
            font-size: 1.1rem;
        }

        .theme-toggle {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--charcoal);
            margin-left: 10px;
        }

        .article-content {
            padding: 80px 0;
            background: var(--seashell);
        }

        .article-content h1 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 3.5rem;
            text-align: center;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .article-content p.subtitle {
            font-family: 'Raleway', sans-serif;
            font-weight: 300;
            font-size: 1.3rem;
            text-align: center;
            margin-bottom: 50px;
            color: #666;
            line-height: 1.6;
        }

        .article-section {
            max-width: 1000px;
            margin: 0 auto 40px;
            background: var(--snow);
            padding: 20px;
            border-radius: 10px;
            box-shadow: var(--shadow-normal);
        }

        .article-section h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.0rem;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .article-section p {
            font-family: 'Raleway', sans-serif;
            font-size: 1.1rem;
            color: #444;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .article-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .back-link {
            display: inline-block;
            padding: 10px 30px;
            background: var(--old-lace);
            color: var(--charcoal);
            text-decoration: none;
            border-radius: 6px;
            font-family: 'Raleway', sans-serif;
            font-size: 1.1rem;
            transition: background 0.3s;
            text-align: center;
        }

        .back-link:hover {
            background: var(--ivory);
        }

        footer {
            background: var(--linen);
            color: var(--charcoal);
            text-align: center;
            padding: 40px 20px;
            margin-top: 50px;
        }

        footer p {
            font-family: 'Raleway', sans-serif;
            font-size: 1rem;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            nav {
                padding: 20px 0;
            }

            nav .container {
                flex-direction: column;
                gap: 15px;
            }

            .article-content h1 {
                font-size: 2.5rem;
            }

            .article-content p.subtitle {
                font-size: 1.1rem;
            }

            .article-section {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="container">
            <a href="index.php" style="display:inline-block;margin-right:20px;">
                <img src="images/haf_logo.png" alt="HAF Logo" style="height:40px;vertical-align:middle;">
            </a>
            <div>
                <a href="history.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_history')); ?></a>
                <a href="world_history.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_world_history')); ?></a>
                <a href="malaysia_history.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_malaysia_history')); ?></a>
                <a href="history_game.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_history_game')); ?></a>
                <a href="art.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_art')); ?></a>
                <a href="fashion.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_fashion')); ?></a>
                <a href="php/shop.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_shop')); ?></a>
            </div>
            <form method="POST" class="language-form">
                <select name="lang" onchange="this.form.submit()">
                    <option value="en" <?php echo $current_lang === 'en' ? 'selected' : ''; ?>>English</option>
                    <option value="zh" <?php echo $current_lang === 'zh' ? 'selected' : ''; ?>>中文</option>
                </select>
                <button type="button" class="theme-toggle" aria-label="Toggle theme"><i class="fas fa-adjust"></i></button>
            </form>
        </div>
    </nav>

    <div class="article-content">
        <div class="container">
            <h1><?php echo htmlspecialchars(get_translation($current_lang, 'title')); ?></h1>
            <p class="subtitle"><?php echo htmlspecialchars(get_translation($current_lang, 'subtitle')); ?></p>
            <div class="article-section">
                <h2><?php echo htmlspecialchars(get_translation($current_lang, 'section1_title')); ?></h2>
                <p><?php echo htmlspecialchars(get_translation($current_lang, 'section1_content')); ?></p>
                <img src="images/article-11-economy.jpg" alt="Economic Challenges" class="article-image">
            </div>
            <div class="article-section">
                <h2><?php echo htmlspecialchars(get_translation($current_lang, 'section2_title')); ?></h2>
                <p><?php echo htmlspecialchars(get_translation($current_lang, 'section2_content')); ?></p>
                <img src="images/article-1-military.jpg" alt="Military Decline" class="article-image">
            </div>
            <div class="article-section">
                <h2><?php echo htmlspecialchars(get_translation($current_lang, 'section3_title')); ?></h2>
                <p><?php echo htmlspecialchars(get_translation($current_lang, 'section3_content')); ?></p>
                <img src="images/article-1-political.jpg" alt="Political Instability" class="article-image">
            </div>
            <a href="history.php" class="back-link"><?php echo htmlspecialchars(get_translation($current_lang, 'back_link')); ?></a>
        </div>
    </div>

    <footer>
        <div class="container">
            <p><?php echo htmlspecialchars(get_translation($current_lang, 'footer_copyright')); ?></p>
        </div>
    </footer>

    <script>
        // Theme Toggle
        const themeToggle = document.querySelector('.theme-toggle');
        themeToggle.addEventListener('click', () => {
            document.body.dataset.theme = document.body.dataset.theme === 'dark' ? 'light' : 'dark';
            localStorage.setItem('theme', document.body.dataset.theme);
        });

        if (localStorage.getItem('theme')) {
            document.body.dataset.theme = localStorage.getItem('theme');
        } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.body.dataset.theme = 'dark';
        }
    </script>
</body>
</html>