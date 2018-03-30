<?
Class Lib_system_general {
    
//-----------------------------------------------------------------------------
// Люди для фильтра
//-----------------------------------------------------------------------------

// Список людей
public static function list_peoples ($type_tpl=false) {
    if($type_tpl === false) return false;
    //-
    $res = DB::query("
        SELECT 
            t2.img,
            t2.img2,        
            t2.id,
            t2.name_".LANG."
        FROM 
            ".TABLE." as t1,
            ".TABLE." as t2
        WHERE 
            t1.type_tpl         = ".$type_tpl." AND
            t2.parent           = t1.id AND
            t2.visible_".LANG." = 'yes'
        ORDER BY t2.position
    ");
    while($row = DB::fetchAssoc($res)){
        $data[] = $row;
    }
    if(empty($data)) return false;
    //-
    return $data;
}


    
}
?>