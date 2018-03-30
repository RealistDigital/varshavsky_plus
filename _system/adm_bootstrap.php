<?php
// Настройки админки / Параметры
require_once(SYSTEM_PATH.'/config/config.php');
// Соеденение для Админки / Защищенное
require_once(SYSTEM_PATH.'/config/db.php');
//Контроллер VIEWS
require_once(SYS_CONTROLLES.'/c_views.php');  

Class Adm_Bootstrap {
    public function __construct() {
        //Views
        $C_View = new C_View();
        //URL
        $URL = Lib_url::getUrl();
        
        switch ($URL[1]) {
            case NAME_ADMIN_ADDR:
                //Контроллер входа
                require_once (SYS_CONTROLLES."c_login.php");
                //Конроллер проверки авторизации
                require_once (SYS_CONTROLLES."c_auth.php");
                //запуск проверки
                new C_Auth ();
                //Запуск Авторизации
                $C_Login = new C_Login ();
                //Права доступа к разделам
                require_once (SYS_CONTROLLES."c_right.php");
                
                //Основной функционал
                switch ($URL[2]) {
                    //Повторный вход на Login
                    case 'login':
                        header('Location:'.URL_ADMIN);
                        exit;
                    break;
                    //выход из админки
                    case 'exit':
                        //Убиваем сессию 
                        unset($_SESSION['user_id']);    //ID
                        unset($_SESSION['user_login']); //Login
                        unset($_SESSION['user_pass']);  //Pass
                        unset($_SESSION['user_name']);  //Имя 
                        unset($_SESSION['user_right']); //Права
                        unset($_SESSION['isLoggedIn']); //Tiny MCE 
                        
                        //Если есть cookie, то валим и их тоже
                        if(isset($_COOKIE['_auth'])){
                            setcookie('_auth', '', time()-600,'/'); //убиваем
                        }
                        //редирект на Login страницу
                        header('Location:'.URL_ADMIN);
                        exit;
                    break;
                    //Структура админки
                    case 'structure':
                        //Контроллер структуры
                        require_once (SYS_CONTROLLES."c_structure.php");
                        //Запуск контроллера ..
                        new C_Structure ();
                    break;
                    
                    //Рекурсия отображения
                    case 'edit':
                        //Контроллер управления админкой / сохранения
                        require_once (SYS_CONTROLLES."c_managment.php");
                        //Запуск контроллера ..
                        new C_Managment();
                        
                    break;
                    
                    // Клонирование записи
                    case 'clone':
                        //Контроллер управления админкой / сохранения
                        require_once (SYS_CONTROLLES."c_managment.php");
                        //Запуск контроллера ..
                        new C_Managment();
                    break;
                    
                    // Добавления записи
                    case 'add':
                        //Контроллер управления админкой / сохранения
                        require_once (SYS_CONTROLLES."c_managment.php");
                        //Запуск контроллера ..
                        new C_Managment();
                    break;
                    
                    // Сохранение записи
                    case 'save':
                        //Контроллер управления админкой / сохранения
                        require_once (SYS_CONTROLLES."c_managment.php");
                        //Запуск контроллера ..
                        new C_Managment();
                    break;
                    
                    // Удаление записи
                    case 'delete':
                        //Контроллер управления админкой / сохранения
                        require_once (SYS_CONTROLLES."c_managment.php");
                        //Запуск контроллера ..
                        new C_Managment();
                    break;
                    
                    // Удаление записи
                    case 'delete_blocked_ip':
                        //Контроллер управления админкой / сохранения
                        require_once (SYS_CONTROLLES."c_managment.php");
                        //Запуск контроллера ..
                        
                        new C_Managment();
                    break;
                    
                    // Проверка URL (AJAX)
                    case 'check-url':
                        //Контроллер управления админкой / сохранения
                        require_once (SYS_CONTROLLES."c_managment.php");
                        //Запуск контроллера ..
                        new C_Managment();
                    break;
                    // Дополнительные возможности
                    case 'additionally':
                        //Контроллер управления админкой / сохранения
                        require_once (SYS_CONTROLLES."c_managment.php");
                        //Запуск контроллера ..
                        new C_Managment();
                    break;
                    //Добавить новый раздел / Главная
                    case 'add-new-main-section':
                        //Модель управления админкой / рекурсия сохранения
                        require_once (SYS_MODELS."m_managment.php");
                        //Запуск модели ..
                        $M_Managment = new M_Managment();
                        if(is_numeric($URL[3])) {
                            //Добавление ...
                            $M_Managment->add_new_main_section_m (0, 0, false, trim($URL[3]));
                        } else {
                            //Ошибка
                            $C_View->view('main/error');
                        }
                    break;
                    
                    //Сохранить разделы / Главная
                    case 'save-main-section':
                        //Контроллер управления админкой / рекурсия сохранения
                        require_once (SYS_CONTROLLES."c_managment.php");
                        //Модель управления админкой / рекурсия сохранения
                        require_once (SYS_MODELS."m_managment.php");
                        //Запуск контроллера ..
                        $C_Managment = new C_Managment(true);
                        //Запуск модели ..
                        $M_Managment = new M_Managment();
                        
                        //Сохранение / Обновление разделов
                        if (!empty($_POST) && isset($_POST['save'])) {
                            //на обработку
                            $query = $C_Managment->query_save_section_c($_POST, false, true);
                            //на сохранение
                            $list_inserted_id = $M_Managment->save_section_m($query);
                            //Заменая вложеных URL
                            if($list_inserted_id){
                               $C_Managment->action_inserted_id_c($list_inserted_id, true);
                            } 
                            //редирект  
                            Lib_url::redirect(URL_ADMIN); 
                        } else {
                            //Ошибка
                            $C_View->view('main/error');
                        }
                    break;
                    
                    // Удаление main menu
                    case 'del-main-section':
                        if (is_numeric($URL[3])) {
                            //Модель управления админкой / рекурсия сохранения
                            require_once (SYS_MODELS."m_managment.php");
                            //Запуск модели ..
                            $M_Managment = new M_Managment();
                            //Удаление 
                            if($M_Managment->del_section_m(trim($URL[3]))) {
                                Lib_url::redirect(URL_ADMIN);
                            } else {
                                //Ошибка
                                $C_View->view('main/error'); 
                            }
                        } else {
                            //Ошибка
                            $C_View->view('main/error'); 
                        }
                    break;
                    
                    //Настройки сайта
                    case 'settings':
                        //Подключаем контроллер карты админки
                        require_once(SYS_CONTROLLES.'c_settings.php');
                        //Вызов 
                        $C_Settings = new C_Settings();
                        $C_Settings->view_sett_c();
                    break;
                    
                    //Сохранение Настройки сайта
                    case 'save-settings':
                        //проверка post
                        if(isset($_POST['save'])) {
                            //Подключаем контроллер карты админки
                            require_once(SYS_CONTROLLES.'c_settings.php');
                            //Вызов 
                            $C_Settings = new C_Settings();
                            $C_Settings->save_sett_c($_POST);
                            
                        } else {
                            //Ошибка
                            $C_View->view('main/error');
                        }
                    break;
                    
                    //Карта админки
                    case 'map-admin':
                        //Подключаем контроллер карты админки
                        require_once(SYS_CONTROLLES.'c_map_admin.php');
                        //Вызов 
                        new C_Map_admin();
                    break;
                    
                    //Пользователи админки
                    case 'users':
                        //Подключаем контроллер карты админки
                        require_once(SYS_CONTROLLES.'c_users.php');
                        //Вызов 
                        $C_Users = new C_Users();
                        //Список юзеров
                        if(!$URL[3]) {
                            $C_Users->_view_users_c();
                        //Редактировать одного юзера
                        } elseif(is_numeric($URL[3])) {
                            $C_Users->_edit_user_c(trim($URL[3]));
                        } else {
                            //Ошибка
                            $C_View->view('main/error');
                        }
                    break;
                    
                    //Добавить нового пользователя
                    case 'add-new-user':
                        //Подключаем контроллер карты админки
                        require_once(SYS_MODELS.'m_users.php');
                        //Вызов 
                        $M_Users = new M_Users();
                        //добавление ...
                        if($M_Users->_add_new_user_m()) {
                            Lib_url::redirect(URL_ADMIN."users/");
                        } else {
                            //Ошибка
                            $C_View->view('main/error');
                        }
                    break;
                    
                    //Сохраняем инфу юзера
                    case 'save-user':
                        if(is_numeric($URL[3]) && isset($_POST['save'])) {
                            //Подключаем контроллер карты админки
                            require_once(SYS_CONTROLLES.'c_users.php');
                            //Вызов 
                            $C_Users = new C_Users();
                            //save ...
                            $C_Users->_save_edit_user_c($_POST, trim($URL[3]));
                        } else {
                            //Ошибка
                            $C_View->view('main/error');
                        }
                    break;
                    
                    //Сохраняем список юзеров
                    case 'save-all-users':
                        if(isset($_POST['save'])) {
                            //Подключаем контроллер карты админки
                            require_once(SYS_CONTROLLES.'c_users.php');
                            //Вызов 
                            $C_Users = new C_Users();
                            //save ...
                            $C_Users->_save_list_user_c($_POST);
                        } else {
                            //Ошибка
                            $C_View->view('main/error');
                        }
                    break;
                    //Удаление userov
                    case 'del-user':
                        if(is_numeric($URL[3])){
                            //Подключаем контроллер карты админки
                            require_once(SYS_MODELS.'m_users.php');
                            //Вызов 
                            $M_Users = new M_Users();
                            //Удаляем 
                            if($M_Users->_del_user_m(trim($URL[3]))) {
                                Lib_url::redirect(URL_ADMIN.'users/');
                            } else {
                                //Ошибка
                                $C_View->view('main/error');
                            }
                        } else {
                            //Ошибка
                            $C_View->view('main/error');
                        }
                    break;
                    //Права юзера админки
                    case 'user-right':
                        if(is_numeric($URL[3]) && isset($_POST['save'])) {
                            //Подключаем контроллер карты админки
                            require_once(SYS_CONTROLLES.'c_users.php');
                            //Вызов 
                            $C_Users = new C_Users();
                            //save ...
                            $C_Users->_right_user_c($_POST, trim($URL[3]));
                        } else {
                            //Ошибка
                            $C_View->view('main/error');
                        }
                    break;
                    //Переводы
                    case 'translation':
                        //Подключаем контроллер карты админки
                        require_once(SYS_CONTROLLES.'c_translation.php');
                        //Вызов 
                        $C_Translation = new C_Translation();
                        //гоу ...
                        $C_Translation->_view_translation_c();
                    break;
                    //добавить новый элемент 
                    case 'add-translation':
                        //Подключаем модель карты админки
                        require_once(SYS_MODELS.'m_translation.php');
                        //Вызов 
                        $M_Translation = new M_Translation();
                        //добавление ...
                        if($M_Translation->_add_new_trans_m()) {
                            Lib_url::redirect(URL_ADMIN."translation/");
                        } else {
                            //Ошибка
                            $C_View->view('main/error');
                        }
                    break;
                    //delete translation element
                    case 'del-translation':
                        if(is_numeric($URL[3])){
                            //Подключаем контроллер карты админки
                            require_once(SYS_MODELS.'m_translation.php');
                            //Вызов 
                            $M_Translation = new M_Translation();
                            //Удаляем 
                            if($M_Translation->_del_trans_el_m(trim($URL[3]))) {
                                Lib_url::redirect(URL_ADMIN.'translation/');
                            } else {
                                //Ошибка
                                $C_View->view('main/error');
                            }
                        } else {
                            //Ошибка
                            $C_View->view('main/error');
                        }
                    break;
                    //save translation
                    case 'save-translation':
                        if(isset($_POST['save'])) {
                            //Подключаем контроллер карты админки
                            require_once(SYS_CONTROLLES.'c_translation.php');
                            //Вызов 
                            $C_Translation = new C_Translation();
                            //save ...
                            $C_Translation->_save_list_trans_c($_POST);
                        } else {
                            //Ошибка
                            $C_View->view('main/error');
                        }
                    break;
                    //Orders
                    case 'orders':
                        // Подключаем контроллер Заказов
                        require_once(SYS_CONTROLLES.'c_orders.php');
                        
                        // Если все заказы
                        if(!$URL['3']) {
                            // Obj
                            $C_Orders = new C_Orders (false);
                            // View
                            $C_Orders->view_all_orders_c();
                        } else {
                            // Obj
                            $C_Orders = new C_Orders (true);
                        }
                    break;
                    // Subscribe
                    case 'subscribe':
                        // Подключаем контроллер Заказов
                        require_once(SYS_CONTROLLES.'c_subscribe.php');
                        //-
                        $C_subscribe = new C_Subscribe();
                        
                        // Если все заказы
                        if(!$URL['3']) {
                            $dataView = $C_subscribe->listSubscribe_c ();
                            $C_View->view('subscribe_list', 'main/menu', $dataView);
                        } else {
                            if($URL[3] == 'del' && is_numeric($URL[4])) {
                                if($C_subscribe->delSubs_m($URL[4])) {
                                    Lib_url::redirect(URL_ADMIN.'subscribe/');
                                }
                            }
                        }
                    break;
                    
                    //Главная Админки / Контроль ошибок
                    default:
                        if($URL[2] == "") {
                            //Модель управления админкой / рекурсия сохранения
                            require_once (SYS_MODELS."m_managment.php");
                            //Запуск модели ..
                            $M_Managment = new M_Managment();
                            
                            //Главная / инфа
                            $main_info = $M_Managment->info_tpl_m(0);
                            //Категории для главной
                            $main_cat = $M_Managment->show_cat_parent_m(0);
                            
                            //Главная / Вид
                            $C_View->view('main/index', 'main/menu', $main_info, $main_cat);
                        } else {
                            //Ошибка
                            $C_View->view('main/error');
                        }
                    break;
                }
            //end admin
            break;
        } // end 1 - switch($URL[1])
    }
}
?>