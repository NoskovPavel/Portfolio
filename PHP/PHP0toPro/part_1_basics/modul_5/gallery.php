<?php
//Задание настроек для выдачи ошибок PHP
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/helper/formatFileSize.php';

?>
<h2 class="title">Галерея</h2>
<div class="on-main">
	<a href="/">На главную</a>
</div>

<?php
// путь до папки с изображениями
$path = "upload/";

//Если нажали кнопку удалить смотрим отмеченные картинки и удаляем их из директории
if (isset($_POST['check'])) {	
	foreach ($_POST['check'] as $value) {	
		
		//название удаленной картинки	
		$img = $_SERVER['DOCUMENT_ROOT'] . '/' . $path . $value;

		//если такая существует удаляем
		if (file_exists($img)) {
			unlink($img);
		}		 
	}
}
//сканируем папку с картинками
$images = scandir($path);

//если нет ошибок при сканировании
if ($images !== false) { 

	//берем только файлы нужных форматов
    $images = preg_grep("/\.(?:png|jpeg|jpg)$/i", $images);  

    //если изображения для вывода есть
    if (is_array($images)) { 
	//Выведем форму с картинками и чекбоксами под ними с соответствующими их названию value 
	//при отправке формы выбранные картинки будут удаляться  
?> 
	<div class="gallery">
		<form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>">
			<div class="gallery__items">
			<? foreach ($images as $image) : ?> 
				<div class="gallery__item">				
					<?php
					//название картинки
					$nameImage = htmlspecialchars(urlencode($image));

					//Размер картинки в байтах
					$fileSize = filesize($path . $nameImage);

					//выводим если картинка с таким адресом существует
					if (file_exists($path . $nameImage)) {
					?>
					<div class="item-date">
						<?= "Дата загрузки:" . date ("F d Y H:i:s.", filemtime($path . $nameImage));?>					
					</div>				
					<div class="item-date">
						<?= formatFileSize\formatFileSize($fileSize); ?>					
					</div>
					<?php   				     
					} 
					?>
			    	<figure>
						<img src="<?= $path . $nameImage; ?>" alt="<?= $nameImage; ?>" />
						<figcaption><?= $nameImage; ?></figcaption>	
					</figure>				
						<input type="checkbox" name="check[]" value="<?= $nameImage; ?>">
				</div>
			<? endforeach; ?>
			</div>
			<input type="submit" value="Удалить" />
		</form>
	</div>   	
<?php    	
	} else { 
		// иначе, если нет изображений
    	echo 'Не обнаружено изображений в директории!';
    }
} else {
	// иначе, если директория пуста или произошла ошибка
    echo 'Директория пуста или произошла ошибка при сканировании.';
}

//Подключим footer 
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php';
