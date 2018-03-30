<?php
//-----------------------------------------------------------------------------
// Модель перевода эл. сайта
//-----------------------------------------------------------------------------
Class M_Translation {
    
    //Инфо 
    public function _view_translation_m () {
        $res = DB::query("SELECT * FROM ".TABLE_TRANS."");
        while($row = DB::fetchAssoc($res)){
            $data[] = $row;
        }
        return $data;
    }
    //add new
    public function _add_new_trans_m() {
        $res = DB::exec("INSERT INTO ".TABLE_TRANS." (`name_ru`, `name_en`, `name_ua`)  VALUES ('new ru', 'new en', 'new ua')");
        return $res; 
    }
    //del element
    public function _del_trans_el_m ($id) {
        //delete user
        return DB::exec("DELETE FROM ".TABLE_TRANS." WHERE id = ".$id."");
    }
    //save 
    public function _save_list_trans_m($set) {
        foreach($set as $k => $v) {
            $set_sub = substr($v, 0, -2); //отрезаем кому в конце
            //save
            DB::exec("UPDATE ".TABLE_TRANS." SET ".$set_sub." WHERE `id` = ".$k."");
        }
        return true;
    }
}

?>