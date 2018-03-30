<?php
//--------------------------------------------------------------------------------------------------
// Контроллер Управления админки / Рекурсии
//--------------------------------------------------------------------------------------------------

//Модель Управления админки
require_once (SYS_MODELS."m_managment.php");

Class C_Managment extends M_Managment {
    //Запуск..
    public function __construct($stop=false) {
        //Остановка контроллера / если нужно запустить одну функцию.
        if ($stop) return false;
        //URL
        $URL = Lib_url::getUrl();
        //Главный контроллер - Views
        $this->C_view = new C_view ();
        
        switch ($URL[2]) {
            //Редактирование ... 
            case "edit":
                //контроль адресной строки
                if (is_numeric($URL[3]) && !isset($URL[4])) {
                    //Показать выбраный шаблон
                    $res_view = $this->view_selected_tpl_c(trim($URL[3]));
                    //Если тип не выбран у шаблона
                    if(!$res_view) {
                        //Ошибка
                        $this->C_view->view('main/error'); 
                    }
                } else {
                    //Ошибка
                    $this->C_view->view('main/error'); 
                }
            break;
            //Добавление ..
            case 'add':
                if(is_numeric($URL[3]) && is_numeric($URL[4])) {
                    //Переадресация 
                    $relocate = 'edit/'.$URL[3].'/';
                    //Добавление ...
                    $this->add_new_main_section_m (trim($URL[3]), 0, $relocate, trim($URL[4]));
                } else {
                    //Ошибка
                    $this->C_view->view('main/error'); 
                }
            break;
            //Сохранение ..
            case 'save':
                //Сохранение / Обновление разделов
                if (!empty($_POST)) { // && isset($_POST['save']
                    //на обработку
                    $query = $this->query_save_section_c($_POST, trim($URL[3]));
                    //на сохранение
                    $list_inserted_id = $this->save_section_m($query);
                    //Заменая вложеных URL
                    if($list_inserted_id){
                        $this->action_inserted_id_c($list_inserted_id);
						// Рекурсивный пересчет URLs
                        $this->recount_urls_c ($query['info_id']);
                    } 
                    //переадресация
                    $relocate = 'edit/'.trim($URL[3]).'/';
                    //редирект  
                    Lib_url::redirect(URL_ADMIN.$relocate);
                    
                } else {
                    //Ошибка
                    $this->C_view->view('main/error');
                }
            break;
            // Удаление 
            case 'delete':
                if(is_numeric($URL[3]) && is_numeric($URL[4])) {
                    $res_remove = $this->del_section_m(trim($URL[3]));
                    if($res_remove) {
                        //Если из Карты удаляем
                        if(is_string($URL[5])) {
                            //Переадресация 
                            $relocate = trim($URL[5]).'/';
                        //Если из Управления удаляем
                        } else {
                            //Переадресация 
                            $relocate = 'edit/'.trim($URL[4]).'/';
                        }
                        Lib_url::redirect(URL_ADMIN.$relocate);
                    }
                } else {
                    //Ошибка
                    $this->C_view->view('main/error');
                }
            break;
            
            
            
            // Удаление 
            case 'delete_blocked_ip':
                if(is_numeric($URL[3])) {
                    $res_remove = $this->del_blocked_ip(trim($URL[3]));
                    if($res_remove) {
                    	$relocate = 'settings/';
                        Lib_url::redirect(URL_ADMIN.$relocate);
                    } else {
						die('Error during del_blocked_ip()');
					}
                } else {
                    //Ошибка
                    $this->C_view->view('main/error');
                }
            break;
            
            
            
            // Проверка URL 
            case 'check-url':
                //-
                if(is_numeric($_GET['id_field']) && !empty($_GET['url_field'])) {
                     $id    = filter_var($_GET['id_field'], FILTER_VALIDATE_INT);
                     $url   = filter_var($_GET['url_field'], FILTER_SANITIZE_STRING);
                     //-
                     if(!empty($id) && !empty($url)) {
                        if($this->check_url_m($id, $url)) {
                            $response = array('check' => 1);
                        } else {
                            $response = array('check' => 0);
                        }
                     } else {
                        $response = array('check' => 0);
                     }
                } else {
                    $response = array('check' => 0);
                }
                // respone ..
                echo json_encode($response);
                exit;
            
            break;
            // Дополнительно
            case 'additionally':
                if(is_numeric($URL[3])) {
                    $data['url'] = $URL[3];
                    $this->C_view->view('main/additionally', 'main/menu', $data);
                } else {
                    switch ($URL[3]) {
                        // Копирование переводов
                        case 'copy-lang':
                            // save
                            if ($_POST['save'] == 1) {
                                $idForCopy      = filter_var($URL[4], FILTER_VALIDATE_INT);
                                $langFrom       = $_POST['land_from'];
                                $langTo         = $_POST['land_to'];
                                $typeCopy       = $_POST['type_copy'];
                                $emptyField     = $_POST['empty_field'];
                                $showFlag       = $_POST['show_flag'];
                                $fieldsText     = array(
                                                        'visible_'.$langFrom,
                                                        'text_'.$langFrom,
                                                        'short_text_'.$langFrom,
                                                        'name_'.$langFrom
                                                    );
                                // если одинаковые языки
                                if($langFrom == $langTo) {
                                    $data['url']     = $idForCopy;
                                    $data['message'] = "<p style='color:red;text-align:center'>Выберите разные языки!</p><br>";
                                    $this->C_view->view('main/additionally', 'main/menu', $data);
                                } else {
                                    // Все вложеные копировать
                                    if ($typeCopy == 1) {
                                        // все вложеные Ids
                                        $listIds = $this->getLangIds_m($idForCopy).$idForCopy;
                                        // ввесь вложенный контент 
                                        $listContent = $this->getLangContent_m($listIds, $fieldsText);
                                        // копируем ..
                                        $this->copyLangs_m($listContent, $langFrom, $langTo, $emptyField, $fieldsText, $showFlag);
                            
                                    // Только один раздел    
                                    } else {
                                        // контент одного раздела
                                        $listContent = $this->getLangContent_m($idForCopy, $fieldsText);
                                        // копируем ..
                                        $this->copyLangs_m($listContent, $langFrom, $langTo, $emptyField, $fieldsText, $showFlag);
                                    }
                                    
                                    // Узнаем parent
                                    $idRelocate     =  $this->_info_old_url_m($idForCopy);
                                    $urlRelocate    = $idRelocate['parent'] == 0 ? null : 'edit/'.$idRelocate['parent'].'/';
                                    
                                    // redirect
                                    Lib_url::redirect(URL_ADMIN.$urlRelocate);
                                }
                            }
                        break;
                        // Клонирование 
                        case 'clone':
                            if(is_numeric($URL[4])) {
                                if ($_POST['type_copy'] == 0) {
                                    if($this->clone_data_note_c(trim($URL[4]))) {
                                        // Узнаем parent
                                        $idRelocate     =  $this->_info_old_url_m(trim($URL[4]));
                                        //Переадресация 
                                        $relocate = 'edit/'.$idRelocate['parent'].'/';
                                        Lib_url::redirect(URL_ADMIN.$relocate);
                                    }
                                } else {
                                    $cloneID = filter_var($URL[4], FILTER_SANITIZE_NUMBER_INT);
                                    
                                    if(empty($cloneID)) return false;
                                    
                                    // Info parent for clone note
                                    $infoParent = $this->get_info_parent_clone_m($cloneID);
                                    // Cloning...
                                    $this->get_inserted_ids_m($cloneID, $infoParent['parent'], $infoParent['url'], 9999999);
                                    //Переадресация 
                                    $relocate = 'edit/'.$infoParent['parent'].'/';
                                    Lib_url::redirect(URL_ADMIN.$relocate);
                                }
                                //Ошибка
                                $this->C_view->view('main/error');
                            } else {
                                //Ошибка
                                $this->C_view->view('main/error');
                            }
                        break;
                        default:
                            //Ошибка
                            $this->C_view->view('main/error'); 
                        break;
                    }
                }
            break;
        }
        
    }
    
    //Сохранение / Обновление раздела / подготовка инфы / main && general 
    public function query_save_section_c ($post, $url=false, $main=false) {
        if(!$post) return false;
        //обработка ...
        $positon = 10; //изначальная позицыя
        foreach($post as $k => $v) {
            
            //Пропуск доп. параметров
            if($k == "save") continue;
            //Обрезаем FIELD для Save в БД
            $pos_field = strpos($k, '_id_');
            //для инфоблока / html страницы / + безопасность
            if ($pos_field === false) {
                
                // for multiselect, checkbox ... 
                if(is_array($v)) {
                    $v = implode(',',$v);
                }
                
                if($k == 'address') {
                    $info_addr = $v; 
                    continue;
                }
                $info_field .= $k."=".Lib_system::processingDbInfoSave($v).", ";
                continue;
            }
            /**
                * здесь можно написать условие для индивидуальной обработки 
                * С_Additionally - контроллер для дополнений
                * M_Additionally - модель для дополнений
            */
            //FIELD
            $field = substr($k, 0, $pos_field);
            //видимость ..
            if ($field == "visible_".LANG && $v == 'on') {
                $v = "yes";
            }
            //Сортировка
            if($field == "position"){
                $v = $positon;
                $positon += 10; //добавим 10
            }
            
            //Обрезаем ID для Save в БД
            $id = substr($k, $pos_field+4, 11);
            //Массив для save в БД
            $data['list'][$id]['set']   .= $field."=".Lib_system::processingDbInfoSave($v).", ";
        }
    
        //для инфо блока || html странички
        if ($url != false) {
            $data['info']       = $info_field;
            $data['info_id']    = $url;
            $data['info_addr']  = $info_addr;
        }
        return $data;
    }
    
    public function view_selected_tpl_c ($id) {
        //URL
        $URL = Lib_url::getUrl();
        //какой шаблон
        $tpl_info = $this->_tpl_info_m($id);
        //Если есть шаблон
        if ($tpl_info['type_tpl'] != 0) {
            //вид для страницы 
            $edit_tpl = $this->_tpl_info_sys_m($tpl_info['type_tpl']);
            //инфа шаблона по вложенности
            $row_tpl = $this->show_cat_parent_m($tpl_info['type_tpl']);
            //основные данные 
            $data_tpl = $this->info_tpl_m($id);
            //Даные инфо блока или для html страницы
            $data_info_html = $this->_info_block_html_m($id);
            // Описание текущего шаблона
            $data_info_html['decription_tpl'] = $edit_tpl['description'];
            //ID для breadcrumbs
            $id_breadcrumbs = $this->breadcrumbs_m ($id);
            //масив инфа для breadcrumbs
            $arr_breadcrumbs = $this->breadcrumbs_info_m($id_breadcrumbs);
            //Вид ..
            $this->C_view->view($edit_tpl['edit_tpl'], 'main/menu', $data_tpl, $row_tpl, $URL, $data_info_html, 'main/breadcrumbs', $arr_breadcrumbs, $tpl_info['type_tpl'], $tpl_info['url']);
            return true;
        }
        return false;
    }
    //Обрабатываем полученые ID и готовим даные для редактирования вложеных URL
    public function action_inserted_id_c ($id_list, $main=false) {
        $urls_edit      = $this->inderted_url_m($id_list['edit']); //Массив ID по которым редактируем
        
        //Перебираем url текущей страницы / которые заменяем у вложеных URL 
        if($id_list['old_addr'] != "") {
            foreach ($id_list['old_addr'] as $k => $v) {
                $old_url = $this->_info_old_url_m($k); //Находим новый address
                //Обработка / замена url 
                foreach($urls_edit as $k2 => $v2) {
                    //отправка на замену / возврат замененной строки или если нечего заменять то false
                    $new_url = $this->edit_url_c($v2, $v, $old_url['address'], $main);
                    //Сохраняем ..
                    if($new_url != false) {
                        $this->_save_new_url_m($k2, $new_url);
                    }
                }
            }
        }
    }
    //Замена Url 
    public function edit_url_c ($url, $old_addr, $new_addr, $main=false) {
        //Для главных разделов в админке
        if($main){
            $arr_url = explode('/', $url);
            if($old_addr == $arr_url[0]) {
                $count_sub      = strlen($old_addr); //на сколько от начала отрезать URL 
                $sub_url        = substr($url, $count_sub); //режем от начала
                $new_str        = $new_addr.$sub_url; //склеиваем и получаем новый
            }
        //Для всех вложеных страниц ..
        } else {
            //Рег. выражение
            $preg = "#(.+?)/".$old_addr."/#si"; 
            //Замена old на new
            $replace = '$1/'.$new_addr.'/'; 
            //Результат
            $new_str = preg_replace($preg, $replace, $url); 
        }
        //если что то поменялось после замены то вертаем для save
        if($url != $new_str) {
            return $new_str;
        }
        return false;
    }
    
    // Клонирование записи
    public function clone_data_note_c ($id=false) {
        if(!$id) return false;
        // Инфо клонированой записи
        $data_clone_note = $this->_data_clone_m($id);
        // Сохранение новой записи 
        return $this->_save_clone_note($data_clone_note);
    }
	
	// Рекурсивный пересчет URLs
    public function recount_urls_c ($idAncor) {

        if ($idAncor) {
            $mainNoteData = $this->get_main_parent_id_m($idAncor);
            $this->save_recount_urls_m ($mainNoteData['id'], $mainNoteData['url']);
            return true;
        }
        return false;
    }
}

?>