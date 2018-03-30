<br>
<!-- Описание шаблона -->
<h2 class="h2-style-1"><?=$data_info['decription_tpl']?></h2>
<br>
<div id="wp-content">
    <form name="form" method="POST" action="<?=URL_ADMIN?>save/<?=$url[3]?>/">
        <label>Заголовок</label><br>
        <input class="input-style-2" type="text" name="name_<?=LANG?>" value="<?=$data_info['name_'.LANG]?>"><br><br>
        <label>Текст</label><br>
        <textarea  cols="55" rows="5" name="short_text_<?=LANG?>"><?=$data_info['short_text_'.LANG]?></textarea><br><br>
        <br>
        
        <label>Телефон 1</label><br>
        <input class="input-style-2" type="text" name="tel" value="<?=$data_info['tel']?>"><br><br>
        <label>Телефон 2</label><br>
        <input class="input-style-2" type="text" name="tel_2" value="<?=$data_info['tel_2']?>"><br><br>
        <label>Телефон 3</label><br>
        <input class="input-style-2" type="text" name="tel_3" value="<?=$data_info['tel_3']?>"><br><br>
        
        
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
