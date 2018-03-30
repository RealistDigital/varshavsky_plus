<?
global $status_apartaments, $count_bedrooms, $numbers_floors;
$plan_info = Lib::plan_img($data_info['parent']);
?>
<style>
	.drag-marker{
	    width: 14px;	
	}
</style>
<!-- Images Manager -->
<script type="text/javascript" src="<?=SYS_PLUGINS?>tiny_mce/plugins/imagemanager/js/mcimagemanager.js"></script>
<!-- File Manager -->
<script type="text/javascript" src="<?=SYS_PLUGINS?>tiny_mce/plugins/filemanager/js/mcfilemanager.js"></script>

<!-- Modal window для картинки с планировкой -->
<div id="window-plan-img" class="modal-window">
    <div class="modal-block">
        <a href="javascript:void(0)" class="clear-canvas">Очистить слой</a>
        <div id="canvas-for-plan"></div>
        <img id="img-plan" class="img-content" src="/<?=$plan_info['img']?>">
    </div>
</div>
<!-- Modal window для маркера -->
<div id="window-plan-marker" class="modal-window">
    <div class="modal-block">
        <div id="container-drag-marker">
            <a href="javascript:void(0)" class="drag-marker marker-apart-room" style=''></a>
        </div>
        <img class="img-content" src="/<?=$plan_info['img']?>">
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
        <br><br>
        <!-- Position marker -->
        <label>Координаты (<strong>X - Y</strong>)</label><br>
        <input class="input-style-2" style="width:162px" id="x-apart-info" name="coordinates_x" type="text" value="<?=$data_info['coordinates_x']?>">
        <input class="input-style-2" style="width:162px" id="y-apart-info" name="coordinates_y" type="text" value="<?=$data_info['coordinates_y']?>">
        <a href="javascript:void(0)" class="add-coordinates buttons"><span></span>Подобрать</a>
        <br><br><br><br>
        <a href="javascript:void(0)" class="save-button buttons"><span></span>Сохранить</a>
        <!-- Для save -->
        <input type="hidden" name="save">
        <br><br>
    </form>
</div>
