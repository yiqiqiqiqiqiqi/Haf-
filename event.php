<?php
session_start();

// Ensure session is started properly
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Language switching handling, must be before any output
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lang'])) {
    $input_lang = $_POST['lang'];
    // Validate language input
    $valid_langs = ['en', 'zh', 'es', 'ar', 'fr', 'ru', 'pt', 'de', 'ja', 'hi'];
    if (in_array($input_lang, $valid_langs)) {
        $_SESSION['lang'] = $input_lang;
    }
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
}

// Set default language if not set (consider browser language as fallback)
if (!isset($_SESSION['lang'])) {
    // Optional: Detect browser language
    $browser_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'en', 0, 2);
    $_SESSION['lang'] = in_array($browser_lang, $valid_langs) ? $browser_lang : 'zh';
}

// Supported languages
$valid_langs = ['en', 'zh', 'es', 'ar', 'fr', 'ru', 'pt', 'de', 'ja', 'hi'];
$lang = in_array($_SESSION['lang'], $valid_langs) ? $_SESSION['lang'] : 'zh';
$site_dir = ($lang === 'ar') ? 'rtl' : 'ltr'; // Handle RTL for Arabic

// Translation function with complete translations
function get_translation($lang, $key) {
    $translations = [
        'en' => [
            'nav_home' => 'Home',
            'events_title' => 'Upcoming Events',
            'events_subtitle' => 'Join HAF future gatherings to experience boundless aesthetic possibilities',
            'event_1_title' => 'Historical Retrospective',
            'event_1_desc' => 'Explore dialogues between ancient civilizations and modern design.',
            'event_2_title' => 'Art Workshop',
            'event_2_desc' => 'Create hands-on, unleashing your artistic potential.',
            'event_3_title' => 'Fashion Launch',
            'event_3_desc' => 'Witness the debut of HAF 2025 collection.',
            'event_view_button' => 'View Details', // Added
            'footer_text' => '© 2025 HAF. All rights reserved.'
        ],
        'zh' => [
            'nav_home' => '首页',
            'events_title' => '即将举行的活动',
            'events_subtitle' => '加入HAF未来的聚会，体验无限的美学可能性',
            'event_1_title' => '历史回顾',
            'event_1_desc' => '探索古代文明与现代设计之间的对话。',
            'event_2_title' => '艺术工作坊',
            'event_2_desc' => '亲手创作，释放你的艺术潜能。',
            'event_3_title' => '时尚发布会',
            'event_3_desc' => '见证HAF 2025系列的首次亮相。',
            'event_view_button' => '查看详情', // Added
            'footer_text' => '© 2025 HAF。保留所有权利。'
        ],
        'es' => [
            'nav_home' => 'Inicio',
            'events_title' => 'Próximos Eventos',
            'events_subtitle' => 'Únete a las futuras reuniones de HAF para experimentar posibilidades estéticas ilimitadas',
            'event_1_title' => 'Retrospectiva Histórica',
            'event_1_desc' => 'Explora diálogos entre civilizaciones antiguas y el diseño moderno.',
            'event_2_title' => 'Taller de Arte',
            'event_2_desc' => 'Crea de forma práctica, liberando tu potencial artístico.',
            'event_3_title' => 'Lanzamiento de Moda',
            'event_3_desc' => 'Presencia el debut de la colección HAF 2025.',
            'event_view_button' => 'Ver Detalles',
            'footer_text' => '© 2025 HAF. Todos los derechos reservados.'
        ],
        'ar' => [
            'nav_home' => 'الرئيسية',
            'events_title' => 'الفعاليات القادمة',
            'events_subtitle' => 'انضم إلى تجمعات HAF المستقبلية لتجربة إمكانيات جمالية لا نهائية',
            'event_1_title' => 'استعادة تاريخية',
            'event_1_desc' => 'استكشف الحوارات بين الحضارات القديمة والتصميم الحديث.',
            'event_2_title' => 'ورشة فنية',
            'event_2_desc' => 'أبدع يدويًا، وأطلق العنان لإمكانياتك الفنية.',
            'event_3_title' => 'إطلاق الأزياء',
            'event_3_desc' => 'شاهد الظهور الأول لمجموعة HAF 2025.',
            'event_view_button' => 'عرض التفاصيل',
            'footer_text' => '© 2025 HAF. جميع الحقوق محفوظة.'
        ],
        'fr' => [
            'nav_home' => 'Accueil',
            'events_title' => 'Événements à venir',
            'events_subtitle' => 'Rejoignez les futurs rassemblements de HAF pour découvrir des possibilités esthétiques infinies',
            'event_1_title' => 'Rétrospective historique',
            'event_1_desc' => 'Explorez les dialogues entre les civilisations anciennes et le design moderne.',
            'event_2_title' => 'Atelier d’art',
            'event_2_desc' => 'Créez de manière pratique, libérant votre potentiel artistique.',
            'event_3_title' => 'Lancement de mode',
            'event_3_desc' => 'Assistez au lancement de la collection HAF 2025.',
            'event_view_button' => 'Voir les détails',
            'footer_text' => '© 2025 HAF. Tous droits réservés.'
        ],
        'ru' => [
            'nav_home' => 'Главная',
            'events_title' => 'Предстоящие мероприятия',
            'events_subtitle' => 'Присоединяйтесь к будущим встречам HAF, чтобы испытать безграничные эстетические возможности',
            'event_1_title' => 'Историческая ретроспектива',
            'event_1_desc' => 'Исследуйте диалоги между древними цивилизациями и современным дизайном.',
            'event_2_title' => 'Художественная мастерская',
            'event_2_desc' => 'Творите руками, раскрывая свой художественный потенциал.',
            'event_3_title' => 'Презентация моды',
            'event_3_desc' => 'Станьте свидетелем дебюта коллекции HAF 2025.',
            'event_view_button' => 'Подробности',
            'footer_text' => '© 2025 HAF. Все права защищены.'
        ],
        'pt' => [
            'nav_home' => 'Início',
            'events_title' => 'Eventos Futuros',
            'events_subtitle' => 'Junte-se aos futuros encontros da HAF para experimentar possibilidades estéticas ilimitadas',
            'event_1_title' => 'Retrospectiva Histórica',
            'event_1_desc' => 'Explore diálogos entre civilizações antigas e o design moderno.',
            'event_2_title' => 'Oficina de Arte',
            'event_2_desc' => 'Crie de forma prática, liberando seu potencial artístico.',
            'event_3_title' => 'Lançamento de Moda',
            'event_3_desc' => 'Testemunhe a estreia da coleção HAF 2025.',
            'event_view_button' => 'Ver Detalhes',
            'footer_text' => '© 2025 HAF. Todos os direitos reservados.'
        ],
        'de' => [
            'nav_home' => 'Startseite',
            'events_title' => 'Kommende Veranstaltungen',
            'events_subtitle' => 'Nehmen Sie an zukünftigen HAF-Treffen teil, um grenzenlose ästhetische Möglichkeiten zu erleben',
            'event_1_title' => 'Historische Rückschau',
            'event_1_desc' => 'Erkunden Sie Dialoge zwischen antiken Zivilisationen und modernem Design.',
            'event_2_title' => 'Kunstworkshop',
            'event_2_desc' => 'Schaffen Sie praktisch und entfesseln Sie Ihr künstlerisches Potenzial.',
            'event_3_title' => 'Mode-Launch',
            'event_3_desc' => 'Erleben Sie die Premiere der HAF 2025 Kollektion.',
            'event_view_button' => 'Details anzeigen',
            'footer_text' => '© 2025 HAF. Alle Rechte vorbehalten.'
        ],
        'ja' => [
            'nav_home' => 'ホーム',
            'events_title' => '今後のイベント',
            'events_subtitle' => 'HAFの未来の集まりに参加して、無限の美的可能性を体験してください',
            'event_1_title' => '歴史的回顧',
            'event_1_desc' => '古代文明と現代デザインの対話を探求します。',
            'event_2_title' => 'アートワークショップ',
            'event_2_desc' => '実際に手を動かして、芸術的潜在能力を解き放ちます。',
            'event_3_title' => 'ファッション発表会',
            'event_3_desc' => 'HAF 2025コレクションのデビューを目撃してください。',
            'event_view_button' => '詳細を見る',
            'footer_text' => '© 2025 HAF. すべての権利を保有します。'
        ],
        'hi' => [
            'nav_home' => 'होम',
            'events_title' => 'आगामी आयोजन',
            'events_subtitle' => 'HAF के भविष्य के समारोहों में शामिल हों और असीमित सौंदर्य संभावनाओं का अनुभव करें',
            'event_1_title' => 'ऐतिहासिक पुनरावलोकन',
            'event_1_desc' => 'प्राचीन सभ्यताओं और आधुनिक डिज़ाइन के बीच संवादों का अन्वेषण करें।',
            'event_2_title' => 'कला कार्यशाला',
            'event_2_desc' => 'हाथों से रचनात्मकता, अपनी कलात्मक संभावनाओं को उजागर करें।',
            'event_3_title' => 'फैशन लॉन्च',
            'event_3_desc' => 'HAF 2025 संग्रह की पहली प्रस्तुति देखें।',
            'event_view_button' => 'विवरण देखें',
            'footer_text' => '© 2025 HAF. सर्वाधिकार सुरक्षित।'
        ]
    ];
    return $translations[$lang][$key] ?? $translations['en'][$key] ?? $key; // Fallback to key if translation missing
}
?>

