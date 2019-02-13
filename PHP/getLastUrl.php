<?php
namespace getLastUrl;
/*
* Функция возвращает url из последнего get-запроса к серверу
* @return string последний запрошенный url у сервера
*/

function getLastUrl() : string {
	//открываем поток к файлу логов для нахождения url запроса к серверу(чтобы понять по какой ссылке кликнули) 
	$f = fopen("../../../userdata/logs/Apache-PHP-7-x64+Nginx-1.14_queriesa.log", "r");

	//Найдем последнюю строку в файле логов
	if($f){
	    if(fseek($f, -1, SEEK_END) == 0){//в конец файла -1 символ перевода строки
	        $len = ftell($f);
	        for($i = $len; $i > ($len-5000); $i--){//5000 - предполагаемая макс. длина строки
	            fseek($f, -2, SEEK_CUR);
	            if(fread($f,1) == "\n")//если встретился признак конца строки
	                break;
	        }        
	        $text = fread($f, $len - $i); //последняя строка
	        
	    }
	    fclose($f);
	} 

	//задаем шаблон регулярного выражения для разбиения последней строки
	$pattern='#(([0-9]{1,3}\.){3}[0-9]{1,3}).{1,}GET ([0-9a-z/\_\.\-]{1,})#i';

	//вытаскиваем данные из последней строки в массив matches 
	preg_match_all($pattern,$text,$matches);

	//искомый url get-запроса на сервер
	$urlSection = end($matches)[0];
	return $urlSection;
}