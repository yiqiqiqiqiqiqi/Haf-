<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    header("Location: shop.php");
    exit();
}

if (isset($_POST['product_id'], $_POST['email'])) {
    $product_id = filter_var($_POST['product_id'], FILTER_VALIDATE_INT);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (!$product_id || !$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid input.";
        header("Location: shop.php");
        exit();
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_zh, total_en, total_ms, status, created_at) 
                               SELECT ?, p.price_zh * ?, p.price_en * ?, p.price_ms * ?, 'pending', NOW()
                               FROM products p WHERE p.id = ?");
        $stmt->execute([$_SESSION['user_id'] ?? 0, 1, 1, 1, $product_id]);
        $order_id = $pdo->lastInsertId();

        $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) 
                               SELECT ?, ?, ?, p.price_zh 
                               FROM products p WHERE p.id = ?");
        $stmt->execute([$order_id, $product_id, 1, $product_id]);

        $_SESSION['success'] = "订单提交成功！";
        header("Location: shop.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = "订单失败: " . $e->getMessage();
        header("Location: shop.php");
        exit();
    }
}

header("Location: shop.php");
exit();
?>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const lang = localStorage.getItem('language') || 'zh';
    const translateElements = () => {
        document.querySelectorAll('[data-lang-key]').forEach(element => {
            const key = element.getAttribute('data-lang-key');
            const text = languages[lang][key] || languages['zh'][key] || key;
            element.textContent = text;
        });
        document.title = languages[lang].site_title || languages['zh'].site_title;
        const metaDesc = document.querySelector('meta[name="description"]');
        if (metaDesc) {
            metaDesc.setAttribute('content', languages[lang].meta_description || languages['zh'].meta_description);
        }
        document.documentElement.lang = lang === 'zh' ? 'zh-CN' : (lang === 'en' ? 'en' : 'ms');
    };
    translateElements();

    const languageSwitcher = document.getElementById('language-switcher');
    if (languageSwitcher) {
        languageSwitcher.addEventListener('change', (e) => {
            const newLang = e.target.value;
            localStorage.setItem('language', newLang);
            fetch('language.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `lang=${encodeURIComponent(newLang)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    translateElements();
                    window.location.reload();
                }
            })
            .catch(error => console.error('Language switch failed:', error));
        });
    }
});
</script>