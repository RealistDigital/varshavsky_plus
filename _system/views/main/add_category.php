<!-- Create new template / View -->
<br>
<h1 align="center">СОЗДАНИЕ НОВОГО ШАБЛОНА</h1>
<br>
<div id="wp-content">
    <table id="tb-content">
        <tr>
            <td>
                <form method="POST" action="">
                    <label><span style="color: red;">*</span>Имя шаблона</label><br>
                    <input class="input-style-3" type="text" name="name_cat" size="40">
                    <br><br>
                    <label><span style="color: red;"></span>Описание шаблона</label><br>
                    <textarea class="input-style-3" name="description_cat"></textarea>
                    <br><br>
                    <label>Родительский шаблон</label>
                    <br>
                    <select class="select-style-2" name="cat_id">
                        <option value="0"> ------------------------------------------- </option>
                        <?=$data['treeOptions']?>
                    </select>
                    <br><br>
                    <label><span style="color: red;">*</span>Шаблон админки (<strong>Edit</strong>)</label><br>
                    <select class="select-style-2" name="edit_tpl">
                        <option value=""> ------------------------------------------- </option>
                        <?=$data['editTemplates'];?>
                    </select>
                    <br><br>
                    <label><span style="color: red;">*</span>Шаблон сайта (<strong>View</strong>)</label><br>
                    <select class="select-style-2" name="view_tpl">
                        <option value=""> ------------------------------------------- </option>
                        <?=$data['viewTemplates'];?>
                    </select>
                    <br><br><br>
                    <a href="javascript:void(0)" class="save-button buttons"><span></span>Сохранить</a>
                    <!-- Для save -->
                    <input type="hidden" name="save_cat"><br><br>
                </form>
            </td>
        </tr>
    </table>
    
    
</div>