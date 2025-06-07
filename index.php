<?php
session_start();

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'zh';
}

// Handle language switching
if (isset($_POST['lang'])) {
    $valid_langs = ['en', 'zh', 'es', 'ar', 'fr', 'ru', 'pt', 'de', 'ja', 'hi', 'ms'];
    $_SESSION['lang'] = in_array($_POST['lang'], $valid_langs) ? $_POST['lang'] : 'zh';
}

$current_lang = $_SESSION['lang'];
$site_dir = $current_lang === 'ar' ? 'rtl' : 'ltr';

// Define image base paths
$image_base_path = 'images/famous_artists/';
$placeholder_image = 'images/placeholder.jpg';

// Translations array
$translations = [
    'en' => [
        'meta_description' => 'HAF weaves history, art, and fashion into a timeless aesthetic journey',
        'hero_title' => 'Eternal Fusion',
        'hero_subtitle' => 'HAF weaves history, art, and fashion into a timeless aesthetic journey',
        'hero_button' => 'Discover HAF',
        'nav_history' => 'History',
        'nav_art' => 'Art',
        'nav_fashion' => 'Fashion',
        'nav_shop' => 'Shop',
        'story_title' => 'Our Story',
        'story_text_1' => 'HAF was born from a passion for aesthetics. We believe history is the foundation, art is the soul, and fashion is the expression.',
        'gallery_title' => 'Inspiration Gallery',
        'gallery_subtitle' => 'Capturing aesthetic moments, feel the creative pulse of HAF',
        'inspiration_title' => 'Inspiration Stories',
        'inspiration_subtitle' => 'From history to fashion, every moment at HAF ignites inspiration',
        'testimonials_title' => 'Voices of Our Community',
        'testimonials_subtitle' => 'HAF enthusiasts from around the globe share their experiences',
        'journey_title' => 'Brand Journey',
        'journey_subtitle' => 'HAF growth story, chronicling every step of aesthetic and creative evolution',
        'events_title' => 'Upcoming Events',
        'events_subtitle' => 'Join HAF future gatherings to experience boundless aesthetic possibilities',
        'community_title' => 'Join Our Community',
        'community_subtitle' => 'Share your HAF story and connect with global aesthetic enthusiasts',
        'community_button' => 'Share Your Story',
        'themes_title' => 'Explore Three Themes',
        'themes_subtitle' => 'History, art, and fashion—HAF opens three doors to aesthetics',
        'theme_history_title' => 'History',
        'theme_history_text' => 'Trace the glory of civilizations, feeling the depth of time.',
        'theme_history_button' => 'Step into History',
        'theme_art_title' => 'Art',
        'theme_art_text' => 'Immerse in color and creativity, exploring boundless inspiration.',
        'theme_art_button' => 'Discover Art',
        'theme_fashion_title' => 'Fashion',
        'theme_fashion_text' => 'Lead the trends, showcasing individuality and confident style.',
        'theme_fashion_button' => 'Chase Fashion',
        'cta_title' => 'Begin Your Aesthetic Journey',
        'cta_subtitle' => 'Explore HAF exclusive products, find your history, art, and fashion',
        'cta_button' => 'Shop Now',
        'footer_copyright' => '© 2025 History, Art & Fashion. All rights reserved.',
        'inspiration_events_button' => 'See Upcoming Events',
        'event_view_button' => 'View Details',
        'gallery_image_1_text' => 'Inspiration 1',
        'gallery_image_2_text' => 'Inspiration 2',
        'gallery_image_3_text' => 'Inspiration 3',
        'gallery_image_4_text' => 'Inspiration 4',
        'gallery_image_5_text' => 'Inspiration 5',
        'gallery_image_6_text' => 'Inspiration 6',
        'gallery_image_7_text' => 'Inspiration 7',
        'gallery_image_8_text' => 'Inspiration 8',
        'gallery_image_9_text' => 'Inspiration 9',
        'gallery_image_10_text' => 'Inspiration 10',
        'gallery_image_11_text' => 'Inspiration 11',
        'gallery_image_12_text' => 'Inspiration 12',
        'gallery_image_13_text' => 'Inspiration 13',
        'gallery_image_14_text' => 'Inspiration 14',
        'gallery_image_15_text' => 'Inspiration 15',
        'gallery_image_16_text' => 'Inspiration 16'
    ],
    'zh' => [
        'meta_description' => 'HAF 将历史、艺术与时尚融为一体，开启一场跨越时空的美学之旅',
        'hero_title' => '永恒交融',
        'hero_subtitle' => 'HAF 将历史、艺术与时尚融为一体，开启一场跨越时空的美学之旅',
        'hero_button' => '发现 HAF',
        'nav_history' => '历史',
        'nav_art' => '艺术',
        'nav_fashion' => '时尚',
        'nav_shop' => '商店',
        'story_title' => '我们的故事',
        'story_text_1' => 'HAF 诞生于对美学的热爱。我们相信，历史是根基，艺术是灵魂，时尚是表达。',
        'gallery_title' => '灵感画廊',
        'gallery_subtitle' => '捕捉美学瞬间，感受 HAF 的创意脉动',
        'inspiration_title' => '灵感故事',
        'inspiration_subtitle' => '从历史到时尚，HAF 的每一刻都在点燃灵感',
        'testimonials_title' => '用户心声',
        'testimonials_subtitle' => '来自全球的 HAF 爱好者分享他们的体验',
        'journey_title' => '品牌历程',
        'journey_subtitle' => 'HAF 的成长故事，记录美学与创意的每一步',
        'events_title' => '活动预告',
        'events_subtitle' => '加入 HAF 的未来盛会，感受美学的无限可能',
        'community_title' => '加入我们的社区',
        'community_subtitle' => '分享你的 HAF 故事，与全球美学爱好者连接',
        'community_button' => '分享你的故事',
        'themes_title' => '探索三大主题',
        'themes_subtitle' => '历史、艺术、时尚，HAF 为你打开三扇美学之门',
        'theme_history_title' => '历史',
        'theme_history_text' => '追溯文明的辉煌，感受时间的深邃与厚重。',
        'theme_history_button' => '走进历史',
        'theme_art_title' => '艺术',
        'theme_art_text' => '浸入色彩与创意，探索灵感的无限可能。',
        'theme_art_button' => '发现艺术',
        'theme_fashion_title' => '时尚',
        'theme_fashion_text' => '引领潮流的步伐，展现个性与自信的风格。',
        'theme_fashion_button' => '追逐时尚',
        'cta_title' => '开启你的美学之旅',
        'cta_subtitle' => '探索 HAF 的独家商品，找到属于你的历史、艺术与时尚',
        'cta_button' => '立即选购',
        'footer_copyright' => '© 2025 历史、艺术与时尚。保留所有权利。',
        'inspiration_events_button' => '查看活动',
        'event_view_button' => '查看详情',
        'inspiration_title_1' => '历史的回响',
        'inspiration_text_1' => '古老文物诉说千年往事，启发我们珍惜每一段传承。',
        'inspiration_title_2' => '艺术的火花',
        'inspiration_text_2' => '一抹色彩，一笔勾勒，艺术赋予生活无限可能。',
        'inspiration_title_3' => '时尚的脉动',
        'inspiration_text_3' => '潮流是自信的表达，HAF 让你成为风尚的引领者。',
        'testimonial_text_1' => 'HAF 的设计让我感受到历史的深邃与现代的活力，太棒了！',
        'testimonial_name_1' => '李明',
        'testimonial_text_2' => '艺术与时尚的完美结合，HAF 让我重新定义了美学！',
        'testimonial_name_2' => '张丽',
        'testimonial_text_3' => '每件商品都像一件艺术品，HAF 是我的灵感源泉！',
        'testimonial_name_3' => '王强',
        'journey_title_1' => '2018 - 诞生',
        'journey_text_1' => 'HAF 成立，致力于融合历史、艺术与时尚。',
        'journey_title_2' => '2020 - 首次展览',
        'journey_text_2' => '全球首展，展示跨学科设计作品。',
        'journey_title_3' => '2023 - 扩展',
        'journey_text_3' => '携新系列进军亚洲市场。',
        'journey_title_4' => '2025 - 未来',
        'journey_text_4' => '持续创新，定义美学新篇章。',
        'gallery_image_1_text' => '灵感一',
        'gallery_image_2_text' => '灵感二',
        'gallery_image_3_text' => '灵感三',
        'gallery_image_4_text' => '灵感四',
        'gallery_image_5_text' => '灵感五',
        'gallery_image_6_text' => '灵感六',
        'gallery_image_7_text' => '灵感七',
        'gallery_image_8_text' => '灵感八',
        'gallery_image_9_text' => '灵感九',
        'gallery_image_10_text' => '灵感十',
        'gallery_image_11_text' => '灵感十一',
        'gallery_image_12_text' => '灵感十二',
        'gallery_image_13_text' => '灵感十三',
        'gallery_image_14_text' => '灵感十四',
        'gallery_image_15_text' => '灵感十五',
        'gallery_image_16_text' => '灵感十六',
        'event_title_1' => '历史回顾展',
        'event_text_1' => '探索古代文明与现代设计的对话。',
        'event_title_2' => '艺术工作坊',
        'event_text_2' => '动手创作，释放你的艺术潜能。',
        'event_title_3' => '时尚发布会',
        'event_text_3' => '见证 HAF 2025 新品系列首发。'
    ],
    'es' => [
        'meta_description' => 'HAF teje historia, arte y moda en un viaje estético atemporal',
        'hero_title' => 'Fusión Eterna',
        'hero_subtitle' => 'HAF teje historia, arte y moda en un viaje estético atemporal',
        'hero_button' => 'Descubrir HAF',
        'nav_history' => 'Historia',
        'nav_art' => 'Arte',
        'nav_fashion' => 'Moda',
        'nav_shop' => 'Tienda',
        'story_title' => 'Nuestra Historia',
        'story_text_1' => 'HAF nació de una pasión por la estética. Creemos que la historia es la base, el arte es el alma y la moda es la expresión.',
        'gallery_title' => 'Galería de Inspiración',
        'gallery_subtitle' => 'Capturando momentos estéticos, siente el pulso creativo de HAF',
        'inspiration_title' => 'Histórias de Inspiração',
        'inspiration_subtitle' => 'Da história à moda, cada momento na HAF acende a inspiração',
        'testimonials_title' => 'Vozes da Nossa Comunidade',
        'testimonials_subtitle' => 'Entusiastas da HAF de todo o mundo compartilham suas experiências',
        'journey_title' => 'Jornada da Marca',
        'journey_subtitle' => 'História de crescimento da HAF, documentando cada passo da evolução estética e criativa',
        'events_title' => 'Próximos Eventos',
        'events_subtitle' => 'Junte-se aos futuros encontros da HAF para experimentar possibilidades estéticas sem limites',
        'community_title' => 'Junte-se à Nossa Comunidade',
        'community_subtitle' => 'Compartilhe sua história da HAF e conecte-se com entusiastas estéticos globais',
        'community_button' => 'Compartilhe Sua História',
        'themes_title' => 'Explore Três Temas',
        'themes_subtitle' => 'História, arte e moda—HAF abre três portas para a estética',
        'theme_history_title' => 'História',
        'theme_history_text' => 'Rastreie a glória das civilizações, sentindo a profundidade do tempo.',
        'theme_history_button' => 'Entre na História',
        'theme_art_title' => 'Arte',
        'theme_art_text' => 'Mergulhe na cor e criatividade, explorando inspiração sem limites.',
        'theme_art_button' => 'Descubra a Arte',
        'theme_fashion_title' => 'Moda',
        'theme_fashion_text' => 'Lidere as tendências, mostrando individualidade e estilo confiante.',
        'theme_fashion_button' => 'Siga a Moda',
        'cta_title' => 'Comece Sua Jornada Estética',
        'cta_subtitle' => 'Explore produtos exclusivos da HAF, encontre sua história, arte e moda',
        'cta_button' => 'Compre Agora',
        'footer_copyright' => '© 2025 História, Arte & Moda. Todos os direitos reservados.',
        'inspiration_events_button' => 'Ver Próximos Eventos',
        'event_view_button' => 'Ver Detalhes',
        'gallery_image_1_text' => 'Inspiración 1',
        'gallery_image_2_text' => 'Inspiración 2',
        'gallery_image_3_text' => 'Inspiración 3',
        'gallery_image_4_text' => 'Inspiración 4',
        'gallery_image_5_text' => 'Inspiración 5',
        'gallery_image_6_text' => 'Inspiración 6',
        'gallery_image_7_text' => 'Inspiración 7',
        'gallery_image_8_text' => 'Inspiración 8',
        'gallery_image_9_text' => 'Inspiración 9',
        'gallery_image_10_text' => 'Inspiración 10',
        'gallery_image_11_text' => 'Inspiración 11',
        'gallery_image_12_text' => 'Inspiración 12',
        'gallery_image_13_text' => 'Inspiración 13',
        'gallery_image_14_text' => 'Inspiración 14',
        'gallery_image_15_text' => 'Inspiración 15',
        'gallery_image_16_text' => 'Inspiración 16'
    ],
    'ar' => [
        'meta_description' => 'HAF ينسج التاريخ والفن والموضة في رحلة جمالية خالدة',
        'hero_title' => 'الاندماج الأبدي',
        'hero_subtitle' => 'HAF ينسج التاريخ والفن والموضة في رحلة جمالية خالدة',
        'hero_button' => 'اكتشف HAF',
        'nav_history' => 'التاريخ',
        'nav_art' => 'الفن',
        'nav_fashion' => 'الموضة',
        'nav_shop' => 'المتجر',
        'story_title' => 'قصتنا',
        'story_text_1' => 'ولد HAF من شغف بالجماليات. نؤمن أن التاريخ هو الأساس، والفن هو الروح، والموضة هي التعبير.',
        'gallery_title' => 'معرض الإلهام',
        'gallery_subtitle' => 'التقاط لحظات جمالية، اشعر بنبض HAF الإبداعي',
        'inspiration_title' => 'قصص الإلهام',
        'inspiration_subtitle' => 'من التاريخ إلى الموضة، كل لحظة في HAF تشعل الإلهام',
        'testimonials_title' => 'أصوات مجتمعنا',
        'testimonials_subtitle' => 'متحمسو HAF من جميع أنحاء العالم يشاركون تجاربهم',
        'journey_title' => 'رحلة العلامة التجارية',
        'journey_subtitle' => 'قصة نمو HAF، توثيق كل خطوة في التطور الجمالي والإبداعي',
        'events_title' => 'الأحداث القادمة',
        'events_subtitle' => 'انضم إلى تجمعات HAF المستقبلية لتجربة إمكانيات جمالية لا حدود لها',
        'community_title' => 'انضم إلى مجتمعنا',
        'community_subtitle' => 'شارك قصتك مع HAF واتصل بمتحمسي الجماليات العالميين',
        'community_button' => 'شارك قصتك',
        'themes_title' => 'استكشف ثلاثة مواضيع',
        'themes_subtitle' => 'التاريخ والفن والموضة—HAF يفتح ثلاثة أبواب للجماليات',
        'theme_history_title' => 'التاريخ',
        'theme_history_text' => 'تتبع مجد الحضارات، اشعر بعمق الزمن.',
        'theme_history_button' => 'خطو في التاريخ',
        'theme_art_title' => 'الفن',
        'theme_art_text' => 'انغمس في اللون والإبداع، استكشف إلهاماً لا حدود له.',
        'theme_art_button' => 'اكتشف الفن',
        'theme_fashion_title' => 'الموضة',
        'theme_fashion_text' => 'قُد الاتجاهات، اعرض الفردية والأسلوب الواثق.',
        'theme_fashion_button' => 'اتبع الموضة',
        'cta_title' => 'ابدأ رحلتك الجمالية',
        'cta_subtitle' => 'استكشف منتجات HAF الحصرية، ابحث عن تاريخك وفنك وموضتك',
        'cta_button' => 'تسوق الآن',
        'footer_copyright' => '© 2025 التاريخ والفن والموضة. جميع الحقوق محفوظة.',
        'inspiration_events_button' => 'شاهد الأحداث القادمة',
        'event_view_button' => 'عرض التفاصيل',
        'gallery_image_1_text' => 'إلهام 1',
        'gallery_image_2_text' => 'إلهام 2',
        'gallery_image_3_text' => 'إلهام 3',
        'gallery_image_4_text' => 'إلهام 4',
        'gallery_image_5_text' => 'إلهام 5',
        'gallery_image_6_text' => 'إلهام 6',
        'gallery_image_7_text' => 'إلهام 7',
        'gallery_image_8_text' => 'إلهام 8',
        'gallery_image_9_text' => 'إلهام 9',
        'gallery_image_10_text' => 'إلهام 10',
        'gallery_image_11_text' => 'إلهام 11',
        'gallery_image_12_text' => 'إلهام 12',
        'gallery_image_13_text' => 'إلهام 13',
        'gallery_image_14_text' => 'إلهام 14',
        'gallery_image_15_text' => 'إلهام 15',
        'gallery_image_16_text' => 'إلهام 16',
        'testimonial_text_1' => 'تصاميم HAF جعلتني أشعر بعمق التاريخ وحيوية العصر الحديث، رائعة حقًا!',
        'testimonial_name_1' => 'محمد علي',
        'testimonial_text_2' => 'الدمج المثالي بين الفن والموضة، HAF أعاد تعريف الجمال بالنسبة لي!',
        'testimonial_name_2' => 'سارة أحمد',
        'testimonial_text_3' => 'كل منتج كأنه قطعة فنية، HAF هو مصدر إلهامي!',
        'testimonial_name_3' => 'خالد يوسف',
        'journey_title_1' => '2018 - التأسيس',
        'journey_text_1' => 'تأسست HAF بهدف دمج التاريخ والفن والموضة.',
        'journey_title_2' => '2020 - أول معرض',
        'journey_text_2' => 'الظهور العالمي الأول، عرض تصاميم متعددة التخصصات.',
        'journey_title_3' => '2023 - التوسع',
        'journey_text_3' => 'دخول الأسواق الآسيوية بسلسلة جديدة.',
        'journey_title_4' => '2025 - المستقبل',
        'journey_text_4' => 'مواصلة الابتكار، وكتابة فصل جديد في الجماليات.',
        'event_title_1' => 'استعراض تاريخي',
        'event_text_1' => 'استكشاف الحوار بين الحضارات القديمة والتصميم الحديث.',
        'event_title_2' => 'ورشة عمل فنية',
        'event_text_2' => 'ابتكر بيدك، وأطلق العنان لإمكاناتك الفنية.',
        'event_title_3' => 'إطلاق الموضة',
        'event_text_3' => 'شاهد إطلاق مجموعة HAF 2025.'
    ],
    'fr' => [
        'meta_description' => 'HAF tisse histoire, art et mode en un voyage esthétique intemporel',
        'hero_title' => 'Fusion Éternelle',
        'hero_subtitle' => 'HAF tisse histoire, art et mode en un voyage esthétique intemporel',
        'hero_button' => 'Découvrir HAF',
        'nav_history' => 'Histoire',
        'nav_art' => 'Art',
        'nav_fashion' => 'Mode',
        'nav_shop' => 'Boutique',
        'story_title' => 'Notre Histoire',
        'story_text_1' => 'HAF est né d\'une passion pour l\'esthétique. Nous croyons que l\'histoire est le fondement, l\'art est l\'âme et la mode est l\'expression.',
        'gallery_title' => 'Galerie d\'Inspiration',
        'gallery_subtitle' => 'Capturant des moments esthétiques, ressentez le pouls créatif de HAF',
        'inspiration_title' => 'Histoires d\'Inspiration',
        'inspiration_subtitle' => 'De l\'histoire à la mode, chaque moment chez HAF enflamme l\'inspiration',
        'testimonials_title' => 'Voix de Notre Communauté',
        'testimonials_subtitle' => 'Les passionnés de HAF du monde entier partagent leurs expériences',
        'journey_title' => 'Parcours de la Marque',
        'journey_subtitle' => 'Histoire de croissance de HAF, documentant chaque étape de l\'évolution esthétique et créative',
        'events_title' => 'Événements à Venir',
        'events_subtitle' => 'Rejoignez les futures rencontres de HAF pour expérimenter des possibilités esthétiques sans limites',
        'community_title' => 'Rejoignez Notre Communauté',
        'community_subtitle' => 'Partagez votre histoire HAF et connectez-vous avec des passionnés d\'esthétique du monde entier',
        'community_button' => 'Partagez Votre Histoire',
        'themes_title' => 'Explorez Trois Thèmes',
        'themes_subtitle' => 'Histoire, art et mode—HAF ouvre trois portes vers l\'esthétique',
        'theme_history_title' => 'Histoire',
        'theme_history_text' => 'Retracez la gloire des civilisations, ressentez la profondeur du temps.',
        'theme_history_button' => 'Plongez dans l\'Histoire',
        'theme_art_title' => 'Art',
        'theme_art_text' => 'Immergez-vous dans la couleur et la créativité, explorez une inspiration sans limites.',
        'theme_art_button' => 'Découvrez l\'Art',
        'theme_fashion_title' => 'Mode',
        'theme_fashion_text' => 'Menez les tendances, montrez votre individualité et votre style confiant.',
        'theme_fashion_button' => 'Suivez la Mode',
        'cta_title' => 'Commencez Votre Voyage Esthétique',
        'cta_subtitle' => 'Explorez les produits exclusifs de HAF, trouvez votre histoire, art et mode',
        'cta_button' => 'Achetez Maintenant',
        'footer_copyright' => '© 2025 Histoire, Art & Mode. Tous droits réservés.',
        'inspiration_events_button' => 'Voir les Événements à Venir',
        'event_view_button' => 'Voir les Détails',
        'gallery_image_1_text' => 'Inspiration 1',
        'gallery_image_2_text' => 'Inspiration 2',
        'gallery_image_3_text' => 'Inspiration 3',
        'gallery_image_4_text' => 'Inspiration 4',
        'gallery_image_5_text' => 'Inspiration 5',
        'gallery_image_6_text' => 'Inspiration 6',
        'gallery_image_7_text' => 'Inspiration 7',
        'gallery_image_8_text' => 'Inspiration 8',
        'gallery_image_9_text' => 'Inspiration 9',
        'gallery_image_10_text' => 'Inspiration 10',
        'gallery_image_11_text' => 'Inspiration 11',
        'gallery_image_12_text' => 'Inspiration 12',
        'gallery_image_13_text' => 'Inspiration 13',
        'gallery_image_14_text' => 'Inspiration 14',
        'gallery_image_15_text' => 'Inspiration 15',
        'gallery_image_16_text' => 'Inspiration 16',
        'inspiration_title_1' => 'Échos de l\'Histoire',
        'inspiration_text_1' => 'Les artefacts anciens racontent des millénaires d\'histoire, nous inspirant à chérir chaque héritage.',
        'inspiration_title_2' => 'Étincelle d\'Art',
        'inspiration_text_2' => 'Un trait de couleur, une seule ligne—l\'art ouvre des possibilités infinies à la vie.',
        'inspiration_title_3' => 'Battement de la Mode',
        'inspiration_text_3' => 'Les tendances sont des expressions de confiance ; HAF fait de vous un leader du style.',
        'testimonial_text_1' => 'Les créations HAF allient la profondeur de l\'histoire à la modernité—tout simplement superbe !',
        'testimonial_name_1' => 'Jean Martin',
        'testimonial_text_2' => 'La fusion parfaite de l\'art et de la mode ; HAF a redéfini l\'esthétique pour moi !',
        'testimonial_name_2' => 'Marie Dubois',
        'testimonial_text_3' => 'Chaque article est une œuvre d\'art ; HAF est ma source d\'inspiration !',
        'testimonial_name_3' => 'Luc Moreau',
        'journey_title_1' => '2018 - Fondation',
        'journey_text_1' => 'HAF a été fondée, dédiée à la fusion de l\'histoire, de l\'art et de la mode.',
        'journey_title_2' => '2020 - Première Exposition',
        'journey_text_2' => 'Première mondiale, présentant des créations interdisciplinaires.',
        'journey_title_3' => '2023 - Expansion',
        'journey_text_3' => 'Entrée sur le marché asiatique avec une nouvelle collection.',
        'journey_title_4' => '2025 - Futur',
        'journey_text_4' => 'Poursuite de l\'innovation, définissant un nouveau chapitre esthétique.',
        'event_title_1' => 'Rétrospective Historique',
        'event_text_1' => 'Explorez les dialogues entre civilisations anciennes et design moderne.',
        'event_title_2' => 'Atelier d\'Art',
        'event_text_2' => 'Créez de vos mains, libérez votre potentiel artistique.',
        'event_title_3' => 'Lancement de Mode',
        'event_text_3' => 'Assistez au lancement de la collection HAF 2025.'
    ],
    'ru' => [
        'meta_description' => 'HAF сплетает историю, искусство и моду в вечное эстетическое путешествие',
        'hero_title' => 'Вечное Слияние',
        'hero_subtitle' => 'HAF сплетает историю, искусство и моду в вечное эстетическое путешествие',
        'hero_button' => 'Открыть HAF',
        'nav_history' => 'История',
        'nav_art' => 'Искусство',
        'nav_fashion' => 'Мода',
        'nav_shop' => 'Магазин',
        'story_title' => 'Наша История',
        'story_text_1' => 'HAF родился из страсти к эстетике. Мы верим, что история - это основа, искусство - это душа, а мода - это выражение.',
        'gallery_title' => 'Галерея Вдохновения',
        'gallery_subtitle' => 'Захватывая эстетические моменты, почувствуйте творческий пульс HAF',
        'inspiration_title' => 'Истории Вдохновения',
        'inspiration_subtitle' => 'От истории к моде, каждый момент в HAF зажигает вдохновение',
        'testimonials_title' => 'Голоса Нашего Сообщества',
        'testimonials_subtitle' => 'Энтузиасты HAF со всего мира делятся своим опытом',
        'journey_title' => 'Путь Бренда',
        'journey_subtitle' => 'История роста HAF, документирующая каждый шаг эстетической и творческой эволюции',
        'events_title' => 'Предстоящие События',
        'events_subtitle' => 'Присоединяйтесь к будущим встречам HAF, чтобы испытать безграничные эстетические возможности',
        'community_title' => 'Присоединяйтесь к Нашему Сообществу',
        'community_subtitle' => 'Поделитесь своей историей HAF и общайтесь с энтузиастами эстетики со всего мира',
        'community_button' => 'Поделиться Историей',
        'themes_title' => 'Исследуйте Три Темы',
        'themes_subtitle' => 'История, искусство и мода—HAF открывает три двери в эстетику',
        'theme_history_title' => 'История',
        'theme_history_text' => 'Проследите славу цивилизаций, почувствуйте глубину времени.',
        'theme_history_button' => 'Шаг в Историю',
        'theme_art_title' => 'Искусство',
        'theme_art_text' => 'Погрузитесь в цвет и творчество, исследуйте безграничное вдохновение.',
        'theme_art_button' => 'Открыть Искусство',
        'theme_fashion_title' => 'Мода',
        'theme_fashion_text' => 'Ведите тренды, демонстрируйте индивидуальность и уверенный стиль.',
        'theme_fashion_button' => 'Следовать Моде',
        'cta_title' => 'Начните Свое Эстетическое Путешествие',
        'cta_subtitle' => 'Исследуйте эксклюзивные продукты HAF, найдите свою историю, искусство и моду',
        'cta_button' => 'Купить Сейчас',
        'footer_copyright' => '© 2025 История, Искусство и Мода. Все права защищены.',
        'inspiration_events_button' => 'Смотреть Предстоящие События',
        'event_view_button' => 'Просмотр Деталей',
        'gallery_image_1_text' => 'Вдохновение 1',
        'gallery_image_2_text' => 'Вдохновение 2',
        'gallery_image_3_text' => 'Вдохновение 3',
        'gallery_image_4_text' => 'Вдохновение 4',
        'gallery_image_5_text' => 'Вдохновение 5',
        'gallery_image_6_text' => 'Вдохновение 6',
        'gallery_image_7_text' => 'Вдохновение 7',
        'gallery_image_8_text' => 'Вдохновение 8',
        'gallery_image_9_text' => 'Вдохновение 9',
        'gallery_image_10_text' => 'Вдохновение 10',
        'gallery_image_11_text' => 'Вдохновение 11',
        'gallery_image_12_text' => 'Вдохновение 12',
        'gallery_image_13_text' => 'Вдохновение 13',
        'gallery_image_14_text' => 'Вдохновение 14',
        'gallery_image_15_text' => 'Вдохновение 15',
        'gallery_image_16_text' => 'Вдохновение 16',
        'inspiration_title_1' => 'Эхо Истории',
        'inspiration_text_1' => 'Древние артефакты рассказывают истории тысячелетий, вдохновляя нас ценить каждое наследие.',
        'inspiration_title_2' => 'Искра Искусства',
        'inspiration_text_2' => 'Мазок цвета, одна линия—искусство открывает бесконечные возможности для жизни.',
        'inspiration_title_3' => 'Пульс Моды',
        'inspiration_text_3' => 'Тренды — это выражение уверенности; HAF делает вас лидером стиля.',
        'testimonial_text_1' => 'Дизайны HAF сочетают глубину истории с современной яркостью—просто потрясающе!',
        'testimonial_name_1' => 'Алексей Иванов',
        'testimonial_text_2' => 'Идеальное слияние искусства и моды; HAF переопределил эстетику для меня!',
        'testimonial_name_2' => 'Мария Смирнова',
        'testimonial_text_3' => 'Каждый предмет как произведение искусства; HAF — мой источник вдохновения!',
        'testimonial_name_3' => 'Ирина Кузнецова',
        'journey_title_1' => '2018 - Основание',
        'journey_text_1' => 'HAF была основана для объединения истории, искусства и моды.',
        'journey_title_2' => '2020 - Первая выставка',
        'journey_text_2' => 'Мировой дебют, показ междисциплинарных дизайнов.',
        'journey_title_3' => '2023 - Расширение',
        'journey_text_3' => 'Выход на азиатский рынок с новой коллекцией.',
        'journey_title_4' => '2025 - Будущее',
        'journey_text_4' => 'Продолжаем инновации, открывая новую главу в эстетике.',
        'event_title_1' => 'Исторический Обзор',
        'event_text_1' => 'Изучайте диалоги между древними цивилизациями и современным дизайном.',
        'event_title_2' => 'Арт-Воркшоп',
        'event_text_2' => 'Творите своими руками, раскрывая свой художественный потенциал.',
        'event_title_3' => 'Показ Моды',
        'event_text_3' => 'Станьте свидетелем дебюта коллекции HAF 2025.'
    ],
    'de' => [
        'meta_description' => 'HAF verwebt Geschichte, Kunst und Mode zu einer zeitlosen ästhetischen Reise',
        'hero_title' => 'Ewige Fusion',
        'hero_subtitle' => 'HAF verwebt Geschichte, Kunst und Mode zu einer zeitlosen ästhetischen Reise',
        'hero_button' => 'HAF Entdecken',
        'nav_history' => 'Geschichte',
        'nav_art' => 'Kunst',
        'nav_fashion' => 'Mode',
        'nav_shop' => 'Shop',
        'story_title' => 'Unsere Geschichte',
        'story_text_1' => 'HAF wurde aus einer Leidenschaft für Ästhetik geboren. Wir glauben, dass Geschichte das Fundament ist, Kunst die Seele und Mode der Ausdruck.',
        'gallery_title' => 'Inspirationsgalerie',
        'gallery_subtitle' => 'Ästhetische Momente einfangen, den kreativen Puls von HAF spüren',
        'inspiration_title' => 'Inspirationsgeschichten',
        'inspiration_subtitle' => 'Von Geschichte bis Mode, jeder Moment bei HAF entfacht Inspiration',
        'testimonials_title' => 'Stimmen unserer Gemeinschaft',
        'testimonials_subtitle' => 'HAF-Enthusiasten aus der ganzen Welt teilen ihre Erfahrungen',
        'journey_title' => 'Markenreise',
        'journey_subtitle' => 'HAF Wachstumsgeschichte, dokumentiert jeden Schritt der ästhetischen und kreativen Evolution',
        'events_title' => 'Kommende Veranstaltungen',
        'events_subtitle' => 'Nehmen Sie an zukünftigen HAF-Treffen teil, um grenzenlose ästhetische Möglichkeiten zu erleben',
        'community_title' => 'Werden Sie Teil unserer Gemeinschaft',
        'community_subtitle' => 'Teilen Sie Ihre HAF-Geschichte und vernetzen Sie sich mit globalen Ästhetik-Enthusiasten',
        'community_button' => 'Teilen Sie Ihre Geschichte',
        'themes_title' => 'Entdecken Sie drei Themen',
        'themes_subtitle' => 'Geschichte, Kunst und Mode—HAF öffnet drei Türen zur Ästhetik',
        'theme_history_title' => 'Geschichte',
        'theme_history_text' => 'Verfolgen Sie den Ruhm der Zivilisationen, spüren Sie die Tiefe der Zeit.',
        'theme_history_button' => 'Eintauchen in die Geschichte',
        'theme_art_title' => 'Kunst',
        'theme_art_text' => 'Tauchen Sie ein in Farbe und Kreativität, erkunden Sie grenzenlose Inspiration.',
        'theme_art_button' => 'Kunst entdecken',
        'theme_fashion_title' => 'Mode',
        'theme_fashion_text' => 'Führen Sie Trends an, zeigen Sie Individualität und selbstbewussten Stil.',
        'theme_fashion_button' => 'Mode folgen',
        'cta_title' => 'Beginnen Sie Ihre ästhetische Reise',
        'cta_subtitle' => 'Entdecken Sie exklusive HAF-Produkte, finden Sie Ihre Geschichte, Kunst und Mode',
        'cta_button' => 'Jetzt einkaufen',
        'footer_copyright' => '© 2025 Geschichte, Kunst & Mode. Alle Rechte vorbehalten.',
        'inspiration_events_button' => 'Kommende Veranstaltungen ansehen',
        'event_view_button' => 'Details anzeigen',
        'gallery_image_1_text' => 'Inspiration 1',
        'gallery_image_2_text' => 'Inspiration 2',
        'gallery_image_3_text' => 'Inspiration 3',
        'gallery_image_4_text' => 'Inspiration 4',
        'gallery_image_5_text' => 'Inspiration 5',
        'gallery_image_6_text' => 'Inspiration 6',
        'gallery_image_7_text' => 'Inspiration 7',
        'gallery_image_8_text' => 'Inspiration 8',
        'gallery_image_9_text' => 'Inspiration 9',
        'gallery_image_10_text' => 'Inspiration 10',
        'gallery_image_11_text' => 'Inspiration 11',
        'gallery_image_12_text' => 'Inspiration 12',
        'gallery_image_13_text' => 'Inspiration 13',
        'gallery_image_14_text' => 'Inspiration 14',
        'gallery_image_15_text' => 'Inspiration 15',
        'gallery_image_16_text' => 'Inspiration 16',
        'inspiration_title_1' => 'Echos der Geschichte',
        'inspiration_text_1' => 'Antike Artefakte erzählen Geschichten von Jahrtausenden und inspirieren uns, jedes Erbe zu schätzen.',
        'inspiration_title_2' => 'Funke der Kunst',
        'inspiration_text_2' => 'Ein Pinselstrich, eine Linie—Kunst eröffnet unendliche Möglichkeiten für das Leben.',
        'inspiration_title_3' => 'Puls der Mode',
        'inspiration_text_3' => 'Trends sind Ausdruck von Selbstvertrauen; HAF macht Sie zum Stilführer.',
        'testimonial_text_1' => 'HAF-Designs verbinden die Tiefe der Geschichte mit moderner Lebendigkeit—einfach atemberaubend!',
        'testimonial_name_1' => 'Hans Müller',
        'testimonial_text_2' => 'Die perfekte Verschmelzung von Kunst und Mode; HAF hat Ästhetik für mich neu definiert!',
        'testimonial_name_2' => 'Anna Schmidt',
        'testimonial_text_3' => 'Jedes Stück fühlt sich wie ein Kunstwerk an; HAF ist meine Inspirationsquelle!',
        'testimonial_name_3' => 'Michael Weber',
        'journey_title_1' => '2018 - Gründung',
        'journey_text_1' => 'HAF wurde gegründet, um Geschichte, Kunst und Mode zu vereinen.',
        'journey_title_2' => '2020 - Erste Ausstellung',
        'journey_text_2' => 'Weltpremiere, Präsentation interdisziplinärer Designs.',
        'journey_title_3' => '2023 - Expansion',
        'journey_text_3' => 'Eintritt in den asiatischen Markt mit einer neuen Kollektion.',
        'journey_title_4' => '2025 - Zukunft',
        'journey_text_4' => 'Ständige Innovation, ein neues Kapitel der Ästhetik definierend.',
        'event_title_1' => 'Historischer Rückblick',
        'event_text_1' => 'Erkunden Sie Dialoge zwischen antiken Zivilisationen und modernem Design.',
        'event_title_2' => 'Kunstwerkstatt',
        'event_text_2' => 'Kreativ werden, Ihr künstlerisches Potenzial entfalten.',
        'event_title_3' => 'Modepremiere',
        'event_text_3' => 'Erleben Sie die Premiere der HAF 2025 Kollektion.'
    ],
    'ja' => [
        'meta_description' => 'HAFは歴史、アート、ファッションを永遠の美の旅へと織りなします',
        'hero_title' => '永遠の融合',
        'hero_subtitle' => 'HAFは歴史、アート、ファッションを永遠の美の旅へと織りなします',
        'hero_button' => 'HAFを発見',
        'nav_history' => '歴史',
        'nav_art' => 'アート',
        'nav_fashion' => 'ファッション',
        'nav_shop' => 'ショップ',
        'story_title' => '私たちの物語',
        'story_text_1' => 'HAFは美学への情熱から生まれました。私たちは歴史を基盤とし、アートを魂とし、ファッションを表現と信じています。',
        'gallery_title' => 'インスピレーションギャラリー',
        'gallery_subtitle' => '美の瞬間を捉え、HAFの創造的な鼓動を感じる',
        'inspiration_title' => 'インスピレーションストーリー',
        'inspiration_subtitle' => '歴史からファッションまで、HAFのすべての瞬間がインスピレーションを生み出す',
        'testimonials_title' => 'コミュニティの声',
        'testimonials_subtitle' => '世界中のHAF愛好家が体験を共有',
        'journey_title' => 'ブランドの歩み',
        'journey_subtitle' => 'HAFの成長物語、美学と創造性の進化の一歩一歩を記録',
        'events_title' => '今後のイベント',
        'events_subtitle' => 'HAFの未来の集いに参加し、無限の美の可能性を体験',
        'community_title' => 'コミュニティに参加',
        'community_subtitle' => 'あなたのHAFストーリーを共有し、世界中の美学愛好家とつながる',
        'community_button' => 'あなたの物語を共有',
        'themes_title' => '3つのテーマを探索',
        'themes_subtitle' => '歴史、アート、ファッション—HAFが美学への3つの扉を開く',
        'theme_history_title' => '歴史',
        'theme_history_text' => '文明の栄光をたどり、時の深さを感じる。',
        'theme_history_button' => '歴史へ踏み入れる',
        'theme_art_title' => 'アート',
        'theme_art_text' => '色彩と創造性に浸り、無限のインスピレーションを探索。',
        'theme_art_button' => 'アートを発見',
        'theme_fashion_title' => 'ファッション',
        'theme_fashion_text' => 'トレンドをリードし、個性と自信に満ちたスタイルを表現。',
        'theme_fashion_button' => 'ファッションを追う',
        'cta_title' => 'あなたの美学の旅を始める',
        'cta_subtitle' => 'HAFの限定商品を探索し、あなたの歴史、アート、ファッションを見つける',
        'cta_button' => '今すぐ購入',
        'footer_copyright' => '© 2025 歴史、アート＆ファッション。全権利所有。',
        'inspiration_events_button' => '今後のイベントを見る',
        'event_view_button' => '詳細を見る',
        'gallery_image_1_text' => 'インスピレーション 1',
        'gallery_image_2_text' => 'インスピレーション 2',
        'gallery_image_3_text' => 'インスピレーション 3',
        'gallery_image_4_text' => 'インスピレーション 4',
        'gallery_image_5_text' => 'インスピレーション 5',
        'gallery_image_6_text' => 'インスピレーション 6',
        'gallery_image_7_text' => 'インスピレーション 7',
        'gallery_image_8_text' => 'インスピレーション 8',
        'gallery_image_9_text' => 'インスピレーション 9',
        'gallery_image_10_text' => 'インスピレーション 10',
        'gallery_image_11_text' => 'インスピレーション 11',
        'gallery_image_12_text' => 'インスピレーション 12',
        'gallery_image_13_text' => 'インスピレーション 13',
        'gallery_image_14_text' => 'インスピレーション 14',
        'gallery_image_15_text' => 'インスピレーション 15',
        'gallery_image_16_text' => 'インスピレーション 16',
        'journey_title_1' => '2018年 - 創設',
        'journey_text_1' => 'HAFは設立され、歴史・アート・ファッションの融合を目指しました。',
        'journey_title_2' => '2020年 - 初の展示会',
        'journey_text_2' => '世界的にデビューし、学際的なデザインを披露。',
        'journey_title_3' => '2023年 - 拡大',
        'journey_text_3' => '新コレクションでアジア市場に進出。',
        'journey_title_4' => '2025年 - 未来',
        'journey_text_4' => '革新を続け、美学の新章を切り開く。',
        'event_title_1' => '歴史回顧展',
        'event_text_1' => '古代文明と現代デザインの対話を探求。',
        'event_title_2' => 'アートワークショップ',
        'event_text_2' => '実践的に創作し、芸術的な可能性を解き放つ。',
        'event_title_3' => 'ファッションローンチ',
        'event_text_3' => 'HAF 2025コレクションのデビューを目撃。',
        'inspiration_title_1' => '歴史の響き',
        'inspiration_text_1' => '古代の遺物が何千年もの物語を語り、私たちにすべての遺産を大切にすることを促します。',
        'inspiration_title_2' => 'アートのきらめき',
        'inspiration_text_2' => '一筆の色彩、一線—アートは人生に無限の可能性をもたらします。',
        'inspiration_title_3' => 'ファッションの鼓動',
        'inspiration_text_3' => 'トレンドは自信の表現；HAFはあなたをスタイルリーダーにします。',
        'testimonial_text_1' => 'HAFのデザインは歴史の深みと現代の活力を感じさせてくれます。素晴らしい！',
        'testimonial_name_1' => '佐藤健',
        'testimonial_text_2' => 'アートとファッションの完璧な融合。HAFは私の美学を再定義しました！',
        'testimonial_name_2' => '鈴木美咲',
        'testimonial_text_3' => 'すべての商品がアート作品のよう。HAFは私のインスピレーション源です！',
        'testimonial_name_3' => '田中翔',
        'journey_title_1' => '2018年 - 創設',
        'journey_text_1' => 'HAFは設立され、歴史・アート・ファッションの融合を目指しました。',
        'journey_title_2' => '2020年 - 初の展示会',
        'journey_text_2' => '世界的にデビューし、学際的なデザインを披露。',
        'journey_title_3' => '2023年 - 拡大',
        'journey_text_3' => '新コレクションでアジア市場に進出。',
        'journey_title_4' => '2025年 - 未来',
        'journey_text_4' => '革新を続け、美学の新章を切り開く。',
        'event_title_1' => '歴史回顧展',
        'event_text_1' => '古代文明と現代デザインの対話を探求。',
        'event_title_2' => 'アートワークショップ',
        'event_text_2' => '実践的に創作し、芸術的な可能性を解き放つ。',
        'event_title_3' => 'ファッションローンチ',
        'event_text_3' => 'HAF 2025コレクションのデビューを目撃。'
    ],
    'pt' => [
        'meta_description' => 'HAF tece história, arte e moda numa jornada estética intemporal',
        'hero_title' => 'Fusão Eterna',
        'hero_subtitle' => 'HAF tece história, arte e moda numa jornada estética intemporal',
        'hero_button' => 'Descobrir a HAF',
        'nav_history' => 'História',
        'nav_art' => 'Arte',
        'nav_fashion' => 'Moda',
        'nav_shop' => 'Loja',
        'story_title' => 'Nossa História',
        'story_text_1' => 'A HAF nasceu de uma paixão pela estética. Acreditamos que a história é a base, a arte é a alma e a moda é a expressão.',
        'gallery_title' => 'Galeria de Inspiração',
        'gallery_subtitle' => 'Capturando momentos estéticos, sinta o pulso criativo da HAF',
        'inspiration_title' => 'Histórias de Inspiração',
        'inspiration_subtitle' => 'Da história à moda, cada momento na HAF acende a inspiração',
        'testimonials_title' => 'Vozes da Nossa Comunidade',
        'testimonials_subtitle' => 'Entusiastas da HAF de todo o mundo partilham as suas experiências',
        'journey_title' => 'Jornada da Marca',
        'journey_subtitle' => 'História de crescimento da HAF, documentando cada passo da evolução estética e criativa',
        'events_title' => 'Próximos Eventos',
        'events_subtitle' => 'Junte-se aos futuros encontros da HAF para experimentar possibilidades estéticas ilimitadas',
        'community_title' => 'Junte-se à Nossa Comunidade',
        'community_subtitle' => 'Partilhe a sua história HAF e conecte-se com entusiastas estéticos globais',
        'community_button' => 'Partilhar a Sua História',
        'themes_title' => 'Explorar Três Temas',
        'themes_subtitle' => 'História, arte e moda — a HAF abre três portas para a estética',
        'theme_history_title' => 'História',
        'theme_history_text' => 'Trace a glória das civilizações, sentindo a profundidade do tempo.',
        'theme_history_button' => 'Entrar na História',
        'theme_art_title' => 'Arte',
        'theme_art_text' => 'Mergulhe na cor e criatividade, explorando inspiração sem limites.',
        'theme_art_button' => 'Descobrir a Arte',
        'theme_fashion_title' => 'Moda',
        'theme_fashion_text' => 'Lidere as tendências, mostrando individualidade e estilo confiante.',
        'theme_fashion_button' => 'Seguir a Moda',
        'cta_title' => 'Comece a Sua Jornada Estética',
        'cta_subtitle' => 'Explore os produtos exclusivos da HAF, encontre a sua história, arte e moda',
        'cta_button' => 'Comprar Agora',
        'footer_copyright' => '© 2025 História, Arte e Moda. Todos os direitos reservados.',
        'inspiration_events_button' => 'Ver Próximos Eventos',
        'event_view_button' => 'Ver Detalhes',
        'gallery_image_1_text' => 'Inspiração 1',
        'gallery_image_2_text' => 'Inspiração 2',
        'gallery_image_3_text' => 'Inspiração 3',
        'gallery_image_4_text' => 'Inspiração 4',
        'gallery_image_5_text' => 'Inspiração 5',
        'gallery_image_6_text' => 'Inspiração 6',
        'gallery_image_7_text' => 'Inspiração 7',
        'gallery_image_8_text' => 'Inspiração 8',
        'gallery_image_9_text' => 'Inspiração 9',
        'gallery_image_10_text' => 'Inspiração 10',
        'gallery_image_11_text' => 'Inspiração 11',
        'gallery_image_12_text' => 'Inspiração 12',
        'gallery_image_13_text' => 'Inspiração 13',
        'gallery_image_14_text' => 'Inspiração 14',
        'gallery_image_15_text' => 'Inspiração 15',
        'gallery_image_16_text' => 'Inspiração 16',
        'inspiration_title_1' => 'Ecos da História',
        'inspiration_text_1' => 'Artefatos antigos contam histórias de milênios, inspirando-nos a valorizar cada legado.',
        'inspiration_title_2' => 'Faísca da Arte',
        'inspiration_text_2' => 'Um traço de cor, uma única linha — a arte abre possibilidades infinitas para a vida.',
        'inspiration_title_3' => 'Pulso da Moda',
        'inspiration_text_3' => 'As tendências são expressões de confiança; a HAF faz de você um líder de estilo.',
        'testimonial_text_1' => 'Os designs da HAF combinam a profundidade da história com a vitalidade moderna — simplesmente deslumbrante!',
        'testimonial_name_1' => 'João Silva',
        'testimonial_text_2' => 'A fusão perfeita de arte e moda; a HAF redefiniu a estética para mim!',
        'testimonial_name_2' => 'Maria Oliveira',
        'testimonial_text_3' => 'Cada item parece uma obra de arte; a HAF é a minha fonte de inspiração!',
        'testimonial_name_3' => 'Pedro Santos',
        'journey_title_1' => '2018 - Fundação',
        'journey_text_1' => 'A HAF foi fundada, dedicada a combinar história, arte e moda.',
        'journey_title_2' => '2020 - Primeira Exposição',
        'journey_text_2' => 'Estreia global, apresentando designs interdisciplinares.',
        'journey_title_3' => '2023 - Expansão',
        'journey_text_3' => 'Entrada nos mercados asiáticos com uma nova coleção.',
        'journey_title_4' => '2025 - Futuro',
        'journey_text_4' => 'Continuando a inovar, definindo um novo capítulo na estética.',
        'event_title_1' => 'Retrospectiva Histórica',
        'event_text_1' => 'Explore diálogos entre civilizações antigas e design moderno.',
        'event_title_2' => 'Workshop de Arte',
        'event_text_2' => 'Crie com as mãos, libertando o seu potencial artístico.',
        'event_title_3' => 'Lançamento de Moda',
        'event_text_3' => 'Testemunhe a estreia da coleção HAF 2025.'
    ],
    'hi' => [
        'meta_description' => 'HAF इतिहास, कला और फैशन को एक कालातीत सौंदर्य यात्रा में बुनता है',
        'hero_title' => 'शाश्वत संलयन',
        'hero_subtitle' => 'HAF इतिहास, कला और फैशन को एक कालातीत सौंदर्य यात्रा में बुनता है',
        'hero_button' => 'HAF खोजें',
        'nav_history' => 'इतिहास',
        'nav_art' => 'कला',
        'nav_fashion' => 'फैशन',
        'nav_shop' => 'दुकान',
        'story_title' => 'हमारी कहानी',
        'story_text_1' => 'HAF सौंदर्यशास्त्र के प्रति जुनून से पैदा हुआ। हम मानते हैं कि इतिहास आधार है, कला आत्मा है, और फैशन अभिव्यक्ति है।',
        'gallery_title' => 'प्रेरणा गैलरी',
        'gallery_subtitle' => 'सौंदर्य क्षणों को कैप्चर करें, HAF की रचनात्मक धड़कन महसूस करें',
        'inspiration_title' => 'प्रेरणा कहानियां',
        'inspiration_subtitle' => 'इतिहास से फैशन तक, HAF का हर पल प्रेरणा जगाता है',
        'testimonials_title' => 'हमारे समुदाय की आवाज़ें',
        'testimonials_subtitle' => 'दुनिया भर के HAF उत्साही अपने अनुभव साझा करते हैं',
        'journey_title' => 'ब्रांड यात्रा',
        'journey_subtitle' => 'HAF की विकास कहानी, सौंदर्य और रचनात्मक विकास के हर कदम का दस्तावेजीकरण',
        'events_title' => 'आगामी कार्यक्रम',
        'events_subtitle' => 'असीमित सौंदर्य संभावनाओं का अनुभव करने के लिए HAF के भविष्य के समारोहों में शामिल हों',
        'community_title' => 'हमारे समुदाय में शामिल हों',
        'community_subtitle' => 'अपनी HAF कहानी साझा करें और वैश्विक सौंदर्य उत्साहियों से जुड़ें',
        'community_button' => 'अपनी कहानी साझा करें',
        'themes_title' => 'तीन विषयों का अन्वेषण करें',
        'themes_subtitle' => 'इतिहास, कला और फैशन—HAF सौंदर्यशास्त्र के लिए तीन द्वार खोलता है',
        'theme_history_title' => 'इतिहास',
        'theme_history_text' => 'सभ्यताओं की महिमा का पता लगाएं, समय की गहराई महसूस करें।',
        'theme_history_button' => 'इतिहास में प्रवेश करें',
        'theme_art_title' => 'कला',
        'theme_art_text' => 'रंग और रचनात्मकता में डूबें, असीमित प्रेरणा का अन्वेषण करें।',
        'theme_art_button' => 'कला खोजें',
        'theme_fashion_title' => 'फैशन',
        'theme_fashion_text' => 'रुझानों का नेतृत्व करें, व्यक्तित्व और आत्मविश्वासी शैली दिखाएं।',
        'theme_fashion_button' => 'फैशन का अनुसरण करें',
        'cta_title' => 'अपनी सौंदर्य यात्रा शुरू करें',
        'cta_subtitle' => 'HAF के विशेष उत्पादों का अन्वेषण करें, अपनी इतिहास, कला और फैशन खोजें',
        'cta_button' => 'अभी खरीदें',
        'footer_copyright' => '© 2025 इतिहास, कला और फैशन। सर्वाधिकार सुरक्षित।',
        'inspiration_events_button' => 'आगामी कार्यक्रम देखें',
        'event_view_button' => 'विवरण देखें',
        'inspiration_title_1' => 'इतिहास की ध्वनियां',
        'inspiration_text_1' => 'पुराने वस्तुओं की बातें हजारों वर्षों की बात करती हैं, हमें इतिहास को अपने विषयों को मूल्यांकन करने के लिए प्रेरणा देती हैं।',
        'inspiration_title_2' => 'कला की फिज़',
        'inspiration_text_2' => 'एक रंग का एक रेखा, एक ही रेखा—कला जीवन के लिए अनंत संभावनाओं को खोलती है।',
        'inspiration_title_3' => 'फैशन की धूप',
        'inspiration_text_3' => 'टेंडेंसी आत्मविश्वास की व्यक्तिगत अभिव्यक्ति है; HAF आपको एक विशेष व्यक्तित्व बनाता है।',
        'gallery_image_1_text' => 'प्रेरणा 1',
        'gallery_image_2_text' => 'प्रेरणा 2',
        'gallery_image_3_text' => 'प्रेरणा 3',
        'gallery_image_4_text' => 'प्रेरणा 4',
        'gallery_image_5_text' => 'प्रेरणा 5',
        'gallery_image_6_text' => 'प्रेरणा 6',
        'gallery_image_7_text' => 'प्रेरणा 7',
        'gallery_image_8_text' => 'प्रेरणा 8',
        'gallery_image_9_text' => 'प्रेरणा 9',
        'gallery_image_10_text' => 'प्रेरणा 10',
        'gallery_image_11_text' => 'प्रेरणा 11',
        'gallery_image_12_text' => 'प्रेरणा 12',
        'gallery_image_13_text' => 'प्रेरणा 13',
        'gallery_image_14_text' => 'प्रेरणा 14',
        'gallery_image_15_text' => 'प्रेरणा 15',
        'gallery_image_16_text' => 'प्रेरणा 16',
        'testimonial_text_1' => 'HAF इतिहास, कला और फैशन को एक कालातीत सौंदर्य यात्रा में बुनता है, बहुत अच्छा है!',
        'testimonial_name_1' => 'श्री गुरुदेव जी',
        'testimonial_text_2' => 'एक रंग का एक रेखा, एक ही रेखा—कला जीवन के लिए अनंत संभावनाओं को खोलती है।',
        'testimonial_name_2' => 'श्रीमती जुली जी',
        'testimonial_text_3' => 'एक रंग का एक रेखा, एक ही रेखा—कला जीवन के लिए अनंत संभावनाओं को खोलती है।',
        'testimonial_name_3' => 'श्री विद्यार्थी जी',
        'journey_title_1' => '2018 - बोध',
        'journey_text_1' => 'HAF बनाया गया, इतिहास, कला और फैशन को मिलाने के लिए उत्साही था।',
        'journey_title_2' => '2020 - पहली दर्शन प्रस्तुति',
        'journey_text_2' => 'विश्वव्यापी प्रस्तुति, क्रॉस-विज्ञानी डिजाइन प्रस्तुत करते हैं।',
        'journey_title_3' => '2023 - विस्तार',
        'journey_text_3' => 'एक नई कलेक्शन के साथ एशियाई बाजारों में प्रवेश।',
        'journey_title_4' => '2025 - भविष्य',
        'journey_text_4' => 'नवीन विकास, एस्टेटिक्स में नया अध्याय बनाने के लिए जारी रखते हैं।',
        'event_title_1' => 'इतिहास की विवेचना',
        'event_text_1' => 'पुराने सभ्यताओं और आधुनिक डिजाइन के बीच चर्चा करते हैं।',
        'event_title_2' => 'कला कार्यवाहक',
        'event_text_2' => 'आंदोलन करते हुए, आपकी कला के संभावनाओं को खोलते हैं।',
        'event_title_3' => 'फैशन प्रीमियर',
        'event_text_3' => 'HAF 2025 कलेक्शन की प्रीमियर देखते हैं।'
    ],
    'ms' => [
        'meta_description' => 'HAF menggabungkan sejarah, seni, dan fesyen dalam perjalanan estetika abadi',
        'hero_title' => 'Gabungan Abadi',
        'hero_subtitle' => 'HAF menggabungkan sejarah, seni, dan fesyen dalam perjalanan estetika abadi',
        'hero_button' => 'Terokai HAF',
        'nav_history' => 'Sejarah',
        'nav_art' => 'Seni',
        'nav_fashion' => 'Fesyen',
        'nav_shop' => 'Kedai',
        'story_title' => 'Kisah Kami',
        'story_text_1' => 'HAF lahir daripada minat terhadap estetika. Kami percaya sejarah adalah asas, seni adalah jiwa, dan fesyen adalah ekspresi.',
        'gallery_title' => 'Galeri Inspirasi',
        'gallery_subtitle' => 'Merakam detik estetika, rasai denyutan kreatif HAF',
        'inspiration_title' => 'Kisah Inspirasi',
        'inspiration_subtitle' => 'Dari sejarah ke fesyen, setiap detik di HAF membangkitkan inspirasi',
        'testimonials_title' => 'Suara Komuniti Kami',
        'testimonials_subtitle' => 'Peminat HAF dari seluruh dunia berkongsi pengalaman mereka',
        'journey_title' => 'Perjalanan Jenama',
        'journey_subtitle' => 'Kisah pertumbuhan HAF, merakam setiap langkah evolusi estetika dan kreativiti',
        'events_title' => 'Acara Akan Datang',
        'events_subtitle' => 'Sertai perhimpunan masa depan HAF untuk alami kemungkinan estetika tanpa batas',
        'community_title' => 'Sertai Komuniti Kami',
        'community_subtitle' => 'Kongsi kisah HAF anda dan berhubung dengan peminat estetika global',
        'community_button' => 'Kongsi Kisah Anda',
        'themes_title' => 'Terokai Tiga Tema',
        'themes_subtitle' => 'Sejarah, seni, dan fesyen—HAF membuka tiga pintu estetika',
        'theme_history_title' => 'Sejarah',
        'theme_history_text' => 'Jejaki kegemilangan tamadun, rasai kedalaman masa.',
        'theme_history_button' => 'Masuk ke Sejarah',
        'theme_art_title' => 'Seni',
        'theme_art_text' => 'Hayati warna dan kreativiti, terokai inspirasi tanpa batas.',
        'theme_art_button' => 'Temui Seni',
        'theme_fashion_title' => 'Fesyen',
        'theme_fashion_text' => 'Pimpin trend, tonjolkan gaya dan keyakinan diri.',
        'theme_fashion_button' => 'Kejar Fesyen',
        'cta_title' => 'Mulakan Perjalanan Estetika Anda',
        'cta_subtitle' => 'Terokai produk eksklusif HAF, temui sejarah, seni, dan fesyen anda',
        'cta_button' => 'Beli Sekarang',
        'footer_copyright' => '© 2025 Sejarah, Seni & Fesyen. Hak cipta terpelihara.',
        'inspiration_events_button' => 'Lihat Acara Akan Datang',
        'event_view_button' => 'Lihat Butiran',
        'inspiration_title_1' => 'Gema Sejarah',
        'inspiration_text_1' => 'Artifak kuno menceritakan kisah beribu tahun, menginspirasi kita menghargai setiap warisan.',
        'inspiration_title_2' => 'Percikan Seni',
        'inspiration_text_2' => 'Satu sapuan warna, satu garisan—seni membuka kemungkinan tanpa had untuk kehidupan.',
        'inspiration_title_3' => 'Denyutan Fesyen',
        'inspiration_text_3' => 'Trend adalah ekspresi keyakinan; HAF menjadikan anda peneraju gaya.',
        'gallery_image_1_text' => 'Inspirasi 1',
        'gallery_image_2_text' => 'Inspirasi 2',
        'gallery_image_3_text' => 'Inspirasi 3',
        'gallery_image_4_text' => 'Inspirasi 4',
        'gallery_image_5_text' => 'Inspirasi 5',
        'gallery_image_6_text' => 'Inspirasi 6',
        'gallery_image_7_text' => 'Inspirasi 7',
        'gallery_image_8_text' => 'Inspirasi 8',
        'gallery_image_9_text' => 'Inspirasi 9',
        'gallery_image_10_text' => 'Inspirasi 10',
        'gallery_image_11_text' => 'Inspirasi 11',
        'gallery_image_12_text' => 'Inspirasi 12',
        'gallery_image_13_text' => 'Inspirasi 13',
        'gallery_image_14_text' => 'Inspirasi 14',
        'gallery_image_15_text' => 'Inspirasi 15',
        'gallery_image_16_text' => 'Inspirasi 16',
        'testimonial_text_1' => 'Reka bentuk HAF menggabungkan kedalaman sejarah dengan semangat moden—sungguh menakjubkan!',
        'testimonial_name_1' => 'Ahmad',
        'testimonial_text_2' => 'Gabungan seni dan fesyen yang sempurna; HAF telah mentakrifkan semula estetika untuk saya!',
        'testimonial_name_2' => 'Siti',
        'testimonial_text_3' => 'Setiap item terasa seperti karya seni; HAF adalah sumber inspirasi saya!',
        'testimonial_name_3' => 'Rahman',
        'journey_title_1' => '2018 - Penubuhan',
        'journey_text_1' => 'HAF ditubuhkan, berdedikasi untuk menggabungkan sejarah, seni, dan fesyen.',
        'journey_title_2' => '2020 - Pameran Pertama',
        'journey_text_2' => 'Debut global, mempamerkan rekaan rentas disiplin.',
        'journey_title_3' => '2023 - Pengembangan',
        'journey_text_3' => 'Memasuki pasaran Asia dengan koleksi baharu.',
        'journey_title_4' => '2025 - Masa Depan',
        'journey_text_4' => 'Terus berinovasi, mendefinisikan babak baharu estetika.',
        'event_title_1' => 'Retrospektif Sejarah',
        'event_text_1' => 'Terokai dialog antara tamadun kuno dan rekaan moden.',
        'event_title_2' => 'Bengkel Seni',
        'event_text_2' => 'Cipta secara praktikal, lepaskan potensi seni anda.',
        'event_title_3' => 'Pelancaran Fesyen',
        'event_text_3' => 'Saksikan pelancaran koleksi HAF 2025.'
    ]
];

