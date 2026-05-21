<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты | ТК Континент</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .contacts-hero { background: linear-gradient(rgba(0,21,41,0.85), rgba(0,15,31,0.95)), url('https://images.unsplash.com/photo-1556740758-90de374c12ad?w=1200') center/cover; padding: 80px 0; text-align: center; }
        .contact-wrapper { display: grid; grid-template-columns: 1fr 1fr; gap: 50px; margin: 60px 0; align-items: start; }
        .contact-card { background: rgba(255,255,255,0.05); padding: 30px; border-radius: 20px; transition: 0.3s; }
        .contact-card:hover { background: rgba(255,255,255,0.08); }
        .contact-item { margin-bottom: 25px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 15px; }
        .contact-item:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
        .contact-title { font-size: 1.2rem; font-weight: 700; color: #d4af37; margin-bottom: 8px; }
        .contact-item p { margin: 0; line-height: 1.4; }
        .contact-item a { color: #fff; text-decoration: none; }
        .contact-item a:hover { color: #ff851b; }
        .map-full { border-radius: 20px; overflow: hidden; height: 100%; min-height: 400px; }
        .map-full iframe { width: 100%; height: 100%; min-height: 400px; }
        @media (max-width: 768px) { 
            .contact-wrapper { grid-template-columns: 1fr; gap: 30px; }
            .contact-card { padding: 25px; }
            .map-full { min-height: 300px; }
            .map-full iframe { min-height: 300px; }
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

    <section class="contacts-hero">
        <div class="container"><h1>Контактная <span class="accent-gold">информация</span></h1><p>Свяжитесь с нами любым удобным способом</p></div>
    </section>

    <div class="container">
        <div class="contact-wrapper">
            <!-- Левая колонка - информация -->
            <div class="contact-card">
                <div class="contact-item">
                    <div class="contact-title"> Главный офис</div>
                    <p>г. Новосибирск, ул. Красногорская, д. 28/1</p>
                </div>
                
                <div class="contact-item">
                    <div class="contact-title"> Телефон</div>
                    <p><a href="tel:+79133777066">+7 (913) 377-70-66</a></p>
                </div>
                
                <div class="contact-item">
                    <div class="contact-title"> Email</div>
                    <p><a href="mailto:kargo.54@mail.ru">kargo.54@mail.ru</a></p>
                </div>
                
                <div class="contact-item">
                    <div class="contact-title"> Режим работы</div>
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

    <section style="padding: 60px 20px; background: #1D4A6A; margin-top: 50px;">
        <div class="container" style="text-align: center; background: rgba(255,255,255,0.05); border-radius: 30px; padding: 50px; backdrop-filter: blur(10px);">
            <h2 style="color: #d4af37; font-size: 2rem; margin-bottom: 15px;"> Остались вопросы?</h2>
            <p style="margin-bottom: 30px; font-size: 1.1rem;">Мы всегда на связи и готовы помочь!</p>
            <div style="display: flex; justify-content: center; gap: 30px; flex-wrap: wrap;">
                <div style="text-align: center;">
                    <div style="font-size: 2rem;"></div>
                    <a href="tel:+79133777066" style="color: #ff851b; text-decoration: none; font-size: 1.2rem; font-weight: bold;">+7 (913) 377-70-66</a>
                    <p style="font-size: 0.8rem;">Звоните с 9:00 до 18:00</p>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 2rem;"></div>
                    <a href="mailto:kargo.54@mail.ru" style="color: #ff851b; text-decoration: none; font-size: 1.2rem; font-weight: bold;">kargo.54@mail.ru</a>
                    <p style="font-size: 0.8rem;">Ответим в течение часа</p>
                </div>
            </div>
            <div style="margin-top: 30px;">
                <a href="index.php#calc" class="btn btn-orange" style="padding: 12px 30px;"> Отправить заявку</a>
            </div>
        </div>
    </section>

    <footer class="site-footer">
        <div class="container"><p>&copy; 2026 ООО «Континент» | <a href="about.php">О компании</a> | <a href="works.php">Наши работы</a> | <a href="contacts.php">Контакты</a></p></div>
    </footer>
</body>
</html>