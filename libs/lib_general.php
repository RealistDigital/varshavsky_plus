<?php

//-----------------------------------------------------------------------------
// Общая библиотека функций
//-----------------------------------------------------------------------------
Class Lib {

//-----------------------------------------------------------------------------
// Переобразование даты / Формат - 15 Февраля 2013
//-----------------------------------------------------------------------------

public static function convect_date ($date_org) {
    //Разбиваем дату у массив
    $date = explode(".", $date_org);
    
    $convect['ru'] =
        array(
            "01"=>"Января",
            "02"=>"Февраля",
            "03"=>"Марта",
            "04"=>"Апреля",
            "05"=>"Мая",
            "06"=>"Июня",
            "07"=>"Июля",
            "08"=>"Августа",
            "09"=>"Сентября",
            "10"=>"Октября",
            "11"=>"Ноября",
            "12"=>"Декабря"
        );
    $convect['ua'] =
        array(
            "01"=>"січня",
            "02"=>"лютого",
            "03"=>"березня",
            "04"=>"квітня",
            "05"=>"травня",
            "06"=>"червня",
            "07"=>"липня",
            "08"=>"серпня",
            "09"=>"вересня",
            "10"=>"жовтня",
            "11"=>"листопада",
            "12"=>"грудня"
        );
    $convect['en'] =
        array(
            "01" => "January",
            "02" => "February",
            "03" => "March",
            "04" => "April",
            "05" => "May",
            "06" => "June",
            "07" => "July",
            "08" => "August",
            "09" => "September",
            "10" => "October",
            "11" => "November",
            "12" => "December"
        );
    $new_date =  $date[0]." ".$convect[LANG][$date[1]]." ".$date[2];   
    return $new_date;             
}

//-------------------------------------------------------------------------------
// Переобразование даты / Формат - 15 Фев. 2013
//-------------------------------------------------------------------------------

public static function convect_date_short ($date_org) {
    //Разбиваем дату у массив
    $date = explode("-", $date_org);
    
    $convect['ru'] =
        array(
            "01"=>"янв",
            "02"=>"фев",
            "03"=>"мар",
            "04"=>"апр",
            "05"=>"мая",
            "06"=>"июн",
            "07"=>"июл",
            "08"=>"авг",
            "09"=>"сен",
            "10"=>"окт",
            "11"=>"ноя",
            "12"=>"дек"
        );
    $convect['en'] =
        array(
            "01" => "Jan",
            "02" => "Feb",
            "03" => "Mar",
            "04" => "Apr",
            "05" => "May",
            "06" => "Jun",
            "07" => "Jul",
            "08" => "Aug",
            "09" => "Sep",
            "10" => "Oct",
            "11" => "Nov",
            "12" => "Dec"
        );
    $new_date['day']    =  $date[2]; 
    $new_date['mouth']  =  $convect[LANG][$date[1]];  
    
    return $new_date;            
}

//-------------------------------------------------------------------------------
// Переобразование даты / Формат - Массив число/месяц/год
//-------------------------------------------------------------------------------

public static function convect_date_numbers ($date_org) {
    //Разбиваем дату у массив
    $date = explode(".", $date_org);
    
    $convect['ru'] =
        array(
            "01"=>"янв",
            "02"=>"фев",
            "03"=>"мар",
            "04"=>"апр",
            "05"=>"мая",
            "06"=>"июн",
            "07"=>"июл",
            "08"=>"авг",
            "09"=>"сен",
            "10"=>"окт",
            "11"=>"ноя",
            "12"=>"дек"
        );
    $convect['en'] =
        array(
            "01" => "Jan",
            "02" => "Feb",
            "03" => "Mar",
            "04" => "Apr",
            "05" => "May",
            "06" => "Jun",
            "07" => "Jul",
            "08" => "Aug",
            "09" => "Sep",
            "10" => "Oct",
            "11" => "Nov",
            "12" => "Dec"
        );
    $new_date = array($date[0], $date[1], $date[2]);
    return $new_date;             
}
//-----------------------------------------------------------------------------
// Фильтр вводимых данных
//-----------------------------------------------------------------------------
public static function form_filter($input) {
    //злосные символы
    $text = preg_replace('%&\s*\{[^}]*(\}\s*;?|$)%', '', $input);
    //xss атаки
    $text = preg_replace('/[<>]/', '', $text);
    
    return $text;
}

//-----------------------------------------------------------------------------
// Фильтр сохраняемых данных
//-----------------------------------------------------------------------------
public static function save_data_filter($string) {
    $denyWords = array('script', 'update', 'insert', 'alert', '.php', '.js', '{', '}', '({', '})', 
                        'jquery', '$(', 'function', 'delete', 'drop', 'union', 'database', '$', 'javascript',
                        '<style>', '</style>', '<style', 'style>', '.css', '_main', '_a_users', '_a_sys_tpl',
                        '_translation', '_settings', '<?', '<?php', '?>', ');', 'document.write');
            
    $string    = str_ireplace($denyWords, '', $string);
    
    return $string;
}

//-----------------------------------------------------------------------------
// Шифрование / Разшифрование /  паролей / ключей
//-----------------------------------------------------------------------------

//Шифруем
public static function _encoding_pass($pass){
    $pass1 = strrev($pass.KEY_CRYPT);
    $pass2 = base64_encode($pass1);
    return $pass2;
}
//Разшифровуем
public static function _decoding_pass($pass){
    $pass1      = base64_decode($pass);
    $pass2      = strrev($pass1);
    $len_key    = strlen(KEY_CRYPT);
    $end_pass   = substr($pass2, 0, -$len_key);
    return $end_pass;
}

//-----------------------------------------------------------------------------
// Шифрование / Разшифрование /  Cookies / Авторизация и т.д.
//-----------------------------------------------------------------------------

//Шифруем / Входящие даные List масив "без ключей"
public static function _encoding_cookie ($cookie=false) {
    if(!$cookie) return false;
    //Доб. до каждого эл. ключ
    foreach($cookie as $cookie_v){
        $cookies_str .= $cookie_v.KEY_COOKIES;
    }
    //кодируем
    $cookies_enc    = base64_encode($cookies_str);
    $cookies_enc2   = strrev($cookies_enc); 
    return $cookies_enc2;
}
//Разшифровуем
public static function _decoding_cookie ($cookie=false) {
    if(!$cookie) return false;
    $cookie_rev     = strrev($cookie); 
    $cookie_64      = base64_decode($cookie_rev); 
    $key_len        = strlen(KEY_COOKIES);
    $sub_str_cookie = substr($cookie_64, 0, -$key_len);
    $data_cookie    = explode(KEY_COOKIES, $sub_str_cookie);
    return $data_cookie;
}

//-----------------------------------------------------------------------------
// Online редактор
//-----------------------------------------------------------------------------

function online_editor ($id, $field) {
    //Проверка статуса редактора
    //if(!$_SESSION['online_editor']) return 'false';
    //дальше не продолжать ...
    if(!$id || !$field) return false;
    //Необходимые параметры
    $style = 'contenteditable="true" data-id="'.$id.'" data-field="'.$field.'"';
    //
    return $style;
}

//-----------------------------------------------------------------------------
// Breadcrumbs
//-----------------------------------------------------------------------------

// breadcrumbs массив инфо
public static function breadcrumbs ($id) {
    if($id == "") return false;
    // массив ID
    $id_arr = Lib::breadcrumbs_info ($id);
    // инфа
    $id_sub = substr($id_arr, 0, -1); //обрезаем кому в конце
    $res = DB::query("SELECT `id`, name_".LANG.", `url` FROM ".TABLE." WHERE id IN (".$id_sub.")");
    while($row = DB::fetchAssoc($res)) {
        $data[]   = $row;
    }
    return $data;
}

// breadcrumbs ID навигация / рекурсия array id
protected static function breadcrumbs_info ($id) { 
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
        $data .= Lib::breadcrumbs_info($row['parent']);
    }
    return $data;
}

