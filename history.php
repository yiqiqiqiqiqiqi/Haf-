<?php
session_start();

// Default language set to Chinese
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'zh';
}

// Handle language switching
if (isset($_POST['lang'])) {
    $valid_langs = ['en', 'zh', 'ms', 'es', 'ar', 'fr', 'ru', 'pt', 'de', 'ja', 'hi'];
    $_SESSION['lang'] = in_array($_POST['lang'], $valid_langs) ? $_POST['lang'] : 'zh';
}

$current_lang = $_SESSION['lang'];
$site_dir = $current_lang === 'zh' ? 'ltr' : 'ltr'; // Both en and zh use LTR

// Hero slideshow images
$hero_slides = [
    'en' => ['images/history-hero-en-1.jpg', 'images/history-hero-en-2.jpg', 'images/history-hero-en-3.jpg'],
    'zh' => ['images/history-hero-zh-1.jpg', 'images/history-hero-zh-2.jpg', 'images/history-hero-zh-3.jpg'],
    'ms' => ['images/history-hero-ms-1.jpg', 'images/history-hero-ms-2.jpg', 'images/history-hero-ms-3.jpg']
];
$default_slides = ['images/history-hero-1.jpg', 'images/history-hero-2.jpg', 'images/history-hero-3.jpg'];
$slides = isset($hero_slides[$current_lang]) ? $hero_slides[$current_lang] : $default_slides;

