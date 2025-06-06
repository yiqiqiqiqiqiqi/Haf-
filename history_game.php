<?php
session_start();

// Initialize session variables if they don't exist
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}
if (!isset($_SESSION['highScore'])) {
    $_SESSION['highScore'] = 0;
}
?>
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
        function updateSession(action, data) {
            fetch('history_game.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=${action}&${new URLSearchParams(data).toString()}`
            })
            // ... 处理响应
        }
        </script><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World History Explorer</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            margin: 0;
            padding: 20px;
            background-image: url('https://images.unsplash.com/photo-1506318137071-a8e063b4bec0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            color: #2c3e50;
            min-height: 100vh;
            overflow-x: hidden;
        }
        #game-container {
            max-width: 850px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.93);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(0,0,0,0.25);
            backdrop-filter: blur(8px);
        }
        button {
            padding: 12px 28px;
            margin: 10px;
            font-size: 17px;
            cursor: pointer;
            background-color: #4a6fa5;
            color: white;
            border: none;
            border-radius: 10px;
            transition: all 0.3s;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            font-weight: bold;
            min-width: 120px;
        }
        button:hover:not(:disabled) {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
        }
        button:active:not(:disabled) {
            transform: translateY(1px);
        }
        button:disabled {
            background-color: #95a5a6;
            cursor: not-allowed;
        }
        #language-buttons {
            margin-bottom: 25px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        #question, #score, #result, #mentor, #leaderboard, #hint, #progress, #explanation, #era-info, #streak-counter {
            margin: 20px 0;
            font-size: 19px;
            opacity: 0;
            animation: fadeIn 1s forwards;
        }
        #question {
            font-size: 22px;
            font-weight: bold;
            color: #2c3e50;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1.4;
        }
        #mentor img {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            margin-top: 15px;
            transition: all 0.5s;
            border: 5px solid #4a6fa5;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        #mentor img:hover {
            transform: rotate(360deg);
            border-color: #e74c3c;
        }
        @keyframes fadeIn {
            to { opacity: 1; }
        }
        .shake {
            animation: shake 0.5s;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }
        #leaderboard, #progress, #era-info, #streak-counter {
            background: rgba(233, 236, 239, 0.85);
            padding: 15px;
            border-radius: 10px;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        #choices button {
            display: block;
            width: 90%;
            margin: 15px auto;
            padding: 15px;
            text-align: center;
            font-size: 16px;
        }
        #explanation {
            font-size: 17px;
            color: #555;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            border-left: 6px solid #4a6fa5;
            line-height: 1.6;
        }
        .civilization-tag {
            display: inline-block;
            padding: 6px 15px;
            margin: 8px;
            background-color: #6c757d;
            color: white;
            border-radius: 25px;
            font-size: 15px;
            font-weight: bold;
            transition: all 0.3s;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .civilization-tag:hover {
            background-color: #4a6fa5;
            transform: scale(1.05);
        }
        #timeline {
            height: 30px;
            background: linear-gradient(90deg, 
                #ff7675, #74b9ff, #55efc4, #ffeaa7, 
                #a29bfe, #fd79a8, #fdcb6e, #00b894);
            margin: 30px 0;
            border-radius: 15px;
            position: relative;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        #timeline-marker {
            position: absolute;
            width: 18px;
            height: 40px;
            background: #2c3e50;
            top: -5px;
            left: 0;
            border-radius: 8px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.25);
            transition: left 1s ease-in-out;
        }
        #timeline-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 8px;
            font-size: 14px;
            font-weight: bold;
            color: #2c3e50;
        }
        #sound-controls {
            position: fixed;
            bottom: 25px;
            right: 25px;
            background: rgba(255,255,255,0.9);
            padding: 12px;
            border-radius: 50px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.25);
            z-index: 100;
            display: flex;
            gap: 10px;
        }
        #sound-controls button {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            padding: 0;
            margin: 0;
            font-size: 22px;
            min-width: auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .correct {
            background-color: #2ecc71 !important;
            animation: pulseCorrect 0.5s;
        }
        .wrong {
            background-color: #e74c3c !important;
            animation: pulseWrong 0.5s;
        }
        @keyframes pulseCorrect {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        @keyframes pulseWrong {
            0% { transform: scale(1); }
            50% { transform: scale(0.95); }
            100% { transform: scale(1); }
        }
        #unlock-notification {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: linear-gradient(135deg, #4a6fa5, #2ecc71);
            color: white;
            padding: 25px 50px;
            border-radius: 15px;
            font-size: 28px;
            font-weight: bold;
            z-index: 1000;
            display: none;
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
            animation: unlockFade 2.5s;
            text-align: center;
            border: 3px solid white;
        }
        @keyframes unlockFade {
            0% { opacity: 0; transform: translate(-50%, -50%) scale(0.7); }
            20% { opacity: 1; transform: translate(-50%, -50%) scale(1.1); }
            80% { opacity: 1; transform: translate(-50%, -50%) scale(1.1); }
            100% { opacity: 0; transform: translate(-50%, -50%) scale(0.8); }
        }
        #score-display {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
            gap: 20px;
        }
        #score-display > div {
            flex: 1;
            padding: 15px;
            border-radius: 10px;
            background: rgba(233, 236, 239, 0.85);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        #mentor-bonus {
            font-size: 16px;
            color: #27ae60;
            font-style: italic;
            margin-top: 8px;
        }
        #streak-fire {
            color: #e74c3c;
            margin-left: 5px;
            display: none;
        }
        .difficulty-indicator {
            display: inline-block;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            margin-left: 8px;
        }
        .difficulty-easy {
            background-color: #2ecc71;
        }
        .difficulty-medium {
            background-color: #f39c12;
        }
        .difficulty-hard {
            background-color: #e74c3c;
        }
        #question-counter {
            font-size: 16px;
            color: #7f8c8d;
            margin-top: 10px;
        }
        #achievements {
            position: fixed;
            top: 20px;
            left: 20px;
            background: rgba(255,255,255,0.9);
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.2);
            z-index: 1050;
            max-width: 250px;
            display: none;
        }
        #achievements h3 {
            margin-top: 0;
            color: #4a6fa5;
            border-bottom: 2px solid #4a6fa5;
            padding-bottom: 8px;
        }
        .achievement-item {
            margin: 10px 0;
            padding: 8px;
            background: rgba(233, 236, 239, 0.7);
            border-radius: 5px;
            display: flex;
            align-items: center;
        }
        .achievement-icon {
            font-size: 24px;
            margin-right: 10px;
            color: #f39c12;
        }
        #achievement-badge {
            position: fixed;
            top: 20px;
            left: 20px;
            background: #e74c3c;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 3px 8px rgba(0,0,0,0.3);
            z-index: 1051;
        }
        #question-timer {
            height: 5px;
            background: #ddd;
            margin: 15px 0;
            border-radius: 5px;
            overflow: hidden;
            display: none;
        }
        #timer-bar {
            height: 100%;
            width: 100%;
            background: #4a6fa5;
            transition: width 1s linear;
        }
        #settings-panel {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
            z-index: 1100;
            display: none;
            max-width: 500px;
            width: 90%;
            animation: fadeInModal 0.3s ease-in-out;
        }
        #settings-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1099;
            display: none;
        }
        #settings-panel h2 {
            margin-top: 0;
            color: #4a6fa5;
            border-bottom: 2px solid #4a6fa5;
            padding-bottom: 10px;
        }
        .settings-option {
            margin: 15px 0;
        }
        .settings-option label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        #close-settings {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #7f8c8d;
        }
        #settings-button {
            position: fixed;
            bottom: 25px;
            left: 25px;
            background: rgba(255,255,255,0.9);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 3px 8px rgba(0,0,0,0.2);
            z-index: 100;
        }
        @keyframes fadeInModal {
            from { opacity: 0; transform: translate(-50%, -60%); }
            to { opacity: 1; transform: translate(-50%, -50%); }
        }
        @media (max-width: 600px) {
            #game-container {
                padding: 15px;
            }
            button {
                padding: 10px 20px;
                font-size: 15px;
                min-width: 100px;
            }
            #settings-panel {
                padding: 20px;
                width: 95%;
                max-width: 400px;
            }
            #question {
                font-size: 18px;
            }
            #sound-controls, #settings-button, #achievement-badge {
                transform: scale(0.8);
            }
        }
        .keyword-tag {
            background-color: #4a6fa5;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-decoration: none;
            display: inline-block;
        }
        .keyword-tag:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            background-color: #2c3e50;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div id="settings-backdrop"></div>
    <div id="game-container">
        <div id="logo-section" style="text-align: center; margin-bottom: 20px;">
            <a href="history.php"><img src="images/historylogo.png" alt="HAF Logo" style="max-width: 200px; height: auto; margin-bottom: 15px;"></a>
            <div id="keywords" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 10px; margin: 10px 0;">
                <a href="history.php" class="keyword-tag">History</a>
                <a href="world_history.php" class="keyword-tag">World History</a>
                <a href="malaysia_history.php" class="keyword-tag">Malaysia History</a>
                <a href="history_game.php" class="keyword-tag">History Game</a>
                <a href="art.php" class="keyword-tag">Art</a>
                <a href="fashion.php" class="keyword-tag">Fashion</a>
                <a href="php/shop.php" class="keyword-tag">Shop</a>
            </div>
        </div>
        <div id="language-buttons">
            <button onclick="setLanguage('zh')" aria-label="Switch to Chinese">中文</button>
            <button onclick="setLanguage('en')" aria-label="Switch to English">English</button>
            <button onclick="setLanguage('ja')" aria-label="Switch to Japanese">日本語</button>
        </div>
        <h1 id="title">World History Explorer</h1>
        
        <div id="timeline">
            <div id="timeline-marker"></div>
        </div>
        <div id="timeline-labels">
            <span>Ancient</span>
            <span>Classical</span>
            <span>Middle Ages</span>
            <span>Early Modern</span>
            <span>Modern</span>
        </div>
        
        <div id="era-info">Current Era: Ancient Civilizations</div>
        <div id="question-timer"><div id="timer-bar"></div></div>
        <div id="mentor">Mentor: Not selected<br><img id="mentor-img" src="" style="display: none;"></div>
        
        <div id="score-display">
            <div id="score">Score: <?php echo $_SESSION['score']; ?></div>
            <div id="leaderboard">High Score: <?php echo $_SESSION['highScore']; ?></div>
            <div id="streak-counter">Streak: 0</div>
        </div>
        
        <div id="progress">Unlocked Civilizations: Mesopotamia, Ancient Egypt</div>
        <div id="question">Click "New Question" to start exploring!</div>
        <div id="hint"></div>
        <div id="choices"></div>
        <div id="result"></div>
        <div id="explanation"></div>
        <div id="question-counter">Questions Answered: 0</div>
        
        <div>
            <button id="next-question" onclick="debouncedNextQuestion()" aria-label="Get New Question">New Question</button>
            <button id="hint-button" onclick="showHint()" style="background-color: #27ae60;" aria-label="Show Hint">Hint</button>
            <button id="reset-score" onclick="resetScore()" style="background-color: #e74c3c;" aria-label="Reset Score">Reset Score</button>
        </div>
    </div>

    <div id="sound-controls">
        <button id="music-toggle" onclick="toggleMusic()" aria-label="Toggle Music">🎵</button>
        <button id="sound-toggle" onclick="toggleSound()" aria-label="Toggle Sound">🔊</button>
    </div>

    <div id="achievement-badge" onclick="toggleAchievements()" title="View Achievements" aria-label="View Achievements">🏆</div>
    
    <div id="achievements">
        <h3 id="achievements-title">Achievements</h3>
        <div id="achievements-list"></div>
    </div>

    <div id="settings-button" onclick="showSettings()" title="Open Settings" aria-label="Open Settings">⚙️</div>
    
    <div id="settings-panel" role="dialog" aria-labelledby="settings-title">
        <button id="close-settings" onclick="hideSettings()" aria-label="Close Settings">×</button>
        <h2 id="settings-title">Settings</h2>
        <div class="settings-option">
            <label id="music-label">Background Music</label>
            <button onclick="toggleMusic()" id="music-toggle-setting" aria-label="Toggle Background Music">Disable Music</button>
        </div>
        <div class="settings-option">
            <label id="sound-label">Sound Effects</label>
            <button onclick="toggleSound()" id="sound-toggle-setting" aria-label="Toggle Sound Effects">Disable Sound</button>
        </div>
        <div class="settings-option">
            <label id="timer-label">Question Timer</label>
            <button onclick="toggleTimer()" id="timer-toggle-setting" aria-label="Toggle Question Timer">Disable Timer</button>
        </div>
        <div class="settings-option">
            <label id="difficulty-label">Difficulty Level</label>
            <select id="difficulty-select" aria-label="Select Difficulty">
                <option value="easy">Easy</option>
                <option value="medium" selected>Medium</option>
                <option value="hard">Hard</option>
            </select>
        </div>
    </div>

    <div id="unlock-notification"></div>

    <!-- Audio System -->
    <audio id="bg-music" preload="auto" loop>
        <source src="https://assets.mixkit.co/music/preview/mixkit-epic-historic-adventure-1497.mp3" type="audio/mpeg">
    </audio>
    <audio id="success-sound" preload="auto">
        <source src="https://assets.mixkit.co/sfx/preview/mixkit-achievement-bell-600.mp3" type="audio/mpeg">
    </audio>
    <audio id="fail-sound" preload="auto">
        <source src="https://assets.mixkit.co/sfx/preview/mixkit-wrong-answer-fail-notification-946.mp3" type="audio/mpeg">
    </audio>
    <audio id="hint-sound" preload="auto">
        <source src="https://assets.mixkit.co/sfx/preview/mixkit-magic-sparkle-902.mp3" type="audio/mpeg">
    </audio>
    <audio id="page-sound" preload="auto">
        <source src="https://assets.mixkit.co/sfx/preview/mixkit-book-page-turning-1561.mp3" type="audio/mpeg">
    </audio>
    <audio id="unlock-sound" preload="auto">
        <source src="https://assets.mixkit.co/sfx/preview/mixkit-unlock-game-notification-253.mp3" type="audio/mpeg">
    </audio>
    <audio id="button-sound" preload="auto">
        <source src="https://assets.mixkit.co/sfx/preview/mixkit-select-click-1109.mp3" type="audio/mpeg">
    </audio>
    <audio id="correct-sound" preload="auto">
        <source src="https://assets.mixkit.co/sfx/preview/mixkit-correct-answer-tone-2870.mp3" type="audio/mpeg">
    </audio>
    <audio id="wrong-sound" preload="auto">
        <source src="https://assets.mixkit.co/sfx/preview/mixkit-wrong-electric-buzz-2927.mp3" type="audio/mpeg">
    </audio>
    <audio id="era-change-sound" preload="auto">
        <source src="https://assets.mixkit.co/sfx/preview/mixkit-ominous-drums-561.mp3" type="audio/mpeg">
    </audio>
    <audio id="achievement-sound" preload="auto">
        <source src="https://assets.mixkit.co/sfx/preview/mixkit-achievement-completed-2068.mp3" type="audio/mpeg">
    </audio>
    <audio id="streak-sound" preload="auto">
        <source src="https://assets.mixkit.co/sfx/preview/mixkit-positive-interface-beep-221.mp3" type="audio/mpeg">
    </audio>

    <script>
        // Game State
        let score = 0;
        let highScore = localStorage.getItem('highScore_1.0') ? parseInt(localStorage.getItem('highScore_1.0')) : 0;
        let currentQuestion = null;
        let language = 'en';
        let currentMentor = null;
        let correctAnswers = 0;
        let unlockedCivilizations = ['Mesopotamia', 'Ancient Egypt'];
        let currentEra = 'Ancient Civilizations';
        let timelinePosition = 0;
        let musicEnabled = true;
        let soundEnabled = true;
        let currentStreak = 0;
        let highestStreak = 0;
        let totalQuestionsAnswered = 0;
        let timerEnabled = false;
        let timerInterval;
        let difficulty = 'medium';
        let isProcessing = false;
        let questionHistory = []; // Add question history array

        const translations = {
            title: { en: 'World History Explorer', zh: '世界历史探险家', ja: '世界歴史探検者' },
            newQuestion: { en: 'New Question', zh: '新问题', ja: '新しい質問' },
            hint: { en: 'Hint', zh: '提示', ja: 'ヒント' },
            resetScore: { en: 'Reset Score', zh: '重置分数', ja: 'スコアをリセット' },
            settings: { en: 'Settings', zh: '设置', ja: '設定' },
            musicLabel: { en: 'Background Music', zh: '背景音乐', ja: '背景音楽' },
            soundLabel: { en: 'Sound Effects', zh: '音效', ja: '効果音' },
            timerLabel: { en: 'Question Timer', zh: '问题计时器', ja: '質問タイマー' },
            difficultyLabel: { en: 'Difficulty Level', zh: '难度级别', ja: '難易度' },
            achievements: { en: 'Achievements', zh: '成就', ja: '実績' },
            score: { en: 'Score', zh: '分数', ja: 'スコア' },
            highScore: { en: 'High Score', zh: '最高分', ja: 'ハイスコア' },
            streak: { en: 'Streak', zh: '连胜', ja: '連続正解' },
            unlockedCivs: { en: 'Unlocked Civilizations', zh: '解锁的文明', ja: '解放された文明' },
            currentEra: { en: 'Current Era', zh: '当前时代', ja: '現在の時代' },
            questionsAnswered: { en: 'Questions Answered', zh: '已回答问题', ja: '回答した質問' },
            noQuestions: { en: 'No more questions! Try unlocking more civilizations or eras.', zh: '没有更多问题！尝试解锁更多文明或时代。', ja: 'これ以上の質問はありません！さらに文明や時代を解放してください。' },
            scoreReset: { en: 'Score reset!', zh: '分数已重置！', ja: 'スコアがリセットされました！' },
            mentorNotSelected: { en: 'Mentor: Not selected', zh: '导师：未选择', ja: '指導者：未選択' },
            selectMentor: { en: 'Select Mentor', zh: '选择导师', ja: '指導者を選択' },
            noMentorHint: { en: 'Hint: Please select a mentor first', zh: '提示：请先选择一位导师', ja: 'ヒント：まず指導者を選択してください' },
            noQuestionHint: { en: 'Hint: Please start a question first', zh: '提示：请先开始一个问题', ja: 'ヒント：まず質問を始めてください' },
            correct: { en: 'Correct! Earned {points} points (Streak x{streak})', zh: '正确！获得 {points} 分（连胜 x{streak}）', ja: '正解！{points} ポイント獲得（連続 x{streak}）' },
            wrong: { en: 'Wrong!', zh: '错误！', ja: '不正解！' },
            civUnlocked: { en: 'New civilization unlocked: {civ}', zh: '新文明解锁：{civ}', ja: '新しい文明が解放されました：{civ}' },
            eraUnlocked: { en: 'New era unlocked: {era}', zh: '新时代解锁：{era}', ja: '新しい時代が解放されました：{era}' },
            achievementUnlocked: { en: 'Achievement Unlocked: {name}', zh: '成就解锁：{name}', ja: '実績解放：{name}' }
        };

        const achievements = {
            firstAnswer: { 
                earned: false, 
                name: { en: 'First Answer', zh: '首次回答', ja: '初回答' }, 
                desc: { en: 'Answer your first question', zh: '回答你的第一个问题', ja: '最初の質問に答える' } 
            },
            fiveStreak: { 
                earned: false, 
                name: { en: 'Five Streak', zh: '五连胜', ja: '5連続正解' }, 
                desc: { en: 'Answer 5 questions correctly in a row', zh: '连续正确回答5个问题', ja: '5問連続で正解する' } 
            },
            unlockAll: { 
                earned: false, 
                name: { en: 'Unlock Master', zh: '解锁大师', ja: '解放マスター' }, 
                desc: { en: 'Unlock all civilizations and eras', zh: '解锁所有文明和时代', ja: 'すべての文明と時代を解放する' } 
            },
            perfectScore: { 
                earned: false, 
                name: { en: 'Perfect Score', zh: '完美分数', ja: '完璧なスコア' }, 
                desc: { en: 'Reach 1000 points', zh: '达到1000分', ja: '1000ポイントに到達する' } 
            },
            historyBuff: { 
                earned: false, 
                name: { en: 'History Buff', zh: '历史爱好者', ja: '歴史愛好家' }, 
                desc: { en: 'Answer 50 questions', zh: '回答50个问题', ja: '50問に答える' } 
            }
        };

        const mentors = {
            herodotus: { 
                name: { en: 'Herodotus', zh: '希罗多德', ja: 'ヘロドトス' }, 
                bonus: 1.3,
                hintStyle: { en: 'Father of History says: ', zh: '历史之父说：', ja: '歴史の父は言う：' },
                img: 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/dd/Herodotus_Met_91.8.jpg/220px-Herodotus_Met_91.8.jpg',
                specialty: ['Ancient Greece', 'Ancient Persia'],
                quote: { en: '"History is the record of human actions"', zh: '“历史是人类行为的记录”', ja: '「歴史は人間の行動の記録である」' }
            },
            simaqian: { 
                name: { en: 'Sima Qian', zh: '司马迁', ja: '司馬遷' }, 
                bonus: 1.4,
                hintStyle: { en: 'Grand Historian notes: ', zh: '大史学家记录：', ja: '大歴史家は記す：' },
                img: 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/Sima_Qian.jpg/220px-Sima_Qian.jpg',
                specialty: ['Ancient China', 'Han Dynasty'],
                quote: { en: '"To explore the relation between heaven and man"', zh: '“探索天人关系”', ja: '「天と人の関係を探る」' }
            },
            ibnkhaldun: { 
                name: { en: 'Ibn Khaldun', zh: '伊本·赫勒敦', ja: 'イブン・ハルドゥーン' }, 
                bonus: 1.5,
                hintStyle: { en: 'Father of Sociology suggests: ', zh: '社会学之父建议：', ja: '社会学の父は提案する：' },
                img: 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/Ibn_Khaldun.jpg/220px-Ibn_Khaldun.jpg',
                specialty: ['Islamic Civilization', 'Middle Ages'],
                quote: { en: '"History is the mirror of human society"', zh: '“历史是人类社会的镜子”', ja: '「歴史は人間社会の鏡である」' }
            }
        };

        const eras = [
            { 
                name: { en: 'Ancient Civilizations', zh: '古代文明', ja: '古代文明' }, 
                civilizations: ['Mesopotamia', 'Ancient Egypt', 'Ancient India', 'Ancient China'], 
                position: 0,
                color: '#ff7675' 
            },
            { 
                name: { en: 'Classical Age', zh: '古典时代', ja: '古典時代' }, 
                civilizations: ['Ancient Greece', 'Ancient Rome', 'Persian Empire', 'Qin-Han'], 
                position: 25,
                color: '#74b9ff' 
            },
            { 
                name: { en: 'Middle Ages', zh: '中世纪', ja: '中世' }, 
                civilizations: ['Byzantine', 'Islamic Civilization', 'Tang-Song', 'Feudal Europe'], 
                position: 50,
                color: '#55efc4' 
            },
            { 
                name: { en: 'Early Modern', zh: '早期现代', ja: '近世' }, 
                civilizations: ['Renaissance', 'Age of Exploration', 'Ming-Qing', 'Ottoman'], 
                position: 75,
                color: '#ffeaa7' 
            },
            { 
                name: { en: 'Modern World', zh: '现代世界', ja: '現代世界' }, 
                civilizations: ['Industrial Revolution', 'Colonial Era', 'World Wars', 'Contemporary'], 
                position: 100,
                color: '#a29bfe' 
            }
        ];

        const questions = [
            {
                civilizations: ['Mesopotamia'],
                era: 'Ancient Civilizations',
                question: { 
                    en: 'Which civilization developed the world\'s earliest known writing system?', 
                    zh: '哪个文明发展了世界上已知的最早书写系统？', 
                    ja: '世界で最も古い既知の文字体系を開発した文明はどれ？' 
                },
                choices: { 
                    en: ['Ancient Egypt', 'Mesopotamia', 'Ancient India', 'Ancient China'], 
                    zh: ['古埃及', '美索不达米亚', '古印度', '古中国'], 
                    ja: ['古代エジプト', 'メソポタミア', '古代インド', '古代中国'] 
                },
                answer: 1,
                explanation: { 
                    en: 'The Sumerians of Mesopotamia developed cuneiform script around 3400 BCE, the earliest known writing system.', 
                    zh: '美索不达米亚的苏美尔人于公元前3400年左右发展了楔形文字，这是已知的最早书写系统。', 
                    ja: 'メソポタミアのシュメール人は紀元前3400年頃に楔形文字を開発し、これは既知の最古の文字体系です。' 
                },
                difficulty: 1
            },
            {
                civilizations: ['Ancient Egypt'],
                era: 'Ancient Civilizations',
                question: {
                    en: 'Which pharaoh built the Great Pyramid of Giza?',
                    zh: '哪位法老建造了吉萨大金字塔？',
                    ja: 'ギザの大ピラミッドを建設したファラオは誰？'
                },
                choices: {
                    en: ['Ramses II', 'Khufu', 'Tutankhamun', 'Cleopatra'],
                    zh: ['拉美西斯二世', '胡夫', '图坦卡蒙', '克利奥帕特拉'],
                    ja: ['ラムセス2世', 'クフ王', 'ツタンカーメン', 'クレオパトラ']
                },
                answer: 1,
                explanation: {
                    en: 'Khufu (also known as Cheops) built the Great Pyramid of Giza around 2560 BCE.',
                    zh: '胡夫（也称为基奥普斯）在公元前2560年左右建造了吉萨大金字塔。',
                    ja: 'クフ王（ケオプスとしても知られる）は紀元前2560年頃にギザの大ピラミッドを建設しました。'
                },
                difficulty: 1
            },
            {
                civilizations: ['Ancient Egypt'],
                era: 'Ancient Civilizations',
                question: {
                    en: 'What was the purpose of the Rosetta Stone?',
                    zh: '罗塞塔石碑的用途是什么？',
                    ja: 'ロゼッタ・ストーンの目的は何？'
                },
                choices: {
                    en: ['Religious text', 'Decree of Ptolemy V', 'Tomb decoration', 'Temple record'],
                    zh: ['宗教文本', '托勒密五世法令', '陵墓装饰', '神庙记录'],
                    ja: ['宗教文書', 'プトレマイオス5世の勅令', '墓の装飾', '神殿の記録']
                },
                answer: 1,
                explanation: {
                    en: 'The Rosetta Stone contained a decree issued by Ptolemy V in 196 BCE, written in three scripts.',
                    zh: '罗塞塔石碑包含了公元前196年托勒密五世颁布的法令，用三种文字书写。',
                    ja: 'ロゼッタ・ストーンには紀元前196年にプトレマイオス5世が発布した勅令が3つの文字で記されています。'
                },
                difficulty: 2
            },
            {
                civilizations: ['Ancient Egypt'],
                era: 'Ancient Civilizations',
                question: {
                    en: 'Which Egyptian queen was known for her relationship with Julius Caesar and Mark Antony?',
                    zh: '哪位埃及女王以与尤利乌斯·凯撒和马克·安东尼的关系而闻名？',
                    ja: 'ユリウス・カエサルとマルクス・アントニウスとの関係で知られるエジプトの女王は誰？'
                },
                choices: {
                    en: ['Nefertiti', 'Hatshepsut', 'Cleopatra', 'Nefertari'],
                    zh: ['纳芙蒂蒂', '哈特谢普苏特', '克利奥帕特拉', '奈菲尔塔利'],
                    ja: ['ネフェルティティ', 'ハトシェプスト', 'クレオパトラ', 'ネフェルタリ']
                },
                answer: 2,
                explanation: {
                    en: 'Cleopatra VII was the last active ruler of the Ptolemaic Kingdom of Egypt.',
                    zh: '克利奥帕特拉七世是托勒密王朝埃及的最后一位实际统治者。',
                    ja: 'クレオパトラ7世はプトレマイオス朝エジプトの最後の実質的な統治者でした。'
                },
                difficulty: 1
            },
            {
                civilizations: ['Ancient Greece'],
                era: 'Classical Age',
                question: {
                    en: 'Which Greek city-state was known for its military society?',
                    zh: '哪个希腊城邦以其军事社会而闻名？',
                    ja: '軍事社会として知られるギリシャの都市国家はどれ？'
                },
                choices: {
                    en: ['Athens', 'Sparta', 'Corinth', 'Thebes'],
                    zh: ['雅典', '斯巴达', '科林斯', '底比斯'],
                    ja: ['アテネ', 'スパルタ', 'コリント', 'テーベ']
                },
                answer: 1,
                explanation: {
                    en: 'Sparta was known for its military-focused society and the famous Spartan warriors.',
                    zh: '斯巴达以其以军事为中心的社会和著名的斯巴达战士而闻名。',
                    ja: 'スパルタは軍事中心の社会と有名なスパルタの戦士で知られていました。'
                },
                difficulty: 1
            },
            {
                civilizations: ['Ancient Greece'],
                era: 'Classical Age',
                question: {
                    en: 'Which Greek philosopher was the teacher of Alexander the Great?',
                    zh: '哪位希腊哲学家是亚历山大大帝的老师？',
                    ja: 'アレクサンダー大王の師匠となったギリシャの哲学者は誰？'
                },
                choices: {
                    en: ['Socrates', 'Plato', 'Aristotle', 'Pythagoras'],
                    zh: ['苏格拉底', '柏拉图', '亚里士多德', '毕达哥拉斯'],
                    ja: ['ソクラテス', 'プラトン', 'アリストテレス', 'ピタゴラス']
                },
                answer: 2,
                explanation: {
                    en: 'Aristotle was the tutor of Alexander the Great from 343 to 340 BCE.',
                    zh: '亚里士多德在公元前343年至340年间担任亚历山大大帝的老师。',
                    ja: 'アリストテレスは紀元前343年から340年までアレクサンダー大王の家庭教師を務めました。'
                },
                difficulty: 2
            },
            {
                civilizations: ['Ancient Greece'],
                era: 'Classical Age',
                question: {
                    en: 'Which Greek city hosted the first Olympic Games?',
                    zh: '哪个希腊城市举办了第一届奥运会？',
                    ja: '最初のオリンピック競技会が開催されたギリシャの都市はどこ？'
                },
                choices: {
                    en: ['Athens', 'Sparta', 'Olympia', 'Delphi'],
                    zh: ['雅典', '斯巴达', '奥林匹亚', '德尔斐'],
                    ja: ['アテネ', 'スパルタ', 'オリンピア', 'デルフォイ']
                },
                answer: 2,
                explanation: {
                    en: 'The first Olympic Games were held in Olympia in 776 BCE.',
                    zh: '第一届奥运会于公元前776年在奥林匹亚举行。',
                    ja: '最初のオリンピック競技会は紀元前776年にオリンピアで開催されました。'
                },
                difficulty: 1
            },
            {
                civilizations: ['Ancient Greece'],
                era: 'Classical Age',
                question: {
                    en: 'Which Greek mathematician is known for the Pythagorean theorem?',
                    zh: '哪位希腊数学家以毕达哥拉斯定理而闻名？',
                    ja: 'ピタゴラスの定理で知られるギリシャの数学者は誰？'
                },
                choices: {
                    en: ['Archimedes', 'Euclid', 'Pythagoras', 'Thales'],
                    zh: ['阿基米德', '欧几里得', '毕达哥拉斯', '泰勒斯'],
                    ja: ['アルキメデス', 'ユークリッド', 'ピタゴラス', 'タレス']
                },
                answer: 2,
                explanation: {
                    en: 'Pythagoras (c. 570-495 BCE) is credited with the Pythagorean theorem in geometry.',
                    zh: '毕达哥拉斯（约公元前570-495年）因几何学中的毕达哥拉斯定理而闻名。',
                    ja: 'ピタゴラス（紀元前570-495年頃）は幾何学におけるピタゴラスの定理で知られています。'
                },
                difficulty: 1
            },
            {
                civilizations: ['Ancient China'],
                era: 'Ancient Civilizations',
                question: {
                    en: 'Which Chinese dynasty is known for the construction of the Great Wall?',
                    zh: '哪个朝代以建造长城而闻名？',
                    ja: '万里の長城の建設で知られる中国の王朝はどれ？'
                },
                choices: {
                    en: ['Han Dynasty', 'Qin Dynasty', 'Tang Dynasty', 'Ming Dynasty'],
                    zh: ['汉朝', '秦朝', '唐朝', '明朝'],
                    ja: ['漢王朝', '秦王朝', '唐王朝', '明王朝']
                },
                answer: 1,
                explanation: {
                    en: 'The Qin Dynasty (221-206 BCE) began the construction of the Great Wall to protect against northern invasions.',
                    zh: '秦朝（公元前221-206年）开始建造长城以抵御北方入侵。',
                    ja: '秦王朝（紀元前221-206年）は北方からの侵略を防ぐために万里の長城の建設を始めました。'
                },
                difficulty: 1
            },
            {
                civilizations: ['Ancient Rome'],
                era: 'Classical Age',
                question: {
                    en: 'Who was the first Roman Emperor?',
                    zh: '谁是第一位罗马皇帝？',
                    ja: '最初のローマ皇帝は誰？'
                },
                choices: {
                    en: ['Julius Caesar', 'Augustus', 'Nero', 'Constantine'],
                    zh: ['尤利乌斯·凯撒', '奥古斯都', '尼禄', '君士坦丁'],
                    ja: ['ユリウス・カエサル', 'アウグストゥス', 'ネロ', 'コンスタンティヌス']
                },
                answer: 1,
                explanation: {
                    en: 'Augustus (27 BCE - 14 CE) was the first Roman Emperor, establishing the Roman Empire.',
                    zh: '奥古斯都（公元前27年-公元14年）是第一位罗马皇帝，建立了罗马帝国。',
                    ja: 'アウグストゥス（紀元前27年-紀元14年）は最初のローマ皇帝で、ローマ帝国を確立しました。'
                },
                difficulty: 2
            },
            {
                civilizations: ['Islamic Civilization'],
                era: 'Middle Ages',
                question: {
                    en: 'Which Islamic Golden Age scientist is known as the "Father of Algebra"?',
                    zh: '哪位伊斯兰黄金时代的科学家被称为"代数之父"？',
                    ja: '「代数学の父」として知られるイスラム黄金時代の科学者は誰？'
                },
                choices: {
                    en: ['Ibn Sina', 'Al-Khwarizmi', 'Ibn Rushd', 'Al-Farabi'],
                    zh: ['伊本·西那', '花拉子米', '伊本·鲁世德', '法拉比'],
                    ja: ['イブン・スィーナー', 'フワーリズミー', 'イブン・ルシュド', 'ファーラービー']
                },
                answer: 1,
                explanation: {
                    en: 'Al-Khwarizmi (c. 780-850) wrote the first comprehensive book on algebra.',
                    zh: '花拉子米（约780-850年）撰写了第一本关于代数的综合性著作。',
                    ja: 'フワーリズミー（780-850年頃）は最初の包括的な代数学の本を書きました。'
                },
                difficulty: 2
            },
            {
                civilizations: ['Renaissance'],
                era: 'Early Modern',
                question: {
                    en: 'Which Renaissance artist painted the ceiling of the Sistine Chapel?',
                    zh: '哪位文艺复兴时期的艺术家绘制了西斯廷教堂的天花板？',
                    ja: 'システィーナ礼拝堂の天井を描いたルネサンスの芸術家は誰？'
                },
                choices: {
                    en: ['Leonardo da Vinci', 'Michelangelo', 'Raphael', 'Donatello'],
                    zh: ['列奥纳多·达·芬奇', '米开朗基罗', '拉斐尔', '多纳泰罗'],
                    ja: ['レオナルド・ダ・ヴィンチ', 'ミケランジェロ', 'ラファエロ', 'ドナテッロ']
                },
                answer: 1,
                explanation: {
                    en: 'Michelangelo painted the Sistine Chapel ceiling between 1508 and 1512.',
                    zh: '米开朗基罗在1508年至1512年间绘制了西斯廷教堂的天花板。',
                    ja: 'ミケランジェロは1508年から1512年の間にシスティーナ礼拝堂の天井を描きました。'
                },
                difficulty: 1
            },
            {
                civilizations: ['Industrial Revolution'],
                era: 'Modern World',
                question: {
                    en: 'Which invention is considered to have started the Industrial Revolution?',
                    zh: '哪项发明被认为开启了工业革命？',
                    ja: '産業革命の始まりとされる発明はどれ？'
                },
                choices: {
                    en: ['Steam Engine', 'Spinning Jenny', 'Power Loom', 'Cotton Gin'],
                    zh: ['蒸汽机', '珍妮纺纱机', '动力织布机', '轧棉机'],
                    ja: ['蒸気機関', 'ジェニー紡績機', '力織機', '綿繰り機']
                },
                answer: 1,
                explanation: {
                    en: 'The Spinning Jenny, invented by James Hargreaves in 1764, revolutionized textile production.',
                    zh: '1764年由詹姆斯·哈格里夫斯发明的珍妮纺纱机彻底改变了纺织生产。',
                    ja: '1764年にジェームズ・ハーグリーブスによって発明されたジェニー紡績機は繊維生産に革命をもたらしました。'
                },
                difficulty: 2
            },
            {
                civilizations: ['World Wars'],
                era: 'Modern World',
                question: {
                    en: 'In which year did World War I begin?',
                    zh: '第一次世界大战在哪一年开始？',
                    ja: '第一次世界大戦は何年に始まった？'
                },
                choices: {
                    en: ['1912', '1914', '1916', '1918'],
                    zh: ['1912年', '1914年', '1916年', '1918年'],
                    ja: ['1912年', '1914年', '1916年', '1918年']
                },
                answer: 1,
                explanation: {
                    en: 'World War I began in 1914 after the assassination of Archduke Franz Ferdinand.',
                    zh: '第一次世界大战在1914年弗朗茨·斐迪南大公遇刺后开始。',
                    ja: '第一次世界大戦は1914年にフランツ・フェルディナント大公の暗殺後に始まりました。'
                },
                difficulty: 1
            },
            {
                civilizations: ['Ancient Egypt'],
                era: 'Ancient Civilizations',
                question: {
                    en: 'Which pharaoh\'s tomb was discovered by Howard Carter in 1922?',
                    zh: '霍华德·卡特在1922年发现了哪位法老的陵墓？',
                    ja: 'ハワード・カーターが1922年に発見したファラオの墓は誰のもの？'
                },
                choices: {
                    en: ['Ramses II', 'Tutankhamun', 'Cleopatra', 'Nefertiti'],
                    zh: ['拉美西斯二世', '图坦卡蒙', '克利奥帕特拉', '纳芙蒂蒂'],
                    ja: ['ラムセス2世', 'ツタンカーメン', 'クレオパトラ', 'ネフェルティティ']
                },
                answer: 1,
                explanation: {
                    en: 'Tutankhamun\'s tomb was discovered in 1922, one of the most significant archaeological finds.',
                    zh: '图坦卡蒙的陵墓在1922年被发现，这是最重要的考古发现之一。',
                    ja: 'ツタンカーメンの墓は1922年に発見され、最も重要な考古学的発見の一つとなりました。'
                },
                difficulty: 1
            },
            {
                civilizations: ['Ancient India'],
                era: 'Ancient Civilizations',
                question: {
                    en: 'Which ancient Indian text is considered the oldest religious text in the world?',
                    zh: '哪部古印度文献被认为是世界上最古老的宗教文献？',
                    ja: '世界最古の宗教文書とされる古代インドの文献はどれ？'
                },
                choices: {
                    en: ['Mahabharata', 'Ramayana', 'Rigveda', 'Bhagavad Gita'],
                    zh: ['摩诃婆罗多', '罗摩衍那', '梨俱吠陀', '薄伽梵歌'],
                    ja: ['マハーバーラタ', 'ラーマーヤナ', 'リグ・ヴェーダ', 'バガヴァッド・ギーター']
                },
                answer: 2,
                explanation: {
                    en: 'The Rigveda, composed around 1500 BCE, is the oldest known religious text.',
                    zh: '梨俱吠陀创作于公元前1500年左右，是已知最古老的宗教文献。',
                    ja: 'リグ・ヴェーダは紀元前1500年頃に作られ、既知の最古の宗教文書です。'
                },
                difficulty: 2
            }
        ];

        // Initialize Game
        function initGame() {
            loadSettings();
            updateUI();
            updateTimeline();
            initMentorButtons();
            if (musicEnabled) {
                document.getElementById('bg-music').play().catch(e => console.log("Autoplay prevented:", e));
            }
            loadAchievements();
            updateAchievementsDisplay();
        }

        // Load Settings
        function loadSettings() {
            const savedMusic = localStorage.getItem('musicEnabled_1.0');
            const savedSound = localStorage.getItem('soundEnabled_1.0');
            const savedTimer = localStorage.getItem('timerEnabled_1.0');
            const savedDifficulty = localStorage.getItem('difficulty_1.0');
            const savedLanguage = localStorage.getItem('language_1.0');
            
            if (savedMusic !== null) musicEnabled = savedMusic === 'true';
            if (savedSound !== null) soundEnabled = savedSound === 'true';
            if (savedTimer !== null) timerEnabled = savedTimer === 'true';
            if (savedDifficulty !== null) difficulty = savedDifficulty;
            if (savedLanguage !== null) language = savedLanguage;
            
            document.getElementById('music-toggle').textContent = musicEnabled ? '🎵' : '🔇';
            document.getElementById('sound-toggle').textContent = soundEnabled ? '🔊' : '🔇';
            document.getElementById('question-timer').style.display = timerEnabled ? 'block' : 'none';
            document.getElementById('difficulty-select').value = difficulty;
            updateUI();
        }

        // Save Settings
        function saveSettings() {
            localStorage.setItem('musicEnabled_1.0', musicEnabled);
            localStorage.setItem('soundEnabled_1.0', soundEnabled);
            localStorage.setItem('timerEnabled_1.0', timerEnabled);
            localStorage.setItem('difficulty_1.0', difficulty);
            localStorage.setItem('language_1.0', language);
        }

        // Load Achievements
        function loadAchievements() {
            const savedAchievements = localStorage.getItem('achievements_1.0');
            if (savedAchievements) {
                const parsed = JSON.parse(savedAchievements);
                for (const key in parsed) {
                    if (achievements[key]) {
                        achievements[key].earned = parsed[key].earned;
                    }
                }
            }
        }

        // Save Achievements
        function saveAchievements() {
            localStorage.setItem('achievements_1.0', JSON.stringify(achievements));
        }

        // Play Sound
        function playSound(soundId) {
            if (!soundEnabled && soundId !== 'bg-music') return;
            if (!musicEnabled && soundId === 'bg-music') return;
            const sound = document.getElementById(soundId);
            sound.currentTime = 0;
            sound.play().catch(e => console.log("Audio play failed:", e));
        }

        // Toggle Music
        function toggleMusic() {
            musicEnabled = !musicEnabled;
            const music = document.getElementById('bg-music');
            if (musicEnabled) {
                music.play();
                document.getElementById('music-toggle').textContent = '🎵';
                document.getElementById('music-toggle-setting').textContent = translations.musicLabel[language] + ': ' + translations.disable[language];
            } else {
                music.pause();
                document.getElementById('music-toggle').textContent = '🔇';
                document.getElementById('music-toggle-setting').textContent = translations.musicLabel[language] + ': ' + translations.enable[language];
            }
            saveSettings();
            playSound('button-sound');
        }

        // Toggle Sound
        function toggleSound() {
            soundEnabled = !soundEnabled;
            document.getElementById('sound-toggle').textContent = soundEnabled ? '🔊' : '🔇';
            document.getElementById('sound-toggle-setting').textContent = translations.soundLabel[language] + ': ' + (soundEnabled ? translations.disable[language] : translations.enable[language]);
            saveSettings();
            playSound('button-sound');
        }

        // Toggle Timer
        function toggleTimer() {
            timerEnabled = !timerEnabled;
            document.getElementById('question-timer').style.display = timerEnabled ? 'block' : 'none';
            document.getElementById('timer-toggle-setting').textContent = translations.timerLabel[language] + ': ' + (timerEnabled ? translations.disable[language] : translations.enable[language]);
            saveSettings();
            playSound('button-sound');
        }

        // Set Difficulty
        function setDifficulty() {
            difficulty = document.getElementById('difficulty-select').value;
            saveSettings();
            playSound('button-sound');
        }

        // Show Settings Panel
        function showSettings() {
            document.getElementById('settings-panel').style.display = 'block';
            document.getElementById('settings-backdrop').style.display = 'block';
            playSound('button-sound');
        }

        // Hide Settings Panel
        function hideSettings() {
            document.getElementById('settings-panel').style.display = 'none';
            document.getElementById('settings-backdrop').style.display = 'none';
            playSound('button-sound');
        }

        // Toggle Achievements Panel
        function toggleAchievements() {
            const panel = document.getElementById('achievements');
            panel.style.display = panel.style.display === 'block' ? 'none' : 'block';
            playSound('button-sound');
        }

        // Update Achievements Display
        function updateAchievementsDisplay() {
            const list = document.getElementById('achievements-list');
            list.innerHTML = '';
            for (const key in achievements) {
                const achievement = achievements[key];
                const item = document.createElement('div');
                item.className = 'achievement-item';
                const icon = document.createElement('span');
                icon.className = 'achievement-icon';
                icon.textContent = achievement.earned ? '🏆' : '🔒';
                item.appendChild(icon);
                const text = document.createElement('div');
                const name = document.createElement('strong');
                name.textContent = achievement.name[language];
                text.appendChild(name);
                const desc = document.createElement('div');
                desc.style.fontSize = '14px';
                desc.style.color = '#7f8c8d';
                desc.textContent = achievement.desc[language];
                text.appendChild(desc);
                item.appendChild(text);
                list.appendChild(item);
            }
        }

        // Check and Unlock Achievements
        function checkAchievements() {
            if (totalQuestionsAnswered === 1 && !achievements.firstAnswer.earned) {
                achievements.firstAnswer.earned = true;
                showAchievementUnlocked('firstAnswer');
            }
            if (currentStreak >= 5 && !achievements.fiveStreak.earned) {
                achievements.fiveStreak.earned = true;
                showAchievementUnlocked('fiveStreak');
            }
            const allCivilizations = Array.from(new Set(questions.flatMap(q => q.civilizations)));
            if (unlockedCivilizations.length === allCivilizations.length && 
                currentEra === eras[eras.length - 1].name[language] && 
                !achievements.unlockAll.earned) {
                achievements.unlockAll.earned = true;
                showAchievementUnlocked('unlockAll');
            }
            if (score >= 1000 && !achievements.perfectScore.earned) {
                achievements.perfectScore.earned = true;
                showAchievementUnlocked('perfectScore');
            }
            if (totalQuestionsAnswered >= 50 && !achievements.historyBuff.earned) {
                achievements.historyBuff.earned = true;
                showAchievementUnlocked('historyBuff');
            }
            saveAchievements();
            updateAchievementsDisplay();
        }

        // Show Achievement Unlocked Notification
        function showAchievementUnlocked(achievementKey) {
            const achievement = achievements[achievementKey];
            const notification = document.getElementById('unlock-notification');
            notification.textContent = translations.achievementUnlocked[language].replace('{name}', achievement.name[language]);
            notification.style.display = 'block';
            playSound('achievement-sound');
            setTimeout(() => {
                notification.style.display = 'none';
            }, 2500);
        }

        // Set Language
        function setLanguage(lang) {
            language = lang;
            playSound('page-sound');
            updateUI();
            if (currentQuestion) {
                displayQuestion(currentQuestion);
            }
            saveSettings();
        }

        // Update UI
        function updateUI() {
            document.getElementById('title').textContent = translations.title[language];
            document.getElementById('next-question').textContent = translations.newQuestion[language];
            document.getElementById('hint-button').textContent = translations.hint[language];
            document.getElementById('reset-score').textContent = translations.resetScore[language];
            document.getElementById('score').textContent = `${translations.score[language]}: ${score}`;
            document.getElementById('leaderboard').textContent = `${translations.highScore[language]}: ${highScore}`;
            document.getElementById('streak-counter').textContent = `${translations.streak[language]}: ${currentStreak}`;
            document.getElementById('progress').textContent = `${translations.unlockedCivs[language]}: ${unlockedCivilizations.join(', ')}`;
            document.getElementById('era-info').textContent = `${translations.currentEra[language]}: ${eras.find(e => e.name.en === currentEra).name[language]}`;
            document.getElementById('question-counter').textContent = `${translations.questionsAnswered[language]}: ${totalQuestionsAnswered}`;
            document.getElementById('settings-title').textContent = translations.settings[language];
            document.getElementById('music-label').textContent = translations.musicLabel[language];
            document.getElementById('sound-label').textContent = translations.soundLabel[language];
            document.getElementById('timer-label').textContent = translations.timerLabel[language];
            document.getElementById('difficulty-label').textContent = translations.difficultyLabel[language];
            document.getElementById('achievements-title').textContent = translations.achievements[language];
            document.getElementById('music-toggle-setting').textContent = translations.musicLabel[language] + ': ' + (musicEnabled ? translations.disable[language] : translations.enable[language]);
            document.getElementById('sound-toggle-setting').textContent = translations.soundLabel[language] + ': ' + (soundEnabled ? translations.disable[language] : translations.enable[language]);
            document.getElementById('timer-toggle-setting').textContent = translations.timerLabel[language] + ': ' + (timerEnabled ? translations.disable[language] : translations.enable[language]);
            const timelineLabels = document.getElementById('timeline-labels');
            timelineLabels.innerHTML = '';
            eras.forEach(era => {
                const label = document.createElement('span');
                label.textContent = era.name[language].substring(0, 2);
                timelineLabels.appendChild(label);
            });
            updateMentorInfo();
        }

        // Update Mentor Information
        function updateMentorInfo() {
            const mentorDiv = document.getElementById('mentor');
            if (currentMentor) {
                mentorDiv.innerHTML = 
                    `${translations.mentor[language]}: ${currentMentor.name[language]}<br>` +
                    `<img id="mentor-img" src="${currentMentor.img}" alt="${currentMentor.name[language]}">` +
                    `<div style="font-style:italic; margin-top:5px;">${currentMentor.quote[language]}</div>`;
                document.getElementById('mentor-img').style.display = 'block';
                document.getElementById('mentor-bonus').textContent = `${translations.mentorBonus[language]}: x${currentMentor.bonus}`;
            } else {
                mentorDiv.innerHTML = 
                    `${translations.mentorNotSelected[language]}<br>` +
                    `<img id="mentor-img" src="" style="display: none;">`;
                document.getElementById('mentor-bonus').textContent = '';
            }
        }

        // Initialize Mentor Selection Buttons
        function initMentorButtons() {
            const mentorButtons = Object.keys(mentors).map(key => {
                return `<button onclick="selectMentor('${key}')" aria-label="Select ${mentors[key].name[language]}">${mentors[key].name[language]}</button>`;
            }).join('');
            document.getElementById('mentor').innerHTML += `<br>${translations.selectMentor[language]}: ${mentorButtons}`;
        }

        // Select Mentor
        function selectMentor(mentorKey) {
            currentMentor = mentors[mentorKey];
            playSound('button-sound');
            updateUI();
            const mentorDiv = document.getElementById('mentor');
            mentorDiv.classList.add('pulse');
            setTimeout(() => {
                mentorDiv.classList.remove('pulse');
            }, 1500);
        }

        // Start Timer
        function startTimer() {
            if (!timerEnabled) return;
            clearInterval(timerInterval);
            const timerBar = document.getElementById('timer-bar');
            timerBar.style.width = '100%';
            timerBar.style.transition = 'none';
            timerBar.offsetHeight;
            timerBar.style.transition = 'width 15s linear';
            timerBar.style.width = '0%';
            timerInterval = setTimeout(() => {
                if (currentQuestion) {
                    checkAnswer(-1);
                }
            }, 15000);
        }

        // Debounce Function
        function debounce(func, wait) {
            let timeout;
            return function (...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), wait);
            };
        }

        // Get New Question
        function nextQuestion() {
            if (isProcessing) return;
            isProcessing = true;
            document.getElementById('next-question').disabled = true;
            playSound('page-sound');
            clearInterval(timerInterval);
            
            let availableQuestions = questions.filter(q => 
                q.civilizations.some(c => unlockedCivilizations.includes(c)) && 
                eras.find(e => e.name.en === currentEra).civilizations.some(c => q.civilizations.includes(c)) &&
                (!q.unlockRequirement || correctAnswers >= q.unlockRequirement) &&
                !questionHistory.includes(q.question.en) // Filter out questions that were recently asked
            );

            // If we've used all questions, reset the history
            if (availableQuestions.length === 0) {
                questionHistory = [];
                availableQuestions = questions.filter(q => 
                    q.civilizations.some(c => unlockedCivilizations.includes(c)) && 
                    eras.find(e => e.name.en === currentEra).civilizations.some(c => q.civilizations.includes(c)) &&
                    (!q.unlockRequirement || correctAnswers >= q.unlockRequirement)
                );
            }

            availableQuestions = availableQuestions.filter(q => {
                if (difficulty === 'easy') return q.difficulty === 1;
                if (difficulty === 'hard') return q.difficulty === 2;
                return true;
            });

            if (availableQuestions.length === 0) {
                document.getElementById('question').textContent = translations.noQuestions[language];
                isProcessing = false;
                document.getElementById('next-question').disabled = false;
                return;
            }

            let filteredQuestions = availableQuestions;
            if (currentMentor) {
                const mentorSpecialtyQuestions = availableQuestions.filter(q => 
                    q.civilizations.some(c => currentMentor.specialty.includes(c))
                );
                if (mentorSpecialtyQuestions.length > 0) {
                    filteredQuestions = mentorSpecialtyQuestions;
                }
            }

            const randomIndex = Math.floor(Math.random() * filteredQuestions.length);
            currentQuestion = filteredQuestions[randomIndex];
            
            // Add current question to history
            questionHistory.push(currentQuestion.question.en);
            // Keep only last 10 questions in history
            if (questionHistory.length > 10) {
                questionHistory.shift();
            }

            displayQuestion(currentQuestion);
            document.getElementById('result').textContent = '';
            document.getElementById('explanation').textContent = '';
            document.getElementById('hint').textContent = '';
            updateTimeline();
            startTimer();
            isProcessing = false;
            document.getElementById('next-question').disabled = false;
        }

        const debouncedNextQuestion = debounce(nextQuestion, 300);

        // Display Question
        function displayQuestion(question) {
            document.getElementById('question').textContent = question.question[language] || question.question.en;
            const choicesDiv = document.getElementById('choices');
            choicesDiv.innerHTML = '';
            const tagsDiv = document.createElement('div');
            tagsDiv.style.margin = '10px 0';
            question.civilizations.forEach(civ => {
                const tag = document.createElement('span');
                tag.className = 'civilization-tag';
                tag.textContent = civ;
                const difficultyIndicator = document.createElement('span');
                difficultyIndicator.className = `difficulty-indicator difficulty-${question.difficulty === 1 ? 'easy' : question.difficulty === 2 ? 'hard' : 'medium'}`;
                tag.appendChild(difficultyIndicator);
                tagsDiv.appendChild(tag);
            });
            choicesDiv.appendChild(tagsDiv);
            (question.choices[language] || question.choices.en).forEach((choice, index) => {
                const button = document.createElement('button');
                button.textContent = choice;
                button.onclick = () => {
                    if (!button.disabled) {
                        clearInterval(timerInterval);
                        checkAnswer(index);
                    }
                };
                button.setAttribute('aria-label', `Option ${choice}`);
                choicesDiv.appendChild(button);
            });
        }

        // Check Answer
        function checkAnswer(selectedIndex) {
            const choices = document.querySelectorAll('#choices button');
            totalQuestionsAnswered++;
            choices.forEach(button => button.disabled = true);
            if (selectedIndex === currentQuestion.answer) {
                currentStreak++;
                if (currentStreak > highestStreak) {
                    highestStreak = currentStreak;
                }
                let points = 10 * currentStreak;
                if (currentMentor) {
                    const isSpecialty = currentQuestion.civilizations.some(c => 
                        currentMentor.specialty.includes(c)
                    );
                    points = Math.floor(points * (isSpecialty ? currentMentor.bonus * 1.2 : currentMentor.bonus));
                }
                score += points;
                playSound('correct-sound');
                if (selectedIndex >= 0) {
                    choices[selectedIndex].classList.add('correct');
                }
                document.getElementById('result').textContent = translations.correct[language]
                    .replace('{points}', points)
                    .replace('{streak}', currentStreak);
                document.getElementById('result').style.color = '#27ae60';
                if (currentStreak >= 3) {
                    playSound('streak-sound');
                    document.getElementById('streak-counter').style.color = '#e74c3c';
                    document.getElementById('streak-counter').style.fontWeight = 'bold';
                }
                correctAnswers++;
                checkForUnlocks();
            } else {
                currentStreak = 0;
                playSound('wrong-sound');
                if (selectedIndex >= 0) {
                    choices[selectedIndex].classList.add('wrong');
                }
                choices[currentQuestion.answer].classList.add('correct');
                document.getElementById('result').textContent = translations.wrong[language];
                document.getElementById('result').style.color = '#e74c3c';
                document.getElementById('result').classList.add('shake');
                setTimeout(() => {
                    document.getElementById('result').classList.remove('shake');
                }, 1500);
                document.getElementById('streak-counter').style.color = '';
                document.getElementById('streak-counter').style.fontWeight = '';
            }
            document.getElementById('explanation').textContent = currentQuestion.explanation[language] || currentQuestion.explanation.en;
            if (score > highScore) {
                highScore = score;
                localStorage.setItem('highScore_1.0', highScore);
            }
            checkAchievements();
            updateUI();
        }

        // Check Unlock Conditions
        function checkForUnlocks() {
            const allCivilizations = Array.from(new Set(questions.flatMap(q => q.civilizations)));
            const lockedCivilizations = allCivilizations.filter(c => !unlockedCivilizations.includes(c));
            lockedCivilizations.forEach(civ => {
                const civQuestions = questions.filter(q => q.civilizations.includes(civ));
                const requiredCorrect = civQuestions[0].unlockRequirement || 5;
                if (correctAnswers >= requiredCorrect) {
                    unlockedCivilizations.push(civ);
                    showUnlockNotification(translations.civUnlocked[language].replace('{civ}', civ));
                }
            });
            const currentEraIndex = eras.findIndex(e => e.name.en === currentEra);
            if (currentEraIndex < eras.length - 1) {
                const nextEra = eras[currentEraIndex + 1];
                const requiredForNextEra = 5 * (currentEraIndex + 1);
                if (correctAnswers >= requiredForNextEra) {
                    currentEra = nextEra.name.en;
                    timelinePosition = nextEra.position;
                    showUnlockNotification(translations.eraUnlocked[language].replace('{era}', nextEra.name[language]));
                    playSound('era-change-sound');
                }
            }
        }

        // Show Unlock Notification
        function showUnlockNotification(message) {
            const notification = document.getElementById('unlock-notification');
            notification.textContent = message;
            notification.style.display = 'block';
            playSound('unlock-sound');
            setTimeout(() => {
                notification.style.display = 'none';
                document.getElementById('progress').classList.add('shake');
                setTimeout(() => {
                    document.getElementById('progress').classList.remove('shake');
                    updateUI();
                }, 1000);
            }, 2000);
        }

        // Show Hint
        function showHint() {
            playSound('hint-sound');
            if (currentQuestion && currentMentor) {
                const hintText = (currentMentor.hintStyle[language] || currentMentor.hintStyle.en) + 
                    (currentQuestion.choices[language][currentQuestion.answer] || currentQuestion.choices.en[currentQuestion.answer]);
                document.getElementById('hint').textContent = hintText;
            } else if (currentQuestion) {
                document.getElementById('hint').textContent = translations.noMentorHint[language];
            } else {
                document.getElementById('hint').textContent = translations.noQuestionHint[language];
            }
        }

        // Reset Score
        function resetScore() {
            playSound('button-sound');
            score = 0;
            correctAnswers = 0;
            currentStreak = 0;
            unlockedCivilizations = ['Mesopotamia', 'Ancient Egypt'];
            currentEra = eras[0].name.en;
            timelinePosition = 0;
            clearInterval(timerInterval);
            updateTimeline();
            updateUI();
            document.getElementById('result').textContent = translations.scoreReset[language];
            document.getElementById('streak-counter').style.color = '';
            document.getElementById('streak-counter').style.fontWeight = '';
        }

        // Update Timeline
        function updateTimeline() {
            document.getElementById('timeline-marker').style.left = `${timelinePosition}%`;
        }

        // Initialize Game
        window.onload = initGame;
        document.getElementById('difficulty-select').addEventListener('change', setDifficulty);
    </script>
</body>
</html>