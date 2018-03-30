<!-- Orders / View -->
<br>
<h1 align="center">ЗАКАЗ № - <?=$data['cust']['order']?></h1>
<br>
<div id="wp-content" style="width: 950px;">
    <br>
    <h2 class="h2-style-1" style="text-transform: uppercase;">Информация о клиенте</h2><br>
    <table id="customer-info">
        <tr>
            <td width="120"><strong>Фио: </strong></td>
            <td><?=$data['cust']['fio']?></td>
        </tr>
        <tr>
            <td><strong>E-Mail: </strong></td>
            <td><?=$data['cust']['email']?></td>
        </tr>
        <tr>
            <td><strong>Телефон: </strong></td>
            <td><?=$data['cust']['phone']?></td>
        </tr>
        <tr>
            <td><strong>Адрес: </strong></td>
            <td><?=$data['cust']['address']?></td>
        </tr>
    </table>
    <br>
    <h2 class="h2-style-1" style="text-transform: uppercase;">Информация о заказе</h2><br>
    <? global $status; ?>
    <table id="customer-info" width="800">
        <tr>
            <td width="150"><strong>Статус заказа</strong></td>
            <td>
                <span style=" margin-right: 30px; float: left;"><?=$status[$data['cust']['status']]?></span>
                <form method="POST" action="<?=URL_ADMIN?>orders/change-status/" style="float: left;">
                    <select name="new_status" style="border: 1px solid #424242;">
                        <option value="0" <?=$sel = $data['cust']['status'] == 0 ? 'selected' : NULL; ?>>Ожидает оплаты</option>
                        <option value="1" <?=$sel = $data['cust']['status'] == 1 ? 'selected' : NULL; ?>>Оплачен</option>
                        <option value="2" <?=$sel = $data['cust']['status'] == 2 ? 'selected' : NULL; ?>>Отменен</option>
                    </select>
                    <input type="hidden" name="order" value="<?=$data['cust']['order']?>">
                    <input type="submit" name="change_status" value="Изменить статус">
                </form>
            </td>
        </tr>
        <tr>
            <td><strong>Сумма к оплате: </strong></td>
            <td><strong><?=$data['cust']['all_price']?></strong> грн.</td>
        </tr>
        <tr>
            <td><strong>Общее кол. товара: </strong></td>
            <td><strong><?=$data['cust']['all_count']?></strong> шт.</td>
        </tr>
        <tr>
            <td><strong>Дата заказа: </strong></td>
            <td><?=$data['cust']['date']?></td>
        </tr>
    </table><br>
    <h2 class="h2-style-1" style="text-transform: uppercase;">Заказаные товары</h2><br>
    <table id="tb-goods-order">
        <? if($data['orders']): ?>
            <tr>
                <td width="40"><strong>№</strong></td>
                <td width="250"><strong>Название товара</strong></td>
                <td width="100"><strong>Количество</strong></td>
                <td width="150"><strong>Цена</strong></td>
            </tr>
            <? $u=1; foreach($data['orders'] as $k => $v): ?>
                <tr>
                    <td><?=$u?></td>
                    <td><a target="_blank" style="color: blue;" href="/<?=LANG?>/<?=$v['url']?>"><?=$v['name']?></a></td>
                    <td><?=$v['count']?> шт.</td>
                    <td><?=$v['price']?> грн.</td>
                </tr>
            <? $u++; endforeach; ?>
        <? endif; ?>
    </table>
    <br><br><br><br><br>
</div>