<?php
//-----------------------------------------------------------------------------
// Статус Online Editor-a
//-----------------------------------------------------------------------------

/**
<div id="online-edit-1" <?=Lib::online_editor($I['id'], 'text_'.LANG);?>>
    <?=$I['text_'.LANG]?>
</div>
*/

session_start();

//Ajax переменная
$status = $_GET['status'] != false ? $_GET['status'] : exit(':)');

//Включаем 
if(!$_SESSION['online_editor']) {
    $_SESSION['online_editor'] = "Выкл.";
    $res = 1;
//Выключаем
} else {
    unset($_SESSION['online_editor']);
    $res = 0;
}

// Выдаем JSON
echo json_encode(array(
        'res'   => $res
    ));
exit;
?>