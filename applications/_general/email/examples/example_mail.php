<?php
// Кодировка
header('Content-type: text/html; charset=UTF-8');

// Защита от любопытных peoples
//if (!isset($_POST) || !isset($_POST['save_order'])) exit (':)');

// Config
require_once($_SERVER['DOCUMENT_ROOT'].'/config/config.php');

// PHP Mailer
require_once($_SERVER['DOCUMENT_ROOT'].'/plugins/php_mailer/class.send.php');

//-----------------------------------------------------------------------------
// Сохранение заказа
//-----------------------------------------------------------------------------

// Обработка переменных
$fio        = trim(filter_var($_POST['fio'], FILTER_SANITIZE_STRING));
$email      = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
$phone      = trim(filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT));
$address    = trim(filter_var($_POST['address'], FILTER_SANITIZE_STRING));
$date       = date('c');
$date_send  = date('d-m-Y G:i:s');

// SQL save Клиент
$sql_save = "
    INSERT INTO ".TABLE_CUST." (
        `fio`, 
        `email`, 
        `phone`, 
        `address`, 
        `date`, 
        `status`,
        `all_price`,
        `all_count`
    ) VALUE (
        '".$fio."', 
        '".$email."', 
        '".$phone."', 
        '".$address."', 
        '".$date."', 
        '0',
        '".$_SESSION['price_all']."',
        '".$_SESSION['count_all']."'
    )"; 
DB::exec($sql_save);

// Last ID
$last_id = DB::lastInsertId();

// SQL save Товары 
foreach ($_SESSION['cart'] as $k => $v) {
    $sql_save_good = "
        INSERT INTO ".TABLE_ORDERS." (
            `order`, 
            `name`, 
            `count`, 
            `price`,
            `id_good`
        ) VALUE (
            '".$last_id."', 
            '".$v['name']."', 
            '".$v['count']."', 
            '".$v['price']."',
            '".$v['id']."'
        )"; 
    DB::exec($sql_save_good);
}

//-----------------------------------------------------------------------------
// Отправка письма
//-----------------------------------------------------------------------------

// Настройка параметров
$site['from_name']      = $langs['38'];   // from (от) имя
$site['from_email']     = $settings['email'];        // from (от) email адрес
// На всякий случай указываем настройки,  для дополнительного (внешнего) SMTP сервера.
$site['smtp_mode']      = 'disabled';   // enabled or disabled (включен или выключен)
$site['smtp_host']      = null;
$site['smtp_port']      = null;
$site['smtp_username']  = null;

// инициализируем класс
$mailer = new FreakMailer();

//-----------------------------------------------------------------------------
// Отправка клиенту
//-----------------------------------------------------------------------------

// Устанавливаем тему письма
$mailer->Subject = 'Заказ № - '.$last_id;
// Добавляем адрес в список получателей
$mailer->AddAddress($email, $fio);
// Задаем тело письма
$mailer->Body = $langs['39'];

// Html тело 
$body = ""; // обнуляем
$count = 1; // счетчик
foreach ($_SESSION['cart'] as $k => $v) {
    $body .= "
        <tr>
            <td>".$count."</td>
            <td>".$v['name']."</td>
            <td>".$v['count']." ".$langs['10']."</td>
            <td>".$v['price']." ".$langs['9']."</td>
        </tr>
    "; 
    $count++;
}

// Wp html    
$htmlBody = "
    <img src='http://".$_SERVER['HTTP_HOST']."/public/img/logo.png' width='200'>
    <br>
    <h3>Спасибо за ваш выбор «Slave»!</h3><br><br>
    <h4>Заказаные товары:</h4>
    <table width='700' border='1'>
        <tr>
            <td width='5%'>№</td>
            <td width='50%'>".$langs['46']."</td>
            <td width='20%'>".$langs['20']."</td>
            <td width='25%'>".$langs['47']."</td>
        </tr>
        ".$body."
    </table>
    <br>
    <p>".$langs['40']." <strong>".$_SESSION['count_all']." ".$langs['10']."</strong></p>
    <p>".$langs['41']." <strong>".$_SESSION['price_all']." ".$langs['9']."</strong></p>
    <br>
    <p><strong>Мы свяжемся с вами в ближайшее время.</strong></p>
    <hr>
    <p>Данное письмо создано автоматически, пожалуйста, не отвечайте на него. С уважением, администрация «SLAVE»</p>
";

// Кодировка
$mailer->CharSet = 'UTF-8';
// Указываем тело 
$mailer->Body = $htmlBody;
// HTML ok
$mailer->isHTML(true);

// Отправка .. 
if(!$mailer->Send()) {
  exit ('<h1 align="center">'.$langs['42'].'</h1>');
}

$mailer->ClearAddresses();

//-----------------------------------------------------------------------------
// Отправка менеджеру
//-----------------------------------------------------------------------------

// Устанавливаем тему письма
$mailer->Subject = $langs['43'].' № - '.$last_id;
// Добавляем адрес в список получателей
$mailer->AddAddress($settings['email'], '');
// Второй адресант
if ($settings['email_2'] != "") {
    $mailer->AddAddress($settings['email_2'], '');
}
// Задаем тело письма
$mailer->Body = $langs['44'];

// Html тело 
$body = ""; // обнуляем
$count = 1; // счетчик
foreach ($_SESSION['cart'] as $k => $v) {
    $body .= "
        <tr>
            <td>".$count."</td>
            <td>".$v['name']."</td>
            <td>".$v['count']." ".$langs['10']."</td>
            <td>".$v['price']." ".$langs['9']."</td>
        </tr>
    "; 
    $count++;
}

// Wp html    
$htmlBody = "
    <img src='http://".$_SERVER['HTTP_HOST']."/public/img/logo.png' width='200'>
    <br>
    <h3>Новый заказа № - ".$last_id."</h3>
    <br>
    <h2>".$langs['45']."</h2>
    <p><strong>".$langs['28']."</strong>: ".$fio."</p>
    <p><strong>".$langs['30']."</strong>: ".$phone."</p>
    <p><strong>".$langs['29']."</strong>: ".$email."</p>
    <p><strong>".$langs['48']."</strong>: ".$date_send."</p>

    <h4>Заказаные товары:</h4>
    <table width='700' border='1'>
        <tr>
            <td width='5%'>№</td>
            <td width='50%'>".$langs['46']."</td>
            <td width='20%'>".$langs['20']."</td>
            <td width='25%'>".$langs['47']."</td>
        </tr>
        ".$body."
    </table>
    <br>
    <p>".$langs['40']." <strong>".$_SESSION['count_all']." ".$langs['10']."</strong></p>
    <p>".$langs['41']." <strong>".$_SESSION['price_all']." ".$langs['9']."</strong></p>
    <br>
    <hr>
    <p>Данное письмо создано автоматически, пожалуйста, не отвечайте на него. С уважением, администрация «SLAVE»</p>
";

// Кодировка
$mailer->CharSet = 'UTF-8';
// Указываем тело 
$mailer->Body = $htmlBody;
// HTML ok
$mailer->isHTML(true);

// Отправка .. 
if(!$mailer->Send()) {
  exit ('<h1 align="center">'.$langs['42'].'</h1>');
}
$mailer->ClearAddresses();

//echo $htmlBody;

// Чистим инфу 
unset($_SESSION['cart']);
unset($_SESSION['count_all']);
unset($_SESSION['price_all']);

// редирект + сообщение
Lib_url::redirect_html(URL.LANG."/#ordered");

?>