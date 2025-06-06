<?php
session_start();
require_once 'config.php';
require_once 'language.php';

header('Content-Type: application/json');

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'zh';
}
$lang = $_SESSION['lang'];
$texts = $languages[$lang] ?? $languages['zh'];

$is_logged_in = isset($_SESSION['user_id']);
$username = $is_logged_in ? $_SESSION['username'] : '';

$response = [
    'lang' => $lang,
    'texts' => $texts,
    'is_logged_in' => $is_logged_in,
    'username' => $username,
    'csrf_token' => $_SESSION['csrf_token']
];

echo json_encode($response, JSON_UNESCAPED_UNICODE);
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