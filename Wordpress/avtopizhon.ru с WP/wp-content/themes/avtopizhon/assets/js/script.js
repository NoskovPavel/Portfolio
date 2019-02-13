
//----------Выпадающее меню для больших экранов

var el = document.getElementsByClassName('menu-item');

for(var i=0; i<el.length; i++) {
    el[i].addEventListener("mouseover", showSub, false);
    el[i].addEventListener("mouseleave", hideSub, false);
}
	//на заметку: события перестают отрабатывать как надо, если выпадающее меню 
	//будет появляться над элементами с position: relative. Браузер будет считать 
	//что мышь вышла из родительского блока, и меню будет закрываться, хотя мышь
	// над дочерним пунктом меню.
function showSub(e) {
    if(this.children.length>1) {
        this.children[1].style.height = "auto";
        this.children[1].style.overflow = "visible";
        this.children[1].style.opacity = "1";
    } else {
        return false;
    }
}

function hideSub(e) {
    if(this.children.length>1) {
        this.children[1].style.height = "0px";
        this.children[1].style.overflow = "hidden";
        this.children[1].style.opacity = "0";
    } else {
        return false;
    }
}





//JQ

$(function () {	

	
//-----------------------Если сайт открыт на Тач-экране показывать меню аккордион вместо обычного	
	
	var myMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (myMobile.Android() || 
                    myMobile.BlackBerry() || 
                    myMobile.iOS() || 
                    myMobile.Opera() || 
                    myMobile.Windows());
        }
    };

    if( myMobile.any() ) {      
	  $('.menu').css("display", "none");
	  $('.menu-accordion').css("display", "block");	  
    }	
	
//------------------------Выпадающее меню для больших экранов
//Пункты меню
    var nav_elements = $('.navigation nav .menu-item a');                     
//Объект JQ с координатами от верха для  всех якорей
    var $offset_elements  = $(".anchor").map(function(indx, element){       
        return $(element).offset().top;
    });
	// Координаты якорей в массив
    var arr_coor = $offset_elements.get();          
//Координата смещения окна в момент загрузки страницы
    var $window_scroll = $(this).scrollTop(); 

//-----------------------------------Переход по якорям

    nav_elements.on("click", function (e) {        
        var selector = $(this).attr("href");
        var h = $(selector);

        $('html, body').animate({
            scrollTop: h.offset().top +50
        }, 1500);
    });
	
//------------------------Аккордион меню для маленьких экранов
	//Пункты меню
    var akk_elements = $('.afwp_accordion_nav_menu #afwp_accordion_nav_menu2 .menu-item a');             
	//Объект JQ с координатами от верха для  всех якорей
    var $offset_akk_elements  = $(".anchor").map(function(indx, element){       
        return $(element).offset().top;
    });
	// Координаты якорей в массив
    var arr_akk_coor = $offset_akk_elements.get();          

//-----------------------------------Переход по якорям для аккордион меню

    akk_elements.on("click", function (e) {       
        var selector = $(this).attr("href");
        var h = $(selector);

        $('html, body').animate({
            scrollTop: h.offset().top + 50
        }, 1500);
    });	

//---------------------------------Функция показа/скрытия кнопки "вверх"

    function calc_scrooll() {
        if($(this).scrollTop() >500) {
            $('.button_up').fadeIn()
        } else {
            $('.button_up').fadeOut()
        }
    }

//---------------------------------------------------------------кнопка "вверх"
	//   Показ/скрытие кнопки "вверх" при перезагрузке
    calc_scrooll();                             
	//   Отработка прокрутки страницы
    $(window).on('scroll', function () { 
          // Показ/скрытие кнопки "вверх" при прокрутке
        calc_scrooll();                            
        var window_scroll = $(this).scrollTop();        
    });

	//  Отработка клика по кнопке "вверх"
    $('.button_up').on('click', function () {      
        $('html, body').animate({
            scrollTop: 0
        }, 1000);
    });
	
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
	
