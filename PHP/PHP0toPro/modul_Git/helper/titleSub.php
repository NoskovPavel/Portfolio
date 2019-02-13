<?php
namespace titleSub;
/*
* Функция принимает строку, обрезает ее если она больше 15 символов, и возвращает ее
* @param string $title принимает значениe строки для обрезки
*/

function titleSub(string $title) {
	if (strlen($title) > 15) {
	    $title = mb_substr($title, 0, 12).'...';
    };
    return $title;
}	
 