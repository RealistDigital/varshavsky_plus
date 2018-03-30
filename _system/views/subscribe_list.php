<!-- Orders / View -->
<style>
.general-label-style {
    font-family: Tahoma, sans-serif; 
    padding-top: 4px;
}
</style>
<br>
<h1 align="center">ПОДПИСКА - СПИСОК ПОДПИСЧИКОВ</h1>
<br>
<div id="wp-content" style="width: 750px;">
    <br>
    <strong style="float: left;" class="general-label-style">Сортировать: &nbsp;&nbsp;&nbsp;</strong>
    <form id="sort-orders" style="float: left;" method="POST" action="">
        <select name="sort" class="select-style-2">
            <option value=""> - - - - - - - - - - - - - - - - - - - - </option>
            <option <?=$sel_sort = $_POST['sort'] == 'news' ? 'selected' : NULL;?> value="news">Новости</option>
            <option <?=$sel_sort = $_POST['sort'] == 'objects' ? 'selected' : NULL;?> value="objects">Слежение за объектами</option>
        </select>
    </form>
    <form id="export-subs-form">
        <strong style="margin-left: 40px;" class="general-label-style">Експорт:</strong>
        <select name="sort" class="select-style-2">
            <option value="">Всех подписчиков</option>
            <option value="news">Новости</option>
            <option value="objects">Слежение за объектами</option>
        </select>
        <a href="javascript:void(0)" class="export-button buttons"><span></span> Export</a>
    </form>
    <br>
    <? global $status; ?>
    <div id="pagination-orders"><?=$data['pagination']?></div><br>
    <table id="tb-content" style="width: 750px;">
        <tr>
            <td width="35"><strong>&nbsp;№</strong></td>
            <td width="140"><strong>&nbsp;Email подписчика</strong></td>
            <td width="170"><strong>&nbsp;Дата подписки</strong></td>
            <td width="170"><strong>&nbsp;Вид подписки</strong></td>
            <td width="30"><strong>&nbsp;</strong></td>
        </tr>
        <tr>
            <td style="padding: 0 !important;" colspan="20">
                <hr>
            </td>
        </tr>
        <? if($data != ""): ?>
            <? foreach($data as $k => $v): ?>
                <tr>
                    <td><?=$v['id']?></td>
                    <td><?=$v['email']?></td>
                    <td style="font-size: 12px;"><?=$v['date']?></td>
                    <td style="font-size: 12px;">
                        <?=$v['flag'] == 'news' ? 'Новости' : 'Объекты';?>
                    </td>
                    <td>
                        <!--<a class="edit-button" href="<?=URL_ADMIN?>subscribe/edit/<?=$v['id']?>/"></a>-->
                        <a class="del-button delete" title="Delete" href="<?=URL_ADMIN?>subscribe/del/<?=$v['id']?>/"></a>
                    </td>
                    
                </tr>
                <tr>
                    <td style="padding: 0 !important;" colspan="20">
                        <hr>
                    </td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="100">
                    <p align="center"><strong>Подписчиков нет!</strong></p>
                </td>
            </tr>
        <? endif; ?>
    </table>
    <br>
    <div id="pagination-orders"><?=$data['pagination']?></div>
</div>