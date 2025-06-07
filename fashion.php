<?php
session_start();

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'zh';
}

// Handle language switching
if (isset($_POST['lang'])) {
    $valid_langs = ['en', 'zh', 'ms', 'es', 'ar', 'fr', 'ru', 'pt', 'de', 'ja', 'hi'];
    $_SESSION['lang'] = in_array($_POST['lang'], $valid_langs) ? $_POST['lang'] : 'zh';
}

$current_lang = $_SESSION['lang'];
$site_dir = $current_lang === 'ar' ? 'rtl' : 'ltr';

// Hero slideshow images based on language
$hero_slides = [
    'en' => [
        'images/fashion-hero-en-1.jpg',
        'images/fashion-hero-en-2.jpg',
        'images/fashion-hero-en-3.jpg'
    ],
    'zh' => [
        'images/fashion-hero-zh-1.jpg',
        'images/fashion-hero-zh-2.jpg',
        'images/fashion-hero-zh-3.jpg'
    ],
    'ms' => [
        'images/fashion-hero-ms-1.jpg',
        'images/fashion-hero-ms-2.jpg',
        'images/fashion-hero-ms-3.jpg'
    ],
    'es' => [
        'images/fashion-hero-es-1.jpg',
        'images/fashion-hero-es-2.jpg',
        'images/fashion-hero-es-3.jpg'
    ],
    'ar' => [
        'images/fashion-hero-ar-1.jpg',
        'images/fashion-hero-ar-2.jpg',
        'images/fashion-hero-ar-3.jpg'
    ],
    'fr' => [
        'images/fashion-hero-fr-1.jpg',
        'images/fashion-hero-fr-2.jpg',
        'images/fashion-hero-fr-3.jpg'
    ],
    'ru' => [
        'images/fashion-hero-ru-1.jpg',
        'images/fashion-hero-ru-2.jpg',
        'images/fashion-hero-ru-3.jpg'
    ],
    'pt' => [
        'images/fashion-hero-pt-1.jpg',
        'images/fashion-hero-pt-2.jpg',
        'images/fashion-hero-pt-3.jpg'
    ],
    'de' => [
        'images/fashion-hero-de-1.jpg',
        'images/fashion-hero-de-2.jpg',
        'images/fashion-hero-de-3.jpg'
    ],
    'ja' => [
        'images/fashion-hero-ja-1.jpg',
        'images/fashion-hero-ja-2.jpg',
        'images/fashion-hero-ja-3.jpg'
    ],
    'hi' => [
        'images/fashion-hero-hi-1.jpg',
        'images/fashion-hero-hi-2.jpg',
        'images/fashion-hero-hi-3.jpg'
    ]
];
$default_slides = [
    'images/fashion-hero-1.jpg',
    'images/fashion-hero-2.jpg',
    'images/fashion-hero-3.jpg'
];
$slides = isset($hero_slides[$current_lang]) ? $hero_slides[$current_lang] : $default_slides;

