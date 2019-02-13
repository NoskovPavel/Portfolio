//alert("Top:"+coord_slider.top+", Left:"+coord_slider.left+", Right:"+coord_slider.right+", Bottom:"+coord_slider.bottom)
	
	function getCoords(elem) {                            // Функция получения координат элемента относительно начала документа
	  var box = elem.getBoundingClientRect();

	  return {												//координаты блока
		top: box.top + pageYOffset,                      //    (left, top)______________
		bottom: box.bottom + pageYOffset,				//				  |				|
		left: box.left + pageXOffset,					//				  |				|
		right: box.right + pageXOffset 					//				  |				|
	   };												//			      |_____________|(right,bottom)		
	}