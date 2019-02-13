<?php
//Задание настроек для выдачи ошибок PHP
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

ini_set('session.gc_maxlifetime', 60*20);
session_name('session_id');
session_start();

//Разавторизуемся при нажатии кнопки Выйти и запросе /index.php?delete=true
if (isset($_GET['delete']) && ($_GET['delete'] === 'true')) {
	session_unset();
	session_destroy();
}

//если форма авторизации была отправлена проверяем логин и пароль
if ($_POST) {
	//подключаем файлы с сообщениями
	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/users_login.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/users_password.php';

	$login = $_POST['login'];

	//Получаем из массива логинов индекс логина совпадающего с введенным пользователем	
	$key_user = array_search($login, $usersLogin);
	//если такого в массиве нет - $key_user == false
	if (($key_user !== false) && ($_POST['password'] === $usersPassword[$key_user])) {	
		//Такой логин у нас есть и пароль от него совпадает - ставим флаг об успешной авторизации
		$successData = true;
		//Ставим флаг в сессию об успешной авторизации		
		$_SESSION['authorize'] = true;
	} else {
		//такого логина  не зарегистрировано или не верный пароль
		$invalidData = true;
	};	
};
//Подключение header'а сайта 
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/header.php';

?>  
<h1>Сайт</h1>    
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="left-collum-index">			
			<h2>Возможности проекта —</h2>
			<p>Вести свои личные списки, например покупки в магазине, цели, задачи и многое другое. Делится списками с друзьями и просматривать списки друзей.</p>	
			<?php 
			//если переменная сессии authorize не определена, т.е. сессия истекла или авторизации не было 
			if (!isset($_SESSION['authorize'])) {
				//и если мы не на странице авторизации - выводим ссылку для перехода к авторизации
				if (!((isset($_GET['login']) && ($_GET['login'] === 'yes')) || isset($invalidData))) {
			?>
			<a href="/index.php?login=yes" class="authorize">
				Авторизуйтесь
			</a>					
			<?php					
				}				
			} else {
			//иначе мы уже авторизованы и предоставляем возможность разавторизоваться				
			?>
			<a href="/index.php?delete=true" class="authorize">
				Выйти из личного кабинета.
			</a>					
			<?php
			}
			//если пользователь ввел правильный логин и пароль и был авторизован
			if (isset($successData) && $successData) {
				//запоминаем логин и пароль в сессию
				$_SESSION['login'] = $login;
            	$_SESSION['password'] = $_POST['password'];            	
            	//выводим приветствие 
            ?> 
            <p class="hello">
            	<?= 'Здравствуйте, ' . $_SESSION['login'] . '!'; ?>
            </p>            	
            <?php
            // Выводим сообщение об успешной авторизации	
            require $_SERVER['DOCUMENT_ROOT'] . '/include/success.php';            	 
            }

				//Выведем меню с параметрами по умолчанию - на главной, в шапке,
				//с прямой сортировкой
				outputMenu\outputMenu();

				//если была запрошена страница авторизации или авторизация была не успешной - выведем форму для авторизации
			?>					
		</td>
	<?php if ((isset($_GET['login']) && ($_GET['login'] === 'yes')) || isset($invalidData)): ?>	
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
				<form method="POST" action="<?= $_SERVER['PHP_SELF'];  ?>">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<p style="color:red;">
							<?php //Вывод сообщения при не удачной авторизации 
							if (isset($invalidData) && $invalidData) {
                                require $_SERVER['DOCUMENT_ROOT'] . '/include/fail.php';
                            }
                            ?>
						</p>
						<tr>						
							<td class="iat">Ваш логин: <br />
								<input id="login_id" size="30" name="login" 
									value="<?= $_POST ? $_POST['login'] : 
													$_COOKIE['login'] ? : ''; ?>"/>
							</td>
						</tr>
						<tr>
							<td class="iat">Ваш пароль: <br />								
								<input type="password" id="password_id" size="30" name="password" 
									value="<?= $_POST ? $_POST['password'] : '' //если форму уже отправляли - поставить в поле введенное ранее значение?>"/>
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
  
    