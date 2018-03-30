<?php
// проверка авторизации
require_once ($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/_system/config/config.php");

require_once (SYS_CONTROLLES . "/c_views.php");
require_once (SYS_CONTROLLES . "c_login.php");
require_once (SYS_CONTROLLES . "c_auth.php");

$auth = new C_Auth ();

if ($auth->checkUserAuth ()) {
    $_SESSION['isLoggedIn'] = true;
    header('location:' . $_GET['return_url']);
    
exit('stop');
} else {
    $_SESSION['isLoggedIn'] = false;
    exit('Access denied!');
}
?>