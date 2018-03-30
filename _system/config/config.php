<?php
//-----------------------------------------------------------------------------
// Настройки для Админки
//-----------------------------------------------------------------------------
define(SYS_CONTROLLES, SYSTEM_PATH.'controllers/');
define(SYS_MODELS, SYSTEM_PATH.'models/');
define(SYS_VIEWS, SYSTEM_PATH.'views/');
define(SYS_PUBLIC, URL.'_system/public/');
define(SYS_PLUGINS, URL.'_system/plugins/');
define(SYS_LIBS, SYSTEM_PATH.'libs/');

define(NAME_ADMIN_ADDR, 'real_admin');
define(URL_ADMIN, URL.LANG.'/' . NAME_ADMIN_ADDR . '/');
//для защиты паролей
define(KEY_CRYPT, 'a2c342efywe56r8943');  //для паролей
define(KEY_COOKIES, '+/50d0a96dc28bd7/+');    //для защиты cookies
?>