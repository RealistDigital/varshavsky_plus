<!-- include uploader -->
<? require_once(DR . DS . "_system/plugins/uploader_images/upload_inc.php"); ?>
<!-- Images Manager -->
<script type="text/javascript" src="/_system/plugins/tiny_mce/plugins/imagemanager/js/mcimagemanager.js"></script>
<br>
<!-- Edit List content -->
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
        <br><br>
        <span class="info-img">Размер картинки 980 х 392px</span>
        
        <div id="hidden-dop-info">
            <br>
            <h2 class="h2-style-1">Дополнительная информация</h2>
            <br>
            <label>Дополнительный текст</label><br>
            <textarea class="textarea-style-1 mceFullSimple" name="text_<?=LANG?>"><?=$data_info['text_'.LANG]?></textarea>
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
        <!-- Multi Load images -->
        <h2 class="h2-style-1">Мульти загрузка картинок</h2>
        <br>
        <div id="wp-multi" style="position: relative;">
            <select id="select_up_dir">
                <option value="public/files">В корень ..</option>
                <?=showTree($dir, " ")?>
            </select>
            <div id="file_upload">Добавить</div>
        </div>
        <br> 
        <div id="wp-content" style="width: 700px;">
            <br>
            <a href="<?=URL_ADMIN?>add/<?=$url[3]?>/0/" class="add-button buttons"><span></span>Добавить новый раздел / в начало</a>
            <br><br>
            <table id="tb-content">
                <tr class="nodrop nodrag">
                    <td width="5%">Show</td>
                    <td width="8%">Sort</td>
                    <td width="40%">Название</td>
                    <td width="11">Картинка</td>
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
                                <input type="hidden" class="input-style-1 check-url" data-check="<?=$v['id']?>" name="address_id_<?=$v['id']?>" value="<?=$v['address'] = $v['id'] == 1 ? "/" : $v['address'];?>" <? if($v['id'] == 1){ echo 'disabled="disabled"'; } ?>>
                            </td>
                            <td>
                                <input class="img-insert input-style-1" type="hidden" id="img_id_<?=$v['id']?>" name="img_id_<?=$v['id']?>" value="<?=$v['img']?>">
                                <input class="input-style-1" type="text" name="name_<?=LANG?>_id_<?=$v['id']?>" value="<?=$v['name_'.LANG]?>">
                            </td>
                            <td>
                                <div class="inser-img">
                                    <img src="<?=$trumb = $v['img'] == "" ? SYS_PUBLIC.'img/no-img.jpg' : "/".$v['img']; ?>" width="70px" height="70px">
                                    <a href="javascript:;" <? if($v['img'] != ""): ?>onclick="mcImageManager.edit({path : '{0}<?=substr($v['img'],12,100)?>', onsave : function(res) {window.location.reload();}});" <? endif; ?> class="crop-icon"></a>
                                    <a href="javascript:;" onclick="mcImageManager.browse({fields : 'img_id_<?=$v['id']?>', relative_urls : true, document_base_url : '/'});" class="add-button buttons"><span></span>Вставить</a>
                                </div>
                            </td>
                            <td>
                                <a <?=C_Right::_del($right_id);?> href="<?=URL_ADMIN?>delete/<?=$v['id']?>/<?=$url[3]?>/" title="Delete" class="del-button delete"></a>
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