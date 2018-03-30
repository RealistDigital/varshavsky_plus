<?php
//-----------------------------------------------------------------------------
// Модель заказов
//-----------------------------------------------------------------------------
Class M_Orders {
    // Все заказы / view
    public function all_orders_m () {
        $sort = trim($_GET['sort']);
        if($sort != "") {
            switch($sort){
    			case "0":
    				$sql_sort = "WHERE `status` = 0";
    			break;
    			case "1":
    				$sql_sort = "WHERE `status` = 1";
    			break;
    			case "2":
    				$sql_sort = "WHERE `status` = 2";
    			break;
    			default:
    				$sql_sort = "";
    			break;
    		}
            $get_sort = '&sort='.$sort;
        }
        // Настройки сайта
        global $settings; 
        // Переменная хранит число сообщений выводимых на станице 
        $num = $settings['count_orders']; 
        // Извлекаем из URL текущую страницу 
        $page = $_GET['page']; 
        // Определяем общее число сообщений в базе данных 
        $result = mysql_query("SELECT COUNT(*) FROM ".TABLE_CUST." ".$sql_sort.""); 
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
        
        // Выбираем $num сообщений начиная с номера $start 
        $res = DB::query("SELECT * FROM ".TABLE_CUST." ".$sql_sort." ORDER BY `order` DESC LIMIT $start, $num");
        while($row = DB::fetchAssoc($res)) {
            $data['all_orders'][] = $row;
        }
        
        // Проверяем нужны ли стрелки назад 
        if ($page != 1) $pervpage = '<a href=?page=1>&laquo;</a>'; 
        // Проверяем нужны ли стрелки вперед 
        if ($page != $total) $nextpage = '<a href=?page=' .$total. '>&raquo;</a>'; 
        
        // Находим две ближайшие станицы с обоих краев, если они есть 
        if($page - 2 > 0) $page2left = ' <a href=?page='. ($page - 2) .$get_sort.'>'. ($page - 2) .'</a> | '; 
        if($page - 1 > 0) $page1left = '<a href=?page='. ($page - 1) .$get_sort.'>'. ($page - 1) .'</a> | '; 
        if($page + 2 <= $total) $page2right = ' | <a href=?page='. ($page + 2) .$get_sort.'>'. ($page + 2) .'</a>'; 
        if($page + 1 <= $total) $page1right = ' | <a href=?page='. ($page + 1) .$get_sort.'>'. ($page + 1) .'</a>';
        
        // Вывод постраничку
        if($posts > $num) {
            $data['pagination'] = $pervpage.$page2left.$page1left.'<strong>'.$page.'</strong>'.$page1right.$page2right.$nextpage;
        }
        return $data;
    }
    
    // Удаление заказа
    public function del_order_m ($order) {
        // Удаление Клиента
        $res_cust = DB::exec("DELETE FROM ".TABLE_CUST." WHERE `order` = ".$order."");
        // Удаление Заказа
        $res_order = DB::exec("DELETE FROM ".TABLE_ORDERS." WHERE `order` = ".$order."");
        
        // Результат удаления
        if ($res_cust && $res_order) {
            return true;
        } else {
            return false;
        }
    }
    
    // Инфа одного заказа
    public function info_one_order_m ($order) {
        // Клиент 
        $res_cust = DB::query("SELECT * FROM ".TABLE_CUST." WHERE `order` = ".$order."");
        $row_cust = DB::fetchAssoc($res_cust);
        
        // Заказы
        $res_order = DB::query("
            SELECT 
                t1.id_good,
                t1.order,
                t1.name,
                t1.count,
                t1.price,
                t2.url 
            FROM 
                ".TABLE_ORDERS." as t1,
                ".TABLE." as t2
            WHERE 
                t1.order = ".$order." AND
                t2.id = t1.id_good
        ");
        while($row_order = DB::fetchAssoc($res_order)) {
            // Все заказы клента
            $data['orders'][] = $row_order;
        }
    
        // Клиент 
        $data['cust'] = $row_cust;
        return $data;
    }
    
    // Изменение статуса заказа
    public function change_order_m ($status, $order) {
        $sql = "UPDATE ".TABLE_CUST." SET `status` = '".$status."' WHERE `order` = ".$order."";
        $res = DB::exec($sql);
        return $res;
    }
    
}

?>