<?php
//Задание настроек для выдачи ошибок PHP
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//если форма была отправлена проверяем логин и пароль
if ($_POST) {
	//подключаем файлы с сообщениями
	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/users_login.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/users_password.php';
	//Получаем из массива логинов индекс логина совпадающего с введенным пользователем	
	$key_user = array_search($_POST['login'], $usersLogin);
	//если такого в массиве нет - $key_user == false
	if (($key_user !== false) && ($_POST['password'] === $usersPassword[$key_user])) {	
		//Такой логин у нас есть и пароль от него совпадает - ставим флаг об успешной авторизации
		$successData = true;	
	} else {
		//такого логина  не зарегистрировано или не верный пароль
		$invalidData = true;
	};	
};
//Подключение header'а сайта 
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/header.php';
?>      
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="left-collum-index">			
			<h1>Возможности проекта —</h1>
			<p>Вести свои личные списки, например покупки в магазине, цели, задачи и многое другое. Делится списками с друзьями и просматривать списки друзей.</p>	
			<?php 
			if (isset($successData) && $successData) {
                require $_SERVER['DOCUMENT_ROOT'] . '/include/success.php';
            }
				//Выведем меню с параметрами по умолчанию - на главной, в шапке,
				//с прямой сортировкой
				outputMenu\outputMenu();
			?>					
		</td>
	<?php if ((isset($_GET['login']) && $_GET['login'] === 'yes') || isset($invalidData)): ?>	
	    <td class="right-collum-index">					
			<div class="project-folders-menu">
				<ul class="project-folders-v">
				<li class="project-folders-v-active"><span>Авторизация</span></li>
				<li><a href="#">Регистрация</a></li>
				<li><a href="#">Забыли пароль?</a></li>
				</ul>
				<div style="clear: both;"></div>
			</div>					
			<div class="index-auth">
				<!-- Форма отправляет данные на эту же страницу   -->
				<form method="POST" action="<?= $_SERVER['PHP_SELF'];  ?>">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<!-- Вывод сообщения при не верном вводе логина или пароля   -->
						<p style="color:red;">
							<?php if (isset($invalidData) && $invalidData) {
                                require $_SERVER['DOCUMENT_ROOT'] . '/include/fail.php';
                            }
                            ?>
						</p>
						<tr>
							<td class="iat">Ваш e-mail: <br />
								<!-- Если форма была уже отправлена и мы на этой же странице, т.е. логин либо пароль не верны - в поле отображается введенное ранее значение   -->
								<input id="login_id" size="30" name="login" 
									value="<?= $_POST ? $_POST['login'] : '' ?>"/>
							</td>
						</tr>
						<tr>
							<td class="iat">Ваш пароль: <br />
								<!-- Если форма была уже отправлена и мы на этой же странице, т.е. логин либо пароль не верны - в поле отображается введенное ранее значение   -->
								<input type="password" id="password_id" size="30" name="password" 
									value="<?= $_POST ? $_POST['password'] : '' ?>"/>
							</td>
						</tr>
						<tr>
							<td>
								<input type="submit" value="Войти" />
							</td>
						</tr>
					</table>
				</form>
			</div>				
		</td>
	<?php endif; ?>	
	</tr>
</table>
<?php 
//Подключение footer'а сайта 
require_once __DIR__.'/template/footer.php';
  
    