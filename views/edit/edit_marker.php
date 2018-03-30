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
<!-- Описание шаблона -->
<h2 class="h2-style-1"><?=$data_info['decription_tpl']?></h2>
<br>
<div id="wp-content">
    <form name="form" method="POST" action="<?=URL_ADMIN?>save/<?=$url[3]?>/">
        <label>Заголовок</label><br>
        <input class="input-style-2" type="text" name="name_<?=LANG?>" value="<?=$data_info['name_'.LANG]?>"><br><br>
        <label>URL адрес</label><br>
        <input class="input-style-3 check-url" data-check="<?=$data_info['id']?>" type="text" name="address" value="<?=$data_info['address']?>"><br><br>
        
        
        <label>Адресс</label><br>
        <input type="text" class="input-style-3" name="short_text_<?=LANG?>" value="<?=$data_info['short_text_'.LANG]?>">
        <br><br><br>
    
        
        <!-- Coordinates && Zoom map -->
        <label>Координаты на карте (<strong>X - Y - Zoom</strong>)</label><br>
        <input id="map-coordinates-x" type="text" class="input-style-2" style="width: 150px;" name="map_coordinates_x" value="<?=$data_info['map_coordinates_x']?>">
        <input id="map-coordinates-y" type="text" class="input-style-2" style="width: 150px;" name="map_coordinates_y" value="<?=$data_info['map_coordinates_y']?>">
        <input id="map-coordinates-x-center" type="hidden" name="map_coordinates_x_center" value="<?=$data_info['map_coordinates_x_center']?>">
        <input id="map-coordinates-y-center" type="hidden" name="map_coordinates_y_center" value="<?=$data_info['map_coordinates_y_center']?>">
        <input id="map-zoom" type="hidden" class="input-style-2" style="width: 70px;" name="map_zoom" value="<?=$data_info['map_zoom']?>">
        <a href="javascript:void(0)" class="buttons add-button google-map" style="padding: 7px 20px 7px 12px;"><span></span>Подобрать</a>
        <!-- / Coordinates && Zoom map -->
        <br><br>
        
        <div style='overflow: hidden;height:0px;'>
        <label>Текст</label><br>
        <textarea class="mceFull" cols="40" rows="5" name="text_<?=LANG?>"><?=$data_info['text_'.LANG]?></textarea><br>
        </div>
        
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
        <br><br><br>
        <a href="javascript:void(0)" class="save-button buttons"><span></span>Сохранить</a>
        <!-- Для save -->
        <input type="hidden" name="save">
        <br><br>
    </form>
</div>