//-----------------------------------------------------------------------------
// Pagination / $current_class - текущая ссылка
//-----------------------------------------------------------------------------
/**
 * @id              - ID
 * @current-class   - класс текущей страницы
 * @add-fields      - доп. поля для выборки (формат: , date, test)
*/
public static function pagination ($id=false, $current_class="", $add_fields="") {
    //-
    if(!$id) return false;
    //-
	global $settings, $langs;
	// Переменная хранит число сообщений выводимых на станице  
	$num = $settings['pages'];  
	// Извлекаем из URL текущую страницу  
	$page = $_GET['page'];  
	// Определяем общее число сообщений в базе данных  
	$result = mysql_query("SELECT COUNT(*) FROM ".TABLE." WHERE `parent` = ".$id." AND visible_".LANG." = 'yes'");  
	$posts = mysql_result($result, 0);  
	// Находим общее число страниц  
	$total = intval(($posts - 1) / $num) + 1;  
	// Определяем начало сообщений для текущей страницы  
	$page = intval($page);  
	// Если значение $page меньше единицы или отрицательно  
	// переходим на первую страницу  
	// А если слишком большое, то переходим на последнюю  
	if(empty($page) or $page < 0) $page = 1;  
	  if($page > $total) $page = $total;  
	// Вычисляем начиная к какого номера  
	// следует выводить сообщения  
	$start = $page * $num - $num;  
	
	/** Content */
	
	// Выбираем $num сообщений начиная с номера $start  
    $res = DB::query("SELECT `id`, name_".LANG.", `img`, short_text_".LANG.", `url`, `date` ".$add_fields." FROM ".TABLE." WHERE `parent` = ".$id." AND visible_".LANG." = 'yes' ORDER BY position LIMIT $start, $num");
    while($row = DB::fetchAssoc($res)){
        $data['data'][] = $row;
    }
	
	/** Pagination */
	
	// Проверяем нужны ли стрелки назад  
	if ($page != 1) $pervpage = '<a href=?page='.($page - 1).'>&laquo; Предыдущая</a>';  
        // <a href=?page=1>Первая</a> 
	// Проверяем нужны ли стрелки вперед  
	if ($page != $total) $nextpage = '<a href=?page='.($page + 1).'>Следующая &raquo;</a>';  
        // <a href=?page='.$total.'>Полседня</a>';  
        
	// Находим две ближайшие станицы с обоих краев, если они есть  
	if($page - 2 > 0) $page2left = ' <a href= ?page='. ($page - 2) .$sort_url.'>'. ($page - 2) .'</a>';  
	if($page - 1 > 0) $page1left = '<a href= ?page='. ($page - 1) .$sort_url.'>'. ($page - 1) .'</a>';  
	if($page + 2 <= $total) $page2right = '<a href= ?page='. ($page + 2) .$sort_url.'>'. ($page + 2) .'</a>';  
	if($page + 1 <= $total) $page1right = '<a href= ?page='. ($page + 1) .$sort_url.'>'. ($page + 1) .'</a>'; 

	// Вывод меню  
	if($posts > $num){
		$data['pagination'] = $pervpage.$page2left.$page1left.'<a class="'.$current_class.'">'.$page.'</a>'.$page1right.$page2right.$nextpage; 
	}
	//--
	return $data; 
}

