<?php 

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require $_SERVER['DOCUMENT_ROOT'] . "/notice/app/User/User.php";

use notice\App\User\User;

$user1 = new User("Павел Иванович", "noskov@mail.ru", "мужской", "19", "+7123456");

$user2 = new User("Семен Семенович", "semen@mail.ru", "мужской", "15", "+7654321");
?>

<p>notifyOnEmail("Hello!"):</p>
<?php
$user1->notifyOnEmail("Hello!");
$user2->notifyOnEmail("Hello!");
?>

<p>notifyOnPhone("Call me!"):</p>
<?php
$user1->notifyOnPhone("Call me!");
$user2->notifyOnPhone("Call me!");
?>

<p>notify("Hello, you want drugs or sex?"):</p>
<?php
$user1->notify("Hello, you want drugs or sex?");
$user2->notify("Hello, you want drugs or sex?");
?>
</br>
<a href="/">На главную</a>