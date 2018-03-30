<?
//-----------------------------------------------------------------------------
// Системная библиотека функций
//-----------------------------------------------------------------------------
Class Lib_system {
    
    /**
     * Обработка инфы которая сохр. в DB 
     * @param - stirng 
    */
    public static function processingDbInfoSave ($string) {
        
        $string = DB::quote($string);
        $string = Lib::save_data_filter ($string);
        
        return $string;
    }  
    
    /**
     * Обработка инфы которая выводиться из DB 
     * @param - stirng 
    */
    public static function processingDbInfoView ($string) {
        
        $string = Lib::save_data_filter ($string);
        return $string;
    } 

	/**
     * Обрезание русской строки без траблов
     * @param string
     * @param edd point
    */
    public static function subString ($string = null, $endChar = null) {
        
        if (!is_null($string) && !is_null($endChar)) {
            $string = iconv('UTF-8', 'windows-1251', $string);
            $string = substr($string, 0, $endChar);
            $string = iconv('windows-1251', 'UTF-8', $string);
        }
        
        return $string;
    }	
}

    
?>