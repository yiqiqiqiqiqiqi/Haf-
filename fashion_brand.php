<?php
session_start();

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'zh';
}

// Handle language switching before any output
if (isset($_POST['lang'])) {
    $valid_langs = ['en', 'zh', 'es', 'ar', 'fr', 'ru', 'pt', 'de', 'ja', 'hi'];
    $_SESSION['lang'] = in_array($_POST['lang'], $valid_langs) ? $_POST['lang'] : 'zh';
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
}

$current_lang = $_SESSION['lang'];
$site_dir = $current_lang === 'ar' ? 'rtl' : 'ltr';

// Translation array
$translations = [
    'en' => [
        'meta_description' => 'Explore iconic fashion brands with HAF, celebrating style and innovation',
        'brands_title' => 'Iconic Fashion Brands',
        'brands_subtitle' => 'Discover the legacy of the world\'s most influential fashion houses',
        'nav_home' => 'Home',
        'nav_brands' => 'Brands',
        'nav_history' => 'History',
        'nav_art' => 'Art',
        'nav_fashion' => 'Fashion',
        'nav_shop' => 'Shop',
        'learn_more' => 'Learn More',
        'visit_website' => 'Visit Official Website',
        'footer_copyright' => '© 2025 History, Art & Fashion. All rights reserved.',
        'brand_1_title' => 'Chanel',
        'brand_1_desc' => 'Known for timeless elegance and the iconic little black dress.',
        'brand_1_detail' => 'Chanel revolutionized fashion with its minimalist elegance, introducing the little black dress and Chanel No. 5 perfume, embodying sophistication and luxury.',
        'brand_2_title' => 'Gucci',
        'brand_2_desc' => 'Celebrated for bold designs and luxurious Italian craftsmanship.',
        'brand_2_detail' => 'Gucci is renowned for its eclectic and vibrant designs, blending traditional Italian craftsmanship with contemporary flair, influencing global fashion trends.',
        'brand_3_title' => 'Louis Vuitton',
        'brand_3_desc' => 'Renowned for its monogrammed luggage and high-fashion accessories.',
        'brand_3_detail' => 'Louis Vuitton is synonymous with luxury travel, offering iconic monogrammed luggage and innovative accessories that define high fashion.',
        'brand_4_title' => 'Dior',
        'brand_4_desc' => 'Famous for feminine silhouettes and revolutionary New Look.',
        'brand_4_detail' => 'Dior transformed post-war fashion with its New Look, emphasizing feminine silhouettes and luxurious fabrics, setting a standard for elegance.',
        'brand_11_title' => 'Balenciaga',
        'brand_11_desc' => 'Known for avant-garde designs and innovative silhouettes.',
        'brand_11_detail' => 'Balenciaga revolutionized fashion with its architectural designs and innovative approach to silhouette, becoming a symbol of modern luxury.',
        'brand_12_title' => 'Burberry',
        'brand_12_desc' => 'Famous for its iconic trench coats and check pattern.',
        'brand_12_detail' => 'Burberry heritage lies in its timeless trench coats and distinctive check pattern, blending tradition with contemporary style.',
        'brand_13_title' => 'Valentino',
        'brand_13_desc' => 'Renowned for romantic designs and signature red gowns.',
        'brand_13_detail' => 'Valentino is celebrated for its romantic aesthetic and vibrant red dresses, embodying elegance and passion in high fashion.',
        'brand_14_title' => 'Givenchy',
        'brand_14_desc' => 'Known for refined elegance and iconic designs.',
        'brand_14_detail' => 'Givenchy blends aristocratic elegance with modern simplicity, creating iconic pieces worn by style icons like Audrey Hepburn.',
        'brand_15_title' => 'Saint Laurent',
        'brand_15_desc' => 'Famous for edgy sophistication and rock-chic style.',
        'brand_15_detail' => 'Saint Laurent combines Parisian elegance with a rebellious edge, defining modern luxury with its rock-inspired aesthetic.',
        'brand_16_title' => 'Celine',
        'brand_16_desc' => 'Known for minimalist luxury and clean lines.',
        'brand_16_detail' => 'Celine redefines modern luxury with its minimalist designs and impeccable craftsmanship, focusing on understated elegance.',
        'brand_17_title' => 'Chloé',
        'brand_17_desc' => 'Celebrated for bohemian elegance and feminine style.',
        'brand_17_detail' => 'Chloé embodies romantic femininity with its flowing designs and bohemian aesthetic, creating timeless pieces for the modern woman.',
        'brand_18_title' => 'Fendi',
        'brand_18_desc' => 'Renowned for luxury leather goods and innovative designs.',
        'brand_18_detail' => 'Fendi is celebrated for its exceptional craftsmanship in leather goods and innovative designs that blend tradition with contemporary style.',
        'brand_19_title' => 'Versace',
        'brand_19_desc' => 'Known for bold prints and glamorous designs.',
        'brand_19_detail' => 'Versace is synonymous with bold prints, vibrant colors, and glamorous designs that embody Italian luxury and sensuality.',
        'brand_20_title' => 'Prada',
        'brand_20_desc' => 'Famous for intellectual fashion and minimalist designs.',
        'brand_20_detail' => 'Prada redefines luxury with its intellectual approach to fashion, combining minimalist designs with innovative materials and concepts.'
    ],
    'zh' => [
        'meta_description' => '通过 HAF 探索标志性时尚品牌，庆祝风格与创新',
        'brands_title' => '标志性时尚品牌',
        'brands_subtitle' => '发现世界上最具影响力的时装屋的遗产',
        'nav_home' => '首页',
        'nav_brands' => '品牌',
        'nav_history' => '历史',
        'nav_art' => '艺术',
        'nav_fashion' => '时尚',
        'nav_shop' => '商店',
        'learn_more' => '了解更多',
        'visit_website' => '访问官方网站',
        'footer_copyright' => '© 2025 历史、艺术与时尚。保留所有权利。',
        'brand_1_title' => '香奈儿',
        'brand_1_desc' => '以永恒的优雅和标志性小黑裙闻名。',
        'brand_1_detail' => '香奈儿以其极简优雅革新了时尚，推出了小黑裙和香奈儿五号香水，体现了精致与奢华。',
        'brand_2_title' => '古驰',
        'brand_2_desc' => '以大胆的设计和奢华的意大利工艺而闻名。',
        'brand_2_detail' => '古驰以其折衷和充满活力的设计而闻名，融合了传统意大利工艺与当代风采，影响全球时尚趋势。',
        'brand_3_title' => '路易威登',
        'brand_3_desc' => '以其标志性行李箱和高时尚配饰而闻名。',
        'brand_3_detail' => '路易威登是奢华旅行的代名词，提供标志性的单字母图案行李箱和创新的配饰，定义高端时尚。',
        'brand_4_title' => '迪奥',
        'brand_4_desc' => '以女性化的轮廓和革命性的新风貌而闻名。',
        'brand_4_detail' => '迪奥以其新风貌改变了战后时尚，强调女性化的轮廓和奢华的面料，设定了优雅的标准。',
        'brand_11_title' => '巴黎世家',
        'brand_11_desc' => '以先锋设计和新廓形著称。',
        'brand_11_detail' => '巴黎世家通过其建筑设计和新廓形，重新定义了现代奢华，成为现代奢华的象征。',
        'brand_12_title' => '博柏利',
        'brand_12_desc' => '以其标志性风衣和格纹图案著称。',
        'brand_12_detail' => '博柏利的传统在于其永恒的风衣和独特的格纹图案，将传统与当代风格完美融合。',
        'brand_13_title' => '华伦天奴',
        'brand_13_desc' => '以浪漫设计和标志性红色礼服著称。',
        'brand_13_detail' => '华伦天奴以其浪漫美学和鲜艳的红色礼服闻名，在高定时尚中体现优雅与激情。',
        'brand_14_title' => '纪梵希',
        'brand_14_desc' => '以精致优雅和标志性设计著称。',
        'brand_14_detail' => '纪梵希将贵族优雅与现代简约相融合，创造出奥黛丽·赫本等时尚偶像穿着的标志性作品。',
        'brand_15_title' => '圣罗兰',
        'brand_15_desc' => '以前卫的精致和摇滚时尚风格著称。',
        'brand_15_detail' => '圣罗兰将巴黎优雅与叛逆边缘相结合，以其摇滚美学定义现代奢华。',
        'brand_16_title' => '赛琳',
        'brand_16_desc' => '以极简奢华和简洁线条著称。',
        'brand_16_detail' => '赛琳以其极简设计和精湛工艺重新定义现代奢华，专注于低调优雅。',
        'brand_17_title' => '蔻依',
        'brand_17_desc' => '以波西米亚优雅和女性风格著称。',
        'brand_17_detail' => '蔻依提供浪漫的波西米亚美学，流畅的廓形和柔软的面料，体现轻松的女性气质。',
        'brand_18_title' => '芬迪',
        'brand_18_desc' => '以奢华皮具和创新设计著称。',
        'brand_18_detail' => '芬迪以其精湛的皮具工艺和创新设计，将传统与当代风格完美融合。',
        'brand_19_title' => '范思哲',
        'brand_19_desc' => '以鲜艳印花和大胆设计著称。',
        'brand_19_detail' => '范思哲以其鲜艳的印花和大胆设计，体现了意大利的奢靡与大胆。',
        'brand_20_title' => '普拉达',
        'brand_20_desc' => '以知识分子风格和极简设计著称。',
        'brand_20_detail' => '普拉达以其知识分子风格和创新材质，重新定义了奢华。'
    ],
    'es' => [
        'meta_description' => 'Explora marcas de moda icónicas con HAF, celebrando el estilo y la innovación',
        'brands_title' => 'Marcas de Moda Icónicas',
        'brands_subtitle' => 'Descubre el legado de las casas de moda más influyentes del mundo',
        'nav_home' => 'Inicio',
        'nav_brands' => 'Marcas',
        'nav_history' => 'Historia',
        'nav_art' => 'Arte',
        'nav_fashion' => 'Moda',
        'nav_shop' => 'Tienda',
        'learn_more' => 'Saber Más',
        'visit_website' => 'Visitar Sitio Web Oficial',
        'footer_copyright' => '© 2025 Historia, Arte y Moda. Todos los derechos reservados.',
        'brand_1_title' => 'Chanel',
        'brand_1_desc' => 'Conocida por su elegancia atemporal y el icónico vestido negro.',
        'brand_1_detail' => 'Chanel revolucionó la moda con su elegancia minimalista, introduciendo el vestido negro pequeño y el perfume Chanel No. 5, encarnando sofisticación y lujo.',
        'brand_2_title' => 'Gucci',
        'brand_2_desc' => 'Celebrada por diseños audaces y artesanía italiana lujosa.',
        'brand_2_detail' => 'Gucci es conocida por sus diseños eclécticos y vibrantes, combinando la artesanía italiana tradicional con un estilo contemporáneo, influyendo en las tendencias de moda globales.',
        'brand_3_title' => 'Louis Vuitton',
        'brand_3_desc' => 'Reconocida por su equipaje monogramado y accesorios de alta moda.',
        'brand_3_detail' => 'Louis Vuitton es sinónimo de viajes de lujo, ofreciendo equipaje monogramado icónico y accesorios innovadores que definen la alta moda.',
        'brand_4_title' => 'Dior',
        'brand_4_desc' => 'Famosa por siluetas femeninas y el revolucionario New Look.',
        'brand_4_detail' => 'Dior transformó la moda de posguerra con su New Look, destacando siluetas femeninas y telas lujosas, estableciendo un estándar de elegancia.',
        'brand_11_title' => 'Balenciaga',
        'brand_11_desc' => 'Conocida por sus diseños avanzados y siluetas innovadoras.',
        'brand_11_detail' => 'Balenciaga revolucionó la moda con sus diseños arquitectónicos y enfoque innovador para la silueta, convirtiéndose en un símbolo de lujo moderno.',
        'brand_12_title' => 'Burberry',
        'brand_12_desc' => 'Famosa por sus gabardinas icónicas y patrón de cuadros.',
        'brand_12_detail' => 'El legado de Burberry radica en sus gabardinas atemporales y su distintivo patrón de cuadros, combinando tradición con estilo contemporáneo.',
        'brand_13_title' => 'Valentino',
        'brand_13_desc' => 'Renombrada por sus diseños románticos y vestidos rojos característicos.',
        'brand_13_detail' => 'Valentino es celebrada por su estética romántica y vestidos rojos vibrantes, encarnando elegancia y pasión en la alta costura.',
        'brand_14_title' => 'Givenchy',
        'brand_14_desc' => 'Conocido por su elegancia refinada y diseños icónicos.',
        'brand_14_detail' => 'Givenchy combina la elegancia aristocrática con la simplicidad moderna, creando piezas icónicas usadas por íconos del estilo como Audrey Hepburn.',
        'brand_15_title' => 'Saint Laurent',
        'brand_15_desc' => 'Famoso por su sofisticación atrevida y estilo rock-chic.',
        'brand_15_detail' => 'Saint Laurent combina la elegancia parisina con un toque rebelde, definiendo el lujo moderno con su estética inspirada en el rock.',
        'brand_16_title' => 'Celine',
        'brand_16_desc' => 'Conocida por su lujo minimalista y líneas limpias.',
        'brand_16_detail' => 'Celine redefine el lujo moderno con sus diseños minimalistas y su artesanía impecable, centrándose en la elegancia discreta.',
        'brand_17_title' => 'Chloé',
        'brand_17_desc' => 'Celebrada por su elegancia bohemia y estilo femenino.',
        'brand_17_detail' => 'Chloé ofrece una estética romántica y bohemia con siluetas fluidas y telas suaves, encarnando la feminidad natural.',
        'brand_18_title' => 'Fendi',
        'brand_18_desc' => 'Célèbre pour son expertise en fourrure et ses accessoires audacieux.',
        'brand_18_detail' => 'Fendi mêle artisanat italien, techniques innovantes en fourrure et accessoires iconiques, créant des tendances de mode de luxe.',
        'brand_19_title' => 'Versace',
        'brand_19_desc' => 'Connue pour ses motifs vibrants et son style élégant.',
        'brand_19_detail' => 'Versace est célèbre pour ses designs audacieux, ses couleurs vives et son esthétique luxueux, incarnant l\'extravagance et l\'audace italienne.',
        'brand_20_title' => 'Prada',
        'brand_20_desc' => 'Conhecida por sus diseños minimalistas y materiales innovadores.',
        'brand_20_detail' => 'Prada combina el lujo discreto con materiales de vanguardia, creando piezas atemporales que resuenan con los entusiastas de la moda moderna.'
    ],
    'ar' => [
        'meta_description' => 'استكشف ماركات الأزياء الشهيرة مع HAF، نحتفل بالأسلوب والابتكار',
        'brands_title' => 'ماركات الأزياء الشهيرة',
        'brands_subtitle' => 'اكتشف إرث بيوت الأزياء الأكثر تأثيرًا في العالم',
        'nav_home' => 'الصفحة الرئيسية',
        'nav_brands' => 'العلامات التجارية',
        'nav_history' => 'التاريخ',
        'nav_art' => 'الفن',
        'nav_fashion' => 'الأزياء',
        'nav_shop' => 'المتجر',
        'learn_more' => 'معرفة المزيد',
        'visit_website' => 'زيارة الموقع الرسمي',
        'footer_copyright' => '© 2025 التاريخ، الفن والأزياء. جميع الحقوق محفوظة.',
        'brand_1_title' => 'شانيل',
        'brand_1_desc' => 'معروفة بأناقتها الخالدة والفستان الأسود الصغير الشهير.',
        'brand_1_detail' => 'أحدثت شانيل ثورة في عالم الموضة بأناقتها البسيطة، وقدمت الفستان الأسود الصغير وعطر شانيل رقم 5، لتجسد الرقي والفخامة.',
        'brand_2_title' => 'غوتشي',
        'brand_2_desc' => 'مشهورة بتصاميمها الجريئة والحرفية الإيطالية الفاخرة.',
        'brand_2_detail' => 'تشتهر غوتشي بتصاميمها المتنوعة والنابضة بالحياة، حيث تمزج بين الحرفية الإيطالية التقليدية والذوق المعاصر، مما يؤثر على اتجاهات الموضة العالمية.',
        'brand_3_title' => 'لوي فيتون',
        'brand_3_desc' => 'معروفة بحقائبها المزخرفة بالشعار وإكسسوارات الموضة العالية.',
        'brand_3_detail' => 'لوي فيتون مرادف للسفر الفاخر، حيث تقدم حقائب مزخرفة بالشعار وإكسسوارات مبتكرة تحدد معايير الموضة الراقية.',
        'brand_4_title' => 'ديور',
        'brand_4_desc' => 'مشهورة بصورها الظلية الأنثوية والمظهر الجديد الثوري.',
        'brand_4_detail' => 'غيرت ديور الموضة بعد الحرب بمظهرها الجديد، مع التركيز على الصور الظلية الأنثوية والأقمشة الفاخرة، ووضعت معيارًا للأناقة.',
        'brand_11_title' => 'بالينسياغا',
        'brand_11_desc' => 'معروفة بالأشكال الطليعية والتقنيات المبتكرة.',
        'brand_11_detail' => 'تدفع بالينسياغا الحدود من خلال الصور الظلية المبتكرة والتصاميم التجريبية، معيدة تعريف الموضة الفاخرة المعاصرة.',
        'brand_12_title' => 'بوربري',
        'brand_12_desc' => 'معروفة بمعاطفها الشهيرة ونسيجها المربع.',
        'brand_12_detail' => 'تراث بوربري يكمن في معاطفها الخالدة ونسيجها المميز، مما يدمج التقاليد مع الأسلوب المعاصر.',
        'brand_13_title' => 'فالنتينو',
        'brand_13_desc' => 'مشهور بجماليته الرومانسية وفساتينه الحمراء النابضة بالحياة، مما يجسد الأناقة والعاطفة في الأزياء الراقية.',
        'brand_14_title' => 'جيفنشي',
        'brand_14_desc' => 'معروف بالأناقة المكررة والتصاميم الأيقونية.',
        'brand_14_detail' => 'يجمع جيفنشي بين الأناقة الأرستقراطية والبساطة العصرية، مما يخلق قطعًا أيقونية يرتديها أيقونات الأزياء مثل أودري هيبورن.',
        'brand_15_title' => 'سان لوران',
        'brand_15_desc' => 'معروف بأناقته الجريئة وأسلوبه الراقي الصاخب.',
        'brand_15_detail' => 'يجمع سان لوران بين الأناقة الباريسية والحافة المتمردة، مما يعرف الفخامة العصرية بجماليتها المستوحاة من موسيقى الروك.',
        'brand_16_title' => 'سيلين',
        'brand_16_desc' => 'معروف بالفخامة البسيطة والخطوط النظيفة.',
        'brand_16_detail' => 'تعيد سيلين تعريف الفخامة العصرية بتصاميمها البسيطة وحرفيتها المثالية، مع التركيز على الأناقة البسيطة.',
        'brand_17_title' => 'كلوي',
        'brand_17_desc' => 'مشهورة بجماليتها الرومانسية والأسلوب الأنثوي.',
        'brand_17_detail' => 'تقدم كلوي جمالية رومانسية بوهيمية مع صور ظلية متدفقة وأقمشة ناعمة، مما يجسد الأنوثة الطبيعية.',
        'brand_18_title' => 'فيندي',
        'brand_18_desc' => 'مشهورة بخبرة الجلد والإكسسوارات الأيقونية.',
        'brand_18_detail' => 'فيندي يجمع بين الصناعة الإيطالية والتقنيات المبتكرة للجلد والإكسسوارات الأيقونية، مما يؤدي إلى تصاميم أزياء عالية الذوق.',
        'brand_19_title' => 'فيرساتشي',
        'brand_19_desc' => 'مشهور بطبعاته الزاهية وأسلوبه الساحر.',
        'brand_19_detail' => 'تحتفل فيرساتشي بتصاميمها الجريئة وألوانها الزاهية وجمالها الفاخر، مجسدة البذخ والجرأة الإيطالية.',
        'brand_20_title' => 'برادا',
        'brand_20_desc' => 'معروفة بتصاميمها البسيطة وموادها المبتكرة.',
        'brand_20_detail' => 'برادا تجمع بين الفخامة البسيطة والمواد المتطورة، وتخلق قطعًا خالدة تروق لعشاق الموضة المعاصرين.'
    ],
    'fr' => [
        'meta_description' => 'Découvrez les marques de mode emblématiques avec HAF, célébrant le style et l\'innovation',
        'brands_title' => 'Marques de Mode Emblématiques',
        'brands_subtitle' => 'Découvrez l\'héritage des grandes maisons de mode avec HAF',
        'nav_home' => 'Accueil',
        'nav_brands' => 'Marques',
        'nav_history' => 'Histoire',
        'nav_art' => 'Art',
        'nav_fashion' => 'Mode',
        'nav_shop' => 'Boutique',
        'learn_more' => 'En Savoir Plus',
        'visit_website' => 'Visiter le Site Officiel',
        'footer_copyright' => '© 2025 Histoire, Art & Mode. Tous droits réservés.',
        'brand_1_title' => 'Chanel',
        'brand_1_desc' => 'Connue pour son élégance intemporelle et la petite robe noire iconique.',
        'brand_1_detail' => 'Chanel a révolutionné la mode avec son élégance minimaliste, introduisant la petite robe noire et le parfum Chanel N°5, incarnant la sophistication et le luxe.',
        'brand_2_title' => 'Gucci',
        'brand_2_desc' => 'Célèbre pour ses designs audacieux et son artisanat italien luxueux.',
        'brand_2_detail' => 'Gucci est célèbre pour ses designs éclectiques et vibrants, mêlant l\'artisanat italien traditionnel à une touche contemporaine, influençant les tendances mondiales de la mode.',
        'brand_3_title' => 'Louis Vuitton',
        'brand_3_desc' => 'Renommée pour ses bagages monogrammés et ses accessoires de haute mode.',
        'brand_3_detail' => 'Louis Vuitton est synonyme de voyage de luxe, offrant des bagages monogrammés emblématiques et des accessoires innovants qui définissent la haute couture.',
        'brand_4_title' => 'Dior',
        'brand_4_desc' => 'Célèbre pour ses silhouettes féminines et son révolutionnaire New Look.',
        'brand_4_detail' => 'Dior a transformé la mode d\'après-guerre avec son New Look, mettant en avant des silhouettes féminines et des tissus luxueux, établissant une norme d\'élégance.',
        'brand_11_title' => 'Balenciaga',
        'brand_11_desc' => 'Connue pour ses designs avancés et ses silhouettes innovatrices.',
        'brand_11_detail' => 'Balenciaga a révolutionné la mode avec ses designs architecturaux et son approche innovante pour la silhouette, devenant un symbole du luxe moderne.',
        'brand_12_title' => 'Burberry',
        'brand_12_desc' => 'Célèbre pour ses trenchs iconiques et son motif à carreaux.',
        'brand_12_detail' => 'L\'héritage de Burberry réside dans ses trenchs intemporels et son motif à carreaux distinctif, alliant tradition et style contemporain.',
        'brand_13_title' => 'Valentino',
        'brand_13_desc' => 'Célèbre pour ses designs romantiques et ses robes rouges emblématiques.',
        'brand_13_detail' => 'Valentino est célèbre pour son esthétique romantique et ses robes rouges vibrantes, incarnant l\'élégance et la passion dans la haute couture.',
        'brand_14_title' => 'Givenchy',
        'brand_14_desc' => 'Connu pour son élégance raffinée et ses designs iconiques.',
        'brand_14_detail' => 'Givenchy mêle élégance aristocratique et simplicité moderne, créant des pièces iconiques portées par des icônes du style comme Audrey Hepburn.',
        'brand_15_title' => 'Saint Laurent',
        'brand_15_desc' => 'Célèbre pour sa sophistication audacieuse et son style rock-chic.',
        'brand_15_detail' => 'Saint Laurent combine l\'élégance parisienne avec une touche rebelle, définissant le luxe moderne avec son esthétique inspirée du rock.',
        'brand_16_title' => 'Celine',
        'brand_16_desc' => 'Connue pour son luxe minimaliste et ses lignes épurées.',
        'brand_16_detail' => 'Celine redéfinit le luxe moderne avec ses designs minimalistes et son artisanat impeccable, en se concentrant sur l\'élégance discrète.',
        'brand_17_title' => 'Chloé',
        'brand_17_desc' => 'Célèbre pour son élégance bohème et son style féminin.',
        'brand_17_detail' => 'Chloé offre une esthétique romantique et bohème avec des silhouettes fluides et des tissus doux, incarnant une féminité naturelle.',
        'brand_18_title' => 'Fendi',
        'brand_18_desc' => 'Célèbre pour son expertise en fourrure et ses accessoires audacieux.',
        'brand_18_detail' => 'Fendi mêle artisanat italien, techniques innovantes en fourrure et accessoires iconiques, créant des tendances de mode de luxe.',
        'brand_19_title' => 'Versace',
        'brand_19_desc' => 'Célèbre pour ses designs audacieux, ses couleurs vives et son esthétique luxueux, incarnant l\'extravagance et l\'audace italienne.',
        'brand_20_title' => 'Prada',
        'brand_20_desc' => 'Célèbre pour ses designs minimalistes et ses matériaux innovants.',
        'brand_20_detail' => 'Prada associe le luxe discret à des matériaux de pointe, créant des pièces intemporelles qui séduisent les passionnés de mode moderne.'
    ],
    'ru' => [
        'meta_description' => 'Исследуйте культовые модные бренды с HAF, прославляя стиль и инновации',
        'brands_title' => 'Культовые Модные Бренды',
        'brands_subtitle' => 'Откройте для себя наследие ведущих домов моды с HAF',
        'nav_home' => 'Главная',
        'nav_brands' => 'Бренды',
        'nav_history' => 'История',
        'nav_art' => 'Искусство',
        'nav_fashion' => 'Мода',
        'nav_shop' => 'Магазин',
        'learn_more' => 'Узнать Больше',
        'visit_website' => 'Посетить официальный сайт',
        'footer_copyright' => '© 2025 История, Искусство и Мода. Все права защищены.',
        'brand_1_title' => 'Шанель',
        'brand_1_desc' => 'Известна своим вневременным элегантным стилем и культовым маленьким черным платьем.',
        'brand_1_detail' => 'Шанель произвела революцию в моде с ее минималистской элегантностью, представив маленькое черное платье и духи Chanel No. 5, воплощающие утонченность и роскошь.',
        'brand_2_title' => 'Гуччи',
        'brand_2_desc' => 'Прославлена смелыми дизайнами и роскошным итальянским мастерством.',
        'brand_2_detail' => 'Гуччи известна своими эклектичными и яркими дизайнами, сочетающими традиционное итальянское мастерство с современным стилем, влияя на мировые модные тенденции.',
        'brand_3_title' => 'Луи Виттон',
        'brand_3_desc' => 'Известна своими монограммированными чемоданами и аксессуарами высокой моды.',
        'brand_3_detail' => 'Луи Виттон является синонимом роскошных путешествий, предлагая культовые монограммированные чемоданы и инновационные аксессуары, определяющие высокую моду.',
        'brand_4_title' => 'Диор',
        'brand_4_desc' => 'Славится женственными силуэтами и революционным новым обликом.',
        'brand_4_detail' => 'Диор преобразил послевоенную моду с новым обликом, акцентируя женственные силуэты и роскошные ткани, установив стандарт элегантности.',
        'brand_11_title' => 'Балескиага',
        'brand_11_desc' => 'Известна своим архитектурным дизайном и инновационным подходом к силуэту.',
        'brand_11_detail' => 'Балескиага революционировала модный дизайн с ее архитектурным дизайном и инновационным подходом к силуэту, став символом современного роскоша.',
        'brand_12_title' => 'Барберри',
        'brand_12_desc' => 'Известна своими культовыми тренчами и клетчатым узором.',
        'brand_12_detail' => 'Наследие Барберри заключается в его вневременных тренчах и отличительном клетчатом узоре, сочетающем традиции с современным стилем.',
        'brand_13_title' => 'Валентино',
        'brand_13_desc' => 'Известен романтичными дизайнами и фирменными красными платьями.',
        'brand_13_detail' => 'Валентино славится своей романтичной эстетикой и яркими красными платьями, воплощая элегантность и страсть в высокой моде.',
        'brand_14_title' => 'Живанши',
        'brand_14_desc' => 'Изысканной элегантностью и культовыми дизайнами.',
        'brand_14_detail' => 'Живанши сочетает аристократическую элегантность с современной простотой, создавая культовые изделия, которые носили иконы стиля, такие как Одри Хепберн.',
        'brand_15_title' => 'Сен-Лоран',
        'brand_15_desc' => 'Известна дерзкой изысканностью и рок-шиком стилем.',
        'brand_15_detail' => 'Сен-Лоран сочетает парижскую элегантность с бунтарским духом, определяя современную роскошь своей эстетикой, вдохновленной роком.',
        'brand_16_title' => 'Селин',
        'brand_16_desc' => 'Известна минималистичной роскошью и чистыми линиями.',
        'brand_16_detail' => 'Селин переосмысливает современную роскошь своими минималистичными дизайнами и безупречным мастерством, фокусируясь на сдержанной элегантности.',
        'brand_17_title' => 'Клоэ',
        'brand_17_desc' => 'Богемной элегантностью и женственным стилем.',
        'brand_17_detail' => 'Клоэ предлагает романтичную богемную эстетику с плавными силуэтами и мягкими тканями, воплощая естественную женственность.',
        'brand_18_title' => 'Фенди',
        'brand_18_desc' => 'Мастерством в обработке кожи и яркими аксессуарами.',
        'brand_18_detail' => 'Фенди сочетает итальянское мастерство с инновационными технологиями обработки кожи и яркими аксессуарами, создавая модные тенденции высокого уровня.',
        'brand_19_title' => 'Миу Миу',
        'brand_19_desc' => 'Игривыми дизайнами и юношеской элегантностью.',
        'brand_19_detail' => 'Миу Миу сочетает эксцентричную юношескую эстетику с изысканным мастерством, создавая уникальные и яркие модные изделия.',
        'brand_20_title' => 'Прада',
        'brand_20_desc' => 'Интеллектуальным подходом к моде и минималистичным дизайнам.',
        'brand_20_detail' => 'Прада переосмысливает роскошь своим интеллектуальным подходом к моде, сочетая минималистичные дизайны с инновационными материалами и концепциями.'
    ],
    'pt' => [
        'meta_description' => 'Explore marcas de moda icônicas com HAF, celebrando estilo e inovação',
        'brands_title' => 'Marcas de Moda Icônicas',
        'brands_subtitle' => 'Descubra o legado das principais casas de moda com HAF',
        'nav_home' => 'Início',
        'nav_brands' => 'Marcas',
        'nav_history' => 'História',
        'nav_art' => 'Arte',
        'nav_fashion' => 'Moda',
        'nav_shop' => 'Loja',
        'learn_more' => 'Saiba Mais',
        'visit_website' => 'Visitar Site Oficial',
        'footer_copyright' => '© 2025 História, Arte e Moda. Todos os direitos reservados.',
        'brand_1_title' => 'Chanel',
        'brand_1_desc' => 'Conhecida por sua elegância atemporal e o icônico vestidinho preto.',
        'brand_1_detail' => 'Chanel revolucionou a moda com sua elegância minimalista, introduzindo o vestidinho preto e o perfume Chanel Nº 5, incorporando sofisticação e luxo.',
        'brand_2_title' => 'Gucci',
        'brand_2_desc' => 'Celebrada por designs ousados e artesanato italiano luxuoso.',
        'brand_2_detail' => 'Gucci é conhecida por seus designs ecléticos e vibrantes, combinando artesanato italiano tradicional com um toque contemporâneo, influenciando tendências globais de moda.',
        'brand_3_title' => 'Louis Vuitton',
        'brand_3_desc' => 'Renomada por suas malas monogramadas e acessórios de alta moda.',
        'brand_3_detail' => 'Louis Vuitton é sinônimo de viagem de luxo, oferecendo malas monogramadas icônicas e acessórios inovadores que definen a alta moda.',
        'brand_4_title' => 'Dior',
        'brand_4_desc' => 'Famosa por silhuetas femininas e o revolucionário New Look.',
        'brand_4_detail' => 'Dior transformou a moda pós-guerra com seu New Look, destacando silhuetas femininas e tecidos luxuosos, estabelecendo um padrão de elegância.',
        'brand_11_title' => 'Balenciaga',
        'brand_11_desc' => 'Conhecida por suas formas avant-gardistes e técnicas inovadoras.',
        'brand_11_detail' => 'Balenciaga revolucionou a moda com seus designs arquitetônicos e abordagem inovadora para a silhueta, se tornando um símbolo do luxo moderno.',
        'brand_12_title' => 'Burberry',
        'brand_12_desc' => 'Famosa por seus trench coats icônicos e padrão xadrez.',
        'brand_12_detail' => 'O legado da Burberry está em seus trench coats atemporais e padrão xadrez distintivo, misturando tradição com estilo contemporâneo.',
        'brand_13_title' => 'Valentino',
        'brand_13_desc' => 'Renomada por seus designs românticos e vestidos vermelhos característicos.',
        'brand_13_detail' => 'Valentino é celebrada por sua estética romântica e vestidos vermelhos vibrantes, encarnando elegância e paixão na alta costura.',
        'brand_14_title' => 'Givenchy',
        'brand_14_desc' => 'Conhecida por sua elegância refinada e designs icônicos.',
        'brand_14_detail' => 'Givenchy combina a elegância aristocrática com a simplicidade moderna, criando peças icônicas usadas por ícones do estilo como Audrey Hepburn.',
        'brand_15_title' => 'Saint Laurent',
        'brand_15_desc' => 'Famoso por sua sofisticação ousada e estilo rock-chic.',
        'brand_15_detail' => 'Saint Laurent combina a elegância parisiense com um toque rebelde, definindo o luxo moderno com sua estética inspirada no rock.',
        'brand_16_title' => 'Celine',
        'brand_16_desc' => 'Conhecida por seu luxo minimalista e linhas limpas.',
        'brand_16_detail' => 'Celine redefine o luxo moderno com seus designs minimalistas e artesanato impecável, focando na elegância discreta.',
        'brand_17_title' => 'Chloé',
        'brand_17_desc' => 'Celebrada por sua elegância boêmia e estilo feminino.',
        'brand_17_detail' => 'Chloé oferece uma estética romântica e boêmia com silhuetas fluidas e tecidos suaves, encarnando a feminilidade natural.',
        'brand_18_title' => 'Fendi',
        'brand_18_desc' => 'Célèbre pour son expertise en fourrure et ses accessoires audacieux.',
        'brand_18_detail' => 'Fendi combina a expertise em couro e acessórios icônicos, criando tendências de moda de luxo.',
        'brand_19_title' => 'Versace',
        'brand_19_desc' => 'Famosa por seus designs ousados, cores vibrantes e estilo glamuroso.',
        'brand_19_detail' => 'Versace é famosa por seus designs ousados, cores vibrantes e estilo glamuroso, que representam a extravagância e a audácia italiana.',
        'brand_20_title' => 'Prada',
        'brand_20_desc' => 'Famosa por seus designs minimalistas e materiais inovadores.',
        'brand_20_detail' => 'Prada combina o discreto com o luxo, criando peças atemporais que ressoam com entusiastas da moda moderna.'
    ],
    'de' => [
        'meta_description' => 'Entdecken Sie ikonische Modemarken mit HAF, die Stil und Innovation feiern',
        'brands_title' => 'Ikonische Modemarken',
        'brands_subtitle' => 'Entdecken Sie das Erbe führender Modehäuser mit HAF',
        'nav_home' => 'Startseite',
        'nav_brands' => 'Marken',
        'nav_history' => 'Geschichte',
        'nav_art' => 'Kunst',
        'nav_fashion' => 'Mode',
        'nav_shop' => 'Shop',
        'learn_more' => 'Erfahren Sie Mehr',
        'visit_website' => 'Offizielle Website besuchen',
        'footer_copyright' => '© 2025 Geschichte, Kunst & Mode. Alle Rechte vorbehalten.',
        'brand_1_title' => 'Chanel',
        'brand_1_desc' => 'Bekannt für zeitlose Eleganz und das ikonische kleine Schwarze.',
        'brand_1_detail' => 'Chanel revolutionierte die Mode mit ihrer minimalistischen Eleganz und führte das kleine Schwarze sowie das Parfüm Chanel No. 5 ein, das für Raffinesse und Luxus steht.',
        'brand_2_title' => 'Gucci',
        'brand_2_desc' => 'Gefeiert für kühne Designs und luxuriöse italienische Handwerkskunst.',
        'brand_2_detail' => 'Gucci ist bekannt für seine eklektischen und lebendigen Designs, die traditionelle italienische Handwerkskunst mit zeitgenössischem Flair verbinden und globale Modetrends beeinflussen.',
        'brand_3_title' => 'Louis Vuitton',
        'brand_3_desc' => 'Berühmt für monogrammiertes Gepäck und High-Fashion-Accessoires.',
        'brand_3_detail' => 'Louis Vuitton ist ein Synonym für Luxusreisen und bietet ikonisches monogrammiertes Gepäck und innovative Accessoires, die die Haute Couture definieren.',
        'brand_4_title' => 'Dior',
        'brand_4_desc' => 'Berühmt für feminine Silhouetten und den revolutionären New Look.',
        'brand_4_detail' => 'Dior veränderte die Nachkriegsmode mit seinem New Look, der feminine Silhouetten und luxuriöse Stoffe betonte und einen Standard für Eleganz setzte.',
        'brand_11_title' => 'Balenciaga',
        'brand_11_desc' => 'Bekannt für avantgardistische Formen und innovative Silhouetten.',
        'brand_11_detail' => 'Balenciaga revolutionierte den Mode-Stil mit ihren architektonischen Designs und einem innovativen Ansatz für die Silhouette, indem sie das Symbol des modernen Luxus wurde.',
        'brand_12_title' => 'Burberry',
        'brand_12_desc' => 'Berühmt für ikonische Trenchcoats und Karomuster.',
        'brand_12_detail' => 'Das Erbe von Burberry liegt in seinen zeitlosen Trenchcoats und dem unverwechselbaren Karomuster, das Tradition mit zeitgenössischem Stil verbindet.',
        'brand_13_title' => 'Valentino',
        'brand_13_desc' => 'Bekannt für romantische Designs und charakteristische rote Kleider.',
        'brand_13_detail' => 'Valentino ist bekannt für seine romantische Ästhetik und lebendige rote Kleider, die Eleganz und Leidenschaft in der Haute Couture verkörpern.',
        'brand_14_title' => 'Givenchy',
        'brand_14_desc' => 'Bekannt für raffinierte Eleganz und ikonische Designs.',
        'brand_14_detail' => 'Givenchy verbindet aristokratische Eleganz mit moderner Einfachheit und schafft ikonische Stücke, die von Stilikonen wie Audrey Hepburn getragen werden.',
        'brand_15_title' => 'Saint Laurent',
        'brand_15_desc' => 'Bekannt für seine gewagte Eleganz und den Rock-Chic-Stil.',
        'brand_15_detail' => 'Saint Laurent verbindet Pariser Eleganz mit einem rebellischen Touch und definiert modernen Luxus mit seiner von Rock inspirierten Ästhetik.',
        'brand_16_title' => 'Celine',
        'brand_16_desc' => 'Bekannt für minimalistischen Luxus und klare Linien.',
        'brand_16_detail' => 'Celine definiert modernen Luxus neu mit minimalistischen Designs und makellosem Handwerk und konzentriert sich auf zurückhaltende Eleganz.',
        'brand_17_title' => 'Chloé',
        'brand_17_desc' => 'Böhmische Eleganz und femininen Stil.',
        'brand_17_detail' => 'Chloé bietet eine romantische, böhmische Ästhetik mit fließenden Silhouetten und weichen Stoffen und verkörpert natürliche Weiblichkeit.',
        'brand_18_title' => 'Fendi',
        'brand_18_desc' => 'Bekannt für exquisite Handwerkskunst und auffällige Accessoires.',
        'brand_18_detail' => 'Fendi verkörpert Luxus mit handgefertigten Lederwaren, darunter die ikonischen Birkin- und Kelly-Taschen, die für Exklusivität stehen.',
        'brand_19_title' => 'Versace',
        'brand_19_desc' => 'Bekannt für seine ehrgeizigen Designs, farbenfrohe Farben und das luxuriöse Aussehen, das die italienische Extravaganz und den Mut zum Ausdruck bringt.',
        'brand_20_title' => 'Prada',
        'brand_20_desc' => 'Bekannt für minimalistisches Design und innovative Materialien.',
        'brand_20_detail' => 'Prada vereint zurückhaltenden Luxus mit modernsten Materialien und schafft zeitlose Stücke, die bei Modebegeisterten Anklang finden.'
    ],
    'ja' => [
        'meta_description' => 'HAFと共に象徴的なファッションブランドを探求し、スタイルと革新を祝います',
        'brands_title' => '象徴的なファッションブランド',
        'brands_subtitle' => 'HAFと共に一流のファッションハウスの遺産を発見してください',
        'nav_home' => 'ホーム',
        'nav_brands' => 'ブランド',
        'nav_history' => '歴史',
        'nav_art' => '芸術',
        'nav_fashion' => 'ファッション',
        'nav_shop' => 'ショップ',
        'learn_more' => '詳細を見る',
        'visit_website' => '公式サイトを訪問',
        'footer_copyright' => '© 2025 歴史、芸術、ファッション。全著作権所有。',
        'brand_1_title' => 'シャネル',
        'brand_1_desc' => '時代を超えたエレガンスと象徴的なリトルブラックドレスで知られています。',
        'brand_1_detail' => 'シャネルはミニマリストのエレガンスでファッションに革命を起こし、リトルブラックドレスとシャネルNo.5香水を導入し、洗練と贅沢を体現しました。',
        'brand_2_title' => 'グッチ',
        'brand_2_desc' => '大胆なデザインと豪華なイタリアの職人技で有名です。',
        'brand_2_detail' => 'グッチは折衷的で鮮やかなデザインで知られ、伝統的なイタリアの職人技と現代的なセンスを融合させ、世界のファッショントレンドに影響を与えています。',
        'brand_3_title' => 'ルイ・ヴィトン',
        'brand_3_desc' => 'モノグラムのラゲッジとハイファッションアクセサリーで有名です。',
        'brand_3_detail' => 'ルイ・ヴィトンは豪華な旅行の代名詞であり、象徴的なモノグラムのラゲッジと革新的なアクセサリーを提供し、ハイファッションを定義します。',
        'brand_4_title' => 'ディオール',
        'brand_4_desc' => '女性らしいシルエットと革命的なニュールックで有名です。',
        'brand_4_detail' => 'ディオールは戦後のファッションをニュールックで変革し、女性らしいシルエットと豪華な生地を強調し、エレガンスの基準を確立しました。',
        'brand_11_title' => 'バレンシアガ',
        'brand_11_desc' => 'アバンギャルドなシルエットとテクニックで知られる。',
        'brand_11_detail' => 'バレンシアガは革新的なシルエットと実験的なデザインで限界を押し広げ、現代のラグジュアリーファッションを再定義しています。',
        'brand_12_title' => 'バーバリー',
        'brand_12_desc' => 'アイコニックなトレンチコートとチェック柄で有名。',
        'brand_12_detail' => 'バーバリーの伝統は、時代を超えたトレンチコートと特徴的なチェック柄にあり、伝統と現代的なスタイルを融合させています。',
        'brand_13_title' => 'ヴァレンティノ',
        'brand_13_desc' => 'ロマンティックなデザインとシグネチャーの赤いドレスで有名。',
        'brand_13_detail' => 'ヴァレンティノはロマンティックな美学と鮮やかな赤いドレスで称賛され、ハイファッションでエレガンスと情熱を体現しています。',
        'brand_14_title' => 'ジバンシー',
        'brand_14_desc' => '貴族的なエレガンスと現代的なシンプルさを融合させ、オードリー・ヘプバーンのようなスタイルアイコンが着用するアイコニックな作品を生み出しています。',
        'brand_15_title' => 'サンローラン',
        'brand_15_desc' => 'エッジの効いた洗練さとロックシックスタイルで有名。',
        'brand_15_detail' => 'サンローランは女性用タキシードを導入し、男性的要素と女性的要素を大胆に融合してファッションを再定義しました。',
        'brand_16_title' => 'セリーヌ',
        'brand_16_desc' => 'ミニマリストなラグジュアリーとクリーンなラインで知られる。',
        'brand_16_detail' => 'セリーヌはミニマリストのエレガンスでファッションに革命を起こし、リトルブラックドレスとシャネルNo.5香水を導入し、洗練と贅沢を体現しました。',
        'brand_17_title' => 'イヴ・サンローラン',
        'brand_17_desc' => '女性のパワードレッシングと大胆な美学を切り開いた。',
        'brand_17_detail' => 'イヴ・サンローランは女性用タキシードを導入し、男性的要素と女性的要素を大胆に融合してファッションを再定義しました。',
        'brand_18_title' => 'フェンディ',
        'brand_18_desc' => 'ファーの専門知識と大胆なアクセサリーで知られる。',
        'brand_18_detail' => 'フェンディはイタリアの職人技と革新的なファー技術、そしてステートメントアクセサリーを組み合わせ、モダンなファッションのトレンドを作り出しています。',
        'brand_19_title' => 'ヴェルサーチェ',
        'brand_19_desc' => '大胆なデザイン、鮮やかな色彩、豪華な美学で称賛され、イタリアの贅沢さと大胆さを体現しています。',
        'brand_19_detail' => 'ヴェルサーチェは大胆なデザイン、鮮やかな色彩、豪華な美学で称賛され、イタリアの贅沢さと大胆さを体現しています。',
        'brand_20_title' => 'プラダ',
        'brand_20_desc' => 'ミニマリストデザインと革新的な素材で知られる。',
        'brand_20_detail' => 'プラダは控えめなラグジュアリーと最先端素材を融合し、現代のファッション愛好家に響くタイムレスな作品を生み出しています。'
    ],
    'hi' => [
        'meta_description' => 'HAF के साथ प्रतिष्ठित फैशन ब्रांडों का अन्वेषण करें, शैली और नवाचार का उत्सव करें',
        'brands_title' => 'प्रतिष्ठित फैशन ब्रांड',
        'brands_subtitle' => 'HAF के साथ अग्रणी फैशन हाउस की विरासत की खोज करें',
        'nav_home' => 'होम',
        'nav_brands' => 'ब्रांड',
        'nav_history' => 'इतिहास',
        'nav_art' => 'कला',
        'nav_fashion' => 'फैशन',
        'nav_shop' => 'दुकान',
        'learn_more' => 'और जानें',
        'visit_website' => 'आधिकारिक वेबसाइट पर जाएं',
        'footer_copyright' => '© 2025 इतिहास, कला और फैशन। सर्वाधिकार सुरक्षित।',
        'brand_1_title' => 'शैनल',
        'brand_1_desc' => 'कालजयी शिष्टता और प्रतिष्ठित छोटी काली पोशाक के लिए जाना जाता है।',
        'brand_1_detail' => 'शैनल ने अपनी न्यूनतम शिष्टता के साथ फैशन में क्रांति ला दी, छोटी काली पोशाक और शैनल नंबर 5 परफ्यूम पेश किया, जो परिष्कार और विलासिता का प्रतीक है।',
        'brand_2_title' => 'गुच्ची',
        'brand_2_desc' => 'बोल्ड डिजाइनों और शानदार इतालवी शिल्पकला के लिए प्रसिद्ध।',
        'brand_2_detail' => 'गुच्ची अपने उदार और जीवंत डिजाइनों के लिए प्रसिद्ध है, जो पारंपरिक इतालवी शिल्पकला को समकालीन स्वाद के साथ मिश्रित करता है, वैश्विक फैशन रुझानों को प्रभावित करता है।',
        'brand_3_title' => 'लुई वुइटॉन',
        'brand_3_desc' => 'मोनोग्राम्ड सामान और उच्च-फैशन सहायक उपकरणों के लिए प्रसिद्ध।',
        'brand_3_detail' => 'लुई वुइटॉन विलासिता यात्रा का पर्याय है, जो प्रतिष्ठित मोनोग्राम्ड सामान और नवीन सहायक उपकरण प्रदान करता है जो उच्च फैशन को परिभाषित करते हैं।',
        'brand_4_title' => 'डायर',
        'brand_4_desc' => 'स्त्री सिल्हूट और क्रांतिकारी न्यू लुक के लिए प्रसिद्ध।',
        'brand_4_detail' => 'डायर ने अपने न्यू लुक के साथ युद्धोत्तर फैशन को बदल दिया, स्त्री सिल्हूट और शानदार कपड़ों पर जोर देकर, शिष्टता का मानक स्थापित किया।',
        'brand_11_title' => 'बलेन्सियागा',
        'brand_11_desc' => 'अग्रणी आकार और आधुनिक विलासिता के लिए प्रसिद्ध।',
        'brand_11_detail' => 'बलेन्सियागा ने अपनी सीमाओं को फोटा करने के लिए नवीन आकार और प्रयोगशील डिज़ाइन का उपयोग करती है, जो आधुनिक विलासिता मॉड को फिर से परिभाषित करती है।',
        'brand_12_title' => 'बर्बेरी',
        'brand_12_desc' => 'अपने आइकॉनिक ट्रेंच कोट और चेक पैटर्न के लिए प्रसिद्ध।',
        'brand_12_detail' => 'बर्बेरी की विरासत उसके टाइमलेस ट्रेंच कोट और विशिष्ट चेक पैटर्न में निहित है, जो परंपरा को समकालीन शैली के साथ मिश्रित करता है।',
        'brand_13_title' => 'वैलेंटिनो',
        'brand_13_desc' => 'रोमांटिक डिज़ाइन और सिग्नेचर लाल गाउन के लिए प्रसिद्ध।',
        'brand_13_detail' => 'वैलेंटिनो अपनी रोमांटिक सौंदर्यशास्त्र और जीवंत लाल पोशाकों के लिए प्रसिद्ध है, जो हाई फैशन में एलिगेंस और जुनून का प्रतीक है।',
        'brand_14_title' => 'गिवेंची',
        'brand_14_desc' => 'परिष्कृत एलिगेंस और आइकॉनिक डिज़ाइन के लिए प्रसिद्ध।',
        'brand_14_detail' => 'गिवेंची कुलीन वर्ग की एलिगेंस को आधुनिक सरलता के साथ मिश्रित करता है, जो ऑड्रे हेपबर्न जैसे स्टाइल आइकन द्वारा पहने जाने वाले आइकॉनिक टुकड़े बनाता है।',
        'brand_15_title' => 'सेंट लॉरेंट',
        'brand_15_desc' => 'एजी सोफिस्टिकेशन और रॉक-चिक स्टाइल के लिए प्रसिद्ध।',
        'brand_15_detail' => 'सेंट लॉरेंट ने महिलाओं के लिए टकेबे को आयोजित करके फैशन को फिर से परिभाषित किया, जो पुरुषी और महिला तत्वों को बोल्ड आदत के साथ संयोजित करते हैं।',
        'brand_16_title' => 'सेलीन',
        'brand_16_desc' => 'मिनिमलिस्ट डिज़ाइन और निर्दोष शिल्प कौशल के साथ आधुनिक विलासिता को फिर से परिभाषित करती है, जो कम दिखावटी एलिगेंस पर केंद्रित है।',
        'brand_17_title' => 'क्लोए',
        'brand_17_desc' => 'प्रवाहित सिल्हूट और नरम कपड़ों के साथ एक रोमांटिक, बोहेमियन सौंदर्यशास्त्र प्रदान करती है, जो प्रयासहीन स्त्रीत्व का प्रतीक है।',
        'brand_18_title' => 'डायर',
        'brand_18_desc' => 'स्त्री सिल्हूट और क्रांतिकारी न्यू लुक के लिए प्रसिद्ध।',
        'brand_18_detail' => 'डायर ने अपने न्यू लुक के साथ युद्धोत्तर फैशन को बदल दिया, स्त्री सिल्हूट और शानदार कपड़ों पर जोर देकर, शिष्टता का मानक स्थापित किया।',
        'brand_19_title' => 'वरसेस',
        'brand_19_desc' => 'मुख्य रूप से उत्कृष्ट छवियों और ग्लैमोरोयस स्टाइल के लिए प्रसिद्ध।',
        'brand_19_detail' => 'वरसेस को ग्लैमोरोयस डिज़ाइन, उत्कृष्ट रंग और ग्लैमोरोयस आदत के लिए प्रसिद्ध है।',
        'brand_20_title' => 'प्रादा',
        'brand_20_desc' => 'मिनिमलिस्ट डिज़ाइन और नवोन्मेषी सामग्रियों के लिए प्रसिद्ध।',
        'brand_20_detail' => 'प्रादा सादगीपूर्ण विलासिता को अत्याधुनिक सामग्रियों के साथ जोड़ती है, जो आधुनिक फैशन प्रेमियों के लिए कालातीत कृतियाँ बनाती है।'
    ]
];

