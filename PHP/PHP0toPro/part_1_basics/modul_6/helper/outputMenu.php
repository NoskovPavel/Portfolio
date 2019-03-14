<?php
namespace outputMenu;
/*
* Функция выводит пункты меню с оформлением в зависимости от параметров
* @param string $cssClass принимает значениe класса для оформления
* @param string $urlSection - адрес текущего пункта меню, по умолчанию - главная страница
* @param int $sortOrder - направление сортировки
*/

function outputMenu(string $cssClass = 'menu-header', string $urlSection = '/', int $sortOrder = SORT_ASC) {	
    //Подключим файл с массивом содержащим пункты меню
    require $_SERVER['DOCUMENT_ROOT'] . '/include/main_menu.php'; 

    //Отсортируем массив меню в зависимости от переданного параметра $sortOrder по ключу 'sort'
    usort($menuItem, \buildSorter\buildSorter('sort', $sortOrder)); 

    // Выведем верстку пунктов меню
    require $_SERVER['DOCUMENT_ROOT'] . '/include/menu_output.php';    
}

