<!-- Admin content -->
<div id="admin-content">
    <br>
    <a href="<?=URL_ADMIN?>add-new-main-section/99999/" class="add-button buttons"><span></span>Добавить новый раздел</a>
    <br><br>
    <div id="wp-content" style="width: 930px !important;">
        <form action="<?=URL_ADMIN?>save-main-section/" method="POST">
            <table id="tb-content">
                <tr class="nodrop nodrag">
                    <td width="5%">Show</td>
                    <td width="8%">Sort</td>
                    <td width="20%">URL адрес</td>
                    <td width="35%">Название</td>
                    <td width="8%">&nbsp;</td>
                    <td width="20%" <?=C_Right::_section_dis(2)?>>Тип шаблона</td>
                    <td width="4%">&nbsp;</td>
                </tr>
                <tr class="nodrop nodrag">
                    <td class="sep-green-line" colspan="100">
                        <hr>
                    </td>
                </tr>
                <? if($data != ""): ?>
                    <? $i=1; foreach($data as $k => $v): ?>
                        <tr <?=C_Right::_management_dis($v['id'])?>>
                            <td>
                                <input class="chec-style-1" type="checkbox" name="visible_<?=LANG?>_id_<?=$v['id']?>" <? if($v['visible_'.LANG] == "yes") { echo "checked='checked'"; } ?>>
                            </td>
                            <td class="drag" title="Drag for Sort">
                                <span class="drag-icon"></span>
                                <input type="hidden" name="position_id_<?=$v['id']?>" value="<?=$v['position']?>">
                                <span class="position"><?=$i*10?></span>
                            </td>
                            <td>
                                <input type="text" class="input-style-1 check-url" data-check="<?=$v['id']?>" name="address_id_<?=$v['id']?>" value="<?=$v['address'] = $v['id'] == 1 ? "/" : $v['address'];?>" <? if($v['id'] == 1){ echo 'disabled="disabled"'; } ?>>
                            </td>
                            <td>
                                <input type="text" class="input-style-1" name="name_<?=LANG?>_id_<?=$v['id']?>" value="<?=$v['name_'.LANG]?>">
                            </td>
                            <td>
                                <a href="<?=URL_ADMIN?>edit/<?=$v['id']?>/" title="Edit" class="edit-button"></a>
                                <a <?=C_Right::_section_del(2)?> href="<?=URL_ADMIN?>del-main-section/<?=$v['id']?>/" title="Delete" class="del-button delete"></a>
                            </td>
                            <td <?=C_Right::_section_dis(2)?>>
                                <div class="select-style-1">
                                    <div class="bg-select-disable-<?=$v['id']?> select-disable"></div>
                                    <select name="type_tpl_id_<?=$v['id']?>">
                                        <option> - - - отсутствует - - - </option>
                                        <? if($tpl_data != ""): ?>
                                            <? foreach($tpl_data as $kk => $vv): ?>
                                                <option value="<?=$vv['id']?>" <? if ($v['type_tpl'] == $vv['id']) echo "selected"; ?>><?=$vv['name']?></option>
                                            <? endforeach; ?>
                                        <? endif; ?>
                                    </select>
                                </div>
                            </td>
                            <td <?=C_Right::_section_dis(2)?>>
                                <a class="block-tpl" data-tpl="<?=$v['id']?>" title="Blocked" href="javascript:void(0)"></a>
                            </td>
                        </tr>
                    <? $i++; endforeach; ?>
                <? endif; ?>
            </table>
            <hr>
            <br>
            <a href="javascript:void(0)" class="save-button buttons"><span></span>Сохранить</a>
            <!-- Для save -->
            <input type="hidden" name="save">
            <br><br>
        </form>
    </div>
</div>