<?php
//-----------------------------------------------------------------------------
// Контроллер карты админки
//-----------------------------------------------------------------------------

//Модель карты админки
require_once(SYS_MODELS.'m_map_admin.php');
 
Class C_Map_admin extends M_Map_admin {
    public function __construct() {
        //Views
        $C_View = new C_View();
        //Инфа для Карты
        $all_info_map = $this->all_info_for_map_m();
        //Вид карты ...
        $C_View->view('main/map_admin', 'main/menu', $all_info_map);       
    }
    
}

?>