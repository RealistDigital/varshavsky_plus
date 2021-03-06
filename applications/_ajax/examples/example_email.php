<?php
// Кодировка
header('Content-type: text/html; charset=UTF-8');

//-----------------------------------------------------------------------------
// Ajax send contacts
//-----------------------------------------------------------------------------

// Config
require_once($_SERVER['DOCUMENT_ROOT'].'/config/config.php');

if(!Lib::checkAJAX()) exit(':)');

// PHP Mailer
require_once($_SERVER['DOCUMENT_ROOT'].'/plugins/php_mailer/class.send.php');

// Обработка переменных
$name   = filter_var($_GET['name'], FILTER_SANITIZE_STRING);
$email  = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);
$text   = filter_var($_GET['text'], FILTER_SANITIZE_STRING);

$date           = date('c');
$date_send      = date('d-m-Y G:i:s');

$toEmail    = $settings['email'];

$fromName   = "Contacts";
$fromEmail  = "contacts@".$_SERVER['HTTP_HOST'];
$theme      = 'Форма обратной связи';

$response   = array(
    'result'    =>  1
); 

//-----------------------------------------------------------------------------
// Отправка письма
//-----------------------------------------------------------------------------

// Настройка параметров
$site['from_name']      = $fromName;      // from (от) имя
$site['from_email']     = $fromEmail;     // from (от) email адрес
// На всякий случай указываем настройки,  для дополнительного (внешнего) SMTP сервера.
$site['smtp_mode']      = 'disabled';     // enabled or disabled (включен или выключен)
$site['smtp_host']      = null;
$site['smtp_port']      = null;
$site['smtp_username']  = null;

// инициализируем класс
$mailer = new FreakMailer();

// Устанавливаем тему письма
$mailer->Subject = 'Сайт '.$_SERVER['HTTP_HOST'].'! '.$theme;
// Добавляем адрес в список получателей
$mailer->AddAddress($toEmail, $fromName);
// Задаем тело письма
$mailer->Body = $theme;

// Html тело    
$htmlBody = "
    <div align='center'>
        <div style='background-color:#d4d2d2; width:750px; padding:30px; margin:0 auto;' align='left'>
            <img src='http://".$_SERVER['HTTP_HOST']."/public/img/logo.png' width='200'>
            <hr>
            <h3 style='text-decoration:underline;'>".$theme."</h3>
            <h4>Информация</h4>
            <p><strong>Имя:</strong> ".$name."</p>
            <p><strong>Email:</strong> ".$email."</p>
            <p><strong>Дата отправки:</strong> ".$date_send."</p>
            <p><strong>Текст сообщения:</strong> <br>".$text."</p>
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

// Отправка .. 
if(!$mailer->Send()) {
    $response   = array(
        'result'    =>  0
    );
} 

$mailer->ClearAddresses();

// response .. 
echo json_encode($response);