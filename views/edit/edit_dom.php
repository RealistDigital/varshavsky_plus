<!-- Edit List content -->
<? global $settings; 
$img_canvas = getGeneralInfo($data_info['parent']);
//print_r($img_canvas);
?>

<script type="text/javascript">
    $(function () {
        initDraw ({
            canvasId        : 'canvas',
            controlPanelId  : 'control-panel-1',
            inputPathId     : 'planing-info-raphael-1',
            pathSvgFormat   : '<?=$data_info['path_svg']?>',
            img             : '/<?=$img_canvas['img_2']?>',
            popupId         : 'popup-drawing-1',
            runButtonId     : 'run-drawing-popup-1',
            closeButtonId   : 'close-drawing-popup-1'
        });
          initDraw ({
            canvasId        : 'canvas-2',
            controlPanelId  : 'control-panel-2',
            inputPathId     : 'planing-info-raphael-2',
            pathSvgFormat   : '<?=$data_info['path_svg_2']?>',
            img             : '/<?=$img_canvas['img_3']?>',
            popupId         : 'popup-drawing-2',
            runButtonId     : 'run-drawing-popup-2',
            closeButtonId   : 'close-drawing-popup-2'
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

<!-- Modal window для картинки с планировкой -->
<div class="modal-window wp-draw-popup" id='popup-drawing-2'>
    <div class="wp-modal-draw">
        <div class="wp-canvas-draw">
            <canvas id="canvas-2"></canvas>
            <a id="close-drawing-popup-2" class="cloce-modal-window" href="javascript:void(0)">Х</a>
        </div>

        <br><br>
        <div id="control-panel-2" class="wp-control-panel-draw">
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
    <div class="modal-block" style="width: 362px; height: 351px;">
        <div id="container-drag-marker">
            <a href="javascript:void(0)" class="drag-marker marker-floor" style=''></a>
        </div>
        <img src="/<?=$img_canvas['img_2']?>" style=" height: 351px;">
    </div>
</div>
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
        <br>
        
        <!-- Render coord -->
		<label>Координаты обводки дома на <strong>генплане</strong></label><br>
		<input class="input-style-2" id="planing-info-raphael-1" name="path_svg" type="text" value="<?=$data_info['path_svg']?>">
		<a href="javascript:void(0)" class="buttons add-draw-coordinates" id='run-drawing-popup-1' ><span></span>Подобрать</a><br>
        <br>
         <!-- Render coord -->
		<label>Координаты обводки дома (моб)</label><br>
		<input class="input-style-2" id="planing-info-raphael-2" name="path_svg_2" type="text" value="<?=$data_info['path_svg_2']?>">
		<a href="javascript:void(0)" class="buttons add-draw-coordinates" id='run-drawing-popup-2' ><span></span>Подобрать</a><br>
        <br>
        <br>
           <!-- Position marker -->
            <label>Координаты маркера дома (<strong>X - Y</strong>)</label><br>
            <input class="input-style-2" style="width:162px" id="x-apart-info" name="coordinates_x" type="text" value="<?=$data_info['coordinates_x']?>">
            <input class="input-style-2" style="width:162px" id="y-apart-info" name="coordinates_y" type="text" value="<?=$data_info['coordinates_y']?>">
            <a href="javascript:void(0)" class="add-coordinates buttons"><span></span>Подобрать</a>
            
            <br>
            <br>
             <label>Компасс для дома</label><br>
	        <input class="input-style-3" type="text" name="compas" value="<?=$data_info['compas']?>">
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