<? //$plan_info = Lib::plan_img($data_info['parent'])?>
<? global $status_apartaments, $count_bedrooms, $numbers_floors; ?>
<!-- Images Manager -->
<script type="text/javascript" src="<?=SYS_PLUGINS?>tiny_mce/plugins/imagemanager/js/mcimagemanager.js"></script>
<!-- File Manager -->
<script type="text/javascript" src="<?=SYS_PLUGINS?>tiny_mce/plugins/filemanager/js/mcfilemanager.js"></script>

<script type="text/javascript">
    $(function () {
        initDraw ({
            canvasId        : 'canvas',
            controlPanelId  : 'control-panel-1',
            inputPathId     : 'planing-info-raphael-1',
            pathSvgFormat   : '<?=$data_info['path_svg']?>',
            img             : '<?=SYS_PUBLIC?>/img/no_img.jpg',
            popupId         : 'popup-drawing-1',
            runButtonId     : 'run-drawing-popup-1',
            closeButtonId   : 'close-drawing-popup-1'
        });
    });
</script>

<!-- Modal window для картинки с планировкой -->
<div class="modal-window wp-draw-popup" id='popup-drawing-1'>
    <div class="wp-modal-draw">
        <div class="wp-canvas-draw">
            <canvas id="canvas"></canvas>
            <a id="close-drawing-popup-1" class="cloce-modal-window" href="javascript:void(0)">Х</a>
        </div>

        <br><br>
        <div id="control-panel-1" class="wp-control-panel-draw">
            <a href="javascript:void(0)" class="buttons draw">Рисуем</a>
            <a href="javascript:void(0)" class="buttons edit">Редактируем</a>
            <a href="javascript:void(0)" class="buttons delete-last">Удалить поcледнюю точку</a>
            <a href="javascript:void(0)" class="buttons clear">Очистить</a>
            <a href="javascript:void(0)" class="buttons ptsasstr">Финиш</a>
            <input type="checkbox" class="alignment" name="aligment" checked="checked"><span>Привязка по горизонтали-вертикали</span>
            <input type="button" value="point as objects" class="ptsasobj" style="display:none;">
        </div>
    </div>
</div>

<!-- Modal window для маркера -->
<div id="window-plan-marker" class="modal-window">
    <div class="modal-block">
        <div id="container-drag-marker">
            <a href="javascript:void(0)" class="drag-marker"></a>
        </div>
        <img src="<?=URL_PUBLIC?>/files/plans/test.png">
    </div>
