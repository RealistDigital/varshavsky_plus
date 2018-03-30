<?php
// Кодировка
header('Content-type: text/html; charset=UTF-8');

//-----------------------------------------------------------------------------
// Ajax load content
//-----------------------------------------------------------------------------

// Config
require_once($_SERVER['DOCUMENT_ROOT'].'/config/config.php');

// Ajax controller
require_once(URL_CONTROLLERS."ajax.php");

// Tpl
$tpl = filter_var($_GET['tpl'], FILTER_SANITIZE_STRING);

// init Ajax
new Ajax($tpl);
