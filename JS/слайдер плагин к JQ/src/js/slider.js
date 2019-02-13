(function ($) {
    $.fn.mySlider = function (setting) {

        var options = $.extend({
            btnPrev: '',
            btnNext: '',
            auto: false,    //авто слайдер
            rate: 0
        }, setting);

        var i = 0;
        var slider = $(this);
         //запоминаем изначальную ширину и высоту
        var sliderWidth = slider.eq(0).width();      
        var sliderHeight = slider.eq(0).height();
        //флаг завершения предидущей анимации по клику
        var isRun = false;              

        function prev() {
            //скрыть
            if (isRun) {
                //если придидущая анимация не завершилась - новая не сработает
                return;              
            }   
            //чтобы началась первая
            isRun = true;          

            slider.eq(i)
                .animate({
                    width: 0
                }, 500);
            
            //фото которое на экране, шаг назад
            i--;    
            //если это была первая фотка и сзади ничего нет - берем последнюю     
            if (i < 0) {                
                i = slider.length - 1;  
            }

            // показать
            //при показе позиционируем элементы по правому нижнему краю
            slider.eq(i)            
                .css({
                    left: sliderWidth,        
                    top: sliderHeight         // можно еще  left: auto,
                })                                       // top: auto,       //в auto, т.к. они приоритетнее и перекрывают другие
                .animate({                               // right: 0,
                    width: '100%',                       // bottom: 0
                    left: 0,
                    top: 0
                }, 500, function () {
                    isRun = false;
                });

        }

        function next() {
            //скрыть
            if (isRun) {
                return;
            }
            isRun = true;

            slider.eq(i)
                .animate({
                    width: 0,
                    left: sliderWidth,
                    top: 0
                }, 500);

            i++;

            if (i >= slider.length) {
                i = 0;
            }

            // показать
            slider.eq(i)
                .css({
                    left: -sliderWidth,
                    top: sliderHeight
                })
                .animate({
                    width: '100%',
                    left: 0,
                    top: 0
                }, 500, function () {
                    isRun = false;
                });

        }

        $(options.btnPrev).on('click', function () {
            prev()
        });
        $(options.btnNext).on('click', function () {
            next()
        });

        if (options.auto){
           setInterval(function(){prev()}, options.rate);
        }
    };
})(jQuery);