</div>
<br>
<!-- Описание шаблона -->
<h2 class="h2-style-1"><?=$data_info['decription_tpl']?></h2>
<br>
<div id="wp-content">
    <form name="form" method="POST" action="<?=URL_ADMIN?>save/<?=$url[3]?>/">
        <br>
        <a href="#" class="seo-button buttons"><span></span>SEO информация</a>
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
        <br><br>
        <label>Заголовок</label><br>
        <input class="input-style-2" type="text" name="name_<?=LANG?>" value="<?=$data_info['name_'.LANG]?>"><br>
        <br>
        <label>URL адрес</label><br>
        <input class="input-style-3 check-url" data-check="<?=$data_info['id']?>" type="text" name="address" value="<?=$data_info['address']?>"><br><br>
        <!-- Картинки планировок -->
        <div class="img-block-html">
            <label>Картинка (с размерами)</label><br>
            <span class="tips-img">600*600рх </span>
            <input class="input-style-3" id="img" name="img" value="<?=$data_info['img']?>">
            <a href="javascript:;" onclick="mcImageManager.browse({fields : 'img', relative_urls : true, document_base_url : '/'});" class="add-button buttons"><span></span>Вставить</a><br>
            <img class="img-html" src="<?=$trumb = $data_info['img'] == "" ? SYS_PUBLIC.'img/no_img.jpg' : "/".$data_info['img']; ?>" width="70px" height="70px">
            <a href="javascript:;" class="crop-icon" <? if($data_info['img'] != ""): ?>onclick="mcImageManager.edit({path : '{0}<?=substr($data_info['img'],12,100)?>', onsave : function(res) {document.forms.form.submit(); }});" <? endif; ?>></a>                        
        </div>
        <br>
        
        
        <div class="img-block-html">
            <label>Картинка (с меблями)</label><br>
            <span class="tips-img">600*600рх </span>
            <input class="input-style-3" id="img_2" name="img_2" value="<?=$data_info['img_2']?>">
            <a href="javascript:;" onclick="mcImageManager.browse({fields : 'img_2', relative_urls : true, document_base_url : '/'});" class="add-button buttons"><span></span>Вставить</a><br>
            <img class="img-html" src="<?=$trumb = $data_info['img_2'] == "" ? SYS_PUBLIC.'img/no_img.jpg' : "/".$data_info['img_2']; ?>" width="70px" height="70px">
            <a href="javascript:;" class="crop-icon" <? if($data_info['img_2'] != ""): ?>onclick="mcImageManager.edit({path : '{0}<?=substr($data_info['img_2'],12,100)?>', onsave : function(res) {document.forms.form.submit(); }});" <? endif; ?>></a>                        
        </div>
        <br>
        
        <!--<div class="img-block-html">
            <label>Картинка (для фильтра)</label><br>
            <!--<span class="tips-img">Макс. ширина 605px, Макс. высота 470px </span>--
            <input class="input-style-3" id="img_3" name="img_3" value="<?=$data_info['img_3']?>">
            <a href="javascript:;" onclick="mcImageManager.browse({fields : 'img_3', relative_urls : true, document_base_url : '/'});" class="add-button buttons"><span></span>Вставить</a><br>
            <img class="img-html" src="<?=$trumb = $data_info['img_3'] == "" ? SYS_PUBLIC.'img/no_img.jpg' : "/".$data_info['img_3']; ?>" width="70px" height="70px">
            <a href="javascript:;" class="crop-icon" <? if($data_info['img_3'] != ""): ?>onclick="mcImageManager.edit({path : '{0}<?=substr($data_info['img_3'],12,100)?>', onsave : function(res) {document.forms.form.submit(); }});" <? endif; ?>></a>                        
        </div>-->
        <br>
        
        <label>Файл </label><br>
        <input class="input-style-3" id="files" name="files" value="<?=$data_info['files']?>">
        <a href="javascript:;" onclick="mcFileManager.browse({fields : 'files', relative_urls : true, document_base_url : '/'});" class="add-button buttons"><span></span>Вставить</a><br>                     
        <!-- / Картинки планировок -->
        <br>
        <label>Полощадь квартиры - Общая / Жилая</label><br>
        <input type="text" class="input-style-2" name="general_space" value="<?=$data_info['general_space']?>" style="width:162px">
        <input type="text" class="input-style-2" name="living_space" value="<?=$data_info['living_space']?>" style="width:162px">
        <br><br>
        <?/*<!-- Render coord -->
		<label>Координаты обводки дома на <strong>генплане</strong></label><br>
		<input class="input-style-2" id="planing-info-raphael-1" name="path_svg" type="text" value="<?=$data_info['path_svg']?>">
		<a href="javascript:void(0)" class="buttons add-draw-coordinates" id='run-drawing-popup-1' ><span></span>Подобрать</a><br>
        <br>*/?>
        <?/*<!-- Position marker -->
        <label>Координаты квартиры (<strong>X - Y</strong>)</label><br>
        <input class="input-style-2" style="width:162px" id="x-apart-info" name="coordinates_x" type="text" value="<?=$data_info['coordinates_x']?>">
        <input class="input-style-2" style="width:162px" id="y-apart-info" name="coordinates_y" type="text" value="<?=$data_info['coordinates_y']?>">
        <a href="javascript:void(0)" class="add-coordinates buttons"><span></span>Подобрать</a>
        <br><br>*/?>
        <?/*<label>Статус квартиры:</label><br>
        <select class="select-style-2" name="status_apart">
            <? foreach($status_apartaments['ru'] as $k => $v): ?>
                <option <?=$data_info['status_apart'] == $k ? 'selected="selected"' : null;?> value="<?=$k?>"><?=$v?></option>
            <? endforeach; ?>
        </select>*/?>
        
        <?/*<br><br>
        <label>Текст описания</label><br>
        <textarea class="mceFull" cols="40" rows="5" name="text_<?=LANG?>"><?=$data_info['text_'.LANG]?></textarea><br>
        <br>*/?>
        
        <label>Комнатность:</label><br>
            <select class="select-style-2" name="count_rooms">
            	<option <?=$data_info['count_rooms'] == 0 ? 'selected="selected"' : null;?> value="0">-</option>
                <!--<option <?=$data_info['count_rooms'] == 100 ? 'selected="selected"' : null;?> value="100">Студия</option>-->
                <option <?=$data_info['count_rooms'] == 1 ? 'selected="selected"' : null;?> value="1">1</option>
                <option <?=$data_info['count_rooms'] == 2 ? 'selected="selected"' : null;?> value="2">2</option>
                <option <?=$data_info['count_rooms'] == 3 ? 'selected="selected"' : null;?> value="3">3</option>
                <option <?=$data_info['count_rooms'] == 4 ? 'selected="selected"' : null;?> value="4">4</option>
                <option <?=$data_info['count_rooms'] == 5 ? 'selected="selected"' : null;?> value="5">5</option>
            </select>
        <br><br>
        
         <label>Сторона света:</label><br>
		 <input type='hidden' value='0' name='side'>
		 <input type='checkbox' value='1' name='side'  id='side'  <?=$data_info['side']==1?'checked="checked"':null;?>>  <label for='side'>Північ</label><br>
		 
		 <input type='hidden' value='0' name='side2'>
         <input type='checkbox' value='2' name='side2' id='side2' <?=$data_info['side2']==2?'checked="checked"':null;?>> <label for='side2'>Південь</label><br>
         
         <input type='hidden' value='0' name='side3'>
         <input type='checkbox' value='3' name='side3' id='side3' <?=$data_info['side3']==3?'checked="checked"':null;?>> <label for='side3'>Захід</label><br>
         
         <input type='hidden' value='0' name='side4'>
         <input type='checkbox' value='4' name='side4' id='side4' <?=$data_info['side4']==4?'checked="checked"':null;?>> <label for='side4'>Схід</label><br>
         
         
        <?/*<select class="select-style-2" name="side">
            <option value="0">Північ</option>
            <option <?=$data_info['side']==1 ? 'selected="selected"' : null;?> value="1">Схід</option>
            <option <?=$data_info['side']==2 ? 'selected="selected"' : null;?> value="2">Південь</option>
            <option <?=$data_info['side']==3 ? 'selected="selected"' : null;?> value="3">Захід</option>
        </select>*/?>
        <br><br>
        
        <label>Тераса:</label><br>
        <select class="select-style-2" name="window">
            <option value="1">С терасой</option>
            <option <?=$data_info['window']==2 ? 'selected="selected"' : null;?> value="2">Без терасы</option>
        </select>
        <br><br>
        
        <table><tr><td>
        
        	<label>Побудована на поверхах:</label><br>
	        <input type='hidden' name='add_space' value=''>
	        <select class="select-style-2" name="add_space[]" multiple="multiple" size='15'>
	        <? $data_info['add_space'] = explode(",", $data_info['add_space']); ?>
	        <? for($i=3;$i<=24;$i++){ ?>
	            <option <?=array_search($i, $data_info['add_space']) !== false ? 'selected="selected"' : null;?> value="<?=$i?>"><?=$i?></option>
	        <? } ?>
	        </select>
	        
        </td><td style='padding:0px 0px 0px 20px;'>
        
        	<label>В наявності на поверхах:</label><br>
	        <input type='hidden' name='add_space2' value=''>
	        <select class="select-style-2" name="add_space2[]" multiple="multiple" size='15'>
	        <? $data_info['add_space2'] = explode(",", $data_info['add_space2']); ?>
	        <? for($i=3;$i<=24;$i++){ ?>
	            <option <?=array_search($i, $data_info['add_space2']) !== false ? 'selected="selected"' : null;?> value="<?=$i?>"><?=$i?></option>
	        <? } ?>
	        </select>
	        
        </td></tr></table>
        
        <br>
        
        
        
        <br><br>
        
        <fieldset class="fieldset-style-1" style="width: 750px;">
            <legend>Дополнительная площадь:</legend>
            <div>
                <br>
                <a href="<?=URL_ADMIN?>add/<?=$url[3]?>/0/" class="add-button buttons"><span></span>Добавить новый раздел / в начало</a>
                <br><br>
                <table id="tb-content">
                    <tr class="nodrop nodrag">
                        <td width="5%">Show</td>
                        <td width="2%">Sort</td>
                        <td width="20%">Название площади</td>
                        <td width="20%">Площадь (м2)</td>
                        <td width="6%">&nbsp;</td>
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
                                    <input type="hidden" class="input-style-1 check-url" data-check="<?=$v['id']?>" name="address_id_<?=$v['id']?>" value="<?=$v['address'] = $v['id'] == 1 ? "/" : $v['address'];?>" <? if($v['id'] == 1){ echo 'disabled="disabled"'; } ?>>
                                </td>
                                <td>
                                    <input type="text" class="input-style-1" name="name_<?=LANG?>_id_<?=$v['id']?>" value="<?=$v['name_'.LANG]?>">
                                </td>
                                <td> 
                                    <input type="text" class="input-style-1" name="add_space_id_<?=$v['id']?>" value="<?=$v['add_space']?>">
                                </td>
                                <td>
                                    <a <?=C_Right::_edit($right_id);?> href="<?=URL_ADMIN?>edit/<?=$v['id']?>/" title="Edit" class="edit-button"></a>
                                    <a <?=C_Right::_del($right_id);?> href="<?=URL_ADMIN?>delete/<?=$v['id']?>/<?=$url[3]?>/" title="Delete" class="del-button delete"></a>
                                </td>
                            </tr>
                        <? $i++; endforeach; ?>
                    <? endif; ?>   
                </table>
                <hr>
                <br>
                <a href="<?=URL_ADMIN?>add/<?=$url[3]?>/99999/" class="add-button buttons"><span></span>Добавить новый раздел / в конец</a>
            </div>
            <br>
        </fieldset>
        <br><br>
        <a href="javascript:void(0)" class="save-button buttons"><span></span>Сохранить</a>
        <!-- Для save -->
        <input type="hidden" name="save">
        <br><br>
    </form>
</div>
