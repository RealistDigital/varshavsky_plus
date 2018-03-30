<?php
//Старт ...
Class Bootstrap {
    public function __construct() {
        //Конфигурация админки
        require_once (SYSTEM_PATH."config/config.php");
        //URL
        $URL = Lib_url::getUrl();
        //Подключаем контроллер вида
        require_once(URL_CONTROLLERS."view.php");
        //Запуск контроллера вида
        $View = new Site_View();
        
        //Проверка языка
        if ($URL[0] == "ru" || $URL[0] == "ua" || $URL[0] == "en") {
            // Слияние главной
            if ($URL[0] == DEFAUL_LANG && !isset($URL[1])) {
                Header("Location:".URL, true, 301);
            }
            //Распределяем Функционал - SITE / ADMINKA
            switch ($URL[1]) {
                case NAME_ADMIN_ADDR:
                    //Стартовый файл админки
                    require_once (SYSTEM_PATH."adm_bootstrap.php");
                    //Запуск админки
                    new Adm_Bootstrap();
                break;
                default: 
                    if($_SESSION['lang'] != "") {
                        //Подключаем контроллер
                        require_once(URL_CONTROLLERS."controller.php");
                        //вызываем контроллер
                        new Controller();
                    } else {
                        $View->view('main/error');
                    }
                break;
            } 
        //Если нет приставки языка / или написано что попало
        } else {
            //Если Главная страница то все OK
            if ($URL[0] == "index") {
                //Подключаем контроллер
                require_once(URL_CONTROLLERS."controller.php");
                //вызываем контроллер
                new Controller();
            // Если /admin - то на /ru/admin
            } elseif($URL[0] == NAME_ADMIN_ADDR) {
                Header("Location: /" . LANG . "/" . NAME_ADMIN_ADDR);
            } else {
                Header("Location:" . URL, true, 301);
            }
        }
    }
}

?>