<?php
//-----------------------------------------------------------------------------
// Контроллер перевода эл. сайта
//-----------------------------------------------------------------------------

//Модель..
require_once(SYS_MODELS.'m_translation.php');

Class C_Translation extends M_Translation {
    
    public function __construct() {
        //Вид
        $this->View = new C_View();
        //URL
        $this->URL = Lib_url::getUrl();
    }
    
    //показать все инфу
    public function _view_translation_c () {
        //инфа
        $all_translation = $this->_view_translation_m();
        //вид 
        $this->View->view('main/translation', 'main/menu', $all_translation);
    }
    
    //save translation
    public function _save_list_trans_c ($post) {
        foreach ($post as $k => $v) {
            if($k == 'save') continue; //пропуск кнопки
            //узнаем где отделить ID 
            $pos = strpos($k, '_id_');
            $id  = substr($k, $pos+4, 10); //ID
            //Поле ..
            $field = substr($k, 0, $pos);
            $set[$id] .= $field."=".Lib_system::processingDbInfoSave($v).", ";  //Запрос
       }
       //на save отдаем
       if($this->_save_list_trans_m($set)) {
            Lib_url::redirect(URL_ADMIN."translation/");
       } else {
            //Ошибка
            $this->View->view('main/error');
       }
    }
}
    
?>