<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Наши работы | ТК Континент</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .works-hero { background: linear-gradient(rgba(0,21,41,0.85), rgba(0,15,31,0.95)), url('https://images.pexels.com/photos/4481259/pexels-photo-4481259.jpeg?w=1200') center/cover; padding: 80px 0; text-align: center; }
        .portfolio-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 30px; margin: 50px 0; }
        .portfolio-card { background: rgba(255,255,255,0.03); border-radius: 12px; overflow: hidden; transition: transform 0.3s; border: 1px solid rgba(212,175,55,0.1); }
        .portfolio-card:hover { transform: translateY(-5px); border-color: #d4af37; }
        .portfolio-img { height: 220px; background-size: cover; background-position: center; }
        .portfolio-content { padding: 20px; }
        .portfolio-tag { display: inline-block; background: #ff851b; color: #fff; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; margin-bottom: 12px; }
        .stat-big { font-size: 2rem; font-weight: bold; color: #d4af37; }
        .stats-mini { display: flex; gap: 30px; margin-top: 20px; justify-content: center; flex-wrap: wrap; }
        
        /* Адаптация для телефонов */
        @media (max-width: 768px) { 
            .portfolio-grid { 
                grid-template-columns: 1fr; 
                gap: 20px;
                margin: 30px 0;
            }
            
            .stats-mini { 
                gap: 15px; 
                justify-content: center;
            }
            
            .stats-mini > div { 
                text-align: center; 
                min-width: 80px;
            }
            
            .stat-big { 
                font-size: 1.3rem; 
            }
            
            .stats-mini > div div:last-child { 
                font-size: 0.7rem; 
            }
            
            .works-hero { 
                padding: 50px 0; 
            }
            
            .works-hero h1 { 
                font-size: 1.8rem; 
            }
            
            .works-hero p { 
                font-size: 0.9rem; 
            }
            
            section[style*="padding: 60px 0;"] {
                padding: 30px 0 !important;
            }
            
            section[style*="padding: 0 0 60px 0;"] {
                padding: 0 0 30px 0 !important;
            }
            
            .calc-section {
                padding: 40px 0 !important;
            }
            
            .calc-section h2 {
                font-size: 1.3rem !important;
            }
            
            .calc-section p {
                font-size: 0.85rem !important;
                margin-bottom: 20px !important;
            }
        }
        
        @media (max-width: 480px) {
            .stat-big { 
                font-size: 1.1rem; 
            }
            
            .stats-mini > div div:last-child { 
                font-size: 0.6rem; 
            }
            
            .stats-mini { 
                gap: 10px; 
            }
            
            .portfolio-content h3 {
                font-size: 1rem;
            }
            
            .portfolio-content p {
                font-size: 0.8rem;
            }
            
            .portfolio-tag {
                font-size: 0.65rem;
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
            <nav class="nav-menu">
                <a href="about.php">О компании</a>
                <a href="works.php">Наши работы</a>
                <a href="contacts.php">Контакты</a>
            </nav>
            <div class="header-contacts">
                <div class="header-phone">
                    <a href="tel:+79133777066"> +7 (913) 377-70-66</a>
                </div>
                <div class="header-email">
                    <a href="mailto:kargo.54@mail.ru"> kargo.54@mail.ru</a>
                </div>
            </div>
        </div>
    </header>

    <script>
        let clickCount = 0, clickTimer = null;
        let secretLogo = document.getElementById('secretLogo');
        if (secretLogo) {
            secretLogo.addEventListener('click', function() {
                clickCount++; 
                clearTimeout(clickTimer);
                if (clickCount === 5) { 
                    window.location.href = 'admin.php'; 
                    clickCount = 0; 
                }
                clickTimer = setTimeout(() => { clickCount = 0; }, 1000);
            });
        }
    </script>

    <section class="works-hero">
        <div class="container">
            <h1>Наши <span class="accent-gold">работы</span></h1>
            <p>Реальные кейсы и довольные клиенты по всей России</p>
        </div>
    </section>

    <section style="padding: 40px 0;">
        <div class="container">
            <div class="stats-mini">
                <div><div class="stat-big">500+</div><div>Выполненных перевозок</div></div>
                <div><div class="stat-big">98%</div><div>Клиентов возвращаются</div></div>
                <div><div class="stat-big">50+</div><div>Единиц техники</div></div>
                <div><div class="stat-big">15</div><div>Регионов РФ</div></div>
            </div>
        </div>
    </section>

    <section style="padding: 0 0 40px 0;">
        <div class="container">
            <h2 class="section-title">Примеры наших перевозок</h2>
            <div class="portfolio-grid">
                <div class="portfolio-card">
                    <div class="portfolio-img" style="background-image: url('https://kargo-54.ru/image/portfolio/4.jpg');"></div>
                    <div class="portfolio-content">
                        <span class="portfolio-tag">Строительные материалы</span>
                        <h3>Москва → Новосибирск</h3>
                        <p>Перевозка 45 тонн строительных материалов. Доставка за 5 дней.</p>
                        <small>Клиент: ООО "СтройИнвест"</small>
                    </div>
                </div>
                <div class="portfolio-card">
                    <div class="portfolio-img" style="background-image: url('https://kargo-54.ru/image/portfolio/8.jpg');"></div>
                    <div class="portfolio-content">
                        <span class="portfolio-tag">Оборудование</span>
                        <h3>СПб → Владивосток</h3>
                        <p>Доставка промышленного оборудования через всю страну.</p>
                        <small>Клиент: Завод "ТехноПром"</small>
                    </div>
                </div>
                <div class="portfolio-card">
                    <div class="portfolio-img" style="background-image: url('https://kargo-54.ru/image/portfolio/7.jpg');"></div>
                    <div class="portfolio-content">
                        <span class="portfolio-tag">Скоропорт</span>
                        <h3>Новосибирск → Москва</h3>
                        <p>Срочная перевозка медикаментов за 48 часов.</p>
                        <small>Клиент: Аптечная сеть "Здоровье"</small>
                    </div>
                </div>
                <div class="portfolio-card">
                    <div class="portfolio-img" style="background-image: url('https://kargo-54.ru/image/portfolio/14.jpg');"></div>
                    <div class="portfolio-content">
                        <span class="portfolio-tag">Продукты питания</span>
                        <h3>Краснодар → Екатеринбург</h3>
                        <p>Рефрижератор, контроль температуры -18°C.</p>
                        <small>Клиент: ТД "Фруктовый рай"</small>
                    </div>
                </div>
                <div class="portfolio-card">
                    <div class="portfolio-img" style="background-image: url('https://kargo-54.ru/image/foto-kargo4.jpg');"></div>
                    <div class="portfolio-content">
                        <span class="portfolio-tag">Мебель</span>
                        <h3>Москва → Иркутск</h3>
                        <p>Перевозка мебели для гостиничного комплекса.</p>
                        <small>Клиент: ГК "Байкал-Отель"</small>
                    </div>
                </div>
                <div class="portfolio-card">
                    <div class="portfolio-img" style="background-image: url('https://kargo-54.ru/image/portfolio/15.jpg');"></div>
                    <div class="portfolio-content">
                        <span class="portfolio-tag">Автозапчасти</span>
                        <h3>Владивосток → Новосибирск</h3>
                        <p>Таможенное оформление, страховка груза.</p>
                        <small>Клиент: Авто-Сибирь</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="calc-section" style="background: #1D4A6A; padding: 30px 0; margin-top: 0;">
        <div class="container" style="text-align: center;">
            <h2 style="color: #d4af37; font-size: 1.6rem; margin-bottom: 10px;">Хотите стать нашим следующим клиентом?</h2>
            <p style="margin-bottom: 20px; font-size: 0.95rem;">Оставьте заявку и получите индивидуальное предложение</p>
            <a href="index.php#calc" class="btn btn-orange">Рассчитать стоимость</a>
        </div>
    </section>

    <footer class="site-footer">
        <div class="container">
            <p>&copy; 2026 ООО «Континент» | <a href="about.php">О компании</a> | <a href="works.php">Наши работы</a> | <a href="contacts.php">Контакты</a></p>
        </div>
    </footer>
</body>
</html>