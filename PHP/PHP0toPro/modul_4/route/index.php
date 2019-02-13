<?php
//Задание настроек для выдачи ошибок PHP
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//Подключение header'а сайта 
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/header.php';
?>     
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
    	<td class="left-collum-index">			
			<h1>Возможности проекта —</h1>
			<p>Вести свои личные списки, например покупки в магазине, цели, задачи и многое другое. Делится списками с друзьями и просматривать списки друзей.</p>								
			<h2>				
			<?= getNameTitle\getNameTitle($urlSection); //вывод названия текущего раздела?>
			<h2>
			<?php
			//выведем сообщение об успешной авторизации
			if (isset($successData) && $successData) {
                require $_SERVER['DOCUMENT_ROOT'] . '/include/success.php';
            };
			//Вывод меню в шапке
			outputMenu\outputMenu('menu-header', $urlSection);
			?>					
		</td>
	</tr>
</table>
<?php 
//Подключение footer'а сайта 
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php';
   
    