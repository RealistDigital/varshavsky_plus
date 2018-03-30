<?php
//-------------------------------------------------------------------------------------------------
// Настройки квартир
//-------------------------------------------------------------------------------------------------

// Статусы квартир
$status_apartaments = array(
    'ru' => array(
        1   => "В продаже",
        2   => "Бронь",
        3   => "Продано"
    ),
    'en' => array(
        1   => "В продаже",
        2   => "Booking",
        3   => "Sold out"
    ),
    'ua' => array(
        1   => "В продаже",
        2   => "Бронь",
        3   => "Продано"
    )
);

// Количество комнат
$count_bedrooms = array (
    1 => "1 Спальня",
    2 => "2 Спальни",
    3 => "3 Спальни",
    4 => "4 Спальни"
);

// Количество этажей
$numbers_floors = array (
    1 => "1 Этаж",
    2 => "2 Этаж",
    3 => "3 Этаж",
    4 => "4 Этаж",
    5 => "5 Этаж"
);

// Номера домов
$numbers_houses = array(1, 2, 3, 4);

// Ссылка на 3d планировку / IFRAME
function _link_3d_plan_iframe ($id_plan, $lang=2, $view='2d', $site_url='/', $logo_url='') {
    // языки roomtodo
    $roomtodo_lang['ru'] = 2;
    $roomtodo_lang['en'] = 1;
    $roomtodo_lang['ua'] = 3;
    // ссылка для 3D планировки 
    $roomtodo_link = "http://roomtodo.com/roomtodo/plans/plan.php?lang=".$roomtodo_lang[$lang]."&plan=".$id_plan."&view=".$view."&labelLink=".$site_url."&labelUrl=".$logo_url."";
    
    //-
    return $roomtodo_link;
}

// Ссылка на 3d планировку / roomtodo.com
function _link_3d_plan ($id_plan, $lang) {
    // языки roomtodo
    $roomtodo_lang['ru'] = 2;
    $roomtodo_lang['en'] = 1;
    $roomtodo_lang['ua'] = 3;
    // ссылка для 3D планировки 
    $roomtodo_link = "http://dev.roomtodo.com/roomtodo/plans/plan.php?plan=".trim($id_plan)."&lang=".$roomtodo_lang[$lang]."&view=3d";
    //-
    return $roomtodo_link;
}
?>