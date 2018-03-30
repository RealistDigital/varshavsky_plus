<?php
//-----------------------------------------------------------------------------
// Модель пользователей админки
//-----------------------------------------------------------------------------
Class M_Users {
    //Все users / view
    public function all_users_m () {
        $res = DB::query("SELECT * FROM ".TABLE_USERS."");
        while($row = DB::fetchAssoc($res)){
            $data[] = $row;
        }
        return $data;
    }
    //Один user инфо
    public function one_user_m ($id) {
        $res = DB::query("SELECT * FROM ".TABLE_USERS." WHERE id = ".$id."");
        $row = DB::fetchAssoc($res);
        return $row;
    }
    //Add new user
    public function _add_new_user_m (){
        $res = DB::exec("INSERT INTO ".TABLE_USERS." (`name`, `login`, `pass`, `access`)  VALUES ('New User', 'user_".rand(1, 9999)."', '".Lib::_encoding_pass(rand(1111, 9999))."', 'no')");
        return $res; 
    }
    //save one user info
    public function save_user_m ($set, $id) {
        $res = DB::exec("UPDATE ".TABLE_USERS." SET ".$set." WHERE `id`=".$id."");
        return $res;
    }
    //save all users list info
    public function save_list_users_m ($set) {
        foreach($set as $k => $v) {
            $set_sub = substr($v, 0, -2); //отрезаем кому в конце
            //Обнуляем все access
            DB::exec("UPDATE ".TABLE_USERS." SET access = 'no' WHERE `id` = ".$k."");
            //save
            DB::exec("UPDATE ".TABLE_USERS." SET ".$set_sub." WHERE `id` = ".$k."");
        }
        return true;
    }
    //delete user
    public function _del_user_m ($id) {
        return DB::exec("DELETE FROM ".TABLE_USERS." WHERE id = ".$id."");
    }
    
    //save права юзера
    public function save_right_user_m ($set, $id) {
        //Обнуляем все access
        DB::exec("UPDATE ".TABLE_USERS." SET
            right_edit = '0', 
            right_delete = '0',
            right_template = '0', 
            right_sect_dis = '0', 
            right_sect_del = '0',
            right_sect_edit = '0',
            right_manag_dis = '0'  
        WHERE `id` = ".$id.""); 
        //save
        DB::exec("UPDATE ".TABLE_USERS." SET
            right_edit      = '".$set['edit']."', 
            right_delete    = '".$set['delete']."',
            right_template   = '".$set['template']."',
            right_sect_dis  = '".$set['sectdis']."',
            right_sect_del  = '".$set['sectdel']."',
            right_sect_edit = '".$set['sectedit']."',
            right_manag_dis = '".$set['managementdis']."'
        WHERE `id` = ".$id."");    
        return true;
    }
    
    //Список главных меню
    public function list_main_menu_m () {
        $res = DB::query("SELECT id, name_".LANG." FROM ".TABLE." WHERE parent = 0 ORDER BY `position`");
        while($row = DB::fetchAssoc($res)){
            $data[] = $row;
        }
        return $data;
    }
    
}

?>