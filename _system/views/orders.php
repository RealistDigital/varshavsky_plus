<!-- Orders / View -->
<br>
<h1 align="center">ЗАКАЗЫ ИНТЕРНЕТ МАГАЗИНА</h1>
<br>
<div id="wp-content" style="width: 950px;">
    <strong style="float: left; font-family: Tahoma, sans-serif;">Сортировать: &nbsp;&nbsp;&nbsp;</strong>
    <form id="sort-orders" style="float: left; border: 1px solid green;" method="GET" action="">
        <select name="sort">
            <option <?=$sel_sort = $_GET['sort'] == false ? 'selected' : NULL;?> value=""> - - - - - - - - - - - - - - - - - - - - </option>
            <option <?=$sel_sort = $_GET['sort'] == '0' ? 'selected' : NULL;?> value="0">Ожидает оплаты</option>
            <option <?=$sel_sort = $_GET['sort'] == '1' ? 'selected' : NULL;?> value="1">Оплачено</option>
            <option <?=$sel_sort = $_GET['sort'] == '2' ? 'selected' : NULL;?> value="2">Отменен</option>
        </select>
    </form>
    <br><br>
    <? global $status; ?>
    <div id="pagination-orders"><?=$data['pagination']?></div><br>
    <table id="tb-content" style="width: 930px;">
        <tr>
            <td width="35"><strong>&nbsp;№</strong></td>
            <td width="140"><strong>&nbsp;Статус заказа</strong></td>
            <td width="170"><strong>&nbsp;Дата</strong></td>
            <td width="270"><strong>&nbsp;ФИО. покупателя</strong></td>
            <td width="130"><strong>&nbsp;Телефон</strong></td>
            <td width="70"><strong>&nbsp;Кол.</strong></td>
            <td width="130"><strong>&nbsp;Цена</strong></td>
            <td width="30">&nbsp;Ред.</td>
            <td width="30">&nbsp;Удал.</td>
        </tr>
        <tr>
            <td style="padding: 0 !important;" colspan="20">
                <hr>
            </td>
        </tr>
        <? if($data['all_orders'] != ""): ?>
            <? foreach($data['all_orders'] as $k => $v): ?>
                <tr>
                    <td><?=$v['order']?></td>
                    <td><?=$status[$v['status']]?></td>
                    <td style="font-size: 12px;"><?=$v['date']?></td>
                    <td><?=$v['fio']?></td>
                    <td><?=$v['phone']?></td>
                    <td><?=$v['all_count']?> <strong>шт.</strong></td>
                    <td><?=$v['all_price']?> <strong>грн.</strong></td>
                    <td><a class="edit-button" href="<?=URL_ADMIN?>orders/edit/<?=$v['order']?>/"></a></td>
                    <td><a class="del-button delete" href="<?=URL_ADMIN?>orders/del/<?=$v['order']?>/"></a></td>
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
                    <p align="center"><strong>Заказы отсутствуют!</strong></p>
                </td>
            </tr>
        <? endif; ?>
    </table>
    <br>
    <div id="pagination-orders"><?=$data['pagination']?></div>
</div>