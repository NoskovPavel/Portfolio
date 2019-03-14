<?php
//Задание настроек для выдачи ошибок PHP

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

ini_set('session.gc_maxlifetime', 60*20);
session_name('session_id');
session_start();

//Подключение header'а сайта 
require $_SERVER['DOCUMENT_ROOT'] . '/template/header.php';

?>

<h1 class="post-title">Почта</h1>

<?php
//если переменная сессии authorize не определена, т.е. сессия истекла или авторизации не было 
if (!isset($_SESSION['authorize'])) {
	//и если мы не на странице авторизации - выводим ссылку для перехода к авторизации
	if (!((isset($_GET['login']) && ($_GET['login'] === 'yes')) || isset($invalidData))) {
	?>
	<a href="/index.php?login=yes" class="authorize">
		Авторизуйтесь чтобы читать сообщения
	</a>					
	<?php					
	}				
} else {
	//Выводим список сообщений для авторизованного пользователя	
	
	//id авторизованного пользователя/экранируем
	$user_id = (int)$_SESSION['user']['id'];

	
	//Вытаскиваем из БД все адресованные авторизованному пользователю сообщения
	$messageUnread = getAllMessageByIdUser\getAllMessageByIdUser($user_id);
	
	//Проходим циклом по всем сообщениям
	foreach ($messageUnread as $value) {
		//Id секции 
		$sectionId = (int)$value['sections_id'];
		//Вытаскиваем из БД название раздела текущего сообщения
		$messageSection = getNameSectionById\getNameSectionById($sectionId);
		
		?>
		<a href="/post/message/index.php?id=<?= $value['id'] ?>" class="write-message">
			<?= $value['header'] ?>/<?= $messageSection['name'] ?>
		</a>
		<?php
	}			
}


