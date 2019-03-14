<?php 

namespace connectToDB {

	/*
	* Функция устанавливает соединение с БД и возвращает указатель на подключение
	*/

	function connectToDB() {
		$host = 'localhost';
		$user = 'pupkin';
		$password_db = '12345';
		$dbname = 'mydb';
		 
		static $connection;

		if (null === $connection) {
		    $connection = mysqli_connect($host, $user, $password_db, $dbname);
		    if (mysqli_connect_errno()) {
		      die("Ошибка " . mysqli_connect_error());
		    }
		}
	  return $connection;
	}	
}

namespace authorization {

	/*
	* Функция проверяет наличие пользователя с таким логином(email) из базы данных,
	* возвращает данные пользователя/false в случае успеха/неудачи
	* @param $connect - указатель на подключение к БД
	* @param string $email - переданный логин
	*/

	function authorization(string $email) {	

		$connect = \connectToDB\connectToDB();

		//Вытаскиваем из БД запись со всей информацией про пользователя желающего зарегистрироваться, т.е. запись с таким email 
	    $query = mysqli_query($connect,
	    	"SELECT * FROM user
	    	 WHERE email='".mysqli_real_escape_string($connect, $email)."' LIMIT 1");

	    if ($query) {
	    	//Если такая запись есть
	    	//Преобразуем в ассоциативный массив
	    	$data = mysqli_fetch_assoc($query);	   
		    return $data;
	    } else {	    	
	    	return false;
	    } 		
	}
}

namespace writeToDB {

	/*
	* Функция записывает данные в БД на основе переданного SQL запроса
	* @param $connect - указатель на подключение к БД
	* @param string $query - запрос SQL для записи данных
	*/

	function writeToDB(string $query) {	

		$connect = \connectToDB\connectToDB();

		$result = false;
		//Применяем к БД переданный в параметре запрос
		$result = mysqli_query($connect, $query);
		return $result;			
	}
}


namespace getallUserGroups {
	/*
	* Функция получает из базы данных все группы в которых состоит пользователь
	* @param int $id - id пользователя
	* @param $connect - указатель на подключение к БД
	*/

	function getallUserGroups(int $id) {
		
		$connect = \connectToDB\connectToDB();

		//Получим все группы пользователя по переданному id
	    $query = mysqli_query($connect, "SELECT user_id, group_id FROM group_user WHERE user_id = '{$id}'");

	    //Массив для хранения строк полученных в результате запрса
	    $data = [];

	    //Запомним в массив все  полученные строки
	    while ($row = mysqli_fetch_assoc($query)) {
	    	array_push($data, $row);    	
	    }
		
		//Возвратим массив выбранных из БД строк
		return $data;	
	}
}

namespace getAllFromTable {

	/*
	* Функция получает из базы данных все значения таблицы
	* @param string $nameTable - название таблицы в БД
	* @param $connect - указатель на подключение к БД
	*/


	function getAllFromTable(string $nameTable) {
		
		$connect = \connectToDB\connectToDB();
		//Получим все группы пользователя по переданному id
	    $query = mysqli_query($connect, "SELECT * FROM {$nameTable}");

	    //Массив для хранения строк полученных в результате запрса
	    $data = [];

	    //Запомним в массив все  полученные строки
	    while ($row = mysqli_fetch_assoc($query)) {
	    	array_push($data, $row);    	
	    }
		
		//Возвратим массив выбранных из БД строк
		return $data;	
	}
}

namespace getAllMessageByIdUser {

	/*
	* Функция получает из базы данных все адресованные пользователю сообщения
	* @param $connect - указатель на подключение к БД
	* @param int $recipientUserId - id пользователя
	*/

	function getAllMessageByIdUser(int $recipientUserId) {
		
		$connect = \connectToDB\connectToDB(); 
		//Получим все сообщения адресованные пользователю с переданным в аргументах id 
	    $query = mysqli_query($connect, "SELECT * FROM message WHERE recipient_user_id = '{$recipientUserId}'");

	    //Массив для хранения строк полученных в результате запрса
	    $data = [];

	    //Запомним в массив все  полученные строки
	    while ($row = mysqli_fetch_assoc($query)) {
	    	array_push($data, $row);    	
	    }
		
		//Возвратим массив выбранных из БД строк
		return $data;	
	}
}

namespace getMessageById {

	/*
	* Функция получает из базы данных сообщение по id 
	* @param $connect - указатель на подключение к БД
	* @param int $messageId - id сообщения 
	*/

	function getMessageById(int $messageId) {
		
		$connect = \connectToDB\connectToDB();
		//Получим сообщениe по id 
	    $query = mysqli_query($connect, "SELECT * FROM message WHERE id = '{$messageId}' LIMIT 1" );

	    if ($query) {
	    	//Если такая запись есть
	    	//Преобразуем в ассоциативный массив
	    	$data = mysqli_fetch_assoc($query);	   
		    return $data;
	    } else {	    	
	    	return false;
	    }			
	}
}

namespace getNameSectionById {

	/*
	* Функция получает из БД название раздела по id 
	* @param $connect - указатель на подключение к БД
	* @param int $sectionId - id раздела
	*/

	function getNameSectionById(int $sectionId) {
		
		$connect = \connectToDB\connectToDB();
		//Получим из БД название раздела по id  
	    $query = mysqli_query($connect, "SELECT name FROM sections WHERE id = '{$sectionId}' LIMIT 1");

	    if ($query) {
	    	//Если такая запись есть
	    	//Преобразуем в ассоциативный массив
	    	$data = mysqli_fetch_assoc($query);	   
		    return $data;
	    } else {	    	
	    	return false;
	    }	
	}
}

namespace getUserbyId {

	/*
	* Функция получает из базы данных информацию о пользователе по id 
	* @param $connect - указатель на подключение к БД
	* @param int $userId - id пользователя 
	*/

	function getUserbyId(int $userId) {
		
		$connect = \connectToDB\connectToDB();
		//Получим все сообщения адресованные пользователю с переданным в аргументах id 
	    $query = mysqli_query($connect, "SELECT * FROM user 
	                                     WHERE id = '{$userId}' LIMIT 1");

	    if ($query) {
	    	//Если такая запись есть
	    	//Преобразуем в ассоциативный массив
	    	$data = mysqli_fetch_assoc($query);	   
		    return $data;
	    } else {	    	
	    	return false;
	    }	
	}
}

namespace getIdUsersByIdGroup {

	/*
	* Функция получает из базы данных id всех пользователей состоящих в группе, id которой передан в параметрах
	* @param $connect - указатель на подключение к БД
	* @param int $groupId - id группы 
	*/

	function getIdUsersByIdGroup(int $groupId) {
		
		$connect = \connectToDB\connectToDB();
		//Получим все сообщения адресованные пользователю с переданным в аргументах id 
	    $query = mysqli_query($connect, "SELECT user_id FROM group_user WHERE group_id = {$groupId}");

	    //Массив для хранения строк полученных в результате запрса
	    $data = [];

	    //Запомним в массив все  полученные строки
	    while ($row = mysqli_fetch_assoc($query)) {
	    	array_push($data, $row);    	
	    }
		
		//Возвратим массив выбранных из БД строк
		return $data;	
	}
}