// Placeholder image (1x64 transparent PNG, Base64-encoded)
$placeholder_image = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSjAAAADUlEQVR42mP8z8DwHwAEhQGAaR9lOQAAAABJRU5ErkJggg==';

// Helper function to get translations
function get_translation($lang, $key) {
    global $translations;
    if (isset($translations[$lang][$key])) {
        return $translations[$lang][$key];
    }
    return isset($translations['en'][$key]) ? $translations['en'][$key] : '';
}
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($current_lang); ?>" dir="<?php echo $site_dir; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars(get_translation($current_lang, 'meta_description')); ?>">
    <title>HAF - History, Art & Fashion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Playfair+Display:wght@400;700&family=Raleway:wght@300;400;600&family=Noto+Sans+Arabic:wght@400;700&family=Noto+Sans+JP:wght@400;700&family=Noto+Sans+Deva:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
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
            /* 新增点缀色 */
            --accent-blue: #B8E0FF;
            --accent-pink: #FFD6E0;
        }

        html {
            scroll-behavior: smooth;
        }

        * {
            margin: 0;
            margin padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--charcoal);
            direction: <?php echo $site_dir; ?>;
            line-height: 1.6;
            min-height: 100vh;
            background: var(--custom-light);
        }

        [lang="ar"] body, [lang="ar"] h1, [lang="ar"] p, [lang="ar"] a {
            font-family: 'Noto Sans Serif Arabic', sans-serif;
        }

        [lang="ja"] body, [lang="ja"] h1, [lang="ja"] p, [lang="ja"] a {
            font-family: 'Noto Sans JP', sans-serif;
        }

        [lang="hi"] body, [lang="hi"] h1, [lang="hi"] p, [lang="hi"] a {
            font-family: 'Noto Sans Deva', sans-serif;
        }

        /* Navigation */
        .navbar {
            background: var(--papaya-whip);
            padding: 15px 0px;
            border-bottom: 2px solid var(--old-lace);
            box-shadow: var(--shadow-normal);
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: var(--charcoal);
            font-weight: 700;
        }

        .navbar-brand:hover {
            color: var(--charcoal);
        }

        .nav-link {
            color: var(--charcoal);
            font-family: 'Raleway', sans-serif;
            font-size: 1.1rem;
            margin: 0 15px;
        }

        .nav-link:hover {
            color: var(--old-lace);
        }

        .form-select {
            font-family: 'Raleway', sans-serif;
            background: var(--ivory);
            border: 2px solid var(--old-lace);
            color: var(--charcoal);
            padding: 5px 10px;
            border-radius: 5px;
        }

        /* Hero Section */
        .hero {
            position: relative;
            background: var(--gradient), url('images/hero_background.jpg') center/cover no-repeat;
            color: var(--charcoal);
            text-align: center;
            padding: 120px 20px;
            border-bottom: 5px solid var(--old-lace);
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            margin-bottom: 20px;
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        .hero p {
            font-family: 'Raleway', sans-serif;
            font-size: 1.6rem;
            margin-bottom: 30px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            opacity: 0;
            animation: fadeIn 1s forwards 0.5s;
        }

        .btn-primary {
            background: var(--old-lace);
            border: 2px solid var(--old-lace);
            color: var(--charcoal);
            font-family: 'Raleway', sans-serif;
            padding: 10px 30px;
            font-size: 1.1rem;
            border-radius: 5px;
            transition: all 0.3s;
            box-shadow: var(--shadow-normal);
            opacity: 0;
            animation: fadeIn 1s forwards 1s;
        }

        .btn-primary:hover {
            background: var(--ivory);
            color: var(--charcoal);
            border-color: var(--charcoal);
            box-shadow: var(--shadow-hover);
        }

        /* Sections */
        section {
            padding: 80px 0;
            background: var(--seashell);
            border-bottom: 1px solid var(--old-lace);
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            text-align: center;
            margin-bottom: 20px;
            color: var(--charcoal);
            position: relative;
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 2px;
            background: var(--old-lace);
        }

        .lead {
            font-family: 'Raleway', sans-serif;
            font-size: 1.3rem;
            text-align: center;
            margin-bottom: 40px;
            color: var(--charcoal);
            opacity: 0;
            animation: fadeIn 1s forwards 0.3s;
        }

        /* Story Section */
        .story img {
            width: 100%;
            height: auto;
            border: 3px solid var(--old-lace);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            opacity: 0;
            animation: fadeIn 1s forwards 0.5s;
        }

        /* Gallery Section */
        .gallery {
            position: relative;
            padding: 40px 0;
            background: linear-gradient(135deg, var(--papaya-whip) 0%, var(--snow) 100%);
        }

        .gallery::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100%;
            background: url('data:image/svg+xml,<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><rect width="1" height="1" fill="rgba(0,0,0,0.05)"/></svg>');
            opacity: 0.5;
            pointer-events: none;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border: 2px solid var(--old-lace);
            border-radius: 18px;
            transition: box-shadow 0.4s, transform 0.4s, border-color 0.3s;
            opacity: 0;
            animation: fadeIn 1s forwards;
            margin-bottom: 30px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.13);
            background: var(--snow);
        }
        .gallery-item:hover {
            transform: scale(1.06) rotate(-1deg);
            box-shadow: 0 20px 40px rgba(0,0,0,0.22);
            border-color: var(--papaya-whip);
            z-index: 2;
        }
        .gallery-item img {
            width: 100%;
            height: 260px;
            object-fit: cover;
            object-position: center;
            display: block;
            border-radius: 14px;
            transition: transform 0.5s, filter 0.4s;
            cursor: pointer;
        }
        .gallery-item:hover img {
            transform: scale(1.12) rotate(1deg);
            filter: brightness(1.08) saturate(1.15) drop-shadow(0 2px 12px #ffe4b5);
        }
        .gallery-item .zoom-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.8);
            font-size: 2.5rem;
            color: #fff8dc;
            background: rgba(0,0,0,0.25);
            border-radius: 50%;
            padding: 10px 14px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s, transform 0.3s;
        }
        .gallery-item:hover .zoom-icon {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1.1);
        }
        .gallery-overlay {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(253, 245, 230, 0.96);
            color: var(--charcoal);
            padding: 16px 12px 10px 12px;
            text-align: center;
            font-family: 'Raleway', sans-serif;
            border-top: 2px solid var(--papaya-whip);
            font-size: 1.12rem;
            font-weight: 500;
            text-shadow: 1px 1px 2px rgba(255,255,255,0.4);
            transition: background 0.3s;
        }
        .gallery-item:hover .gallery-overlay {
            background: rgba(253, 245, 230, 1);
        }
        /* Lightbox 弹窗样式 */
        .lightbox {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0; top: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.85);
            justify-content: center;
            align-items: center;
        }
        .lightbox.active {
            display: flex;
        }
        .lightbox img {
            max-width: 90vw;
            max-height: 80vh;
            border-radius: 18px;
            box-shadow: 0 8px 40px #000a;
        }
        .lightbox-close {
            position: absolute;
            top: 40px;
            right: 60px;
            font-size: 2.5rem;
            color: #fff8dc;
            cursor: pointer;
            z-index: 10001;
        }
        @media (max-width: 900px) {
            .gallery-item img {
                height: 180px;
            }
        }
        @media (max-width: 600px) {
            .gallery-item img {
                height: 120px;
            }
        }

        /* Gallery Navigation */
        .gallery-nav {
            position: fixed;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 100;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .gallery-nav-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--old-lace);
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid var(--papaya-whip);
        }

        .gallery-nav-dot:hover,
        .gallery-nav-dot.active {
            background: var(--papaya-whip);
            transform: scale(1.2);
        }

        /* Gallery Animation */
        @keyframes galleryFadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .gallery-item {
            animation: galleryFadeIn 0.6s ease forwards;
            animation-delay: calc(var(--item-index) * 0.1s);
        }

        /* Artists Section */
        .artist-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .artist-card {
            text-align: center;
            border: 2px solid var(--old-lace);
            border-radius: 8px;
            background: var(--snow);
            padding: transform 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        .artist-card:hover {
            transform: translateY(-5px);
        }

        .frame {
            border: 3px solid var(--papaya-whip);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .painting-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            cursor: pointer;
        }

        .text-container .title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: var(--charcoal);
            margin-bottom: 10px;
            cursor: pointer;
        }

        .text-container .description {
            font-family: 'Raleway', sans-serif;
            font-size: 0.9rem;
            color: #666;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.85);
            z-index: 2000;
            overflow-y: auto;
        }

        .modal-content {
            background: var(--snow);
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            position: relative;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease;
        }

        .modal-content img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .modal-content h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: var(--charcoal);
            margin-bottom: 10px;
        }

        .modal-content p {
            font-family: 'Raleway', sans-serif;
            font-size: 1rem;
            color: #333;
            line-height: 1.6;
        }

        .modal-close {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 1.5rem;
            color: var(--charcoal);
            cursor: pointer;
            background: none;
            border: none;
        }

        /* Inspiration, Testimonials, Events */
        .inspiration-card, .testimonial-card, .event-card, .theme-card {
            background: var(--snow);
            border: 2px solid var(--old-lace);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s;
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        .inspiration-card:hover, .testimonial-card:hover, .event-card:hover, .theme-card:hover {
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .inspiration-card img, .event-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .testimonial-card img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .card-back h3, .event-card h3, .theme-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            color: var(--charcoal);
            margin-bottom: 10px;
        }

        .theme-card i {
            color: var(--charcoal);
        }

        /* Journey Section */
        .timeline {
            position: relative;
            max-width: 900px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
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
            background: var(--snow);
            padding: 20px;
            border-radius: 16px;
            border-left: 5px solid var(--old-lace);
            box-shadow: 0 4px 18px rgba(0,0,0,0.10);
            opacity: 0;
            animation: fadeIn 1s forwards;
            transition: box-shadow 0.4s, transform 0.4s, border-color 0.3s;
        }
        .timeline-item:nth-child(odd) {
            align-self: flex-start;
            left: 0;
            text-align: right;
            border-left: 5px solid var(--old-lace);
            border-right: none;
        }
        .timeline-item:nth-child(even) {
            align-self: flex-end;
            left: auto;
            text-align: left;
            border-left: none;
            border-right: 5px solid var(--old-lace);
        }
        .timeline-item:hover {
            transform: scale(1.03) rotate(-1deg);
            box-shadow: 0 12px 32px rgba(0,0,0,0.18);
            border-color: var(--papaya-whip);
            z-index: 2;
        }
        .timeline-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            object-position: center;
            border-radius: 10px;
            margin-bottom: 14px;
            border: 2px solid var(--old-lace);
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.5s, box-shadow 0.4s;
            background: #f8f8f8;
        }
        .timeline-item:hover .timeline-img {
            transform: scale(1.07) rotate(1deg);
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }
        .timeline-content h5 {
            font-size: 1.25rem;
            font-family: 'Playfair Display', serif;
            color: var(--charcoal);
            margin-bottom: 8px;
        }
        .timeline-content p {
            background: rgba(253,245,230,0.92);
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 1.05rem;
            color: #444;
            margin-bottom: 0;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        }
        @media (max-width: 900px) {
            .timeline-item {
                width: 90%;
        }
        }
        @media (max-width: 600px) {
            .timeline-item {
                width: 100%;
                left: 0 !important;
                text-align: left !important;
                border-left: 5px solid var(--old-lace);
                border-right: none !important;
            }
        }

        /* Community Section */
        .community img {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            display: block;
            border: 3px solid var(--old-lace);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            opacity: 0;
            animation: fadeIn 1s forwards 0.5s;
        }

        /* CTA Section */
        .shop-cta {
            background: var(--gradient);
            text-align: center;
            padding: 100px 20px;
            border-top: 5px solid var(--old-lace);
        }

        /* Footer */
        .footer {
            background: var(--papaya-whip);
            color: var(--charcoal);
            text-align: center;
            padding: 30px 0;
            border-top: 2px solid var(--old-lace);
            box-shadow: var(--shadow-normal);
        }

        .social-icon {
            color: var(--charcoal);
            margin: 0 10px;
            font-size: 1.2rem;
            transition: color 0.3s;
        }

        .social-icon:hover {
            color: var(--old-lace);
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.3rem;
            }

            .timeline::before {
                left: 20px;
            }

            .timeline-item {
                width: 90%;
                padding-left: 40px;
                padding-right: 20px;
                left: 0 !important;
                text-align: left !important;
            }

            .timeline-item::before {
                left: 10px !important;
                right: auto !important;
            }

            .navbar-nav {
                text-align: center;
            }

            .nav-link {
                margin: 10px 0;
            }

            .form-select {
                margin: 10px auto;
            }

            .gallery-item {
                aspect-ratio: 4/3;
            }
            
            .gallery-overlay {
                bottom: 0;
                padding: 15px 10px;
            }
            
            .gallery-overlay p {
                font-size: 1rem;
            }

            .gallery-nav {
                display: none;
            }

            .row.row-cols-md-4 {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">HAF</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="history.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_history')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="art.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_art')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="fashion.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_fashion')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="php/shop.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_shop')); ?></a>
                    </li>
                    <li class="nav-item">
                        <form method="POST">
                            <select name="lang" class="form-select" onchange="this.form.submit()">
                                <option value="en" <?php echo $current_lang === 'en' ? 'selected' : ''; ?>>English</option>
                                <option value="zh" <?php echo $current_lang === 'zh' ? 'selected' : ''; ?>>中文</option>
                                <option value="es" <?php echo $current_lang === 'es' ? 'selected' : ''; ?>>Español</option>
                                <option value="ar" <?php echo $current_lang === 'ar' ? 'selected' : ''; ?>>العربية</option>
                                <option value="fr" <?php echo $current_lang === 'fr' ? 'selected' : ''; ?>>Français</option>
                                <option value="ru" <?php echo $current_lang === 'ru' ? 'selected' : ''; ?>>Русский</option>
                                <option value="pt" <?php echo $current_lang === 'pt' ? 'selected' : ''; ?>>Português</option>
                                <option value="de" <?php echo $current_lang === 'de' ? 'selected' : ''; ?>>Deutsch</option>
                                <option value="ja" <?php echo $current_lang === 'ja' ? 'selected' : ''; ?>>日本語</option>
                                <option value="hi" <?php echo $current_lang === 'hi' ? 'selected' : ''; ?>>हिन्दी</option>
                                <option value="ms" <?php echo $current_lang === 'ms' ? 'selected' : ''; ?>>Bahasa Malaysia</option>
                            </select>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 class="animate__animated animate__fadeIn"><?php echo htmlspecialchars(get_translation($current_lang, 'hero_title')); ?></h1>
            <p class="animate__animated animate__fadeIn" data-animate-delay="0.5s"><?php echo htmlspecialchars(get_translation($current_lang, 'hero_subtitle')); ?></p>
            <a href="#story" class="btn btn-primary animate__animated animate__fadeIn" data-animate-delay="1s"><?php echo htmlspecialchars(get_translation($current_lang, 'hero_button')); ?></a>
        </div>
    </section>

    <!-- Story Section -->
    <section id="story" class="story">
        <div class="container">
            <h2 class="section-title"><?php echo htmlspecialchars(get_translation($current_lang, 'story_title')); ?></h2>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="images/story_images.jpg" class="img-fluid" alt="HAF Story">
                </div>
                <div class="col-md-6">
                    <p class="lead"><?php echo htmlspecialchars(get_translation($current_lang, 'story_text_1')); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="gallery">
        <div class="container">
            <h2 class="section-title"><?php echo htmlspecialchars(get_translation($current_lang, 'gallery_title')); ?></h2>
            <p class="lead"><?php echo htmlspecialchars(get_translation($current_lang, 'gallery_subtitle')); ?></p>
            <div class="row row-cols-md-4 g-4">
                <?php for ($i = 1; $i <= 16; $i++): ?>
                    <div class="col">
                        <div class="gallery-item">
                            <img src="<?php echo 'images/gallery_' . $i . '.jpg'; ?>" class="img-fluid" alt="Inspiration <?php echo $i; ?>">
                            <div class="gallery-overlay">
                                <p><?php echo htmlspecialchars(get_translation($current_lang, 'gallery_image_' . $i . '_text') ?: 'Inspiration ' . $i); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- Inspiration Section -->
    <section id="inspiration" class="py-5">
        <div class="container">
            <h2 class="section-title"><?php echo htmlspecialchars(get_translation($current_lang, 'inspiration_title')); ?></h2>
            <p class="lead"><?php echo htmlspecialchars(get_translation($current_lang, 'inspiration_subtitle')); ?></p>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="inspiration-card">
                        <img src="images/inspiration_1.jpg" class="img-fluid" alt="Story 1">
                        <div class="card-back">
                            <h3><?php echo htmlspecialchars(get_translation($current_lang, 'inspiration_title_1') ?: 'Echoes of History'); ?></h3>
                            <p><?php echo htmlspecialchars(get_translation($current_lang, 'inspiration_text_1') ?: 'Ancient artifacts tell tales of millennia, inspiring us to cherish every legacy.'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="inspiration-card">
                        <img src="images/inspiration_2.jpg" class="img-fluid" alt="Story 2">
                        <div class="card-back">
                            <h3><?php echo htmlspecialchars(get_translation($current_lang, 'inspiration_title_2') ?: 'Spark of Art'); ?></h3>
                            <p><?php echo htmlspecialchars(get_translation($current_lang, 'inspiration_text_2') ?: 'A stroke of color, a single line—art unlocks infinite possibilities for life.'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="inspiration-card">
                        <img src="images/inspiration_3.jpg" class="img-fluid" alt="Story 3">
                        <div class="card-back">
                            <h3><?php echo htmlspecialchars(get_translation($current_lang, 'inspiration_title_3') ?: 'Pulse of Fashion'); ?></h3>
                            <p><?php echo htmlspecialchars(get_translation($current_lang, 'inspiration_text_3') ?: 'Trends are expressions Committee of confidence; HAF makes you a leader of style.'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="event.php" class="btn btn-primary animate__animated animate__fadeIn" data-animate-delay="1.2s"><?php echo htmlspecialchars(get_translation($current_lang, 'inspiration_events_button')); ?></a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="testimonials">
        <div class="container">
            <h2 class="section-title"><?php echo htmlspecialchars(get_translation($current_lang, 'testimonials_title')); ?></h2>
            <p class="lead"><?php echo htmlspecialchars(get_translation($current_lang, 'testimonials_subtitle')); ?></p>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <img src="images/testimonial_1.jpg" class="img-fluid rounded-circle mb-3" alt="User 1">
                        <p><?php echo htmlspecialchars(get_translation($current_lang, 'testimonial_text_1') ?: 'HAF designs blend history depth with modern vibrancy—simply stunning!'); ?></p>
                        <h5><?php echo htmlspecialchars(get_translation($current_lang, 'testimonial_name_1') ?: 'User 1'); ?></h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <img src="images/testimonial_2.jpg" class="img-fluid rounded-circle mb-3" alt="User 2">
                        <p><?php echo htmlspecialchars(get_translation($current_lang, 'testimonial_text_2') ?: 'The perfect fusion of art and fashion; HAF has redefined aesthetics for me!'); ?></p>
                        <h5><?php echo htmlspecialchars(get_translation($current_lang, 'testimonial_name_2') ?: 'User 2'); ?></h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <img src="images/testimonial_3.jpg" class="img-fluid rounded-circle mb-3" alt="User 3">
                        <p><?php echo htmlspecialchars(get_translation($current_lang, 'testimonial_text_3') ?: 'Every item feels like a piece of art; HAF is my source of inspiration!'); ?></p>
                        <h5><?php echo htmlspecialchars(get_translation($current_lang, 'testimonial_name_3') ?: 'User 3'); ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brand Journey -->
    <section id="journey" class="journey">
        <div class="container">
            <h2 class="section-title"><?php echo htmlspecialchars(get_translation($current_lang, 'journey_title')); ?></h2>
            <p class="lead"><?php echo htmlspecialchars(get_translation($current_lang, 'journey_subtitle')); ?></p>
            <div class="timeline">
                <div class="timeline-item">
                    <img src="images/journey_11.jpg" class="timeline-img" alt="Milestone 1">
                    <div class="timeline-content">
                        <h5><?php echo htmlspecialchars(get_translation($current_lang, 'journey_title_1') ?: '2018 - Inception'); ?></h5>
                        <p><?php echo htmlspecialchars(get_translation($current_lang, 'journey_text_1') ?: 'HAF was founded, dedicated to blending history, art, and fashion.'); ?></p>
                    </div>
                </div>
                <div class="timeline-item">
                    <img src="images/journey_22.jpg" class="timeline-img" alt="Milestone 2">
                    <div class="timeline-content">
                        <h5><?php echo htmlspecialchars(get_translation($current_lang, 'journey_title_2') ?: '2020 - First Exhibition'); ?></h5>
                        <p><?php echo htmlspecialchars(get_translation($current_lang, 'journey_text_2') ?: 'Debuted globally, showcasing cross-disciplinary designs.'); ?></p>
                    </div>
                </div>
                <div class="timeline-item">
                    <img src="images/journey_33.jpg" class="timeline-img" alt="Milestone 3">
                    <div class="timeline-content">
                        <h5><?php echo htmlspecialchars(get_translation($current_lang, 'journey_title_3') ?: '2023 - Expansion'); ?></h5>
                        <p><?php echo htmlspecialchars(get_translation($current_lang, 'journey_text_3') ?: 'Entered Asian markets with a new collection.'); ?></p>
                    </div>
                </div>
                <div class="timeline-item">
                    <img src="images/journey_44.jpg" class="timeline-img" alt="Milestone 4">
                    <div class="timeline-content">
                        <h5><?php echo htmlspecialchars(get_translation($current_lang, 'journey_title_4') ?: '2025 - Future'); ?></h5>
                        <p><?php echo htmlspecialchars(get_translation($current_lang, 'journey_text_4') ?: 'Continuing to innovate, defining a new chapter in aesthetics.'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Preview -->
    <section id="events" class="events">
        <div class="container">
            <h2 class="section-title"><?php echo htmlspecialchars(get_translation($current_lang, 'events_title')); ?></h2>
            <p class="lead"><?php echo htmlspecialchars(get_translation($current_lang, 'events_subtitle')); ?></p>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="event-card">
                        <img src="images/event_1.jpg" class="img-fluid" alt="Event 1">
                        <div class="card-body">
                            <h3><?php echo htmlspecialchars(get_translation($current_lang, 'event_title_1') ?: 'Historical Retrospective'); ?></h3>
                            <p><?php echo htmlspecialchars(get_translation($current_lang, 'event_text_1') ?: 'Explore dialogues between ancient civilizations and modern design.'); ?></p>
                            <a href="event.php?event=1" class="btn btn-primary mt-2"><?php echo htmlspecialchars(get_translation($current_lang, 'event_view_button')); ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="event-card">
                        <img src="images/event_2.jpg" class="img-fluid" alt="Event 2">
                        <div class="card-body">
                            <h3><?php echo htmlspecialchars(get_translation($current_lang, 'event_title_2') ?: 'Art Workshop'); ?></h3>
                            <p><?php echo htmlspecialchars(get_translation($current_lang, 'event_text_2') ?: 'Create hands-on, unleashing your artistic potential.'); ?></p>
                            <a href="event.php?event=2" class="btn btn-primary mt-2"><?php echo htmlspecialchars(get_translation($current_lang, 'event_view_button')); ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="event-card">
                        <img src="images/event_3.jpg" class="img-fluid" alt="Event 3">
                        <div class="card-body">
                            <h3><?php echo htmlspecialchars(get_translation($current_lang, 'event_title_3') ?: 'Fashion Launch'); ?></h3>
                            <p><?php echo htmlspecialchars(get_translation($current_lang, 'event_text_3') ?: 'Witness the debut of HAF 2025 collection.'); ?></p>
                            <a href="event.php?event=3" class="btn btn-primary mt-2"><?php echo htmlspecialchars(get_translation($current_lang, 'event_view_button')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Community Section -->
    <section id="community" class="community">
        <div class="container text-center">
            <h2 class="section-title"><?php echo htmlspecialchars(get_translation($current_lang, 'community_title')); ?></h2>
            <p class="lead"><?php echo htmlspecialchars(get_translation($current_lang, 'community_subtitle')); ?></p>
            <img src="images/community_image.jpg" class="img-fluid mb-4" alt="Community">
            <a href="#events" class="btn btn-primary"><?php echo htmlspecialchars(get_translation($current_lang, 'community_button')); ?></a>
        </div>
    </section>

    <!-- Themes Section -->
    <section id="themes" class="themes">
        <div class="container">
            <h2 class="section-title"><?php echo htmlspecialchars(get_translation($current_lang, 'themes_title')); ?></h2>
            <p class="lead"><?php echo htmlspecialchars(get_translation($current_lang, 'themes_subtitle')); ?></p>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="theme-card">
                        <i class="fas fa-landmark fa-3x mb-3"></i>
                        <h3><?php echo htmlspecialchars(get_translation($current_lang, 'theme_history_title')); ?></h3>
                        <p><?php echo htmlspecialchars(get_translation($current_lang, 'theme_history_text')); ?></p>
                        <a href="history.php" class="btn btn-primary"><?php echo htmlspecialchars(get_translation($current_lang, 'theme_history_button')); ?></a>
                    </div>
                </div>
                <div class="col">
                    <div class="theme-card">
                        <i class="fas fa-paint-brush fa-3x mb-3"></i>
                        <h3><?php echo htmlspecialchars(get_translation($current_lang, 'theme_art_title')); ?></h3>
                        <p><?php echo htmlspecialchars(get_translation($current_lang, 'theme_art_text')); ?>
                        </p>
                        <a href="art.php" class="btn btn-primary"><?php echo htmlspecialchars(get_translation($current_lang, 'theme_art_button')); ?></a>
                    </div>
                </div>
                <div class="col">
                    <div class="theme-card">
                        <i class="fas fa-tshirt fa-3x mb-3"></i>
                        <h3><?php echo htmlspecialchars(get_translation($current_lang, 'theme_fashion_title')); ?>
                        </h3>
                        <p>
<?php echo htmlspecialchars(get_translation($current_lang, 'theme_fashion_text')); ?>
                        </p>
                        <a href="fashion.php" class="btn btn-primary"><?php echo htmlspecialchars(get_translation($current_lang, 'theme_fashion_button')); ?>
</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Shop CTA -->
    <section id="cta" class="shop-cta">
        <div class="container text-center">
            <h2 class="section-title"><?php echo htmlspecialchars(get_translation($current_lang, 'cta_title')); ?></h2>
            <p class="lead"><?php echo htmlspecialchars(get_translation($current_lang, 'cta_subtitle')); ?></p>
            <a href="php/shop.php" class="btn btn-primary"><?php echo htmlspecialchars(get_translation($current_lang, 'cta_button')); ?></a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <p><?php echo htmlspecialchars(get_translation($current_lang, 'footer_copyright')); ?></p>
            <div class="social-links">
                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        // Language Switch
        document.querySelector('select[name="lang"]').addEventListener('change', function() {
            this.form.submit();
        });

        // Animation Trigger
        document.querySelectorAll('.animate__animated').forEach(el => {
            const delay = el.getAttribute('data-animate-delay') || '0';
            el.style.animationDelay = delay;
        });

        // Lightbox 功能
        const galleryImgs = document.querySelectorAll('.gallery-item img');
        const lightbox = document.createElement('div');
        lightbox.className = 'lightbox';
        lightbox.innerHTML = '<span class="lightbox-close">&times;</span><img src="" alt="Gallery Large">';
        document.body.appendChild(lightbox);
        const lightboxImg = lightbox.querySelector('img');
        const lightboxClose = lightbox.querySelector('.lightbox-close');
        galleryImgs.forEach(img => {
            img.addEventListener('click', e => {
                lightboxImg.src = img.src;
                lightbox.classList.add('active');
        });
        });
        lightboxClose.addEventListener('click', () => {
            lightbox.classList.remove('active');
        });
        lightbox.addEventListener('click', e => {
            if (e.target === lightbox) lightbox.classList.remove('active');
        });
    </script>
</body>
</html>