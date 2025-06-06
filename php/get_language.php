<?php
session_start();
require_once 'language.php';

// 设置默认语言
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'zh';
}
$lang = $_SESSION['lang'];
$texts = isset($languages[$lang]) ? $languages[$lang] : $languages['zh'];

// 设置响应头为JSON
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($texts, JSON_UNESCAPED_UNICODE);
?>