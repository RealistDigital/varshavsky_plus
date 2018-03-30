<?php
//-------------------------------------------------------------------------------------------------
// Установка языка
//-------------------------------------------------------------------------------------------------
require_once(URL_LIBS."lib_url.php");

$url_conf = Lib_url::getUrl();

if($url_conf['0'] == 'ru' || $url_conf['0'] == 'en' || $url_conf['0'] == 'ua') {
    define(LANG, $url_conf['0']);
    $_SESSION['lang'] = $url_conf['0'];
} else {
    define(LANG, DEFAUL_LANG);
    $_SESSION['lang'] = DEFAUL_LANG;
}

?>