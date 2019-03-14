<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require $_SERVER['DOCUMENT_ROOT'] . '/hungryCat/app/HungryCat/HungryCat.php';

use hungryCat\App\HungryCat\HungryCat;

$cat1 = new HungryCat("Васька", "черный", "Вискас");
$cat2 = new HungryCat("Том", "синий", "Китекат");

$cat1->eat("Молоко");
$cat1->eat("Колбаса");
$cat1->eat("Пиво");
$cat1->eat("Сало");
$cat1->eat("Вискас");

$cat2->eat("Квас");
$cat2->eat("Рыба");
$cat2->eat("Картошка");
$cat2->eat("Сосиска");
$cat2->eat("Китекат");

?>

<a href="/">На главную</a>