// Translation array
$translations = [
    'en' => [
        'meta_description' => 'Explore the depths of history with HAF, where the past inspires the present',
        'hero_title' => 'Journey Through History',
        'hero_subtitle' => 'Discover the stories that shaped civilizations with HAF',
        'nav_history' => 'History',
        'nav_world_history' => 'World History',
        'nav_malaysia_history' => 'Malaysia History',
        'nav_history_game' => 'History Game',
        'nav_art' => 'Art',
        'nav_fashion' => 'Fashion',
        'nav_shop' => 'Shop',
        'options_title' => 'Explore History',
        'options_subtitle' => 'Choose a path to dive into the past',
        'option_world_history' => 'Discover World History',
        'option_malaysia_history' => 'Explore Malaysia History',
        'option_history_game' => 'Play History Game',
        'option_world_history_desc' => 'Journey through global historical events',
        'option_malaysia_history_desc' => 'Learn about Malaysia\'s rich past',
        'option_history_game_desc' => 'Test your knowledge with an interactive game',
        'timeline_title' => 'Historical Timeline',
        'timeline_subtitle' => 'Key events that shaped the world',
        'quiz_title' => 'History Quiz',
        'quiz_subtitle' => 'Test your historical knowledge',
        'quiz_question_1' => 'Which ancient civilization built the pyramids?',
        'quiz_option_1a' => 'Egyptians',
        'quiz_option_1b' => 'Greeks',
        'quiz_option_1c' => 'Romans',
        'quiz_question_2' => 'When did Malaysia gain independence?',
        'quiz_option_2a' => '1957',
        'quiz_option_2b' => '1963',
        'quiz_option_2c' => '1945',
        'quiz_submit' => 'Submit Answers',
        'quiz_result_1' => 'Well done! You\'re a history expert!',
        'quiz_result_2' => 'Good effort! Keep learning!',
        'quiz_result_3' => 'Nice try! Explore more history!',
        'articles_title' => 'Featured Articles',
        'articles_subtitle' => 'Recent insights into historical events',
        'article_1_title' => 'The Fall of the Roman Empire',
        'article_1_desc' => 'An in-depth look at the decline of one of history\'s greatest empires.',
        'article_2_title' => 'Malaysia\'s Road to Independence',
        'article_2_desc' => 'Exploring the key milestones in Malaysia\'s journey to freedom.',
        'article_read_more' => 'Read More',
        'video_title' => 'Historical Video Tour',
        'video_subtitle' => 'Watch a guided tour through history',
        'map_title' => 'Historical Regions',
        'map_subtitle' => 'Explore key historical regions on the map',
        'newsletter_title' => 'Stay Informed',
        'newsletter_subtitle' => 'Subscribe for history updates',
        'newsletter_email_placeholder' => 'Enter your email',
        'newsletter_submit' => 'Subscribe',
        'newsletter_success' => 'Thank you for subscribing!',
        'newsletter_banner' => 'Join our history community for updates!',
        'news_ticker' => 'Latest: New exhibit on Ancient Egypt | Malaysia celebrates 68 years of independence | Roman artifacts unearthed in Italy',
        'theme_toggle' => 'Toggle Theme',
        'cookie_consent' => 'We use cookies to enhance your experience. Accept to continue.',
        'cookie_accept' => 'Accept',
        'back_to_top' => 'Back to Top',
        'share_page' => 'Share this page',
        'footer_copyright' => '© 2025 History, Art & Fashion. All rights reserved.',
        'timeline_egypt_period' => '3100 BCE',
        'timeline_egypt_title' => 'Rise of Ancient Egypt',
        'timeline_egypt_desc' => 'The unification of Upper and Lower Egypt marked the beginning of one of the world\'s first civilizations.',
        'timeline_rome_period' => '27 BCE',
        'timeline_rome_title' => 'Foundation of the Roman Empire',
        'timeline_rome_desc' => 'Augustus became the first Roman emperor, initiating a period of expansion and stability.',
        'timeline_malaysia_period' => '1957',
        'timeline_malaysia_title' => 'Malaysian Independence',
        'timeline_malaysia_desc' => 'Malaysia gained independence from British colonial rule on August 31, 1957.',
        'journey_title' => 'Viaje a través de la historia',
        'journey_subtitle' => 'Descubre las historias que dieron forma a las civilizaciones con HAF',
        'explore_now' => 'Explorar ahora',
        'explore_history' => 'Explorar historia',
        'explore_subtitle' => 'Elige un camino para sumergirte en el pasado',
        'world_history' => 'Historia mundial',
        'world_history_desc' => 'Viaja a través de eventos históricos globales',
        'malaysia_history' => 'Historia de Malasia',
        'malaysia_history_desc' => 'Aprende sobre el rico pasado de Malasia',
        'history_game' => 'Juego de historia',
        'history_game_desc' => 'Pon a prueba tus conocimientos con un juego interactivo',
        'historical_timeline' => 'Línea de tiempo histórica',
        'timeline_subtitle' => 'Eventos clave que dieron forma al mundo',
        'history_quiz' => 'History Quiz',
        'quiz_subtitle' => 'Test your historical knowledge',
        'quiz_question1' => 'Which ancient civilization built the pyramids?',
        'quiz_option1' => 'Egyptians',
        'quiz_option2' => 'Greeks',
        'quiz_option3' => 'Romans',
        'quiz_question2' => 'When did Malaysia gain independence?',
        'quiz_option4' => '1957',
        'quiz_option5' => '1963',
        'quiz_option6' => '1945',
        'submit_answers' => 'Submit Answers',
        'featured_articles' => 'Artículos destacados',
        'articles_subtitle' => 'Perspectivas recientes sobre eventos históricos',
        'roman_empire' => 'Imperio Romano',
        'roman_empire_title' => 'La caída del Imperio Romano',
        'roman_empire_desc' => 'Una mirada en profundidad al declive de uno de los mayores imperios de la historia.',
        'read_more' => 'Leer más',
        'malaysia_independence' => 'Independencia de Malasia',
        'malaysia_independence_title' => 'El camino de Malasia hacia la independencia',
        'malaysia_independence_desc' => 'Explorando los hitos clave en el camino de Malasia hacia la libertad.',
        'read_more' => 'Mehr lesen',
        'malaysia_independence' => 'Jalan Malaysia ke Kemerdekaan',
        'malaysia_independence_title' => 'Meneroka detik penting dalam perjalanan Malaysia ke arah kebebasan.',
        'malaysia_independence_desc' => 'Meneroka detik penting dalam perjalanan Malaysia ke arah kebebasan.'
    ],
    'zh' => [
        'meta_description' => '与HAF一起探索历史，让过去启迪现在',
        'hero_title' => '历史之旅',
        'hero_subtitle' => '与HAF一起探索塑造文明的故事',
        'nav_history' => '历史',
        'nav_world_history' => '世界历史',
        'nav_malaysia_history' => '马来西亚历史',
        'nav_history_game' => '历史游戏',
        'nav_art' => '艺术',
        'nav_fashion' => '时尚',
        'nav_shop' => '商店',
        'options_title' => '探索历史',
        'options_subtitle' => '选择一条通往过去的道路',
        'option_world_history' => '探索世界历史',
        'option_malaysia_history' => '探索马来西亚历史',
        'option_history_game' => '玩历史游戏',
        'option_world_history_desc' => '穿越全球历史事件',
        'option_malaysia_history_desc' => '了解马来西亚丰富的历史',
        'option_history_game_desc' => '通过互动游戏测试你的知识',
        'timeline_title' => '历史时间线',
        'timeline_subtitle' => '塑造世界的关键事件',
        'timeline_egypt_period' => '公元前3100年',
        'timeline_egypt_title' => '古埃及的崛起',
        'timeline_egypt_desc' => '上下埃及的统一标志着世界上最早文明之一的开始。',
        'timeline_rome_period' => '公元前27年',
        'timeline_rome_title' => '罗马帝国的建立',
        'timeline_rome_desc' => '奥古斯都成为第一位罗马皇帝，开启了扩张和稳定的时期。',
        'timeline_malaysia_period' => '1957年',
        'timeline_malaysia_title' => '马来西亚独立',
        'timeline_malaysia_desc' => '马来西亚于1957年8月31日从英国殖民统治中获得独立。',
        'history_quiz' => '历史测验',
        'quiz_subtitle' => '测试你的历史知识',
        'quiz_question_1' => '哪个古代文明建造了金字塔？',
        'quiz_option_1a' => '埃及人',
        'quiz_option_1b' => '希腊人',
        'quiz_option_1c' => '罗马人',
        'quiz_question_2' => '马来西亚何时获得独立？',
        'quiz_option_2a' => '1957年',
        'quiz_option_2b' => '1963年',
        'quiz_option_2c' => '1945年',
        'quiz_submit' => '提交答案',
        'quiz_result_1' => '太棒了！你是历史专家！',
        'quiz_result_2' => '做得很好！继续学习！',
        'quiz_result_3' => '不错的尝试！继续探索历史吧！',
        'articles_title' => '精选文章',
        'articles_subtitle' => '关于历史事件的最新见解',
        'roman_empire' => '罗马帝国',
        'roman_empire_title' => '罗马帝国的衰落',
        'roman_empire_desc' => '深入探讨历史上最伟大帝国之一的衰落。',
        'read_more' => '阅读更多',
        'malaysia_independence' => '马来西亚独立',
        'malaysia_independence_title' => '马来西亚的独立之路',
        'malaysia_independence_desc' => '探索马来西亚走向自由的关键里程碑。',
        'news_ticker' => '最新消息：古埃及新展览 | 马来西亚庆祝独立68周年 | 意大利发现罗马文物',
        'theme_toggle' => '切换主题',
        'cookie_consent' => '我们使用cookies来改善您的体验。接受以继续。',
        'cookie_accept' => '接受',
        'back_to_top' => '返回顶部',
        'share_page' => '分享页面',
        'footer_copyright' => '© 2025 历史、艺术与时尚。保留所有权利。',
        'historical_video_tour' => '历史视频导览',
        'watch_guided_tour' => '观看导览',
        'stay_informed' => '保持关注',
        'subscribe_updates' => '订阅历史更新',
        'enter_email' => '输入您的邮箱',
        'subscribe' => '订阅',
        'article_1_title' => '罗马帝国',
        'article_1_desc' => '深入探讨历史上最伟大帝国之一的衰落。',
        'article_2_title' => '马来西亚独立',
        'article_2_desc' => '探索马来西亚走向自由的重要里程碑。',
        'video_title' => '历史视频导览',
        'video_subtitle' => '观看历史导览',
        'video_description' => '通过我们的视频导览，深入了解历史的重要时刻。',
        'video_button' => '观看视频',
        'subscribe_title' => '保持更新',
        'subscribe_subtitle' => '订阅获取历史更新',
        'subscribe_description' => '订阅我们的通讯，获取最新的历史文章和活动信息。',
        'subscribe_button' => '立即订阅',
        'subscribe_success' => '订阅成功！',
        'subscribe_error' => '订阅失败，请稍后重试。'
    ],
    'ms' => [
        'meta_description' => 'Terokai sejarah dengan HAF, di mana masa lalu mengilhamkan masa kini',
        'hero_title' => 'Pengembaraan Melalui Sejarah',
        'hero_subtitle' => 'Terokai kisah-kisah yang membentuk tamadun dengan HAF',
        'nav_history' => 'Sejarah',
        'nav_world_history' => 'Sejarah Dunia',
        'nav_malaysia_history' => 'Sejarah Malaysia',
        'nav_history_game' => 'Permainan Sejarah',
        'nav_art' => 'Seni',
        'nav_fashion' => 'Fesyen',
        'nav_shop' => 'Kedai',
        'options_title' => 'Terokai Sejarah',
        'options_subtitle' => 'Pilih laluan untuk menyelami masa lalu',
        'option_world_history' => 'Terokai Sejarah Dunia',
        'option_malaysia_history' => 'Terokai Sejarah Malaysia',
        'option_history_game' => 'Main Permainan Sejarah',
        'option_world_history_desc' => 'Melalui peristiwa sejarah global',
        'option_malaysia_history_desc' => 'Ketahui tentang sejarah Malaysia yang kaya',
        'option_history_game_desc' => 'Uji pengetahuan anda dengan permainan interaktif',
        'timeline_title' => 'Garis Masa Sejarah',
        'timeline_subtitle' => 'Peristiwa utama yang membentuk dunia',
        'timeline_egypt_period' => '3100 SM',
        'timeline_egypt_title' => 'Kebangkitan Mesir Purba',
        'timeline_egypt_desc' => 'Penyatuan Mesir Hulu dan Hilir menandakan permulaan salah satu tamadun terawal di dunia.',
        'timeline_rome_period' => '27 SM',
        'timeline_rome_title' => 'Penubuhan Empayar Rom',
        'timeline_rome_desc' => 'Augustus menjadi maharaja Rom pertama, memulakan tempoh pengembangan dan kestabilan.',
        'timeline_malaysia_period' => '1957',
        'timeline_malaysia_title' => 'Kemerdekaan Malaysia',
        'timeline_malaysia_desc' => 'Malaysia mencapai kemerdekaan dari pemerintahan kolonial British pada 31 Ogos 1957.',
        'history_quiz' => 'Kuiz Sejarah',
        'quiz_subtitle' => 'Uji pengetahuan sejarah anda',
        'quiz_question_1' => 'Tamadun purba yang manakah membina piramid?',
        'quiz_option_1a' => 'Orang Mesir',
        'quiz_option_1b' => 'Orang Yunani',
        'quiz_option_1c' => 'Orang Rom',
        'quiz_question_2' => 'Bilakah Malaysia mencapai kemerdekaan?',
        'quiz_option_2a' => '1957',
        'quiz_option_2b' => '1963',
        'quiz_option_2c' => '1945',
        'quiz_submit' => 'Hantar Jawapan',
        'quiz_result_1' => 'Cemerlang! Anda adalah pakar sejarah!',
        'quiz_result_2' => 'Usaha yang baik! Teruskan belajar!',
        'quiz_result_3' => 'Usaha yang baik! Terokai lebih banyak sejarah!',
        'articles_title' => 'Artikel Pilihan',
        'articles_subtitle' => 'Pandangan terkini tentang peristiwa sejarah',
        'roman_empire' => 'Empayar Rom',
        'roman_empire_title' => 'Kejatuhan Empayar Rom',
        'roman_empire_desc' => 'Pandangan mendalam tentang kemerosotan salah satu empayar terbesar dalam sejarah.',
        'read_more' => 'Baca Lagi',
        'malaysia_independence' => 'Kemerdekaan Malaysia',
        'malaysia_independence_title' => 'Jalan Malaysia Menuju Kemerdekaan',
        'malaysia_independence_desc' => 'Meneroka pencapaian utama dalam perjalanan Malaysia menuju kebebasan.',
        'news_ticker' => 'Terkini: Pameran Baru Mesir Purba | Malaysia Meraikan 68 Tahun Kemerdekaan | Artifak Rom Ditemui di Itali',
        'theme_toggle' => 'Tukar Tema',
        'cookie_consent' => 'Kami menggunakan kuki untuk meningkatkan pengalaman anda. Terima untuk teruskan.',
        'cookie_accept' => 'Terima',
        'back_to_top' => 'Kembali ke Atas',
        'share_page' => 'Kongsi Halaman',
        'footer_copyright' => '© 2025 Sejarah, Seni & Fesyen. Hak Cipta Terpelihara.',
        'historical_video_tour' => 'Lawatan Video Sejarah',
        'watch_guided_tour' => 'Tonton lawatan berpandu',
        'stay_informed' => 'Kekal Dimaklumkan',
        'subscribe_updates' => 'Langgan kemas kini sejarah',
        'enter_email' => 'Masukkan e-mel anda',
        'subscribe' => 'Langgan'
    ],
    'es' => [
        'meta_description' => 'Explora la historia con HAF, donde el pasado inspira el presente',
        'hero_title' => 'Viaje a través de la Historia',
        'hero_subtitle' => 'Descubre las historias que dieron forma a las civilizaciones con HAF',
        'nav_history' => 'Historia',
        'nav_world_history' => 'Historia Mundial',
        'nav_malaysia_history' => 'Historia de Malasia',
        'nav_history_game' => 'Juego de Historia',
        'nav_art' => 'Arte',
        'nav_fashion' => 'Moda',
        'nav_shop' => 'Tienda',
        'options_title' => 'Explorar Historia',
        'options_subtitle' => 'Elige un camino para sumergirte en el pasado',
        'option_world_history' => 'Explorar Historia Mundial',
        'option_malaysia_history' => 'Explorar Historia de Malasia',
        'option_history_game' => 'Jugar Juego de Historia',
        'option_world_history_desc' => 'Viaja a través de eventos históricos globales',
        'option_malaysia_history_desc' => 'Conoce la rica historia de Malasia',
        'option_history_game_desc' => 'Pon a prueba tus conocimientos con un juego interactivo',
        'timeline_title' => 'Línea de Tiempo Histórica',
        'timeline_subtitle' => 'Eventos clave que dieron forma al mundo',
        'timeline_egypt_period' => '3100 a.C.',
        'timeline_egypt_title' => 'Auge del Antiguo Egipto',
        'timeline_egypt_desc' => 'La unificación del Alto y Bajo Egipto marcó el comienzo de una de las primeras civilizaciones del mundo.',
        'timeline_rome_period' => '27 a.C.',
        'timeline_rome_title' => 'Fundación del Imperio Romano',
        'timeline_rome_desc' => 'Augusto se convirtió en el primer emperador romano, iniciando un período de expansión y estabilidad.',
        'timeline_malaysia_period' => '1957',
        'timeline_malaysia_title' => 'Independencia de Malasia',
        'timeline_malaysia_desc' => 'Malasia obtuvo su independencia del dominio colonial británico el 31 de agosto de 1957.',
        'history_quiz' => 'Cuestionario de Historia',
        'quiz_subtitle' => 'Pon a prueba tus conocimientos históricos',
        'quiz_question1' => '¿Qué civilización antigua construyó las pirámides?',
        'quiz_option1' => 'Egipcios',
        'quiz_option2' => 'Griegos',
        'quiz_option3' => 'Romanos',
        'quiz_question2' => '¿Cuándo obtuvo Malasia su independencia?',
        'quiz_option4' => '1957',
        'quiz_option5' => '1963',
        'quiz_option6' => '1945',
        'submit_answers' => 'Enviar Respuestas',
        'featured_articles' => 'Artículos Destacados',
        'articles_subtitle' => 'Perspectivas actuales sobre eventos históricos',
        'roman_empire' => 'Imperio Romano',
        'roman_empire_title' => 'La Caída del Imperio Romano',
        'roman_empire_desc' => 'Un análisis profundo del declive de uno de los mayores imperios de la historia.',
        'read_more' => 'Leer Más',
        'malaysia_independence' => 'Independencia de Malasia',
        'malaysia_independence_title' => 'El Camino de Malasia hacia la Independencia',
        'malaysia_independence_desc' => 'Explorando los hitos importantes en el camino de Malasia hacia la libertad.'
    ],
    'ar' => [
        'meta_description' => 'اكتشف التاريخ مع HAF، حيث يلهم الماضي الحاضر',
        'hero_title' => 'رحلة عبر التاريخ',
        'hero_subtitle' => 'اكتشف القصص التي شكلت الحضارات مع HAF',
        'nav_history' => 'التاريخ',
        'nav_world_history' => 'تاريخ العالم',
        'nav_malaysia_history' => 'تاريخ ماليزيا',
        'nav_history_game' => 'لعبة التاريخ',
        'nav_art' => 'الفن',
        'nav_fashion' => 'الموضة',
        'nav_shop' => 'المتجر',
        'options_title' => 'استكشار التاريخ',
        'options_subtitle' => 'اختر مسارًا للغوص في الماضي',
        'option_world_history' => 'استكشف تاريخ العالم',
        'option_malaysia_history' => 'استكشار تاريخ ماليزيا',
        'option_history_game' => 'العب لعبة التاريخ',
        'option_world_history_desc' => 'رحلة عبر الأحداث التاريخية العالمية',
        'option_malaysia_history_desc' => 'تعرف على تاريخ ماليزيا الغني',
        'option_history_game_desc' => 'اختبر معرفتك من خلال لعبة تفاعلية',
        'timeline_title' => 'الجدول الزمني التاريخي',
        'timeline_subtitle' => 'الأحداث الرئيسية التي شكلت العالم',
        'timeline_egypt_period' => '3100 ق.م',
        'timeline_egypt_title' => 'صعود مصر القديمة',
        'timeline_egypt_desc' => 'وحدت مصر العليا والسفلى بداية واحدة من أقدم الحضارات في العالم.',
        'timeline_rome_period' => '27 ق.م',
        'timeline_rome_title' => 'تأسيس الإمبراطورية الرومانية',
        'timeline_rome_desc' => 'أصبح أغسطس أول إمبراطور روماني، مما أدى إلى فترة من التوسع والاستقرار.',
        'timeline_malaysia_period' => '1957',
        'timeline_malaysia_title' => 'استقلال ماليزيا',
        'timeline_malaysia_desc' => 'حصلت ماليزيا على استقلالها من الحكم الاستعماري البريطاني في 31 أغسطس 1957.',
        'history_quiz' => 'اختبار التاريخ',
        'quiz_subtitle' => 'اختبر معرفتك التاريخية',
        'quiz_question1' => 'أي حضارة قديمة بنت الأهرامات؟',
        'quiz_option1a' => 'المصريون',
        'quiz_option1b' => 'اليونانيون',
        'quiz_option1c' => 'الرومان',
        'quiz_question2' => 'متى حصلت ماليزيا على استقلالها؟',
        'quiz_option2a' => '1957',
        'quiz_option2b' => '1963',
        'quiz_option2c' => '1945',
        'quiz_submit' => 'إرسال الإجابات',
        'quiz_result_1' => 'جيد جدا! أنت خبير تاريخي!',
        'quiz_result_2' => 'جيد جدا! استمر في التعلم!',
        'quiz_result_3' => 'جيد جدا! جرب المزيد من التاريخ!',
        'articles_title' => 'المقالات المميزة',
        'articles_subtitle' => 'الرؤيات الحديثة حول الأحداث التاريخية',
        'article_1_title' => 'انهيار الإمبراطورية الرومانية',
        'article_1_desc' => 'مراجعة عميقة لانهيار إحدى أكبر الإمبراطوريات في التاريخ.',
        'article_2_title' => 'مسار ماليزيا للاستقلال',
        'article_2_desc' => 'استكشار المعالم الرئيسية في مسار ماليزيا للحرية.',
        'article_read_more' => 'قراءة المزيد',
        'video_title' => 'رحلة في الفيديو التاريخي',
        'video_subtitle' => 'شاهد رحلة توضيحية من خلال التاريخ',
        'map_title' => 'مناطق تاريخية',
        'map_subtitle' => 'استكشار مناطق تاريخية رئيسية في الخريطة',
        'newsletter_title' => 'بقي على اطلاع',
        'newsletter_subtitle' => 'اشترك لتحصل على تحديثات التاريخ',
        'newsletter_email_placeholder' => 'أدخل بريدك الإلكتروني',
        'newsletter_submit' => 'اشتراك',
        'newsletter_success' => 'شكرا لك للاشتراك!',
        'newsletter_banner' => 'إنضم إلى مجتمع التاريخ للحصول على تحديثات!',
        'news_ticker' => 'آخر الأخبار: معرض جديد على مصر القديم | ماليزيا تضيف 68 عامًا من الاستقلال | أثريات رومانية ظهرت في إيطاليا',
        'theme_toggle' => 'تغيير الموضوع',
        'cookie_consent' => 'نستخدم الكوكيز لتحسين تجربتك. قبول للمتابعة.',
        'cookie_accept' => 'قبول',
        'back_to_top' => 'إيقاف الإسقاط',
        'share_page' => 'مشاركة هذه الصفحة',
        'footer_copyright' => '© 2025 التاريخ، الفن، والموضة. جميع الحقون محفوظة.',
        'timeline_egypt_period' => '3100 v. Chr.',
        'timeline_egypt_title' => 'Aufstieg des Alten Ägypten',
        'timeline_egypt_desc' => 'Die Vereinigung von Ober- und Unterägypten markierte den Beginn einer der ersten Zivilisationen der Welt.',
        'timeline_rome_period' => '27 v. Chr.',
        'timeline_rome_title' => 'Gründung des Römischen Reiches',
        'timeline_rome_desc' => 'Augustus wurde der erste römische Kaiser und leitete eine Phase der Expansion und Stabilität ein.',
        'timeline_malaysia_period' => '1957',
        'timeline_malaysia_title' => 'Unabhängigkeit Malaysias',
        'timeline_malaysia_desc' => 'Malaysia erlangte am 31. August 1957 die Unabhängigkeit von der britischen Kolonialherrschaft.',
        'timeline_malaysia_period' => '1957',
        'timeline_malaysia_title' => 'Malaysian Independence',
        'timeline_malaysia_desc' => 'Malaysia gained independence from British colonial rule on August 31, 1957.',
        'journey_title' => 'رحلة في التاريخ',
        'journey_subtitle' => 'اكتشف القصص التي شكلت الحضارات مع HAF',
        'explore_now' => 'استكشف الآن',
        'explore_history' => 'استكشف التاريخ',
        'explore_subtitle' => 'اختر مسارًا للغوص في الماضي',
        'world_history' => 'تاريخ العالم',
        'world_history_desc' => 'رحلة عبر الأحداث التاريخية العالمية',
        'malaysia_history' => 'تاريخ ماليزيا',
        'malaysia_history_desc' => 'تعرف على ماضي ماليزيا الغني',
        'history_game' => 'لعبة التاريخ',
        'history_game_desc' => 'اختبر معلوماتك من خلال لعبة تفاعلية',
        'historical_timeline' => 'الجدول الزمني التاريخي',
        'timeline_subtitle' => 'الأحداث الرئيسية التي شكلت العالم',
        'history_quiz' => 'اختبار التاريخ',
        'quiz_subtitle' => 'اختبر معرفتك التاريخية',
        'quiz_question1' => 'أي حضارة قديمة بنت الأهرامات؟',
        'quiz_option1' => 'المصريون',
        'quiz_option2' => 'اليونانيون',
        'quiz_option3' => 'الرومان',
        'quiz_question2' => 'متى حصلت ماليزيا على الاستقلال؟',
        'quiz_option4' => '1957',
        'quiz_option5' => '1963',
        'quiz_option6' => '1945',
        'submit_answers' => 'إرسال الإجابات',
        'featured_articles' => 'مقالات مميزة',
        'articles_subtitle' => 'أحدث الرؤى حول الأحداث التاريخية',
        'roman_empire' => 'الإمبراطورية الرومانية',
        'roman_empire_title' => 'سقوط الإمبراطورية الرومانية',
        'roman_empire_desc' => 'نظرة متعمقة على تراجع أحد أعظم الإمبراطوريات في التاريخ.',
        'read_more' => 'اقرأ المزيد',
        'malaysia_independence' => 'استقلال ماليزيا',
        'malaysia_independence_title' => 'طريق ماليزيا إلى الاستقلال',
        'malaysia_independence_desc' => 'استكشاف المعالم الرئيسية في رحلة ماليزيا نحو الحرية.'
    ],
    'fr' => [
        'meta_description' => 'Explorez les profondeurs de l\'histoire avec HAF, où le passé inspire le présent',
        'hero_title' => 'Voyage à travers l\'histoire',
        'hero_subtitle' => 'Découvrez les histoires qui ont façonné les civilisations avec HAF',
        'nav_history' => 'Histoire',
        'nav_world_history' => 'Histoire du monde',
        'nav_malaysia_history' => 'Histoire de la Malaisie',
        'nav_history_game' => 'Jeu d\'histoire',
        'nav_art' => 'Art',
        'nav_fashion' => 'Mode',
        'nav_shop' => 'Boutique',
        'options_title' => 'Explorer l\'histoire',
        'options_subtitle' => 'Choisissez un chemin pour plonger dans le passé',
        'option_world_history' => 'Découvrir l\'histoire du monde',
        'option_malaysia_history' => 'Explorer l\'histoire de la Malaisie',
        'option_history_game' => 'Jouer au jeu d\'histoire',
        'option_world_history_desc' => 'Voyage à travers les événements historiques mondiaux',
        'option_malaysia_history_desc' => 'Découvrez le riche passé de la Malaisie',
        'option_history_game_desc' => 'Testez vos connaissances avec un jeu interactif',
        'timeline_title' => 'Chronologie historique',
        'timeline_subtitle' => 'Événements clés qui ont façonné le monde',
        'quiz_title' => "Quiz d'histoire",
        'quiz_subtitle' => 'Testez vos connaissances historiques',
        'quiz_question_1' => 'Quelle civilisation ancienne a construit les pyramides ?',
        'quiz_option_1a' => 'Égyptiens',
        'quiz_option_1b' => 'Grecs',
        'quiz_option_1c' => 'Romains',
        'quiz_question_2' => 'Quand la Malaisie a-t-elle obtenu son indépendance ?',
        'quiz_option_2a' => '1957',
        'quiz_option_2b' => '1963',
        'quiz_option_2c' => '1945',
        'quiz_submit' => 'Soumettre les réponses',
        'quiz_result_1' => 'Bien joué ! Vous êtes un expert en histoire !',
        'quiz_result_2' => 'Bon effort ! Continuez à apprendre !',
        'quiz_result_3' => 'Bon essai ! Explorez plus d\'histoire !',
        'articles_title' => 'Articles en vedette',
        'articles_subtitle' => 'Aperçus récents des événements historiques',
        'article_1_title' => "La chute de l'Empire romain",
        'article_1_desc' => "Un regard approfondi sur le déclin de l'un des plus grands empires de l'histoire.",
        'article_2_title' => 'Le chemin de la Malaisie vers l\'indépendance',
        'article_2_desc' => 'Explorer les étapes clés du chemin de la Malaisie vers la liberté.',
        'article_read_more' => 'Lire la suite',
        'video_title' => 'Visite vidéo historique',
        'video_subtitle' => 'Regardez une visite guidée à travers l\'histoire',
        'map_title' => 'Régions historiques',
        'map_subtitle' => 'Explorez les principales régions historiques sur la carte',
        'newsletter_title' => 'Restez informé',
        'newsletter_subtitle' => 'Abonnez-vous pour des mises à jour historiques',
        'newsletter_email_placeholder' => 'Entrez votre e-mail',
        'newsletter_submit' => 'S\'abonner',
        'newsletter_success' => 'Merci pour votre abonnement !',
        'newsletter_banner' => 'Rejoignez notre communauté historique pour des mises à jour !',
        'news_ticker' => 'Dernières nouvelles : Nouvelle exposition sur l\'Égypte ancienne | La Malaisie célèbre 68 ans d\'indépendance | Découverte d\'artefacts romains en Italie',
        'theme_toggle' => 'Changer de thème',
        'cookie_consent' => 'Nous utilisons des cookies pour améliorer votre expérience. Acceptez pour continuer.',
        'cookie_accept' => 'Accepter',
        'back_to_top' => 'Retour en haut',
        'share_page' => 'Partager cette page',
        'footer_copyright' => '© 2025 Histoire, Art & Mode. Tous droits réservés.',
        'timeline_egypt_period' => '3100 av. J.-C.',
        'timeline_egypt_title' => 'L\'essor de l\'Égypte ancienne',
        'timeline_egypt_desc' => 'L\'unification de la Haute et de la Basse-Égypte marqua le début de l\'une des premières civilisations du monde.',
        'timeline_rome_period' => '27 av. J.-C.',
        'timeline_rome_title' => 'Fondation de l\'Empire romain',
        'timeline_rome_desc' => 'Auguste devint le premier empereur romain, initiant une période d\'expansion et de stabilité.',
        'timeline_malaysia_period' => '1957',
        'timeline_malaysia_title' => 'Indépendance de la Malaisie',
        'timeline_malaysia_desc' => 'La Malaisie obtint son indépendance de la domination coloniale britannique le 31 août 1957.',
        'timeline_malaysia_period' => '1957',
        'timeline_malaysia_title' => 'Malaysian Independence',
        'timeline_malaysia_desc' => 'Malaysia gained independence from British colonial rule on August 31, 1957.',
        'journey_title' => 'Voyage à travers l\'histoire',
        'journey_subtitle' => 'Découvrez les histoires qui ont façonné les civilisations avec HAF',
        'explore_now' => 'Explorer l\'histoire',
        'explore_history' => 'Explorer l\'histoire',
        'explore_subtitle' => 'Choisissez un chemin pour plonger dans le passé',
        'world_history' => 'Histoire du monde',
        'world_history_desc' => 'Voyage à travers les événements historiques mondiaux',
        'malaysia_history' => 'Histoire de la Malaisie',
        'malaysia_history_desc' => 'Découvrez le riche passé de la Malaisie',
        'history_game' => 'Jeu d\'histoire',
        'history_game_desc' => 'Testez vos connaissances avec un jeu interactif',
        'historical_timeline' => 'Chronologie historique',
        'timeline_subtitle' => 'Événements clés qui ont façonné le monde',
        'history_quiz' => 'Quiz d\'histoire',
        'quiz_subtitle' => 'Testez vos connaissances historiques',
        'quiz_question1' => 'Quelle civilisation ancienne a construit les pyramides ?',
        'quiz_option1' => 'Égyptiens',
        'quiz_option2' => 'Grecs',
        'quiz_option3' => 'Romains',
        'quiz_question2' => 'Quand la Malaisie a-t-elle obtenu son indépendance ?',
        'quiz_option4' => '1957',
        'quiz_option5' => '1963',
        'quiz_option6' => '1945',
        'submit_answers' => 'Soumettre les réponses',
        'featured_articles' => 'Articles en vedette',
        'articles_subtitle' => 'Aperçus récents des événements historiques',
        'roman_empire' => 'La chute de l\'Empire romain',
        'roman_empire_title' => 'Un regard approfondi sur le déclin de l\'un des plus grands empires de l\'histoire.',
        'roman_empire_desc' => 'Explorer les étapes clés du chemin de la Malaisie vers la liberté.',
        'read_more' => 'Lire la suite',
        'malaysia_independence' => 'Indépendance de la Malaisie',
        'malaysia_independence_title' => 'Le chemin de la Malaisie vers l\'indépendance',
        'malaysia_independence_desc' => 'Explorer les étapes clés du chemin de la Malaisie vers la liberté.'
    ],
    'ru' => [
        'meta_description' => 'Исследуйте историю с HAF, где прошлое вдохновляет настоящее',
        'hero_title' => 'Путешествие по истории',
        'hero_subtitle' => 'Откройте для себя истории, которые сформировали цивилизации с HAF',
        'nav_history' => 'История',
        'nav_world_history' => 'Всемирная история',
        'nav_malaysia_history' => 'История Малайзии',
        'nav_history_game' => 'Историческая игра',
        'nav_art' => 'Искусство',
        'nav_fashion' => 'Мода',
        'nav_shop' => 'Магазин',
        'options_title' => 'Изучить историю',
        'options_subtitle' => 'Выберите путь, чтобы погрузиться в прошлое',
        'option_world_history' => 'Откройте для себя всемирную историю',
        'option_malaysia_history' => 'Изучить историю Малайзии',
        'option_history_game' => 'Играть в историческую игру',
        'option_world_history_desc' => 'Путешествие по мировым историческим событиям',
        'option_malaysia_history_desc' => 'Узнайте о богатом прошлом Малайзии',
        'option_history_game_desc' => 'Проверьте свои знания с помощью интерактивной игры',
        'timeline_title' => 'Историческая хронология',
        'timeline_subtitle' => 'Ключевые события, сформировавшие мир',
        'quiz_title' => 'Историческая викторина',
        'quiz_subtitle' => 'Проверьте свои исторические знания',
        'quiz_question_1' => 'Какая древняя цивилизация построила пирамиды?',
        'quiz_option_1a' => 'Египтяне',
        'quiz_option_1b' => 'Греки',
        'quiz_option_1c' => 'Римляне',
        'quiz_question_2' => 'Когда Малайзия получила независимость?',
        'quiz_option_2a' => '1957',
        'quiz_option_2b' => '1963',
        'quiz_option_2c' => '1945',
        'quiz_submit' => 'Отправить ответы',
        'quiz_result_1' => 'Молодец! Вы эксперт по истории!',
        'quiz_result_2' => 'Хорошая попытка! Продолжайте учиться!',
        'quiz_result_3' => 'Неплохо! Изучайте больше истории!',
        'articles_title' => 'Избранные статьи',
        'articles_subtitle' => 'Последние взгляды на исторические события',
        'article_1_title' => 'Падение Римской империи',
        'article_1_desc' => 'Подробный взгляд на упадок одной из величайших империй в истории.',
        'article_2_title' => 'Путь Малайзии к независимости',
        'article_2_desc' => 'Изучение ключевых этапов на пути Малайзии к свободе.',
        'article_read_more' => 'Читать далее',
        'video_title' => 'Исторический видео-тур',
        'video_subtitle' => 'Смотрите экскурсию по истории',
        'map_title' => 'Исторические регионы',
        'map_subtitle' => 'Изучайте ключевые исторические регионы на карте',
        'newsletter_title' => 'Будьте в курсе',
        'newsletter_subtitle' => 'Подпишитесь на обновления по истории',
        'newsletter_email_placeholder' => 'Введите ваш e-mail',
        'newsletter_submit' => 'Подписаться',
        'newsletter_success' => 'Спасибо за подписку!',
        'newsletter_banner' => 'Присоединяйтесь к нашему историческому сообществу для обновлений!',
        'news_ticker' => 'Последние новости: Новая выставка о Древнем Египте | Малайзия отмечает 68 лет независимости | В Италии найдены римские артефакты',
        'theme_toggle' => 'Сменить тему',
        'cookie_consent' => 'Мы используем файлы cookie для улучшения вашего опыта. Примите, чтобы продолжить.',
        'cookie_accept' => 'Принять',
        'back_to_top' => 'Наверх',
        'share_page' => 'Поделиться страницей',
        'footer_copyright' => '© 2025 История, Искусство и Мода. Все права защищены.',
        'timeline_egypt_period' => '3100 г. до н.э.',
        'timeline_egypt_title' => 'Расцвет Древнего Египта',
        'timeline_egypt_desc' => 'Объединение Верхнего и Нижнего Египта ознаменовало начало одной из первых цивилизаций мира.',
        'timeline_rome_period' => '27 г. до н.э.',
        'timeline_rome_title' => 'Основание Римской империи',
        'timeline_rome_desc' => 'Август стал первым римским императором, начав период экспансии и стабильности.',
        'timeline_malaysia_period' => '1957',
        'timeline_malaysia_title' => 'Независимость Малайзии',
        'timeline_malaysia_desc' => 'Малайзия получила независимость от британского колониального правления 31 августа 1957 года.',
        'history_quiz' => 'Историческая викторина',
        'quiz_subtitle' => 'Проверьте свои исторические знания',
        'quiz_question1' => 'Какая древняя цивилизация построила пирамиды?',
        'quiz_option1' => 'Египтяне',
        'quiz_option2' => 'Греки',
        'quiz_option3' => 'Римляне',
        'quiz_question2' => 'Когда Малайзия получила независимость?',
        'quiz_option4' => '1957',
        'quiz_option5' => '1963',
        'quiz_option6' => '1945',
        'submit_answers' => 'Отправить ответы',
        'featured_articles' => 'Избранные статьи',
        'articles_subtitle' => 'Последние взгляды на исторические события',
        'roman_empire' => 'Падение Римской империи',
        'roman_empire_title' => 'Подробный взгляд на упадок одной из величайших империй в истории.',
        'roman_empire_desc' => 'Изучение ключевых этапов на пути Малайзии к свободе.',
        'read_more' => 'Читать далее',
        'malaysia_independence' => 'Путь Малайзии к независимости',
        'malaysia_independence_title' => 'Изучение ключевых этапов на пути Малайзии к свободе.',
        'malaysia_independence_desc' => 'Изучение ключевых этапов на пути Малайзии к свободе.'
    ],
    'pt' => [
        'meta_description' => 'Explore a história com HAF, onde o passado inspira o presente',
        'hero_title' => 'Jornada pela História',
        'hero_subtitle' => 'Descubra as histórias que moldaram civilizações com HAF',
        'nav_history' => 'História',
        'nav_world_history' => 'História Mundial',
        'nav_malaysia_history' => 'História da Malásia',
        'nav_history_game' => 'Jogo de História',
        'nav_art' => 'Arte',
        'nav_fashion' => 'Moda',
        'nav_shop' => 'Loja',
        'options_title' => 'Explorar História',
        'options_subtitle' => 'Escolha um caminho para mergulhar no passado',
        'option_world_history' => 'Explorar História Mundial',
        'option_malaysia_history' => 'Explorar História da Malásia',
        'option_history_game' => 'Jogar Jogo de História',
        'option_world_history_desc' => 'Viaje através de eventos históricos globais',
        'option_malaysia_history_desc' => 'Conheça a rica história da Malásia',
        'option_history_game_desc' => 'Teste seus conhecimentos com um jogo interativo',
        'timeline_title' => 'Linha do Tempo Histórica',
        'timeline_subtitle' => 'Eventos-chave que moldaram o mundo',
        'timeline_egypt_period' => '3100 a.C.',
        'timeline_egypt_title' => 'Ascensão do Antigo Egito',
        'timeline_egypt_desc' => 'A unificação do Alto e Baixo Egito marcou o início de uma das primeiras civilizações do mundo.',
        'timeline_rome_period' => '27 a.C.',
        'timeline_rome_title' => 'Fundação do Império Romano',
        'timeline_rome_desc' => 'Augusto tornou-se o primeiro imperador romano, iniciando um período de expansão e estabilidade.',
        'timeline_malaysia_period' => '1957',
        'timeline_malaysia_title' => 'Independência da Malásia',
        'timeline_malaysia_desc' => 'A Malásia obteve independência do domínio colonial britânico em 31 de agosto de 1957.',
        'history_quiz' => 'Quiz de História',
        'quiz_subtitle' => 'Teste seus conhecimentos históricos',
        'quiz_question1' => 'Qual civilização antiga construiu as pirâmides?',
        'quiz_option1' => 'Egípcios',
        'quiz_option2' => 'Gregos',
        'quiz_option3' => 'Romanos',
        'quiz_question2' => 'Quando a Malásia obteve independência?',
        'quiz_option4' => '1957',
        'quiz_option5' => '1963',
        'quiz_option6' => '1945',
        'submit_answers' => 'Enviar Respostas',
        'featured_articles' => 'Artigos em Destaque',
        'articles_subtitle' => 'Perspectivas atuais sobre eventos históricos',
        'roman_empire' => 'Império Romano',
        'roman_empire_title' => 'A Queda do Império Romano',
        'roman_empire_desc' => 'Uma análise profunda do declínio de um dos maiores impérios da história.',
        'read_more' => 'Ler Mais',
        'malaysia_independence' => 'Independência da Malásia',
        'malaysia_independence_title' => 'O Caminho da Malásia para a Independência',
        'malaysia_independence_desc' => 'Explorando os marcos importantes no caminho da Malásia para a liberdade.',
        'news_ticker' => 'Últimas notícias: Nova exposição sobre o Antigo Egito | Malásia celebra 68 anos de independência | Artefatos romanos descobertos na Itália',
        'theme_toggle' => 'Alternar Tema',
        'cookie_consent' => 'Usamos cookies para melhorar sua experiência. Aceite para continuar.',
        'cookie_accept' => 'Aceitar',
        'back_to_top' => 'Voltar ao Topo',
        'share_page' => 'Compartilhar Página',
        'footer_copyright' => '© 2025 História, Arte e Moda. Todos os direitos reservados.',
        'historical_video_tour' => 'Tour Histórico em Vídeo',
        'watch_guided_tour' => 'Assistir tour guiado',
        'stay_informed' => 'Mantenha-se Informado',
        'subscribe_updates' => 'Inscreva-se para atualizações históricas',
        'enter_email' => 'Digite seu e-mail',
        'subscribe' => 'Inscrever-se'
    ],
    'de' => [
        'meta_description' => 'Entdecken Sie die Tiefen der Geschichte mit HAF, wo die Vergangenheit die Gegenwart inspiriert',
        'hero_title' => 'Reise durch die Geschichte',
        'hero_subtitle' => 'Entdecken Sie die Geschichten, die Zivilisationen mit HAF geprägt haben',
        'nav_history' => 'Geschichte',
        'nav_world_history' => 'Weltgeschichte',
        'nav_malaysia_history' => 'Geschichte Malaysias',
        'nav_history_game' => 'Geschichtsspiel',
        'nav_art' => 'Kunst',
        'nav_fashion' => 'Mode',
        'nav_shop' => 'Shop',
        'options_title' => 'Geschichte erkunden',
        'options_subtitle' => 'Wählen Sie einen Weg, um in die Vergangenheit einzutauchen',
        'option_world_history' => 'Entdecken Sie die Weltgeschichte',
        'option_malaysia_history' => 'Entdecken Sie die Geschichte Malaysias',
        'option_history_game' => 'Geschichtsspiel spielen',
        'option_world_history_desc' => 'Reisen Sie durch globale historische Ereignisse',
        'option_malaysia_history_desc' => 'Erfahren Sie mehr über Malaysias reiche Vergangenheit',
        'option_history_game_desc' => 'Testen Sie Ihr Wissen mit einem interaktiven Spiel',
        'timeline_title' => 'Historische Zeitleiste',
        'timeline_subtitle' => 'Schlüsselereignisse, die die Welt geprägt haben',
        'quiz_title' => 'Geschichtsquiz',
        'quiz_subtitle' => 'Testen Sie Ihr historisches Wissen',
        'quiz_question_1' => 'Welche antike Zivilisation baute die Pyramiden?',
        'quiz_option_1a' => 'Ägypter',
        'quiz_option_1b' => 'Griechen',
        'quiz_option_1c' => 'Römer',
        'quiz_question_2' => 'Wann wurde Malaysia unabhängig?',
        'quiz_option_2a' => '1957',
        'quiz_option_2b' => '1963',
        'quiz_option_2c' => '1945',
        'quiz_submit' => 'Antworten absenden',
        'quiz_result_1' => 'Gut gemacht! Sie sind ein Geschichtsexperte!',
        'quiz_result_2' => 'Gute Arbeit! Weiter so!',
        'quiz_result_3' => 'Guter Versuch! Entdecken Sie mehr Geschichte!',
        'articles_title' => 'Ausgewählte Artikel',
        'articles_subtitle' => 'Aktuelle Einblicke in historische Ereignisse',
        'article_1_title' => 'Der Fall des Römischen Reiches',
        'article_1_desc' => 'Ein tiefer Einblick in den Niedergang eines der größten Reiche der Geschichte.',
        'article_2_title' => 'Malaysias Weg zur Unabhängigkeit',
        'article_2_desc' => 'Erkundung der wichtigsten Meilensteine auf Malaysias Weg zur Freiheit.',
        'article_read_more' => 'Mehr lesen',
        'video_title' => 'Historische Video-Tour',
        'video_subtitle' => 'Sehen Sie eine geführte Tour durch die Geschichte',
        'map_title' => 'Historische Regionen',
        'map_subtitle' => 'Erkunden Sie wichtige historische Regionen auf der Karte',
        'newsletter_title' => 'Bleiben Sie informiert',
        'newsletter_subtitle' => 'Abonnieren Sie für Geschichts-Updates',
        'newsletter_email_placeholder' => 'Geben Sie Ihre E-Mail ein',
        'newsletter_submit' => 'Abonnieren',
        'newsletter_success' => 'Danke für Ihr Abonnement!',
        'newsletter_banner' => 'Treten Sie unserer Geschichtsgemeinschaft für Updates bei!',
        'news_ticker' => 'Neueste: Neue Ausstellung über das alte Ägypten | Malaysia feiert 68 Jahre Unabhängigkeit | Römische Artefakte in Italien entdeckt',
        'theme_toggle' => 'Thema wechseln',
        'cookie_consent' => 'Wir verwenden Cookies, um Ihre Erfahrung zu verbessern. Akzeptieren Sie, um fortzufahren.',
        'cookie_accept' => 'Akzeptieren',
        'back_to_top' => 'Nach oben',
        'share_page' => 'Diese Seite teilen',
        'footer_copyright' => '© 2025 Geschichte, Kunst & Mode. Alle Rechte vorbehalten.',
        'timeline_egypt_period' => '3100 v. Chr.',
        'timeline_egypt_title' => 'Aufstieg des Alten Ägypten',
        'timeline_egypt_desc' => 'Die Vereinigung von Ober- und Unterägypten markierte den Beginn einer der ersten Zivilisationen der Welt.',
        'timeline_rome_period' => '27 v. Chr.',
        'timeline_rome_title' => 'Gründung des Römischen Reiches',
        'timeline_rome_desc' => 'Augustus wurde der erste römische Kaiser und leitete eine Phase der Expansion und Stabilität ein.',
        'timeline_malaysia_period' => '1957',
        'timeline_malaysia_title' => 'Unabhängigkeit Malaysias',
        'timeline_malaysia_desc' => 'Malaysia erlangte am 31. August 1957 die Unabhängigkeit von der britischen Kolonialherrschaft.',
        'timeline_malaysia_period' => '1957',
        'timeline_malaysia_title' => 'Malaysian Independence',
        'timeline_malaysia_desc' => 'Malaysia gained independence from British colonial rule on August 31, 1957.',
        'journey_title' => 'Reise durch die Geschichte',
        'journey_subtitle' => 'Entdecken Sie die Geschichten, die Zivilisationen mit HAF geprägt haben',
        'explore_now' => 'Entdecken Sie die Geschichte Malaysias',
        'explore_history' => 'Entdecken Sie die Geschichte Malaysias',
        'explore_subtitle' => 'Wählen Sie einen Weg, um in die Vergangenheit einzutauchen',
        'world_history' => 'Weltgeschichte',
        'world_history_desc' => 'Reisen Sie durch globale historische Ereignisse',
        'malaysia_history' => 'Geschichte Malaysias',
        'malaysia_history_desc' => 'Erfahren Sie mehr über Malaysias reiche Vergangenheit',
        'history_game' => 'Geschichtsspiel',
        'history_game_desc' => 'Testen Sie Ihr historisches Wissen mit einem interaktiven Spiel',
        'historical_timeline' => 'Historische Zeitleiste',
        'timeline_subtitle' => 'Schlüsselereignisse, die die Welt geprägt haben',
        'history_quiz' => 'Geschichtsquiz',
        'quiz_subtitle' => 'Testen Sie Ihr historisches Wissen',
        'quiz_question1' => 'Welche antike Zivilisation baute die Pyramiden?',
        'quiz_option1' => 'Ägypter',
        'quiz_option2' => 'Griechen',
        'quiz_option3' => 'Römer',
        'quiz_question2' => 'Wann wurde Malaysia unabhängig?',
        'quiz_option4' => '1957',
        'quiz_option5' => '1963',
        'quiz_option6' => '1945',
        'submit_answers' => 'Antworten absenden',
        'featured_articles' => 'Ausgewählte Artikel',
        'articles_subtitle' => 'Aktuelle Einblicke in historische Ereignisse',
        'roman_empire' => 'Der Fall des Römischen Reiches',
        'roman_empire_title' => 'Ein tiefer Einblick in den Niedergang eines der größten Reiche der Geschichte.',
        'roman_empire_desc' => 'Erkundung der wichtigsten Meilensteine auf Malaysias Weg zur Freiheit.',
        'read_more' => 'Mehr lesen',
        'malaysia_independence' => 'Malaysias Weg zur Unabhängigkeit',
        'malaysia_independence_title' => 'Erkundung der wichtigsten Meilensteine auf Malaysias Weg zur Freiheit.',
        'malaysia_independence_desc' => 'Erkundung der wichtigsten Meilensteine auf Malaysias Weg zur Freiheit.'
    ],
    'ja' => [
        'meta_description' => 'HAFとともに歴史を探索し、過去が現在にインスピレーションを与えます',
        'hero_title' => '歴史の旅',
        'hero_subtitle' => 'HAFとともに文明を形作った物語を発見しよう',
        'nav_history' => '歴史',
        'nav_world_history' => '世界史',
        'nav_malaysia_history' => 'マレーシアの歴史',
        'nav_history_game' => '歴史ゲーム',
        'nav_art' => 'アート',
        'nav_fashion' => 'ファッション',
        'nav_shop' => 'ショップ',
        'options_title' => '歴史を探索',
        'options_subtitle' => '過去に飛び込む道を選ぼう',
        'option_world_history' => '世界史を探索',
        'option_malaysia_history' => 'マレーシアの歴史を探索',
        'option_history_game' => '歴史ゲームをプレイ',
        'option_world_history_desc' => '世界の歴史的出来事を旅しよう',
        'option_malaysia_history_desc' => 'マレーシアの豊かな歴史を知ろう',
        'option_history_game_desc' => 'インタラクティブなゲームで知識を試そう',
        'timeline_title' => '歴史年表',
        'timeline_subtitle' => '世界を形作った重要な出来事',
        'timeline_egypt_period' => '紀元前3100年',
        'timeline_egypt_title' => '古代エジプトの興隆',
        'timeline_egypt_desc' => '上エジプトと下エジプトの統一は、世界最古の文明の一つが始まることを示しました。',
        'timeline_rome_period' => '紀元前27年',
        'timeline_rome_title' => 'ローマ帝国の建国',
        'timeline_rome_desc' => 'アウグストゥスが初代ローマ皇帝となり、拡張と安定の時代が始まりました。',
        'timeline_malaysia_period' => '1957年',
        'timeline_malaysia_title' => 'マレーシアの独立',
        'timeline_malaysia_desc' => 'マレーシアは1957年8月31日にイギリスの植民地支配から独立を果たしました。',
        'history_quiz' => '歴史クイズ',
        'quiz_subtitle' => '歴史の知識を試そう',
        'quiz_question_1' => 'どの古代文明がピラミッドを建てましたか？',
        'quiz_option_1a' => 'エジプト人',
        'quiz_option_1b' => 'ギリシャ人',
        'quiz_option_1c' => 'ローマ人',
        'quiz_question_2' => 'マレーシアはいつ独立しましたか？',
        'quiz_option_2a' => '1957年',
        'quiz_option_2b' => '1963年',
        'quiz_option_2c' => '1945年',
        'quiz_submit' => '回答を送信',
        'quiz_result_1' => '素晴らしい！あなたは歴史の専門家です！',
        'quiz_result_2' => 'よくできました！さらに学びましょう！',
        'quiz_result_3' => '良い試みです！もっと歴史を探求しましょう！',
        'articles_title' => '注目の記事',
        'articles_subtitle' => '歴史的な出来事への最新の洞察',
        'roman_empire' => 'ローマ帝国',
        'roman_empire_title' => 'ローマ帝国の衰退',
        'roman_empire_desc' => '歴史上最も偉大な帝国の一つが衰退していく様子を深く考察します。',
        'read_more' => '続きを読む',
        'malaysia_independence' => 'マレーシアの独立',
        'malaysia_independence_title' => 'マレーシアの独立への道のり',
        'malaysia_independence_desc' => 'マレーシアが自由への道を歩む中での重要な節目を探ります。',
        'news_ticker' => '最新：古代エジプトの新展示 | マレーシア独立68周年を祝う | イタリアでローマ時代の遺物を発見',
        'theme_toggle' => 'テーマを切り替え',
        'cookie_consent' => 'より良い体験のためにCookieを使用しています。続行するには同意してください。',
        'cookie_accept' => '同意する',
        'back_to_top' => 'トップに戻る',
        'share_page' => 'ページを共有',
        'footer_copyright' => '© 2025 歴史、アート、ファッション。全権利所有。',
        'historical_video_tour' => '歴史ビデオツアー',
        'watch_guided_tour' => 'ガイド付きツアーを見る',
        'stay_informed' => '最新情報を入手',
        'subscribe_updates' => '歴史の更新情報を購読',
        'enter_email' => 'メールアドレスを入力',
        'subscribe' => '購読'
    ],
    'hi' => [
        'meta_description' => 'HAF के साथ इतिहास की गहराई का अन्वेषण करें, जहाँ अतीत वर्तमान को प्रेरित करता है',
        'hero_title' => 'इतिहास के माध्यम से यात्रा',
        'hero_subtitle' => 'HAF के साथ उन कहानियों की खोज करें जिन्होंने सभ्यताओं को आकार दिया',
        'nav_history' => 'इतिहास',
        'nav_world_history' => 'विश्व इतिहास',
        'nav_malaysia_history' => 'मलेशिया का इतिहास',
        'nav_history_game' => 'इतिहास खेल',
        'nav_art' => 'कला',
        'nav_fashion' => 'फैशन',
        'nav_shop' => 'दुकान',
        'options_title' => 'इतिहास का अन्वेषण करें',
        'options_subtitle' => 'अतीत में डूबने के लिए एक मार्ग चुनें',
        'option_world_history' => 'विश्व इतिहास की खोज करें',
        'option_malaysia_history' => 'मलेशिया के इतिहास का अन्वेषण करें',
        'option_history_game' => 'इतिहास खेलें',
        'option_world_history_desc' => 'वैश्विक ऐतिहासिक घटनाओं के माध्यम से यात्रा',
        'option_malaysia_history_desc' => 'मलेशिया के समृद्ध अतीत के बारे में जानें',
        'option_history_game_desc' => 'इंटरएक्टिव खेल के साथ अपनी जानकारी जांचें',
        'timeline_title' => 'ऐतिहासिक समयरेखा',
        'timeline_subtitle' => 'दुनिया को आकार देने वाली प्रमुख घटनाएँ',
        'quiz_title' => 'इतिहास प्रश्नोत्तरी',
        'quiz_subtitle' => 'अपने ऐतिहासिक ज्ञान की जांच करें',
        'quiz_question_1' => 'किस प्राचीन सभ्यता ने पिरामिड बनाए थे?',
        'quiz_option_1a' => 'मिस्रवासी',
        'quiz_option_1b' => 'यूनानी',
        'quiz_option_1c' => 'रोमन',
        'quiz_question_2' => 'मलेशिया ने कब स्वतंत्रता प्राप्त की?',
        'quiz_option_2a' => '1957',
        'quiz_option_2b' => '1963',
        'quiz_option_2c' => '1945',
        'quiz_submit' => 'उत्तर सबमिट करें',
        'quiz_result_1' => 'शानदार! आप इतिहास के विशेषज्ञ हैं!',
        'quiz_result_2' => 'अच्छा प्रयास! सीखते रहें!',
        'quiz_result_3' => 'अच्छा प्रयास! और इतिहास जानें!',
        'articles_title' => 'विशेष लेख',
        'articles_subtitle' => 'ऐतिहासिक घटनाओं पर नवीनतम दृष्टिकोण',
        'article_1_title' => 'रोमन साम्राज्य का पतन',
        'article_1_desc' => 'इतिहास के सबसे बड़े साम्राज्यों में से एक के पतन पर गहन दृष्टि।',
        'article_2_title' => 'मलेशिया की स्वतंत्रता की राह',
        'article_2_desc' => 'मलेशिया की स्वतंत्रता की यात्रा के प्रमुख पड़ावों की खोज।',
        'article_read_more' => 'और पढ़ें',
        'video_title' => 'ऐतिहासिक वीडियो टूर',
        'video_subtitle' => 'इतिहास के माध्यम से एक गाइडेड टूर देखें',
        'map_title' => 'ऐतिहासिक क्षेत्र',
        'map_subtitle' => 'मानचित्र पर प्रमुख ऐतिहासिक क्षेत्रों का अन्वेषण करें',
        'newsletter_title' => 'सूचित रहें',
        'newsletter_subtitle' => 'इतिहास अपडेट के लिए सदस्यता लें',
        'newsletter_email_placeholder' => 'अपना ईमेल दर्ज करें',
        'newsletter_submit' => 'सदस्यता लें',
        'newsletter_success' => 'सदस्यता के लिए धन्यवाद!',
        'newsletter_banner' => 'अपडेट के लिए हमारे इतिहास समुदाय से जुड़ें!',
        'news_ticker' => 'नवीनतम: प्राचीन मिस्र पर नई प्रदर्शनी | मलेशिया ने 68वीं स्वतंत्रता वर्षगांठ मनाई | इटली में रोमन कलाकृतियाँ मिलीं',
        'theme_toggle' => 'थीम बदलें',
        'cookie_consent' => 'हम आपके अनुभव को बेहतर बनाने के लिए कुकीज़ का उपयोग करते हैं। जारी रखने के लिए स्वीकार करें।',
        'cookie_accept' => 'स्वीकार करें',
        'back_to_top' => 'ऊपर जाएं',
        'share_page' => 'इस पृष्ठ को साझा करें',
        'footer_copyright' => '© 2025 इतिहास, कला और फैशन। सर्वाधिकार सुरक्षित।',
        'timeline_egypt_period' => '3100 ईसा पूर्व',
        'timeline_egypt_title' => 'प्राचीन मिस्र का उदय',
        'timeline_egypt_desc' => 'ऊपरी और निचली मिस्र का एकीकरण दुनिया की पहली सभ्यताओं में से एक की शुरुआत थी।',
        'timeline_rome_period' => '27 ईसा पूर्व',
        'timeline_rome_title' => 'रोमन साम्राज्य की स्थापना',
        'timeline_rome_desc' => 'ऑगस्टस पहले रोमन सम्राट बने, जिससे विस्तार और स्थिरता का युग शुरू हुआ।',
        'timeline_malaysia_period' => '1957',
        'timeline_malaysia_title' => 'मलेशिया की स्वतंत्रता',
        'timeline_malaysia_desc' => 'मलेशिया ने 31 अगस्त 1957 को ब्रिटिश उपनिवेश शासन से स्वतंत्रता प्राप्त की।',
        'history_quiz' => 'इतिहास खेलें',
        'quiz_subtitle' => 'अपने ऐतिहासिक ज्ञान की जांच करें',
        'quiz_question1' => 'किस प्राचीन सभ्यता ने पिरामिड बनाए थे?',
        'quiz_option1' => 'मिस्रवासी',
        'quiz_option2' => 'यूनानी',
        'quiz_option3' => 'रोमन',
        'quiz_question2' => 'मलेशिया ने कब स्वतंत्रता प्राप्त की?',
        'quiz_option4' => '1957',
        'quiz_option5' => '1963',
        'quiz_option6' => '1945',
        'submit_answers' => 'उत्तर सबमिट करें',
        'featured_articles' => 'विशेष लेख',
        'articles_subtitle' => 'ऐतिहासिक घटनाओं पर नवीनतम दृष्टिकोण',
        'roman_empire' => 'रोमन साम्राज्य का पतन',
        'roman_empire_title' => 'इतिहास के सबसे बड़े साम्राज्यों में से एक के पतन पर गहन दृष्टि।',
        'roman_empire_desc' => 'मलेशिया की स्वतंत्रता की यात्रा के प्रमुख पड़ावों की खोज।',
        'read_more' => 'और पढ़ें',
        'malaysia_independence' => 'मलेशिया की स्वतंत्रता की राह',
        'malaysia_independence_title' => 'मलेशिया की स्वतंत्रता की यात्रा के प्रमुख पड़ावों की खोज।',
        'malaysia_independence_desc' => 'मलेशिया की स्वतंत्रता की यात्रा के प्रमुख पड़ावों की खोज।'
    ],
    'ta' => [
        'meta_description' => 'கிமு 3100',
        'hero_title' => 'பண்டைய எகிப்தின் எழுச்சி',
        'hero_subtitle' => 'மேல் மற்றும் கீழ் எகிப்தின் ஒருங்கிணைப்பு உலகின் முதல் நாகரிகங்களில் ஒன்றின் தொடக்கத்தைக் குறித்தது.',
        'nav_history' => 'இதிஹாஸ்',
        'nav_world_history' => 'விஶ்வ இதிஹாஸ்',
        'nav_malaysia_history' => 'மலேசிய இதிஹாஸ்',
        'nav_history_game' => 'இதிஹாஸ் விளையாட்டு',
        'nav_art' => 'நடவடிக்கை',
        'nav_fashion' => 'வட்டிக்கை',
        'nav_shop' => 'பால்கள்',
        'options_title' => 'இதிஹாஸ் அடிப்படையாக்கு',
        'options_subtitle' => 'அதிகாலத்தில் ஒரு வழியைத் தேர்ந்தெடுக்க',
        'option_world_history' => 'விஶ்வ இதிஹாஸ் அடிப்படையாக்கு',
        'option_malaysia_history' => 'மலேசிய இதிஹாஸ் அடிப்படையாக்கு',
        'option_history_game' => 'இதிஹாஸ் விளையாட்டு',
        'option_world_history_desc' => 'விரும்பிய இதிஹாஸ் நிகழ்வுகள் மூலம் இயக்கம்',
        'option_malaysia_history_desc' => 'மலேசிய வளர்ச்சியான முன்னேற்றத்தைப் பெறுதல்',
        'option_history_game_desc' => 'இடைவெளியில் உள்ள தகவல்களைப் பார்வையிட்டு அடையல்',
        'timeline_title' => 'நாட்கள் வரிசை',
        'timeline_subtitle' => 'உலகத்தை வட்டென்று அடையும் முக்கிய நிகழ்வுகள்',
        'quiz_title' => 'இதிஹாஸ் வினைவிள்ளை',
        'quiz_subtitle' => 'உங்கள் இதிஹாஸ் அறிவை சரிபார்க்க',
        'quiz_question_1' => 'எந்த முன்னிய சமூகத்தில் பிரமிட்டுகள் உருவாக்கப்பட்டது?',
        'quiz_option_1a' => 'மிஸ்ரவாஸ்திரர்',
        'quiz_option_1b' => 'யூனானி',
        'quiz_option_1c' => 'ரோமன்',
        'quiz_question_2' => 'மலேசியா எப்போது சுதந்திரம் பெற்றது?',
        'quiz_option_2a' => '1957',
        'quiz_option_2b' => '1963',
        'quiz_option_2c' => '1945',
        'quiz_submit' => 'பதில் அளிக்க',
        'quiz_result_1' => 'நல்லது! நீங்கள் இதிஹாஸ் முக்கியர் அளிக்கின்றீர்கள்!',
        'quiz_result_2' => 'நல்ல முயற்சி! நீங்கள் மேலும் கற்றுக்கொள்ளலாம்!',
        'quiz_result_3' => 'நல்ல முயற்சி! நீங்கள் மேலும் இதிஹாஸ் அறிந்துக்கொள்ளலாம்!',
        'articles_title' => 'முக்கிய நூல்கள்',
        'articles_subtitle' => 'இதிஹாஸ் நிகழ்வுகள் முன்னால் முன்னர் பார்வை',
        'article_1_title' => 'ரோமன் சாம்ராஜ்யத்தின் பதிவு',
        'article_1_desc' => 'இதிஹாஸ் முழுவது வளர்ச்சியான சாம்ராஜ்யங்களில் ஒன்றின் பதிவு மேல் பார்வையிட்டு அடையல்.',
        'article_2_title' => 'மலேசியா சுதந்திரம் கொள்கை',
        'article_2_desc' => 'மலேசியா சுதந்திரம் கொள்கை யாத்திரம் முன்னால் பார்வையிட்டு அடையல்.',
        'article_read_more' => 'மேலும் படிக்க',
        'video_title' => 'இதிஹாஸ் வீடியோ டூர்',
        'video_subtitle' => 'இதிஹாஸ் மூலம் ஒரு குறிப்பிட்ட டூர் பார்வையிட்டு அடையல்',
        'map_title' => 'இதிஹாஸ் பகுதிகள்',
        'map_subtitle' => 'படம் மீது முக்கிய இதிஹாஸ் பகுதிகள் அடிப்படையாக்கு',
        'newsletter_title' => 'முன்னோட்டம் வைத்துக்கொள்க',
        'newsletter_subtitle' => 'இதிஹாஸ் புதுப்பிக்கும் முன்னோட்டம் அடையல்',
        'newsletter_email_placeholder' => 'உங்கள் மின்னஞ்சலை உள்ளீடு செய்ய',
        'newsletter_submit' => 'புதுப்பிக்க',
        'newsletter_success' => 'புதுப்பிக்கும் முன்னோட்டம் அளிக்கின்றீர்கள்!',
        'newsletter_banner' => 'இதிஹாஸ் குடும்பத்தின் முன்னோட்டம் அடையல்!',
        'news_ticker' => 'முன்னோட்டம்: முன்னிய எகிப்தின் புதுப்பிக்கும் நிகழ்வு | மலேசியா சுதந்திரம் 68 வருடத்தின் விருந்து நிகழ்வு | இடிலியில் ரோமன் கலாக்கம் அடைந்தது',
        'theme_toggle' => 'தேம் மாற்று',
        'cookie_consent' => 'நீங்கள் விருப்பம் பெறுவதற்கு குக்குக்கையை பயன்படுத்துகின்றோம். நீங்கள் மேலும் செய்ய முடிவில் நினைவு அடையல்.',
        'cookie_accept' => 'நினைவு அடையல்',
        'back_to_top' => 'மேலே செல்ல',
        'share_page' => 'இந்த பக்கத்தை பகிர்ந்துக்கொள்க',
        'footer_copyright' => '© 2025 இதிஹாஸ், நடவடிக்கை மற்றும் வட்டிக்கை. முழு உரிமை வழங்கப்படுகின்றோம்.',
        'timeline_egypt_period' => '3100 av. J.-C.',
        'timeline_egypt_title' => 'L\'essor de l\'Égypte ancienne',
        'timeline_egypt_desc' => 'L\'unification de la Haute et de la Basse-Égypte marqua le début de l\'une des premières civilisations du monde.',
        'timeline_rome_period' => '27 av. J.-C.',
        'timeline_rome_title' => 'Fondation de l\'Empire romain',
        'timeline_rome_desc' => 'Auguste devint le premier empereur romain, initiant une période d\'expansion et de stabilité.',
        'timeline_malaysia_period' => '1957',
        'timeline_malaysia_title' => 'Indépendance de la Malaisie',
        'timeline_malaysia_desc' => 'La Malaisie obtint son indépendance de la domination coloniale britannique le 31 août 1957.',
        'timeline_malaysia_period' => '1957',
        'timeline_malaysia_title' => 'Malaysian Independence',
        'timeline_malaysia_desc' => 'Malaysia gained independence from British colonial rule on August 31, 1957.',
        'journey_title' => 'பண்டைய எகிப்தின் எழுச்சி',
        'journey_subtitle' => 'மேல் மற்றும் கீழ் எகிப்தின் ஒருங்கிணைப்பு உலகின் முதல் நாகரிகங்களில் ஒன்றின் தொடக்கத்தைக் குறித்தது.',
        'explore_now' => 'பண்டைய எகிப்தின் எழுச்சி',
        'explore_history' => 'இதிஹாஸ் அடிப்படையாக்கு',
        'explore_subtitle' => 'அதிகாலத்தில் ஒரு வழியைத் தேர்ந்தெடுக்க',
        'world_history' => 'விஶ்வ இதிஹாஸ் அடிப்படையாக்கு',
        'world_history_desc' => 'விரும்பிய இதிஹாஸ் நிகழ்வுகள் மூலம் இயக்கம்',
        'malaysia_history' => 'மலேசிய இதிஹாஸ் அடிப்படையாக்கு',
        'malaysia_history_desc' => 'மலேசிய வளர்ச்சியான முன்னேற்றத்தைப் பெறுதல்',
        'history_game' => 'இதிஹாஸ் விளையாட்டு',
        'history_game_desc' => 'இடைவெளியில் உள்ள தகவல்களைப் பார்வையிட்டு அடையல்',
        'historical_timeline' => 'நாட்கள் வரிசை',
        'timeline_subtitle' => 'உலகத்தை வட்டென்று அடையும் முக்கிய நிகழ்வுகள்',
        'history_quiz' => 'இதிஹாஸ் வினைவிள்ளை',
        'quiz_subtitle' => 'உங்கள் இதிஹாஸ் அறிவை சரிபார்க்க',
        'quiz_question1' => 'எந்த முன்னிய சமூகத்தில் பிரமிட்டுகள் உருவாக்கப்பட்டது?',
        'quiz_option1' => 'மிஸ்ரவாஸ்திரர்',
        'quiz_option2' => 'யூனானி',
        'quiz_option3' => 'ரோமன்',
        'quiz_question2' => 'மலேசியா எப்போது சுதந்திரம் பெற்றது?',
        'quiz_option4' => '1957',
        'quiz_option5' => '1963',
        'quiz_option6' => '1945',
        'submit_answers' => 'பதில் அளிக்க',
        'featured_articles' => 'முக்கிய நூல்கள்',
        'articles_subtitle' => 'இதிஹாஸ் நிகழ்வுகள் முன்னால் முன்னர் பார்வை',
        'roman_empire' => 'ரோமன் சாம்ராஜ்யத்தின் பதிவு',
        'roman_empire_title' => 'இதிஹாஸ் முழுவது வளர்ச்சியான சாம்ராஜ்யங்களில் ஒன்றின் பதிவு மேல் பார்வையிட்டு அடையல்.',
        'roman_empire_desc' => 'மலேசியா சுதந்திரம் கொள்கை யாத்திரம் முன்னால் பார்வையிட்டு அடையல்.',
        'read_more' => 'மேலும் படிக்க',
        'malaysia_independence' => 'மலேசியா சுதந்திரம் கொள்கை',
        'malaysia_independence_title' => 'மலேசியா சுதந்திரம் கொள்கை யாத்திரம் முன்னால் பார்வையிட்டு அடையல்.',
        'malaysia_independence_desc' => 'மலேசியா சுதந்திரம் கொள்கை யாத்திரம் முன்னால் பார்வையிட்டு அடையல்.'
    ]
];

