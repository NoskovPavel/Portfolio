$(function () {

    var nav_elements = $('nav a');                     //Пункты меню

    var $offset_elements  = $("section div div").map(function(indx, element){       //Объект JQ с координатами от верха для  всех якорей
        return $(element).offset().top;
    });

    var arr_coor = $offset_elements.get();          // Координаты якорей в массив

    var $window_scroll = $(this).scrollTop();       //Координата смещения окна в момент загрузки страницы



//--------------------------------Функця подсветки нужного пункта меню. Параметр - при скроллинге или загрузке
     function elem_active(el_scroll){
        var j = 0;                                      //счетчик
        for(var i = 0; i < arr_coor.length; i++) {
            if ((el_scroll + 150) > arr_coor[i+1]) {      //нахождение порядкового номера нужного пункта меню
                j++;
            } else {break;}                                     //выход как нашли
        }
        nav_elements.removeClass().get(j).className = 'active';     //подсветка
    }

//---------------------------------Функция показа/скрытия кнопки "вверх"

    function calc_scrooll() {
        if($(this).scrollTop() >500) {
            $('.button').fadeIn()
        } else {
            $('.button').fadeOut()
        }
    }


//----------------------------Подсветка пункта меню соответствующего просматриваемой области при перезагрузке страницы

    elem_active($window_scroll);


//---------------------------------------------------------------кнопка "вверх"

    calc_scrooll();                             //   Показ/скрытие кнопки "вверх" при перезагрузке

     $(window).on('scroll', function () {       //   Отработка прокрутки страницы
         calc_scrooll();                            // Показ/скрытие кнопки "вверх" при прокрутке
         var window_scroll = $(this).scrollTop();
         elem_active(window_scroll);                    //  Подсветка нужного пункта меню при прокрутке страницы
    });
     

    $('.button').on('click', function () {      //  Отработка клика по кнопке "вверх"
        $('html, body').animate({
            scrollTop: 0
        }, 1000);
    });

//-----------------------------------------------------------------Переход по якорям

    nav_elements.on("click", function (e) {
        e.preventDefault();                                     //отмена перехода по обычному якорю при включенном js
        nav_elements.removeClass('active').filter(this).addClass('active');

        var selector = $(this).attr("href");
        var h = $(selector);

        $('html, body').animate({
                scrollTop: h.offset().top - 80
            }, 1000);
    });

});



