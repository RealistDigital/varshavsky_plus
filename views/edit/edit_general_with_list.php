<? $plan_info = Lib::plan_img($data_info['parent'])?>
<? global $status_apartaments, $count_bedrooms, $numbers_floors; ?>
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
            <a href="javascript:void(0)" class="drag-marker img-marker-3"></a>
        </div>
        <img src="/<?=$plan_info['img']?>">
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
        <input class="input-style-3 check-url" data-check="<?=$data_info['id']?>" type="text" name="address" value="<?=$data_info['address']?>">
        <br><br>
        <label>Текст описания</label><br>
        <textarea class="mceFull" cols="40" rows="5" name="text_<?=LANG?>"><?=$data_info['text_'.LANG]?></textarea><br>
        <br>
        <fieldset class="fieldset-style-1" style="width: 750px;">
            <legend>Список параметров:</legend>
            <div>
                <br>
                <a href="<?=URL_ADMIN?>add/<?=$url[3]?>/0/" class="add-button buttons"><span></span>Добавить новый раздел / в начало</a>
                <br><br>
                <table id="tb-content">
                    <tr class="nodrop nodrag">
                        <td width="5%">Show</td>
                        <td width="2%">Sort</td>
                        <td width="20%">Название 1</td>
                        <td width="20%">Название 2</td>
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
                                    <input type="text" class="input-style-1" name="name_2_<?=LANG?>_id_<?=$v['id']?>" value="<?=$v['name_2_'.LANG]?>">
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
