<br>
<h1 align="center">РЕДАКТИРОВАТЬ ШАБЛОН</h1>
<br>
<div id="wp-content">
    <form method="POST" action="">
        <label>Имя шаблона</label><br>
        <input class="input-style-3" type="text" name="name_cat" value="<?=$data['name']?>">
        <br><br>
        <label><span style="color: red;"></span>Описание шаблона</label><br>
        <textarea class="input-style-3" name="description_cat"><?=$data['description']?></textarea>
        <br><br>
        <label>Родительский шаблон</label>
        <br>
        <select class="select-style-2" name="cat_id">
            <option value="0"> ------------------------------------------- </option>
            <?=$data['treeOptions']?>
        </select>
        <br><br>
        
        <label>Шаблон админки (<strong>Edit</strong>)</label><br>
        <select class="select-style-2" name="edit_tpl">
            <option value=""> ------------------------------------------- </option>
            <?=$data['editTemplates'];?>
        </select>
        <br><br>
        
        <label>Шаблон сайта (<strong>View</strong>)</label><br>
        <select class="select-style-2" name="view_tpl">
            <option value=""> ------------------------------------------- </option>
            <?=$data['viewTemplates'];?>
        </select>
        <br><br><br>
        
        <a href="javascript:void(0)" class="save-button buttons"><span></span>Сохранить</a>
        <!-- Для save -->
        <input type="hidden" name="save_edit_cat"><br><br>
    </form>
</div>