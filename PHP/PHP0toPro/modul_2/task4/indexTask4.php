<?php
require __DIR__.'/task4.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title  ?></title>
    <style type="text/css">.red {color: red;}</style>
</head>
<body>	
<h1 <?= $red ? 'class="red"' : ''?>>
	<?= $title  ?>
</h1>
<div>Авторов на портале <?= count($result3["AUTHORS"]) ?></div>
<!-- Выведем все книги -->
<?php foreach ($result3["BOOKS"] as $value) : 
	//Найдем автора книги по email книги 
	 $author = $result3["AUTHORS"][$value["email"]]; ?>
	<p>
		<?= "Книга \"".$value['book_name']."\", ее написал ".$author['name']." ".
	         $author['birth_year']." (".$value['email'].")"; ?>
	</p>      
<?php endforeach; ?>
</body>
</html>