// Additional brand data for brands 5-20
$additional_brands = [
    5 => [
        'title' => [
            'en' => 'Prada',
            'zh' => '普拉达',
            'ja' => 'プラダ',
            'ar' => 'برادا',
            'es' => 'Prada',
            'fr' => 'Prada',
            'ru' => 'Прада',
            'pt' => 'Prada',
            'de' => 'Prada',
            'hi' => 'प्रादा',
        ],
        'desc' => [
            'en' => 'Known for minimalist designs and innovative materials.',
            'zh' => '以极简设计和创新材质著称。',
            'ja' => 'ミニマリストデザインと革新的な素材で知られる。',
            'ar' => 'معروفة بتصاميمها البسيطة وموادها المبتكرة.',
            'es' => 'Conocida por sus diseños minimalistas y materiales innovadores.',
            'fr' => 'Connue pour ses designs minimalistes et ses matériaux innovants.',
            'ru' => 'Известна минималистичным дизайном и инновационными материалами.',
            'pt' => 'Conhecida por designs minimalistas e materiais inovadores.',
            'de' => 'Bekannt für minimalistisches Design und innovative Materialien.',
            'hi' => 'मिनिमलिस्ट डिज़ाइन और नवोन्मेषी सामग्रियों के लिए प्रसिद्ध।',
        ],
        'detail' => [
            'en' => 'Prada combines understated luxury with cutting-edge materials, creating timeless pieces that resonate with modern fashion enthusiasts.',
            'zh' => '普拉达将低调的奢华与前沿材质结合，创造出深受现代时尚爱好者喜爱的永恒作品。',
            'ja' => 'プラダは控えめなラグジュアリーと最先端素材を融合し、現代のファッション愛好家に響くタイムレスな作品を生み出しています。',
            'ar' => 'برادا تجمع بين الفخامة البسيطة والمواد المتطورة، وتخلق قطعًا خالدة تروق لعشاق الموضة المعاصرين.',
            'es' => 'Prada combina el lujo discreto con materiales de vanguardia, creando piezas atemporales que resuenan con los entusiastas de la moda moderna.',
            'fr' => 'Prada associe le luxe discret à des matériaux de pointe, créant des pièces intemporelles qui séduisent les passionnés de mode moderne.',
            'ru' => 'Прада сочетает сдержанную роскошь с передовыми материалами, создавая вечные изделия, которые находят отклик у современных модников.',
            'pt' => 'A Prada combina luxo discreto com materiais de ponta, criando peças atemporais que ressoam com entusiastas da moda moderna.',
            'de' => 'Prada vereint zurückhaltenden Luxus mit modernsten Materialien und schafft zeitlose Stücke, die bei Modebegeisterten Anklang finden.',
            'hi' => 'प्रादा सादगीपूर्ण विलासिता को अत्याधुनिक सामग्रियों के साथ जोड़ती है, जो आधुनिक फैशन प्रेमियों के लिए कालातीत कृतियाँ बनाती है।',
        ],
        'website' => 'https://www.prada.com'
    ],
    6 => [
        'title' => [
            'en' => 'Yves Saint Laurent',
            'zh' => '伊夫·圣罗兰',
            'ja' => 'イヴ・サンローラン',
            'ar' => 'إيف سان لوران',
            'es' => 'Yves Saint Laurent',
            'fr' => 'Yves Saint Laurent',
            'ru' => 'Ив Сен-Лоран',
            'pt' => 'Yves Saint Laurent',
            'de' => 'Yves Saint Laurent',
            'hi' => 'येव्स सेन लॉरेन',
        ],
        'desc' => [
            'en' => 'Pioneered women power dressing and bold aesthetics.',
            'zh' => '开创了女性权力着装和大胆美学。',
            'ja' => '女性のパワードレッシングと大胆な美学を切り開いた。',
            'ar' => 'رائد في ملابس القوة النسائية والجماليات الجريئة.',
            'es' => 'Fue pionero en la ropa de poder para mujeres y la estética audaz.',
            'fr' => 'Fût le pionnier de la tenue de puissance pour les femmes et l\'esthétique audacieuse.',
            'ru' => 'Был пионером женской мощной одежды и смелой эстетики.',
            'pt' => 'Foi pioneiro em roupas de poder para mulheres e estética ousada.',
            'de' => 'War der Pionier für Frauen-Macht-Outfits und die ehrgeizige Êsthetik.',
            'hi' => 'महिलाओं के लिए शक्तिशाली आदत और बोल्ड आदत को शुरू करने वाला था।',
        ],
        'detail' => [
            'en' => 'Yves Saint Laurent redefined fashion by introducing the tuxedo for women, blending masculine and feminine elements with bold creativity.',
            'zh' => '伊夫·圣罗兰通过为女性引入燕尾服，重新定义了时尚，将阳刚与阴柔元素大胆融合。',
            'ja' => 'イヴ・サンローランは女性用タキシードを導入し、男性的要素と女性的要素を大胆に融合してファッションを再定義しました。',
            'ar' => 'أعاد إيف سان لوران تعريف الموضة من خلال تقديم التوكسيدو للنساء، ودمج العناصر الذكورية والأنثوية بإبداع جريء.',
            'es' => 'Yves Saint Laurent revolucionó la moda al introducir el tuxedo para mujeres, fusionando elementos masculinos y femeninos con creatividad audaz.',
            'fr' => 'Yves Saint Laurent a révolutionné la mode en introduisant le tuxedo pour les femmes, en fusionnant éléments masculins et féminins avec créativité audacieuse.',
            'ru' => 'Ив Сен-Лоран переосмыслил моду, введя туалет для женщин, объединив мужские и женские элементы с безграничной креативностью.',
            'pt' => 'Yves Saint Laurent revolucionou a moda ao introduzir o tuxedo para mulheres, fundindo elementos masculinos e femininos com criatividade ousada.',
            'de' => 'Yves Saint Laurent revolutionierte die Mode, indem er das Tuxedo für Frauen einführte, indem er männliche und weibliche Elemente mit großer Kreativität verband.',
            'hi' => 'येव्स सेन लॉरेन ने महिलाओं के लिए टकेबे को आयोजित करके फैशन को फिर से परिभाषित किया, जो पुरुषी और महिला तत्वों को बोल्ड आदत के साथ संयोजित करते हैं।',
        ],
        'website' => 'https://www.ysl.com'
    ],
    7 => [
        'title' => [
            'en' => 'Versace',
            'zh' => '范思哲',
            'ja' => 'ヴェルサーチェ',
            'ar' => 'فيرساتشي',
            'es' => 'Versace',
            'fr' => 'Versace',
            'ru' => 'Версаче',
            'pt' => 'Versace',
            'de' => 'Versace',
            'hi' => 'वरसेस',
        ],
        'desc' => [
            'en' => 'Famous for vibrant prints and glamorous style.',
            'zh' => '以鲜艳印花和魅力风格著称。',
            'ja' => '鮮やかなプリントとグラマラスなスタイルで有名。',
            'ar' => 'معروفة بطبعاتها الزاهية وأسلوبها الساحر.',
            'es' => 'Conocida por sus diseños vibrantes y estilo glamuroso.',
            'fr' => 'Connue pour ses motifs vibrants et son style élégant.',
            'ru' => 'Известна яркими принтами и элегантным стилем.',
            'pt' => 'Famosa por desenhos vibrantes e estilo glamuroso.',
            'de' => 'Bekannt für vibrante Drucke und eklägten Stil.',
            'hi' => 'मुख्य रूप से उत्कृष्ट छवियों और ग्लैमोरोयस स्टाइल के लिए प्रसिद्ध।',
        ],
        'detail' => [
            'en' => 'Versace is celebrated for its daring designs, vibrant colors, and opulent aesthetic, embodying Italian extravagance and boldness.',
            'zh' => '范思哲以大胆设计、鲜艳色彩和奢华美学著称，体现了意大利的奢靡与大胆。',
            'ja' => 'ヴェルサーチェは大胆なデザイン、鮮やかな色彩、豪華な美学で称賛され、イタリアの贅沢さと大胆さを体現しています。',
            'ar' => 'تحتفل فيرساتشي بتصاميمها الجريئة وألوانها الزاهية وجمالها الفاخر، مجسدة البذخ والجرأة الإيطالية.',
            'es' => 'Versace es celebrada por sus diseños audaces, colores vibrantes y estética opulenta, que representan la extravagancia y la audacia italiana.',
            'fr' => 'Versace est célèbre pour ses designs audacieux, ses couleurs vives et son esthétique luxueux, incarnant l\'extravagance et l\'audace italienne.',
            'ru' => 'Версаче славится своим безграничным дизайном, яркими цветами и элегантным стилем, который воплощает итальянскую роскошь и смелость.',
            'pt' => 'Versace é famosa por seus designs ousados, cores vibrantes e estilo glamuroso, que representam a extravagância e a audácia italiana.',
            'de' => 'Versace ist bekannt für seine ehrgeizigen Designs, farbenfrohe Farben und das luxuriöse Aussehen, das die italienische Extravaganz und den Mut zum Ausdruck bringt.',
            'hi' => 'वरसेस को ग्लैमोरोयस डिज़ाइन, उत्कृष्ट रंग और ग्लैमोरोयस आदत के लिए प्रसिद्ध है।',
        ],
        'website' => 'https://www.versace.com'
    ],
    8 => [
        'title' => [
            'en' => 'Balenciaga',
            'zh' => '巴黎世家',
            'ja' => 'バレンシアガ',
            'ar' => 'بالينسياغا',
            'es' => 'Balenciaga',
            'fr' => 'Balenciaga',
            'ru' => 'Балескиага',
            'pt' => 'Balenciaga',
            'de' => 'Balenciaga',
            'hi' => 'बलेन्सियागा',
        ],
        'desc' => [
            'en' => 'Renowned for avant-garde shapes and modern luxury.',
            'zh' => '以前卫造型和现代奢华著称。',
            'ja' => 'アバンギャルドなシルエットと現代的なラグジュアリーで有名。',
            'ar' => 'معروفة بالأشكال الطليعية والفخامة الحديثة.',
            'es' => 'Renombrada por formas avanzadas y lujo moderno.',
            'fr' => 'Renommée pour des silhouettes avant-gardistes et luxe moderne.',
            'ru' => 'Известна авангардной формой и современным роскошем.',
            'pt' => 'Renomada por formas avulsas e luxo moderno.',
            'de' => 'Renominiert für avantgardistische Formen und modernes Luxus.',
            'hi' => 'अग्रणी आकार और आधुनिक विलासिता के लिए प्रसिद्ध।',
        ],
        'detail' => [
            'en' => 'Balenciaga pushes boundaries with innovative silhouettes and experimental designs, redefining contemporary luxury fashion.',
            'zh' => '巴黎世家以创新廓形和实验性设计突破界限，重新定义了当代奢侈时尚。',
            'ja' => 'バレンシアガは革新的なシルエットと実験的なデザインで限界を押し広げ、現代のラグジュアリーファッションを再定義しています。',
            'ar' => 'تدفع بالينسياغا الحدود من خلال الصور الظلية المبتكرة والتصاميم التجريبية، معيدة تعريف الموضة الفاخرة المعاصرة.',
            'es' => 'Balenciaga rompe los límites con siluetas innovadoras y diseños experimentales, redefiniendo la moda de lujo contemporánea.',
            'fr' => 'Balenciaga pousse les limites avec des silhouettes innovantes et des conceptions expérimentales, redéfinissant la mode de luxe contemporaine.',
            'ru' => 'Балескиага выходит за рамки с использованием инновационных силуэтов и экспериментальных дизайнов, переопределяя современный роскошный стиль.',
            'pt' => 'Balenciaga quebra limites com siluetas inovadoras e designs experimentais, redefinindo a moda de luxo moderna.',
            'de' => 'Balenciaga setzt Grenzen mit innovativen Silhouetten und experimentellen Designs, die die moderne Luxusmode neu definieren.',
            'hi' => 'बलेन्सियागा ने अपनी सीमाओं को फोटा करने के लिए नवीन आकार और प्रयोगशील डिज़ाइन का उपयोग करती है, जो आधुनिक विलासिता मॉड को फिर से परिभाषित करती है।',
        ],
        'website' => 'https://www.balenciaga.com'
    ],
    9 => [
        'title' => [
            'en' => 'Hermès',
            'zh' => '爱马仕',
            'ja' => 'エルメス',
            'ar' => 'هيرميس',
            'es' => 'Hermès',
            'fr' => 'Hermès',
            'ru' => 'Эрмес',
            'pt' => 'Hermès',
            'de' => 'Hermès',
            'hi' => 'हर्मेस',
        ],
        'desc' => [
            'en' => 'Known for exquisite craftsmanship and iconic bags.',
            'zh' => '以精湛工艺和标志性包袋著称。',
            'ja' => '卓越した職人技とアイコニックなバッグで知られる。',
            'ar' => 'معروف بالحرفية الرائعة والحقائب الأيقونية.',
            'es' => 'Conocido por su exquisita artesanía y bolsos icónicos.',
            'fr' => 'Connu pour son artisanat exquis et ses sacs iconiques.',
            'ru' => 'Известен своим мастерством и культовыми сумками.',
            'pt' => 'Conhecido pelo artesanato requintado e bolsas icônicas.',
            'de' => 'Bekannt für exquisite Handwerkskunst und ikonische Taschen.',
            'hi' => 'उत्कृष्ट शिल्प कौशल और प्रतिष्ठित बैग्स के लिए प्रसिद्ध।',
        ],
        'detail' => [
            'en' => 'Hermès epitomizes luxury with its handcrafted leather goods, including the iconic Birkin and Kelly bags, synonymous with exclusivity.',
            'zh' => '爱马仕以手工皮具闻名，包括标志性的Birkin和Kelly包，象征着独特与奢华。',
            'ja' => 'エルメスは手作りのレザーグッズで贅沢を体現し、象徴的なバーキンやケリーのバッグで知られています。',
            'ar' => 'هيرميس يجسد الفخامة بمنتجاته الجلدية اليدوية، بما في ذلك حقائب بيركين وكيللي الأيقونية، مرادف للتميز.',
            'es' => 'Hermès personifica el lujo con sus artículos de cuero hechos a mano, incluidos los icónicos bolsos Birkin y Kelly, sinónimo de exclusividad.',
            'fr' => 'Hermès incarne le luxe avec ses articles en cuir faits main, dont les sacs iconiques Birkin et Kelly, synonymes d\'exclusivité.',
            'ru' => 'Эрмес воплощает роскошь своими изделиями из кожи ручной работы, включая культовые сумки Биркин и Келли, синонимы эксклюзивности.',
            'pt' => 'A Hermès personifica o luxo com seus artigos de couro feitos à mão, incluindo as icônicas bolsas Birkin e Kelly, sinônimo de exclusividade.',
            'de' => 'Hermès verkörpert Luxus mit handgefertigten Lederwaren, darunter die ikonischen Birkin- und Kelly-Taschen, die für Exklusivität stehen.',
            'hi' => 'हर्मेस अपने हस्तनिर्मित चमड़े के सामान, विशेष रूप से प्रतिष्ठित बिर्किन और केली बैग्स के लिए विलासिता का प्रतीक है।',
        ],
        'website' => 'https://www.hermes.com'
    ],
    10 => [
        'title' => [
            'en' => 'Fendi',
            'zh' => '芬迪',
            'ja' => 'フェンディ',
            'ar' => 'فيندي',
            'es' => 'Fendi',
            'fr' => 'Fendi',
            'ru' => 'Фенди',
            'pt' => 'Fendi',
            'de' => 'Fendi',
            'hi' => 'फेंडी',
        ],
        'desc' => [
            'en' => 'Celebrated for fur expertise and bold accessories.',
            'zh' => '以皮草专业和标志性配饰著称。',
            'ja' => 'ファーの専門知識と大胆なアクセサリーで知られる。',
            'ar' => 'معروف بخبرة الجلد والإكسسوارات الأيقونية.',
            'es' => 'Celebrado por su conocimiento del cuero y accesorios icónicos.',
            'fr' => 'Célèbre pour son expertise en fourrure et ses accessoires audacieux.',
            'ru' => 'Известен своим мастерством в обработке кожи и яркими аксессуарами.',
            'pt' => 'Celebrado pela expertise em couro e acessórios icônicos.',
            'de' => 'Gefeiert für Fur-Experten und auffällige Accessoires.',
            'hi' => 'फुर विशेषज्ञता और बोल्ड एक्सेसोरी के लिए प्रसिद्ध।',
        ],
        'detail' => [
            'en' => 'Fendi combines Italian craftsmanship with innovative fur techniques and statement accessories, shaping luxury fashion trends.',
            'zh' => '芬迪将意大利工艺与创新皮草技术和标志性配饰相结合，塑造奢华时尚趋势。',
            'ja' => 'フェンディはイタリアの職人技と革新的なファー技術、そしてステートメントアクセサリーを組み合わせ、モダンなファッションのトレンドを作り出しています。',
            'ar' => 'فيندي يجمع بين الصناعة الإيطالية والتقنيات المبتكرة للجلد والإكسسوارات الأيقونية، مما يؤدي إلى تصاميم أزياء عالية الذوق.',
            'es' => 'Fendi combina la artesanía italiana con técnicas innovadoras de cuero y accesorios icónicos, creando tendencias de moda de lujo.',
            'fr' => 'Fendi mêle artisanat italien, techniques innovantes en fourrure et accessoires iconiques, créant des tendances de mode de luxe.',
            'ru' => 'Фенди сочетает итальянское мастерство с инновационными технологиями обработки кожи и яркими аксессуарами, создавая модные тенденции высокого уровня.',
            'pt' => 'Fendi combina artesanato italiano, técnicas inovadoras de couro e acessórios icônicos, criando tendências de moda de luxo.',
            'de' => 'Fendi vereint italienisches Handwerk, innovative Ledertechnik und auffällige Accessoires, um Luxusmode Trends zu formen.',
            'hi' => 'फेंडी अपने इतालवी व्यवस्थाई और नवोन्मेषी फुर तकनीकों के साथ बोल्ड एक्सेसोरी को मिलाकर फैशन के ट्रेंड्स को बनाती है।',
        ],
        'website' => 'https://www.fendi.com'
    ],
    11 => [
        'title' => [
            'en' => 'Armani',
            'zh' => '阿玛尼',
            'ja' => 'アルマーニ',
            'ar' => 'أرماني',
            'es' => 'Armani',
            'fr' => 'Armani',
            'ru' => 'Армани',
            'pt' => 'Armani',
            'de' => 'Armani',
            'hi' => 'अरमानी'
        ],
        'desc' => [
            'en' => 'Known for sleek tailoring and timeless elegance.',
            'zh' => '以简洁裁剪和永恒优雅著称。',
            'ja' => 'スリムな仕立てと時代を超えたエレガンスで知られる。',
            'ar' => 'معروف بالخياطة الأنيقة والأناقة الخالدة.',
            'es' => 'Conocido por su sastrería elegante y elegancia atemporal.',
            'fr' => 'Connu pour sa coupe élégante et son élégance intemporelle.',
            'ru' => 'Известен элегантным кроем и вневременной элегантностью.',
            'pt' => 'Conhecido por sua alfaiataria elegante e elegância atemporal.',
            'de' => 'Bekannt für elegante Schnitte und zeitlose Eleganz.',
            'hi' => 'स्लीक टेलरिंग और टाइमलेस एलिगेंस के लिए जाना जाता है।'
        ],
        'detail' => [
            'en' => 'Armani is renowned for its sophisticated tailoring and minimalist designs, offering effortless elegance for modern wardrobes.',
            'zh' => '阿玛尼以其高级裁剪和极简设计闻名，为现代衣橱提供无与伦比的优雅。',
            'ja' => 'アルマーニは洗練された仕立てとミニマリストデザインで知られ、現代のワードローブに自然なエレガンスを提供します。',
            'ar' => 'أرماني معروف بتصميماته المتطورة والتصاميم البسيطة، مما يوفر أناقة سهلة للخزائن العصرية.',
            'es' => 'Armani es reconocido por su sastrería sofisticada y diseños minimalistas, ofreciendo elegancia sin esfuerzo para guardarropas modernos.',
            'fr' => 'Armani est reconnu pour sa coupe sophistiquée et ses designs minimalistes, offrant une élégance naturelle pour les garde-robes modernes.',
            'ru' => 'Армани славится своей изысканной кройкой и минималистичным дизайном, предлагая естественную элегантность для современного гардероба.',
            'pt' => 'Armani é conhecido por sua alfaiataria sofisticada e designs minimalistas, oferecendo elegância natural para guarda-roupas modernos.',
            'de' => 'Armani ist bekannt für seine anspruchsvolle Schneiderei und minimalistisches Design, das natürliche Eleganz für moderne Garderoben bietet.',
            'hi' => 'अरमानी अपने परिष्कृत टेलरिंग और मिनिमलिस्ट डिज़ाइन के लिए प्रसिद्ध है, जो आधुनिक वार्डरोब के लिए प्रयासहीन एलिगेंस प्रदान करता है।'
        ],
        'website' => 'https://www.armani.com'
    ],
    12 => [
        'title' => [
            'en' => 'Burberry',
            'zh' => '博柏利',
            'ja' => 'バーバリー',
            'ar' => 'بوربري',
            'es' => 'Burberry',
            'fr' => 'Burberry',
            'ru' => 'Барберри',
            'pt' => 'Burberry',
            'de' => 'Burberry',
            'hi' => 'बर्बेरी'
        ],
        'desc' => [
            'en' => 'Famous for its iconic trench coats and check pattern.',
            'zh' => '以其标志性风衣和格纹图案著称。',
            'ja' => 'アイコニックなトレンチコートとチェック柄で有名。',
            'ar' => 'معروفة بمعاطفها الشهيرة ونسيجها المربع.',
            'es' => 'Famosa por sus gabardinas icónicas y patrón de cuadros.',
            'fr' => 'Célèbre pour ses trenchs iconiques et son motif à carreaux.',
            'ru' => 'Известна своими культовыми тренчами и клетчатым узором.',
            'pt' => 'Famosa por seus trench coats icônicos e padrão xadrez.',
            'de' => 'Berühmt für seine ikonischen Trenchcoats und Karomuster.',
            'hi' => 'अपने आइकॉनिक ट्रेंच कोट और चेक पैटर्न के लिए प्रसिद्ध।'
        ],
        'detail' => [
            'en' => 'Burberry heritage lies in its timeless trench coats and distinctive check pattern, blending tradition with contemporary style.',
            'zh' => '博柏利的传统在于其永恒的风衣和独特的格纹图案，将传统与当代风格完美融合。',
            'ja' => 'バーバリーの伝統は、時代を超えたトレンチコートと特徴的なチェック柄にあり、伝統と現代的なスタイルを融合させています。',
            'ar' => 'تراث بوربري يكمن في معاطفها الخالدة ونسيجها المميز، مما يدمج التقاليد مع الأسلوب المعاصر.',
            'es' => 'El legado de Burberry radica en sus gabardinas atemporales y su distintivo patrón de cuadros, combinando tradición con estilo contemporáneo.',
            'fr' => 'L\'héritage de Burberry réside dans ses trenchs intemporels et son motif à carreaux distinctif, alliant tradition et style contemporain.',
            'ru' => 'Наследие Барберри заключается в его вневременных тренчах и отличительном клетчатом узоре, сочетающем традиции с современным стилем.',
            'pt' => 'O legado da Burberry está em seus trench coats atemporais e padrão xadrez distintivo, misturando tradição com estilo contemporâneo.',
            'de' => 'Das Erbe von Burberry liegt in seinen zeitlosen Trenchcoats und dem unverwechselbaren Karomuster, das Tradition mit zeitgenössischem Stil verbindet.',
            'hi' => 'बर्बेरी की विरासत उसके टाइमलेस ट्रेंच कोट और विशिष्ट चेक पैटर्न में निहित है, जो परंपरा को समकालीन शैली के साथ मिश्रित करता है।'
        ],
        'website' => 'https://www.burberry.com'
    ],
    13 => [
        'title' => [
            'en' => 'Valentino',
            'zh' => '华伦天奴',
            'ja' => 'ヴァレンティノ',
            'ar' => 'فالنتينو',
            'es' => 'Valentino',
            'fr' => 'Valentino',
            'ru' => 'Валентино',
            'pt' => 'Valentino',
            'de' => 'Valentino',
            'hi' => 'वैलेंटिनो'
        ],
        'desc' => [
            'en' => 'Renowned for romantic designs and signature red gowns.',
            'zh' => '以浪漫设计和标志性红色礼服著称。',
            'ja' => 'ロマンティックなデザインとシグネチャーの赤いドレスで有名。',
            'ar' => 'معروف بتصاميمه الرومانسية وفساتينه الحمراء المميزة.',
            'es' => 'Renombrado por sus diseños románticos y vestidos rojos característicos.',
            'fr' => 'Renommé pour ses designs romantiques et ses robes rouges emblématiques.',
            'ru' => 'Известен романтичными дизайнами и фирменными красными платьями.',
            'pt' => 'Renomado por seus designs românticos e vestidos vermelhos característicos.',
            'de' => 'Bekannt für romantische Designs und charakteristische rote Kleider.',
            'hi' => 'रोमांटिक डिज़ाइन और सिग्नेचर लाल गाउन के लिए प्रसिद्ध।'
        ],
        'detail' => [
            'en' => 'Valentino is celebrated for its romantic aesthetic and vibrant red dresses, embodying elegance and passion in high fashion.',
            'zh' => '华伦天奴以其浪漫美学和鲜艳的红色礼服闻名，在高定时尚中体现优雅与激情。',
            'ja' => 'ヴァレンティノはロマンティックな美学と鮮やかな赤いドレスで称賛され、ハイファッションでエレガンスと情熱を体現しています。',
            'ar' => 'فالنتينو مشهور بجماليته الرومانسية وفساتينه الحمراء النابضة بالحياة، مما يجسد الأناقة والعاطفة في الأزياء الراقية.',
            'es' => 'Valentino es celebrado por su estética romántica y vestidos rojos vibrantes, encarnando elegancia y pasión en la alta costura.',
            'fr' => 'Valentino est célèbre pour son esthétique romantique et ses robes rouges vibrantes, incarnant l\'élégance et la passion dans la haute couture.',
            'ru' => 'Валентино славится своей романтичной эстетикой и яркими красными платьями, воплощая элегантность и страсть в высокой моде.',
            'pt' => 'Valentino é celebrado por sua estética romântica e vestidos vermelhos vibrantes, encarnando elegância e paixão na alta costura.',
            'de' => 'Valentino ist bekannt für seine romantische Ästhetik und lebendige rote Kleider, die Eleganz und Leidenschaft in der Haute Couture verkörpern.',
            'hi' => 'वैलेंटिनो अपनी रोमांटिक सौंदर्यशास्त्र और जीवंत लाल पोशाकों के लिए प्रसिद्ध है, जो हाई फैशन में एलिगेंस और जुनून का प्रतीक है।'
        ],
        'website' => 'https://www.valentino.com'
    ],
    14 => [
        'title' => [
            'en' => 'Givenchy',
            'zh' => '纪梵希',
            'ja' => 'ジバンシー',
            'ar' => 'جيفنشي',
            'es' => 'Givenchy',
            'fr' => 'Givenchy',
            'ru' => 'Живанши',
            'pt' => 'Givenchy',
            'de' => 'Givenchy',
            'hi' => 'गिवेंची'
        ],
        'desc' => [
            'en' => 'Known for refined elegance and iconic designs.',
            'zh' => '以精致优雅和标志性设计著称。',
            'ja' => '洗練されたエレガンスとアイコニックなデザインで知られる。',
            'ar' => 'معروف بالأناقة المكررة والتصاميم الأيقونية.',
            'es' => 'Conocido por su elegancia refinada y diseños icónicos.',
            'fr' => 'Connu pour son élégance raffinée et ses designs iconiques.',
            'ru' => 'Известен изысканной элегантностью и культовыми дизайнами.',
            'pt' => 'Conhecido por sua elegância refinada e designs icônicos.',
            'de' => 'Bekannt für raffinierte Eleganz und ikonische Designs.',
            'hi' => 'परिष्कृत एलिगेंस और आइकॉनिक डिज़ाइन के लिए प्रसिद्ध।'
        ],
        'detail' => [
            'en' => 'Givenchy blends aristocratic elegance with modern simplicity, creating iconic pieces worn by style icons like Audrey Hepburn.',
            'zh' => '纪梵希将贵族优雅与现代简约相融合，创造出奥黛丽·赫本等时尚偶像穿着的标志性作品。',
            'ja' => 'ジバンシーは貴族的なエレガンスと現代的なシンプルさを融合させ、オードリー・ヘプバーンのようなスタイルアイコンが着用するアイコニックな作品を生み出しています。',
            'ar' => 'يجمع جيفنشي بين الأناقة الأرستقراطية والبساطة العصرية، مما يخلق قطعًا أيقونية يرتديها أيقونات الأزياء مثل أودري هيبورن.',
            'es' => 'Givenchy combina la elegancia aristocrática con la simplicidad moderna, creando piezas icónicas usadas por íconos del estilo como Audrey Hepburn.',
            'fr' => 'Givenchy mêle élégance aristocratique et simplicité moderne, créant des pièces iconiques portées par des icônes du style comme Audrey Hepburn.',
            'ru' => 'Живанши сочетает аристократическую элегантность с современной простотой, создавая культовые изделия, которые носили иконы стиля, такие как Одри Хепберн.',
            'pt' => 'Givenchy combina elegância aristocrática com simplicidade moderna, criando peças icônicas usadas por ícones do estilo como Audrey Hepburn.',
            'de' => 'Givenchy verbindet aristokratische Eleganz mit moderner Einfachheit und schafft ikonische Stücke, die von Stilikonen wie Audrey Hepburn getragen werden.',
            'hi' => 'गिवेंची कुलीन वर्ग की एलिगेंस को आधुनिक सरलता के साथ मिश्रित करता है, जो ऑड्रे हेपबर्न जैसे स्टाइल आइकन द्वारा पहने जाने वाले आइकॉनिक टुकड़े बनाता है।'
        ],
        'website' => 'https://www.givenchy.com'
    ],
    15 => [
        'title' => [
            'en' => 'Saint Laurent',
            'zh' => '圣罗兰',
            'ja' => 'サンローラン',
            'ar' => 'سان لوران',
            'es' => 'Saint Laurent',
            'fr' => 'Saint Laurent',
            'ru' => 'Сен-Лоран',
            'pt' => 'Saint Laurent',
            'de' => 'Saint Laurent',
            'hi' => 'सेंट लॉरेंट'
        ],
        'desc' => [
            'en' => 'Famous for edgy sophistication and rock-chic style.',
            'zh' => '以前卫的精致和摇滚时尚风格著称。',
            'ja' => 'エッジの効いた洗練さとロックシックスタイルで有名。',
            'ar' => 'معروف بأناقته الجريئة وأسلوبه الراقي الصاخب.',
            'es' => 'Famoso por su sofisticación atrevida y estilo rock-chic.',
            'fr' => 'Célèbre pour sa sophistication audacieuse et son style rock-chic.',
            'ru' => 'Известен дерзкой изысканностью и рок-шиком стилем.',
            'pt' => 'Famoso por sua sofisticação ousada e estilo rock-chic.',
            'de' => 'Bekannt für seine gewagte Eleganz und den Rock-Chic-Stil.',
            'hi' => 'एजी सोफिस्टिकेशन और रॉक-चिक स्टाइल के लिए प्रसिद्ध।'
        ],
        'detail' => [
            'en' => 'Saint Laurent combines Parisian elegance with a rebellious edge, defining modern luxury with its rock-inspired aesthetic.',
            'zh' => '圣罗兰将巴黎优雅与叛逆边缘相结合，以其摇滚美学定义现代奢华。',
            'ja' => 'サンローランはパリのエレガンスと反逆的なエッジを組み合わせ、ロックにインスパイアされた美学で現代のラグジュアリーを定義しています。',
            'ar' => 'يجمع سان لوران بين الأناقة الباريسية والحافة المتمردة، مما يعرف الفخامة العصرية بجماليتها المستوحاة من موسيقى الروك.',
            'es' => 'Saint Laurent combina la elegancia parisina con un toque rebelde, definiendo el lujo moderno con su estética inspirada en el rock.',
            'fr' => 'Saint Laurent combine l\'élégance parisienne avec une touche rebelle, définissant le luxe moderne avec son esthétique inspirée du rock.',
            'ru' => 'Сен-Лоран сочетает парижскую элегантность с бунтарским духом, определяя современную роскошь своей эстетикой, вдохновленной роком.',
            'pt' => 'Saint Laurent combina a elegância parisiense com um toque rebelde, definindo o luxo moderno com sua estética inspirada no rock.',
            'de' => 'Saint Laurent verbindet Pariser Eleganz mit einem rebellischen Touch und definiert modernen Luxus mit seiner von Rock inspirierten Ästhetik.',
            'hi' => 'सेंट लॉरेंट पेरिस की एलिगेंस को विद्रोही किनारे के साथ जोड़ता है, जो अपनी रॉक-प्रेरित सौंदर्यशास्त्र के साथ आधुनिक विलासिता को परिभाषित करता है।'
        ],
        'website' => 'https://www.ysl.com'
    ],
    16 => [
        'title' => [
            'en' => 'Celine',
            'zh' => '赛琳',
            'ja' => 'セリーヌ',
            'ar' => 'سيلين',
            'es' => 'Celine',
            'fr' => 'Celine',
            'ru' => 'Селин',
            'pt' => 'Celine',
            'de' => 'Celine',
            'hi' => 'सेलीन'
        ],
        'desc' => [
            'en' => 'Known for minimalist luxury and clean lines.',
            'zh' => '以极简奢华和简洁线条著称。',
            'ja' => 'ミニマリストなラグジュアリーとクリーンなラインで知られる。',
            'ar' => 'معروف بالفخامة البسيطة والخطوط النظيفة.',
            'es' => 'Conocida por su lujo minimalista y líneas limpias.',
            'fr' => 'Connue pour son luxe minimaliste et ses lignes épurées.',
            'ru' => 'Известна минималистичной роскошью и чистыми линиями.',
            'pt' => 'Conhecida por seu luxo minimalista e linhas limpas.',
            'de' => 'Bekannt für minimalistischen Luxus und klare Linien.',
            'hi' => 'मिनिमलिस्ट लक्जरी और क्लीन लाइन्स के लिए प्रसिद्ध।'
        ],
        'detail' => [
            'en' => 'Celine redefines modern luxury with its minimalist designs and impeccable craftsmanship, focusing on understated elegance.',
            'zh' => '赛琳以其极简设计和精湛工艺重新定义现代奢华，专注于低调优雅。',
            'ja' => 'セリーヌはミニマリストなデザインと完璧な職人技で現代のラグジュアリーを再定義し、控えめなエレガンスに焦点を当てています。',
            'ar' => 'تعيد سيلين تعريف الفخامة العصرية بتصاميمها البسيطة وحرفيتها المثالية، مع التركيز على الأناقة البسيطة.',
            'es' => 'Celine redefine el lujo moderno con sus diseños minimalistas y su impecable artesanía, centrándose en la elegancia discreta.',
            'fr' => 'Celine redéfinit le luxe moderne avec ses designs minimalistes et son artisanat impeccable, en se concentrant sur l\'élégance discrète.',
            'ru' => 'Селин переосмысливает современную роскошь своими минималистичными дизайнами и безупречным мастерством, фокусируясь на сдержанной элегантности.',
            'pt' => 'Celine redefine o luxo moderno com seus designs minimalistas e artesanato impecável, focando na elegância discreta.',
            'de' => 'Celine definiert modernen Luxus neu mit minimalistischen Designs und makellosem Handwerk und konzentriert sich auf zurückhaltende Eleganz.',
            'hi' => 'सेलीन अपने मिनिमलिस्ट डिज़ाइन और निर्दोष शिल्प कौशल के साथ आधुनिक विलासिता को फिर से परिभाषित करती है, जो कम दिखावटी एलिगेंस पर केंद्रित है।'
        ],
        'website' => 'https://www.celine.com'
    ],
    17 => [
        'title' => [
            'en' => 'Chloé',
            'zh' => '蔻依',
            'ja' => 'クロエ',
            'ar' => 'كلوي',
            'es' => 'Chloé',
            'fr' => 'Chloé',
            'ru' => 'Клоэ',
            'pt' => 'Chloé',
            'de' => 'Chloé',
            'hi' => 'क्लोए'
        ],
        'desc' => [
            'en' => 'Celebrated for bohemian elegance and feminine style.',
            'zh' => '以波西米亚优雅和女性风格著称。',
            'ja' => 'ボヘミアンなエレガンスとフェミニンなスタイルで知られる。',
            'ar' => 'معروفة بالأناقة البوهيمية والأسلوب الأنثوي.',
            'es' => 'Celebrada por su elegancia bohemia y estilo femenino.',
            'fr' => 'Célèbre pour son élégance bohème et son style féminin.',
            'ru' => 'Известна богемной элегантностью и женственным стилем.',
            'pt' => 'Celebrada por sua elegância boêmia e estilo feminino.',
            'de' => 'Gefeiert für böhmische Eleganz und femininen Stil.',
            'hi' => 'बोहेमियन एलिगेंस और फेमिनिन स्टाइल के लिए प्रसिद्ध।'
        ],
        'detail' => [
            'en' => 'Chloé offers a romantic, bohemian aesthetic with flowing silhouettes and soft fabrics, embodying effortless femininity.',
            'zh' => '蔻依提供浪漫的波西米亚美学，流畅的廓形和柔软的面料，体现轻松的女性气质。',
            'ja' => 'クロエは流れるようなシルエットと柔らかな生地でロマンティックなボヘミアンな美学を提供し、自然なフェミニニティを体現しています。',
            'ar' => 'تقدم كلوي جمالية رومانسية بوهيمية مع صور ظلية متدفقة وأقمشة ناعمة، مما يجسد الأنوثة الطبيعية.',
            'es' => 'Chloé ofrece una estética romántica y bohemia con siluetas fluidas y telas suaves, encarnando la feminidad natural.',
            'fr' => 'Chloé offre une esthétique romantique et bohème avec des silhouettes fluides et des tissus doux, incarnant une féminité naturelle.',
            'ru' => 'Клоэ предлагает романтичную богемную эстетику с плавными силуэтами и мягкими тканями, воплощая естественную женственность.',
            'pt' => 'Chloé oferece uma estética romântica e boêmia com silhuetas fluidas e tecidos suaves, encarnando a feminilidade natural.',
            'de' => 'Chloé bietet eine romantische, böhmische Ästhetik mit fließenden Silhouetten und weichen Stoffen und verkörpert natürliche Weiblichkeit.',
            'hi' => 'क्लोए प्रवाहित सिल्हूट और नरम कपड़ों के साथ एक रोमांटिक, बोहेमियन सौंदर्यशास्त्र प्रदान करती है, जो प्रयासहीन स्त्रीत्व का प्रतीक है।'
        ],
        'website' => 'https://www.chloe.com'
    ],
    18 => [
        'title' => [
            'en' => 'Dolce & Gabbana',
            'zh' => '杜嘉班纳',
            'ja' => 'ドルチェ＆ガッバーナ',
            'ar' => 'دولتشي آند غابانا',
            'es' => 'Dolce & Gabbana',
            'fr' => 'Dolce & Gabbana',
            'ru' => 'Дольче и Габбана',
            'pt' => 'Dolce & Gabbana',
            'de' => 'Dolce & Gabbana',
            'hi' => 'डोल्से एंड गैबाना'
        ],
        'desc' => [
            'en' => 'Famous for opulent designs and Italian heritage.',
            'zh' => '以奢华设计和意大利传统著称。',
            'ja' => '豪華なデザインとイタリアの伝統で有名。',
            'ar' => 'معروفة بتصاميمها الفخمة والتراث الإيطالي.',
            'es' => 'Famosa por sus diseños opulentos y herencia italiana.',
            'fr' => 'Célèbre pour ses designs opulents et son héritage italien.',
            'ru' => 'Известна роскошными дизайнами и итальянским наследием.',
            'pt' => 'Famosa por seus designs opulentos e herança italiana.',
            'de' => 'Berühmt für opulente Designs und italienisches Erbe.',
            'hi' => 'वैभवशाली डिज़ाइन और इतालवी विरासत के लिए प्रसिद्ध।'
        ],
        'detail' => [
            'en' => 'Dolce & Gabbana celebrates Italian culture with lavish designs, vibrant prints, and a bold, glamorous aesthetic.',
            'zh' => '杜嘉班纳以奢华设计、鲜艳印花和大胆迷人的美学庆祝意大利文化。',
            'ja' => 'ドルチェ＆ガッバーナは豪華なデザイン、鮮やかなプリント、大胆で魅力的な美学でイタリア文化を祝います。',
            'ar' => 'تحتفل دولتشي آند غابانا بالثقافة الإيطالية بتصاميم فخمة وطباعة نابضة بالحياة وجمالية جريئة وساحرة.',
            'es' => 'Dolce & Gabbana celebra la cultura italiana con diseños lujosos, estampados vibrantes y una estética audaz y glamurosa.',
            'fr' => 'Dolce & Gabbana célèbre la culture italienne avec des designs somptueux, des imprimés vibrants et une esthétique audacieuse et glamour.',
            'ru' => 'Дольче и Габбана прославляет итальянскую культуру роскошными дизайнами, яркими принтами и смелой, гламурной эстетикой.',
            'pt' => 'Dolce & Gabbana celebra a cultura italiana com designs luxuosos, estampas vibrantes e uma estética ousada e glamourosa.',
            'de' => 'Dolce & Gabbana feiert die italienische Kultur mit luxuriösen Designs, lebendigen Drucken und einer mutigen, glamourösen Ästhetik.',
            'hi' => 'डोल्से एंड गैबाना भव्य डिज़ाइन, जीवंत प्रिंट और बोल्ड, ग्लैमरस सौंदर्यशास्त्र के साथ इतालवी संस्कृति का जश्न मनाता है।'
        ],
        'website' => 'https://www.dolcegabbana.com'
    ],
    19 => [
        'title' => [
            'en' => 'Miu Miu',
            'zh' => '缪缪',
            'ja' => 'ミュウミュウ',
            'ar' => 'ميوميو',
            'es' => 'Miu Miu',
            'fr' => 'Miu Miu',
            'ru' => 'Миу Миу',
            'pt' => 'Miu Miu',
            'de' => 'Miu Miu',
            'hi' => 'मिउ मिउ'
        ],
        'desc' => [
            'en' => 'Known for playful designs and youthful elegance.',
            'zh' => '以俏皮设计和年轻优雅著称。',
            'ja' => '遊び心のあるデザインと若々しいエレガンスで知られる。',
            'ar' => 'معروفة بتصاميمها المرحة والأناقة الشبابية.',
            'es' => 'Conocida por sus diseños juguetones y elegancia juvenil.',
            'fr' => 'Connue pour ses designs ludiques et son élégance juvénile.',
            'ru' => 'Известна игривыми дизайнами и юношеской элегантностью.',
            'pt' => 'Conhecida por seus designs brincalhões e elegância juvenil.',
            'de' => 'Bekannt für verspielte Designs und jugendliche Eleganz.',
            'hi' => 'खेल-खेल में डिज़ाइन और युवा एलिगेंस के लिए प्रसिद्ध।'
        ],
        'detail' => [
            'en' => 'Miu Miu blends quirky, youthful aesthetics with sophisticated craftsmanship, creating unique and vibrant fashion pieces.',
            'zh' => '缪缪将独特的年轻美学与精湛工艺相融合，创造出独特而充满活力的时尚作品。',
            'ja' => 'ミュウミュウは個性的で若々しい美学と洗練された職人技を融合させ、ユニークで活気のあるファッションピースを生み出しています。',
            'ar' => 'تمزج ميوميو بين الجمالية الشابة المميزة والحرفية المتطورة، مما يخلق قطع أزياء فريدة ونابضة بالحياة.',
            'es' => 'Miu Miu combina estética juvenil peculiar con artesanía sofisticada, creando piezas de moda únicas y vibrantes.',
            'fr' => 'Miu Miu mêle esthétique jeune excentrique et artisanat sophistiqué, créant des pièces de mode uniques et vibrantes.',
            'ru' => 'Миу Миу сочетает эксцентричную юношескую эстетику с изысканным мастерством, создавая уникальные и яркие модные изделия.',
            'pt' => 'Miu Miu combina estética jovem peculiar com artesanato sofisticado, criando peças de moda únicas e vibrantes.',
            'de' => 'Miu Miu verbindet exzentrische, jugendliche Ästhetik mit anspruchsvollem Handwerk und schafft einzigartige und lebendige Modestücke.',
            'hi' => 'मिउ मिउ विशिष्ट, युवा सौंदर्यशास्त्र को परिष्कृत शिल्प कौशल के साथ मिश्रित करती है, जो अद्वितीय और जीवंत फैशन टुकड़े बनाती है।'
        ],
        'website' => 'https://www.miumiu.com'
    ],
    20 => [
        'title' => [
            'en' => 'Bottega Veneta',
            'zh' => '宝缇嘉',
            'ja' => 'ボッテガ・ヴェネタ',
            'ar' => 'بوتيغا فينيتا',
            'es' => 'Bottega Veneta',
            'fr' => 'Bottega Veneta',
            'ru' => 'Боттега Венета',
            'pt' => 'Bottega Veneta',
            'de' => 'Bottega Veneta',
            'hi' => 'बोटेगा वेनेटा'
        ],
        'desc' => [
            'en' => 'Renowned for artisanal leatherwork and subtle luxury.',
            'zh' => '以手工皮革工艺和低调奢华著称。',
            'ja' => '職人技のレザーワークと控えめなラグジュアリーで知られる。',
            'ar' => 'معروفة بأعمالها الجلدية الحرفية والفخامة البسيطة.',
            'es' => 'Renombrada por su trabajo artesanal en cuero y lujo sutil.',
            'fr' => 'Renommée pour son travail artisanal du cuir et son luxe subtil.',
            'ru' => 'Известна своим ремесленным кожевенным делом и сдержанной роскошью.',
            'pt' => 'Renomada por seu trabalho artesanal em couro e luxo sutil.',
            'de' => 'Bekannt für kunsthandwerkliche Lederarbeit und subtilen Luxus.',
            'hi' => 'दस्तकारी चमड़े के काम और सूक्ष्म विलासिता के लिए प्रसिद्ध।'
        ],
        'detail' => [
            'en' => 'Bottega Veneta is celebrated for its intricate leather weaving and minimalist luxury, offering timeless and refined designs.',
            'zh' => '宝缇嘉以其复杂的皮革编织和极简奢华闻名，提供永恒而精致的作品。',
            'ja' => 'ボッテガ・ヴェネタは複雑なレザーウィービングとミニマリストなラグジュアリーで称賛され、タイムレスで洗練されたデザインを提供しています。',
            'ar' => 'تحتفل بوتيغا فينيتا بنسيجها الجلدي المعقد والفخامة البسيطة، مما يقدم تصاميم خالدة ومكررة.',
            'es' => 'Bottega Veneta es celebrada por su intrincado tejido de cuero y lujo minimalista, ofreciendo diseños atemporales y refinados.',
            'fr' => 'Bottega Veneta est célèbre pour son tissage de cuir complexe et son luxe minimaliste, offrant des designs intemporels et raffinés.',
            'ru' => 'Боттега Венета славится своим сложным плетением кожи и минималистичной роскошью, предлагая вневременные и изысканные дизайны.',
            'pt' => 'Bottega Veneta é celebrada por seu intrincado trabalho em couro e luxo minimalista, oferecendo designs atemporais e refinados.',
            'de' => 'Bottega Veneta ist bekannt für seine komplexe Lederweberei und minimalistischen Luxus und bietet zeitlose und raffinierte Designs.',
            'hi' => 'बोटेगा वेनेटा अपने जटिल चमड़े के बुनाई और मिनिमलिस्ट विलासिता के लिए प्रसिद्ध है, जो टाइमलेस और परिष्कृत डिज़ाइन प्रदान करता है।'
        ],
        'website' => 'https://www.bottegaveneta.com'
    ]
];

