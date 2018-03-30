<?php
//-----------------------------------------------------------------------------
// Контроллер пользователей адинки
//-----------------------------------------------------------------------------

//Модель..
require_once(SYS_MODELS.'m_users.php');

Class C_Users extends M_Users {
    
    public function __construct() {
        //Вид
        $this->View = new C_View();
        //URL
        $this->URL = Lib_url::getUrl();
    }
    
    //View users
    public function _view_users_c (){
        //Все users
        $all_users = $this->all_users_m();
        //в шаблон 
        $this->View->view('main/users', 'main/menu', $all_users);    
    }
    //Edit user
    public function _edit_user_c ($id) {
        //Info one user
        $one_user_m = $this->one_user_m($id);
        //Подключаем контроллер карты админки / для составления дерева админки
        require_once(SYS_MODELS.'m_structure.php');
        //Вызов 
        $M_Structure = new M_Structure ();
        //Инфо для дерева админки
        $tree_info = $M_Structure->show_all_cat_in_m();
        //Инфо для главного меню Упр. контентом
        $list_main_menu = $this->list_main_menu_m();
        
        //в шаблон 
        $this->View->view('main/user_edit', 'main/menu', $one_user_m, false, $this->URL, $tree_info, false, false, $list_main_menu);
    }
    //save edit user 
    public function _save_edit_user_c ($post, $id) {
        //готовым запрос нв save
        foreach ($post as $k => $v) {
            if($k == 'save') continue;  // пропускаем кнопку
            //пароль - шифруем
            if($k == 'pass'){
                $ecoding_pass = Lib::_encoding_pass(trim($v)); //кодим
                $set .= $k." = "."'".$ecoding_pass."', ";
            } else {
                $set .= $k." = "."'".trim($v)."', ";
            }
            
        }
        //Запросл
        $set = substr($set, 0, -2);
        //на save
        if($this->save_user_m($set, $id)) {
            Lib_url::redirect(URL_ADMIN.'users/');
        } else {
            //Ошибка
            $this->View->view('main/error');
        }
    }
    //save list users
    public function _save_list_user_c ($post) {
        
        foreach ($post as $k => $v) {
            if($k == 'save') continue; //пропуск кнопки
            //узнаем где отделить ID 
            $pos = strpos($k, '_');
            $id  = substr($k, $pos+1, 10); //ID
            //Поле ..
            $field = substr($k, 0, $pos);
            //access 
            if($field == 'access' && $v == 'on') {
                $v = 'yes';
            }
            $set[$id] .= $field."=".Lib_system::processingDbInfoSave($v).", ";  //Запрос
       }
       //на save отдаем
       if($this->save_list_users_m($set)) {
            Lib_url::redirect(URL_ADMIN."users/");
       } else {
            //Ошибка
            $this->View->view('main/error');
       }
    }
    //готовим запрос для save прав usera
    public function _right_user_c ($post, $id_user) {
        foreach ($post as $k => $v) {
            if($k == 'save') continue; //пропуск кнопки
            //узнаем где отделить ID 
            $pos = strpos($k, '_');
            $id_field  = substr($k, $pos+1, 10); //ID
            //Поле ..
            $field = substr($k, 0, $pos);
            //edit
            if($field == 'edit' && $v == 'on') {
                $edit .= $id_field."/";
            }
            //delete
            if($field == 'delete' && $v == 'on') {
                $delete .= $id_field."/";
            }
            //template template
            if($field == 'template' && $v == 'on') {
                $template .= $id_field."/";
            }
            //section disable
            if($field == 'sectdis' && $v == 'on') {
                $sectdis .= $id_field."/";
            }
            //section del
            if($field == 'sectdel' && $v == 'on') {
                $sectdel .= $id_field."/";
            }
            //section edit
            if($field == 'sectedit' && $v == 'on') {
                $sectedit .= $id_field."/";
            }
            //Главное меню упр. контентом
            if($field == 'managementdis' && $v == 'on') {
                $managementdis .= $id_field."/";
            }
            
       }
       //запросы 
       $set['edit'] = $edit == "" ? '0' : "/".$edit;                //общие edit
       $set['delete'] = $delete == "" ? '0' : "/".$delete;          //общие delete
       $set['template'] = $template == "" ? '0' : "/".$template;    //общие template hidden
       $set['sectdis'] = $sectdis == "" ? '0' : "/".$sectdis;       //раздеры меню скрыть
       $set['sectdel'] = $sectdel == "" ? '0' : "/".$sectdel;       //раздеры меню удаление
       $set['sectedit'] = $sectedit == "" ? '0' : "/".$sectedit;    //раздеры меню редактирование
       $set['managementdis'] = $managementdis == "" ? '0' : "/".$managementdis;    //главное меню упр. контентом / скрыть
       
       //save 
       if($this->save_right_user_m($set, $id_user)){
            /** права пользователя админки */
            $_SESSION['user_right']['right_edit']  = $set['edit'];
            $_SESSION['user_right']['right_delete']   = $set['delete'];
            $_SESSION['user_right']['right_template']   = $set['template'];
            $_SESSION['user_right']['right_sect_dis'] = $set['sectdis'];
            $_SESSION['user_right']['right_sect_del'] = $set['sectdel'];
            $_SESSION['user_right']['right_sect_edit'] = $set['sectedit'];
            $_SESSION['user_right']['right_manag_dis'] = $set['managementdis'];
       
            Lib_url::redirect(URL_ADMIN."users/".$id_user.'/'); 
       } else {
            //Ошибка
            $this->View->view('main/error');
       }
    }
    
    

}

?>