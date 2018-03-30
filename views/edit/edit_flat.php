<?php
global $settings;
$typesAparts        = getGeneralInfoCycle(array('type_tpl' => 30));
$dataFloor          = getGeneralInfo($data_info['parent'], array('img'));
//$dataApartSection   = getGeneralInfo(array('type_tpl' => 6));
?>
<!-- Images Manager -->
<script type="text/javascript" src="<?=SYS_PLUGINS?>tiny_mce/plugins/imagemanager/js/mcimagemanager.js"></script>

<script type="text/javascript">
    $(function () {
        initDraw ({
            canvasId        : 'canvas',
            controlPanelId  : 'control-panel-1',
            inputPathId     : 'planing-info-raphael-1',
            pathSvgFormat   : '<?=$data_info['path_svg']?>',
            img             : '/<?=$dataFloor['img']?>',
            popupId         : 'popup-drawing-1',
            runButtonId     : 'run-drawing-popup-1',
            closeButtonId   : 'close-drawing-popup-1'
        });
    });

    $(function () {
        initDraw ({
            canvasId        : 'canvas-2',
            controlPanelId  : 'control-panel-2',
            inputPathId     : 'planing-info-raphael-2',
            pathSvgFormat   : '<?=$data_info['path_svg_2']?>',
            img             : '/<?=$dataFloor['img']?>',
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
    <div class="modal-block" style="width: 440px; height:360px;">
        <div id="container-drag-marker">
            <a href="javascript:void(0)" class="drag-marker marker-apart-info"></a>
            <a href="javascript:void(0)" class="drag-marker-3 marker-apart-sold"></a>
        </div>
        <img style="max-width: 440px; max-height: 360px" src="/<?=$dataFloor['img']?>">
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
        <input class="input-style-3 check-url" data-check="<?=$data_info['id']?>" type="text" name="address" value="<?=$data_info['address']?>">
        <br><br>

     
		<!-- Render coord -->
            <label>Координаты обводки секции (страница "Квартиры")</label><br>
            <input class="input-style-2" id="planing-info-raphael-1" name="path_svg" type="text" value="<?=$data_info['path_svg']?>">
            <a href="javascript:void(0)" class="buttons add-draw-coordinates" id='run-drawing-popup-1' ><span></span>Подобрать</a><br>
            <br>
            
               <!-- Render coord -->
		<!--<label>Координаты обводки квартиры на <strong>этаже</strong></label><br>
		<input class="input-style-2" id="planing-info-raphael-2" name="path_svg_2" type="text" value="<?=$data_info['path_svg_2']?>">
		<a href="javascript:void(0)" class="buttons add-draw-coordinates" id='run-drawing-popup-2' ><span></span>Подобрать</a><br>
        <br>-->
            
         <!--<label>Тип маркера этажа</label><br><br>
            <div style="width: 70px; height: 50px; position: relative; float: left;    margin-right: 16px;">
                <img src="<?=SYS_PLUGINS?>planning/img/marker_1.png" style="    width: 72px;">
                <input class="type-marker" <?=$data_info['type_marker'] == 2 ? 'checked' : null;?> type="radio" name="type_marker" value="2" style="position: absolute; left:14px; top:22px;">
            </div>
            <div style="width: 70px; height: 50px; position: relative; float: left">
                <img src="<?=SYS_PLUGINS?>planning/img/marker_2.png" style="    width: 72px;">
                <input class="type-marker" <?=$data_info['type_marker'] == 1 ? 'checked' : null;?> type="radio" name="type_marker" value="1" style="position: absolute; left:19px; top:22px;">
            </div>
            <br>
            <br>
            <br>
            <br>-->
            
               <br><br>
            
       
        <!-- Position marker -->
            <label>Координаты маркера секции (<strong>X - Y</strong>) (страница "Квартиры")</label><br>
            <input class="input-style-2" style="width:162px" id="x-apart-info" name="coordinates_x" type="text" value="<?=$data_info['coordinates_x']?>">
            <input class="input-style-2" style="width:162px" id="y-apart-info" name="coordinates_y" type="text" value="<?=$data_info['coordinates_y']?>">
            <a href="javascript:void(0)" class="add-coordinates buttons"><span></span>Подобрать</a>

            <br><br>
       
        <label>Планировка квартиры:</label><br>
        <select class="select-style-2" name="plan">
            <option value="0"> - </option>
            <?php if (!empty($typesAparts)): ?>
                <?php foreach ($typesAparts as $k => $v): ?>
                    <option <?=$data_info['plan'] == $v['id'] ? 'selected="selected"' : null;?> value="<?=$v['id']?>"><?=$v['name_'.LANG]?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <br><br>
        
        
     

        <label>Статус квартиры:</label><br>
        <select class="select-style-2" name="status">
            <option value="0">В продаже</option>
            <option <?=$data_info['status']==1 ? 'selected="selected"' : null;?> value="1">Продано</option>
            <option <?=$data_info['status']==2 ? 'selected="selected"' : null;?> value="2">Резерв</option>
        </select>
        <br><br>

        <!--<label>Поворот компаса <strong>в градусах</strong></label><br>
        <input class="input-style-2" name="compas_rotation" type="text" value="<?=$data_info['compas_rotation']?>" style="width: 150px">-->
        <br><br><br><br>

        <a href="javascript:void(0)" class="save-button buttons"><span></span>Сохранить</a>
        <!-- Для save -->
        <input type="hidden" name="save">
        <br><br>
    </form>
</div>
