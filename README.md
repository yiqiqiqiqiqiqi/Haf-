HAF Website Code Introduction and Explanation

Website Overview

The "HAF - History, Art & Fashion" website is an elegant digital gallery showcasing the blend of history, art, and fashion. It invites users to explore aesthetic content, view images, learn the brand’s story, and shop products. Supporting 11 languages (e.g., English, Chinese, Portuguese), it displays smoothly on phones and computers, with text and images adapting to screen sizes.

Code Functions (Simplified)

My code (index.php), written in PHP with HTML, CSS, and JavaScript, enables:

1.Multilingual Support:


•Users select a language (e.g., English, Chinese, Portuguese) from the navigation bar, updating text instantly.

•PHP stores the chosen language; translations are stored in a $translations array.


2.Page Content:

•Includes 12 sections: navigation bar, banner, brand story, image gallery, inspiration stories, testimonials, brand journey, events, community, themes, call-to-action, and footer.

•The gallery shows 16 images, clickable to enlarge.


3.Design and Interaction:

•Bootstrap 5.3 ensures adaptive layouts for phones and computers.

•Animations make text and images appear smoothly.

•Clicking images opens a large view (Lightbox effect).

•Arabic pages align right-to-left. 


4.Image Management:

•Images (e.g., gallery_1.jpg) load from the images folder.


5.Database Connection:

•Connects to a haf_db database for dynamic content (e.g., products).
•PHP uses MySQL to fetch data.


⟦Technologies Used⟧

—PHP: Handles language switching and database content.

—HTML5: Builds page structure (e.g., navigation, gallery).

—CSS3: Styles colors, fonts, and animations, with Bootstrap 5.3 for responsive design.

—JavaScript: Enables interactions like image zooming and language switching.

—External Tools: Bootstrap (layout), Font Awesome (icons), Animate.css (animations), Google Fonts (multilingual fonts).

⁅User Experience⁆

⁜⁜⁜Visiting http://localhost/hsbm/index.php:

⁜Visuals: Warm tones (beige, ivory), smooth animations, tidy layout.

⁜Interaction: Switch languages, enlarge images, navigate via buttons.

⁜Multilingual: Supports English, Chinese, Malay, etc., with instant text updates.

⁜Device-Friendly: Works well on phones and computers.

How to Run the Code (on WAMP)

1.Install WAMP:
Download and install WAMP from www.wampserver.com.
Start WAMP; ensure the tray icon is green.

2.Place Files:
Copy the hsbm folder (containing index.php, images, and sql/haf_db.sql) to C:\wamp64\www.

3.Set Up Database:
Open http://localhost/phpmyadmin in a browser.
Log in (username: root, no password).
Create a database named haf_db, click “Import,” select hsbm/sql/haf_db.sql, and click “Go.”

Run the Website:
Open a browser, visit http://localhost/hsbm/index.php.
Test features: switch languages, enlarge images, click navigation buttons.
Troubleshooting:
Images missing: Check images folder in C:\wamp64\www\hsbm contains files like gallery_1.jpg.
Page blank: Verify WAMP services (green icon) and correct file path.

       HAF网站代码介绍与解释
网站概述
“HAF - 历史、艺术与时尚”网站是一个优雅的数字画廊，展示历史、艺术和时尚的融合，吸引用户探索美学内容、浏览图片、了解品牌故事并购买产品。支持11种语言（如中文、英文、马来文），在手机和电脑上流畅显示，文字和图片自动适配屏幕。

代码功能（简易解释）
我的代码（index.php）使用PHP、HTML、CSS和JavaScript，实现：

多语言支持：
用户从导航栏选择语言（如中文、英文、马来文），页面文字立即更新。
PHP保存语言选择，文字存储在$translations数组中。
页面内容：
包含12个部分：导航栏、大横幅、品牌故事、图片画廊、灵感故事、用户评价、品牌历程、活动预告、社区、三大主题、行动号召和页脚。
画廊展示16张图片，可点击放大。
美观与互动：
Bootstrap 5.3确保页面适配手机和电脑。
动画让文字和图片平滑出现。
点击图片弹出大图（Lightbox效果）。
阿拉伯语页面从右到左排列。
图片管理：
图片（如gallery_1.jpg）从images文件夹加载。
数据库连接：
连接haf_db数据库，显示动态内容（如产品）。
PHP使用MySQL获取数据。
技术组成
PHP：处理语言切换和数据库内容。
HTML5：搭建页面结构（如导航、画廊）。
CSS3：控制颜色、字体、动画，使用Bootstrap 5.3适配设备。
JavaScript：实现图片放大、语言切换。
外部工具：Bootstrap（布局）、Font Awesome（图标）、Animate.css（动画）、Google Fonts（多语言字体）。
访问体验
打开http://localhost/hsbm/index.php：

视觉：温暖色调（米色、象牙白），动画流畅，布局整齐。
互动：切换语言、放大图片、点击按钮跳转页面。
多语言：支持中文、英文、马来文等，文字即时更新。
适配设备：手机和电脑显示良好。
如何运行代码（在WAMP上）
安装WAMP：
从www.wampserver.com下载并安装WAMP。
启动WAMP，确保托盘图标为绿色。
放置文件：
将hsbm文件夹（含index.php、images和sql/haf_db.sql）复制到C:\wamp64\www。
设置数据库：
打开浏览器，访问http://localhost/phpmyadmin。
登录（用户名：root，无密码）。
创建数据库haf_db，点击“导入”，选择hsbm/sql/haf_db.sql，点击“执行”。
检查数据库连接：
确保index.php包含：
php

