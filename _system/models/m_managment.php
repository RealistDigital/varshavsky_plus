<?php

//---------------------------------------------------------------------------------------------
// Модель Управления админкой 
//---------------------------------------------------------------------------------------------

Class M_Managment {
    protected $_counterGetIds   = 0;
    protected $_memoryCloneId   = null;
    
    public function __construct($stop=false) {
        //Остановка контроллера / если нужно запустить одну функцию.
        if($stop) return false;
    }
    //Добавление нового раздела / main && general
    public function add_new_main_section_m ($parent, $type_tpl, $relocate=false, $position=99999) {

        $sql = DB::exec("INSERT INTO ".TABLE." (`parent`, name_".LANG.", `type_tpl`, `position`) VALUES (".$parent.", 'New', ".$type_tpl.", ".$position.")");
        $last_id = DB::lastInsertId();

        $setTpl = null;
        
        //Если главная / то URL = Last ID
        if($parent == 0) {
            $url = $last_id.'/';
        //Для все остальных страниц
        } else {
            //Формируем вложеный URL
            $url_sel = $this->_info_block_html_m($parent);
            $url = $url_sel['url'].$last_id.'/';
            
            // Узнаем шаблон для установки
            $sqlTpl = DB::query("
                SELECT 
                    t1.type_tpl,
                    t2.id
                FROM 
                    ".TABLE."       as t1,
                    ".TABLE_TPL."   as t2
                WHERE 
                    t1.id = ".$parent." AND
                    t2.parent_id = t1.type_tpl
                    
            ");
            while($resTpl = DB::fetchAssoc($sqlTpl)) {
                $dataTpl[] = $resTpl;
            }
            // set template
            if(!empty($dataTpl)) {
                if(count($dataTpl) < 2) {
                    $setTpl = ", `type_tpl` = ".$dataTpl[0]['id']."";
                }
            }
        }
        
        //обновляем URL
        $update_url = DB::exec("UPDATE ".TABLE." SET `address`='".$last_id."', `url`='".$url."' ".$setTpl." WHERE `id` = ".$last_id."");
        //редирект 
        Lib_url::redirect(URL_ADMIN.$relocate);
    }
    
    //Сохранение / Обновление раздела / подготовка инфы / main && general 
    public function save_section_m ($data) {
        
        //если не пустой..
        if(!empty($data['list'])) {
            foreach ($data['list'] as $k => $v) {
                //Собираем все старые address текущей страницы
                $sql_old_addr = DB::query("SELECT `address` FROM ".TABLE." WHERE `id` = ".$k."");
                $row_old_addr = DB::fetchAssoc($sql_old_addr);
                if($k != 1) {
                    $old_addr[$k] = $row_old_addr['address'];
                }
                
                //запрос 
                $set = substr($v['set'],0,-2); //обрезаем последнюю кому
                //Обнуляем все visible
                DB::exec("UPDATE ".TABLE." SET visible_".LANG." = 'no' WHERE `id` = ".$k."");
                // Сохраняем / обновляем разделы
                $update_sec = DB::exec("UPDATE ".TABLE." SET ".$set." WHERE `id` = ".$k."");
                
                //Если Index
                if($k != 1) {
                    //Собираем все ID сохраняемой страницы ..
                    $urls_id   .= $k.",";  
                    //Рекурсивно вытаскиваем все вложеные ID
                    $urls_id_2 .= $this->inderted_id_urls_m($k);
                }
            }

            $all_urls_id    = $urls_id.$urls_id_2; // соеденяем текущий список ID и ID всех вложеных
            $succes_id['edit']      = substr($all_urls_id, 0, -1);    // режем последнюю кому у текущих ID
            $succes_id['old_addr']  = $old_addr;
            
            //return в конце функ.
        }
        //для html страницы
        if(!empty($data['info']) && !empty($data['info_id']) && !empty($data['info_addr'])) {
            //Узнаем URL 
            $old_url        = DB::query("SELECT `url`, `address` FROM ".TABLE." WHERE `id` = ".$data['info_id']."");
            $row_old_url    = DB::fetchAssoc($old_url);
            //Формируем новый URL 
            $leng_old_url   = strlen($row_old_url['address']);  //Длина addr
            $sub_old_url    = substr($row_old_url['url'], 0, -($leng_old_url+1));  //Обрезаем на столько же old url  +1 - это потому что есть в конце "/" - 106/      
            $new_url        = $sub_old_url.$data['info_addr']."/";  //до обрезаного + новый addr

            $set_info = substr($data['info'],0,-2); //обрезаем последнюю кому
            //сохраняем ..
            DB::exec("UPDATE ".TABLE." SET ".$set_info.", url='".$new_url."', address='".$data['info_addr']."'  WHERE `id` = ".$data['info_id']."");
        
        //для инфо блока
        } elseif(!empty($data['info']) && !empty($data['info_id']) && empty($data['info_addr'])) {
            $set_info = substr($data['info'],0,-2); //обрезаем последнюю кому
            //сохраняем ..
            DB::exec("UPDATE ".TABLE." SET ".$set_info."  WHERE `id` = ".$data['info_id']."");
        }
        return  !empty($succes_id) ? $succes_id : false; // список всех вложеных и текущих ID через ","
    }
    
    //Url - список вложеных ID  / рекурсия
    public function inderted_id_urls_m ($id) {
        $res = DB::query("SELECT `id` FROM ".TABLE." WHERE parent = ".$id."");
        while($row = DB::fetchAssoc($res)) {
            $data .= $row['id'].",";
            $data .= $this->inderted_id_urls_m($row['id']);
        }
        return $data;
    }
    //Узнаем по ID URL или address / для его смены
    public function _info_old_url_m ($id) {
        $sql_old_url = DB::query("SELECT `url`, `address`, `parent` FROM ".TABLE." WHERE `id` = ".$id."");
        $row_old_url = DB::fetchAssoc($sql_old_url);
        return $row_old_url;
    }
    //Сохраняем новый URL 
    public function _save_new_url_m ($id, $url) {
        //Сохраняем новый URL
        DB::exec("UPDATE ".TABLE." SET url = '".$url."' WHERE `id`=".$id."");
    }
    //Меняем всем вложенностям URL
    public function inderted_url_m ($id) {
        if(!$id) return false;
        $res = DB::query("SELECT `id`, `url` FROM ".TABLE." WHERE id IN (".$id.")");
        while($row = DB::fetchAssoc($res)) {
            $data_url[$row['id']]   = $row['url'];
        }
        return $data_url;
    }
    
    //Удаление раздела
    public function del_section_m ($id) {
        $data = $this->inderted_id_urls_m($id);
        
        $all_inserted_id = $data.$id;

        $sql = DB::exec("DELETE FROM ".TABLE." WHERE id IN (".$all_inserted_id.")");
        return $sql;
    }
    
    
    
    //Удаление блокированного IP
    public function del_blocked_ip ($id) {
        $sql = DB::exec("DELETE FROM ".TABLE_BLOCKED_IP." WHERE id='".$id."' LIMIT 1");
        return $sql;
    }
    
    
    //Узнаем какой шаблон у записи
    public function _tpl_info_m ($id) {
        $sql_info_tpl = DB::query("SELECT `type_tpl`, `url` FROM ".TABLE." WHERE `id` = ".$id."");
        $row_info_tpl = DB::fetchAssoc($sql_info_tpl);
        return $row_info_tpl;
    }
    
    //Узнаем какой шаблон
    public function _tpl_info_sys_m ($id) {
        $sql_info_tpl = DB::query("SELECT * FROM ".TABLE_TPL." WHERE `id` = ".$id."");
        $row_info_tpl = DB::fetchAssoc($sql_info_tpl);
        return $row_info_tpl;
    }
    
    //Инфа для шаблона
    public function info_tpl_m ($parent) {
        $sql = DB::query("SELECT * FROM ".TABLE." WHERE `parent` = ".$parent." ORDER BY `position`");
        while($row = DB::fetchAssoc($sql)){
            $data[] = $row;
        }
        return $data;
    }
    
    //Инфа для шаблона Info block / Html 
    public function _info_block_html_m ($id) {
        $sql_info_tpl = DB::query("SELECT * FROM ".TABLE." WHERE `id` = ".$id."");
        $row_info_tpl = DB::fetchAssoc($sql_info_tpl);
        return $row_info_tpl;
    }
    
    //Список категорий по Parent
    public function show_cat_parent_m($parent) {
        $res = DB::query("SELECT * FROM ".TABLE_TPL." WHERE `parent_id` = ".$parent."");
        while($row = DB::fetchAssoc($res)) {
            $data[] = $row;
        }
        return $data;
    }
    //breadcrumbs ID навигация / рекурсия
    public function breadcrumbs_m ($id) { 
        $sql = DB::query("
            SELECT 
                t1.id,
                t1.parent,
                t2.id as id2 
            FROM 
                ".TABLE." as t1,
                ".TABLE." as t2
            WHERE 
                t1.id = ".$id." AND
                t2.id = t1.parent
        ");
        if(DB::numRows($sql) < 1) {
            $data .= $id.",";
        }
        while ($row = DB::fetchAssoc($sql)) {
        
            $data .= $row['id'].",";
            $data .= $this->breadcrumbs_m($row['parent']);
        }
        return $data;
    }
    //breadcrumbs массив инфо
    public function breadcrumbs_info_m ($id) {
        if($id == "") return false;
        $id_sub = substr($id, 0, -1); //обрезаем кому в конце
        $res = DB::query("SELECT `id`, name_".LANG." FROM ".TABLE." WHERE id IN (".$id_sub.")");
        while($row = DB::fetchAssoc($res)) {
            $data[]   = $row;
        }
        return $data;
    }
    
    // Клонирование - Инфа для клонирования записи
    public function _data_clone_m ($id=false) {
        if(!$id) return false;
        //-
        $sql = DB::query("SELECT * FROM ".TABLE." WHERE `id` = ".$id."");
        $row_data_clone = DB::fetchAssoc($sql);
        return $row_data_clone;
    }
    // Клонирование - сохранение новой записи
    public function _save_clone_note ($data=false) {
        if(!$data) return false;
        // составляем SQL 
        $sql_insert_fields  = null;
        $sql_insert_values  = null;

        //-
        foreach($data as $k => $v) {
            // settings
            if($k == 'id') continue;
            if($k == 'visible_ru' || $k == 'visible_en' || $k == 'visible_ua')  $v = "no";
            if($k == 'position')    $v = 99999999;
            if($k == 'address')     continue;
            if($k == 'url')         continue;
            //-
            if(!empty($v)) {
                $sql_insert_fields .= $k.','; 
                $sql_insert_values .= Lib_system::processingDbInfoSave($v).',';
            }
        }
        
        $sql_insert_fields = substr($sql_insert_fields, 0, -1); 
        $sql_insert_values = substr($sql_insert_values, 0, -1); 
        //-
        $sql_insert = "INSERT INTO ".TABLE." (".$sql_insert_fields.") VALUES (".$sql_insert_values.")";
        $res_copy   = DB::exec($sql_insert);
        
        $lastId = DB::lastInsertId();
        $new_url = substr($data['url'], 0, -strlen($data['address'])-1).$lastId.'/'; 
        
        DB::exec("UPDATE ".TABLE." SET `url`='".$new_url."', `address`='".$lastId."' WHERE `id`=".$lastId."");
        
        return true;
    }
    
    // проверка URL 
    public function check_url_m ($id, $url) {
        if(!$id || !$url) return false;
        //--
        $res = DB::query("
            SELECT 
                t1.id 
            FROM 
                ".TABLE." as t1,
                ".TABLE." as t2
            WHERE 
                t1.id = ".$id." AND
                t2.address = '".$url."' AND
                t2.parent = t1.parent AND 
                t2.id != ".$id."
        ");
        $row = DB::fetchAssoc($res);
        
        if(empty($row)) return true;
            
        return false;
    }
    
    /** 
     * Копирование переводов
    */
    
    // Все тексты по ID и LANG + все вложеные
    public function getLangContent_m ($ids = false, $fields = false) {
        if(!$ids || !$fields) { return false; }

        $fields = implode(',', $fields);
        
        $res = DB::query("SELECT id, ".$fields." FROM ".TABLE." WHERE id IN (".$ids.")");
        while($row = DB::fetchAssoc($res)) {
            $data[]   = $row;
        }
        return $data;
    }
    
    // Получить вес вложеные Ids 
    public function getLangIds_m ($id) {
        $sql =  DB::query("SELECT id FROM ".TABLE." WHERE parent = ".$id."");
        while ($row = DB::fetchAssoc($sql)) {
            $data .= $row['id'].",";
            $data .= $this->getLangIds_m($row['id']);
        }
        return $data;
    }
    
    // Копируем из LANG в LANG
    public function copyLangs_m ($data, $langFrom, $langTo, $flagEmpty, $fieldsForCheckEmpty, $showFlag) {
        if (!empty($data)) {
            foreach ($data as $langs) {
                $idUpdate;
                $fieldsUpdate   = null;
                $checkEmptyData = null;
                
                foreach ($langs as $k => $v) {
                    if ($k == 'id') {
                        $idUpdate = $v;
                        // если проверка на пустоту
                        if ($flagEmpty != 1) {
                            $fieldsForCheckEmpty    = implode(',',$fieldsForCheckEmpty);
                            $fieldsForCheckEmpty    = str_replace("_".$langFrom, "_".$langTo, $fieldsForCheckEmpty);
                            $fieldsForCheckEmpty    = explode(',', $fieldsForCheckEmpty);
                        
                            $checkEmptyData = $this->_checkLangEmpty_m($idUpdate, $fieldsForCheckEmpty);
                        }
                        continue;
                    } 
                    
                    // Копируем Show
                    if($k == 'visible_'.$langFrom) {
                        if($showFlag == 1) {
                            $fieldsUpdate .= "visible_".$langTo."='".$v."',";
                        }
                        continue;
                    }
                    
                    // только не пустые
                    if ($v != "") {
                        $newFieldWithToLang = substr($k, 0, -2).$langTo;
                        // если проверка на пустоту
                        if ($flagEmpty != 1) {
                            if ( empty($checkEmptyData[$newFieldWithToLang]) ) {
                                $fieldsUpdate .= $newFieldWithToLang."='".$v."',";
                            } 
                        } else {
                            $fieldsUpdate .= $newFieldWithToLang."='".$v."',";
                        }
                    }
                }
                $fieldsUpdate = substr($fieldsUpdate, 0, -1);
                $this->_updateLangs_m($idUpdate, $fieldsUpdate);
            }
            return true;
        }
        return false;
    }
    // Обновляем переводы
    private function _updateLangs_m ($id=false, $fields=false) {
        if(!$id || !$fields) { return false; }
        // обновление ..
        //echo "<br>UPDATE ".TABLE." SET ".$fields." WHERE `id`=".$id."";
        DB::exec("UPDATE ".TABLE." SET ".$fields." WHERE `id`=".$id."");
    } 
    // 
    private function _checkLangEmpty_m ($id, $fields) {
        $fieldsString = implode(',',$fields); 
        
        $sql =  DB::query("SELECT ".$fieldsString." FROM ".TABLE." WHERE `id` = ".$id."");
        return DB::fetchAssoc($sql);
    } 
    
    // Получаем ID parent и его URL 
    public function get_info_parent_clone_m ($id) {
        $res = DB::query("
            SELECT 
                t1.parent,
                t2.url 
            FROM 
                ".TABLE." as t1,
                ".TABLE." as t2
            WHERE 
                t1.id = ".$id." AND 
                t2.id = t1.parent
        ");
        $row = DB::fetchAssoc($res);
        return $row;
    }   
    
    // Копируем все вложеные ID в массив
    public function get_inserted_ids_m ($id, $parent = 0, $url, $pos = false) {
        
        // 1. Выбыраем рядок за переданыйм $id 
        $res = DB::query("SELECT * FROM ".TABLE." WHERE `id` = ".$id."");
        $row = DB::fetchAssoc($res);
    
        // 1.2 Собираем инфу для клонирования
        foreach($row as $k => $v){
            if($v == "" || $k == 'id' || $k == 'parent' || $k == 'visible_'.LANG) continue;
            
            if($k == 'position' && $pos) {
                $insertFields .= $k."='".$pos."',";
                continue;
            } 
            $insertFields .= $k."='".$v."',";
            
        }
        $insertFields .= "parent = '".$parent."'";
       
        // 2. Запиываем его в БД c parent = $parent 
        DB::exec("INSERT INTO ".TABLE." SET ".$insertFields."");
        
        // 3. Получаем LastInsertID
        $lastId = DB::lastInsertId();
        
        // 3.1 Формируем URL 
        $url .= $lastId."/";
        
        // 3.2 Update URL
        DB::exec("UPDATE ".TABLE." SET `address` = '".$lastId."', `url` = '".$url."' WHERE `id`=".$lastId."");
        
        // 4. Получение детей по $id
        $res = DB::query("SELECT * FROM ".TABLE." WHERE parent = ".$id."");
        
        while($row = DB::fetchAssoc($res)) {
            // 5. Для каждого детя запускаешь get_inserted_ids_m ( clild[ID] , LastInsertID )
            $this->get_inserted_ids_m ($row['id'], $lastId, $url);
        }
    }
	
	public function get_main_parent_id_m ($id) {
        $res    = DB::query("SELECT id, parent, address, url FROM " . TABLE . " WHERE id = " . $id);
        $data   = DB::fetchAssoc($res);
        return $data;
    }

    public function save_recount_urls_m ($id, $url) {
        if ($id && !empty($url)) {
            $res    = DB::query("SELECT id, parent, address FROM " .TABLE. " WHERE parent = " . $id);
            while($row = DB::fetchAssoc($res)){
                $newUrl  = $url . $row['address'] . '/';
                //echo '<br>ID: ' . $row['id'] . ' - ' . $newUrl;
                $resSave = DB::query("UPDATE ".TABLE." SET url = '".$newUrl."' WHERE id = " . $row['id']);
                $this->save_recount_urls_m ($row['id'], $newUrl);
            }
        }
    }
}
?>