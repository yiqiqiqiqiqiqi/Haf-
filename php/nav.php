<?php
session_start();
require_once 'language.php';

// 设置默认语言
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'zh';
}
$lang = $_SESSION['lang'];
$texts = isset($languages[$lang]) ? $languages[$lang] : $languages['zh'];

// 检查用户登录状态
$is_logged_in = isset($_SESSION['user_id']);
$username = $is_logged_in ? $_SESSION['username'] : '';
$is_admin = $is_logged_in && isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

// 设置响应头为HTML
header('Content-Type: text/html; charset=UTF-8');
?>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand animate-jitter" href="../index.html">HAF</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link animate-jitter" href="../history.html" data-lang-key="nav_history"><?php echo htmlspecialchars($texts['nav_history']); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link animate-jitter" href="../art.html" data-lang-key="nav_art"><?php echo htmlspecialchars($texts['nav_art']); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link animate-jitter" href="../fashion.html" data-lang-key="nav_fashion"><?php echo htmlspecialchars($texts['nav_fashion']); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link animate-jitter" href="shop.php" data-lang-key="nav_shop"><?php echo htmlspecialchars($texts['nav_shop']); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link animate-jitter" href="cart.php" data-lang-key="nav_cart"><?php echo htmlspecialchars($texts['nav_cart']); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link animate-jitter" href="orders.php" data-lang-key="nav_orders"><?php echo htmlspecialchars($texts['nav_orders']); ?></a>
                </li>
                <?php if ($is_admin): ?>
                    <li class="nav-item">
                        <a class="nav-link animate-jitter" href="admin.php" data-lang-key="nav_admin"><?php echo htmlspecialchars($texts['nav_admin']); ?></a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <?php if ($is_logged_in): ?>
                        <span class="nav-link" data-lang-key="welcome_user"><?php echo htmlspecialchars($texts['welcome_user']) . ' ' . htmlspecialchars($username); ?></span>
                        <a class="nav-link animate-jitter" href="logout.php" data-lang-key="nav_logout"><?php echo htmlspecialchars($texts['nav_logout']); ?></a>
                    <?php else: ?>
                        <a class="nav-link animate-jitter" href="login.php" data-lang-key="nav_login"><?php echo htmlspecialchars($texts['nav_login']); ?></a>
                    <?php endif; ?>
                </li>
                <li class="nav-item">
                    <select id="language-switcher" class="form-select w-auto">
                        <option value="zh" <?php echo $lang === 'zh' ? 'selected' : ''; ?>>中文</option>
                        <option value="en" <?php echo $lang === 'en' ? 'selected' : ''; ?>>English</option>
                        <option value="ms" <?php echo $lang === 'ms' ? 'selected' : ''; ?>>Bahasa Melayu</option>
                    </select>
                </li>
            </ul>
        </div>
    </div>
</nav>