//-----------------------------------------------------------------------------
// Site MAP
//-----------------------------------------------------------------------------

/**
 * @parent-id   - корневая ID = 0
 * @margin-left - отступ (margin-left) - при каждой вложенности
 * @not-id      - эти id не учитывать в карту сайта (формат: 12, 21, 45)
 * @not-tpl     - шаблоны не учитывать в карту сайта (формат: 12, 21, 45)
 * @calss-a     - class для ссылки 
 * @class-li    - class для li 
 * @main-class  - class для главных разделов
 * @other-class     - [class] - name class
 *                  - [tpl]   - type_tpl - которым установить other class  
*/
public static function site_map ($parent_id=0, $margin_left=10, $not_id=false, $not_tpl=false, $class_a=false, $class_li=false, $main_class=false, $other_class=false) { 
    // not TPL
    if($not_tpl) {
        $not_tpl = "AND type_tpl NOT IN (".$not_tpl.")"; 
    }
    //-
    $res = DB::query("SELECT `id`, `type_tpl`, `parent`, `url`, name_".LANG." FROM ".TABLE." WHERE id NOT IN (".$not_id.") ".$not_tpl." AND visible_".LANG." = 'yes' ORDER BY `position`");
    //-    
    while($row = DB::fetchAssoc($res)) {
        $data[$row['parent']][] = $row;
    }
    // вызываем уже построеную карту
    return Lib::map_info($parent_id, 0, $margin_left, $data, $class_a, $class_li, $main_class, $other_class);
}

// строим дерево карты сайта
protected static function map_info ($parent_id=0, $level=0, $margin=false, $data=false, $class_a, $class_li, $main_class=false, $other_class=false) {
    //Если категория с таким parent_id существует
    if (isset($data[$parent_id])) { 
        //Обходим
        foreach ($data[$parent_id] as $value) {  
            // $level * $margin - отступ, $level - хранит текущий уровень вложености (0,1,2..) 
            $margin_left = $level * $margin;
            // определяем главные разделы
            if ($value['parent'] != 0) $main_class = "";
            $otherClass = null;
            if (is_array($other_class) && array_search($value['type_tpl'], $other_class['tpl']) !== false) {
                $otherClass = $other_class['class'];
            } 
            //Вывод меню
            if($value["name_".LANG] != "#" && $value["name_".LANG] != "#"){
                echo "
                    <li class='".$class_li." ".$otherClass."' style='margin-left:".$margin_left."px;'> 
                        <a class='".$class_a." ".$main_class."' href='/".LANG."/".$value["url"]."'>".$value["name_".LANG]."</a>  
                    </li>
                "; 
            }
            //Увеличиваем уровень вложености 
            $level = $level + 1; 
            //Рекурсивно вызываем эту же функцию, но с новым $parent_id и $level 
            Lib::map_info($value["id"], $level, $margin, $data, $class_a, $class_li, $main_class, $other_class); 
            //Уменьшаем уровень вложености 
            $level = $level - 1; 
        }
    }
}

