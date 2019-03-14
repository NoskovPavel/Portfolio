<?php
namespace getNameTitle;
/*
* Функция выводит текущий пункт меню 
* @param string $urlSection - url текущего пункта меню 
*/

function getNameTitle(string $urlSection) {	
//Подключем файл с массивом содержащим пункты меню
require $_SERVER['DOCUMENT_ROOT'] . '/include/main_menu.php';

	foreach ($menuItem as $value) {
		if ($value['path'] == $urlSection) {
	 		return $value['title'];
		}
	}
}
