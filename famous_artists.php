<?php
session_start();

// Define image base path (adjust this to your actual image directory)
$image_base_path = 'images/artists/';
$placeholder_image = 'images/placeholder.jpg'; // Fallback image if artist image is missing

// Translations array
$en_translations = [
    'meta_description' => 'Explore the lives and masterpieces of famous artists with HAF, celebrating their timeless contributions to art.',
    'hero_title' => 'Masters of Art',
    'hero_subtitle' => 'Discover the legacies of iconic artists who shaped the world of creativity.',
    'nav_history' => 'History',
    'nav_art' => 'Art',
    'nav_fashion' => 'Fashion',
    'nav_shop' => 'Shop',
    'timeline_title' => 'Famous Artists Timeline',
    'timeline_subtitle' => 'A journey through the lives of artists who defined art history.',
    'footer_copyright' => '© 2025 History, Art & Fashion. All rights reserved.',
    'modal_close' => 'Close',
    'artists' => [
        1 => ['title' => 'Leonardo da Vinci', 'text' => 'Renaissance genius known for the Mona Lisa and The Last Supper.', 'details' => 'Leonardo da Vinci (1452–1519) was a polymath whose work spanned art, science, and engineering. His iconic Mona Lisa is renowned for its enigmatic expression.'],
        2 => ['title' => 'Vincent van Gogh', 'text' => 'Post-Impressionist painter famous for The Starry Night and Sunflowers.', 'details' => 'Vincent van Gogh (1853–1890) created vibrant, emotional works despite personal struggles, influencing modern art with pieces like The Starry Night.'],
        3 => ['title' => 'Pablo Picasso', 'text' => 'Cubist pioneer who created Guernica and Les Demoiselles d\'Avignon.', 'details' => 'Pablo Picasso (1881–1973) revolutionized art with Cubism, producing groundbreaking works like Guernica that addressed social and political themes.'],
        4 => ['title' => 'Claude Monet', 'text' => 'Impressionist master renowned for Water Lilies and his garden paintings.', 'details' => 'Claude Monet (1840–1926) captured light and atmosphere in his Impressionist works, with Water Lilies showcasing his mastery of color.'],
        5 => ['title' => 'Michelangelo', 'text' => 'Renaissance sculptor and painter known for the Sistine Chapel and David.', 'details' => 'Michelangelo (1475–1564) created monumental works like the Sistine Chapel ceiling, blending art with profound human emotion.'],
        6 => ['title' => 'Rembrandt', 'text' => 'Dutch master known for The Night Watch and self-portraits.', 'details' => 'Rembrandt (1606–1669) used light and shadow to create dramatic, introspective works, including The Night Watch.'],
        7 => ['title' => 'Frida Kahlo', 'text' => 'Mexican artist famous for her vivid self-portraits.', 'details' => 'Frida Kahlo (1907–1954) expressed her pain and identity through vibrant, symbolic self-portraits, becoming a feminist icon.'],
        8 => ['title' => 'Gustav Klimt', 'text' => 'Symbolist painter known for The Kiss and golden artworks.', 'details' => 'Gustav Klimt (1862–1918) blended symbolism and ornamentation in works like The Kiss, characterized by gold leaf and sensuality.'],
        9 => ['title' => 'Mary Cassatt', 'text' => 'Impressionist known for her paintings of motherhood.', 'details' => 'Mary Cassatt (1844–1926) portrayed intimate family moments with soft colors, contributing significantly to Impressionism.'],
        10 => ['title' => 'Edvard Munch', 'text' => 'Expressionist famous for The Scream.', 'details' => 'Edvard Munch (1863–1944) captured psychological intensity in The Scream, a cornerstone of Expressionism.'],
        11 => ['title' => 'Henri Matisse', 'text' => 'Fauvist leader known for vibrant colors and bold forms.', 'details' => 'Henri Matisse (1869–1954) pioneered Fauvism, using bold colors to create dynamic compositions like The Dance.'],
        12 => ['title' => 'Georgia O\'Keeffe', 'text' => 'Modernist known for her large-scale flower paintings.', 'details' => 'Georgia O\'Keeffe (1887–1986) celebrated nature with magnified floral works and desert landscapes, defining American Modernism.'],
        13 => ['title' => 'Jackson Pollock', 'text' => 'Abstract Expressionist famous for drip paintings.', 'details' => 'Jackson Pollock (1912–1956) revolutionized art with his energetic drip techniques, embodying Abstract Expressionism.'],
        14 => ['title' => 'Andy Warhol', 'text' => 'Pop Art icon known for Campbell\'s Soup Cans.', 'details' => 'Andy Warhol (1928–1987) redefined art with Pop Art, using consumer imagery in works like Campbell\'s Soup Cans.'],
        15 => ['title' => 'Salvador Dalí', 'text' => 'Surrealist known for The Persistence of Memory.', 'details' => 'Salvador Dalí (1904–1989) explored the subconscious with dreamlike scenes, including melting clocks in The Persistence of Memory.'],
        16 => ['title' => 'Pierre-Auguste Renoir', 'text' => 'Impressionist known for vibrant social scenes.', 'details' => 'Pierre-Auguste Renoir (1841–1919) depicted joyful gatherings with rich colors in works like Luncheon of the Boating Party.'],
        17 => ['title' => 'Wassily Kandinsky', 'text' => 'Abstract art pioneer with colorful compositions.', 'details' => 'Wassily Kandinsky (1866–1944) created some of the first abstract works, using color to express emotion and spirituality.'],
        18 => ['title' => 'Artemisia Gentileschi', 'text' => 'Baroque painter known for dramatic works.', 'details' => 'Artemisia Gentileschi (1593–1656) brought intensity and feminist perspectives to Baroque art with works like Judith Slaying Holofernes.'],
        19 => ['title' => 'Paul Cézanne', 'text' => 'Post-Impressionist who influenced modern art.', 'details' => 'Paul Cézanne (1839–1906) bridged Impressionism and Cubism with structured compositions like The Card Players.'],
        20 => ['title' => 'Johannes Vermeer', 'text' => 'Dutch master known for Girl with a Pearl Earring.', 'details' => 'Johannes Vermeer (1632–1675) created luminous, intimate scenes with meticulous detail, as seen in Girl with a Pearl Earring.']
    ]
];

