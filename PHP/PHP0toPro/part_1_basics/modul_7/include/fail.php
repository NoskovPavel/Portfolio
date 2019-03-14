<!-- Сообщение при неудачной авторизации -->
<? if (isset($_COOKIE['login'])) : //Если куки с логином прочитаны значит логин есть ?>
<div style="color: red; font-size: 120%;">
	Неверный пароль!
</div>
<? else : ?>	
<div style="color: red; font-size: 120%;">
	Неверный логин или пароль!
</div>
<? endif; ?>