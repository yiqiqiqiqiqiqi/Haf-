## ⟦HAF Website Code Introduction and Explanation⟧

### ⟦Website Overview⟧

The "HAF - History, Art & Fashion" website is an elegant digital gallery showcasing the blend of history, art, and fashion. It invites users to explore aesthetic content, view images, learn the brand’s story, and shop products. Supporting 11 languages (e.g., English, Chinese, Portuguese), it displays smoothly on phones and computers, with text and images adapting to screen sizes.

---

### ⟦Code Functions (Simplified)⟧

**1. Multilingual Support:**

• Users select a language (e.g., English, Chinese, Portuguese) from the navigation bar, updating text instantly.

• PHP stores the chosen language; translations are stored in a `$translations` array.

**2. Page Content:**

• Includes 12 sections: navigation bar, banner, brand story, image gallery, inspiration stories, testimonials, brand journey, events, community, themes, call-to-action, and footer.

• The gallery shows 16 images, clickable to enlarge.

**3. Design and Interaction:**

• Bootstrap 5.3 ensures adaptive layouts for phones and computers.

• Animations make text and images appear smoothly.

• Clicking images opens a large view (Lightbox effect).

• Arabic pages align right-to-left.

**4. Image Management:**

• Images (e.g., `gallery_1.jpg`) load from the **images** folder.

**5. Database Connection:**

• Connects to a `haf_db` database for dynamic content (e.g., products).

• PHP uses MySQL to fetch data.

---

### ⟦Technologies Used⟧

• **PHP** – Handles language switching and database content.

• **HTML5** – Builds page structure (e.g., navigation, gallery).

• **CSS3** – Styles colors, fonts, and animations with Bootstrap 5.3 for responsive design.

• **JavaScript** – Enables interactions like image zooming and language switching.

• **External Tools** – Bootstrap (layout), Font Awesome (icons), Animate.css (animations), Google Fonts (multilingual fonts).

---

### ⁅User Experience⁆

Visit `http://localhost/hsbm/index.php`:

• **Visuals:** Warm tones (beige, ivory), smooth animations, tidy layout.

• **Interaction:** Switch languages, enlarge images, navigate via buttons.

• **Multilingual:** Supports English, Chinese, Malay, etc., with instant updates.

• **Device-Friendly:** Works well on phones and computers.

---

### ⟦How to Run the Code (on WAMP)⟧

**1. Install WAMP:**

