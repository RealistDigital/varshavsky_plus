<!-- Translate site / View -->
<br>
<h1 align="center">ПЕРЕВОДЫ ЭЛЕМЕНТОВ САЙТ</h1>
<br>
<div id="wp-content">
    <form method="POST" action="<?=URL_ADMIN?>save-translation/">
        <br>
        <a href="<?=URL_ADMIN?>add-translation/" class="add-button buttons"><span></span>Добавить новый элемент</a>
        <br><br>
        <table id="tb-content" style="width: 450px;">
            <tr>
                <td>&nbsp;&nbsp;ID</td>
                <!--
                <td>&nbsp;&nbsp;RU</td>
                <td>&nbsp;&nbsp;EN</td>
                -->
                <td>&nbsp;&nbsp;UA</td> 
                <td></td>
                <td>&nbsp;</td>
            </tr>
            <? if($data != ""): ?>
                <? $i=1; foreach($data as $k => $v): ?>
                    <tr>
                        <td>
                            <input class="input-style-4" style="width: 60px;" type="text" disabled="disabled" value="ID - <?=$v['id']?>">
                        </td>
                        <!--
                        <td>
                            <input class="input-style-3" style="width: 250px;" type="text" name="name_ru_id_<?=$v['id']?>" value="<?=$v['name_ru']?>">
                        </td>
                        <td>
                            <input class="input-style-3" style="width: 250px;" type="text" name="name_en_id_<?=$v['id']?>" value="<?=$v['name_en']?>">
                        </td>-->
                        <td>
                            <input class="input-style-3" style="width: 250px;" type="text" name="name_ua_id_<?=$v['id']?>" value="<?=$v['name_ua']?>">
                        </td>
                        
                        <td style="padding: 11px 0 0 5px;">
                            &nbsp;&nbsp;
                            <a class="delete del-button" title="Delete" href="<?=URL_ADMIN?>del-translation/<?=$v['id']?>/"></a>&nbsp;&nbsp;
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                <? endforeach; ?>
            <? endif; ?>
        </table>
        <br>
        <a href="javascript:void(0)" class="save-button buttons"><span></span>Сохранить</a>
        <!-- Для save -->
        <input type="hidden" name="save">
        <br><br>
    </form>
</div>
