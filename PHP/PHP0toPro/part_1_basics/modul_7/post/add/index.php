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
//Функция получения id пользователей по id группы в которой они состоят

//если форма с сообщением была отправлена 
if ($_POST) {
	//Данные сообщения для записи в БД	
	$text  				= mysqli_real_escape_string($_POST['message']);
	$header 			= mysqli_real_escape_string($_POST['title']);
	$date 				= date("Y-m-d H:i:s");
	$recipient_user_id 	= (int)$_POST['recipient_id']; 
	$create_user_id		= (int)$_SESSION['user']['id'];
	$section_id 		= (int)$_POST['section'];	
	
	
		//Записываем сообщение в БД
		writeToDB\writeToDB("INSERT INTO message (text, 
												header, 
												creation_date, 
												recipient_user_id,
												create_user_id,
												sections_id)
								 VALUES (
								 				'{$text}', 
								 				'{$header}',
								 				'{$date}', 
								 				'{$recipient_user_id}', 
								 				'{$create_user_id}',
								 				'{$section_id}')"
		); 
			
}

//Массивы для данных из БД
//id пользователей
$users_id = [];
//пользователи
$users = [];
//Разделы
$sections = [];
//цвета разделов
$colors = [];


//Вытаскиваем из БД id всех пользователей которые состоят во второй группе - те кто может отправлять сообщения
$users_id = getIdUsersByIdGroup\getIdUsersByIdGroup(2);

foreach ($users_id as $value) {
	//id пользователя
	$idUser = (int)$value['user_id'];
	
	//Вытаскиваем каждого пользователя по id и добавляем в общий массив
	$user = getUserbyId\getUserbyId($idUser);
	
	array_push($users, $user);
}
//Получим из базы данных все разделы
$sections = getAllFromTable\getAllFromTable("sections");
	
//Получим из базы данных все возможные цвета для разделов 
$colors = getAllFromTable\getAllFromTable("color");
?>

<h2 class="white">Отправьте сообщение:</h2>
<div class="post-form">	
	<form method="POST" action="<?= $_SERVER['PHP_SELF'];  ?>">		
		<p>
			<label for="title">Заголовок:</label></br>
			<input type="text" id="" size="30" name="title" value=""/>
		</p>															
		<p>
			<label for="message">Текст сообщения:</label></br>
			<input type="text" id="" size="60" name="message" value=""/>
		</p>
		<p>
			<label for="recipient">Получатель сообщения:</label></br></br>
			<select name="recipient_id" id="recipient" size="1">
				<?foreach ($users as $value) :?>				
					<option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>	
				<? endforeach; ?>			
			</select>
		</p>
		<p>
			<label for="section">Раздел сообщения:</label></br></br>
			<select name="section" id="section" size="1">
				<?php 
				//Пройдем по всем разделам 
				foreach ($sections as $value) {	
					//Пройдем по всем цветам			
					foreach ($colors as $value_colors) {
						//Если id цвета совпадает с color_id раздела, окрасим в этот цвет текст названия раздела
						if ($value_colors['id'] == $value['color_id']) {					  			
				?>				
				<option value="<?= $value['id'] ?>"
					style="color : <?= $value_colors['color'] ?>;" >						
						<?= $value['name'] ?>						
				</option>	
				<?php 
					  	}
					}				
				}
				?>			
			</select>
		</p>							
		<input type="submit" value="Отправить" />							
	</form>
</div>

  
	  