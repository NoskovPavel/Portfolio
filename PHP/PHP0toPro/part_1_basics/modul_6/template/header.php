<?php
//Записываем/перезаписываем в куки логин при каждом хите если пользователь авторизован
if (isset($_SESSION['login'])) {
	$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
	setcookie('login', $_SESSION['login'], time() + 60*60*24*30, '/', $domain, false);    
}

//подключим функции хелперы
require_once $_SERVER['DOCUMENT_ROOT'] . '/helper/outputMenu.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/helper/getNameTitle.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/helper/titleSub.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/helper/buildSorter.php';
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
	<? if (isset($_SESSION['login'])) : //если была авторизация - выводим приветствие ?>
		<div class="login">
			<?= 'Личный кабинет ' . $_SESSION['login']; ?>
		</div>
	<? endif; ?>	
    <div style="clear: both"></div>
</div>