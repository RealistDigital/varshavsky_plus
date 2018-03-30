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
        <label>Заголовок раздела</label><br>
        <input class="input-style-2" type="text" name="name_2_<?=LANG?>" value="<?=$data_info['name_2_'.LANG]?>"><br>
        <br>
        <label>URL адрес</label><br>
        <input class="input-style-3 check-url" data-check="<?=$data_info['id']?>" type="text" name="address" value="<?=$data_info['address']?>"><br><br>
        <!-- Картинки планировок -->
        <div class="img-block-html">
            <label>Картинка</label><br>
            <span class="tips-img">Макс. ширина 605px, Макс. высота 470px </span>
            <input class="input-style-3" id="img" name="img" value="<?=$data_info['img']?>">
            <a href="javascript:;" onclick="mcImageManager.browse({fields : 'img', relative_urls : true, document_base_url : '/'});" class="add-button buttons"><span></span>Вставить</a><br>
            <img class="img-html" src="<?=$trumb = $data_info['img'] == "" ? SYS_PUBLIC.'img/no_img.jpg' : "/".$data_info['img']; ?>" width="70px" height="70px">
            <a href="javascript:;" class="crop-icon" <? if($data_info['img'] != ""): ?>onclick="mcImageManager.edit({path : '{0}<?=substr($data_info['img'],12,100)?>', onsave : function(res) {document.forms.form.submit(); }});" <? endif; ?>></a>                        
        </div>
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
        <!-- Render coord -->
		<label>Координаты обводки дома на <strong>генплане</strong></label><br>
		<input class="input-style-2" id="planing-info-raphael-1" name="path_svg" type="text" value="<?=$data_info['path_svg']?>">
		<a href="javascript:void(0)" class="buttons add-draw-coordinates" id='run-drawing-popup-1' ><span></span>Подобрать</a><br>
        <br>
        <!-- Position marker -->
        <label>Координаты квартиры (<strong>X - Y</strong>)</label><br>
        <input class="input-style-2" style="width:162px" id="x-apart-info" name="coordinates_x" type="text" value="<?=$data_info['coordinates_x']?>">
        <input class="input-style-2" style="width:162px" id="y-apart-info" name="coordinates_y" type="text" value="<?=$data_info['coordinates_y']?>">
        <a href="javascript:void(0)" class="add-coordinates buttons"><span></span>Подобрать</a>
        <br><br>
        <label>Статус квартиры:</label><br>
        <select class="select-style-2" name="status_apart">
            <? foreach($status_apartaments['ru'] as $k => $v): ?>
                <option <?=$data_info['status_apart'] == $k ? 'selected="selected"' : null;?> value="<?=$k?>"><?=$v?></option>
            <? endforeach; ?>
        </select>
        
        <br><br>
        <label>Текст описания</label><br>
        <textarea class="mceFull" cols="40" rows="5" name="text_<?=LANG?>"><?=$data_info['text_'.LANG]?></textarea><br>
        <br>
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
