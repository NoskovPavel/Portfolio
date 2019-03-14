<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require $_SERVER['DOCUMENT_ROOT'] . '/homeZoo/app/Cat/Cat.php';
require $_SERVER['DOCUMENT_ROOT'] . '/homeZoo/app/Dog/Dog.php';
require $_SERVER['DOCUMENT_ROOT'] . '/homeZoo/app/Fish/Fish.php';

use homeZoo\App\Cat\Cat;
use homeZoo\App\Dog\Dog;
use homeZoo\App\Fish\Fish;



$cat1 = new Cat("Кот1");
$cat2 = new Cat("Кот2");
$cat3 = new Cat("Кот3");

$dog1 = new Dog("Собака1");
$dog2 = new Dog("Собака2");
$dog3 = new Dog("Собака3");
$dog4 = new Dog("Собака4");
$dog5 = new Dog("Собака5");

$fish = new Fish("Рыба");

echo $cat1->name . "</br>";
echo $cat2->name . "</br>";
echo $cat3->name . "</br>";

echo $dog1->name . "</br>";
echo $dog2->name . "</br>";
echo $dog3->name . "</br>";
echo $dog4->name . "</br>";
echo $dog5->name . "</br>";

echo $fish->name . "</br>";

?>

<a href="/">На главную</a>