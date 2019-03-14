<?php
namespace buildSorter;
/*
* Функция возвращает пользовательскую функцию сравнения элементов для сортировки в usort()
* в зависимости от параметра $sortOrder
* @param string $key - название ключа в массиве по которому будет сортировка
* @param int $sortOrder - направление сортировки
*/


function buildSorter(string $key, int $sortOrder) {
	//функция для прямой сортировки с использованием ключа в массиве
	if ($sortOrder === SORT_ASC) {
    	return function ($a, $b) use ($key) {
    				return ($a[$key] <=> $b[$key]) ?: 0;				        
			    };
	//функция для обратной сортировки с использованием ключа в массиве
    } elseif ($sortOrder === SORT_DESC) {
    	return function ($a, $b) use ($key) {
				    return ($b[$key] <=> $a[$key]) ?: 0;    
			    };	
    };
    
}

