<?php
	function endings($m, $variants){
		$m1 = $m % 100;
		$m0 = $m % 10;
		
		if($m1 >= 5 && $m1 <= 20){
			$res = $variants[0];
		}
		elseif($m0 == 1){
		    $res = $variants[1];
        }
        elseif ($m0 >= 2 && $m0 <= 4){
		    $res = $variants[2];
        }
        else{
		    $res = $variants[0];
        }
			return $res;
	}	
?>

<!Doctype html>
<html>
	<head>
		<title>Study of PHP</title>
		<style>
			div{
                width: 500px;
                margin: 0 auto;
            }
		</style>
	</head>
	<body>
        <div>
            <p>Московское время:</p>
		    <?php
                $hStr = ['часов', 'час', 'часа'];
                $iStr = ['минут', 'минута', 'минуты'];
                $sStr = ['секунд', 'секунда', 'секунды'];
                $h = date('H');
                $i = date('i');
                $s = date ('s');
                echo $h . ' ' . endings($h, $hStr) . '<br>' . $i . ' ' . endings($i, $iStr) . ' <br>' . $s . ' ' . endings($s, $sStr);
            ?>
        </div>
    </body>
	</html>
	
	

