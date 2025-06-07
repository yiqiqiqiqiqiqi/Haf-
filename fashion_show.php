    <?php
    session_start();

    if (!isset($_SESSION['lang'])) {
        $_SESSION['lang'] = 'zh';
    }

    // Handle language switching
    if (isset($_POST['lang'])) {
        $valid_langs = ['en', 'zh', 'ja', 'ar', 'es', 'fr', 'ru', 'pt', 'de', 'hi'];
        $_SESSION['lang'] = in_array($_POST['lang'], $valid_langs) ? $_POST['lang'] : 'zh';
    }

    $current_lang = $_SESSION['lang'];
    $site_dir = $current_lang === 'ar' ? 'rtl' : 'ltr';

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
            'look_1_text' => 'Evening Gown',
            'look_1_designer' => 'Designer: Alexander McQueen',
            'look_1_year' => 'Year: 2023',
            'look_1_desc' => 'A stunning black evening gown with intricate lace details, embodying timeless elegance.',
            'look_2_text' => 'Street Chic',
            'look_2_designer' => 'Designer: Virgil Abloh',
            'look_2_year' => 'Year: 2021',
            'look_2_desc' => 'A bold streetwear-inspired look with vibrant colors and oversized silhouettes.',
            'look_3_text' => 'Bohemian Rhapsody',
            'look_3_designer' => 'Designer: Etro',
            'look_3_year' => 'Year: 2022',
            'look_3_desc' => 'Flowing fabrics and earthy tones create a bohemian vibe with a modern twist.',
            'look_4_text' => 'Minimalist Elegance',
            'look_4_designer' => 'Designer: Jil Sander',
            'look_4_year' => 'Year: 2023',
            'look_4_desc' => 'Clean lines and neutral tones define this minimalist yet sophisticated look.',
            'look_5_text' => 'Avant-Garde Couture',
            'look_5_designer' => 'Designer: Iris van Herpen',
            'look_5_year' => 'Year: 2024',
            'look_5_desc' => 'An avant-garde piece with 3D-printed elements and futuristic design.',
            'look_6_text' => 'Vintage Glam',
            'look_6_designer' => 'Designer: Gucci',
            'look_6_year' => 'Year: 2022',
            'look_6_desc' => 'A nod to the 70s with glamorous sequins and bold patterns.',
            'look_7_text' => 'Bold Statement',
            'look_7_designer' => 'Designer: Balenciaga',
            'look_7_year' => 'Year: 2023',
            'look_7_desc' => 'A dramatic look featuring oversized shapes and vibrant red hues.',
            'look_8_text' => 'Classic Tailoring',
            'look_8_designer' => 'Designer: Ralph Lauren',
            'look_8_year' => 'Year: 2021',
            'look_8_desc' => 'Timeless tailoring with a perfectly fitted suit in classic navy.',
            'look_9_text' => 'Floral Fantasy',
            'look_9_designer' => 'Designer: Dolce & Gabbana',
            'look_9_year' => 'Year: 2023',
            'look_9_desc' => 'A romantic dress adorned with vibrant floral prints and delicate fabrics.',
            'look_10_text' => 'Modern Monochrome',
            'look_10_designer' => 'Designer: Calvin Klein',
            'look_10_year' => 'Year: 2022',
            'look_10_desc' => 'A sleek monochrome outfit with sharp lines and a minimalist aesthetic.',
            'look_11_text' => 'Romantic Layers',
            'look_11_designer' => 'Designer: Chanel',
            'look_11_year' => 'Year: 2024',
            'look_11_desc' => 'Soft layers of tulle and lace create a romantic, ethereal look.',
            'look_12_text' => 'Urban Edge',
            'look_12_designer' => 'Designer: Off-White',
            'look_12_year' => 'Year: 2023',
            'look_12_desc' => 'A mix of streetwear and high fashion with a gritty urban edge.',
            'look_13_text' => 'Glamorous Metallics',
            'look_13_designer' => 'Designer: Versace',
            'look_13_year' => 'Year: 2024',
            'look_13_desc' => 'Shiny metallic fabrics and bold cuts for a glamorous runway moment.',
            'look_14_text' => 'Timeless Silhouettes',
            'look_14_designer' => 'Designer: Dior',
            'look_14_year' => 'Year: 2022',
            'look_14_desc' => 'Classic silhouettes with a modern twist, featuring soft pastel tones.',
            'look_15_text' => 'Eclectic Patterns',
            'look_15_designer' => 'Designer: Missoni',
            'look_15_year' => 'Year: 2023',
            'look_15_desc' => 'A vibrant mix of patterns and textures for a bold, eclectic style.',
            'modal_close' => 'Close',
            'footer_copyright' => '© 2025 History, Art & Fashion. All rights reserved.',
            'autoplay_button' => 'Start Autoplay',
            'stop_autoplay_button' => 'Stop Autoplay'
        ],
        'zh' => [
            'meta_description' => '通过 HAF 体验时装秀的魅力，展示最新的跑道造型',
            'hero_title' => '时装秀亮点',
            'hero_subtitle' => '与 HAF 一起发现跑道的优雅',
            'nav_history' => '历史',
            'nav_art' => '艺术',
            'nav_fashion' => '时尚',
            'nav_shop' => '商店',
            'runway_title' => '跑道造型',
            'runway_subtitle' => '本季最具标志性的设计精选集合',
            'look_1_text' => '晚礼服',
            'look_1_designer' => '设计师：亚历山大·麦昆',
            'look_1_year' => '年份：2023',
            'look_1_desc' => '一件华丽的黑色晚礼服，带有复杂的蕾丝细节，体现永恒的优雅。',
            'look_2_text' => '街头时尚',
            'look_2_designer' => '设计师：维吉尔·阿布洛',
            'look_2_year' => '年份：2021',
            'look_2_desc' => '大胆的街头风格造型，采用鲜艳的色彩和超大廓形。',
            'look_3_text' => '波西米亚狂想曲',
            'look_3_designer' => '设计师：Etro',
            'look_3_year' => '年份：2022',
            'look_3_desc' => '流动的面料和大地色调，带来波西米亚风格的现代诠释。',
            'look_4_text' => '极简优雅',
            'look_4_designer' => '设计师：Jil Sander',
            'look_4_year' => '年份：2023',
            'look_4_desc' => '简洁的线条和中性色调，定义了这种极简却精致的造型。',
            'look_5_text' => '前卫高级定制',
            'look_5_designer' => '设计师：Iris van Herpen',
            'look_5_year' => '年份：2024',
            'look_5_desc' => '前卫设计，采用3D打印元素，展现未来主义风格。',
            'look_6_text' => '复古魅力',
            'look_6_designer' => '设计师：Gucci',
            'look_6_year' => '年份：2022',
            'look_6_desc' => '向70年代致敬，采用闪亮的亮片和大胆的图案。',
            'look_7_text' => '大胆宣言',
            'look_7_designer' => '设计师：Balenciaga',
            'look_7_year' => '年份：2023',
            'look_7_desc' => '戏剧化的造型，采用超大廓形和鲜艳的红色调。',
            'look_8_text' => '经典剪裁',
            'look_8_designer' => '设计师：Ralph Lauren',
            'look_8_year' => '年份：2021',
            'look_8_desc' => '经典剪裁，完美合身的海军蓝西装，永恒优雅。',
            'look_9_text' => '花卉幻想',
            'look_9_designer' => '设计师：Dolce & Gabbana',
            'look_9_year' => '年份：2023',
            'look_9_desc' => '浪漫的连衣裙，饰以鲜艳的花卉印花和精致面料。',
            'look_10_text' => '现代单色',
            'look_10_designer' => '设计师：Calvin Klein',
            'look_10_year' => '年份：2022',
            'look_10_desc' => '流畅的单色造型，线条锐利，极简美学。',
            'look_11_text' => '浪漫层次',
            'look_11_designer' => '设计师：Chanel',
            'look_11_year' => '年份：2024',
            'look_11_desc' => '柔软的薄纱和蕾丝层叠，打造浪漫而空灵的造型。',
            'look_12_text' => '都市边缘',
            'look_12_designer' => '设计师：Off-White',
            'look_12_year' => '年份：2023',
            'look_12_desc' => '街头服饰与高级时尚的融合，带有粗犷的都市边缘感。',
            'look_13_text' => '华丽金属色',
            'look_13_designer' => '设计师：Versace',
            'look_13_year' => '年份：2024',
            'look_13_desc' => '闪亮的金属面料和大胆剪裁，打造华丽的跑道时刻。',
            'look_14_text' => '永恒剪影',
            'look_14_designer' => '设计师：Dior',
            'look_14_year' => '年份：2022',
            'look_14_desc' => '经典廓形，融入现代元素，采用柔和的粉彩色调。',
            'look_15_text' => '折衷图案',
            'look_15_designer' => '设计师：Missoni',
            'look_15_year' => '年份：2023',
            'look_15_desc' => '鲜艳的图案和纹理混搭，展现大胆的折衷风格。',
            'modal_close' => '关闭',
            'footer_copyright' => '© 2025 历史、艺术与时尚. 保留所有权利。',
            'autoplay_button' => '开始自动播放',
            'stop_autoplay_button' => '停止自动播放'
        ],
        'ar' => [
            'look_1_text' => 'فستان سهرة',
            'look_1_designer' => 'المصمم: ألكسندر ماكوين',
            'look_1_year' => 'السنة: 2023',
            'look_1_desc' => 'فستان سهرة أسود مذهل بتفاصيل دانتيل معقدة يجسد الأناقة الخالدة.',
            'look_2_text' => 'أناقة الشارع',
            'look_2_designer' => 'المصمم: فيرجيل أبلوه',
            'look_2_year' => 'السنة: 2021',
            'look_2_desc' => 'إطلالة جريئة مستوحاة من أزياء الشارع بألوان زاهية وأشكال كبيرة الحجم.',
            'look_3_text' => 'افتتان بوهيمي',
            'look_3_designer' => 'المصمم: إيترو',
            'look_3_year' => 'السنة: 2022',
            'look_3_desc' => 'أقمشة منسدلة وألوان ترابية تخلق أجواء بوهيمية بلمسة عصرية.',
            'look_4_text' => 'أناقة بسيطة',
            'look_4_designer' => 'المصمم: جيل ساندر',
            'look_4_year' => 'السنة: 2023',
            'look_4_desc' => 'خطوط نظيفة وألوان محايدة تحدد هذه الإطلالة البسيطة والأنيقة.',
            'look_5_text' => 'كوتور الطليعية',
            'look_5_designer' => 'المصمم: إيريس فان هيربن',
            'look_5_year' => 'السنة: 2024',
            'look_5_desc' => 'قطعة طليعية بعناصر مطبوعة ثلاثية الأبعاد وتصميم مستقبلي.',
            'look_6_text' => 'سحر عتيق',
            'look_6_designer' => 'المصمم: غوتشي',
            'look_6_year' => 'السنة: 2022',
            'look_6_desc' => 'تحية لسبعينيات القرن الماضي مع الترتر البراق والأنماط الجريئة.',
            'look_7_text' => 'بيان جريء',
            'look_7_designer' => 'المصمم: بالنسياغا',
            'look_7_year' => 'السنة: 2023',
            'look_7_desc' => 'إطلالة درامية بأشكال كبيرة وألوان حمراء زاهية.',
            'look_8_text' => 'تفصيل كلاسيكي',
            'look_8_designer' => 'المصمم: رالف لورين',
            'look_8_year' => 'السنة: 2021',
            'look_8_desc' => 'تفصيل كلاسيكي مع بدلة زرقاء داكنة مناسبة تمامًا.',
            'look_9_text' => 'خيال زهري',
            'look_9_designer' => 'المصمم: دولتشي آند غابانا',
            'look_9_year' => 'السنة: 2023',
            'look_9_desc' => 'فستان رومانسي مزين بطبعات زهرية زاهية وأقمشة رقيقة.',
            'look_10_text' => 'أحادية اللون الحديثة',
            'look_10_designer' => 'المصمم: كالفن كلاين',
            'look_10_year' => 'السنة: 2022',
            'look_10_desc' => 'إطلالة أحادية اللون أنيقة بخطوط حادة وجمالية بسيطة.',
            'look_11_text' => 'طبقات رومانسية',
            'look_11_designer' => 'المصمم: شانيل',
            'look_11_year' => 'السنة: 2024',
            'look_11_desc' => 'طبقات ناعمة من التول والدانتيل تخلق مظهرًا رومانسيًا وأثيريًا.',
            'look_12_text' => 'حافة حضرية',
            'look_12_designer' => 'المصمم: أوف-وايت',
            'look_12_year' => 'السنة: 2023',
            'look_12_desc' => 'مزيج من أزياء الشارع والموضة الراقية مع لمسة حضرية قوية.',
            'look_13_text' => 'معدن ساحر',
            'look_13_designer' => 'المصمم: فيرساتشي',
            'look_13_year' => 'السنة: 2024',
            'look_13_desc' => 'أقمشة معدنية لامعة وقصات جريئة للحظة عرض أزياء ساحرة.',
            'look_14_text' => 'صور ظلية خالدة',
            'look_14_designer' => 'المصمم: ديور',
            'look_14_year' => 'السنة: 2022',
            'look_14_desc' => 'صور ظلية كلاسيكية بلمسة عصرية وألوان باستيل ناعمة.',
            'look_15_text' => 'أنماط انتقائية',
            'look_15_designer' => 'المصمم: ميسوني',
            'look_15_year' => 'السنة: 2023',
            'look_15_desc' => 'مزيج نابض بالحياة من الأنماط والقوام لأسلوب جريء وانتقائي.',
            'modal_close' => 'Close',
            'footer_copyright' => '© 2025 History, Art & Fashion. All rights reserved.',
            'autoplay_button' => 'Start Autoplay',
            'stop_autoplay_button' => 'Stop Autoplay'
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
            'look_1_text' => 'イブニングガウン',
            'look_1_designer' => 'デザイナー：アレキサンダー・マックイーン',
            'look_1_year' => '年：2023',
            'look_1_desc' => '繊細なレースが施された見事な黒のイブニングガウンで、時代を超えたエレガンスを体現しています。',
            'look_2_text' => 'ストリートシック',
            'look_2_designer' => 'デザイナー：ヴァージル・アブロー',
            'look_2_year' => '年：2021',
            'look_2_desc' => '鮮やかな色彩とオーバーサイズのシルエットが特徴の大胆なストリートウェアスタイル。',
            'look_3_text' => 'ボヘミアンラプソディ',
            'look_3_designer' => 'デザイナー：Etro',
            'look_3_year' => '年：2022',
            'look_3_desc' => '流れるような生地とアースカラーが、現代的なボヘミアンの雰囲気を演出します。',
            'look_4_text' => 'ミニマルエレガンス',
            'look_4_designer' => 'デザイナー：ジル・サンダー',
            'look_4_year' => '年：2023',
            'look_4_desc' => 'クリーンなラインとニュートラルな色合いが、このミニマルで洗練されたルックを定義します。',
            'look_5_text' => 'アバンギャルドクチュール',
            'look_5_designer' => 'デザイナー：イリス・ヴァン・ヘルペン',
            'look_5_year' => '年：2024',
            'look_5_desc' => '3Dプリント要素と未来的なデザインを取り入れたアバンギャルドな作品。',
            'look_6_text' => 'ヴィンテージグラム',
            'look_6_designer' => 'デザイナー：グッチ',
            'look_6_year' => '年：2022',
            'look_6_desc' => '70年代へのオマージュとして、グラマラスなスパンコールと大胆なパターンを採用。',
            'look_7_text' => '大胆なステートメント',
            'look_7_designer' => 'デザイナー：バレンシアガ',
            'look_7_year' => '年：2023',
            'look_7_desc' => 'オーバーサイズのシルエットと鮮やかな赤が特徴のドラマチックなルック。',
            'look_8_text' => 'クラシックテーラリング',
            'look_8_designer' => 'デザイナー：ラルフ・ローレン',
            'look_8_year' => '年：2021',
            'look_8_desc' => 'クラシックなネイビーのスーツで、時代を超えたテーラリング。',
            'look_9_text' => 'フローラルファンタジー',
            'look_9_designer' => 'デザイナー：ドルチェ＆ガッバーナ',
            'look_9_year' => '年：2023',
            'look_9_desc' => '鮮やかな花柄と繊細な生地で飾られたロマンチックなドレス。',
            'look_10_text' => 'モダンモノクローム',
            'look_10_designer' => 'デザイナー：カルバン・クライン',
            'look_10_year' => '年：2022',
            'look_10_desc' => 'シャープなラインとミニマルな美学を持つ洗練されたモノクロの装い。',
            'look_11_text' => 'ロマンティックレイヤー',
            'look_11_designer' => 'デザイナー：シャネル',
            'look_11_year' => '年：2024',
            'look_11_desc' => '柔らかなチュールとレースのレイヤーがロマンチックで幻想的なルックを作り出します。',
            'look_12_text' => 'アーバンエッジ',
            'look_12_designer' => 'デザイナー：オフホワイト',
            'look_12_year' => '年：2023',
            'look_12_desc' => 'ストリートウェアとハイファッションが融合した都会的なエッジ。',
            'look_13_text' => 'グラマラスメタリック',
            'look_13_designer' => 'デザイナー：ヴェルサーチ',
            'look_13_year' => '年：2024',
            'look_13_desc' => '光沢のあるメタリック生地と大胆なカットでグラマラスなランウェイを演出。',
            'look_14_text' => 'タイムレスシルエット',
            'look_14_designer' => 'デザイナー：ディオール',
            'look_14_year' => '年：2022',
            'look_14_desc' => 'クラシックなシルエットに現代的なひねりを加え、柔らかなパステルカラーを特徴とします。',
            'look_15_text' => 'エクレクティックパターン',
            'look_15_designer' => 'デザイナー：ミッソーニ',
            'look_15_year' => '年：2023',
            'look_15_desc' => '鮮やかなパターンとテクスチャーのミックスで、大胆で折衷的なスタイルを表現。',
            'modal_close' => 'Close',
            'footer_copyright' => '© 2025 History, Art & Fashion. All rights reserved.',
            'autoplay_button' => 'Start Autoplay',
            'stop_autoplay_button' => 'Stop Autoplay'
        ],
        'es' => [
            'look_1_text' => 'Vestido de noite',
            'look_1_designer' => 'Diseñador: Alexander McQueen',
            'look_1_year' => 'Año: 2023',
            'look_1_desc' => 'Um deslumbrante vestido de noite preto com detalhes de renda intrincados, incorporando elegância atemporal.',
            'look_2_text' => 'Estilo de rua',
            'look_2_designer' => 'Diseñador: Virgil Abloh',
            'look_2_year' => 'Año: 2021',
            'look_2_desc' => 'Um look ousado inspirado no streetwear com cores vibrantes e silhuetas oversized.',
            'look_3_text' => 'Rapsódia boêmia',
            'look_3_designer' => 'Diseñador: Etro',
            'look_3_year' => 'Año: 2022',
            'look_3_desc' => 'Tecidos fluidos e tons terrosos criam uma vibe boêmia com um toque moderno.',
            'look_4_text' => 'Elegância minimalista',
            'look_4_designer' => 'Diseñador: Jil Sander',
            'look_4_year' => 'Año: 2023',
            'look_4_desc' => 'Linhas limpas e tons neutros definem este look minimalista e sofisticado.',
            'look_5_text' => 'Alta-costura vanguardista',
            'look_5_designer' => 'Diseñador: Iris van Herpen',
            'look_5_year' => 'Año: 2024',
            'look_5_desc' => 'Uma peça vanguardista com elementos impressos em 3D e design futurista.',
            'look_6_text' => 'Glam vintage',
            'look_6_designer' => 'Diseñador: Gucci',
            'look_6_year' => 'Año: 2022',
            'look_6_desc' => 'Uma homenagem aos anos 70 com lantejoulas glamorosas e padrões ousados.',
            'look_7_text' => 'Declaração ousada',
            'look_7_designer' => 'Diseñador: Balenciaga',
            'look_7_year' => 'Año: 2023',
            'look_7_desc' => 'Um look dramático com formas oversized e tons vermelhos vibrantes.',
            'look_8_text' => 'Alfaiataria clássica',
            'look_8_designer' => 'Diseñador: Ralph Lauren',
            'look_8_year' => 'Año: 2021',
            'look_8_desc' => 'Alfaiataria atemporal com um terno azul-marinho perfeitamente ajustado.',
            'look_9_text' => 'Fantasia floral',
            'look_9_designer' => 'Diseñador: Dolce & Gabbana',
            'look_9_year' => 'Año: 2023',
            'look_9_desc' => 'Um vestido romântico adornado com estampas florais vibrantes e tecidos delicados.',
            'look_10_text' => 'Monocromático moderno',
            'look_10_designer' => 'Diseñador: Calvin Klein',
            'look_10_year' => 'Año: 2022',
            'look_10_desc' => 'Um visual monocromático elegante com linhas nítidas e estética minimalista.',
            'look_11_text' => 'Camadas românticas',
            'look_11_designer' => 'Diseñador: Chanel',
            'look_11_year' => 'Año: 2024',
            'look_11_desc' => 'Camadas suaves de tule e renda criam um visual romântico e etéreo.',
            'look_12_text' => 'Toque urbano',
            'look_12_designer' => 'Diseñador: Off-White',
            'look_12_year' => 'Año: 2023',
            'look_12_desc' => 'Uma mistura de streetwear e alta moda com um toque urbano marcante.',
            'look_13_text' => 'Metálicos glamorosos',
            'look_13_designer' => 'Diseñador: Versace',
            'look_13_year' => 'Año: 2024',
            'look_13_desc' => 'Tecidos metálicos brilhantes e cortes ousados para um momento glamoroso na passarela.',
            'look_14_text' => 'Silhuetas atemporais',
            'look_14_designer' => 'Diseñador: Dior',
            'look_14_year' => 'Año: 2022',
            'look_14_desc' => 'Silhuetas clássicas com um toque moderno e tons pastel suaves.',
            'look_15_text' => 'Padrões ecléticos',
            'look_15_designer' => 'Diseñador: Missoni',
            'look_15_year' => 'Año: 2023',
            'look_15_desc' => 'Uma mistura vibrante de padrões e texturas para um estilo ousado e eclético.',
            'modal_close' => 'Close',
            'footer_copyright' => '© 2025 History, Art & Fashion. All rights reserved.',
            'autoplay_button' => 'Start Autoplay',
            'stop_autoplay_button' => 'Stop Autoplay',
            'meta_description' => 'Vive el glamour de los desfiles de moda con HAF, mostrando los últimos looks de pasarela',
            'hero_title' => 'Destacados del Desfile de Moda',
            'hero_subtitle' => 'Descubre la elegancia de la pasarela con HAF',
            'nav_history' => 'Historia',
            'nav_art' => 'Arte',
            'nav_fashion' => 'Moda',
            'nav_shop' => 'Tienda',
            'runway_title' => 'Looks de Pasarela',
            'runway_subtitle' => 'Una colección seleccionada de los diseños más icónicos de la temporada'
        ],
        'fr' => [
            'look_1_text' => 'Robe de soirée',
            'look_1_designer' => 'Créateur : Alexander McQueen',
            'look_1_year' => 'Année : 2023',
            'look_1_desc' => 'Une superbe robe de soirée noire avec des détails en dentelle complexes, incarnant l\'élégance intemporelle.',
            'look_2_text' => 'Chic urbain',
            'look_2_designer' => 'Créateur : Virgil Abloh',
            'look_2_year' => 'Année : 2021',
            'look_2_desc' => 'Un look audacieux inspiré du streetwear avec des couleurs vives et des silhouettes surdimensionnées.',
            'look_3_text' => 'Rhapsodie bohème',
            'look_3_designer' => 'Créateur : Etro',
            'look_3_year' => 'Année : 2022',
            'look_3_desc' => 'Des tissus fluides et des tons terreux créent une ambiance bohème avec une touche moderne.',
            'look_4_text' => 'Élégance minimaliste',
            'look_4_designer' => 'Créateur : Jil Sander',
            'look_4_year' => 'Année : 2023',
            'look_4_desc' => 'Des lignes épurées et des tons neutres définissent ce look minimaliste et sophistiqué.',
            'look_5_text' => 'Haute couture avant-gardiste',
            'look_5_designer' => 'Créateur : Iris van Herpen',
            'look_5_year' => 'Année : 2024',
            'look_5_desc' => 'Une pièce avant-gardiste avec des éléments imprimés en 3D et un design futuriste.',
            'look_6_text' => 'Glamour vintage',
            'look_6_designer' => 'Créateur : Gucci',
            'look_6_year' => 'Année : 2022',
            'look_6_desc' => 'Un clin d\'œil aux années 70 avec des paillettes glamour et des motifs audacieux.',
            'look_7_text' => 'Déclaration audacieuse',
            'look_7_designer' => 'Créateur : Balenciaga',
            'look_7_year' => 'Année : 2023',
            'look_7_desc' => 'Un look dramatique avec des formes surdimensionnées et des tons rouges vibrants.',
            'look_8_text' => 'Tailleur classique',
            'look_8_designer' => 'Créateur : Ralph Lauren',
            'look_8_year' => 'Année : 2021',
            'look_8_desc' => 'Une coupe intemporelle avec un costume bleu marine parfaitement ajusté.',
            'look_9_text' => 'Fantaisie florale',
            'look_9_designer' => 'Créateur : Dolce & Gabbana',
            'look_9_year' => 'Année : 2023',
            'look_9_desc' => 'Une robe romantique ornée d\'imprimés floraux vibrants et de tissus délicats.',
            'look_10_text' => 'Monocromático moderno',
            'look_10_designer' => 'Créateur : Calvin Klein',
            'look_10_year' => 'Année : 2022',
            'look_10_desc' => 'Une tenue monochrome élégante avec des lignes nettes et une esthétique minimaliste.',
            'look_11_text' => 'Couches romântiques',
            'look_11_designer' => 'Créateur : Chanel',
            'look_11_year' => 'Année : 2024',
            'look_11_desc' => 'Des couches douces de tulle et de dentelle créent un look romantique et éthéré.',
            'look_12_text' => 'Esprit urbain',
            'look_12_designer' => 'Créateur : Off-White',
            'look_12_year' => 'Année : 2023',
            'look_12_desc' => 'Un mélange de streetwear et de haute couture avec une touche urbaine marquée.',
            'look_13_text' => 'Métalliques glamour',
            'look_13_designer' => 'Créateur : Versace',
            'look_13_year' => 'Année : 2024',
            'look_13_desc' => 'Des tissus métalliques brillants et des coupes audacieuses pour un moment glamour sur le podium.',
            'look_14_text' => 'Silhuettes intemporelles',
            'look_14_designer' => 'Créateur : Dior',
            'look_14_year' => 'Année : 2022',
            'look_14_desc' => 'Des silhouettes classiques avec une touche moderno et tons pastel doux.',
            'look_15_text' => 'Motifs éclectiques',
            'look_15_designer' => 'Créateur : Missoni',
            'look_15_year' => 'Année : 2023',
            'look_15_desc' => 'Un mélange vibrant de motifs et de textures pour un style audacieux et éclectique.',
            'modal_close' => 'Close',
            'footer_copyright' => '© 2025 History, Art & Fashion. All rights reserved.',
            'autoplay_button' => 'Start Autoplay',
            'stop_autoplay_button' => 'Stop Autoplay',
            'meta_description' => 'Vivez le glamour des défilés de mode avec HAF, présentant les derniers looks du podium',
            'hero_title' => 'Temps forts du défilé de mode',
            'hero_subtitle' => 'Découvrez l\'élégance du podium avec HAF',
            'nav_history' => 'Histoire',
            'nav_art' => 'Art',
            'nav_fashion' => 'Mode',
            'nav_shop' => 'Boutique',
            'runway_title' => 'Looks de Podium',
            'runway_subtitle' => 'Une collection sélectionnée des designs les plus emblématiques de la saison'
        ],
        'pt' => [
            'look_1_text' => 'Vestido de noite',
            'look_1_designer' => 'Designer: Alexander McQueen',
            'look_1_year' => 'Ano: 2023',
            'look_1_desc' => 'Um deslumbrante vestido de noite preto com detalhes de renda intrincados, incorporando elegância atemporal.',
            'look_2_text' => 'Estilo de rua',
            'look_2_designer' => 'Designer: Virgil Abloh',
            'look_2_year' => 'Ano: 2021',
            'look_2_desc' => 'Um look ousado inspirado no streetwear com cores vibrantes e silhuetas oversized.',
            'look_3_text' => 'Rapsódia boêmia',
            'look_3_designer' => 'Designer: Etro',
            'look_3_year' => 'Ano: 2022',
            'look_3_desc' => 'Tecidos fluidos e tons terrosos criam uma vibe boêmia com um toque moderno.',
            'look_4_text' => 'Elegância minimalista',
            'look_4_designer' => 'Designer: Jil Sander',
            'look_4_year' => 'Ano: 2023',
            'look_4_desc' => 'Linhas limpas e tons neutros definem este look minimalista e sofisticado.',
            'look_5_text' => 'Alta-costura vanguardista',
            'look_5_designer' => 'Designer: Iris van Herpen',
            'look_5_year' => 'Ano: 2024',
            'look_5_desc' => 'Uma peça vanguardista com elementos impressos em 3D e design futurista.',
            'look_6_text' => 'Glam vintage',
            'look_6_designer' => 'Designer: Gucci',
            'look_6_year' => 'Ano: 2022',
            'look_6_desc' => 'Uma homenagem aos anos 70 com lantejoulas glamorosas e padrões ousados.',
            'look_7_text' => 'Declaração ousada',
            'look_7_designer' => 'Designer: Balenciaga',
            'look_7_year' => 'Ano: 2023',
            'look_7_desc' => 'Um look dramático com formas oversized e tons vermelhos vibrantes.',
            'look_8_text' => 'Alfaiataria clássica',
            'look_8_designer' => 'Designer: Ralph Lauren',
            'look_8_year' => 'Ano: 2021',
            'look_8_desc' => 'Alfaiataria atemporal com um terno azul-marinho perfeitamente ajustado.',
            'look_9_text' => 'Fantasia floral',
            'look_9_designer' => 'Designer: Dolce & Gabbana',
            'look_9_year' => 'Ano: 2023',
            'look_9_desc' => 'Um vestido romântico adornado com estampas florais vibrantes e tecidos delicados.',
            'look_10_text' => 'Monocromático moderno',
            'look_10_designer' => 'Designer: Calvin Klein',
            'look_10_year' => 'Ano: 2022',
            'look_10_desc' => 'Um visual monocromático elegante com linhas nítidas e estética minimalista.',
            'look_11_text' => 'Camadas românticas',
            'look_11_designer' => 'Designer: Chanel',
            'look_11_year' => 'Ano: 2024',
            'look_11_desc' => 'Camadas suaves de tule e renda criam um visual romântico e etéreo.',
            'look_12_text' => 'Toque urbano',
            'look_12_designer' => 'Designer: Off-White',
            'look_12_year' => 'Ano: 2023',
            'look_12_desc' => 'Uma mistura de streetwear e alta moda com um toque urbano marcante.',
            'look_13_text' => 'Metálicos glamorosos',
            'look_13_designer' => 'Designer: Versace',
            'look_13_year' => 'Ano: 2024',
            'look_13_desc' => 'Tecidos metálicos brilhantes e cortes ousados para um momento glamoroso na passarela.',
            'look_14_text' => 'Silhuetas atemporais',
            'look_14_designer' => 'Designer: Dior',
            'look_14_year' => 'Ano: 2022',
            'look_14_desc' => 'Silhuetas clássicas com um toque moderno e tons pastel suaves.',
            'look_15_text' => 'Padrões ecléticos',
            'look_15_designer' => 'Designer: Missoni',
            'look_15_year' => 'Ano: 2023',
            'look_15_desc' => 'Uma mistura vibrante de padrões e texturas para um estilo ousado e eclético.',
            'modal_close' => 'Close',
            'footer_copyright' => '© 2025 History, Art & Fashion. All rights reserved.',
            'autoplay_button' => 'Start Autoplay',
            'stop_autoplay_button' => 'Stop Autoplay',
            'meta_description' => 'Experimente o glamour dos desfiles de moda com HAF, apresentando os mais recentes looks de passarela',
            'hero_title' => 'Destaques do Desfile de Moda',
            'hero_subtitle' => 'Descubra a elegância da passarela com HAF',
            'nav_history' => 'História',
            'nav_art' => 'Arte',
            'nav_fashion' => 'Moda',
            'nav_shop' => 'Loja',
            'runway_title' => 'Looks de Passarela',
            'runway_subtitle' => 'Uma coleção selecionada dos designs mais icônicos da temporada'
        ],
        'de' => [
            'look_1_text' => 'Abendkleid',
            'look_1_designer' => 'Designer: Alexander McQueen',
            'look_1_year' => 'Jahr: 2023',
            'look_1_desc' => 'Ein atemberaubendes schwarzes Abendkleid mit aufwendigen Spitzendetails, das zeitlose Eleganz verkörpert.',
            'look_2_text' => 'Street Chic',
            'look_2_designer' => 'Designer: Virgil Abloh',
            'look_2_year' => 'Jahr: 2021',
            'look_2_desc' => 'Ein kühner, von Streetwear inspirierter Look mit lebendigen Farben und übergroßen Silhouetten.',
            'look_3_text' => 'Bohemian Rhapsody',
            'look_3_designer' => 'Designer: Etro',
            'look_3_year' => 'Jahr: 2022',
            'look_3_desc' => 'Fließende Stoffe und erdige Töne schaffen eine Boho-Atmosphäre mit modernem Touch.',
            'look_4_text' => 'Minimalistische Eleganz',
            'look_4_designer' => 'Designer: Jil Sander',
            'look_4_year' => 'Jahr: 2023',
            'look_4_desc' => 'Klare Linien und neutrale Töne definieren diesen minimalistischen und dennoch raffinierten Look.',
            'look_5_text' => 'Avantgarde-Couture',
            'look_5_designer' => 'Designer: Iris van Herpen',
            'look_5_year' => 'Jahr: 2024',
            'look_5_desc' => 'Ein avantgardistisches Stück mit 3D-gedruckten Elementen und futuristischem Design.',
            'look_6_text' => 'Vintage Glam',
            'look_6_designer' => 'Designer: Gucci',
            'look_6_year' => 'Jahr: 2022',
            'look_6_desc' => 'Eine Hommage an die 70er mit glamourösen Pailletten und kräftigen Mustern.',
            'look_7_text' => 'Mutiges Statement',
            'look_7_designer' => 'Designer: Balenciaga',
            'look_7_year' => 'Jahr: 2023',
            'look_7_desc' => 'Ein dramatischer Look mit übergroßen Formen und leuchtend roten Tönen.',
            'look_8_text' => 'Klassische Schneiderei',
            'look_8_designer' => 'Designer: Ralph Lauren',
            'look_8_year' => 'Jahr: 2021',
            'look_8_desc' => 'Zeitlose Schneiderei mit einem perfekt sitzenden Anzug in klassischem Marineblau.',
            'look_9_text' => 'Blumenfantasie',
            'look_9_designer' => 'Designer: Dolce & Gabbana',
            'look_9_year' => 'Jahr: 2023',
            'look_9_desc' => 'Ein romantisches Kleid mit leuchtenden Blumenprints und zarten Stoffen.',
            'look_10_text' => 'Modernes Monochrom',
            'look_10_designer' => 'Designer: Calvin Klein',
            'look_10_year' => 'Jahr: 2022',
            'look_10_desc' => 'Ein elegantes monochromes Outfit mit klaren Linien und minimalistischer Ästhetik.',
            'look_11_text' => 'Romantische Lagen',
            'look_11_designer' => 'Designer: Chanel',
            'look_11_year' => 'Jahr: 2024',
            'look_11_desc' => 'Weiche Lagen aus Tüll und Spitze schaffen einen romantischen, ätherischen Look.',
            'look_12_text' => 'Urbaner Touch',
            'look_12_designer' => 'Designer: Off-White',
            'look_12_year' => 'Jahr: 2023',
            'look_12_desc' => 'Eine Mischung aus Streetwear und High Fashion mit markantem urbanem Touch.',
            'look_13_text' => 'Glamouröse Metallics',
            'look_13_designer' => 'Designer: Versace',
            'look_13_year' => 'Jahr: 2024',
            'look_13_desc' => 'Glänzende Metallic-Stoffe und kühne Schnitte für einen glamourösen Laufstegmoment.',
            'look_14_text' => 'Zeitlose Silhouetten',
            'look_14_designer' => 'Designer: Dior',
            'look_14_year' => 'Jahr: 2022',
            'look_14_desc' => 'Klassische Silhouetten mit modernem Twist und sanften Pastelltönen.',
            'look_15_text' => 'Eklektische Muster',
            'look_15_designer' => 'Designer: Missoni',
            'look_15_year' => 'Jahr: 2023',
            'look_15_desc' => 'Eine lebendige Mischung aus Mustern und Texturen für einen mutigen, eklektischen Stil.',
            'modal_close' => 'Close',
            'footer_copyright' => '© 2025 History, Art & Fashion. All rights reserved.',
            'autoplay_button' => 'Start Autoplay',
            'stop_autoplay_button' => 'Stop Autoplay',
            'meta_description' => 'Erleben Sie den Glamour von Modenschauen mit HAF und entdecken Sie die neuesten Laufsteg-Looks',
            'hero_title' => 'Highlights der Modenschau',
            'hero_subtitle' => 'Entdecken Sie die Eleganz des Laufstegs mit HAF',
            'nav_history' => 'Geschichte',
            'nav_art' => 'Kunst',
            'nav_fashion' => 'Mode',
            'nav_shop' => 'Shop',
            'runway_title' => 'Laufsteg-Looks',
            'runway_subtitle' => 'Eine kuratierte Auswahl der ikonischsten Designs der Saison'
        ],
        'hi' => [
            'look_1_text' => 'इवनिंग गाउन',
            'look_1_designer' => 'डिज़ाइनर: अलेक्जेंडर मैक्वीन',
            'look_1_year' => 'वर्ष: 2023',
            'look_1_desc' => 'जटिल लेस डिटेल्स के साथ एक शानदार काले रंग का इवनिंग गाउन, जो शाश्वत सुंदरता को दर्शाता है।',
            'look_2_text' => 'सड़क शैली',
            'look_2_designer' => 'डिज़ाइनर: वर्जिल अब्लोह',
            'look_2_year' => 'वर्ष: 2021',
            'look_2_desc' => 'चमकीले रंगों और ओवरसाइज़ सिल्हूट के साथ एक बोल्ड स्ट्रीटवियर-प्रेरित लुक।',
            'look_3_text' => 'बोहेमियन रैप्सोडी',
            'look_3_designer' => 'डिज़ाइनर: Etro',
            'look_3_year' => 'वर्ष: 2022',
            'look_3_desc' => 'बहती हुई कपड़े और मिट्टी के रंग आधुनिक ट्विस्ट के साथ बोहेमियन वाइब बनाते हैं।',
            'look_4_text' => 'मिनिमलिस्ट एलिगेंस',
            'look_4_designer' => 'डिज़ाइनर: जिल सैंडर',
            'look_4_year' => 'वर्ष: 2023',
            'look_4_desc' => 'साफ़ रेखाएँ और न्यूट्रल टोन इस मिनिमलिस्ट लेकिन परिष्कृत लुक को परिभाषित करते हैं।',
            'look_5_text' => 'अवांट-गार्डे कुट्योर',
            'look_5_designer' => 'डिज़ाइनर: आइरिस वैन हर्पेन',
            'look_5_year' => 'वर्ष: 2024',
            'look_5_desc' => '3D-प्रिंटेड तत्वों और भविष्यवादी डिज़ाइन के साथ एक अवांट-गार्डे पीस।',
            'look_6_text' => 'विंटेज ग्लैम',
            'look_6_designer' => 'डिज़ाइनर: गुच्ची',
            'look_6_year' => 'वर्ष: 2022',
            'look_6_desc' => '70 के दशक को समर्पित, ग्लैमरस सीक्विन और बोल्ड पैटर्न के साथ।',
            'look_7_text' => 'बोल्ड स्टेटमेंट',
            'look_7_designer' => 'डिज़ाइनर: बालेंसीआगा',
            'look_7_year' => 'वर्ष: 2023',
            'look_7_desc' => 'ओवरसाइज़ शेप्स और चमकीले लाल रंगों के साथ एक नाटकीय लुक।',
            'look_8_text' => 'क्लासिक टेलरिंग',
            'look_8_designer' => 'डिज़ाइनर: राल्फ लॉरेन',
            'look_8_year' => 'वर्ष: 2021',
            'look_8_desc' => 'क्लासिक नेवी सूट के साथ कालातीत टेलरिंग।',
            'look_9_text' => 'फ्लोरल फैंटेसी',
            'look_9_designer' => 'डोल्से एंड गब्बाना',
            'look_9_year' => 'वर्ष: 2023',
            'look_9_desc' => 'चमकीले फूलों के प्रिंट और नाजुक कपड़ों से सजी एक रोमांटिक ड्रेस।',
            'look_10_text' => 'आधुनिक मोनोक्रोम',
            'look_10_designer' => 'डिज़ाइनर: कैल्विन क्लेन',
            'look_10_year' => 'वर्ष: 2022',
            'look_10_desc' => 'तेज रेखाओं और न्यूनतम सौंदर्य के साथ एक चिकना मोनोक्रोम आउटफिट।',
            'look_11_text' => 'रोमांटिक लेयर्स',
            'look_11_designer' => 'डिज़ाइनर: चैनल',
            'look_11_year' => 'वर्ष: 2024',
            'look_11_desc' => 'मुलायम ट्यूल और लेस की परतें एक रोमांटिक, स्वप्निल लुक बनाती हैं।',
            'look_12_text' => 'शहरी किनारा',
            'look_12_designer' => 'डिज़ाइनर: ऑफ-व्हाइट',
            'look_12_year' => 'वर्ष: 2023',
            'look_12_desc' => 'स्ट्रीटवियर और हाई फैशन का मिश्रण, जिसमें एक मजबूत शहरी किनारा है।',
            'look_13_text' => 'ग्लैमरस मेटैलिक्स',
            'look_13_designer' => 'डिज़ाइनर: वर्साचे',
            'look_13_year' => 'वर्ष: 2024',
            'look_13_desc' => 'चमकदार मेटैलिक कपड़े और बोल्ड कट्स एक ग्लैमरस रनवे पल के लिए।',
            'look_14_text' => 'टाइमलेस सिल्हूट्स',
            'look_14_designer' => 'डिज़ाइनर: डायर',
            'look_14_year' => 'वर्ष: 2022',
            'look_14_desc' => 'आधुनिक ट्विस्ट और सॉफ्ट पेस्टल टोन के साथ क्लासिक सिल्हूट्स।',
            'look_15_text' => 'इक्लेक्टिक पैटर्न्स',
            'look_15_designer' => 'डिज़ाइनर: मिसोनी',
            'look_15_year' => 'वर्ष: 2023',
            'look_15_desc' => 'पैटर्न्स और टेक्सचर्स का एक जीवंत मिश्रण, बोल्ड और विविध शैली के लिए।',
            'modal_close' => 'Close',
            'footer_copyright' => '© 2025 History, Art & Fashion. All rights reserved.',
            'autoplay_button' => 'Start Autoplay',
            'stop_autoplay_button' => 'Stop Autoplay',
            'meta_description' => 'HAF के साथ फैशन शो की भव्यता का अनुभव करें, नवीनतम रनवे लुक्स को प्रदर्शित करते हुए',
            'hero_title' => 'फैशन शो की झलकियाँ',
            'hero_subtitle' => 'HAF के साथ रनवे की सुंदरता की खोज करें',
            'nav_history' => 'इतिहास',
            'nav_art' => 'कला',
            'nav_fashion' => 'फैशन',
            'nav_shop' => 'दुकान',
            'runway_title' => 'रनवे लुक्स',
            'runway_subtitle' => 'सीजन के सबसे प्रतिष्ठित डिज़ाइनों का एक क्यूरेटेड संग्रह',
            'modal_close' => 'बंद करें',
            'footer_copyright' => '© 2025 इतिहास, कला और फैशन. सर्वाधिकार सुरक्षित.',
            'autoplay_button' => 'ऑटोप्ले शुरू करें',
            'stop_autoplay_button' => 'ऑटोप्ले रोकें',
            'nav_history' => 'इतिहास',
            'nav_art' => 'कला',
            'nav_fashion' => 'फैशन',
            'nav_shop' => 'दुकान',
            'runway_title' => 'रनवे लुक्स',
            'runway_subtitle' => 'सीजन के सबसे प्रतिष्ठित डिज़ाइनों का एक क्यूरेटेड संग्रह'
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
            'modal_close' => 'Закрыть',
            'footer_copyright' => '© 2025 История, Искусство и Мода. Все права защищены.',
            'autoplay_button' => 'Запустить автопрокрутку',
            'stop_autoplay_button' => 'Остановить автопрокрутку'
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

    // Prepare translations for JavaScript
    $js_translations = json_encode($translations[$current_lang]);
    ?>
    <!DOCTYPE html>
    <html lang="<?php echo htmlspecialchars($current_lang); ?>" dir="<?php echo $site_dir; ?>">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php echo htmlspecialchars(get_translation($current_lang, 'meta_description')); ?>">
        <title>HAF - <?php echo htmlspecialchars(get_translation($current_lang, 'runway_title')); ?></title>
        <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;700&family=Source+Sans+Pro:wght@400;700&family=Libre+Baskerville&family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <style>
            :root {
                --color-1: #F8F1E9; /* Soft Cream */
                --color-2: #F5ECE3; /* Light Linen */
                --color-3: #FAF3E0; /* Pale Peach */
                --color-4: #FDFAF6; /* Almost White */
                --color-5: #F9F2ED; /* Warm Ivory */
                --color-6: #FFF8F0; /* Light Blush */
                --accent-pastel: linear-gradient(45deg, #E6D3D1, #D9E4DD); /* Pastel Pink to Mint */
                --text-dark: #4A4A4A; /* Soft Gray */
                --shadow-normal: 0 4px 16px rgba(0,0,0,0.05);
                --shadow-hover: 0 6px 24px rgba(0,0,0,0.08);
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
                background: linear-gradient(135deg, var(--color-3) 0%, var(--color-5) 100%);
                overflow-x: hidden;
            }

            [lang="zh"] body, [lang="zh"] h1, [lang="zh"] p, [lang="zh"] a {
                font-family: 'Noto Sans', sans-serif;
            }

            .container {
                max-width: 1400px;
                margin: 0 auto;
                padding: 0 20px;
            }

            nav {
                background: linear-gradient(90deg, var(--color-1), var(--color-3));
                padding: 15px 0;
                position: sticky;
                top: 0;
                z-index: 1000;
                box-shadow: var(--shadow-normal);
                transition: background 0.5s;
            }

            nav:hover {
                background: linear-gradient(90deg, var(--color-3), var(--color-5));
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
                color: var(--accent-pastel);
                background: linear-gradient(var(--accent-pastel));
                -webkit-background-clip: text;
                background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            nav select {
                padding: 8px;
                font-family: 'Source Sans Pro', sans-serif;
                background: var(--color-4);
                border: 1px solid var(--color-2);
                border-radius: 8px;
                color: var(--text-dark);
                margin-left: 20px;
            }

            .hero {
                position: relative;
                text-align: center;
                padding: 150px 20px;
                border-bottom: 5px solid var(--color-4);
                overflow: hidden;
                background: linear-gradient(135deg, rgba(250, 243, 224, 0.8), rgba(249, 242, 237, 0.8));
            }

            .hero video {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                z-index: -1;
                opacity: 0.2;
                filter: blur(2px);
            }

            .hero h1 {
                font-size: 4rem;
                margin-bottom: 20px;
                font-family: 'Libre Baskerville', serif;
                animation: fadeInDown 1s;
                color: var(--text-dark);
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
                position: relative;
                z-index: 1;
            }

            .hero p {
                font-size: 2rem;
                margin-bottom: 30px;
                position: relative;
                z-index: 1;
            }

            section {
                padding: 100px 0;
                border-bottom: 2px solid var(--color-2);
                background: linear-gradient(180deg, rgba(253, 250, 246, 0.9), rgba(248, 241, 233, 0.9));
                transition: transform 0.5s ease;
            }

            section:hover {
                transform: translateY(-10px);
            }

            section h2 {
                font-size: 3.5rem;
                text-align: center;
                margin-bottom: 25px;
                color: var(--text-dark);
                font-family: 'Libre Baskerville', serif;
                text-transform: uppercase;
                letter-spacing: 2px;
            }

            section p.subtitle {
                text-align: center;
                font-size: 1.6rem;
                margin-bottom: 50px;
                color: #666;
                font-style: italic;
            }

            .runway-container {
                position: relative;
                padding: 0 50px;
            }

            .runway-slider {
                overflow-x: hidden;
                scroll-behavior: smooth;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: thin;
                scrollbar-color: var(--color-2) var(--color-4);
                padding-bottom: 20px;
                position: relative;
            }

            .runway-slider::-webkit-scrollbar {
                height: 10px;
            }

            .runway-slider::-webkit-scrollbar-track {
                background: var(--color-4);
            }

            .runway-slider::-webkit-scrollbar-thumb {
                background: var(--color-2);
                border-radius: 5px;
            }

            .runway-items {
                display: flex;
                flex-direction: row;
                gap: 50px;
                padding: 0 10px;
                min-width: fit-content;
                transition: transform 0.6s ease-in-out;
            }

            .runway-item {
                flex: 0 0 750px;
                display: flex;
                align-items: center;
                background: linear-gradient(45deg, rgba(250, 243, 224, 0.3), rgba(249, 242, 237, 0.3));
                border-radius: 15px;
                overflow: hidden;
                box-shadow: var(--shadow-normal);
                transition: box-shadow 0.4s, transform 0.4s;
                opacity: 0;
                cursor: pointer;
                border: 1px solid rgba(230, 211, 209, 0.2);
            }

            .runway-item.visible {
                opacity: 1;
                animation: bounceIn 0.6s;
            }

            .runway-item:hover {
                box-shadow: var(--shadow-hover);
                transform: translateY(-10px) scale(1.03);
                border-color: rgba(217, 228, 221, 0.4);
            }

            .runway-content {
                flex: 0 0 50%;
                padding: 35px;
                text-align: left;
                background: rgba(253, 250, 246, 0.5);
            }

            .runway-content h3 {
                font-size: 2rem;
                font-family: 'Libre Baskerville', serif;
                margin-bottom: 12px;
                color: var(--text-dark);
                transition: color 0.3s;
            }

            .runway-content p {
                font-size: 1.3rem;
                color: #666;
                margin-bottom: 10px;
                transition: color 0.3s;
            }

            .runway-content p.desc {
                font-style: italic;
                color: var(--text-dark);
            }

            .runway-content:hover h3, .runway-content:hover p {
                color: #E6D3D1; /* Pastel Pink */
            }

            .runway-image {
                flex: 0 0 50%;
                position: relative;
                overflow: hidden;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .runway-image img {
                width: 100%;
                max-height: 450px; /* Set a maximum height to maintain layout consistency */
                object-fit: contain; /* Changed to contain to show the full image */
                display: block;
                transition: transform 0.4s ease, filter 0.4s ease;
            }

            .runway-image:hover img {
                transform: scale(1.15);
                filter: brightness(1.1);
            }

            .nav-arrow {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                background: linear-gradient(45deg, rgba(230, 211, 209, 0.7), rgba(217, 228, 221, 0.7));
                color: var(--text-dark);
                border: none;
                padding: 20px;
                font-size: 2.5rem;
                cursor: pointer;
                z-index: 100;
                border-radius: 50%;
                transition: transform 0.3s, background 0.3s;
            }

            .nav-arrow:hover {
                transform: translateY(-50%) scale(1.1);
                background: linear-gradient(45deg, rgba(230, 211, 209, 0.9), rgba(217, 228, 221, 0.9));
            }

            .nav-arrow.prev {
                left: 10px;
            }

            .nav-arrow.next {
                right: 10px;
            }

            .autoplay-button {
                display: block;
                margin: 25px auto;
                padding: 12px 25px;
                font-family: 'Source Sans Pro', sans-serif;
                font-size: 1.2rem;
                background: linear-gradient(45deg, #E6D3D1, #D9E4DD);
                border: none;
                border-radius: 10px;
                color: var(--text-dark);
                cursor: pointer;
                transition: transform 0.3s, box-shadow 0.3s;
                z-index: 100;
            }

            .autoplay-button:hover {
                transform: scale(1.05);
                box-shadow: var(--shadow-hover);
            }

            .modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.7);
                z-index: 1000;
                align-items: center;
                justify-content: center;
            }

            .modal-content {
                background: linear-gradient(135deg, var(--color-4), var(--color-6));
                padding: 25px;
                border-radius: 12px;
                max-width: 700px;
                text-align: center;
                color: var(--text-dark);
                animation: zoomIn 0.6s;
                box-shadow: var(--shadow-hover);
            }

            .modal-content h3 {
                font-size: 2.2rem;
                margin-bottom: 15px;
                color: #E6D3D1; /* Pastel Pink */
            }

            .modal-content p {
                font-size: 1.4rem;
                margin-bottom: 20px;
                color: #666;
            }

            .modal-close {
                padding: 10px 20px;
                font-family: 'Source Sans Pro', sans-serif;
                background: linear-gradient(45deg, #E6D3D1, #D9E4DD);
                border: none;
                border-radius: 8px;
                color: var(--text-dark);
                cursor: pointer;
                transition: transform 0.3s;
            }

            .modal-close:hover {
                transform: scale(1.1);
            }

            footer {
                background: linear-gradient(90deg, var(--color-1), var(--color-3));
                padding: 50px 0;
                text-align: center;
                color: var(--text-dark);
                font-size: 1.1rem;
                margin-top: 30px;
                border-top: 3px solid var(--color-2);
            }
        </style>
    </head>
    <body>
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
                        <option value="ja" <?php echo $current_lang === 'ja' ? 'selected' : ''; ?>>日本語</option>
                        <option value="ar" <?php echo $current_lang === 'ar' ? 'selected' : ''; ?>>العربية</option>
                        <option value="es" <?php echo $current_lang === 'es' ? 'selected' : ''; ?>>Español</option>
                        <option value="fr" <?php echo $current_lang === 'fr' ? 'selected' : ''; ?>>Français</option>
                        <option value="ru" <?php echo $current_lang === 'ru' ? 'selected' : ''; ?>>Русский</option>
                        <option value="pt" <?php echo $current_lang === 'pt' ? 'selected' : ''; ?>>Português</option>
                        <option value="de" <?php echo $current_lang === 'de' ? 'selected' : ''; ?>>Deutsch</option>
                        <option value="hi" <?php echo $current_lang === 'hi' ? 'selected' : ''; ?>>हिन्दी</option>
                    </select>
                </form>
            </div>
        </nav>

        <header class="hero">
            <div class="container">
                <h1><?php echo htmlspecialchars(get_translation($current_lang, 'hero_title')); ?></h1>
                <p><?php echo htmlspecialchars(get_translation($current_lang, 'hero_subtitle')); ?></p>
            </div>
            <video autoplay muted loop>
                <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
            </video>
        </header>

        <section class="runway">
            <div class="container">
                <h2><?php echo htmlspecialchars(get_translation($current_lang, 'runway_title')); ?></h2>
                <p class="subtitle"><?php echo htmlspecialchars(get_translation($current_lang, 'runway_subtitle')); ?></p>
                <div class="runway-container">
                    <button class="nav-arrow prev">❮</button>
                    <div class="runway-slider" id="runwaySlider">
                        <div class="runway-items">
                            <?php
                            for ($i = 1; $i <= 15; $i++) {
                                echo '<div class="runway-item" data-index="' . $i . '">';
                                echo '<div class="runway-content">';
                                echo '<h3>' . htmlspecialchars(get_translation($current_lang, 'look_' . $i . '_text')) . '</h3>';
                                echo '<p>' . htmlspecialchars(get_translation($current_lang, 'look_' . $i . '_designer')) . '</p>';
                                echo '<p>' . htmlspecialchars(get_translation($current_lang, 'look_' . $i . '_year')) . '</p>';
                                echo '<p class="desc">' . htmlspecialchars(get_translation($current_lang, 'look_' . $i . '_desc')) . '</p>';
                                echo '</div>';
                                echo '<div class="runway-image">';
                                echo '<img src="images/fashionshow/' . $i . '.jpg" alt="' . htmlspecialchars(get_translation($current_lang, 'look_' . $i . '_text')) . '">';
                                echo '</div>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                    <button class="nav-arrow next">❯</button>
                    <button class="autoplay-button" id="autoplayButton"><?php echo htmlspecialchars(get_translation($current_lang, 'autoplay_button')); ?></button>
                </div>
            </div>
        </section>

        <div class="modal" id="modal">
            <div class="modal-content">
                <h3 id="modal-title"></h3>
                <p id="modal-designer"></p>
                <p id="modal-year"></p>
                <p id="modal-desc"></p>
                <button class="modal-close"><?php echo htmlspecialchars(get_translation($current_lang, 'modal_close')); ?></button>
            </div>
        </div>

        <footer>
            <div class="container">
                <p><?php echo htmlspecialchars(get_translation($current_lang, 'footer_copyright')); ?></p>
            </div>
        </footer>

        <script>
            // Pass translations to JavaScript
            const translations = <?php echo $js_translations; ?>;
            let autoScrollInterval = null;

            document.addEventListener('DOMContentLoaded', () => {
                const slider = document.getElementById('runwaySlider');
                const prevButton = document.querySelector('.nav-arrow.prev');
                const nextButton = document.querySelector('.nav-arrow.next');
                const autoplayButton = document.getElementById('autoplayButton');
                const modal = document.getElementById('modal');
                const modalClose = document.querySelector('.modal-close');
                const runwayItems = document.querySelectorAll('.runway-item');

                // Scroll slider function
                function scrollSlider(direction) {
                    const scrollAmount = 850;
                    slider.scrollLeft += direction * scrollAmount;
                }

                // Start autoplay
                function startAutoplay() {
                    if (!autoScrollInterval) {
                        autoScrollInterval = setInterval(() => scrollSlider(1), 3000);
                        autoplayButton.textContent = translations['stop_autoplay_button'];
                    }
                }

                // Stop autoplay
                function stopAutoplay() {
                    if (autoScrollInterval) {
                        clearInterval(autoScrollInterval);
                        autoScrollInterval = null;
                        autoplayButton.textContent = translations['autoplay_button'];
                    }
                }

                // Open modal
                function openModal(index) {
                    const title = document.getElementById('modal-title');
                    const designer = document.getElementById('modal-designer');
                    const year = document.getElementById('modal-year');
                    const desc = document.getElementById('modal-desc');

                    title.textContent = translations['look_' + index + '_text'];
                    designer.textContent = translations['look_' + index + '_designer'];
                    year.textContent = translations['look_' + index + '_year'];
                    desc.textContent = translations['look_' + index + '_desc'];

                    modal.style.display = 'flex';
                }

                // Close modal
                function closeModal() {
                    modal.style.display = 'none';
                }

                // Event listeners for buttons
                prevButton.addEventListener('click', () => scrollSlider(-1));
                nextButton.addEventListener('click', () => scrollSlider(1));
                autoplayButton.addEventListener('click', () => {
                    if (autoScrollInterval) {
                        stopAutoplay();
                    } else {
                        startAutoplay();
                    }
                });
                modalClose.addEventListener('click', closeModal);
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        closeModal();
                    }
                });

                // Event listeners for runway items
                runwayItems.forEach(item => {
                    item.addEventListener('click', () => {
                        const index = item.getAttribute('data-index');
                        openModal(index);
                    });
                });

                // Intersection observer for animation
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                        }
                    });
                }, { threshold: 0.5 });

                runwayItems.forEach(item => observer.observe(item));
            });
        </script>
    </body>
    </html>