<?php
session_start();
// Для разработки
error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT); // E_STRICT - строгий контроль / Off
// Для работы
//error_reporting(0);
header('Content-Type: text/html; charset=utf-8');
// init date timezone
ini_set('date.timezone', 'Europe/Kiev');

//-------------------------------------------------------------------------------------------------
// Настройка БД
//-------------------------------------------------------------------------------------------------

define(DB_HOST, 'localhost');
define(DB_USER, 'web');
define(DB_PASS, 'GwFYpHwaTK8vDFy8');
define(DB_NAME, 'rd_varsh_plus');

define(SITE_ADDR, 'http://'.$_SERVER['HTTP_HOST']);
define(URL, '/');
define(URL_ROOT, $_SERVER['DOCUMENT_ROOT'].'/');
define(DR, $_SERVER['DOCUMENT_ROOT']);
define(DS, '/');

define(URL_APP, URL_ROOT.'applications/');
define(URL_CONTROLLERS, URL_ROOT.'applications/conrtollers/');
define(URL_MODELS, URL_ROOT.'applications/models/');

define(URL_LIBS, URL_ROOT.'libs/');
define(URL_FILES, URL_ROOT.'files/');
define(URL_LANGS, URL_ROOT.'languages/');
define(URL_PUBLIC, URL.'public/');
define(URL_PLUGINS, URL.'plugins/');
define(URL_VIEWS, URL_ROOT.'views/');
define(URL_BLOCKS, URL_ROOT.'views/blocks/');
define(URL_EDIT, URL_ROOT.'views/edit/');
define(URL_VIEWS_PRINT, URL_ROOT.'views/print/');
define(URL_AJAX, '/applications/_ajax/');

// Путь к движку админки
define(SYSTEM_PATH, URL_ROOT.'_system/');

//define(SYS_PLUGINS, SYSTEM_PATH.'plugins/');

// Язык по умолчанию
define(DEFAUL_LANG, 'ua');

// Таблица для рекурсии .
define(TABLE, '_main');
// Таблица шаблонов / типов
define(TABLE_TPL, '_a_sys_tpl');
// Таблица настроек
define(TABLE_SETT, '_settings');
// Таблица пользователей админки
define(TABLE_USERS, '_a_users');
//Таблица перевода эл. сайта
define(TABLE_TRANS, '_translation');
//Таблица подписки
define(TABLE_SUBS, '_subscribe');
// Таблица блокированных ip
define(TABLE_BLOCKED_IP, '_blocked_ip');

//Таблица заказов
define(TABLE_ORDERS, '_shop_orders');
//Таблица клиентов
define(TABLE_CUST, '_shop_customers');
//Таблица комментариев
define(TABLE_COMM, '_comments');

// Общая библиотека функций
require_once(URL_LIBS."lib_general.php");
// IMG lib
require_once(URL_LIBS."lib_img.php");
// System libs
require_once(SYSTEM_PATH.'libs/lib_system.php');
// Настроки 
require_once("general.php");
// Настройки / Lang
require_once("lang.php"); 
// Base url 
define(BASE_URL, '/'.LANG.'/');
// Соеденение для Админки / Защищенное
require_once(SYSTEM_PATH.'/config/db.php');
// Подключаем модель
require_once(URL_MODELS."model.php");

// Obj модели
$model = new Model ();
// Настройки сайта
$settings = $model->settings_info_m();
// Переводы сайта
$langs = $model->langs_info_m();
?>