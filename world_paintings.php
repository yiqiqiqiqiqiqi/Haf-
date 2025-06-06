<?php
session_start();

// Default language is Chinese
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'zh';
}

// Handle language switching
if (isset($_POST['lang'])) {
    $valid_langs = ['en', 'zh', 'es', 'ar', 'fr', 'ru', 'pt', 'de', 'ja', 'hi', 'ms'];
    $_SESSION['lang'] = in_array($_POST['lang'], $valid_langs) ? $_POST['lang'] : 'zh';
}

$current_lang = $_SESSION['lang'];
$site_dir = 'ltr'; // Both languages (en, zh) are LTR

// Translations array
$translations = [
    'en' => [
        'meta_description' => 'Discover iconic world paintings with HAF, showcasing timeless masterpieces',
        'hero_title' => 'World Paintings Gallery',
        'hero_subtitle' => 'Explore the beauty of renowned artworks with HAF',
        'nav_history' => 'History',
        'nav_art' => 'Art',
        'nav_world_paintings' => 'World Paintings',
        'nav_famous_artists' => 'Famous Artists',
        'nav_art_game' => 'Art Game',
        'nav_fashion' => 'Fashion',
        'nav_shop' => 'Shop',
        'gallery_title' => 'Iconic Paintings',
        'gallery_subtitle' => 'A curated collection of world-famous paintings',
        'modal_close' => 'Close',
        'modal_artist' => 'Artist',
        'modal_year' => 'Year',
        'modal_medium' => 'Medium',
        'modal_location' => 'Location',
        'view_single' => 'View Single Painting',
        'view_grid' => 'View Gallery Grid',
        'prev_painting' => 'Previous',
        'next_painting' => 'Next',
        'painting_1_text' => 'Mona Lisa - Leonardo da Vinci',
        'painting_1_desc' => 'Italian Renaissance masterpiece, renowned for its mysterious smile and gaze-tracking effect, one of the most famous portraits.',
        'painting_1_artist' => 'Leonardo da Vinci',
        'painting_1_year' => '1503–1506',
        'painting_1_medium' => 'Oil on poplar panel',
        'painting_1_location' => 'Louvre Museum, Paris',
        'painting_2_text' => 'The Last Supper - Leonardo da Vinci',
        'painting_2_desc' => 'Depicts Jesus and the twelve apostles at their final meal, with intricate composition and intense emotional tension.',
        'painting_2_artist' => 'Leonardo da Vinci',
        'painting_2_year' => '1495–1498',
        'painting_2_medium' => 'Tempera on gesso',
        'painting_2_location' => 'Santa Maria delle Grazie, Milan',
        'painting_3_text' => 'Starry Night - Vincent van Gogh',
        'painting_3_desc' => 'Captures swirling night skies with dynamic energy and emotion, a hallmark of Post-Impressionism.',
        'painting_3_artist' => 'Vincent van Gogh',
        'painting_3_year' => '1889',
        'painting_3_medium' => 'Oil on canvas',
        'painting_3_location' => 'Museum of Modern Art, New York',
        'painting_4_text' => 'Sunflowers - Vincent van Gogh',
        'painting_4_desc' => 'A series showcasing vibrant, passionate life force and personal emotion through vivid yellow blooms.',
        'painting_4_artist' => 'Vincent van Gogh',
        'painting_4_year' => '1888',
        'painting_4_medium' => 'Oil on canvas',
        'painting_4_location' => 'National Gallery, London',
        'painting_5_text' => 'The Scream - Edvard Munch',
        'painting_5_desc' => 'Symbolist masterpiece, depicting existential anxiety through a distorted figure and terrified expression.',
        'painting_5_artist' => 'Edvard Munch',
        'painting_5_year' => '1893',
        'painting_5_medium' => 'Tempera and pastel on cardboard',
        'painting_5_location' => 'National Gallery, Oslo',
        'painting_6_text' => 'Liberty Leading the People - Eugène Delacroix',
        'painting_6_desc' => 'Commemorates the 1830 French July Revolution, with Liberty holding the flag, exuding powerful impact.',
        'painting_6_artist' => 'Eugène Delacroix',
        'painting_6_year' => '1830',
        'painting_6_medium' => 'Oil on canvas',
        'painting_6_location' => 'Louvre Museum, Paris',
        'painting_7_text' => 'Napoleon Crossing the Alps - Jacques-Louis David',
        'painting_7_desc' => 'Neoclassical work emphasizing Napoleon\'s heroic and commanding presence.',
        'painting_7_artist' => 'Jacques-Louis David',
        'painting_7_year' => '1801',
        'painting_7_medium' => 'Oil on canvas',
        'painting_7_location' => 'Château de Malmaison, France',
        'painting_8_text' => 'A Sunday Afternoon on the Island of La Grande Jatte - Georges Seurat',
        'painting_8_desc' => 'Pointillist classic, using tiny dots to portray modern urban leisure.',
        'painting_8_artist' => 'Georges Seurat',
        'painting_8_year' => '1884–1886',
        'painting_8_medium' => 'Oil on canvas',
        'painting_8_location' => 'Art Institute of Chicago',
        'painting_9_text' => 'The Creation of Adam - Michelangelo',
        'painting_9_desc' => 'Sistine Chapel ceiling fresco, showing God and Adam\'s fingers nearly touching, symbolizing the spark of life.',
        'painting_9_artist' => 'Michelangelo',
        'painting_9_year' => '1512',
        'painting_9_medium' => 'Fresco',
        'painting_9_location' => 'Sistine Chapel, Vatican City',
        'painting_10_text' => 'The Birth of Venus - Sandro Botticelli',
        'painting_10_desc' => 'Early Renaissance work depicting the mythological birth of Venus emerging from the sea.',
        'painting_10_artist' => 'Sandro Botticelli',
        'painting_10_year' => '1484–1486',
        'painting_10_medium' => 'Tempera on canvas',
        'painting_10_location' => 'Uffizi Gallery, Florence',
        'painting_11_text' => 'Guernica - Pablo Picasso',
        'painting_11_desc' => 'Anti-war protest against the bombing of Guernica, using stark monochrome and chaotic forms.',
        'painting_11_artist' => 'Pablo Picasso',
        'painting_11_year' => '1937',
        'painting_11_medium' => 'Oil on canvas',
        'painting_11_location' => 'Museo Reina Sofía, Madrid',
        'painting_12_text' => 'The Angelus - Jean-François Millet',
        'painting_12_desc' => 'Portrays peasant farmers praying in the fields, imbued with religious and dignified labor themes.',
        'painting_12_artist' => 'Jean-François Millet',
        'painting_12_year' => '1857–1859',
        'painting_12_medium' => 'Oil on canvas',
        'painting_12_location' => 'Paris, Musée d\'Orsay',
        'painting_13_text' => 'The Gleaners - Jean-François Millet',
        'painting_13_desc' => 'Shows poor women gathering leftover grain, symbolizing labor and social class.',
        'painting_13_artist' => 'Jean-François Millet',
        'painting_13_year' => '1857',
        'painting_13_medium' => 'Oil on canvas',
        'painting_13_location' => 'Paris, Musée d\'Orsay',
        'painting_14_text' => 'The Fifer - Édouard Manet',
        'painting_14_desc' => 'Impressionist work with flat backgrounds and bold colors, depicting a young military musician.',
        'painting_14_artist' => 'Édouard Manet',
        'painting_14_year' => '1866',
        'painting_14_medium' => 'Oil on canvas',
        'painting_14_location' => 'Paris, Musée d\'Orsay',
        'painting_15_text' => 'The Dance Class - Edgar Degas',
        'painting_15_desc' => 'Captures ballet rehearsal moments, highlighting movement and urban female life.',
        'painting_15_artist' => 'Edgar Degas',
        'painting_15_year' => '1874',
        'painting_15_medium' => 'Oil on canvas',
        'painting_15_location' => 'New York, Metropolitan Museum of Art',
        'painting_16_text' => 'The Night Watch - Rembrandt',
        'painting_16_desc' => 'Dutch Golden Age masterpiece, using dramatic light to depict a civic guard patrol.',
        'painting_16_artist' => 'Rembrandt van Rijn',
        'painting_16_year' => '1642',
        'painting_16_medium' => 'Oil on canvas',
        'painting_16_location' => 'Amsterdam, Rijksmuseum',
        'painting_17_text' => 'Girl with a Pearl Earring - Johannes Vermeer',
        'painting_17_desc' => 'Known as the "Mona Lisa of the North," celebrated for its light and enigmatic expression.',
        'painting_17_artist' => 'Johannes Vermeer',
        'painting_17_year' => '1665',
        'painting_17_medium' => 'Oil on canvas',
        'painting_17_location' => 'The Hague, Mauritshuis',
        'painting_18_text' => 'American Gothic - Grant Wood',
        'painting_18_desc' => 'Satirical yet realistic portrayal of rural American life, a cultural icon.',
        'painting_18_artist' => 'Grant Wood',
        'painting_18_year' => '1930',
        'painting_18_medium' => 'Oil on beaverboard',
        'painting_18_location' => 'Chicago, Art Institute of Chicago',
        'painting_19_text' => 'Café Terrace at Night - Vincent van Gogh',
        'painting_19_desc' => 'Vividly colored depiction of a nighttime café in Arles, France, with emotional resonance.',
        'painting_19_artist' => 'Vincent van Gogh',
        'painting_19_year' => '1888',
        'painting_19_medium' => 'Oil on canvas',
        'painting_19_location' => 'Otterlo, Kröller-Müller Museum',
        'painting_20_text' => 'The Red Room - Henri Matisse',
        'painting_20_desc' => 'Fauvist work with decorative composition and rhythmic color patterns.',
        'painting_20_artist' => 'Henri Matisse',
        'painting_20_year' => '1908',
        'painting_20_medium' => 'Oil on canvas',
        'painting_20_location' => 'St. Petersburg, Hermitage Museum',
        'footer_copyright' => '© 2025 History, Art & Fashion. All rights reserved.'
    ],
    'zh' => [
        'meta_description' => '通过 HAF 发现标志性的世界名画，展示永恒的杰作',
        'hero_title' => '世界名画画廊',
        'hero_subtitle' => '与 HAF 一起探索著名艺术品的美丽',
        'nav_history' => '历史',
        'nav_art' => '艺术',
        'nav_world_paintings' => '世界名画',
        'nav_famous_artists' => '著名艺术家',
        'nav_art_game' => '艺术游戏',
        'nav_fashion' => '时尚',
        'nav_shop' => '商店',
        'gallery_title' => '标志性画作',
        'gallery_subtitle' => '精选的世界著名画作集合',
        'modal_close' => '关闭',
        'modal_artist' => '艺术家',
        'modal_year' => '年代',
        'modal_medium' => '媒介',
        'modal_location' => '地点',
        'view_single' => '查看单幅画作',
        'view_grid' => '查看画廊网格',
        'prev_painting' => '上一张',
        'next_painting' => '下一张',
        'painting_1_text' => '蒙娜丽莎 - 达·芬奇',
        'painting_1_desc' => '意大利文艺复兴时期的杰作，以神秘的微笑和眼神追踪感著称，是最著名的肖像画之一。',
        'painting_1_artist' => '列奥纳多·达·芬奇',
        'painting_1_year' => '1503–1506',
        'painting_1_medium' => '油画于杨木板',
        'painting_1_location' => '巴黎卢浮宫',
        'painting_2_text' => '最后的晚餐 - 达·芬奇',
        'painting_2_desc' => '描绘耶稣与十二门徒共进最后晚餐，构图精巧，情感张力强烈。',
        'painting_2_artist' => '列奥纳多·达·芬奇',
        'painting_2_year' => '1495–1498',
        'painting_2_medium' => '石膏底料上的蛋彩画',
        'painting_2_location' => '米兰圣玛丽亚感恩教堂',
        'painting_3_text' => '星夜 - 梵高',
        'painting_3_desc' => '表现夜空旋涡状星云的动感和情绪，是后印象派的代表作之一。',
        'painting_3_artist' => '文森特·梵高',
        'painting_3_year' => '1889',
        'painting_3_medium' => '布面油画',
        'painting_3_location' => '纽约现代艺术博物馆',
        'painting_4_text' => '向日葵 - 梵高',
        'painting_4_desc' => '多次创作此主题，展现鲜艳、热烈的生命力与个人情感。',
        'painting_4_artist' => '文森特·梵高',
        'painting_4_year' => '1888',
        'painting_4_medium' => '布面油画',
        'painting_4_location' => '伦敦国家美术馆',
        'painting_5_text' => '呐喊 - 爱德华·蒙克',
        'painting_5_desc' => '象征主义代表作，以扭曲的人物和惊恐面容表现存在主义的焦虑。',
        'painting_5_artist' => '爱德华·蒙克',
        'painting_5_year' => '1893',
        'painting_5_medium' => '纸板上的蛋彩和粉彩',
        'painting_5_location' => '奥斯陆国家美术馆',
        'painting_6_text' => '自由引导人民 - 德拉克洛瓦',
        'painting_6_desc' => '描绘1830年法国七月革命，女性象征"自由"手持国旗，极具震撼力。',
        'painting_6_artist' => '欧仁·德拉克洛瓦',
        'painting_6_year' => '1830',
        'painting_6_medium' => '布面油画',
        'painting_6_location' => '巴黎卢浮宫',
        'painting_7_text' => '拿破仑越阿尔卑斯山 - 大卫',
        'painting_7_desc' => '新古典主义风格，突出拿破仑的英雄气概和领袖形象。',
        'painting_7_artist' => '雅克-路易·大卫',
        'painting_7_year' => '1801',
        'painting_7_medium' => '布面油画',
        'painting_7_location' => '法国马尔梅松城堡',
        'painting_8_text' => '大碗岛的星期天下午 - 修拉',
        'painting_8_desc' => '点彩派经典之作，以细小色点描绘现代都市生活。',
        'painting_8_artist' => '乔治·修拉',
        'painting_8_year' => '1884–1886',
        'painting_8_medium' => '布面油画',
        'painting_8_location' => '芝加哥艺术学院',
        'painting_9_text' => '创造亚当 - 米开朗基罗',
        'painting_9_desc' => '西斯廷礼拜堂天顶画，描绘上帝与亚当\'s fingers nearly touching, symbolizing the spark of life.',
        'painting_9_artist' => '米开朗基罗',
        'painting_9_year' => '1512',
        'painting_9_medium' => '壁画',
        'painting_9_location' => '梵蒂冈西斯廷礼拜堂',
        'painting_10_text' => '维纳斯的诞生 - 波提切利',
        'painting_10_desc' => '早期文艺复兴作品，表现女神维纳斯诞生于海浪的浪漫神话场景。',
        'painting_10_artist' => '桑德罗·波提切利',
        'painting_10_year' => '1484–1486',
        'painting_10_medium' => 'Tempera on canvas',
        'painting_10_location' => 'Uffizi Gallery, Florence',
        'painting_11_text' => '格尔尼卡 - 毕加索',
        'painting_11_desc' => '为抗议西班牙内战中格尔尼卡镇被轰炸而作，黑白色调，富有反战意义。',
        'painting_11_artist' => '巴勃罗·毕加索',
        'painting_11_year' => '1937',
        'painting_11_medium' => '布面油画',
        'painting_11_location' => '马德里索菲亚王后博物馆',
        'painting_12_text' => '晚钟 - 米勒',
        'painting_12_desc' => '展现农民夫妇在田间祈祷，具有宗教意象与劳动者的尊严。',
        'painting_12_artist' => '让-弗朗索瓦·米勒',
        'painting_12_year' => '1857–1859',
        'painting_12_medium' => '布面油画',
        'painting_12_location' => '巴黎奥赛博物馆',
        'painting_13_text' => '拾穗者 - 米勒',
        'painting_13_desc' => '描绘贫困农妇在田间拾麦穗，象征勤劳与社会阶层。',
        'painting_13_artist' => '让-弗朗索瓦·米勒',
        'painting_13_year' => '1857',
        'painting_13_medium' => '布面油画',
        'painting_13_location' => '巴黎奥赛博物馆',
        'painting_14_text' => '吹笛少年 - 马奈',
        'painting_14_desc' => '用扁平化背景和鲜明色彩刻画军乐手少年，是印象派的重要作品。',
        'painting_14_artist' => '爱德华·马奈',
        'painting_14_year' => '1866',
        'painting_14_medium' => '布面油画',
        'painting_14_location' => '巴黎奥赛博物馆',
        'painting_15_text' => '舞蹈课 - 德加',
        'painting_15_desc' => '表现芭蕾舞练习场景，捕捉动态与细节，展示现代都市女性生活。',
        'painting_15_artist' => '埃德加·德加',
        'painting_15_year' => '1874',
        'painting_15_medium' => '布面油画',
        'painting_15_location' => '纽约大都会艺术博物馆',
        'painting_16_text' => '夜巡 - 伦勃朗',
        'painting_16_desc' => '荷兰黄金时代杰作，采用戏剧性光影描绘市民卫队巡逻。',
        'painting_16_artist' => '伦勃朗·范·莱因',
        'painting_16_year' => '1642',
        'painting_16_medium' => '布面油画',
        'painting_16_location' => '阿姆斯特丹国家博物馆',
        'painting_17_text' => '珍珠耳环的少女 - 维米尔',
        'painting_17_desc' => '被称为"北方的蒙娜丽莎"，以光影与神秘表情著称。',
        'painting_17_artist' => '约翰内斯·维米尔',
        'painting_17_year' => '1665',
        'painting_17_medium' => '布面油画',
        'painting_17_location' => '海牙莫瑞泰斯皇家美术馆',
        'painting_18_text' => '美国哥特式 - 格兰特·伍德',
        'painting_18_desc' => '讽刺又真实地描绘美国乡村夫妻，成为美国文化象征。',
        'painting_18_artist' => '格兰特·伍德',
        'painting_18_year' => '1930',
        'painting_18_medium' => '油画于纤维板',
        'painting_18_location' => '芝加哥艺术学院',
        'painting_19_text' => '夜晚的咖啡馆 - 梵高',
        'painting_19_desc' => '色彩浓烈，表现法国阿尔勒夜晚的咖啡馆氛围，具有强烈情感色彩。',
        'painting_19_artist' => '文森特·梵高',
        'painting_19_year' => '1888',
        'painting_19_medium' => '布面油画',
        'painting_19_location' => '奥特洛克勒勒-穆勒博物馆',
        'painting_20_text' => '红色房间 - 马蒂斯',
        'painting_20_desc' => '野兽派风格，构图与色彩极富装饰性和节奏感。',
        'painting_20_artist' => '亨利·马蒂斯',
        'painting_20_year' => '1908',
        'painting_20_medium' => '布面油画',
        'painting_20_location' => '圣彼得堡艾尔米塔什博物馆',
        'footer_copyright' => '© 2025 历史、艺术与时尚. 保留所有权利。'
    ],
    'es' => [
        'meta_description' => 'Descubre pinturas icónicas del mundo con HAF, mostrando obras maestras atemporales',
        'hero_title' => 'Galería de Pinturas del Mundo',
        'hero_subtitle' => 'Explora la belleza de obras de arte renombradas con HAF',
        'nav_history' => 'Historia',
        'nav_art' => 'Arte',
        'nav_world_paintings' => 'Pinturas del Mundo',
        'nav_famous_artists' => 'Artistas Famosos',
        'nav_art_game' => 'Juego de Arte',
        'nav_fashion' => 'Moda',
        'nav_shop' => 'Tienda',
        'gallery_title' => 'Pinturas Icónicas',
        'gallery_subtitle' => 'Una colección seleccionada de pinturas mundialmente famosas',
        'modal_close' => 'Cerrar',
        'modal_artist' => 'Artista',
        'modal_year' => 'Año',
        'modal_medium' => 'Técnica',
        'modal_location' => 'Ubicación',
        'view_single' => 'Ver Pintura Individual',
        'view_grid' => 'Ver Galería',
        'prev_painting' => 'Anterior',
        'next_painting' => 'Siguiente',
        'painting_1_text' => 'La Mona Lisa - Leonardo da Vinci',
        'painting_1_desc' => 'Obra maestra del Renacimiento italiano, famosa por su enigmática sonrisa y efecto de seguimiento de la mirada, uno de los retratos más famosos.',
        'painting_1_artist' => 'Leonardo da Vinci',
        'painting_1_year' => '1503–1506',
        'painting_1_medium' => 'Óleo sobre panel de álamo',
        'painting_1_location' => 'Museo del Louvre, París',
        'painting_2_text' => 'La Última Cena - Leonardo da Vinci',
        'painting_2_desc' => 'Representa a Jesús y los doce apóstoles en su última comida, con una composición intrincada y tensión emocional intensa.',
        'painting_2_artist' => 'Leonardo da Vinci',
        'painting_2_year' => '1495–1498',
        'painting_2_medium' => 'Temple sobre yeso',
        'painting_2_location' => 'Santa Maria delle Grazie, Milán',
        'painting_3_text' => 'La Noche Estrellada - Vincent van Gogh',
        'painting_3_desc' => 'Captura cielos nocturnos arremolinados con energía dinámica y emoción, característica del Postimpresionismo.',
        'painting_3_artist' => 'Vincent van Gogh',
        'painting_3_year' => '1889',
        'painting_3_medium' => 'Óleo sobre lienzo',
        'painting_3_location' => 'Museo de Arte Moderno, Nueva York',
        'painting_4_text' => 'Los Girasoles - Vincent van Gogh',
        'painting_4_desc' => 'Una serie que muestra la vibrante fuerza vital y emoción personal a través de flores amarillas vívidas.',
        'painting_4_artist' => 'Vincent van Gogh',
        'painting_4_year' => '1888',
        'painting_4_medium' => 'Óleo sobre lienzo',
        'painting_4_location' => 'Galería Nacional, Londres',
        'painting_5_text' => 'El Grito - Edvard Munch',
        'painting_5_desc' => 'Obra maestra simbolista, que representa la ansiedad existencial a través de una figura distorsionada y expresión aterrada.',
        'painting_5_artist' => 'Edvard Munch',
        'painting_5_year' => '1893',
        'painting_5_medium' => 'Temple y pastel sobre cartón',
        'painting_5_location' => 'Galería Nacional, Oslo',
        'painting_6_text' => 'La Libertad Guiando al Pueblo - Eugène Delacroix',
        'painting_6_desc' => 'Conmemora la Revolución de Julio de 1830 en Francia, con la Libertad sosteniendo la bandera, desprendiendo un poderoso impacto.',
        'painting_6_artist' => 'Eugène Delacroix',
        'painting_6_year' => '1830',
        'painting_6_medium' => 'Óleo sobre lienzo',
        'painting_6_location' => 'Museo del Louvre, París',
        'painting_7_text' => 'Napoleón Cruzando los Alpes - Jacques-Louis David',
        'painting_7_desc' => 'Obra neoclásica que enfatiza la presencia heroica y dominante de Napoleón.',
        'painting_7_artist' => 'Jacques-Louis David',
        'painting_7_year' => '1801',
        'painting_7_medium' => 'Óleo sobre lienzo',
        'painting_7_location' => 'Palacio de Malmaison, Francia',
        'painting_8_text' => 'Tarde de Domingo en la Isla de la Grande Jatte - Georges Seurat',
        'painting_8_desc' => 'Clásico puntillista, utilizando pequeños puntos para retratar el ocio urbano moderno.',
        'painting_8_artist' => 'Georges Seurat',
        'painting_8_year' => '1884–1886',
        'painting_8_medium' => 'Óleo sobre lienzo',
        'painting_8_location' => 'Instituto de Arte de Chicago',
        'painting_9_text' => 'La Creación de Adán - Miguel Ángel',
        'painting_9_desc' => 'Fresco del techo de la Capilla Sixtina, mostrando los dedos de Dios y Adán casi tocándose, simbolizando la chispa de la vida.',
        'painting_9_artist' => 'Miguel Ángel',
        'painting_9_year' => '1512',
        'painting_9_medium' => 'Fresco',
        'painting_9_location' => 'Capilla Sixtina, Ciudad del Vaticano',
        'painting_10_text' => 'El Nacimiento de Venus - Sandro Botticelli',
        'painting_10_desc' => 'Obra del Renacimiento temprano que representa el nacimiento mitológico de Venus emergiendo del mar.',
        'painting_10_artist' => 'Sandro Botticelli',
        'painting_10_year' => '1484–1486',
        'painting_10_medium' => 'Temple sobre lienzo',
        'painting_10_location' => 'Galería Uffizi, Florencia',
        'painting_11_text' => 'Guernica - Pablo Picasso',
        'painting_11_desc' => 'Protesta contra la guerra por el bombardeo de Guernica, utilizando formas monocromáticas y caóticas.',
        'painting_11_artist' => 'Pablo Picasso',
        'painting_11_year' => '1937',
        'painting_11_medium' => 'Óleo sobre lienzo',
        'painting_11_location' => 'Museo Reina Sofía, Madrid',
        'painting_12_text' => 'El Ángelus - Jean-François Millet',
        'painting_12_desc' => 'Retrata a campesinos rezando en los campos, impregnado de temas religiosos y trabajo digno.',
        'painting_12_artist' => 'Jean-François Millet',
        'painting_12_year' => '1857–1859',
        'painting_12_medium' => 'Óleo sobre lienzo',
        'painting_12_location' => 'Museo de Orsay, París',
        'painting_13_text' => 'Las Espigadoras - Jean-François Millet',
        'painting_13_desc' => 'Muestra a mujeres pobres recogiendo grano sobrante, simbolizando el trabajo y la clase social.',
        'painting_13_artist' => 'Jean-François Millet',
        'painting_13_year' => '1857',
        'painting_13_medium' => 'Óleo sobre lienzo',
        'painting_13_location' => 'Museo de Orsay, París',
        'painting_14_text' => 'El Pífano - Édouard Manet',
        'painting_14_desc' => 'Obra impresionista con fondos planos y colores audaces, representando a un joven músico militar.',
        'painting_14_artist' => 'Édouard Manet',
        'painting_14_year' => '1866',
        'painting_14_medium' => 'Óleo sobre lienzo',
        'painting_14_location' => 'Museo de Orsay, París',
        'painting_15_text' => 'La Clase de Baile - Edgar Degas',
        'painting_15_desc' => 'Captura momentos de ensayo de ballet, destacando el movimiento y la vida femenina urbana.',
        'painting_15_artist' => 'Edgar Degas',
        'painting_15_year' => '1874',
        'painting_15_medium' => 'Óleo sobre lienzo',
        'painting_15_location' => 'Museo Metropolitano de Arte, Nueva York',
        'painting_16_text' => 'La Ronda Nocturna - Rembrandt',
        'painting_16_desc' => 'Obra maestra de la Edad de Oro holandesa, utilizando luz dramática para representar una patrulla de guardia cívica.',
        'painting_16_artist' => 'Rembrandt van Rijn',
        'painting_16_year' => '1642',
        'painting_16_medium' => 'Óleo sobre lienzo',
        'painting_16_location' => 'Rijksmuseum, Ámsterdam',
        'painting_17_text' => 'La Joven de la Perla - Johannes Vermeer',
        'painting_17_desc' => 'Conocida como la "Mona Lisa del Norte", celebrada por su luz y expresión enigmática.',
        'painting_17_artist' => 'Johannes Vermeer',
        'painting_17_year' => '1665',
        'painting_17_medium' => 'Óleo sobre lienzo',
        'painting_17_location' => 'Mauritshuis, La Haya',
        'painting_18_text' => 'Gótico Americano - Grant Wood',
        'painting_18_desc' => 'Retrato satírico pero realista de la vida rural estadounidense, un ícono cultural.',
        'painting_18_artist' => 'Grant Wood',
        'painting_18_year' => '1930',
        'painting_18_medium' => 'Óleo sobre panel de madera',
        'painting_18_location' => 'Instituto de Arte de Chicago',
        'painting_19_text' => 'Terraza del Café por la Noche - Vincent van Gogh',
        'painting_19_desc' => 'Representación vívidamente coloreada de un café nocturno en Arles, Francia, con resonancia emocional.',
        'painting_19_artist' => 'Vincent van Gogh',
        'painting_19_year' => '1888',
        'painting_19_medium' => 'Óleo sobre lienzo',
        'painting_19_location' => 'Museo Kröller-Müller, Otterlo',
        'painting_20_text' => 'La Habitación Roja - Henri Matisse',
        'painting_20_desc' => 'Obra fauvista con composición decorativa y patrones de color rítmicos.',
        'painting_20_artist' => 'Henri Matisse',
        'painting_20_year' => '1908',
        'painting_20_medium' => 'Óleo sobre lienzo',
        'painting_20_location' => 'Museo del Hermitage, San Petersburgo',
        'footer_copyright' => '© 2025 Historia, Arte y Moda. Todos los derechos reservados.'
    ],
    'ar' => [
        'meta_description' => 'اكتشف لوحات العالم الأيقونية مع HAF، تعرض روائع خالدة',
        'hero_title' => 'معرض لوحات العالم',
        'hero_subtitle' => 'استكشف جمال الأعمال الفنية الشهيرة مع HAF',
        'nav_history' => 'تاريخ',
        'nav_art' => 'فن',
        'nav_world_paintings' => 'لوحات العالم',
        'nav_famous_artists' => 'فنانون مشهورون',
        'nav_art_game' => 'لعبة الفن',
        'nav_fashion' => 'موضة',
        'nav_shop' => 'متجر',
        'gallery_title' => 'لوحات أيقونية',
        'gallery_subtitle' => 'مجموعة مختارة من اللوحات العالمية الشهيرة',
        'modal_close' => 'إغلاق',
        'modal_artist' => 'الفنان',
        'modal_year' => 'السنة',
        'modal_medium' => 'الخامة',
        'modal_location' => 'الموقع',
        'view_single' => 'عرض لوحة واحدة',
        'view_grid' => 'عرض المعرض',
        'prev_painting' => 'السابق',
        'next_painting' => 'التالي',
        'painting_1_text' => 'الموناليزا - ليوناردو دافنشي',
        'painting_1_desc' => 'تحفة عصر النهضة الإيطالية، مشهورة بابتسامتها الغامضة وتأثير تتبع النظرات، واحدة من أشهر البورتريهات.',
        'painting_1_artist' => 'ليوناردو دافنشي',
        'painting_1_year' => '1503–1506',
        'painting_1_medium' => 'زيت على لوح الحور',
        'painting_1_location' => 'متحف اللوفر، باريس',
        'painting_2_text' => 'العشاء الأخير - ليوناردو دافنشي',
        'painting_2_desc' => 'يصور يسوع والرسل الاثني عشر في وجبتهم الأخيرة، مع تكوين معقد وتوتر عاطفي شديد.',
        'painting_2_artist' => 'ليوناردو دافنشي',
        'painting_2_year' => '1495–1498',
        'painting_2_medium' => 'تمبرا على جص',
        'painting_2_location' => 'سانتا ماريا ديلي غراتسي، ميلانو',
        'painting_3_text' => 'ليلة مرصعة بالنجوم - فينسنت فان جوخ',
        'painting_3_desc' => 'يلتقط سماء الليل الدوارة بطاقة وحيوية، رمز ما بعد الانطباعية.',
        'painting_3_artist' => 'فينسنت فان جوخ',
        'painting_3_year' => '1889',
        'painting_3_medium' => 'زيت على قماش',
        'painting_3_location' => 'متحف الفن الحديث، نيويورك',
        'painting_4_text' => 'عباد الشمس - فينسنت فان جوخ',
        'painting_4_desc' => 'سلسلة تعرض قوة الحياة النابضة والعاطفة من خلال الزهور الصفراء الزاهية.',
        'painting_4_artist' => 'فينسنت فان جوخ',
        'painting_4_year' => '1888',
        'painting_4_medium' => 'زيت على قماش',
        'painting_4_location' => 'المعرض الوطني، لندن',
        'painting_5_text' => 'الصرخة - إدفارت مونك',
        'painting_5_desc' => 'تحفة رمزية، تصور القلق الوجودي من خلال شخصية مشوهة وتعبير مذعور.',
        'painting_5_artist' => 'إدفارت مونك',
        'painting_5_year' => '1893',
        'painting_5_medium' => 'تمبرا وباستيل على كرتون',
        'painting_5_location' => 'المعرض الوطني، أوسلو',
        'painting_6_text' => 'الحرية تقود الشعب - أوجين ديلاكروا',
        'painting_6_desc' => 'يخلد ثورة يوليو الفرنسية 1830، مع الحرية تحمل العلم وتبعث تأثيرًا قويًا.',
        'painting_6_artist' => 'أوجين ديلاكروا',
        'painting_6_year' => '1830',
        'painting_6_medium' => 'زيت على قماش',
        'painting_6_location' => 'متحف اللوفر، باريس',
        'painting_7_text' => 'نابليون يعبر جبال الألب - جاك لوي دافيد',
        'painting_7_desc' => 'عمل كلاسيكي جديد يبرز حضور نابليون البطولي والآمر.',
        'painting_7_artist' => 'جاك لوي دافيد',
        'painting_7_year' => '1801',
        'painting_7_medium' => 'زيت على قماش',
        'painting_7_location' => 'شاتو دي مالميزون، فرنسا',
        'painting_8_text' => 'بعد ظهر يوم أحد في جزيرة لا غراند جات - جورج سورا',
        'painting_8_desc' => 'كلاسيكية التنقيط، تستخدم نقاطًا صغيرة لتصوير الترفيه الحضري الحديث.',
        'painting_8_artist' => 'جورج سورا',
        'painting_8_year' => '1884–1886',
        'painting_8_medium' => 'زيت على قماش',
        'painting_8_location' => 'معهد الفنون في شيكاغو',
        'painting_9_text' => 'خلق آدم - مايكل أنجلو',
        'painting_9_desc' => 'لوحة جدارية على سقف كنيسة سيستين، تظهر أصابع الله وآدم تكاد تلمس، ترمز إلى شرارة الحياة.',
        'painting_9_artist' => 'مايكل أنجلو',
        'painting_9_year' => '1512',
        'painting_9_medium' => 'جدارية',
        'painting_9_location' => 'كنيسة سيستين، الفاتيكان',
        'painting_10_text' => 'ولادة فينوس - ساندرو بوتيتشيلي',
        'painting_10_desc' => 'عمل من عصر النهضة المبكر يصور الولادة الأسطورية لفينوس من البحر.',
        'painting_10_artist' => 'ساندرو بوتيتشيلي',
        'painting_10_year' => '1484–1486',
        'painting_10_medium' => 'تمبرا على قماش',
        'painting_10_location' => 'معرض أوفيزي، فلورنسا',
        'painting_11_text' => 'غيرنيكا - بابلو بيكاسو',
        'painting_11_desc' => 'احتجاج ضد قصف غيرنيكا، باستخدام أحادية اللون الصارمة والأشكال الفوضوية.',
        'painting_11_artist' => 'بابلو بيكاسو',
        'painting_11_year' => '1937',
        'painting_11_medium' => 'زيت على قماش',
        'painting_11_location' => 'متحف رينا صوفيا، مدريد',
        'painting_12_text' => 'الأنجلوس - جان فرانسوا ميليه',
        'painting_12_desc' => 'يصور الفلاحين يصلون في الحقول، مليء بمواضيع دينية وكرامة العمل.',
        'painting_12_artist' => 'جان فرانسوا ميليه',
        'painting_12_year' => '1857–1859',
        'painting_12_medium' => 'زيت على قماش',
        'painting_12_location' => 'باريس، متحف أورسيه',
        'painting_13_text' => 'الملتقطات - جان فرانسوا ميليه',
        'painting_13_desc' => 'يظهر نساء فقيرات يجمعن الحبوب المتبقية، يرمز إلى العمل والطبقة الاجتماعية.',
        'painting_13_artist' => 'جان فرانسوا ميليه',
        'painting_13_year' => '1857',
        'painting_13_medium' => 'زيت على قماش',
        'painting_13_location' => 'باريس، متحف أورسيه',
        'painting_14_text' => 'عازف الناي - إدوار مانيه',
        'painting_14_desc' => 'عمل انطباعي بخلفيات مسطحة وألوان جريئة، يصور موسيقيًا عسكريًا شابًا.',
        'painting_14_artist' => 'إدوار مانيه',
        'painting_14_year' => '1866',
        'painting_14_medium' => 'زيت على قماش',
        'painting_14_location' => 'باريس، متحف أورسيه',
        'painting_15_text' => 'صف الرقص - إدغار ديغا',
        'painting_15_desc' => 'يلتقط لحظات تدريب الباليه، يبرز الحركة وحياة المرأة الحضرية.',
        'painting_15_artist' => 'إدغار ديغا',
        'painting_15_year' => '1874',
        'painting_15_medium' => 'زيت على قماش',
        'painting_15_location' => 'نيويورك، متحف المتروبوليتان للفنون',
        'painting_16_text' => 'الحرس الليلي - رامبرانت',
        'painting_16_desc' => 'تحفة العصر الذهبي الهولندي، يستخدم الضوء الدرامي لتصوير دورية الحرس المدني.',
        'painting_16_artist' => 'رامبرانت فان راين',
        'painting_16_year' => '1642',
        'painting_16_medium' => 'زيت على قماش',
        'painting_16_location' => 'أمستردام، متحف ريجكس',
        'painting_17_text' => 'الفتاة ذات القرط اللؤلؤي - يوهانس فيرمير',
        'painting_17_desc' => 'معروفة باسم "موناليزا الشمال"، مشهورة بضوئها وتعبيرها الغامض.',
        'painting_17_artist' => 'يوهانس فيرمير',
        'painting_17_year' => '1665',
        'painting_17_medium' => 'زيت على قماش',
        'painting_17_location' => 'لاهاي، متحف موريتشيوس',
        'painting_18_text' => 'القوطية الأمريكية - غرانت وود',
        'painting_18_desc' => 'تصوير ساخر لكنه واقعي للحياة الريفية الأمريكية، أيقونة ثقافية.',
        'painting_18_artist' => 'غرانت وود',
        'painting_18_year' => '1930',
        'painting_18_medium' => 'زيت على لوح بيفر',
        'painting_18_location' => 'شيكاغو، معهد الفنون',
        'painting_19_text' => 'تراس المقهى ليلاً - فينسنت فان جوخ',
        'painting_19_desc' => 'تصوير ملون لمقهى ليلي في آرل، فرنسا، مع صدى عاطفي.',
        'painting_19_artist' => 'فينسنت فان جوخ',
        'painting_19_year' => '1888',
        'painting_19_medium' => 'زيت على قماش',
        'painting_19_location' => 'أوترلو، متحف كرولر-مولر',
        'painting_20_text' => 'الغرفة الحمراء - هنري ماتيس',
        'painting_20_desc' => 'عمل فوفي مع تركيبة زخرفية وأنماط لونية إيقاعية.',
        'painting_20_artist' => 'هنري ماتيس',
        'painting_20_year' => '1908',
        'painting_20_medium' => 'زيت على قماش',
        'painting_20_location' => 'سانت بطرسبرغ، متحف هيرميتاج',
        'footer_copyright' => '© 2025 تاريخ، فن وموضة. جميع الحقوق محفوظة.'
    ],
    'fr' => [
        'meta_description' => 'Découvrez des peintures mondiales emblématiques avec HAF, présentant des chefs-d\'œuvre intemporels',
        'hero_title' => 'Galerie de Peintures Mondiales',
        'hero_subtitle' => 'Explorez la beauté des œuvres d\'art renommées avec HAF',
        'nav_history' => 'Histoire',
        'nav_art' => 'Art',
        'nav_world_paintings' => 'Peintures Mondiales',
        'nav_famous_artists' => 'Artistes Célèbres',
        'nav_art_game' => 'Jeu d\'Art',
        'nav_fashion' => 'Mode',
        'nav_shop' => 'Boutique',
        'gallery_title' => 'Peintures Emblématiques',
        'gallery_subtitle' => 'Une collection soigneusement sélectionnée de peintures mondialement célèbres',
        'modal_close' => 'Fermer',
        'modal_artist' => 'Artiste',
        'modal_year' => 'Année',
        'modal_medium' => 'Technique',
        'modal_location' => 'Lieu',
        'view_single' => 'Voir la Peinture Individuelle',
        'view_grid' => 'Voir la Grille de la Galerie',
        'prev_painting' => 'Précédent',
        'next_painting' => 'Suivant',
        'painting_1_text' => 'La Joconde - Léonard de Vinci',
        'painting_1_desc' => 'Chef-d\'œuvre de la Renaissance italienne, célèbre pour son sourire mystérieux et son effet de suivi du regard, l\'un des portraits les plus célèbres.',
        'painting_1_artist' => 'Léonard de Vinci',
        'painting_1_year' => '1503–1506',
        'painting_1_medium' => 'Huile sur panneau de peuplier',
        'painting_1_location' => 'Musée du Louvre, Paris',
        'painting_2_text' => 'La Cène - Léonard de Vinci',
        'painting_2_desc' => 'Représente Jésus et les douze apôtres lors de leur dernier repas, avec une composition complexe et une tension émotionnelle intense.',
        'painting_2_artist' => 'Léonard de Vinci',
        'painting_2_year' => '1495–1498',
        'painting_2_medium' => 'Tempera sur gesso',
        'painting_2_location' => 'Santa Maria delle Grazie, Milan',
        'painting_3_text' => 'La Nuit Étoilée - Vincent van Gogh',
        'painting_3_desc' => 'Capture des ciels nocturnes tourbillonnants avec une énergie et une émotion dynamiques, caractéristique du Post-Impressionnisme.',
        'painting_3_artist' => 'Vincent van Gogh',
        'painting_3_year' => '1889',
        'painting_3_medium' => 'Huile sur toile',
        'painting_3_location' => 'Musée d\'Art Moderne, New York',
        'painting_4_text' => 'Les Tournesols - Vincent van Gogh',
        'painting_4_desc' => 'Une série mettant en valeur la force vitale vibrante et l\'émotion personnelle à travers des fleurs jaunes vives.',
        'painting_4_artist' => 'Vincent van Gogh',
        'painting_4_year' => '1888',
        'painting_4_medium' => 'Huile sur toile',
        'painting_4_location' => 'National Gallery, Londres',
        'painting_5_text' => 'Le Cri - Edvard Munch',
        'painting_5_desc' => 'Chef-d\'œuvre symboliste, dépeignant l\'angoisse existentielle à travers une figure déformée et une expression terrifiée.',
        'painting_5_artist' => 'Edvard Munch',
        'painting_5_year' => '1893',
        'painting_5_medium' => 'Tempera et pastel sur carton',
        'painting_5_location' => 'Galerie Nationale, Oslo',
        'painting_6_text' => 'La Liberté Guidant le Peuple - Eugène Delacroix',
        'painting_6_desc' => 'Commémore la Révolution de Juillet 1830 en France, avec la Liberté tenant le drapeau, dégageant un impact puissant.',
        'painting_6_artist' => 'Eugène Delacroix',
        'painting_6_year' => '1830',
        'painting_6_medium' => 'Huile sur toile',
        'painting_6_location' => 'Musée du Louvre, Paris',
        'painting_7_text' => 'Napoléon Traversant les Alpes - Jacques-Louis David',
        'painting_7_desc' => 'Œuvre néoclassique soulignant la présence héroïque et commandante de Napoléon.',
        'painting_7_artist' => 'Jacques-Louis David',
        'painting_7_year' => '1801',
        'painting_7_medium' => 'Huile sur toile',
        'painting_7_location' => 'Château de Malmaison, France',
        'painting_8_text' => 'Un Dimanche Après-midi à l\'Île de la Grande Jatte - Georges Seurat',
        'painting_8_desc' => 'Classique pointilliste, utilisant de minuscules points pour dépeindre les loisirs urbains modernes.',
        'painting_8_artist' => 'Georges Seurat',
        'painting_8_year' => '1884–1886',
        'painting_8_medium' => 'Huile sur toile',
        'painting_8_location' => 'Institut d\'Art de Chicago',
        'painting_9_text' => 'La Création d\'Adam - Michel-Ange',
        'painting_9_desc' => 'Fresque du plafond de la Chapelle Sixtine, montrant les doigts de Dieu et d\'Adam presque touchants, symbolisant l\'étincelle de la vie.',
        'painting_9_artist' => 'Michel-Ange',
        'painting_9_year' => '1512',
        'painting_9_medium' => 'Fresque',
        'painting_9_location' => 'Chapelle Sixtine, Cité du Vatican',
        'painting_10_text' => 'La Naissance de Vénus - Sandro Botticelli',
        'painting_10_desc' => 'Œuvre de la Renaissance précoce dépeignant la naissance mythologique de Vénus émergeant de la mer.',
        'painting_10_artist' => 'Sandro Botticelli',
        'painting_10_year' => '1484–1486',
        'painting_10_medium' => 'Tempera sur toile',
        'painting_10_location' => 'Galerie des Offices, Florence',
        'painting_11_text' => 'Guernica - Pablo Picasso',
        'painting_11_desc' => 'Protestation anti-guerre contre le bombardement de Guernica, utilisant des formes monochromes et chaotiques.',
        'painting_11_artist' => 'Pablo Picasso',
        'painting_11_year' => '1937',
        'painting_11_medium' => 'Huile sur toile',
        'painting_11_location' => 'Museo Reina Sofía, Madrid',
        'painting_12_text' => 'L\'Angélus - Jean-François Millet',
        'painting_12_desc' => 'Représente des paysans priant dans les champs, imprégné de thèmes religieux et de travail digne.',
        'painting_12_artist' => 'Jean-François Millet',
        'painting_12_year' => '1857–1859',
        'painting_12_medium' => 'Huile sur toile',
        'painting_12_location' => 'Musée d\'Orsay, Paris',
        'painting_13_text' => 'Les Glaneuses - Jean-François Millet',
        'painting_13_desc' => 'Montre des femmes pauvres ramassant le grain restant, symbolisant le travail et la classe sociale.',
        'painting_13_artist' => 'Jean-François Millet',
        'painting_13_year' => '1857',
        'painting_13_medium' => 'Huile sur toile',
        'painting_13_location' => 'Musée d\'Orsay, Paris',
        'painting_14_text' => 'Le Joueur de Fifre - Édouard Manet',
        'painting_14_desc' => 'Œuvre impressionniste avec des arrière-plans plats et des couleurs audacieuses, dépeignant un jeune musicien militaire.',
        'painting_14_artist' => 'Édouard Manet',
        'painting_14_year' => '1866',
        'painting_14_medium' => 'Huile sur toile',
        'painting_14_location' => 'Musée d\'Orsay, Paris',
        'painting_15_text' => 'La Classe de Danse - Edgar Degas',
        'painting_15_desc' => 'Capture des moments de répétition de ballet, mettant en valeur le mouvement et la vie féminine urbaine.',
        'painting_15_artist' => 'Edgar Degas',
        'painting_15_year' => '1874',
        'painting_15_medium' => 'Huile sur toile',
        'painting_15_location' => 'Metropolitan Museum of Art, New York',
        'painting_16_text' => 'La Ronde de Nuit - Rembrandt',
        'painting_16_desc' => 'Chef-d\'œuvre de l\'Âge d\'Or hollandais, utilisant une lumière dramatique pour dépeindre une patrouille de garde civique.',
        'painting_16_artist' => 'Rembrandt van Rijn',
        'painting_16_year' => '1642',
        'painting_16_medium' => 'Huile sur toile',
        'painting_16_location' => 'Rijksmuseum, Amsterdam',
        'painting_17_text' => 'La Jeune Fille à la Perle - Johannes Vermeer',
        'painting_17_desc' => 'Connue comme la "Joconde du Nord", célèbre pour sa lumière et son expression énigmatique.',
        'painting_17_artist' => 'Johannes Vermeer',
        'painting_17_year' => '1665',
        'painting_17_medium' => 'Huile sur toile',
        'painting_17_location' => 'Mauritshuis, La Haye',
        'painting_18_text' => 'American Gothic - Grant Wood',
        'painting_18_desc' => 'Portrait satirique mais réaliste de la vie rurale américaine, une icône culturelle.',
        'painting_18_artist' => 'Grant Wood',
        'painting_18_year' => '1930',
        'painting_18_medium' => 'Huile sur panneau de bois',
        'painting_18_location' => 'Institut d\'Art de Chicago',
        'painting_19_text' => 'Terrasse du Café le Soir - Vincent van Gogh',
        'painting_19_desc' => 'Représentation vivement colorée d\'un café nocturne à Arles, France, avec une résonance émotionnelle.',
        'painting_19_artist' => 'Vincent van Gogh',
        'painting_19_year' => '1888',
        'painting_19_medium' => 'Huile sur toile',
        'painting_19_location' => 'Musée Kröller-Müller, Otterlo',
        'painting_20_text' => 'La Chambre Rouge - Henri Matisse',
        'painting_20_desc' => 'Œuvre fauve avec une composition décorative et des motifs de couleurs rythmiques.',
        'painting_20_artist' => 'Henri Matisse',
        'painting_20_year' => '1908',
        'painting_20_medium' => 'Huile sur toile',
        'painting_20_location' => 'Musée de l\'Ermitage, Saint-Pétersbourg',
        'footer_copyright' => '© 2025 History, Art & Fashion. Tous droits réservés.'
    ],
    'ru' => [
        'meta_description' => 'Откройте для себя знаковые мировые картины с HAF, демонстрирующие вечные шедевры',
        'hero_title' => 'Галерея Мировых Картин',
        'hero_subtitle' => 'Исследуйте красоту известных произведений искусства с HAF',
        'nav_history' => 'История',
        'nav_art' => 'Искусство',
        'nav_world_paintings' => 'Мировые Картины',
        'nav_famous_artists' => 'Известные Художники',
        'nav_art_game' => 'Игра в Искусство',
        'nav_fashion' => 'Мода',
        'nav_shop' => 'Магазин',
        'gallery_title' => 'Знаковые Картины',
        'gallery_subtitle' => 'Кураторская коллекция всемирно известных картин',
        'modal_close' => 'Закрыть',
        'modal_artist' => 'Художник',
        'modal_year' => 'Год',
        'modal_medium' => 'Техника',
        'modal_location' => 'Местоположение',
        'view_single' => 'Просмотр Одной Картины',
        'view_grid' => 'Просмотр Галереи',
        'prev_painting' => 'Предыдущая',
        'next_painting' => 'Следующая',
        'painting_1_text' => 'Мона Лиза - Леонардо да Винчи',
        'painting_1_desc' => 'Шедевр итальянского Возрождения, известный своей загадочной улыбкой и эффектом следящего взгляда, одна из самых известных портретных работ.',
        'painting_1_artist' => 'Леонардо да Винчи',
        'painting_1_year' => '1503–1506',
        'painting_1_medium' => 'Масло на тополиной панели',
        'painting_1_location' => 'Лувр, Париж',
        'painting_2_text' => 'Тайная Вечеря - Леонардо да Винчи',
        'painting_2_desc' => 'Изображает Иисуса и двенадцать апостолов на их последней трапезе, с замысловатой композицией и интенсивным эмоциональным напряжением.',
        'painting_2_artist' => 'Леонардо да Винчи',
        'painting_2_year' => '1495–1498',
        'painting_2_medium' => 'Темпера на гипсе',
        'painting_2_location' => 'Санта-Мария-делле-Грацие, Милан',
        'painting_3_text' => 'Звездная Ночь - Винсент Ван Гог',
        'painting_3_desc' => 'Захватывает вихревые ночные небеса с динамической энергией и эмоцией, отличительная черта постимпрессионизма.',
        'painting_3_artist' => 'Винсент Ван Гог',
        'painting_3_year' => '1889',
        'painting_3_medium' => 'Масло на холсте',
        'painting_3_location' => 'Музей современного искусства, Нью-Йорк',
        'painting_4_text' => 'Подсолнухи - Винсент Ван Гог',
        'painting_4_desc' => 'Серия работ, демонстрирующая яркую, страстную жизненную силу и личные эмоции через яркие желтые цветы.',
        'painting_4_artist' => 'Винсент Ван Гог',
        'painting_4_year' => '1888',
        'painting_4_medium' => 'Масло на холсте',
        'painting_4_location' => 'Национальная галерея, Лондон',
        'painting_5_text' => 'Крик - Эдвард Мунк',
        'painting_5_desc' => 'Символистский шедевр, изображающий экзистенциальную тревогу через искаженную фигуру и испуганное выражение.',
        'painting_5_artist' => 'Эдвард Мунк',
        'painting_5_year' => '1893',
        'painting_5_medium' => 'Темпера и пастель на картоне',
        'painting_5_location' => 'Национальная галерея, Осло',
        'painting_6_text' => 'Свобода, ведущая народ - Эжен Делакруа',
        'painting_6_desc' => 'Коммеморация французской Июльской революции 1830 года, со Свободой, держащей флаг, излучающей мощное воздействие.',
        'painting_6_artist' => 'Эжен Делакруа',
        'painting_6_year' => '1830',
        'painting_6_medium' => 'Масло на холсте',
        'painting_6_location' => 'Лувр, Париж',
        'painting_7_text' => 'Наполеон пересекает Альпы - Жак-Луи Давид',
        'painting_7_desc' => 'Неоклассическая работа, подчеркивающая героическое и властное присутствие Наполеона.',
        'painting_7_artist' => 'Жак-Луи Давид',
        'painting_7_year' => '1801',
        'painting_7_medium' => 'Масло на холсте',
        'painting_7_location' => 'Шато де Мальмезон, Франция',
        'painting_8_text' => 'Воскресный день на острове Гранд-Жатт - Жорж Сёра',
        'painting_8_desc' => 'Пуантилистская классика, использующая крошечные точки для изображения современного городского досуга.',
        'painting_8_artist' => 'Жорж Сёра',
        'painting_8_year' => '1884–1886',
        'painting_8_medium' => 'Масло на холсте',
        'painting_8_location' => 'Художественный институт Чикаго',
        'painting_9_text' => 'Сотворение Адама - Микеланджело',
        'painting_9_desc' => 'Фреска потолка Сикстинской капеллы, показывающая почти соприкасающиеся пальцы Бога и Адама, символизирующие искру жизни.',
        'painting_9_artist' => 'Микеланджело',
        'painting_9_year' => '1512',
        'painting_9_medium' => 'Фреска',
        'painting_9_location' => 'Сикстинская капелла, Ватикан',
        'painting_10_text' => 'Рождение Венеры - Сандро Боттичелли',
        'painting_10_desc' => 'Работа раннего Возрождения, изображающая мифологическое рождение Венеры, появляющейся из моря.',
        'painting_10_artist' => 'Сандро Боттичелли',
        'painting_10_year' => '1484–1486',
        'painting_10_medium' => 'Темпера на холсте',
        'painting_10_location' => 'Галерея Уффици, Флоренция',
        'painting_11_text' => 'Герника - Пабло Пикассо',
        'painting_11_desc' => 'Антивоенный протест против бомбардировки Герники, использующий резкий монохром и хаотичные формы.',
        'painting_11_artist' => 'Пабло Пикассо',
        'painting_11_year' => '1937',
        'painting_11_medium' => 'Масло на холсте',
        'painting_11_location' => 'Музей королевы Софии, Мадрид',
        'painting_12_text' => 'Анжелюс - Жан-Франçois Милле',
        'painting_12_desc' => 'Изображает крестьян, молящихся в поле, наполненных религиозными темами и достоинством труда.',
        'painting_12_artist' => 'Жан-Франçois Милле',
        'painting_12_year' => '1857–1859',
        'painting_12_medium' => 'Масло на холсте',
        'painting_12_location' => 'Музей Орсе, Париж',
        'painting_13_text' => 'Сборщицы колосьев - Жан-Франçois Милле',
        'painting_13_desc' => 'Показывает бедных женщин, собирающих оставшееся зерно, символизируя труд и социальный класс.',
        'painting_13_artist' => 'Жан-Франçois Милле',
        'painting_13_year' => '1857',
        'painting_13_medium' => 'Масло на холсте',
        'painting_13_location' => 'Музей Орсе, Париж',
        'painting_14_text' => 'The Fifer - Édouard Manet',
        'painting_14_desc' => 'Impressionist work with flat backgrounds and bold colors, depicting a young military musician.',
        'painting_14_artist' => 'Édouard Manet',
        'painting_14_year' => '1866',
        'painting_14_medium' => 'Oil on canvas',
        'painting_14_location' => 'Paris, Musée d\'Orsay',
        'painting_15_text' => 'The Dance Class - Edgar Degas',
        'painting_15_desc' => 'Captures ballet rehearsal moments, highlighting movement and urban female life.',
        'painting_15_artist' => 'Edgar Degas',
        'painting_15_year' => '1874',
        'painting_15_medium' => 'Oil on canvas',
        'painting_15_location' => 'New York, Metropolitan Museum of Art',
        'painting_16_text' => 'The Night Watch - Rembrandt',
        'painting_16_desc' => 'Dutch Golden Age masterpiece, using dramatic light to depict a civic guard patrol.',
        'painting_16_artist' => 'Rembrandt van Rijn',
        'painting_16_year' => '1642',
        'painting_16_medium' => 'Oil on canvas',
        'painting_16_location' => 'Amsterdam, Rijksmuseum',
        'painting_17_text' => 'Girl with a Pearl Earring - Johannes Vermeer',
        'painting_17_desc' => 'Known as the "Mona Lisa of the North," celebrated for its light and enigmatic expression.',
        'painting_17_artist' => 'Johannes Vermeer',
        'painting_17_year' => '1665',
        'painting_17_medium' => 'Oil on canvas',
        'painting_17_location' => 'The Hague, Mauritshuis',
        'painting_18_text' => 'American Gothic - Grant Wood',
        'painting_18_desc' => 'Satirical yet realistic portrayal of rural American life, a cultural icon.',
        'painting_18_artist' => 'Grant Wood',
        'painting_18_year' => '1930',
        'painting_18_medium' => 'Oil on beaverboard',
        'painting_18_location' => 'Chicago, Art Institute of Chicago',
        'painting_19_text' => 'Café Terrace at Night - Vincent van Gogh',
        'painting_19_desc' => 'Vividly colored depiction of a nighttime café in Arles, France, with emotional resonance.',
        'painting_19_artist' => 'Vincent van Gogh',
        'painting_19_year' => '1888',
        'painting_19_medium' => 'Oil on canvas',
        'painting_19_location' => 'Otterlo, Kröller-Müller Museum',
        'painting_20_text' => 'The Red Room - Henri Matisse',
        'painting_20_desc' => 'Fauvist work with decorative composition and rhythmic color patterns.',
        'painting_20_artist' => 'Henri Matisse',
        'painting_20_year' => '1908',
        'painting_20_medium' => 'Oil on canvas',
        'painting_20_location' => 'St. Petersburg, Hermitage Museum',
        'footer_copyright' => '© 2025 История, Искусство и Мода. Все права защищены.'
    ],
    'pt' => [
        'meta_description' => 'Descubra pinturas icônicas do mundo com HAF, mostrando obras-primas atemporais',
        'hero_title' => 'Galeria de Pinturas Mundiais',
        'hero_subtitle' => 'Explore a beleza de obras de arte renomadas com HAF',
        'nav_history' => 'História',
        'nav_art' => 'Arte',
        'nav_world_paintings' => 'Pinturas Mundiais',
        'nav_famous_artists' => 'Artistas Famosos',
        'nav_art_game' => 'Jogo de Arte',
        'nav_fashion' => 'Moda',
        'nav_shop' => 'Loja',
        'gallery_title' => 'Pinturas Icônicas',
        'gallery_subtitle' => 'Uma coleção curada de pinturas mundialmente famosas',
        'modal_close' => 'Fechar',
        'modal_artist' => 'Artista',
        'modal_year' => 'Ano',
        'modal_medium' => 'Técnica',
        'modal_location' => 'Localização',
        'view_single' => 'Ver Pintura Individual',
        'view_grid' => 'Ver Galeria',
        'prev_painting' => 'Anterior',
        'next_painting' => 'Próxima',
        'painting_1_text' => 'Mona Lisa - Leonardo da Vinci',
        'painting_1_desc' => 'Obra-prima do Renascimento italiano, conhecida por seu sorriso misterioso e efeito de acompanhamento do olhar, um dos retratos mais famosos.',
        'painting_1_artist' => 'Leonardo da Vinci',
        'painting_1_year' => '1503–1506',
        'painting_1_medium' => 'Óleo sobre painel de álamo',
        'painting_1_location' => 'Museu do Louvre, Paris',
        'painting_2_text' => 'A Última Ceia - Leonardo da Vinci',
        'painting_2_desc' => 'Retrata Jesus e os doze apóstolos em sua última refeição, com composição intrincada e intensa tensão emocional.',
        'painting_2_artist' => 'Leonardo da Vinci',
        'painting_2_year' => '1495–1498',
        'painting_2_medium' => 'Têmpera sobre gesso',
        'painting_2_location' => 'Santa Maria delle Grazie, Milão',
        'painting_3_text' => 'Noite Estrelada - Vincent van Gogh',
        'painting_3_desc' => 'Captura céus noturnos em espiral com energia dinâmica e emoção, uma marca registrada do Pós-impressionismo.',
        'painting_3_artist' => 'Vincent van Gogh',
        'painting_3_year' => '1889',
        'painting_3_medium' => 'Óleo sobre tela',
        'painting_3_location' => 'Museu de Arte Moderna, Nova York',
        'painting_4_text' => 'Girassóis - Vincent van Gogh',
        'painting_4_desc' => 'Uma série que mostra força vital vibrante e paixão através de flores amarelas vívidas.',
        'painting_4_artist' => 'Vincent van Gogh',
        'painting_4_year' => '1888',
        'painting_4_medium' => 'Óleo sobre tela',
        'painting_4_location' => 'Galeria Nacional, Londres',
        'painting_5_text' => 'O Grito - Edvard Munch',
        'painting_5_desc' => 'Obra-prima simbolista, retratando ansiedade existencial através de uma figura distorcida e expressão aterrorizada.',
        'painting_5_artist' => 'Edvard Munch',
        'painting_5_year' => '1893',
        'painting_5_medium' => 'Têmpera e pastel sobre cartão',
        'painting_5_location' => 'Galeria Nacional, Oslo',
        'painting_6_text' => 'A Liberdade Guiando o Povo - Eugène Delacroix',
        'painting_6_desc' => 'Comemora a Revolução de Julho de 1830 na França, com a Liberdade segurando a bandeira, exalando impacto poderoso.',
        'painting_6_artist' => 'Eugène Delacroix',
        'painting_6_year' => '1830',
        'painting_6_medium' => 'Óleo sobre tela',
        'painting_6_location' => 'Museu do Louvre, Paris',
        'painting_7_text' => 'Napolão Cruzando os Alpes - Jacques-Louis David',
        'painting_7_desc' => 'Obra neoclássica enfatizando a presença heroica e comandante de Napoleão.',
        'painting_7_artist' => 'Jacques-Louis David',
        'painting_7_year' => '1801',
        'painting_7_medium' => 'Óleo sobre tela',
        'painting_7_location' => 'Château de Malmaison, França',
        'painting_8_text' => 'Uma Tarde de Domingo na Ilha de Grande Jatte - Georges Seurat',
        'painting_8_desc' => 'Clássico pontilhista, usando pequenos pontos para retratar o lazer urbano moderno.',
        'painting_8_artist' => 'Georges Seurat',
        'painting_8_year' => '1884–1886',
        'painting_8_medium' => 'Óleo sobre tela',
        'painting_8_location' => 'Instituto de Arte de Chicago',
        'painting_9_text' => 'A Criação de Adão - Michelangelo',
        'painting_9_desc' => 'Afresco do teto da Capela Sistina, mostrando os dedos de Deus e Adão quase se tocando, simbolizando a centelha da vida.',
        'painting_9_artist' => 'Michelangelo',
        'painting_9_year' => '1512',
        'painting_9_medium' => 'Afresco',
        'painting_9_location' => 'Capela Sistina, Vaticano',
        'painting_10_text' => 'O Nascimento de Vênus - Sandro Botticelli',
        'painting_10_desc' => 'Obra do início do Renascimento, retratando o nascimento mitológico de Vênus emergindo do mar.',
        'painting_10_artist' => 'Sandro Botticelli',
        'painting_10_year' => '1484–1486',
        'painting_10_medium' => 'Têmpera sobre tela',
        'painting_10_location' => 'Galeria Uffizi, Florença',
        'painting_11_text' => 'Guernica - Pablo Picasso',
        'painting_11_desc' => 'Protesto anti-guerra contra o bombardeio de Guernica, usando monocromia severa e formas caóticas.',
        'painting_11_artist' => 'Pablo Picasso',
        'painting_11_year' => '1937',
        'painting_11_medium' => 'Óleo sobre tela',
        'painting_11_location' => 'Museu Reina Sofía, Madri',
        'painting_12_text' => 'O Angelus - Jean-François Millet',
        'painting_12_desc' => 'Retrata camponeses rezando nos campos, imbuídos de temas religiosos e dignidade do trabalho.',
        'painting_12_artist' => 'Jean-François Millet',
        'painting_12_year' => '1857–1859',
        'painting_12_medium' => 'Óleo sobre tela',
        'painting_12_location' => 'Museu d\'Orsay, Paris',
        'painting_13_text' => 'As Respigadoras - Jean-François Millet',
        'painting_13_desc' => 'Mostra mulheres pobres coletando grãos restantes, simbolizando trabalho e classe social.',
        'painting_13_artist' => 'Jean-François Millet',
        'painting_13_year' => '1857',
        'painting_13_medium' => 'Óleo sobre tela',
        'painting_13_location' => 'Museu d\'Orsay, Paris',
        'painting_14_text' => 'O Flautista - Édouard Manet',
        'painting_14_desc' => 'Obra impressionista com fundos planos e cores ousadas, retratando um jovem músico militar.',
        'painting_14_artist' => 'Édouard Manet',
        'painting_14_year' => '1866',
        'painting_14_medium' => 'Óleo sobre tela',
        'painting_14_location' => 'Museu d\'Orsay, Paris',
        'painting_15_text' => 'A Classe de Dança - Edgar Degas',
        'painting_15_desc' => 'Captura momentos de ensaio de balé, destacando movimento e vida feminina urbana.',
        'painting_15_artist' => 'Edgar Degas',
        'painting_15_year' => '1874',
        'painting_15_medium' => 'Óleo sobre tela',
        'painting_15_location' => 'Museu Metropolitano de Arte, Nova York',
        'painting_16_text' => 'A Ronda Noturna - Rembrandt',
        'painting_16_desc' => 'Obra-prima da Era de Ouro Holandesa, usando luz dramática para retratar uma patrulha da guarda cívica.',
        'painting_16_artist' => 'Rembrandt van Rijn',
        'painting_16_year' => '1642',
        'painting_16_medium' => 'Óleo sobre tela',
        'painting_16_location' => 'Rijksmuseum, Amsterdã',
        'painting_17_text' => 'Moça com Brinco de Pérola - Johannes Vermeer',
        'painting_17_desc' => 'Conhecida como a "Mona Lisa do Norte", celebrada por sua luz e expressão enigmática.',
        'painting_17_artist' => 'Johannes Vermeer',
        'painting_17_year' => '1665',
        'painting_17_medium' => 'Óleo sobre tela',
        'painting_17_location' => 'Mauritshuis, Haia',
        'painting_18_text' => 'Gótico Americano - Grant Wood',
        'painting_18_desc' => 'Retrato satírico mas realista da vida rural americana, um ícone cultural.',
        'painting_18_artist' => 'Grant Wood',
        'painting_18_year' => '1930',
        'painting_18_medium' => 'Óleo sobre painel',
        'painting_18_location' => 'Instituto de Arte de Chicago',
        'painting_19_text' => 'Terraço do Café à Noite - Vincent van Gogh',
        'painting_19_desc' => 'Representação vívida de um café noturno em Arles, França, com ressonância emocional.',
        'painting_19_artist' => 'Vincent van Gogh',
        'painting_19_year' => '1888',
        'painting_19_medium' => 'Óleo sobre tela',
        'painting_19_location' => 'Museu Kröller-Müller, Otterlo',
        'painting_20_text' => 'A Sala Vermelha - Henri Matisse',
        'painting_20_desc' => 'Obra fauvista com composição decorativa e padrões rítmicos de cor.',
        'painting_20_artist' => 'Henri Matisse',
        'painting_20_year' => '1908',
        'painting_20_medium' => 'Óleo sobre tela',
        'painting_20_location' => 'Museu Hermitage, São Petersburgo',
        'footer_copyright' => '© 2025 História, Arte & Moda. Todos os direitos reservados.'
    ],
    'de' => [
        'meta_description' => 'Entdecken Sie ikonische Weltgemälde mit HAF, die zeitlose Meisterwerke präsentieren',
        'hero_title' => 'Weltgemälde-Galerie',
        'hero_subtitle' => 'Erkunden Sie die Schönheit renommierter Kunstwerke mit HAF',
        'nav_history' => 'Geschichte',
        'nav_art' => 'Kunst',
        'nav_world_paintings' => 'Weltgemälde',
        'nav_famous_artists' => 'Berühmte Künstler',
        'nav_art_game' => 'Kunstspiel',
        'nav_fashion' => 'Mode',
        'nav_shop' => 'Shop',
        'gallery_title' => 'Ikonische Gemälde',
        'gallery_subtitle' => 'Eine kuratierte Sammlung weltberühmter Gemälde',
        'modal_close' => 'Schließen',
        'modal_artist' => 'Künstler',
        'modal_year' => 'Jahr',
        'modal_medium' => 'Technik',
        'modal_location' => 'Standort',
        'view_single' => 'Einzelnes Gemälde anzeigen',
        'view_grid' => 'Galerie-Grid anzeigen',
        'prev_painting' => 'Zurück',
        'next_painting' => 'Weiter',
        'painting_1_text' => 'Mona Lisa - Leonardo da Vinci',
        'painting_1_desc' => 'Meisterwerk der italienischen Renaissance, bekannt für ihr geheimnisvolles Lächeln und den Blickkontakt-Effekt, eines der berühmtesten Porträts.',
        'painting_1_artist' => 'Leonardo da Vinci',
        'painting_1_year' => '1503–1506',
        'painting_1_medium' => 'Öl auf Pappelholz',
        'painting_1_location' => 'Louvre, Paris',
        'painting_2_text' => 'Das Letzte Abendmahl - Leonardo da Vinci',
        'painting_2_desc' => 'Zeigt Jesus und die zwölf Apostel bei ihrem letzten Mahl, mit komplexer Komposition und intensiver emotionaler Spannung.',
        'painting_2_artist' => 'Leonardo da Vinci',
        'painting_2_year' => '1495–1498',
        'painting_2_medium' => 'Tempera auf Putz',
        'painting_2_location' => 'Santa Maria delle Grazie, Mailand',
        'painting_3_text' => 'Sternennacht - Vincent van Gogh',
        'painting_3_desc' => 'Fängt wirbelnde Nachthimmel mit dynamischer Energie und Emotion ein, ein Markenzeichen des Post-Impressionismus.',
        'painting_3_artist' => 'Vincent van Gogh',
        'painting_3_year' => '1889',
        'painting_3_medium' => 'Öl auf Leinwand',
        'painting_3_location' => 'Museum of Modern Art, New York',
        'painting_4_text' => 'Sonnenblumen - Vincent van Gogh',
        'painting_4_desc' => 'Eine Serie, die lebendige Lebenskraft und Leidenschaft durch leuchtende gelbe Blumen zeigt.',
        'painting_4_artist' => 'Vincent van Gogh',
        'painting_4_year' => '1888',
        'painting_4_medium' => 'Öl auf Leinwand',
        'painting_4_location' => 'National Gallery, London',
        'painting_5_text' => 'Der Schrei - Edvard Munch',
        'painting_5_desc' => 'Symbolistisches Meisterwerk, das existenzielle Angst durch eine verzerrte Figur und einen erschrockenen Ausdruck darstellt.',
        'painting_5_artist' => 'Edvard Munch',
        'painting_5_year' => '1893',
        'painting_5_medium' => 'Tempera und Pastell auf Karton',
        'painting_5_location' => 'Nationalgalerie, Oslo',
        'painting_6_text' => 'Die Freiheit führt das Volk - Eugène Delacroix',
        'painting_6_desc' => 'Kommemoriert die Julirevolution von 1830 in Frankreich, mit der Freiheit, die die Flagge hält, und strahlt kraftvolle Wirkung aus.',
        'painting_6_artist' => 'Eugène Delacroix',
        'painting_6_year' => '1830',
        'painting_6_medium' => 'Öl auf Leinwand',
        'painting_6_location' => 'Louvre, Paris',
        'painting_7_text' => 'Napoleon überquert die Alpen - Jacques-Louis David',
        'painting_7_desc' => 'Neoklassisches Werk, das Napoleons heroische und befehlshabende Präsenz betont.',
        'painting_7_artist' => 'Jacques-Louis David',
        'painting_7_year' => '1801',
        'painting_7_medium' => 'Öl auf Leinwand',
        'painting_7_location' => 'Château de Malmaison, Frankreich',
        'painting_8_text' => 'Ein Sonntagnachmittag auf der Insel La Grande Jatte - Georges Seurat',
        'painting_8_desc' => 'Pointillistischer Klassiker, der kleine Punkte verwendet, um modernes urbanes Freizeitleben darzustellen.',
        'painting_8_artist' => 'Georges Seurat',
        'painting_8_year' => '1884–1886',
        'painting_8_medium' => 'Öl auf Leinwand',
        'painting_8_location' => 'Art Institute of Chicago',
        'painting_9_text' => 'Die Erschaffung Adams - Michelangelo',
        'painting_9_desc' => 'Fresko an der Decke der Sixtinischen Kapelle, zeigt die fast berührenden Finger Gottes und Adams, symbolisiert den Funken des Lebens.',
        'painting_9_artist' => 'Michelangelo',
        'painting_9_year' => '1512',
        'painting_9_medium' => 'Fresko',
        'painting_9_location' => 'Sixtinische Kapelle, Vatikan',
        'painting_10_text' => 'Die Geburt der Venus - Sandro Botticelli',
        'painting_10_desc' => 'Frührenaissance-Werk, das die mythische Geburt der Venus aus dem Meer darstellt.',
        'painting_10_artist' => 'Sandro Botticelli',
        'painting_10_year' => '1484–1486',
        'painting_10_medium' => 'Tempera auf Leinwand',
        'painting_10_location' => 'Uffizien, Florenz',
        'painting_11_text' => 'Guernica - Pablo Picasso',
        'painting_11_desc' => 'Anti-Kriegs-Protest gegen die Bombardierung von Guernica, verwendet strenge Monochromie und chaotische Formen.',
        'painting_11_artist' => 'Pablo Picasso',
        'painting_11_year' => '1937',
        'painting_11_medium' => 'Öl auf Leinwand',
        'painting_11_location' => 'Museo Reina Sofía, Madrid',
        'painting_12_text' => 'Das Angelusläuten - Jean-François Millet',
        'painting_12_desc' => 'Zeigt betende Bauern auf den Feldern, durchdrungen von religiösen Themen und Arbeitswürde.',
        'painting_12_artist' => 'Jean-François Millet',
        'painting_12_year' => '1857–1859',
        'painting_12_medium' => 'Öl auf Leinwand',
        'painting_12_location' => 'Musée d\'Orsay, Paris',
        'painting_13_text' => 'Die Ährenleserinnen - Jean-François Millet',
        'painting_13_desc' => 'Zeigt arme Frauen beim Aufsammeln von übriggebliebenem Getreide, symbolisiert Arbeit und soziale Klasse.',
        'painting_13_artist' => 'Jean-François Millet',
        'painting_13_year' => '1857',
        'painting_13_medium' => 'Öl auf Leinwand',
        'painting_13_location' => 'Musée d\'Orsay, Paris',
        'painting_14_text' => 'Der Flötenspieler - Édouard Manet',
        'painting_14_desc' => 'Impressionistisches Werk mit flachen Hintergründen und kühnen Farben, zeigt einen jungen Militärmusiker.',
        'painting_14_artist' => 'Édouard Manet',
        'painting_14_year' => '1866',
        'painting_14_medium' => 'Öl auf Leinwand',
        'painting_14_location' => 'Musée d\'Orsay, Paris',
        'painting_15_text' => 'Die Tanzklasse - Edgar Degas',
        'painting_15_desc' => 'Fängt Ballettprobenmomente ein, hebt Bewegung und urbanes Frauenleben hervor.',
        'painting_15_artist' => 'Edgar Degas',
        'painting_15_year' => '1874',
        'painting_15_medium' => 'Öl auf Leinwand',
        'painting_15_location' => 'Metropolitan Museum of Art, New York',
        'painting_16_text' => 'Die Nachtwache - Rembrandt',
        'painting_16_desc' => 'Meisterwerk des niederländischen Goldenen Zeitalters, verwendet dramatisches Licht, um eine Bürgerwehrpatrouille darzustellen.',
        'painting_16_artist' => 'Rembrandt van Rijn',
        'painting_16_year' => '1642',
        'painting_16_medium' => 'Öl auf Leinwand',
        'painting_16_location' => 'Rijksmuseum, Amsterdam',
        'painting_17_text' => 'Mädchen mit dem Perlenohrring - Johannes Vermeer',
        'painting_17_desc' => 'Bekannt als "Mona Lisa des Nordens", gefeiert für ihr Licht und ihren rätselhaften Ausdruck.',
        'painting_17_artist' => 'Johannes Vermeer',
        'painting_17_year' => '1665',
        'painting_17_medium' => 'Öl auf Leinwand',
        'painting_17_location' => 'Mauritshuis, Den Haag',
        'painting_18_text' => 'American Gothic - Grant Wood',
        'painting_18_desc' => 'Satirisches aber realistisches Porträt des amerikanischen Landlebens, ein kulturelles Ikone.',
        'painting_18_artist' => 'Grant Wood',
        'painting_18_year' => '1930',
        'painting_18_medium' => 'Öl auf Holz',
        'painting_18_location' => 'Art Institute of Chicago',
        'painting_19_text' => 'Caféterrasse bei Nacht - Vincent van Gogh',
        'painting_19_desc' => 'Lebendige Darstellung eines Nachtcafés in Arles, Frankreich, mit emotionaler Resonanz.',
        'painting_19_artist' => 'Vincent van Gogh',
        'painting_19_year' => '1888',
        'painting_19_medium' => 'Öl auf Leinwand',
        'painting_19_location' => 'Kröller-Müller Museum, Otterlo',
        'painting_20_text' => 'Das rote Zimmer - Henri Matisse',
        'painting_20_desc' => 'Fauvistisches Werk mit dekorativer Komposition und rhythmischen Farbmustern.',
        'painting_20_artist' => 'Henri Matisse',
        'painting_20_year' => '1908',
        'painting_20_medium' => 'Öl auf Leinwand',
        'painting_20_location' => 'Eremitage, St. Petersburg',
        'footer_copyright' => '© 2025 Geschichte, Kunst & Mode. Alle Rechte vorbehalten.'
    ],
    'ja' => [
        'meta_description' => 'HAFで世界の名画を発見し、時代を超えた傑作をご覧ください',
        'hero_title' => '世界名画ギャラリー',
        'hero_subtitle' => 'HAFで名高い芸術作品の美しさを探索',
        'nav_history' => '歴史',
        'nav_art' => 'アート',
        'nav_world_paintings' => '世界の名画',
        'nav_famous_artists' => '著名な芸術家',
        'nav_art_game' => 'アートゲーム',
        'nav_fashion' => 'ファッション',
        'nav_shop' => 'ショップ',
        'gallery_title' => '名画コレクション',
        'gallery_subtitle' => '世界の名画の厳選コレクション',
        'modal_close' => '閉じる',
        'modal_artist' => 'アーティスト',
        'modal_year' => '制作年',
        'modal_medium' => '技法',
        'modal_location' => '所蔵場所',
        'view_single' => '個別作品表示',
        'view_grid' => 'ギャラリー表示',
        'prev_painting' => '前へ',
        'next_painting' => '次へ',
        'painting_1_text' => 'モナ・リザ - レオナルド・ダ・ヴィンチ',
        'painting_1_desc' => 'イタリア・ルネサンスの傑作、謎めいた微笑みと視線追従効果で知られる、最も有名な肖像画の一つ。',
        'painting_1_artist' => 'レオナルド・ダ・ヴィンチ',
        'painting_1_year' => '1503–1506',
        'painting_1_medium' => 'ポプラ板に油彩',
        'painting_1_location' => 'ルーヴル美術館、パリ',
        'painting_2_text' => '最後の晩餐 - レオナルド・ダ・ヴィンチ',
        'painting_2_desc' => 'イエスと12使徒の最後の食事を描き、複雑な構図と強い感情的な緊張感を表現。',
        'painting_2_artist' => 'レオナルド・ダ・ヴィンチ',
        'painting_2_year' => '1495–1498',
        'painting_2_medium' => '石膏にテンペラ',
        'painting_2_location' => 'サンタ・マリア・デッレ・グラツィエ教会、ミラノ',
        'painting_3_text' => '星月夜 - フィンセント・ファン・ゴッホ',
        'painting_3_desc' => '渦巻く夜空を動的なエネルギーと感情で捉えた、ポスト印象派の代表作。',
        'painting_3_artist' => 'フィンセント・ファン・ゴッホ',
        'painting_3_year' => '1889',
        'painting_3_medium' => '油彩、キャンバス',
        'painting_3_location' => '近代美術館、ニューヨーク',
        'painting_4_text' => 'ひまわり - フィンセント・ファン・ゴッホ',
        'painting_4_desc' => '鮮やかな黄色の花を通して生命力と情熱を表現した連作。',
        'painting_4_artist' => 'フィンセント・ファン・ゴッホ',
        'painting_4_year' => '1888',
        'painting_4_medium' => '油彩、キャンバス',
        'painting_4_location' => 'ナショナル・ギャラリー、ロンドン',
        'painting_5_text' => '叫び - エドヴァルド・ムンク',
        'painting_5_desc' => '歪んだ人物と恐怖の表情を通して実存的不安を表現した象徴主義の傑作。',
        'painting_5_artist' => 'エドヴァルド・ムンク',
        'painting_5_year' => '1893',
        'painting_5_medium' => 'テンペラとパステル、厚紙',
        'painting_5_location' => '国立美術館、オスロ',
        'painting_6_text' => '民衆を導く自由の女神 - ウジェーヌ・ドラクロワ',
        'painting_6_desc' => '1830年のフランス7月革命を記念し、旗を掲げる自由の女神が力強い影響力を持つ。',
        'painting_6_artist' => 'ウジェーヌ・ドラクロワ',
        'painting_6_year' => '1830',
        'painting_6_medium' => '油彩、キャンバス',
        'painting_6_location' => 'ルーヴル美術館、パリ',
        'painting_7_text' => 'アルプスを越えるナポレオン - ジャック＝ルイ・ダヴィッド',
        'painting_7_desc' => 'ナポレオンの英雄的で威厳ある存在感を強調した新古典主義作品。',
        'painting_7_artist' => 'ジャック＝ルイ・ダヴィッド',
        'painting_7_year' => '1801',
        'painting_7_medium' => '油彩、キャンバス',
        'painting_7_location' => 'マルメゾン城、フランス',
        'painting_8_text' => 'グランド・ジャット島の日曜日の午後 - ジョルジュ・スーラ',
        'painting_8_desc' => '小さな点で現代の都市の余暇を描いた点描主義の古典。',
        'painting_8_artist' => 'ジョルジュ・スーラ',
        'painting_8_year' => '1884–1886',
        'painting_8_medium' => '油彩、キャンバス',
        'painting_8_location' => 'シカゴ美術館',
        'painting_9_text' => 'アダムの創造 - ミケランジェロ',
        'painting_9_desc' => 'システィーナ礼拝堂の天井画、神とアダムの指が触れ合う瞬間を描き、生命の火花を象徴。',
        'painting_9_artist' => 'ミケランジェロ',
        'painting_9_year' => '1512',
        'painting_9_medium' => 'フレスコ',
        'painting_9_location' => 'システィーナ礼拝堂、バチカン',
        'painting_10_text' => 'ヴィーナスの誕生 - サンドロ・ボッティチェリ',
        'painting_10_desc' => '海から生まれるヴィーナスの神話的な誕生を描いた初期ルネサンス作品。',
        'painting_10_artist' => 'サンドロ・ボッティチェリ',
        'painting_10_year' => '1484–1486',
        'painting_10_medium' => 'テンペラ、キャンバス',
        'painting_10_location' => 'ウフィツィ美術館、フィレンツェ',
        'painting_11_text' => 'ゲルニカ - パブロ・ピカソ',
        'painting_11_desc' => 'ゲルニカ爆撃への反戦抗議、厳格なモノクロームと混沌とした形態を使用。',
        'painting_11_artist' => 'パブロ・ピカソ',
        'painting_11_year' => '1937',
        'painting_11_medium' => '油彩、キャンバス',
        'painting_11_location' => 'ソフィア王妃芸術センター、マドリード',
        'painting_12_text' => '晩鐘 - ジャン＝フランソワ・ミレー',
        'painting_12_desc' => '畑で祈る農民を描き、宗教的主題と労働の尊厳を表現。',
        'painting_12_artist' => 'ジャン＝フランソワ・ミレー',
        'painting_12_year' => '1857–1859',
        'painting_12_medium' => '油彩、キャンバス',
        'painting_12_location' => 'オルセー美術館、パリ',
        'painting_13_text' => '落穂拾い - ジャン＝フランソワ・ミレー',
        'painting_13_desc' => '残された穀物を拾う貧しい女性たちを描き、労働と社会階級を象徴。',
        'painting_13_artist' => 'ジャン＝フランソワ・ミレー',
        'painting_13_year' => '1857',
        'painting_13_medium' => '油彩、キャンバス',
        'painting_13_location' => 'オルセー美術館、パリ',
        'painting_14_text' => '笛を吹く少年 - エドゥアール・マネ',
        'painting_14_desc' => '平面的な背景と大胆な色彩で若い軍楽隊員を描いた印象派作品。',
        'painting_14_artist' => 'エドゥアール・マネ',
        'painting_14_year' => '1866',
        'painting_14_medium' => '油彩、キャンバス',
        'painting_14_location' => 'オルセー美術館、パリ',
        'painting_15_text' => 'バレエ教室 - エドガー・ドガ',
        'painting_15_desc' => 'バレエのリハーサルシーンを捉え、動きと都市の女性生活を強調。',
        'painting_15_artist' => 'エドガー・ドガ',
        'painting_15_year' => '1874',
        'painting_15_medium' => '油彩、キャンバス',
        'painting_15_location' => 'メトロポリタン美術館、ニューヨーク',
        'painting_16_text' => '夜警 - レンブラント',
        'painting_16_desc' => '劇的な光で市民警備隊のパトロールを描いたオランダ黄金時代の傑作。',
        'painting_16_artist' => 'レンブラント・ファン・レイン',
        'painting_16_year' => '1642',
        'painting_16_medium' => '油彩、キャンバス',
        'painting_16_location' => 'アムステルダム国立美術館',
        'painting_17_text' => '真珠の耳飾りの少女 - ヨハネス・フェルメール',
        'painting_17_desc' => '「北のモナ・リザ」として知られ、光と謎めいた表情で称賛。',
        'painting_17_artist' => 'ヨハネス・フェルメール',
        'painting_17_year' => '1665',
        'painting_17_medium' => '油彩、キャンバス',
        'painting_17_location' => 'マウリッツハイス美術館、ハーグ',
        'painting_18_text' => 'アメリカン・ゴシック - グラント・ウッド',
        'painting_18_desc' => 'アメリカの田舎生活を風刺的だが写実的に描いた文化的アイコン。',
        'painting_18_artist' => 'グラント・ウッド',
        'painting_18_year' => '1930',
        'painting_18_medium' => '油彩、板',
        'painting_18_location' => 'シカゴ美術館',
        'painting_19_text' => '夜のカフェテラス - フィンセント・ファン・ゴッホ',
        'painting_19_desc' => 'フランス・アルルの夜のカフェを鮮やかに描き、感情的な共鳴を持つ。',
        'painting_19_artist' => 'フィンセント・ファン・ゴッホ',
        'painting_19_year' => '1888',
        'painting_19_medium' => '油彩、キャンバス',
        'painting_19_location' => 'クレラー・ミュラー美術館、オッテルロー',
        'painting_20_text' => '赤い部屋 - アンリ・マティス',
        'painting_20_desc' => '装飾的な構図とリズミカルな色彩パターンを持つフォーヴィスム作品。',
        'painting_20_artist' => 'アンリ・マティス',
        'painting_20_year' => '1908',
        'painting_20_medium' => '油彩、キャンバス',
        'painting_20_location' => 'エルミタージュ美術館、サンクトペテルブルク',
        'footer_copyright' => '© 2025 歴史、アート＆ファッション。全権利所有。'
    ],
    'hi' => [
            'meta_description' => 'HAF के साथ प्रतिष्ठित विश्व चित्रों की खोज करें, जो कालातीत कृतियों को प्रदर्शित करता है',
            'hero_title' => 'विश्व चित्र गैलरी',
            'hero_subtitle' => 'HAF के साथ प्रसिद्ध कलाकृतियों की सुंदरता का अन्वेषण करें',
            'nav_history' => 'इतिहास',
            'nav_art' => 'कला',
            'nav_world_paintings' => 'विश्व चित्र',
            'nav_famous_artists' => 'प्रसिद्ध कलाकार',
            'nav_art_game' => 'कला खेल',
            'nav_fashion' => 'फैशन',
            'nav_shop' => 'दुकान',
            'gallery_title' => 'प्रसिद्ध चित्र',
            'gallery_subtitle' => 'विश्व-प्रसिद्ध चित्रों का एक चयनित संग्रह',
            'modal_close' => 'बंद करें',
            'modal_artist' => 'कलाकार',
            'modal_year' => 'वर्ष',
            'modal_medium' => 'माध्यम',
            'modal_location' => 'स्थान',
            'view_single' => 'एकल चित्र देखें',
            'view_grid' => 'गैलरी ग्रिड देखें',
            'prev_painting' => 'पिछला',
            'next_painting' => 'अगला',
            'painting_1_text' => 'मोना लिसा - लियोनार्डो दा विंची',
            'painting_1_desc' => 'इतालवी पुनर्जागरण की उत्कृष्ट कृति, अपनी रहस्यमय मुस्कान और नज़र के प्रभाव के लिए प्रसिद्ध, यह सबसे प्रसिद्ध चित्रों में से एक है।',
            'painting_1_artist' => 'लियोनार्डो दा विंची',
            'painting_1_year' => '1503–1506',
            'painting_1_medium' => 'पॉपलर पैनल पर तेल',
            'painting_1_location' => 'लूव्र संग्रहालय, पेरिस',
            'painting_2_text' => 'द लास्ट सपर - लियोनार्डो दा विंची',
            'painting_2_desc' => 'यीशु और बारह प्रेरितों के अंतिम भोजन को दर्शाता है, जटिल रचना और तीव्र भावनाओं के साथ।',
            'painting_2_artist' => 'लियोनार्डो दा विंची',
            'painting_2_year' => '1495–1498',
            'painting_2_medium' => 'जिप्सम पर टेम्परा',
            'painting_2_location' => 'सांता मारिया डेल्ले ग्राज़ी, मिलान',
            'painting_3_text' => 'स्टारी नाइट - विंसेंट वैन गॉग',
            'painting_3_desc' => 'घूमते हुए रात के आकाश को गतिशील ऊर्जा और भावना के साथ दर्शाता है, जो पोस्ट-इंप्रेशनिज़्म का प्रतीक है।',
            'painting_3_artist' => 'विंसेंट वैन गॉग',
            'painting_3_year' => '1889',
            'painting_3_medium' => 'कैनवास पर तेल',
            'painting_3_location' => 'मॉडर्न आर्ट म्यूज़ियम, न्यूयॉर्क',
            'painting_4_text' => 'सनफ्लावर्स - विंसेंट वैन गॉग',
            'painting_4_desc' => 'एक श्रृंखला जो चमकीले पीले फूलों के माध्यम से जीवन शक्ति और व्यक्तिगत भावना को दर्शाती है।',
            'painting_4_artist' => 'विंसेंट वैन गॉग',
            'painting_4_year' => '1888',
            'painting_4_medium' => 'कैनवास पर तेल',
            'painting_4_location' => 'नेशनल गैलरी, लंदन',
            'painting_5_text' => 'द स्क्रीम - एडवर्ड मंच',
            'painting_5_desc' => 'प्रतीकवादी उत्कृष्ट कृति, जो एक विकृत आकृति और भयभीत अभिव्यक्ति के माध्यम से अस्तित्वगत चिंता को दर्शाती है।',
            'painting_5_artist' => 'एडवर्ड मंच',
            'painting_5_year' => '1893',
            'painting_5_medium' => 'कार्डबोर्ड पर टेम्परा और पेस्टल',
            'painting_5_location' => 'नेशनल गैलरी, ओस्लो',
            'painting_6_text' => 'लिबर्टी लीडिंग द पीपल - यूजीन डेलाक्रॉइक्स',
            'painting_6_desc' => '1830 की फ्रांसीसी जुलाई क्रांति की याद में, स्वतंत्रता झंडा पकड़े हुए है और शक्तिशाली प्रभाव डालती है।',
            'painting_6_artist' => 'यूजीन डेलाक्रॉइक्स',
            'painting_6_year' => '1830',
            'painting_6_medium' => 'कैनवास पर तेल',
            'painting_6_location' => 'लूव्र संग्रहालय, पेरिस',
            'painting_7_text' => 'नेपोलियन क्रॉसिंग द अल्प्स - जैक्स-लुई डेविड',
            'painting_7_desc' => 'नवशास्त्रीय कृति, जो नेपोलियन की वीरता और नेतृत्व को दर्शाती है।',
            'painting_7_artist' => 'जैक्स-लुई डेविड',
            'painting_7_year' => '1801',
            'painting_7_medium' => 'कैनवास पर तेल',
            'painting_7_location' => 'शैटो डी मालमेज़न, फ्रांस',
            'painting_8_text' => 'ए संडे आफ्टरनून ऑन द आइलैंड ऑफ ला ग्रांडे जैट - जॉर्जेस सुरा',
            'painting_8_desc' => 'पॉइंटिलिस्ट क्लासिक, जो छोटे बिंदुओं का उपयोग करके आधुनिक शहरी अवकाश को दर्शाता है।',
            'painting_8_artist' => 'जॉर्जेस सुरा',
            'painting_8_year' => '1884–1886',
            'painting_8_medium' => 'कैनवास पर तेल',
            'painting_8_location' => 'आर्ट इंस्टीट्यूट ऑफ शिकागो',
            'painting_9_text' => 'द क्रिएशन ऑफ एडम - माइकलएंजेलो',
            'painting_9_desc' => 'सिस्टिन चैपल की छत पर भित्तिचित्र, जिसमें भगवान और एडम की उंगलियाँ लगभग छू रही हैं, जो जीवन की चिंगारी का प्रतीक है।',
            'painting_9_artist' => 'माइकलएंजेलो',
            'painting_9_year' => '1512',
            'painting_9_medium' => 'भित्तिचित्र',
            'painting_9_location' => 'सिस्टिन चैपल, वेटिकन सिटी',
            'painting_10_text' => 'द बर्थ ऑफ वीनस - सैंड्रो बोटिचेली',
            'painting_10_desc' => 'प्रारंभिक पुनर्जागरण कृति, जो समुद्र से निकलती देवी वीनस के पौराणिक जन्म को दर्शाती है।',
            'painting_10_artist' => 'सैंड्रो बोटिचेली',
            'painting_10_year' => '1484–1486',
            'painting_10_medium' => 'कैनवास पर टेम्परा',
            'painting_10_location' => 'उफीजी गैलरी, फ्लोरेंस',
            'painting_11_text' => 'गुएर्निका - पाब्लो पिकासो',
            'painting_11_desc' => 'गुएर्निका की बमबारी के खिलाफ युद्ध-विरोधी विरोध, जिसमें कठोर मोनोक्रोम और अराजक रूपों का उपयोग किया गया है।',
            'painting_11_artist' => 'पाब्लो पिकासो',
            'painting_11_year' => '1937',
            'painting_11_medium' => 'कैनवास पर तेल',
            'painting_11_location' => 'रेना सोफिया संग्रहालय, मैड्रिड',
            'painting_12_text' => 'द एंजेलस - जीन-फ्रांस्वा मिले',
            'painting_12_desc' => 'खेतों में प्रार्थना करते हुए किसानों को दर्शाता है, जिसमें धार्मिक और श्रम की गरिमा के विषय हैं।',
            'painting_12_artist' => 'जीन-फ्रांस्वा मिले',
            'painting_12_year' => '1857–1859',
            'painting_12_medium' => 'कैनवास पर तेल',
            'painting_12_location' => 'म्यूज़ी डी ऑर्से, पेरिस',
            'painting_13_text' => 'द ग्लीनर्स - जीन-फ्रांस्वा मिले',
            'painting_13_desc' => 'गरीब महिलाओं को बचे हुए अनाज इकट्ठा करते हुए दिखाता है, जो श्रम और सामाजिक वर्ग का प्रतीक है।',
            'painting_13_artist' => 'जीन-फ्रांस्वा मिले',
            'painting_13_year' => '1857',
            'painting_13_medium' => 'कैनवास पर तेल',
            'painting_13_location' => 'म्यूज़ी डी ऑर्से, पेरिस',
            'painting_14_text' => 'द फिफर - एडुआर्ड माने',
            'painting_14_desc' => 'फ्लैट पृष्ठभूमि और बोल्ड रंगों के साथ प्रभाववादी कृति, जो एक युवा सैन्य संगीतकार को दर्शाती है।',
            'painting_14_artist' => 'एडुआर्ड माने',
            'painting_14_year' => '1866',
            'painting_14_medium' => 'कैनवास पर तेल',
            'painting_14_location' => 'म्यूज़ी डी ऑर्से, पेरिस',
            'painting_15_text' => 'द डांस क्लास - एडगर डेगास',
            'painting_15_desc' => 'बैले अभ्यास के क्षणों को पकड़ता है, जिसमें गति और शहरी महिला जीवन को उजागर किया गया है।',
            'painting_15_artist' => 'एडगर डेगास',
            'painting_15_year' => '1874',
            'painting_15_medium' => 'कैनवास पर तेल',
            'painting_15_location' => 'मेट्रोपॉलिटन म्यूज़ियम ऑफ आर्ट, न्यूयॉर्क',
            'painting_16_text' => 'द नाइट वॉच - रेम्ब्रांट',
            'painting_16_desc' => 'डच गोल्डन एज की उत्कृष्ट कृति, जिसमें नाटकीय प्रकाश का उपयोग करके नागरिक गार्ड पेट्रोल को दर्शाया गया है।',
            'painting_16_artist' => 'रेम्ब्रांट वैन रिजन',
            'painting_16_year' => '1642',
            'painting_16_medium' => 'कैनवास पर तेल',
            'painting_16_location' => 'रिज्क्सम्यूज़ियम, एम्स्टर्डम',
            'painting_17_text' => 'गर्ल विद ए पर्ल ईयररिंग - जोहान्स वर्मीर',
            'painting_17_desc' => '"उत्तर की मोना लिसा" के रूप में जानी जाती है, अपने प्रकाश और रहस्यमय अभिव्यक्ति के लिए प्रसिद्ध।',
            'painting_17_artist' => 'जोहान्स वर्मीर',
            'painting_17_year' => '1665',
            'painting_17_medium' => 'कैनवास पर तेल',
            'painting_17_location' => 'मॉरिट्सहुइस, हेग',
            'painting_18_text' => 'अमेरिकन गॉथिक - ग्रांट वुड',
            'painting_18_desc' => 'अमेरिकी ग्रामीण जीवन का व्यंग्यात्मक लेकिन यथार्थवादी चित्रण, एक सांस्कृतिक प्रतीक।',
            'painting_18_artist' => 'ग्रांट वुड',
            'painting_18_year' => '1930',
            'painting_18_medium' => 'बीवरबोर्ड पर तेल',
            'painting_18_location' => 'आर्ट इंस्टीट्यूट ऑफ शिकागो',
            'painting_19_text' => 'कैफे टैरेस एट नाइट - विंसेंट वैन गॉग',
            'painting_19_desc' => 'फ्रांस के आर्ल्स में एक रात के कैफे का जीवंत चित्रण, जिसमें भावनात्मक गूंज है।',
            'painting_19_artist' => 'विंसेंट वैन गॉग',
            'painting_19_year' => '1888',
            'painting_19_medium' => 'कैनवास पर तेल',
            'painting_19_location' => 'क्रोलर-मुलर म्यूज़ियम, ओटरलो',
            'painting_20_text' => 'द रेड रूम - हेनरी मैटिस',
            'painting_20_desc' => 'फॉविस्ट कृति, जिसमें सजावटी रचना और लयबद्ध रंग पैटर्न हैं।',
            'painting_20_artist' => 'हेनरी मैटिस',
            'painting_20_year' => '1908',
            'painting_20_medium' => 'कैनवास पर तेल',
            'painting_20_location' => 'एर्मिटाज संग्रहालय, सेंट पीटर्सबर्ग',
            'footer_copyright' => '© 2025 इतिहास, कला और फैशन। सर्वाधिकार सुरक्षित।'
    ],
    'ms' => [
        'meta_description' => 'Temui lukisan ikonik dunia dengan HAF, memaparkan karya agung abadi',
        'hero_title' => 'Galeri Lukisan Dunia',
        'hero_subtitle' => 'Terokai keindahan karya seni terkenal bersama HAF',
        'nav_history' => 'Sejarah',
        'nav_art' => 'Seni',
        'nav_world_paintings' => 'Lukisan Dunia',
        'nav_famous_artists' => 'Artis Terkenal',
        'nav_art_game' => 'Permainan Seni',
        'nav_fashion' => 'Fesyen',
        'nav_shop' => 'Kedai',
        'gallery_title' => 'Lukisan Ikonik',
        'gallery_subtitle' => 'Koleksi terpilih lukisan terkenal dunia',
        'modal_close' => 'Tutup',
        'modal_artist' => 'Artis',
        'modal_year' => 'Tahun',
        'modal_medium' => 'Medium',
        'modal_location' => 'Lokasi',
        'view_single' => 'Lihat Lukisan Tunggal',
        'view_grid' => 'Lihat Galeri',
        'prev_painting' => 'Sebelum',
        'next_painting' => 'Seterusnya',
        'painting_1_text' => 'Mona Lisa - Leonardo da Vinci',
        'painting_1_desc' => 'Karya agung Renaissance Itali, terkenal dengan senyuman misteri dan kesan pandangan yang mengikuti, salah satu potret paling terkenal.',
        'painting_1_artist' => 'Leonardo da Vinci',
        'painting_1_year' => '1503–1506',
        'painting_1_medium' => 'Minyak di atas panel poplar',
        'painting_1_location' => 'Muzium Louvre, Paris',
        'painting_2_text' => 'The Last Supper - Leonardo da Vinci',
        'painting_2_desc' => 'Menggambarkan Yesus dan dua belas rasul pada makan malam terakhir mereka, dengan komposisi rumit dan ketegangan emosi yang mendalam.',
        'painting_2_artist' => 'Leonardo da Vinci',
        'painting_2_year' => '1495–1498',
        'painting_2_medium' => 'Tempera di atas gesso',
        'painting_2_location' => 'Santa Maria delle Grazie, Milan',
        'painting_3_text' => 'Starry Night - Vincent van Gogh',
        'painting_3_desc' => 'Menangkap langit malam berpusar dengan tenaga dinamik dan emosi, lambang Pascaimpresionisme.',
        'painting_3_artist' => 'Vincent van Gogh',
        'painting_3_year' => '1889',
        'painting_3_medium' => 'Minyak di atas kanvas',
        'painting_3_location' => 'Muzium Seni Moden, New York',
        'painting_4_text' => 'Sunflowers - Vincent van Gogh',
        'painting_4_desc' => 'Siri yang mempamerkan tenaga hidup yang bertenaga dan emosi peribadi melalui bunga kuning terang.',
        'painting_4_artist' => 'Vincent van Gogh',
        'painting_4_year' => '1888',
        'painting_4_medium' => 'Minyak di atas kanvas',
        'painting_4_location' => 'Galeri Nasional, London',
        'painting_5_text' => 'The Scream - Edvard Munch',
        'painting_5_desc' => 'Karya agung simbolis, menggambarkan keresahan eksistensial melalui figura terdistorsi dan ekspresi ketakutan.',
        'painting_5_artist' => 'Edvard Munch',
        'painting_5_year' => '1893',
        'painting_5_medium' => 'Tempera dan pastel di atas kadbod',
        'painting_5_location' => 'Galeri Nasional, Oslo',
        'painting_6_text' => 'Liberty Leading the People - Eugène Delacroix',
        'painting_6_desc' => 'Memperingati Revolusi Julai 1830 Perancis, dengan Liberty memegang bendera, memberi impak yang kuat.',
        'painting_6_artist' => 'Eugène Delacroix',
        'painting_6_year' => '1830',
        'painting_6_medium' => 'Minyak di atas kanvas',
        'painting_6_location' => 'Muzium Louvre, Paris',
        'painting_7_text' => 'Napoleon Crossing the Alps - Jacques-Louis David',
        'painting_7_desc' => 'Karya neoklasik yang menekankan kehadiran heroik dan berwibawa Napoleon.',
        'painting_7_artist' => 'Jacques-Louis David',
        'painting_7_year' => '1801',
        'painting_7_medium' => 'Minyak di atas kanvas',
        'painting_7_location' => 'Château de Malmaison, Perancis',
        'painting_8_text' => 'A Sunday Afternoon on the Island of La Grande Jatte - Georges Seurat',
        'painting_8_desc' => 'Klasik pointilisme, menggunakan titik-titik kecil untuk menggambarkan masa lapang bandar moden.',
        'painting_8_artist' => 'Georges Seurat',
        'painting_8_year' => '1884–1886',
        'painting_8_medium' => 'Minyak di atas kanvas',
        'painting_8_location' => 'Institut Seni Chicago',
        'painting_9_text' => 'The Creation of Adam - Michelangelo',
        'painting_9_desc' => 'Fresco siling Kapel Sistina, menunjukkan jari Tuhan dan Adam hampir bersentuhan, melambangkan percikan kehidupan.',
        'painting_9_artist' => 'Michelangelo',
        'painting_9_year' => '1512',
        'painting_9_medium' => 'Fresco',
        'painting_9_location' => 'Kapel Sistina, Kota Vatican',
        'painting_10_text' => 'The Birth of Venus - Sandro Botticelli',
        'painting_10_desc' => 'Karya Renaissance awal yang menggambarkan kelahiran mitos Venus yang muncul dari laut.',
        'painting_10_artist' => 'Sandro Botticelli',
        'painting_10_year' => '1484–1486',
        'painting_10_medium' => 'Tempera di atas kanvas',
        'painting_10_location' => 'Galeri Uffizi, Florence',
        'painting_11_text' => 'Guernica - Pablo Picasso',
        'painting_11_desc' => 'Protes anti-perang terhadap pengeboman Guernica, menggunakan monokrom yang ketara dan bentuk kacau.',
        'painting_11_artist' => 'Pablo Picasso',
        'painting_11_year' => '1937',
        'painting_11_medium' => 'Minyak di atas kanvas',
        'painting_11_location' => 'Museo Reina Sofía, Madrid',
        'painting_12_text' => 'The Angelus - Jean-François Millet',
        'painting_12_desc' => 'Menggambarkan petani berdoa di ladang, penuh dengan tema keagamaan dan maruah kerja.',
        'painting_12_artist' => 'Jean-François Millet',
        'painting_12_year' => '1857–1859',
        'painting_12_medium' => 'Minyak di atas kanvas',
        'painting_12_location' => 'Paris, Musée d\'Orsay',
        'painting_13_text' => 'The Gleaners - Jean-François Millet',
        'painting_13_desc' => 'Menunjukkan wanita miskin mengutip bijirin yang tertinggal, melambangkan kerja dan kelas sosial.',
        'painting_13_artist' => 'Jean-François Millet',
        'painting_13_year' => '1857',
        'painting_13_medium' => 'Minyak di atas kanvas',
        'painting_13_location' => 'Paris, Musée d\'Orsay',
        'painting_14_text' => 'The Fifer - Édouard Manet',
        'painting_14_desc' => 'Karya impresionis dengan latar belakang rata dan warna berani, menggambarkan pemuzik tentera muda.',
        'painting_14_artist' => 'Édouard Manet',
        'painting_14_year' => '1866',
        'painting_14_medium' => 'Minyak di atas kanvas',
        'painting_14_location' => 'Paris, Musée d\'Orsay',
        'painting_15_text' => 'The Dance Class - Edgar Degas',
        'painting_15_desc' => 'Menangkap detik latihan balet, menonjolkan pergerakan dan kehidupan wanita bandar.',
        'painting_15_artist' => 'Edgar Degas',
        'painting_15_year' => '1874',
        'painting_15_medium' => 'Minyak di atas kanvas',
        'painting_15_location' => 'New York, Metropolitan Museum of Art',
        'painting_16_text' => 'The Night Watch - Rembrandt',
        'painting_16_desc' => 'Karya agung Zaman Keemasan Belanda, menggunakan cahaya dramatik untuk menggambarkan rondaan pengawal sivik.',
        'painting_16_artist' => 'Rembrandt van Rijn',
        'painting_16_year' => '1642',
        'painting_16_medium' => 'Minyak di atas kanvas',
        'painting_16_location' => 'Amsterdam, Rijksmuseum',
        'painting_17_text' => 'Girl with a Pearl Earring - Johannes Vermeer',
        'painting_17_desc' => 'Dikenali sebagai "Mona Lisa dari Utara," diraikan kerana cahaya dan ekspresi misterinya.',
        'painting_17_artist' => 'Johannes Vermeer',
        'painting_17_year' => '1665',
        'painting_17_medium' => 'Minyak di atas kanvas',
        'painting_17_location' => 'The Hague, Mauritshuis',
        'painting_18_text' => 'American Gothic - Grant Wood',
        'painting_18_desc' => 'Gambaran satira namun realistik kehidupan luar bandar Amerika, ikon budaya.',
        'painting_18_artist' => 'Grant Wood',
        'painting_18_year' => '1930',
        'painting_18_medium' => 'Minyak di atas papan beaver',
        'painting_18_location' => 'Chicago, Art Institute of Chicago',
        'painting_19_text' => 'Café Terrace at Night - Vincent van Gogh',
        'painting_19_desc' => 'Lebendige Darstellung eines Nachtcafés in Arles, Frankreich, mit emotionaler Resonanz.',
        'painting_19_artist' => 'Vincent van Gogh',
        'painting_19_year' => '1888',
        'painting_19_medium' => 'Minyak di atas kanvas',
        'painting_19_location' => 'Otterlo, Kröller-Müller Museum',
        'painting_20_text' => 'The Red Room - Henri Matisse',
        'painting_20_desc' => 'Karya Fauvist dengan komposisi hiasan dan corak warna berirama.',
        'painting_20_artist' => 'Henri Matisse',
        'painting_20_year' => '1908',
        'painting_20_medium' => 'Minyak di atas kanvas',
        'painting_20_location' => 'St. Petersburg, Hermitage Museum',
        'footer_copyright' => '© 2025 Sejarah, Seni & Fesyen. Hak cipta terpelihara.'
    ],
];

