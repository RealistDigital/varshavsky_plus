<?php
//-----------------------------------------------------------------------------
// Главный Контроллер VIEWS / Виды 
//-----------------------------------------------------------------------------
Class Site_View {
    
    /** Основной вид / Модуль вида 
     * @view        - главный вид
     * @data        - основные даные
     * @settings    - настройки сайта  
     * @langs       - переводы
	 * @error		- текст ошибки	
    */
    public function view ($view=false, $data=false, $settings=false, $langs=false, $error=false) 
    {
        // Header for ERROR page
        if(!file_exists(URL_VIEWS.$view.'.php')) {
            header("HTTP/1.0 404 Not Found");
        }
        //Функционал для сайта
        require_once(URL_APP."_general/general.php");
        
        //Header
        require_once URL_VIEWS.'main/header.php';
        
        //проверка на существование файла
        if(file_exists(URL_VIEWS.$view.'.php')) {
            require_once URL_VIEWS.$view.'.php';
        } else {
            require_once URL_VIEWS.'main/error.php';
        }
        
        // Footer
        require_once URL_VIEWS.'main/footer.php';
    }
    
    /** Основной вид для AJAX 
     * @view        - главный вид
     * @data        - основные даные
     * @settings    - настройки сайта  
     * @langs       - переводы 
    */
    public function view_ajax ($view=false, $data=false, $settings=false, $langs=false) 
    {
		//Функционал для сайта
        require_once(URL_APP."_general/general.php");
		
        if($data['id'] == 1) {
            //Header
            require_once URL_VIEWS.'main/header.php';
        }
        
        //проверка на существование файла
        if(file_exists(URL_VIEWS.$view.'.php')) {
            require_once URL_VIEWS.$view.'.php';
        } else {
            require_once URL_VIEWS.'main/error.php';
        }
        
        if($data['id'] == 1) {
            // Footer
            require_once URL_VIEWS.'main/footer.php';
        }
        
    }
    
    /** Print View
     * @view        - главный вид
     * @data        - основные даные
     * @settings    - настройки сайта  
     * @langs       - переводы 
    */
    public function view_print ($view=false, $data=false, $settings=false, $langs=false) 
    {
        // Header for ERROR page
        if(!file_exists(URL_VIEWS_PRINT.$view.'.php')) {
            header("HTTP/1.0 404 Not Found");
        }
        //Функционал для сайта
        require_once(URL_APP."_general/general.php");
        
        //Header
        require_once URL_VIEWS_PRINT.'main/header.php';
        
        //проверка на существование файла
        if(file_exists(URL_VIEWS_PRINT.$view.'.php')) {
            require_once URL_VIEWS_PRINT.$view.'.php';
        } else {
            require_once URL_VIEWS_PRINT.'main/error.php';
        }
        
        // Footer
        require_once URL_VIEWS_PRINT.'main/footer.php';
    }
}

?>