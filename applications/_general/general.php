<?php
/**
 * --------------------------------------------------------------------------------
 * Общие функции
 * --------------------------------------------------------------------------------
*/
// mobile
require_once($_SERVER['DOCUMENT_ROOT'].'/plugins/mobile_detect_master/Mobile_Detect.php');
$detect = new Mobile_Detect;
$deviceTouch = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : false);

// Информация текущей страницы
if (!empty($data) && is_array($data)) {
    $I = array_map(array(Lib_system, 'processingDbInfoView'), $data);
}

/**
 * Общая выборка / мелочи ...
 * @param - condition (Array ( Key => Value )) or ( String ( id = $id ) )
 * @param - поля (Array)
*/

function getGeneralInfo ($condition=false, $fields=false, $visible = true) {
    // Fields
    $fields     = is_array($fields) ? implode(',', $fields) : ' * ';
    
    // Condition
    if(!is_array($condition)) {
        $condition = ' `id` = '.$condition.'';
    } else {
        foreach ($condition as $k => $v) {
            $conditionAr[] = $k." = '".$v."'";
        }
        $condition = implode(' AND ', $conditionAr);
    }

    if ($visible) {
        $visibleSQl = " AND visible_".LANG." = 'yes'";
    } else {
        $visibleSQl = null;
    }

    //-
    $sql    = "SELECT ".$fields." FROM ".TABLE." WHERE ".$condition . $visibleSQl;
	$res    = DB::query($sql);
    $row    = DB::fetchAssoc($res);
	
    if(empty($row)) return false;
    
    $row    = array_map(array(Lib_system, 'processingDbInfoView'), $row); 
    return $row;
}

/**
 * Общая выборка / мелочи ... - Цикл по PARENT
 * @param - condition (Array ( Key => Value )) or ( String ( parent = parent ) )
 * @param - поля (String)
 * @param - SORT (ASK, DESC)
 * @param - LIMIT
*/
function getGeneralInfoCycle ($condition=false, $fields=false, $limit=false, $visible = true) {
    // Fields
    $fields = is_array($fields) ? implode(',', $fields) : " * ";
    
    // Limit
    if($limit) $limit = "LIMIT 0, ".$limit;
    
    // Condition
    if(!is_array($condition)) {
        $condition = ' `parent` = '.$condition.'';
    } else {
        foreach ($condition as $k => $v) {
            $conditionAr[] = $k." = '".$v."'";
        }
        $condition = implode(' AND ', $conditionAr);
    }

    if ($visible) {
        $visibleSQl = " AND visible_".LANG." = 'yes'";
    } else {
        $visibleSQl = null;
    }
    
    //-
    $sql = "SELECT ".$fields." FROM ".TABLE." WHERE ".$condition.$visibleSQl." ORDER BY `position` ".$limit."";
    $res = DB::query($sql);
    while($row = DB::fetchAssoc($res)){
        $data[] = array_map(array(Lib_system, 'processingDbInfoView'), $row);
    }
    if(empty($data)) return false;
    //-
    return $data;
}

/**
 * Общый вложеный запрос
 * @param - ID
 * @param - вложенность
 * @param - поля Array
 * @param - в цикле или без
 * @param - направление выборки Child, Parent / Default Child
*/
function getGeneralSubqueryInfo ($id, $subInt=2, $fields=false, $cycle=false, $direction='parent') {
    if(!$fields) {
        // default fields
        $fields = array('id', 'parent', 'img','name_'.LANG.'', 'url', 'short_text_'.LANG.'');
    }
    // формируем вложеный запрос
    for ($i=1; $i <= $subInt; $i++) {
        /** fields */
        if($i == $subInt) {
            foreach($fields as $field) {
                $fieldsQuery .= "t".$i.".".$field.","; 
            }
            $fieldsQuery = substr($fieldsQuery, 0, -1);
        }
        /** tables */
        $tablesQuery .= " ".TABLE." as t".$i.","; 
        
        /** where */
        if ($i == 1) {
            // direction
            if($direction == "parent") {
                $whereQuery .= "t".$i.".id = ".$id."";
            } else {
                $whereQuery .= "t".$i.".parent = ".$id."";
            }
        } else {
            // direction
            if($direction == "parent") {
                if($i == $subInt) {
                    // cycle
                    if($cycle) {
                        $whereQuery .= " AND t".$i.".parent = t".($i-1).".parent ";
                    // one 
                    } else {
                        $whereQuery .= " AND t".$i.".id = t".($i-1).".parent ";
                    }
                } else {
                    $whereQuery .= " AND t".$i.".id = t".($i-1).".parent ";
                }
            } else {
                $whereQuery .= " AND t".$i.".parent = t".($i-1).".id ";
            }
        }
        if($i == $subInt) {
            $whereQuery .= " AND t".$i.".visible_".LANG." = 'yes' ORDER BY t".$i.".position";
        }
    }
    $tablesQuery = substr($tablesQuery, 0, -1);
    //-
    $sqlQuery = "SELECT ".$fieldsQuery." FROM ".$tablesQuery." WHERE ".$whereQuery; 
    //echo $sqlQuery;
    $res = DB::query($sqlQuery);
    //-
    if($cycle) {
        while($row = DB::fetchAssoc($res)){
            $data[] = array_map(array(Lib_system, 'processingDbInfoView'), $row);
        }
    } else {
        $data = DB::fetchAssoc($res);
        if(is_array($data)){
	        $data = array_map(array(Lib_system, 'processingDbInfoView'), $data);		
		}else{
			echo ('Включите родителя в админке');die();
		}
    }
    if(empty($data)) return false;
    //-
    return $data;
}



/**
 * Общый вложеный запрос
 * @param - ID
 * @param - видимость
 * @param - лимит
 * @param - с какой позиции
*/

function getGeneralChildOne($id, $visible = 'yes',  $limit = 1, $from = 0){
	$query_one = "SELECT * 
			FROM 
				_main
			WHERE 
				parent = ".$id."
				AND visible_".LANG."= '$visible' 
				ORDER BY position 
				LIMIT $from,".$limit."";
	$res_one = DB::fetchAssoc(DB::query($query_one));
	return $res_one;
}
/**
 * --------------------------------------------------------------------------------
 * Users functions
 * --------------------------------------------------------------------------------
*/


?>