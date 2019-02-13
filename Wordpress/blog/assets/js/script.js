
$(function () {

    var nav_elements = $('li.menu-item-object-custom a');                     //Пункты меню
	
    var $offset_elements  = $(".anchor").map(function(indx, element){       //Объект JQ с координатами от верха для  всех якорей
        return $(element).offset().top;
    });

    var arr_coor = $offset_elements.get();          // Координаты якорей в массив

    var $window_scroll = $(this).scrollTop();       //Координата смещения окна в момент загрузки страницы




//-----------------------------------------------------------------Переход по якорям

    nav_elements.on("click", function (e) {
        e.preventDefault();                                     //отмена перехода по обычному якорю при включенном js
        

        var selector = $(this).attr("href");
        var h = $(selector);

        $('html, body').animate({
                scrollTop: h.offset().top 
            }, 2000);
    });

//	Отправка запроса из формы AJAX-ом 
	
	
	$('.flat-app-btn').on('click', function() {
		var data = {
			phone: $('input[name=phone]').val(),
			action: 'flatapp',
			flat_id: $('input[name=id_flat]').val(),
		};
		
		// обработка полученного ответа, в res - ответ 
		
		$.post(window.wp.ajax_url, data, function(res){
			if(res.success){
				alert('Ура!');
			} else {
				alert(res.err);
			}
			
		}, 'json');
		
	});
});



