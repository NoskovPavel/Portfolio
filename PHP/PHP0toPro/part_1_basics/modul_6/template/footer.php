<?php		
//вывод нижнего меню
if (!isset($urlSection)) {
	outputMenu\outputMenu('menu-footer', '/', SORT_DESC);
} else {
	outputMenu\outputMenu('menu-footer', $urlSection, SORT_DESC);
}

?>
	<div class="footer">&copy;&nbsp;<nobr>2018</nobr> Project.</div>	
</body>
</html>