<?php // fashion_game.php ?>
<script type="text/javascript">
        var gk_isXlsx = false;
        var gk_xlsxFileLookup = {};
        var gk_fileData = {};
        function filledCell(cell) {
          return cell !== '' && cell != null;
        }
        function loadFileData(filename) {
        if (gk_isXlsx && gk_xlsxFileLookup[filename]) {
            try {
                var workbook = XLSX.read(gk_fileData[filename], { type: 'base64' });
                var firstSheetName = workbook.SheetNames[0];
                var worksheet = workbook.Sheets[firstSheetName];

                // Convert sheet to JSON to filter blank rows
                var jsonData = XLSX.utils.sheet_to_json(worksheet, { header: 1, blankrows: false, defval: '' });
                // Filter out blank rows (rows where all cells are empty, null, or undefined)
                var filteredData = jsonData.filter(row => row.some(filledCell));

                // Heuristic to find the header row by ignoring rows with fewer filled cells than the next row
                var headerRowIndex = filteredData.findIndex((row, index) =>
                  row.filter(filledCell).length >= filteredData[index + 1]?.filter(filledCell).length
                );
                // Fallback
                if (headerRowIndex === -1 || headerRowIndex > 25) {
                  headerRowIndex = 0;
                }

                // Convert filtered JSON back to CSV
                var csv = XLSX.utils.aoa_to_sheet(filteredData.slice(headerRowIndex)); // Create a new sheet from filtered array of arrays
                csv = XLSX.utils.sheet_to_csv(csv, { header: 1 });
                return csv;
            } catch (e) {
                console.error(e);
                return "";
            }
        }
        return gk_fileData[filename] || "";
        }
        </script><!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Matching Game</title>
    <style>
        :root {
            --color-1: #FDF5E6; /* oldlace */
            --color-2: #FAF0E6; /* linen */
            --color-3: #FFF5EE; /* seashell */
            --color-4: #FFFAFA; /* snow */
            --color-5: #FFFAF0; /* floralwhite */
            --color-6: #FFFFF0; /* ivory */
            --text-dark: #333;
            --text-light: #fff;
            --accent: #b23a48;
        }
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            background-color: var(--color-1);
            color: var(--text-dark);
            margin: 0;
            padding: 20px;
            transition: background-color 0.3s, color 0.3s;
        }
        .dark-mode {
            background-color: #2c3e50;
            color: var(--color-4);
        }
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            background: none;
            border-radius: 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
            transition: background 0.3s;
        }
        .dark-mode .main-container {
            background: linear-gradient(to bottom, #3a3a4a, #5a5a6a);
        }
        h1, h2, h3 {
            color: var(--accent);
        }
        .dark-mode h1, .dark-mode h2, .dark-mode h3 {
            color: var(--color-5);
        }
        select, button {
            padding: 12px;
            margin: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid var(--color-2);
            cursor: pointer;
            background-color: var(--color-4);
            color: var(--text-dark);
            transition: background-color 0.3s, color 0.3s, border-color 0.3s;
        }
        select:hover, button:hover {
            background-color: var(--color-5);
            border-color: var(--accent);
        }
        .dark-mode select, .dark-mode button {
            background-color: #444;
            color: var(--color-4);
            border-color: #666;
        }
        .dark-mode select:hover, .dark-mode button:hover {
            background-color: #555;
        }
        .preview, .saved-outfits, .challenge, .progress, .results {
            margin: 20px 0;
            padding: 15px;
            border-radius: 8px;
            background-color: var(--color-3);
        }
        .dark-mode .preview, .dark-mode .saved-outfits, 
        .dark-mode .challenge, .dark-mode .progress, .dark-mode .results {
            background-color: rgba(0, 0, 0, 0.5);
        }
        .section {
            margin: 15px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }
        .color-preview {
            width: 30px;
            height: 30px;
            display: inline-block;
            border: 2px solid var(--color-2);
            border-radius: 50%;
            vertical-align: middle;
            margin-left: 10px;
            transition: background-color 0.3s;
        }
        .dark-mode .color-preview {
            border-color: #666;
        }
        .item-image {
            width: 100px;
            height: 100px;
            display: block;
            border-radius: 5px;
            margin-left: 10px;
            border: 2px solid var(--color-2);
            background-color: var(--color-5);
            transition: border-color 0.3s;
        }
        .item-image:not(.empty) {
            border: 2px solid var(--accent);
        }
        .item-image.empty {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #666;
            background-color: var(--color-6);
        }
        .dark-mode .item-image {
            border-color: #666;
            background-color: #333;
        }
        .dark-mode .item-image.empty {
            color: #aaa;
            background-color: #444;
        }
        .item-label {
            font-size: 12px;
            margin: 5px 0 0 10px;
            text-align: left;
            color: var(--text-dark);
        }
        .dark-mode .item-label {
            color: var(--color-4);
        }
        .score {
            font-weight: bold;
            color: #2e7d32;
        }
        .dark-mode .score {
            color: #66bb6a;
        }
        .clipboard-fallback {
            margin: 10px auto;
            padding: 10px;
            background-color: var(--color-4);
            border: 1px solid var(--color-2);
            border-radius: 5px;
            display: none;
        }
        .dark-mode .clipboard-fallback {
            background-color: #444;
            border-color: #666;
        }
        .clipboard-fallback textarea {
            width: 100%;
            height: 60px;
            font-size: 14px;
        }
        .haf-navbar {
            display: flex;
            align-items: center;
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
            color: var(--accent);
            letter-spacing: 2px;
        }
        .haf-nav-links a {
            color: var(--text-dark);
            text-decoration: none;
            margin: 0 12px;
            font-size: 1.1rem;
            font-family: 'Source Sans Pro', 'Arial', sans-serif;
            transition: color 0.2s;
            padding-bottom: 2px;
            border-bottom: 2px solid transparent;
        }
        .haf-nav-links a:hover, .haf-nav-links a.active {
            color: var(--accent);
            border-bottom: 2px solid var(--accent);
        }
        body.dark-mode .haf-navbar {
            background: #2c3e50;
        }
        body.dark-mode .haf-title {
            color: var(--color-5);
        }
        body.dark-mode .haf-nav-links a {
            color: var(--color-4);
        }
        body.dark-mode .haf-nav-links a:hover, body.dark-mode .haf-nav-links a.active {
            color: var(--color-5);
            border-bottom: 2px solid var(--color-5);
        }
        .nav-container {
            background: none !important;
            border-radius: 0 !important;
            box-shadow: none !important;
            padding: 0 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            flex: 1;
        }
        .nav-container a {
            color: var(--text-dark);
            text-decoration: none;
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 1.1rem;
            padding: 5px 10px;
            transition: color 0.3s ease;
        }
        .nav-container a:hover {
            color: var(--color-5);
        }
        .haf-navbar select, .nav-container select {
            padding: 8px;
            font-family: 'Source Sans Pro', sans-serif;
            background: var(--color-3);
            border: 1px solid var(--color-2);
            border-radius: 4px;
            color: var(--text-dark);
            margin-left: 20px;
        }
        .haf-navbar form {
            margin-left: auto;
        }
    </style>
</head>
<body>
    <!-- HAF Logo 和导航栏 -->
    <nav class="haf-navbar">
        <div class="nav-container">
            <a href="fashion.php"><img src="images/fashionlogo.png" alt="Fashion Logo" style="height: 40px; width: auto;"></a>
            <a href="history.php">History</a>
            <a href="art.php">Art</a>
            <a href="fashion.php">Fashion</a>
            <a href="fashion_show.php">Fashion Shows</a>
            <a href="fashion_brand.php">Fashion Brands</a>
            <a href="fashion_game.php">Fashion Game</a>
            <a href="php/shop.php">Shop</a>
        </div>
        <div style="margin-left: auto;">
            <select id="language-select">
                <option value="zh">中文</option>
                <option value="en">English</option>
                <option value="ms">Bahasa Melayu</option>
            </select>
        </div>
    </nav>

    <div class="main-container">
        <h1 id="title">时尚搭配游戏</h1>
        
        <div class="section">
            <button id="toggle-dark-mode">切换深色模式</button>
            <select id="theme-select">
                <option value="blue-pink">蓝色-粉色</option>
                <option value="green-yellow">绿色-黄色</option>
                <option value="purple-orange">紫色-橙色</option>
            </select>
        </div>

        <div class="preview">
            <h2 id="current-outfit">当前搭配: 未选择</h2>
        </div>

        <div class="section">
            <h3 id="top-label">上衣</h3>
            <select id="top">
                <option value="">请选择</option>
                <option value="casual_shirt">休闲衬衫 (休闲)</option>
                <option value="tshirt">T恤 (休闲)</option>
                <option value="sweater">毛衣 (休闲)</option>
                <option value="hoodie">连帽衫 (休闲)</option>
                <option value="suit_jacket">西装外套 (正式)</option>
                <option value="formal_shirt">正装衬衫 (正式)</option>
            </select>
            <select id="top-color">
                <option value="">选择颜色</option>
                <option value="red">红色</option>
                <option value="blue">蓝色</option>
                <option value="black">黑色</option>
                <option value="white">白色</option>
                <option value="green">绿色</option>
                <option value="yellow">黄色</option>
                <option value="gray">灰色</option>
            </select>
            <span id="top-color-preview" class="color-preview"></span>
            <div>
                <img id="top-image" class="item-image empty" src="" alt="上衣图片">
                <div id="top-label-text" class="item-label"></div>
            </div>
        </div>

        <div class="section">
            <h3 id="bottom-label">裤子/裙子</h3>
            <select id="bottom">
                <option value="">请选择</option>
                <option value="jeans">牛仔裤 (休闲)</option>
                <option value="skirt">短裙 (休闲)</option>
                <option value="sweatpants">运动裤 (休闲)</option>
                <option value="chinos">斜纹裤 (休闲)</option>
                <option value="formal_pants">正装裤 (正式)</option>
                <option value="long_skirt">长裙 (正式)</option>
            </select>
            <select id="bottom-color">
                <option value="">选择颜色</option>
                <option value="red">红色</option>
                <option value="blue">蓝色</option>
                <option value="black">黑色</option>
                <option value="white">白色</option>
                <option value="green">绿色</option>
                <option value="yellow">黄色</option>
                <option value="gray">灰色</option>
            </select>
            <span id="bottom-color-preview" class="color-preview"></span>
            <div>
                <img id="bottom-image" class="item-image empty" src="" alt="裤子/裙子图片">
                <div id="bottom-label-text" class="item-label"></div>
            </div>
        </div>

        <div class="section">
            <h3 id="accessory-label">配饰</h3>
            <select id="accessory">
                <option value="">请选择</option>
                <option value="sneakers">运动鞋 (休闲)</option>
                <option value="hat">时尚帽 (休闲)</option>
                <option value="scarf">围巾 (休闲)</option>
                <option value="sunglasses">太阳镜 (休闲)</option>
                <option value="heels">高跟鞋 (正式)</option>
                <option value="watch">手表 (正式)</option>
            </select>
            <select id="accessory-color">
                <option value="">选择颜色</option>
                <option value="red">红色</option>
                <option value="blue">蓝色</option>
                <option value="black">黑色</option>
                <option value="white">白色</option>
                <option value="green">绿色</option>
                <option value="yellow">黄色</option>
                <option value="gray">灰色</option>
            </select>
            <span id="accessory-color-preview" class="color-preview"></span>
            <div>
                <img id="accessory-image" class="item-image empty" src="" alt="配饰图片">
                <div id="accessory-label-text" class="item-label"></div>
            </div>
        </div>

        <div class="preview">
            <h3 id="preview-label">搭配预览</h3>
            <p id="preview-text">未选择</p>
        </div>

        <div class="challenge">
            <h3 id="daily-challenge">每日挑战</h3>
            <p id="challenge-text">加载中...</p>
        </div>

        <div class="progress">
            <h3 id="progress-label">搭配进度</h3>
            <p id="progress-text"></p>
        </div>

        <div class="saved-outfits">
            <h3 id="saved-outfits-label">已保存的搭配</h3>
            <p id="saved-outfits-text"></p>
        </div>

        <div class="section">
            <button id="submit-outfit">提交搭配</button>
            <button id="random-outfit">随机搭配</button>
            <button id="reset-outfit">重置</button>
            <button id="save-outfit">保存搭配</button>
            <button id="share-outfit">复制分享</button>
        </div>

        <div class="clipboard-fallback" id="clipboard-fallback">
            <p id="fallback-message"></p>
            <textarea id="fallback-text" readonly></textarea>
        </div>

        <div class="results">
            <h3 id="results-label">搭配结果</h3>
            <p id="results-text"></p>
            <p id="score-text"></p>
        </div>
    </div>

    <script>
        // Translation object
        const translations = {
            zh: {
                title: "时尚搭配游戏",
                toggleDarkMode: "切换深色模式",
                themeSelect: "选择主题",
                themeOptions: ["蓝色-粉色", "绿色-黄色", "紫色-橙色"],
                currentOutfit: "当前搭配: 未选择",
                topLabel: "上衣",
                bottomLabel: "裤子/裙子",
                accessoryLabel: "配饰",
                selectPlaceholder: "请选择",
                colorPlaceholder: "选择颜色",
                topOptions: [
                    "休闲衬衫 (休闲)", "T恤 (休闲)", "毛衣 (休闲)", 
                    "连帽衫 (休闲)", "西装外套 (正式)", "正装衬衫 (正式)"
                ],
                bottomOptions: [
                    "牛仔裤 (休闲)", "短裙 (休闲)", "运动裤 (休闲)", 
                    "斜纹裤 (休闲)", "正装裤 (正式)", "长裙 (正式)"
                ],
                accessoryOptions: [
                    "运动鞋 (休闲)", "时尚帽 (休闲)", "围巾 (休闲)", 
                    "太阳镜 (休闲)", "高跟鞋 (正式)", "手表 (正式)"
                ],
                colorOptions: [
                    "红色", "蓝色", "黑色", "白色", "绿色", "黄色", "灰色"
                ],
                previewLabel: "搭配预览",
                previewText: "未选择",
                dailyChallenge: "每日挑战",
                challengeText: "加载中...",
                progressLabel: "搭配进度",
                savedOutfitsLabel: "已保存的搭配",
                submitOutfit: "提交搭配",
                randomOutfit: "随机搭配",
                resetOutfit: "重置",
                saveOutfit: "保存搭配",
                shareOutfit: "复制分享",
                resultsLabel: "搭配结果",
                scoreLabel: "搭配得分",
                scorePerfect: "完美搭配！风格和颜色非常协调！",
                scoreGood: "不错的搭配！试试更统一的风格或颜色。",
                scoreAverage: "搭配可以，但风格或颜色需要更协调。",
                scorePoor: "搭配需要改进，尝试匹配风格和颜色。",
                scoreIncomplete: "请完成所有选择以获得评分！",
                imageEmpty: "未选择",
                imageFailed: "图片加载失败，请检查选择或刷新页面。",
                shareEmpty: "请先选择一套搭配再分享！",
                shareFailed: "无法复制到剪贴板，请手动复制以下文本或检查浏览器权限。",
                shareSecureContext: "复制功能需要安全环境。请通过 localhost 或 HTTPS 运行此页面（例如，使用本地服务器）。",
                shareSuccess: "搭配已复制到剪贴板："
            },
            en: {
                title: "Fashion Matching Game",
                toggleDarkMode: "Toggle Dark Mode",
                themeSelect: "Select Theme",
                themeOptions: ["Blue-Pink", "Green-Yellow", "Purple-Orange"],
                currentOutfit: "Current Outfit: None Selected",
                topLabel: "Top",
                bottomLabel: "Pants/Skirt",
                accessoryLabel: "Accessories",
                selectPlaceholder: "Please Select",
                colorPlaceholder: "Select Color",
                topOptions: [
                    "Casual Shirt (Casual)", "T-Shirt (Casual)", "Sweater (Casual)", 
                    "Hoodie (Casual)", "Suit Jacket (Formal)", "Dress Shirt (Formal)"
                ],
                bottomOptions: [
                    "Jeans (Casual)", "Short Skirt (Casual)", "Sweatpants (Casual)", 
                    "Chinos (Casual)", "Dress Pants (Formal)", "Long Skirt (Formal)"
                ],
                accessoryOptions: [
                    "Sneakers (Casual)", "Fashion Hat (Casual)", "Scarf (Casual)", 
                    "Sunglasses (Casual)", "High Heels (Formal)", "Watch (Formal)"
                ],
                colorOptions: [
                    "Red", "Blue", "Black", "White", "Green", "Yellow", "Gray"
                ],
                previewLabel: "Outfit Preview",
                previewText: "None Selected",
                dailyChallenge: "Daily Challenge",
                challengeText: "Loading...",
                progressLabel: "Outfit Progress",
                savedOutfitsLabel: "Saved Outfits",
                submitOutfit: "Submit Outfit",
                randomOutfit: "Random Outfit",
                resetOutfit: "Reset",
                saveOutfit: "Save Outfit",
                shareOutfit: "Copy Share Link",
                resultsLabel: "Outfit Results",
                scoreLabel: "Outfit Score",
                scorePerfect: "Perfect match! Style and colors are highly coordinated!",
                scoreGood: "Nice outfit! Try a more unified style or color scheme.",
                scoreAverage: "Decent outfit, but style or colors could be more coordinated.",
                scorePoor: "Outfit needs improvement, try matching style and colors.",
                scoreIncomplete: "Please complete all selections to get a score!",
                imageEmpty: "Not Selected",
                imageFailed: "Image failed to load, please check selection or refresh the page.",
                shareEmpty: "Please select an outfit before sharing!",
                shareFailed: "Failed to copy to clipboard. Please copy the text below manually or check browser permissions.",
                shareSecureContext: "Clipboard functionality requires a secure context. Please run this page via localhost or HTTPS (e.g., using a local server).",
                shareSuccess: "Outfit copied to clipboard:"
            },
            ms: {
                title: "Permainan Padanan Fesyen",
                toggleDarkMode: "Togol Mod Gelap",
                themeSelect: "Pilih Tema",
                themeOptions: ["Biru-Pink", "Hijau-Kuning", "Ungu-Jingga"],
                currentOutfit: "Padanan Semasa: Tiada Dipilih",
                topLabel: "Baju Atas",
                bottomLabel: "Seluar/Skirt",
                accessoryLabel: "Aksesori",
                selectPlaceholder: "Sila Pilih",
                colorPlaceholder: "Pilih Warna",
                topOptions: [
                    "Baju Kasual (Kasual)", "T-Shirt (Kasual)", "Sweater (Kasual)", 
                    "Hoodie (Kasual)", "Jaket Sut (Formal)", "Baju Kemeja Formal (Formal)"
                ],
                bottomOptions: [
                    "Jeans (Kasual)", "Skirt Pendek (Kasual)", "Seluar Sukan (Kasual)", 
                    "Seluar Chino (Kasual)", "Seluar Formal (Formal)", "Skirt Panjang (Formal)"
                ],
                accessoryOptions: [
                    "Kasut Sukan (Kasual)", "Topi Fesyen (Kasual)", "Skaf (Kasual)", 
                    "Cermin Mata Hitam (Kasual)", "Kasut Tumit Tinggi (Formal)", "Jam Tangan (Formal)"
                ],
                colorOptions: [
                    "Merah", "Biru", "Hitam", "Putih", "Hijau", "Kuning", "Kelabu"
                ],
                previewLabel: "Pratonton Padanan",
                previewText: "Tiada Dipilih",
                dailyChallenge: "Cabaran Harian",
                challengeText: "Sedang Memuat...",
                progressLabel: "Kemajuan Padanan",
                savedOutfitsLabel: "Padanan yang Disimpan",
                submitOutfit: "Hantar Padanan",
                randomOutfit: "Padanan Rawak",
                resetOutfit: "Set Semula",
                saveOutfit: "Simpan Padanan",
                shareOutfit: "Salin Pautan Kongsi",
                resultsLabel: "Keputusan Padanan",
                scoreLabel: "Skor Padanan",
                scorePerfect: "Padanan sempurna! Gaya dan warna sangat serasi!",
                scoreGood: "Padanan yang bagus! Cubalah gaya atau warna yang lebih seragam.",
                scoreAverage: "Padanan yang boleh tahan, tetapi gaya atau warna perlu lebih serasi.",
                scorePoor: "Padanan perlu diperbaiki, cuba padankan gaya dan warna.",
                scoreIncomplete: "Sila lengkapkan semua pilihan untuk mendapat skor!",
                imageEmpty: "Tiada Dipilih",
                imageFailed: "Imej gagal dimuat, sila periksa pilihan atau muat semula halaman.",
                shareEmpty: "Sila pilih padanan sebelum berkongsi!",
                shareFailed: "Gagal menyalin ke papan klip. Sila salin teks di bawah secara manual atau semak kebenaran pelayar.",
                shareSecureContext: "Fungsi papan klip memerlukan konteks selamat. Sila jalankan halaman ini melalui localhost atau HTTPS (contohnya, menggunakan pelayan tempatan).",
                shareSuccess: "Padanan disalin ke papan klip:"
            }
        };

        // Theme mapping for container background
        const themes = {
            'blue-pink': {
                light: 'linear-gradient(to bottom, #a1c4fd, #c2e9fb)',
                dark: 'linear-gradient(to bottom, #2c3e50, #4a69bd)'
            },
            'green-yellow': {
                light: 'linear-gradient(to bottom, #a8e063, #f4d03f)',
                dark: 'linear-gradient(to bottom, #2f4f4f, #6b8e23)'
            },
            'purple-orange': {
                light: 'linear-gradient(to bottom, #d3adf7, #ff9a9e)',
                dark: 'linear-gradient(to bottom, #4b0082, #8b4513)'
            }
        };

        // Color mapping for SVG fill
        const colorMap = {
            red: '#FF0000',
            blue: '#0000FF',
            black: '#000000',
            white: '#FFFFFF',
            green: '#008000',
            yellow: '#FFFF00',
            gray: '#808080',
            default: '#CCCCCC' // Fallback color
        };

        // Image mapping with highly distinct SVG templates
        const imageMap = {
            top: {
                casual_shirt: `<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path d="M20 30L30 20H70L80 30H70V70H30V30H20Z" fill="{COLOR}"/><path d="M40 20V30H60V20H40Z" fill="#000000"/> <!-- Buttoned collar --><path d="M45 35H55V40H45Z" fill="#000000"/> <!-- Buttons --></svg>`,
                tshirt: `<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path d="M25 25L35 15H65L75 25H70V65H30V25H25Z" fill="{COLOR}"/><path d="M45 15V20H55V15H45Z" fill="#000000"/> <!-- Crew neck --></svg>`,
                sweater: `<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path d="M25 30L35 20H65L75 30H70V70H30V30H25Z" fill="{COLOR}"/><path d="M40 20V35H60V20H40Z" fill="#000000"/> <!-- Turtleneck --><path d="M30 40H70V45H30Z" fill="#000000"/> <!-- Ribbing --></svg>`,
                hoodie: `<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path d="M25 30L35 20H65L75 30H70V70H30V30H25Z" fill="{COLOR}"/><path d="M35 20V10H65V20H35Z" fill="{COLOR}"/> <!-- Hood --><path d="M45 20H55V25H45Z" fill="#000000"/> <!-- Drawstring --></svg>`,
                suit_jacket: `<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path d="M20 30L30 20H70L80 30H70V65H55V70H45V65H30V30H20Z" fill="{COLOR}"/><path d="M35 20L40 30H60L65 20H35Z" fill="#000000"/> <!-- Lapels --><path d="M45 35H55V40H45Z" fill="#000000"/> <!-- Button --></svg>`,
                formal_shirt: `<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path d="M20 30L30 20H70L80 30H70V70H30V30H20Z" fill="{COLOR}"/><path d="M40 20V25H60V20H40Z" fill="#000000"/> <!-- Collar --><path d="M45 35H55V60H45Z" fill="#000000"/> <!-- Buttons --></svg>`
            },
            bottom: {
                jeans: `<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path d="M35 20H65L60 80H40L35 20Z" fill="{COLOR}"/><rect x="45" y="25" width="10" height="10" fill="#000000"/> <!-- Pocket --><path d="M50 35V75" stroke="#FFFF00" stroke-width="2"/> <!-- Stitching --></svg>`,
                skirt: `<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path d="M30 20H70L60 50H40L30 20Z" fill="{COLOR}"/><path d="M40 20H60V25H40Z" fill="#000000"/> <!-- Waistband --><path d="M45 30H55V35H45Z" fill="#000000"/> <!-- Pleat --></svg>`,
                sweatpants: `<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path d="M35 20H65L60 80H40L35 20Z" fill="{COLOR}"/><rect x="45" y="20" width="10" height="5" fill="#000000"/> <!-- Drawstring --><path d="M35 75H65V80H35Z" fill="#000000"/> <!-- Cuff --></svg>`,
                chinos: `<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path d="M35 20H65L60 80H40L35 20Z" fill="{COLOR}"/><rect x="45" y="25" width="10" height="10" fill="#000000"/> <!-- Pocket --><path d="M40 20H60V25H40Z" fill="#000000"/> <!-- Waistband --></svg>`,
                formal_pants: `<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path d="M35 20H65L60 80H40L35 20Z" fill="{COLOR}"/><path d="M50 25V75" stroke="#000000" stroke-width="2"/> <!-- Crease --><path d="M40 20H60V25H40Z" fill="#000000"/> <!-- Waistband --></svg>`,
                long_skirt: `<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path d="M30 20H70L60 80H40L30 20Z" fill="{COLOR}"/><path d="M40 20H60V25H40Z" fill="#000000"/> <!-- Waistband --><path d="M50 30V70" stroke="#000000" stroke-width="2"/> <!-- Seam --></svg>`
            },
            accessory: {
                sneakers: `<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path d="M20 60H60C65 60 70 55 70 50C70 45 65 40 60 40H20C15 40 10 45 10 50C10 55 15 60 20 60Z" fill="{COLOR}"/><path d="M30 50H50" stroke="#000000" stroke-width="2"/> <!-- Laces --><path d="M60 50H65V55H60Z" fill="#000000"/> <!-- Sole --></svg>`,
                hat: `<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path d="M20 30H80C82 30 84 32 84 35C84 40 70 40 70 40H30C30 40 16 40 16 35C16 32 18 30 20 30Z" fill="{COLOR}"/><rect x="40" y="25" width="20" height="5" fill="#000000"/> <!-- Band --><circle cx="50" cy="30" r="5" fill="#000000"/> <!-- Logo --></svg>`,
                scarf: `<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path d="M20 30H80L70 60H30L20 30Z" fill="{COLOR}"/><path d="M30 60L25 65H75L70 60H30Z" fill="{COLOR}"/> <!-- Fringe --><path d="M45 35H55V40H45Z" fill="#000000"/> <!-- Pattern --></svg>`,
                sunglasses: `<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><rect x="20" y="40" width="30" height="20" rx="5" fill="{COLOR}"/><rect x="50" y="40" width="30" height="20" rx="5" fill="{COLOR}"/><path d="M45 50H55" stroke="#000000" stroke-width="2"/> <!-- Bridge --><path d="M15 45H20" stroke="#000000" stroke-width="2"/> <!-- Temple --></svg>`,
                heels: `<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path d="M20 60H50C55 60 60 55 60 50C60 45 55 40 50 40H20C15 40 10 45 10 50C10 55 15 60 20 60Z" fill="{COLOR}"/><rect x="50" y="50" width="5" height="20" fill="{COLOR}"/> <!-- Heel --><path d="M20 40H30V45H20Z" fill="#000000"/> <!-- Strap --></svg>`,
                watch: `<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="20" fill="{COLOR}"/><path d="M50 40V50H60" stroke="#000000" stroke-width="2"/> <!-- Hands --><rect x="45" y="30" width="10" height="5" fill="#000000"/> <!-- Strap --></svg>`
            }
        };

        // Function to calculate outfit score
        function calculateScore(top, bottom, accessory, topColor, bottomColor, accessoryColor) {
            const lang = document.getElementById('language-select').value;
            const t = translations[lang];

            if (!top || !bottom || !accessory || !topColor || !bottomColor || !accessoryColor) {
                return { score: 0, feedback: t.scoreIncomplete };
            }

            const casualItems = ['casual_shirt', 'tshirt', 'sweater', 'hoodie', 'jeans', 'skirt', 'sweatpants', 'chinos', 'sneakers', 'hat', 'scarf', 'sunglasses'];
            const formalItems = ['suit_jacket', 'formal_shirt', 'formal_pants', 'long_skirt', 'heels', 'watch'];
            const topStyle = casualItems.includes(top) ? 'casual' : 'formal';
            const bottomStyle = casualItems.includes(bottom) ? 'casual' : 'formal';
            const accessoryStyle = casualItems.includes(accessory) ? 'casual' : 'formal';
            
            let styleScore = 0;
            if (topStyle === bottomStyle && bottomStyle === accessoryStyle) {
                styleScore = 60;
            } else if (topStyle === bottomStyle || bottomStyle === accessoryStyle || topStyle === accessoryStyle) {
                styleScore = 30;
            }

            const warmColors = ['red', 'yellow', 'green'];
            const coolColors = ['blue', 'black', 'white', 'gray'];
            const topColorType = warmColors.includes(topColor) ? 'warm' : 'cool';
            const bottomColorType = warmColors.includes(bottomColor) ? 'warm' : 'cool';
            const accessoryColorType = warmColors.includes(accessoryColor) ? 'warm' : 'cool';
            
            let colorScore = 0;
            if (topColorType === bottomColorType && bottomColorType === accessoryColorType) {
                colorScore = 40;
            } else if (topColorType === bottomColorType || bottomColorType === accessoryColorType || topColorType === accessoryColorType) {
                colorScore = 20;
            }

            const totalScore = styleScore + colorScore;
            let feedback = '';
            if (totalScore >= 80) {
                feedback = t.scorePerfect;
            } else if (totalScore >= 60) {
                feedback = t.scoreGood;
            } else if (totalScore >= 40) {
                feedback = t.scoreAverage;
            } else {
                feedback = t.scorePoor;
            }

            return { score: totalScore, feedback };
        }

        // Function to update page content based on selected language
        function updateLanguage(lang) {
            const t = translations[lang];
            document.getElementById('title').textContent = t.title;
            document.getElementById('toggle-dark-mode').textContent = t.toggleDarkMode;
            document.getElementById('theme-select').options[0].textContent = t.themeOptions[0];
            document.getElementById('theme-select').options[1].textContent = t.themeOptions[1];
            document.getElementById('theme-select').options[2].textContent = t.themeOptions[2];
            document.getElementById('current-outfit').textContent = t.currentOutfit;
            document.getElementById('top-label').textContent = t.topLabel;
            document.getElementById('bottom-label').textContent = t.bottomLabel;
            document.getElementById('accessory-label').textContent = t.accessoryLabel;
            document.getElementById('preview-label').textContent = t.previewLabel;
            document.getElementById('preview-text').textContent = t.previewText;
            document.getElementById('daily-challenge').textContent = t.dailyChallenge;
            document.getElementById('challenge-text').textContent = t.challengeText;
            document.getElementById('progress-label').textContent = t.progressLabel;
            document.getElementById('saved-outfits-label').textContent = t.savedOutfitsLabel;
            document.getElementById('submit-outfit').textContent = t.submitOutfit;
            document.getElementById('random-outfit').textContent = t.randomOutfit;
            document.getElementById('reset-outfit').textContent = t.resetOutfit;
            document.getElementById('save-outfit').textContent = t.saveOutfit;
            document.getElementById('share-outfit').textContent = t.shareOutfit;
            document.getElementById('results-label').textContent = t.resultsLabel;

            document.querySelectorAll('select option[value=""]').forEach(opt => {
                opt.textContent = t.selectPlaceholder;
            });
            document.querySelectorAll('#top-color, #bottom-color, #accessory-color').forEach(select => {
                select.options[0].textContent = t.colorPlaceholder;
            });

            const topSelect = document.getElementById('top');
            const topValues = Array.from(topSelect.options).map(opt => opt.value);
            topSelect.innerHTML = `<option value="">${t.selectPlaceholder}</option>`;
            t.topOptions.forEach((text, index) => {
                const option = document.createElement('option');
                option.value = topValues[index + 1] || `top_${index}`;
                option.textContent = text;
                topSelect.appendChild(option);
            });

            const bottomSelect = document.getElementById('bottom');
            const bottomValues = Array.from(bottomSelect.options).map(opt => opt.value);
            bottomSelect.innerHTML = `<option value="">${t.selectPlaceholder}</option>`;
            t.bottomOptions.forEach((text, index) => {
                const option = document.createElement('option');
                option.value = bottomValues[index + 1] || `bottom_${index}`;
                option.textContent = text;
                bottomSelect.appendChild(option);
            });

            const accessorySelect = document.getElementById('accessory');
            const accessoryValues = Array.from(accessorySelect.options).map(opt => opt.value);
            accessorySelect.innerHTML = `<option value="">${t.selectPlaceholder}</option>`;
            t.accessoryOptions.forEach((text, index) => {
                const option = document.createElement('option');
                option.value = accessoryValues[index + 1] || `accessory_${index}`;
                option.textContent = text;
                accessorySelect.appendChild(option);
            });

            const colorSelects = ['top-color', 'bottom-color', 'accessory-color'];
            const colorValues = ['red', 'blue', 'black', 'white', 'green', 'yellow', 'gray'];
            colorSelects.forEach(selectId => {
                const select = document.getElementById(selectId);
                const currentValue = select.value;
                select.innerHTML = `<option value="">${t.colorPlaceholder}</option>`;
                t.colorOptions.forEach((text, index) => {
                    const option = document.createElement('option');
                    option.value = colorValues[index];
                    option.textContent = text;
                    select.appendChild(option);
                });
                select.value = currentValue;
            });

            updateScoreDisplay();
            updatePreview();
        }

        // Function to update score display
        function updateScoreDisplay() {
            const lang = document.getElementById('language-select').value;
            const t = translations[lang];
            const { score, feedback } = calculateScore(
                document.getElementById('top').value,
                document.getElementById('bottom').value,
                document.getElementById('accessory').value,
                document.getElementById('top-color').value,
                document.getElementById('bottom-color').value,
                document.getElementById('accessory-color').value
            );
            const scoreText = document.getElementById('score-text');
            scoreText.innerHTML = score > 0 ? 
                `${t.scoreLabel}: <span class="score">${score}/100</span> - ${feedback}` : 
                feedback;
        }

        // Function to update theme
        function updateTheme(theme) {
            const mainContainer = document.querySelector('.main-container');
            const isDarkMode = document.body.classList.contains('dark-mode');
            const themeStyle = themes[theme][isDarkMode ? 'dark' : 'light'];
            if (mainContainer) mainContainer.style.background = themeStyle;
        }

        // Language switcher event listener
        document.getElementById('language-select').addEventListener('change', (e) => {
            updateLanguage(e.target.value);
            document.documentElement.lang = e.target.value;
        });

        // Theme switcher event listener
        document.getElementById('theme-select').addEventListener('change', (e) => {
            updateTheme(e.target.value);
        });

        // Dark mode toggle
        document.getElementById('toggle-dark-mode').addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            updateTheme(document.getElementById('theme-select').value);
        });

        // Outfit selection logic
        const topSelect = document.getElementById('top');
        const bottomSelect = document.getElementById('bottom');
        const accessorySelect = document.getElementById('accessory');
        const topColorSelect = document.getElementById('top-color');
        const bottomColorSelect = document.getElementById('bottom-color');
        const accessoryColorSelect = document.getElementById('accessory-color');
        const previewText = document.getElementById('preview-text');
        const currentOutfit = document.getElementById('current-outfit');
        const topColorPreview = document.getElementById('top-color-preview');
        const bottomColorPreview = document.getElementById('bottom-color-preview');
        const accessoryColorPreview = document.getElementById('accessory-color-preview');
        const topImage = document.getElementById('top-image');
        const bottomImage = document.getElementById('bottom-image');
        const accessoryImage = document.getElementById('accessory-image');
        const topLabelText = document.getElementById('top-label-text');
        const bottomLabelText = document.getElementById('bottom-label-text');
        const accessoryLabelText = document.getElementById('accessory-label-text');
        const clipboardFallback = document.getElementById('clipboard-fallback');
        const fallbackText = document.getElementById('fallback-text');
        const fallbackMessage = document.getElementById('fallback-message');
        let savedOutfits = [];

        function updatePreview() {
            console.log('updatePreview called at', new Date().toISOString());
            const lang = document.getElementById('language-select').value;
            const t = translations[lang];
            const top = topSelect.options[topSelect.selectedIndex]?.text || t.selectPlaceholder;
            const bottom = bottomSelect.options[bottomSelect.selectedIndex]?.text || t.selectPlaceholder;
            const accessory = accessorySelect.options[accessorySelect.selectedIndex]?.text || t.selectPlaceholder;
            const topColor = topColorSelect.value ? t.colorOptions[['red', 'blue', 'black', 'white', 'green', 'yellow', 'gray'].indexOf(topColorSelect.value)] : t.colorPlaceholder;
            const bottomColor = bottomColorSelect.value ? t.colorOptions[['red', 'blue', 'black', 'white', 'green', 'yellow', 'gray'].indexOf(bottomColorSelect.value)] : t.colorPlaceholder;
            const accessoryColor = accessoryColorSelect.value ? t.colorOptions[['red', 'blue', 'black', 'white', 'green', 'yellow', 'gray'].indexOf(accessoryColorSelect.value)] : t.colorPlaceholder;
            
            const outfitText = `${top} (${topColor}), ${bottom} (${bottomColor}), ${accessory} (${accessoryColor})`;
            console.log('Outfit text:', outfitText);
            previewText.textContent = outfitText || t.previewText;
            currentOutfit.textContent = `${t.currentOutfit.split(': ')[0]}: ${outfitText || t.previewText}`;

            topColorPreview.style.backgroundColor = topColorSelect.value || 'transparent';
            bottomColorPreview.style.backgroundColor = bottomColorSelect.value || 'transparent';
            accessoryColorPreview.style.backgroundColor = accessoryColorSelect.value || 'transparent';

            // Update images and labels
            [
                { img: topImage, value: topSelect.value, color: topColorSelect.value, map: imageMap.top, label: topLabelText, text: top, name: 'top' },
                { img: bottomImage, value: bottomSelect.value, color: bottomColorSelect.value, map: imageMap.bottom, label: bottomLabelText, text: bottom, name: 'bottom' },
                { img: accessoryImage, value: accessorySelect.value, color: accessoryColorSelect.value, map: imageMap.accessory, label: accessoryLabelText, text: accessory, name: 'accessory' }
            ].forEach(({ img, value, color, map, label, text, name }) => {
                console.log(`Processing ${name}: value=${value}, color=${color}, text=${text}, map_exists=${!!map[value]}, color_exists=${!!colorMap[color] || color === ''}`);
                if (value && map[value]) {
                    const selectedColor = color && colorMap[color] ? colorMap[color] : colorMap.default;
                    console.log(`${name} using color: ${selectedColor} (selected: ${color || 'none'})`);
                    const svgContent = map[value].replace(/{COLOR}/g, selectedColor);
                    console.log(`${name} SVG content (first 100 chars): ${svgContent.substring(0, 100)}...`);
                    const base64Svg = `data:image/svg+xml;base64,${btoa(unescape(encodeURIComponent(svgContent)))}`;
                    console.log(`Setting ${name} image: src=base64_svg, alt=${text}, color=${selectedColor}`);
                    img.classList.remove('empty');
                    img.src = base64Svg;
                    img.alt = text;
                    img.innerHTML = '';
                    label.textContent = text;
                    console.log(`${name} image set: src=${img.src.substring(0, 50)}..., classes=${img.className}`);
                    img.onload = () => console.log(`${name} image loaded successfully at ${new Date().toISOString()}`);
                    img.onerror = () => {
                        console.error(`${name} image failed to load: src=${img.src.substring(0, 50)}..., value=${value}, color=${color}, selectedColor=${selectedColor}`);
                        alert(`${t.imageFailed} (${name}: ${text}, color: ${color || 'default'})`);
                    };
                } else {
                    console.log(`Clearing ${name} image: value=${value}, reason=${!value ? 'no item selected' : 'invalid map entry'}`);
                    img.classList.add('empty');
                    img.src = '';
                    img.alt = t.imageEmpty;
                    img.innerHTML = t.imageEmpty;
                    label.textContent = '';
                    console.log(`${name} image cleared: src=${img.src}, classes=${img.className}`);
                }
            });
        }

        topSelect.addEventListener('change', () => {
            console.log('topSelect changed:', topSelect.value);
            updatePreview();
        });
        bottomSelect.addEventListener('change', () => {
            console.log('bottomSelect changed:', bottomSelect.value);
            updatePreview();
        });
        accessorySelect.addEventListener('change', () => {
            console.log('accessorySelect changed:', accessorySelect.value);
            updatePreview();
        });
        topColorSelect.addEventListener('change', () => {
            console.log('topColorSelect changed:', topColorSelect.value);
            updatePreview();
        });
        bottomColorSelect.addEventListener('change', () => {
            console.log('bottomColorSelect changed:', bottomColorSelect.value);
            updatePreview();
        });
        accessoryColorSelect.addEventListener('change', () => {
            console.log('accessoryColorSelect changed:', accessoryColorSelect.value);
            updatePreview();
        });

        // Button functionalities
        document.getElementById('submit-outfit').addEventListener('click', () => {
            console.log('Submit outfit clicked');
            const result = previewText.textContent;
            document.getElementById('results-text').textContent = result;
            updateScoreDisplay();
        });

        document.getElementById('random-outfit').addEventListener('click', () => {
            console.log('Random outfit clicked');
            const topOptions = Array.from(topSelect.options).slice(1);
            const bottomOptions = Array.from(bottomSelect.options).slice(1);
            const accessoryOptions = Array.from(accessorySelect.options).slice(1);
            const colorOptions = Array.from(topColorSelect.options).slice(1).map(opt => opt.value);
            topSelect.selectedIndex = Math.floor(Math.random() * topOptions.length) + 1;
            bottomSelect.selectedIndex = Math.floor(Math.random() * bottomOptions.length) + 1;
            accessorySelect.selectedIndex = Math.floor(Math.random() * accessoryOptions.length) + 1;
            topColorSelect.selectedIndex = Math.floor(Math.random() * colorOptions.length) + 1;
            bottomColorSelect.selectedIndex = Math.floor(Math.random() * colorOptions.length) + 1;
            accessoryColorSelect.selectedIndex = Math.floor(Math.random() * colorOptions.length) + 1;
            console.log('Random selections:', {
                top: topSelect.value,
                bottom: bottomSelect.value,
                accessory: accessorySelect.value,
                topColor: topColorSelect.value,
                bottomColor: bottomColorSelect.value,
                accessoryColor: accessoryColorSelect.value
            });
            updatePreview();
        });

        document.getElementById('reset-outfit').addEventListener('click', () => {
            console.log('Reset outfit clicked');
            topSelect.selectedIndex = 0;
            bottomSelect.selectedIndex = 0;
            accessorySelect.selectedIndex = 0;
            topColorSelect.selectedIndex = 0;
            bottomColorSelect.selectedIndex = 0;
            accessoryColorSelect.selectedIndex = 0;
            updatePreview();
            document.getElementById('results-text').textContent = '';
            document.getElementById('score-text').textContent = '';
            clipboardFallback.style.display = 'none';
        });

        document.getElementById('save-outfit').addEventListener('click', () => {
            console.log('Save outfit clicked');
            const lang = document.getElementById('language-select').value;
            const t = translations[lang];
            const outfit = previewText.textContent;
            if (outfit && outfit !== t.previewText) {
                savedOutfits.push(outfit);
                document.getElementById('saved-outfits-text').textContent = savedOutfits.join('; ');
            } else {
                alert(t.shareEmpty);
            }
        });

        document.getElementById('share-outfit').addEventListener('click', () => {
            console.log('Share outfit clicked at', new Date().toISOString());
            const lang = document.getElementById('language-select').value;
            const t = translations[lang];
            const outfit = previewText.textContent;
            console.log('Outfit to share:', outfit, 'isDefault:', outfit === t.previewText);

            if (outfit && outfit !== t.previewText) {
                if (!window.isSecureContext) {
                    console.warn('Non-secure context detected:', window.location.protocol);
                    alert(t.shareSecureContext);
                    showClipboardFallback(outfit, t);
                    return;
                }

                console.log('Checking clipboard-write permission');
                if (navigator.permissions && navigator.permissions.query) {
                    navigator.permissions.query({ name: 'clipboard-write' }).then(permission => {
                        console.log('Clipboard-write permission:', permission.state);
                        if (permission.state === 'denied') {
                            console.warn('Clipboard permission denied');
                            alert(t.shareFailed);
                            showClipboardFallback(outfit, t);
                            return;
                        }
                        writeToClipboard(outfit, t);
                    }).catch(err => {
                        console.warn('Permission query failed:', err);
                        writeToClipboard(outfit, t); // Try anyway
                    });
                } else {
                    console.log('Permission API not supported, attempting clipboard write');
                    writeToClipboard(outfit, t);
                }
            } else {
                console.log('No valid outfit to share, previewText:', outfit);
                alert(t.shareEmpty);
            }
        });

        function writeToClipboard(outfit, t) {
            console.log('Attempting to copy outfit:', outfit);
            navigator.clipboard.write(outfit).then(() => {
                console.log('Outfit copied to clipboard:', outfit);
                alert(`${t.shareSuccess} ${outfit}`);
                clipboardFallback.style.display = 'none';
            }).catch(err => {
                console.error('Clipboard write failed:', err.message || err);
                alert(t.shareFailed);
                showClipboardFallback(outfit, t);
            });
        }

        function showClipboardFallback(outfit, t) {
            console.log('Showing clipboard fallback for outfit:', outfit);
            fallbackMessage.textContent = t.shareFailed;
            fallbackText.value = outfit;
            clipboardFallback.style.display = 'block';
            fallbackText.focus();
            fallbackText.select();
        }

        // Initialize language and theme
        console.log('Initializing page at', new Date().toISOString());
        console.log('Secure context:', window.isSecureContext, 'Protocol:', window.location.protocol);
        updateLanguage('zh');
        updatePreview();
        updateTheme('blue-pink');
    </script>
</body>
</html>