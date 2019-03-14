<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require $_SERVER['DOCUMENT_ROOT'] . '/eshop/app/basket/basket.php';
require $_SERVER['DOCUMENT_ROOT'] . '/eshop/app/order/order.php';
require $_SERVER['DOCUMENT_ROOT'] . '/eshop/app/product/product.php';
require $_SERVER['DOCUMENT_ROOT'] . '/notice/app/user/user.php';

use eshop\App\Basket\Basket;
use eshop\App\Order\Order;
use eshop\App\Product\Product;
use notice\App\User\User;


$basket = new Basket;

$product1 = new Product("First_prod", 55);
$product2 = new Product("Second_prod", 45);

//Добавим товары и их количество в корзину  
$basket->addProduct($product1, 100);
$basket->addProduct($product2, 50);

$order = new Order($basket);
?>
<pre>
<h2>Информация о корзине заказа:</h2>
<?php 
//Выведем информацию о корзине
$infBasket = $order->getBasket()->describe();
echo $infBasket;
?>
<h2>Общая стоимость заказа:</h2>
<?php 
//Общая стоимость заказа
$total = $order->getPrice();
echo  "$total</br></br>";

//Уведомление клиенту
$user = new User("Николай Николаевич", "nikolay@mail.ru");
$user->notifyOnEmail("Для вас создан заказ, на сумму: $total Состав: </br>$infBasket")
?>
</pre>
</br>
<a href="/">На главную</a>