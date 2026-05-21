<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Загрузка направлений из JSON
$directions_file = 'directions.json';
$directions = [];
if (file_exists($directions_file)) {
    $directions = json_decode(file_get_contents($directions_file), true);
}

$message_sent = false;
$calculated_price = 0;
$show_calculated_price = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'send_lead') {
    $route_id = intval($_POST['route']);
    $weight = floatval($_POST['weight']);
    $volume = floatval($_POST['volume']);
    $insurance_rate = isset($_POST['insurance']) ? floatval($_POST['insurance']) : 0;
    $cargo_value = floatval($_POST['cargo_value']);
    $phone = htmlspecialchars($_POST['phone']);
    $name = htmlspecialchars($_POST['name']);

    $selected_route = null;
    foreach ($directions as $dir) {
        if ($dir['id'] == $route_id) {
            $selected_route = $dir;
            break;
        }
    }

    if ($selected_route) {
        $cost_by_weight = $weight * $selected_route['price_per_kg'];
        $cost_by_volume = $volume * $selected_route['price_per_m3'];
        $base_cost = max($cost_by_weight, $cost_by_volume);
        $insurance_cost = $cargo_value * $insurance_rate;
        $calculated_price = $base_cost + $insurance_cost;
        $show_calculated_price = true;
    }
    
    $message_sent = true;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ТК Континент | Доставка грузов по России</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="site-header">
        <div class="container header-flex">
            <div class="logo">
                <span class="logo-main">КОНТИНЕНТ</span>
                <span class="logo-sub">транспортная компания</span>
            </div>
            <nav class="nav-menu">
                <a href="index.php">Главная</a>
                <a href="about.php">О компании</a>
                <a href="works.php">Наши работы</a>
                <a href="contacts.php">Контакты</a>
            </nav>
            <div class="header-phone">
                <a href="tel:+73830000000">+7 (383) 000-00-00</a>
            </div>
        </div>
    </header>

    <section class="hero-section">
        <div class="container hero-content">
            <h1>Надежная доставка грузов <span class="accent-gold">по всей России</span></h1>
            <p>Оптимальные тарифы, гарантия сохранности, контроль на всех этапах</p>
            <a href="#calc" class="btn btn-orange">Рассчитать стоимость</a>
        </div>
    </section>

    <section id="calc" class="calc-section">
        <div class="container">
            <h2 class="section-title">Расчет стоимости перевозки</h2>
            
            <?php if ($message_sent && $show_calculated_price): ?>
                <div class="alert alert-success">
                    <h3>✅ Заявка успешно отправлена!</h3>
                    <p>Менеджер свяжется с вами в ближайшее время.</p>
                    <p class="final-price">🎯 Ориентировочная стоимость перевозки: <span><?= number_format($calculated_price, 2, ',', ' ') ?> руб.</span></p>
                    <small style="display: block; margin-top: 15px;">* Точная стоимость будет рассчитана менеджером после подтверждения всех деталей</small>
                </div>
            <?php elseif ($message_sent): ?>
                <div class="alert alert-success">
                    <h3>✅ Заявка успешно отправлена!</h3>
                    <p>Менеджер свяжется с вами для расчета точной стоимости перевозки.</p>
                </div>
            <?php endif; ?>

            <div class="calc-grid">
                <div class="calc-form-container">
                    <form method="POST" id="main-calculator">
                        <input type="hidden" name="action" value="send_lead">
                        
                        <div class="form-group">
                            <label for="route">📦 Направление перевозки:</label>
                            <select name="route" id="route" required>
                                <option value="">-- Выберите направление --</option>
                                <?php foreach ($directions as $dir): ?>
                                    <option value="<?= $dir['id'] ?>" 
                                            data-kg="<?= $dir['price_per_kg'] ?>" 
                                            data-m3="<?= $dir['price_per_m3'] ?>">
                                        <?= htmlspecialchars($dir['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="weight">⚖️ Вес (кг):</label>
                                <input type="number" name="weight" id="weight" step="0.1" value="100" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="volume">📐 Объем (м³):</label>
                                <input type="number" name="volume" id="volume" step="0.01" value="0.5" min="0" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cargo_value">💰 Оценочная стоимость груза (руб):</label>
                            <input type="number" name="cargo_value" id="cargo_value" value="50000" min="0">
                        </div>

                        <!-- Страхование - опционально -->
                        <div class="insurance-box" id="insurance">
                            <label class="checkbox-label">
                                <input type="checkbox" id="insurance_checkbox">
                                <span class="custom-checkbox"></span>
                                <div>
                                    <strong>🛡️ Страхование груза (рекомендуется)</strong>
                                    <small>Защита от повреждений, кражи и потери</small>
                                </div>
                            </label>
                            
                            <div id="insurance_options" style="display: none; margin-top: 15px; margin-left: 30px;">
                                <div class="insurance-options">
                                    <label class="radio-label">
                                        <input type="radio" name="insurance" value="0.01" checked>
                                        <strong>Базовый тариф (1%)</strong>
                                        <small>Полная защита от стандартных рисков</small>
                                    </label>
                                    <label class="radio-label">
                                        <input type="radio" name="insurance" value="0.03">
                                        <strong>Премиум тариф (3%)</strong>
                                        <small>Расширенная защита + форс-мажор</small>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">👤 Ваше имя:</label>
                                <input type="text" name="name" id="name" placeholder="Иван" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">📞 Телефон:</label>
                                <input type="tel" name="phone" id="phone" placeholder="+7 (999) 000-00-00" required>
                            </div>
                        </div>

                        <div class="info-tip">
                            💡 <strong>Подсказка:</strong> Заполните все поля и нажмите "Отправить заявку", чтобы получить ориентировочную стоимость перевозки
                        </div>

                        <button type="submit" class="btn btn-orange btn-full">📩 Отправить заявку и рассчитать стоимость</button>
                    </form>
                </div>

                <div class="calc-info-container">
                    <h3>📊 Актуальные тарифы</h3>
                    <table class="prices-table">
                        <thead>
                            <tr><th>Маршрут</th><th>За кг</th><th>За м³</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($directions as $dir): ?>
                            <tr><td><?= htmlspecialchars($dir['name']) ?></td><td><?= $dir['price_per_kg'] ?> ₽</td><td><?= $dir['price_per_m3'] ?> ₽</td></tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <p style="margin-top: 20px; font-size: 0.85rem; color: #aaa;">*Цены указаны без учета страховки и доп. услуг</p>
                    
                    <div class="info-box">
                        <h4>📝 Как рассчитать стоимость?</h4>
                        <p>1. Выберите направление перевозки<br>
                        2. Укажите вес и объем груза<br>
                        3. При необходимости добавьте страховку<br>
                        4. Нажмите "Отправить заявку"<br>
                        5. Менеджер рассчитает точную стоимость</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="features-section">
        <div class="container">
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🚛</div>
                    <h3>Собственный автопарк</h3>
                    <p>Более 50 единиц техники разной грузоподъемности</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📋</div>
                    <h3>Полный пакет документов</h3>
                    <p>Договоры, акты, закрывающие документы</p>
                </div>
                <div class="feature-card" id="secretButton">
                    <div class="feature-icon">🤝</div>
                    <h3>Индивидуальный подход</h3>
                    <p>Разработаем оптимальный маршрут под вас</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⭐</div>
                    <h3>Более 500 довольных клиентов</h3>
                    <p>Нас рекомендуют друзьям и партнерам</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="site-footer">
        <div class="container">
            <p>&copy; <?= date('Y') ?> ТК «Континент». Все права защищены.</p>
            <p><a href="about.php">О компании</a> | <a href="works.php">Наши работы</a> | <a href="contacts.php">Контакты</a></p>
        </div>
    </footer>

    <script>
        // Секретный кликер для входа в админку (5 кликов по карточке "Индивидуальный подход")
        let clickCount = 0;
        let clickTimer = null;
        
        let secretButton = document.getElementById('secretButton');
        if (secretButton) {
            secretButton.addEventListener('click', function(e) {
                e.stopPropagation();
                clickCount++;
                clearTimeout(clickTimer);
                
                if (clickCount === 1) {
                    this.style.transform = 'scale(0.98)';
                    setTimeout(() => { this.style.transform = ''; }, 200);
                }
                
                if (clickCount === 5) {
                    window.location.href = 'admin.php';
                    clickCount = 0;
                }
                
                clickTimer = setTimeout(function() {
                    clickCount = 0;
                }, 1000);
            });
        }

        // Логика для страхования
        let insuranceCheckbox = document.getElementById('insurance_checkbox');
        let insuranceOptions = document.getElementById('insurance_options');
        
        if (insuranceCheckbox) {
            insuranceCheckbox.addEventListener('change', function() {
                insuranceOptions.style.display = this.checked ? 'block' : 'none';
            });
        }
    </script>
</body>
</html>