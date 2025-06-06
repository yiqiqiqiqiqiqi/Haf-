<?php
session_start();

// 支持的语言
$valid_langs = ['en', 'zh', 'ja', 'ar', 'es', 'fr', 'ru', 'pt', 'de', 'hi'];

// 默认语言
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'zh';
}

// 处理语言切换
if (isset($_POST['lang']) && in_array($_POST['lang'], $valid_langs)) {
    $_SESSION['lang'] = $_POST['lang'];
}

$current_lang = $_SESSION['lang'];
$site_dir = $current_lang === 'ar' ? 'rtl' : 'ltr';

// 全量多语言翻译
$translations = [
    'en' => [
        'meta_description' => 'Experience the glamour of fashion shows with HAF, showcasing the latest runway looks',
        'hero_title' => 'Fashion Show Highlights',
        'hero_subtitle' => 'Discover the elegance of the runway with HAF',
        'nav_history' => 'History',
        'nav_art' => 'Art',
        'nav_fashion' => 'Fashion',
        'nav_shop' => 'Shop',
        'runway_title' => 'Runway Looks',
        'runway_subtitle' => 'A curated collection of the season\'s most iconic designs',
        // ... look_1 ~ look_15 (英文)
    ],
    'zh' => [
        'meta_description' => '通过 HAF 体验时装秀的魅力，展示最新的跑道造型',
        'hero_title' => '时装秀亮点',
        'hero_subtitle' => '与 HAF 一起发现跑道的优雅',
        'nav_history' => '历史',
        'nav_art' => '艺术',
        'nav_fashion' => '时尚',
        'nav_shop' => '商店',
        'runway_title' => '马来西亚独立',
        'runway_subtitle' => '马来西亚的独立之路',
        'section1_title' => '早期抗争',
        'section1_content' => '马来西亚人民在殖民时期展开了多次反抗运动，为争取独立奠定了基础。',
        'section2_title' => '联盟的形成',
        'section2_content' => '各民族团结一致，成立了马来亚联合邦，为独立运动提供了坚实的组织保障。',
        'section3_title' => '独立日',
        'section3_content' => '1957年8月31日，马来西亚正式宣布独立，成为主权国家。',
        'back_link' => '返回历史',
        // ... look_1 ~ look_15 (中文)
    ],
    'ja' => [
        'meta_description' => 'HAFでファッションショーの魅力を体験し、最新のランウェイルックを紹介',
        'hero_title' => 'ファッションショー ハイライト',
        'hero_subtitle' => 'HAFと共にランウェイの優雅さを発見',
        'nav_history' => '歴史',
        'nav_art' => 'アート',
        'nav_fashion' => 'ファッション',
        'nav_shop' => 'ショップ',
        'runway_title' => 'ランウェイルック',
        'runway_subtitle' => '今シーズンの最も象徴的なデザインを厳選',
        // ... look_1 ~ look_15 (日文)
    ],
    'ar' => [
        'meta_description' => 'اكتشف روعة عروض الأزياء مع HAF، واستعرض أحدث إطلالات المنصة',
        'hero_title' => 'أبرز عروض الأزياء',
        'hero_subtitle' => 'اكتشف أناقة المنصة مع HAF',
        'nav_history' => 'التاريخ',
        'nav_art' => 'الفن',
        'nav_fashion' => 'الموضة',
        'nav_shop' => 'المتجر',
        'runway_title' => 'إطلالات المنصة',
        'runway_subtitle' => 'مجموعة مختارة من أكثر التصاميم شهرة لهذا الموسم',
        // ... look_1 ~ look_15 (阿拉伯文)
    ],
    'es' => [
        'meta_description' => 'Vive el glamour de los desfiles de moda con HAF, mostrando los últimos looks de pasarela',
        'hero_title' => 'Destacados del Desfile de Moda',
        'hero_subtitle' => 'Descubre la elegancia de la pasarela con HAF',
        'nav_history' => 'Historia',
        'nav_art' => 'Arte',
        'nav_fashion' => 'Moda',
        'nav_shop' => 'Tienda',
        'runway_title' => 'Looks de Pasarela',
        'runway_subtitle' => 'Una colección seleccionada de los diseños más icónicos de la temporada',
        // ... look_1 ~ look_15 (西班牙文)
    ],
    'fr' => [
        'meta_description' => 'Vivez le glamour des défilés de mode avec HAF, présentant les derniers looks du podium',
        'hero_title' => 'Temps forts du défilé de mode',
        'hero_subtitle' => 'Découvrez l\'élégance du podium avec HAF',
        'nav_history' => 'Histoire',
        'nav_art' => 'Art',
        'nav_fashion' => 'Mode',
        'nav_shop' => 'Boutique',
        'runway_title' => 'Looks de Podium',
        'runway_subtitle' => 'Une collection sélectionnée des designs les plus emblématiques de la saison',
        // ... look_1 ~ look_15 (法文)
    ],
    'ru' => [
        'meta_description' => 'Ощутите гламур модных показов с HAF, демонстрируя последние образы с подиума',
        'hero_title' => 'Основные моменты модного показа',
        'hero_subtitle' => 'Откройте для себя элегантность подиума с HAF',
        'nav_history' => 'История',
        'nav_art' => 'Искусство',
        'nav_fashion' => 'Мода',
        'nav_shop' => 'Магазин',
        'runway_title' => 'Образы с подиума',
        'runway_subtitle' => 'Подборка самых культовых дизайнов сезона',
        // ... look_1 ~ look_15 (俄文)
    ],
    'pt' => [
        'meta_description' => 'Experimente o glamour dos desfiles de moda com HAF, apresentando os mais recentes looks de passarela',
        'hero_title' => 'Destaques do Desfile de Moda',
        'hero_subtitle' => 'Descubra a elegância da passarela com HAF',
        'nav_history' => 'História',
        'nav_art' => 'Arte',
        'nav_fashion' => 'Moda',
        'nav_shop' => 'Loja',
        'runway_title' => 'Looks de Passarela',
        'runway_subtitle' => 'Uma coleção selecionada dos designs mais icônicos da temporada',
        // ... look_1 ~ look_15 (葡萄牙文)
    ],
    'de' => [
        'meta_description' => 'Erleben Sie den Glamour von Modenschauen mit HAF und entdecken Sie die neuesten Laufsteg-Looks',
        'hero_title' => 'Highlights der Modenschau',
        'hero_subtitle' => 'Entdecken Sie die Eleganz des Laufstegs mit HAF',
        'nav_history' => 'Geschichte',
        'nav_art' => 'Kunst',
        'nav_fashion' => 'Mode',
        'nav_shop' => 'Shop',
        'runway_title' => 'Laufsteg-Looks',
        'runway_subtitle' => 'Eine kuratierte Auswahl der ikonischsten Designs der Saison',
        // ... look_1 ~ look_15 (德文)
    ],
    'hi' => [
        'meta_description' => 'HAF के साथ फैशन शो की भव्यता का अनुभव करें, नवीनतम रनवे लुक्स को प्रदर्शित करते हुए',
        'hero_title' => 'फैशन शो की झलकियाँ',
        'hero_subtitle' => 'HAF के साथ रनवे की सुंदरता की खोज करें',
        'nav_history' => 'इतिहास',
        'nav_art' => 'कला',
        'nav_fashion' => 'फैशन',
        'nav_shop' => 'दुकान',
        'runway_title' => 'रनवे लुक्स',
        'runway_subtitle' => 'सीजन के सबसे प्रतिष्ठित डिज़ाइनों का एक क्यूरेटेड संग्रह',
        // ... look_1 ~ look_15 (印地文)
    ],
];

