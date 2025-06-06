<?php
session_start();

// Default language is English
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en';
}

// Handle language switching (multi-language)
if (isset($_POST['lang'])) {
    $supported_langs = ['en','zh','es','ar','fr','ru','pt','de','ja','hi'];
    $lang = $_POST['lang'];
    $_SESSION['lang'] = in_array($lang, $supported_langs) ? $lang : 'en';
}

$current_lang = $_SESSION['lang'];
if (!in_array($current_lang, ['en','zh','es','ar','fr','ru','pt','de','ja','hi'])) {
    $current_lang = 'en';
}

$site_dir = 'ltr'; // Only left-to-right languages

// Placeholder image for timeline fallback
$placeholder_image = 'https://via.placeholder.com/300x150';

// Translations array, only English, including image translations within the file
$translations = [
    'en' => [
        'meta_description' => 'Discover the vast tapestry of world history with HAF, from ancient civilizations to modern times',
        'hero_title' => 'World History Unveiled',
        'hero_subtitle' => 'Explore the global events that shaped humanity with HAF',
        'nav_history' => 'History',
        'nav_world_history' => 'World History',
        'nav_malaysia_history' => 'Malaysia History',
        'nav_history_game' => 'History Game',
        'nav_art' => 'Art',
        'nav_fashion' => 'Fashion',
        'nav_shop' => 'Shop',
        'timeline_title' => 'World History Timeline',
        'timeline_subtitle' => 'Journey through pivotal global historical periods',
        'modal_close' => 'Close',
        'period_prehistoric_title' => 'Prehistoric Humans',
        'period_prehistoric_date' => 'c. 2 million BCE – 3000 BCE',
        'period_prehistoric_text' => 'Early humans lived by hunting and gathering, later developing farming, tools, and settlements.',
        'period_prehistoric_details' => 'The Prehistoric period spans from approximately 2 million BCE to 3000 BCE, marking the earliest phase of human existence...',
        'period_ancient_egypt_title' => 'Ancient Egypt',
        'period_ancient_egypt_date' => 'c. 3100 BCE – 30 BCE',
        'period_ancient_egypt_text' => 'A powerful civilization along the Nile River, known for pyramids, pharaohs, and hieroglyphs.',
        'period_ancient_egypt_details' => 'Ancient Egypt, flourishing from around 3100 BCE to 30 BCE, was one of the most advanced civilizations of its time...',
        'period_ancient_greece_title' => 'Ancient Greece',
        'period_ancient_greece_date' => 'c. 800 BCE – 146 BCE',
        'period_ancient_greece_text' => 'The birthplace of democracy, philosophy, and the Olympic Games, with lasting influence on Western culture.',
        'period_ancient_greece_details' => 'Ancient Greece, active from around 800 BCE to 146 BCE, was a collection of city-states, with Athens and Sparta being the most prominent...',
        'period_roman_empire_title' => 'Roman Empire',
        'period_roman_empire_date' => '27 BCE – 476 CE (Western Roman Empire)',
        'period_roman_empire_text' => 'A vast empire that shaped law, architecture, and governance in Europe and beyond.',
        'period_roman_empire_details' => 'The Roman Empire, established in 27 BCE with Augustus as its first emperor, spanned three continents at its height...',
        'period_renaissance_title' => 'Renaissance',
        'period_renaissance_date' => 'c. 1300 – 1600',
        'period_renaissance_text' => 'A cultural rebirth in Europe, celebrating art, science, and humanism, featuring figures like Leonardo da Vinci.',
        'period_renaissance_details' => 'The Renaissance, spanning roughly from 1300 to 1600, was a period of cultural and intellectual revival in Europe...',
        'period_exploration_title' => 'The Age of Exploration',
        'period_exploration_date' => 'c. 1400 – 1700',
        'period_exploration_text' => 'European explorers traveled the world by sea, discovering new lands and expanding trade and empires.',
        'period_exploration_details' => 'The Age of Exploration, from approximately 1400 to 1700, was a period when European powers sought new trade routes and territories...',
        'period_industrial_title' => 'Industrial Revolution',
        'period_industrial_date' => 'c. 1760 – 1840',
        'period_industrial_text' => 'A period of major industrialization with inventions like the steam engine, transforming economies and societies.',
        'period_industrial_details' => 'The Industrial Revolution, occurring between 1760 and 1840, began in Britain and spread to Europe and North America...',
        'period_ww1_title' => 'World War I',
        'period_ww1_date' => '1914 – 1918',
        'period_ww1_text' => 'A global war centered in Europe, marked by trench warfare and massive casualties, ending with major political changes.',
        'period_ww1_details' => 'World War I, fought from 1914 to 1918, was a global conflict primarily centered in Europe...',
        'period_ww1_end_title' => 'End of World War I',
        'period_ww1_end_date' => '1918',
        'period_ww1_end_text' => 'World War I ended with an armistice on November 11, 1918, after four years of devastating global conflict.',
        'period_ww1_end_details' => 'The end of World War I came on November 11, 1918, with the signing of the Armistice in a railway carriage in Compiègne, France...',
        'period_versailles_title' => 'Treaty of Versailles',
        'period_versailles_date' => '1919',
        'period_versailles_text' => 'A peace treaty that officially ended WWI; it imposed harsh penalties on Germany and redrew European borders.',
        'period_versailles_details' => 'The Treaty of Versailles, signed on June 28, 1919, in the Palace of Versailles, France, officially ended World War I...',
        'period_league_nations_title' => 'League of Nations',
        'period_league_nations_date' => 'Founded in 1920',
        'period_league_nations_text' => 'An international organization created to maintain world peace after WWI, but it was ultimately ineffective and replaced by the UN.',
        'period_league_nations_details' => 'The League of Nations was established in 1920 as part of the Treaty of Versailles, with the primary goal of maintaining world peace...',
        'period_roaring_twenties_title' => 'Roaring Twenties',
        'period_roaring_twenties_date' => '1920s',
        'period_roaring_twenties_text' => 'A decade of economic prosperity, jazz music, cultural change, and new lifestyles, especially in the U.S. and Europe.',
        'period_roaring_twenties_details' => 'The Roaring Twenties, spanning the 1920s, was a decade of economic prosperity and cultural dynamism...',
        'period_womens_suffrage_title' => 'Women Suffrage',
        'period_womens_suffrage_date' => '1920 (U.S.); varies by country',
        'period_womens_suffrage_text' => 'Women gained the right to vote in many countries, including the U.S. (19th Amendment in 1920), marking a major step in gender equality.',
        'period_womens_suffrage_details' => 'The women suffrage movement, culminating in the 1920s in many countries, was a decades-long struggle to secure voting rights for women...',
        'period_stock_crash_title' => 'Stock Market Crash',
        'period_stock_crash_date' => '1929',
        'period_stock_crash_text' => 'The U.S. stock market collapsed in October 1929, triggering a global economic downturn.',
        'period_stock_crash_details' => 'The Stock Market Crash of 1929 began on October 24, 1929 (Black Thursday), with a catastrophic drop in stock prices on the New York Stock Exchange...',
        'period_great_depression_title' => 'Great Depression',
        'period_great_depression_date' => '1929 – late 1930s',
        'period_great_depression_text' => 'A worldwide economic crisis with massive unemployment, poverty, and social hardship.',
        'period_great_depression_details' => 'The Great Depression, lasting from 1929 to the late 1930s, was a severe global economic crisis following the Stock Market Crash of 1929...',
        'period_fascism_title' => 'Rise of Fascism',
        'period_fascism_date' => '1920s – 1930s',
        'period_fascism_text' => 'Authoritarian leaders like Mussolini in Italy and Hitler in Germany gained power, promoting nationalism, militarism, and dictatorship.',
        'period_fascism_details' => 'The rise of fascism in the 1920s and 1930s was a response to economic instability, social unrest, and the aftermath of World War I...',
        'period_ww2_title' => 'World War II',
        'period_ww2_date' => '1939 – 1945',
        'period_ww2_text' => 'A global conflict involving most world powers; caused massive destruction and ended with the defeat of Nazi Germany and Imperial Japan.',
        'period_ww2_details' => 'World War II, from 1939 to 1945, was the deadliest conflict in history, involving over 30 countries and resulting in approximately 70–85 million deaths...',
        'period_cold_war_title' => 'Cold War',
        'period_cold_war_date' => 'c. 1947 – 1991',
        'period_cold_war_text' => 'A period of political and military tension between the United States and the Soviet Union, marked by nuclear arms race and ideological rivalry.',
        'period_cold_war_details' => 'The Cold War, spanning from approximately 1947 to 1991, was a prolonged period of geopolitical tension between the United States and the Soviet Union...',
        'period_civil_rights_title' => 'Civil Rights Movement',
        'period_civil_rights_date' => '1950s – 1960s',
        'period_civil_rights_text' => 'A movement in the U.S. to end racial segregation and secure equal rights for African Americans, led by figures like Martin Luther King Jr.',
        'period_civil_rights_details' => 'The Civil Rights Movement, primarily active in the 1950s and 1960s, was a struggle to end racial segregation and discrimination against African Americans in the United States...',
        'period_space_exploration_title' => 'Space Exploration',
        'period_space_exploration_date' => '1957 – present',
        'period_space_exploration_text' => 'Began with the Soviet launch of Sputnik in 1957; included the U.S. moon landing in 1969 and continues with international space missions.',
        'period_space_exploration_details' => 'Space exploration began in earnest with the Soviet Union launch of Sputnik, the first artificial satellite, on October 4, 1957...',
        'period_computer_revolution_title' => 'Computer Revolution',
        'period_computer_revolution_date' => '1970s – present',
        'period_computer_revolution_text' => 'The rapid advancement of computing technology, from early personal computers to the internet and smartphones.',
        'period_computer_revolution_details' => 'The Computer Revolution, beginning in the 1970s, transformed society through the rapid development of computing technology...',
        'period_cold_war_end_title' => 'End of the Cold War',
        'period_cold_war_end_date' => '1991',
        'period_cold_war_end_text' => 'Marked by the collapse of the Soviet Union, the fall of the Berlin Wall, and the shift toward a unipolar world led by the U.S.',
        'period_cold_war_end_details' => 'The end of the Cold War in 1991 marked the conclusion of decades of tension between the United States and the Soviet Union...',
        'period_y2k_title' => 'Year 2000 (Y2K and Globalization)',
        'period_y2k_date' => '2000',
        'period_y2k_text' => 'The world entered a new millennium; fears of the Y2K bug proved mostly harmless. The internet and globalization rapidly accelerated.',
        'period_y2k_details' => 'The year 2000 marked the dawn of a new millennium, accompanied by widespread concerns about the Y2K bug...',
        'period_financial_crisis_title' => '2008 Financial Crisis',
        'period_financial_crisis_date' => '2008',
        'period_financial_crisis_text' => 'A major global economic recession triggered by the collapse of the U.S. housing market and banking system, causing widespread job loss and financial instability.',
        'period_financial_crisis_details' => 'The 2008 Financial Crisis, often called the Great Recession, began with the collapse of the U.S. housing bubble...',
        'period_social_media_title' => 'Rise of Social Media',
        'period_social_media_date' => '2010s',
        'period_social_media_text' => 'Platforms like Facebook, Twitter, Instagram, and TikTok reshaped communication, politics, and culture around the world.',
        'period_social_media_details' => 'The rise of social media in the 2010s transformed global communication, culture, and politics, driven by platforms like Facebook...',
        'period_covid_pandemic_title' => 'COVID-19 Pandemic',
        'period_covid_pandemic_date' => '2020',
        'period_covid_pandemic_text' => 'A global health crisis caused by the coronavirus, leading to lockdowns, economic disruptions, and over 6 million deaths worldwide.',
        'period_covid_pandemic_details' => 'The COVID-19 pandemic began in late 2019 with the outbreak of a novel coronavirus (SARS-CoV-2) in Wuhan, China...',
        'period_ai_expansion_title' => 'Artificial Intelligence Expansion',
        'period_ai_expansion_date' => '2020s – 2025',
        'period_ai_expansion_text' => 'AI technologies like machine learning and large language models (e.g., ChatGPT) began transforming industries, education, and daily life.',
        'period_ai_expansion_details' => 'The expansion of artificial intelligence (AI) in the 2020s, particularly up to 2025, has reshaped industries, education, and daily life...',
        'period_current_era_title' => 'Year 2025 (Current Era)',
        'period_current_era_date' => '2025',
        'period_current_era_text' => 'Marked by rapid technological advancements, global challenges like climate change, and discussions about the role of AI, ethics, and the future of humanity.',
        'period_current_era_details' => 'The year 2025 represents a pivotal moment in the current era, characterized by rapid technological advancements and pressing global challenges...',
        'gallery_title' => 'World History Gallery',
        'gallery_subtitle' => 'Explore iconic moments and artifacts from world history',
        'image_1_text' => 'Prehistoric Cave Paintings',
        'image_1_desc' => 'Ancient cave art from Lascaux, France, depicting animals and human activities from c. 15,000 BCE.',
        'image_2_text' => 'Pyramids of Giza',
        'image_2_desc' => 'Monumental tombs built for pharaohs in Ancient Egypt, constructed around 2560 BCE.',
        'image_3_text' => 'Greek Parthenon',
        'image_3_desc' => 'A temple on the Acropolis in Athens, dedicated to Athena, built in the 5th century BCE.',
        'image_4_text' => 'Roman Colosseum',
        'image_4_desc' => 'An iconic amphitheater in Rome, completed in 80 CE, used for gladiatorial contests.',
        'image_5_text' => 'Renaissance Art: Sistine Chapel',
        'image_5_desc' => 'Michelangelo masterpiece on the ceiling of the Sistine Chapel, painted between 1508 and 1512.',
        'image_6_text' => 'Age of Exploration: Caravels',
        'image_6_desc' => 'Ships used by explorers like Columbus during the 15th century to cross oceans.',
        'image_7_text' => 'Industrial Revolution: Steam Engine',
        'image_7_desc' => 'A steam engine, pivotal to the Industrial Revolution, introduced by James Watt in the 18th century.',
        'image_8_text' => 'World War I: Trenches',
        'image_8_desc' => 'Soldiers in the trenches of the Western Front during World War I, 1914–1918.',
        'image_9_text' => 'Armistice Day 1918',
        'image_9_desc' => 'Celebrations marking the end of World War I on November 11, 1918.',
        'image_10_text' => 'Treaty of Versailles Signing',
        'image_10_desc' => 'The signing of the Treaty of Versailles in 1919, formally ending World War I.',
        'image_11_text' => 'League of Nations Assembly',
        'image_11_desc' => 'The first assembly of the League of Nations in Geneva, 1920.',
        'image_12_text' => 'Roaring Twenties: Jazz Age',
        'image_12_desc' => 'A jazz band performing in the 1920s, emblematic of the cultural vibrancy of the decade.',
        'image_13_text' => 'Women Suffrage March',
        'image_13_desc' => 'Women marching for voting rights in the U.S., leading to the 19th Amendment in 1920.',
        'image_14_text' => 'Stock Market Crash 1929',
        'image_14_desc' => 'Panic on Wall Street as the stock market crashed in October 1929.',
        'image_15_text' => 'Great Depression: Breadlines',
        'image_15_desc' => 'People lining up for food during the Great Depression in the 1930s.',
        'image_16_text' => 'Rise of Fascism: Nazi Rally',
        'image_16_desc' => 'A Nazi rally in Nuremberg, Germany, during the 1930s under Hitler regime.',
        'image_17_text' => 'World War II: D-Day',
        'image_17_desc' => 'Allied forces landing on the beaches of Normandy on D-Day, June 6, 1944.',
        'image_18_text' => 'Cold War: Berlin Wall',
        'image_18_desc' => 'The Berlin Wall, a symbol of Cold War division, constructed in 1961.',
        'image_19_text' => 'Civil Rights Movement: March on Washington',
        'image_19_desc' => 'The 1963 March on Washington, where Martin Luther King Jr. delivered his "I Have a Dream" speech.',
        'image_20_text' => 'Space Exploration: Moon Landing',
        'image_20_desc' => 'Neil Armstrong on the moon during the Apollo 11 mission, July 20, 1969.',
        'image_21_text' => 'Computer Revolution: Early PC',
        'image_21_desc' => 'An early personal computer from the 1970s, marking the start of the digital age.',
        'image_22_text' => 'Fall of the Berlin Wall',
        'image_22_desc' => 'Citizens dismantling the Berlin Wall in 1989, symbolizing the end of the Cold War.',
        'image_23_text' => 'Y2K Preparations',
        'image_23_desc' => 'Technicians preparing systems for the Y2K transition in 1999.',
        'image_24_text' => '2008 Financial Crisis: Bank Failures',
        'image_24_desc' => 'The collapse of Lehman Brothers in 2008, a key event in the global financial crisis.',
        'image_25_text' => 'Social Media: Smartphone Era',
        'image_25_desc' => 'The rise of social media in the 2010s, driven by widespread smartphone use.',
        'image_26_text' => 'COVID-19 Pandemic: Lockdowns',
        'image_26_desc' => 'Empty streets during global lockdowns in 2020 due to the COVID-19 pandemic.',
        'image_27_text' => 'AI Expansion: Robotics',
        'image_27_desc' => 'Advanced robotics powered by AI, transforming industries in the 2020s.',
        'image_28_text' => '2025: Sustainable Future',
        'image_28_desc' => 'Innovations in renewable energy and sustainability efforts in 2025.',
        'footer_copyright' => '© 2025 History, Art & Fashion. All rights reserved.',
    ],
    'zh' => [
        'meta_description' => '通过HAF探索世界历史的宏伟画卷，从古代文明到现代社会',
        'hero_title' => '世界历史揭秘',
        'hero_subtitle' => '与HAF一起探索塑造人类的全球大事件',
        'nav_history' => '历史',
        'nav_world_history' => '世界历史',
        'nav_malaysia_history' => '马来西亚历史',
        'nav_history_game' => '历史游戏',
        'nav_art' => '艺术',
        'nav_fashion' => '时尚',
        'nav_shop' => '商店',
        'timeline_title' => '世界历史年表',
        'timeline_subtitle' => '穿越全球关键历史时期',
        'modal_close' => '关闭',
        'period_prehistoric_title' => '史前人类',
        'period_prehistoric_date' => '约公元前200万年 - 公元前3000年',
        'period_prehistoric_text' => '早期人类以狩猎和采集为生，后来发展出农业、工具和定居点。',
        'period_prehistoric_details' => '史前时期从约公元前200万年到公元前3000年，标志着人类存在的最早阶段...',
        'period_ancient_egypt_title' => '古埃及',
        'period_ancient_egypt_date' => '约公元前3100年 - 公元前30年',
        'period_ancient_egypt_text' => '尼罗河沿岸的强大文明，以金字塔、法老和象形文字闻名。',
        'period_ancient_egypt_details' => '古埃及从约公元前3100年到公元前30年繁荣发展，是当时最先进的文明之一...',
        'period_ancient_greece_title' => '古希腊',
        'period_ancient_greece_date' => '约公元前800年 - 公元前146年',
        'period_ancient_greece_text' => '民主、哲学和奥运会的发源地，对西方文化产生深远影响。',
        'period_ancient_greece_details' => '古希腊从约公元前800年到公元前146年活跃，是一个城邦集合体，其中雅典和斯巴达最为突出...',
        'period_roman_empire_title' => '罗马帝国',
        'period_roman_empire_date' => '公元前27年 - 公元476年（西罗马帝国）',
        'period_roman_empire_text' => '一个塑造了欧洲及更远地区法律、建筑和治理的庞大帝国。',
        'period_roman_empire_details' => '罗马帝国于公元前27年由奥古斯都建立，在其鼎盛时期横跨三大洲...',
        'period_renaissance_title' => '文艺复兴',
        'period_renaissance_date' => '约1300年 - 1600年',
        'period_renaissance_text' => '欧洲的文化复兴，庆祝艺术、科学和人文主义，以达芬奇等人物为代表。',
        'period_renaissance_details' => '文艺复兴大约从1300年持续到1600年，是欧洲文化和知识复兴的时期...',
        'period_exploration_title' => '大航海时代',
        'period_exploration_date' => '约1400年 - 1700年',
        'period_exploration_text' => '欧洲探险家通过海路环游世界，发现新大陆并扩展贸易和帝国。',
        'period_exploration_details' => '大航海时代从约1400年到1700年，是欧洲列强寻求新贸易路线和领土的时期...',
        'period_industrial_title' => '工业革命',
        'period_industrial_date' => '约1760年 - 1840年',
        'period_industrial_text' => '以蒸汽机等发明为标志的重大工业化时期，改变了经济和社会结构。',
        'period_industrial_details' => '工业革命始于1760年，首先在英国兴起，随后扩展到欧洲和北美...',
        'period_ww1_title' => '第一次世界大战',
        'period_ww1_date' => '1914年 - 1918年',
        'period_ww1_text' => '一场以欧洲为中心的世界大战，以堑壕战和重大伤亡为特征，最终导致重大政治变革。',
        'period_ww1_details' => '第一次世界大战从1914年持续到1918年，是一场主要在欧洲进行的全球冲突...',
        'period_ww1_end_title' => '第一次世界大战结束',
        'period_ww1_end_date' => '1918年',
        'period_ww1_end_text' => '第一次世界大战于1918年11月11日停战，结束了四年的毁灭性全球冲突。',
        'period_ww1_end_details' => '第一次世界大战于1918年11月11日在法国贡比涅的一节火车车厢中签署停战协议而结束...',
        'period_versailles_title' => '凡尔赛条约',
        'period_versailles_date' => '1919年',
        'period_versailles_text' => '正式结束一战的和平条约；对德国实施严厉惩罚并重新划定欧洲边界。',
        'period_versailles_details' => '凡尔赛条约于1919年6月28日在法国凡尔赛宫签署，正式结束了第一次世界大战...',
        'period_league_nations_title' => '国际联盟',
        'period_league_nations_date' => '1920年成立',
        'period_league_nations_text' => '一战后为维护世界和平而创建的国际组织，但最终无效并被联合国取代。',
        'period_league_nations_details' => '国际联盟于1920年作为凡尔赛条约的一部分成立，其主要目标是维护世界和平...',
        'period_roaring_twenties_title' => '咆哮的二十年代',
        'period_roaring_twenties_date' => '1920年代',
        'period_roaring_twenties_text' => '经济繁荣、爵士乐、文化变革和新生活方式的十年，尤其在美国和欧洲。',
        'period_roaring_twenties_details' => '咆哮的二十年代横跨1920年代，是一个经济繁荣和文化活力的十年...',
        'period_womens_suffrage_title' => '妇女选举权',
        'period_womens_suffrage_date' => '1920年（美国）；各国不同',
        'period_womens_suffrage_text' => '妇女在许多国家获得投票权，包括美国（1920年第19修正案），标志着性别平等的重大进步。',
        'period_womens_suffrage_details' => 'The women suffrage movement, culminating in the 1920s in many countries, was a decades-long struggle to secure voting rights for women...',
        'period_stock_crash_title' => '股市崩盘',
        'period_stock_crash_date' => '1929年',
        'period_stock_crash_text' => '1929年10月美国股市崩盘，引发全球经济衰退。',
        'period_stock_crash_details' => '1929年股市崩盘始于10月24日（黑色星期四），纽约证券交易所股价暴跌...',
        'period_great_depression_title' => '大萧条',
        'period_great_depression_date' => '1929年 - 1930年代末',
        'period_great_depression_text' => '一场全球性经济危机，导致大规模失业、贫困和社会困境。',
        'period_great_depression_details' => '大萧条从1929年持续到1930年代末，是继1929年股市崩盘后的严重全球经济危机...',
        'period_fascism_title' => '法西斯主义兴起',
        'period_fascism_date' => '1920年代 - 1930年代',
        'period_fascism_text' => '墨索里尼在意大利和希特勒在德国等独裁者掌权，推行民族主义、军国主义和独裁统治。',
        'period_fascism_details' => 'The rise of fascism in the 1920s and 1930s was a response to economic instability, social unrest, and the aftermath of World War I...',
        'period_ww2_title' => '第二次世界大战',
        'period_ww2_date' => '1939年 - 1945年',
        'period_ww2_text' => '一场涉及大多数世界大国的全球冲突；造成大规模破坏，以纳粹德国和日本帝国的失败告终。',
        'period_ww2_details' => '第二次世界大战从1939年持续到1945年，是历史上最致命的冲突，涉及30多个国家，造成约7000-8500万人死亡...',
        'period_cold_war_title' => '冷战',
        'period_cold_war_date' => '约1947年 - 1991年',
        'period_cold_war_text' => '美国和苏联之间的政治和军事紧张时期，以核军备竞赛和意识形态对抗为特征。',
        'period_cold_war_details' => 'The Cold War, spanning from approximately 1947 to 1991, was a prolonged period of geopolitical tension between the United States and the Soviet Union...',
        'period_civil_rights_title' => '民权运动',
        'period_civil_rights_date' => '1950年代 - 1960年代',
        'period_civil_rights_text' => '美国结束种族隔离和争取非裔美国人平等权利的运动，由马丁·路德·金等人物领导。',
        'period_civil_rights_details' => 'The Civil Rights Movement, primarily active in the 1950s and 1960s, was a struggle to end racial segregation and discrimination against African Americans in the United States...',
        'period_space_exploration_title' => '太空探索',
        'period_space_exploration_date' => '1957年 - 至今',
        'period_space_exploration_text' => '始于1957年苏联发射人造卫星；包括1969年美国登月和持续的国际太空任务。',
        'period_space_exploration_details' => '太空探索始于1957年10月4日苏联发射第一颗人造卫星斯普特尼克...',
        'period_computer_revolution_title' => '计算机革命',
        'period_computer_revolution_date' => '1970年代 - 至今',
        'period_computer_revolution_text' => '计算技术的快速发展，从早期个人电脑到互联网和智能手机。',
        'period_computer_revolution_details' => 'The Computer Revolution, beginning in the 1970s, transformed society through the rapid development of computing technology...',
        'period_cold_war_end_title' => '冷战结束',
        'period_cold_war_end_date' => '1991年',
        'period_cold_war_end_text' => '以苏联解体、柏林墙倒塌和美国主导的单极世界转变为标志。',
        'period_cold_war_end_details' => '1991年冷战结束标志着美国和苏联之间数十年紧张关系的终结...',
        'period_y2k_title' => '2000年（千年虫和全球化）',
        'period_y2k_date' => '2000年',
        'period_y2k_text' => '世界进入新千年；千年虫恐慌大多被证明是无害的。互联网和全球化迅速发展。',
        'period_y2k_details' => 'The year 2000 marked the dawn of a new millennium, accompanied by widespread concerns about the Y2K bug...',
        'period_financial_crisis_title' => '2008年金融危机',
        'period_financial_crisis_date' => '2008年',
        'period_financial_crisis_text' => '由美国房地产市场崩溃和银行系统引发的重大全球经济衰退，导致大规模失业和金融不稳定。',
        'period_financial_crisis_details' => 'The 2008 Financial Crisis, often called the Great Recession, began with the collapse of the U.S. housing bubble...',
        'period_social_media_title' => '社交媒体兴起',
        'period_social_media_date' => '2010年代',
        'period_social_media_text' => 'Facebook、Twitter、Instagram、TikTok等平台重塑了全球通信、政治和文化。',
        'period_social_media_details' => 'The rise of social media in the 2010s transformed global communication, culture, and politics, driven by platforms like Facebook...',
        'period_covid_pandemic_title' => 'COVID-19大流行',
        'period_covid_pandemic_date' => '2020年',
        'period_covid_pandemic_text' => '由冠状病毒引起的全球健康危机，导致封锁、经济中断和全球超过600万人死亡。',
        'period_covid_pandemic_details' => 'The COVID-19 pandemic began in late 2019 with the outbreak of a novel coronavirus (SARS-CoV-2) in Wuhan, China...',
        'period_ai_expansion_title' => '人工智能扩张',
        'period_ai_expansion_date' => '2020年代 - 2025年',
        'period_ai_expansion_text' => '机器学习和大型语言模型（如ChatGPT）等AI技术开始改变行业、教育和日常生活。',
        'period_ai_expansion_details' => 'The expansion of artificial intelligence (AI) in the 2020s, particularly up to 2025, has reshaped industries, education, and daily life...',
        'period_current_era_title' => '2025年（当前时代）',
        'period_current_era_date' => '2025年',
        'period_current_era_text' => '以快速技术进步、气候变化等全球挑战以及关于AI、伦理和人类未来的讨论为标志。',
        'period_current_era_details' => 'The year 2025 represents a pivotal moment in the current era, characterized by rapid technological advancements and pressing global challenges...',
        'gallery_title' => '世界历史画廊',
        'gallery_subtitle' => '探索世界历史上的标志性时刻和文物',
        'image_1_text' => '史前洞穴壁画',
        'image_1_desc' => '法国拉斯科洞穴的古代艺术，描绘了约公元前15000年的动物和人类活动。',
        'image_2_text' => '吉萨金字塔',
        'image_2_desc' => '古埃及为法老建造的宏伟陵墓，建于约公元前2560年。',
        'image_3_text' => '希腊帕特农神庙',
        'image_3_desc' => '雅典卫城上的神庙，供奉雅典娜，建于公元前5世纪。',
        'image_4_text' => '罗马斗兽场',
        'image_4_desc' => '罗马的标志性圆形剧场，建于公元80年，用于角斗士比赛。',
        'image_5_text' => '文艺复兴艺术：西斯廷教堂',
        'image_5_desc' => '米开朗基罗在西斯廷教堂天花板上的杰作，绘制于1508年至1512年之间。',
        'image_6_text' => '大航海时代：卡拉维尔帆船',
        'image_6_desc' => '15世纪哥伦布等探险家用来横渡大洋的船只。',
        'image_7_text' => '工业革命：蒸汽机',
        'image_7_desc' => '工业革命的关键蒸汽机，由詹姆斯·瓦特在18世纪引入。',
        'image_8_text' => '第一次世界大战：战壕',
        'image_8_desc' => '1914-1918年第一次世界大战西线战壕中的士兵。',
        'image_9_text' => '1918年停战日',
        'image_9_desc' => '1918年11月11日庆祝第一次世界大战结束。',
        'image_10_text' => '凡尔赛条约签署',
        'image_10_desc' => '1919年签署凡尔赛条约，正式结束第一次世界大战。',
        'image_11_text' => '国际联盟大会',
        'image_11_desc' => '1920年国际联盟在日内瓦的第一次大会。',
        'image_12_text' => '咆哮的二十年代：爵士时代',
        'image_12_desc' => '1920年代爵士乐队表演，体现了那个年代的文化活力。',
        'image_13_text' => '妇女选举权游行',
        'image_13_desc' => '美国妇女为争取投票权游行，导致1920年第19修正案通过。',
        'image_14_text' => '1929年股市崩盘',
        'image_14_desc' => '1929年10月华尔街股市崩盘时的恐慌。',
        'image_15_text' => '大萧条：面包线',
        'image_15_desc' => '1930年代大萧条期间人们排队领取食物。',
        'image_16_text' => '法西斯主义兴起：纳粹集会',
        'image_16_desc' => '1930年代希特勒统治时期德国纽伦堡的纳粹集会。',
        'image_17_text' => '第二次世界大战：诺曼底登陆',
        'image_17_desc' => '1944年6月6日诺曼底登陆日，盟军在诺曼底海滩登陆。',
        'image_18_text' => '冷战：柏林墙',
        'image_18_desc' => '1961年建造的柏林墙，冷战分裂的象征。',
        'image_19_text' => '民权运动：华盛顿大游行',
        'image_19_desc' => '1963年华盛顿大游行，马丁·路德·金发表"我有一个梦想"演讲。',
        'image_20_text' => '太空探索：登月',
        'image_20_desc' => '1969年7月20日阿波罗11号任务期间，尼尔·阿姆斯特朗在月球上。',
        'image_21_text' => '计算机革命：早期个人电脑',
        'image_21_desc' => '1970年代的早期个人电脑，标志着数字时代的开始。',
        'image_22_text' => '柏林墙倒塌',
        'image_22_desc' => '1989年市民拆除柏林墙，象征着冷战的结束。',
        'image_23_text' => '千年虫准备',
        'image_23_desc' => '1999年技术人员为千年虫过渡准备系统。',
        'image_24_text' => '2008年金融危机：银行倒闭',
        'image_24_desc' => 'The collapse of Lehman Brothers in 2008, a key event in the global financial crisis.',
        'image_25_text' => 'Social Media: Smartphone Era',
        'image_25_desc' => 'The rise of social media in the 2010s, driven by widespread smartphone use.',
        'image_26_text' => 'COVID-19 Pandemic: Lockdowns',
        'image_26_desc' => 'Empty streets during global lockdowns in 2020 due to the COVID-19 pandemic.',
        'image_27_text' => 'AI Expansion: Robotics',
        'image_27_desc' => 'Advanced robotics powered by AI, transforming industries in the 2020s.',
        'image_28_text' => '2025: Sustainable Future',
        'image_28_desc' => 'Innovations in renewable energy and sustainability efforts in 2025.',
        'footer_copyright' => '© 2025 历史、艺术与时尚。保留所有权利。'
    ],
    'es' => [
        'meta_description' => 'Descubre el vasto tapiz de la historia mundial con HAF, desde civilizaciones antiguas hasta la era moderna',
        'hero_title' => 'Historia Mundial Revelada',
        'hero_subtitle' => 'Explora los eventos globales que dieron forma a la humanidad con HAF',
        'nav_history' => 'Historia',
        'nav_world_history' => 'Historia Mundial',
        'nav_malaysia_history' => 'Historia de Malasia',
        'nav_history_game' => 'Juego de Historia',
        'nav_art' => 'Arte',
        'nav_fashion' => 'Moda',
        'nav_shop' => 'Tienda',
        'timeline_title' => 'Línea de Tiempo de la Historia Mundial',
        'timeline_subtitle' => 'Viaja a través de períodos históricos globales clave',
        'modal_close' => 'Cerrar',
        'period_prehistoric_title' => 'Humanos Prehistóricos',
        'period_prehistoric_date' => 'c. 2 millones a.C. - 3000 a.C.',
        'period_prehistoric_text' => 'Los primeros humanos vivían de la caza y la recolección, desarrollando luego la agricultura, herramientas y asentamientos.',
        'period_prehistoric_details' => 'El período prehistórico abarca desde aproximadamente 2 millones a.C. hasta 3000 a.C., marcando la fase más temprana de la existencia humana...',
        'period_ancient_egypt_title' => 'Antiguo Egipto',
        'period_ancient_egypt_date' => 'c. 3100 a.C. - 30 a.C.',
        'period_ancient_egypt_text' => 'Una poderosa civilización a lo largo del río Nilo, conocida por sus pirámides, faraones y jeroglíficos.',
        'period_ancient_egypt_details' => 'El Antiguo Egipto, floreciendo desde alrededor de 3100 a.C. hasta 30 a.C., fue una de las civilizaciones más avanzadas de su tiempo...',
        'period_ancient_greece_title' => 'Antigua Grecia',
        'period_ancient_greece_date' => 'c. 800 a.C. - 146 a.C.',
        'period_ancient_greece_text' => 'La cuna de la democracia, la filosofía y los Juegos Olímpicos, con una influencia duradera en la cultura occidental.',
        'period_ancient_greece_details' => 'La Antigua Grecia, activa desde alrededor de 800 a.C. hasta 146 a.C., fue una colección de ciudades-estado, con Atenas y Esparta siendo las más prominentes...',
        'period_roman_empire_title' => 'Imperio Romano',
        'period_roman_empire_date' => '27 a.C. - 476 d.C. (Imperio Romano de Occidente)',
        'period_roman_empire_text' => 'Un vasto imperio que moldeó la ley, la arquitectura y el gobierno en Europa y más allá.',
        'period_roman_empire_details' => 'El Imperio Romano, establecido en 27 a.C. con Augusto como su primer emperador, abarcó tres continentes en su apogeo...',
        'period_renaissance_title' => 'Renacimiento',
        'period_renaissance_date' => 'c. 1300 - 1600',
        'period_renaissance_text' => 'Un renacimiento cultural en Europa, celebrando el arte, la ciencia y el humanismo, con figuras como Leonardo da Vinci.',
        'period_renaissance_details' => 'El Renacimiento, abarcando aproximadamente desde 1300 hasta 1600, fue un período de renacimiento cultural e intelectual en Europa...',
        'period_exploration_title' => 'La Era de la Exploración',
        'period_exploration_date' => 'c. 1400 - 1700',
        'period_exploration_text' => 'Exploradores europeos viajaron por el mundo por mar, descubriendo nuevas tierras y expandiendo el comercio y los imperios.',
        'period_exploration_details' => 'La Era de la Exploración, desde aproximadamente 1400 hasta 1700, fue un período cuando las potencias europeas buscaron nuevas rutas comerciales y territorios...',
        'period_industrial_title' => 'Revolución Industrial',
        'period_industrial_date' => 'c. 1760 - 1840',
        'period_industrial_text' => 'Un período de gran industrialización con inventos como la máquina de vapor, transformando economías y sociedades.',
        'period_industrial_details' => 'La Revolución Industrial, ocurriendo entre 1760 y 1840, comenzó en Gran Bretaña y se extendió a Europa y América del Norte...',
        'period_ww1_title' => 'Primera Guerra Mundial',
        'period_ww1_date' => '1914 - 1918',
        'period_ww1_text' => 'Una guerra global centrada en Europa, marcada por la guerra de trincheras y grandes bajas, terminando con cambios políticos importantes.',
        'period_ww1_details' => 'La Primera Guerra Mundial, librada de 1914 a 1918, fue un conflicto global principalmente centrado en Europa...',
        'period_ww1_end_title' => 'Fin de la Primera Guerra Mundial',
        'period_ww1_end_date' => '1918',
        'period_ww1_end_text' => 'La Primera Guerra Mundial terminó con un armisticio el 11 de noviembre de 1918, después de cuatro años de devastador conflicto global.',
        'period_ww1_end_details' => 'El fin de la Primera Guerra Mundial llegó el 11 de noviembre de 1918, con la firma del Armisticio en un vagón de tren en Compiègne, Francia...',
        'period_versailles_title' => 'Tratado de Versalles',
        'period_versailles_date' => '1919',
        'period_versailles_text' => 'Un tratado de paz que oficialmente puso fin a la Primera Guerra Mundial; impuso duras penas a Alemania y redibujó las fronteras europeas.',
        'period_versailles_details' => 'El Tratado de Versalles, firmado el 28 de junio de 1919 en el Palacio de Versalles, Francia, oficialmente puso fin a la Primera Guerra Mundial...',
        'period_league_nations_title' => 'Liga de las Naciones',
        'period_league_nations_date' => 'Fundada en 1920',
        'period_league_nations_text' => 'Una organización internacional creada para mantener la paz mundial después de la Primera Guerra Mundial, pero finalmente fue inefectiva y reemplazada por la ONU.',
        'period_league_nations_details' => 'La Liga de las Naciones fue establecida en 1920 como parte del Tratado de Versalles, con el objetivo principal de mantener la paz mundial...',
        'period_roaring_twenties_title' => 'Los Años Veinte',
        'period_roaring_twenties_date' => 'Años 1920',
        'period_roaring_twenties_text' => 'Una década de prosperidad económica, música jazz, cambio cultural y nuevos estilos de vida, especialmente en EE.UU. y Europa.',
        'period_roaring_twenties_details' => 'Los Años Veinte, abarcando la década de 1920, fue un período de prosperidad económica y dinamismo cultural...',
        'period_womens_suffrage_title' => 'Sufragio Femenino',
        'period_womens_suffrage_date' => '1920 (EE.UU.); varía por país',
        'period_womens_suffrage_text' => 'Las mujeres obtuvieron el derecho al voto en muchos países, incluyendo EE.UU. (19ª Enmienda en 1920), marcando un gran paso en la igualdad de género.',
        'period_womens_suffrage_details' => 'El movimiento por el sufragio femenino, culminando en los años 1920 en muchos países, fue una lucha de décadas para asegurar el derecho de voto para las mujeres...',
        'period_stock_crash_title' => 'Crack de la Bolsa',
        'period_stock_crash_date' => '1929',
        'period_stock_crash_text' => 'La bolsa de valores de EE.UU. colapsó en octubre de 1929, desencadenando una recesión económica global.',
        'period_stock_crash_details' => 'El Crack de la Bolsa de 1929 comenzó el 24 de octubre de 1929 (Jueves Negro), con una caída catastrófica en los precios de las acciones en la Bolsa de Nueva York...',
        'period_great_depression_title' => 'Gran Depresión',
        'period_great_depression_date' => '1929 - finales de 1930',
        'period_great_depression_text' => 'Una crisis económica mundial con desempleo masivo, pobreza y dificultades sociales.',
        'period_great_depression_details' => 'La Gran Depresión, durando desde 1929 hasta finales de los años 1930, fue una severa crisis económica global tras el Crack de la Bolsa de 1929...',
        'period_fascism_title' => 'Auge del Fascismo',
        'period_fascism_date' => 'Años 1920 - 1930',
        'period_fascism_text' => 'Líderes autoritarios como Mussolini en Italia y Hitler en Alemania ganaron poder, promoviendo nacionalismo, militarismo y dictadura.',
        'period_fascism_details' => 'El auge del fascismo en los años 1920 y 1930 fue una respuesta a la inestabilidad económica, el malestar social y las secuelas de la Primera Guerra Mundial...',
        'period_ww2_title' => 'Segunda Guerra Mundial',
        'period_ww2_date' => '1939 - 1945',
        'period_ww2_text' => 'Un conflicto global que involucró a la mayoría de las potencias mundiales; causó destrucción masiva y terminó con la derrota de la Alemania nazi y el Japón imperial.',
        'period_ww2_details' => 'La Segunda Guerra Mundial, de 1939 a 1945, fue el conflicto más mortífero de la historia, involucrando a más de 30 países y resultando en aproximadamente 70-85 millones de muertes...',
        'period_cold_war_title' => 'Guerra Fría',
        'period_cold_war_date' => 'c. 1947 - 1991',
        'period_cold_war_text' => 'Un período de tensión política y militar entre Estados Unidos y la Unión Soviética, marcado por la carrera armamentística nuclear y la rivalidad ideológica.',
        'period_cold_war_details' => 'La Guerra Fría, abarcando desde aproximadamente 1947 hasta 1991, fue un período prolongado de tensión geopolítica entre Estados Unidos y la Unión Soviética...',
        'period_civil_rights_title' => 'Movimiento por los Derechos Civiles',
        'period_civil_rights_date' => 'Años 1950 - 1960',
        'period_civil_rights_text' => 'Un movimiento en EE.UU. para terminar con la segregación racial y asegurar derechos iguales para los afroamericanos, liderado por figuras como Martin Luther King Jr.',
        'period_civil_rights_details' => 'El Movimiento por los Derechos Civiles, principalmente activo en los años 1950 y 1960, fue una lucha para terminar con la segregación racial y la discriminación contra los afroamericanos en Estados Unidos...',
        'period_space_exploration_title' => 'Exploración Espacial',
        'period_space_exploration_date' => '1957 - presente',
        'period_space_exploration_text' => 'Comenzó con el lanzamiento soviético del Sputnik en 1957; incluyó el alunizaje estadounidense en 1969 y continúa con misiones espaciales internacionales.',
        'period_space_exploration_details' => 'La exploración espacial comenzó en serio con el lanzamiento del Sputnik, el primer satélite artificial, por la Unión Soviética el 4 de octubre de 1957...',
        'period_computer_revolution_title' => 'Revolución Informática',
        'period_computer_revolution_date' => 'Años 1970 - presente',
        'period_computer_revolution_text' => 'El rápido avance de la tecnología informática, desde las primeras computadoras personales hasta Internet y los smartphones.',
        'period_computer_revolution_details' => 'La Revolución Informática, comenzando en los años 1970, transformó la sociedad a través del rápido desarrollo de la tecnología informática...',
        'period_cold_war_end_title' => 'Fin de la Guerra Fría',
        'period_cold_war_end_date' => '1991',
        'period_cold_war_end_text' => 'Marcado por el colapso de la Unión Soviética, la caída del Muro de Berlín y el cambio hacia un mundo unipolar liderado por EE.UU.',
        'period_cold_war_end_details' => 'El fin de la Guerra Fría en 1991 marcó la conclusión de décadas de tensión entre Estados Unidos y la Unión Soviética...',
        'period_y2k_title' => 'Año 2000 (Y2K y Globalización)',
        'period_y2k_date' => '2000',
        'period_y2k_text' => 'El mundo entró en un nuevo milenio; los temores del error Y2K resultaron mayormente inofensivos. Internet y la globalización se aceleraron rápidamente.',
        'period_y2k_details' => 'El año 2000 marcó el amanecer de un nuevo milenio, acompañado de preocupaciones generalizadas sobre el error Y2K...',
        'period_financial_crisis_title' => 'Crisis Financiera de 2008',
        'period_financial_crisis_date' => '2008',
        'period_financial_crisis_text' => 'Una importante recesión económica global desencadenada por el colapso del mercado inmobiliario y el sistema bancario de EE.UU., causando pérdida generalizada de empleos e inestabilidad financiera.',
        'period_financial_crisis_details' => 'La Crisis Financière de 2008, a menudo llamada la Grande Récession, a commencé avec l\'effondrement de la bulle immobilière américaine...',
        'period_social_media_title' => 'Montée des Réseaux Sociaux',
        'period_social_media_date' => 'Années 2010',
        'period_social_media_text' => 'Des plateformes comme Facebook, Twitter, Instagram et TikTok ont remodelé la communication, la politique et la culture dans le monde entier.',
        'period_social_media_details' => 'La montée des réseaux sociaux dans les années 2010 a transformé la communication, la culture et la politique mondiale, propulsée par des plateformes comme Facebook...',
        'period_covid_pandemic_title' => 'Pandémie COVID-19',
        'period_covid_pandemic_date' => '2020',
        'period_covid_pandemic_text' => 'Une crise sanitaire mondiale causée par le coronavirus, entraînant des confinements, des perturbations économiques et plus de 6 millions de décès dans le monde.',
        'period_covid_pandemic_details' => 'La pandémie COVID-19 a commencé fin 2019 avec l\'émergence d\'un nouveau coronavirus (SARS-CoV-2) à Wuhan, Chine...',
        'period_ai_expansion_title' => 'Expansion de l\'Intelligence Artificielle',
        'period_ai_expansion_date' => 'Années 2020 - 2025',
        'period_ai_expansion_text' => 'Les technologies d\'IA comme l\'apprentissage automatique et les grands modèles de langage (par exemple, ChatGPT) ont commencé à transformer les industries, l\'éducation et la vie quotidienne.',
        'period_ai_expansion_details' => 'La expansion de l\'intelligence artificielle (IA) dans les années 2020, particulièrement jusqu\'en 2025, a remodelé les industries, l\'éducation et la vie quotidienne...',
        'period_current_era_title' => 'Année 2025 (Ère Actuelle)',
        'period_current_era_date' => '2025',
        'period_current_era_text' => 'Marquée par des avancées technologiques rapides, des défis mondiaux comme le changement climatique, et des discussions sur le rôle de l\'IA, l\'éthique et l\'avenir de l\'humanité.',
        'period_current_era_details' => 'L\'année 2025 représente un moment crucial dans l\'ère actuelle, caractérisé par des avancées technologiques rapides et des défis mondiaux urgents...',
        'gallery_title' => 'Galerie d\'Histoire Mondiale',
        'gallery_subtitle' => 'Explorez des moments et des artefacts emblématiques de l\'histoire mondiale',
        'image_1_text' => 'Peintures Rupestres Préhistoriques',
        'image_1_desc' => 'Art rupestre ancien de Lascaux, France, représentant des animaux et des activités humaines d\'env. 15000 av. J.-C.',
        'image_2_text' => 'Pirámides de Giza',
        'image_2_desc' => 'Tumbas monumentales construidas para faraones en el Antiguo Egipto, construidas alrededor de 2560 a.C.',
        'image_3_text' => 'Partenón Griego',
        'image_3_desc' => 'Un temple en la Acrópolis de Atenas, dedicado a Atenea, construido en el siglo V a.C.',
        'image_4_text' => 'Roman Colosseum',
        'image_4_desc' => 'Un anfiteatro icónico en Roma, completado en 80 d.C., usado para concursos de gladiadores.',
        'image_5_text' => 'Arte Renacentista: Capilla Sixtina',
        'image_5_desc' => 'Obra maestra de Miguel Ángel en el techo de la Capilla Sixtina, pintada entre 1508 y 1512.',
        'image_6_text' => 'Era de la Exploración: Carabelas',
        'image_6_desc' => 'Barcos usados por exploradores como Colón durante el siglo XV para cruzar océanos.',
        'image_7_text' => 'Revolución Industrial: Máquina de Vapor',
        'image_7_desc' => 'Una máquina de vapor, fundamental para la Revolución Industrial, introducida por James Watt en el siglo XVIII.',
        'image_8_text' => 'Primera Guerra Mundial: Trincheras',
        'image_8_desc' => 'Soldados en las trincheras del Frente Occidental durante la Primera Guerra Mundial, 1914-1918.',
        'image_9_text' => 'Día del Armisticio 1918',
        'image_9_desc' => 'Celebraciones marcando el fin de la Primera Guerra Mundial el 11 de noviembre de 1918.',
        'image_10_text' => 'Firma del Tratado de Versalles',
        'image_10_desc' => 'La firma del Tratado de Versalles en 1919, formalmente terminando la Primera Guerra Mundial.',
        'image_11_text' => 'Asamblea de la Liga de las Naciones',
        'image_11_desc' => 'La primera asamblea de la Liga de las Naciones en Ginebra, 1920.',
        'image_12_text' => 'Años Veinte: Era del Jazz',
        'image_12_desc' => 'Una banda de jazz actuando en los años 1920, emblemática de la vitalidad cultural de la década.',
        'image_13_text' => 'Marcha por el Sufragio Femenino',
        'image_13_desc' => 'Mujeres marchando por el derecho al voto en EE.UU., llevando a la 19ª Enmienda en 1920.',
        'image_14_text' => 'Crack de la Bolsa 1929',
        'image_14_desc' => 'Pánico en Wall Street cuando la bolsa se desplomó en octubre de 1929.',
        'image_15_text' => 'Gran Depresión: Colas de Pan',
        'image_15_desc' => 'Personas haciendo cola para comida durante la Gran Depresión en los años 1930.',
        'image_16_text' => 'Auge del Fascismo: Concentración Nazi',
        'image_16_desc' => 'Una concentración nazi en Nuremberg, Alemania, durante los años 1930 bajo el régimen de Hitler.',
        'image_17_text' => 'Segunda Guerra Mundial: Día D',
        'image_17_desc' => 'Fuerzas aliadas desembarcando en las playas de Normandía el Día D, 6 de junio de 1944.',
        'image_18_text' => 'Guerra Fría: Muro de Berlín',
        'image_18_desc' => 'El Muro de Berlín, un símbolo de la división de la Guerra Fría, construido en 1961.',
        'image_19_text' => 'Movimiento por los Derechos Civiles: Marcha en Washington',
        'image_19_desc' => 'La Marcha en Washington de 1963, donde Martin Luther King Jr. pronunció su discurso "Tengo un sueño".',
        'image_20_text' => 'Exploración Espacial: Alunizaje',
        'image_20_desc' => 'Neil Armstrong en la luna durante la misión Apolo 11, 20 de julio de 1969.',
        'image_21_text' => 'Revolución Informática: PC Temprana',
        'image_21_desc' => 'Una computadora personal temprana de los años 1970, marcando el inicio de la era digital.',
        'image_22_text' => 'Caída del Muro de Berlín',
        'image_22_desc' => 'Ciudadanos démantelando el Muro de Berlín en 1989, simbolizando la fin de la Guerra Fría.',
        'image_23_text' => 'Preparaciones Y2K',
        'image_23_desc' => 'Técnicos preparando sistemas para la transición Y2K en 1999.',
        'image_24_text' => '2008 Financial Crisis: Bank Failures',
        'image_24_desc' => 'The collapse of Lehman Brothers in 2008, a key event in the global financial crisis.',
        'image_25_text' => 'Social Media: Smartphone Era',
        'image_25_desc' => 'The rise of social media in the 2010s, driven by widespread smartphone use.',
        'image_26_text' => 'COVID-19 Pandemic: Lockdowns',
        'image_26_desc' => 'Empty streets during global lockdowns in 2020 due to the COVID-19 pandemic.',
        'image_27_text' => 'AI Expansion: Robotics',
        'image_27_desc' => 'Advanced robotics powered by AI, transforming industries in the 2020s.',
        'image_28_text' => '2025: Sustainable Future',
        'image_28_desc' => 'Innovaciones en energía renovable y esfuerzos de sostenibilidad en 2025.',
        'footer_copyright' => '© 2025 Historia, Arte y Moda. Todos los derechos reservados.'
    ],
    'ar' => [
        'meta_description' => 'اكتشف تاريخ العالم الغني مع HAF، من الحضارات القديمة إلى العصر الحديث',
        'hero_title' => 'كشف تاريخ العالم',
        'hero_subtitle' => 'استكشف الأحداث العالمية التي شكلت البشرية مع HAF',
        'nav_history' => 'التاريخ',
        'nav_world_history' => 'تاريخ العالم',
        'nav_malaysia_history' => 'تاريخ ماليزيا',
        'nav_history_game' => 'لعبة التاريخ',
        'nav_art' => 'الفن',
        'nav_fashion' => 'الموضة',
        'nav_shop' => 'المتجر',
        'timeline_title' => 'الجدول الزمني لتاريخ العالم',
        'timeline_subtitle' => 'ارتحل عبر الفترات التاريخية الرئيسية في العالم',
        'modal_close' => 'إغلاق',
        'period_prehistoric_title' => 'البشر ما قبل التاريخ',
        'period_prehistoric_date' => 'حوالي 2 مليون قبل الميلاد - 3000 قبل الميلاد',
        'period_prehistoric_text' => 'عاش البشر الأوائل على الصيد وجمع الثمار، ثم طوروا الزراعة والأدوات والمستوطنات.',
        'period_prehistoric_details' => 'تمتد فترة ما قبل التاريخ من حوالي 2 مليون قبل الميلاد إلى 3000 قبل الميلاد، وتمثل أقدم مرحلة من وجود البشر...',
        'period_ancient_egypt_title' => 'مصر القديمة',
        'period_ancient_egypt_date' => 'حوالي 3100 قبل الميلاد - 30 قبل الميلاد',
        'period_ancient_egypt_text' => 'حضارة قوية على ضفاف النيل، اشتهرت بالأهرامات والفراعنة والهيروغليفية.',
        'period_ancient_egypt_details' => 'ازدهرت مصر القديمة من 3100 قبل الميلاد إلى 30 قبل الميلاد، وكانت واحدة من أكثر الحضارات تقدماً في عصرها...',
        'period_ancient_greece_title' => 'اليونان القديمة',
        'period_ancient_greece_date' => 'حوالي 800 قبل الميلاد - 146 قبل الميلاد',
        'period_ancient_greece_text' => 'مهد الديمقراطية والفلسفة والألعاب الأولمبية، مع تأثير دائم على الثقافة الغربية.',
        'period_ancient_greece_details' => 'كانت اليونان القديمة نشطة من 800 قبل الميلاد إلى 146 قبل الميلاد، وكانت مجموعة من دول المدن، مع أثينا وسبارتا كأهمها...',
        'period_roman_empire_title' => 'الإمبراطورية الرومانية',
        'period_roman_empire_date' => '27 قبل الميلاد - 476 م (الإمبراطورية الرومانية الغربية)',
        'period_roman_empire_text' => 'إمبراطورية شاسعة شكلت القانون والعمارة والحكم في أوروبا وما وراءها.',
        'period_roman_empire_details' => 'تأسست الإمبراطورية الرومانية في 27 قبل الميلاد مع أغسطس كأول إمبراطور، وامتدت في ذروتها عبر ثلاث قارات...',
        'period_renaissance_title' => 'عصر النهضة',
        'period_renaissance_date' => 'حوالي 1300 - 1600',
        'period_renaissance_text' => 'نهضة ثقافية في أوروبا، احتفلت بالفن والعلوم والإنسانية، مع شخصيات مثل ليوناردو دافنشي.',
        'period_renaissance_details' => 'امتد عصر النهضة من حوالي 1300 إلى 1600، وكان فترة نهضة ثقافية وفكرية في أوروبا...',
        'period_exploration_title' => 'عصر الاستكشاف',
        'period_exploration_date' => 'حوالي 1400 - 1700',
        'period_exploration_text' => 'استكشف الأوروبيون العالم بالسفن، واكتشفوا أراضٍ جديدة ووسعوا التجارة والإمبراطوريات.',
        'period_exploration_details' => 'كان عصر الاستكشاف من حوالي 1400 إلى 1700، عندما كانت القوى الأوروبية تبحث عن طرق تجارية وأراضٍ جديدة...',
        'period_industrial_title' => 'الثورة الصناعية',
        'period_industrial_date' => 'حوالي 1760 - 1840',
        'period_industrial_text' => 'فترة من التصنيع الكبير مع اختراعات مثل المحرك البخاري، غيرت الاقتصاد والمجتمعات.',
        'period_industrial_details' => 'بدأت الثورة الصناعية بين 1760 و1840 في بريطانيا وانتشرت إلى أوروبا وأمريكا الشمالية...',
        'period_ww1_title' => 'الحرب العالمية الأولى',
        'period_ww1_date' => '1914 - 1918',
        'period_ww1_text' => 'حرب عالمية تركزت في أوروبا، تميزت بحرب الخنادق وخسائر كبيرة، وانتهت بتغييرات سياسية كبيرة.',
        'period_ww1_details' => 'خاضت الحرب العالمية الأولى من 1914 إلى 1918، وكانت صراعاً عالمياً تركز في أوروبا...',
        'period_ww1_end_title' => 'نهاية الحرب العالمية الأولى',
        'period_ww1_end_date' => '1918',
        'period_ww1_end_text' => 'انتهت الحرب العالمية الأولى بهدنة في 11 نوفمبر 1918، بعد أربع سنوات من الصراع العالمي المدمر.',
        'period_ww1_end_details' => 'جاءت نهاية الحرب العالمية الأولى في 11 نوفمبر 1918 مع توقيع الهدنة في عربة قطار في كومبيين، فرنسا...',
        'period_versailles_title' => 'معاهدة فرساي',
        'period_versailles_date' => '1919',
        'period_versailles_text' => 'معاهدة سلام أنهت الحرب العالمية الأولى رسمياً؛ فرضت عقوبات قاسية على ألمانيا وأعادت تشكيل حدود أوروبا.',
        'period_versailles_details' => 'تم توقيع معاهدة فرساي في 28 يونيو 1919 في قصر فرساي، فرنسا، وأنهت الحرب العالمية الأولى رسمياً...',
        'period_league_nations_title' => 'عصبة الأمم',
        'period_league_nations_date' => 'تأسست 1920',
        'period_league_nations_text' => 'منظمة دولية للحفاظ على السلام العالمي بعد الحرب العالمية الأولى، لكنها أثبتت عدم فعاليتها وتم استبدالها بالأمم المتحدة.',
        'period_league_nations_details' => 'تأسست عصبة الأمم في 1920 كجزء من معاهدة فرساي، وكان هدفها الرئيسي الحفاظ على السلام العالمي...',
        'period_roaring_twenties_title' => 'العشرينات الصاخبة',
        'period_roaring_twenties_date' => 'عقد 1920',
        'period_roaring_twenties_text' => 'عقد من الازدهار الاقتصادي وموسيقى الجاز والتغييرات الثقافية وأنماط حياة جديدة، خاصة في الولايات المتحدة وأوروبا.',
        'period_roaring_twenties_details' => 'غطت العشرينات الصاخبة عقد 1920، وكانت فترة من الازدهار الاقتصادي والحيوية الثقافية...',
        'period_womens_suffrage_title' => 'حق المرأة في التصويت',
        'period_womens_suffrage_date' => '1920 (الولايات المتحدة)؛ يختلف حسب البلد',
        'period_womens_suffrage_text' => 'حصلت النساء على حق التصويت في العديد من البلدان، بما في ذلك الولايات المتحدة (التعديل التاسع عشر 1920)، خطوة كبيرة نحو المساواة بين الجنسين.',
        'period_womens_suffrage_details' => 'بلغت حركة حق المرأة في التصويت ذروتها في 1920 في العديد من البلدان، بعد عقود من النضال من أجل حق التصويت...',
        'period_stock_crash_title' => 'انهيار سوق الأسهم',
        'period_stock_crash_date' => '1929',
        'period_stock_crash_text' => 'انهيار سوق الأسهم الأمريكية في أكتوبر 1929، مما أدى إلى ركود اقتصادي عالمي.',
        'period_stock_crash_details' => 'بدأ انهيار سوق الأسهم 1929 في 24 أكتوبر 1929 (الخميس الأسود) مع انهيار كارثي في أسعار الأسهم في بورصة نيويورك...',
        'period_great_depression_title' => 'الكساد الكبير',
        'period_great_depression_date' => '1929 - نهاية 1930',
        'period_great_depression_text' => 'أزمة اقتصادية عالمية مع بطالة جماعية وفقر وصعوبات اجتماعية.',
        'period_great_depression_details' => 'الكساد الكبير، الذي استمر من 1929 إلى أواخر عقد 1930، كان أزمة اقتصادية عالمية شديدة بعد انهيار سوق الأسهم في 1929...',
        'period_fascism_title' => 'صعود الفاشية',
        'period_fascism_date' => 'عقد 1920 - 1930',
        'period_fascism_text' => 'زعماء استبداديون مثل موسوليني في إيطاليا وهتلر في ألمانيا اكتسبوا السلطة، مما عزز القومية والعسكرية والديكتاتورية.',
        'period_fascism_details' => 'كان صعود الفاشية في عقد 1920 و 1930 استجابة لعدم الاستقرار الاقتصادي والاضطراب الاجتماعي وتبعات الحرب العالمية الأولى...',
        'period_ww2_title' => 'الحرب العالمية الثانية',
        'period_ww2_date' => '1939 - 1945',
        'period_ww2_text' => 'حرب عالمية شاركت فيها معظم القوى العالمية؛ تسبب في دمار هائل وانتهى بهزيمة ألمانيا النازية واليابان الإمبراطورية.',
        'period_ww2_details' => 'الحرب العالمية الثانية، من 1939 إلى 1945، كانت أكثر الصراعات دموية في التاريخ، شارك فيها أكثر من 30 بلداً وأسفرت عن حوالي 70-85 مليون قتيل...',
        'period_cold_war_title' => 'الحرب الباردة',
        'period_cold_war_date' => 'حوالي 1947 - 1991',
        'period_cold_war_text' => 'فترة من التوتر السياسي والعسكري بين الولايات المتحدة والاتحاد السوفيتي، تميزت بسباق التسلح النووي والمنافسة الأيديولوجية.',
        'period_cold_war_details' => 'الحرب الباردة، التي امتدت من حوالي 1947 إلى 1991، كانت فترة طويلة من التوتر الجيوسياسي بين الولايات المتحدة والاتحاد السوفيتي...',
        'period_civil_rights_title' => 'حركة الحقوق المدنية',
        'period_civil_rights_date' => 'عقد 1950 - 1960',
        'period_civil_rights_text' => 'حركة في الولايات المتحدة لإنهاء الفصل العنصري وضمان حقوق متساوية للأمريكيين الأفارقة، بقيادة شخصيات مثل مارتن لوثر كينغ جونيور.',
        'period_civil_rights_details' => 'حركة الحقوق المدنية، النشطة بشكل أساسي في عقد 1950 و 1960، كانت نضالاً لإنهاء الفصل العنصري والتمييز ضد الأمريكيين الأفارقة في الولايات المتحدة...',
        'period_space_exploration_title' => 'استكشاف الفضاء',
        'period_space_exploration_date' => '1957 - حتى الآن',
        'period_space_exploration_text' => 'بدأ مع إطلاق السوفيت لسبوتنيك في 1957؛ شمل هبوط الأمريكيين على القمر في 1969 ويستمر مع البعثات الفضائية الدولية.',
        'period_space_exploration_details' => 'بدأ استكشاف الفضاء بشكل جدي مع إطلاق سبوتنيك، أول قمر صناعي، من قبل الاتحاد السوفيتي في 4 أكتوبر 1957...',
        'period_computer_revolution_title' => 'الثورة الحاسوبية',
        'period_computer_revolution_date' => 'عقد 1970 - حتى الآن',
        'period_computer_revolution_text' => 'التقدم السريع في تكنولوجيا الحاسوب، من أجهزة الكمبيوتر الشخصية الأولى إلى الإنترنت والهواتف الذكية.',
        'period_computer_revolution_details' => 'الثورة الحاسوبية، التي بدأت في عقد 1970، غيرت المجتمع من خلال التطور السريع لتكنولوجيا الحاسوب...',
        'period_cold_war_end_title' => 'نهاية الحرب الباردة',
        'period_cold_war_end_date' => '1991',
        'period_cold_war_end_text' => 'تميزت بانهيار الاتحاد السوفيتي، وسقوط جدار برلين، والتحول نحو عالم أحادي القطب بقيادة الولايات المتحدة.',
        'period_cold_war_end_details' => 'نهاية الحرب الباردة في 1991 مثلت ختام عقود من التوتر بين الولايات المتحدة والاتحاد السوفيتي...',
        'period_y2k_title' => 'عام 2000 (Y2K والعولمة)',
        'period_y2k_date' => '2000',
        'period_y2k_text' => 'دخل العالم الألفية الجديدة؛ تبين أن مخاوف خطأ Y2K كانت غير ضارة في الغالب. تسارع الإنترنت والعولمة بسرعة.',
        'period_y2k_details' => 'مثل عام 2000 فجر ألفية جديدة، مصحوبة بمخاوف واسعة النطاق حول خطأ Y2K...',
        'period_financial_crisis_title' => 'الأزمة المالية 2008',
        'period_financial_crisis_date' => '2008',
        'period_financial_crisis_text' => 'ركود اقتصادي عالمي كبير نجم عن انهيار سوق الإسكان والنظام المصرفي الأمريكي، مما تسبب في فقدان الوظائف على نطاق واسع وعدم استقرار مالي.',
        'period_financial_crisis_details' => 'الأزمة المالية 2008، التي غالباً ما تسمى الركود الكبير، بدأت مع انهيار فقاعة الإسكان الأمريكية...',
        'period_social_media_title' => 'صعود وسائل التواصل الاجتماعي',
        'period_social_media_date' => 'عقد 2010',
        'period_social_media_text' => 'منصات مثل فيسبوك وتويتر وإنستغرام وتيك توك أعادت تشكيل الاتصال والسياسة والثقافة في جميع أنحاء العالم.',
        'period_social_media_details' => 'صعود وسائل التواصل الاجتماعي في عقد 2010 غير الاتصال والثقافة والسياسة العالمية، مدفوعاً بمنصات مثل فيسبوك...',
        'period_covid_pandemic_title' => 'جائحة كوفيد-19',
        'period_covid_pandemic_date' => '2020',
        'period_covid_pandemic_text' => 'أزمة صحية عالمية ناجمة عن فيروس كورونا، مما أدى إلى عمليات إغلاق واختلالات اقتصادية وأكثر من 6 ملايين حالة وفاة في جميع أنحاء العالم.',
        'period_covid_pandemic_details' => 'بدأت جائحة كوفيد-19 في أواخر 2019 مع تفشي فيروس كورونا جديد (SARS-CoV-2) في ووهان، الصين...',
        'period_ai_expansion_title' => 'توسع الذكاء الاصطناعي',
        'period_ai_expansion_date' => 'عقد 2020 - 2025',
        'period_ai_expansion_text' => 'بدأت تقنيات الذكاء الاصطناعي مثل التعلم الآلي ونماذج اللغة الكبيرة (مثل ChatGPT) في تحويل الصناعات والتعليم والحياة اليومية.',
        'period_ai_expansion_details' => 'توسع الذكاء الاصطناعي في عقد 2020، وخاصة حتى 2025، أعاد تشكيل الصناعات والتعليم والحياة اليومية...',
        'period_current_era_title' => 'عام 2025 (العصر الحالي)',
        'period_current_era_date' => '2025',
        'period_current_era_text' => 'تميز بتقدم تكنولوجي سريع، وتحديات عالمية مثل تغير المناخ، ومناقشات حول دور الذكاء الاصطناعي والأخلاق ومستقبل الإنسانية.',
        'period_current_era_details' => 'يمثل عام 2025 لحظة حاسمة في العصر الحالي، يتميز بتقدم تكنولوجي سريع وتحديات عالمية ملحة...',
        'gallery_title' => 'معرض التاريخ العالمي',
        'gallery_subtitle' => 'استكشف لحظات وقطع أثرية أيقونية من التاريخ العالمي',
        'image_1_text' => 'رسومات الكهوف ما قبل التاريخ',
        'image_1_desc' => 'فن الكهوف القديم من لاسكو، فرنسا، يصور الحيوانات والأنشطة البشرية من حوالي 15000 ق.م.',
        'image_2_text' => 'أهرامات الجيزة',
        'image_2_desc' => 'مقابر ضخمة بنيت للفراعنة في مصر القديمة، بنيت حوالي 2560 ق.م.',
        'image_3_text' => 'البارثينون اليوناني',
        'image_3_desc' => 'معبد في أكروبوليس أثينا، مكرس لأثينا، بني في القرن الخامس ق.م.',
        'image_4_text' => 'الكولوسيوم الروماني',
        'image_4_desc' => 'مدرج أيقوني في روما، اكتمل في 80 م، استخدم لمسابقات المصارعين.',
        'image_5_text' => 'فن عصر النهضة: كنيسة سيستين',
        'image_5_desc' => 'تحفة مايكل أنجلو على سقف كنيسة سيستين، رسمت بين 1508 و 1512.',
        'image_6_text' => 'عصر الاستكشاف: الكارافيل',
        'image_6_desc' => 'سفن استخدمها مستكشفون مثل كولومبوس خلال القرن الخامس عشر لعبور المحيطات.',
        'image_7_text' => 'الثورة الصناعية: المحرك البخاري',
        'image_7_desc' => 'محرك بخاري، أساسي للثورة الصناعية، قدمه جيمس وات في القرن الثامن عشر.',
        'image_8_text' => 'الحرب العالمية الأولى: الخنادق',
        'image_8_desc' => 'جنود في خنادق الجبهة الغربية خلال الحرب العالمية الأولى، 1914-1918.',
        'image_9_text' => 'يوم الهدنة 1918',
        'image_9_desc' => 'احتفالات بمناسبة نهاية الحرب العالمية الأولى في 11 نوفمبر 1918.',
        'image_10_text' => 'توقيع معاهدة فرساي',
        'image_10_desc' => 'توقيع معاهدة فرساي في 1919، إنهاء رسمي للحرب العالمية الأولى.',
        'image_11_text' => 'جمعية عصبة الأمم',
        'image_11_desc' => 'الجمعية الأولى لعصبة الأمم في جنيف، 1920.',
        'image_12_text' => 'العشرينات: عصر الجاز',
        'image_12_desc' => 'فرقة جاز تؤدي في العشرينات، رمزية للحيوية الثقافية للعقد.',
        'image_13_text' => 'مسيرة حق المرأة في التصويت',
        'image_13_desc' => 'نساء يشاركن في مسيرة من أجل حق التصويت في الولايات المتحدة، مما أدى إلى التعديل التاسع عشر في 1920.',
        'image_14_text' => 'انهيار سوق الأسهم 1929',
        'image_14_desc' => 'ذعر في وول ستريت عندما انهار السوق في أكتوبر 1929.',
        'image_15_text' => 'الكساد الكبير: طوابير الخبز',
        'image_15_desc' => 'أشخاص يصطفون للحصول على الطعام خلال الكساد الكبير في الثلاثينات.',
        'image_16_text' => 'صعود الفاشية: تجمع نازي',
        'image_16_desc' => 'تجمع نازي في نورمبرغ، ألمانيا، خلال الثلاثينات تحت حكم هتلر.',
        'image_17_text' => 'الحرب العالمية الثانية: يوم النصر',
        'image_17_desc' => 'قوات الحلفاء تهبط على شواطئ نورماندي في يوم النصر، 6 يونيو 1944.',
        'image_18_text' => 'الحرب الباردة: جدار برلين',
        'image_18_desc' => 'جدار برلين، رمز انقسام الحرب الباردة، بني في 1961.',
        'image_19_text' => 'حركة الحقوق المدنية: مسيرة واشنطن',
        'image_19_desc' => 'مسيرة واشنطن 1963، حيث ألقى مارتن لوثر كينغ جونيور خطابه "لدي حلم".',
        'image_20_text' => 'استكشاف الفضاء: الهبوط على القمر',
        'image_20_desc' => 'نيل أرمسترونغ على القمر خلال مهمة أبولو 11، 20 يوليو 1969.',
        'image_21_text' => 'الثورة الحاسوبية: حاسوب شخصي مبكر',
        'image_21_desc' => 'حاسوب شخصي مبكر من السبعينات، يعلن بداية العصر الرقمي.',
        'image_22_text' => 'سقوط جدار برلين',
        'image_22_desc' => 'مواطنون يهدمون جدار برلين في 1989، رمزية لنهاية الحرب الباردة.',
        'image_23_text' => 'استعدادات Y2K',
        'image_23_desc' => 'فنيون يعدون الأنظمة لانتقال Y2K في 1999.',
        'image_24_text' => 'الأزمة المالية 2008: إفلاس البنوك',
        'image_24_desc' => 'انهيار ليمان براذرز في 2008، حدث رئيسي في الأزمة المالية العالمية.',
        'image_25_text' => 'وسائل التواصل الاجتماعي: عصر الهواتف الذكية',
        'image_25_desc' => 'صعود وسائل التواصل الاجتماعي في عقد 2010، مدفوعاً بالاستخدام الواسع للهواتف الذكية.',
        'image_26_text' => 'جائحة كوفيد-19: عمليات الإغلاق',
        'image_26_desc' => 'شوارع فارغة خلال عمليات إغلاق عالمية في 2020 بسبب جائحة كوفيد-19.',
        'image_27_text' => 'توسع الذكاء الاصطناعي: الروبوتات',
        'image_27_desc' => 'روبوتات متقدمة مدعومة بالذكاء الاصطناعي، تحول الصناعات في عقد 2020.',
        'image_28_text' => '2025: مستقبل مستدام',
        'image_28_desc' => 'ابتكارات في الطاقة المتجددة وجهود الاستدامة في 2025.',
        'footer_copyright' => '© 2025 التاريخ والفن والموضة. جميع الحقوق محفوظة.'
    ],
    'fr' => [
        'meta_description' => 'Découvrez la vaste tapisserie de l\'histoire mondiale avec HAF, des civilisations anciennes à l\'ère moderne',
        'hero_title' => 'Histoire Mondiale Dévoilée',
        'hero_subtitle' => 'Explorez les événements mondiaux qui ont façonné l\'humanité avec HAF',
        'nav_history' => 'Histoire',
        'nav_world_history' => 'Histoire Mondiale',
        'nav_malaysia_history' => 'Histoire de la Malaisie',
        'nav_history_game' => 'Jeu d\'Histoire',
        'nav_art' => 'Art',
        'nav_fashion' => 'Mode',
        'nav_shop' => 'Boutique',
        'timeline_title' => 'Chronologie de l\'Histoire Mondiale',
        'timeline_subtitle' => 'Voyagez à travers les périodes historiques mondiales clés',
        'modal_close' => 'Fermer',
        'period_prehistoric_title' => 'Humains Préhistoriques',
        'period_prehistoric_date' => 'env. 2 millions av. J.-C. - 3000 av. J.-C.',
        'period_prehistoric_text' => 'Les premiers humains vivaient de la chasse et de la cueillette, développant ensuite l\'agriculture, les outils et les établissements.',
        'period_prehistoric_details' => 'La période préhistorique s\'étend d\'environ 2 millions av. J.-C. à 3000 av. J.-C., marquant la phase la plus ancienne de l\'existence humaine...',
        'period_ancient_egypt_title' => 'Égypte Ancienne',
        'period_ancient_egypt_date' => 'env. 3100 av. J.-C. - 30 av. J.-C.',
        'period_ancient_egypt_text' => 'Une puissante civilisation le long du Nil, connue pour ses pyramides, pharaons et hiéroglyphes.',
        'period_ancient_egypt_details' => 'L\'Égypte Ancienne, florissante d\'environ 3100 av. J.-C. à 30 av. J.-C., fut l\'une des civilisations les plus avancées de son temps...',
        'period_ancient_greece_title' => 'Grèce Antique',
        'period_ancient_greece_date' => 'env. 800 av. J.-C. - 146 av. J.-C.',
        'period_ancient_greece_text' => 'Le berceau de la démocratie, de la philosophie et des Jeux Olympiques, avec une influence durable sur la culture occidentale.',
        'period_ancient_greece_details' => 'La Grèce antique, active d\'environ 800 av. J.-C. à 146 av. J.-C., était une collection de cités-États, avec Athènes et Sparte comme les plus importantes...',
        'period_roman_empire_title' => 'Empire Romain',
        'period_roman_empire_date' => '27 av. J.-C. - 476 ap. J.-C. (Empire Romain d\'Occident)',
        'period_roman_empire_text' => 'Un vaste empire qui a façonné le droit, l\'architecture et la gouvernance en Europe et au-delà.',
        'period_roman_empire_details' => 'L\'Empire Romain, établi en 27 av. J.-C. avec Auguste comme premier empereur, s\'étendait sur trois continents à son apogée...',
        'period_renaissance_title' => 'Renaissance',
        'period_renaissance_date' => 'env. 1300 - 1600',
        'period_renaissance_text' => 'Une renaissance culturelle en Europe, célébrant l\'art, la science et l\'humanisme, avec des figures comme Leonardo da Vinci.',
        'period_renaissance_details' => 'La Renaissance, s\'étendant approximativement de 1300 à 1600, a été une période de renaissance culturelle et intellectuelle en Europe...',
        'period_exploration_title' => 'L\'Âge des Découvertes',
        'period_exploration_date' => 'env. 1400 - 1700',
        'period_exploration_text' => 'Les explorateurs européens ont voyagé autour du monde par mer, découvrant de nouvelles terres et étendant le commerce et les empires.',
        'period_exploration_details' => 'L\'Âge des Découvertes, d\'environ 1400 à 1700, fut une période où les puissances européennes cherchaient de nouvelles routes commerciales et territoires...',
        'period_industrial_title' => 'Révolution Industrielle',
        'period_industrial_date' => 'env. 1760 - 1840',
        'period_industrial_text' => 'Une période de grande industrialisation avec des inventions comme la machine à vapeur, transformant les économies et les sociétés.',
        'period_industrial_details' => 'La Révolution Industrielle, survenant entre 1760 et 1840, commença en Grande-Bretagne et s\'étendit à l\'Europe et à l\'Amérique du Nord...',
        'period_ww1_title' => 'Première Guerre Mondiale',
        'period_ww1_date' => '1914 - 1918',
        'period_ww1_text' => 'Une guerre mondiale centrée en Europe, marquée par la guerre des tranchées et des pertes massives, se terminant par des changements politiques majeurs.',
        'period_ww1_details' => 'La Première Guerre Mondiale, menée de 1914 à 1918, fut un conflit mondial principalement centré en Europe...',
        'period_ww1_end_title' => 'Fin de la Première Guerre Mondiale',
        'period_ww1_end_date' => '1918',
        'period_ww1_end_text' => 'La Première Guerre Mondiale s\'est terminée par un armistice le 11 novembre 1918, après quatre années de conflit mondial dévastateur.',
        'period_ww1_end_details' => 'La fin de la Première Guerre Mondiale est survenue le 11 novembre 1918, avec la signature de l\'Armistice dans un wagon de train à Compiègne, France...',
        'period_versailles_title' => 'Traité de Versailles',
        'period_versailles_date' => '1919',
        'period_versailles_text' => 'Un traité de paix qui a officiellement mis fin à la Première Guerre Mondiale ; il a imposé des sanctions sévères à l\'Allemagne et redessiné les frontières européennes.',
        'period_versailles_details' => 'Le Traité de Versailles, signé le 28 juin 1919 au Palais de Versailles, France, a officiellement mis fin à la Première Guerre Mondiale...',
        'period_league_nations_title' => 'Société des Nations',
        'period_league_nations_date' => 'Fondée en 1920',
        'period_league_nations_text' => 'Une organisation internationale créée pour maintenir la paix mondiale après la Première Guerre Mondiale, mais elle s\'est avérée inefficace et a été remplacée par les Nations Unies.',
        'period_league_nations_details' => 'La Société des Nations a été établie en 1920 dans le cadre du Traité de Versailles, avec pour objectif principal de maintenir la paix mondiale...',
        'period_roaring_twenties_title' => 'Années Folles',
        'period_roaring_twenties_date' => 'Années 1920',
        'period_roaring_twenties_text' => 'Une décennie de prospérité économique, de musique jazz, de changements culturels et de nouveaux modes de vie, particulièrement aux États-Unis et en Europe.',
        'period_roaring_twenties_details' => 'Les Années Folles, couvrant les années 1920, furent une décennie de prospérité économique et de dynamisme culturel...',
        'period_womens_suffrage_title' => 'Suffrage des Femmes',
        'period_womens_suffrage_date' => '1920 (États-Unis) ; varie selon les pays',
        'period_womens_suffrage_text' => 'Les femmes ont obtenu le droit de vote dans de nombreux pays, y compris les États-Unis (19e amendement en 1920), représentant un grand pas vers l\'égalité des sexes.',
        'period_womens_suffrage_details' => 'Le mouvement pour le suffrage des femmes, culminant dans les années 1920 dans de nombreux pays, a été une lutte de plusieurs décennies pour obtenir le droit de vote...',
        'period_stock_crash_title' => 'Krach Boursier',
        'period_stock_crash_date' => '1929',
        'period_stock_crash_text' => 'Le marché boursier américain s\'est effondré en octobre 1929, déclenchant une récession économique mondiale.',
        'period_stock_crash_details' => 'Le Krach Boursier de 1929 a commencé le 24 octobre 1929 (Jeudi Noir), avec une chute catastrophique des cours à la Bourse de New York...',
        'period_great_depression_title' => 'Grande Dépression',
        'period_great_depression_date' => '1929 - fin des années 1930',
        'period_great_depression_text' => 'Une crise économique mondiale avec un chômage massif, la pauvreté et des difficultés sociales.',
        'period_great_depression_details' => 'La Grande Dépression, s\'étendant de 1929 à la fin des années 1930, fut une grave crise économique mondiale suite au Krach Boursier de 1929...',
        'period_fascism_title' => 'Montée du Fascisme',
        'period_fascism_date' => 'Années 1920 - 1930',
        'period_fascism_text' => 'Des dirigeants autoritaires comme Mussolini en Italie et Hitler en Allemagne ont pris le pouvoir, promouvant le nationalisme, le militarisme et la dictature.',
        'period_fascism_details' => 'La montée du fascisme dans les années 1920 et 1930 fut une réponse à l\'instabilité économique, aux troubles sociaux et aux conséquences de la Première Guerre Mondiale...',
        'period_ww2_title' => 'Seconde Guerre Mondiale',
        'period_ww2_date' => '1939 - 1945',
        'period_ww2_text' => 'Un conflit mondial impliquant la plupart des puissances mondiales ; causant des destructions massives et se terminant par la défaite de l\'Allemagne nazie et du Japon impérial.',
        'period_ww2_details' => 'La Seconde Guerre Mondiale, de 1939 à 1945, fut le conflit le plus meurtrier de l\'histoire, impliquant plus de 30 pays et causant environ 70-85 millions de morts...',
        'period_cold_war_title' => 'Guerre Froide',
        'period_cold_war_date' => 'env. 1947 - 1991',
        'period_cold_war_text' => 'Une période de tension politique et militaire entre les États-Unis et l\'Union Soviétique, marquée par la course aux armements nucléaires et la rivalité idéologique.',
        'period_cold_war_details' => 'La Guerre Froide, s\'étendant d\'environ 1947 à 1991, fut une période prolongée de tension géopolitique entre les États-Unis et l\'Union Soviétique...',
        'period_civil_rights_title' => 'Mouvement des Droits Civiques',
        'period_civil_rights_date' => 'Années 1950 - 1960',
        'period_civil_rights_text' => 'Un mouvement aux États-Unis pour mettre fin à la ségrégation raciale et garantir l\'égalité des droits pour les Afro-Américains, dirigé par des figures comme Martin Luther King Jr.',
        'period_civil_rights_details' => 'Le Mouvement des Droits Civiques, principalement actif dans les années 1950 et 1960, fut une lutte pour mettre fin à la ségrégation raciale et à la discrimination contre les Afro-Américains aux États-Unis...',
        'period_space_exploration_title' => 'Exploration Spatiale',
        'period_space_exploration_date' => '1957 - présent',
        'period_space_exploration_text' => 'Commencée avec le lancement de Spoutnik par les Soviétiques en 1957 ; incluant l\'alunissage américain en 1969 et continuant avec des missions spatiales internationales.',
        'period_space_exploration_details' => 'L\'exploration spatiale a commencé sérieusement avec le lancement de Spoutnik, le premier satellite artificiel, par l\'Union Soviétique le 4 octobre 1957...',
        'period_computer_revolution_title' => 'Révolution Informatique',
        'period_computer_revolution_date' => 'Années 1970 - présent',
        'period_computer_revolution_text' => 'Le développement rapide de la technologie informatique, des premiers ordinateurs personnels à l\'internet et aux smartphones.',
        'period_computer_revolution_details' => 'La Révolution Informatique, commençant dans les années 1970, a transformé la société grâce au développement rapide de la technologie informatique...',
        'period_cold_war_end_title' => 'Fin de la Guerre Froide',
        'period_cold_war_end_date' => '1991',
        'period_cold_war_end_text' => 'Marquée par l\'effondrement de l\'Union Soviétique, la chute du Mur de Berlin, et le passage vers un monde unipolaire dirigé par les États-Unis.',
        'period_cold_war_end_details' => 'La fin de la Guerre Froide en 1991 a marqué la conclusion de décennies de tension entre les États-Unis et l\'Union Soviétique...',
        'period_y2k_title' => 'Année 2000 (Bug de l\'An 2000 et Mondialisation)',
        'period_y2k_date' => '2000',
        'period_y2k_text' => 'Le monde est entré dans un nouveau millénaire ; les craintes du bug de l\'an 2000 se sont avérées largement inoffensives. L\'internet et la mondialisation se sont accélérés rapidement.',
        'period_y2k_details' => 'L\'année 2000 a marqué l\'aube d\'un nouveau millénaire, accompagnée de préoccupations généralisées concernant le bug de l\'an 2000...',
        'period_financial_crisis_title' => 'Crise Financière de 2008',
        'period_financial_crisis_date' => '2008',
        'period_financial_crisis_text' => 'Une récession économique mondiale majeure déclenchée par l\'effondrement du marché immobilier américain et du système bancaire, causant des pertes d\'emplois massives et une instabilité financière.',
        'period_financial_crisis_details' => 'La Crise Financière de 2008, souvent appelée la Grande Récession, a commencé avec l\'effondrement de la bulle immobilière américaine...',
        'period_social_media_title' => 'Aufstieg Sozialer Medien',
        'period_social_media_date' => '2010er Jahre',
        'period_social_media_text' => 'Plattformen wie Facebook, Twitter, Instagram und TikTok restrukturierten Kommunikation, Politik und Kultur weltweit.',
        'period_social_media_details' => 'Der Aufstieg sozialer Medien in den 2010er Jahren transformierte Kommunikation, Kultur und globale Politik, angetrieben von Plattformen wie Facebook...',
        'period_covid_pandemic_title' => 'Pandémie COVID-19',
        'period_covid_pandemic_date' => '2020',
        'period_covid_pandemic_text' => 'Globale Gesundheitskrise verursacht durch Coronavirus, führend zu Quarantänen, wirtschaftlichen Störungen und über 6 Millionen Toten weltweit.',
        'period_covid_pandemic_details' => 'Die COVID-19-Pandemie begann Ende 2019 mit einem Ausbruch des neuen Coronavirus (SARS-CoV-2) in Wuhan, China...',
        'period_ai_expansion_title' => 'Expansion Künstlicher Intelligenz',
        'period_ai_expansion_date' => 'Années 2020 - 2025',
        'period_ai_expansion_text' => 'KI-Technologien wie maschinelles Lernen und große Sprachmodelle (par exemple, ChatGPT) begannen Industrien, Bildung und Alltagsleben zu transformieren.',
        'period_ai_expansion_details' => 'Die Expansion künstlicher Intelligenz (KI) in den 2020er Jahren, besonders bis 2025, hat Branchen, Bildung und Alltag neu gestaltet...',
        'period_current_era_title' => 'Année 2025 (Ère Actuelle)',
        'period_current_era_date' => '2025',
        'period_current_era_text' => 'Marquée par des avancées technologiques rapides, des défis mondiaux comme le changement climatique, et des discussions sur le rôle de l\'IA, l\'éthique et l\'avenir de l\'humanité.',
        'period_current_era_details' => 'L\'année 2025 représente un moment crucial dans l\'ère actuelle, caractérisé par des avancées technologiques rapides et des défis mondiaux urgents...',
        'gallery_title' => 'Galerie d\'Histoire Mondiale',
        'gallery_subtitle' => 'Explorez les moments et artefacts emblématiques de l\'histoire mondiale',
        'image_1_text' => 'Peintures Rupestres Préhistoriques',
        'image_1_desc' => 'Art rupestre ancien de Lascaux, France, représentant des animaux et des activités humaines d\'environ 15 000 av. J.-C.',
        'image_2_text' => 'Pyramides de Gizeh',
        'image_2_desc' => 'Tombes monumentales construites pour les pharaons dans l\'Égypte Ancienne, construites vers 2560 av. J.-C.',
        'image_3_text' => 'Parthénon Grec',
        'image_3_desc' => 'Un temple sur l\'Acropole d\'Athènes, dédié à Athéna, construit au 5e siècle av. J.-C.',
        'image_4_text' => 'Roman Colosseum',
        'image_4_desc' => 'Un anfiteatro icónico en Roma, completado en 80 d.C., usado para concursos de gladiadores.',
        'image_5_text' => 'Arte de la Renaissance : Chapelle Sixtine',
        'image_5_desc' => 'Chef-d\'œuvre de Michel-Ange sur le plafond de la Chapelle Sixtine, peint entre 1508 et 1512.',
        'image_6_text' => 'Âge des Découvertes : Caravelles',
        'image_6_desc' => 'Barcos usados por exploradores como Colón durante el siglo XV para cruzar océanos.',
        'image_7_text' => 'Révolution Industrielle : Machine à Vapeur',
        'image_7_desc' => 'Une machine à vapeur, cruciale pour la Révolution Industrielle, introduite par James Watt au 18e siècle.',
        'image_8_text' => 'Première Guerre Mondiale : Tranchées',
        'image_8_desc' => 'Soldats dans les tranchées du Frente Occidental pendant la Première Guerre Mondiale, 1914-1918.',
        'image_9_text' => 'Jour de l\'Armistice 1918',
        'image_9_desc' => 'Célébrations marquant la fin de la Première Guerre Mondiale le 11 novembre 1918.',
        'image_10_text' => 'Signature du Traité de Versailles',
        'image_10_desc' => 'La signature du Traité de Versailles en 1919, mettant officiellement fin à la Première Guerre Mondiale.',
        'image_11_text' => 'Assemblée de la Société des Nations',
        'image_11_desc' => 'La première assemblée de la Société des Nations à Genève, 1920.',
        'image_12_text' => 'Années Folles : Âge du Jazz',
        'image_12_desc' => 'Un orchestre de jazz jouant dans les années 1920, emblématique de la vitalité culturelle de la décennie.',
        'image_13_text' => 'Marche pour le Suffrage des Femmes',
        'image_13_desc' => 'Femmes marchant pour le droit de vote aux États-Unis, menant au 19e amendement en 1920.',
        'image_14_text' => 'Krach Boursier de 1929',
        'image_14_desc' => 'Panique à Wall Street lors du krach boursier d\'octobre 1929.',
        'image_15_text' => 'Grande Dépression : Files d\'Attente',
        'image_15_desc' => 'Personnes faisant la queue pour de la nourriture pendant la Grande Dépression dans les années 1930.',
        'image_16_text' => 'Auge du Fascisme : Concentration Nazi',
        'image_16_desc' => 'Une concentration nazi à Nuremberg, Allemagne, pendant les années 1930 sous le régime d\'Hitler.',
        'image_17_text' => 'Seconde Guerre Mondiale : Jour J',
        'image_17_desc' => 'Forces alliées débarquant sur les plages de Normandie le Jour J, 6 de juin de 1944.',
        'image_18_text' => 'Guerre Froide : Muro de Berlín',
        'image_18_desc' => 'Le Mur de Berlin, symbole de la division de la Guerre Froide, construit en 1961.',
        'image_19_text' => 'Mouvement des Droits Civiques : Marche sur Washington',
        'image_19_desc' => 'La Marche sur Washington de 1963, où Martin Luther King Jr. a prononcé son discours "I Have a Dream".',
        'image_20_text' => 'Exploration Spatiale : Alunissage',
        'image_20_desc' => 'Neil Armstrong en la luna pendant la mission Apollo 11, 20 juillet 1969.',
        'image_21_text' => 'Revolución Informática : PC Temprana',
        'image_21_desc' => 'Una computadora personal temprana de los años 1970, marcando el inicio de la era digital.',
        'image_22_text' => 'Chute du Mur de Berlin',
        'image_22_desc' => 'Citoyens démantelant le Mur de Berlin en 1989, symbolisant la fin de la Guerre Froide.',
        'image_23_text' => 'Préparations pour l\'An 2000',
        'image_23_desc' => 'Techniciens préparant les systèmes pour la transition vers l\'an 2000 en 1999.',
        'image_24_text' => 'Crise Financière de 2008 : Faillites Bancaires',
        'image_24_desc' => 'L\'effondrement de Lehman Brothers en 2008, un événement clé de la crise financière mondiale.',
        'image_25_text' => 'Réseaux Sociaux : Ère du Smartphone',
        'image_25_desc' => 'La montée des réseaux sociaux dans les années 2010, portée par l\'utilisation généralisée des smartphones.',
        'image_26_text' => 'Pandémie de COVID-19 : Confinements',
        'image_26_desc' => 'Rues vides pendant les confinements mondiaux de 2020 dus à la pandémie de COVID-19.',
        'image_27_text' => 'Expansion de l\'IA : Robotique',
        'image_27_desc' => 'Robotique avancée alimentée par l\'IA, transformant les industries dans les années 2020.',
        'image_28_text' => '2025 : Avenir Durable',
        'image_28_desc' => 'Innovations dans les énergies renouvelables et efforts de durabilité en 2025.',
        'footer_copyright' => '© 2025 Histoire, Art & Mode. Tous droits réservés.'
    ],
    'ja' => [
        'meta_description' => 'HAFと共に、古代文明から現代まで、世界の豊かな歴史を探索しましょう',
        'hero_title' => '世界史の解明',
        'hero_subtitle' => 'HAFと共に、人類を形作った世界的な出来事を探索しましょう',
        'nav_history' => '歴史',
        'nav_world_history' => '世界史',
        'nav_malaysia_history' => 'マレーシアの歴史',
        'nav_history_game' => '歴史ゲーム',
        'nav_art' => 'アート',
        'nav_fashion' => 'ファッション',
        'nav_shop' => 'ショップ',
        'timeline_title' => '世界史のタイムライン',
        'timeline_subtitle' => '世界の主要な歴史的時代を旅しましょう',
        'modal_close' => '閉じる',
        'period_prehistoric_title' => '先史時代の人類',
        'period_prehistoric_date' => '約200万年前 - 紀元前3000年',
        'period_prehistoric_text' => '最初の人類は狩猟採集で生活し、後に農業、道具、定住地を発展させました。',
        'period_prehistoric_details' => '先史時代は約200万年前から紀元前3000年まで続き、人類の存在の最も初期の段階を示しています...',
        'period_ancient_egypt_title' => '古代エジプト',
        'period_ancient_egypt_date' => '約紀元前3100年 - 紀元前30年',
        'period_ancient_egypt_text' => 'ナイル川沿いの強大な文明で、ピラミッド、ファラオ、ヒエログリフで知られています。',
        'period_ancient_egypt_details' => '古代エジプトは紀元前3100年から紀元前30年まで繁栄し、当時最も進んだ文明の一つでした...',
        'period_ancient_greece_title' => '古代ギリシャ',
        'period_ancient_greece_date' => '約紀元前800年 - 紀元前146年',
        'period_ancient_greece_text' => '民主主義、哲学、オリンピックの揺籃地で、西洋文化に永続的な影響を与えました。',
        'period_ancient_greece_details' => '古代ギリシャは紀元前800年から紀元前146年まで活動し、アテネとスパルタを主要な都市国家とする都市国家群でした...',
        'period_roman_empire_title' => 'ローマ帝国',
        'period_roman_empire_date' => '紀元前27年 - 476年（西ローマ帝国）',
        'period_roman_empire_text' => '法律、建築、統治をヨーロッパとその先に形作った巨大な帝国。',
        'period_roman_empire_details' => 'ローマ帝国は紀元前27年にアウグストゥスを初代皇帝として設立され、最盛期には3つの大陸に広がりました...',
        'period_renaissance_title' => 'ルネサンス',
        'period_renaissance_date' => '約1300年 - 1600年',
        'period_renaissance_text' => 'レオナルド・ダ・ヴィンチなどの人物を輩出した、芸術、科学、人文主義を称えたヨーロッパの文化的再生。',
        'period_renaissance_details' => 'ルネサンスは1300年から1600年頃まで続き、ヨーロッパにおける文化的・知的な再生の時代でした...',
        'period_exploration_title' => '大航海時代',
        'period_exploration_date' => '約1400年 - 1700年',
        'period_exploration_text' => 'ヨーロッパの探検家たちが船で世界を航海し、新しい土地を発見し、貿易と帝国を拡大しました。',
        'period_exploration_details' => '大航海時代は1400年から1700年頃まで続き、ヨーロッパ諸国が新しい交易路と領土を求めた時代でした...',
        'period_industrial_title' => '産業革命',
        'period_industrial_date' => '約1760年 - 1840年',
        'period_industrial_text' => '蒸気機関などの発明により経済と社会を変革した大規模な工業化の時代。',
        'period_industrial_details' => '産業革命は1760年から1840年の間にイギリスで始まり、ヨーロッパと北アメリカに広がりました...',
        'period_ww1_title' => '第一次世界大戦',
        'period_ww1_date' => '1914年 - 1918年',
        'period_ww1_text' => '主にヨーロッパを中心とした世界大戦で、塹壕戦と大規模な損失を特徴とし、大きな政治的変革で終結。',
        'period_ww1_details' => '第一次世界大戦は1914年から1918年まで戦われ、主にヨーロッパを中心とした世界的な紛争でした...',
        'period_ww1_end_title' => '第一次世界大戦の終結',
        'period_ww1_end_date' => '1918年',
        'period_ww1_end_text' => '第一次世界大戦は1918年11月11日の休戦で終結し、4年間の破壊的な世界的紛争が終わりました。',
        'period_ww1_end_details' => '第一次世界大戦の終結は1918年11月11日、フランスのコンピエーニュで鉄道車両内での休戦協定調印で実現しました...',
        'period_versailles_title' => 'ヴェルサイユ条約',
        'period_versailles_date' => '1919年',
        'period_versailles_text' => '第一次世界大戦を正式に終結させた平和条約；ドイツに厳しい制裁を課し、ヨーロッパの国境を再描画。',
        'period_versailles_details' => 'ヴェルサイユ条約は1919年6月28日にフランスのヴェルサイユ宮殿で調印され、第一次世界大戦を正式に終結させました...',
        'period_league_nations_title' => '国際連盟',
        'period_league_nations_date' => '1920年設立',
        'period_league_nations_text' => '第一次世界大戦後に世界平和を維持するために創設された国際機関だが、最終的に非効率で国連に取って代わられた。',
        'period_league_nations_details' => '国際連盟は1920年にヴェルサイユ条約の一部として設立され、世界平和の維持を主な目的としました...',
        'period_roaring_twenties_title' => '狂騒の20年代',
        'period_roaring_twenties_date' => '1920年代',
        'period_roaring_twenties_text' => '特に米国とヨーロッパでの経済的繁栄、ジャズ、文化的変化、新しいライフスタイルの10年。',
        'period_roaring_twenties_details' => '狂騒の20年代は1920年代をカバーし、経済的繁栄と文化的活力の期間でした...',
        'period_womens_suffrage_title' => '女性参政権',
        'period_womens_suffrage_date' => '1920年（米国）；国によって異なる',
        'period_womens_suffrage_text' => '米国（1920年の19修正）を含む多くの国で女性が投票権を獲得し、ジェンダー平等への大きな一歩を踏み出した。',
        'period_womens_suffrage_details' => '女性参政権運動は1920年代に多くの国でピークに達し、女性の投票権を確保するための数十年の闘争でした...',
        'period_stock_crash_title' => '1929年の株式市場暴落',
        'period_stock_crash_date' => '1929年',
        'period_stock_crash_text' => '米国の株式市場が1929年10月に暴落し、世界的な経済不況を引き起こした。',
        'period_stock_crash_details' => '1929年の株式市場暴落は1929年10月24日（暗黒の木曜日）に始まり、ニューヨーク証券取引所での株式価格の壊滅的な下落を特徴としました...',
        'period_great_depression_title' => '大恐慌',
        'period_great_depression_date' => '1929年 - 1930年代後半',
        'period_great_depression_text' => '大量失業、貧困、社会的困難を伴う世界的な経済危機。',
        'period_great_depression_details' => '大恐慌は1929年から1930年代後半まで続き、1929年の株式市場暴落後の深刻な世界的経済危機でした...',
        'period_fascism_title' => 'ファシズムの台頭',
        'period_fascism_date' => '1920年代-1930年代',
        'period_fascism_text' => 'イタリアのムッソリーニやドイツのヒトラーなどの権威主義的指導者が権力を得て、ナショナリズム、軍国主義、独裁を推進。',
        'period_fascism_details' => '1920年代と1930年代のファシズムの台頭は、経済的不安定、社会的動揺、第一次世界大戦の結果への対応でした...',
        'period_ww2_title' => '第二次世界大戦',
        'period_ww2_date' => '1939年 - 1945年',
        'period_ww2_text' => '世界の主要国を巻き込んだ世界的な紛争；大規模な破壊を引き起こし、ナチス・ドイツと大日本帝国の敗北で終結。',
        'period_ww2_details' => '第二次世界大戦は1939年から1945年まで続き、30以上の国を巻き込み、約7000万から8500万人の死者を出した史上最も致命的な紛争でした...',
        'period_cold_war_title' => '冷戦',
        'period_cold_war_date' => '約1947年 - 1991年',
        'period_cold_war_text' => '米国とソ連の間の政治的・軍事的緊張の時代で、核軍拡競争とイデオロギー的対立を特徴とした。',
        'period_cold_war_details' => '冷戦は約1947年から1991年まで続き、米国とソ連の間の長期的な地政学的緊張の期間でした...',
        'period_civil_rights_title' => '公民権運動',
        'period_civil_rights_date' => '1950年代-1960年代',
        'period_civil_rights_text' => '米国での人種差別撤廃とアフリカ系アメリカ人の平等な権利を求める運動で、マーティン・ルーサー・キング・ジュニアなどの人物が指導。',
        'period_civil_rights_details' => '公民権運動は主に1950年代と1960年代に活発で、米国でのアフリカ系アメリカ人に対する人種差別と差別を終わらせるための闘争でした...',
        'period_space_exploration_title' => '宇宙探査',
        'period_space_exploration_date' => '1957年 - 現在',
        'period_space_exploration_text' => '1957年のソ連のスプートニク打ち上げで始まり；1969年の米国の月面着陸を含み、国際的な宇宙ミッションが続く。',
        'period_space_exploration_details' => '宇宙探査は1957年10月4日のソ連による最初の人工衛星スプートニクの打ち上げで本格的に始まりました...',
        'period_computer_revolution_title' => 'コンピュータ革命',
        'period_computer_revolution_date' => '1970年代 - 現在',
        'period_computer_revolution_text' => '最初のパーソナルコンピュータからインターネット、スマートフォンまでのコンピュータ技術の急速な発展。',
        'period_computer_revolution_details' => 'コンピュータ革命は1970年代に始まり、コンピュータ技術の急速な発展を通じて社会を変革しました...',
        'period_cold_war_end_title' => '冷戦の終結',
        'period_cold_war_end_date' => '1991年',
        'period_cold_war_end_text' => 'ソ連の崩壊、ベルリンの壁の崩壊、米国主導の一極世界への移行で特徴づけられた。',
        'period_cold_war_end_details' => '1991年の冷戦の終結は、米国とソ連の間の数十年の緊張の終わりを示しました...',
        'period_y2k_title' => '2000年（千年虫和全球化）',
        'period_y2k_date' => '2000年',
        'period_y2k_text' => '世界は新しい千年紀に入りました。Y2Kバグの懸念はほとんど無害であることが判明しました。インターネットとグローバル化が急速に加速しました。',
        'period_y2k_details' => '2000年は新しい千年紀の幕開けを示し、Y2Kバグに関する広範な懸念が伴いましたが、重大な問題はほとんど発生しませんでした。インターネットの普及とグローバル化が急速に進展しました。',
        'period_financial_crisis_text' => '2008年、米国の住宅市場と銀行システムの崩壊によって引き起こされた世界的な経済危機で、大規模な失業と金融不安をもたらしました。',
        'period_financial_crisis_details' => '2008年の金融危機（グレート・リセッション）は、米国の住宅バブルの崩壊から始まり、世界中の経済に深刻な影響を与えました。多くの銀行が破綻し、失業率が急増しました。',
        'period_social_media_text' => 'Facebook、Twitter、Instagram、TikTokなどのプラットフォームが、世界中のコミュニケーション、政治、文化を再構築しました。',
        'period_social_media_details' => '2010年代のソーシャルメディアの台頭は、Facebookなどのプラットフォームによって、グローバルなコミュニケーション、文化、政治を大きく変革しました。',
        'period_covid_pandemic_text' => '新型コロナウイルスによる世界的な健康危機で、ロックダウン、経済的混乱、世界中で600万人以上の死者をもたらしました。',
        'period_covid_pandemic_details' => 'COVID-19パンデミックは2019年末、中国・武漢で新型コロナウイルス（SARS-CoV-2）が発生したことに始まりました。世界中で感染が拡大し、社会・経済に大きな影響を与えました。',
        'period_ai_expansion_text' => '機械学習や大規模言語モデル（例：ChatGPT）などのAI技術が、産業、教育、日常生活を変革し始めました。',
        'period_ai_expansion_details' => '2020年代、特に2025年までにAI（人工知能）の拡大が進み、産業、教育、日常生活のあり方が大きく変わりました。',
        'period_current_era_text' => '急速な技術進歩、気候変動などの地球規模の課題、AIの役割や倫理、人類の未来についての議論が特徴です。',
        'period_current_era_details' => '2025年は、急速な技術進歩と差し迫った地球規模の課題が特徴的な現代の重要な節目となっています。',
        'period_current_era_title' => '2025年（当前时代）',
        'period_current_era_date' => '2025年',
        'period_current_era_text' => '以快速技术进步、气候变化等全球挑战以及关于AI、伦理和人类未来的讨论为标志。',
        'period_current_era_details' => 'The year 2025 represents a pivotal moment in the current era, characterized by rapid technological advancements and pressing global challenges...',
        'gallery_title' => '世界历史画廊',
        'gallery_subtitle' => '探索世界历史上的标志性时刻和文物',
        'image_1_text' => '史前洞穴壁画',
        'image_1_desc' => '法国拉斯科洞穴的古代艺术，描绘了约公元前15000年的动物和人类活动。',
        'image_2_text' => '吉萨金字塔',
        'image_2_desc' => '古埃及为法老建造的宏伟陵墓，建于约公元前2560年。',
        'image_3_text' => '希腊帕特农神庙',
        'image_3_desc' => '雅典卫城上的神庙，供奉雅典娜，建于公元前5世纪。',
        'image_4_text' => '罗马斗兽场',
        'image_4_desc' => '罗马的标志性圆形剧场，建于公元80年，用于角斗士比赛。',
        'image_5_text' => '文艺复兴艺术：西斯廷教堂',
        'image_5_desc' => '米开朗基罗在西斯廷教堂天花板上的杰作，绘制于1508年至1512年之间。',
        'image_6_text' => '大航海时代：卡拉维尔帆船',
        'image_6_desc' => '15世纪哥伦布等探险家用来横渡大洋的船只。',
        'image_7_text' => '工业革命：蒸汽机',
        'image_7_desc' => '工业革命的关键蒸汽机，由詹姆斯·瓦特在18世纪引入。',
        'image_8_text' => '第一次世界大战：战壕',
        'image_8_desc' => '1914-1918年第一次世界大战西线战壕中的士兵。',
        'image_9_text' => '1918年停战日',
        'image_9_desc' => '1918年11月11日庆祝第一次世界大战结束。',
        'image_10_text' => '凡尔赛条约签署',
        'image_10_desc' => '1919年签署凡尔赛条约，正式结束第一次世界大战。',
        'image_11_text' => '国际联盟大会',
        'image_11_desc' => '1920年国际联盟在日内瓦的第一次大会。',
        'image_12_text' => '咆哮的二十年代：爵士时代',
        'image_12_desc' => '1920年代爵士乐队表演，体现了那个年代的文化活力。',
        'image_13_text' => '妇女选举权游行',
        'image_13_desc' => '美国妇女为争取投票权游行，导致1920年第19修正案通过。',
        'image_14_text' => '1929年股市崩盘',
        'image_14_desc' => '1929年10月华尔街股市崩盘时的恐慌。',
        'image_15_text' => '大萧条：面包线',
        'image_15_desc' => '1930年代大萧条期间人们排队领取食物。',
        'image_16_text' => '法西斯主义兴起：纳粹集会',
        'image_16_desc' => '1930年代希特勒统治时期德国纽伦堡的纳粹集会。',
        'image_17_text' => '第二次世界大战：诺曼底登陆',
        'image_17_desc' => '1944年6月6日诺曼底登陆日，盟军在诺曼底海滩登陆。',
        'image_18_text' => '冷战：柏林墙',
        'image_18_desc' => '1961年建造的柏林墙，冷战分裂的象征。',
        'image_19_text' => '民权运动：华盛顿大游行',
        'image_19_desc' => '1963年华盛顿大游行，马丁·路德·金发表"我有一个梦想"演讲。',
        'image_20_text' => '太空探索：登月',
        'image_20_desc' => '1969年7月20日阿波罗11号任务期间，尼尔·阿姆斯特朗在月球上。',
        'image_21_text' => '计算机革命：早期个人电脑',
        'image_21_desc' => '1970年代的早期个人电脑，标志着数字时代的开始。',
        'image_22_text' => '柏林墙倒塌',
        'image_22_desc' => '1989年市民拆除柏林墙，象征着冷战的结束。',
        'image_23_text' => '千年虫准备',
        'image_23_desc' => '1999年技术人员为千年虫过渡准备系统。',
        'image_24_text' => '2008年金融危机：银行倒闭',
        'image_24_desc' => 'The collapse of Lehman Brothers in 2008, a key event in the global financial crisis.',
        'image_25_text' => 'Social Media: Smartphone Era',
        'image_25_desc' => 'The rise of social media in the 2010s, driven by widespread smartphone use.',
        'image_26_text' => 'COVID-19 Pandemic: Lockdowns',
        'image_26_desc' => 'Empty streets during global lockdowns in 2020 due to the COVID-19 pandemic.',
        'image_27_text' => 'AI Expansion: Robotics',
        'image_27_desc' => 'Advanced robotics powered by AI, transforming industries in the 2020s.',
        'image_28_text' => '2025: Sustainable Future',
        'image_28_desc' => 'Innovations in renewable energy and sustainability efforts in 2025.',
        'footer_copyright' => '© 2025 Histoire, Art & Mode. Tous droits réservés.'
    ],
    'hi' => [
        'meta_description' => 'HAF के साथ प्राचीन सभ्यताओं से लेकर आधुनिक समय तक विश्व इतिहास की विशाल टेपेस्ट्री का अन्वेषण करें',
        'hero_title' => 'विश्व इतिहास का अनावरण',
        'hero_subtitle' => 'HAF के साथ मानवता को आकार देने वाली वैश्विक घटनाओं का अन्वेषण करें',
        'nav_history' => 'इतिहास',
        'nav_world_history' => 'विश्व इतिहास',
        'nav_malaysia_history' => 'मलेशिया का इतिहास',
        'nav_history_game' => 'इतिहास खेल',
        'nav_art' => 'कला',
        'nav_fashion' => 'फैशन',
        'nav_shop' => 'दुकान',
        'timeline_title' => 'विश्व इतिहास समयरेखा',
        'timeline_subtitle' => 'महत्वपूर्ण वैश्विक ऐतिहासिक अवधियों की यात्रा',
        'modal_close' => 'बंद करें',
        'period_prehistoric_title' => 'प्रागैतिहासिक मनुष्य',
        'period_prehistoric_date' => 'c. 2 मिलियन ईसा पूर्व – 3000 ईसा पूर्व',
        'period_prehistoric_text' => 'प्रारंभिक मनुष्य शिकार और संग्रहण से जीवन यापन करते थे, बाद में कृषि, उपकरण और बस्तियों का विकास हुआ।',
        'period_prehistoric_details' => 'प्रागैतिहासिक काल लगभग 2 मिलियन ईसा पूर्व से 3000 ईसा पूर्व तक फैला हुआ है, जो मानव अस्तित्व के प्रारंभिक चरण को चिह्नित करता है...',
        'period_ancient_egypt_title' => 'प्राचीन मिस्र',
        'period_ancient_egypt_date' => 'c. 3100 ईसा पूर्व – 30 ईसा पूर्व',
        'period_ancient_egypt_text' => 'नील नदी के किनारे एक शक्तिशाली सभ्यता, पिरामिड, फिरौन और हाइरोग्लिफ्स के लिए प्रसिद्ध।',
        'period_ancient_egypt_details' => 'प्राचीन मिस्र, लगभग 3100 ईसा पूर्व से 30 ईसा पूर्व तक फलता-फूलता रहा, अपने समय की सबसे उन्नत सभ्यताओं में से एक था...',
        'period_ancient_greece_title' => 'प्राचीन यूनान',
        'period_ancient_greece_date' => 'c. 800 ईसा पूर्व – 146 ईसा पूर्व',
        'period_ancient_greece_text' => 'लोकतंत्र, दर्शन और ओलंपिक खेलों का जन्मस्थान, पश्चिमी संस्कृति पर स्थायी प्रभाव के साथ।',
        'period_ancient_greece_details' => 'प्राचीन यूनान, लगभग 800 ईसा पूर्व से 146 ईसा पूर्व तक सक्रिय, नगर-राज्यों का एक संग्रह था, जिसमें एथेंस और स्पार्टा सबसे प्रमुख थे...',
        'period_roman_empire_title' => 'रोमन साम्राज्य',
        'period_roman_empire_date' => '27 ईसा पूर्व – 476 ईस्वी (पश्चिमी रोमन साम्राज्य)',
        'period_roman_empire_text' => 'एक विशाल साम्राज्य जिसने यूरोप और उससे आगे के क्षेत्रों में कानून, वास्तुकला और शासन को आकार दिया।',
        'period_roman_empire_details' => 'रोमन साम्राज्य, 27 ईसा पूर्व में ऑगस्टस को अपने पहले सम्राट के रूप में स्थापित किया गया, अपने चरम पर तीन महाद्वीपों तक फैला हुआ था...',
        'period_renaissance_title' => 'पुनर्जागरण',
        'period_renaissance_date' => 'c. 1300 – 1600',
        'period_renaissance_text' => 'यूरोप में एक सांस्कृतिक पुनर्जन्म, कला, विज्ञान और मानवतावाद का उत्सव, लियोनार्डो दा विंची जैसे व्यक्तित्वों के साथ।',
        'period_renaissance_details' => 'पुनर्जागरण, लगभग 1300 से 1600 तक फैला हुआ, यूरोप में सांस्कृतिक और बौद्धिक पुनरुत्थान की अवधि थी...',
        'period_exploration_title' => 'खोज का युग',
        'period_exploration_date' => 'c. 1400 – 1700',
        'period_exploration_text' => 'यूरोपीय खोजकर्ता समुद्र के रास्ते दुनिया की यात्रा करते थे, नई भूमियों की खोज और व्यापार और साम्राज्यों का विस्तार करते थे।',
        'period_exploration_details' => 'खोज का युग, लगभग 1400 से 1700 तक, वह अवधि थी जब यूरोपीय शक्तियां नए व्यापार मार्गों और क्षेत्रों की तलाश में थीं...',
        'period_industrial_title' => 'औद्योगिक क्रांति',
        'period_industrial_date' => 'c. 1760 – 1840',
        'period_industrial_text' => 'भाप इंजन जैसे आविष्कारों के साथ प्रमुख औद्योगीकरण की अवधि, अर्थव्यवस्थाओं और समाजों को बदल दिया।',
        'period_industrial_details' => 'औद्योगिक क्रांति, 1760 और 1840 के बीच हुई, ब्रिटेन में शुरू हुई और यूरोप और उत्तरी अमेरिका में फैल गई...',
        'period_ww1_title' => 'प्रथम विश्व युद्ध',
        'period_ww1_date' => '1914 – 1918',
        'period_ww1_text' => 'यूरोप में केंद्रित एक वैश्विक युद्ध, खाई युद्ध और बड़े पैमाने पर हताहतों से चिह्नित, प्रमुख राजनीतिक परिवर्तनों के साथ समाप्त हुआ।',
        'period_ww1_details' => 'प्रथम विश्व युद्ध, 1914 से 1918 तक लड़ा गया, मुख्य रूप से यूरोप में केंद्रित एक वैश्विक संघर्ष था...',
        'period_ww1_end_title' => 'प्रथम विश्व युद्ध का अंत',
        'period_ww1_end_date' => '1918',
        'period_ww1_end_text' => 'चार वर्षों के विनाशकारी वैश्विक संघर्ष के बाद 11 नवंबर 1918 को युद्धविराम के साथ प्रथम विश्व युद्ध समाप्त हुआ।',
        'period_ww1_end_details' => 'प्रथम विश्व युद्ध का अंत 11 नवंबर 1918 को फ्रांस के कॉम्पिएग्ने में एक रेलवे डिब्बे में युद्धविराम पर हस्ताक्षर के साथ आया...',
        'period_versailles_title' => 'वर्साय की संधि',
        'period_versailles_date' => '1919',
        'period_versailles_text' => 'एक शांति संधि जिसने आधिकारिक रूप से प्रथम विश्व युद्ध को समाप्त किया; इसने जर्मनी पर कठोर दंड लगाए और यूरोपीय सीमाओं को पुनर्निर्धारित किया।',
        'period_versailles_details' => 'वर्साय की संधि, 28 जून 1919 को फ्रांस के वर्साय पैलेस में हस्ताक्षरित, ने आधिकारिक रूप से प्रथम विश्व युद्ध को समाप्त किया...',
        'period_league_nations_title' => 'राष्ट्र संघ',
        'period_league_nations_date' => '1920 में स्थापित',
        'period_league_nations_text' => 'प्रथम विश्व युद्ध के बाद विश्व शांति बनाए रखने के लिए बनाई गई एक अंतर्राष्ट्रीय संगठन, लेकिन यह अंततः अप्रभावी रहा और संयुक्त राष्ट्र द्वारा प्रतिस्थापित किया गया।',
        'period_league_nations_details' => 'राष्ट्र संघ की स्थापना 1920 में वर्साय की संधि के हिस्से के रूप में की गई थी, जिसका प्राथमिक लक्ष्य विश्व शांति बनाए रखना था...',
        'period_roaring_twenties_title' => 'रोअरिंग ट्वेंटीज',
        'period_roaring_twenties_date' => '1920 का दशक',
        'period_roaring_twenties_text' => 'आर्थिक समृद्धि, जैज़ संगीत, सांस्कृतिक परिवर्तन और नए जीवन शैलियों का दशक, विशेष रूप से अमेरिका और यूरोप में।',
        'period_roaring_twenties_details' => 'रोअरिंग ट्वेंटीज, 1920 के दशक में फैला हुआ, आर्थिक समृद्धि और सांस्कृतिक गतिशीलता का दशक था...',
        'period_womens_suffrage_title' => 'महिला मताधिकार',
        'period_womens_suffrage_date' => '1920 (अमेरिका); देश के अनुसार भिन्न',
        'period_womens_suffrage_text' => 'कई देशों में महिलाओं को मतदान का अधिकार मिला, जिसमें अमेरिका (1920 में 19वां संशोधन) शामिल है, लैंगिक समानता में एक प्रमुख कदम।',
        'period_womens_suffrage_details' => 'महिला मताधिकार आंदोलन, जो 1920 के दशक में कई देशों में चरम पर पहुंचा, महिलाओं के लिए मतदान अधिकार सुरक्षित करने के लिए दशकों का संघर्ष था...',
        'period_stock_crash_title' => 'शेयर बाजार दुर्घटना',
        'period_stock_crash_date' => '1929',
        'period_stock_crash_text' => 'अक्टूबर 1929 में अमेरिकी शेयर बाजार ध्वस्त हो गया, जिससे वैश्विक आर्थिक मंदी शुरू हुई।',
        'period_stock_crash_details' => '1929 की शेयर बाजार दुर्घटना 24 अक्टूबर 1929 (ब्लैक थर्सडे) को न्यूयॉर्क स्टॉक एक्सचेंज पर शेयर कीमतों में भयावह गिरावट के साथ शुरू हुई...',
        'period_great_depression_title' => 'महामंदी',
        'period_great_depression_date' => '1929 – 1930 के दशक के अंत',
        'period_great_depression_text' => 'बड़े पैमाने पर बेरोजगारी, गरीबी और सामाजिक कठिनाइयों के साथ एक विश्वव्यापी आर्थिक संकट।',
        'period_great_depression_details' => 'महामंदी, 1929 से 1930 के दशक के अंत तक चली, 1929 की शेयर बाजार दुर्घटना के बाद एक गंभीर वैश्विक आर्थिक संकट थी...',
        'period_fascism_title' => 'फासीवाद का उदय',
        'period_fascism_date' => '1920 – 1930 का दशक',
        'period_fascism_text' => 'इटली में मुसोलिनी और जर्मनी में हिटलर जैसे सत्तावादी नेता सत्ता में आए, राष्ट्रवाद, सैन्यवाद और तानाशाही को बढ़ावा दिया।',
        'period_fascism_details' => '1920 और 1930 के दशक में फासीवाद का उदय आर्थिक अस्थिरता, सामाजिक अशांति और प्रथम विश्व युद्ध के बाद की स्थितियों के प्रति प्रतिक्रिया थी...',
        'period_ww2_title' => 'द्वितीय विश्व युद्ध',
        'period_ww2_date' => '1939 – 1945',
        'period_ww2_text' => 'अधिकांश विश्व शक्तियों को शामिल करने वाला एक वैश्विक संघर्ष; बड़े पैमाने पर विनाश का कारण बना और नाजी जर्मनी और साम्राज्यवादी जापान की हार के साथ समाप्त हुआ।',
        'period_ww2_details' => 'द्वितीय विश्व युद्ध, 1939 से 1945 तक, इतिहास का सबसे घातक संघर्ष था, जिसमें 30 से अधिक देश शामिल थे और लगभग 70-85 मिलियन मौतें हुईं...',
        'period_cold_war_title' => 'शीत युद्ध',
        'period_cold_war_date' => 'c. 1947 – 1991',
        'period_cold_war_text' => 'संयुक्त राज्य अमेरिका और सोवियत संघ के बीच राजनीतिक और सैन्य तनाव की अवधि, परमाणु हथियारों की दौड़ और वैचारिक प्रतिद्वंद्विता से चिह्नित।',
        'period_cold_war_details' => 'शीत युद्ध, लगभग 1947 से 1991 तक फैला हुआ, संयुक्त राज्य अमेरिका और सोवियत संघ के बीच भू-राजनीतिक तनाव की लंबी अवधि थी...',
        'period_civil_rights_title' => 'नागरिक अधिकार आंदोलन',
        'period_civil_rights_date' => '1950 – 1960 का दशक',
        'period_civil_rights_text' => 'अमेरिका में नस्लीय अलगाव को समाप्त करने और अफ्रीकी अमेरिकियों के लिए समान अधिकार सुरक्षित करने के लिए एक आंदोलन, मार्टिन लूथर किंग जूनियर जैसे नेताओं के नेतृत्व में।',
        'period_civil_rights_details' => 'नागरिक अधिकार आंदोलन, मुख्य रूप से 1950 और 1960 के दशक में सक्रिय, संयुक्त राज्य अमेरिका में अफ्रीकी अमेरिकियों के खिलाफ नस्लीय अलगाव और भेदभाव को समाप्त करने के लिए एक संघर्ष था...',
        'period_space_exploration_title' => 'अंतरिक्ष अन्वेषण',
        'period_space_exploration_date' => '1957 – वर्तमान',
        'period_space_exploration_text' => '1957 में सोवियत द्वारा स्पुतनिक के प्रक्षेपण के साथ शुरू हुआ; 1969 में अमेरिकी चंद्रमा लैंडिंग और अंतर्राष्ट्रीय अंतरिक्ष मिशनों के साथ जारी है।',
        'period_space_exploration_details' => 'अंतरिक्ष अन्वेषण की शुरुआत 4 अक्टूबर 1957 को सोवियत संघ द्वारा पहले कृत्रिम उपग्रह स्पुतनिक के प्रक्षेपण के साथ हुई...',
        'period_computer_revolution_title' => 'कंप्यूटर क्रांति',
        'period_computer_revolution_date' => '1970 का दशक – वर्तमान',
        'period_computer_revolution_text' => 'प्रारंभिक व्यक्तिगत कंप्यूटरों से इंटरनेट और स्मार्टफोन तक कंप्यूटिंग प्रौद्योगिकी का तेजी से विकास।',
        'period_computer_revolution_details' => 'कंप्यूटर क्रांति, 1970 के दशक में शुरू हुई, कंप्यूटिंग प्रौद्योगिकी के तेजी से विकास के माध्यम से समाज को बदल दिया...',
        'period_cold_war_end_title' => 'शीत युद्ध का अंत',
        'period_cold_war_end_date' => '1991',
        'period_cold_war_end_text' => 'सोवियत संघ के पतन, बर्लिन की दीवार के गिरने और अमेरिका के नेतृत्व वाली एकध्रुवीय दुनिया की ओर बदलाव से चिह्नित।',
        'period_cold_war_end_details' => '1991 में शीत युद्ध का अंत संयुक्त राज्य अमेरिका और सोवियत संघ के बीच दशकों के तनाव का समापन था...',
        'period_y2k_title' => 'वर्ष 2000 (Y2K और वैश्वीकरण)',
        'period_y2k_date' => '2000',
        'period_y2k_text' => 'दुनिया नए सहस्राब्दी में प्रवेश किया; Y2K बग का डर ज्यादातर हानिरहित साबित हुआ। इंटरनेट और वैश्वीकरण तेजी से बढ़ा।',
        'period_y2k_details' => 'वर्ष 2000 ने एक नए सहस्राब्दी की शुरुआत को चिह्नित किया, जिसके साथ Y2K बग के बारे में व्यापक चिंताएं थीं...',
        'period_financial_crisis_title' => '2008 वित्तीय संकट',
        'period_financial_crisis_date' => '2008',
        'period_financial_crisis_text' => 'अमेरिकी आवास बाजार और बैंकिंग प्रणाली के पतन से शुरू हुआ एक प्रमुख वैश्विक आर्थिक मंदी, जिससे व्यापक नौकरी हानि और वित्तीय अस्थिरता हुई।',
        'period_financial_crisis_details' => '2008 का वित्तीय संकट, जिसे अक्सर महामंदी कहा जाता है, अमेरिकी आवास बुलबुले के पतन से शुरू हुआ...',
        'period_social_media_title' => 'सोशल मीडिया का उदय',
        'period_social_media_date' => '2010 का दशक',
        'period_social_media_text' => 'फेसबुक, ट्विटर, इंस्टाग्राम और टिकटॉक जैसे प्लेटफॉर्म ने दुनिया भर में संचार, राजनीति और संस्कृति को पुनर्निर्मित किया।',
        'period_social_media_details' => '2010 के दशक में सोशल मीडिया का उदय फेसबुक जैसे प्लेटफॉर्मों द्वारा संचालित वैश्विक संचार, संस्कृति और राजनीति को बदल दिया...',
        'period_covid_pandemic_title' => 'कोविड-19 महामारी',
        'period_covid_pandemic_date' => '2020',
        'period_covid_pandemic_text' => 'कोरोनावायरस के कारण एक वैश्विक स्वास्थ्य संकट, जिससे लॉकडाउन, आर्थिक व्यवधान और दुनिया भर में 6 मिलियन से अधिक मौतें हुईं।',
        'period_covid_pandemic_details' => 'कोविड-19 महामारी 2019 के अंत में चीन के वुहान में एक नए कोरोनावायरस (SARS-CoV-2) के प्रकोप के साथ शुरू हुई...',
        'period_ai_expansion_title' => 'कृत्रिम बुद्धिमत्ता का विस्तार',
        'period_ai_expansion_date' => '2020 – 2025',
        'period_ai_expansion_text' => 'मशीन लर्निंग और बड़े भाषा मॉडल (जैसे, ChatGPT) जैसी AI प्रौद्योगिकियां उद्योगों, शिक्षा और दैनिक जीवन को बदलना शुरू कर रही हैं।',
        'period_ai_expansion_details' => '2020 के दशक में कृत्रिम बुद्धिमत्ता (AI) का विस्तार, विशेष रूप से 2025 तक, ने उद्योगों, शिक्षा और दैनिक जीवन को पुनर्निर्मित किया है...',
        'period_current_era_title' => 'वर्ष 2025 (वर्तमान युग)',
        'period_current_era_date' => '2025',
        'period_current_era_text' => 'तेजी से तकनीकी प्रगति, जलवायु परिवर्तन जैसी वैश्विक चुनौतियों और AI, नैतिकता और मानवता के भविष्य की भूमिका पर चर्चाओं से चिह्नित।',
        'period_current_era_details' => 'वर्ष 2025 वर्तमान युग में एक महत्वपूर्ण क्षण का प्रतिनिधित्व करता है, जो तेजी से तकनीकी प्रगति और दबाव वाली वैश्विक चुनौतियों की विशेषता है...',
        'period_prehistoric_title' => 'प्रागैतिहासिक मनुष्य',
        'period_prehistoric_date' => 'c. 2 मिलियन ईसा पूर्व – 3000 ईसा पूर्व',
         'period_prehistoric_text' => 'प्रारंभिक मनुष्य शिकार और संग्रहण से जीवन यापन करते थे, बाद में कृषि, उपकरण और बस्तियों का विकास हुआ।',
'period_prehistoric_details' => 'प्रागैतिहासिक काल लगभग 2 मिलियन ईसा पूर्व से 3000 ईसा पूर्व तक फैला हुआ है, जो मानव अस्तित्व के प्रारंभिक चरण को चिह्नित करता है...',
'period_ancient_egypt_title' => 'प्राचीन मिस्र',
'period_ancient_egypt_date' => 'c. 3100 ईसा पूर्व – 30 ईसा पूर्व',
'period_ancient_egypt_text' => 'नील नदी के किनारे एक शक्तिशाली सभ्यता, पिरामिड, फिरौन और हाइरोग्लिफ्स के लिए प्रसिद्ध।',
'period_ancient_egypt_details' => 'प्राचीन मिस्र, लगभग 3100 ईसा पूर्व से 30 ईसा पूर्व तक फलता-फूलता रहा, अपने समय की सबसे उन्नत सभ्यताओं में से एक था...',
'period_ancient_greece_title' => 'प्राचीन यूनान',
'period_ancient_greece_date' => 'c. 800 ईसा पूर्व – 146 ईसा पूर्व',
'period_ancient_greece_text' => 'लोकतंत्र, दर्शन और ओलंपिक खेलों का जन्मस्थान, पश्चिमी संस्कृति पर स्थायी प्रभाव के साथ।',
'period_ancient_greece_details' => 'प्राचीन यूनान, लगभग 800 ईसा पूर्व से 146 ईसा पूर्व तक सक्रिय, नगर-राज्यों का एक संग्रह था, जिसमें एथेंस और स्पार्टा सबसे प्रमुख थे...',
'period_roman_empire_title' => 'रोमन साम्राज्य',
'period_roman_empire_date' => '27 ईसा पूर्व – 476 ईस्वी (पश्चिमी रोमन साम्राज्य)',
'period_roman_empire_text' => 'एक विशाल साम्राज्य जिसने यूरोप और उससे आगे के क्षेत्रों में कानून, वास्तुकला और शासन को आकार दिया।',
'period_roman_empire_details' => 'रोमन साम्राज्य, 27 ईसा पूर्व में ऑगस्टस को अपने पहले सम्राट के रूप में स्थापित किया गया, अपने चरम पर तीन महाद्वीपों तक फैला हुआ था...',
'period_renaissance_title' => 'पुनर्जागरण',
'period_renaissance_date' => 'c. 1300 – 1600',
'period_renaissance_text' => 'यूरोप में एक सांस्कृतिक पुनर्जन्म, कला, विज्ञान और मानवतावाद का उत्सव, लियोनार्डो दा विंची जैसे व्यक्तित्वों के साथ।',
'period_renaissance_details' => 'पुनर्जागरण, लगभग 1300 से 1600 तक फैला हुआ, यूरोप में सांस्कृतिक और बौद्धिक पुनरुत्थान की अवधि थी...',
'period_exploration_title' => 'खोज का युग',
'period_exploration_date' => 'c. 1400 – 1700',
'period_exploration_text' => 'यूरोपीय खोजकर्ता समुद्र के रास्ते दुनिया की यात्रा करते थे, नई भूमियों की खोज और व्यापार और साम्राज्यों का विस्तार करते थे।',
'period_exploration_details' => 'खोज का युग, लगभग 1400 से 1700 तक, वह अवधि थी जब यूरोपीय शक्तियां नए व्यापार मार्गों और क्षेत्रों की तलाश में थीं...',
'period_industrial_title' => 'औद्योगिक क्रांति',
'period_industrial_date' => 'c. 1760 – 1840',
'period_industrial_text' => 'भाप इंजन जैसे आविष्कारों के साथ प्रमुख औद्योगीकरण की अवधि, अर्थव्यवस्थाओं और समाजों को बदल दिया।',
'period_industrial_details' => 'औद्योगिक क्रांति, 1760 और 1840 के बीच हुई, ब्रिटेन में शुरू हुई और यूरोप और उत्तरी अमेरिका में फैल गई...',
'period_ww1_title' => 'प्रथम विश्व युद्ध',
'period_ww1_date' => '1914 – 1918',
'period_ww1_text' => 'यूरोप में केंद्रित एक वैश्विक युद्ध, खाई युद्ध और बड़े पैमाने पर हताहतों से चिह्नित, प्रमुख राजनीतिक परिवर्तनों के साथ समाप्त हुआ।',
'period_ww1_details' => 'प्रथम विश्व युद्ध, 1914 से 1918 तक लड़ा गया, मुख्य रूप से यूरोप में केंद्रित एक वैश्विक संघर्ष था...',
'period_ww1_end_title' => 'प्रथम विश्व युद्ध का अंत',
'period_ww1_end_date' => '1918',
'period_ww1_end_text' => 'चार वर्षों के विनाशकारी वैश्विक संघर्ष के बाद 11 नवंबर 1918 को युद्धविराम के साथ प्रथम विश्व युद्ध समाप्त हुआ।',
'period_ww1_end_details' => 'प्रथम विश्व युद्ध का अंत 11 नवंबर 1918 को फ्रांस के कॉम्पिएग्ने में एक रेलवे डिब्बे में युद्धविराम पर हस्ताक्षर के साथ आया...',
'period_versailles_title' => 'वर्साय की संधि',
'period_versailles_date' => '1919',
'period_versailles_text' => 'एक शांति संधि जिसने आधिकारिक रूप से प्रथम विश्व युद्ध को समाप्त किया; इसने जर्मनी पर कठोर दंड लगाए और यूरोपीय सीमाओं को पुनर्निर्धारित किया।',
'period_versailles_details' => 'वर्साय की संधि, 28 जून 1919 को फ्रांस के वर्साय पैलेस में हस्ताक्षरित, ने आधिकारिक रूप से प्रथम विश्व युद्ध को समाप्त किया...',
'period_league_nations_title' => 'राष्ट्र संघ',
'period_league_nations_date' => '1920 में स्थापित',
'period_league_nations_text' => 'प्रथम विश्व युद्ध के बाद विश्व शांति बनाए रखने के लिए बनाई गई एक अंतर्राष्ट्रीय संगठन, लेकिन यह अंततः अप्रभावी रहा और संयुक्त राष्ट्र द्वारा प्रतिस्थापित किया गया।',
'period_league_nations_details' => 'राष्ट्र संघ की स्थापना 1920 में वर्साय की संधि के हिस्से के रूप में की गई थी, जिसका प्राथमिक लक्ष्य विश्व शांति बनाए रखना था...',
'period_roaring_twenties_title' => 'रोअरिंग ट्वेंटीज',
'period_roaring_twenties_date' => '1920 का दशक',
'period_roaring_twenties_text' => 'आर्थिक समृद्धि, जैज़ संगीत, सांस्कृतिक परिवर्तन और नए जीवन शैलियों का दशक, विशेष रूप से अमेरिका और यूरोप में।',
'period_roaring_twenties_details' => 'रोअरिंग ट्वेंटीज, 1920 के दशक में फैला हुआ, आर्थिक समृद्धि और सांस्कृतिक गतिशीलता का दशक था...',
'period_womens_suffrage_title' => 'महिला मताधिकार',
'period_womens_suffrage_date' => '1920 (अमेरिका); देश के अनुसार भिन्न',
'period_womens_suffrage_text' => 'कई देशों में महिलाओं को मतदान का अधिकार मिला, जिसमें अमेरिका (1920 में 19वां संशोधन) शामिल है, लैंगिक समानता में एक प्रमुख कदम।',
'period_womens_suffrage_details' => 'महिला मताधिकार आंदोलन, जो 1920 के दशक में कई देशों में चरम पर पहुंचा, महिलाओं के लिए मतदान अधिकार सुरक्षित करने के लिए दशकों का संघर्ष था...',
'period_stock_crash_title' => 'शेयर बाजार दुर्घटना',
'period_stock_crash_date' => '1929',
'period_stock_crash_text' => 'अक्टूबर 1929 में अमेरिकी शेयर बाजार ध्वस्त हो गया, जिससे वैश्विक आर्थिक मंदी शुरू हुई।',
'period_stock_crash_details' => '1929 की शेयर बाजार दुर्घटना 24 अक्टूबर 1929 (ब्लैक थर्सडे) को न्यूयॉर्क स्टॉक एक्सचेंज पर शेयर कीमतों में भयावह गिरावट के साथ शुरू हुई...',
'period_great_depression_title' => 'महामंदी',
'period_great_depression_date' => '1929 – 1930 के दशक के अंत',
'period_great_depression_text' => 'बड़े पैमाने पर बेरोजगारी, गरीबी और सामाजिक कठिनाइयों के साथ एक विश्वव्यापी आर्थिक संकट।',
'period_great_depression_details' => 'महामंदी, 1929 से 1930 के दशक के अंत तक चली, 1929 की शेयर बाजार दुर्घटना के बाद एक गंभीर वैश्विक आर्थिक संकट थी...',
'period_fascism_title' => 'फासीवाद का उदय',
'period_fascism_date' => '1920 – 1930 का दशक',
'period_fascism_text' => 'इटली में मुसोलिनी और जर्मनी में हिटलर जैसे सत्तावादी नेता सत्ता में आए, राष्ट्रवाद, सैन्यवाद और तानाशाही को बढ़ावा दिया।',
'period_fascism_details' => '1920 और 1930 के दशक में फासीवाद का उदय आर्थिक अस्थिरता, सामाजिक अशांति और प्रथम विश्व युद्ध के बाद की स्थितियों के प्रति प्रतिक्रिया थी...',
'period_ww2_title' => 'द्वितीय विश्व युद्ध',
'period_ww2_date' => '1939 – 1945',
'period_ww2_text' => 'अधिकांश विश्व शक्तियों को शामिल करने वाला एक वैश्विक संघर्ष; बड़े पैमाने पर विनाश का कारण बना और नाजी जर्मनी और साम्राज्यवादी जापान की हार के साथ समाप्त हुआ।',
'period_ww2_details' => 'द्वितीय विश्व युद्ध, 1939 से 1945 तक, इतिहास का सबसे घातक संघर्ष था, जिसमें 30 से अधिक देश शामिल थे और लगभग 70-85 मिलियन मौतें हुईं...',
'period_cold_war_title' => 'शीत युद्ध',
'period_cold_war_date' => 'c. 1947 – 1991',
'period_cold_war_text' => 'संयुक्त राज्य अमेरिका और सोवियत संघ के बीच राजनीतिक और सैन्य तनाव की अवधि, परमाणु हथियारों की दौड़ और वैचारिक प्रतिद्वंद्विता से चिह्नित।',
'period_cold_war_details' => 'शीत युद्ध, लगभग 1947 से 1991 तक फैला हुआ, संयुक्त राज्य अमेरिका और सोवियत संघ के बीच भू-राजनीतिक तनाव की लंबी अवधि थी...',
'period_civil_rights_title' => 'नागरिक अधिकार आंदोलन',
'period_civil_rights_date' => '1950 – 1960 का दशक',
'period_civil_rights_text' => 'अमेरिका में नस्लीय अलगाव को समाप्त करने और अफ्रीकी अमेरिकियों के लिए समान अधिकार सुरक्षित करने के लिए एक आंदोलन, मार्टिन लूथर किंग जूनियर जैसे नेताओं के नेतृत्व में।',
'period_civil_rights_details' => 'नागरिक अधिकार आंदोलन, मुख्य रूप से 1950 और 1960 के दशक में सक्रिय, संयुक्त राज्य अमेरिका में अफ्रीकी अमेरिकियों के खिलाफ नस्लीय अलगाव और भेदभाव को समाप्त करने के लिए एक संघर्ष था...',
'period_space_exploration_title' => 'अंतरिक्ष अन्वेषण',
'period_space_exploration_date' => '1957 – वर्तमान',
'period_space_exploration_text' => '1957 में सोवियत द्वारा स्पुतनिक के प्रक्षेपण के साथ शुरू हुआ; 1969 में अमेरिकी चंद्रमा लैंडिंग और अंतर्राष्ट्रीय अंतरिक्ष मिशनों के साथ जारी है।',
'period_space_exploration_details' => 'अंतरिक्ष अन्वेषण की शुरुआत 4 अक्टूबर 1957 को सोवियत संघ द्वारा पहले कृत्रिम उपग्रह स्पुतनिक के प्रक्षेपण के साथ हुई...',
'period_computer_revolution_title' => 'कंप्यूटर क्रांति',
'period_computer_revolution_date' => '1970 का दशक – वर्तमान',
'period_computer_revolution_text' => 'प्रारंभिक व्यक्तिगत कंप्यूटरों से इंटरनेट और स्मार्टफोन तक कंप्यूटिंग प्रौद्योगिकी का तेजी से विकास।',
'period_computer_revolution_details' => 'कंप्यूटर क्रांति, 1970 के दशक में शुरू हुई, कंप्यूटिंग प्रौद्योगिकी के तेजी से विकास के माध्यम से समाज को बदल दिया...',
'period_cold_war_end_title' => 'शीत युद्ध का अंत',
'period_cold_war_end_date' => '1991',
'period_cold_war_end_text' => 'सोवियत संघ के पतन, बर्लिन की दीवार के गिरने और अमेरिका के नेतृत्व वाली एकध्रुवीय दुनिया की ओर बदलाव से चिह्नित।',
'period_cold_war_end_details' => '1991 में शीत युद्ध का अंत संयुक्त राज्य अमेरिका और सोवियत संघ के बीच दशकों के तनाव का समापन था...',
'period_y2k_title' => 'वर्ष 2000 (Y2K और वैश्वीकरण)',
'period_y2k_date' => '2000',
'period_y2k_text' => 'दुनिया नए सहस्राब्दी में प्रवेश किया; Y2K बग का डर ज्यादातर हानिरहित साबित हुआ। इंटरनेट और वैश्वीकरण तेजी से बढ़ा।',
'period_y2k_details' => 'वर्ष 2000 ने एक नए सहस्राब्दी की शुरुआत को चिह्नित किया, जिसके साथ Y2K बग के बारे में व्यापक चिंताएं थीं...',
'period_financial_crisis_title' => '2008 वित्तीय संकट',
'period_financial_crisis_date' => '2008',
'period_financial_crisis_text' => 'अमेरिकी आवास बाजार और बैंकिंग प्रणाली के पतन से शुरू हुआ एक प्रमुख वैश्विक आर्थिक मंदी, जिससे व्यापक नौकरी हानि और वित्तीय अस्थिरता हुई।',
'period_financial_crisis_details' => '2008 का वित्तीय संकट, जिसे अक्सर महामंदी कहा जाता है, अमेरिकी आवास बुलबुले के पतन से शुरू हुआ...',
'period_social_media_title' => 'सोशल मीडिया का उदय',
'period_social_media_date' => '2010 का दशक',
'period_social_media_text' => 'फेसबुक, ट्विटर, इंस्टाग्राम और टिकटॉक जैसे प्लेटफॉर्म ने दुनिया भर में संचार, राजनीति और संस्कृति को पुनर्निर्मित किया।',
'period_social_media_details' => '2010 के दशक में सोशल मीडिया का उदय फेसबुक जैसे प्लेटफॉर्मों द्वारा संचालित वैश्विक संचार, संस्कृति और राजनीति को बदल दिया...',
'period_covid_pandemic_title' => 'कोविड-19 महामारी',
'period_covid_pandemic_date' => '2020',
'period_covid_pandemic_text' => 'कोरोनावायरस के कारण एक वैश्विक स्वास्थ्य संकट, जिससे लॉकडाउन, आर्थिक व्यवधान और दुनिया भर में 6 मिलियन से अधिक मौतें हुईं।',
'period_covid_pandemic_details' => 'कोविड-19 महामारी 2019 के अंत में चीन के वुहान में एक नए कोरोनावायरस (SARS-CoV-2) के प्रकोप के साथ शुरू हुई...',
'period_ai_expansion_title' => 'कृत्रिम बुद्धिमत्ता का विस्तार',
'period_ai_expansion_date' => '2020 – 2025',
'period_ai_expansion_text' => 'मशीन लर्निंग और बड़े भाषा मॉडल (जैसे, ChatGPT) जैसी AI प्रौद्योगिकियां उद्योगों, शिक्षा और दैनिक जीवन को बदलना शुरू कर रही हैं।',
'period_ai_expansion_details' => '2020 के दशक में कृत्रिम बुद्धिमत्ता (AI) का विस्तार, विशेष रूप से 2025 तक, ने उद्योगों, शिक्षा और दैनिक जीवन को पुनर्निर्मित किया है...',
'period_current_era_title' => 'वर्ष 2025 (वर्तमान युग)',
'period_current_era_date' => '2025',
'period_current_era_text' => 'तेजी से तकनीकी प्रगति, जलवायु परिवर्तन जैसी वैश्विक चुनौतियों और AI, नैतिकता और मानवता के भविष्य की भूमिका पर चर्चाओं से चिह्नित।',
'period_current_era_details' => 'वर्ष 2025 वर्तमान युग में एक महत्वपूर्ण क्षण का प्रतिनिधित्व करता है, जो तेजी से तकनीकी प्रगति और दबाव वाली वैश्विक चुनौतियों की विशेषता है...',
    ],


    'pt' => [
        'meta_description' => 'Descubra a vasta tapeçaria da história mundial com a HAF, das civilizações antigas aos tempos modernos',
        'hero_title' => 'História Mundial Revelada',
        'hero_subtitle' => 'Explore os eventos globais que moldaram a humanidade com a HAF',
        'nav_history' => 'História',
        'nav_world_history' => 'História Mundial',
        'nav_malaysia_history' => 'História da Malásia',
        'nav_history_game' => 'Jogo de História',
        'nav_art' => 'Arte',
        'nav_fashion' => 'Moda',
        'nav_shop' => 'Loja',
        'timeline_title' => 'Linha do Tempo da História Mundial',
        'timeline_subtitle' => 'Viaje através dos períodos históricos mundiais principais',
        'modal_close' => 'Fechar',
        'period_prehistoric_title' => 'Humanos Pré-históricos',
        'period_prehistoric_date' => 'c. 2 milhões a.C. - 3000 a.C.',
        'period_prehistoric_text' => 'Os primeiros humanos viviam da caça e coleta, desenvolvendo posteriormente a agricultura, ferramentas e assentamentos.',
        'period_prehistoric_details' => 'O período pré-histórico estende-se de aproximadamente 2 milhões a.C. a 3000 a.C., marcando a fase mais antiga da existência humana...',
        'period_ancient_egypt_title' => 'Antigo Egito',
        'period_ancient_egypt_date' => 'c. 3100 a.C. - 30 a.C.',
        'period_ancient_egypt_text' => 'Uma poderosa civilização ao longo do Rio Nilo, conhecida por suas pirâmides, faraós e hieróglifos.',
        'period_ancient_egypt_details' => 'O Antigo Egito, florescendo de aproximadamente 3100 a.C. a 30 a.C., foi uma das civilizações mais avançadas de sua época...',
        'period_ancient_greece_title' => 'Grécia Antiga',
        'period_ancient_greece_date' => 'c. 800 a.C. - 146 a.C.',
        'period_ancient_greece_text' => 'O berço da democracia, filosofia e dos Jogos Olímpicos, com influência duradoura na cultura ocidental.',
        'period_ancient_greece_details' => 'A Grécia Antiga, ativa de aproximadamente 800 a.C. a 146 a.C., era uma coleção de cidades-estado, com Atenas e Esparta sendo as mais proeminentes...',
        'period_roman_empire_title' => 'Império Romano',
        'period_roman_empire_date' => '27 a.C. - 476 d.C. (Império Romano do Ocidente)',
        'period_roman_empire_text' => 'Um vasto império que moldou leis, arquitetura e governança na Europa e além.',
        'period_roman_empire_details' => 'O Império Romano, estabelecido em 27 a.C. com Augusto como seu primeiro imperador, abrangeu três continentes em seu auge...',
        'period_renaissance_title' => 'Renascimento',
        'period_renaissance_date' => 'c. 1300 - 1600',
        'period_renaissance_text' => 'Um renascimento cultural na Europa, celebrando arte, ciência e humanismo, com figuras como Leonardo da Vinci.',
        'period_renaissance_details' => 'O Renascimento, abrangendo aproximadamente de 1300 a 1600, foi um período de renascimento cultural e intelectual na Europa...',
        'period_exploration_title' => 'Era das Grandes Navegações',
        'period_exploration_date' => 'c. 1400 - 1700',
        'period_exploration_text' => 'Exploradores europeus viajaram pelo mundo por mar, descobrindo novas terras e expandindo comércio e impérios.',
        'period_exploration_details' => 'A Era das Grandes Navegações, de aproximadamente 1400 a 1700, foi um período em que potências europeias buscaram novas rotas comerciais e territórios...',
        'period_industrial_title' => 'Revolução Industrial',
        'period_industrial_date' => 'c. 1760 - 1840',
        'period_industrial_text' => 'Um período de grande industrialização com invenções como a máquina a vapor, transformando economias e sociedades.',
        'period_industrial_details' => 'A Revolução Industrial, ocorrendo entre 1760 e 1840, começou na Grã-Bretanha e se espalhou pela Europa e América do Norte...',
        'period_ww1_title' => 'Primeira Guerra Mundial',
        'period_ww1_date' => '1914 - 1918',
        'period_ww1_text' => 'Uma guerra global centrada na Europa, marcada por guerra de trincheiras e enormes baixas, terminando com grandes mudanças políticas.',
        'period_ww1_details' => 'A Primeira Guerra Mundial, travada de 1914 a 1918, foi um conflito global principalmente centrado na Europa...',
        'period_ww1_end_title' => 'Fim da Primeira Guerra Mundial',
        'period_ww1_end_date' => '1918',
        'period_ww1_end_text' => 'A Primeira Guerra Mundial terminou com um armistício em 11 de novembro de 1918, após quatro anos de devastador conflito global.',
        'period_ww1_end_details' => 'O fim da Primeira Guerra Mundial ocorreu em 11 de novembro de 1918, com a assinatura do Armistício em um vagão ferroviário em Compiègne, França...',
        'period_versailles_title' => 'Tratado de Versalhes',
        'period_versailles_date' => '1919',
        'period_versailles_text' => 'Um tratado de paz que oficialmente encerrou a Primeira Guerra Mundial; impôs duras penalidades à Alemanha e redesenhou as fronteiras europeias.',
        'period_versailles_details' => 'O Tratado de Versalhes, assinado em 28 de junho de 1919, no Palácio de Versalhes, França, oficialmente encerrou a Primeira Guerra Mundial...',
        'period_league_nations_title' => 'Liga das Nações',
        'period_league_nations_date' => 'Fundada em 1920',
        'period_league_nations_text' => 'Uma organização internacional criada para manter a paz mundial após a Primeira Guerra Mundial, mas acabou sendo ineficaz e substituída pela ONU.',
        'period_league_nations_details' => 'A Liga das Nações foi estabelecida em 1920 como parte do Tratado de Versalhes, com o objetivo principal de manter a paz mundial...',
        'period_roaring_twenties_title' => 'Anos Loucos',
        'period_roaring_twenties_date' => 'Década de 1920',
        'period_roaring_twenties_text' => 'Uma década de prosperidade econômica, música jazz, mudanças culturais e novos estilos de vida, especialmente nos EUA e Europa.',
        'period_roaring_twenties_details' => 'Os Anos Loucos, abrangendo a década de 1920, foi um período de prosperidade econômica e dinamismo cultural...',
        'period_womens_suffrage_title' => 'Sufrágio Feminino',
        'period_womens_suffrage_date' => '1920 (EUA); varia por país',
        'period_womens_suffrage_text' => 'Mulheres conquistaram o direito ao voto em muitos países, incluindo os EUA (19ª Emenda em 1920), marcando um grande passo na igualdade de gênero.',
        'period_womens_suffrage_details' => 'O movimento pelo sufrágio feminino, culminando na década de 1920 em muitos países, foi uma luta de décadas para garantir direitos de voto para as mulheres...',
        'period_stock_crash_title' => 'Queda da Bolsa de Valores',
        'period_stock_crash_date' => '1929',
        'period_stock_crash_text' => 'A bolsa de valores dos EUA entrou em colapso em outubro de 1929, desencadeando uma recessão econômica global.',
        'period_stock_crash_details' => 'A Queda da Bolsa de Valores de 1929 começou em 24 de outubro de 1929 (Quinta-feira Negra), com uma queda catastrófica nos preços das ações na Bolsa de Valores de Nova York...',
        'period_great_depression_title' => 'Grande Depressão',
        'period_great_depression_date' => '1929 - final dos anos 1930',
        'period_great_depression_text' => 'Uma crise econômica mundial com desemprego em massa, pobreza e dificuldades sociais.',
        'period_great_depression_details' => 'A Grande Depressão, durando de 1929 ao final dos anos 1930, foi uma severa crise econômica global após a Queda da Bolsa de Valores de 1929...',
        'period_fascism_title' => 'Ascensão do Fascismo',
        'period_fascism_date' => 'Décadas de 1920 - 1930',
        'period_fascism_text' => 'Líderes autoritários como Mussolini na Itália e Hitler na Alemanha ganharam poder, promovendo nacionalismo, militarismo e ditadura.',
        'period_fascism_details' => 'A ascensão do fascismo nas décadas de 1920 e 1930 foi uma resposta à instabilidade econômica, agitação social e as consequências da Primeira Guerra Mundial...',
        'period_ww2_title' => 'Segunda Guerra Mundial',
        'period_ww2_date' => '1939 - 1945',
        'period_ww2_text' => 'Um conflito global envolvendo a maioria das potências mundiais; causou destruição maciça e terminou com a derrota da Alemanha Nazista e do Japão Imperial.',
        'period_ww2_details' => 'A Segunda Guerra Mundial, de 1939 a 1945, foi o conflito mais mortal da história, envolvendo mais de 30 países e resultando em aproximadamente 70-85 milhões de mortes...',
        'period_cold_war_title' => 'Guerra Fria',
        'period_cold_war_date' => 'c. 1947 - 1991',
        'period_cold_war_text' => 'Um período de tensão política e militar entre os Estados Unidos e a União Soviética, marcado pela corrida armamentista nuclear e rivalidade ideológica.',
        'period_cold_war_details' => 'A Guerra Fria, abrangendo aproximadamente de 1947 a 1991, foi um período prolongado de tensão geopolítica entre os Estados Unidos e a União Soviética...',
        'period_civil_rights_title' => 'Movimento dos Direitos Civis',
        'period_civil_rights_date' => 'Décadas de 1950 - 1960',
        'period_civil_rights_text' => 'Um movimento nos EUA para acabar com a segregação racial e garantir direitos iguais para afro-americanos, liderado por figuras como Martin Luther King Jr.',
        'period_civil_rights_details' => 'O Movimento dos Direitos Civis, principalmente ativo nas décadas de 1950 e 1960, foi uma luta para acabar com a segregação racial e discriminação contra afro-americanos nos Estados Unidos...',
        'period_space_exploration_title' => 'Exploração Espacial',
        'period_space_exploration_date' => '1957 - presente',
        'period_space_exploration_text' => 'Começou com o lançamento do Sputnik pela União Soviética em 1957; incluiu o pouso na Lua pelos EUA em 1969 e continua com missões espaciais internacionais.',
        'period_space_exploration_details' => 'A exploração espacial começou seriamente com o lançamento do Sputnik, o primeiro satélite artificial, pela União Soviética em 4 de outubro de 1957...',
        'period_computer_revolution_title' => 'Revolução dos Computadores',
        'period_computer_revolution_date' => 'Década de 1970 - presente',
        'period_computer_revolution_text' => 'O rápido avanço da tecnologia computacional, desde os primeiros computadores pessoais até a internet e smartphones.',
        'period_computer_revolution_details' => 'A Revolução dos Computadores, começando na década de 1970, transformou a sociedade através do rápido desenvolvimento da tecnologia computacional...',
        'period_cold_war_end_title' => 'Fim da Guerra Fria',
        'period_cold_war_end_date' => '1991',
        'period_cold_war_end_text' => 'Marcado pelo colapso da União Soviética, a queda do Muro de Berlim e a mudança para um mundo unipolar liderado pelos EUA.',
        'period_cold_war_end_details' => 'O fim da Guerra Fria em 1991 marcou a conclusão de décadas de tensão entre os Estados Unidos e a União Soviética...',
        'period_y2k_title' => 'Ano 2000 (Y2K e Globalização)',
        'period_y2k_date' => '2000',
        'period_y2k_text' => 'O mundo entrou em um novo milênio; os temores do bug Y2K provaram ser em sua maioria inofensivos. A internet e a globalização aceleraram rapidamente.',
        'period_y2k_details' => 'O ano 2000 marcou o início de um novo milênio, acompanhado por preocupações generalizadas sobre o bug Y2K...',
        'period_financial_crisis_title' => 'Crise Financeira de 2008',
        'period_financial_crisis_date' => '2008',
        'period_financial_crisis_text' => 'Uma grande recessão econômica global desencadeada pelo colapso do mercado imobiliário e sistema bancário dos EUA, causando perda generalizada de empregos e instabilidade financeira.',
        'period_financial_crisis_details' => 'A Crise Financeira de 2008, frequentemente chamada de Grande Recessão, começou com o colapso da bolha imobiliária dos EUA...',
        'period_social_media_title' => 'Ascensão das Redes Sociais',
        'period_social_media_date' => 'Década de 2010',
        'period_social_media_text' => 'Plataformas como Facebook, Twitter, Instagram e TikTok remodelaram a comunicação, política e cultura ao redor do mundo.',
        'period_social_media_details' => 'A ascensão das redes sociais na década de 2010 transformou a comunicação, cultura e política global, impulsionada por plataformas como o Facebook...',
        'period_covid_pandemic_title' => 'Pandemia de COVID-19',
        'period_covid_pandemic_date' => '2020',
        'period_covid_pandemic_text' => 'Uma crise de saúde global causada pelo coronavírus, levando a lockdowns, perturbações econômicas e mais de 6 milhões de mortes em todo o mundo.',
        'period_covid_pandemic_details' => 'A pandemia de COVID-19 começou no final de 2019 com o surto de um novo coronavírus (SARS-CoV-2) em Wuhan, China...',
        'period_ai_expansion_title' => 'Expansão da Inteligência Artificial',
        'period_ai_expansion_date' => 'Década de 2020 - 2025',
        'period_ai_expansion_text' => 'Tecnologias de IA como aprendizado de máquina e modelos de linguagem grandes (ex: ChatGPT) começaram a transformar indústrias, educação e vida cotidiana.',
        'period_ai_expansion_details' => 'A expansão da inteligência artificial (IA) na década de 2020, particularmente até 2025, tem remodelado indústrias, educação e vida cotidiana...',
        'period_current_era_title' => 'Ano 2025 (Era Atual)',
        'period_current_era_date' => '2025',
        'period_current_era_text' => 'Marcado por rápidos avanços tecnológicos, desafios globais como mudanças climáticas e discussões sobre o papel da IA, ética e o futuro da humanidade.',
        'period_current_era_details' => 'O ano 2025 representa um momento crucial na era atual, caracterizado por rápidos avanços tecnológicos e desafios globais urgentes...',
        'gallery_title' => 'Galeria da História Mundial',
        'gallery_subtitle' => 'Explore momentos e artefatos icônicos da história mundial',
        'image_1_text' => 'Pinturas Rupestres Pré-históricas',
        'image_1_desc' => 'Arte rupestre antiga de Lascaux, França, retratando animais e atividades humanas de c. 15.000 a.C.',
        'image_2_text' => 'Pirâmides de Gizé',
        'image_2_desc' => 'Túmulos monumentais construídos para faraós no Antigo Egito, construídos por volta de 2560 a.C.',
        'image_3_text' => 'Partenon Grego',
        'image_3_desc' => 'Um templo na Acrópole em Atenas, dedicado a Atena, construído no século V a.C.',
        'image_4_text' => 'Coliseu Romano',
        'image_4_desc' => 'Um anfiteatro icônico em Roma, concluído em 80 d.C., usado para competições de gladiadores.',
        'image_5_text' => 'Arte Renascentista: Capela Sistina',
        'image_5_desc' => 'Obra-prima de Michelangelo no teto da Capela Sistina, pintada entre 1508 e 1512.',
        'image_6_text' => 'Era das Grandes Navegações: Caravelas',
        'image_6_desc' => 'Navios usados por exploradores como Colombo durante o século XV para cruzar oceanos.',
        'image_7_text' => 'Revolução Industrial: Máquina a Vapor',
        'image_7_desc' => 'Uma máquina a vapor, fundamental para a Revolução Industrial, introduzida por James Watt no século XVIII.',
        'image_8_text' => 'Primeira Guerra Mundial: Trincheiras',
        'image_8_desc' => 'Soldados nas trincheiras da Frente Ocidental durante a Primeira Guerra Mundial, 1914-1918.',
        'image_9_text' => 'Dia do Armistício 1918',
        'image_9_desc' => 'Celebrações marcando o fim da Primeira Guerra Mundial em 11 de novembro de 1918.',
        'image_10_text' => 'Assinatura do Tratado de Versalhes',
        'image_10_desc' => 'A assinatura do Tratado de Versalhes em 1919, formalmente encerrando a Primeira Guerra Mundial.',
        'image_11_text' => 'Assembleia da Liga das Nações',
        'image_11_desc' => 'A primeira assembleia da Liga das Nações em Genebra, 1920.',
        'image_12_text' => 'Anos Loucos: Era do Jazz',
        'image_12_desc' => 'Uma banda de jazz se apresentando na década de 1920, emblemática da vibração cultural da década.',
        'image_13_text' => 'Marcha pelo Sufrágio Feminino',
        'image_13_desc' => 'Mulheres marchando pelo direito ao voto nos EUA, levando à 19ª Emenda em 1920.',
        'image_14_text' => 'Queda da Bolsa de Valores 1929',
        'image_14_desc' => 'Pânico em Wall Street quando a bolsa de valores caiu em outubro de 1929.',
        'image_15_text' => 'Grande Depressão: Filas de Pão',
        'image_15_desc' => 'Pessoas em fila por comida durante a Grande Depressão na década de 1930.',
        'image_16_text' => 'Ascensão do Fascismo: Comício Nazista',
        'image_16_desc' => 'Um comício nazista em Nuremberg, Alemanha, durante a década de 1930 sob o regime de Hitler.',
        'image_17_text' => 'Segunda Guerra Mundial: Dia D',
        'image_17_desc' => 'Forças aliadas desembarcando nas praias da Normandia no Dia D, 6 de junho de 1944.',
        'image_18_text' => 'Guerra Fria: Muro de Berlim',
        'image_18_desc' => 'O Muro de Berlim, um símbolo da divisão da Guerra Fria, construído em 1961.',
        'image_19_text' => 'Movimento dos Direitos Civis: Marcha em Washington',
        'image_19_desc' => 'A Marcha em Washington de 1963, onde Martin Luther King Jr. proferiu seu discurso "Eu Tenho um Sonho".',
        'image_20_text' => 'Exploração Espacial: Pouso na Lua',
        'image_20_desc' => 'Neil Armstrong na Lua durante a missão Apollo 11, 20 de julho de 1969.',
        'image_21_text' => 'Revolução dos Computadores: PC Antigo',
        'image_21_desc' => 'Um dos primeiros computadores pessoais da década de 1970, marcando o início da era digital.',
        'image_22_text' => 'Queda do Muro de Berlim',
        'image_22_desc' => 'Cidadãos derrubando o Muro de Berlim em 1989, simbolizando o fim da Guerra Fria.',
        'image_23_text' => 'Preparativos para o Y2K',
        'image_23_desc' => 'Técnicos preparando sistemas para a transição Y2K em 1999.',
        'image_24_text' => 'Crise Financeira de 2008: Falências Bancárias',
        'image_24_desc' => 'O colapso do Lehman Brothers em 2008, um evento chave na crise financeira global.',
        'image_25_text' => 'Redes Sociais: Era dos Smartphones',
        'image_25_desc' => 'A ascensão das redes sociais na década de 2010, impulsionada pelo uso generalizado de smartphones.',
        'image_26_text' => 'Pandemia de COVID-19: Lockdowns',
        'image_26_desc' => 'Ruas vazias durante lockdowns globais em 2020 devido à pandemia de COVID-19.',
        'image_27_text' => 'Expansão da IA: Robótica',
        'image_27_desc' => 'Robótica avançada alimentada por IA, transformando indústrias na década de 2020.',
        'image_28_text' => '2025: Futuro Sustentável',
        'image_28_desc' => 'Inovações em energia renovável e esforços de sustentabilidade em 2025.',
        'footer_copyright' => '© 2025 História, Arte & Moda. Todos os direitos reservados.',
],
    'ru' => [
        'meta_description' => 'Откройте богатую историю мира с HAF, от древних цивилизаций до современной эпохи',
        'hero_title' => 'Раскрытие мировой истории',
        'hero_subtitle' => 'Исследуйте глобальные события, сформировавшие человечество с HAF',
        'nav_history' => 'История',
        'nav_world_history' => 'Мировая история',
        'nav_malaysia_history' => 'История Малайзии',
        'nav_history_game' => 'Историческая игра',
        'nav_art' => 'Искусство',
        'nav_fashion' => 'Мода',
        'nav_shop' => 'Магазин',
        'timeline_title' => 'Хронология мировой истории',
        'timeline_subtitle' => 'Путешествие по основным историческим периодам мира',
        'modal_close' => 'Закрыть',
        'period_prehistoric_title' => 'Доисторические люди',
        'period_prehistoric_date' => 'около 2 млн лет до н.э. - 3000 г. до н.э.',
        'period_prehistoric_text' => 'Ранние люди жили охотой и собирательством, затем развили сельское хозяйство, инструменты и поселения.',
        'period_prehistoric_details' => 'Доисторический период охватывает примерно от 2 миллионов лет до н.э. до 3000 г. до н.э., представляя самую раннюю стадию человеческого существования...',
        'period_ancient_egypt_title' => 'Древний Египет',
        'period_ancient_egypt_date' => 'около 3100 г. до н.э. - 30 г. до н.э.',
        'period_ancient_egypt_text' => 'Могущественная цивилизация на берегах Нила, известная своими пирамидами, фараонами и иероглифами.',
        'period_ancient_egypt_details' => 'Древний Египет процветал с 3100 г. до н.э. до 30 г. до н.э., являясь одной из самых развитых цивилизаций своего времени...',
        'period_ancient_greece_title' => 'Древняя Греция',
        'period_ancient_greece_date' => 'около 800 г. до н.э. - 146 г. до н.э.',
        'period_ancient_greece_text' => 'Колыбель демократии, философии и Олимпийских игр, с длительным влиянием на западную культуру.',
        'period_ancient_greece_details' => 'Древняя Греция существовала с 800 г. до н.э. до 146 г. до н.э., представляя собой совокупность городов-государств, с Афинами и Спартой как наиболее значимыми...',
        'period_roman_empire_title' => 'Римская империя',
        'period_roman_empire_date' => '27 г. до н.э. - 476 г. н.э. (Западная Римская империя)',
        'period_roman_empire_text' => 'Обширная империя, сформировавшая право, архитектуру и управление в Европе и за её пределами.',
        'period_roman_empire_details' => 'Римская империя была основана в 27 г. до н.э. с Августом как первым императором, достигнув своего пика, охватывала три континента...',
        'period_renaissance_title' => 'Эпоха Возрождения',
        'period_renaissance_date' => 'около 1300 - 1600',
        'period_renaissance_text' => 'Культурное возрождение в Европе, прославляющее искусство, науку и гуманизм, с такими фигурами как Леонардо да Винчи.',
        'period_renaissance_details' => 'Эпоха Возрождения длилась с 1300 по 1600 год, представляя период культурного и интеллектуального возрождения в Европе...',
        'period_industrial_revolution_title' => 'Промышленная революция',
        'period_industrial_revolution_date' => 'около 1760 - 1840',
        'period_industrial_revolution_text' => 'Переход к новым производственным процессам, механизации и фабрикам, трансформировавшим общество.',
        'period_industrial_revolution_details' => 'Промышленная революция началась в Великобритании около 1760 года, распространившись по Европе и Северной Америке...',
        'period_ww1_title' => 'Первая мировая война',
        'period_ww1_date' => '1914 - 1918',
        'period_ww1_text' => 'Глобальный конфликт, перекроивший карту Европы и приведший к значительным социальным изменениям.',
        'period_ww1_details' => 'Первая мировая война началась в 1914 году после убийства эрцгерцога Франца Фердинанда...',
        'period_ww1_end_title' => 'Окончание Первой мировой войны',
        'period_ww1_end_date' => '11 ноября 1918',
        'period_ww1_end_text' => 'Подписание перемирия в Компьене, Франция, положило конец боевым действиям.',
        'period_ww1_end_details' => 'Перемирие было подписано в Компьене, Франция, 11 ноября 1918 года, официально завершив Первую мировую войну...',
        // ... existing code ...
    ],
    'de' => [
        'meta_description' => 'Entdecken Sie das große Panorama der Weltgeschichte mit HAF, von antiken Zivilisationen bis zur Moderne',
        'hero_title' => 'Weltgeschichte Enthüllt',
        'hero_subtitle' => 'Erkunden Sie mit HAF die globalen Ereignisse, die die Menschheit geprägt haben',
        'nav_history' => 'Geschichte',
        'nav_world_history' => 'Weltgeschichte',
        'nav_malaysia_history' => 'Geschichte Malaysias',
        'nav_history_game' => 'Geschichtsspiel',
        'nav_art' => 'Kunst',
        'nav_fashion' => 'Mode',
        'nav_shop' => 'Shop',
        'timeline_title' => 'Zeitleiste der Weltgeschichte',
        'timeline_subtitle' => 'Reise durch die wichtigsten Epochen der Weltgeschichte',
        'modal_close' => 'Schließen',
        'period_prehistoric_title' => 'Prähistorische Menschen',
        'period_prehistoric_date' => 'ca. 2 Mio. v. Chr. – 3000 v. Chr.',
        'period_prehistoric_text' => 'Frühe Menschen lebten von Jagd und Sammeln, entwickelten später Landwirtschaft, Werkzeuge und Siedlungen.',
        'period_prehistoric_details' => 'Die prähistorische Zeitspanne reicht von etwa 2 Millionen v. Chr. bis 3000 v. Chr. und markiert die früheste Phase der Menschheitsgeschichte...',
        'period_ancient_egypt_title' => 'Altes Ägypten',
        'period_ancient_egypt_date' => 'ca. 3100 v. Chr. – 30 v. Chr.',
        'period_ancient_egypt_text' => 'Eine mächtige Zivilisation am Nil, bekannt für Pyramiden, Pharaonen und Hieroglyphen.',
        'period_ancient_egypt_details' => 'Das alte Ägypten blühte von etwa 3100 v. Chr. bis 30 v. Chr. und war eine der fortschrittlichsten Zivilisationen seiner Zeit...',
        'period_ancient_greece_title' => 'Antikes Griechenland',
        'period_ancient_greece_date' => 'ca. 800 v. Chr. – 146 v. Chr.',
        'period_ancient_greece_text' => 'Die Wiege der Demokratie, Philosophie und Olympischen Spiele mit nachhaltigem Einfluss auf die westliche Kultur.',
        'period_ancient_greece_details' => 'Das antike Griechenland bestand von ca. 800 v. Chr. bis 146 v. Chr. und war eine Ansammlung von Stadtstaaten, wobei Athen und Sparta die bedeutendsten waren...',
        'period_roman_empire_title' => 'Römisches Reich',
        'period_roman_empire_date' => '27 v. Chr. – 476 n. Chr. (Weströmisches Reich)',
        'period_roman_empire_text' => 'Ein riesiges Reich, das Recht, Architektur und Verwaltung in Europa und darüber hinaus prägte.',
        'period_roman_empire_details' => 'Das Römische Reich wurde 27 v. Chr. mit Augustus als erstem Kaiser gegründet und erstreckte sich auf seinem Höhepunkt über drei Kontinente...',
        'period_renaissance_title' => 'Renaissance',
        'period_renaissance_date' => 'ca. 1300 – 1600',
        'period_renaissance_text' => 'Eine kulturelle Wiedergeburt in Europa, die Kunst, Wissenschaft und Humanismus feierte, mit Persönlichkeiten wie Leonardo da Vinci.',
        'period_renaissance_details' => 'Die Renaissance, etwa von 1300 bis 1600, war eine Zeit des kulturellen und intellektuellen Aufschwungs in Europa...',
        'period_exploration_title' => 'Zeitalter der Entdeckungen',
        'period_exploration_date' => 'ca. 1400 – 1700',
        'period_exploration_text' => 'Europäische Entdecker reisten per Schiff um die Welt, entdeckten neue Länder und erweiterten Handel und Reiche.',
        'period_exploration_details' => 'Das Zeitalter der Entdeckungen, etwa von 1400 bis 1700, war eine Zeit, in der europäische Mächte neue Handelsrouten und Gebiete suchten...',
        'period_industrial_title' => 'Industrielle Revolution',
        'period_industrial_date' => 'ca. 1760 – 1840',
        'period_industrial_text' => 'Eine Zeit großer Industrialisierung mit Erfindungen wie der Dampfmaschine, die Wirtschaft und Gesellschaft veränderten.',
        'period_industrial_details' => 'Die Industrielle Revolution, die zwischen 1760 und 1840 stattfand, begann in Großbritannien und verbreitete sich nach Europa und Nordamerika...',
        'period_ww1_title' => 'Erster Weltkrieg',
        'period_ww1_date' => '1914 – 1918',
        'period_ww1_text' => 'Ein globaler Krieg, der sich auf Europa konzentrierte, geprägt von Stellungskrieg und massiven Verlusten, endete mit großen politischen Veränderungen.',
        'period_ww1_details' => 'Der Erste Weltkrieg, von 1914 bis 1918, war ein globaler Konflikt, der sich hauptsächlich auf Europa konzentrierte...',
        'period_ww1_end_title' => 'Ende des Ersten Weltkriegs',
        'period_ww1_end_date' => '1918',
        'period_ww1_end_text' => 'Der Erste Weltkrieg endete am 11. November 1918 mit einem Waffenstillstand nach vier Jahren verheerenden globalen Konflikts.',
        'period_ww1_end_details' => 'Das Ende des Ersten Weltkriegs kam am 11. November 1918 mit der Unterzeichnung des Waffenstillstands in einem Eisenbahnwaggon in Compiègne, Frankreich...',
        'period_versailles_title' => 'Vertrag von Versailles',
        'period_versailles_date' => '1919',
        'period_versailles_text' => 'Ein Friedensvertrag, der den Ersten Weltkrieg offiziell beendete; er verhängte harte Strafen gegen Deutschland und zog europäische Grenzen neu.',
        'period_versailles_details' => 'Der Vertrag von Versailles, unterzeichnet am 28. Juni 1919 im Schloss Versailles, Frankreich, beendete offiziell den Ersten Weltkrieg...',
        'period_league_nations_title' => 'Völkerbund',
        'period_league_nations_date' => 'Gegründet 1920',
        'period_league_nations_text' => 'Eine internationale Organisation zur Wahrung des Weltfriedens nach dem Ersten Weltkrieg, die letztlich unwirksam war und durch die UNO ersetzt wurde.',
        'period_league_nations_details' => 'Der Völkerbund wurde 1920 als Teil des Vertrags von Versailles gegründet, mit dem Hauptziel, den Weltfrieden zu wahren...',
        'period_roaring_twenties_title' => 'Goldene Zwanziger',
        'period_roaring_twenties_date' => '1920er Jahre',
        'period_roaring_twenties_text' => 'Ein Jahrzehnt wirtschaftlichen Wohlstands, Jazzmusik, kulturellen Wandels und neuer Lebensstile, besonders in den USA und Europa.',
        'period_roaring_twenties_details' => 'Die Goldenen Zwanziger, die die 1920er Jahre umfassten, waren ein Jahrzehnt wirtschaftlichen Wohlstands und kultureller Dynamik...',
        'period_womens_suffrage_title' => 'Frauenwahlrecht',
        'period_womens_suffrage_date' => '1920 (USA); je nach Land unterschiedlich',
        'period_womens_suffrage_text' => 'Frauen erhielten in vielen Ländern das Wahlrecht, darunter die USA (19. Zusatzartikel 1920), ein großer Schritt zur Gleichstellung der Geschlechter.',
        'period_womens_suffrage_details' => 'Die Frauenwahlrechtsbewegung, die in den 1920er Jahren in vielen Ländern ihren Höhepunkt erreichte, war ein jahrzehntelanger Kampf um das Wahlrecht für Frauen...',
        'period_stock_crash_title' => 'Börsencrash',
        'period_stock_crash_date' => '1929',
        'period_stock_crash_text' => 'Der US-Aktienmarkt brach im Oktober 1929 zusammen und löste eine weltweite Wirtschaftskrise aus.',
        'period_stock_crash_details' => 'Der Börsencrash von 1929 begann am 24. Oktober 1929 (Schwarzer Donnerstag) mit einem katastrophalen Kurssturz an der New Yorker Börse...',
        'period_great_depression_title' => 'Große Depression',
        'period_great_depression_date' => '1929 – späte 1930er Jahre',
        'period_great_depression_text' => 'Eine weltweite Wirtschaftskrise mit massiver Arbeitslosigkeit, Armut und sozialen Schwierigkeiten.',
        'period_great_depression_details' => 'Die Große Depression, die von 1929 bis in die späten 1930er Jahre dauerte, war eine schwere globale Wirtschaftskrise nach dem Börsencrash von 1929...',
        'period_fascism_title' => 'Aufstieg des Faschismus',
        'period_fascism_date' => '1920er – 1930er Jahre',
        'period_fascism_text' => 'Autoritäre Führer wie Mussolini in Italien und Hitler in Deutschland kamen an die Macht und förderten Nationalismus, Militarismus und Diktatur.',
        'period_fascism_details' => 'Der Aufstieg des Faschismus in den 1920er und 1930er Jahren war eine Reaktion auf wirtschaftliche Instabilität, soziale Unruhen und die Folgen des Ersten Weltkriegs...',
        'period_ww2_title' => 'Zweiter Weltkrieg',
        'period_ww2_date' => '1939 – 1945',
        'period_ww2_text' => 'Un globaler Konflikt, an dem die meisten Weltmächte beteiligt waren; verursachte massive Zerstörung und endete mit der Niederlage Nazi-Deutschlands und des kaiserlichen Japans.',
        'period_ww2_details' => 'Der Zweite Weltkrieg, von 1939 bis 1945, war der tödlichste Konflikt der Geschichte, an dem über 30 Länder beteiligt waren und der etwa 70–85 Millionen Todesopfer forderte...',
        'period_cold_war_title' => 'Kalter Krieg',
        'period_cold_war_date' => 'ca. 1947 – 1991',
        'period_cold_war_text' => 'Eine Zeit politischer und militärischer Spannungen zwischen den USA und der Sowjetunion, geprägt von einem nuklearen Wettrüsten und ideologischer Rivalität.',
        'period_cold_war_details' => 'Der Kalte Krieg, etwa von 1947 bis 1991, war eine langanhaltende Phase geopolitischer Spannungen zwischen den USA und der Sowjetunion...',
        'period_civil_rights_title' => 'Bürgerrechtsbewegung',
        'period_civil_rights_date' => '1950er – 1960er Jahre',
        'period_civil_rights_text' => 'Eine Bewegung in den USA zur Beendigung der Rassentrennung und zur Sicherung gleicher Rechte für Afroamerikaner, angeführt von Persönlichkeiten wie Martin Luther King Jr.',
        'period_civil_rights_details' => 'Die Bürgerrechtsbewegung, hauptsächlich in den 1950er und 1960er Jahren aktiv, war ein Kampf zur Beendigung der Rassentrennung und Diskriminierung von Afroamerikanern in den USA...',
        'period_space_exploration_title' => 'Weltraumforschung',
        'period_space_exploration_date' => '1957 – heute',
        'period_space_exploration_text' => 'Begann mit dem sowjetischen Start von Sputnik 1957; umfasste die US-Mondlandung 1969 und setzt sich mit internationalen Weltraummissionen fort.',
        'period_space_exploration_details' => 'Die Weltraumforschung begann ernsthaft mit dem Start von Sputnik, dem ersten künstlichen Satelliten, durch die Sowjetunion am 4. Oktober 1957...',
        'period_computer_revolution_title' => 'Computerrevolution',
        'period_computer_revolution_date' => '1970er Jahre – heute',
        'period_computer_revolution_text' => 'Der rasante Fortschritt der Computertechnologie, von frühen Personal Computern bis hin zu Internet und Smartphones.',
        'period_computer_revolution_details' => 'Die Computerrevolution, die in den 1970er Jahren begann, veränderte die Gesellschaft durch die rasante Entwicklung der Computertechnologie...',
        'period_cold_war_end_title' => 'Ende des Kalten Krieges',
        'period_cold_war_end_date' => '1991',
        'period_cold_war_end_text' => 'Gekennzeichnet durch den Zusammenbruch der Sowjetunion, den Fall der Berliner Mauer und den Übergang zu einer von den USA geführten unipolaren Welt.',
        'period_cold_war_end_details' => 'Das Ende des Kalten Krieges 1991 markierte den Abschluss jahrzehntelanger Spannungen zwischen den USA und der Sowjetunion...',
        'period_y2k_title' => 'Jahr 2000 (Y2K und Globalisierung)',
        'period_y2k_date' => '2000',
        'period_y2k_text' => 'Die Welt trat in ein neues Jahrtausend ein; die Befürchtungen des Y2K-Bugs erwiesen sich als weitgehend harmlos. Das Internet und die Globalisierung beschleunigten sich rasant.',
        'period_y2k_details' => 'Das Jahr 2000 markierte den Beginn eines neuen Jahrtausends, begleitet von weit verbreiteten Bedenken hinsichtlich des Y2K-Bugs...',
        'period_financial_crisis_title' => 'Finanzkrise 2008',
        'period_financial_crisis_date' => '2008',
        'period_financial_crisis_text' => 'Eine große globale Wirtschaftskrise, ausgelöst durch den Zusammenbruch des US-Immobilienmarktes und des Bankensystems, führte zu weit verbreitetem Arbeitsplatzverlust und finanzieller Instabilität.',
        'period_financial_crisis_details' => 'Die Finanzkrise 2008, oft als Große Rezession bezeichnet, begann mit dem Zusammenbruch der US-Immobilienblase...',
        'period_social_media_title' => 'Aufstieg der Sozialen Medien',
        'period_social_media_date' => '2010er Jahre',
        'period_social_media_text' => 'Plattformen wie Facebook, Twitter, Instagram und TikTok veränderten Kommunikation, Politik und Kultur weltweit.',
        'period_social_media_details' => 'Der Aufstieg sozialer Medien in den 2010er Jahren veränderte die globale Kommunikation, Kultur und Politik, angetrieben von Plattformen wie Facebook...',
        'period_covid_pandemic_title' => 'COVID-19-Pandemie',
        'period_covid_pandemic_date' => '2020',
        'period_covid_pandemic_text' => 'Eine globale Gesundheitskrise, verursacht durch das Coronavirus, führte zu Lockdowns, wirtschaftlichen Störungen und über 6 Millionen Todesfällen weltweit.',
        'period_covid_pandemic_details' => 'Die COVID-19-Pandemie begann Ende 2019 mit einem Ausbruch des neuartigen Coronavirus (SARS-CoV-2) in Wuhan, China...',
        'period_ai_expansion_title' => 'Expansion der Künstlichen Intelligenz',
        'period_ai_expansion_date' => '2020er – 2025',
        'period_ai_expansion_text' => 'KI-Technologien wie maschinelles Lernen und große Sprachmodelle (par exemple, ChatGPT) begannen, Branchen, Bildung und Alltag zu verändern.',
        'period_ai_expansion_details' => 'Die Expansion der Künstlichen Intelligenz (KI) in den 2020er Jahren, insbesondere bis 2025, hat Branchen, Bildung und Alltag neu gestaltet...',
        'period_current_era_title' => 'Jahr 2025 (Gegenwärtige Ära)',
        'period_current_era_date' => '2025',
        'period_current_era_text' => 'Gekennzeichnet durch rasante technologische Fortschritte, globale Herausforderungen wie den Klimawandel und Debatten über die Rolle der KI, Ethik und die Zukunft der Menschheit.',
        'period_current_era_details' => 'Das Jahr 2025 stellt einen entscheidenden Moment in der gegenwärtigen Ära dar, geprägt von schnellen technologischen Fortschritten und dringenden globalen Herausforderungen...',
        'gallery_title' => 'Galerie der Weltgeschichte',
        'gallery_subtitle' => 'Entdecken Sie ikonische Momente und Artefakte der Weltgeschichte',
        'image_1_text' => 'Prähistorische Höhlenmalereien',
        'image_1_desc' => 'Antike Höhlenkunst aus Lascaux, Frankreich, die Tiere und menschliche Aktivitäten um 15.000 v. Chr. darstellt.',
        'image_2_text' => 'Pyramiden von Gizeh',
        'image_2_desc' => 'Monumentale Gräber, die für Pharaonen im Alten Ägypten um 2560 v. Chr. erbaut wurden.',
        'image_3_text' => 'Griechischer Parthenon',
        'image_3_desc' => 'Ein Tempel auf der Akropolis in Athen, der Athene gewidmet ist und im 5. Jahrhundert v. Chr. erbaut wurde.',
        'image_4_text' => 'Römisches Kolosseum',
        'image_4_desc' => 'Ein ikonisches Amphitheater in Rom, 80 n. Chr. fertiggestellt, genutzt für Gladiatorenkämpfe.',
        'image_5_text' => 'Renaissance-Kunst: Sixtinische Kapelle',
        'image_5_desc' => 'Meisterwerk von Michelangelo an der Decke der Sixtinischen Kapelle, gemalt zwischen 1508 und 1512.',
        'image_6_text' => 'Âge des Découvertes : Caravelles',
        'image_6_desc' => 'Barcos usados por exploradores como Colón durante el siglo XV para cruzar océanos.',
        'image_7_text' => 'Révolution Industrielle : Máquina de Vapor',
        'image_7_desc' => 'Una máquina de vapor, fundamental para la Revolución Industrial, introducida por James Watt en el siglo XVIII.',
        'image_8_text' => 'Primera Guerra Mundial: Trincheras',
        'image_8_desc' => 'Soldados en las trincheras del Frente Occidental durante la Primera Guerra Mundial, 1914-1918.',
        'image_9_text' => 'Día del Armisticio 1918',
        'image_9_desc' => 'Celebraciones marcando el fin de la Primera Guerra Mundial el 11 de noviembre de 1918.',
        'image_10_text' => 'Firma del Tratado de Versalles',
        'image_10_desc' => 'La firma del Tratado de Versalles en 1919, formalmente terminando la Primera Guerra Mundial.',
        'image_11_text' => 'Asamblea de la Liga de las Naciones',
        'image_11_desc' => 'La primera asamblea de la Liga de las Naciones en Ginebra, 1920.',
        'image_12_text' => 'Años Veinte: Era del Jazz',
        'image_12_desc' => 'Una banda de jazz actuando en los años 1920, emblemática de la vitalidad cultural de la década.',
        'image_13_text' => 'Marcha por el Sufragio Femenino',
        'image_13_desc' => 'Mujeres marchando por el derecho al voto en EE.UU., llevando a la 19ª Enmienda en 1920.',
        'image_14_text' => 'Crack de la Bolsa 1929',
        'image_14_desc' => 'Pánico en Wall Street cuando la bolsa se desplomó en octubre de 1929.',
        'image_15_text' => 'Gran Depresión: Colas de Pan',
        'image_15_desc' => 'Personas haciendo cola para comida durante la Gran Depresión en los años 1930.',
        'image_16_text' => 'Auge del Fascismo: Concentración Nazi',
        'image_16_desc' => 'Una concentración nazi en Nuremberg, Alemania, durante los años 1930 bajo el régimen de Hitler.',
        'image_17_text' => 'Segunda Guerra Mundial: Día D',
        'image_17_desc' => 'Fuerzas aliadas desembarcando en las playas de Normandía el Día D, 6 de junio de 1944.',
        'image_18_text' => 'Guerra Fría: Muro de Berlín',
        'image_18_desc' => 'El Muro de Berlín, un símbolo de la división de la Guerra Fría, construido en 1961.',
        'image_19_text' => 'Movimiento por los Derechos Civiles: Marcha en Washington',
        'image_19_desc' => 'La Marcha en Washington de 1963, où Martin Luther King Jr. a prononcé son discours "I Have a Dream".',
        'image_20_text' => 'Exploración Espacial: Alunizaje',
        'image_20_desc' => 'Neil Armstrong en la luna durante la misión Apolo 11, 20 de julio de 1969.',
        'image_21_text' => 'Revolución Informática : PC Temprana',
        'image_21_desc' => 'Una computadora personal temprana de los años 1970, marcando el inicio de la era digital.',
        'image_22_text' => 'Caída del Muro de Berlín',
        'image_22_desc' => 'Ciudadanos démantelant el Muro de Berlín en 1989, simbolizando la fin de la Guerra Fría.',
        'image_23_text' => 'Preparaciones Y2K',
        'image_23_desc' => 'Técnicos preparando sistemas para la transición Y2K en 1999.',
        'image_24_text' => '2008 Financial Crisis: Bank Failures',
        'image_24_desc' => 'The collapse of Lehman Brothers in 2008, a key event in the global financial crisis.',
        'image_25_text' => 'Social Media: Smartphone Era',
        'image_25_desc' => 'The rise of social media in the 2010s, driven by widespread smartphone use.',
        'image_26_text' => 'COVID-19 Pandemic: Lockdowns',
        'image_26_desc' => 'Empty streets during global lockdowns in 2020 due to the COVID-19 pandemic.',
        'image_27_text' => 'AI Expansion: Robotics',
        'image_27_desc' => 'Advanced robotics powered by AI, transforming industries in the 2020s.',
        'image_28_text' => '2025 : Avenir Durable',
        'image_28_desc' => 'Innovationen in erneuerbaren Energien und Nachhaltigkeitsbemühungen im Jahr 2025.',
        'footer_copyright' => '© 2025 Geschichte, Kunst & Mode. Alle Rechte vorbehalten.'
    ],
    'en' => [
        'meta_description' => 'Discover the vast tapestry of world history with HAF, from ancient civilizations to modern times',
        'hero_title' => 'World History Unveiled',
        'hero_subtitle' => 'Explore the global events that shaped humanity with HAF',
        'nav_history' => 'History',
        'nav_world_history' => 'World History',
        'nav_malaysia_history' => 'Malaysia History',
        'nav_history_game' => 'History Game',
        'nav_art' => 'Art',
        'nav_fashion' => 'Fashion',
        'nav_shop' => 'Shop',
        'timeline_title' => 'World History Timeline',
        'timeline_subtitle' => 'Journey through pivotal global historical periods',
        'modal_close' => 'Close',
        'period_prehistoric_title' => 'Prehistoric Humans',
        'period_prehistoric_date' => 'c. 2 million BCE – 3000 BCE',
        'period_prehistoric_text' => 'Early humans lived by hunting and gathering, later developing farming, tools, and settlements.',
        'period_prehistoric_details' => 'The Prehistoric period spans from approximately 2 million BCE to 3000 BCE, marking the earliest phase of human existence...',
        'period_ancient_egypt_title' => 'Ancient Egypt',
        'period_ancient_egypt_date' => 'c. 3100 BCE – 30 BCE',
        'period_ancient_egypt_text' => 'A powerful civilization along the Nile River, known for pyramids, pharaohs, and hieroglyphs.',
        'period_ancient_egypt_details' => 'Ancient Egypt, flourishing from around 3100 BCE to 30 BCE, was one of the most advanced civilizations of its time...',
        'period_ancient_greece_title' => 'Ancient Greece',
        'period_ancient_greece_date' => 'c. 800 BCE – 146 BCE',
        'period_ancient_greece_text' => 'The birthplace of democracy, philosophy, and the Olympic Games, with lasting influence on Western culture.',
        'period_ancient_greece_details' => 'Ancient Greece, active from around 800 BCE to 146 BCE, was a collection of city-states, with Athens and Sparta being the most prominent...',
        'period_roman_empire_title' => 'Roman Empire',
        'period_roman_empire_date' => '27 BCE – 476 CE (Western Roman Empire)',
        'period_roman_empire_text' => 'A vast empire that shaped law, architecture, and governance in Europe and beyond.',
        'period_roman_empire_details' => 'The Roman Empire, established in 27 BCE with Augustus as its first emperor, spanned three continents at its height...',
        'period_renaissance_title' => 'Renaissance',
        'period_renaissance_date' => 'c. 1300 – 1600',
        'period_renaissance_text' => 'A cultural rebirth in Europe, celebrating art, science, and humanism, featuring figures like Leonardo da Vinci.',
        'period_renaissance_details' => 'The Renaissance, spanning roughly from 1300 to 1600, was a period of cultural and intellectual revival in Europe...',
        'period_exploration_title' => 'The Age of Exploration',
        'period_exploration_date' => 'c. 1400 – 1700',
        'period_exploration_text' => 'European explorers traveled the world by sea, discovering new lands and expanding trade and empires.',
        'period_exploration_details' => 'The Age of Exploration, from approximately 1400 to 1700, was a period when European powers sought new trade routes and territories...',
        'period_industrial_title' => 'Industrial Revolution',
        'period_industrial_date' => 'c. 1760 – 1840',
        'period_industrial_text' => 'A period of major industrialization with inventions like the steam engine, transforming economies and societies.',
        'period_industrial_details' => 'The Industrial Revolution, occurring between 1760 and 1840, began in Britain and spread to Europe and North America...',
        'period_ww1_title' => 'World War I',
        'period_ww1_date' => '1914 – 1918',
        'period_ww1_text' => 'A global war centered in Europe, marked by trench warfare and massive casualties, ending with major political changes.',
        'period_ww1_details' => 'World War I, fought from 1914 to 1918, was a global conflict primarily centered in Europe...',
        'period_ww1_end_title' => 'End of World War I',
        'period_ww1_end_date' => '1918',
        'period_ww1_end_text' => 'World War I ended with an armistice on November 11, 1918, after four years of devastating global conflict.',
        'period_ww1_end_details' => 'The end of World War I came on November 11, 1918, with the signing of the Armistice in a railway carriage in Compiègne, France...',
        'period_versailles_title' => 'Treaty of Versailles',
        'period_versailles_date' => '1919',
        'period_versailles_text' => 'A peace treaty that officially ended WWI; it imposed harsh penalties on Germany and redrew European borders.',
        'period_versailles_details' => 'The Treaty of Versailles, signed on June 28, 1919, in the Palace of Versailles, France, officially ended World War I...',
        'period_league_nations_title' => 'League of Nations',
        'period_league_nations_date' => 'Founded in 1920',
        'period_league_nations_text' => 'An international organization created to maintain world peace after WWI, but it was ultimately ineffective and replaced by the UN.',
        'period_league_nations_details' => 'The League of Nations was established in 1920 as part of the Treaty of Versailles, with the primary goal of maintaining world peace...',
        'period_roaring_twenties_title' => 'Roaring Twenties',
        'period_roaring_twenties_date' => '1920s',
        'period_roaring_twenties_text' => 'A decade of economic prosperity, jazz music, cultural change, and new lifestyles, especially in the U.S. and Europe.',
        'period_roaring_twenties_details' => 'The Roaring Twenties, spanning the 1920s, was a decade of economic prosperity and cultural dynamism...',
        'period_womens_suffrage_title' => 'Women Suffrage',
        'period_womens_suffrage_date' => '1920 (U.S.); varies by country',
        'period_womens_suffrage_text' => 'Women gained the right to vote in many countries, including the U.S. (19th Amendment in 1920), marking a major step in gender equality.',
        'period_womens_suffrage_details' => 'The women suffrage movement, culminating in the 1920s in many countries, was a decades-long struggle to secure voting rights for women...',
        'period_stock_crash_title' => 'Stock Market Crash',
        'period_stock_crash_date' => '1929',
        'period_stock_crash_text' => 'The U.S. stock market collapsed in October 1929, triggering a global economic downturn.',
        'period_stock_crash_details' => 'The Stock Market Crash of 1929 began on October 24, 1929 (Black Thursday), with a catastrophic drop in stock prices on the New York Stock Exchange...',
        'period_great_depression_title' => 'Great Depression',
        'period_great_depression_date' => '1929 – late 1930s',
        'period_great_depression_text' => 'A worldwide economic crisis with massive unemployment, poverty, and social hardship.',
        'period_great_depression_details' => 'The Great Depression, lasting from 1929 to the late 1930s, was a severe global economic crisis following the Stock Market Crash of 1929...',
        'period_fascism_title' => 'Rise of Fascism',
        'period_fascism_date' => '1920s – 1930s',
        'period_fascism_text' => 'Authoritarian leaders like Mussolini in Italy and Hitler in Germany gained power, promoting nationalism, militarism, and dictatorship.',
        'period_fascism_details' => 'The rise of fascism in the 1920s and 1930s was a response to economic instability, social unrest, and the aftermath of World War I...',
        'period_ww2_title' => 'World War II',
        'period_ww2_date' => '1939 – 1945',
        'period_ww2_text' => 'A global conflict involving most world powers; caused massive destruction and ended with the defeat of Nazi Germany and Imperial Japan.',
        'period_ww2_details' => 'World War II, from 1939 to 1945, was the deadliest conflict in history, involving over 30 countries and resulting in approximately 70–85 million deaths...',
        'period_cold_war_title' => 'Cold War',
        'period_cold_war_date' => 'c. 1947 – 1991',
        'period_cold_war_text' => 'A period of political and military tension between the United States and the Soviet Union, marked by nuclear arms race and ideological rivalry.',
        'period_cold_war_details' => 'The Cold War, spanning from approximately 1947 to 1991, was a prolonged period of geopolitical tension between the United States and the Soviet Union...',
        'period_civil_rights_title' => 'Civil Rights Movement',
        'period_civil_rights_date' => '1950s – 1960s',
        'period_civil_rights_text' => 'A movement in the U.S. to end racial segregation and secure equal rights for African Americans, led by figures like Martin Luther King Jr.',
        'period_civil_rights_details' => 'The Civil Rights Movement, primarily active in the 1950s and 1960s, was a struggle to end racial segregation and discrimination against African Americans in the United States...',
        'period_space_exploration_title' => 'Space Exploration',
        'period_space_exploration_date' => '1957 – present',
        'period_space_exploration_text' => 'Began with the Soviet launch of Sputnik in 1957; included the U.S. moon landing in 1969 and continues with international space missions.',
        'period_space_exploration_details' => 'Space exploration began in earnest with the Soviet Union launch of Sputnik, the first artificial satellite, on October 4, 1957...',
        'period_computer_revolution_title' => 'Computer Revolution',
        'period_computer_revolution_date' => '1970s – present',
        'period_computer_revolution_text' => 'The rapid advancement of computing technology, from early personal computers to the internet and smartphones.',
        'period_computer_revolution_details' => 'The Computer Revolution, beginning in the 1970s, transformed society through the rapid development of computing technology...',
        'period_cold_war_end_title' => 'End of the Cold War',
        'period_cold_war_end_date' => '1991',
        'period_cold_war_end_text' => 'Marked by the collapse of the Soviet Union, the fall of the Berlin Wall, and the shift toward a unipolar world led by the U.S.',
        'period_cold_war_end_details' => 'The end of the Cold War in 1991 marked the conclusion of decades of tension between the United States and the Soviet Union...',
        'period_y2k_title' => 'Year 2000 (Y2K and Globalization)',
        'period_y2k_date' => '2000',
        'period_y2k_text' => 'The world entered a new millennium; fears of the Y2K bug proved mostly harmless. The internet and globalization rapidly accelerated.',
        'period_y2k_details' => 'The year 2000 marked the dawn of a new millennium, accompanied by widespread concerns about the Y2K bug...',
        'period_financial_crisis_title' => '2008 Financial Crisis',
        'period_financial_crisis_date' => '2008',
        'period_financial_crisis_text' => 'A major global economic recession triggered by the collapse of the U.S. housing market and banking system, causing widespread job loss and financial instability.',
        'period_financial_crisis_details' => 'The 2008 Financial Crisis, often called the Great Recession, began with the collapse of the U.S. housing bubble...',
        'period_social_media_title' => 'Rise of Social Media',
        'period_social_media_date' => '2010s',
        'period_social_media_text' => 'Platforms like Facebook, Twitter, Instagram, and TikTok reshaped communication, politics, and culture around the world.',
        'period_social_media_details' => 'The rise of social media in the 2010s transformed global communication, culture, and politics, driven by platforms like Facebook...',
        'period_covid_pandemic_title' => 'COVID-19 Pandemic',
        'period_covid_pandemic_date' => '2020',
        'period_covid_pandemic_text' => 'A global health crisis caused by the coronavirus, leading to lockdowns, economic disruptions, and over 6 million deaths worldwide.',
        'period_covid_pandemic_details' => 'The COVID-19 pandemic began in late 2019 with the outbreak of a novel coronavirus (SARS-CoV-2) in Wuhan, China...',
        'period_ai_expansion_title' => 'Artificial Intelligence Expansion',
        'period_ai_expansion_date' => '2020s – 2025',
        'period_ai_expansion_text' => 'AI technologies like machine learning and large language models (e.g., ChatGPT) began transforming industries, education, and daily life.',
        'period_ai_expansion_details' => 'The expansion of artificial intelligence (AI) in the 2020s, particularly up to 2025, has reshaped industries, education, and daily life...',
        'period_current_era_title' => 'Year 2025 (Current Era)',
        'period_current_era_date' => '2025',
        'period_current_era_text' => 'Marked by rapid technological advancements, global challenges like climate change, and discussions about the role of AI, ethics, and the future of humanity.',
        'period_current_era_details' => 'The year 2025 represents a pivotal moment in the current era, characterized by rapid technological advancements and pressing global challenges...',
        'gallery_title' => 'World History Gallery',
        'gallery_subtitle' => 'Explore iconic moments and artifacts from world history',
        'image_1_text' => 'Prehistoric Cave Paintings',
        'image_1_desc' => 'Ancient cave art from Lascaux, France, depicting animals and human activities from c. 15,000 BCE.',
        'image_2_text' => 'Pyramids of Giza',
        'image_2_desc' => 'Monumental tombs built for pharaohs in Ancient Egypt, constructed around 2560 BCE.',
        'image_3_text' => 'Greek Parthenon',
        'image_3_desc' => 'A temple on the Acropolis in Athens, dedicated to Athena, built in the 5th century BCE.',
        'image_4_text' => 'Roman Colosseum',
        'image_4_desc' => 'An iconic amphitheater in Rome, completed in 80 CE, used for gladiatorial contests.',
        'image_5_text' => 'Renaissance Art: Sistine Chapel',
        'image_5_desc' => 'Michelangelo masterpiece on the ceiling of the Sistine Chapel, painted between 1508 and 1512.',
        'image_6_text' => 'Age of Exploration: Caravels',
        'image_6_desc' => 'Ships used by explorers like Columbus during the 15th century to cross oceans.',
        'image_7_text' => 'Industrial Revolution: Steam Engine',
        'image_7_desc' => 'A steam engine, pivotal to the Industrial Revolution, introduced by James Watt in the 18th century.',
        'image_8_text' => 'World War I: Trenches',
        'image_8_desc' => 'Soldiers in the trenches of the Western Front during World War I, 1914–1918.',
        'image_9_text' => 'Armistice Day 1918',
        'image_9_desc' => 'Celebrations marking the end of World War I on November 11, 1918.',
        'image_10_text' => 'Treaty of Versailles Signing',
        'image_10_desc' => 'The signing of the Treaty of Versailles in 1919, formally ending World War I.',
        'image_11_text' => 'League of Nations Assembly',
        'image_11_desc' => 'The first assembly of the League of Nations in Geneva, 1920.',
        'image_12_text' => 'Roaring Twenties: Jazz Age',
        'image_12_desc' => 'A jazz band performing in the 1920s, emblematic of the cultural vibrancy of the decade.',
        'image_13_text' => 'Women Suffrage March',
        'image_13_desc' => 'Women marching for voting rights in the U.S., leading to the 19th Amendment in 1920.',
        'image_14_text' => 'Stock Market Crash 1929',
        'image_14_desc' => 'Panic on Wall Street as the stock market crashed in October 1929.',
        'image_15_text' => 'Great Depression: Breadlines',
        'image_15_desc' => 'People lining up for food during the Great Depression in the 1930s.',
        'image_16_text' => 'Rise of Fascism: Nazi Rally',
        'image_16_desc' => 'A Nazi rally in Nuremberg, Germany, during the 1930s under Hitler regime.',
        'image_17_text' => 'World War II: D-Day',
        'image_17_desc' => 'Allied forces landing on the beaches of Normandy on D-Day, June 6, 1944.',
        'image_18_text' => 'Cold War: Berlin Wall',
        'image_18_desc' => 'The Berlin Wall, a symbol of Cold War division, constructed in 1961.',
        'image_19_text' => 'Civil Rights Movement: March on Washington',
        'image_19_desc' => 'The 1963 March on Washington, where Martin Luther King Jr. delivered his "I Have a Dream" speech.',
        'image_20_text' => 'Space Exploration: Moon Landing',
        'image_20_desc' => '1969年7月20日阿波罗11号任务期间，尼尔·阿姆斯特朗在月球上。',
        'image_21_text' => 'Computer Revolution: Early PC',
        'image_21_desc' => '1970年代的早期个人电脑，标志着数字时代的开始。',
        'image_22_text' => 'Berlin Wall Fall',
        'image_22_desc' => 'Citizens dismantling the Berlin Wall in 1989, symbolizing the end of the Cold War.',
        'image_23_text' => 'Y2K Preparations',
        'image_23_desc' => 'Technicians preparing systems for the Y2K transition in 1999.',
        'image_24_text' => '2008 Financial Crisis: Bank Failures',
        'image_24_desc' => 'The collapse of Lehman Brothers in 2008, a key event in the global financial crisis.',
        'image_25_text' => 'Social Media: Smartphone Era',
        'image_25_desc' => 'The rise of social media in the 2010s, driven by widespread smartphone use.',
        'image_26_text' => 'COVID-19 Pandemic: Lockdowns',
        'image_26_desc' => 'Empty streets during global lockdowns in 2020 due to the COVID-19 pandemic.',
        'image_27_text' => 'AI Expansion: Robotics',
        'image_27_desc' => 'Advanced robotics powered by AI, transforming industries in the 2020s.',
        'image_28_text' => '2025: Sustainable Future',
        'image_28_desc' => 'Innovations in renewable energy and sustainability efforts in 2025.',
        'footer_copyright' => '© 2025 History, Art & Fashion. All rights reserved.',
    ]
    ];

