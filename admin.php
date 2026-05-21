<?php
session_start();

// Простой пароль для защиты без БД
define('ADMIN_PASSWORD', 'Continent2026'); 

$directions_file = 'directions.json';
$error = '';
$success = '';

// Проверка авторизации
if (isset($_POST['login'])) {
    if ($_POST['password'] === ADMIN_PASSWORD) {
        $_SESSION['admin_auth'] = true;
    } else {
        $error = 'Неверный пароль!';
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit;
}

$is_logged_in = isset($_SESSION['admin_auth']) && $_SESSION['admin_auth'] === true;

// Загрузка данных
$directions = [];
if (file_exists($directions_file)) {
    $directions = json_decode(file_get_contents($directions_file), true);
}

// Обработка CRUD-действий (Сохранение изменений)
if ($is_logged_in && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    
    if ($_POST['action'] === 'save') {
        $updated_directions = [];
        if (isset($_POST['dir']) && is_array($_POST['dir'])) {
            foreach ($_POST['dir'] as $id => $data) {
                if (empty($data['name'])) continue; // Пропускаем пустые строки
                $updated_directions[] = [
                    'id' => intval($id),
                    'name' => htmlspecialchars($data['name']),
                    'price_per_kg' => floatval($data['price_per_kg']),
                    'price_per_m3' => floatval($data['price_per_m3'])
                ];
            }
        }
        
        // Добавление нового направления, если заполнено
        if (!empty($_POST['new_name'])) {
            $new_id = time(); // Простая генерация уникального ID
            $updated_directions[] = [
                'id' => $new_id,
                'name' => htmlspecialchars($_POST['new_name']),
                'price_per_kg' => floatval($_POST['new_price_per_kg']),
                'price_per_m3' => floatval($_POST['new_price_per_m3'])
            ];
        }

        file_put_contents($directions_file, json_encode($updated_directions, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        $directions = $updated_directions;
        $success = 'Данные успешно обновлены!';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель управления ценами | ТК Континент</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { background: #001226; color: #fff; }
        .admin-box { max-width: 900px; margin: 50px auto; background: rgba(255,255,255,0.05); padding: 30px; border-radius: 12px; border: 1px solid rgba(212,175,55,0.2); }
        .form-control-admin { background: #001f3f; border: 1px solid rgba(255,255,255,0.2); color: #fff; padding: 8px; width: 100%; border-radius: 4px; }
        .crud-table th, .crud-table td { padding: 12px; text-align: left; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .crud-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .btn-danger { background: #ff4136; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 4px; }
    </style>
</head>
<body>

    <div class="container">
        <?php if (!$is_logged_in): ?>
            <div class="admin-box" style="max-width: 400px; margin-top: 100px;">
                <h2 style="border-left:4px solid #ff851b; padding-left: 10px; margin-bottom: 20px;">Вход в Админ-панель</h2>
                <?php if ($error): ?><div style="color: #ff4136; margin-bottom: 15px;"><?= $error ?></div><?php endif; ?>
                <form method="POST">
                    <div class="form-group">
                        <label>Введите секретный пароль:</label>
                        <input type="password" name="password" class="form-control-admin" style="margin-top: 100px;" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-orange" style="width: 100%; margin-top: 15px;">Войти</button>
                </form>
                <p style="margin-top: 15px; font-size: 0.85rem; color: #aaa;">Демо-пароль: <code style="color: #ff851b;">Continent2026</code></p>
                <p><a href="index.php" style="color: #fff; text-decoration: underline; font-size: 0.9rem;">Вернуться на сайт</a></p>
            </div>
        <?php else: ?>
            <div class="admin-box">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #d4af37; padding-bottom: 15px;">
                    <h2>Управление тарифами ТК «Континент»</h2>
                    <div>
                        <a href="index.php" class="btn" style="background:#222; color:#fff; border:1px solid #444; margin-right: 10px;">На сайт</a>
                        <a href="admin.php?logout=1" class="btn" style="background:#888; color:#fff;">Выйти</a>
                    </div>
                </div>

                <?php if ($success): ?><div style="color: #2ecc40; background: rgba(46,204,64,0.1); padding: 10px; margin: 15px 0; border-radius: 4px;"><?= $success ?></div><?php endif; ?>

                <form method="POST">
                    <input type="hidden" name="action" value="save">
                    
                    <h3>Текущие транзитные направления</h3>
                    <table class="crud-table">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Название маршрута (направление)</th>
                                <th>Ставка за кг (руб)</th>
                                <th>Ставка за м³ (руб)</th>
                                <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($directions as $dir): ?>
                                <tr>
                                    <td>
                                        <input type="text" name="dir[<?= $dir['id'] ?>][name]" value="<?= htmlspecialchars($dir['name']) ?>" class="form-control-admin" required>
                                    </td>
                                    <td>
                                        <input type="number" step="0.1" name="dir[<?= $dir['id'] ?>][price_per_kg]" value="<?= $dir['price_per_kg'] ?>" class="form-control-admin" required>
                                    </td>
                                    <td>
                                        <input type="number" step="1" name="dir[<?= $dir['id'] ?>][price_per_m3]" value="<?= $dir['price_per_m3'] ?>" class="form-control-admin" required>
                                    </td>
                                    <td>
                                        <small style="color: #aaa;">Для удаления сотрите имя</small>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <h3 style="margin-top: 40px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px; color: #ff851b;">+ Добавить новое транзитное направление</h3>
                    <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 15px; margin-top: 15px;">
                        <div>
                            <label><small>Название нового маршрута:</small></label>
                            <input type="text" name="new_name" placeholder="Прим: Новосибирск — Забайкальск" class="form-control-admin">
                        </div>
                        <div>
                            <label><small>Цена за кг:</small></label>
                            <input type="number" step="0.1" name="new_price_per_kg" placeholder="0.0" class="form-control-admin">
                        </div>
                        <div>
                            <label><small>Цена за м³:</small></label>
                            <input type="number" step="1" name="new_price_per_m3" placeholder="0" class="form-control-admin">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-orange" style="margin-top: 35px; padding: 12px 30px; font-size: 1.05rem;">Сохранить все изменения</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>