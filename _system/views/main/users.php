<!-- All users CMS / View -->
<br>
<h1 align="center">ПОЛЬЗОВАТЕЛИ АДМИНКИ</h1>
<br>
<div id="wp-content">
    <form method="POST" action="<?=URL_ADMIN?>save-all-users/">  
        <br> 
        <a href="<?=URL_ADMIN?>add-new-user/" class="add-button buttons"><span></span>Добавить пользователя</a>      
        <br><br> 
        <table id="tb-content" style="width:470px;">
            <tr>
                <td>Act. &nbsp;&nbsp;&nbsp;</td>
                <td>Логин</td>
                <td></td>
                <td></td>
            </tr>
            <? foreach($data as $k => $v): ?>
                <? if($_SESSION['user_id'] != 1 && $v['id'] == 1) continue; //только админ может редактировать себя.. ?>
                <tr>
                    <td>
                        <input type="checkbox" name="access_<?=$v['id']?>" <? if($v['access'] == 'yes') echo 'checked="checked"'; ?> >
                    </td>
                    <td>
                        <input class="input-style-3" type="text" size="60" name="login_<?=$v['id']?>" value="<?=$v['login']?>">
                    </td>
                    <td>
                        <a class="edit-button" href="<?=URL_ADMIN?>users/<?=$v['id']?>/"></a>&nbsp;&nbsp;
                        <a <?=C_Right::_section_del(5)?> class="delete del-button" href="<?=URL_ADMIN?>del-user/<?=$v['id']?>/"></a>&nbsp;&nbsp;
                    </td>
                    <td>&nbsp;</td>
                </tr>
            <? endforeach; ?>
        </table>
        <br><br>
        <a href="javascript:void(0)" class="save-button buttons"><span></span>Сохранить</a>
        <!-- Для save -->
        <input type="hidden" name="save">
        <br><br>
    </form>
</div>