// Timeline periods
$periods = [
    'prehistoric', 'ancient_egypt', 'ancient_greece', 'roman_empire', 'renaissance',
    'exploration', 'industrial', 'ww1', 'ww1_end', 'versailles', 'league_nations',
    'roaring_twenties', 'womens_suffrage', 'stock_crash', 'great_depression', 'fascism',
    'ww2', 'cold_war', 'civil_rights', 'space_exploration', 'computer_revolution',
    'cold_war_end', 'y2k', 'financial_crisis', 'social_media', 'covid_pandemic',
    'ai_expansion', 'current_era'
];


// Helper function: Get translation

    function get_translation($lang, $key) {
    global $translations;
    return isset($translations[$lang][$key]) ? $translations[$lang][$key] : '';
}


?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($current_lang); ?>" dir="<?php echo $site_dir; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars(get_translation($current_lang, 'meta_description')); ?>">
    <title>HAF - <?php echo htmlspecialchars(get_translation($current_lang, 'nav_world_history')); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;700&family=Source+Sans+Pro:wght@400;700&family=Libre+Baskerville&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        :root {
            --color-1: #ffd6e8;
            --color-2: #ffeceb;
            --color-3: #fffbf5;
            --color-4: #ebfff0;
            --color-5: #d1f5ff;
            --text-dark: #333333;
            --sepia: #f4ecd8;
            --papaya-whip: #FFEFD5;
            --cornsilk: #FFF8DC;
            --old-lace: #FDF5E6;
            --linen: #FAF0E6;
            --seashell: #FFF5EE;
            --snow: #FFFAFA;
            --floralwhite: #FFFAF0;
            --ivory: #FFFFF0;
            --charcoal: #333333;
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
            background: var(--sepia);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        nav {
            background: var(--papaya-whip) !important;
            padding: 15px 0;
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
            margin: 0 15px;
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 1.1rem;
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
        }

        .hero {
            background: linear-gradient(rgba(244, 236, 216, 0.8), rgba(244, 236, 216, 0.8)), url('<?php echo $placeholder_image; ?>') center/cover no-repeat;
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
            color: var(--text-dark);
        }

        .hero p {
            font-size: 1.5rem;
            margin-bottom: 30px;
        }

        section {
            padding: 60px 0;
            border-bottom: 1px solid var(--color-2);
        }

        section h2 {
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 20px;
            color: var(--color-1);
            font-family: 'Libre Baskerville', serif;
        }

        section p.subtitle {
            text-align: center;
            font-size: 1.2rem;
            margin-bottom: 40px;
            color: #555;
        }

        .timeline {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
        }

        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 4px;
            background: var(--color-4);
            transform: translateX(-50%);
        }

        .timeline-item {
            position: relative;
            margin: 40px 0;
            width: 50%;
        }

        .timeline-item:nth-child(odd) {
            left: 0;
            text-align: right;
            padding-right: 40px;
        }

        .timeline-item:nth-child(even) {
            left: 50%;
            padding-left: 40px;
        }

        .timeline-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 4px;
            margin-bottom: 10px;
            border: 2px solid var(--color-2);
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .timeline-item img:hover {
            transform: scale(1.05);
        }

        .timeline-item h3 {
            font-size: 1.5rem;
            color: var(--color-1);
            margin-bottom: 10px;
            font-family: 'Libre Baskerville', serif;
        }

        .timeline-item .date {
            font-style: italic;
            color: #666;
            margin-bottom: 10px;
        }

        .timeline-item p {
            background: rgba(255, 251, 245, 0.8);
            padding: 10px;
            border-radius: 4px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            top: 20px;
            width: 20px;
            height: 20px;
            background: var(--color-1);
            border-radius: 50%;
            z-index: 1;
        }

        .timeline-item:nth-child(odd)::before {
            right: -10px;
        }

        .timeline-item:nth-child(even)::before {
            left: -10px;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: var(--color-3);
            margin: 10% auto;
            padding: 20px;
            border: 1px solid var(--color-2);
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
            position: relative;
        }

        .modal-content h3 {
            font-size: 1.8rem;
            color: var(--color-1);
            margin-bottom: 10px;
            font-family: 'Libre Baskerville', serif;
        }

        .modal-content .date {
            font-style: italic;
            color: #666;
            margin-bottom: 15px;
        }

        .modal-content p {
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .modal-close {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-dark);
            background: none;
            border: none;
        }

        .modal-close:hover {
            color: var(--color-5);
        }

        /* Gallery Styles */
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px 0;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            cursor: pointer;
        }

        .frame {
            position: relative;
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .painting-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover .painting-img {
            transform: scale(1.1);
        }

        .text-container {
            padding: 10px;
            background: rgba(255, 251, 245, 0.8);
            border-radius: 0 0 8px 8px;
        }

        .text-container .title {
            font-size: 1.2rem;
            color: var(--color-1);
            margin-bottom: 5px;
            font-family: 'Libre Baskerville', serif;
        }

        .text-container .description {
            font-size: 0.9rem;
            color: #666;
        }

        footer {
            background: var(--color-1);
            color: var(--text-dark);
            text-align: center;
            padding: 20px 0;
            margin-top: 40px;
        }

        @media (max-width: 768px) {
            .timeline::before {
                left: 20px;
            }

            .timeline-item {
                width: 100%;
                padding-left: 40px;
                text-align: left;
            }

            .timeline-item:nth-child(odd) {
                padding-right: 0;
            }

            .timeline-item::before {
                left: 10px;
            }

            .timeline-item:nth-child(even)::before {
                left: 10px;
            }

            .gallery-item {
                width: 100%;
            }

            .frame {
                height: 150px;
            }
        }

        .haf-navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #FDF5E6;
            padding: 10px 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.07);
            font-family: 'EB Garamond', 'Arial', serif;
            position: sticky;
            top: 0;
            z-index: 2000;
        }
        .haf-logo-title {
            display: flex;
            align-items: center;
        }
        .haf-logo {
            height: 40px;
            width: auto;
            margin-right: 10px;
        }
        .haf-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #b23a48;
            letter-spacing: 2px;
        }
        .haf-nav-links a {
            color: #333;
            text-decoration: none;
            margin: 0 12px;
            font-size: 1.1rem;
            font-family: 'Source Sans Pro', 'Arial', sans-serif;
            transition: color 0.2s;
            padding-bottom: 2px;
            border-bottom: 2px solid transparent;
        }
        .haf-nav-links a:hover, .haf-nav-links a.active {
            color: #b23a48;
            border-bottom: 2px solid #b23a48;
        }
        body.dark-mode .haf-navbar {
            background: #2c3e50;
        }
        body.dark-mode .haf-title {
            color: #FFFAF0;
        }
        body.dark-mode .haf-nav-links a {
            color: #FFFAFA;
        }
        body.dark-mode .haf-nav-links a:hover, body.dark-mode .haf-nav-links a.active {
            color: #FFFAF0;
            border-bottom: 2px solid #FFFAF0;
        }
        .navbar {
          background-color: var(--papaya-whip); /* 替换成你想要的色 */
        }

        .hero-big-btn {
            font-size: 1.5rem;
            font-weight: 600;
            padding: 16px 48px;
            border-radius: 24px;
            background: var(--papaya-whip);
            color: var(--charcoal);
            border: 2px solid var(--old-lace);
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            transition: all 0.18s cubic-bezier(.4,0,.2,1);
            letter-spacing: 1px;
        }
        .hero-big-btn:hover, .hero-big-btn:focus {
            background: var(--ivory);
            color: var(--charcoal);
            border-color: var(--charcoal);
            box-shadow: 0 6px 24px rgba(0,0,0,0.10);
            transform: translateY(-2px) scale(1.03);
            outline: none;
        }
    </style>