//----------------Обработка Swipу (листание) на слайдере Автосигнализации
		
	var initialPoint;
	var finalPoint;	
	var count_input = 3;
	//назначаем обработчик на прикосновение к экрану		
	document.addEventListener('touchstart', function(event) {
			//начальные координаты пальца учавствующего в событии
		initialPoint=event.changedTouches[0];					    
	}, false);
	//назначаем обработчик на окончание прикосновения к экрану
	document.addEventListener('touchend', function(event) {			
		 //получаем объект DOM слайдер 
		var slider_section = document.getElementById("slider");    
		//получаем координаты слайдера относительно начала документа					
		var coord_slider = getCoords(slider_section);				
			
		//если двигаем по слайду
		if (initialPoint.pageY > coord_slider.top && initialPoint.pageY < coord_slider.bottom) { 	
			finalPoint=event.changedTouches[0];	
			//разница между прикосновениями по x
			var xAbs = Math.abs(initialPoint.pageX - finalPoint.pageX);    
			if (xAbs > 20) {				
				if (finalPoint.pageX < initialPoint.pageX){
						/*СВАЙП ВЛЕВО*/
					console.log('влево');
					if (count_input == 5){
						count_input = 1
					} else {
						count_input++;
					}
					console.log('count_input ' + count_input);
					
					var id_input = "s" + count_input;
					console.log('слайд ' + id_input);
					document.getElementById(id_input).checked=true;
					
				}
				else{
					/*СВАЙП ВПРАВО*/
					console.log('вправо');									
					if (count_input == 1){
						count_input = 5
					} else {
						count_input--;
					}
					console.log('count_input ' + count_input);
					
					var id_input = "s" + count_input;
					console.log(id_input);
					document.getElementById(id_input).checked=true;					
				}				
			}
		}
	}, false);
	
	//----------------Обработка Swipу (листание) на слайдере Автозвук
		
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

//При клике на кнопку Заказать в описании товара, у кнопки берется ее data атрибут
	//с названием товара и он будет отправлен в контактной форме скрытым полем 
	$('.btn_news').on('click', function(){
		//заголовок поста у которого нажали кнопку
	    var currentTitle = $(this).attr("data-title-service");
	    //Обрежем атрибут до названия если клик идет из блока новости, где в виджете можно получить
	    // title записи только как ссылку
	    var start = currentTitle.indexOf('bookmark">');
	    var end = currentTitle.indexOf('</a>');    
	    //если вхождения такой подстроки нет, тогда start = -1 - значит title чистый - без ссылки и можно не обрезать
	    if (start > 0) {
			var currentTitle = currentTitle.substring(start + 10, end);
	    };
	    //добавление нужного value полю кнопки    
	    $('#title-service').val(currentTitle);		   
	});


// Отслеживаем клик по кнопке "Добавить в избранное"/"Удалить из избранного"
	$('.simplefavorite-button').on('click', function () {  				
				//Записываем что написано на кнопке
				//"Удалить из избранного" или "Добавить в избранное"
				var inputValue = $(this).find('i').html(); 
				
				//Записываем значение количества "Избранного" написанное сейчас 
				//в "пузырке" у корзины
				var cartCount = $('.header_bottom_cart-cart-count').html();
				
				//если было написано "Удалить из избранного" уменьшаем "бублик" 
				//и записываем значение (и иначе аналогично)
				if (inputValue === '  Удалить из избранного') {
					$('.header_bottom_cart-cart-count').html(--cartCount);					
				} else {
					$('.header_bottom_cart-cart-count').html(++cartCount);					
				}
	});



//На странице "Избранное". Т.к. плагин подавляет стандартную реализацию события на кнопке 
//"удалить из избранного" отслеживаем клик по блоку со всеми избранными записями включая
//кнопку "Очистить избранное"и запускаем функцию demo
	$('.favourites').on('click', function (){			
			demo();			
	});

	//функция выполняется асинхронно основному потоку
	async function demo() {	
		//ждем после клика пока плагин сделает свои дела по удалению записи если пользователь
	  	//нажал на кнопку "Удалить из избранного"  
	  	await sleep(2000);
	  	//Считываем сколько записей записано в избранном
	 	var favouritesCount = $('.favourites__item').length;
	 	//Печатаем это в "бублик" у значка корзина
	 	$('.header_bottom_cart-cart-count').html(favouritesCount);
	};

	function sleep(ms) {
	  return new Promise(resolve => setTimeout(resolve, ms));
	};	
	
});

















