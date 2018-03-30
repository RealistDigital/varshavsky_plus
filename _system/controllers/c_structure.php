<?php
//--------------------------------------------------------------------------------------------------
// Контроллер Структуры
//--------------------------------------------------------------------------------------------------

//Модель Структуры
require_once (SYS_MODELS."m_structure.php");

Class C_Structure extends M_Structure {
    public function __construct() {
        //URL
        $URL = Lib_url::getUrl();
        //Views
        $C_View = new C_View();
        //Действия в структуре админки ...
        switch ($URL[3]) {
            //Главная стр. Структуры
            case "":
                $all_cat = $this->show_all_cat_in_m(); //все категории стр.
                $data = $this->treeAllCategLi_c(0, 0, $all_cat); // дерево
                //-
                $C_View->view('main/structure','main/menu', $data, false);
            break;
            
            //Добавить новую категорию
            case "add-new-category":
                //Сохранение новой категории
                if (isset($_POST['save_cat'])) {
                    if ($this->save_new_cat_m($_POST)) {
                        Lib_url::redirect(URL_ADMIN."structure/");
                    } else {
                        //Ошибка
                        $C_View->view('main/error');
                    }   
                }
                // Список всех категорий 
                $all_cat = $this->show_all_cat_in_m();
                // Дерево категорий 
                $data['treeOptions'] = $this->treeAllCategOptions_c(0, 0, $all_cat);
                // Список view / edit шаблонов 
                $data['viewTemplates'] = $this->listAllPhpTemplates_c(URL_VIEWS, 'view');
                $data['editTemplates'] = $this->listAllPhpTemplates_c(URL_EDIT, 'edit');
                
                // Показать в View
                $C_View->view('main/add_category','main/menu', $data, false);
            break;
            
            //Редактировать категорию
            case $URL[3] == "edit-category":
                //Сохранение категории
                if (isset($_POST['save_edit_cat'])) {
                    if($this->save_edit_cat_m($_POST, trim($URL[4]))) {
                        Lib_url::redirect(URL_ADMIN."structure/");
                    } else {
                        //Ошибка
                        $C_View->view('main/error');
                    }
                }
                // View 
                if (is_numeric($URL[4])) {
                    // Список всех категорий 
                    $all_cat = $this->show_all_cat_in_m();
                    //Узнаем инфу о редактированой категории
                    $info_edit_cat = $this->info_edit_cat_m(trim($URL[4]));
                    // Выкл. шаблоны
                    $disabledTpl = $this->allChidTemplate_m($info_edit_cat['id']);
                    // Дерево категорий 
                    $data['treeOptions'] = $this->treeAllCategOptions_c(0, 0, $all_cat, $info_edit_cat['parent_id'], $disabledTpl);
                    // Список view / edit шаблонов 
                    $data['viewTemplates'] = $this->listAllPhpTemplates_c(URL_VIEWS, 'view', $info_edit_cat['view_tpl']);
                    $data['editTemplates'] = $this->listAllPhpTemplates_c(URL_EDIT, 'edit', $info_edit_cat['edit_tpl']);
                    $data['name'] = $info_edit_cat['name'];
                    $data['description'] = $info_edit_cat['description'];
                    //Показать в View
                    $C_View->view("main/edit_category", "main/menu", $data, false);
                } else {
                    //Ошибка
                    $C_View->view('main/error');
                }
            break;
        
            //Удалить категорию
            case "del-category":
                if (is_numeric($URL[4])) {
                    //Удалить..
                    $this->delete_cat_m(trim($URL[4]));
                } else {
                    //Ошибка
                    $C_View->view('main/error');
                }
            break;
            
            // Просмотр шаблона
            case "view-template":
                if (is_numeric($URL[4])) {
                    $idEditPage = $this->idOnEdit_m(trim($URL[4]));
                    if($idEditPage != "") {
                        Lib_url::redirect(URL_ADMIN.'edit/'.$idEditPage.'/');
                    } 
                    Lib_url::redirect(URL_ADMIN."structure/");
                } else {
                    //Ошибка
                    $C_View->view('main/error');
                }
            break; 
            //Контроль ошибок 
            default:
                //Ошибка
                $C_View->view('main/error');
            break;                                                
        }
        
    }
    
    /**
     * Дерево всех категорий Option
     * @param - parent id
     * @param - уровень вложенности
     * @param - все категории
     * 
     * @return - string (дерево options)
    */
    private function treeAllCategOptions_c ($parent_id, $level, $data=false, $selectedParent=null, $disabledTpl=null) {
        global $optString;
        //Если категория с таким parent_id существует
        if (isset($data[$parent_id])) { 
            //Обходим
            foreach ($data[$parent_id] as $value) {  
                // $level * 25 - отступ, $level - хранит текущий уровень вложености (0,1,2..) 
                $counter = $level * 2;
                //Стили
                if ($counter > 0) {
                    $separator=null;
                    for ($i=1; $i <= $counter; $i++) {
                        $separator .= '-';
                    }
                }
                $parentSep = $parent_id != 0 ? '>' : null; 
                //-
                $selected = $selectedParent == $value['id'] ? 'selected="selected"' : null;
                if(!is_null($disabled)) {
                    $disabled = array_search($value['id'], $disabledTpl) !== false ? 'disabled="disabled"' : null;
                }
                //Вывод меню
                $optString .= "<option ".$selected." ".$disabled." value=".$value['id'].">".$separator.$parentSep." ".$value["name"]."</option>"; 
                //Увеличиваем уровень вложености 
                $level = $level + 1; 
                //Рекурсивно вызываем эту же функцию, но с новым $parent_id и $level 
                $this->treeAllCategOptions_c($value["id"], $level, $data, $selectedParent, $disabledTpl); 
                //Уменьшаем уровень вложености 
                $level = $level - 1; 
            }
        } 
        return $optString;
    }
    
    /** Вложеность в UL / Доб. нов. кат.
     * Вывод дерева 
     * @param Integer $parent_id - id-родителя 
     * @param Integer $level - уровень вложености 
     */
    private function treeAllCategLi_c ($parent_id, $level, $data=false) {
        global $listTamplates;
        //Если категория с таким parent_id существует
        if (isset($data[$parent_id])) { 
            //Обходим
            foreach ($data[$parent_id] as $value) {  
                // $level * 25 - отступ, $level - хранит текущий уровень вложености (0,1,2..) 
                $margin_left = $level * 20;
                //Стили
                if ($parent_id == 0) { $bold = 'font-weight:bold;'; }
                //Настройка прав удаления
                $del_structure = C_Right::_section_del(1);
                //Вывод меню
                $listTamplates .= "
                        <li class='map-info' style='margin: 5px 0 0 ".$margin_left."px; ".$bold."'>".$value["name"]." 
                            <span style='font-weight:normal;'>|
                                <a class='map-edit' href='".URL_ADMIN."structure/edit-category/".$value["id"]."/' title='Edit'></a>
                                <a class='map-del delete' ".$del_structure." href='".URL_ADMIN."structure/del-category/".$value["id"]."/' title='Delete'></a>
                                <a class='map-tpl-view' href='".URL_ADMIN."structure/view-template/".$value["id"]."/' title='View'></a>
                            <span>
                        </li>"; 
                //Увеличиваем уровень вложености 
                $level = $level + 1; 
                //Рекурсивно вызываем эту же функцию, но с новым $parent_id и $level 
                $this->treeAllCategLi_c($value["id"], $level, $data); 
                //Уменьшаем уровень вложености 
                $level = $level - 1; 
            }
        }
        return $listTamplates;
    }
    
    /**
     * Список PHP шаблонов в папке
     * @param - путь к папке
     * @param - тип шаблонов view / edit
    */
    private function listAllPhpTemplates_c ($path, $typeTpl='view', $selectedTpl=null) {
        $files = scandir($path);
        // default шаблоны 
        $defaultTemplates['view'] = array('view_general');
        $defaultTemplates['edit'] = array('edit_general', 'edit_list', 'edit_files', 'edit_img');
        
        //--
        foreach($files as $file) {
            if(is_file($path.$file)) {
                if(strpos($file, '.php') !== false && strpos($file, $typeTpl) !== false) {
                    // убираем .php
                    $nameTpl = preg_replace('/.php/', '', $file);
                    //-
                    $selected = $selectedTpl == $nameTpl ? 'selected' : null;
                    //-
                    if(array_search($nameTpl, $defaultTemplates[$typeTpl]) !== false) {
                        $defaultTpl .= "<option ".$selected." value='".$nameTpl."'>".$nameTpl."</option>";
                    } else {
                        $otherTpl .= "<option ".$selected." value='".$nameTpl."'>".$nameTpl."</option>";
                    }
                }
            }
        }
        //-
        $selectedViewParent = $selectedTpl == 'view_parent' ? 'selected' : null;
        $selectedViewChild  = $selectedTpl == 'view_child' ? 'selected' : null;
        $selectedViewTwoChild  = $selectedTpl == 'view_second_child' ? 'selected' : null;
        //-
        $defaultView = "<option ".$selectedViewParent." value='view_parent'>view_parent</option>
                        <option ".$selectedViewChild." value='view_child'>view_child</option>
                        <option ".$selectedViewTwoChild." value='view_child'>view_second_child</option>";
        //-
        $defaultTpl = $typeTpl == 'view' ? $defaultTpl.$defaultView : $defaultTpl;                
        //--
        $listAllTpl = "
            <optgroup label='Default templates'>
                ".$defaultTpl."
            </optgroup>
            <optgroup label='Universal templates'>
                ".$otherTpl."
            </optgroup>
        ";
        
        return $listAllTpl;
    }
}