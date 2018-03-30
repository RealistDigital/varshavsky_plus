<?php
//-----------------------------------------------------------------------------
// Модель карты админки
//-----------------------------------------------------------------------------
Class M_Map_admin {
    public function __construct() {
        //URL
        $URL = Lib_url::getUrl();
    }
    //Все записи для Карты админки
    public function all_info_for_map_m () {
        $res = DB::query("SELECT * FROM ".TABLE."");
        
        while($row = DB::fetchAssoc($res)) {
            $data[$row['parent']][] = $row;
        }
        return $data;
    }
}

?>