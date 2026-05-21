<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты | ТК Континент</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Дополнительные стили для выравнивания */
        .contact-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin: 50px 0 30px 0;
            align-items: stretch;
        }
        .contact-card {
            background: rgba(255,255,255,0.05);
            padding: 30px;
            border-radius: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .map-full {
            border-radius: 20px;
            overflow: hidden;
            height: 100%;
            min-height: 380px;
        }
        .map-full iframe {
            width: 100%;
            height: 100%;
            min-height: 380px;
        }
        @media (max-width: 768px) {
            .contact-wrapper {
                grid-template-columns: 1fr;
                gap: 30px;
                margin: 30px 0;
            }
            .map-full {
                min-height: 300px;
            }
        }
    </style>
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

<section style="background: linear-gradient(rgba(0,21,41,0.85), rgba(0,15,31,0.95)), url('https://images.unsplash.com/photo-1556740758-90de374c12ad?w=1200') center/cover; padding: 80px 0; text-align: center;">
    <div class="container">
        <h1 style="font-size: 3rem;">Контактная <span class="accent-gold">информация</span></h1>
        <p>Свяжитесь с нами любым удобным способом</p>
    </div>
</section>

<div class="container">
    <div class="contact-wrapper">
        <!-- Левая колонка - информация -->
        <div class="contact-card">
            <div style="margin-bottom: 25px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 15px;">
                <div style="font-size: 1.2rem; font-weight: 700; color: #d4af37; margin-bottom: 8px;">📍 Главный офис</div>
                <p>г. Новосибирск, ул. Красногорская, д. 28/1</p>
            </div>
            <div style="margin-bottom: 25px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 15px;">
                <div style="font-size: 1.2rem; font-weight: 700; color: #d4af37; margin-bottom: 8px;">📞 Телефон</div>
                <p><a href="tel:+79133777066" style="color: #fff; text-decoration: none;">+7 (913) 377-70-66</a></p>
            </div>
            <div style="margin-bottom: 25px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 15px;">
                <div style="font-size: 1.2rem; font-weight: 700; color: #d4af37; margin-bottom: 8px;">✉️ Email</div>
                <p><a href="mailto:kargo.54@mail.ru" style="color: #fff; text-decoration: none;">kargo.54@mail.ru</a></p>
            </div>
            <div>
                <div style="font-size: 1.2rem; font-weight: 700; color: #d4af37; margin-bottom: 8px;">⏰ Режим работы</div>
                <p>Пн — Пт: 9:00 — 18:00</p>
                <p>Сб — Вс: выходной</p>
            </div>
        </div>

        <!-- Правая колонка - карта -->
        <div class="map-full">
            <iframe src="https://yandex.ru/map-widget/v1/?text=Красногорская%2028/1%20Новосибирск&z=17&l=map" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
</div>

<!-- Блок "Остались вопросы?" - прижат к карте -->
<section style="background: #1D4A6A; padding: 20px 0 50px 0;">
    <div class="container">
        <div style="text-align: center; background: rgba(255,255,255,0.05); border-radius: 30px; padding: 40px;">
            <h2 style="color: #d4af37; font-size: 1.8rem; margin-bottom: 10px;">Остались вопросы?</h2>
            <p style="margin-bottom: 25px; font-size: 1rem;">Мы всегда на связи и готовы помочь!</p>
            <div style="display: flex; justify-content: center; gap: 40px; flex-wrap: wrap; margin-bottom: 25px;">
                <div style="text-align: center;">
                    <a href="tel:+79133777066" style="color: #ff851b; text-decoration: none; font-size: 1.2rem; font-weight: bold;">+7 (913) 377-70-66</a>
                    <p style="font-size: 0.8rem; margin-top: 5px;">Звоните с 9:00 до 18:00</p>
                </div>
                <div style="text-align: center;">
                    <a href="mailto:kargo.54@mail.ru" style="color: #ff851b; text-decoration: none; font-size: 1.2rem; font-weight: bold;">kargo.54@mail.ru</a>
                    <p style="font-size: 0.8rem; margin-top: 5px;">Ответим в течение часа</p>
                </div>
            </div>
            <a href="index.php#calc" class="btn btn-orange">Отправить заявку</a>
        </div>
    </div>
</section>

<footer class="site-footer">
    <div class="container"><p>&copy; 2026 ООО «Континент» | <a href="about.php">О компании</a> | <a href="works.php">Наши работы</a> | <a href="contacts.php">Контакты</a></p></div>
</footer>

</body>
</html>