$translations = [
    'en' => $en_translations,
    'zh' => [
        'meta_description' => '通过 HAF 探索著名艺术家的生量和杰作，庆祝他们对艺术的永恒贡献。',
        'hero_title' => '艺术大师',
        'hero_subtitle' => '发现塑造创意世界的标志性艺术家的遗产。',
        'nav_history' => '历史',
        'nav_art' => '艺术',
        'nav_fashion' => '时尚',
        'nav_shop' => '商店',
        'timeline_title' => '著名艺术家时间线',
        'timeline_subtitle' => '穿越艺术史的艺术家之旅。',
        'footer_copyright' => '© 2025 历史、艺术与时尚。保留所有权利。',
        'modal_close' => '关闭',
        'artists' => [
            1 => ['title' => '莱昂纳多·达·芬奇', 'text' => '文艺复兴天才，以《蒙娜丽莎》和《最后的晚餐》闻名。', 'details' => '莱昂纳多·达·芬奇（1452–1519）是一位多才多艺的天才，涉及艺术、科学和工程。其标志性作品《蒙娜丽莎》以神秘的表情闻名。'],
            2 => ['title' => '文森特·梵高', 'text' => '后印象派画家，以《星夜》和《向日葵》著称。', 'details' => '文森特·梵高（1853–1890）尽管个人生活坎坷，创作了充满情感的色彩鲜艳作品，如《星夜》。'],
            3 => ['title' => '巴勃罗·毕加索', 'text' => '立体主义先驱，创作了《格尔尼卡》和《阿维尼翁的少女》。', 'details' => '巴勃罗·毕加索（1881–1973）通过立体主义革新艺术，创作了如《格尔尼卡》这样具有社会政治意义的作品。'],
            4 => ['title' => '克劳德·莫奈', 'text' => '印象派大师，以《睡莲》和花园画作闻名。', 'details' => '克劳德·莫奈（1840–1926）通过印象派作品捕捉光线和氛围，《睡莲》展现了他对色彩的精湛掌握。'],
            5 => ['title' => '米开朗基罗', 'text' => '文艺复兴雕塑家和画家，以西斯廷教堂和大卫像闻名。', 'details' => '米开朗基罗（1475–1564）创作了如西斯廷教堂天花板等宏伟作品，融合艺术与深刻的的人类情感。'],
            6 => ['title' => '伦勃朗', 'text' => '荷兰大师，以《夜巡》和自画像著称。', 'details' => '伦勃朗（1606–1669）利用光影创造戏剧性和内省的作品，包括《夜巡》。'],
            7 => ['title' => '弗里达·卡罗', 'text' => '墨西哥艺术家，以生动的自画像闻名。', 'details' => '弗里达·卡罗（1907–1954）通过充满象征意义的生动自画像表达痛苦和身份，成为女性主义偶像。'],
            8 => ['title' => '古斯塔夫·克林姆', 'text' => '象征主义画家，以《吻》和金色作品闻名。', 'details' => '古斯塔夫·克林姆（1862–1918）在《吻》等作品中融合象征主义和装饰性，使用金箔和感性风格。'],
            9 => ['title' => '玛丽·卡萨特', 'text' => '印象派画家，以母性主题画作著称。', 'details' => '玛丽·卡萨特（1844–1926）用柔和的色彩描绘家庭亲密时刻，对印象派有重要贡献。'],
            10 => ['title' => '爱德华·蒙克', 'text' => '表现主义画家，以《呐喊》闻名。', 'details' => '爱德华·蒙克（1863–1944）在《呐喊》中捕捉心理强度，是表现主义的基石。'],
            11 => ['title' => '亨利·马蒂斯', 'text' => '野兽派领袖，以鲜艳的色彩和大胆的形式著称。', 'details' => '亨利·马蒂斯（1869–1954）开创野兽派，用大胆的色彩创作如《舞蹈》等动态作品。'],
            12 => ['title' => '乔治亚·欧姬芙', 'text' => '现代主义画家，以大型花卉画作闻名。', 'details' => '乔治亚·欧姬芙（1887–1986）通过放大的花卉和沙漠景观作品庆祝自然，定义了美国现代主义。'],
            13 => ['title' => '杰克逊·波洛克', 'text' => '抽象表现主义画家，以滴画技法闻名。', 'details' => '杰克逊·波洛克（1912–1956）通过充满活力的滴画技术革新艺术，体现了抽象表现主义。'],
            14 => ['title' => '安迪·沃霍尔', 'text' => '波普艺术偶像，以坎贝尔汤罐头闻名。', 'details' => '安迪·沃霍尔（1928–1987）通过波普艺术重新定义艺术，使用如坎贝尔汤罐头等消费意象。'],
            15 => ['title' => '萨尔瓦多·达利', 'text' => '超现实主义画家，以《记忆的坚持》闻名。', 'details' => '萨尔瓦多·达利（1904–1989）通过如《记忆的坚持》中融化的时钟探索潜资源和梦境场景。'],
            16 => ['title' => '皮埃尔-奥古斯特·雷诺阿', 'text' => '印象派画家，以生动的社交场景著称。', 'details' => '皮埃尔-奥古斯特·雷诺阿（1841–1919）在如《游艇午餐》等作品中用丰富色彩描绘欢乐聚会。'],
            17 => ['title' => '瓦西里·康定斯基', 'text' => '抽象艺术先驱，以多彩的构图闻名。', 'details' => '瓦西里·康定斯基（1866–1944）创作了最早的抽象作品，用色彩表达情感和社会政治意义。'],
            18 => ['title' => '阿尔泰米西亚·真蒂莱斯基', 'text' => '巴洛克画家，以戏剧性作品闻名。', 'details' => '阿尔泰米西亚·真蒂莱斯基（1593–1656）以如《朱迪斯斩杀霍洛芬尼》等作品带来巴洛克艺术的强度和女性主义视角。'],
            19 => ['title' => '保罗·塞尚', 'text' => '后印象派画家，影响了现代艺术。', 'details' => '保罗·塞尚（1839–1906）通过如《纸牌玩家》等结构化构图连接印象派和立体主义。'],
            20 => ['title' => '约翰内斯·维米尔', 'text' => '荷兰大师，以《戴珍珠耳环的少女》闻名。', 'details' => '约翰内斯·维米尔（1632–1675）以精致的细节创作了如《戴珍珠耳环的少女》等明亮而亲密的场景。']
        ]
    ],
    'ar' => [
        'meta_description' => 'استكشف حياة وأعمال الفنانين المشهورين مع HAF، احتفالاً بمساهماتهم الخالدة في الفن.',
        'hero_title' => 'أساتذة الفن',
        'hero_subtitle' => 'اكتشف إرث الفنانين الأيقونيين الذين شكلوا عالم الإبداع.',
        'nav_history' => 'التاريخ',
        'nav_art' => 'الفن',
        'nav_fashion' => 'الموضة',
        'nav_shop' => 'المتجر',
        'timeline_title' => 'الجدول الزمني للفنانين المشهورين',
        'timeline_subtitle' => 'رحلة عبر حياة الفنانين الذين عرّفوا تاريخ الفن.',
        'footer_copyright' => '© 2025 التاريخ والفن والموضة. جميع الحقوق محفوظة.',
        'modal_close' => 'إغلاق',
        'artists' => [
            1 => ['title' => 'ليوناردو دافنشي', 'text' => 'عبقري عصر النهضة المعروف بلوحة الموناليزا والعشاء الأخير.', 'details' => 'ليوناردو دافنشي (1452-1519) كان عالماً متعدد المواهب امتد عمله عبر الفن والعلوم والهندسة. لوحته الأيقونية الموناليزا معروفة بتعبيرها الغامض.'],
            2 => ['title' => 'فنسنت فان غوخ', 'text' => 'رسام ما بعد الانطباعية مشهور بلوحة ليلة النجوم وعباد الشمس.', 'details' => 'فنسنت فان غوخ (1853-1890) أنتج أعمالاً حيوية وعاطفية رغم الصعوبات الشخصية، مؤثراً على الفن الحديث بأعمال مثل ليلة النجوم.'],
            3 => ['title' => 'بابلو بيكاسو', 'text' => 'رائد التكعيبية الذي أنتج غرنيكا وفتيات أفينيون.', 'details' => 'بابلو بيكاسو (1881-1973) أحدث ثورة في الفن بالتكعيبية، منتجاً أعمالاً رائدة مثل غرنيكا التي تناولت المواضيع الاجتماعية والسياسية.'],
            4 => ['title' => 'كلود مونيه', 'text' => 'سيد الانطباعية المعروف بلوحات زنابق الماء وحدائقه.', 'details' => 'كلود مونيه (1840-1926) أمسك بالضوء والجو في أعماله الانطباعية، مع زنابق الماء التي تظهر براعته في استخدام اللون.'],
            5 => ['title' => 'مايكل أنجلو', 'text' => 'نحات ورسام عصر النهضة معروف بكنيسة سيستين وتمثال ديفيد.', 'details' => 'مايكل أنجلو (1475-1564) أنتج أعمالاً ضخمة مثل سقف كنيسة سيستين، مزجاً الفن مع المشاعر الإنسانية العميقة.'],
            6 => ['title' => 'رامبرانت', 'text' => 'السيد الهولندي المعروف بلوحة الحراسة الليلية والصور الذاتية.', 'details' => 'رامبرانت (1606-1669) استخدم الضوء والظل لخلق أعمال درامية وتأملية، بما في ذلك الحراسة الليلية.'],
            7 => ['title' => 'فريدا كالو', 'text' => 'فنانة مكسيكية مشهورة بصورها الذاتية النابضة بالحياة.', 'details' => 'فريدا كالو (1907-1954) عبرت عن ألمها وهويتها من خلال صورها الذاتية الرمزية النابضة بالحياة، لتصبح أيقونة نسوية.'],
            8 => ['title' => 'غوستاف كليمت', 'text' => 'رسام رمزي معروف بلوحة القبلة والأعمال الذهبية.', 'details' => 'غوستاف كليمت (1862-1918) مزج الرمزية والزخرفة في أعمال مثل القبلة، مميزاً بأوراق الذهب والحسية.'],
            9 => ['title' => 'ماري كاسات', 'text' => 'انطباعية معروفة بلوحاتها عن الأمومة.', 'details' => 'ماري كاسات (1844-1926) صورت لحظات عائلية حميمة بألوان ناعمة، مساهمة بشكل كبير في الانطباعية.'],
            10 => ['title' => 'إدفارد مونك', 'text' => 'تعبيري مشهور بلوحة الصرخة.', 'details' => 'إدفارد مونك (1863-1944) أمسك بالكثافة النفسية في الصرخة، حجر الزاوية في التعبيرية.'],
            11 => ['title' => 'هنري ماتيس', 'text' => 'قائد الوحشية معروف بألوانه الزاهية وأشكاله الجريئة.', 'details' => 'هنري ماتيس (1869-1954) رائد الوحشية، مستخدماً ألواناً جريئة لخلق تركيبات ديناميكية مثل الرقصة.'],
            12 => ['title' => 'جورجيا أوكيف', 'text' => 'حداثية معروفة بلوحاتها الكبيرة للزهور.', 'details' => 'جورجيا أوكيف (1887-1986) احتفلت بالطبيعة بأعمال زهرية مكبرة ومناظر صحراوية، معرّفة الحداثة الأمريكية.'],
            13 => ['title' => 'جاكسون بولوك', 'text' => 'تعبيري تجريدي مشهور بلوحات التنقيط.', 'details' => 'جاكسون بولوك (1912-1956) أحدث ثورة في الفن بتقنيات التنقيط النشطة، تجسيداً للتعبيرية التجريدية.'],
            14 => ['title' => 'آندي وارهول', 'text' => 'أيقونة فن البوب معروفة بلوحات علب حساء كامبل.', 'details' => 'آندي وارهول (1928-1987) أعاد تعريف الفن بفن البوب، مستخدماً صوراً استهلاكية في أعمال مثل علب حساء كامبل.'],
            15 => ['title' => 'سلفادور دالي', 'text' => 'سريالي معروف بلوحة استمرارية الذاكرة.', 'details' => 'سلفادور دالي (1904-1989) استكشف اللاوعي بمشاهد تشبه الأحلام، بما في ذلك الساعات الذائبة في استمرارية الذاكرة.'],
            16 => ['title' => 'بيير أوغست رينوار', 'text' => 'انطباعي معروف بمشاهده الاجتماعية النابضة بالحياة.', 'details' => 'بيير أوغست رينوار (1841-1919) صور تجمعات سعيدة بألوان غنية في أعمال مثل غداء على متن القارب.'],
            17 => ['title' => 'فاسيلي كاندينسكي', 'text' => 'رائد الفن التجريدي مع تركيبات ملونة.', 'details' => 'فاسيلي كاندينسكي (1866-1944) أنتج بعض أول الأعمال التجريدية، مستخدماً اللون للتعبير عن المشاعر والروحانية.'],
            18 => ['title' => 'أرتيميسيا جنتلسكي', 'text' => 'رسامة باروكية معروفة بأعمالها الدرامية.', 'details' => 'أرتيميسيا جنتلسكي (1593-1656) جلبت الكثافة والمنظور النسوي إلى فن الباروك بأعمال مثل يهوديت تقتل هولوفرنيس.'],
            19 => ['title' => 'بول سيزان', 'text' => 'ما بعد الانطباعية الذي أثر على الفن الحديث.', 'details' => 'بول سيزان (1839-1906) ربط الانطباعية والتكعيبية بتراكيب منظمة مثل لاعبي الورق.'],
            20 => ['title' => 'يوهانس فيرمير', 'text' => 'السيد الهولندي المعروف بلوحة الفتاة ذات القرط اللؤلؤي.', 'details' => 'يوهانس فيرمير (1632-1675) أنتج مشاهد مضيئة وحميمة بتفاصيل دقيقة، كما يظهر في الفتاة ذات القرط اللؤلؤي.']
        ]
    ],
    'fr' => [
        'meta_description' => 'Explorez la vie et les chefs-d\'œuvre des artistes célèbres avec HAF, célébrant leurs contributions intemporelles à l\'art.',
        'hero_title' => 'Maîtres de l\'Art',
        'hero_subtitle' => 'Découvrez l\'héritage des artistes iconiques qui ont façonné le monde de la créativité.',
        'nav_history' => 'Histoire',
        'nav_art' => 'Art',
        'nav_fashion' => 'Mode',
        'nav_shop' => 'Boutique',
        'timeline_title' => 'Chronologie des Artistes Célèbres',
        'timeline_subtitle' => 'Un voyage à travers la vie des artistes qui ont défini l\'histoire de l\'art.',
        'footer_copyright' => '© 2025 Histoire, Art & Mode. Tous droits réservés.',
        'modal_close' => 'Fermer',
        'artists' => [
            1 => ['title' => 'Léonard de Vinci', 'text' => 'Génie de la Renaissance connu pour la Joconde et La Cène.', 'details' => 'Léonard de Vinci (1452-1519) était un polymathe dont le travail s\'étendait à l\'art, la science et l\'ingénierie. Sa Joconde iconique est renommée pour son expression énigmatique.'],
            2 => ['title' => 'Vincent van Gogh', 'text' => 'Peintre post-impressionniste célèbre pour La Nuit étoilée et Les Tournesols.', 'details' => 'Vincent van Gogh (1853-1890) a créé des œuvres vibrantes et émotionnelles malgré ses difficultés personnelles, influençant l\'art moderne avec des pièces comme La Nuit étoilée.'],
            3 => ['title' => 'Pablo Picasso', 'text' => 'Pionnier du cubisme qui a créé Guernica et Les Demoiselles d\'Avignon.', 'details' => 'Pablo Picasso (1881-1973) a révolutionné l\'art avec le cubisme, produisant des œuvres révolutionnaires comme Guernica qui abordaient des thèmes sociaux et polítiques.'],
            4 => ['title' => 'Claude Monet', 'text' => 'Maître impressionniste renommé pour Les Nymphéas et ses peintures de jardin.', 'details' => 'Claude Monet (1840-1926) a capturé la lumière et l\'atmosphère dans ses œuvres impressionnistes, avec Les Nymphéas montrant sa maîtrise de la couleur.'],
            5 => ['title' => 'Michel-Ange', 'text' => 'Sculpteur et peintre de la Renaissance connu pour la Chapelle Sixtine et David.', 'details' => 'Michel-Ange (1475-1564) a créé des œuvres monumentales comme le plafond de la Chapelle Sixtine, mêlant art et émotion humaine profonde.'],
            6 => ['title' => 'Rembrandt', 'text' => 'Maître hollandais connu pour La Ronde de nuit et ses autoportraits.', 'details' => 'Rembrandt (1606-1669) a utilisé la lumière et l\'ombre pour créer des œuvres dramatiques et introspectives, y compris La Ronde de nuit.'],
            7 => ['title' => 'Frida Kahlo', 'text' => 'Artiste mexicaine célèbre pour ses autoportraits vifs.', 'details' => 'Frida Kahlo (1907-1954) a exprimé sa douleur et son identité à travers des autoportraits symboliques vifs, devenant une icône féministe.'],
            8 => ['title' => 'Gustav Klimt', 'text' => 'Peintre symboliste connu pour Le Baiser et ses œuvres dorées.', 'details' => 'Gustav Klimt (1862-1918) a mêlé symbolisme et ornementation dans des œuvres comme Le Baiser, caractérisées par la feuille d\'or et la sensualité.'],
            9 => ['title' => 'Mary Cassatt', 'text' => 'Impressionniste connue pour ses peintures de la maternité.', 'details' => 'Mary Cassatt (1844-1926) a dépeint des moments familiaux intimes avec des couleurs douces, contribuant significativement à l\'impressionnisme.'],
            10 => ['title' => 'Edvard Munch', 'text' => 'Expressionniste célèbre pour Le Cri.', 'details' => 'Edvard Munch (1863-1944) a capturé l\'intensité psychologique dans Le Cri, une pierre angulaire de l\'expressionnisme.'],
            11 => ['title' => 'Henri Matisse', 'text' => 'Leader fauve connu pour ses couleurs vibrantes et ses formes audacieuses.', 'details' => 'Henri Matisse (1869-1954) a été pionnier du fauvisme, utilisant des couleurs audacieuses pour créer des compositions dynamiques comme La Danse.'],
            12 => ['title' => 'Georgia O\'Keeffe', 'text' => 'Moderniste connue pour ses grandes peintures de fleurs.', 'details' => 'Georgia O\'Keeffe (1887-1986) a célébré la nature avec des œuvres florales agrandies et des paysages désertiques, définissant le modernisme américain.'],
            13 => ['title' => 'Jackson Pollock', 'text' => 'Expressionniste abstrait célèbre pour ses peintures au goutte-à-goutte.', 'details' => 'Jackson Pollock (1912-1956) a révolutionné l\'art avec ses techniques énergiques de goutte-à-goutte, incarnant l\'expressionnisme abstrait.'],
            14 => ['title' => 'Andy Warhol', 'text' => 'Icône du Pop Art connue pour les Boîtes de soupe Campbell.', 'details' => 'Andy Warhol (1928-1987) a redéfini l\'art avec le Pop Art, utilisant des images de consommation dans des œuvres comme Campbell\'s Soup Cans.'],
            15 => ['title' => 'Salvador Dalí', 'text' => 'Surréaliste connu pour La Persistance de la mémoire.', 'details' => 'Salvador Dalí (1904-1989) a exploré le subconscient avec des scènes oniriques, y compris les montres molles dans La Persistance de la mémoire.'],
            16 => ['title' => 'Pierre-Auguste Renoir', 'text' => 'Impressionniste connu pour ses scènes sociales vibrantes.', 'details' => 'Pierre-Auguste Renoir (1841-1919) a dépeint des rassemblements joyeux avec des couleurs riches dans des œuvres comme Le Déjeuner des canotiers.'],
            17 => ['title' => 'Vassily Kandinsky', 'text' => 'Pionnier de l\'art abstrait avec des compositions colorées.', 'details' => 'Vassily Kandinsky (1866-1944) a créé certaines des premières œuvres abstraites, utilisant la couleur pour exprimer l\'émotion et la spiritualité.'],
            18 => ['title' => 'Artemisia Gentileschi', 'text' => 'Peintre baroque connue pour ses œuvres dramatiques.', 'details' => 'Artemisia Gentileschi (1593-1656) a apporté intensité et perspectives féministes à l\'art baroque avec des œuvres comme Judith décapitant Holopherne.'],
            19 => ['title' => 'Paul Cézanne', 'text' => 'Post-impressionniste qui a influencé l\'art moderne.', 'details' => 'Paul Cézanne (1839-1906) a fait le lien entre impressionnisme et cubisme avec des compositions structurées comme Les Joueurs de cartes.'],
            20 => ['title' => 'Johannes Vermeer', 'text' => 'Maître hollandais connu pour La Jeune Fille à la perle.', 'details' => 'Johannes Vermeer (1632-1675) a créé des scènes lumineuses et intimes avec des détails méticuleux, comme on le voit dans La Jeune Fille à la perle.']
        ]
    ],
    'ru' => [
        'meta_description' => 'Исследуйте жизнь и шедевры известных художников с HAF, отмечая их вневременной вклад в искусство.',
        'hero_title' => 'Мастера Искусства',
        'hero_subtitle' => 'Откройте наследие знаковых художников, сформировавших мир творчества.',
        'nav_history' => 'История',
        'nav_art' => 'Искусство',
        'nav_fashion' => 'Мода',
        'nav_shop' => 'Магазин',
        'timeline_title' => 'Хронология Известных Художников',
        'timeline_subtitle' => 'Путешествие по жизни художников, определивших историю искусства.',
        'footer_copyright' => '© 2025 История, Искусство и Мода. Все права защищены.',
        'modal_close' => 'Закрыть',
        'artists' => [
            1 => ['title' => 'Леонардо да Винчи', 'text' => 'Гений эпохи Возрождения, известный Моной Лизой и Тайной вечерей.', 'details' => 'Леонардо да Винчи (1452-1519) был универсальным гением, чьи работы охватывали искусство, науку и инженерию. Его знаменитая Мона Лиза известна своей загадочной улыбкой.'],
            2 => ['title' => 'Винсент ван Гог', 'text' => 'Постимпрессионист, известный Звёздной ночью и Подсолнухами.', 'details' => 'Винсент ван Гог (1853-1890) создавал яркие, эмоциональные работы, несмотря на личные трудности, влияя на современное искусство такими произведениями, как Звёздная ночь.'],
            3 => ['title' => 'Пабло Пикассо', 'text' => 'Пионер кубизма, создавший Гернику и Авиньонских девиц.', 'details' => 'Пабло Пикассо (1881-1973) революционназировал искусство кубизмом, создавая новаторские работы, такие как Герника, затрагивающие социальные и политические темы.'],
            4 => ['title' => 'Клод Моне', 'text' => 'Мастер импрессионизма, известный Кувшинками и садовыми картинами.', 'details' => 'Клод Моне (1840-1926) запечатлевал свет и атмосферу в своих импрессионистских работах, с Кувшинками, демонстрирующими его мастерство цвета.'],
            5 => ['title' => 'Микеланджело', 'text' => 'Скульптор и художник эпохи Возрождения, известный Сикстинской капеллой и Давидом.', 'details' => 'Микеланджело (1475-1564) создавал монументальные работы, такие как потолок Сикстинской капеллы, сочетая искусство с глубокими человеческими эмоциями.'],
            6 => ['title' => 'Рембрандт', 'text' => 'Голландский мастер, известный Ночным дозором и автопортретами.', 'details' => 'Рембрандт (1606-1669) использовал свет и тень для создания драматических, интроспективных работ, включая Ночной дозор.'],
            7 => ['title' => 'Фрида Кало', 'text' => 'Мексиканская художница, известная своими яркими автопортретами.', 'details' => 'Фрида Кало (1907-1954) выражала свою боль и идентичность через яркие, символические автопортреты, став феминистской иконой.'],
            8 => ['title' => 'Густав Климт', 'text' => 'Символист, известный Поцелуем и золотыми работами.', 'details' => 'Густав Климт (1862-1918) сочетал символизм и орнаментацию в работах, таких как Поцелуй, характеризуемых сусальным золотом и чувственностью.'],
            9 => ['title' => 'Мэри Кассат', 'text' => 'Импрессионистка, известная картинами материнства.', 'details' => 'Мэри Кассат (1844-1926) изображала интимные семейные моменты мягкими цветами, значительно способствуя импрессионизму.'],
            10 => ['title' => 'Эдвард Мунк', 'text' => 'Экспрессионист, известный Криком.', 'details' => 'Эдвард Мунк (1863-1944) запечатлел психологическую интенсивность в Крике, краеугольным камне экспрессионизма.'],
            11 => ['title' => 'Анри Матисс', 'text' => 'Лидер фовизма, известный яркими цветами и смелыми формами.', 'details' => 'Анри Матисс (1869-1954) был пионером фовизма, используя смелые цвета для создания динамичных композиций, таких как Танец.'],
            12 => ['title' => 'Джорджия О\'Киф', 'text' => 'Модернистка, известная крупномасштабными картинами цветов.', 'details' => 'Джорджия О\'Киф (1887-1986) прославляла природу увеличенными цветочными работами и пустынными пейзажами, определяя американский модернизм.'],
            13 => ['title' => 'Джексон Поллок', 'text' => 'Абстрактный экспрессионист, известный капельной живописью.', 'details' => 'Джексон Поллок (1912-1956) революционназировал искусство своими энергичными техниками капельной живописи, воплощая абстрактный экспрессионизм.'],
            14 => ['title' => 'Энди Уорхол', 'text' => 'Икона поп-арта, известная банками супа Кэмпбелл.', 'details' => 'Энди Уорхол (1928-1987) переопределил искусство поп-артом, используя потребительские образы в работах, таких как банки супа Кэмпбелл.'],
            15 => ['title' => 'Сальвадор Дали', 'text' => 'Сюрреалист, известный Постоянством памяти.', 'details' => 'Сальвадор Дали (1904-1989) исследовал подсознание сновидческими сценами, включая тающие часы в Постоянстве памяти.'],
            16 => ['title' => 'Пьер-Огюст Ренуар', 'text' => 'Импрессионист, известный яркими социальными сценами.', 'details' => 'Пьер-Огюст Ренуар (1841-1919) изображал радостные собрания богатыми цветами в работах, таких как Завтрак гребцов.'],
            17 => ['title' => 'Василий Кандинский', 'text' => 'Пионер абстрактного искусства с красочными композициями.', 'details' => 'Василий Кандинский (1866-1944) создал одни из первых абстрактных работ, используя цвет для выражения эмоций и духовности.'],
            18 => ['title' => 'Артемизия Джентилески', 'text' => 'Барочная художница, известная драматическими работами.', 'details' => 'Артемизия Джентилески (1593-1656) привнесла интенсивность и феминистские перспективы в барочное искусство работами, такими как Юдифь, обезглавливающая Олоферна.'],
            19 => ['title' => 'Поль Сезанн', 'text' => 'Постимпрессионист, повлиявший на современное искусство.', 'details' => 'Поль Сезанн (1839-1906) связал импрессионизм и кубизм структурированными композициями, такими как Игроки в карты.'],
            20 => ['title' => 'Ян Вермеер', 'text' => 'Голландский мастер, известный Девушкой с жемчужной серёжкой.', 'details' => 'Ян Вермеер (1632-1675) создавал светлые, интимные сцены с тщательными деталями, как видно в Девушке с жемчужной серёжкой.']
        ]
    ],
    'pt' => [
        'meta_description' => 'Explore a vida e as obras-primas de artistas famosos com HAF, celebrando suas contribuições atemporais para a arte.',
        'hero_title' => 'Mestres da Arte',
        'hero_subtitle' => 'Descubra os legados dos artistas icônicos que moldaram o mundo da criatividade.',
        'nav_history' => 'História',
        'nav_art' => 'Arte',
        'nav_fashion' => 'Moda',
        'nav_shop' => 'Loja',
        'timeline_title' => 'Linha do Tempo dos Artistas Famosos',
        'timeline_subtitle' => 'Uma jornada através das vidas dos artistas que definiram a história da arte.',
        'footer_copyright' => '© 2025 História, Arte & Moda. Todos os direitos reservados.',
        'modal_close' => 'Fechar',
        'artists' => [
            1 => ['title' => 'Leonardo da Vinci', 'text' => 'Gênio renascentista conhecido pela Mona Lisa e A Última Ceia.', 'details' => 'Leonardo da Vinci (1452-1519) foi um polímata cujo trabalho abrangeu arte, ciência e engenharia. Sua icônica Mona Lisa é renomada por sua expressão enigmática.'],
            2 => ['title' => 'Vincent van Gogh', 'text' => 'Pintor pós-impressionista famoso por A Noite Estrelada e Os Girassóis.', 'details' => 'Vincent van Gogh (1853-1890) criou obras vibrantes e emocionais apesar das lutas pessoais, influenciando a arte moderna com peças como A Noite Estrelada.'],
            3 => ['title' => 'Pablo Picasso', 'text' => 'Pioneiro do cubismo que criou Guernica e Les Demoiselles d\'Avignon.', 'details' => 'Pablo Picasso (1881-1973) revolucionou a arte com o cubismo, produzindo obras inovadoras como Guernica que abordavam temas sociais e políticos.'],
            4 => ['title' => 'Claude Monet', 'text' => 'Mestre impressionista renomado por Nenúfares e suas pinturas de jardim.', 'details' => 'Claude Monet (1840-1926) capturou luz e atmosfera em suas obras impressionistas, com Nenúfares mostrando sua maestria da cor.'],
            5 => ['title' => 'Michelangelo', 'text' => 'Escultor e pintor renascentista conhecido pela Capela Sistina e David.', 'details' => 'Michelangelo (1475-1564) criou obras monumentais como o teto da Capela Sistina, misturando arte com profunda emoção humana.'],
            6 => ['title' => 'Rembrandt', 'text' => 'Mestre holandês conhecido por A Ronda Noturna e autorretratos.', 'details' => 'Rembrandt (1606-1669) usou luz e sombra para criar obras dramáticas e introspectivas, incluindo A Ronda Noturna.'],
            7 => ['title' => 'Frida Kahlo', 'text' => 'Artista mexicana famosa por seus autorretratos vívidos.', 'details' => 'Frida Kahlo (1907-1954) expressou sua dor e identidade através de autorretratos simbólicos vívidos, tornando-se um ícone feminista.'],
            8 => ['title' => 'Gustav Klimt', 'text' => 'Pintor simbolista conhecido por O Beijo e obras douradas.', 'details' => 'Gustav Klimt (1862-1918) misturou simbolismo e ornamentação em obras como O Beijo, caracterizadas por folha de ouro e sensualidade.'],
            9 => ['title' => 'Mary Cassatt', 'text' => 'Impressionista conhecida por suas pinturas da maternidade.', 'details' => 'Mary Cassatt (1844-1926) retratou momentos familiares íntimos com cores suaves, contribuindo significativamente para o impressionismo.'],
            10 => ['title' => 'Edvard Munch', 'text' => 'Expressionista famoso por O Grito.', 'details' => 'Edvard Munch (1863-1944) capturou intensidade psicológica em O Grito, uma pedra angular do expressionismo.'],
            11 => ['title' => 'Henri Matisse', 'text' => 'Líder fauvista conhecido por cores vibrantes e formas ousadas.', 'details' => 'Henri Matisse (1869-1954) foi pioneiro do fauvismo, usando cores ousadas para criar composições dinâmicas como A Dança.'],
            12 => ['title' => 'Georgia O\'Keeffe', 'text' => 'Modernista conhecida por suas grandes pinturas de flores.', 'details' => 'Georgia O\'Keeffe (1887-1986) celebrou a natureza com obras florais ampliadas e paisagens desérticas, definindo o modernismo americano.'],
            13 => ['title' => 'Jackson Pollock', 'text' => 'Expressionista abstrato famoso por pinturas de gotejamento.', 'details' => 'Jackson Pollock (1912-1956) revolucionou a arte com suas técnicas energéticas de gotejamento, personificando o expressionismo abstrato.'],
            14 => ['title' => 'Andy Warhol', 'text' => 'Ícone da Pop Art conhecido por Latas de Sopa Campbell.', 'details' => 'Andy Warhol (1928-1987) redefiniu a arte com a Pop Art, usando imagens de consumo em obras como Latas de Sopa Campbell.'],
            15 => ['title' => 'Salvador Dalí', 'text' => 'Surrealista conhecido por A Persistência da Memória.', 'details' => 'Salvador Dalí (1904-1989) explorou o subconsciente com cenas oníricas, incluindo relógios derretidos em A Persistência da Memória.'],
            16 => ['title' => 'Pierre-Auguste Renoir', 'text' => 'Impressionista conhecido por cenas sociais vibrantes.', 'details' => 'Pierre-Auguste Renoir (1841-1919) retratou reuniões alegres com cores ricas em obras como O Almoço dos Remadores.'],
            17 => ['title' => 'Vassily Kandinsky', 'text' => 'Pioneiro da arte abstrata com composições coloridas.', 'details' => 'Vassily Kandinsky (1866-1944) criou algumas das primeiras obras abstratas, usando cor para expressar emoção e espiritualidade.'],
            18 => ['title' => 'Artemisia Gentileschi', 'text' => 'Pintora barroca conhecida por obras dramáticas.', 'details' => 'Artemisia Gentileschi (1593-1656) trouxe intensidade e perspectivas feministas à arte barroca com obras como Judite Decapitando Holofernes.'],
            19 => ['title' => 'Paul Cézanne', 'text' => 'Pós-impressionista que influenciou a arte moderna.', 'details' => 'Paul Cézanne (1839-1906) ligou o impressionismo e o cubismo com composições estruturadas como Os Jogadores de Cartas.'],
            20 => ['title' => 'Johannes Vermeer', 'text' => 'Mestre holandês conhecido por Moça com Brinco de Pérola.', 'details' => 'Johannes Vermeer (1632-1675) criou cenas luminosas e íntimas com detalhes meticulosos, como visto em Moça com Brinco de Pérola.']
        ]
    ],
    'ja' => [
        'meta_description' => 'HAFと共に著名なアーティストの生涯と傑作を探索し、アートへの不朽の貢献を称えましょう。',
        'hero_title' => 'アートの巨匠たち',
        'hero_subtitle' => '創造の世界を形作った象徴的なアーティストたちの遺産を発見しましょう。',
        'nav_history' => '歴史',
        'nav_art' => 'アート',
        'nav_fashion' => 'ファッション',
        'nav_shop' => 'ショップ',
        'timeline_title' => '著名なアーティストの年表',
        'timeline_subtitle' => 'アートの歴史を定義したアーティストたちの生涯を旅しましょう。',
        'footer_copyright' => '© 2025 歴史、アート＆ファッション。全権利所有。',
        'modal_close' => '閉じる',
        'artists' => [
            1 => ['title' => 'レオナルド・ダ・ヴィンチ', 'text' => 'モナ・リザと最後の晩餐で知られるルネサンスの天才。', 'details' => 'レオナルド・ダ・ヴィンチ（1452-1519）は、アート、科学、工学を網羅する博学者でした。彼の象徴的なモナ・リザは謎めいた表情で知られています。'],
            2 => ['title' => 'フィンセント・ファン・ゴッホ', 'text' => '星月夜とひまわりで知られるポスト印象派の画家。', 'details' => 'フィンセント・ファン・ゴッホ（1853-1890）は、個人的な苦悩にもかかわらず、星月夜などの作品で現代アートに影響を与える鮮やかで感情的な作品を生み出しました。'],
            3 => ['title' => 'パブロ・ピカソ', 'text' => 'ゲルニカとアビニヨンの娘たちを生み出したキュビズムの先駆者。', 'details' => 'パブロ・ピカソ（1881-1973）は、ゲルニカなどの革新的な作品で社会的・政治的テーマに取り組み、キュビズムでアートを革命化しました。'],
            4 => ['title' => 'クロード・モネ', 'text' => '睡蓮と庭園の絵画で知られる印象派の巨匠。', 'details' => 'クロード・モネ（1840-1926）は印象派の作品で光と雰囲気を捉え、睡蓮は彼の色彩の熟達を示しています。'],
            5 => ['title' => 'ミケランジェロ', 'text' => 'システィーナ礼拝堂とダビデ像で知られるルネサンスの彫刻家・画家。', 'details' => 'ミケランジェロ（1475-1564）はシスティーナ礼拝堂の天井画などの記念碑的な作品を創造し、アートと深い人間の感情を融合させました。'],
            6 => ['title' => 'レンブラント', 'text' => '夜警と自画像で知られるオランダの巨匠。', 'details' => 'レンブラント（1606-1669）は光と影を使用して夜警を含む劇的で内省的な作品を創造しました。'],
            7 => ['title' => 'フリーダ・カーロ', 'text' => '鮮やかな自画像で知られるメキシコのアーティスト。', 'details' => 'フリーダ・カーロ（1907-1954）は鮮やかな象徴的な自画像を通じて痛みとアイデンティティを表現し、フェミニストのアイコンとなりました。'],
            8 => ['title' => 'グスタフ・クリムト', 'text' => '接吻と金の作品で知られる象徴主義者。', 'details' => 'グスタフ・クリムト（1862-1918）は接吻などの作品で象徴主義と装飾を組み合わせ、金箔と官能性が特徴です。'],
            9 => ['title' => 'メアリー・カサット', 'text' => '母性の絵画で知られる印象派の画家。', 'details' => 'メアリー・カサット（1844-1926）は柔らかな色彩で親密な家族の瞬間を描き、印象派に大きく貢献しました。'],
            10 => ['title' => 'エドヴァルド・ムンク', 'text' => '叫びで知られる表現主義者。', 'details' => 'エドヴァルド・ムンク（1863-1944）は表現主義の礎石である叫びで心理的な強度を捉えました。'],
            11 => ['title' => 'アンリ・マティス', 'text' => '鮮やかな色彩と大胆な形態で知られるフォーヴィズムのリーダー。', 'details' => 'アンリ・マティス（1869-1954）はダンスなどの作品で大胆な色彩を使用して動的な構図を創造し、フォーヴィズムの先駆者でした。'],
            12 => ['title' => 'ジョージア・オキーフ', 'text' => '大きな花の絵画で知られるモダニスト。', 'details' => 'ジョージア・オキーフ（1887-1986）は拡大された花の作品と砂漠の風景で自然を称え、アメリカのモダニズムを定義しました。'],
            13 => ['title' => 'ジャクソン・ポロック', 'text' => 'ドリッピング・ペインティングで知られる抽象表現主義者。', 'details' => 'ジャクソン・ポロック（1912-1956）はエネルギッシュなドリッピング技法でアートを革命化し、抽象表現主義を体現しました。'],
            14 => ['title' => 'アンディ・ウォーホル', 'text' => 'キャンベル・スープ缶で知られるポップアートのアイコン。', 'details' => 'アンディ・ウォーホル（1928-1987）はキャンベル・スープ缶などの作品で消費者のイメージを使用し、ポップアートでアートを再定義しました。'],
            15 => ['title' => 'サルバドール・ダリ', 'text' => '記憶の固執で知られるシュルレアリスト。', 'details' => 'サルバドール・ダリ（1904-1989）は記憶の固執で溶ける時計を含む夢のようなシーンで潜在意識を探求しました。'],
            16 => ['title' => 'ピエール＝オーギュスト・ルノワール', 'text' => '鮮やかな社交シーンで知られる印象派の画家。', 'details' => 'ピエール＝オーギュスト・ルノワール（1841-1919）は舟遊びの昼食会などの作品で豊かな色彩で楽しい集まりを描きました。'],
            17 => ['title' => 'ワシリー・カンディンスキー', 'text' => 'カラフルな構図で知られる抽象アートの先駆者。', 'details' => 'ワシリー・カンディンスキー（1866-1944）は感情と精神性を表現するために色彩を使用し、最初の抽象作品のいくつかを創造しました。'],
            18 => ['title' => 'アルテミジア・ジェンティレスキ', 'text' => '劇的な作品で知られるバロックの画家。', 'details' => 'アルテミジア・ジェンティレスキ（1593-1656）はホロフェルネスの首を斬るユディトなどの作品でバロックアートに強度とフェミニストの視点をもたらしました。'],
            19 => ['title' => 'ポール・セザンヌ', 'text' => '現代アートに影響を与えたポスト印象派の画家。', 'details' => 'ポール・セザンヌ（1839-1906）はトランプをする人々などの構造化された構図で印象派とキュビズムを結びつけました。'],
            20 => ['title' => 'ヨハネス・フェルメール', 'text' => '真珠の耳飾りの少女で知られるオランダの巨匠。', 'details' => 'ヨハネス・フェルメール（1632-1675）は真珠の耳飾りの少女に見られるように、細部に注意を払った明るく親密なシーンを創造しました。']
        ]
    ],
    'hi' => [
        'meta_description' => 'HAF के साथ प्रसिद्ध कलाकारों के जीवन और कृतियों का अन्वेषण करें, कला में उनके कालातीत योगदान का जश्न मनाएं।',
        'hero_title' => 'कला के स्वामी',
        'hero_subtitle' => 'रचनात्मकता की दुनिया को आकार देने वाले प्रतिष्ठित कलाकारों की विरासत की खोज करें।',
        'nav_history' => 'इतिहास',
        'nav_art' => 'कला',
        'nav_fashion' => 'फैशन',
        'nav_shop' => 'दुकान',
        'timeline_title' => 'प्रसिद्ध कलाकारों की समयरेखा',
        'timeline_subtitle' => 'कला के इतिहास को परिभाषित करने वाले कलाकारों के जीवन की यात्रा।',
        'footer_copyright' => '© 2025 इतिहास, कला और फैशन। सर्वाधिकार सुरक्षित।',
        'modal_close' => 'बंद करें',
        'artists' => [
         1 => ['title' => 'लियोनार्डो दा विंची', 'text' => 'मोना लिसा और द लास्ट सपर के लिए प्रसिद्ध पुनर्जागरण प्रतिभा।', 'details' => 'लियोनार्डो दा विंची (1452-1519) एक बहुज्ञ थे जिनका कार्य कला, विज्ञान और इंजीनियरिंग को कवर करता था। उनकी प्रतिष्ठित मोना लिसा अपनी रहस्यमय मुस्कान के लिए जानी जाती है।'],
            2 => ['title' => 'विन्सेंट वैन गॉग', 'text' => 'स्टारी नाइट और सनफ्लावर्स के लिए प्रसिद्ध पोस्ट-इम्प्रेशनिस्ट।', 'details' => 'विन्सेंट वैन गॉग (1853-1890) ने व्यक्तिगत संघर्षों के बावजूद जीवंत, भावनात्मक कार्य बनाए, स्टारी नाइट जैसे टुकड़ों के साथ आधुनिक कला को प्रभावित किया।'],
            3 => ['title' => 'पाब्लो पिकासो', 'text' => 'गुएर्निका और लेस डेमोइसेल्स डी\'एविग्नन के निर्माता क्यूबिस्ट अग्रणी।', 'details' => 'पाब्लो पिकासो (1881-1973) ने क्यूबिज्म के साथ कला को क्रांतिकारी बनाया, गुएर्निका जैसे नवीन कार्यों का निर्माण किया जो सामाजिक और राजनीतिक विषयों को संबोधित करते थे।'],
            4 => ['title' => 'क्लॉड मोने', 'text' => 'वॉटर लिलीज और उद्यान चित्रों के लिए प्रसिद्ध इम्प्रेशनिस्ट मास्टर।', 'details' => 'क्लॉड मोने (1840-1926) ने अपने इम्प्रेशनिस्ट कार्यों में प्रकाश और वातावरण को कैप्चर किया, वॉटर लिलीज उनके रंग के निपुणता को दर्शाती है।'],
            5 => ['title' => 'माइकलएंजेलो', 'text' => 'सिस्टिन चैपल और डेविड के लिए प्रसिद्ध पुनर्जागरण मूर्तिकार और चित्रकार।', 'details' => 'माइकलएंजेलो (1475-1564) ने सिस्टिन चैपल की छत जैसे स्मारकीय कार्य बनाए, कला को गहरी मानवीय भावनाओं के साथ मिश्रित किया।'],
            6 => ['title' => 'रेम्ब्रांट', 'text' => 'द नाइट वॉच और आत्म-चित्रों के लिए प्रसिद्ध डच मास्टर।', 'details' => 'रेम्ब्रांट (1606-1669) ने प्रकाश और छाया का उपयोग करके नाइट वॉच सहित नाटकीय, आत्मनिरीक्षण कार्य बनाए।'],
            7 => ['title' => 'फ्रिडा काहलो', 'text' => 'अपने जीवंत आत्म-चित्रों के लिए प्रसिद्ध मैक्सिकन कलाकार।', 'details' => 'फ्रिडा काहलो (1907-1954) ने जीवंत, प्रतीकात्मक आत्म-चित्रों के माध्यम से अपने दर्द और पहचान को व्यक्त किया, एक नारीवादी आइकन बन गईं।'],
            8 => ['title' => 'गुस्ताव क्लिंट', 'text' => 'द किस और सोने के कार्यों के लिए प्रसिद्ध प्रतीकवादी।', 'details' => 'गुस्ताव क्लिंट (1862-1918) ने द किस जैसे कार्यों में प्रतीकवाद और सजावट को मिश्रित किया, सोने की पत्ती और कामुकता की विशेषता।'],
            9 => ['title' => 'हेंरी मातीस', 'text' => 'विश्वास के दोनों भागों को जोड़ने वाले व्यक्ति को जानने के लिए विश्वास की विशेषता।', 'details' => 'हेंरी मातीस (1869-1954) विश्वास के दोनों भागों को जोड़ने वाले व्यक्ति को जानने के लिए विश्वास की विशेषता।'],
            10 => ['title' => 'जोर्जिया ओखीफ', 'text' => 'बड़ी फूलों की छवियों के द्वारा जानी जाने वाली मोदनिस्ट।', 'details' => 'जोर्जिया ओखीफ (1887-1986) बड़ी फूलों की छवियों के द्वारा जानी जाने वाली मोदनिस्ट।'],
            11 => ['title' => 'जैक्सन पोलोक', 'text' => 'ड्रिप्पिंग और ड्रोपिंग के द्वारा जानी जाने वाले अवश्यक व्यक्ति।', 'details' => 'जैक्सन पोलोक (1912-1956) ड्रिप्पिंग और ड्रोपिंग के द्वारा जानी जाने वाले अवश्यक व्यक्ति।'],
            12 => ['title' => 'जोर्जिया ओखीफ', 'text' => 'बड़ी फूलों की छवियों के द्वारा जानी जाने वाली मोदनिस्ट।', 'details' => 'जोर्जिया ओखीफ (1887-1986) बड़ी फूलों की छवियों के द्वारा जानी जाने वाली मोदनिस्ट।'],
            13 => ['title' => 'जैक्सन पोलोक', 'text' => 'ड्रिप्पिंग और ड्रोपिंग के द्वारा जानी जाने वाले अवश्यक व्यक्ति।', 'details' => 'जैक्सन पोलोक (1912-1956) ड्रिप्पिंग और ड्रोपिंग के द्वारा जानी जाने वाले अवश्यक व्यक्ति।'],
            14 => ['title' => 'अंडी उवारोहल', 'text' => 'कैंबेल स्यूप के द्वारा जानी जाने वाले पॉप आर्ट का आइकन।', 'details' => 'अंडी उवारोहल (1928-1987) कैंबेल स्यूप के द्वारा जानी जाने वाले पॉप आर्ट का आइकन।'],
            15 => ['title' => 'सर्वाडोर डाली', 'text' => 'यादवदार के द्वारा जानी जाने वाले शुरूरी व्यक्ति।', 'details' => 'सर्वाडोर डाली (1904-1989) यादवदार के द्वारा जानी जाने वाले शुरूरी व्यक्ति।'],
            16 => ['title' => 'पियर ओगस्ट रेनोवार', 'text' => 'जोर्जिया सोसल सीन के द्वारा जानी जाने वाले इम्प्रेशनिस्ट।', 'details' => 'पियर ओगस्ट रेनोवार (1841-1919) जोर्जिया सोसल सीन के द्वारा जानी जाने वाले इम्प्रेशनिस्ट।'],
            17 => ['title' => 'वाशिली कंडिंस्की', 'text' => 'रंगीन आकृतियों के द्वारा जानी जाने वाले अवश्यक व्यक्ति।', 'details' => 'वाशिली कंडिंस्की (1866-1944) रंगीन आकृतियों के द्वारा जानी जाने वाले अवश्यक व्यक्ति।'],
            18 => ['title' => 'अल्टेमिजिया जेंटिलेस्की', 'text' => 'दर्ददायक व्यक्तियों के द्वारा जानी जाने वाले बारोक्स व्यक्ति।', 'details' => 'अल्टेमिजिया जेंटिलेस्की (1593-1656) दर्ददायक व्यक्तियों के द्वारा जानी जाने वाले बारोक्स व्यक्ति।'],
            19 => ['title' => 'पोल सेजानन', 'text' => 'वर्तमान आर्ट में प्रभाव देने वाले पोस्ट-इम्प्रेशनिस्ट।', 'details' => 'पोल सेजानन (1839-1906) वर्तमान आर्ट में प्रभाव देने वाले पोस्ट-इम्प्रेशनिस्ट।'],
            20 => ['title' => 'योहानेस वर्मेर', 'text' => 'होलंड व्यक्ति जो जेम्चुआरी सीन के द्वारा जानी जाने वाले व्यक्ति।', 'details' => 'योहानेस वर्मेर (1632-1675) होलंड व्यक्ति जो जेम्चुआरी सीन के द्वारा जानी जाने वाले व्यक्ति।']
        ]
    ],
    'ms' => [
        'meta_description' => 'Terokai kehidupan dan karya agung artis terkenal dengan HAF, meraikan sumbangan abadi mereka kepada seni.',
        'hero_title' => 'Tuan-tuan Seni',
        'hero_subtitle' => 'Temui warisan artis ikonik yang membentuk dunia kreativiti.',
        'nav_history' => 'Sejarah',
        'nav_art' => 'Seni',
        'nav_fashion' => 'Fesyen',
        'nav_shop' => 'Kedai',
        'timeline_title' => 'Garis Masa Artis Terkenal',
        'timeline_subtitle' => 'Perjalanan melalui kehidupan artis yang mentakrifkan sejarah seni.',
        'footer_copyright' => '© 2025 Sejarah, Seni & Fesyen. Hak Cipta Terpelihara.',
        'modal_close' => 'Tutup',
        'artists' => [
            1 => ['title' => 'Leonardo da Vinci', 'text' => 'Genius Renaissance yang terkenal dengan Mona Lisa dan The Last Supper.', 'details' => 'Leonardo da Vinci (1452-1519) adalah seorang polymath yang karyanya merangkumi seni, sains dan kejuruteraan. Mona Lisa ikoniknya terkenal dengan senyuman misterinya.'],
            2 => ['title' => 'Vincent van Gogh', 'text' => 'Pelukis pasca-impresionis terkenal dengan Starry Night dan Sunflowers.', 'details' => 'Vincent van Gogh (1853-1890) mencipta karya yang penuh hidup dan emosi walaupun menghadapi cabaran peribadi, mempengaruhi seni moden dengan karya seperti Starry Night.'],
            3 => ['title' => 'Pablo Picasso', 'text' => 'Perintis kubisme yang mencipta Guernica dan Les Demoiselles d\'Avignon.', 'details' => 'Pablo Picasso (1881-1973) merevolusikan seni dengan kubisme, menghasilkan karya inovatif seperti Guernica yang membincangkan tema sosial dan politik.'],
            4 => ['title' => 'Claude Monet', 'text' => 'Tuan impresionis terkenal dengan Water Lilies dan lukisan taman.', 'details' => 'Claude Monet (1840-1926) menangkap cahaya dan suasana dalam karya impresionisnya, dengan Water Lilies menunjukkan kemahirannya dalam warna.'],
            5 => ['title' => 'Michelangelo', 'text' => 'Pengukir dan pelukis Renaissance terkenal dengan Sistine Chapel dan David.', 'details' => 'Michelangelo (1475-1564) mencipta karya monumental seperti siling Sistine Chapel, menggabungkan seni dengan emosi manusia yang mendalam.'],
            6 => ['title' => 'Rembrandt', 'text' => 'Tuan Belanda terkenal dengan The Night Watch dan potret diri.', 'details' => 'Rembrandt (1606-1669) menggunakan cahaya dan bayang untuk mencipta karya dramatik dan introspektif, termasuk The Night Watch.'],
            7 => ['title' => 'Frida Kahlo', 'text' => 'Artis Mexico terkenal dengan potret diri yang penuh hidup.', 'details' => 'Frida Kahlo (1907-1954) meluahkan kesakitan dan identitinya melalui potret diri simbolik yang penuh hidup, menjadi ikon feminis.'],
            8 => ['title' => 'Gustav Klimt', 'text' => 'Simbolis terkenal dengan The Kiss dan karya emas.', 'details' => 'Gustav Klimt (1862-1918) menggabungkan simbolisme dan hiasan dalam karya seperti The Kiss, dicirikan oleh daun emas dan sensualitas.'],
            9 => ['title' => 'Mary Cassatt', 'text' => 'Impresionis terkenal dengan lukisan keibuan.', 'details' => 'Mary Cassatt (1844-1926) menggambarkan detik-detik keluarga intim dengan warna lembut, menyumbang secara signifikan kepada impresionisme.'],
            10 => ['title' => 'Edvard Munch', 'text' => 'Expressionista famoso por O Grito.', 'details' => 'Edvard Munch (1863-1944) menangkap intensiti psikologi dalam O Grito, batu asas ekspresionisme.'],
            11 => ['title' => 'Henri Matisse', 'text' => 'Líder fauvisme terkenal dengan warna terang dan bentuk berani.', 'details' => 'Henri Matisse (1869-1954) adalah perintis fauvisme, menggunakan warna berani untuk mencipta komposisi dinamik seperti The Dance.'],
            12 => ['title' => 'Georgia O\'Keeffe', 'text' => 'Modernis terkenal dengan lukisan bunga berskala besar.', 'details' => 'Georgia O\'Keeffe (1887-1986) meraikan alam semula jadi dengan karya bunga yang diperbesar dan landskap padang pasir, mentakrifkan modernisme Amerika.'],
            13 => ['title' => 'Jackson Pollock', 'text' => 'Expressionista abstrak terkenal dengan lukisan titisan.', 'details' => 'Jackson Pollock (1912-1956) merevolusikan seni dengan teknik titisan energiknya, menjadi lambang ekspresionisme abstrak.'],
            14 => ['title' => 'Andy Warhol', 'text' => 'Ikon Pop Art terkenal dengan Tin Sup Campbell.', 'details' => 'Andy Warhol (1928-1987) mentakrifkan semula seni dengan Pop Art, menggunakan imej pengguna dalam karya seperti Tin Sup Campbell.'],
            15 => ['title' => 'Salvador Dalí', 'text' => 'Surealis terkenal dengan The Persistence of Memory.', 'details' => 'Salvador Dalí (1904-1989) meneroka alam bawah sedar dengan pemandangan seperti mimpi, termasuk jam yang mencair dalam The Persistence of Memory.'],
            16 => ['title' => 'Pierre-Auguste Renoir', 'text' => 'Impresionis terkenal dengan pemandangan sosial yang penuh hidup.', 'details' => 'Pierre-Auguste Renoir (1841-1919) menggambarkan perhimpunan yang penuh kegembiraan dengan warna yang kaya dalam karya seperti Lunch of the Boating Party.'],
            17 => ['title' => 'Vassily Kandinsky', 'text' => 'Pioneiro da arte abstrata com composições coloridas.', 'details' => 'Vassily Kandinsky (1866-1944) criou algumas das primeiras obras abstratas, usando cor para expressar emoção e espiritualidade.'],
            18 => ['title' => 'Artemisia Gentileschi', 'text' => 'Pintora barroca conhecida por obras dramáticas.', 'details' => 'Artemisia Gentileschi (1593-1656) trouxe intensidade e perspectivas feministas à arte barroca com obras como Judite Decapitando Holofernes.'],
            19 => ['title' => 'Paul Cézanne', 'text' => 'Pós-impressionista que influenciou a arte moderna.', 'details' => 'Paul Cézanne (1839-1906) ligou o impressionismo e o cubismo com composições estruturadas como Os Jogadores de Cartas.'],
            20 => ['title' => 'Johannes Vermeer', 'text' => 'Mestre holandês conhecido por Moça com Brinco de Pérola.', 'details' => 'Johannes Vermeer (1632-1675) criou cenas luminosas e íntimas com detalhes meticulosos, como visto em Moça com Brinco de Pérola.']
        ]
    ]
];