</head>
<body>
    <nav>
        <div class="container">
            <div class="haf-logo-title">
                <a href="history.php">
                    <img src="images/historylogo.png" alt="History Logo" class="haf-logo" style="height:40px;vertical-align:middle;margin-right:10px;">
                </a>
                <span class="haf-title">History Art Fashion</span>
            </div>
            <div class="haf-nav-links">
                <a href="history.php">History</a>
                <a href="#timeline">World History</a>
                <a href="malaysia_history.php">Malaysia History</a>
                <a href="history_game.php">History Game</a>
                <a href="art.php">Art</a>
                <a href="fashion.php">Fashion</a>
                <a href="php/shop.php">Shop</a>
            </div>
            <form method="post">
                <select name="lang" onchange="this.form.submit()">
                    <option value="zh"   <?php if($current_lang=='zh') echo 'selected'; ?>>中文</option>
                    <option value="es"   <?php if($current_lang=='es') echo 'selected'; ?>>Español</option>
                    <option value="ar"   <?php if($current_lang=='ar') echo 'selected'; ?>>العربية</option>
                    <option value="fr"   <?php if($current_lang=='fr') echo 'selected'; ?>>Français</option>
                    <option value="ru"   <?php if($current_lang=='ru') echo 'selected'; ?>>Русский</option>
                    <option value="pt"   <?php if($current_lang=='pt') echo 'selected'; ?>>Português</option>
                    <option value="de"   <?php if($current_lang=='de') echo 'selected'; ?>>Deutsch</option>
                    <option value="ja"   <?php if($current_lang=='ja') echo 'selected'; ?>>日本語</option>
                    <option value="hi"   <?php if($current_lang=='hi') echo 'selected'; ?>>हिन्दी</option>
                    <option value="en"   <?php if($current_lang=='en') echo 'selected'; ?>>English</option>
                </select>
            </form>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <h1 class="animate__animated animate__fadeIn"><?php echo htmlspecialchars(get_translation($current_lang, 'hero_title')); ?></h1>
            <p class="animate__animated animate__fadeIn"><?php echo htmlspecialchars(get_translation($current_lang, 'hero_subtitle')); ?></p>
            <button onclick="location.href='#timeline'" class="btn btn-primary mt-4 animate__animated animate__fadeIn hero-big-btn" data-animate-delay="1s">
                <?php echo htmlspecialchars(get_translation($current_lang, 'nav_world_history')); ?>
            </button>
        </div>
    </section>

    <section id="timeline">
        <div class="container">
            <h2><?php echo htmlspecialchars(get_translation($current_lang, 'timeline_title')); ?></h2>
            <p class="subtitle"><?php echo htmlspecialchars(get_translation($current_lang, 'timeline_subtitle')); ?></p>
            <div class="timeline">
                <?php foreach ($periods as $index => $period): ?>
                    <div class="timeline-item" data-modal="#modal-<?php echo $period; ?>">
                        <img src="images/worldhistory/<?php echo ($index+1); ?>.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'">
                        <h3><?php echo htmlspecialchars(get_translation($current_lang, 'period_' . $period . '_title')); ?></h3>
                        <div class="date"><?php echo htmlspecialchars(get_translation($current_lang, 'period_' . $period . '_date')); ?></div>
                        <p><?php echo htmlspecialchars(get_translation($current_lang, 'period_' . $period . '_text')); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php foreach ($periods as $index => $period): ?>
        <!-- Modal -->
        <div id="modal-<?php echo $period; ?>" class="modal">
            <div class="modal-content">
                <button class="modal-close" onclick="document.getElementById('modal-<?php echo $period; ?>').style.display='none'">
                    <?php echo htmlspecialchars(get_translation($current_lang, 'modal_close')); ?>
                </button>
                <h3><?php echo htmlspecialchars(get_translation($current_lang, 'period_' . $period . '_title')); ?></h3>
                <div class="date"><?php echo htmlspecialchars(get_translation($current_lang, 'period_' . $period . '_date')); ?></div>
                <img src="images/worldhistory/<?php echo ($index+1); ?>.jpg" 
                     onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" 
                     alt="<?php echo htmlspecialchars(get_translation($current_lang, 'period_' . $period . '_title')); ?>" 
                     style="width:100%;border-radius:4px;margin-bottom:15px;">
                <p><?php echo nl2br(htmlspecialchars(get_translation($current_lang, 'period_' . $period . '_details'))); ?></p>
            </div>
        </div>
    <?php endforeach; ?>

    <section id="gallery">
        <div class="container">
            <h2><?php echo htmlspecialchars(get_translation($current_lang, 'gallery_title')); ?></h2>
            <p class="subtitle"><?php echo htmlspecialchars(get_translation($current_lang, 'gallery_subtitle')); ?></p>
            <div class="gallery">
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/1.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="1" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_1_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_1_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/2.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="2" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_2_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_2_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/3.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="3" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_3_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_3_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/4.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="4" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_4_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_4_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/5.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="5" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_5_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_5_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/6.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="6" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_6_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_6_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/7.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="7" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_7_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_7_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/8.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="8" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_8_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_8_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/9.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="9" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_9_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_9_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/10.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="10" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_10_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_10_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/11.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="11" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_11_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_11_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/12.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="12" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_12_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_12_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/13.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="13" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_13_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_13_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/14.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="14" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_14_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_14_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/15.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="15" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_15_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_15_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/16.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="16" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_16_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_16_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/17.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="17" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_17_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_17_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/18.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="18" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_18_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_18_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/19.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="19" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_19_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_19_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/20.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="20" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_20_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_20_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/21.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="21" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_21_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_21_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/22.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="22" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_22_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_22_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/23.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="23" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_23_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_23_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/24.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="24" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_24_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_24_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/25.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="25" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_25_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_25_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/26.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="26" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_26_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_26_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/27.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="27" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_27_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_27_desc')); ?></p>
                    </div>
                </div>
                <div class="gallery-item animate__animated animate__fadeIn">
                    <div class="frame">
                        <img src="images/worldhistory/28.jpg" onerror="this.onerror=null;this.src='<?php echo $placeholder_image; ?>'" data-index="28" class="painting-img">
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo htmlspecialchars(get_translation($current_lang, 'image_28_text')); ?></p>
                        <p class="description"><?php echo htmlspecialchars(get_translation($current_lang, 'image_28_desc')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p><?php echo htmlspecialchars(get_translation($current_lang, 'footer_copyright')); ?></p>
        </div>
    </footer>

    <script>
        // Modal interaction
        document.querySelectorAll('.timeline-item').forEach(item => {
            item.addEventListener('click', () => {
                const modalId = item.getAttribute('data-modal');
                document.querySelector(modalId).style.display = 'block';
            });
        });

        document.querySelectorAll('.modal-close').forEach(button => {
            button.addEventListener('click', () => {
                button.closest('.modal').style.display = 'none';
            });
        });

        window.addEventListener('click', (event) => {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        });
    </script>
</body>
</html>

