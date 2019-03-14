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
<h1 class="post-title">Сообщение</h1>
<?php 
if (isset($_GET['id'])) {	
		//Id сообщения/экранируем 
		$messageId = (int)$_GET['id'];
		
		//Если есть id запрошенного сообщения, получаем информацию по нему из БД
		$message = getMessageById\getMessageById($messageId);
				
		//Если сообщение еще непрочитано
		if (!isRead\isRead($message['read'])) {			
			//Помечаем сообщение прочитанным
			writeToDB\writeToDB("UPDATE message SET `read` = 1 WHERE `id` = {$messageId}");
		}			

		//Id отправителя/экранируем
		$recipientId = (int)$message['recipient_user_id'];
		
		//Получаем информацию по отправителю
		$recipient = getUserbyId\getUserbyId($recipientId);
		
		//Полное имя отправителя
		$fullName = $recipient['surname'] . " " . $recipient['name'] . " " . $recipient['patronymic'];
		//email отправителя
		$email = $recipient['email'];
		?>
		<div class="white">
			<h2>Заголовок:</h2>
			<p class="text"><?= $message['header'] ?></p>

			<p class="header">Дата отправки:</p>
			<p class="text"><?= $message['creation_date'] ?></p>

			<p class="header">От кого:</p>
			<p class="text">
				<?= $fullName . "/" . $email ?>
			</p>
			<p class="header">Текст сообщения:</p>
			<p class="text"><?= $message['text'] ?></p>
		</div>
<?php		
}
