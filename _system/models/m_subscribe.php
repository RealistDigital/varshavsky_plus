<?php
//-----------------------------------------------------------------------------
// Модель подписки
//-----------------------------------------------------------------------------
Class M_Subscribe {
    
    // список подписчиков
    public function listSubscribe_m ($flag=null) {
        
        if(!is_null($flag)) $flag = "WHERE flag = '".$flag."'";
        
        $sql = DB::query("SELECT * FROM ".TABLE_SUBS." ".$flag." ORDER BY `id` DESC");
        while($row = DB::fetchAssoc($sql)) {
            $data[] = $row;
        }
        return $data;
    }
    
    // удаление подписчика
    public function delSubs_m ($id) {
        // Удаление подписчика
        $res = DB::exec("DELETE FROM ".TABLE_SUBS." WHERE `id` = ".$id."");
        return true;
    }
    
    
}

?>