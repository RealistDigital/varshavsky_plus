<h1 align="center">Дополнительные возможности</h1>
<br>
<div id="wp-content">
    <? if($data['message'] != ""): ?>
        <?=$data['message']?>
    <? endif; ?>
    <table style="width: 100%;">
        <tr>
            <td style="width: 50%;">
                <form id="form-copy-lang" method="POST" action="<?=URL_ADMIN?>additionally/copy-lang/<?=$data['url']?>/">
                    <h1>Копирование переводов</h1><br>
                    <fieldset class="fieldset-style-1" style="width: 280px;">
                        <legend>Выберите с какого языка копировать:</legend>
                        <label>ru</label>
                        <input type="radio" name="land_from" value="ru" <?=LANG == "ru" ? 'checked="checked"' : null?>>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>ua</label>
                        <input type="radio" name="land_from" value="ua" <?=LANG == "ua" ? 'checked="checked"' : null?>>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>en</label>
                        <input type="radio" name="land_from" value="en" <?=LANG == "en" ? 'checked="checked"' : null?>>&nbsp;&nbsp;&nbsp;&nbsp;
                        <br>
                    </fieldset>
                    <br>
                    <fieldset class="fieldset-style-1" style="width: 280px;">
                        <legend>Выберите в какой язык копировать:</legend>
                        <label>ru</label>
                        <input type="radio" name="land_to" value="ru" checked="checked">&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>ua</label>
                        <input type="radio" name="land_to" value="ua">&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>en</label>
                        <input type="radio" name="land_to" value="en">&nbsp;&nbsp;&nbsp;&nbsp;
                    </fieldset>
                    <br>
                    <fieldset class="fieldset-style-1" style="width: 280px;">
                        <legend>Копировать переводы вложеных разделов?</legend>
                        <label>да</label>
                        <input type="radio" name="type_copy" value="1" checked="checked">&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>нет</label>
                        <input type="radio" name="type_copy" value="0">&nbsp;&nbsp;&nbsp;&nbsp;
                    </fieldset>
                    <br>
                    <fieldset class="fieldset-style-1" style="width: 280px;">
                        <legend>Заменить заполненые поля?</legend>
                        <label>да</label>
                        <input type="radio" name="empty_field" value="1" checked="checked">&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>нет</label>
                        <input type="radio" name="empty_field" value="0">&nbsp;&nbsp;&nbsp;&nbsp;
                    </fieldset>
                    <br>
                    <fieldset class="fieldset-style-1" style="width: 280px;">
                        <legend>Скопировать Show?</legend>
                        <label>да</label>
                        <input type="radio" name="show_flag" value="1">&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>нет</label>
                        <input type="radio" name="show_flag" value="0" checked="checked">&nbsp;&nbsp;&nbsp;&nbsp;
                    </fieldset>
                    <br><br>
                    <a id="save-copy-lang" href="javascript:void(0)" class="save-button-2 buttons"><span></span>Копировать переводы</a>
                    <br><br>
                    <input type="hidden" name="save" value="1">
                </form>
            </td>
            <td style="width: 50%;">
                <h1>Копирование записей</h1>
                <form id="form-copy-content" method="POST" action="<?=URL_ADMIN?>additionally/clone/<?=$data['url']?>/">
                    <br>
                    <fieldset class="fieldset-style-1" style="width: 280px;">
                        <legend>Копировать записи вложеных разделов?</legend>
                        <label>Да</label>
                        <input type="radio" name="type_copy" value="1">&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>Нет</label>
                        <input type="radio" name="type_copy" value="0" checked="checked">&nbsp;&nbsp;&nbsp;&nbsp;
                        <br>
                    </fieldset>
                    <br><br>
                    <a id="save-copy-content" href="javascript:void(0)" class="save-button-2 buttons"><span></span>Копировать записи</a>
                    <br><br>
                    <input type="hidden" name="save" value="1">
                </form>
            </td>
        </tr>
    </table>
</div>