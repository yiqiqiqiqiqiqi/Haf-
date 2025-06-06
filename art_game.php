<?php
// Set the content type to HTML with UTF-8 encoding
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>艺术猜词游戏 | Art Word Guess</title>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <style>
        :root {
            --primary-color: #6a5acd;
            --secondary-color: #ff7f50;
            --accent-color: #20b2aa;
            --text-color: #333;
            --light-bg: #f8f9fa;
            --success-color: #28a745;
            --error-color: #dc3545;
            --warning-color: #ffc107;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
            background-color: var(--light-bg);
            color: var(--text-color);
            font-size: 16px;
        }

        /* Navigation Bar Styles */
        .haf-navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .haf-logo-title {
            display: flex;
            align-items: center;
        }

        .haf-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-color);
        }

        .haf-nav-links {
            display: flex;
            gap: 20px;
        }

        .haf-nav-links a {
            text-decoration: none;
            color: var(--text-color);
            font-size: 1rem;
            font-weight: 500;
            transition: color 0.2s;
        }

        .haf-nav-links a:hover {
            color: var(--primary-color);
        }

        .haf-nav-links a.active {
            color: var(--primary-color);
            font-weight: bold;
            border-bottom: 2px solid var(--primary-color);
        }

        .game-container {
            background-color: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
            transition: background-color 0.3s;
        }

        .game-container.classic { background-color: #f8f9fa; }
        .game-container.time { background-color: #e6f3ff; }
        .game-container.streak { background-color: #fff5e6; }

        h1 {
            color: var(--primary-color);
            margin-bottom: 20px;
            font-size: 2.2rem;
        }

        .game-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .controls {
            display: flex;
            gap: 10px;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: bold;
            transition: transform 0.2s, background-color 0.2s;
            font-size: 1rem;
        }

        button:hover:not(:disabled) {
            transform: scale(1.05);
        }

        button:focus {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }

        .lang-btn {
            background-color: var(--light-bg);
            color: var(--primary-color);
        }

        .lang-btn.active {
            background-color: var(--primary-color);
            color: white;
        }

        .new-game-btn, .sound-btn, .clear-btn {
            background-color: var(--secondary-color);
            color: white;
        }

        .game-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            background-color: var(--light-bg);
            padding: 12px;
            border-radius: 10px;
            font-size: 0.9rem;
        }

        .hint {
            color: var(--primary-color);
            font-weight: bold;
        }

        .attempts {
            color: var(--error-color);
            font-weight: bold;
        }

        .score {
            color: var(--success-color);
            font-weight: bold;
        }

        .word-display {
            font-size: 1.8rem;
            letter-spacing: 8px;
            margin: 20px 0;
            min-height: 50px;
            animation: fadeIn 0.5s;
        }

        .message {
            font-weight: bold;
            margin: 15px 0;
            min-height: 24px;
            font-size: 1.1rem;
        }

        .win {
            color: var(--success-color);
        }

        .lose {
            color: var(--error-color);
        }

        .keyboard {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 8px;
            margin: 15px 0;
        }

        .key {
            min-width: 50px;
            min-height: 50px;
            font-size: 1.1rem;
            border-radius: 8px;
            background-color: var(--light-bg);
            color: var(--text-color);
            transition: transform 0.2s;
        }

        .key:hover:not(:disabled) {
            background-color: var(--primary-color);
            color: white;
            transform: scale(1.1);
        }

        .key.correct {
            background-color: var(--success-color);
            color: white;
        }

        .key.wrong {
            background-color: var(--error-color);
            color: white;
        }

        .word-input {
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid var(--primary-color);
            margin: 10px 5px;
            width: 200px;
        }

        .art-display {
            margin: 15px auto;
            max-width: 350px;
            border-radius: 8px;
            overflow: hidden;
        }

        .art-image {
            width: 100%;
            transition: filter 0.3s;
            loading: lazy;
        }

        .game-modes {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 15px 0;
        }

        .mode-btn {
            padding: 8px 15px;
            background-color: var(--light-bg);
        }

        .mode-btn.active {
            background-color: var(--accent-color);
            color: white;
        }

        .timer {
            font-weight: bold;
            color: var(--primary-color);
            margin: 10px 0;
        }

        .progress-bar {
            width: 100%;
            height: 10px;
            background-color: var(--light-bg);
            border-radius: 5px;
            margin: 10px 0;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background-color: var(--success-color);
            transition: width 0.3s;
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            text-align: left;
            position: relative;
        }

        .modal-close {
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--error-color);
            color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }

        .shake {
            animation: shake 0.4s;
        }

        .hidden {
            display: none;
        }

        @media (max-width: 600px) {
            body {
                font-size: 14px;
            }
            h1 {
                font-size: 1.8rem;
            }
            .word-display {
                font-size: 1.4rem;
                letter-spacing: 6px;
            }
            .word-input {
                width: 80%;
            }
            .key {
                min-width: 40px;
                min-height: 40px;
                font-size: 0.9rem;
            }
            .haf-navbar {
                flex-direction: column;
                gap: 10px;
            }
            .haf-nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- HAF Logo and Navigation Bar -->
    <nav class="haf-navbar">
        <div class="haf-logo-title">
            <a href="art.php">
                <img src="images/artlogo.png" alt="HAF Logo" class="haf-logo" style="height:40px;vertical-align:middle;margin-right:10px;">
            </a>
            <span class="haf-title">History Art Fashion</span>
        </div>
        <div class="haf-nav-links">
            <a href="world_history.php">History</a>
            <a href="art.php">Art</a>
            <a href="world_paintings.php">World Paintings</a>
            <a href="famous_artists.php">Famous Artists</a>
            <a href="art_game.php" class="active">Art Game</a>
            <a href="fashion.php">Fashion</a>
            <a href="php/shop.php">Shop</a>
        </div>
    </nav>

    <div class="modal hidden" id="tutorial-modal">
        <div class="modal-content">
            <button class="modal-close" aria-label="关闭教程">X</button>
            <h2 id="tutorial-title">欢迎体验艺术猜词游戏</h2>
            <p id="tutorial-text">
                在这个游戏中，你需要根据艺术图片和提示猜测与艺术相关的词语。支持简体中文、繁体中文和英语三种语言，以及经典、限时和连胜三种模式。
                <br><br>
                <strong>如何玩：</strong>
                <ul>
                    <li>选择语言（简/繁/EN）和模式（经典/限时/连胜）。</li>
                    <li>英语模式：点击键盘字母逐个猜测。</li>
                    <li>中文模式：在输入框中输入完整词语并按回车。</li>
                    <li>查看提示和图片，观察生命（❤️）和进度条。</li>
                    <li>点击“新游戏”重新开始。</li>
                </ul>
                享受音效、彩纸动画和艺术之旅吧！
            </p>
            <button class="new-game-btn" id="start-game-btn">开始游戏</button>
        </div>
    </div>

    <div class="game-container">
        <div class="game-header">
            <h1 id="title">艺术猜词游戏</h1>
            <div class="controls">
                <button class="lang-btn active" aria-label="简体中文" onclick="setLanguage('zh-CN')">简</button>
                <button class="lang-btn" aria-label="繁體中文" onclick="setLanguage('zh-TW')">繁</button>
                <button class="lang-btn" aria-label="English" onclick="setLanguage('en')">EN</button>
                <button class="sound-btn" id="sound-btn" aria-label="开启音效" onclick="toggleSound()">🔊</button>
                <button class="new-game-btn" onclick="startNewGame()">新游戏</button>
            </div>
        </div>

        <div class="game-modes">
            <button class="mode-btn active" onclick="setGameMode('classic')" id="classic-btn">经典模式</button>
            <button class="mode-btn" onclick="setGameMode('time')" id="time-btn">限时模式</button>
            <button class="mode-btn" onclick="setGameMode('streak')" id="streak-btn">连胜模式</button>
        </div>

        <div class="game-info">
            <div class="hint" id="hint-text">提示：著名艺术作品或艺术家</div>
            <div class="attempts" id="attempts-text">生命: ❤️❤️❤️❤️❤️❤️</div>
            <div class="score" id="score-text">得分: 0</div>
        </div>

        <div class="timer hidden" id="timer">时间: 60秒</div>

        <div class="progress-bar">
            <div class="progress" id="progress" style="width: 0%"></div>
        </div>

        <div class="art-display">
            <img class="art-image" id="art-image" src="" alt="艺术提示" loading="lazy">
        </div>

        <div class="word-display" id="word-display"></div>

        <div class="message" id="message" aria-live="polite">选择字母来猜出艺术相关的词语</div>

        <div class="input-container">
            <input type="text" id="word-input" class="word-input hidden" placeholder="输入猜测的词语" aria-describedby="message">
            <button class="clear-btn hidden" id="clear-btn" onclick="clearInput()">清除</button>
        </div>
        <div class="keyboard" id="keyboard"></div>
    </div>

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
                    var csv = XLSX.utils.aoa_to_sheet(filteredData.slice(headerRowIndex));
                    csv = XLSX.utils.sheet_to_csv(csv, { header: 1 });
                    return csv;
                } catch (e) {
                    console.error(e);
                    return "";
                }
            }
            return gk_fileData[filename] || "";
        }

        // Game data
        const gameData = {
            'en': [
                { word: "MONALISA", hint: "Leonardo da Vinci's famous portrait", secondaryHint: "A mysterious smile", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Mona_Lisa%2C_by_Leonardo_da_Vinci%2C_from_C2RMF_retouched.jpg/320px-Mona_Lisa%2C_by_Leonardo_da_Vinci%2C_from_C2RMF_retouched.jpg" },
                { word: "STARRYNIGHT", hint: "Van Gogh's swirling night sky", secondaryHint: "Painted in 1889", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/e/ea/Van_Gogh_-_Starry_Night_-_Google_Art_Project.jpg/320px-Van_Gogh_-_Starry_Night_-_Google_Art_Project.jpg" },
                { word: "SCREAM", hint: "Edvard Munch's expressive painting", secondaryHint: "Symbol of anxiety", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/f/f4/The_Scream.jpg/320px-The_Scream.jpg" },
                { word: "PICASSO", hint: "Spanish cubist artist", secondaryHint: "Created Guernica", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/Pablo_picasso_1.jpg/320px-Pablo_picasso_1.jpg" },
                { word: "WATERLILIES", hint: "Monet's series of impressionist works", secondaryHint: "Inspired by a garden", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/3/36/Claude_Monet_-_Water_Lilies_-_Google_Art_Project.jpg/320px-Claude_Monet_-_Water_Lilies_-_Google_Art_Project.jpg" },
                { word: "DAVINCI", hint: "Renaissance genius", secondaryHint: "Painted The Last Supper", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Leonardo_self.jpg/320px-Leonardo_self.jpg" },
                { word: "VANGOGH", hint: "Dutch post-impressionist", secondaryHint: "Lost an ear", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/4/4c/Vincent_van_Gogh_-_Self-Portrait_-_Google_Art_Project_%28454045%29.jpg/320px-Vincent_van_Gogh_-_Self-Portrait_-_Google_Art_Project_%28454045%29.jpg" },
                { word: "GUERNICA", hint: "Picasso's anti-war masterpiece", secondaryHint: "Depicts Spanish Civil War", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Pablo_Picasso%2C_Guernica.jpg/320px-Pablo_Picasso%2C_Guernica.jpg" },
                { word: "SUNFLOWERS", hint: "Van Gogh's flower series", secondaryHint: "Bright yellow blooms", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/9/9d/Vincent_van_Gogh_-_Sunflowers_-_VGM_F458.jpg/320px-Vincent_van_Gogh_-_Sunflowers_-_VGM_F458.jpg" },
                { word: "PERSISTENCE", hint: "Dali's melting clocks painting", secondaryHint: "Surrealist work", image: "https://upload.wikimedia.org/wikipedia/en/thumb/d/dd/The_Persistence_of_Memory.jpg/320px-The_Persistence_of_Memory.jpg" },
                { word: "BIRTHVENUS", hint: "Botticelli's goddess painting", secondaryHint: "Mythological birth", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Sandro_Botticelli_-_La_nascita_di_Venere_-_Google_Art_Project_-_edited.jpg/320px-Sandro_Botticelli_-_La_nascita_di_Venere_-_Google_Art_Project_-_edited.jpg" },
                { word: "GIRLPEARL", hint: "Vermeer's pearl earring girl", secondaryHint: "Dutch Golden Age", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/0/0f/1665_Girl_with_a_Pearl_Earring.jpg/320px-1665_Girl_with_a_Pearl_Earring.jpg" },
                { word: "KISS", hint: "Klimt's golden painting", secondaryHint: "Art Nouveau style", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/The_Kiss_-_Gustav_Klimt_-_Google_Cultural_Institute.jpg/320px-The_Kiss_-_Gustav_Klimt_-_Google_Cultural_Institute.jpg" },
                { word: "NIGHTHAWKS", hint: "Hopper's diner painting", secondaryHint: "Urban isolation", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/c/c0/Nighthawks_by_Edward_Hopper_1942.jpg/320px-Nighthawks_by_Edward_Hopper_1942.jpg" },
                { word: "WHISTLER", hint: "Artist of Mother's portrait", secondaryHint: "American painter", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Whistlers_Mother_high_res.jpg/320px-Whistlers_Mother_high_res.jpg" }
            ],
            'zh-CN': [
                { word: "蒙娜丽莎", hint: "达芬奇的著名肖像画", secondaryHint: "神秘的微笑", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Mona_Lisa%2C_by_Leonardo_da_Vinci%2C_from_C2RMF_retouched.jpg/320px-Mona_Lisa%2C_by_Leonardo_da_Vinci%2C_from_C2RMF_retouched.jpg" },
                { word: "星空", hint: "梵高创作的旋转星空", secondaryHint: "1889年创作", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/e/ea/Van_Gogh_-_Starry_Night_-_Google_Art_Project.jpg/320px-Van_Gogh_-_Starry_Night_-_Google_Art_Project.jpg" },
                { word: "呐喊", hint: "蒙克的经典表现主义作品", secondaryHint: "焦虑的象征", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/f/f4/The_Scream.jpg/320px-The_Scream.jpg" },
                { word: "毕加索", hint: "西班牙立体派艺术家", secondaryHint: "创作了格尔尼卡", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/Pablo_picasso_1.jpg/320px-Pablo_picasso_1.jpg" },
                { word: "睡莲", hint: "莫奈的印象派系列作品", secondaryHint: "灵感来自花园", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/3/36/Claude_Monet_-_Water_Lilies_-_Google_Art_Project.jpg/320px-Claude_Monet_-_Water_Lilies_-_Google_Art_Project.jpg" },
                { word: "达芬奇", hint: "文艺复兴天才", secondaryHint: "绘制了最后的晚餐", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Leonardo_self.jpg/320px-Leonardo_self.jpg" },
                { word: "梵高", hint: "荷兰后印象派画家", secondaryHint: "失去了一只耳朵", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/4/4c/Vincent_van_Gogh_-_Self-Portrait_-_Google_Art_Project_%28454045%29.jpg/320px-Vincent_van_Gogh_-_Self-Portrait_-_Google_Art_Project_%28454045%29.jpg" },
                { word: "格尔尼卡", hint: "毕加索的反战杰作", secondaryHint: "描绘西班牙内战", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Pablo_Picasso%2C_Guernica.jpg/320px-Pablo_Picasso%2C_Guernica.jpg" },
                { word: "向日葵", hint: "梵高的花卉系列", secondaryHint: "明亮的黄色花朵", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/9/9d/Vincent_van_Gogh_-_Sunflowers_-_VGM_F458.jpg/320px-Vincent_van_Gogh_-_Sunflowers_-_VGM_F458.jpg" },
                { word: "记忆永恒", hint: "达利的融化时钟画作", secondaryHint: "超现实主义作品", image: "https://upload.wikimedia.org/wikipedia/en/thumb/d/dd/The_Persistence_of_Memory.jpg/320px-The_Persistence_of_Memory.jpg" },
                { word: "维纳斯诞生", hint: "波提切利的维纳斯画作", secondaryHint: "神话中的诞生", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Sandro_Botticelli_-_La_nascita_di_Venere_-_Google_Art_Project_-_edited.jpg/320px-Sandro_Botticelli_-_La_nascita_di_Venere_-_Google_Art_Project_-_edited.jpg" },
                { word: "戴珍珠耳环的少女", hint: "维米尔的珍珠耳环少女", secondaryHint: "荷兰黄金时代", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/0/0f/1665_Girl_with_a_Pearl_Earring.jpg/320px-1665_Girl_with_a_Pearl_Earring.jpg" },
                { word: "吻", hint: "克里姆特的金色画作", secondaryHint: "新艺术运动风格", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/The_Kiss_-_Gustav_Klimt_-_Google_Cultural_Institute.jpg/320px-The_Kiss_-_Gustav_Klimt_-_Google_Cultural_Institute.jpg" },
                { word: "夜鹰", hint: "霍珀的餐厅画作", secondaryHint: "城市孤独感", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/c/c0/Nighthawks_by_Edward_Hopper_1942.jpg/320px-Nighthawks_by_Edward_Hopper_1942.jpg" },
                { word: "惠斯勒", hint: "艺术家母亲肖像的作者", secondaryHint: "美国画家", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Whistlers_Mother_high_res.jpg/320px-Whistlers_Mother_high_res.jpg" }
            ],
            'zh-TW': [
                { word: "蒙娜麗莎", hint: "達文西的著名肖像畫", secondaryHint: "神秘的微笑", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Mona_Lisa%2C_by_Leonardo_da_Vinci%2C_from_C2RMF_retouched.jpg/320px-Mona_Lisa%2C_by_Leonardo_da_Vinci%2C_from_C2RMF_retouched.jpg" },
                { word: "星空", hint: "梵高創作的旋轉星空", secondaryHint: "1889年創作", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/e/ea/Van_Gogh_-_Starry_Night_-_Google_Art_Project.jpg/320px-Van_Gogh_-_Starry_Night_-_Google_Art_Project.jpg" },
                { word: "吶喊", hint: "孟克的經典表現主義作品", secondaryHint: "焦慮的象徵", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/f/f4/The_Scream.jpg/320px-The_Scream.jpg" },
                { word: "畢卡索", hint: "西班牙立體派藝術家", secondaryHint: "創作了格爾尼卡", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/Pablo_picasso_1.jpg/320px-Pablo_picasso_1.jpg" },
                { word: "睡蓮", hint: "莫內的印象派系列作品", secondaryHint: "靈感來自花園", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/3/36/Claude_Monet_-_Water_Lilies_-_Google_Art_Project.jpg/320px-Claude_Monet_-_Water_Lilies_-_Google_Art_Project.jpg" },
                { word: "達文西", hint: "文藝復興天才", secondaryHint: "繪製了最後的晚餐", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Leonardo_self.jpg/320px-Leonardo_self.jpg" },
                { word: "梵高", hint: "荷蘭後印象派畫家", secondaryHint: "失去了一隻耳朵", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/4/4c/Vincent_van_Gogh_-_Self-Portrait_-_Google_Art_Project_%28454045%29.jpg/320px-Vincent_van_Gogh_-_Self-Portrait_-_Google_Art_Project_%28454045%29.jpg" },
                { word: "格爾尼卡", hint: "畢卡索的反戰傑作", secondaryHint: "描繪西班牙內戰", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Pablo_Picasso%2C_Guernica.jpg/320px-Pablo_Picasso%2C_Guernica.jpg" },
                { word: "向日葵", hint: "梵高的花卉系列", secondaryHint: "明亮的黃色花朵", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/9/9d/Vincent_van_Gogh_-_Sunflowers_-_VGM_F458.jpg/320px-Vincent_van_Gogh_-_Sunflowers_-_VGM_F458.jpg" },
                { word: "記憶的永恆", hint: "達利的融化時鐘畫作", secondaryHint: "超現實主義作品", image: "https://upload.wikimedia.org/wikipedia/en/thumb/d/dd/The_Persistence_of_Memory.jpg/320px-The_Persistence_of_Memory.jpg" },
                { word: "維納斯的誕生", hint: "波提切利的維納斯畫作", secondaryHint: "神話中的誕生", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Sandro_Botticelli_-_La_nascita_di_Venere_-_Google_Art_Project_-_edited.jpg/320px-Sandro_Botticelli_-_La_nascita_di_Venere_-_Google_Art_Project_-_edited.jpg" },
                { word: "戴珍珠耳環的少女", hint: "維梅爾的珍珠耳環少女", secondaryHint: "荷蘭黃金時代", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/0/0f/1665_Girl_with_a_Pearl_Earring.jpg/320px-1665_Girl_with_a_Pearl_Earring.jpg" },
                { word: "吻", hint: "克林姆的金色畫作", secondaryHint: "新藝術運動風格", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/The_Kiss_-_Gustav_Klimt_-_Google_Cultural_Institute.jpg/320px-The_Kiss_-_Gustav_Klimt_-_Google_Cultural_Institute.jpg" },
                { word: "夜鷹", hint: "霍普的餐廳畫作", secondaryHint: "城市孤獨感", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/c/c0/Nighthawks_by_Edward_Hopper_1942.jpg/320px-Nighthawks_by_Edward_Hopper_1942.jpg" },
                { word: "惠斯勒", hint: "藝術家母親肖像的作者", secondaryHint: "美國畫家", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Whistlers_Mother_high_res.jpg/320px-Whistlers_Mother_high_res.jpg" }
            ]
        };

        // Translations
        const translations = {
            'en': {
                title: "Art Word Guess",
                hint: "Hint",
                attempts: "Lives",
                newGame: "New Game",
                win: "Correct! ",
                lose: "Game Over! ",
                instructions: "Guess the art-related word",
                classic: "Classic",
                time: "Time Trial",
                streak: "Streak",
                score: "Score: ",
                timeLeft: "Time: ",
                inputPlaceholder: "Enter your guess",
                tutorialTitle: "Welcome to Art Word Guess",
                tutorialText: "In this game, guess art-related words using hints and images. Supports English, Simplified, and Traditional Chinese, with Classic, Time Trial, and Streak modes.\n\n<b>How to Play:</b>\n<ul><li>Choose a language (EN/简/繁) and mode (Classic/Time/Streak).</li><li>English: Click keyboard letters to guess.</li><li>Chinese: Enter the full word and press Enter.</li><li>Use hints and images, track lives (❤️) and progress.</li><li>Click 'New Game' to restart.</li></ul>Enjoy sounds, confetti, and the art journey!",
                startGame: "Start Game",
                clear: "Clear",
                soundOn: "🔊",
                soundOff: "🔇"
            },
            'zh-CN': {
                title: "艺术猜词游戏",
                hint: "提示",
                attempts: "生命",
                newGame: "新游戏",
                win: "正确！",
                lose: "游戏结束！",
                instructions: "猜艺术相关词语",
                classic: "经典模式",
                time: "限时模式",
                streak: "连胜模式",
                score: "得分: ",
                timeLeft: "时间: ",
                inputPlaceholder: "输入猜测的词语",
                tutorialTitle: "欢迎体验艺术猜词游戏",
                tutorialText: "在这个游戏中，你需要根据艺术图片和提示猜测与艺术相关的词语。支持简体中文、繁体中文和英语，以及经典、限时和连胜三种模式。\n\n<b>如何玩：</b>\n<ul><li>选择语言（简/繁/EN）和模式（经典/限时/连胜）。</li><li>英语模式：点击键盘字母逐个猜测。</li><li>中文模式：在输入框中输入完整词语并按回车。</li><li>查看提示和图片，观察生命（❤️）和进度条。</li><li>点击“新游戏”重新开始。</li></ul>享受音效、彩纸动画和艺术之旅吧！",
                startGame: "开始游戏",
                clear: "清除",
                soundOn: "🔊",
                soundOff: "🔇"
            },
            'zh-TW': {
                title: "藝術猜詞遊戲",
                hint: "提示",
                attempts: "生命",
                newGame: "新遊戲",
                win: "正確！",
                lose: "遊戲結束！",
                instructions: "猜藝術相關詞語",
                classic: "經典模式",
                time: "限時模式",
                streak: "連勝模式",
                score: "得分: ",
                timeLeft: "時間: ",
                inputPlaceholder: "輸入猜測的詞語",
                tutorialTitle: "歡迎體驗藝術猜詞遊戲",
                tutorialText: "在這個遊戲中，你需要根據藝術圖片和提示猜測與藝術相關的詞語。支援簡體中文、繁體中文和英語，以及經典、限時和連勝三種模式。\n\n<b>如何玩：</b>\n<ul><li>選擇語言（簡/繁/EN）和模式（經典/限時/連勝）。</li><li>英語模式：點擊鍵盤字母逐個猜測。</li><li>中文模式：在輸入框中輸入完整詞語並按回車。</li><li>查看提示和圖片，觀察生命（❤️）和進度條。</li><li>點擊“新遊戲”重新開始。</li></ul>享受音效、彩紙動畫和藝術之旅吧！",
                startGame: "開始遊戲",
                clear: "清除",
                soundOn: "🔊",
                soundOff: "🔇"
            }
        };

        // Game state
        let elements;
        let currentLanguage = 'zh-CN';
        let currentMode = 'classic';
        let selectedWord = '';
        let selectedData = {};
        let guessedLetters = [];
        let wrongAttempts = 0;
        let maxAttempts = 6;
        let score = localStorage.getItem('artGameScore') ? parseInt(localStorage.getItem('artGameScore')) : 0;
        let streak = 0;
        let timer;
        let timeLeft = 60;
        let usedWords = [];
        let isProcessingGuess = false;
        let isSoundEnabled = true;
        let startTime;

        // Sound effects
        const audioContext = new (window.AudioContext || window.webkitAudioContext)();
        function playSound(frequency, type = 'sine', duration = 0.1) {
            if (!isSoundEnabled) return;
            const oscillator = audioContext.createOscillator();
            oscillator.type = type;
            oscillator.frequency.setValueAtTime(frequency, audioContext.currentTime);
            oscillator.connect(audioContext.destination);
            oscillator.start();
            oscillator.stop(audioContext.currentTime + duration);
        }

        // Confetti effect
        function launchConfetti() {
            confetti({
                particleCount: 100,
                spread: 70,
                origin: { y: 0.6 }
            });
        }

        // Show tutorial modal
        function showTutorial() {
            if (localStorage.getItem('artGameTutorialShown')) return;
            elements.tutorialModal.classList.remove('hidden');
            elements.tutorialModal.focus();
            localStorage.setItem('artGameTutorialShown', 'true');
        }

        // Close tutorial modal
        function closeTutorial() {
            elements.tutorialModal.classList.add('hidden');
            elements.newGameBtn.focus();
        }

        // Toggle sound
        function toggleSound() {
            isSoundEnabled = !isSoundEnabled;
            elements.soundBtn.textContent = isSoundEnabled ? translations[currentLanguage].soundOn : translations[currentLanguage].soundOff;
            elements.soundBtn.setAttribute('aria-label', isSoundEnabled ? '关闭音效' : '开启音效');
        }

        // Clear input
        function clearInput() {
            elements.wordInput.value = '';
            elements.wordInput.focus();
        }

        // Initialize game
        function initGame() {
            if (!elements) {
                console.error('Elements not initialized');
                return;
            }
            clearInterval(timer);
            guessedLetters = [];
            wrongAttempts = 0;
            maxAttempts = currentMode === 'streak' ? 5 : 6;
            isProcessingGuess = false;
            startTime = Date.now();

            selectNewWord();
            updateDisplay();
            createKeyboard();

            elements.wordInput.classList.toggle('hidden', currentLanguage === 'en');
            elements.clearBtn.classList.toggle('hidden', currentLanguage === 'en');
            elements.keyboard.classList.toggle('hidden', currentLanguage !== 'en');

            if (currentMode === 'time') {
                timeLeft = 60;
                elements.timer.classList.remove('hidden');
                updateTimerDisplay();
                timer = setInterval(updateTimer, 1000);
            } else {
                elements.timer.classList.add('hidden');
            }

            elements.gameContainer.className = `game-container ${currentMode}`;
            elements.message.textContent = translations[currentLanguage].instructions;
            elements.message.className = 'message';
        }

        // Select new word
        function selectNewWord() {
            const words = gameData[currentLanguage];
            let availableWords = words.filter(wordData => !usedWords.includes(wordData.word));

            if (availableWords.length === 0) {
                usedWords = [];
                availableWords = words;
            }

            const randomIndex = Math.floor(Math.random() * availableWords.length);
            selectedData = availableWords[randomIndex];
            selectedWord = selectedData.word.toUpperCase();
            usedWords.push(selectedData.word);

            if (elements.hintText) {
                elements.hintText.textContent = `${translations[currentLanguage].hint}: ${selectedData.hint}`;
            } else {
                console.error('hint-text element not found');
            }
            elements.artImage.src = selectedData.image;
            elements.artImage.alt = selectedData.hint;
            elements.artImage.onerror = () => {
                elements.artImage.src = 'https://via.placeholder.com/320x240?text=Art+Image';
            };
        }

        // Update display
        function updateDisplay() {
            if (!elements.wordDisplay) {
                console.error('word-display element not found');
                return;
            }
            elements.wordDisplay.innerHTML = '';

            for (const letter of selectedWord) {
                const span = document.createElement('span');
                span.textContent = (guessedLetters.includes(letter) || letter === ' ') ? letter : '_';
                elements.wordDisplay.appendChild(span);
            }

            updateAttemptsDisplay();
            updateProgressBar();
            if (elements.scoreText) {
                elements.scoreText.textContent = `${translations[currentLanguage].score}${score}`;
            } else {
                console.error('score-text element not found');
            }
        }

        // Update attempts display
        function updateAttemptsDisplay() {
            if (!elements.attemptsText) {
                console.error('attempts-text element not found');
                return;
            }
            let hearts = '';
            const lives = maxAttempts - wrongAttempts;

            for (let i = 0; i < maxAttempts; i++) {
                hearts += i < lives ? '❤️' : '🖤';
            }

            elements.attemptsText.textContent = `${translations[currentLanguage].attempts}: ${hearts}`;

            // Show secondary hint after 3 wrong attempts
            if (wrongAttempts === 3 && selectedData.secondaryHint) {
                elements.hintText.textContent = `${translations[currentLanguage].hint}: ${selectedData.secondaryHint}`;
            }
        }

        // Update progress bar
        function updateProgressBar() {
            if (!elements.progress) {
                console.error('progress element not found');
                return;
            }
            const correctLetters = [...selectedWord].filter(c => guessedLetters.includes(c) || c === ' ').length;
            const totalLetters = [...selectedWord].filter(c => c !== ' ').length;
            const progress = (correctLetters / totalLetters) * 100;
            elements.progress.style.width = `${progress}%`;
        }

        // Create keyboard
        function createKeyboard() {
            if (!elements.keyboard) {
                console.error('keyboard element not found');
                return;
            }
            elements.keyboard.innerHTML = '';
            if (currentLanguage !== 'en') return;

            const letters = Array.from({length: 26}, (_, i) => String.fromCharCode(65 + i));
            letters.forEach(letter => {
                const button = document.createElement('button');
                button.className = 'key';
                button.textContent = letter;
                button.dataset.letter = letter;
                button.setAttribute('aria-label', `Letter ${letter}`);
                if (guessedLetters.includes(letter)) {
                    button.classList.add(selectedWord.includes(letter) ? 'correct' : 'wrong');
                    button.disabled = true;
                }
                elements.keyboard.appendChild(button);
            });

            elements.keyboard.onclick = (e) => {
                if (e.target.classList.contains('key') && !isProcessingGuess) {
                    guessLetter(e.target.dataset.letter);
                }
            };
        }

        // Guess letter (English mode)
        function guessLetter(letter) {
            if (isProcessingGuess || guessedLetters.includes(letter)) return;
            isProcessingGuess = true;

            guessedLetters.push(letter);

            if (!selectedWord.includes(letter)) {
                wrongAttempts++;
                elements.wordDisplay.classList.add('shake');
                playSound(200, 'square', 0.2);
                setTimeout(() => elements.wordDisplay.classList.remove('shake'), 400);
            } else {
                playSound(600, 'sine', 0.1);
            }

            updateDisplay();
            updateKeyboard();
            checkGameEnd();
            setTimeout(() => isProcessingGuess = false, 200);
        }

        // Guess word (Chinese mode)
        function guessWord() {
            if (isProcessingGuess || currentLanguage === 'en') return;
            isProcessingGuess = true;

            const guess = elements.wordInput.value.trim().toUpperCase();
            if (guess === selectedWord) {
                guessedLetters = [...selectedWord];
                playSound(600, 'sine', 0.1);
                handleWin();
            } else {
                wrongAttempts++;
                elements.wordInput.classList.add('shake');
                playSound(200, 'square', 0.2);
                setTimeout(() => elements.wordInput.classList.remove('shake'), 400);
                checkGameEnd();
            }
            elements.wordInput.value = '';
            updateDisplay();
            setTimeout(() => isProcessingGuess = false, 200);
        }

        // Update keyboard
        function updateKeyboard() {
            if (currentLanguage !== 'en') return;
            if (!elements.keyboard) {
                console.error('keyboard element not found');
                return;
            }
            guessedLetters.forEach(letter => {
                const key = elements.keyboard.querySelector(`.key[data-letter="${letter}"]:not(.correct):not(.wrong)`);
                if (key) {
                    key.classList.add(selectedWord.includes(letter) ? 'correct' : 'wrong');
                    key.disabled = true;
                }
            });
        }

        // Check game end
        function checkGameEnd() {
            const isWin = [...selectedWord].every(c => guessedLetters.includes(c) || c === ' ');
            const isLose = wrongAttempts >= maxAttempts;

            if (isWin) {
                handleWin();
            } else if (isLose) {
                handleLose();
            }
        }

        // Handle win
        function handleWin() {
            let points = 0;
            const timeTaken = (Date.now() - startTime) / 1000; // Seconds

            if (currentMode === 'classic') {
                points = selectedWord.length * 10 + (maxAttempts - wrongAttempts) * 5;
                if (wrongAttempts <= 2) points += 20; // Bonus for few mistakes
            } else if (currentMode === 'time') {
                points = selectedWord.length * 15 + timeLeft;
                if (timeTaken < 30) points += 30; // Bonus for speed
                clearInterval(timer);
            } else if (currentMode === 'streak') {
                streak++;
                points = selectedWord.length * 10 + streak * 5;
                if (wrongAttempts === 0) points += 25; // Perfect guess bonus
            }

            score += points;
            localStorage.setItem('artGameScore', score);

            if (elements.message) {
                elements.message.textContent = `${translations[currentLanguage].win}${selectedWord} (+${points}分)`;
                elements.message.className = 'message win';
            } else {
                console.error('message element not found');
            }
            playSound(800, 'sine', 0.3);
            launchConfetti();

            clearInterval(timer);
            setTimeout(() => {
                if (currentMode === 'streak') {
                    initGame();
                } else {
                    disableKeyboard();
                }
            }, 1500);
        }

        // Handle lose
        function handleLose() {
            if (currentMode === 'streak') {
                streak = 0;
            }

            if (elements.message) {
                elements.message.textContent = `${translations[currentLanguage].lose}${selectedWord}`;
                elements.message.className = 'message lose';
            } else {
                console.error('message element not found');
            }
            playSound(100, 'square', 0.3);

            disableKeyboard();
        }

        // Disable keyboard
        function disableKeyboard() {
            if (elements.keyboard) {
                elements.keyboard.querySelectorAll('.key').forEach(key => key.disabled = true);
            }
            if (elements.wordInput) {
                elements.wordInput.disabled = true;
            }
            if (elements.clearBtn) {
                elements.clearBtn.disabled = true;
            }
        }

        // Update timer
        function updateTimer() {
            timeLeft--;
            updateTimerDisplay();

            if (timeLeft <= 0) {
                clearInterval(timer);
                handleLose();
            }
        }

        // Update timer display
        function updateTimerDisplay() {
            if (elements.timer) {
                elements.timer.textContent = `${translations[currentLanguage].timeLeft}${timeLeft}秒`;
            } else {
                console.error('timer element not found');
            }
        }

        // Set language
        function setLanguage(lang) {
            currentLanguage = lang;
            document.documentElement.lang = lang;
            usedWords = [];
            updateUIText();
            document.querySelectorAll('.lang-btn').forEach(btn => {
                btn.classList.toggle('active', btn.textContent === 
                    (lang === 'en' ? 'EN' : lang === 'zh-CN' ? '简' : '繁'));
            });
            startNewGame();
        }

        // Set game mode
        function setGameMode(mode) {
            currentMode = mode;
            usedWords = [];
            document.querySelectorAll('.mode-btn').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            startNewGame();
        }

        // Update UI text
        function updateUIText() {
            if (!elements) {
                console.error('Elements not initialized');
                return;
            }
            const trans = translations[currentLanguage];
            if (elements.title) {
                elements.title.textContent = trans.title;
            } else {
                console.error('title element not found');
            }
            if (elements.newGameBtn) {
                elements.newGameBtn.textContent = trans.newGame;
            } else {
                console.error('new-game-btn element not found');
            }
            if (elements.message) {
                elements.message.textContent = trans.instructions;
            } else {
                console.error('message element not found');
            }
            if (elements.classicBtn) {
                elements.classicBtn.textContent = trans.classic;
            } else {
                console.error('classic-btn element not found');
            }
            if (elements.timeBtn) {
                elements.timeBtn.textContent = trans.time;
            } else {
                console.error('time-btn element not found');
            }
            if (elements.streakBtn) {
                elements.streakBtn.textContent = trans.streak;
            } else {
                console.error('streak-btn element not found');
            }
            if (elements.scoreText) {
                elements.scoreText.textContent = `${trans.score}${score}`;
            } else {
                console.error('score-text element not found');
            }
            if (elements.wordInput) {
                elements.wordInput.placeholder = trans.inputPlaceholder;
            } else {
                console.error('word-input element not found');
            }
            if (elements.tutorialTitle) {
                elements.tutorialTitle.textContent = trans.tutorialTitle;
            }
            if (elements.tutorialText) {
                elements.tutorialText.innerHTML = trans.tutorialText;
            }
            if (elements.startGameBtn) {
                elements.startGameBtn.textContent = trans.startGame;
            }
            if (elements.clearBtn) {
                elements.clearBtn.textContent = trans.clear;
            }
            if (elements.soundBtn) {
                elements.soundBtn.textContent = isSoundEnabled ? trans.soundOn : trans.soundOff;
            }
        }

        // Start new game
        function startNewGame() {
            if (currentMode !== 'streak') {
                streak = 0;
            }
            initGame();
        }

        // Initialize
        window.onload = () => {
            // Initialize DOM elements
            elements = {
                gameContainer: document.querySelector('.game-container'),
                title: document.getElementById('title'),
                hintText: document.getElementById('hint-text'),
                attemptsText: document.getElementById('attempts-text'),
                scoreText: document.getElementById('score-text'),
                timer: document.getElementById('timer'),
                progress: document.getElementById('progress'),
                artImage: document.getElementById('art-image'),
                wordDisplay: document.getElementById('word-display'),
                message: document.getElementById('message'),
                wordInput: document.getElementById('word-input'),
                keyboard: document.getElementById('keyboard'),
                classicBtn: document.getElementById('classic-btn'),
                timeBtn: document.getElementById('time-btn'),
                streakBtn: document.getElementById('streak-btn'),
                newGameBtn: document.getElementById('new-game-btn'),
                soundBtn: document.getElementById('sound-btn'),
                clearBtn: document.getElementById('clear-btn'),
                tutorialModal: document.getElementById('tutorial-modal'),
                tutorialTitle: document.getElementById('tutorial-title'),
                tutorialText: document.getElementById('tutorial-text'),
                startGameBtn: document.getElementById('start-game-btn'),
                modalClose: document.querySelector('.modal-close')
            };

            // Check for missing elements
            for (const [key, element] of Object.entries(elements)) {
                if (!element) {
                    console.error(`Element "${key}" not found`);
                }
            }

            updateUIText();
            showTutorial();
            initGame();

            // Event listeners
            if (elements.wordInput) {
                elements.wordInput.onkeydown = (e) => {
                    if (e.key === 'Enter' && elements.wordInput.value.trim()) {
                        guessWord();
                    }
                };
            }

            if (elements.modalClose) {
                elements.modalClose.onclick = closeTutorial;
            }

            if (elements.startGameBtn) {
                elements.startGameBtn.onclick = closeTutorial;
            }

            // Keyboard navigation for modal
            if (elements.tutorialModal) {
                elements.tutorialModal.onkeydown = (e) => {
                    if (e.key === 'Escape') closeTutorial();
                };
            }
        };
    </script>
</body>
</html>