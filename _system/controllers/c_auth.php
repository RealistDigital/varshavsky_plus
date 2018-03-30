<?php
//-----------------------------------------------------------------------------
// Контроллер авторизации / проверка подлинности
//-----------------------------------------------------------------------------

//Модель Входа в Админку
require_once(SYS_MODELS.'m_login.php');

Class C_Auth extends M_Login {
    
    // Статус авторизации
    protected $_statusAuth = false;
    
    // авторизация в админку
    public function __construct() {
        
        // проверка по IP
        if ($this->checkAccessByIP () == false) {
            $this->_statusAuth = false;
            //Нахер с админки
            Lib_url::redirect(URL);
        }
        
        //проверка Session
        if (isset($_SESSION['user_id']) && isset($_SESSION['user_login']) && isset($_SESSION['user_pass'])) {
            //проверяем пользователя 
            $res_auth = $this->_auth_m($_SESSION['user_login'], Lib::_decoding_pass($_SESSION['user_pass']));
            //Если нет то все приехали ....
            if(!$res_auth){
                //Убиваем сессию 
                unset($_SESSION['user_id']);    //ID
                unset($_SESSION['user_login']); //Login
                unset($_SESSION['user_pass']);  //Pass
                unset($_SESSION['user_name']);  //Имя 
                unset($_SESSION['user_right']); //Права
                unset($_SESSION['isLoggedIn']); //Tiny MCE 
                $this->_statusAuth = false;
                
                //Нахер с админки
                Lib_url::redirect(URL_ADMIN);
                exit;
            } 
            $this->_statusAuth = true;
        //проверяем куку    
        } elseif (isset($_COOKIE['_auth']) && !empty($_COOKIE['_auth'])) {        
            $cookie_auth = Lib::_decoding_cookie($_COOKIE['_auth']);
            
            $login_cookie   = $cookie_auth[1];
            $pass_cookie    = Lib::_decoding_pass($cookie_auth[2]);   
            
            //проверяем пользователя 
            $user_info = $this->_auth_m($login_cookie, $pass_cookie);
            //Если кука подлинная
            if($user_info){
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

                $this->_statusAuth = true;
            //Если кривая кука    
            } else {   
                $this->_statusAuth = false;
                setcookie('_auth', '', time()-2592000,'/'); //убиваем ложную куку
                //Нахер с админки
                Lib_url::redirect(URL_ADMIN);
                exit;
            }
        }
    }
    
    /**
     * Проверка отдельного модуля авторизации
     * 
     * @return boolean
    */
    public function checkUserAuth () {
        if ($this->_statusAuth) {
            return true;
        }
        return false;
    } 
    
    /**
     * Проверка по IP
     * 
     * @return boolean
    */
    public function checkAccessByIP () {
        $currentIp      = $_SERVER['REMOTE_ADDR'];
        $allovedIpsArr  = $this->_getAlloedIps ();
        
        if (empty($allovedIpsArr)) {
            return true;
        } else {
            if (in_array($currentIp, $allovedIpsArr) !== false) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * Список разрешенных IP
     * 
     * @return array
    */
    protected function _getAlloedIps () {
        global $settings;
        $allovedIps = array();
        
        if (!empty($settings['allow_ips'])) {
            $arrIps = explode(',', $settings['allow_ips']);
            
            if (!empty($arrIps)) {
                foreach ($arrIps as $k => $v) {
                    $ip = trim($v);
                    if (filter_var($ip, FILTER_VALIDATE_IP)) {
                        $allovedIps[] = $ip;
                    }
                }
            }
        }
        
        return $allovedIps;
    }
}

?>