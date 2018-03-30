<!-- Settings site / View -->
<br>
<h1 align="center">НАСТРОЙКИ САЙТА</h1>
<br>
<div id="wp-content">
    <form method="POST" action="<?=URL_ADMIN?>save-settings/">
        <table>
            <tr>
                <td style="width: 500px;">
                    <h2>Настройки сайта</h2>
                    <br>
                    <label>E-mail для формы обратной связи</label><br>
                    <input class="input-style-3" type="text" name="email" value="<?=$data['email']?>"><br><br>
            		
            		<label>Дополнительный E-mail</label><br>
                    <input class="input-style-3" type="text" name="email_2" value="<?=$data['email_2']?>"><br><br>
                    
                    <label>Pagination admin panel</label><br>
                    <input class="input-style-4" style="width: 50px;" type="text" name="pagination_ad" value="<?=$data['pagination_ad']?>"><br><br>
                </td>
                <td style="width: 500px;">
                    <h2>Настройки безопасности</h2>
                    <br>
                    <label>Органичение входа в админку по IP</label><br>
                    <textarea name="allow_ips" style="width: 300px; height: 80px;"><?=$data['allow_ips']?></textarea><br>
                    <span class="tips">Если список IP, то вводите через запятую, <br>
                        <strong>&nbsp;пример:</strong> (127.0.0.1,121.54.64.2). 
                        <br> &nbsp;Ваш текущий IP - <strong><?=$_SERVER['REMOTE_ADDR']?> </strong>
                        <br> &nbsp;<strong style="color: red;">Не забудьте указать Ваш IP</strong> 
                    </span>
                    
                    <br>
                    <br>
                    
                    
                    <label>Заблокированные IP:</label><br>
                    <div style='overflow: auto;height:100px;width:200px;'>
                    <? $query = "SELECT * FROM ".TABLE_BLOCKED_IP." ORDER BY id";
                    	$res = DB::query($query);
                    	while($blocked_ip = DB::fetchAssoc($res)){
							$blocked_ip_html .= "<div style='clear:both;'>".$blocked_ip['ip']."&nbsp; <a href='".URL_ADMIN."delete_blocked_ip/".$blocked_ip['id']."/' title='Delete' class='del-button delete' style='float:right;'></a></div>";
						}
						if($blocked_ip_html){
							echo $blocked_ip_html;
						} else {
							echo "НЕТ";
						}
						
                    ?>
                    </div>
                    
                </td>
            </tr>
        </table>
        
		<br>
        <a href="javascript:void(0)" class="save-button buttons"><span></span>Сохранить</a>
        <!-- Для save -->
        <input type="hidden" name="save">
        <br><br>
    </form>
</div>