// Translation array
$translations = [
    'en' => [
        'meta_description' => 'Step into the world of fashion with HAF, where style defines identity',
        'hero_title' => 'Runway of Elegance',
        'hero_subtitle' => 'Explore the essence of style with HAF\'s fashion hub',
        'nav_history' => 'History',
        'nav_art' => 'Art',
        'nav_fashion' => 'Fashion',
        'nav_fashion_show' => 'Fashion Shows',
        'nav_fashion_brand' => 'Fashion Brands',
        'nav_fashion_game' => 'Fashion Game',
        'nav_shop' => 'Shop',
        'options_title' => 'Discover Fashion',
        'options_subtitle' => 'Choose a path to explore the world of style',
        'option_fashion_show' => 'Experience Fashion Shows',
        'option_fashion_brand' => 'Explore Fashion Brands',
        'option_fashion_game' => 'Play Fashion Game',
        'option_fashion_show_desc' => 'Immerse yourself in the glamour of global runways',
        'option_fashion_brand_desc' => 'Discover iconic and emerging fashion labels',
        'option_fashion_game_desc' => 'Design and style in our interactive game',
        'quote_text' => 'Fashion is the armor to survive the reality of everyday life.',
        'quote_author' => 'Bill Cunningham',
        'trending_title' => 'Trending Looks',
        'trending_subtitle' => 'Discover the latest styles shaping the fashion world',
        'newsletter_title' => 'Stay in Style',
        'newsletter_subtitle' => 'Subscribe to our newsletter for the latest fashion updates',
        'newsletter_email_placeholder' => 'Enter your email',
        'newsletter_submit' => 'Subscribe',
        'newsletter_success' => 'Thank you for subscribing!',
        'newsletter_banner' => 'Get the latest fashion updates!',
        'back_to_top' => 'Back to Top',
        'footer_copyright' => '© 2025 History, Art & Fashion. All rights reserved.'
    ],
    'zh' => [
        'meta_description' => '通过 HAF 踏入时尚世界，风格定义自我',
        'hero_title' => '优雅的跑道',
        'hero_subtitle' => '与 HAF 的时尚中心一起探索风格的本质',
        'nav_history' => '历史',
        'nav_art' => '艺术',
        'nav_fashion' => '时尚',
        'nav_fashion_show' => '时装秀',
        'nav_fashion_brand' => '时尚品牌',
        'nav_fashion_game' => '时尚游戏',
        'nav_shop' => '商店',
        'options_title' => '发现时尚',
        'options_subtitle' => '选择一条路径探索风格世界',
        'option_fashion_show' => '体验时装秀',
        'option_fashion_brand' => '探索时尚品牌',
        'option_fashion_game' => '玩时尚游戏',
        'option_fashion_show_desc' => '沉浸在全球跑道的魅力中',
        'option_fashion_brand_desc' => '发现标志性和新兴时尚品牌',
        'option_fashion_game_desc' => '在我们的互动游戏中设计和造型',
        'quote_text' => '时尚是应对日常现实的盔甲。',
        'quote_author' => '比尔·坎宁安',
        'trending_title' => '流行造型',
        'trending_subtitle' => '探索塑造时尚世界的最新风格',
        'newsletter_title' => '保持时尚',
        'newsletter_subtitle' => '订阅我们的 newsletter 以获取最新时尚动态',
        'newsletter_email_placeholder' => '输入您的邮箱',
        'newsletter_submit' => '订阅',
        'newsletter_success' => '感谢您的订阅！',
        'newsletter_banner' => '获取最新时尚动态！',
        'back_to_top' => '返回顶部',
        'footer_copyright' => '© 2025 历史、艺术与时尚. 保留所有权利。'
    ],
    'ms' => [
        'meta_description' => 'Melangkah ke dunia fesyen bersama HAF, di mana gaya menentukan identiti',
        'hero_title' => 'Landasan Keanggunan',
        'hero_subtitle' => 'Terokai intipati gaya dengan hab fesyen HAF',
        'nav_history' => 'Sejarah',
        'nav_art' => 'Seni',
        'nav_fashion' => 'Fesyen',
        'nav_fashion_show' => 'Pertunjukan Fesyen',
        'nav_fashion_brand' => 'Jenama Fesyen',
        'nav_fashion_game' => 'Permainan Fesyen',
        'nav_shop' => 'Kedai',
        'options_title' => 'Temui Fesyen',
        'options_subtitle' => 'Pilih laluan untuk meneroka dunia gaya',
        'option_fashion_show' => 'Alami Pertunjukan Fesyen',
        'option_fashion_brand' => 'Terokai Jenama Fesyen',
        'option_fashion_game' => 'Main Permainan Fesyen',
        'option_fashion_show_desc' => 'Hayati kemewahan pentas global',
        'option_fashion_brand_desc' => 'Temui jenama fesyen ikonik dan baharu',
        'option_fashion_game_desc' => 'Reka dan gayakan dalam permainan interaktif kami',
        'quote_text' => 'Fesyen adalah perisai untuk menghadapi realiti kehidupan seharian.',
        'quote_author' => 'Bill Cunningham',
        'trending_title' => 'Gaya Terkini',
        'trending_subtitle' => 'Temui gaya terkini yang membentuk dunia fesyen',
        'newsletter_title' => 'Kekal Bergaya',
        'newsletter_subtitle' => 'Langgan newsletter kami untuk kemas kini fesyen terkini',
        'newsletter_email_placeholder' => 'Masukkan emel anda',
        'newsletter_submit' => 'Langgan',
        'newsletter_success' => 'Terima kasih kerana melanggan!',
        'newsletter_banner' => 'Dapatkan kemas kini fesyen terkini!',
        'back_to_top' => 'Kembali ke Atas',
        'footer_copyright' => '© 2025 Sejarah, Seni & Fesyen. Hak cipta terpelihara.'
    ],
    'es' => [
        'meta_description' => 'Entra en el mundo de la moda con HAF, donde el estilo define la identidad',
        'hero_title' => 'Pasarela de Elegancia',
        'hero_subtitle' => 'Explora la esencia del estilo con el centro de moda de HAF',
        'nav_history' => 'Historia',
        'nav_art' => 'Arte',
        'nav_fashion' => 'Moda',
        'nav_fashion_show' => 'Desfiles de Moda',
        'nav_fashion_brand' => 'Marcas de Moda',
        'nav_fashion_game' => 'Juego de Moda',
        'nav_shop' => 'Tienda',
        'options_title' => 'Descubre la Moda',
        'options_subtitle' => 'Elige un camino para explorar el mundo del estilo',
        'option_fashion_show' => 'Vive Desfiles de Moda',
        'option_fashion_brand' => 'Explora Marcas de Moda',
        'option_fashion_game' => 'Juega al Juego de Moda',
        'option_fashion_show_desc' => 'Sumérgete en el glamour de las pasarelas globales',
        'option_fashion_brand_desc' => 'Descubre marcas icónicas y emergentes',
        'option_fashion_game_desc' => 'Diseña y crea en nuestro juego interactivo',
        'quote_text' => 'La moda es la armadura para sobrevivir la realidad de la vida cotidiana.',
        'quote_author' => 'Bill Cunningham',
        'trending_title' => 'Tendencias',
        'trending_subtitle' => 'Descubre los estilos más recientes que marcan la moda',
        'newsletter_title' => 'Mantente a la Moda',
        'newsletter_subtitle' => 'Suscríbete a nuestro boletín para las últimas novedades de moda',
        'newsletter_email_placeholder' => 'Introduce tu correo electrónico',
        'newsletter_submit' => 'Suscribirse',
        'newsletter_success' => '¡Gracias por suscribirte!',
        'newsletter_banner' => '¡Recibe las últimas novedades de moda!',
        'back_to_top' => 'Volver arriba',
        'footer_copyright' => '© 2025 Historia, Arte y Moda. Todos los derechos reservados.'
    ],
    'ar' => [
        'meta_description' => 'ادخل إلى عالم الموضة مع HAF، حيث يعرف الأسلوب الهوية',
        'hero_title' => 'منصة الأناقة',
        'hero_subtitle' => 'استكشف جوهر الأسلوب مع مركز الموضة HAF',
        'nav_history' => 'التاريخ',
        'nav_art' => 'الفن',
        'nav_fashion' => 'الأزياء',
        'nav_fashion_show' => 'عروض الأزياء',
        'nav_fashion_brand' => 'ماركات الأزياء',
        'nav_fashion_game' => 'لعبة الموضة',
        'nav_shop' => 'المتجر',
        'options_title' => 'اكتشاف الموضة',
        'options_subtitle' => 'اختر مسارًا لاستكشاف عالم الأسلوب',
        'option_fashion_show' => 'تجربة عروض الأزياء',
        'option_fashion_brand' => 'استكشاف ماركات الأزياء',
        'option_fashion_game' => 'لعب لعبة الموضة',
        'option_fashion_show_desc' => 'انغمس في سحر منصات العرض العالمية',
        'option_fashion_brand_desc' => 'اكتشف العلامات التجارية الشهيرة والناشئة',
        'option_fashion_game_desc' => 'صمم وأبدع في لعبتنا التفاعلية',
        'quote_text' => 'الموضة هي الدرع للبقاء على قيد الحياة في واقع الحياة اليومية.',
        'quote_author' => 'بيل كانينجهام',
        'trending_title' => 'إطلالات رائجة',
        'trending_subtitle' => 'اكتشف أحدث الأنماط التي تشكل عالم الموضة',
        'newsletter_title' => 'ابقَ أنيقًا',
        'newsletter_subtitle' => 'اشترك في نشرتنا الإخبارية للحصول على آخر تحديثات الموضة',
        'newsletter_email_placeholder' => 'أدخل بريدك الإلكتروني',
        'newsletter_submit' => 'اشتراك',
        'newsletter_success' => 'شكرًا لاشتراكك!',
        'newsletter_banner' => 'احصل على آخر تحديثات الموضة!',
        'back_to_top' => 'العودة للأعلى',
        'footer_copyright' => '© 2025 التاريخ، الفن والأزياء. جميع الحقوق محفوظة.'
    ],
    'fr' => [
        'meta_description' => 'Entrez dans le monde de la mode avec HAF, où le style définit l\'identité',
        'hero_title' => 'Podium de l\'Élégance',
        'hero_subtitle' => 'Explorez l\'essence du style avec le hub mode de HAF',
        'nav_history' => 'Histoire',
        'nav_art' => 'Art',
        'nav_fashion' => 'Mode',
        'nav_fashion_show' => 'Défilés de Mode',
        'nav_fashion_brand' => 'Marques de Mode',
        'nav_fashion_game' => 'Jeu de Mode',
        'nav_shop' => 'Boutique',
        'options_title' => 'Découvrir la Mode',
        'options_subtitle' => 'Choisissez un chemin pour explorer le monde du style',
        'option_fashion_show' => 'Vivre les Défilés de Mode',
        'option_fashion_brand' => 'Explorer les Marques de Mode',
        'option_fashion_game' => 'Jouer au Jeu de Mode',
        'option_fashion_show_desc' => 'Plongez dans le glamour des podiums mondiaux',
        'option_fashion_brand_desc' => 'Découvrez des marques emblématiques et émergentes',
        'option_fashion_game_desc' => 'Créez et stylisez dans notre jeu interactif',
        'quote_text' => 'La mode est l\'armure pour survivre à la réalité du quotidien.',
        'quote_author' => 'Bill Cunningham',
        'trending_title' => 'Tendances',
        'trending_subtitle' => 'Découvrez les derniers styles qui façonnent la mode',
        'newsletter_title' => 'Restez Stylé',
        'newsletter_subtitle' => 'Abonnez-vous à notre newsletter pour les dernières actualités mode',
        'newsletter_email_placeholder' => 'Entrez votre email',
        'newsletter_submit' => 'S\'abonner',
        'newsletter_success' => 'Merci pour votre abonnement !',
        'newsletter_banner' => 'Recevez les dernières actualités mode !',
        'back_to_top' => 'Retour en haut',
        'footer_copyright' => '© 2025 Histoire, Art & Mode. Tous droits réservés.'
    ],
    'ru' => [
        'meta_description' => 'Погрузитесь в мир моды с HAF, где стиль определяет личность',
        'hero_title' => 'Подиум Элегантности',
        'hero_subtitle' => 'Исследуйте суть стиля с модным центром HAF',
        'nav_history' => 'История',
        'nav_art' => 'Искусство',
        'nav_fashion' => 'Мода',
        'nav_fashion_show' => 'Показы мод',
        'nav_fashion_brand' => 'Модные бренды',
        'nav_fashion_game' => 'Модная игра',
        'nav_shop' => 'Магазин',
        'options_title' => 'Откройте для себя моду',
        'options_subtitle' => 'Выберите путь для изучения мира стиля',
        'option_fashion_show' => 'Посетить показы мод',
        'option_fashion_brand' => 'Изучить модные бренды',
        'option_fashion_game' => 'Играть в модную игру',
        'option_fashion_show_desc' => 'Погрузитесь в гламур мировых подиумов',
        'option_fashion_brand_desc' => 'Откройте для себя культовые и новые бренды',
        'option_fashion_game_desc' => 'Создавайте и стилизуйте в нашей интерактивной игре',
        'quote_text' => 'Мода — это броня, чтобы выжить в реальности повседневной жизни.',
        'quote_author' => 'Билл Каннингем',
        'trending_title' => 'Тренды',
        'trending_subtitle' => 'Откройте для себя последние стили, формирующие мир моды',
        'newsletter_title' => 'Будьте в стиле',
        'newsletter_subtitle' => 'Подпишитесь на нашу рассылку для получения последних новостей моды',
        'newsletter_email_placeholder' => 'Введите ваш email',
        'newsletter_submit' => 'Подписаться',
        'newsletter_success' => 'Спасибо за подписку!',
        'newsletter_banner' => 'Получайте последние новости моды!',
        'back_to_top' => 'Наверх',
        'footer_copyright' => '© 2025 История, Искусство и Мода. Все права защищены.'
    ],
    'pt' => [
        'meta_description' => 'Entre no mundo da moda com a HAF, onde o estilo define a identidade',
        'hero_title' => 'Passarela da Elegância',
        'hero_subtitle' => 'Explore a essência do estilo com o hub de moda da HAF',
        'nav_history' => 'História',
        'nav_art' => 'Arte',
        'nav_fashion' => 'Moda',
        'nav_fashion_show' => 'Desfiles de Moda',
        'nav_fashion_brand' => 'Marcas de Moda',
        'nav_fashion_game' => 'Jogo de Moda',
        'nav_shop' => 'Loja',
        'options_title' => 'Descubra a Moda',
        'options_subtitle' => 'Escolha um caminho para explorar o mundo do estilo',
        'option_fashion_show' => 'Viva Desfiles de Moda',
        'option_fashion_brand' => 'Explore Marcas de Moda',
        'option_fashion_game' => 'Jogue o Jogo de Moda',
        'option_fashion_show_desc' => 'Mergulhe no glamour das passarelas globais',
        'option_fashion_brand_desc' => 'Descubra marcas icônicas e emergentes',
        'option_fashion_game_desc' => 'Desenhe e estilize no nosso jogo interativo',
        'quote_text' => 'A moda é a armadura para sobreviver à realidade do dia a dia.',
        'quote_author' => 'Bill Cunningham',
        'trending_title' => 'Tendências',
        'trending_subtitle' => 'Descubra os estilos mais recentes que moldam o mundo da moda',
        'newsletter_title' => 'Fique na Moda',
        'newsletter_subtitle' => 'Assine nossa newsletter para as últimas novidades da moda',
        'newsletter_email_placeholder' => 'Digite seu e-mail',
        'newsletter_submit' => 'Assinar',
        'newsletter_success' => 'Obrigado por assinar!',
        'newsletter_banner' => 'Receba as últimas novidades da moda!',
        'back_to_top' => 'Voltar ao topo',
        'footer_copyright' => '© 2025 História, Arte & Moda. Todos os direitos reservados.'
    ],
    'de' => [
        'meta_description' => 'Tauche ein in die Welt der Mode mit HAF, wo Stil Identität definiert',
        'hero_title' => 'Laufsteg der Eleganz',
        'hero_subtitle' => 'Entdecke das Wesen des Stils mit dem Modezentrum von HAF',
        'nav_history' => 'Geschichte',
        'nav_art' => 'Kunst',
        'nav_fashion' => 'Mode',
        'nav_fashion_show' => 'Modenschauen',
        'nav_fashion_brand' => 'Modemarken',
        'nav_fashion_game' => 'Mode-Spiel',
        'nav_shop' => 'Shop',
        'options_title' => 'Mode Entdecken',
        'options_subtitle' => 'Wähle einen Weg, um die Welt des Stils zu erkunden',
        'option_fashion_show' => 'Modenschauen Erleben',
        'option_fashion_brand' => 'Modemarken Entdecken',
        'option_fashion_game' => 'Mode-Spiel Spielen',
        'option_fashion_show_desc' => 'Tauche ein in den Glamour globaler Laufstege',
        'option_fashion_brand_desc' => 'Entdecke ikonische und neue Modemarken',
        'option_fashion_game_desc' => 'Gestalte und style im interaktiven Spiel',
        'quote_text' => 'Mode ist die Rüstung, um die Realität des Alltags zu überleben.',
        'quote_author' => 'Bill Cunningham',
        'trending_title' => 'Trends',
        'trending_subtitle' => 'Entdecke die neuesten Styles der Modewelt',
        'newsletter_title' => 'Bleib im Stil',
        'newsletter_subtitle' => 'Abonniere unseren Newsletter für die neuesten Mode-Updates',
        'newsletter_email_placeholder' => 'Gib deine E-Mail ein',
        'newsletter_submit' => 'Abonnieren',
        'newsletter_success' => 'Danke für dein Abonnement!',
        'newsletter_banner' => 'Erhalte die neuesten Mode-Updates!',
        'back_to_top' => 'Nach oben',
        'footer_copyright' => '© 2025 Geschichte, Kunst & Mode. Alle Rechte vorbehalten.'
    ],
    'ja' => [
        'meta_description' => 'HAFと共にファッションの世界へ。スタイルがアイデンティティを定義します',
        'hero_title' => 'エレガンスのランウェイ',
        'hero_subtitle' => 'HAFのファッションハブでスタイルの本質を探求',
        'nav_history' => '歴史',
        'nav_art' => 'アート',
        'nav_fashion' => 'ファッション',
        'nav_fashion_show' => 'ファッションショー',
        'nav_fashion_brand' => 'ファッションブランド',
        'nav_fashion_game' => 'ファッションゲーム',
        'nav_shop' => 'ショップ',
        'options_title' => 'ファッションを発見',
        'options_subtitle' => 'スタイルの世界を探る道を選ぼう',
        'option_fashion_show' => 'ファッションショーを体験',
        'option_fashion_brand' => 'ブランドを探す',
        'option_fashion_game' => 'ファッションゲームで遊ぶ',
        'option_fashion_show_desc' => '世界のランウェイの魅力に浸る',
        'option_fashion_brand_desc' => '象徴的・新進気鋭のブランドを発見',
        'option_fashion_game_desc' => 'インタラクティブなゲームでデザイン＆スタイリング',
        'quote_text' => 'ファッションは日常の現実を生き抜くための鎧です。',
        'quote_author' => 'ビル・カニンガム',
        'trending_title' => 'トレンド',
        'trending_subtitle' => 'ファッション界を形作る最新スタイルを発見',
        'newsletter_title' => 'スタイルをキープ',
        'newsletter_subtitle' => '最新ファッション情報を受け取るにはニュースレターを購読',
        'newsletter_email_placeholder' => 'メールアドレスを入力',
        'newsletter_submit' => '購読する',
        'newsletter_success' => 'ご購読ありがとうございます！',
        'newsletter_banner' => '最新ファッション情報をゲット！',
        'back_to_top' => 'トップへ戻る',
        'footer_copyright' => '© 2025 歴史・アート・ファッション。全著作権所有。'
    ],
    'hi' => [
        'meta_description' => 'HAF के साथ फैशन की दुनिया में कदम रखें, जहाँ स्टाइल पहचान को परिभाषित करता है',
        'hero_title' => 'शान की रैंप',
        'hero_subtitle' => 'HAF के फैशन हब के साथ स्टाइल का सार खोजें',
        'nav_history' => 'इतिहास',
        'nav_art' => 'कला',
        'nav_fashion' => 'फैशन',
        'nav_fashion_show' => 'फैशन शो',
        'nav_fashion_brand' => 'फैशन ब्रांड्स',
        'nav_fashion_game' => 'फैशन गेम',
        'nav_shop' => 'दुकान',
        'options_title' => 'फैशन खोजें',
        'options_subtitle' => 'स्टाइल की दुनिया को खोजने के लिए एक रास्ता चुनें',
        'option_fashion_show' => 'फैशन शो का अनुभव करें',
        'option_fashion_brand' => 'फैशन ब्रांड्स खोजें',
        'option_fashion_game' => 'फैशन गेम खेलें',
        'option_fashion_show_desc' => 'वैश्विक रैंप के ग्लैमर में डूब जाएं',
        'option_fashion_brand_desc' => 'प्रसिद्ध और उभरते फैशन ब्रांड्स खोजें',
        'option_fashion_game_desc' => 'हमारे इंटरैक्टिव गेम में डिज़ाइन और स्टाइल करें',
        'quote_text' => 'फैशन रोज़मर्रा की हकीकत से जूझने के लिए कवच है।',
        'quote_author' => 'बिल कनिंघम',
        'trending_title' => 'रुझान',
        'trending_subtitle' => 'फैशन की दुनिया को आकार देने वाले नवीनतम स्टाइल्स खोजें',
        'newsletter_title' => 'स्टाइल में रहें',
        'newsletter_subtitle' => 'नवीनतम फैशन अपडेट के लिए हमारे न्यूज़लेटर की सदस्यता लें',
        'newsletter_email_placeholder' => 'अपना ईमेल दर्ज करें',
        'newsletter_submit' => 'सदस्यता लें',
        'newsletter_success' => 'सदस्यता के लिए धन्यवाद!',
        'newsletter_banner' => 'नवीनतम फैशन अपडेट पाएं!',
        'back_to_top' => 'ऊपर जाएं',
        'footer_copyright' => '© 2025 इतिहास, कला और फैशन. सर्वाधिकार सुरक्षित।'
    ]
];