Collapse

Wrap

Copy
$conn = new mysqli("localhost", "root", "", "haf_db");
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
运行网站：
打开浏览器，输入http://localhost/hsbm/index.php。
测试功能：切换语言、放大图片、跳转页面。
问题修复：
图片不显示：确认images文件夹在C:\wamp64\www\hsbm，包含gallery_1.jpg等。
页面空白：检查WAMP服务（绿色图标）和文件路径。




 Pengenalan dan Penjelasan Kod Laman Web HAF
Gambaran Laman Web
Laman web "HAF - History, Art & Fashion" adalah galeri digital yang anggun, mempamerkan gabungan sejarah, seni, dan fesyen. Ia menjemput pengguna untuk meneroka kandungan estetik, melihat gambar, mempelajari kisah jenama, dan membeli produk. Menyokong 11 bahasa (contohnya, Melayu, Inggeris, Portugis), ia dipaparkan dengan lancar pada telefon dan komputer, dengan teks dan gambar menyesuaikan saiz skrin.

Fungsi Kod (Penerangan Mudah)
Kod saya (index.php), ditulis dalam PHP dengan HTML, CSS, dan JavaScript, menyokong:

Sokongan Berbilang Bahasa:
Pengguna memilih bahasa (contohnya, Melayu, Inggeris, Portugis) dari bar navigasi, teks bertukar serta-merta.
PHP menyimpan pilihan bahasa; terjemahan disimpan dalam senarai $translations.
Kandungan Laman:
Mengandungi 12 bahagian: bar navigasi, sepanduk, kisah jenama, galeri gambar, cerita inspirasi, testimoni, perjalanan jenama, pratonton acara, komuniti, tiga tema, seruan tindakan, dan kaki laman.
Galeri memaparkan 16 gambar, boleh diklik untuk pembesaran.
Reka Bentuk dan Interaksi:
Bootstrap 5.3 memastikan susun atur menyesuaikan telefon dan komputer.
Animasi membuat teks dan gambar muncul dengan lancar.
Mengklik gambar membuka paparan besar (kesan Lightbox).
Halaman Bahasa Arab disusun dari kanan ke kiri.
Pengurusan Gambar:
Gambar (contohnya, gallery_1.jpg) dimuat dari folder images.
Sambungan Pangkalan Data:
Bersambung ke pangkalan data haf_db untuk kandungan dinamik (contohnya, produk).
PHP menggunakan MySQL untuk mengambil data.
Teknologi yang Digunakan
PHP: Mengurus pertukaran bahasa dan kandungan pangkalan data.
HTML5: Membina struktur laman (contohnya, navigasi, galeri).
CSS3: Mengawal warna, fon, dan animasi, dengan Bootstrap 5.3 untuk reka bentuk responsif.
JavaScript: Mengendalikan interaksi seperti pembesaran gambar dan pertukaran bahasa.
Alat Luaran: Bootstrap (susun atur), Font Awesome (ikon), Animate.css (animasi), Google Fonts (fon berbilang bahasa).
Pengalaman Melawat
Melawat http://localhost/hsbm/index.php:

Visual: Warna hangat (krem, gading), animasi lancar, susun atur kemas.
Interaksi: Tukar bahasa, besarkan gambar, navigasi melalui butang.
Berbilang Bahasa: Menyokong Melayu, Inggeris, Portugis, dll., dengan teks dikemas kini serta-merta.
Mesra Peranti: Berfungsi baik pada telefon dan komputer.
Cara Menjalankan Kod (di WAMP)
Pasang WAMP:
Muat turun dan pasang WAMP dari www.wampserver.com.
Mulakan WAMP; pastikan ikon dulang berwarna hijau.
Letakkan Fail:
Salin folder hsbm (mengandungi index.php, images, dan sql/haf_db.sql) ke C:\wamp64\www.
Sediakan Pangkalan Data:
Buka http://localhost/phpmyadmin di pelayar.
Log masuk (nama pengguna: root, tiada kata laluan).
Cipta pangkalan data haf_db, klik “Import,” pilih hsbm/sql/haf_db.sql, dan klik “Go.”
Semak Sambungan Pangkalan Data:
Pastikan index.php mengandungi:
php

Collapse

Wrap

Copy
$conn = new mysqli("localhost", "root", "", "haf_db");
if ($conn->connect_error) {
    die("Sambungan gagal: " . $conn->connect_error);
}
Jalankan Laman Web:
Buka pelayar, lawati http://localhost/hsbm/index.php.
Uji ciri: tukar bahasa, besarkan gambar, navigasi halaman.
Penyelesaian Masalah:
Gambar hilang: Pastikan folder images di C:\wamp64\www\hsbm mengandungi fail seperti gallery_1.jpg.
Halaman kosong: Semak perkhidmatan WAMP (ikon hijau) dan laluan fail yang betul.
