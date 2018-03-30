<br>
<!-- Google API -->
<link href="<?=SYS_PLUGINS?>maps/css/styles.css" rel="stylesheet">
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script src="<?=SYS_PLUGINS?>maps/js/init.js"></script>
<!-- Modal window для Google Map -->
<div id="window-google-map" class="modal-window">
    <div class="modal-block">
        <div id="panel">
            <input id="target-map-google" type="text" placeholder="Введите..." value="">
        </div>
        <div id="map-conteiner"></div>
    </div>
</div>
<br>
<!-- Edit List content -->
<? global $settings; ?>
<div id="admin-content">
    <br>
    <a href="#" class="dop-button buttons"><span></span>Дополнительная информация</a>
    <a href="#" class="seo-button buttons"><span></span>SEO информация</a>
    <br>
    <br>
    <form name="more_info" id="more-info" action="<?=URL_ADMIN?>save/<?=$url[3]?>/" method="POST">
        <label>Заголовок раздела</label>
        <br>
        <input type="text" class="input-style-2" name="name_<?=LANG?>" value="<?=$data_info['name_'.LANG]?>">
        <br>
        <div id="hidden-dop-info">
            <br>
            <h2 class="h2-style-1">Дополнительная информация</h2>
            <br>
            <label>Дополнительный текст</label><br>
            <textarea class="textarea-style-1 mceFullSimple"  name="text_<?=LANG?>"><?=$data_info['text_'.LANG]?></textarea>
        </div>
        <div id="hidden-seo-info">
            <br>
            <h2 class="h2-style-1">Мета информация</h2>
            <br>
            <label>Title</label><br>
            <input type="text" class="input-style-3" name="title_<?=LANG?>" value="<?=$data_info['title_'.LANG]?>">
            <br>
            <label>Meta description</label><br>
            <textarea class="textarea-style-1" name="meta_d_<?=LANG?>"><?=$data_info['meta_d_'.LANG]?></textarea>
            <br>
            <label>Meta keywords</label><br>
            <textarea class="textarea-style-1" name="meta_k_<?=LANG?>"><?=$data_info['meta_k_'.LANG]?></textarea>
        </div>
        
        <br>
        <div class="img-block-html">
            <label>Картинка <strong>маркера на карте</strong></label><br>
            <input class="input-style-3 icon-marker-map" id="img" name="img" value="<?=$data_info['img']?>">
            <a href="javascript:;" onclick="mcImageManager.browse({fields : 'img', relative_urls : true, document_base_url : '/'});" class="add-button buttons"><span></span>Вставить</a><br>
            <img class="img-html" src="<?=$trumb = $data_info['img'] == "" ? SYS_PUBLIC.'img/no_img.jpg' : "/".$data_info['img']; ?>" width="70px" height="70px">
            <a href="javascript:;" class="crop-icon" <? if($data_info['img'] != ""): ?>onclick="mcImageManager.edit({path : '{0}<?=substr($data_info['img'],12,100)?>', onsave : function(res) {document.forms.form.submit(); }});" <? endif; ?>></a>                        
        </div>
         <br>
        <div class="img-block-html">
            <label>Картинка <strong>маркера на карте(в фильтре)</strong></label><br>
            <input class="input-style-3 icon-marker-map" id="img_2" name="img_2" value="<?=$data_info['img_2']?>">
            <a href="javascript:;" onclick="mcImageManager.browse({fields : 'img_2', relative_urls : true, document_base_url : '/'});" class="add-button buttons"><span></span>Вставить</a><br>
            <img class="img-html" src="<?=$trumb = $data_info['img_2'] == "" ? SYS_PUBLIC.'img/no_img.jpg' : "/".$data_info['img_2']; ?>" width="70px" height="70px">
            <a href="javascript:;" class="crop-icon" <? if($data_info['img_2'] != ""): ?>onclick="mcImageManager.edit({path : '{0}<?=substr($data_info['img_2'],12,100)?>', onsave : function(res) {document.forms.form.submit(); }});" <? endif; ?>></a>                        
        </div>
        
        
        <label>К какой группе относится</label><br>
        <select name='add_space' id='add_space' class="select-style-2">
        	<option value='0' <?=($data_info['add_space']==0?"selected='selected'":"")?>>-</option>
        	<option value='1' <?=($data_info['add_space']==1?"selected='selected'":"")?>>Освіта</option>
        	<option value='2' <?=($data_info['add_space']==2?"selected='selected'":"")?>>Здоров'я</option>
        	<option value='3' <?=($data_info['add_space']==3?"selected='selected'":"")?>>Спорт</option>
			<option value='4' <?=($data_info['add_space']==4?"selected='selected'":"")?>>Парки</option>
			<option value='5' <?=($data_info['add_space']==5?"selected='selected'":"")?>>Розваги</option>
			<option value='6' <?=($data_info['add_space']==6?"selected='selected'":"")?>>Ресторани</option>
			<option value='7' <?=($data_info['add_space']==7?"selected='selected'":"")?>>Бізнес центри</option>
			<option value='8' <?=($data_info['add_space']==8?"selected='selected'":"")?>>Транспорт</option>
			<option value='9' <?=($data_info['add_space']==9?"selected='selected'":"")?>>Історико-культурні місця</option>
			<option value='10' <?=($data_info['add_space']==10?"selected='selected'":"")?>>Центри дитячого розвитку</option>
			<!--<option value='8' <?=($data_info['add_space']==8?"selected='selected'":"")?>>Заправки</option>-->
        </select>
        <br><br>
        
        <?/*<!-- Coordinates && Zoom map -->
        <label>Координаты на карте (<strong>X - Y - Zoom</strong>)</label><br>
        <input id="map-coordinates-x" type="text" class="input-style-2" style="width: 150px;" name="map_coordinates_x" value="<?=$data_info['map_coordinates_x']?>">
        <input id="map-coordinates-y" type="text" class="input-style-2" style="width: 150px;" name="map_coordinates_y" value="<?=$data_info['map_coordinates_y']?>">
        <input id="map-coordinates-x-center" type="hidden" name="map_coordinates_x_center" value="<?=$data_info['map_coordinates_x_center']?>">
        <input id="map-coordinates-y-center" type="hidden" name="map_coordinates_y_center" value="<?=$data_info['map_coordinates_y_center']?>">
        <input id="map-zoom" type="hidden" class="input-style-2" style="width: 70px;" name="map_zoom" value="<?=$data_info['map_zoom']?>">
        <a href="javascript:void(0)" class="buttons add-button google-map" style="padding: 7px 20px 7px 12px;"><span></span>Подобрать</a>
        <!-- / Coordinates && Zoom map -->
        <br><br>*/?>
        
        <!-- Описание шаблона -->
        <h2 class="h2-style-1"><?=$data_info['decription_tpl']?></h2>
        <br>
        <div id="wp-content">
            <br>
            <a href="<?=URL_ADMIN?>add/<?=$url[3]?>/0/" class="add-button buttons"><span></span>Добавить новый раздел / в начало</a>
            <!-- Pagination -->
            <span class="pagination-list" data-count-elem="<?=$settings['pagination_ad']?>">
                <span>Cтраницы: </span>
            </span>
            <!-- / Pagination -->
            <div class="clear"></div>
            <br>
            <table id="tb-content">
                <tr class="nodrop nodrag">
                    <td width="5%">Show</td>
                    <td width="8%">Sort</td>
                    <td width="20%">URL адрес</td>
                    <td width="35%">Название</td>
                    <td width="12%">&nbsp;</td>
                    <td width="20%" <?=C_Right::_tpl($right_id);?>>Тип шаблона</td>
                    <td width="4%">&nbsp;</td>
                </tr>
                <tr class="nodrop nodrag">
                    <td class="sep-green-line" colspan="100">
                        <hr>
                    </td>
                </tr>
                <? if($data != ""): ?>
                    <? $i=1; foreach($data as $k => $v): ?>
                        <tr <?=C_Right::_management_dis($v['id'])?> class="page-js">
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
                                <a <?=C_Right::_edit($right_id);?> href="<?=URL_ADMIN?>edit/<?=$v['id']?>/" title="Edit" class="edit-button"></a>
                                <a <?=C_Right::_del($right_id);?> href="<?=URL_ADMIN?>delete/<?=$v['id']?>/<?=$url[3]?>/" title="Delete" class="del-button delete"></a>
                                <a href="<?=URL_ADMIN?>additionally/<?=$v['id']?>/" title="Additionally" class="additionally-button"></a>
                            </td>
                            <td <?=C_Right::_tpl($right_id);?>>
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
                            <td <?=C_Right::_tpl($right_id);?>>
                                <a class="block-tpl" data-tpl="<?=$v['id']?>" title="Blocked" href="javascript:void(0)"></a>
                            </td>
                        </tr>
                    <? $i++; endforeach; ?>
                <? endif; ?>   
            </table>
            <hr>
            <br>
            <a href="<?=URL_ADMIN?>add/<?=$url[3]?>/99999/" class="add-button buttons"><span></span>Добавить новый раздел / в конец</a>
            <br><br>
            
        </div>
        <br>
        <a href="javascript:void(0)" class="save-button buttons"><span></span>Сохранить</a>
        <!-- Для save -->
        <input type="hidden" name="save">
    </form>
    <br><br>
</div>