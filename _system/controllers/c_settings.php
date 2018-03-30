<?php
//-----------------------------------------------------------------------------
// Контроллер настроек
//-----------------------------------------------------------------------------

//Модель настроек
require_once(SYS_MODELS.'m_settings.php');
 
Class C_Settings extends M_Settings {
    
    public function __construct() {
        //Obj view
        $this->View = new C_View ();
    }
    
    //Показать 
    public function view_sett_c() {
        //инфа 
        $info = $this->all_settings_m ();
        //вид настроек
        $this->View->view('main/settings', 'main/menu', $info); 
    }
    
    //Сохранить
    public function save_sett_c ($post) {
        //готовым запрос нв save
        foreach ($post as $k => $v) {
            if($k == 'save') continue;  // пропускаем кнопку
            
            if ($k != 'allow_ips') {
                $set .= $k." = ". Lib_system::processingDbInfoSave($v) . ", ";
            } else { // ip проверка
                $set .= $k." = "."'" . $this->_filterIp($v) . "', ";
            }
        }
        //Запросл
        $set = substr($set, 0, -2);
        //на save
        if($this->save_settings_m($set)) {
            Lib_url::redirect(URL_ADMIN.'settings/');
        } else {
            //Ошибка
            $this->View->view('main/error');
        }
            
    } 
    
    // Отфильтровать правильные IP
    private function _filterIp ($idsString) {
        $resultIP = null;
    
        if (!empty($idsString)) {
            $arrIP = explode(',', $idsString);

            if (!empty($arrIP)) {
                foreach ($arrIP as $ip) {
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP)) {
                        $resultIP[] = $ip;
                    }
                }
                $resultIP = !empty($resultIP) ? implode(',', $resultIP) : null;
            }
        }
        
        return $resultIP;
    } 
}

?>