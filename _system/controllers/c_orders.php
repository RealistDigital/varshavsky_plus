<?php
//-----------------------------------------------------------------------------
// Контроллер заказов
//-----------------------------------------------------------------------------

//Модель настроек
require_once(SYS_MODELS.'m_orders.php');
 
Class C_Orders extends M_Orders {
    
    public function __construct($status = true) {
        // Obj view
        $this->View = new C_View ();
        
        // Если мы на главной Orders
        if(!$status) return false;
        
        // URL 
        $URL = Lib_url::getUrl();
    
        // Удаление / Редактироване
        switch ($URL['3']) {
            case 'del':
                if(is_numeric($URL['4'])){
                    // Удаление 
                    $res_del = $this->del_order_m(trim($URL['4']));
                    // Если удача то Редирект
                    if($res_del) {
                        Lib_url::redirect(URL_ADMIN.'orders/');
                    } else {
                        //Ошибка
                        $this->View->view('main/error');
                    }
                } else {
                    //Ошибка
                    $this->View->view('main/error');
                }
            break;
            case 'edit':
                if(is_numeric($URL['4'])){
                    // Инфа о заказе
                    $info_one_order = $this->info_one_order_m(trim($URL['4']));
                    if(!$info_one_order) {
                        //Ошибка
                        $this->View->view('main/error');
                    }
                    // Вид 
                    $this->View->view('edit_order', 'main/menu', $info_one_order);
                    
                    
                } else {
                    //Ошибка
                    $this->View->view('main/error');
                }
            break;
            // Изменение статуса заказа
            case 'change-status':
                //Изменение статуса
                if (isset($_POST['change_status']) && isset($_POST['new_status']) && isset($_POST['order'])) {
                    $res = $this->change_order_m($_POST['new_status'], $_POST['order']);
                    // Редиркт
                    if ($res) {
                        Lib_url::redirect(URL_ADMIN."orders/edit/".$_POST['order']);
                    }
                } else {
                    //Ошибка
                    $this->View->view('main/error');
                }
            break;
            
            default :
                //Ошибка
                $this->View->view('main/error');
            break;
        }
    }
    
    // Показать все заказы
    public function view_all_orders_c () {
        // Все заказы
        $data = $this->all_orders_m();
        // Вид
        $this->View->view("orders", "main/menu", $data); 
    }



}
?>