// Populate translations for brands 5-20 for all languages
foreach ($additional_brands as $i => $data) {
    foreach ([
        'en','zh','ja','ar','es','fr','ru','pt','de','hi'
    ] as $lang) {
        $title = isset($data['title'][$lang]) ? $data['title'][$lang] : $data['title']['en'];
        $desc = isset($data['desc'][$lang]) ? $data['desc'][$lang] : $data['desc']['en'];
        $detail = isset($data['detail'][$lang]) ? $data['detail'][$lang] : $data['detail']['en'];
        $translations[$lang]["brand_{$i}_title"] = $title;
        $translations[$lang]["brand_{$i}_desc"] = $desc;
        $translations[$lang]["brand_{$i}_detail"] = $detail;
    }
    $brand_urls[$i] = $data['website'];
}

// Placeholder image (JPEG)
$placeholder_image = 'data:image/jpg;base64,/9j/4AAQSkZJRgABAQEAAAAAAAD/2wBDAAoHBwkHBgoJCAkLCwoMDxkQDw4ODx4WFxIZJCAmJSMgIyMjKC0nJCUlIx8nLCIuMjIyPCsyPS8zMjIyMjIyMjL/wAALCAAIAAgBAREA/8QAFQABAQAAAAAAAAAAAAAAAAAAAAb/xAAUEAEAAAAAAAAAAAAAAAAAAAAA/9oACAEBAAA/AH//2Q==';

