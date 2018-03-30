<?php

/**
---------------------------------------------------------------------------------------------------
Права доступа к разделам
---------------------------------------------------------------------------------------------------
*/
Class C_Right {
    //-----------------------------------------------------------------------------
    // Отображение разделов взависимости от правов
    //-----------------------------------------------------------------------------
    public static function _main_right ($id=false, $right_str=false) {
        if(!$id || !$right_str) return false;
        //искомая строка
        $str = "/".$id."/";
        //ищем...
        $res = strpos($right_str, $str);
        if($res === false) return false;
        //скрыть
        return "style='display:none;'";
    }
    //Запрет видимости Контентных разделов
    public static function _edit ($id=false) {
        return C_Right::_main_right($id, $_SESSION['user_right']['right_edit']);        
    }
    //Запрет видимости выбора шаблонов у Контентных разделах 
    public static function _tpl ($id=false) {
        return C_Right::_main_right($id, $_SESSION['user_right']['right_template']);        
    }
    //Запрет удаления Контентных разделов
    public static function _del ($id=false) {
        return C_Right::_main_right($id, $_SESSION['user_right']['right_delete']);        
    }
    //Запрет видимости главных разделов
    public static function _section_dis ($id=false) {
        return C_Right::_main_right($id, $_SESSION['user_right']['right_sect_dis']);        
    }
    //Запрет удаления главных разделов
    public static function _section_del ($id=false) {
        return C_Right::_main_right($id, $_SESSION['user_right']['right_sect_del']);        
    } 
    //Запрет редактирования главных разделов
    public static function _section_edit ($id=false) {
        return C_Right::_main_right($id, $_SESSION['user_right']['right_sect_edit']);        
    } 
    //Запрет отображения менюшек в разделе Упр. контентом
    public static function _management_dis ($id=false) {
        return C_Right::_main_right($id, $_SESSION['user_right']['right_manag_dis']);        
    }
}

?>