// Helper function to get translations
function get_translation($lang, $key) {
    global $translations;
    if (isset($translations[$lang][$key])) {
        return $translations[$lang][$key];
    }
    return isset($translations['en'][$key]) ? $translations['en'][$key] : '';
}

// 统一所有语言key并补全缺失项（不覆盖已有翻译）
$en_keys = array_keys($translations['en']);
$missing_translations = [];
foreach ($translations as $lang => &$trans) {
    if ($lang === 'en') continue;
    foreach ($en_keys as $key) {
        if (!isset($trans[$key])) {
            $trans[$key] = $translations['en'][$key];
            $missing_translations[$lang][] = $key;
        }
    }
    // 移除多余key
    foreach (array_keys($trans) as $key) {
        if (!in_array($key, $en_keys)) {
            unset($trans[$key]);
        }
    }
}
unset($trans); // 解除引用
// 可选：输出缺失翻译的 key，方便人工补全
if (!empty($missing_translations)) {
    file_put_contents('missing_translations.log', print_r($missing_translations, true));
}
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($current_lang); ?>" dir="<?php echo $site_dir; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars(get_translation($current_lang, 'meta_description')); ?>">
    <meta property="og:title" content="HAF - <?php echo htmlspecialchars(get_translation($current_lang, 'nav_history')); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars(get_translation($current_lang, 'meta_description')); ?>">
    <meta property="og:image" content="<?php echo $slides[0]; ?>">
    <title>HAF - <?php echo htmlspecialchars(get_translation($current_lang, 'nav_history')); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@400&family=Raleway:wght@300;400;500&family=Noto+Sans+Arabic:wght@400;700&family=Noto+Sans+JP:wght@400;700&family=Noto+Sans+Deva:wght@400;700&display=swap" rel="stylesheet">
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
            min-height: 100vh;
            position: relative;
            background: var(--custom-light);
            transition: background 0.3s, color 0.3s;
            direction: <?php echo $site_dir; ?>;
        }

        [lang="zh"] body, [lang="zh"] h1, [lang="zh"] p, [lang="zh"] a {
            font-family: 'Noto Sans JP', sans-serif; /* Adjusted for Chinese compatibility */
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
            margin-bottom: 10px;
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
            color: var(--charcoal);
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

        .timeline-section {
            background: var(--seashell);
            text-align: center;
        }

        .timeline-container {
            max-width: 1000px;
            margin: 0 auto;
            position: relative;
        }

        .timeline-line {
            position: absolute;
            left: 50%;
            width: 4px;
            height: 100%;
            background: var(--old-lace);
            transform: translateX(-50%);
        }

        .timeline-item {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
            position: relative;
            padding: 20px;
        }

        .timeline-item:nth-child(odd) {
            flex-direction: row;
        }

        .timeline-item:nth-child(even) {
            flex-direction: row-reverse;
        }

        .timeline-image {
            flex: 1;
            min-width: 200px;
        }

        .timeline-image img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
        }

        .timeline-content {
            flex: 2;
            padding: 0 20px;
            text-align: left;
        }

        .timeline-content h5 {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            margin-bottom: 10px;
            line-height: 1.6;
        }

        .timeline-content p {
            font-family: 'Raleway', sans-serif;
            font-size: 1.05rem;
            color: #444;
            line-height: 1.6;
        }

        .timeline-dot {
            position: absolute;
            left: 50%;
            width: 20px;
            height: 20px;
            background: var(--papaya-whip);
            border-radius: 50%;
            transform: translateX(-50%);
            top: 50%;
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

        .articles-section {
            background: var(--seashell);
            text-align: center;
        }

        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .article-card {
            background: var(--snow);
            border: 2px solid var(--old-lace);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: var(--shadow-normal);
        }

        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .article-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .article-card h5 {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            margin-bottom: 10px;
            line-height: 1.6;
        }

        .article-card p {
            font-family: 'Raleway', sans-serif;
            font-size: 1.05rem;
            color: #666;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .article-card a {
            color: var(--charcoal);
            text-decoration: none;
            font-family: 'Raleway', sans-serif;
            font-size: 1rem;
            line-height: 1.6;
        }

        .article-card a:hover {
            color: var(--ivory);
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

        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        .video-play-btn {
            background: var(--old-lace);
            color: var(--charcoal);
            border: none;
            padding: 15px 30px;
            font-size: 1.2rem;
            border-radius: 50%;
            cursor: pointer;
            transition: background 0.3s;
        }

        .video-play-btn:hover {
            background: var(--ivory);
        }

        .map-section {
            background: var(--seashell);
            text-align: center;
        }

        .map-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .world-map {
            width: 100%;
            height: auto;
        }

        .world-map path {
            fill: var(--old-lace);
            stroke: var(--charcoal);
            stroke-width: 0.5;
            transition: fill 0.3s;
        }

        .world-map path:hover {
            fill: var(--papaya-whip);
            cursor: pointer;
        }

        .map-tooltip {
            position: absolute;
            background: var(--snow);
            color: var(--charcoal);
            padding: 10px;
            border-radius: 4px;
            box-shadow: var(--shadow-normal);
            display: none;
            font-family: 'Raleway', sans-serif;
            font-size: 1rem;
            line-height: 1.6;
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
            padding: 10px 15px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.5rem;
            z-index: 1000;
            transition: background 0.3s;
        }

        .back-to-top:hover {
            background: var(--ivory);
        }

        .share-buttons {
            text-align: center;
            margin-top: 20px;
        }

        .share-buttons a {
            margin: 0 10px;
            color: var(--charcoal);
            font-size: 1.5rem;
            transition: color 0.3s;
        }

        .share-buttons a:hover {
            color: var(--ivory);
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

            .hero {
                padding: 80px 20px;
                height: 400px;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            .options-grid, .articles-grid {
                grid-template-columns: 1fr;
            }

            .timeline-item {
                flex-direction: column;
                text-align: center;
            }

            .timeline-image {
                margin-bottom: 20px;
            }

            .timeline-line, .timeline-dot {
                display: none;
            }

            .newsletter-section form {
                flex-direction: column;
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
                <a href="shop.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_shop')); ?></a>
            </div>
            <form method="POST" class="language-form">
                <select name="lang" onchange="this.form.submit()">
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
                <button type="button" class="theme-toggle" aria-label="Toggle theme"><i class="fas fa-adjust"></i></button>
            </form>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-slideshow">
            <?php foreach ($slides as $index => $slide): ?>
                <div class="hero-slide" style="background-image: url('<?php echo htmlspecialchars($slide); ?>');" data-index="<?php echo $index; ?>"></div>
            <?php endforeach; ?>
        </div>
        <div class="hero-content">
            <h1 class="animate__animated animate__fadeInDown"><?php echo htmlspecialchars(get_translation($current_lang, 'hero_title')); ?></h1>
            <p><?php echo htmlspecialchars(get_translation($current_lang, 'hero_subtitle')); ?></p>
            <a href="#options" class="cta-button">Explore Now</a>
        </div>
        <div class="slideshow-dots"></div>
    </section>

    <section id="options" class="options-section">
        <div class="container">
            <h2><?php echo htmlspecialchars(get_translation($current_lang, 'options_title')); ?></h2>
            <p class="subtitle"><?php echo htmlspecialchars(get_translation($current_lang, 'options_subtitle')); ?></p>
            <div class="options-grid">
                <div class="option-card">
                    <img src="images/world-history.jpg" alt="World History" class="option-image">
                    <a href="world_history.php"><?php echo htmlspecialchars(get_translation($current_lang, 'option_world_history')); ?></a>
                    <div class="overlay"><?php echo htmlspecialchars(get_translation($current_lang, 'option_world_history_desc')); ?></div>
                </div>
                <div class="option-card">
                    <img src="images/malaysia-history.jpg" alt="Malaysia History" class="option-image">
                    <a href="malaysia_history.php"><?php echo htmlspecialchars(get_translation($current_lang, 'option_malaysia_history')); ?></a>
                    <div class="overlay"><?php echo htmlspecialchars(get_translation($current_lang, 'option_malaysia_history_desc')); ?></div>
                </div>
                <div class="option-card">
                    <img src="images/history-game.jpg" alt="History Game" class="option-image">
                    <a href="history_game.php"><?php echo htmlspecialchars(get_translation($current_lang, 'option_history_game')); ?></a>
                    <div class="overlay"><?php echo htmlspecialchars(get_translation($current_lang, 'option_history_game_desc')); ?></div>
                </div>
            </div>
        </div>
    </section>

    <section class="timeline-section">
        <div class="container">
            <h2><?php echo htmlspecialchars(get_translation($current_lang, 'timeline_title')); ?></h2>
            <p class="subtitle"><?php echo htmlspecialchars(get_translation($current_lang, 'timeline_subtitle')); ?></p>
            <div class="timeline-container">
                <div class="timeline-line"></div>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-image"><img src="images/timeline-11.jpg" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'timeline_egypt_title')); ?>"></div>
                    <div class="timeline-content">
                        <h5><?php echo htmlspecialchars(get_translation($current_lang, 'timeline_egypt_period')); ?> - <?php echo htmlspecialchars(get_translation($current_lang, 'timeline_egypt_title')); ?></h5>
                        <p><?php echo htmlspecialchars(get_translation($current_lang, 'timeline_egypt_desc')); ?></p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-image"><img src="images/timeline-2.jpg" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'timeline_rome_title')); ?>"></div>
                    <div class="timeline-content">
                        <h5><?php echo htmlspecialchars(get_translation($current_lang, 'timeline_rome_period')); ?> - <?php echo htmlspecialchars(get_translation($current_lang, 'timeline_rome_title')); ?></h5>
                        <p><?php echo htmlspecialchars(get_translation($current_lang, 'timeline_rome_desc')); ?></p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-image"><img src="images/timeline-3.jpg" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'timeline_malaysia_title')); ?>"></div>
                    <div class="timeline-content">
                        <h5><?php echo htmlspecialchars(get_translation($current_lang, 'timeline_malaysia_period')); ?> - <?php echo htmlspecialchars(get_translation($current_lang, 'timeline_malaysia_title')); ?></h5>
                        <p><?php echo htmlspecialchars(get_translation($current_lang, 'timeline_malaysia_desc')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="quiz-section">
        <div class="container">
            <h2><?php echo htmlspecialchars(get_translation($current_lang, 'quiz_title')); ?></h2>
            <p class="subtitle"><?php echo htmlspecialchars(get_translation($current_lang, 'quiz_subtitle')); ?></p>
            <form class="quiz-form" id="quizForm">
                <div class="question">
                    <label><?php echo htmlspecialchars(get_translation($current_lang, 'quiz_question_1')); ?></label>
                    <input type="radio" name="q1" value="a" id="q1a"><label for="q1a"><?php echo htmlspecialchars(get_translation($current_lang, 'quiz_option_1a')); ?></label><br>
                    <input type="radio" name="q1" value="b" id="q1b"><label for="q1b"><?php echo htmlspecialchars(get_translation($current_lang, 'quiz_option_1b')); ?></label><br>
                    <input type="radio" name="q1" value="c" id="q1c"><label for="q1c"><?php echo htmlspecialchars(get_translation($current_lang, 'quiz_option_1c')); ?></label>
                </div>
                <div class="question">
                    <label><?php echo htmlspecialchars(get_translation($current_lang, 'quiz_question_2')); ?></label>
                    <input type="radio" name="q2" value="a" id="q2a"><label for="q2a"><?php echo htmlspecialchars(get_translation($current_lang, 'quiz_option_2a')); ?></label><br>
                    <input type="radio" name="q2" value="b" id="q2b"><label for="q2b"><?php echo htmlspecialchars(get_translation($current_lang, 'quiz_option_2b')); ?></label><br>
                    <input type="radio" name="q2" value="c" id="q2c"><label for="q2c"><?php echo htmlspecialchars(get_translation($current_lang, 'quiz_option_2c')); ?></label>
                </div>
                <button type="submit"><?php echo htmlspecialchars(get_translation($current_lang, 'quiz_submit')); ?></button>
                <div class="quiz-result" id="quizResult"></div>
            </form>
        </div>
    </section>

    <section class="articles-section">
        <div class="container">
            <h2><?php echo htmlspecialchars(get_translation($current_lang, 'articles_title')); ?></h2>
            <p class="subtitle"><?php echo htmlspecialchars(get_translation($current_lang, 'articles_subtitle')); ?></p>
            <div class="articles-grid">
                <div class="article-card">
                    <img src="images/article-1.jpg" alt="Roman Empire">
                    <h5><?php echo htmlspecialchars(get_translation($current_lang, 'article_1_title')); ?></h5>
                    <p><?php echo htmlspecialchars(get_translation($current_lang, 'article_1_desc')); ?></p>
                    <a href="article1.php"><?php echo htmlspecialchars(get_translation($current_lang, 'article_read_more')); ?></a>
                </div>
                <div class="article-card">
                    <img src="images/article-2.jpg" alt="Malaysia Independence">
                    <h5><?php echo htmlspecialchars(get_translation($current_lang, 'article_2_title')); ?></h5>
                    <p><?php echo htmlspecialchars(get_translation($current_lang, 'article_2_desc')); ?></p>
                    <a href="article2.php"><?php echo htmlspecialchars(get_translation($current_lang, 'article_read_more')); ?></a>
                </div>
            </div>
        </div>
    </section>

    <section class="video-section">
        <div class="container">
            <h2><?php echo htmlspecialchars(get_translation($current_lang, 'video_title')); ?></h2>
            <p class="subtitle"><?php echo htmlspecialchars(get_translation($current_lang, 'video_subtitle')); ?></p>
            <div class="video-container">
                <iframe src="https://www.youtube.com/embed/ha1NneZGm7A" frameborder="0" allowfullscreen></iframe>
                <div class="video-overlay" id="videoOverlay">
                    <button class="video-play-btn" id="videoPlayBtn"><i class="fas fa-play"></i></button>
                </div>
            </div>
        </div>
    </section>
    <section class="newsletter-section">
        <div class="container">
            <h2><?php echo htmlspecialchars(get_translation($current_lang, 'newsletter_title')); ?></h2>
            <p class="subtitle"><?php echo htmlspecialchars(get_translation($current_lang, 'newsletter_subtitle')); ?></p>
            <form id="newsletterForm">
                <input type="email" name="email" placeholder="<?php echo htmlspecialchars(get_translation($current_lang, 'enter_email')); ?>" required>
                <button type="submit"><?php echo htmlspecialchars(get_translation($current_lang, 'subscribe')); ?></button>
            </form>
            <div class="newsletter-success" id="newsletterSuccess"><?php echo htmlspecialchars(get_translation($current_lang, 'newsletter_success')); ?></div>
            <div class="newsletter-banner" id="newsletterBanner">
                <p><?php echo htmlspecialchars(get_translation($current_lang, 'newsletter_banner')); ?></p>
                <a href="#newsletter-section"><?php echo htmlspecialchars(get_translation($current_lang, 'subscribe_updates')); ?></a>
                <button class="close-banner" id="closeBanner">&times;</button>
            </div>
        </div>
    </section>

    <div class="news-ticker">
        <p><?php echo htmlspecialchars(get_translation($current_lang, 'news_ticker')); ?></p>
    </div>

    <div class="cookie-consent" id="cookieConsent">
        <p><?php echo htmlspecialchars(get_translation($current_lang, 'cookie_consent')); ?></p>
        <button id="acceptCookies"><?php echo htmlspecialchars(get_translation($current_lang, 'cookie_accept')); ?></button>
    </div>

    <button class="back-to-top" id="backToTop"><i class="fas fa-arrow-up"></i></button>

    <div class="share-buttons">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://www.linkedin.com/shareArticle?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
    </div>

    <footer>
        <div class="container">
            <p><?php echo htmlspecialchars(get_translation($current_lang, 'footer_copyright')); ?></p>
        </div>
    </footer>
    <script>
        // Slideshow
        let slideIndex = 0;
        const slides = document.querySelectorAll('.hero-slide');
        const dots = document.querySelector('.slideshow-dots');
        slides.forEach((_, index) => {
            const dot = document.createElement('div');
            dot.classList.add('slideshow-dot');
            dot.addEventListener('click', () => showSlide(index));
            dots.appendChild(dot);
        });
        showSlide(slideIndex);

        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            document.querySelectorAll('.slideshow-dot').forEach(dot => dot.classList.remove('active'));
            slides[index].classList.add('active');
            document.querySelectorAll('.slideshow-dot')[index].classList.add('active');
            slideIndex = index;
        }

        setInterval(() => {
            slideIndex = (slideIndex + 1) % slides.length;
            showSlide(slideIndex);
        }, 5000);

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

        // Scroll Animations
        const sections = document.querySelectorAll('section');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });
        sections.forEach(section => observer.observe(section));

        // Quiz
        const quizForm = document.getElementById('quizForm');
        const quizResult = document.getElementById('quizResult');
        quizForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const q1 = document.querySelector('input[name="q1"]:checked');
            const q2 = document.querySelector('input[name="q2"]:checked');
            let score = 0;
            if (q1 && q1.value === 'a') score++;
            if (q2 && q2.value === 'a') score++;
            let resultText = '';
            if (score === 2) resultText = '<?php echo htmlspecialchars(get_translation($current_lang, 'quiz_result_1')); ?>';
            else if (score === 1) resultText = '<?php echo htmlspecialchars(get_translation($current_lang, 'quiz_result_2')); ?>';
            else resultText = '<?php echo htmlspecialchars(get_translation($current_lang, 'quiz_result_3')); ?>';
            quizResult.textContent = resultText;
            quizResult.style.display = 'block';
        });

        // Video
        const videoOverlay = document.getElementById('videoOverlay');
        const videoPlayBtn = document.getElementById('videoPlayBtn');
        const iframe = document.querySelector('.video-container iframe');
        videoPlayBtn.addEventListener('click', () => {
            videoOverlay.style.display = 'none';
            iframe.src += '?autoplay=1';
        });

        // Map Tooltip
        const map = document.querySelector('.world-map');
        const tooltip = document.getElementById('mapTooltip');
        map.addEventListener('mousemove', (e) => {
            const path = e.target.closest('path');
            if (path) {
                tooltip.style.display = 'block';
                tooltip.style.left = e.pageX + 10 + 'px';
                tooltip.style.top = e.pageY + 10 + 'px';
                tooltip.textContent = path.dataset.tooltip;
            }
        });
        map.addEventListener('mouseleave', () => {
            tooltip.style.display = 'none';
        });

        // Newsletter
        const newsletterForm = document.getElementById('newsletterForm');
        const newsletterSuccess = document.getElementById('newsletterSuccess');
        const newsletterBanner = document.getElementById('newsletterBanner');
        const closeBanner = document.getElementById('closeBanner');
        newsletterForm.addEventListener('submit', (e) => {
            e.preventDefault();
            newsletterSuccess.style.display = 'block';
            setTimeout(() => {
                newsletterSuccess.style.display = 'none';
                if (!localStorage.getItem('newsletterShown')) {
                    newsletterBanner.style.display = 'block';
                    localStorage.setItem('newsletterShown', 'true');
                }
            }, 2000);
        });
        closeBanner.addEventListener('click', () => {
            newsletterBanner.style.display = 'none';
        });

        // Cookie Consent
        const cookieConsent = document.getElementById('cookieConsent');
        const acceptCookies = document.getElementById('acceptCookies');
        if (!localStorage.getItem('cookiesAccepted')) {
            cookieConsent.style.display = 'block';
        }
        acceptCookies.addEventListener('click', () => {
            localStorage.setItem('cookiesAccepted', 'true');
            cookieConsent.style.display = 'none';
        });

        // Back to Top
        const backToTop = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) backToTop.style.display = 'block';
            else backToTop.style.display = 'none';
        });
        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>
</html>