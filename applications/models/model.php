<?php
//-----------------------------------------------------------------------------
// Главная Модель сайта
//-----------------------------------------------------------------------------
Class Model {
    //Узнаем инфу для текущего url
    public function current_url_info_m ($url) {
        $url = DB::quote($url);
        $sql = DB::query("SELECT * FROM ".TABLE." WHERE `url` = ".$url);
        $res_info = DB::fetchAssoc($sql);
        return $res_info;
    }
    //Узнаем инфу для главной страницы
    public function current_id_info_m ($id=1) {
        $sql = DB::query("SELECT * FROM ".TABLE." WHERE `id` = '".$id."'");
        $res_info = DB::fetchAssoc($sql);
        return $res_info;
    }
    //Узнаем шаблон который загружать на стр.
    public function current_view_m ($tpl) {
        $sql = DB::query("SELECT `view_tpl` FROM ".TABLE_TPL." WHERE `id` = '".$tpl."'");
        $res_info = DB::fetchAssoc($sql);
        return $res_info['view_tpl'];
    }
    //Настройки сайта
    public function settings_info_m () {
        $sql = DB::query("SELECT * FROM ".TABLE_SETT."");
        return DB::fetchAssoc($sql);
    }
    //Переводы 
    public function langs_info_m () {
        $sql = DB::query("SELECT id, name_".LANG." FROM ".TABLE_TRANS."");
        while ($row = DB::fetchAssoc($sql)) {
            $data[$row['id']] = $row['name_'.LANG]; 
        }
        return $data;
    }
    // view child
    public function view_child_m ($url) {
        $url = DB::quote($url);
        $sql = "
            SELECT 
                t1.id,
                t2.url
            FROM
                ".TABLE." as t1,
                ".TABLE." as t2
            WHERE
                t1.url      = ".$url." AND
                t2.parent   = t1.id AND
                t2.visible_".LANG." = 'yes'
            ORDER BY 
                t2.position 
        ";
        $res = DB::query($sql);
        $row = DB::fetchAssoc($res);
        
        return $row['url'];
    }
    
    // view second child
    public function view_second_child_m ($url) {
        $url = DB::quote($url);
        $sql = "
            SELECT 
                t1.id,
                t2.url
            FROM
                ".TABLE." as t1,
                ".TABLE." as t2
            WHERE
                t1.url      = ".$url." AND
                t2.parent   = t1.id
            ORDER BY 
                t2.position 
        ";
        $res = DB::query($sql);
        $row = DB::fetchAssoc($res);
        
        while ($row = DB::fetchAssoc($sql)) {
            $data[] = $row; 
        }
        // else not second child
        if(empty($data[1]['url'])) {
            return $data[0]['url'];
        }
        return $data[1]['url'];
    }
    
    // view parent
    public function view_parent_m ($url) {
        $url = DB::quote($url);
        $sql = "
            SELECT 
                t1.id,
                t2.url
            FROM
                ".TABLE." as t1,
                ".TABLE." as t2
            WHERE
                t1.url  = ".$url." AND
                t2.id   = t1.parent
            ORDER BY 
                t2.position 
        ";
        $res = DB::query($sql);
        $row = DB::fetchAssoc($res);
        
        return $row['url'];
    }
}

?>