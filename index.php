<?php
//-------------------------------------------------------------------------------------------------
// Если версия не актуальна
//-------------------------------------------------------------------------------------------------
//echo '<p class="dev_verion" style="    position: fixed;top: 10px;left: 10px;font-family: Arial, Helvetica, sans-serif;background-color: red;color: #FFF;border-radius: 4px;padding: 6px 8px;font-size: 16px;box-shadow: -1px 1px 3px #444444;pointer-events: none;opacity: 0.5;z-index: 999999;">НЕ АКТУАЛЬНО</p>';
//-------------------------------------------------------------------------------------------------
// Стартовые подключения
//-------------------------------------------------------------------------------------------------
require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";
//Стартовый файл
require_once URL_ROOT."bootstrap.php";

//Старт .. 
new Bootstrap ();
?>