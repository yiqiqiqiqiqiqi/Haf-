<?php
session_start();

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'zh';
}

// Handle language switching
if (isset($_POST['lang'])) {
    $valid_langs = ['en', 'zh', 'es', 'ar', 'ru', 'pt', 'de', 'ja', 'fr', 'hi', 'ms'];
    $_SESSION['lang'] = in_array($_POST['lang'], $valid_langs) ? $_POST['lang'] : 'zh';
}

$current_lang = $_SESSION['lang'];

// Hero slideshow images
$hero_slides = [
    'en' => ['images/art-hero-en-1.jpg', 'images/art-hero-en-2.jpg', 'images/art-hero-en-3.jpg'],
    'zh' => ['images/art-hero-zh-1.jpg', 'images/art-hero-zh-2.jpg', 'images/art-hero-zh-3.jpg'],
    'es' => ['images/art-hero-es-1.jpg', 'images/art-hero-es-2.jpg', 'images/art-hero-es-3.jpg'],
    'ar' => ['images/art-hero-ar-1.jpg', 'images/art-hero-ar-2.jpg', 'images/art-hero-ar-3.jpg'],
    'ru' => ['images/art-hero-ru-1.jpg', 'images/art-hero-ru-2.jpg', 'images/art-hero-ru-3.jpg'],
    'pt' => ['images/art-hero-pt-1.jpg', 'images/art-hero-pt-2.jpg', 'images/art-hero-pt-3.jpg'],
    'de' => ['images/art-hero-de-1.jpg', 'images/art-hero-de-2.jpg', 'images/art-hero-de-3.jpg'],
    'ja' => ['images/art-hero-ja-1.jpg', 'images/art-hero-ja-2.jpg', 'images/art-hero-ja-3.jpg'],
    'fr' => ['images/art-hero-fr-1.jpg', 'images/art-hero-fr-2.jpg', 'images/art-hero-fr-3.jpg'],
    'hi' => ['images/art-hero-hi-1.jpg', 'images/art-hero-hi-2.jpg', 'images/art-hero-hi-3.jpg'],
    'ms' => ['images/art-hero-ms-1.jpg', 'images/art-hero-ms-2.jpg', 'images/art-hero-ms-3.jpg']
];
$default_slides = ['images/art-hero-1.jpg', 'images/art-hero-2.jpg', 'images/art-hero-3.jpg'];
$slides = isset($hero_slides[$current_lang]) ? $hero_slides[$current_lang] : $default_slides;

