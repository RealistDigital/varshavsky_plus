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
        <br>
        <div class="img-block-html">
            <label>Картинка</label><br>
            <span class="tips-img">Макс. ширина 1200px </span>
            <input class="input-style-3" id="img" name="img" value="<?=$data_info['img']?>">
            <a href="javascript:;" onclick="mcImageManager.browse({fields : 'img', relative_urls : true, document_base_url : '/'});" class="add-button buttons"><span></span>Вставить</a><br>
            <img class="img-html" src="<?=$trumb = $data_info['img'] == "" ? SYS_PUBLIC.'img/no_img.jpg' : "/".$data_info['img']; ?>" width="70px" height="70px">
            <a href="javascript:;" class="crop-icon" <? if($data_info['img'] != ""): ?>onclick="mcImageManager.edit({path : '{0}<?=substr($data_info['img'],12,100)?>', onsave : function(res) {document.forms.form.submit(); }});" <? endif; ?>></a>                        
        </div>
        <br>
        <label>Файл </label><br>
        <input class="input-style-3" id="files" name="files" value="<?=$data_info['files']?>">
        <a href="javascript:;" onclick="mcFileManager.browse({fields : 'files', relative_urls : true, document_base_url : '/'});" class="add-button buttons"><span></span>Вставить</a><br>                   
        <br>
        <label>Дата</label><br>
        <input type="text" name="date" value="<?=$data_info['date']?>" class="date input-style-4"><br>
        <br>
        <br>
        <label>Сокращенный текст</label><br>
        <textarea  cols="40" rows="5" class="mceSimple" name="short_text_<?=LANG?>"><?=$data_info['short_text_'.LANG]?></textarea><br><br>
        <label>Сокращенный текст 2</label><br>
        <textarea  cols="40" rows="5" class="mceFullSimple" name="short_text_<?=LANG?>"><?=$data_info['short_text_'.LANG]?></textarea><br><br>
        <label>Полный текст</label><br>
        <textarea class="mceFull" cols="40" rows="5" name="text_<?=LANG?>"><?=$data_info['text_'.LANG]?></textarea><br>
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
