<br>
<h1 align="center">Редактируем - <?=$data['name']?></h1>
<br>
<div id="wp-content">
    <br>
    <table width="100%">
        <tr>
            <td>
                <form method="POST" action="<?=URL_ADMIN?>save-user/<?=$url[3]?>/">
                    <label>Имя</label><br>
                    <input class="input-style-3" type="text" name="name" size="50" value="<?=$data['name']?>"><br><br>
                    
                    <label>Login</label><br>
                    <input class="input-style-3" type="text" name="login" size="50" value="<?=$data['login']?>"><br><br>
                    <label>Password</label><br>
                    
                    <input class="input-style-3" name="pass" value="<?=Lib::_decoding_pass($data['pass'])?>"><br><br>
                    <input type="submit" name="save" class="save-button buttons" value="Сохранить">
                </form>
            </td>
            <td>
                <div id="right-user">
                    <form method="POST" action="<?=URL_ADMIN?>user-right/<?=$url[3]?>/">
                        <span class="text-right-user">Права пользователя: <span class="sep-right">/</span>1.<input type="checkbox"><span class="sep-right">/</span> - видимость; &nbsp;<span class="sep-right">/</span>2.<input type="checkbox"><span class="sep-right">/</span> - редактирование; &nbsp;<span class="sep-right">/</span>3.<input type="checkbox"><span class="sep-right">/</span> - удаление;</span>
                        <br><br><br>
                        <div class="top-menu-right">
                            <a href="javascript:void(0)" class="menu-tabs active-tab" data-tab="1">Главные разделы</a>
                            <a href="javascript:void(0)" class="menu-tabs" data-tab="2">Меню упр. контентом</a>
                            <a href="javascript:void(0)" class="menu-tabs" data-tab="3">Категории упр. контентом</a>
                        </div>
                        <div class="content-stuct-right">
                            <div id="tab-1" class="tabs-content">
                                <!-- Section right -->
                                <div class="wp-gen-right">
                                    <label>Структура админки <span class="sep-right">/</span> 1.</label>
                                    <input name="sectdis_1" <?=$section_check = strpos($data['right_sect_dis'], '/1/') === false ? '' : "checked='checked'"; ?> type="checkbox"><span class="sep-right">/</span>3.
                                    <input name="sectdel_1" <?=$section_check = strpos($data['right_sect_del'], '/1/') === false ? '' : "checked='checked'"; ?> type="checkbox"> <span class="sep-right">/</span><br>
                                </div>
                                <div class="wp-gen-right">
                                    <label>Управление контентом <span class="sep-right">/</span>1.</label>
                                    <input name="sectdis_2" <?=$section_check = strpos($data['right_sect_dis'], '/2/') === false ? '' : "checked='checked'"; ?> type="checkbox"> <span class="sep-right">/</span>2.
                                    <input name="sectdel_2" <?=$section_check = strpos($data['right_sect_del'], '/2/') === false ? '' : "checked='checked'"; ?> type="checkbox"> <span class="sep-right">/</span>3.
                                    <input name="sectedit_2" <?=$section_check = strpos($data['right_sect_edit'], '/2/') === false ? '' : "checked='checked'"; ?> type="checkbox"> <span class="sep-right">/</span><br>
                                </div>
                                <div class="wp-gen-right">
                                    <label>Настройки сайта <span class="sep-right">/</span>1.</label>
                                    <input name="sectdis_3" <?=$section_check = strpos($data['right_sect_dis'], '/3/') === false ? '' : "checked='checked'"; ?> type="checkbox"> <span class="sep-right">/</span><br>
                                </div>
                                <div class="wp-gen-right">
                                    <label>Карта контента</label><span class="sep-right">/</span>1.
                                    <input name="sectdis_4" <?=$section_check = strpos($data['right_sect_dis'], '/4/') === false ? '' : "checked='checked'"; ?> type="checkbox"><span class="sep-right">/</span>3.
                                    <input name="sectdel_4" <?=$section_check = strpos($data['right_sect_del'], '/4/') === false ? '' : "checked='checked'"; ?> type="checkbox"> <span class="sep-right">/</span><br>
                                </div>
                                <div class="wp-gen-right">
                                    <label>Пользователи админки <span class="sep-right">/</span>1.</label>
                                    <input name="sectdis_5" <?=$section_check = strpos($data['right_sect_dis'], '/5/') === false ? '' : "checked='checked'"; ?> type="checkbox"><span class="sep-right">/</span>3.
                                    <input name="sectdel_5" <?=$section_check = strpos($data['right_sect_del'], '/5/') === false ? '' : "checked='checked'"; ?> type="checkbox"> <span class="sep-right">/</span><br> 
                                </div>
                                <div class="wp-gen-right">
                                    <label>Переводы <span class="sep-right">/</span>1.</label>
                                    <input name="sectdis_6" <?=$section_check = strpos($data['right_sect_dis'], '/6/') === false ? '' : "checked='checked'"; ?> type="checkbox"> <span class="sep-right">/</span><br> 
                                </div> 
                                <br>
                            </div>
                            <div id="tab-2" class="tabs-content">
                                <ul>
                                    <? if($right_id != ""): ?>
                                        <? foreach($right_id as $k => $v): ?>
                                            <li>
                                                <?=$v['name_'.LANG]?> - <span class="sep-right">/</span>1.<input name='managementdis_<?=$v['id']?>' type='checkbox' <?=$section_check = strpos($data['right_manag_dis'], '/'.$v['id'].'/') === false ? '' : "checked='checked'"; ?>><span class="sep-right">/</span>
                                            </li>
                                        <? endforeach; ?>
                                    <? endif; ?>
                                </ul>
                                <br>
                            </div>
                            <div id="tab-3" class="tabs-content">
                                <ul>
                                    <?php
                                        /** Вложеность в UL / Доб. нов. кат.
                                         * Вывод дерева 
                                         * @param Integer $parent_id - id-родителя 
                                         * @param Integer $level - уровень вложености 
                                         */
                                         function outTreeLi($parent_id, $level, $data=false, $data_check=false) {
                                            //Если категория с таким parent_id существует
                                            if (isset($data[$parent_id])) { 
                                                //Обходим
                                                foreach ($data[$parent_id] as $value) {  
                                                    // $level * 25 - отступ, $level - хранит текущий уровень вложености (0,1,2..) 
                                                    $margin_left = $level * 20;
                                                    //Стили
                                                    //if ($parent_id == 0) { $bold = 'font-weight:bold;'; }
                                                    
                                                    //Вывод меню
                                                    $edit_chek = strpos($data_check['right_edit'], "/".$value['id']."/") === false ? "" : "checked='checked'";
                                                    $delete_chek = strpos($data_check['right_delete'], "/".$value['id']."/") === false ? "" : "checked='checked'";
                                                    $template_chek = strpos($data_check['right_template'], "/".$value['id']."/") === false ? "" : "checked='checked'";
                                                    
                                                    echo "
                                                        <li style='margin: 0 0 6px ".$margin_left."px; ".$bold."'>
                                                            ".$value["name"]." (
                                                            <input name='edit_".$value['id']."' ".$edit_chek." type='checkbox'>
                                                            <input name='template_".$value['id']."' ".$template_chek." type='checkbox'>
                                                            <input name='delete_".$value['id']."' ".$delete_chek." type='checkbox'> )
                                                        </li>
                                                        
                                                        "; 
                                                    //Увеличиваем уровень вложености 
                                                    $level = $level + 1; 
                                                    //Рекурсивно вызываем эту же функцию, но с новым $parent_id и $level 
                                                    outTreeLi($value["id"], $level, $data, $data_check); 
                                                    //Уменьшаем уровень вложености 
                                                    $level = $level - 1; 
                                                }
                                            }
                                        }
                                        outTreeLi(0, 0, $data_info, $data);
                                    ?>
                                    <br>
                            </div>
                            
                            <a href="javascript:void(0)" class="save-button buttons"><span></span>Сохранить права</a>
                            <!-- Для save -->
                            <input type="hidden" name="save"> <br><br>
                        </div>
                    </form>
                </div>
            </td>
        </tr>
    
    </table>
</div>