// Translation function with fallback
function get_translation($lang, $key) {
    global $translations;
    if (isset($translations[$lang][$key])) {
        return $translations[$lang][$key];
    }
    // Fallback to English
    return isset($translations['en'][$key]) ? $translations['en'][$key] : "Missing translation for $key";
}

// --- 修正品牌官网链接数组 ---
$brand_urls = [];
$brand_urls[1] = 'https://www.chanel.com';
$brand_urls[2] = 'https://www.gucci.com';
$brand_urls[3] = 'https://www.louisvuitton.com';
$brand_urls[4] = 'https://www.dior.com';
$brand_urls[5] = 'https://www.prada.com';
$brand_urls[6] = 'https://www.ysl.com';
$brand_urls[7] = 'https://www.versace.com';
$brand_urls[8] = 'https://www.balenciaga.com';
$brand_urls[9] = 'https://www.hermes.com';
$brand_urls[10] = 'https://www.fendi.com';
$brand_urls[11] = 'https://www.armani.com';
$brand_urls[12] = 'https://www.burberry.com';
$brand_urls[13] = 'https://www.valentino.com';
$brand_urls[14] = 'https://www.givenchy.com';
$brand_urls[15] = 'https://www.ysl.com';
$brand_urls[16] = 'https://www.celine.com';
$brand_urls[17] = 'https://www.chloe.com';
$brand_urls[18] = 'https://www.dolcegabbana.com';
$brand_urls[19] = 'https://www.miumiu.com';
$brand_urls[20] = 'https://www.bottegaveneta.com';
?>

