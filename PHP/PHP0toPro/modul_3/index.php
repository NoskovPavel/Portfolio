<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//если форма была отправлена проверяем логин и пароль
if ($_POST) {
	//подключаем файлы с сообщениями
	require __DIR__.'/include/users_login.php';
	require __DIR__.'/include/users_password.php';
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
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="styles.css" rel="stylesheet" />
<title>Project - ведение списков</title>
</head>

<body>
  <div class="header">
    	<div class="logo"><img src="i/logo.png" width="68" height="23" alt="Project" /></div>
        <div style="clear: both"></div>
   </div>    
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<tr>
            	<td class="left-collum-index">			
					<h1>Возможности проекта —</h1>
					<p>Вести свои личные списки, например покупки в магазине, цели, задачи и многое другое. Делится списками с друзьями и просматривать списки друзей.</p>	
					<?php if (isset($successData) && $successData)
						  		require __DIR__.'/include/success.php'; ?>					
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
									<?php if (isset($invalidData) && $invalidData)
										 require __DIR__.'/include/fail.php'; ?>
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
    
    <div class="footer">&copy;&nbsp;<nobr>2018</nobr> Project.</div>

</body>
</html>