// Helper function
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
    <meta property="og:title" content="HAF - <?php echo htmlspecialchars(get_translation($current_lang, 'nav_fashion')); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars(get_translation($current_lang, 'meta_description')); ?>">
    <meta property="og:image" content="<?php echo $slides[0]; ?>">
    <title>HAF - <?php echo htmlspecialchars(get_translation($current_lang, 'nav_fashion')); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;700&family=Source+Sans+Pro:wght@400;700&family=Libre+Baskerville&family=Noto+Sans+Arabic:wght@400;700&family=Noto+Sans+JP:wght@400;700&family=Noto+Sans+KR:wght@400;700&family=Noto+Sans+SC:wght@400;700&family=Noto+Sans+TC:wght@400;700&family=Noto+Sans+Devanagari:wght@400;700&family=Noto+Sans+Malayalam:wght@400;700&family=Noto+Sans+Thai:wght@400;700&family=Noto+Sans+Vietnamese:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --color-1: #FDF5E6; /* oldlace */
            --color-2: #FAF0E6; /* linen */
            --color-3: #FFF5EE; /* seashell */
            --color-4: #FFFAFA; /* snow */
            --color-5: #FFFAF0; /* floralwhite */
            --color-6: #FFFFF0; /* ivory */
            --text-dark: #333333;
            --fashion-bg: linear-gradient(135deg, #FFF5EE 0%, #FAF0E6 50%, #FDF5E6 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'EB Garamond', serif;
            color: var(--text-dark);
            direction: <?php echo $site_dir; ?>;
            line-height: 1.6;
            min-height: 100vh;
            position: relative;
            background: var(--fashion-bg);
        }

        /* Language-specific font families */
        [lang="ar"] body, [lang="ar"] h1, [lang="ar"] p, [lang="ar"] a {
            font-family: 'Noto Sans Arabic', 'Arial', sans-serif;
        }
        [lang="ja"] body, [lang="ja"] h1, [lang="ja"] p, [lang="ja"] a {
            font-family: 'Noto Sans JP', 'Arial', sans-serif;
        }
        [lang="zh"] body, [lang="zh"] h1, [lang="zh"] p, [lang="zh"] a {
            font-family: 'Noto Sans SC', 'Arial', sans-serif;
        }
        [lang="hi"] body, [lang="hi"] h1, [lang="hi"] p, [lang="hi"] a {
            font-family: 'Noto Sans Devanagari', 'Arial', sans-serif;
        }
        [lang="ms"] body, [lang="ms"] h1, [lang="ms"] p, [lang="ms"] a {
            font-family: 'Noto Sans Malayalam', 'Arial', sans-serif;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        nav {
            background: var(--color-1);
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        nav .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav a {
            color: var(--text-dark);
            text-decoration: none;
            margin: 0 20px;
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 1.2rem;
        }

        nav a:hover {
            color: var(--color-5);
        }

        nav a img:hover {
            opacity: 0.8;
            transition: opacity 0.3s;
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
            font-family: 'Source Sans Pro', sans-serif;
            background: var(--color-3);
            border: 1px solid var(--color-2);
            border-radius: 4px;
            color: var(--text-dark);
            font-size: 1.1rem;
        }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            border: 0;
        }

        .hero {
            position: relative;
            height: 600px;
            color: #fff;
            text-align: center;
            padding: 150px 20px;
            border-bottom: 5px solid var(--color-4);
            overflow: hidden;
        }

        .hero-slideshow {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .hero-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .hero-slide.active {
            opacity: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            background: rgba(0, 0, 0, 0.4);
            padding: 20px;
            border-radius: 8px;
            display: inline-block;
        }

        .hero h1 {
            font-size: 4rem;
            margin-bottom: 25px;
            font-family: 'Libre Baskerville', serif;
            animation: fadeInDown 1s;
        }

        .hero p {
            font-size: 1.8rem;
            margin-bottom: 40px;
        }

        .cta-button {
            display: inline-block;
            padding: 15px 30px;
            background: var(--color-5);
            color: var(--text-dark);
            text-decoration: none;
            border-radius: 6px;
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 1.4rem;
            transition: background 0.3s;
        }

        .cta-button:hover {
            background: var(--color-4);
        }

        .slideshow-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            display: flex;
            gap: 10px;
        }

        .slideshow-dot {
            width: 12px;
            height: 12px;
            background: #fff;
            border-radius: 50%;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.3s, background 0.3s;
        }

        .slideshow-dot.active {
            opacity: 1;
            background: var(--color-5);
        }

        section {
            padding: 80px 0;
            border-bottom: 1px solid var(--color-2);
        }

        section h2 {
            font-size: 3rem;
            text-align: center;
            margin-bottom: 25px;
            color: var(--color-1);
            font-family: 'Libre Baskerville', serif;
        }

        section p.subtitle {
            text-align: center;
            font-size: 1.4rem;
            margin-bottom: 50px;
            color: #555;
        }

        .quote-section {
            text-align: center;
            padding: 40px 20px;
            background: var(--color-4);
            border-radius: 8px;
            margin: 0 auto 50px;
            max-width: 800px;
        }

        .quote-section blockquote {
            font-size: 1.8rem;
            font-style: italic;
            color: var(--text-dark);
            margin-bottom: 20px;
            font-family: 'EB Garamond', serif;
        }

        .quote-section cite {
            font-size: 1.2rem;
            color: #555;
        }

        .options-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .option-card {
            background: var(--color-3);
            border: 2px solid var(--color-2);
            border-radius: 10px;
            padding: 25px;
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .option-card:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .option-card .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
            padding: 20px;
            text-align: center;
            font-size: 1rem;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .option-card:hover .overlay {
            opacity: 1;
        }

        .option-card a {
            color: var(--text-dark);
            text-decoration: none;
            font-size: 1.4rem;
            font-family: 'Source Sans Pro', sans-serif;
            display: block;
            z-index: 1;
            position: relative;
        }

        .option-card a:hover {
            color: var(--color-5);
        }

        .option-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
            margin-bottom: 15px;
        }

        .trending-section {
            padding: 60px 0;
            background: var(--color-6);
        }

        .trending-carousel {
            position: relative;
            max-width: 1000px;
            margin: 0 auto;
            overflow: hidden;
        }

        .trending-slides {
            display: flex;
            transition: transform 0.5s ease;
        }

        .trending-slide {
            flex: 0 0 100%;
            text-align: center;
        }

        .trending-slide img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .trending-slide p {
            font-size: 1.2rem;
            color: var(--text-dark);
        }

        .trending-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }

        .trending-nav button {
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 1.5rem;
            border-radius: 50%;
            transition: background 0.3s;
        }

        .trending-nav button:hover {
            background: rgba(0, 0, 0, 0.8);
        }

        .newsletter-section {
            text-align: center;
            padding: 60px 20px;
            background: var(--color-5);
            margin-top: 50px;
        }

        .newsletter-section form {
            max-width: 500px;
            margin: 0 auto;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .newsletter-section input[type="email"] {
            padding: 12px;
            font-size: 1.1rem;
            border: 1px solid var(--color-2);
            border-radius: 4px;
            flex: 1;
            min-width: 200px;
        }

        .newsletter-section button {
            padding: 12px 24px;
            background: var(--color-1);
            color: var(--text-dark);
            border: none;
            border-radius: 4px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background 0.3s;
        }

        .newsletter-section button:hover {
            background: var(--color-4);
        }

        .newsletter-success {
            color: green;
            margin-top: 20px;
            display: none;
        }

        .newsletter-banner {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: var(--color-1);
            padding: 15px;
            text-align: center;
            z-index: 1000;
            box-shadow: 0 -2px 5px rgba(0,0,0,0.2);
        }

        .newsletter-banner p {
            font-size: 1rem;
            margin-bottom: 10px;
            color: var(--text-dark);
        }

        .newsletter-banner a {
            display: inline-block;
            padding: 8px 16px;
            background: var(--color-5);
            color: var(--text-dark);
            text-decoration: none;
            border-radius: 4px;
            font-size: 1rem;
            transition: background 0.3s;
        }

        .newsletter-banner a:hover {
            background: var(--color-4);
        }

        .newsletter-banner .close-banner {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: var(--text-dark);
        }

        .back-to-top {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--color-5);
            color: var(--text-dark);
            border: none;
            padding: 15px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 1000;
            font-size: 1.2rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            transition: background 0.3s;
        }

        .back-to-top:hover {
            background: var(--color-4);
        }

        footer {
            background: var(--color-5);
            color: var(--text-dark);
            text-align: center;
            padding: 30px 0;
        }

        footer p {
            font-size: 1.1rem;
        }

        .social-links {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .social-links a {
            color: var(--text-dark);
            font-size: 1.5rem;
            transition: color 0.3s;
        }

        .social-links a:hover {
            color: var(--color-4);
        }

        @media (max-width: 768px) {
            .options-grid {
                grid-template-columns: 1fr;
            }

            .hero {
                height: 500px;
            }

            .hero h1 {
                font-size: 3rem;
            }

            .hero p {
                font-size: 1.5rem;
            }

            .cta-button {
                padding: 12px 25px;
                font-size: 1.2rem;
            }

            .section h2 {
                font-size: 2.5rem;
            }

            .section p.subtitle {
                font-size: 1.2rem;
            }

            .option-card a {
                font-size: 1.2rem;
            }

            .quote-section blockquote {
                font-size: 1.5rem;
            }

            .quote-section cite {
                font-size: 1rem;
            }

            .newsletter-banner {
                display: block;
            }

            .trending-slide img {
                max-height: 300px;
            }
        }

        @media (max-width: 480px) {
            nav a {
                margin: 0 10px;
                font-size: 1rem;
            }

            .hero {
                padding: 100px 20px;
                height: 400px;
            }

            .newsletter-section form {
                flex-direction: column;
                align-items: center;
            }

            .newsletter-section input[type="email"] {
                width: 100%;
            }

            .trending-nav button {
                padding: 8px;
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <nav aria-label="Main navigation">
        <div class="container">
            <a href="index.php" style="display:inline-block;margin-right:20px;">
                <img src="images/haf_logo.png" alt="HAF Logo" style="height:50px;vertical-align:middle;" loading="lazy">
            </a>
            <div>
                <a href="history.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_history')); ?></a>
                <a href="art.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_art')); ?></a>
                <a href="fashion.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_fashion')); ?></a>
                <a href="fashion_show.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_fashion_show')); ?></a>
                <a href="fashion_brand.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_fashion_brand')); ?></a>
                <a href="fashion_game.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_fashion_game')); ?></a>
                <a href="php/shop.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_shop')); ?></a>
            </div>
            <form method="POST" class="language-form">
                <label for="lang" class="sr-only">Select Language</label>
                <select name="lang" id="lang" onchange="this.form.submit()">
                    <option value="en" <?php echo $current_lang === 'en' ? 'selected' : ''; ?>>English</option>
                    <option value="zh" <?php echo $current_lang === 'zh' ? 'selected' : ''; ?>>中文</option>
                    <option value="ms" <?php echo $current_lang === 'ms' ? 'selected' : ''; ?>>Malay</option>
                    <option value="es" <?php echo $current_lang === 'es' ? 'selected' : ''; ?>>Spanish</option>
                    <option value="ar" <?php echo $current_lang === 'ar' ? 'selected' : ''; ?>>العربية</option>
                    <option value="fr" <?php echo $current_lang === 'fr' ? 'selected' : ''; ?>>French</option>
                    <option value="ru" <?php echo $current_lang === 'ru' ? 'selected' : ''; ?>>Russian</option>
                    <option value="pt" <?php echo $current_lang === 'pt' ? 'selected' : ''; ?>>Portuguese</option>
                    <option value="de" <?php echo $current_lang === 'de' ? 'selected' : ''; ?>>German</option>
                    <option value="ja" <?php echo $current_lang === 'ja' ? 'selected' : ''; ?>>Japanese</option>
                    <option value="hi" <?php echo $current_lang === 'hi' ? 'selected' : ''; ?>>Hindi</option>
                </select>
            </form>
        </div>
    </nav>

    <section class="hero" role="banner">
        <div class="hero-slideshow">
            <?php foreach ($slides as $index => $slide): ?>
                <div class="hero-slide <?php echo $index === 0 ? 'active' : ''; ?>" style="background-image: url('<?php echo $slide; ?>');" aria-hidden="<?php echo $index !== 0 ? 'true' : 'false'; ?>"></div>
            <?php endforeach; ?>
            <div class="slideshow-dots">
                <?php foreach ($slides as $index => $slide): ?>
                    <span class="slideshow-dot <?php echo $index === 0 ? 'active' : ''; ?>" data-slide="<?php echo $index; ?>"></span>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="hero-content">
            <h1 class="animate__animated animate__fadeInDown"><?php echo htmlspecialchars(get_translation($current_lang, 'hero_title')); ?></h1>
            <p><?php echo htmlspecialchars(get_translation($current_lang, 'hero_subtitle')); ?></p>
            <a href="#options" class="cta-button"><?php echo htmlspecialchars(get_translation($current_lang, 'options_title')); ?></a>
        </div>
    </section>

    <section id="options">
        <div class="container">
            <div class="quote-section">
                <blockquote><?php echo htmlspecialchars(get_translation($current_lang, 'quote_text')); ?></blockquote>
                <cite>— <?php echo htmlspecialchars(get_translation($current_lang, 'quote_author')); ?></cite>
            </div>
            <h2><?php echo htmlspecialchars(get_translation($current_lang, 'options_title')); ?></h2>
            <p class="subtitle"><?php echo htmlspecialchars(get_translation($current_lang, 'options_subtitle')); ?></p>
            <div class="options-grid">
                <div class="option-card">
                    <img src="images/fashion-show-thumb.jpg" alt="Fashion Show" class="option-image" loading="lazy">
                    <a href="fashion_show.php"><?php echo htmlspecialchars(get_translation($current_lang, 'option_fashion_show')); ?></a>
                    <div class="overlay"><?php echo htmlspecialchars(get_translation($current_lang, 'option_fashion_show_desc')); ?></div>
                </div>
                <div class="option-card">
                    <img src="images/fashion-brand-thumb.jpg" alt="Fashion Brands" class="option-image" loading="lazy">
                    <a href="fashion_brand.php"><?php echo htmlspecialchars(get_translation($current_lang, 'option_fashion_brand')); ?></a>
                    <div class="overlay"><?php echo htmlspecialchars(get_translation($current_lang, 'option_fashion_brand_desc')); ?></div>
                </div>
                <div class="option-card">
                    <img src="images/fashion-game-thumb.jpg" alt="Fashion Game" class="option-image" loading="lazy">
                    <a href="fashion_game.php"><?php echo htmlspecialchars(get_translation($current_lang, 'option_fashion_game')); ?></a>
                    <div class="overlay"><?php echo htmlspecialchars(get_translation($current_lang, 'option_fashion_game_desc')); ?></div>
                </div>
            </div>
        </div>
    </section>

    <section class="trending-section">
        <div class="container">
            <h2><?php echo htmlspecialchars(get_translation($current_lang, 'trending_title')); ?></h2>
            <p class="subtitle"><?php echo htmlspecialchars(get_translation($current_lang, 'trending_subtitle')); ?></p>
            <div class="trending-carousel">
                <div class="trending-slides">
                    <div class="trending-slide">
                        <img src="images/trending-look-1.jpg" alt="Bold Street Style" loading="lazy">
                        <p><?php echo $current_lang === 'zh' ? '大胆街头风格' : ($current_lang === 'ar' ? 'أسلوب الشارع الجريء' : 'Bold Street Style'); ?></p>
                    </div>
                    <div class="trending-slide">
                        <img src="images/trending-look-2.jpg" alt="Elegant Evening Wear" loading="lazy">
                        <p><?php echo $current_lang === 'zh' ? '优雅晚装' : ($current_lang === 'ar' ? 'ملابس السهرة الأنيقة' : 'Elegant Evening Wear'); ?></p>
                    </div>
                    <div class="trending-slide">
                        <img src="images/trending-look-3.jpg" alt="Minimalist Chic" loading="lazy">
                        <p><?php echo $current_lang === 'zh' ? '极简时尚' : ($current_lang === 'ar' ? 'أناقة بسيطة' : 'Minimalist Chic'); ?></p>
                    </div>
                </div>
                <div class="trending-nav">
                    <button class="prev-slide" aria-label="Previous trending look">&#10094;</button>
                    <button class="next-slide" aria-label="Next trending look">&#10095;</button>
                </div>
            </div>
        </div>
    </section>

    <section class="newsletter-section">
        <div class="container">
            <h2><?php echo htmlspecialchars(get_translation($current_lang, 'newsletter_title')); ?></h2>
            <p class="subtitle"><?php echo htmlspecialchars(get_translation($current_lang, 'newsletter_subtitle')); ?></p>
            <form id="newsletter-form" action="subscribe.php" method="POST">
                <input type="email" name="email" placeholder="<?php echo htmlspecialchars(get_translation($current_lang, 'newsletter_email_placeholder')); ?>" required aria-label="Email for newsletter">
                <button type="submit"><?php echo htmlspecialchars(get_translation($current_lang, 'newsletter_submit')); ?></button>
            </form>
            <p class="newsletter-success" id="newsletter-success"><?php echo htmlspecialchars(get_translation($current_lang, 'newsletter_success')); ?></p>
        </div>
    </section>

    <div class="newsletter-banner">
        <button class="close-banner" aria-label="Close banner">&times;</button>
        <p><?php echo htmlspecialchars(get_translation($current_lang, 'newsletter_banner')); ?></p>
        <a href="#newsletter-form" class="cta-button"><?php echo htmlspecialchars(get_translation($current_lang, 'newsletter_submit')); ?></a>
    </div>

    <button class="back-to-top" aria-label="<?php echo htmlspecialchars(get_translation($current_lang, 'back_to_top')); ?>">
        <i class="fas fa-arrow-up"></i>
    </button>

    <footer>
        <div class="container">
            <p><?php echo htmlspecialchars(get_translation($current_lang, 'footer_copyright')); ?></p>
            <div class="social-links">
                <a href="https://x.com/haf_fashion" target="_blank" aria-label="Follow HAF on X"><i class="fab fa-x-twitter"></i></a>
                <a href="https://instagram.com/haf_fashion" target="_blank" aria-label="Follow HAF on Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://facebook.com/haf_fashion" target="_blank" aria-label="Follow HAF on Facebook"><i class="fab fa-facebook-f"></i></a>
            </div>
        </div>
    </footer>

    <script>
        // Hero slideshow
        const heroSlides = document.querySelectorAll('.hero-slide');
        const heroDots = document.querySelectorAll('.slideshow-dot');
        let currentHeroSlide = 0;

        function showHeroSlide(index) {
            heroSlides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
                slide.setAttribute('aria-hidden', i !== index);
            });
            heroDots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
            currentHeroSlide = index;
        }

        heroDots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showHeroSlide(index);
            });
        });

        setInterval(() => {
            currentHeroSlide = (currentHeroSlide + 1) % heroSlides.length;
            showHeroSlide(currentHeroSlide);
        }, 5000);

        // Trending carousel
        const trendingSlides = document.querySelector('.trending-slides');
        const trendingSlideElements = document.querySelectorAll('.trending-slide');
        const prevButton = document.querySelector('.prev-slide');
        const nextButton = document.querySelector('.next-slide');
        let currentTrendingSlide = 0;

        function updateTrendingSlide() {
            trendingSlides.style.transform = `translateX(-${currentTrendingSlide * 100}%)`;
        }

        prevButton.addEventListener('click', () => {
            currentTrendingSlide = (currentTrendingSlide - 1 + trendingSlideElements.length) % trendingSlideElements.length;
            updateTrendingSlide();
        });

        nextButton.addEventListener('click', () => {
            currentTrendingSlide = (currentTrendingSlide + 1) % trendingSlideElements.length;
            updateTrendingSlide();
        });

        // Newsletter form
        document.getElementById('newsletter-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const successMessage = document.getElementById('newsletter-success');
            successMessage.style.display = 'block';
            this.reset();
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 3000);
        });

        // Newsletter banner
        document.querySelector('.close-banner').addEventListener('click', () => {
            document.querySelector('.newsletter-banner').style.display = 'none';
        });

        // Back to top
        const backToTop = document.querySelector('.back-to-top');
        window.addEventListener('scroll', () => {
            backToTop.style.display = window.scrollY > 300 ? 'block' : 'none';
        });

        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Animations
        document.querySelectorAll('.animate__animated').forEach(el => {
            el.classList.add('animate__fadeIn');
        });
    </script>
</body>
</html>