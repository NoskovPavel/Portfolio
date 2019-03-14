<?php 
namespace belongToGroups {

	/*
	* Функция сравнивает два параметра, возвращает true в случае строгого равенства
	*/

	function belongToGroups(string $idUserGroup, $idGroup) {	
	    if ($idUserGroup === $idGroup) {
	    	return true;
	    } else {
	    	return false;
	    }
	}
}

namespace buildSorter {

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
}

namespace isRead {

	/*
	* Функция проверяет аргумент на строгое равенство "1"(Флаг в базе данных (поле bool), 1 значит прочитано)
	*/

	function isRead(string $flagReadMessage) {	
	    return $flagReadMessage === "1";	    	
	}
}

