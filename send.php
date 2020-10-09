<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Переменные, которые отправляет пользователь
if (isset($_POST['subscribe'])) {
    $email = $_POST['email'];
} else if (isset($_POST['contact'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
} else {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $email = $_POST['email'];
}

// Формирование самого письма
$title1 = "Новое обращение Best Tour Plan";
$title2 = "Новая подписка Best Tour Plan";
$title3 = "Новая заявка Best Tour Plan";
$body1 = "
<h2>Новое обращение</h2>
<b>Имя:</b> $name<br>
<b>Телефон:</b> $phone<br><br>
<b>Сообщение:</b><br>$message
";
$body2 = "
<h2>Новая подписка</h2>
<b>Email:</b> $email
";
$body3 = "
<h2>Новая заявка на бронь</h2>
<b>Имя:</b> $name<br>
<b>Телефон:</b> $phone<br>
<b>Email:</b> $email<br><br>
<b>Сообщение:</b><br>$message
";

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();

try {
  $mail->isSMTP();   
  $mail->CharSet = "UTF-8";
  $mail->SMTPAuth   = true;
  //$mail->SMTPDebug = 2;
  $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

  // Настройки вашей почты
  $mail->Host       = 'smtp.mail.ru'; // SMTP сервера вашей почты
  $mail->Username   = ''; // Логин на почте
  $mail->Password   = ''; // Пароль на почте
  $mail->SMTPSecure = 'ssl';
  $mail->Port       = 465;
  $mail->setFrom('', ''); // Адрес самой почты и имя отправителя

  // Получатель письма
  $mail->addAddress('');

  // Отправка сообщения
  $mail->isHTML(true);
  
  if (isset($_POST['subscribe'])) {
      $mail->Subject = $title2;
      $mail->Body = $body2;  
  } else if (isset($_POST['contact'])) {
      $mail->Subject = $title1;
      $mail->Body = $body1;  
  } else {
      $mail->Subject = $title3;
      $mail->Body = $body3;  
  }

  // Проверяем отравленность сообщения
  if ($mail->send()) {$result = "success";} 
  else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата
if (isset($_POST['subscribe'])) {
    header('Location: subscribe.html'); 
} else if (isset($_POST['contact'])) {
    header('Location: thank-you.html');  
} else {
    header('Location: thank-you.html');
}
