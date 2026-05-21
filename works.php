<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Наши работы | ТК Континент</title>
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
        <h1 style="font-size: 3rem;">Наши <span class="accent-gold">работы</span></h1>
        <p>Реальные кейсы и довольные клиенты по всей России</p>
    </div>
</section>

<!-- Блок статистики - адаптивный -->
<section style="padding: 30px 0 20px 0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; text-align: center;">
            <div>
                <div style="font-size: 2rem; font-weight: bold; color: #d4af37;">500+</div>
                <div style="font-size: 0.9rem;">Выполненных перевозок</div>
            </div>
            <div>
                <div style="font-size: 2rem; font-weight: bold; color: #d4af37;">98%</div>
                <div style="font-size: 0.9rem;">Клиентов возвращаются</div>
            </div>
            <div>
                <div style="font-size: 2rem; font-weight: bold; color: #d4af37;">50+</div>
                <div style="font-size: 0.9rem;">Единиц техники</div>
            </div>
            <div>
                <div style="font-size: 2rem; font-weight: bold; color: #d4af37;">15</div>
                <div style="font-size: 0.9rem;">Регионов РФ</div>
            </div>
        </div>
    </div>
</section>

<!-- Карточки работ - отступ сверху 10px, снизу 30px -->
<section style="padding: 10px 0 30px 0;">
    <div class="container">
        <h2 class="section-title">Примеры наших перевозок</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px;">
            <div style="background: rgba(255,255,255,0.03); border-radius: 12px; overflow: hidden; transition: 0.3s; border: 1px solid rgba(212,175,55,0.1);">
                <div style="height: 220px; background-size: cover; background-position: center; background-image: url('https://kargo-54.ru/image/portfolio/4.jpg');"></div>
                <div style="padding: 20px;"><span style="display: inline-block; background: #ff851b; color: #fff; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem;">Строительные материалы</span><h3>Москва → Новосибирск</h3><p>Перевозка 45 тонн строительных материалов. Доставка за 5 дней.</p><small>Клиент: ООО "СтройИнвест"</small></div>
            </div>
            <div style="background: rgba(255,255,255,0.03); border-radius: 12px; overflow: hidden; transition: 0.3s; border: 1px solid rgba(212,175,55,0.1);">
                <div style="height: 220px; background-size: cover; background-position: center; background-image: url('https://kargo-54.ru/image/portfolio/8.jpg');"></div>
                <div style="padding: 20px;"><span style="display: inline-block; background: #ff851b; color: #fff; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem;">Оборудование</span><h3>СПб → Владивосток</h3><p>Доставка промышленного оборудования через всю страну.</p><small>Клиент: Завод "ТехноПром"</small></div>
            </div>
            <div style="background: rgba(255,255,255,0.03); border-radius: 12px; overflow: hidden; transition: 0.3s; border: 1px solid rgba(212,175,55,0.1);">
                <div style="height: 220px; background-size: cover; background-position: center; background-image: url('https://kargo-54.ru/image/portfolio/7.jpg');"></div>
                <div style="padding: 20px;"><span style="display: inline-block; background: #ff851b; color: #fff; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem;">Скоропорт</span><h3>Новосибирск → Москва</h3><p>Срочная перевозка медикаментов за 48 часов.</p><small>Клиент: Аптечная сеть "Здоровье"</small></div>
            </div>
            <div style="background: rgba(255,255,255,0.03); border-radius: 12px; overflow: hidden; transition: 0.3s; border: 1px solid rgba(212,175,55,0.1);">
                <div style="height: 220px; background-size: cover; background-position: center; background-image: url('https://kargo-54.ru/image/portfolio/14.jpg');"></div>
                <div style="padding: 20px;"><span style="display: inline-block; background: #ff851b; color: #fff; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem;">Продукты питания</span><h3>Краснодар → Екатеринбург</h3><p>Рефрижератор, контроль температуры -18°C.</p><small>Клиент: ТД "Фруктовый рай"</small></div>
            </div>
            <div style="background: rgba(255,255,255,0.03); border-radius: 12px; overflow: hidden; transition: 0.3s; border: 1px solid rgba(212,175,55,0.1);">
                <div style="height: 220px; background-size: cover; background-position: center; background-image: url('https://kargo-54.ru/image/foto-kargo4.jpg');"></div>
                <div style="padding: 20px;"><span style="display: inline-block; background: #ff851b; color: #fff; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem;">Мебель</span><h3>Москва → Иркутск</h3><p>Перевозка мебели для гостиничного комплекса.</p><small>Клиент: ГК "Байкал-Отель"</small></div>
            </div>
            <div style="background: rgba(255,255,255,0.03); border-radius: 12px; overflow: hidden; transition: 0.3s; border: 1px solid rgba(212,175,55,0.1);">
                <div style="height: 220px; background-size: cover; background-position: center; background-image: url('https://kargo-54.ru/image/portfolio/15.jpg');"></div>
                <div style="padding: 20px;"><span style="display: inline-block; background: #ff851b; color: #fff; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem;">Автозапчасти</span><h3>Владивосток → Новосибирск</h3><p>Таможенное оформление, страховка груза.</p><small>Клиент: Авто-Сибирь</small></div>
            </div>
        </div>
    </div>
</section>

<!-- Блок с призывом - минимальный отступ -->
<section style="background: #1D4A6A; padding: 10px 0;">
    <div class="container" style="text-align: center;">
        <h2 style="color: #d4af37; font-size: 1.4rem; margin-bottom: 5px;">Хотите стать нашим следующим клиентом?</h2>
        <p style="margin-bottom: 10px; font-size: 0.9rem;">Оставьте заявку и получите индивидуальное предложение</p>
        <a href="index.php#calc" class="btn btn-orange">Рассчитать стоимость</a>
    </div>
</section>

<footer class="site-footer">
    <div class="container"><p>&copy; 2026 ООО «Континент» | <a href="about.php">О компании</a> | <a href="works.php">Наши работы</a> | <a href="contacts.php">Контакты</a></p></div>
</footer>

</body>
</html>