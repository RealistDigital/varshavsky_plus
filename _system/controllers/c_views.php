<?php
//-----------------------------------------------------------------------------
// Главный Контроллер VIEWS / Виды 
//-----------------------------------------------------------------------------

//Модель управления админкой / для публичной части URL
require_once (SYS_MODELS."m_managment.php");

Class C_View extends M_Managment {
    /** Основной вид / Модуль вида 
     * @view                - главный вид
     * @menu                - меню вкл. / выкл.
     * @data                - основные даные
     * @tpl-data            - даные для шаблона
     * @url                 - масив URL
     * @data-info           - даные для инфо блока или html шаблон
     * @breadcrumbs-view    - вид для навигации
     * @breadcrumbs-data    - инфа для навигации
     * @right-id            - ID для прав
     * @public-url          - URL для публичной части 
     * @header-v            - показать header / default TRUE
     * @footer-v            - показать footer / default TRUE            
    */
    public function view ($view=false, $menu=false, $data=false, $tpl_data=false, $url=false, $data_info=false, $breadcrumbs_view=false, $breadcrumbs_data=false, $right_id=false, $public_url=false, $header_v = true, $footer_v = true) {
        //Функционал для сайта
        require_once(URL_APP."_general/general.php");
		
		//Header
        if($header_v) {
            require_once SYS_VIEWS.'main/header.php';
        }
        //меню 
        if ($menu != false) {
            require_once SYS_VIEWS.$menu.'.php';
        }
        //breadcrumbs
        if($breadcrumbs_view != false) {
            require_once SYS_VIEWS.$breadcrumbs_view.'.php';
        }
        //проверка файла в Общей директории Edit шаблонов
        if(file_exists(URL_EDIT.$view.'.php')) {
            require_once URL_EDIT.$view.'.php';  //Odl SYS_VIEWS
        //проверка файла в Системной директории   
        } elseif(file_exists(SYS_VIEWS.$view.'.php')) {
            require_once SYS_VIEWS.$view.'.php';
        //Ошибка 
        } else {
            require_once SYS_VIEWS.'main/error.php';
        }
        //Footer
        if($footer_v) {
            require_once SYS_VIEWS.'main/footer.php';
        } 
    }
}

?>