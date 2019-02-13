$(function () {	

//------------------Функция получения координат блочного элемента относительно начала документа
	
	function getCoords(elem) {                            
	  var box = elem.getBoundingClientRect();
	  return {									//координаты блока
		top: box.top + pageYOffset,              // (left, top)______________
		bottom: box.bottom + pageYOffset,		//			  |				|
		left: box.left + pageXOffset,			//			  |				|
		right: box.right + pageXOffset 			//			  |				|
	   };										//		      |_____________|(right,bottom)		
	}
	
//----------------Обработка Swipу (листание) на слайдере 
		
	var initialPoint_sound;
	var finalPoint_sound;	
	var count_input__sound = 3;
	//назначаем обработчик на прикосновение к экрану		
	document.addEventListener('touchstart', function(event) {
		//начальные координаты пальца учавствующего в событии
		initialPoint_sound=event.changedTouches[0];					    
	}, false);
	//назначаем обработчик на окончание прикосновения к экрану
	document.addEventListener('touchend', function(event) {	
		//получаем объект DOM слайдер 
		var slider_section = document.getElementById("slider_sound");    
		//получаем координаты слайдера относительно начала документа					
		var coord_slider = getCoords(slider_section);				
		//если двигаем по слайду
		if (initialPoint_sound.pageY > coord_slider.top && initialPoint_sound.pageY < coord_slider.bottom) { 	
					
			finalPoint_sound=event.changedTouches[0];		
			//разница между прикосновениями по x
			var xAbs = Math.abs(initialPoint_sound.pageX - finalPoint_sound.pageX);    
			//Если движение пальца по экрану больше 20 => был свайп	
			if (xAbs > 20) {						
				//Свайп влево	
				if (finalPoint_sound.pageX < initialPoint_sound.pageX){													
					//если активный слайд - последний, ставим первый
					if (count_input__sound == 5){                                  
						count_input__sound = 1
					} else {
						//ставим счетчик на следующий слайд
						count_input__sound++;										
					}
					//формируем id следующего слайда
					var id_input = "s" + count_input__sound + "_sound";		
					//делаем его включенным	
					document.getElementById(id_input).checked=true;				
				}
				else{					
					//Свайп вправо
					if (count_input__sound == 1){
						count_input__sound = 5
					} else {
						count_input__sound--;
					}				
					var id_input = "s" + count_input__sound + "_sound";					
					document.getElementById(id_input).checked=true;					
				}				
			}
		}
	}, false);
});