//-----------------------------------------------------------------------------
// Поиск по сайту
//-----------------------------------------------------------------------------

/**
 * @param - search request
 * @param - Array Ids
 * @param - Array Tpl
*/
public static function search ($search=false, $not_tpl=false, $not_ids=false) { 
    // обработка запроса
    $search = trim(filter_var($search, FILTER_SANITIZE_STRING));
    if(empty($search)) return false;
    
    // empty
    if(!$not_ids) { $not_ids = array(); }
    if(!$not_tpl) { $not_tpl = array(); }
    
    // sql
    $sql = "
        SELECT 
            `id`, 
            name_".LANG.", 
            text_".LANG.", 
            short_text_".LANG.", 
            `url`,
            `type_tpl` 
        FROM 
            ".TABLE." 
        WHERE 
            ( 
                text_".LANG." LIKE '%".$search."%' OR 
                short_text_".LANG." LIKE '%".$search."%' OR
                name_".LANG." LIKE '%".$search."%'
            ) 
            AND (visible_".LANG." = 'yes')
    ";
    $res = DB::query($sql);
    while($row = DB::fetchAssoc($res)){
        // filter
        if(array_search($row['id'], $not_ids) === false && array_search($row['type_tpl'], $not_tpl) === false) {
            $data[] = $row;
        }
    }
    if(empty($data)) return false;
    //-
    return $data;
}

//-----------------------------------------------------------------------------
// Образать сторку по конечному слову
//-----------------------------------------------------------------------------
/**
 * @string - строка 
 * @limit  - количество символов
*/
public static function crop_str($string=false, $limit) {
    if(!$string) return false;
    //режем строку от 0 до limit
    $substring_limited = substr($string,0, $limit);        
    //берем часть обрезанной строки от 0 до последнего пробела
    return substr($substring_limited, 0, strrpos($substring_limited, ' ' ));    
}

//-----------------------------------------------------------------------------
// Проверка ссылки YOUTUBE
//-----------------------------------------------------------------------------

/**
 * @url - ссылка, пример http://www.youtube.com/watch?v=-jPBqNw1uJA¶m1=asd
 * @return - код видео
*/
public static function checkYoutubeLink ($url) {
    if (stripos($url, 'youtube.com') !== false) {
        preg_match('#v=([^\&]+)#is', $url, $videoId);
        if (count ($videoId) > 0) {
            //у нас есть id video, ссылка правильная
            // $videoId[1] - ID видео
            return $videoId[1];
        }
    }
    return false;
}

//-----------------------------------------------------------------------------
// Проверка Ipad Iphone Android
//-----------------------------------------------------------------------------

public static function checkFlahsDevice () {
    // checking ...
    if(strstr($_SERVER['HTTP_USER_AGENT'],'iPad') || 
        strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || 
        strstr($_SERVER['HTTP_USER_AGENT'], 'Android')) 
    {
        return false;
    }
    return true;
}

//-----------------------------------------------------------------------------
// Проверка AJAX запроса
//-----------------------------------------------------------------------------

public static function checkAJAX () {
    // checking ...
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
        !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
    {
        // да Это действительно AJAX  :)    
        return true;    
    }
    // :(
    return false;
}

//-----------------------------------------------------------------------------
// Переобразование 10,99 на 10.99
//-----------------------------------------------------------------------------

/**
 * @param - stirng 
*/
public static function getFloatInt ($string) {
    //-
    return str_replace(",",'.', $string); 
}  

//-----------------------------------------------------------------------------
// Картинка плана для Админки
//-----------------------------------------------------------------------------

public static function plan_img ($parent) {
    //-
	$res = DB::query("SELECT `id`, `img` FROM ".TABLE." WHERE `id` = ".$parent."");
    $row = DB::fetchAssoc($res);
    return $row;
}
public static function plan_img_2 ($parent) {
    //-
    $sql = "SELECT 
                section.id,
                ochered.img,
                ochered.img_2 
            FROM 
                ".TABLE." as section,
                ".TABLE." as ochered,
                ".TABLE." as dom
            WHERE
                section.id = ".$parent." 
                AND dom.id = section.parent
                AND ochered.id = dom.parent";
          
	$res = DB::query($sql);
    $row = DB::fetchAssoc($res);
    return $row;
}

public static function getDataByTpl ($tpl) {
    $res = DB::query("SELECT * FROM ".TABLE." WHERE `type_tpl` = ".$tpl."");
    $row = DB::fetchAssoc($res);
    return $row;
}

public static function getTypesAparts () {
    $query = "SELECT * FROM _main WHERE parent='18' AND visible_".LANG."='yes' ORDER BY position";
    $res = DB::query($query);
    $data = DB::fetchAll($res);
    return $data;
}

}

?>