// 你需要将 look_1 ~ look_15 的所有字段（_text, _designer, _year, _desc）在每个语言下都补全
// 下面是一个 look 的多语言示例，其他 look 请仿照补全
/*
'look_1_text' => 'Evening Gown',
'look_1_designer' => 'Designer: Alexander McQueen',
'look_1_year' => 'Year: 2023',
'look_1_desc' => 'A stunning black evening gown with intricate lace details, embodying timeless elegance.',
// 中文
'look_1_text' => '晚礼服',
'look_1_designer' => '设计师：亚历山大·麦昆',
'look_1_year' => '年份：2023',
'look_1_desc' => '一件华丽的黑色晚礼服，带有复杂的蕾丝细节，体现永恒的优雅。',
...
*/

// 获取翻译
function get_translation($lang, $key) {
    global $translations;
    if (isset($translations[$lang][$key])) {
        return $translations[$lang][$key];
    }
    return isset($translations['en'][$key]) ? $translations['en'][$key] : '';
}

// JS用
$js_translations = json_encode($translations[$current_lang]);
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($current_lang); ?>" dir="<?php echo $site_dir; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars(get_translation($current_lang, 'meta_description')); ?>">
    <meta property="og:title" content="HAF - <?php echo htmlspecialchars(get_translation($current_lang, 'runway_title')); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars(get_translation($current_lang, 'meta_description')); ?>">
    <meta property="og:image" content="images/article-2.jpg">
    <title>HAF - <?php echo htmlspecialchars(get_translation($current_lang, 'runway_title')); ?></title>
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
                    <?php foreach ($valid_langs as $lang_code): ?>
                        <option value="<?php echo $lang_code; ?>" <?php echo $current_lang === $lang_code ? 'selected' : ''; ?>>
                            <?php
                            $lang_names = [
                                'en' => 'English', 'zh' => '中文', 'ja' => '日本語', 'ar' => 'العربية',
                                'es' => 'Español', 'fr' => 'Français', 'ru' => 'Русский', 'pt' => 'Português',
                                'de' => 'Deutsch', 'hi' => 'हिन्दी'
                            ];
                            echo $lang_names[$lang_code];
                            ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="button" class="theme-toggle" aria-label="Toggle theme"><i class="fas fa-adjust"></i></button>
            </form>
        </div>
    </nav>

    <div class="article-content">
        <div class="container">
            <h1><?php echo htmlspecialchars(get_translation($current_lang, 'runway_title')); ?></h1>
            <p class="subtitle"><?php echo htmlspecialchars(get_translation($current_lang, 'runway_subtitle')); ?></p>
            <div class="article-section">
                <h2><?php echo htmlspecialchars(get_translation($current_lang, 'section1_title')); ?></h2>
                <p><?php echo htmlspecialchars(get_translation($current_lang, 'section1_content')); ?></p>
                <img src="images/article-2-resistance.jpg" alt="Early Resistance" class="article-image">
            </div>
            <div class="article-section">
                <h2><?php echo htmlspecialchars(get_translation($current_lang, 'section2_title')); ?></h2>
                <p><?php echo htmlspecialchars(get_translation($current_lang, 'section2_content')); ?></p>
                <img src="images/article-2-alliance.jpg" alt="Formation of the Alliance" class="article-image">
            </div>
            <div class="article-section">
                <h2><?php echo htmlspecialchars(get_translation($current_lang, 'section3_title')); ?></h2>
                <p><?php echo htmlspecialchars(get_translation($current_lang, 'section3_content')); ?></p>
                <img src="images/article-2-independence.jpg" alt="Independence Day" class="article-image">
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