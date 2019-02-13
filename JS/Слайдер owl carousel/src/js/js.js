$(document).ready(function(){
    $(".owl-carousel").owlCarousel({
        nav: true,
        loop:true,
        margin: 10,
        center:true,
        responsiveClass:true,
        responsive: {
            0:{
                items: 1,
                nav: true
            },
            400:{
                items: 2,
                nav: true
            },
            600:{
                items: 3,
                nav: true
            },
            900:{
                items:4,
                nav: true
            }

        }

    });

    /**
     * Проставляет всем елементам слайдера одинаковую высоту взятую по большему слайду
     */

    function offset () {
        var $elem = $('.owl-item');
    //--------------------------Находим высоту самого высокого слайда
        var maxheight =  0;
        $elem.each(function(indx, element){
            if ($(element).outerHeight() > maxheight){
                maxheight = $(element).outerHeight()
            }
            $elem.css('min-height', maxheight + 'px');                  
        });
    }
//-------------------Выравниваем слайды при загрузке
     offset();
//-------------------Выравниваем слайды при изменении размеров экрана
    $(window).resize(function(){
        offset();
    });
    $(window).resize();
});