// Translation array
$translations = [
    'en' => [
        'meta_description' => 'Immerse yourself in the world of art with HAF, where creativity knows no bounds',
        'hero_title' => 'Canvas of Creativity',
        'hero_subtitle' => 'Explore the vibrant expressions of art with HAF',
        'nav_history' => 'History',
        'nav_art' => 'Art',
        'nav_world_paintings' => 'World Paintings',
        'nav_famous_artists' => 'Famous Artists',
        'nav_art_game' => 'Art Game',
        'nav_fashion' => 'Fashion',
        'nav_shop' => 'Shop',
        'options_title' => 'Explore Art',
        'options_subtitle' => 'Choose a path to dive into the world of creativity',
        'option_world_paintings' => 'Discover World Paintings',
        'option_famous_artists' => 'Explore Famous Artists',
        'option_art_game' => 'Play Art Game',
        'option_world_paintings_desc' => 'Journey through iconic masterpieces from around the globe',
        'option_famous_artists_desc' => 'Learn about the visionaries who shaped art history',
        'option_art_game_desc' => 'Unleash your creativity with our interactive art game',
        'quote_text' => 'Every artist dips his brush in his own soul, and paints his own nature into his pictures.',
        'quote_author' => 'Henry Ward Beecher',
        'gallery_title' => 'Trending Artworks',
        'gallery_subtitle' => 'Discover masterpieces shaping the art world',
        'video_title' => 'Virtual Gallery Tour',
        'video_subtitle' => 'Experience a guided tour through world-class museums',
        'canvas_title' => 'Create Your Art',
        'canvas_subtitle' => 'Draw and share your own masterpiece',
        'canvas_color' => 'Select Color',
        'canvas_size' => 'Brush Size',
        'canvas_clear' => 'Clear Canvas',
        'canvas_save' => 'Save Artwork',
        'canvas_share' => 'Share Artwork',
        'quiz_title' => 'Find Your Art Style',
        'quiz_subtitle' => 'Take our quiz to discover your artistic personality',
        'quiz_question_1' => 'What inspires you most?',
        'quiz_option_1a' => 'Nature',
        'quiz_option_1b' => 'Emotions',
        'quiz_option_1c' => 'Abstract Concepts',
        'quiz_question_2' => 'Preferred medium?',
        'quiz_option_2a' => 'Oil Painting',
        'quiz_option_2b' => 'Watercolor',
        'quiz_option_2c' => 'Digital Art',
        'quiz_submit' => 'Get Results',
        'quiz_result_impressionism' => 'You\'re an Impressionist!',
        'quiz_result_surrealism' => 'You\'re a Surrealist!',
        'quiz_result_abstract' => 'You\'re an Abstract Artist!',
        'artist_title' => 'Artist Spotlight',
        'artist_subtitle' => 'Celebrating the visionaries of art',
        'artist_name' => 'Vincent van Gogh',
        'artist_bio' => 'A Dutch Post-Impressionist painter whose work had a far-reaching influence on 20th-century art.',
        'newsletter_title' => 'Stay Inspired',
        'newsletter_subtitle' => 'Subscribe for the latest art updates and exhibitions',
        'newsletter_email_placeholder' => 'Enter your email',
        'newsletter_submit' => 'Subscribe',
        'newsletter_success' => 'Thank you for subscribing!',
        'newsletter_banner' => 'Join our art community for exclusive updates!',
        'news_ticker' => 'Latest: Louvre hosts new Impressionist exhibit | Van Gogh\'s Starry Night on tour | Digital art auction breaks records',
        'theme_toggle' => 'Toggle Theme',
        'cookie_consent' => 'We use cookies to enhance your experience. Accept to continue.',
        'cookie_accept' => 'Accept',
        'back_to_top' => 'Back to Top',
        'footer_copyright' => '© 2025 History, Art & Fashion. All rights reserved.'
    ],
    'zh' => [
        'meta_description' => '通过 HAF 沉浸在艺术世界，创意无极限',
        'hero_title' => '创意画布',
        'hero_subtitle' => '与 HAF 一起探索艺术的生动表达',
        'nav_history' => '历史',
        'nav_art' => '艺术',
        'nav_world_paintings' => '世界名画',
        'nav_famous_artists' => '著名艺术家',
        'nav_art_game' => '艺术游戏',
        'nav_fashion' => '时尚',
        'nav_shop' => '商店',
        'options_title' => '探索艺术',
        'options_subtitle' => '选择一条路径深入创意世界',
        'option_world_paintings' => '发现世界名画',
        'option_famous_artists' => '探索著名艺术家',
        'option_art_game' => '玩艺术游戏',
        'option_world_paintings_desc' => '游览全球标志性杰作',
        'option_famous_artists_desc' => '了解塑造艺术史的远见者',
        'option_art_game_desc' => '通过互动艺术游戏释放你的创造力',
        'quote_text' => '每位艺术家都将画笔浸入自己的灵魂，在画作中描绘自己的本性。',
        'quote_author' => '亨利·沃德·比彻',
        'gallery_title' => '流行艺术品',
        'gallery_subtitle' => '发现塑造艺术世界的杰作',
        'video_title' => '虚拟画廊之旅',
        'video_subtitle' => '体验世界级博物馆的导览游',
        'canvas_title' => '创作你的艺术',
        'canvas_subtitle' => '绘制并分享你的杰作',
        'canvas_color' => '选择颜色',
        'canvas_size' => '画笔大小',
        'canvas_clear' => '清除画布',
        'canvas_save' => '保存作品',
        'canvas_share' => '分享作品',
        'quiz_title' => '找到你的艺术风格',
        'quiz_subtitle' => '参加我们的测验，发现你的艺术个性',
        'quiz_question_1' => '什么最能激发你的灵感？',
        'quiz_option_1a' => '自然',
        'quiz_option_1b' => '情感',
        'quiz_option_1c' => '抽象概念',
        'quiz_question_2' => '偏好的媒介？',
        'quiz_option_2a' => '油画',
        'quiz_option_2b' => '水彩',
        'quiz_option_2c' => '数字艺术',
        'quiz_submit' => '查看结果',
        'quiz_result_impressionism' => '你是印象派艺术家！',
        'quiz_result_surrealism' => '你是超现实主义艺术家！',
        'quiz_result_abstract' => '你是抽象艺术家！',
        'artist_title' => '艺术家聚焦',
        'artist_subtitle' => '致敬艺术的远见者',
        'artist_name' => '文森特·梵高',
        'artist_bio' => '荷兰后印象派画家，其作品对20世纪艺术产生了深远影响。',
        'newsletter_title' => '保持灵感',
        'newsletter_subtitle' => '订阅以获取最新艺术动态和展览信息',
        'newsletter_email_placeholder' => '输入您的邮箱',
        'newsletter_submit' => '订阅',
        'newsletter_success' => '感谢您的订阅！',
        'newsletter_banner' => '加入我们的艺术社区，获取独家动态！',
        'news_ticker' => '最新：卢浮宫举办新的印象派展览 | 梵高《星空》巡展 | 数字艺术拍卖创纪录',
        'theme_toggle' => '切换主题',
        'cookie_consent' => '我们使用 cookies 提升您的体验。接受以继续。',
        'cookie_accept' => '接受',
        'back_to_top' => '返回顶部',
        'footer_copyright' => '© 2025 历史、艺术与时尚. 保留所有权利。'
    ],
    'es' => [
        'meta_description' => 'Sumérgete en el mundo del arte con HAF, donde la creatividad no tiene límites',
        'hero_title' => 'Lienzo de Creatividad',
        'hero_subtitle' => 'Explora las vibrantes expresiones del arte con HAF',
        'nav_history' => 'Historia',
        'nav_art' => 'Arte',
        'nav_world_paintings' => 'Pinturas del Mundo',
        'nav_famous_artists' => 'Artistas Famosos',
        'nav_art_game' => 'Juego de Arte',
        'nav_fashion' => 'Moda',
        'nav_shop' => 'Tienda',
        'options_title' => 'Explora el Arte',
        'options_subtitle' => 'Elige un camino para sumergirte en el mundo de la creatividad',
        'option_world_paintings' => 'Descubre Pinturas del Mundo',
        'option_famous_artists' => 'Explora Artistas Famosos',
        'option_art_game' => 'Juega al Juego de Arte',
        'option_world_paintings_desc' => 'Viaja a través de obras maestras icónicas de todo el mundo',
        'option_famous_artists_desc' => 'Conoce a los visionarios que dieron forma a la historia del arte',
        'option_art_game_desc' => 'Desata tu creatividad con nuestro juego de arte interactivo',
        'quote_text' => 'Cada artista sumerge su pincel en su propia alma y pinta su propia naturaleza en sus cuadros.',
        'quote_author' => 'Henry Ward Beecher',
        'gallery_title' => 'Obras de Arte en Tendencia',
        'gallery_subtitle' => 'Descubre obras maestras que están moldeando el mundo del arte',
        'video_title' => 'Recorrido Virtual por la Galería',
        'video_subtitle' => 'Experimenta un recorrido guiado por museos de clase mundial',
        'canvas_title' => 'Crea Tu Arte',
        'canvas_subtitle' => 'Dibuja y comparte tu propia obra maestra',
        'canvas_color' => 'Seleccionar Color',
        'canvas_size' => 'Tamaño del Pincel',
        'canvas_clear' => 'Limpiar Lienzo',
        'canvas_save' => 'Guardar Obra',
        'canvas_share' => 'Compartir Obra',
        'quiz_title' => 'Encuentra Tu Estilo Artístico',
        'quiz_subtitle' => 'Realiza nuestro cuestionario para descubrir tu personalidad artística',
        'quiz_question_1' => '¿Qué te inspira más?',
        'quiz_option_1a' => 'Naturaleza',
        'quiz_option_1b' => 'Emociones',
        'quiz_option_1c' => 'Conceptos Abstractos',
        'quiz_question_2' => '¿Medio preferido?',
        'quiz_option_2a' => 'Pintura al Óleo',
        'quiz_option_2b' => 'Acuarela',
        'quiz_option_2c' => 'Arte Digital',
        'quiz_submit' => 'Obtener Resultados',
        'quiz_result_impressionism' => '¡Eres un Impresionista!',
        'quiz_result_surrealism' => '¡Eres un Surrealista!',
        'quiz_result_abstract' => '¡Eres un Artista Abstracto!',
        'artist_title' => 'Destacado del Artista',
        'artist_subtitle' => 'Celebrando a los visionarios del arte',
        'artist_name' => 'Vincent van Gogh',
        'artist_bio' => 'Un pintor postimpresionista holandés cuyo trabajo tuvo una influencia de gran alcance en el arte del siglo XX.',
        'newsletter_title' => 'Mantente Inspirado',
        'newsletter_subtitle' => 'Suscríbete para recibir las últimas actualizaciones y exposiciones de arte',
        'newsletter_email_placeholder' => 'Ingresa tu correo electrónico',
        'newsletter_submit' => 'Suscribirse',
        'newsletter_success' => '¡Gracias por suscribirte!',
        'newsletter_banner' => '¡Únete a nuestra comunidad de arte para recibir actualizaciones exclusivas!',
        'news_ticker' => 'Últimas noticias: El Louvre organiza una nueva exposición impresionista | La Noche Estrellada de Van Gogh en gira | Subasta de arte digital rompe récords',
        'theme_toggle' => 'Cambiar Tema',
        'cookie_consent' => 'Usamos cookies para mejorar tu experiencia. Acepta para continuar.',
        'cookie_accept' => 'Aceptar',
        'back_to_top' => 'Volver Arriba',
        'footer_copyright' => '© 2025 Historia, Arte y Moda. Todos los derechos reservados.'
    ],
    'ar' => [
        'meta_description' => 'انغمس في عالم الفن مع HAF، حيث لا حدود للإبداع',
        'hero_title' => 'لوحة الإبداع',
        'hero_subtitle' => 'استكشف التعبيرات النابضة بالحياة للفن مع HAF',
        'nav_history' => 'تاريخ',
        'nav_art' => 'فن',
        'nav_world_paintings' => 'لوحات عالمية',
        'nav_famous_artists' => 'فنانون مشهورون',
        'nav_art_game' => 'لعبة فنية',
        'nav_fashion' => 'موضة',
        'nav_shop' => 'متجر',
        'options_title' => 'استكشف الفن',
        'options_subtitle' => 'اختر مسارًا للغوص في عالم الإبداع',
        'option_world_paintings' => 'اكتشف اللوحات العالمية',
        'option_famous_artists' => 'استكشف الفنانين المشهورين',
        'option_art_game' => 'العب لعبة فنية',
        'option_world_paintings_desc' => 'سافر عبر الأعمال الفنية الرمزية من جميع أنحاء العالم',
        'option_famous_artists_desc' => 'تعرف على الرؤى التي شكلت تاريخ الفن',
        'option_art_game_desc' => 'أطلق العنان لإبداعك مع لعبتنا الفنية التفاعلية',
        'quote_text' => 'كل فنان يغمس فرشاته في روحه، ويرسم طباعه في لوحاته.',
        'quote_author' => 'هنري وارد بيتشر',
        'gallery_title' => 'أعمال فنية رائجة',
        'gallery_subtitle' => 'اكتشف الأعمال الفنية التي تشكل عالم الفن',
        'video_title' => 'جولة افتراضية في المعرض',
        'video_subtitle' => 'استمتع بجولة إرشادية عبر المتاحف العالمية',
        'canvas_title' => 'اصنع فنك',
        'canvas_subtitle' => 'ارسم وشارك تحفتك الخاصة',
        'canvas_color' => 'اختر اللون',
        'canvas_size' => 'حجم الفرشاة',
        'canvas_clear' => 'مسح اللوحة',
        'canvas_save' => 'حفظ العمل الفني',
        'canvas_share' => 'مشاركة العمل الفني',
        'quiz_title' => 'اعثر على أسلوبك الفني',
        'quiz_subtitle' => 'شارك في اختبارنا لاكتشاف شخصيتك الفنية',
        'quiz_question_1' => 'ما الذي يلهمك أكثر؟',
        'quiz_option_1a' => 'الطبيعة',
        'quiz_option_1b' => 'العواطف',
        'quiz_option_1c' => 'المفاهيم المجردة',
        'quiz_question_2' => 'الوسيط المفضل؟',
        'quiz_option_2a' => 'الطلاء الزيتي',
        'quiz_option_2b' => 'الألوان المائية',
        'quiz_option_2c' => 'الفن الرقمي',
        'quiz_submit' => 'احصل على النتائج',
        'quiz_result_impressionism' => 'أنت انطباعي!',
        'quiz_result_surrealism' => 'أنت سريالي!',
        'quiz_result_abstract' => 'أنت فنان مجرد!',
        'artist_title' => 'أضواء على الفنان',
        'artist_subtitle' => 'الاحتفال بالرؤى الفنية',
        'artist_name' => 'فنسنت فان جوخ',
        'artist_bio' => 'رسام هولندي ما بعد الانطباعية، كان لأعماله تأثير بعيد المدى على فن القرن العشرين.',
        'newsletter_title' => 'ابقَ ملهمًا',
        'newsletter_subtitle' => 'اشترك للحصول على آخر تحديثات الفن والمعارض',
        'newsletter_email_placeholder' => 'أدخل بريدك الإلكتروني',
        'newsletter_submit' => 'اشترك',
        'newsletter_success' => 'شكرًا لاشتراكك!',
        'newsletter_banner' => 'انضم إلى مجتمعنا الفني للحصول على تحديثات حصرية!',
        'news_ticker' => 'آخر الأخبار: اللوفر يستضيف معرضًا انطباعيًا جديدًا | جولة "ليلة النجوم" لفان جوخ | مزاد فني رقمي يكسر الأرقام القياسية',
        'theme_toggle' => 'تبديل الثيم',
        'cookie_consent' => 'نستخدم ملفات تعريف الارتباط لتحسين تجربتك. قبول للمتابعة.',
        'cookie_accept' => 'قبول',
        'back_to_top' => 'عودة إلى الأعلى',
        'footer_copyright' => '© 2025 التاريخ، الفن والموضة. جميع الحقوق محفوظة.'
    ],
    'ru' => [
        'meta_description' => 'Погрузитесь в мир искусства с HAF, где творчество не знает границ',
        'hero_title' => 'Холст Творчества',
        'hero_subtitle' => 'Исследуйте яркие выражения искусства с HAF',
        'nav_history' => 'История',
        'nav_art' => 'Искусство',
        'nav_world_paintings' => 'Мировые Картины',
        'nav_famous_artists' => 'Известные Художники',
        'nav_art_game' => 'Игра в Искусство',
        'nav_fashion' => 'Мода',
        'nav_shop' => 'Магазин',
        'options_title' => 'Исследуйте Искусство',
        'options_subtitle' => 'Выберите путь, чтобы погрузиться в мир творчества',
        'option_world_paintings' => 'Откройте Мировые Картины',
        'option_famous_artists' => 'Исследуйте Известных Художников',
        'option_art_game' => 'Играйте в Игру в Искусство',
        'option_world_paintings_desc' => 'Путешествуйте по культовым шедеврам со всего мира',
        'option_famous_artists_desc' => 'Узнайте о провидцах, которые сформировали историю искусства',
        'option_art_game_desc' => 'Раскройте свой творческий потенциал с нашей интерактивной игрой в искусство',
        'quote_text' => 'Каждый художник окунает кисть в свою душу и рисует свою природу в своих картинах.',
        'quote_author' => 'Генри Уорд Бичер',
        'gallery_title' => 'Популярные Произведения Искусства',
        'gallery_subtitle' => 'Откройте шедевры, формирующие мир искусства',
        'video_title' => 'Виртуальный Тур по Галерее',
        'video_subtitle' => 'Пройдите экскурсию с гидом по музеям мирового класса',
        'canvas_title' => 'Создайте Свое Искусство',
        'canvas_subtitle' => 'Рисуйте и делитесь своим шедевром',
        'canvas_color' => 'Выберите Цвет',
        'canvas_size' => 'Размер Кисти',
        'canvas_clear' => 'Очистить Холст',
        'canvas_save' => 'Сохранить Произведение',
        'canvas_share' => 'Поделиться Произведением',
        'quiz_title' => 'Найдите Свой Художественный Стиль',
        'quiz_subtitle' => 'Пройдите наш тест, чтобы узнать вашу художественную личность',
        'quiz_question_1' => 'Что вас больше всего вдохновляет?',
        'quiz_option_1a' => 'Природа',
        'quiz_option_1b' => 'Эмоции',
        'quiz_option_1c' => 'Абстрактные Концепции',
        'quiz_question_2' => 'Предпочитаемый носитель?',
        'quiz_option_2a' => 'Масляная Живопись',
        'quiz_option_2b' => 'Акварель',
        'quiz_option_2c' => 'Цифровое Искусство',
        'quiz_submit' => 'Получить Результаты',
        'quiz_result_impressionism' => 'Вы Импрессионист!',
        'quiz_result_surrealism' => 'Вы Сюрреалист!',
        'quiz_result_abstract' => 'Вы Абстрактный Художник!',
        'artist_title' => 'В центре внимания Художник',
        'artist_subtitle' => 'Празднование провидцев искусства',
        'artist_name' => 'Винсент ван Гог',
        'artist_bio' => 'Голландский художник-постимпрессионист, чьи работы оказали огромное влияние на искусство 20-го века.',
        'newsletter_title' => 'Оставайтесь Вдохновленными',
        'newsletter_subtitle' => 'Подпишитесь на последние новости искусства и выставки',
        'newsletter_email_placeholder' => 'Введите ваш email',
        'newsletter_submit' => 'Подписаться',
        'newsletter_success' => 'Спасибо за подписку!',
        'newsletter_banner' => 'Присоединяйтесь к нашему художественному сообществу для эксклюзивных обновлений!',
        'news_ticker' => 'Последние новости: Лувр проводит новую выставку импрессионистов | "Звездная ночь" Ван Гога в туре | Аукцион цифрового искусства побил рекорды',
        'theme_toggle' => 'Переключить Тему',
        'cookie_consent' => 'Мы используем cookies для улучшения вашего опыта. Примите, чтобы продолжить.',
        'cookie_accept' => 'Принять',
        'back_to_top' => 'Вернуться Наверх',
        'footer_copyright' => '© 2025 История, Искусство и Мода. Все права защищены.'
    ],
    'pt' => [
        'meta_description' => 'Mergulhe no mundo da arte com a HAF, onde a criatividade não tem limites',
        'hero_title' => 'Tela de Criatividade',
        'hero_subtitle' => 'Explore as expressões vibrantes da arte com a HAF',
        'nav_history' => 'História',
        'nav_art' => 'Arte',
        'nav_world_paintings' => 'Pinturas do Mundo',
        'nav_famous_artists' => 'Artistas Famosos',
        'nav_art_game' => 'Jogo de Arte',
        'nav_fashion' => 'Moda',
        'nav_shop' => 'Loja',
        'options_title' => 'Explore a Arte',
        'options_subtitle' => 'Escolha um caminho para mergulhar no mundo da criatividade',
        'option_world_paintings' => 'Descubra Pinturas do Mundo',
        'option_famous_artists' => 'Explore Artistas Famosos',
        'option_art_game' => 'Jogue o Jogo de Arte',
        'option_world_paintings_desc' => 'Viaje por obras-primas icônicas de todo o mundo',
        'option_famous_artists_desc' => 'Conheça os visionários que moldaram a história da arte',
        'option_art_game_desc' => 'Liberte sua criatividade com nosso jogo de arte interativo',
        'quote_text' => 'Cada artista mergulha seu pincel em sua própria alma e pinta sua própria natureza em suas pinturas.',
        'quote_author' => 'Henry Ward Beecher',
        'gallery_title' => 'Obras de Arte em Destaque',
        'gallery_subtitle' => 'Descubra obras-primas que estão moldando o mundo da arte',
        'video_title' => 'Tour Virtual pela Galeria',
        'video_subtitle' => 'Experimente um tour guiado por museus de classe mundial',
        'canvas_title' => 'Crie Sua Arte',
        'canvas_subtitle' => 'Desenhe e compartilhe sua própria obra-prima',
        'canvas_color' => 'Selecionar Cor',
        'canvas_size' => 'Tamanho do Pincel',
        'canvas_clear' => 'Limpar Tela',
        'canvas_save' => 'Salvar Obra',
        'canvas_share' => 'Compartilhar Obra',
        'quiz_title' => 'Encontre Seu Estilo Artístico',
        'quiz_subtitle' => 'Faça nosso quiz para descobrir sua personalidade artística',
        'quiz_question_1' => 'O que mais te inspira?',
        'quiz_option_1a' => 'Natureza',
        'quiz_option_1b' => 'Emoções',
        'quiz_option_1c' => 'Conceitos Abstratos',
        'quiz_question_2' => 'Meio preferido?',
        'quiz_option_2a' => 'Pintura a Óleo',
        'quiz_option_2b' => 'Aquarela',
        'quiz_option_2c' => 'Arte Digital',
        'quiz_submit' => 'Obter Resultados',
        'quiz_result_impressionism' => 'Você é um Impressionista!',
        'quiz_result_surrealism' => 'Você é um Surrealista!',
        'quiz_result_abstract' => 'Você é um Artista Abstrato!',
        'artist_title' => 'Destaque do Artista',
        'artist_subtitle' => 'Celebrando os visionários da arte',
        'artist_name' => 'Vincent van Gogh',
        'artist_bio' => 'Um pintor pós-impressionista holandês cujo trabalho teve uma influência de longo alcance na arte do século XX.',
        'newsletter_title' => 'Mantenha-se Inspirado',
        'newsletter_subtitle' => 'Inscreva-se para receber as últimas atualizações e exposições de arte',
        'newsletter_email_placeholder' => 'Digite seu email',
        'newsletter_submit' => 'Inscrever-se',
        'newsletter_success' => 'Obrigado por se inscrever!',
        'newsletter_banner' => 'Junte-se à nossa comunidade de arte para atualizações exclusivas!',
        'news_ticker' => 'Últimas notícias: Louvre realiza nova exposição impressionista | A Noite Estrelada de Van Gogh em turnê | Leilão de arte digital quebra recordes',
        'theme_toggle' => 'Alternar Tema',
        'cookie_consent' => 'Usamos cookies para melhorar sua experiência. Aceite para continuar.',
        'cookie_accept' => 'Aceitar',
        'back_to_top' => 'Voltar ao Topo',
        'footer_copyright' => '© 2025 História, Arte e Moda. Todos os direitos reservados.'
    ],
    'de' => [
        'meta_description' => 'Tauchen Sie ein in die Welt der Kunst mit HAF, wo Kreativität keine Grenzen kennt',
        'hero_title' => 'Leinwand der Kreativität',
        'hero_subtitle' => 'Entdecken Sie die lebendigen Ausdrucksformen der Kunst mit HAF',
        'nav_history' => 'Geschichte',
        'nav_art' => 'Kunst',
        'nav_world_paintings' => 'Weltgemälde',
        'nav_famous_artists' => 'Berühmte Künstler',
        'nav_art_game' => 'Kunstspiel',
        'nav_fashion' => 'Mode',
        'nav_shop' => 'Shop',
        'options_title' => 'Kunst Entdecken',
        'options_subtitle' => 'Wählen Sie einen Weg, um in die Welt der Kreativität einzutauchen',
        'option_world_paintings' => 'Entdecken Sie Weltgemälde',
        'option_famous_artists' => 'Erkunden Sie berühmte Künstler',
        'option_art_game' => 'Spielen Sie das Kunstspiel',
        'option_world_paintings_desc' => 'Reisen Sie durch ikonische Meisterwerke aus der ganzen Welt',
        'option_famous_artists_desc' => 'Lernen Sie die Visionäre kennen, die die Kunstgeschichte geprägt haben',
        'option_art_game_desc' => 'Entfesseln Sie Ihre Kreativität mit unserem interaktiven Kunstspiel',
        'quote_text' => 'Jeder Künstler taucht seinen Pinsel in seine eigene Seele und malt seine eigene Natur in seine Bilder.',
        'quote_author' => 'Henry Ward Beecher',
        'gallery_title' => 'Trendende Kunstwerke',
        'gallery_subtitle' => 'Entdecken Sie Meisterwerke, die die Kunstwelt prägen',
        'video_title' => 'Virtueller Galerie-Rundgang',
        'video_subtitle' => 'Erleben Sie eine geführte Tour durch erstklassige Museen',
        'canvas_title' => 'Erstellen Sie Ihre Kunst',
        'canvas_subtitle' => 'Zeichnen und teilen Sie Ihr eigenes Meisterwerk',
        'canvas_color' => 'Farbe auswählen',
        'canvas_size' => 'Pinselgröße',
        'canvas_clear' => 'Leinwand löschen',
        'canvas_save' => 'Kunstwerk speichern',
        'canvas_share' => 'Kunstwerk teilen',
        'quiz_title' => 'Finden Sie Ihren Kunststil',
        'quiz_subtitle' => 'Machen Sie unser Quiz, um Ihre künstlerische Persönlichkeit zu entdecken',
        'quiz_question_1' => 'Was inspiriert Sie am meisten?',
        'quiz_option_1a' => 'Natur',
        'quiz_option_1b' => 'Emotionen',
        'quiz_option_1c' => 'Abstrakte Konzepte',
        'quiz_question_2' => 'Bevorzugtes Medium?',
        'quiz_option_2a' => 'Ölmalerei',
        'quiz_option_2b' => 'Aquarell',
        'quiz_option_2c' => 'Digitale Kunst',
        'quiz_submit' => 'Ergebnisse anzeigen',
        'quiz_result_impressionism' => 'Sie sind ein Impressionist!',
        'quiz_result_surrealism' => 'Sie sind ein Surrealist!',
        'quiz_result_abstract' => 'Sie sind ein abstrakter Künstler!',
        'artist_title' => 'Künstler im Rampenlicht',
        'artist_subtitle' => 'Feiern der Visionäre der Kunst',
        'artist_name' => 'Vincent van Gogh',
        'artist_bio' => 'Ein niederländischer Post-Impressionist, dessen Werk einen weitreichenden Einfluss auf die Kunst des 20. Jahrhunderts hatte.',
        'newsletter_title' => 'Bleiben Sie inspiriert',
        'newsletter_subtitle' => 'Abonnieren Sie die neuesten Kunst-Updates und Ausstellungen',
        'newsletter_email_placeholder' => 'Geben Sie Ihre E-Mail ein',
        'newsletter_submit' => 'Abonnieren',
        'newsletter_success' => 'Vielen Dank für Ihr Abonnement!',
        'newsletter_banner' => 'Treten Sie unserer Kunstgemeinschaft für exklusive Updates bei!',
        'news_ticker' => 'Neueste Nachrichten: Louvre veranstaltet neue Impressionisten-Ausstellung | Van Goghs Sternennacht auf Tour | Digitale Kunstauktion bricht Rekorde',
        'theme_toggle' => 'Thema wechseln',
        'cookie_consent' => 'Wir verwenden Cookies, um Ihr Erlebnis zu verbessern. Akzeptieren Sie, um fortzufahren.',
        'cookie_accept' => 'Akzeptieren',
        'back_to_top' => 'Zurück nach oben',
        'footer_copyright' => '© 2025 Geschichte, Kunst & Mode. Alle Rechte vorbehalten.'
    ],
    'ja' => [
        'meta_description' => 'HAFでアートの世界に没入し、創造性に限界のない世界を体験してください',
        'hero_title' => '創造性のキャンバス',
        'hero_subtitle' => 'HAFと共にアートの躍動的な表現を探索しましょう',
        'nav_history' => '歴史',
        'nav_art' => 'アート',
        'nav_world_paintings' => '世界の絵画',
        'nav_famous_artists' => '著名なアーティスト',
        'nav_art_game' => 'アートゲーム',
        'nav_fashion' => 'ファッション',
        'nav_shop' => 'ショップ',
        'options_title' => 'アートを探索',
        'options_subtitle' => '創造性の世界に没入する道を選んでください',
        'option_world_paintings' => '世界の絵画を発見',
        'option_famous_artists' => '著名なアーティストを探索',
        'option_art_game' => 'アートゲームをプレイ',
        'option_world_paintings_desc' => '世界中の象徴的な傑作を巡る旅',
        'option_famous_artists_desc' => 'アートの歴史を形作った先駆者たちを知る',
        'option_art_game_desc' => 'インタラクティブなアートゲームで創造性を解き放つ',
        'quote_text' => 'すべてのアーティストは自分の魂に筆を浸し、自分の本質を絵画に描き出します。',
        'quote_author' => 'ヘンリー・ウォード・ビーチャー',
        'gallery_title' => 'トレンドのアート作品',
        'gallery_subtitle' => 'アートの世界を形作る傑作を発見',
        'video_title' => 'バーチャルギャラリーツアー',
        'video_subtitle' => '世界クラスの美術館をガイド付きで体験',
        'canvas_title' => 'あなたのアートを作成',
        'canvas_subtitle' => '自分の傑作を描いて共有',
        'canvas_color' => '色を選択',
        'canvas_size' => 'ブラシサイズ',
        'canvas_clear' => 'キャンバスをクリア',
        'canvas_save' => '作品を保存',
        'canvas_share' => '作品を共有',
        'quiz_title' => 'あなたのアートスタイルを見つける',
        'quiz_subtitle' => 'あなたのアーティスティックな個性を発見するクイズに挑戦',
        'quiz_question_1' => '最もインスピレーションを受けるものは？',
        'quiz_option_1a' => '自然',
        'quiz_option_1b' => '感情',
        'quiz_option_1c' => '抽象的な概念',
        'quiz_question_2' => '好みの表現方法は？',
        'quiz_option_2a' => '油絵',
        'quiz_option_2b' => '水彩画',
        'quiz_option_2c' => 'デジタルアート',
        'quiz_submit' => '結果を見る',
        'quiz_result_impressionism' => 'あなたは印象派です！',
        'quiz_result_surrealism' => 'あなたはシュルレアリストです！',
        'quiz_result_abstract' => 'あなたは抽象アーティストです！',
        'artist_title' => 'アーティストスポットライト',
        'artist_subtitle' => 'アートの先駆者たちを称える',
        'artist_name' => 'フィンセント・ファン・ゴッホ',
        'artist_bio' => '20世紀のアートに多大な影響を与えたオランダのポスト印象派画家。',
        'newsletter_title' => 'インスピレーションを受け続ける',
        'newsletter_subtitle' => '最新のアート情報と展示会の更新を受け取る',
        'newsletter_email_placeholder' => 'メールアドレスを入力',
        'newsletter_submit' => '登録',
        'newsletter_success' => 'ご登録ありがとうございます！',
        'newsletter_banner' => '独占的な更新情報を受け取るためにアートコミュニティに参加しましょう！',
        'news_ticker' => '最新ニュース：ルーヴル美術館で新印象派展 | ゴッホの「星月夜」ツアー | デジタルアートオークションが記録を更新',
        'theme_toggle' => 'テーマ切替',
        'cookie_consent' => 'より良い体験のためにCookieを使用しています。続行するには同意してください。',
        'cookie_accept' => '同意する',
        'back_to_top' => 'トップに戻る',
        'footer_copyright' => '© 2025 歴史、アート＆ファッション. 全権利所有.'
    ],
    'fr' => [
        'meta_description' => "Plongez dans le monde de l'art avec HAF, où la créativité est sans limites",
        'hero_title' => "Toile de Créativité",
        'hero_subtitle' => "Explorez les expressions vibrantes de l'art avec HAF",
        'nav_history' => "Histoire",
        'nav_art' => "Art",
        'nav_world_paintings' => "Peintures du Monde",
        'nav_famous_artists' => "Artistes Célèbres",
        'nav_art_game' => "Jeu d'Art",
        'nav_fashion' => "Mode",
        'nav_shop' => "Boutique",
        'options_title' => "Explorer l'Art",
        'options_subtitle' => "Choisissez un chemin pour plonger dans la créativité",
        'option_world_paintings' => "Découvrir les Peintures du Monde",
        'option_famous_artists' => "Explorer les Artistes Célèbres",
        'option_art_game' => "Jouer au Jeu d'Art",
        'option_world_paintings_desc' => "Voyagez à travers des chefs-d'œuvre emblématiques du monde entier",
        'option_famous_artists_desc' => "Découvrez les visionnaires qui ont façonné l'histoire de l'art",
        'option_art_game_desc' => "Libérez votre créativité avec notre jeu interactif",
        'quote_text' => "Chaque artiste plonge son pinceau dans son âme et peint sa propre nature dans ses tableaux.",
        'quote_author' => "Henry Ward Beecher",
        'gallery_title' => "Œuvres en Tendance",
        'gallery_subtitle' => "Découvrez les chefs-d'œuvre qui façonnent le monde de l'art",
        'video_title' => "Visite Virtuelle de la Galerie",
        'video_subtitle' => "Vivez une visite guidée de musées de classe mondiale",
        'canvas_title' => "Créez Votre Art",
        'canvas_subtitle' => "Dessinez et partagez votre chef-d'œuvre",
        'canvas_color' => "Choisir la Couleur",
        'canvas_size' => "Taille du Pinceau",
        'canvas_clear' => "Effacer la Toile",
        'canvas_save' => "Enregistrer l'Œuvre",
        'canvas_share' => "Partager l'Œuvre",
        'quiz_title' => "Trouvez Votre Style Artistique",
        'quiz_subtitle' => "Faites notre quiz pour découvrir votre personnalité artistique",
        'quiz_question_1' => "Qu'est-ce qui vous inspire le plus ?",
        'quiz_option_1a' => "La nature",
        'quiz_option_1b' => "Les émotions",
        'quiz_option_1c' => "Concepts abstraits",
        'quiz_question_2' => "Médium préféré ?",
        'quiz_option_2a' => "Peinture à l'huile",
        'quiz_option_2b' => "Aquarelle",
        'quiz_option_2c' => "Art numérique",
        'quiz_submit' => "Voir les Résultats",
        'quiz_result_impressionism' => "Vous êtes un Impressionniste !",
        'quiz_result_surrealism' => "Vous êtes un Surréaliste !",
        'quiz_result_abstract' => "Vous êtes un Artiste Abstrait !",
        'artist_title' => "Artiste à la Une",
        'artist_subtitle' => "Célébrons les visionnaires de l'art",
        'artist_name' => "Vincent van Gogh",
        'artist_bio' => "Un peintre postimpressionniste néerlandais dont l'œuvre a eu une influence considérable sur l'art du XXe siècle.",
        'newsletter_title' => "Restez Inspiré",
        'newsletter_subtitle' => "Abonnez-vous pour recevoir les dernières actualités et expositions d'art",
        'newsletter_email_placeholder' => "Entrez votre email",
        'newsletter_submit' => "S'abonner",
        'newsletter_success' => "Merci pour votre abonnement !",
        'newsletter_banner' => "Rejoignez notre communauté artistique pour des mises à jour exclusives !",
        'news_ticker' => "Dernières nouvelles : Le Louvre accueille une nouvelle exposition impressionniste | La Nuit étoilée de Van Gogh en tournée | Vente aux enchères d'art numérique bat des records",
        'theme_toggle' => "Changer de Thème",
        'cookie_consent' => "Nous utilisons des cookies pour améliorer votre expérience. Acceptez pour continuer.",
        'cookie_accept' => "Accepter",
        'back_to_top' => "Retour en Haut",
        'footer_copyright' => "© 2025 Histoire, Art & Mode. Tous droits réservés."
    ],
    'hi' => [
        'meta_description' => 'HAF के साथ कला की दुनिया में डूब जाएं, जहाँ रचनात्मकता की कोई सीमा नहीं',
        'hero_title' => 'रचनात्मकता का कैनवास',
        'hero_subtitle' => 'HAF के साथ कला की जीवंत अभिव्यक्तियों का अन्वेषण करें',
        'nav_history' => 'इतिहास',
        'nav_art' => 'कला',
        'nav_world_paintings' => 'विश्व चित्रकला',
        'nav_famous_artists' => 'प्रसिद्ध कलाकार',
        'nav_art_game' => 'कला खेल',
        'nav_fashion' => 'फैशन',
        'nav_shop' => 'दुकान',
        'options_title' => 'कला का अन्वेषण करें',
        'options_subtitle' => 'रचनात्मकता की दुनिया में डूबने के लिए एक मार्ग चुनें',
        'option_world_paintings' => 'विश्व चित्रकला खोजें',
        'option_famous_artists' => 'प्रसिद्ध कलाकारों का अन्वेषण करें',
        'option_art_game' => 'कला खेल खेलें',
        'option_world_paintings_desc' => 'दुनिया भर की प्रतिष्ठित कृतियों की यात्रा करें',
        'option_famous_artists_desc' => 'उन दूरदर्शियों के बारे में जानें जिन्होंने कला का इतिहास रचा',
        'option_art_game_desc' => 'हमारे इंटरैक्टिव कला खेल के साथ अपनी रचनात्मकता को उजागर करें',
        'quote_text' => 'हर कलाकार अपनी आत्मा में ब्रश डुबोता है और अपनी प्रकृति को अपनी पेंटिंग्स में चित्रित करता है।',
        'quote_author' => 'हेनरी वार्ड बीचर',
        'gallery_title' => 'लोकप्रिय कलाकृतियाँ',
        'gallery_subtitle' => 'कला की दुनिया को आकार देने वाली कृतियों की खोज करें',
        'video_title' => 'वर्चुअल गैलरी टूर',
        'video_subtitle' => 'विश्व स्तरीय संग्रहालयों का गाइडेड टूर अनुभव करें',
        'canvas_title' => 'अपनी कला बनाएं',
        'canvas_subtitle' => 'अपनी खुद की कृति बनाएं और साझा करें',
        'canvas_color' => 'रंग चुनें',
        'canvas_size' => 'ब्रश का आकार',
        'canvas_clear' => 'कैनवास साफ करें',
        'canvas_save' => 'कृति सहेजें',
        'canvas_share' => 'कृति साझा करें',
        'quiz_title' => 'अपनी कला शैली खोजें',
        'quiz_subtitle' => 'अपनी कलात्मक पहचान जानने के लिए हमारा क्विज़ लें',
        'quiz_question_1' => 'आपको सबसे अधिक क्या प्रेरित करता है?',
        'quiz_option_1a' => 'प्रकृति',
        'quiz_option_1b' => 'भावनाएँ',
        'quiz_option_1c' => 'अमूर्त अवधारणाएँ',
        'quiz_question_2' => 'पसंदीदा माध्यम?',
        'quiz_option_2a' => 'तेल चित्रकला',
        'quiz_option_2b' => 'वॉटरकलर',
        'quiz_option_2c' => 'डिजिटल आर्ट',
        'quiz_submit' => 'परिणाम प्राप्त करें',
        'quiz_result_impressionism' => 'आप एक इंप्रेशनिस्ट हैं!',
        'quiz_result_surrealism' => 'आप एक सर्रियलिस्ट हैं!',
        'quiz_result_abstract' => 'आप एक अमूर्त कलाकार हैं!',
        'artist_title' => 'कलाकार स्पॉटलाइट',
        'artist_subtitle' => 'कला के दूरदर्शियों का उत्सव',
        'artist_name' => 'विन्सेंट वैन गॉग',
        'artist_bio' => 'एक डच पोस्ट-इंप्रेशनिस्ट चित्रकार जिनके कार्यों ने 20वीं सदी की कला पर गहरा प्रभाव डाला।',
        'newsletter_title' => 'प्रेरित रहें',
        'newsletter_subtitle' => 'नवीनतम कला समाचार और प्रदर्शनियों के लिए सदस्यता लें',
        'newsletter_email_placeholder' => 'अपना ईमेल दर्ज करें',
        'newsletter_submit' => 'सदस्यता लें',
        'newsletter_success' => 'सदस्यता के लिए धन्यवाद!',
        'newsletter_banner' => 'विशेष अपडेट के लिए हमारे कला समुदाय से जुड़ें!',
        'news_ticker' => 'नवीनतम: लौवर में नई इंप्रेशनिस्ट प्रदर्शनी | वैन गॉग की स्टाररी नाइट टूर पर | डिजिटल आर्ट नीलामी ने रिकॉर्ड तोड़े',
        'theme_toggle' => 'थीम बदलें',
        'cookie_consent' => 'हम आपके अनुभव को बेहतर बनाने के लिए कुकीज़ का उपयोग करते हैं। जारी रखने के लिए स्वीकार करें।',
        'cookie_accept' => 'स्वीकार करें',
        'back_to_top' => 'ऊपर जाएं',
        'footer_copyright' => '© 2025 इतिहास, कला और फैशन. सर्वाधिकार सुरक्षित।'
    ],
    'ms' => [
        'meta_description' => 'Hayati dunia seni dengan HAF, di mana kreativiti tiada batasan',
        'hero_title' => 'Kanvas Kreativiti',
        'hero_subtitle' => 'Terokai ekspresi seni yang penuh warna bersama HAF',
        'nav_history' => 'Sejarah',
        'nav_art' => 'Seni',
        'nav_world_paintings' => 'Lukisan Dunia',
        'nav_famous_artists' => 'Artis Terkenal',
        'nav_art_game' => 'Permainan Seni',
        'nav_fashion' => 'Fesyen',
        'nav_shop' => 'Kedai',
        'options_title' => 'Terokai Seni',
        'options_subtitle' => 'Pilih laluan untuk menyelami dunia kreativiti',
        'option_world_paintings' => 'Temui Lukisan Dunia',
        'option_famous_artists' => 'Terokai Artis Terkenal',
        'option_art_game' => 'Main Permainan Seni',
        'option_world_paintings_desc' => 'Mengembara melalui karya agung ikonik dari seluruh dunia',
        'option_famous_artists_desc' => 'Kenali tokoh yang membentuk sejarah seni',
        'option_art_game_desc' => 'Bebaskan kreativiti anda dengan permainan seni interaktif kami',
        'quote_text' => 'Setiap artis mencelupkan berus ke dalam jiwanya sendiri dan melukis sifatnya ke dalam lukisannya.',
        'quote_author' => 'Henry Ward Beecher',
        'gallery_title' => 'Karya Seni Terkini',
        'gallery_subtitle' => 'Temui karya agung yang membentuk dunia seni',
        'video_title' => 'Lawatan Maya Galeri',
        'video_subtitle' => 'Alami lawatan berpandu di muzium bertaraf dunia',
        'canvas_title' => 'Cipta Seni Anda',
        'canvas_subtitle' => 'Lukis dan kongsi karya agung anda sendiri',
        'canvas_color' => 'Pilih Warna',
        'canvas_size' => 'Saiz Berus',
        'canvas_clear' => 'Kosongkan Kanvas',
        'canvas_save' => 'Simpan Karya',
        'canvas_share' => 'Kongsi Karya',
        'quiz_title' => 'Cari Gaya Seni Anda',
        'quiz_subtitle' => 'Jawab kuiz kami untuk mengetahui personaliti seni anda',
        'quiz_question_1' => 'Apa yang paling memberi inspirasi kepada anda?',
        'quiz_option_1a' => 'Alam semula jadi',
        'quiz_option_1b' => 'Emosi',
        'quiz_option_1c' => 'Konsep Abstrak',
        'quiz_question_2' => 'Medium pilihan?',
        'quiz_option_2a' => 'Lukisan Minyak',
        'quiz_option_2b' => 'Akvarel',
        'quiz_option_2c' => 'Seni Digital',
        'quiz_submit' => 'Dapatkan Keputusan',
        'quiz_result_impressionism' => 'Anda seorang Impresionis!',
        'quiz_result_surrealism' => 'Anda seorang Surealis!',
        'quiz_result_abstract' => 'Anda seorang Artis Abstrak!',
        'artist_title' => 'Sorotan Artis',
        'artist_subtitle' => 'Menghargai tokoh seni terkemuka',
        'artist_name' => 'Vincent van Gogh',
        'artist_bio' => 'Seorang pelukis pasca-impresionis Belanda yang memberi pengaruh besar pada seni abad ke-20.',
        'newsletter_title' => 'Teruskan Inspirasi',
        'newsletter_subtitle' => 'Langgan untuk kemas kini dan pameran seni terkini',
        'newsletter_email_placeholder' => 'Masukkan emel anda',
        'newsletter_submit' => 'Langgan',
        'newsletter_success' => 'Terima kasih kerana melanggan!',
        'newsletter_banner' => 'Sertai komuniti seni kami untuk kemas kini eksklusif!',
        'news_ticker' => 'Terkini: Louvre menganjurkan pameran Impresionis baharu | Starry Night Van Gogh dalam jelajah | Lelongan seni digital memecah rekod',
        'theme_toggle' => 'Tukar Tema',
        'cookie_consent' => 'Kami menggunakan kuki untuk meningkatkan pengalaman anda. Terima untuk meneruskan.',
        'cookie_accept' => 'Terima',
        'back_to_top' => 'Kembali ke Atas',
        'footer_copyright' => '© 2025 Sejarah, Seni & Fesyen. Hak cipta terpelihara.'
    ]
];

