<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>О компании | ТК Континент</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="site-header">
    <div class="container header-flex">
        <a href="index.php" class="logo-link" id="secretLogo">
            <div class="logo">
                <img src="images/logo.png" alt="ТК Континент" class="logo-img">
                <span class="logo-main">КОНТИНЕНТ</span>
            </div>
        </a>
        
        <!-- Кнопка бургер-меню -->
        <button class="menu-toggle" id="menuToggle">
            <span></span>
            <span></span>
            <span></span>
        </button>
        
        <nav class="nav-menu" id="navMenu">
            <a href="about.php">О компании</a>
            <a href="works.php">Наши работы</a>
            <a href="contacts.php">Контакты</a>
        </nav>
        
        <div class="header-contacts">
            <div class="header-phone"><a href="tel:+79133777066">+7 (913) 377-70-66</a></div>
            <div class="header-email"><a href="mailto:kargo.54@mail.ru">kargo.54@mail.ru</a></div>
        </div>
    </div>
</header>

<!-- Затемнение фона -->
<div class="menu-overlay" id="menuOverlay"></div>

<script>
    // Бургер-меню
    const menuToggle = document.getElementById('menuToggle');
    const navMenu = document.getElementById('navMenu');
    const menuOverlay = document.getElementById('menuOverlay');
    
    function toggleMenu() {
        menuToggle.classList.toggle('active');
        navMenu.classList.toggle('active');
        menuOverlay.classList.toggle('active');
        document.body.style.overflow = navMenu.classList.contains('active') ? 'hidden' : '';
    }
    
    function closeMenu() {
        menuToggle.classList.remove('active');
        navMenu.classList.remove('active');
        menuOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }
    
    menuToggle.addEventListener('click', toggleMenu);
    menuOverlay.addEventListener('click', closeMenu);
    
    // Закрываем меню при клике на ссылку
    document.querySelectorAll('.nav-menu a').forEach(link => {
        link.addEventListener('click', closeMenu);
    });
</script>
<script>
    let clickCount = 0, clickTimer = null;
    document.getElementById('secretLogo').addEventListener('click', function() {
        clickCount++;
        clearTimeout(clickTimer);
        if (clickCount === 5) { window.location.href = 'admin.php'; }
        clickTimer = setTimeout(() => { clickCount = 0; }, 1000);
    });
</script>

<section style="background: linear-gradient(rgba(0,21,41,0.85), rgba(0,15,31,0.95)), url('https://images.pexels.com/photos/4481259/pexels-photo-4481259.jpeg?w=1200') center/cover; padding: 80px 0; text-align: center;">
    <div class="container">
        <h1 style="font-size: 3rem; margin-bottom: 20px;">О компании <span class="accent-gold">«Континент»</span></h1>
        <p>Надежность, опыт, профессионализм с 2014 года</p>
    </div>
</section>

<section style="padding: 60px 0;">
    <div class="container">
        <div class="about-grid">
            <div>
                <h2 class="section-title left-align">Кто мы</h2>
                <p style="font-size: 1.1rem; line-height: 1.6;">Транспортная компания «Континент» — ведущий оператор грузоперевозок по России. Мы объединяем регионы и обеспечиваем надежную логистику для бизнеса любого масштаба.</p>
                <p>Наша миссия — сделать грузоперевозки прозрачными, быстрыми и доступными. Мы используем современные технологии управления перевозками, что позволяет нам предлагать конкурентные цены и гарантировать сохранность грузов.</p>
                
                <div style="background: rgba(212,175,55,0.1); border-left: 4px solid #d4af37; padding: 30px; margin: 40px 0; border-radius: 12px;">
                    <h3 style="color: #d4af37;">🎯 Наша миссия</h3>
                    <p>Стать логистическим партнером №1 для российского бизнеса, обеспечивая безупречное качество сервиса и индивидуальный подход к каждому клиенту.</p>
                </div>
                
                <h3>🏆 Наши преимущества</h3>
                <ul style="list-style: none; padding: 0;">
                    <li style="margin: 15px 0;">✅ <strong>10+ лет опыта</strong> — тысячи довольных клиентов по всей России</li>
                    <li style="margin: 15px 0;">✅ <strong>Прозрачные цены</strong> — фиксированные тарифы без скрытых платежей</li>
                    <li style="margin: 15px 0;">✅ <strong>Страхование грузов</strong> — полная защита вашего имущества</li>
                    <li style="margin: 15px 0;">✅ <strong>24/7 поддержка</strong> — менеджер всегда на связи</li>
                    <li style="margin: 15px 0;">✅ <strong>Юридическая чистота</strong> — работаем по договору, все документы в срок</li>
                </ul>
            </div>
            <div>
                <img src="https://totalenergies.com/sites/g/files/nytnzq121/files/styles/crop_landscape_ratio_9_5/public/thumbnails/image/visuel_une_total_com_0.jpg?itok=U3TeLNpt" alt="О компании" style="width: 100%; border-radius: 12px; margin-bottom: 20px;">
                <img src="https://t4.ftcdn.net/jpg/06/23/82/89/360_F_623828986_br5debv0sVjqw2Wc7AWOmd1qcmGKRuqt.jpg" alt="Логистика" style="width: 100%; border-radius: 12px;">
                <img src="https://i.pinimg.com/originals/00/f9/77/00f977b75fe12867a4e4d78d155bb5b5.jpg" alt="Перевозки" style="width: 100%; border-radius: 12px; margin-top: 20px;">
            </div>
        </div>
    </div>
</section>

<footer class="site-footer">
    <div class="container"><p>&copy; 2026 ООО «Континент» | <a href="about.php">О компании</a> | <a href="works.php">Наши работы</a> | <a href="contacts.php">Контакты</a></p></div>
</footer>

</body>
</html>