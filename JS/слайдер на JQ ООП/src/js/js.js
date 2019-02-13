$(function() {
    
    new Slider({
        images: '.gallery-1 img',
        btnPrev: '.gallery-1 .buttons .prev',
        btnNext: '.gallery-1 .buttons .next',
        auto: false
    });
    
	new Slider({
        images: '.gallery-2 img',
        btnPrev: '.gallery-2 .buttons .prev',
        btnNext: '.gallery-2 .buttons .next',
        auto: true,    //авто слайдер
        rate: 2000     // скорость авто прокрутки
    });
});

function Slider(obj) {
    
	this.images = $(obj.images);	
	this.auto = obj.auto;
	this.btnPrev = $(obj.btnPrev);
	this.btnNext = $(obj.btnNext);
    this.rate = obj.rate || 1000;
	
	var i = 0;
    
    var slider = this;
	sliderWidth = slider.images.eq(0).width();              //запоминаем изначальную ширину и высоту
	sliderHeight = slider.images.eq(0).height();
	
    var isRun = false;              //флаг завершения предидущей анимации по клику
	
	this.prev = function () {
        //скрыть
        if(isRun){
            return;              //если придидущая анимация не завершилась - новая не сработает
        }

        isRun = true;          //чтобы началась первая

        slider.images.eq(i)
            .animate({
                width: 0
            }, 500);

        i--;          //фото которое на экране, шаг назад

        if (i < 0) {
            i = slider.images.length - 1;          //если это была первая фотка и сзади ничего нет - берем последнюю
        }

        // показать
        slider.images.eq(i)
            .css({
                left: sliderWidth,        //при показе позиционируем элементы по правому нижнему краю
                top: sliderHeight         // можно еще  left: auto,
            })                                       // top: auto,       //в auto, т.к. они приоритетнее и перекрывают другие
            .animate({                               // right: 0,
                width: '100%',                       // bottom: 0
                left: 0,
                top: 0
            }, 500, function(){
                isRun = false;
            });

    };

    this.next = function () {
        //скрыть
        if(isRun){
            return;
        }
        isRun = true;

        slider.images.eq(i)
            .animate({
                width: 0,
                left: sliderWidth,
                top: 0
            }, 500);

        i++;

        if (i >= slider.images.length) {
            i = 0;
        }

        // показать
        slider.images.eq(i)
            .css({
                left: -sliderWidth,
                top: sliderHeight
            })
            .animate({
                width: '100%',
                left: 0,
                top: 0
            }, 500, function(){
                isRun = false;
            });

    }

	
    $(slider.btnPrev).on('click', function(){slider.prev();});
    $(slider.btnNext).on('click', function(){slider.next();});

    if (slider.auto){
        setInterval(slider.prev, slider.rate);
    }

}



