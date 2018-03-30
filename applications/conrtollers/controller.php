<?php
//-----------------------------------------------------------------------------
// Главный Контроллер сайта
//-----------------------------------------------------------------------------

//Подключаем контроллер вида
require_once(URL_CONTROLLERS."view.php");

Class Controller extends Model {
    
    public function __construct () {
        
        $URL = Lib_url::getUrl();
        //Узнаем текущий URL
        if($URL[1] != "") {
            foreach ($URL as $k => $v) {
                if($k == 0) continue;
                $url_addr .= $v."/";
            }
            //Инфа для текущего URL 
            $info_url   = $this->current_url_info_m($url_addr);
        } else {
            //Инфа для Главной
            $info_url   = $this->current_id_info_m(1);
        }
        
        //Узнаем какой вид подставлять
        $main_view      = $this->current_view_m($info_url['type_tpl']);
        //-
        switch ($main_view) {
            case 'view_parent':
                // url для parent
                $view_parent = $this->view_parent_m($url_addr);
                // redirect на parent
                Lib_url::redirect("/".LANG."/".$view_parent, 'location', 301);
            break;
            case 'view_child':
                // url для child
                $view_chield = $this->view_child_m($url_addr);
                // redirect на child 
                Lib_url::redirect("/".LANG."/".$view_chield, 'location', 301);
            break;
            case 'view_second_child':  // выбрать второй элемент
                // url для second child
                $view_second_chield = $this->view_second_child_m($url_addr);
                // redirect на child 
                Lib_url::redirect("/".LANG."/".$view_second_chield, 'location', 301);
            break;
            default:
                //--
            break;
        } 
        
        //Настройки сайта
        $settinds_site  = $this->settings_info_m();
        //Переводы для сайта
        $langs_site     = $this->langs_info_m();
        //Запуск контроллера вида
        $View           = new Site_View();
        
        //Показываем основную инфу
        $View->view($main_view, $info_url, $settinds_site, $langs_site); 
        
        /**
         * View method for AJAX
         * /applications/_ajax/content.php - this file for AJAX request
        */
        // $View->view_ajax($main_view, $info_url, $settinds_site, $langs_site); 
        
        /**
         * View method for print Version
         * 
        //Показываем основную инфу
        if ($info_url['type_tpl'] != 86) { // не забуть удалить, если нет Print Version, а то будет Караул... ) 
            
        //Показываем PRINT инфу
        } else {
            $id_page_for_print = filter_var($_GET['page'], FILTER_VALIDATE_INT);
            if (($id_page_for_print)) {
                $dataCurrentId  = $this->current_id_info_m ($id_page_for_print);
                $tplViewPrint   = $this->current_view_m($dataCurrentId['type_tpl']); 
                // view on print
                $print_view     = preg_replace('/view/', 'print', $tplViewPrint);
            }
            // View Print ..
            $View->view_print($print_view, $dataCurrentId, $settinds_site, $langs_site); 
        }
        */
    }
}


?>