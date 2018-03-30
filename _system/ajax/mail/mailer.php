<?php
// Кодировка
header('Content-type: text/html; charset=UTF-8');

//-----------------------------------------------------------------------------
// Ajax load content
//-----------------------------------------------------------------------------

// Config
require_once($_SERVER['DOCUMENT_ROOT'].'/config/config.php');
require_once($_SERVER['DOCUMENT_ROOT']."/plugins/php_mailer/class.phpmailer.php");

  $mail = new PHPMailer();

  $ID = (int) $_REQUEST['id'];
  $lang = htmlspecialchars($_REQUEST['lang']);
  $count = (int) $_REQUEST['count'];
  $all_subscribes = (int) $_REQUEST['all_subscribes'];
  $delete_email = (int) $_REQUEST['delete_email'];
  $id_subscriber = (int) $_REQUEST['id_subscriber'];

  if($delete_email==1){
  
    $query = "SELECT id, email FROM " . TABLE_SUBS . " WHERE id='$id_subscriber' ORDER BY id LIMIT 1";
    $res = mysql_query($query);
    $s = mysql_fetch_assoc($res);

    $query = "DELETE QUICK FROM " . TABLE_SUBS . " WHERE id='$id_subscriber' LIMIT 1";
    $res = mysql_query($query);
    echo "<div style='color:gray;'>Email <b>($s[email])</b> удален из базы!</div>";

  } else {

  // вытаскиваем из базы инфу для отправки в рассылку
  $query = "SELECT name_$lang, text_$lang FROM " . TABLE . " WHERE id='$ID' LIMIT 1";
  $res = mysql_query($query);
  $inf = mysql_fetch_assoc($res);
  //echo $inf['text_'.$lang];
  
  // обработка html для отправки без вложений картинок
    $pattern = array(
         0 => "/src=\"/",
         1 => "/<a href=\"/"
     );
      $replacement = array(
         1 => "src=\"http://$_SERVER[HTTP_HOST]",
         0 => "<a href=\"http://$_SERVER[HTTP_HOST]"
     );
  
  $newinf = '<html><body><head><meta content="text/html; charset=UTF-8" http-equiv="Content-Type" /><title>Рассылка с сайта http://'.$_SERVER[HTTP_HOST].'/</title></head>';
  $newinf .= preg_replace($pattern,$replacement,stripslashes($inf['text_'.$lang]));
  $body = $newinf .= '</body></html>';
  //echo $newinf; // проверка генерированого текста
  
  
  // вытаскиваем подписчика из базы
  $query = "SELECT id,email FROM " . TABLE_SUBS . " ORDER BY id LIMIT $count,1";
  $res = mysql_query($query);
  $s = mysql_fetch_assoc($res);
  //$s['email'] = 'support@beleven.com.ua';
  
  if($count==$all_subscribes){
    echo "<input type='hidden' id='finish' value='1'><div style='color:green;text-decoration:underline;font-weight:bold;'>!!! ГОТОВО !!!</div>";
  }else{
    $mail->CharSet = "UTF-8";
    $mail->SetFrom("site@$_SERVER[HTTP_HOST]","Письмо с сайта $_SERVER[HTTP_HOST]");//от кого рассылка
    $mail->AddAddress($s['email']); // кому отправляется
	//$mail->Subject = "Рассылка с сайта http://$_SERVER[HTTP_HOST]/";// тема письма
	$mail->Subject = $inf['name_'.$lang];// тема письма
    $mail->Body = $body; // тело письма (у нас html)
    $mail->IsHTML(true);// Устанавливаем что письмо в HTML формате
    if(!$mail->Send()){
      echo "<div style='color:red;'>Ошибка отправки письма на <b>(".$s['email'].")</b>: ".$mail->ErrorInfo." <a href='#' rel=".$s['id']." class='del_email'>Удалить email</a></div>";
    }else{
      echo "<div style='color:green;'>Отправленно: ".$s['email']."</div>";
    }
  }
  
  }
?>
