<?php
//-----------------------------------------------------------------------------
// Модель настроек
//-----------------------------------------------------------------------------
Class M_Settings {
    //Все настройки / view
    public function all_settings_m () {
        $res = DB::query("SELECT * FROM ".TABLE_SETT." WHERE `id`=1");
        return DB::fetchAssoc($res);
    }
    //save settings
    public function save_settings_m ($set) {
        $res = DB::exec("UPDATE ".TABLE_SETT." SET ".$set." WHERE `id`=1");
        return $res;
    }
}

?>