<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'phpmailer/src/PHPMailer.php';
require_once 'phpmailer/src/SMTP.php';
require_once 'phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Загрузка направлений из JSON
$directions_file = 'directions.json';
$directions = [];
if (file_exists($directions_file)) {
    $directions = json_decode(file_get_contents($directions_file), true);
}

$message_sent = false;
$calculated_price = 0;
$show_calculated_price = false;
$mail_error = '';

function sendSmtpMail($to, $subject, $message) {
    $mail = new PHPMailer(true);
    try {
        // Настройки для Яндекса
        $mail->isSMTP();
        $mail->Host = 'smtp.yandex.ru';
        $mail->SMTPAuth = true;
        $mail->Username = 'pevasnetsov5677@yandex.ru';
        $mail->Password = 'tnujoyyvplozjneo';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';
        
        // Отключаем проверку сертификатов для Windows
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        
        $mail->setFrom('pevasnetsov5677@yandex.ru', 'ТК Континент');
        $mail->addAddress($to);
        
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

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
        
        // Сохраняем в файл
        $lead_data = date('Y-m-d H:i:s') . " | $name | $phone | {$selected_route['name']} | " . number_format($calculated_price, 2, ',', ' ') . " руб.\n";
        file_put_contents('leads.txt', $lead_data, FILE_APPEND);
        
        // Отправляем письмо
        $to = "podstrelov5567@mail.ru";
        $subject = "Новая заявка с сайта ТК Континент";
        
        $message = "
        <html>
        <head><meta charset='UTF-8'></head>
        <body style='font-family: Arial, sans-serif;'>
            <h2 style='color: #ff851b;'>📦 Новая заявка</h2>
            <table style='border-collapse: collapse; width: 100%;'>
                <tr><td style='padding: 8px; background: #f5f5f5;'><strong>👤 Имя:</strong></td><td>$name</td></tr>
                <tr><td style='padding: 8px; background: #f5f5f5;'><strong>📞 Телефон:</strong></td><td>$phone</td></tr>
                <tr><td style='padding: 8px; background: #f5f5f5;'><strong>🗺️ Направление:</strong></td><td>{$selected_route['name']}</td></tr>
                <tr><td style='padding: 8px; background: #f5f5f5;'><strong>⚖️ Вес:</strong></td><td>$weight кг</td></tr>
                <tr><td style='padding: 8px; background: #f5f5f5;'><strong>📐 Объем:</strong></td><td>$volume м³</td></tr>
                <tr style='background: #fff3e0;'><td style='padding: 10px;'><strong>💰 ИТОГО:</strong></td><td><strong style='color: #ff851b;'>" . number_format($calculated_price, 2, ',', ' ') . " ₽</strong></td></tr>
            </table>
        </body>
        </html>
        ";
        
        $mail_result = sendSmtpMail($to, $subject, $message);
        if (!$mail_result) {
            $mail_error = "Письмо не отправлено, но заявка сохранена в leads.txt";
        }
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
                    <a href="tel:+73830000000">📞 +7 (383) 000-00-00</a>
                </div>
                <div class="header-email">
                    <a href="mailto:kargo.54@mail.ru">✉️ kargo.54@mail.ru</a>
                </div>
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
                    <p class="final-price">🎯 Ориентировочная стоимость: <span><?= number_format($calculated_price, 2, ',', ' ') ?> руб.</span></p>
                    <?php if ($mail_error): ?>
                        <small style="color: orange;">⚠️ <?= $mail_error ?></small>
                    <?php endif; ?>
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
                                    <option value="<?= $dir['id'] ?>"><?= htmlspecialchars($dir['name']) ?></option>
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

                        <div class="insurance-box">
                            <label class="checkbox-label">
                                <input type="checkbox" id="insurance_checkbox">
                                <strong>🛡️ Страхование груза (рекомендуется)</strong>
                            </label>
                            <div id="insurance_options" style="display: none; margin-top: 15px;">
                                <label class="radio-label"><input type="radio" name="insurance" value="0.01" checked> Базовый тариф (1%)</label>
                                <label class="radio-label"><input type="radio" name="insurance" value="0.03"> Премиум тариф (3%)</label>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">👤 Ваше имя:</label>
                                <input type="text" name="name" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">📞 Телефон:</label>
                                <input type="tel" name="phone" id="phone" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-orange btn-full">📩 Отправить заявку</button>
                    </form>
                </div>

                <div class="calc-info-container">
                    <h3>📊 Актуальные тарифы</h3>
                    <table class="modern-table">
                        <thead><tr><th>Маршрут</th><th>За кг</th><th>За м³</th></tr></thead>
                        <tbody>
                            <?php foreach ($directions as $dir): ?>
                            <tr><td><?= htmlspecialchars($dir['name']) ?></td><td><?= $dir['price_per_kg'] ?> ₽</td><td><?= $dir['price_per_m3'] ?> ₽</td></tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <footer class="site-footer">
        <div class="container">
            <p>&copy; <?= date('Y') ?> ТК «Континент»</p>
        </div>
    </footer>

    <script>
        document.getElementById('insurance_checkbox')?.addEventListener('change', function() {
            document.getElementById('insurance_options').style.display = this.checked ? 'block' : 'none';
        });
        
        let clickCount = 0, clickTimer = null;
        document.getElementById('secretButton')?.addEventListener('click', function() {
            clickCount++;
            clearTimeout(clickTimer);
            if (clickCount === 5) { window.location.href = 'admin.php'; }
            clickTimer = setTimeout(() => { clickCount = 0; }, 1000);
        });
    </script>
</body>
</html>