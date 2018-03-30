<?
// Config
require_once($_SERVER['DOCUMENT_ROOT'].'/config/config.php');

  $ID = (int) $_REQUEST['id'];
  $lang = htmlspecialchars($_REQUEST['lang']);

  // вытаскиваем подписчиков с базы
  $query = "SELECT id, email FROM " . TABLE_SUBS;
  $res = mysql_query($query);
  $num_emails = DB::numRows($res);
?>
<html>
<head>
<title>Разсылка</title>
<script src="<?=URL_PUBLIC?>js/libs/jquery-1.8.2.min.js"></script>
<script type='text/javascript'>
$(document).ready(function(){
  
  $('#to_send').click(function(){
    send();
    return false;
  });
  
});

function send(){
  var count = parseInt($('#surent_email').val());
  var finish = $('#finish').size();

  if(finish==0){
  $.ajax({
    url: "/_system/ajax/mail/mailer.php",
    cache: false,
    data: "id="+<?=$ID?>+"&count="+count+"&lang=<?=$lang?>&all_subscribes=<?=$num_emails?>",
    success: function(html){
      $("#res_conteiner").prepend(html);
      count++;
      $('#surent_email').val(count);
    },
    complete: function(){
      timeoutID = setTimeout(send, getRandom(1000,5000));
    }
  });
  } else { clearTimeout(timeoutID); return false; }
}

 $('.del_email').live('click',function(){
  var id_subscriber = $(this).attr('rel');
  $.ajax({
    url: "/_system/ajax/mail/mailer.php",
    cache: false,
    data: "lang=<?=$lang?>&delete_email=1&id_subscriber="+id_subscriber,
    success: function(html){
      $("#res_conteiner").prepend(html);
    }
  });
  return false;
 });

function getRandom(min, max){
	  return Math.random() * (max - min) + min;
}

</script>
</head>
<body>
<table border='1' height='370'>
<tr>
  <td width='200'>
    <br>Количество email: <?=$num_emails?>
    <br><br>
    <a href='#' id='to_send'>Разослать</a>
  </td>
  <td width='380'>
    <div id='res_conteiner' style='overflow:auto;width:380px;height:370px;'>
      <input type='hidden' id='surent_email' value='0'>
    </div>
  </td>
</tr>
</table>
</body>
</html>
