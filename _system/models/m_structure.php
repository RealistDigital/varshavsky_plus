<?php
//---------------------------------------------------------------------------------------------
// Модель Управления Структурой
//---------------------------------------------------------------------------------------------
Class M_Structure {
    public function __construct() {
    
    }
    //---------------------------------------------------------------------------------------------
    // КАТЕГОРИИ / (список, инфа, редакт., удаление)
    //---------------------------------------------------------------------------------------------

    //Инфа о редактированой категории
    public function info_edit_cat_m ($id) {
        $res = DB::query("SELECT * FROM ".TABLE_TPL." WHERE `id`=".$id."");
        $row = DB::fetchAssoc($res);
        return $row;
    }
    
    // Список всех категорий / Для вложености
    public function show_all_cat_in_m() {
        $res = DB::query("SELECT * FROM ".TABLE_TPL."");
        while($row = DB::fetchAssoc($res)) {
            $data[$row['parent_id']][] = $row;
        }
        return $data;
    }
    
    //Сохранение новой категории
    public function save_new_cat_m($post) {
        $sql = "INSERT INTO ".TABLE_TPL." (`name`, `parent_id`, `edit_tpl`, `view_tpl`, `description`) VALUES ('".trim($post['name_cat'])."', '".trim($post['cat_id'])."', '".trim($post['edit_tpl'])."', '".trim($post['view_tpl'])."', '".trim($post['description_cat'])."')";
        if(DB::exec($sql)) {
            return true;
        }
        return false;
    }
    
    //Сохранение редактирования категории
    public function save_edit_cat_m($post, $id_cat) {
        //Сохранение ...
        $sql = "UPDATE ".TABLE_TPL." SET `parent_id`='".trim($post['cat_id'])."', `name`='".trim($post['name_cat'])."', `edit_tpl`='".trim($post['edit_tpl'])."', `view_tpl`='".trim($post['view_tpl'])."', `description`='".trim($post['description_cat'])."' WHERE `id`='".$id_cat."'";
        if(DB::exec($sql)) {
            return true;
        }
        return false;
    }
    
    //Удаление категории
    public function delete_cat_m($id_cat) {
        //Выбрать вложеные категория / Если они есть
        $query_in = "SELECT COUNT(*) as count FROM ".TABLE_TPL." WHERE `parent_id` = ".$id_cat."";
        $res = DB::query($query_in);
        $count = DB::fetchObject($res);
        
        //Если нету вложенности то Удаляем
        if($count->count == 0) {
            //Удаление ...
            $sql = "DELETE FROM ".TABLE_TPL." WHERE `id`='".$id_cat."'";
            if(DB::exec($sql)) {
                Lib_url::redirect(URL_ADMIN."structure/");
            }
        //Если есть Дети то Не Удаляем    
        } else {
            Lib_url::redirect(URL_ADMIN."structure/#warning-del-cat");
        }
        
    }
    
    // Все вложеные шаблоны
    public function allChidTemplate_m ($idTemplate) {
        global $arrayChild;
        $arrayChild[] = $idTemplate;
        //-
        $res = DB::query("SELECT `id` FROM ".TABLE_TPL." WHERE `parent_id`=".$idTemplate."");
        while($row = DB::fetchAssoc($res)) {
            $this->allChidTemplate_m($row['id']);
        }
        //-
        return $arrayChild;   
    }
    
    // ID на Edit страницу 
    public function idOnEdit_m ($typeTpl) {
        $res = DB::query("SELECT `id` FROM ".TABLE." WHERE `type_tpl`=".$typeTpl."");
        $row = DB::fetchAssoc($res);
        
        return $row['id'];
    }   
}
?>