<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>" dir="<?php echo htmlspecialchars($site_dir); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAF Events</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&family=Playfair+Display:wght@400;700&family=Raleway:wght@300;400;500&family=Noto+Sans+Arabic:wght@400;700&family=Noto+Sans+JP:wght@400;700&family=Noto+Sans+Deva:wght@400;700" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        /* CSS remains unchanged */
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

        * {
            box-sizing: border-box;
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--custom-light);
            color: var(--charcoal);
            line-height: 1.6;
        }

        [lang="ar"] {
            font-family: 'Noto Sans Arabic', sans-serif;
        }

        [lang="ja"] {
            font-family: 'Noto Sans JP', sans-serif;
        }

        [lang="hi"] {
            font-family: 'Noto Sans Deva', sans-serif;
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

        .lang-selector {
            background-color: var(--ivory);
            border: 2px solid var(--old-lace);
            padding: 5px 10px;
            border-radius: 5px;
            font-family: 'Raleway', sans-serif;
        }

        .events-section {
            padding: 80px 0;
            background: var(--gradient);
        }

        .events-section h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .events-section .lead {
            font-family: 'Raleway', sans-serif;
            font-size: 1.3rem;
            margin-bottom: 40px;
            text-align: center;
        }

        .event-card {
            background-color: var(--snow);
            border: 2px solid var(--old-lace);
            border-radius: 10px;
            box-shadow: var(--shadow-normal);
            padding: 20px;
            margin-bottom: 30px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .event-card img {
            height: 180px;
            width: 100%;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .event-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            margin-bottom: 10px;
        }

        .event-card p {
            font-family: 'Raleway', sans-serif;
            font-size: 1rem;
            color: #666;
        }

        footer {
            background-color: var(--papaya-whip);
            border-top: 2px solid var(--old-lace);
            padding: 30px 0;
            text-align: center;
            color: var(--charcoal);
            font-family: 'Raleway', sans-serif;
        }

        footer .social-icons a {
            color: var(--charcoal);
            margin: 0 10px;
            font-size: 1.2rem;
        }

        footer .social-icons a:hover {
            color: var(--old-lace);
        }

        @media (max-width: 768px) {
            .events-section h1 {
                font-size: 2.5rem;
            }

            .events-section .lead {
                font-size: 1.3rem;
            }

            .event-card img {
                height: 120px;
            }
        }

        @media (max-width: 600px) {
            .event-card img {
                height: 100px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">HAF</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><?php echo get_translation($lang, 'nav_home'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="event.php"><?php echo get_translation($lang, 'events_title'); ?></a>
                    </li>
                </ul>
                <!-- Simplified language selector form -->
                <form id="langForm" method="post" action="" class="ms-3">
                    <select class="lang-selector" name="lang" onchange="this.form.submit()">
                        <?php foreach ($valid_langs as $l): ?>
                            <option value="<?php echo htmlspecialchars($l); ?>" <?php echo $l === $lang ? 'selected' : ''; ?>><?php echo strtoupper($l); ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>
        </div>
    </nav>

    <!-- Events Section -->
    <section class="events-section">
        <div class="container">
            <h1 class="animate__animated animate__fadeIn" data-animate-delay="0s"><?php echo get_translation($lang, 'events_title'); ?></h1>
            <p class="lead animate__animated animate__fadeIn" data-animate-delay="0.5s"><?php echo get_translation($lang, 'events_subtitle'); ?></p>
            <?php
            // Retrieve event parameter
            $event_id = isset($_GET['event']) ? intval($_GET['event']) : 0;
            $events = [
                1 => [
                    'img' => 'images/event_1.png',
                    'title' => get_translation($lang, 'event_1_title'),
                    'desc' => get_translation($lang, 'event_1_desc'),
                ],
                2 => [
                    'img' => 'images/event_2.png',
                    'title' => get_translation($lang, 'event_2_title'),
                    'desc' => get_translation($lang, 'event_2_desc'),
                ],
                3 => [
                    'img' => 'images/event_3.png',
                    'title' => get_translation($lang, 'event_3_title'),
                    'desc' => get_translation($lang, 'event_3_desc'),
                ],
            ];
            ?>
            <?php if (isset($events[$event_id]) && $event_id > 0): ?>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="event-card animate__animated animate__fadeIn">
                            <img src="<?php echo $events[$event_id]['img']; ?>" alt="<?php echo htmlspecialchars($events[$event_id]['title']); ?>">
                            <h3><?php echo htmlspecialchars($events[$event_id]['title']); ?></h3>
                            <p><?php echo htmlspecialchars($events[$event_id]['desc']); ?></p>
                        </div>
                    </div>
                </div>
            <?php elseif ($event_id === 0): ?>
                <div class="row g-4">
                    <?php foreach ($events as $id => $event): ?>
                        <div class="col-md-4">
                            <div class="event-card animate__animated animate__fadeIn">
                                <img src="<?php echo $event['img']; ?>" alt="<?php echo htmlspecialchars($event['title']); ?>">
                                <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                                <p><?php echo htmlspecialchars($event['desc']); ?></p>
                                <a href="event.php?event=<?php echo $id; ?>" class="btn btn-primary mt-2"><?php echo get_translation($lang, 'event_view_button'); ?></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-warning text-center mt-5"><?php echo get_translation($lang, 'event_not_found') ?: 'Event not found.'; ?></div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p><?php echo get_translation($lang, 'footer_text'); ?></p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        // Animation on scroll (JavaScript unchanged)
        const animateElements = document.querySelectorAll('.animate__animated');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const delay = entry.target.getAttribute('data-animate-delay') || '0s';
                    entry.target.style.animationDelay = delay;
                    entry.target.classList.add('animate__fadeIn');
                }
            });
        }, { threshold: 0.1 });

        animateElements.forEach(el => observer.observe(el));
    </script>
</body>
</html>