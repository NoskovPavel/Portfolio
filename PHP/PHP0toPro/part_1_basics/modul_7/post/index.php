<?php
//Задание настроек для выдачи ошибок PHP

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

ini_set('session.gc_maxlifetime', 60*20);
session_name('session_id');
session_start();

//Подключение header'а сайта 
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/header.php';

?>
<h1 class="post-title">Страница сообщений</h1>
<a href="/post/view/index.php" class="write-message">
	Почта
</a>
<?php
//если переменная сессии authorize не определена, т.е. сессия истекла или авторизации не было 
if (!isset($_SESSION['authorize'])) {
	//и если мы не на странице авторизации - выводим ссылку для перехода к авторизации
	if (!((isset($_GET['login']) && ($_GET['login'] === 'yes')) || isset($invalidData))) {
?>
<a href="/index.php?login=yes" class="authorize">
	Авторизуйтесь чтобы оставлять сообщения
</a>					
<?php					
	}				
} else {	
	//id авторизованного пользователя/экранируем 
	$user_id = (int)$_SESSION['user']['id'];
		
	//Вытаскиваем из БД все записи связанные с авторизованным пользователем(в каких он группах состоит)
	$users = getallUserGroups\getallUserGroups($user_id);
	
	//Проходим по получившемуся многомерному массиву
	foreach ($users as $value) {
		//Установим принадлежность пользователя первой группе
		if (belongToGroups\belongToGroups($value['group_id'], '1')) {			
			?>
			<p class="white">Вы сможете отправлять  сообщения после прохождения модерации.</p>
			<?php
		} elseif (belongToGroups\belongToGroups($value['group_id'], '2')) {
			?>
			<a href="/post/add/index.php" class="write-message">
				Написать сообщение
			</a>
			<?php
		}
	}
		
}
