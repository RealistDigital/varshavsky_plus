<br>
<h1 align="center">КАРТА КОНТЕНТА</h1>
<br>
<div id="wp-content">
    <ul>
        <?php
            /** Вложеность в UL / Доб. нов. кат.
             * Вывод дерева 
             * @param Integer $parent_id - id-родителя 
             * @param Integer $level - уровень вложености 
             */
             function outTreeLi($parent_id, $level, $data=false) {
                //Если категория с таким parent_id существует
                if (isset($data[$parent_id])) { 
                    //Обходим
                    foreach ($data[$parent_id] as $value) {  
                        // $level * 25 - отступ, $level - хранит текущий уровень вложености (0,1,2..) 
                        $margin_left = $level * 20;
                        //Стили
                        if ($parent_id == 0) { $bold = 'font-weight:bold;'; }
                        //Настройка прав удаления
                        $del_structure = C_Right::_section_del(4);
                        //Вывод меню
                        echo "
                            <li class='map-info' style='margin: 5px 0 0 ".$margin_left."px; ".$bold."'>".$value["name_".LANG]." 
                                <span style='font-weight:normal;'> |
                                    <a class='map-edit' href='".URL_ADMIN."edit/".$value["id"]."/' title='Edit'></a> 
                                    <a class='map-del' ".$del_structure." href='".URL_ADMIN."delete/".$value["id"]."/".$value['parent']."/map-admin/' title='Delete'></a>
                                <span>
                            </li>"; 
                        //Увеличиваем уровень вложености 
                        $level = $level + 1; 
                        //Рекурсивно вызываем эту же функцию, но с новым $parent_id и $level 
                        outTreeLi($value["id"], $level, $data); 
                        //Уменьшаем уровень вложености 
                        $level = $level - 1; 
                    }
                }
            }
            outTreeLi(0, 0, $data);
        ?>
    </ul>
</div>