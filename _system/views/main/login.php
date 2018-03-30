<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <!-- CSS -->
        <link href="<?=SYS_PUBLIC?>css/login.css"  rel="stylesheet" type="text/css">
        <!-- JS -->
        <script type="text/javascript" src="<?=SYS_PUBLIC?>js/jquery-1.8.1.min.js"></script>
        <!-- Main JS -->
        <script type="text/javascript" src="<?=SYS_PUBLIC?>js/js_login.js"></script>
        <title> Login </title>
    </head>
<body>
    <div id="login-wp">
        <div id="form">
			<div class="logo"><img src="<?=SITE_ADDR?>/public/img/logo.png" alt="logo" /></div>
            <form method="POST" action="">
                <div class="field-login">
                    <input type="text" name="login" value="login">
                </div>
                <div class="field-pass">
                    <input type="password" name="pass" value="login">
                </div>
                <input type="checkbox" class="remember-me" name="rememder">
                <label class="lable-remember">запомнить меня</label>
                <input class="field-button" name="access" type="submit" value="" title="Login">
            </form>
			<a class="powered" href="<?=SITE_ADDR?>">Вернуться на сайт</a>  <a class="link" href="http://realist.digital" target="_blank">Powered by REALIST DIGITAL</a>
        </div>
    </div>
<!-- ошибка - вывод
<p align="center"><?=$data[0]?></p>
-->
</body>
</html>