<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($current_lang); ?>" dir="<?php echo $site_dir; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars(get_translation($current_lang, 'meta_description')); ?>">
    <title>HAF - <?php echo htmlspecialchars(get_translation($current_lang, 'brands_title')); ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;700&family=Source+Sans+Pro:wght@400;700&family=Libre+Baskerville&family=Noto+Sans+Arabic:wght@400;700&family=Noto+Sans+JP:wght@400;700&family=Noto+Sans+Deva:wght@400;700&display=swap" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
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
            --modal-bg: linear-gradient(135deg, #FFE6E6 0%, #FAE6E6 50%, #FDF5F5 100%); /* Watercolor-inspired gradient */
            --shadow-normal: 0 4px 16px rgba(0,0,0,0.1);
            --shadow-hover: 0 8px 32px rgba(0,0,0,0.15);
            --border-decor: 2px solid #E0C0C0; /* Subtle decorative border */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }

        body {
            font-family: 'EB Garamond', serif;
            color: var(--text-dark);
            line-height: 1.6;
            min-height: 100vh;
            background: var(--fashion-bg);
        }

        [lang="ar"] body, [lang="ar"] h1, [lang="ar"] p, [lang="ar"] a, [lang="ar"] button {
            font-family: 'Noto Sans Arabic', sans-serif;
        }

        [lang="ja"] body, [lang="ja"] h1, [lang="ja"] p, [lang="ja"] a, [lang="ja"] button {
            font-family: 'Noto Sans JP', sans-serif;
        }

        [lang="hi"] body, [lang="hi"] h1, [lang="hi"] p, [lang="hi"] a, [lang="hi"] button {
            font-family: 'Noto Sans Deva', sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        nav {
            background: var(--color-1);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        nav .container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        nav a {
            color: var(--text-dark);
            text-decoration: none;
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 1.1rem;
            padding: 5px 10px;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: var(--color-5);
        }

        nav select {
            padding: 8px;
            font-family: 'Source Sans Pro', sans-serif;
            background: var(--color-3);
            border: 1px solid var(--color-2);
            border-radius: 4px;
            color: var(--text-dark);
            margin-left: 20px;
        }

        .hero {
            background: var(--fashion-bg), url('<?php echo $placeholder_image; ?>') center/cover no-repeat;
            color: var(--text-dark);
            text-align: center;
            padding: 100px 20px;
            border-bottom: 5px solid var(--color-4);
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            font-family: 'Libre Baskerville', serif;
            animation: fadeInDown 1s;
        }

        .hero p {
            font-size: 1.5rem;
            margin-bottom: 30px;
        }

        .brands-section {
            padding: 60px 0;
        }

        .brand-item {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
            background: var(--color-4);
            border: 2px solid var(--color-2);
            border-radius: 8px;
            padding: 20px;
            box-shadow: var(--shadow-normal);
            transition: box-shadow 0.3s, transform 0.3s;
        }

        .brand-item:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-5px);
        }

        .brand-image {
            flex: 0 0 50%;
            padding-right: 20px;
            background-color: var(--color-3);
            border-radius: 5px;
        }

        .brand-image img {
            width: 100%;
            max-height: 200px;
            object-fit: contain;
            object-position: center;
            border-radius: 5px;
        }

        .brand-content {
            flex: 0 0 50%;
        }

        .brand-content h3 {
            font-family: 'Libre Baskerville', serif;
            font-size: 1.8rem;
            margin-bottom: 10px;
        }

        .brand-content p {
            font-size: 1rem;
            color: #555;
        }

        .learn-more-btn {
            background: var(--color-1);
            border: 2px solid var(--color-2);
            color: var(--text-dark);
            padding: 10px 20px;
            border-radius: 5px;
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 1rem;
            margin-top: 10px;
            cursor: pointer;
            transition: background 0.3s, border 0.3s;
        }

        .learn-more-btn:hover {
            background: var(--color-6);
            border-color: var(--text-dark);
        }

        .visit-website-btn {
            background: var(--color-1);
            border: 2px solid var(--color-2);
            color: var(--text-dark);
            padding: 10px 20px;
            border-radius: 5px;
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s, border 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .visit-website-btn:hover {
            background: var(--color-6);
            border-color: var(--text-dark);
        }

        .modal-content {
            background: var(--modal-bg);
            border-radius: 15px;
            border: var(--border-decor);
            box-shadow: var(--shadow-hover);
            padding: 20px;
        }

        .modal-header {
            border-bottom: none;
            padding: 0 0 20px 0;
        }

        .modal-title {
            font-family: 'Libre Baskerville', serif;
            font-size: 2.5rem;
            color: var(--text-dark);
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .modal-body {
            padding: 20px 0;
        }

        .modal-images {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .modal-images img {
            width: 100%;
            max-height: 300px; /* Increased image size */
            object-fit: contain;
            object-position: center;
            border-radius: 10px;
            border: 2px solid var(--color-2);
            background-color: var(--color-3);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .modal-images img:hover {
            transform: scale(1.05);
        }

        .modal-body p {
            font-size: 1.2rem;
            color: #444;
            line-height: 1.8;
            text-align: justify;
            padding: 0 20px;
        }

        .modal-footer {
            border-top: none;
            justify-content: center;
        }

        footer {
            background: var(--color-5);
            color: var(--text-dark);
            text-align: center;
            padding: 20px 0;
        }

        @media (max-width: 768px) {
            .brand-item {
                flex-direction: column;
                text-align: center;
            }

            .brand-image {
                flex: 0 0 100%;
                padding-right: 0;
                margin-bottom: 20px;
            }

            .brand-content {
                flex: 0 0 100%;
            }

            .brand-image img {
                max-height: 150px;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.3rem;
            }

            .modal-images {
                grid-template-columns: 1fr;
            }

            .modal-images img {
                max-height: 250px; /* Adjusted for smaller screens */
            }

            .modal-title {
                font-size: 2rem;
            }

            .modal-body p {
                font-size: 1rem;
            }

            nav .container {
                flex-wrap: wrap;
                gap: 10px;
            }
            
            nav a {
                font-size: 1rem;
                padding: 5px;
            }
        }

        @media (max-width: 600px) {
            .brand-image img {
                max-height: 120px;
            }

            .modal-images img {
                max-height: 200px; /* Further adjusted for very small screens */
            }

            .modal-title {
                font-size: 1.8rem;
            }

            .modal-body p {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="container">
            <div style="display: flex; align-items: center; gap: 20px;">
                <a href="fashion.php"><img src="images/fashionlogo.png" alt="Fashion Logo" style="height: 40px; width: auto;"></a>
                <a href="history.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_history')); ?></a>
                <a href="art.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_art')); ?></a>
                <a href="fashion.php"><?php echo htmlspecialchars(get_translation($current_lang, 'nav_fashion')); ?></a>
                <a href="fashion_show.php">Fashion Shows</a>
                <a href="fashion_brand.php">Fashion Brands</a>
                <a href="fashion_game.php">Fashion Game</a>
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
                </select>
            </form>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 class="animate__animated animate__fadeInDown"><?php echo htmlspecialchars(get_translation($current_lang, 'brands_title')); ?></h1>
            <p><?php echo htmlspecialchars(get_translation($current_lang, 'brands_subtitle')); ?></p>
        </div>
    </section>

    <!-- Brands Section -->
    <section class="brands-section">
        <div class="container">
            <?php for ($i = 1; $i <= 20; $i++): ?>
                <div class="brand-item animate__animated animate__fadeIn">
                    <div class="brand-image">
                        <img src="images/fashionbrand/brand_<?php echo $i; ?>.jpg" alt="<?php echo htmlspecialchars(get_translation($current_lang, "brand_{$i}_title")); ?>">
                        <button class="learn-more-btn" data-bs-toggle="modal" data-bs-target="#brandModal<?php echo $i; ?>">
                            <?php echo htmlspecialchars(get_translation($current_lang, 'learn_more')); ?>
                        </button>
                    </div>
                    <div class="brand-content">
                        <h3><?php echo htmlspecialchars(get_translation($current_lang, "brand_{$i}_title")); ?></h3>
                        <p><?php echo htmlspecialchars(get_translation($current_lang, "brand_{$i}_desc")); ?></p>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="brandModal<?php echo $i; ?>" tabindex="-1" aria-labelledby="brandModalLabel<?php echo $i; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="brandModalLabel<?php echo $i; ?>"><?php echo htmlspecialchars(get_translation($current_lang, "brand_{$i}_title")); ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="modal-images">
                                    <img src="images/fashionbrand/brand_<?php echo ($i * 2 + 19); ?>.jpg" alt="Detail Image 1">
                                    <img src="images/fashionbrand/brand_<?php echo ($i * 2 + 20); ?>.jpg" alt="Detail Image 2">
                                </div>
                                <p><?php echo htmlspecialchars(get_translation($current_lang, "brand_{$i}_detail")); ?></p>
                            </div>
                            <div class="modal-footer">
                                <a href="<?php echo htmlspecialchars(isset($brand_urls[$i]) && $brand_urls[$i] ? $brand_urls[$i] : '#'); ?>" target="_blank" class="visit-website-btn" rel="noopener noreferrer">
                                    <?php echo htmlspecialchars(get_translation($current_lang, 'visit_website')); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p><?php echo htmlspecialchars(get_translation($current_lang, 'footer_copyright')); ?></p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        // Language switch handler
        document.querySelector('select[name="lang"]').addEventListener('change', function() {
            this.form.submit();
        });

        // Animation on scroll
        const animateElements = document.querySelectorAll('.animate__animated');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate__fadeIn');
                }
            });
        }, { threshold: 0.1 });

        animateElements.forEach(el => observer.observe(el));
    </script>
</body>
</html>