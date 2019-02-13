<?php
	$d = date('H');	
	$h = intdiv($d, 6);		
?>

<!Doctype html>
<html>
	<head>
		<title>Study of PHP</title>
		<style>
			body{
				background: url(img/<?php echo $h; ?>.jpg);
				background-size: cover;
			}
		</style>
	</head>
	<body>
		<?php
			echo $h . ".jpg";
			echo 5 % 6;
		?>
	<body>
	</html>
	
	

