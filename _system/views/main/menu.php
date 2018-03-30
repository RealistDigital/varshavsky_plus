<!-- Left part / Left menu -->
<td class="left-part">
    <div id="admin-logo"></div>
    <div class="line-1"></div>
    <!-- Mein menu -->
    <div id="left-menu">
        <h2>Main menu</h2>
        <ul id="main-menu">
            <li>&nbsp;</li>
            <li <?=Lib_url::current_admin_menu('edit', true)?>><a <?=C_Right::_section_edit(2)?> href="<?=URL_ADMIN?>" class="manag-icon" >Управление контентом</a></li>
            <li <?=Lib_url::current_admin_menu('settings')?>><a <?=C_Right::_section_dis(3)?> href="<?=URL_ADMIN?>settings/" class="sett-icon">Настройки сайта</a></li>
            <li <?=Lib_url::current_admin_menu('translation')?>><a <?=C_Right::_section_dis(6)?> href="<?=URL_ADMIN?>translation/" class="lang-icon">Переводы сайта</a></li>
            <!--<li <?=Lib_url::current_admin_menu('map-admin')?>><a <?=C_Right::_section_dis(4)?> href="<?=URL_ADMIN?>map-admin/" class="map-icon">Карта контента</a></li>-->
            <li <?=Lib_url::current_admin_menu('structure')?>><a <?=C_Right::_section_dis(1)?> href="<?=URL_ADMIN?>structure/" class="struc-icon">Структура CMS</a></li>
            <li <?=Lib_url::current_admin_menu('users')?>><a <?=C_Right::_section_dis(5)?> href="<?=URL_ADMIN?>users/" class="users-icon">Пользователи CMS</a></li>
            <!--<li <?=Lib_url::current_admin_menu('orders')?>><a href="<?=URL_ADMIN?>orders/" class="order-icon">Заказы магазина</a></li>-->
            <li <?=Lib_url::current_admin_menu('subscribe')?>><a href="<?=URL_ADMIN?>subscribe/" class="order-icon">Подписка</a></li>
        </ul>
    </div>
</td>

<!-- Right part / Top menu -->
<td class="right-part">
    <div id="rigth-header">
        <h2>Administration panel</h2>
        <!-- Top menu -->
        <div id="lang-out-menu">
            <ul>
                <li>
                    <a href="<?=URL_ADMIN;?>exit/" title="Exit" class="out-icon"></a>
                </li>
                <li class="langs-select">
                    <? $lang_url = $url[3] != "" ? $url[2]."/".$url[3]."/" : NULL; ?>
                    <!--<a href="<?=URL?>ru/real_admin/<?=$lang_url?>" title="Russian language" class="lang-ru"></a>
                    <a href="<?=URL?>en/real_admin/<?=$lang_url?>" title="English language" class="lang-en"></a>-->
                    <a href="<?=URL?>ua/real_admin/<?=$lang_url?>" title="Ukraine language" class="lang-ua"></a>
                </li>
                <li><a id="public-part" href="<?=BASE_URL.$public_url?>" target="_blank">Публичная часть</a></li>
                <!--<li><a href="javascript:void(0)" class="online-editor"><?=$_SESSION['online_editor']?> Online редактор</a></li>-->
                <li><a class="info-hotkeys" title="Hotkeys"></a></li>
            </ul>
        </div>
        <div class="line-2"></div>
        <!-- Name user -->
        <table id="name-user">
            <tr>
                <td class="left-bg"></td>
                <td class="center-bg">Здравствуйте: <strong><?=$_SESSION['user_name']?> (<?=$_SESSION['user_login']?>)</strong></td>
                <td class="right-bg"></td>
            </tr>
        </table>
    </div>
    <br>
    <!-- Right content -->
    <div id="right-content">
    
    