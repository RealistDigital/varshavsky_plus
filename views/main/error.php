<div style="background-color: #00619e; width: 100%; height: 100%">
    <br><br><br><br><br><br><br><br><br><br><br>

    <?php if(is_string($error)): ?>
        <div id="wp-text-error">
            <p class="text-error"><?=$error?></p>
        </div>
    <?php else: ?>
        <h1>Извините, такой странички не существует</h1>
		<div>Возможно, в адресе страницы была допущена опечатка или ошибка, или эта страница была удалена.</div>
		<div>Попробуйте предпринять следующие шаги:</div>
		<ul>
			<li><a href='javascript:history.back()' style='text-decoration:none;'>- вернуться назад</a></li>
			<li><a href='/' style='text-decoration:none;'>- перейти на главную страницу</a></li>
		</ul>
		<div>С уважением, <br> Администрация</div>
    <?php endif; ?>
</div>

<?
// Пример для Вывода ошибок
/**
$viev->view('error', false, false, false, 'Текст ошибки');
exit();
*/
?>
