<?php
	$d = date('H');
	$h = $d % 4;		
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
			echo $d;
		?>
	<body>
	</html>
	
	

