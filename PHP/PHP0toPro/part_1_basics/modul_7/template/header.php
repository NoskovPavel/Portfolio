<?php
//Записываем/перезаписываем в куки логин(email) при каждом хите если пользователь авторизован
if (isset($_SESSION['user'])) {
	$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
	setcookie('login', $_SESSION['user']['email'], time() + 60*60*24*30, '/', $domain, false);    
}

//Функции вывода контента
require $_SERVER['DOCUMENT_ROOT'] . '/helper/getContentFunctions.php';
//Функция обрезки строки
require $_SERVER['DOCUMENT_ROOT'] . '/helper/titleSub.php';
//Функции получения информации из Базы Данных
require $_SERVER['DOCUMENT_ROOT'] . '/helper/workWithDB.php';
//Функции проверок и сравнений
require $_SERVER['DOCUMENT_ROOT'] . '/helper/verificationFunctions.php';

//Адрес на который был запрос			
$urlSection = $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href='/styles.css' rel="stylesheet" />
<title>Project - ведение списков</title>
</head>
<body>
<div class="header">
	<? if (isset($_SESSION['user'])) : //если была авторизация - выводим приветствие ?>
		<div class="login">
			<?= 'Личный кабинет ' . $_SESSION['user']['name']; ?>
		</div>
	<? endif; ?>	
    <div style="clear: both"></div>
</div>