// Placeholder image
$placeholder_image = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8DwHwAEhQGAaR9lOQAAAABJRU5ErkJggg==';

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
    <title>HAF - <?php echo htmlspecialchars(get_translation($current_lang, 'gallery_title')); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;700&family=Source+Sans+Pro:wght@400;700&family=Libre+Baskerville&family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
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
            --accent-blue: #B8E0FF;
            --accent-pink: #FFD6E0;
            --gradient: linear-gradient(135deg, var(--papaya-whip) 0%, var(--snow) 100%);
            --shadow-normal: 0 4px 16px rgba(0,0,0,0.10);
            --shadow-hover: 0 8px 32px rgba(0,0,0,0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--charcoal);
            direction: <?php echo $site_dir; ?>;
            line-height: 1.6;
            min-height: 100vh;
            background: var(--custom-light);
            transition: background 0.3s, color 0.3s;
        }

        .container {
            max-width: 1200px;
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
            flex-wrap: wrap;
        }

        nav a {
            color: var(--charcoal);
            text-decoration: none;
            margin: 0 12px;
            font-family: 'Raleway', sans-serif;
            font-size: 1.3rem;
        }

        nav a:hover {
            color: var(--ivory);
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

        .hero {
            background: var(--gradient);
            color: var(--charcoal);
            text-align: center;
            padding: 100px 20px;
            border-bottom: 5px solid var(--ivory);
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            font-family: 'Libre Baskerville', serif;
            animation: fadeInDown 1s;
            color: var(--charcoal);
        }

        .hero p {
            font-size: 1.5rem;
            margin-bottom: 30px;
        }

        section {
            padding: 60px 0;
            border-bottom: 1px solid var(--ivory);
        }

        section h2 {
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 20px;
            color: var(--papaya-whip);
            font-family: 'Libre Baskerville', serif;
        }

        section p.subtitle {
            text-align: center;
            font-size: 1.2rem;
            margin-bottom: 40px;
            color: #555;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .gallery-item {
            overflow: hidden;
            border-radius: 8px;
            background: linear-gradient(45deg, rgba(255, 214, 232, 0.3), rgba(209, 245, 255, 0.3));
            padding: 10px;
        }

        .frame {
            position: relative;
            padding: 15px;
            background: linear-gradient(45deg, #d4af37, #f0c05a);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3), inset 0 0 5px rgba(255,255,255,0.5);
            border-radius: 6px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .frame:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.4);
        }

        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
            filter: brightness(1.1);
            transition: transform 0.3s;
            border-radius: 4px;
            cursor: pointer;
        }

        .gallery-item img:hover {
            transform: scale(1.05);
        }

        .gallery-item .text-container {
            padding: 10px;
            background: rgba(255, 251, 245, 0.8);
            text-align: center;
            border-radius: 4px;
            margin-top: 10px;
        }

        .gallery-item p.title {
            color: var(--charcoal);
            font-style: italic;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .gallery-item p.description {
            color: #555;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .single-painting {
            display: none;
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }

        .single-painting .frame {
            padding: 20px;
            background: linear-gradient(45deg, #d4af37, #f0c05a, #d4af37);
            box-shadow: 0 10px 25px rgba(0,0,0,0.4);
        }

        .single-painting img {
            width: 100%;
            max-height: 400px;
            object-fit: contain;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .single-painting .text-container {
            background: rgba(255, 251, 245, 0.9);
            padding: 15px;
            border-radius: 4px;
        }

        .navigation-buttons {
            margin: 20px 0;
        }

        .navigation-buttons button {
            padding: 10px 20px;
            margin: 0 10px;
            background: var(--papaya-whip);
            border: none;
            border-radius: 4px;
            color: var(--charcoal);
            font-family: 'Source Sans Pro', sans-serif;
            cursor: pointer;
            transition: background 0.3s;
        }

        .navigation-buttons button:hover {
            background: var(--ivory);
        }

        .view-toggle {
            text-align: center;
            margin-bottom: 20px;
        }

        .view-toggle button {
            padding: 10px 20px;
            background: var(--ivory);
            border: none;
            border-radius: 4px;
            color: var(--charcoal);
            font-family: 'Source Sans Pro', sans-serif;
            cursor: pointer;
            transition: background 0.3s;
        }

        .view-toggle button:hover {
            background: var(--accent-pink);
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            z-index: 2000;
            justify-content: center;
            align-items: center;
            overflow: auto;
            padding: 20px;
        }

        .modal-content {
            background: linear-gradient(145deg, #fffbf5, #f0f0f0);
            max-width: 900px;
            width: 90%;
            border-radius: 12px;
            padding: 30px;
            position: relative;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            border: 2px solid #d4af37;
            animation: fadeIn 0.4s ease-in-out;
            transition: transform 0.3s ease;
        }

        .modal-content:hover {
            transform: scale(1.02);
        }

        .modal-content img {
            width: 100%;
            max-height: 600px;
            object-fit: contain;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 3px solid #d4af37;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .modal-content h3 {
            font-family: 'Libre Baskerville', serif;
            font-size: 2rem;
            color: var(--charcoal);
            margin-bottom: 15px;
        }

        .modal-content p {
            font-size: 1.1rem;
            color: #444;
            margin-bottom: 12px;
        }

        .modal-content .close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 2rem;
            color: var(--charcoal);
            cursor: pointer;
            transition: color 0.3s;
        }

        .modal-content .close:hover {
            color: var(--ivory);
        }

        footer {
            background: var(--ivory);
            color: var(--charcoal);
            text-align: center;
            padding: 20px 0;
        }

        @media (max-width: 768px) {
            .gallery-item img {
                height: 150px;
            }

            .gallery-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }

            .single-painting img {
                max-height: 300px;
            }

            .modal-content img {
                max-height: 450px;
            }

            .modal-content {
                padding: 20px;
            }

            .modal-content h3 {
                font-size: 1.5rem;
            }

            .modal-content p {
                font-size: 1rem;
            }
        }

        .nav-logo {
            height: 40px;
            margin-right: 20px;
            vertical-align: middle;
        }

        .logo-link {
            display: inline-block;
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <nav>
        <div class="container">
            <div>
                <a href="history.php" class="logo-link">
                    <img src="images/historylogo" alt="HAF Logo" class="nav-logo">
                </a>
                <a href="history.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_history')); ?></a>
                <a href="art.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_art')); ?></a>
                <a href="world_paintings.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_world_paintings')); ?></a>
                <a href="famous_artists.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_famous_artists')); ?></a>
                <a href="art_game.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_art_game')); ?></a>
                <a href="fashion.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_fashion')); ?></a>
                <a href="php/shop.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_shop')); ?></a>
            </div>
            <form method="POST">
                <select name="lang" onchange="this.form.submit()">
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
        </div>
    </nav>

    <header class="hero">
        <div class="container">
            <h1 class="animate__animated animate__fadeInDown"><?php echo htmlspecialchars(get_translation($current_lang, 'hero_title')); ?></h1>
            <p><?php echo htmlspecialchars(get_translation($current_lang, 'hero_subtitle')); ?></p>
        </div>
    </header>

    <section id="gallery">
        <div class="container">
            <h2><?php echo htmlspecialchars(get_translation($current_lang, 'gallery_title')); ?></h2>
            <p class="subtitle"><?php echo htmlspecialchars(get_translation($current_lang, 'gallery_subtitle')); ?></p>
            <div class="view-toggle">
                <button id="viewSingleBtn"><?php echo htmlspecialchars(get_translation($current_lang, 'view_single')); ?></button>
                <button id="viewGridBtn"><?php echo htmlspecialchars(get_translation($current_lang, 'view_grid')); ?></button>
            </div>
            <div class="gallery-grid" id="galleryGrid">
                <!-- Painting 1: Mona Lisa - Leonardo da Vinci -->
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/monalisa/1.jpg" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'painting_1_text')); ?>" onerror="this.src='<?php echo $placeholder_image; ?>'" data-index="1" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_1_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_1_desc')); ?></p>
                    </div>
                </div>
                <!-- Painting 2: The Last Supper - Leonardo da Vinci -->
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/monalisa/2.jpg" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'painting_2_text')); ?>" onerror="this.src='<?php echo $placeholder_image; ?>'" data-index="2" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_2_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_2_desc')); ?></p>
                    </div>
                </div>
                <!-- Painting 3: Starry Night - Vincent van Gogh -->
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/monalisa/3.jpg" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'painting_3_text')); ?>" onerror="this.src='<?php echo $placeholder_image; ?>'" data-index="3" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_3_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_3_desc')); ?></p>
                    </div>
                </div>
                <!-- Painting 4: Sunflowers - Vincent van Gogh -->
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/monalisa/4.jpg" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'painting_4_text')); ?>" onerror="this.src='<?php echo $placeholder_image; ?>'" data-index="4" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_4_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_4_desc')); ?></p>
                    </div>
                </div>
                <!-- Painting 5: The Scream - Edvard Munch -->
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/monalisa/5.jpeg" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'painting_5_text')); ?>" onerror="this.src='<?php echo $placeholder_image; ?>'" data-index="5" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_5_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_5_desc')); ?></p>
                    </div>
                </div>
                <!-- Painting 6: Liberty Leading the People - Eugène Delacroix -->
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/monalisa/6.jpg" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'painting_6_text')); ?>" onerror="this.src='<?php echo $placeholder_image; ?>'" data-index="6" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_6_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_6_desc')); ?></p>
                    </div>
                </div>
                <!-- Painting 7: Napoleon Crossing the Alps - Jacques-Louis David -->
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/monalisa/7.jpg" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'painting_7_text')); ?>" onerror="this.src='<?php echo $placeholder_image; ?>'" data-index="7" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_7_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_7_desc')); ?></p>
                    </div>
                </div>
                <!-- Painting 8: A Sunday Afternoon - Georges Seurat -->
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/monalisa/8.webp" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'painting_8_text')); ?>" onerror="this.src='<?php echo $placeholder_image; ?>'" data-index="8" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_8_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_8_desc')); ?></p>
                    </div>
                </div>
                <!-- Painting 9: The Creation of Adam - Michelangelo -->
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/monalisa/9.jpg" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'painting_9_text')); ?>" onerror="this.src='<?php echo $placeholder_image; ?>'" data-index="9" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_9_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_9_desc')); ?></p>
                    </div>
                </div>
                <!-- Painting 10: The Birth of Venus - Sandro Botticelli -->
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/monalisa/10.jpg" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'painting_10_text')); ?>" onerror="this.src='<?php echo $placeholder_image; ?>'" data-index="10" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_10_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_10_desc')); ?></p>
                    </div>
                </div>
                <!-- Painting 11: Guernica - Pablo Picasso -->
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/monalisa/11.jpg" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'painting_11_text')); ?>" onerror="this.src='<?php echo $placeholder_image; ?>'" data-index="11" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_11_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_11_desc')); ?></p>
                    </div>
                </div>
                <!-- Painting 12: The Angelus - Jean-François Millet -->
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/monalisa/12.jpeg" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'painting_12_text')); ?>" onerror="this.src='<?php echo $placeholder_image; ?>'" data-index="12" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_12_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_12_desc')); ?></p>
                    </div>
                </div>
                <!-- Painting 13: The Gleaners - Jean-François Millet -->
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/monalisa/13.webp" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'painting_13_text')); ?>" onerror="this.src='<?php echo $placeholder_image; ?>'" data-index="13" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_13_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_13_desc')); ?></p>
                    </div>
                </div>
                <!-- Painting 14: The Fifer - Édouard Manet -->
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/monalisa/14.jpeg" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'painting_14_text')); ?>" onerror="this.src='<?php echo $placeholder_image; ?>'" data-index="14" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_14_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_14_desc')); ?></p>
                    </div>
                </div>
                <!-- Painting 15: The Dance Class - Edgar Degas -->
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/monalisa/15.jpeg" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'painting_15_text')); ?>" onerror="this.src='<?php echo $placeholder_image; ?>'" data-index="15" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_15_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_15_desc')); ?></p>
                    </div>
                </div>
                <!-- Painting 16: The Night Watch - Rembrandt -->
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/monalisa/16.jpg" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'painting_16_text')); ?>" onerror="this.src='<?php echo $placeholder_image; ?>'" data-index="16" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_16_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_16_desc')); ?></p>
                    </div>
                </div>
                <!-- Painting 17: Girl with a Pearl Earring - Johannes Vermeer -->
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/monalisa/17.jpeg" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'painting_17_text')); ?>" onerror="this.src='<?php echo $placeholder_image; ?>'" data-index="17" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_17_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_17_desc')); ?></p>
                    </div>
                </div>
                <!-- Painting 18: American Gothic - Grant Wood -->
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/monalisa/18.jpeg" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'painting_18_text')); ?>" onerror="this.src='<?php echo $placeholder_image; ?>'" data-index="18" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_18_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_18_desc')); ?></p>
                    </div>
                </div>
                <!-- Painting 19: Café Terrace at Night - Vincent van Gogh -->
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/monalisa/19.jpeg" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'painting_19_text')); ?>" onerror="this.src='<?php echo $placeholder_image; ?>'" data-index="19" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_19_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_19_desc')); ?></p>
                    </div>
                </div>
                <!-- Painting 20: The Red Room - Henri Matisse -->
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/monalisa/20.jpeg" alt="<?php echo htmlspecialchars(get_translation($current_lang, 'painting_20_text')); ?>" onerror="this.src='<?php echo $placeholder_image; ?>'" data-index="20" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_20_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'painting_20_desc')); ?></p>
                    </div>
                </div>
            </div>
            <div class="single-painting" id="singlePainting">
                <div class="frame">
                    <img id="singleImg" src="" alt="" onerror="this.src='<?php echo $placeholder_image; ?>'">
                </div>
                <div class="text-container">
                    <p class="title" id="singleTitle"></p>
                    <p class="description" id="singleDesc"></p>
                </div>
                <div class="navigation-buttons">
                    <button id="prevBtn"><?php echo htmlspecialchars(get_translation($current_lang, 'prev_painting')); ?></button>
                    <button id="nextBtn"><?php echo htmlspecialchars(get_translation($current_lang, 'next_painting')); ?></button>
                </div>
            </div>
        </div>
    </section>

    <div class="modal" id="modal">
        <div class="modal-content">
            <span class="close">×</span>
            <img id="modalImg" src="" alt="">
            <h3 id="modalTitle"></h3>
            <p id="modalDesc"></p>
            <p id="modalArtist"></p>
            <p id="modalYear"></p>
            <p id="modalMedium"></p>
            <p id="modalLocation"></p>
        </div>
    </div>

    <footer>
        <div class="container">
            <p><?php echo htmlspecialchars(get_translation($current_lang, 'footer_copyright')); ?></p>
        </div>
    </footer>

    <script>
        // Gallery functionality
        const galleryGrid = document.getElementById('galleryGrid');
        const singlePainting = document.getElementById('singlePainting');
        const viewSingleBtn = document.getElementById('viewSingleBtn');
        const viewGridBtn = document.getElementById('viewGridBtn');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const modal = document.getElementById('modal');
        const modalImg = document.getElementById('modalImg');
        const modalTitle = document.getElementById('modalTitle');
        const modalDesc = document.getElementById('modalDesc');
        const modalArtist = document.getElementById('modalArtist');
        const modalYear = document.getElementById('modalYear');
        const modalMedium = document.getElementById('modalMedium');
        const modalLocation = document.getElementById('modalLocation');
        const closeModal = document.querySelector('.close');
        const totalPaintings = 20;
        let currentIndex = 1;

        // Data for translations (to avoid PHP in JS)
        const translations = <?php echo json_encode($translations, JSON_UNESCAPED_UNICODE); ?>;
        const currentLang = '<?php echo $current_lang; ?>';

        // Function to show single painting
        function showPainting(index) {
            const img = document.getElementById('singleImg');
            const title = document.getElementById('singleTitle');
            const desc = document.getElementById('singleDesc');
            // Get the corresponding image element from the gallery grid
            const galleryImg = document.querySelector(`.painting-img[data-index="${index}"]`);
            if (galleryImg) {
                img.src = galleryImg.src;
                img.alt = translations[currentLang][`painting_${index}_text`];
            } else {
                img.src = '<?php echo $placeholder_image; ?>';
                img.alt = 'Image not found';
            }
            title.textContent = translations[currentLang][`painting_${index}_text`];
            desc.textContent = translations[currentLang][`painting_${index}_desc`];
        }

        // View toggle
        viewSingleBtn.addEventListener('click', () => {
            galleryGrid.style.display = 'none';
            singlePainting.style.display = 'block';
            showPainting(currentIndex);
        });

        viewGridBtn.addEventListener('click', () => {
            singlePainting.style.display = 'none';
            galleryGrid.style.display = 'grid';
        });

        // Navigation
        prevBtn.addEventListener('click', () => {
            currentIndex = currentIndex === 1 ? totalPaintings : currentIndex - 1;
            showPainting(currentIndex);
        });

        nextBtn.addEventListener('click', () => {
            currentIndex = currentIndex === totalPaintings ? 1 : currentIndex + 1;
            showPainting(currentIndex);
        });

        // Modal handling
        document.querySelectorAll('.painting-img').forEach(img => {
            img.addEventListener('click', () => {
                currentIndex = parseInt(img.getAttribute('data-index'));
                modalImg.src = img.src;
                modalImg.alt = translations[currentLang][`painting_${currentIndex}_text`];
                modalTitle.textContent = translations[currentLang][`painting_${currentIndex}_text`];
                modalDesc.textContent = translations[currentLang][`painting_${currentIndex}_desc`];
                modalArtist.textContent = `${translations[currentLang]['modal_artist']}: ${translations[currentLang][`painting_${currentIndex}_artist`]}`;
                modalYear.textContent = `${translations[currentLang]['modal_year']}: ${translations[currentLang][`painting_${currentIndex}_year`]}`;
                modalMedium.textContent = `${translations[currentLang]['modal_medium']}: ${translations[currentLang][`painting_${currentIndex}_medium`]}`;
                modalLocation.textContent = `${translations[currentLang]['modal_location']}: ${translations[currentLang][`painting_${currentIndex}_location`]}`;
                modal.style.display = 'flex';
            });
        });

        // Close modal
        closeModal.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        // Close modal when clicking outside
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (singlePainting.style.display === 'block') {
                if (e.key === 'ArrowLeft') {
                    prevBtn.click();
                } else if (e.key === 'ArrowRight') {
                    nextBtn.click();
                }
            }
            if (e.key === 'Escape' && modal.style.display === 'flex') {
                modal.style.display = 'none';
            }
        });
    </script>
</body>
</html>