// Default language to English
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en';
}

// Handle language switching
if (isset($_POST['lang'])) {
    $valid_langs = array_keys($translations);
    $_SESSION['lang'] = in_array($_POST['lang'], $valid_langs) ? $_POST['lang'] : 'en';
}

$current_lang = $_SESSION['lang'];
if (!isset($translations[$current_lang])) {
    $current_lang = 'en';
}
$site_dir = $current_lang === 'ar' ? 'rtl' : 'ltr';

// Helper function to get translations
function get_translation($lang, $key) {
    global $translations;
    if (isset($translations[$lang][$key])) {
        return $translations[$lang][$key];
    }
    return isset($translations['en'][$key]) ? $translations['en'][$key] : '';
}

// Function to get image path with fallback
function get_image_path($index, $base_path, $placeholder) {
    $image_path = $base_path . 'artist' . $index . '.jpg';
    return file_exists($image_path) ? $image_path : $placeholder;
}

$lang_names = [
    'en' => 'English',
    'zh' => '中文',
    'es' => 'Español',
    'ar' => 'العربية',
    'fr' => 'Français',
    'ru' => 'Русский',
    'pt' => 'Português',
    'de' => 'Deutsch',
    'ja' => '日本語',
    'hi' => 'हिन्दी',
    'ms' => 'Bahasa Malaysia'
];
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($current_lang); ?>" dir="<?php echo $site_dir; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars(get_translation($current_lang, 'meta_description')); ?>">
    <title>HAF - <?php echo htmlspecialchars(get_translation($current_lang, 'timeline_title')); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@300;400;700&family=Noto+Sans+Arabic:wght@400;700&family=Noto+Sans+JP:wght@400;700&family=Noto+Sans+Deva:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        :root {
            --primary-color: #2c3e50;
            --accent-color: #d4a373;
            --text-dark: #1a1a1a;
            --text-light: #f5f5f5;
            --bg-light: #fafafa;
            --bg-dark: #1e1e1e;
            --modal-bg: rgba(0, 0, 0, 0.85);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background: var(--bg-light);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Navigation Styles */
        .navbar {
            background: var(--primary-color);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-logo img {
            height: 40px;
            width: auto;
        }

        .navbar-logo span {
            color: var(--text-light);
            font-size: 1.2rem;
            font-weight: 700;
        }

        .navbar-links {
            display: flex;
            gap: 20px;
        }

        .navbar-links a {
            color: var(--text-light);
            text-decoration: none;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .navbar-links a:hover,
        .navbar-links a.active {
            color: var(--accent-color);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(44, 62, 80, 0.9), rgba(44, 62, 80, 0.9)), url('images/hero-bg.jpg');
            background-size: cover;
            background-position: center;
            color: var(--text-light);
            padding: 100px 0;
            text-align: center;
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Artists Section */
        .artists-section {
            padding: 80px 0;
            overflow-y: visible;
            height: auto;
            scroll-snap-type: y mandatory;
            scroll-behavior: smooth;
            position: relative;
        }

        .artists-section h2 {
            text-align: center;
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 10px;
            padding: 20px 0;
        }

        .artists-section .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 40px;
            padding: 10px 0;
        }

        .artist-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            padding: 80px 20px;
            margin-bottom: 0;
            transition: all 0.5s ease;
            scroll-snap-align: start;
            scroll-snap-stop: always;
            position: relative;
        }

        .artist-image {
            flex: 0 0 auto;
            width: 100%;
            max-width: 500px;
            padding: 0 20px;
            margin-bottom: 40px;
            transition: transform 0.3s ease;
        }

        .artist-image:hover {
            transform: scale(1.02);
        }

        .artist-image img {
            width: 100%;
            height: auto;
            max-height: 600px;
            object-fit: cover;
            border-radius: 15px;
            border: 3px solid var(--accent-color);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .artist-content {
            flex: 1;
            max-width: 800px;
            padding: 0 30px;
            cursor: pointer;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .artist-content:hover {
            transform: translateY(-5px);
        }

        .artist-content h3 {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            color: var(--primary-color);
            margin-bottom: 25px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .artist-content p {
            font-size: 1.3rem;
            color: #444;
            background: var(--bg-light);
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 20px;
            line-height: 1.8;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .artist-content .details {
            display: none;
        }

        /* Navigation Arrows */
        .nav-arrows {
            position: fixed;
            right: 40px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 25px;
            z-index: 100;
        }

        .nav-arrow {
            background: var(--primary-color);
            color: var(--text-light);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-size: 1.5rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .nav-arrow:hover {
            background: var(--accent-color);
            transform: scale(1.1);
        }

        .nav-arrow:active {
            transform: scale(0.95);
        }

        /* Progress Indicator */
        .progress-indicator {
            position: fixed;
            left: 40px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 10px;
            z-index: 100;
        }

        .progress-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--primary-color);
            opacity: 0.3;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .progress-dot.active {
            opacity: 1;
            transform: scale(1.2);
            background: var(--accent-color);
        }

        .progress-dot:hover {
            transform: scale(1.2);
            background: var(--accent-color);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--modal-bg);
            z-index: 2000;
            overflow-y: auto;
        }

        .modal-content {
            background: var(--bg-light);
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            position: relative;
            animation: fadeIn 0.5s ease;
        }

        .modal-content img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .modal-content h3 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .modal-content p {
            font-size: 1.1rem;
            color: #333;
            line-height: 1.8;
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 1.5rem;
            color: var(--text-dark);
            cursor: pointer;
            background: none;
            border: none;
        }

        /* Footer */
        footer {
            background: var(--primary-color);
            color: var(--text-light);
            text-align: center;
            padding: 30px 0;
            font-size: 1rem;
        }

        /* Language Selector */
        select[name="lang"] {
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid var(--accent-color);
            background: var(--bg-light);
            color: var(--text-dark);
            cursor: pointer;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar .container {
                flex-direction: column;
                gap: 15px;
            }

            .navbar-links {
                flex-wrap: wrap;
                justify-content: center;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .artist-item {
                min-height: 100vh;
                padding: 60px 15px;
            }

            .artist-image {
                max-width: 100%;
            }

            .artist-content {
                padding: 0 15px;
            }

            .artist-content h3 {
                font-size: 2.2rem;
            }

            .artist-content p {
                font-size: 1.1rem;
                padding: 20px;
            }

            .nav-arrows {
                right: 20px;
            }

            .nav-arrow {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
            }

            .progress-indicator {
                left: 20px;
            }

            .progress-dot {
                width: 10px;
                height: 10px;
            }

            .modal-content {
                margin: 20px;
                padding: 20px;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="navbar-logo">
                <a href="art.php">
                    <img src="images/artlogo.png" alt="HAF Logo">
                </a>
                <span>History Art Fashion</span>
            </div>
            <div class="navbar-links">
                <a href="world_history.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_history')); ?></a>
                <a href="art.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_art')); ?></a>
                <a href="world_paintings.php">World Paintings</a>
                <a href="famous_artists.php" class="active"><?php echo htmlspecialchars(get_translation($current_lang, 'timeline_title')); ?></a>
                <a href="art_game.php">Art Game</a>
                <a href="fashion.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_fashion')); ?></a>
                <a href="php/shop.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_shop')); ?></a>
            </div>
            <form method="POST">
                <select name="lang" aria-label="Select Language">
                    <?php foreach (array_keys($translations) as $lang_code): ?>
                        <option value="<?php echo $lang_code; ?>" <?php echo $current_lang === $lang_code ? 'selected' : ''; ?>>
                            <?php echo $lang_names[$lang_code] ?? strtoupper($lang_code); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <h1><?php echo htmlspecialchars(get_translation($current_lang, 'hero_title')); ?></h1>
            <p><?php echo htmlspecialchars(get_translation($current_lang, 'hero_subtitle')); ?></p>
        </div>
    </section>

    <section class="artists-section">
        <div class="container">
            <h2><?php echo htmlspecialchars(get_translation($current_lang, 'timeline_title')); ?></h2>
            <p class="subtitle"><?php echo htmlspecialchars(get_translation($current_lang, 'timeline_subtitle')); ?></p>
            <?php for ($i = 1; $i <= 20; $i++): ?>
                <?php $artist = isset($translations[$current_lang]['artists'][$i]) ? $translations[$current_lang]['artists'][$i] : $translations['en']['artists'][$i]; ?>
                <div class="artist-item" data-artist-id="<?php echo $i; ?>">
                    <div class="artist-image">
                        <img loading="lazy" src="images/famous_artists/<?php echo $i; ?>.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" alt="<?php echo htmlspecialchars($artist['title']); ?>">
                    </div>
                    <div class="artist-content">
                        <h3><?php echo htmlspecialchars($artist['title']); ?></h3>
                        <p><?php echo htmlspecialchars($artist['text']); ?></p>
                        <p class="details"><?php echo htmlspecialchars($artist['details']); ?></p>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
        <div class="nav-arrows">
            <button class="nav-arrow" id="prevArtist" aria-label="Previous Artist">↑</button>
            <button class="nav-arrow" id="nextArtist" aria-label="Next Artist">↓</button>
        </div>
        <div class="progress-indicator">
            <?php for ($i = 1; $i <= 20; $i++): ?>
                <div class="progress-dot" data-index="<?php echo $i - 1; ?>" aria-label="Go to artist <?php echo $i; ?>"></div>
            <?php endfor; ?>
        </div>
    </section>

    <div class="modal" id="artistModal">
        <div class="modal-content">
            <button class="modal-close" aria-label="Close Modal"><?php echo htmlspecialchars(get_translation($current_lang, 'modal_close')); ?></button>
            <img id="modalImage" src="" alt="">
            <h3 id="modalTitle"></h3>
            <p id="modalDetails"></p>
        </div>
    </div>

    <footer>
        <div class="container">
            <p><?php echo htmlspecialchars(get_translation($current_lang, 'footer_copyright')); ?></p>
        </div>
    </footer>

    <script>
        document.querySelector('select[name="lang"]').addEventListener('change', function() {
            this.form.submit();
        });

        const modal = document.getElementById('artistModal');
        const modalImage = document.getElementById('modalImage');
        const modalTitle = document.getElementById('modalTitle');
        const modalDetails = document.getElementById('modalDetails');
        const modalClose = document.querySelector('.modal-close');
        const artistItems = document.querySelectorAll('.artist-content');
        const prevButton = document.getElementById('prevArtist');
        const nextButton = document.getElementById('nextArtist');
        const artistsSection = document.querySelector('.artists-section');
        const progressDots = document.querySelectorAll('.progress-dot');
        let currentIndex = 0;
        let isScrolling = false;
        let scrollTimeout = null;
        let lastScrollY = window.scrollY;
        let userScroll = false;

        // Update progress dots
        function updateProgressDots(index) {
            progressDots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
        }

        // 获取元素相对于文档的offsetTop
        function getAbsoluteOffsetTop(element) {
            let offset = 0;
            while (element) {
                offset += element.offsetTop;
                element = element.offsetParent;
            }
            return offset;
        }

        // Smooth scroll to artist
        function scrollToArtist(index) {
            if (isScrolling) return;
            isScrolling = true;
            
            const artists = document.querySelectorAll('.artist-item');
            if (artists[index]) {
                const targetArtist = artists[index];
                const navbar = document.querySelector('.navbar');
                const navbarHeight = navbar ? navbar.offsetHeight : 0;
                const viewportHeight = window.innerHeight;
                const availableHeight = viewportHeight - navbarHeight;
                // 获取图片img元素和标题h3
                const imageDiv = targetArtist.querySelector('.artist-image');
                const img = imageDiv ? imageDiv.querySelector('img') : null;
                const title = targetArtist.querySelector('.artist-content h3');
                let imgOffsetTop = img ? getAbsoluteOffsetTop(img) : 0;
                let imgHeight = img ? img.offsetHeight : 0;
                let titleHeight = title ? title.offsetHeight : 0;
                let totalHeight = imgHeight + titleHeight + 20; // 20为图片和标题间距
                let targetPosition;
                if (totalHeight <= availableHeight) {
                    // 图片+标题整体居中
                    targetPosition = imgOffsetTop + (totalHeight / 2) - (navbarHeight + availableHeight / 2);
                } else {
                    // 图片顶部紧贴导航栏，但保证标题底部不会被遮挡
                    // 如果图片底部+标题高度超出可用区域，则向上偏移
                    let minTop = imgOffsetTop - navbarHeight;
                    let maxScroll = (imgOffsetTop + imgHeight + titleHeight + 20) - (navbarHeight + availableHeight);
                    targetPosition = Math.min(minTop, maxScroll);
                }
                const currentPosition = window.pageYOffset;
                const distance = targetPosition - currentPosition;
                const duration = 800; // Duration in milliseconds
                let start = null;
                
                function animation(currentTime) {
                    if (start === null) start = currentTime;
                    const timeElapsed = currentTime - start;
                    const progress = Math.min(timeElapsed / duration, 1);
                    
                    // Easing function for smoother animation
                    const easeInOutCubic = progress => {
                        return progress < 0.5
                            ? 4 * progress * progress * progress
                            : 1 - Math.pow(-2 * progress + 2, 3) / 2;
                    };
                    
                    window.scrollTo(0, currentPosition + distance * easeInOutCubic(progress));
                    
                    if (timeElapsed < duration) {
                        requestAnimationFrame(animation);
                    } else {
                        // Ensure we land exactly on the target position
                        window.scrollTo(0, targetPosition);
                        isScrolling = false;
                        currentIndex = index;
                        updateProgressDots(index);
                    }
                }
                
                requestAnimationFrame(animation);
            }
        }

        // Navigation buttons
        prevButton.addEventListener('click', () => {
            if (currentIndex > 0) {
                scrollToArtist(currentIndex - 1);
            }
        });

        nextButton.addEventListener('click', () => {
            const artists = document.querySelectorAll('.artist-item');
            if (currentIndex < artists.length - 1) {
                scrollToArtist(currentIndex + 1);
            }
        });

        // Progress dots navigation
        progressDots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                scrollToArtist(index);
            });
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (isScrolling) return;
            
            if (e.key === 'ArrowUp' || e.key === 'ArrowLeft') {
                if (currentIndex > 0) {
                    scrollToArtist(currentIndex - 1);
                }
            } else if (e.key === 'ArrowDown' || e.key === 'ArrowRight') {
                const artists = document.querySelectorAll('.artist-item');
                if (currentIndex < artists.length - 1) {
                    scrollToArtist(currentIndex + 1);
                }
            } else if (e.key >= '1' && e.key <= '9') {
                const num = parseInt(e.key) - 1;
                if (num >= 0 && num < 9) {
                    scrollToArtist(num);
                }
            } else if (e.key === '0') {
                scrollToArtist(9);
            }
        });

        // Scroll detection with Intersection Observer
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.5
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const artistItem = entry.target;
                    const index = Array.from(document.querySelectorAll('.artist-item')).indexOf(artistItem);
                    if (index !== -1 && !isScrolling) {
                        currentIndex = index;
                        updateProgressDots(index);
                    }
                }
            });
        }, observerOptions);

        document.querySelectorAll('.artist-item').forEach(item => {
            observer.observe(item);
        });

        // Touch swipe support
        let touchStartY = 0;
        let touchEndY = 0;

        artistsSection.addEventListener('touchstart', (e) => {
            touchStartY = e.touches[0].clientY;
        });

        artistsSection.addEventListener('touchend', (e) => {
            touchEndY = e.changedTouches[0].clientY;
            const diff = touchStartY - touchEndY;
            
            if (Math.abs(diff) > 50) { // Minimum swipe distance
                if (diff > 0 && currentIndex < artists.length - 1) {
                    // Swipe up
                    scrollToArtist(currentIndex + 1);
                } else if (diff < 0 && currentIndex > 0) {
                    // Swipe down
                    scrollToArtist(currentIndex - 1);
                }
            }
        });

        // Initialize first dot as active
        updateProgressDots(0);

        artistItems.forEach(item => {
            item.addEventListener('click', () => {
                const artistItem = item.closest('.artist-item');
                const artistId = artistItem.getAttribute('data-artist-id');
                const artistData = <?php echo json_encode($translations[$current_lang]['artists'] ?? $translations['en']['artists']); ?>;
                const artist = artistData[artistId];

                modalImage.src = `<?php echo $image_base_path; ?>artist${artistId}.jpg`;
                modalImage.alt = artist.title;
                modalTitle.textContent = artist.title;
                modalDetails.textContent = artist.details;
                modal.style.display = 'block';
            });
        });

        modalClose.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal.style.display === 'block') {
                modal.style.display = 'none';
            }
        });

        // Helper: Snap to nearest artist after scroll
        function snapToNearestArtist() {
            const artists = document.querySelectorAll('.artist-item');
            const navbar = document.querySelector('.navbar');
            const navbarHeight = navbar ? navbar.offsetHeight : 0;
            const viewportHeight = window.innerHeight;
            const availableHeight = viewportHeight - navbarHeight;
            const scrollY = window.scrollY;
            let minDiff = Infinity;
            let nearestIndex = 0;
            artists.forEach((item, idx) => {
                // 获取图片img元素和标题h3
                const imageDiv = item.querySelector('.artist-image');
                const img = imageDiv ? imageDiv.querySelector('img') : null;
                const title = item.querySelector('.artist-content h3');
                let imgOffsetTop = img ? getAbsoluteOffsetTop(img) : 0;
                let imgHeight = img ? img.offsetHeight : 0;
                let titleHeight = title ? title.offsetHeight : 0;
                let totalHeight = imgHeight + titleHeight + 20;
                let itemTarget;
                if (totalHeight <= availableHeight) {
                    itemTarget = imgOffsetTop + (totalHeight / 2) - (navbarHeight + availableHeight / 2);
                } else {
                    let minTop = imgOffsetTop - navbarHeight;
                    let maxScroll = (imgOffsetTop + imgHeight + titleHeight + 20) - (navbarHeight + availableHeight);
                    itemTarget = Math.min(minTop, maxScroll);
                }
                const diff = Math.abs(scrollY - itemTarget);
                if (diff < minDiff) {
                    minDiff = diff;
                    nearestIndex = idx;
                }
            });
            if (nearestIndex !== currentIndex) {
                currentIndex = nearestIndex;
                updateProgressDots(currentIndex);
            }
            scrollToArtist(nearestIndex);
        }

        // Listen for scroll events and snap after user stops scrolling
        window.addEventListener('scroll', () => {
            if (isScrolling) return;
            userScroll = true;
            if (scrollTimeout) clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
                if (userScroll) {
                    snapToNearestArtist();
                    userScroll = false;
                }
            }, 120); // Snap after 120ms of no scroll
        });

        // Prevent native scroll-snap
        document.querySelector('.artists-section').style.scrollSnapType = 'none';
        document.querySelectorAll('.artist-item').forEach(item => {
            item.style.scrollSnapAlign = 'none';
            item.style.scrollSnapStop = 'none';
        });
    </script>
</body>
</html>