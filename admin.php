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

// Обработка CRUD-действий
if ($is_logged_in && $_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Сохранение изменений
    if (isset($_POST['action']) && $_POST['action'] === 'save') {
        $updated_directions = [];
        if (isset($_POST['dir']) && is_array($_POST['dir'])) {
            foreach ($_POST['dir'] as $id => $data) {
                if (empty($data['name'])) continue;
                $updated_directions[] = [
                    'id' => intval($id),
                    'name' => htmlspecialchars($data['name']),
                    'price_per_kg' => floatval($data['price_per_kg']),
                    'price_per_m3' => floatval($data['price_per_m3'])
                ];
            }
        }
        
        // Добавление нового направления
        if (!empty($_POST['new_name']) && !empty($_POST['new_price_per_kg'])) {
            $new_id = time();
            $updated_directions[] = [
                'id' => $new_id,
                'name' => htmlspecialchars($_POST['new_name']),
                'price_per_kg' => floatval($_POST['new_price_per_kg']),
                'price_per_m3' => floatval($_POST['new_price_per_m3'])
            ];
        }

        file_put_contents($directions_file, json_encode($updated_directions, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        $directions = $updated_directions;
        $success = '✅ Данные успешно сохранены!';
    }
    
    // Удаление маршрута
    if (isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['delete_id'])) {
        $delete_id = intval($_POST['delete_id']);
        $updated_directions = [];
        foreach ($directions as $dir) {
            if ($dir['id'] != $delete_id) {
                $updated_directions[] = $dir;
            }
        }
        
        // Сохраняем обновленный массив
        $result = file_put_contents($directions_file, json_encode($updated_directions, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        
        if ($result !== false) {
            $directions = $updated_directions;
            $success = '🗑️ Маршрут успешно удален!';
        } else {
            $error = '❌ Ошибка при удалении маршрута! Проверьте права на запись.';
        }
        
        // Возвращаемся на страницу без повторной отправки формы
        header("Location: admin.php?deleted=1");
        exit;
    }
}

// Показываем сообщение после удаления
if (isset($_GET['deleted'])) {
    $success = '🗑️ Маршрут успешно удален!';
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
        .admin-box { max-width: 1100px; margin: 50px auto; background: rgba(255,255,255,0.05); padding: 30px; border-radius: 12px; border: 1px solid rgba(212,175,55,0.2); }
        .form-control-admin { background: #001f3f; border: 1px solid rgba(255,255,255,0.2); color: #fff; padding: 8px; width: 100%; border-radius: 4px; }
        .crud-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .crud-table th, .crud-table td { padding: 12px; text-align: left; border-bottom: 1px solid rgba(255,255,255,0.1); vertical-align: middle; }
        .crud-table th { background: rgba(0,0,0,0.3); color: #d4af37; }
        .delete-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: 0.3s;
            font-size: 0.85rem;
        }
        .delete-btn:hover { background: #c82333; transform: scale(1.02); }
        .success-msg { background: rgba(46,204,64,0.2); border: 1px solid #2ecc40; padding: 12px; border-radius: 6px; margin-bottom: 20px; color: #2ecc40; }
        .error-msg { background: rgba(220,53,69,0.2); border: 1px solid #dc3545; padding: 12px; border-radius: 6px; margin-bottom: 20px; color: #dc3545; }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background: #001f3f;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            max-width: 400px;
            border: 1px solid #d4af37;
        }
        .modal-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 20px;
        }
        .btn-confirm { background: #dc3545; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; }
        .btn-cancel { background: #6c757d; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; }
    </style>
</head>
<body>

    <div class="container">
        <?php if (!$is_logged_in): ?>
            <div class="admin-box" style="max-width: 400px; margin-top: 100px;">
                <h2 style="border-left:4px solid #ff851b; padding-left: 10px; margin-bottom: 20px;">🔐 Вход в Админ-панель</h2>
                <?php if ($error): ?><div class="error-msg">❌ <?= $error ?></div><?php endif; ?>
                <form method="POST">
                    <div class="form-group">
                        <label>Введите секретный пароль:</label>
                        <input type="password" name="password" class="form-control-admin" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-orange" style="width: 100%; margin-top: 15px;">Войти</button>
                </form>
                <p style="margin-top: 15px; font-size: 0.85rem; color: #aaa;">Демо-пароль: <code style="color: #ff851b;">Continent2026</code></p>
                <p><a href="index.php" style="color: #fff; text-decoration: underline;">← Вернуться на сайт</a></p>
            </div>
        <?php else: ?>
            <div class="admin-box">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #d4af37; padding-bottom: 15px; margin-bottom: 20px;">
                    <h2> Управление тарифами ТК «Континент»</h2>
                    <div>
                        <a href="index.php" class="btn" style="background:#222; color:#fff; border:1px solid #444; margin-right: 10px;"> На сайт</a>
                        <a href="admin.php?logout=1" class="btn" style="background:#888; color:#fff;"> Выйти</a>
                    </div>
                </div>

                <?php if ($success): ?>
                    <div class="success-msg"><?= $success ?></div>
                <?php endif; ?>
                
                <?php if ($error): ?>
                    <div class="error-msg"><?= $error ?></div>
                <?php endif; ?>

                <form method="POST" id="mainForm">
                    <input type="hidden" name="action" value="save">
                    
                    <h3>📋 Текущие транзитные направления</h3>
                    <table class="crud-table">
                        <thead>
                            <tr>
                                <th style="width: 40%;">Название маршрута</th>
                                <th style="width: 20%;">Ставка за кг (руб)</th>
                                <th style="width: 20%;">Ставка за м³ (руб)</th>
                                <th style="width: 20%;">Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($directions)): ?>
                                <tr>
                                    <td colspan="4" style="text-align: center; color: #aaa;">Нет добавленных маршрутов</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($directions as $dir): ?>
                                    <tr>
                                        <td>
                                            <input type="text" name="dir[<?= $dir['id'] ?>][name]" 
                                                   value="<?= htmlspecialchars($dir['name']) ?>" 
                                                   class="form-control-admin" required>
                                        </td>
                                        <td>
                                            <input type="number" step="0.1" name="dir[<?= $dir['id'] ?>][price_per_kg]" 
                                                   value="<?= $dir['price_per_kg'] ?>" class="form-control-admin" required>
                                        </td>
                                        <td>
                                            <input type="number" step="1" name="dir[<?= $dir['id'] ?>][price_per_m3]" 
                                                   value="<?= $dir['price_per_m3'] ?>" class="form-control-admin" required>
                                        </td>
                                        <td>
                                            <button type="button" class="delete-btn" onclick="confirmDelete(<?= $dir['id'] ?>, '<?= htmlspecialchars(addslashes($dir['name'])) ?>')">
                                                🗑️ Удалить
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <h3 style="margin-top: 40px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px; color: #ff851b;">➕ Добавить новое транзитное направление</h3>
                    <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 15px; margin-top: 15px;">
                        <div>
                            <label><small>Название нового маршрута:</small></label>
                            <input type="text" name="new_name" placeholder="Пример: Новосибирск — Забайкальск" class="form-control-admin">
                        </div>
                        <div>
                            <label><small>Цена за кг (руб):</small></label>
                            <input type="number" step="0.1" name="new_price_per_kg" placeholder="0.0" class="form-control-admin">
                        </div>
                        <div>
                            <label><small>Цена за м³ (руб):</small></label>
                            <input type="number" step="1" name="new_price_per_m3" placeholder="0" class="form-control-admin">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-orange" style="margin-top: 35px; padding: 12px 30px; font-size: 1.05rem;">
                        💾 Сохранить все изменения
                    </button>
                </form>

                <!-- Форма для удаления -->
                <form method="POST" id="deleteForm">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="delete_id" id="delete_id">
                </form>
            </div>
        <?php endif; ?>
    </div>

    <!-- Модальное окно подтверждения -->
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <h3>🗑️ Подтверждение удаления</h3>
            <p>Вы действительно хотите удалить маршрут:</p>
            <p><strong id="routeNameToDelete" style="color: #ff851b;"></strong>?</p>
            <p style="font-size: 0.85rem; color: #aaa;">Это действие нельзя отменить.</p>
            <div class="modal-buttons">
                <button class="btn-confirm" onclick="executeDelete()">Да, удалить</button>
                <button class="btn-cancel" onclick="closeModal()">Отмена</button>
            </div>
        </div>
    </div>

    <script>
        let deleteId = null;
        
        function confirmDelete(id, name) {
            deleteId = id;
            document.getElementById('routeNameToDelete').innerText = name;
            document.getElementById('confirmModal').style.display = 'flex';
        }
        
        function executeDelete() {
            if (deleteId) {
                document.getElementById('delete_id').value = deleteId;
                document.getElementById('deleteForm').submit();
            }
        }
        
        function closeModal() {
            document.getElementById('confirmModal').style.display = 'none';
            deleteId = null;
        }
        
        // Закрыть модальное окно при клике вне его
        window.onclick = function(event) {
            const modal = document.getElementById('confirmModal');
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>