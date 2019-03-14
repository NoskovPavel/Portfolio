<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require $_SERVER['DOCUMENT_ROOT'] . "/toyFactory/app/ToyFactory/ToyFactory.php";
require $_SERVER['DOCUMENT_ROOT'] . "/toyFactory/app/Toy/Toy.php";

use toyFactory\App\ToyFactory\ToyFactory;

//Создадим фабрику
$toyFactory = new ToyFactory;

//массив для хранения игрушек
$toys = [];

//Заполним массив игрушками
for ($i=1; $i <= rand(5,20) ; $i++) { 
	array_push($toys, $toyFactory->createToy("Игрушка №$i"));
}

//Общая стоимость всех игрушек
$sum = 0;

//Выведем все игрушки
foreach ($toys as $value) {
	$sum += $value->price;
	echo $value->name . " - " . $value->price . "</br>";
}

//Выведем общую стоимость
echo "Итого - " . $sum;
?>
</br>
<a href="/">На главную</a>