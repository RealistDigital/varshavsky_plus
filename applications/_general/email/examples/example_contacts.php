<?php
// Кодировка
header('Content-type: text/html; charset=UTF-8');

// Защита от любопытных peoples
if (!isset($_POST)) exit (':)');

// Config
require_once($_SERVER['DOCUMENT_ROOT'].'/config/config.php');

// PHP Mailer
require_once($_SERVER['DOCUMENT_ROOT'].'/plugins/php_mailer/class.send.php');

// Подключаем контроллер вида
require_once(URL_CONTROLLERS."view.php");

$viev = new Site_View ();

$errorMesssages = array(
    'invalid_name'  => '<strong>Ошибка:</strong> Вы не указали Имя!',
    'invalid_text'  => '<strong>Ошибка:</strong> Вы не указали Текст сообщения!',
    'invalid_email' => '<strong>Ошибка:</strong> не корректный Email адрес!',
    'system'        => '<strong>Ошибка:</strong> у Нас произошла системная ошибка, извините за неудобства!',
    'send_email'    => '<strong>Ошибка:</strong> отправки сообщения, извините за неудобства!'
);

//-----------------------------------------------------------------------------
// Сохранение заказа
//-----------------------------------------------------------------------------

// Обработка переменных
$userName       = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
$userEmail      = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
$userPhone      = trim(filter_var($_POST['phone'], FILTER_SANITIZE_STRING));
$userText       = trim(strip_tags($_POST['text']));
$redirectUrl    = trim($_POST['url']);
$date_send      = date('d-m-Y G:i:s');
$fromUser       = 'support@'.$_SERVER['HTTP_HOST'];

// Проверка имени
if (empty($userName)) {
    $viev->view('error', false, false, false, $errorMesssages['invalid_name']);
    exit();
}

// Проверка текста
if (empty($userText)) {
    $viev->view('error', false, false, false, $errorMesssages['invalid_text']);
    exit();
}

// Проверка Email
if (empty($userEmail) || !filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
    $viev->view('error', false, false, false, $errorMesssages['invalid_email']);
    exit();
}

//-----------------------------------------------------------------------------
// Отправка письма
//-----------------------------------------------------------------------------

// Настройка параметров
$site['from_name']      = $userName;   // from (от) имя
$site['from_email']     = $fromUser;        // from (от) email адрес
// На всякий случай указываем настройки,  для дополнительного (внешнего) SMTP сервера.
$site['smtp_mode']      = 'disabled';   // enabled or disabled (включен или выключен)
$site['smtp_host']      = null;
$site['smtp_port']      = null;
$site['smtp_username']  = null;

// инициализируем класс
$mailer = new FreakMailer();

// Устанавливаем тему письма
$mailer->Subject = 'Сайт '.$_SERVER['HTTP_HOST'].'! Форма контакты';
// Добавляем адрес в список получателей
if ($settings['email']) {
    $mailer->AddAddress($settings['email'], $fromUser);
}
if ($settings['email_2']) {
    $mailer->AddAddress($settings['email_2'], $fromUser);
}
// Задаем тело письма
$mailer->Body = 'Форма контакты';

// Html тело    
$htmlBody = "
    <div align='center'>
        <div style='background-color:#d4d2d2; width:750px; padding:30px; margin:0 auto;' align='left'>
            <img src='http://".$_SERVER['HTTP_HOST']."/public/images/logo.png' width='150'>
            <hr>
            <h4>Информация</h4>
            <p><strong>Имя:</strong> ".$userName."</p>
            <p><strong>Email:</strong> ".$userEmail."</p>
            <p><strong>Дата отправки:</strong> ".$date_send."</p>
            <p><strong>Текст сообщения:</strong> <br>".$userText."</p>
            <br>
            <hr>
            <p>Данное письмо создано автоматически, пожалуйста, не отвечайте на него. С уважением, администрация сайта!</p>
        </div>
    </div>
";

// Кодировка
$mailer->CharSet = 'UTF-8';
// Указываем тело 
$mailer->Body = $htmlBody;
// HTML ok
$mailer->isHTML(true);

// Проверка отправки почты
if (!$mailer->Send()) {
    $viev->view('error', false, false, false, $errorMesssages['send_email']);
    exit();
}

// result good
$_SESSION['form_result'] = 1;

$mailer->ClearAddresses();

// редирект + сообщение
Lib_url::redirect_html($redirectUrl);

?>