// Helper function
function get_translation($lang, $key) {
    global $translations;
    return isset($translations[$lang][$key]) ? $translations[$lang][$key] : (isset($translations['en'][$key]) ? $translations['en'][$key] : '');
}
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($current_lang); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars(get_translation($current_lang, 'meta_description')); ?>">
    <meta property="og:title" content="HAF - <?php echo htmlspecialchars(get_translation($current_lang, 'nav_art')); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars(get_translation($current_lang, 'meta_description')); ?>">
    <meta property="og:image" content="<?php echo $slides[0]; ?>">
    <title>HAF - <?php echo htmlspecialchars(get_translation($current_lang, 'nav_art')); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@400&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
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
            --accent-blue: #B8E0FF;
            --accent-pink: #FFD6E0;
            --gradient: linear-gradient(135deg, var(--papaya-whip) 0%, var(--snow) 100%);
            --shadow-normal: 0 40px 30px rgba(0,0,0,0.10);
            --shadow-hover: 0 15px 50px rgba(0,0,0,0.15);
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
            min-height: 100vh;
            position: relative;
            background: var(--custom-light);
            transition: background 0.3s, color 0.3s;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        nav {
            background: var(--papaya-whip);
            padding: 20px 0;
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
            color: var(--charcoal);
            text-align: center;
            padding: 120px 20px;
            border-bottom: 5px solid var(--old-lace);
            overflow: hidden;
            background: var(--gradient);
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
            background: var(--old-lace-opaque);
            padding: 20px;
            border-radius: 8px;
            display: inline-block;
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 3.5rem;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .hero p {
            font-family: 'Raleway', sans-serif;
            font-weight: 300;
            font-size: 1.3rem;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .cta-button {
            display: inline-block;
            padding: 10px 30px;
            background: var(--old-lace);
            color: var(--charcoal);
            text-decoration: none;
            border-radius: 6px;
            font-family: 'Raleway', sans-serif;
            font-size: 1.1rem;
            transition: background 0.3s;
        }

        .cta-button:hover {
            background: var(--ivory);
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
            background: var(--charcoal);
            border-radius: 50%;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.3s, background 0.3s;
        }

        .slideshow-dot.active {
            opacity: 1;
            background: var(--ivory);
        }

        section {
            padding: 80px 0;
            border-bottom: 1px solid var(--linen);
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s, transform 0.5s;
        }

        section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        section h2 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 2.8rem;
            text-align: center;
            margin-bottom: 25px;
            color: var(--papaya-whip);
            line-height: 1.6;
        }

        section p.subtitle {
            font-family: 'Raleway', sans-serif;
            font-weight: 300;
            font-size: 1.3rem;
            text-align: center;
            margin-bottom: 50px;
            color: #666;
            line-height: 1.6;
        }

        .quote-section {
            text-align: center;
            padding: 20px;
            background: var(--seashell);
            border-radius: 8px;
            margin: 0 auto 50px;
            max-width: 800px;
        }

        .quote-section blockquote {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 1.8rem;
            color: var(--charcoal);
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .quote-section cite {
            font-family: 'Raleway', sans-serif;
            font-size: 1.2rem;
            color: #666;
            line-height: 1.6;
        }

        .options-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .option-card {
            background: var(--snow);
            border: 2px solid var(--old-lace);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: var(--shadow-normal);
        }

        .option-card:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: var(--shadow-hover);
        }

        .option-card .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--old-lace-opaque);
            color: var(--charcoal);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
            padding: 16px 12px 10px 12px;
            text-align: center;
            font-size: 1rem;
            font-family: 'Raleway', sans-serif;
            font-weight: 500;
            text-shadow: 1px 1px 2px rgba(255,255,255,0.4);
        }

        .option-card:hover .overlay {
            opacity: 1;
        }

        .option-card a {
            color: var(--charcoal);
            text-decoration: none;
            font-family: 'Raleway', sans-serif;
            font-size: 1.4rem;
            display: block;
            z-index: 1;
            position: relative;
            line-height: 1.6;
        }

        .option-card a:hover {
            color: var(--ivory);
        }

        .option-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
            margin-bottom: 15px;
        }

        .video-section {
            text-align: center;
            background: var(--linen);
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 */
            height: 0;
            overflow: hidden;
            max-width: 1000px;
            margin: 0 auto;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .canvas-section {
            background: var(--seashell);
            text-align: center;
        }

        .canvas-container {
            max-width: 800px;
            margin: 0 auto;
        }

        #art-canvas {
            border: 2px solid var(--old-lace);
            background: var(--snow);
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .canvas-controls {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .canvas-controls input, .canvas-controls select, .canvas-controls button {
            padding: 10px;
            font-size: 1.1rem;
            border: 1px solid var(--linen);
            border-radius: 4px;
            background: var(--old-lace);
            color: var(--charcoal);
        }

        .quiz-section {
            background: var(--linen);
            text-align: center;
        }

        .quiz-form {
            max-width: 600px;
            margin: 0 auto;
        }

        .quiz-form .question {
            margin-bottom: 20px;
        }

        .quiz-form label {
            display: block;
            font-family: 'Raleway', sans-serif;
            font-size: 1.2rem;
            margin-bottom: 10px;
            line-height: 1.6;
        }

        .quiz-form input[type="radio"] {
            margin-right: 10px;
        }

        .quiz-result {
            display: none;
            margin-top: 20px;
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: var(--charcoal);
            line-height: 1.6;
        }

        .artist-section {
            background: var(--seashell);
            text-align: center;
        }

        .artist-container {
            display: flex;
            gap: 20px;
            max-width: 1000px;
            margin: 0 auto;
            flex-wrap: wrap;
        }

        .artist-image {
            flex: 1;
            min-width: 250px;
        }

        .artist-image img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }

        .artist-bio {
            flex: 2;
            min-width: 300px;
            text-align: left;
        }

        .artist-bio h3 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.6rem;
            margin-bottom: 10px;
            line-height: 1.6;
        }

        .artist-bio p {
            font-family: 'Raleway', sans-serif;
            font-size: 1.05rem;
            color: #444;
            line-height: 1.6;
        }

        .gallery-section {
            background: var(--linen);
        }

        .gallery-carousel {
            position: relative;
            max-width: 1000px;
            margin: 0 auto;
            overflow: hidden;
            padding: 40px 0;
        }

        .gallery-slides {
            display: flex;
            transition: transform 0.5s ease;
        }

        .gallery-slide {
            flex: 0 0 100%;
            text-align: center;
        }

        .gallery-slide img {
            width: 100%;
            height: 260px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .gallery-slide p {
            font-family: 'Raleway', sans-serif;
            font-size: 1.2rem;
            color: var(--charcoal);
            line-height: 1.6;
        }

        .gallery-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }

        .gallery-nav button {
            background: rgba(0, 0, 0, 0.5);
            color: var(--snow);
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 1.5rem;
            border-radius: 50%;
            transition: background 0.3s;
        }

        .gallery-nav button:hover {
            background: rgba(0, 0, 0, 0.8);
        }

        .newsletter-section {
            text-align: center;
            padding: 100px 20px;
            background: var(--papaya-whip);
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
            padding: 10px;
            font-size: 1.1rem;
            border: 1px solid var(--linen);
            border-radius: 4px;
            flex: 1;
            min-width: 200px;
            background: var(--old-lace);
            color: var(--charcoal);
        }

        .newsletter-section button {
            padding: 10px 30px;
            background: var(--old-lace);
            color: var(--charcoal);
            border: none;
            border-radius: 4px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background 0.3s;
        }

        .newsletter-section button:hover {
            background: var(--ivory);
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
            background: var(--papaya-whip);
            padding: 15px;
            text-align: center;
            z-index: 1000;
            box-shadow: var(--shadow-normal);
        }

        .newsletter-banner p {
            font-family: 'Raleway', sans-serif;
            font-size: 1rem;
            margin-bottom: 10px;
            color: var(--charcoal);
            line-height: 1.6;
        }

        .newsletter-banner a {
            display: inline-block;
            padding: 8px 16px;
            background: var(--old-lace);
            color: var(--charcoal);
            text-decoration: none;
            border-radius: 4px;
            font-family: 'Raleway', sans-serif;
            font-size: 1rem;
            transition: background 0.3s;
        }

        .newsletter-banner a:hover {
            background: var(--ivory);
        }

        .newsletter-banner .close-banner {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: var(--charcoal);
        }

        .news-ticker {
            background: var(--linen);
            padding: 10px;
            overflow: hidden;
            white-space: nowrap;
            margin-bottom: 20px;
        }

        .news-ticker p {
            font-family: 'Raleway', sans-serif;
            display: inline-block;
            animation: ticker 20s linear infinite;
            color: var(--charcoal);
            line-height: 1.6;
        }

        @keyframes ticker {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        .cookie-consent {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background: var(--snow);
            padding: 20px;
            border-radius: 8px;
            box-shadow: var(--shadow-normal);
            z-index: 1000;
            max-width: 300px;
            display: none;
        }

        .cookie-consent p {
            font-family: 'Raleway', sans-serif;
            font-size: 1rem;
            margin-bottom: 10px;
            color: var(--charcoal);
            line-height: 1.6;
        }

        .cookie-consent button {
            padding: 8px 16px;
            background: var(--old-lace);
            color: var(--charcoal);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .cookie-consent button:hover {
            background: var(--ivory);
        }

        .back-to-top {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--old-lace);
            color: var(--charcoal);
            border: none;
            padding: 15px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 1000;
            font-size: 1.2rem;
            box-shadow: var(--shadow-normal);
            transition: background 0.3s;
        }

        .back-to-top:hover {
            background: var(--ivory);
        }

        footer {
            background: var(--papaya-whip);
            color: var(--charcoal);
            text-align: center;
            padding: 30px 0;
        }

        footer p {
            font-family: 'Raleway', sans-serif;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .social-links {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .social-links a {
            color: var(--charcoal);
            font-size: 1.5rem;
            transition: color 0.3s;
        }

        .social-links a:hover {
            color: var(--ivory);
        }

        @media (max-width: 768px) {
            .options-grid {
                grid-template-columns: 1fr;
            }

            .hero {
                height: 500px;
                padding: 80px 20px;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.2rem;
            }

            .cta-button {
                padding: 8px 20px;
                font-size: 1rem;
            }

            section h2 {
                font-size: 2.2rem;
            }

            section p.subtitle {
                font-size: 1.1rem;
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

            .gallery-slide img {
                height: 180px;
            }

            .artist-container {
                flex-direction: column;
            }

            .cookie-consent {
                left: 10px;
                right: 10px;
                max-width: none;
            }

            #art-canvas {
                width: 100%;
                height: 300px;
            }

            .gallery-nav {
                display: none;
            }
        }

        @media (max-width: 480px) {
            nav a {
                margin: 0 10px;
                font-size: 1rem;
            }

            .hero {
                padding: 60px 20px;
                height: 400px;
            }

            .newsletter-section form {
                flex-direction: column;
                align-items: center;
            }

            .newsletter-section input[type="email"] {
                width: 100%;
            }

            .gallery-slide img {
                height: 120px;
            }
        }
    </style>
</head>
<body>
    <div class="news-ticker">
        <p><?php echo htmlspecialchars(get_translation($current_lang, 'news_ticker')); ?></p>
    </div>

    <nav aria-label="Main navigation">
        <div class="container">
            <a href="index.php" style="display:inline-block;margin-right:20px;">
                <img src="images/haf_logo.png" alt="HAF Logo" style="height:32px;vertical-align:middle;" loading="lazy">
            </a>
            <div>
                <a href="history.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_history')); ?></a>
                <a href="art.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_art')); ?></a>
                <a href="world_paintings.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_world_paintings')); ?></a>
                <a href="famous_artists.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_famous_artists')); ?></a>
                <a href="art_game.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_art_game')); ?></a>
                <a href="fashion.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_fashion')); ?></a>
                <a href="php/shop.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_shop')); ?></a>
            </div>
            <div>
                <form method="POST" class="language-form">
                    <label for="lang" class="sr-only">Select Language</label>
                    <select name="lang" id="lang" onchange="this.form.submit()">
                        <option value="en" <?php echo $current_lang === 'en' ? 'selected' : ''; ?>>English</option>
                        <option value="zh" <?php echo $current_lang === 'zh' ? 'selected' : ''; ?>>中文</option>
                        <option value="es" <?php echo $current_lang === 'es' ? 'selected' : ''; ?>>Spanish</option>
                        <option value="ar" <?php echo $current_lang === 'ar' ? 'selected' : ''; ?>>Arabic</option>
                        <option value="ru" <?php echo $current_lang === 'ru' ? 'selected' : ''; ?>>Russian</option>
                        <option value="pt" <?php echo $current_lang === 'pt' ? 'selected' : ''; ?>>Portuguese</option>
                        <option value="de" <?php echo $current_lang === 'de' ? 'selected' : ''; ?>>German</option>
                        <option value="ja" <?php echo $current_lang === 'ja' ? 'selected' : ''; ?>>Japanese</option>
                        <option value="fr" <?php echo $current_lang === 'fr' ? 'selected' : ''; ?>>Français</option>
                        <option value="hi" <?php echo $current_lang === 'hi' ? 'selected' : ''; ?>>हिन्दी</option>
                        <option value="ms" <?php echo $current_lang === 'ms' ? 'selected' : ''; ?>>Bahasa Malaysia</option>
                    </select>
                </form>
                <button class="theme-toggle" aria-label="<?php echo htmlspecialchars(get_translation($current_lang, 'theme_toggle')); ?>">
                    <i class="fas fa-moon"></i>
                </button>
            </div>
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
            <p class="lead"><?php echo htmlspecialchars(get_translation($current_lang, 'hero_subtitle')); ?></p>
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
                    <img src="images/world-paintings-thumb.jpg" alt="World Paintings" class="option-image" loading="lazy">
                    <a href="world_paintings.php"><?php echo htmlspecialchars(get_translation($current_lang, 'option_world_paintings')); ?></a>
                    <div class="overlay"><?php echo htmlspecialchars(get_translation($current_lang, 'option_world_paintings_desc')); ?></div>
                </div>
                <div class="option-card">
                    <img src="images/famous-artists-thumb.jpg" alt="Famous Artists" class="option-image" loading="lazy">
                    <a href="famous_artists.php"><?php echo htmlspecialchars(get_translation($current_lang, 'option_famous_artists')); ?></a>
                    <div class="overlay"><?php echo htmlspecialchars(get_translation($current_lang, 'option_famous_artists_desc')); ?></div>
                </div>
                <div class="option-card">
                    <img src="images/art-game-thumb.jpg" alt="Art Game" class="option-image" loading="lazy">
                    <a href="art_game.php"><?php echo htmlspecialchars(get_translation($current_lang, 'option_art_game')); ?></a>
                    <div class="overlay"><?php echo htmlspecialchars(get_translation($current_lang, 'option_art_game_desc')); ?></div>
                </div>
            </div>
        </div>
    </section>

    <section class="video-section">
        <div class="container">
            <h2><?php echo htmlspecialchars(get_translation($current_lang, 'video_title')); ?></h2>
            <p class="subtitle"><?php echo htmlspecialchars(get_translation($current_lang, 'video_subtitle')); ?></p>
            <div class="video-container">
                <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="Virtual Gallery Tour" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
            </div>
        </div>
    </section>

    <section class="canvas-section">
        <div class="container">
            <h2><?php echo htmlspecialchars(get_translation($current_lang, 'canvas_title')); ?></h2>
            <p class="subtitle"><?php echo htmlspecialchars(get_translation($current_lang, 'canvas_subtitle')); ?></p>
            <div class="canvas-container">
                <canvas id="art-canvas" width="800" height="400"></canvas>
                <div class="canvas-controls">
                    <label for="brush-color"><?php echo htmlspecialchars(get_translation($current_lang, 'canvas_color')); ?></label>
                    <input type="color" id="brush-color" value="#000000">
                    <label for="brush-size"><?php echo htmlspecialchars(get_translation($current_lang, 'canvas_size')); ?></label>
                    <input type="range" id="brush-size" min="1" max="50" value="5">
                    <button id="clear-canvas" class="cta-button"><?php echo htmlspecialchars(get_translation($current_lang, 'canvas_clear')); ?></button>
                    <button id="save-canvas" class="cta-button"><?php echo htmlspecialchars(get_translation($current_lang, 'canvas_save')); ?></button>
                    <button id="share-canvas" class="cta-button"><?php echo htmlspecialchars(get_translation($current_lang, 'canvas_share')); ?></button>
                </div>
            </div>
        </div>
    </section>

    <section class="quiz-section">
        <div class="container">
            <h2><?php echo htmlspecialchars(get_translation($current_lang, 'quiz_title')); ?></h2>
            <p class="subtitle"><?php echo htmlspecialchars(get_translation($current_lang, 'quiz_subtitle')); ?></p>
            <form id="quiz-form" class="quiz-form">
                <div class="question">
                    <label><?php echo htmlspecialchars(get_translation($current_lang, 'quiz_question_1')); ?></label>
                    <input type="radio" name="inspiration" value="nature" required> <?php echo htmlspecialchars(get_translation($current_lang, 'quiz_option_1a')); ?>
                    <input type="radio" name="inspiration" value="emotions"> <?php echo htmlspecialchars(get_translation($current_lang, 'quiz_option_1b')); ?>
                    <input type="radio" name="inspiration" value="abstract"> <?php echo htmlspecialchars(get_translation($current_lang, 'quiz_option_1c')); ?>
                </div>
                <div class="question">
                    <label><?php echo htmlspecialchars(get_translation($current_lang, 'quiz_question_2')); ?></label>
                    <input type="radio" name="medium" value="oil" required> <?php echo htmlspecialchars(get_translation($current_lang, 'quiz_option_2a')); ?>
                    <input type="radio" name="medium" value="watercolor"> <?php echo htmlspecialchars(get_translation($current_lang, 'quiz_option_2b')); ?>
                    <input type="radio" name="medium" value="digital"> <?php echo htmlspecialchars(get_translation($current_lang, 'quiz_option_2c')); ?>
                </div>
                <button type="submit" class="cta-button"><?php echo htmlspecialchars(get_translation($current_lang, 'quiz_submit')); ?></button>
            </form>
            <div id="quiz-result" class="quiz-result"></div>
        </div>
    </section>

    <section class="artist-section">
        <div class="container">
            <h2><?php echo htmlspecialchars(get_translation($current_lang, 'artist_title')); ?></h2>
            <p class="subtitle"><?php echo htmlspecialchars(get_translation($current_lang, 'artist_subtitle')); ?></p>
            <div class="artist-container">
                <div class="artist-image">
                    <img src="images/van-gogh.jpg" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'artist_name')); ?>" loading="lazy">
                </div>
                <div class="artist-bio">
                    <h3><?php echo htmlspecialchars(get_translation($current_lang, 'artist_name')); ?></h3>
                    <p><?php echo htmlspecialchars(get_translation($current_lang, 'artist_bio')); ?></p>
                </div>
            </div>
        </div>
    </section>

    <section class="gallery-section">
        <div class="container">
            <h2><?php echo htmlspecialchars(get_translation($current_lang, 'gallery_title')); ?></h2>
            <p class="subtitle"><?php echo htmlspecialchars(get_translation($current_lang, 'gallery_subtitle')); ?></p>
            <div class="gallery-carousel">
                <div class="gallery-slides">
                    <div class="gallery-slide">
                        <img src="images/mona-lisa1.jpg" alt="Mona Lisa" loading="lazy">
                        <p><?php echo $current_lang === 'zh' ? '蒙娜丽莎' : 'Mona Lisa'; ?></p>
                    </div>
                    <div class="gallery-slide">
                        <img src="images/starry-night.jpg" alt="Starry Night" loading="lazy">
                        <p><?php echo $current_lang === 'zh' ? '星空' : 'Starry Night'; ?></p>
                    </div>
                    <div class="gallery-slide">
                        <img src="images/the-scream.jpg" alt="The Scream" loading="lazy">
                        <p><?php echo $current_lang === 'zh' ? '呐喊' : 'The Scream'; ?></p>
                    </div>
                </div>
                <div class="gallery-nav">
                    <button class="prev-slide" aria-label="Previous artwork">❮</button>
                    <button class="next-slide" aria-label="Next artwork">❯</button>
                </div>
            </div>
        </div>
    </section>

    <section class="newsletter-section">
        <div class="container">
            <h2><?php echo htmlspecialchars(get_translation($current_lang, 'newsletter_title')); ?></h2>
            <p class="subtitle"><?php echo htmlspecialchars(get_translation($current_lang, 'newsletter_subtitle')); ?></p>
            <form id="newsletter-form" action="subscribe.php" method="POST">
                <input type="email" id="email" placeholder="<?php echo htmlspecialchars(get_translation($current_lang, 'newsletter_email_placeholder')); ?>" required aria-label="Email for newsletter">
                <button type="submit"><?php echo htmlspecialchars(get_translation($current_lang, 'newsletter_submit')); ?></button>
            </form>
            <p class="newsletter-success" id="newsletter-success"><?php echo htmlspecialchars(get_translation($current_lang, 'newsletter_success')); ?></p>
        </div>
    </section>

    <div class="newsletter-banner">
        <button class="close-banner" aria-label="Close banner">×</button>
        <p><?php echo htmlspecialchars(get_translation($current_lang, 'newsletter_banner')); ?></p>
        <a href="#newsletter-form" class="cta-button"><?php echo htmlspecialchars(get_translation($current_lang, 'newsletter_submit')); ?></a>
    </div>

    <div class="cookie-consent" id="cookie-consent">
        <p><?php echo htmlspecialchars(get_translation($current_lang, 'cookie_consent')); ?></p>
        <button id="cookie-accept"><?php echo htmlspecialchars(get_translation($current_lang, 'cookie_accept')); ?></button>
    </div>

    <button class="back-to-top" id="back-to-top" aria-label="<?php echo htmlspecialchars(get_translation($current_lang, 'back_to_top')); ?>">
        <i class="fas fa-arrow-up"></i>
    </button>

    <footer>
        <div class="container">
            <p><?php echo htmlspecialchars(get_translation($current_lang, 'footer_copyright')); ?></p>
            <div class="social-links">
                <a href="https://x.com/haf_art" target="_blank" aria-label="Follow HAF on X"><i class="fab fa-x-twitter"></i></a>
                <a href="https://instagram.com/haf_art" target="_blank" aria-label="Follow HAF on Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://facebook.com/haf_art" target="_blank" aria-label="Follow HAF on Facebook"><i class="fab fa-facebook-f"></i></a>
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
            dot.addEventListener('click', () => showHeroSlide(index));
        });

        setInterval(() => {
            currentHeroSlide = (currentHeroSlide + 1) % heroSlides.length;
            showHeroSlide(currentHeroSlide);
        }, 5000);

        // Gallery carousel
        const gallerySlides = document.querySelector('.gallery-slides');
        const gallerySlideElements = document.querySelectorAll('.gallery-slide');
        const prevButton = document.querySelector('.prev-slide');
        const nextButton = document.querySelector('.next-slide');
        let currentGallerySlide = 0;

        function updateGallerySlide() {
            gallerySlides.style.transform = `translateX(-${currentGallerySlide} * 100%)`;
        }

        prevButton.addEventListener('click', () => {
            currentGallerySlide = (currentGallerySlide - 1 + gallerySlideElements.length) % gallerySlideElements.length;
            updateGallerySlide();
        });

        nextButton.addEventListener('click', () => {
            currentGallerySlide = (currentGallerySlide + 1) % gallerySlideElements.length;
            updateGallerySlide();
        });

        // Canvas drawing
        const canvas = document.getElementById('art-canvas');
        const ctx = canvas.getContext('2d');
        let isDrawing = false;

        function startDrawing(e) {
            isDrawing = true;
            draw(e);
        }

        function stopDrawing() {
            isDrawing = false;
            ctx.beginPath();
        }

        function draw(e) {
            if (!isDrawing) return;
            ctx.lineWidth = document.getElementById('brush-size').value;
            ctx.strokeStyle = document.getElementById('brush-color').value;
            ctx.lineCap = 'round';
            const rect = canvas.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            ctx.lineTo(x, y);
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(x, y);
        }

        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing);

        document.getElementById('clear-canvas').addEventListener('click', () => {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        });

        document.getElementById('save-canvas').addEventListener('click', () => {
            const dataURL = canvas.toDataURL('image/png');
            const link = document.createElement('a');
            link.href = dataURL;
            link.download = 'artwork.png';
            link.click();
        });

        document.getElementById('share-canvas').addEventListener('click', () => {
            canvas.toBlob(blob => {
                const file = new File([blob], 'artwork.png', { type: 'image/png' });
                if (navigator.share) {
                    navigator.share({
                        files: [file],
                        title: 'My Artwork',
                        text: 'Check out my artwork from HAF!'
                    });
                } else {
                    alert('Share not supported. Artwork saved to downloads.');
                }
            });
        });

        // Quiz logic
        document.getElementById('quiz-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const inspiration = document.querySelector('input[name="inspiration"]:checked').value;
            const resultDiv = document.getElementById('quiz-result');
            let resultText = '';

            if (inspiration === 'nature') {
                resultText = '<?php echo htmlspecialchars(get_translation($current_lang, 'quiz_result_impressionism')); ?>';
            } else if (inspiration === 'emotions') {
                resultText = '<?php echo htmlspecialchars(get_translation($current_lang, 'quiz_result_surrealism')); ?>';
            } else {
                resultText = '<?php echo htmlspecialchars(get_translation($current_lang, 'quiz_result_abstract')); ?>';
            }

            resultDiv.textContent = resultText;
            resultDiv.style.display = 'block';
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

        // Theme toggle
        const themeToggle = document.querySelector('.theme-toggle');
        themeToggle.addEventListener('click', () => {
            const currentTheme = document.body.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            document.body.setAttribute('data-theme', newTheme);
            themeToggle.innerHTML = newTheme === 'dark' ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
            localStorage.setItem('theme', newTheme);
        });

        // Apply saved theme
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            document.body.setAttribute('data-theme', savedTheme);
            themeToggle.innerHTML = savedTheme === 'dark' ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
        }

        // Cookie consent
        if (!localStorage.getItem('cookie-consent')) {
            document.getElementById('cookie-consent').style.display = 'block';
        }

        document.getElementById('cookie-accept').addEventListener('click', () => {
            document.getElementById('cookie-consent').style.display = 'none';
            localStorage.setItem('cookie-consent', 'accepted');
        });

        // Back to top
        const backToTop = document.getElementById('back-to-top');
        window.addEventListener('scroll', () => {
            backToTop.style.display = window.scrollY > 300 ? 'block' : 'none';
        });

        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Scroll animations
        const sections = document.querySelectorAll('section');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });

        sections.forEach(section => observer.observe(section));
    </script>
</body>
</html>