<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты | ТК Континент</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .contacts-hero { background: linear-gradient(rgba(0,21,41,0.85), rgba(0,15,31,0.95)), url('https://images.unsplash.com/photo-1556740758-90de374c12ad?w=1200') center/cover; padding: 80px 0; text-align: center; }
        .contact-info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 50px; margin: 60px 0; }
        .contact-card { background: rgba(255,255,255,0.03); padding: 30px; border-radius: 12px; margin-bottom: 20px; transition: 0.3s; }
        .contact-card:hover { background: rgba(255,255,255,0.06); }
        .contact-icon { font-size: 2rem; margin-bottom: 10px; }
        .requisites { background: rgba(212,175,55,0.05); padding: 25px; border-radius: 12px; margin-top: 30px; }
        .map-full { margin-top: 40px; border-radius: 12px; overflow: hidden; }
        .social-links { display: flex; gap: 20px; margin-top: 20px; }
        .social-link { display: inline-flex; align-items: center; gap: 10px; background: rgba(255,255,255,0.1); padding: 10px 20px; border-radius: 8px; text-decoration: none; color: #fff; transition: 0.3s; }
        .social-link:hover { background: #ff851b; transform: translateY(-2px); }
        @media (max-width: 768px) { .contact-info-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

    <header class="site-header">
        <div class="container header-flex">
            <div class="logo"><span class="logo-main">КОНТИНЕНТ</span><span class="logo-sub">транспортная компания</span></div>
            <nav class="nav-menu">
                <a href="index.php">Главная</a>
                <a href="about.php">О компании</a>
                <a href="works.php">Наши работы</a>
                <a href="contacts.php">Контакты</a>
                <a href="admin.php" class="admin-link-btn">Админ-панель</a>
            </nav>
            <div class="header-phone"><a href="tel:+73830000000">+7 (383) 000-00-00</a></div>
        </div>
    </header>

    <section class="contacts-hero">
        <div class="container"><h1>Контактная <span class="accent-gold">информация</span></h1><p>Свяжитесь с нами любым удобным способом</p></div>
    </section>

    <div class="container">
        <div class="contact-info-grid">
            <div>
                <div class="contact-card">
                    <div class="contact-icon">📍</div>
                    <h3>Главный офис</h3>
                    <p>г. Новосибирск, ул. Транспортная, д. 45, офис 302</p>
                    <small style="color: #aaa;">БЦ "Логист", 3 этаж</small>
                </div>
                
                <div class="contact-card">
                    <div class="contact-icon">📞</div>
                    <h3>Телефоны</h3>
                    <p><a href="tel:+73830000000" style="color:#fff;">+7 (383) 000-00-00</a> (многоканальный)</p>
                    <p><a href="tel:+79990000000" style="color:#fff;">+7 (999) 000-00-00</a> (отдел продаж)</p>
                    <p><a href="tel:+78000000000" style="color:#fff;">8 (800) 000-00-00</a> (бесплатно по РФ)</p>
                </div>
                
                <div class="contact-card">
                    <div class="contact-icon">✉️</div>
                    <h3>Email</h3>
                    <p><a href="mailto:info@kargo-54.ru" style="color:#fff;">info@kargo-54.ru</a> - общие вопросы</p>
                    <p><a href="mailto:sales@kargo-54.ru" style="color:#fff;">sales@kargo-54.ru</a> - коммерческий отдел</p>
                </div>
                
                <div class="contact-card">
                    <div class="contact-icon">⏰</div>
                    <h3>Режим работы</h3>
                    <p>Пн — Пт: 9:00 — 18:00 (Новосибирское время)</p>
                    <p>Сб — Вс: выходной</p>
                    <p>Диспетчерская: круглосуточно</p>
                </div>

                <div class="social-links">
                    <a href="#" class="social-link">📱 Telegram</a>
                    <a href="#" class="social-link">💬 WhatsApp</a>
                    <a href="#" class="social-link">📘 VK</a>
                </div>
            </div>

            <div>
                <div class="contact-card">
                    <div class="contact-icon">📄</div>
                    <h3>Реквизиты компании</h3>
                    <div class="requisites">
                        <p><strong>ООО "ТК Континент"</strong></p>
                        <p>ИНН: 5400000000</p>
                        <p>КПП: 540001001</p>
                        <p>ОГРН: 1235400000000</p>
                        <p>Р/с: 40702810100000000000</p>
                        <p>Банк: СИБИРСКИЙ БАНК ПАО СБЕРБАНК</p>
                        <p>БИК: 045004000</p>
                        <p>К/с: 30101810600000000000</p>
                    </div>
                </div>

                <div class="contact-card">
                    <div class="contact-icon">🚚</div>
                    <h3>Складские терминалы</h3>
                    <p><strong>Склад приема грузов:</strong> г. Новосибирск, ул. Промышленная, д. 12</p>
                    <p><strong>Склад выдачи:</strong> г. Новосибирск, ул. Логистическая, д. 8</p>
                    <p><strong>Московский склад:</strong> Московская обл., г. Подольск, ул. Транспортная, д. 5</p>
                </div>
            </div>
        </div>

        <div class="map-full">
            <iframe src="https://yandex.ru/map-widget/v1/?ll=82.920430%2C55.030199&z=12&l=map" width="100%" height="400" frameborder="0" style="border-radius: 12px;"></iframe>
        </div>
    </div>

    <section style="padding: 60px 0; background: #001f3f; margin-top: 50px;">
        <div class="container" style="text-align: center;">
            <h2 style="color: #d4af37;">Остались вопросы?</h2>
            <p style="margin-bottom: 30px;">Заполните форму или позвоните нам — ответим на все вопросы!</p>
            <a href="index.php#calc" class="btn btn-orange">Оставить заявку</a>
        </div>
    </section>

    <footer class="site-footer">
        <div class="container"><p>&copy; 2024 ТК «Континент» | <a href="about.php">О компании</a> | <a href="works.php">Наши работы</a> | <a href="contacts.php">Контакты</a></p></div>
    </footer>
</body>
</html>