<?php
require_once 'phpmailer/src/PHPMailer.php';
require_once 'phpmailer/src/SMTP.php';
require_once 'phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
try {
    // Включаем отладку
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'echo';
    
    // Настройки
    $mail->isSMTP();
    $mail->Host = 'smtp.yandex.ru';
    $mail->SMTPAuth = true;
    $mail->Username = 'pevasnetsov5677@yandex.ru';
    $mail->Password = 'vlgxngvljcmlnxdc';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';
    
    // Отключаем проверку SSL
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    
    $mail->setFrom('pevasnetsov5677@yandex.ru', 'ТК Континент');
    $mail->addAddress('podstrelov5567@mail.ru');
    $mail->Subject = 'Тест с сервера';
    $mail->Body = 'Проверка SMTP ' . date('Y-m-d H:i:s');
    
    $mail->send();
    echo "\n✅ ПИСЬМО ОТПРАВЛЕНО!";
} catch (Exception $e) {
    echo "\n❌ ОШИБКА: " . $mail->ErrorInfo;
}
?>