• Download and install WAMP from [www.wampserver.com](http://www.wampserver.com).

• Start WAMP; ensure the tray icon is green.

2. Place Files:

⁕Copy the hsbm folder (containing index.php, images, and sql/haf_db.sql) to C:\wamp64\www.

⁕⚠️ Important: If the folder name is not hsbm, rename it to hsbm before placing it into C:\wamp64\www.

**3. Set Up Database:**

• Open browser: `http://localhost/phpmyadmin`.

• Login (username: root, no password).

• Create a database named `haf_db`, click **Import**, select `hsbm/sql/haf_db.sql`, click **Go**.

**4. Run the Website:**
• Open browser → `http://localhost/hsbm/index.php`.
• Test features: switch languages, enlarge images, navigate.

**5. Troubleshooting:**

• **Images missing?** Check `images` folder exists in `C:\wamp64\www\hsbm`.

• **Blank page?** Confirm WAMP icon is green and file path is correct.

---

## ⟦HAF网站代码介绍与解释⟧

### ⟦网站概述⟧

“HAF - 历史、艺术与时尚”网站是一个优雅的数字画廊，展示历史、艺术和时尚的融合。它吸引用户探索美学内容、浏览图片、了解品牌故事并购买产品。支持11种语言（如中文、英文、葡萄牙语），在手机和电脑上流畅显示，文字和图片可适配不同屏幕。

---

### ⟦代码功能（简易解释）⟧

**1. 多语言支持：**

• 用户从导航栏选择语言（如中文、英文、葡萄牙语），文字即时更新。

• PHP 保存所选语言，翻译内容存储在 `$translations` 数组中。

**2. 页面内容：**

• 包含12个部分：导航栏、大横幅、品牌故事、图片画廊、灵感故事、用户评价、品牌历程、活动预告、社区、三大主题、行动号召、页脚。

• 画廊展示16张图片，可点击放大。

**3. 美观与互动：**

• 使用 Bootstrap 5.3 实现手机与电脑自适应布局。

• 动画让文字和图片平滑出现。

• 点击图片弹出大图（Lightbox 效果）。

• 阿拉伯语页面为从右到左排列。

**4. 图片管理：**

• 图片（如 `gallery_1.jpg`）从 **images** 文件夹加载。

**5. 数据库连接：**

• 连接名为 `haf_db` 的数据库，用于显示动态内容（如产品）。
• PHP 使用 MySQL 获取数据。

---

### ⟦使用技术⟧

• **PHP**：处理语言切换与数据库内容。

• **HTML5**：搭建页面结构（如导航、画廊）。

• **CSS3**：美化颜色、字体、动画，结合 Bootstrap 5.3 实现响应式设计。

• **JavaScript**：处理图片放大、语言切换等交互。

• **外部工具**：Bootstrap（布局）、Font Awesome（图标）、Animate.css（动画）、Google Fonts（字体）。

---

### ⁅用户体验⁆

访问 `http://localhost/hsbm/index.php`：

• **视觉**：温暖色调（米色、象牙白），动画流畅，布局整齐。

• **互动**：可切换语言、点击放大图片、使用按钮导航。

• **多语言**：支持中文、英文、马来文等，内容即时更新。

• **设备兼容**：适配手机与电脑。

---

### ⟦如何运行代码（在 WAMP 上）⟧

**1. 安装 WAMP：**

• 从 [www.wampserver.com](http://www.wampserver.com) 下载并安装 WAMP。

• 启动 WAMP，托盘图标应为绿色。

2. 放置文件：

⁕将 hsbm 文件夹（含 index.php、images 和 sql/haf_db.sql）复制到 C:\wamp64\www。

⁕⚠️ 重要：下载后若文件夹名称不是 hsbm，请先将其重命名为 hsbm，再放入 C:\wamp64\www。

**3. 设置数据库：**

• 打开浏览器：`http://localhost/phpmyadmin`

• 登录（用户名：root，无密码）。

• 创建数据库 `haf_db` → 点击 **导入** → 选择 `hsbm/sql/haf_db.sql` → 点击 **执行**。

**4. 运行网站：**

• 浏览器访问 `http://localhost/hsbm/index.php`

• 测试功能：切换语言、点击放大图片、跳转页面。

**5. 问题排查：**

• **图片不显示？** 检查 `images` 文件夹是否存在于 `C:\wamp64\www\hsbm`。

• **页面空白？** 检查 WAMP 图标是否为绿色，并确认路径正确。

---

## ⟦Pengenalan dan Penjelasan Kod Laman Web HAF⟧

### ⟦Gambaran Laman Web⟧

Laman web "HAF - History, Art & Fashion" ialah galeri digital yang anggun, mempamerkan gabungan sejarah, seni, dan fesyen. Ia mengajak pengguna meneroka kandungan estetik, melihat gambar, memahami kisah jenama, dan membeli produk. Ia menyokong 11 bahasa (contohnya, Melayu, Inggeris, Portugis), serta dipaparkan dengan lancar di telefon dan komputer.

---

### ⟦Fungsi Kod (Penerangan Mudah)⟧

**1. Sokongan Berbilang Bahasa:**

• Pengguna memilih bahasa (contohnya, Melayu, Inggeris, Portugis) dari bar navigasi, dan teks akan bertukar serta-merta.

• PHP menyimpan pilihan bahasa; terjemahan disimpan dalam array `$translations`.

**2. Kandungan Laman:**

• Terdiri daripada 12 bahagian: bar navigasi, sepanduk, kisah jenama, galeri gambar, cerita inspirasi, testimoni, perjalanan jenama, acara, komuniti, tema, seruan tindakan, dan kaki laman.

• Galeri memaparkan 16 gambar yang boleh diklik untuk pembesaran.

**3. Reka Bentuk dan Interaksi:**

• Bootstrap 5.3 memastikan susun atur yang responsif untuk telefon dan komputer.

• Animasi menjadikan teks dan imej muncul dengan lancar.

• Klik gambar akan membuka paparan besar (kesan Lightbox).

• Halaman Bahasa Arab disusun dari kanan ke kiri.

**4. Pengurusan Gambar:**

• Imej (contohnya, `gallery_1.jpg`) dimuatkan daripada folder **images**.

**5. Sambungan Pangkalan Data:**

• Bersambung ke pangkalan data `haf_db` untuk kandungan dinamik (seperti produk).

• PHP menggunakan MySQL untuk mengambil data.

---

### ⟦Teknologi yang Digunakan⟧

• **PHP** – Mengurus penukaran bahasa dan kandungan pangkalan data.

• **HTML5** – Membina struktur halaman (seperti navigasi dan galeri).

• **CSS3** – Menggayakan warna, fon, dan animasi dengan Bootstrap 5.3 untuk reka bentuk responsif.

• **JavaScript** – Mengendalikan interaksi seperti pembesaran gambar dan pertukaran bahasa.

• **Alat Luaran** – Bootstrap (susun atur), Font Awesome (ikon), Animate.css (animasi), Google Fonts (fon pelbagai bahasa).

---

### ⁅Pengalaman Pengguna⁆

Lawati `http://localhost/hsbm/index.php`:

• **Visual:** Warna hangat (krem, gading), animasi lancar, susun atur kemas.

• **Interaksi:** Tukar bahasa, besarkan gambar, navigasi dengan butang.

• **Berbilang Bahasa:** Menyokong Melayu, Inggeris, Cina, dll., dengan teks dikemas kini serta-merta.

• **Mesra Peranti:** Berfungsi dengan baik di telefon dan komputer.

---

### ⟦Cara Menjalankan Kod (di WAMP)⟧

**1. Pasang WAMP:**

• Muat turun dan pasang WAMP dari [www.wampserver.com](http://www.wampserver.com).

• Mulakan WAMP dan pastikan ikon dulang berwarna hijau.

2. Letakkan Fail:

⁕Salin folder hsbm (mengandungi index.php, images, dan sql/haf_db.sql) ke C:\wamp64\www.

⁕⚠️ Penting: Jika nama folder bukan hsbm, namakan semula folder kepada hsbm sebelum meletakkannya ke dalam C:\wamp64\www.

**3. Sediakan Pangkalan Data:**

• Buka pelayar: `http://localhost/phpmyadmin`.

• Log masuk (nama pengguna: root, tiada kata laluan).

• Cipta pangkalan data `haf_db`, klik **Import**, pilih `hsbm/sql/haf_db.sql`, dan klik **Go**.

**4. Jalankan Laman Web:**

• Buka pelayar → `http://localhost/hsbm/index.php`

• Uji ciri: tukar bahasa, besarkan gambar, navigasi halaman.

**5. Penyelesaian Masalah:**

• **Gambar tiada?** Pastikan folder `images` wujud dalam `C:\wamp64\www\hsbm`.

• **Halaman kosong?** Semak ikon WAMP hijau dan laluan fail betul.

