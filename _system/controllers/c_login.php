<?php
//-----------------------------------------------------------------------------
// Контроллер Входа в Админку / Login
//-----------------------------------------------------------------------------

//Модель Входа в Админку
require_once(SYS_MODELS.'m_login.php');

Class C_Login extends M_Login {
    public function __construct() {
        //Views
        $this->C_View = new C_View();
        //URL
        $URL = Lib_url::getUrl();
        //Общая lib
        
        //Если User не залогинен то redirect на login 
        if(!isset($_SESSION['user_id']) && !isset($_SESSION['user_name']) && !isset($_SESSION['user_login'])) {  
            if($URL[2] != 'login') {
                header('Location:'.URL_ADMIN.'login/');
                exit;
            } else {
                //Авторицация ...
                $login      = Lib::form_filter($_POST['login']);     //login проверка фильтром
                $pass       = Lib::form_filter($_POST['pass']);       //pass проверка фильтром
                $rememder   = $_POST['rememder'] == 'on' ? true : false; //cookies запомнить
                
                $this->login($login, $pass, $rememder);
            }
        }
    }
    //Login 
    public function login ($login=false, $pass=false, $remember=false) {
        if ($login == false && $pass == false) {
        	$count_ip = $this->_find_blocked_ip($_SERVER['REMOTE_ADDR']);
        	if($count_ip>3){
				die('Ваш IP заблокирован.');
			}
            //Когда пустая форма
            $this->C_View->view('main/login', false, false, false, false, false, false, false, false, false, false, false);   
            exit; 
        } elseif($login == false || $pass == false) {
            // пишем в LOG - неудачный вход
            $this->log_login_to_admin(false, $login, $pass);
            //Криво заполнили форму 
            $this->C_View->view('main/login', false, $massages_adm, false, false, false, false, false, false, false, false, false); 
            exit;
        } else {
            //Ищем в БД user-a
            $user_info = $this->_auth_m($login, $pass);

            //Если нет такого юзера
            if(!$user_info) {
            	// добавляем ip в список заблокированных
            	$this->_add_blocked_ip($_SERVER['REMOTE_ADDR']);
                // пишем в LOG - неудачный вход
                $this->log_login_to_admin(false, $login, $pass);
                // redirect 
                Header("Location:".URL_ADMIN);
                exit;
            }
            
            // очищаем базу от заблокированных ip текущего пользователя
            $this->_clear_blocked_ip($_SERVER['REMOTE_ADDR']);
            
            //Если "запомнить меня" / в cookies
            if ($remember) {
                $array_auth     = array($user_info['id'], $user_info['login'], $user_info['pass']);   //Массив для шифрования cookie
                $cookies_auth   = Lib::_encoding_cookie($array_auth);   //Шифруем куку        
                setcookie('_auth', $cookies_auth, time()+2592000, '/');     //авторизация, установка на 30 дней
            } 
            
            //если все норм / пользователь есть в БД
            $_SESSION['user_id']        = $user_info['id'];        //ID пользователя
            $_SESSION['user_name']      = $user_info['name'];      //имя
            $_SESSION['user_login']     = $user_info['login'];     //логин
            $_SESSION['user_pass']      = $user_info['pass'];      //пароль
            /** права пользователя админки */
            $_SESSION['user_right']['right_edit']       = $user_info['right_edit'];
            $_SESSION['user_right']['right_delete']     = $user_info['right_delete'];
            $_SESSION['user_right']['right_template']   = $user_info['right_template'];
            $_SESSION['user_right']['right_sect_dis']   = $user_info['right_sect_dis'];
            $_SESSION['user_right']['right_sect_del']   = $user_info['right_sect_del'];
            $_SESSION['user_right']['right_sect_edit']  = $user_info['right_sect_edit'];
            $_SESSION['user_right']['right_manag_dis']  = $user_info['right_manag_dis'];
            
            // пишем в LOG - удачный вход
            $this->log_login_to_admin(true, $user_info['login'], $user_info['pass']);
            //Редирект на главную
            Header("Location:".URL_ADMIN);
            exit;
            
        }   
    }
    // Запись в лог - кто заходил в админку
    public function log_login_to_admin ($result=false, $login=false, $pass=false) {
        // имя файла который хранит LOG
        $filename_log = 'login_to_admin_panel.txt';
        // путь ...
        $path_log = $_SERVER['DOCUMENT_ROOT']."/logs/";

        @chmod($path_log, 0755);
        @chmod($path_log . $filename_log, 0755);
        
        // открывает || создает - файл ..
        $fopen = fopen($path_log . $filename_log, 'a+');
        
        /** Настройки сообщения для LOG */
        // статус входа 
        $status_log = !$result ? "ERROR" : "GOOD";
        // разделитель
        $sep_log = "-------------------------------------------------------------------------------";
        // date
        $date_log = date("d-m-Y H:i:s");
        // IP user
        $ip_log = $_SERVER['REMOTE_ADDR'];
        // браузер
        $info_user_log = $_SERVER['HTTP_USER_AGENT'];
        // сообщение для записи
        $mess_log .= "\nStatus login: ".$status_log;
        $mess_log .= ", Date: ".$date_log;
        $mess_log .= ", Login: ".$login;
        $mess_log .= ", Pass: ".$pass_log = !$result ? $pass : "- no access -";
        $mess_log .= ", IP User: ".$ip_log;
        $mess_log .= ", Info user agent: ".$info_user_log;
        $mess_log .= "\n".$sep_log.$sep_log.$sep_log;
        // запись в файл 
        fwrite($fopen, $mess_log);
        // закрываем файл
        fclose($fopen);
    }
}
?>