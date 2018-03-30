<?php
//-----------------------------------------------------------------------------
// Контроллер подписки
//-----------------------------------------------------------------------------

//Модель..
require_once(SYS_MODELS.'m_subscribe.php');

Class C_Subscribe extends M_Subscribe {
    
    public function __construct() {
        //Вид
        $this->View = new C_View();
        //URL
        $this->URL = Lib_url::getUrl();
    }
    
    public function listSubscribe_c () {
        $flag = $_POST['sort'] == "" ? null : $_POST['sort'];
        return $this->listSubscribe_m($flag);
    }
    
    

}

?>