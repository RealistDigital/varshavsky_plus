<?php 
session_start();
 
// проверка
if(!$_GET['code']) exit(":)");
// код
$code = trim($_GET['code']);
// Сравниваем введенную капчу с сохраненной в переменной в сессии 
if(isset($_SESSION['capcha']) && strtoupper($_SESSION['capcha']) == strtoupper($code)) {
    $res = 1; // ok
} else {
    $res = false; // no
} 
// Удаляем капчу из сессии 
// unset($_SESSION['capcha']); 

// Выдаем JSON
echo json_encode(array(
    'res'    => $res,
));
exit;

?>