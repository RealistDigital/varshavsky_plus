<?php
//-----------------------------------------------------------------------------
// Сохранение даных 
//-----------------------------------------------------------------------------

//Config
require_once($_SERVER['DOCUMENT_ROOT'].'/config/config.php');

//AJAX переменные ...
$id     = $_POST['id'] != "" ? trim($_POST['id']) : exit(':)');           //ID
$field  = $_POST['field'] != "" ? trim($_POST['field']) : exit(':)');     //Поле для save    
$text   = $_POST['text'] != "" ? trim($_POST['text']) : exit(':)');       //Текст для Save

//Save 
$update = DB::exec("UPDATE ".TABLE." SET $field='".$text."' WHERE `id`=".$id."");

//Результат save ..
if($update) {
    $res = "Save";
} else {
    $res = "Error";
}

// Выдаем JSON
echo $res;

?>