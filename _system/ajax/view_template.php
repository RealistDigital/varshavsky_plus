<?php
// Кодировка
header('Content-type: text/html; charset=UTF-8');

// проверка
if(!$_GET['ajax']) exit(':)'); 

// Config
require_once($_SERVER['DOCUMENT_ROOT'].'/config/config.php');

$id_tpl = filter_var(trim($_GET['tpl']), FILTER_VALIDATE_INT);

if (empty($id_tpl)) return false;

$sql = DB::query("SELECT * FROM ".TABLE_TPL." WHERE `id` = ".$id_tpl."");
$row = DB::fetchAssoc($sql);

$result = 0;
if(!empty($row)) { $result = 1; }
 
echo json_encode(array(
    'res'   => $result,
    'edit'  => $row['edit_tpl'],
    'view'  => $row['view_tpl'],
    'name_view' => $row['name']
));

exit;