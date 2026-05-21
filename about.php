<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>О компании | ТК Континент</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .about-hero {
            background: linear-gradient(rgba(0,21,41,0.85), rgba(0,15,31,0.95)), url('https://images.pexels.com/photos/4481259/pexels-photo-4481259.jpeg?w=1200') center/cover;
            padding: 80px 0;
            text-align: center;
        }
        .about-hero h1 { font-size: 3rem; margin-bottom: 20px; }
        .about-content { padding: 60px 0; }
        .mission-box {
            background: rgba(212,175,55,0.1);
            border-left: 4px solid #d4af37;
            padding: 30px;
            margin: 40px 0;
            border-radius: 12px;
        }
        .team-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 40px;
        }
        .team-card {
            text-align: center;
            background: rgba(255,255,255,0.03);
            padding: 25px;
            border-radius: 12px;
            transition: 0.3s;
        }
        .team-card:hover { transform: translateY(-5px); background: rgba(255,255,255,0.06); }
        .team-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #001f3f, #001226);
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            border: 2px solid #d4af37;
        }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 30px;
        }
        .gallery-item {
            border-radius: 12px;
            overflow: hidden;
            height: 200px;
            background-size: cover;
            background-position: center;
            transition: 0.3s;
        }
        .gallery-item:hover { transform: scale(1.02); }
        @media (max-width: 768px) { .team-grid, .gallery-grid { grid-template-columns: 1fr; } }
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
                    <a href="tel:+73830000000"> +7 (383) 000-00-00</a>
                </div>
                <div class="header-email">
                    <a href="mailto:info@kargo-54.ru"> info@kargo-54.ru</a>
                </div>
            </div>
        </div>
    </header>

    <script>
        let clickCount = 0;
        let clickTimer = null;
        const secretLogo = document.getElementById('secretLogo');
        if (secretLogo) {
            secretLogo.addEventListener('click', function() {
                clickCount++;
                clearTimeout(clickTimer);
                if (clickCount === 5) { window.location.href = 'admin.php'; clickCount = 0; }
                clickTimer = setTimeout(function() { clickCount = 0; }, 1000);
            });
        }
    </script>

    <section class="about-hero">
        <div class="container"><h1>О компании <span class="accent-gold">«Континент»</span></h1><p>Надежность, опыт, профессионализм с 2014 года</p></div>
    </section>

    <section class="about-content">
        <div class="container">
            <div class="about-grid">
                <div>
                    <h2 class="section-title left-align">Кто мы</h2>
                    <p style="font-size: 1.1rem; line-height: 1.6;">Транспортная компания «Континент» — ведущий оператор грузоперевозок по России. Мы объединяем регионы и обеспечиваем надежную логистику для бизнеса любого масштаба.</p>
                    <p>Наша миссия — сделать грузоперевозки прозрачными, быстрыми и доступными. Мы используем современные технологии управления перевозками, что позволяет нам предлагать конкурентные цены и гарантировать сохранность грузов.</p>
                    
                    <div class="mission-box">
                        <h3 style="color: #d4af37;"> Наша миссия</h3>
                        <p>Стать логистическим партнером №1 для российского бизнеса, обеспечивая безупречное качество сервиса и индивидуальный подход к каждому клиенту.</p>
                    </div>
                    
                    <h3> Наши преимущества</h3>
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