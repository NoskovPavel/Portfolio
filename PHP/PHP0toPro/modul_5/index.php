<?php
//Задание настроек для выдачи ошибок PHP
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/header.php';
?>
Pагрузите картинки для галереи (не более 5 шт и только файлы форматов jpeg, png, jpg и не более 5 МВ).
<form action="handler.php" method="post" id="my_form" enctype="multipart/form-data">	
	<input type="file" name="myfile[]" required multiple>  	
	<input type="submit" name="upload" id="submit" value="Отправить">
</form>
<div class="success"></div>
<div class="open-gallery">
	<a href="gallery">Посмотреть загруженные фото</a>
</div>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php';
