$(function () {

    //------------------таймер обратного отсчета----------

    function getTimeRemaining(endtime){
        var t = Date.parse(endtime) - Date.parse(new Date());
        var seconds = Math.floor( (t/1000) % 60 );
        var minutes = Math.floor( (t/1000/60) % 60 );
        var hours = Math.floor( (t/(1000*60*60)) % 24 );
        var days = Math.floor( t/(1000*60*60*24) );
        return {
            'total': t,
            'days': days,
            'hours': hours,
            'minutes': minutes,
            'seconds': seconds
        };
    }

    function initializeClock(id, endtime, isday){
        var clock = document.getElementById(id);
        if (isday) var daysSpan = clock.querySelector('.days');
        var hoursSpan = clock.querySelector('.hours');
        var minutesSpan = clock.querySelector('.minutes');
        var secondsSpan = clock.querySelector('.seconds');

        function updateClock(){
            var t = getTimeRemaining(endtime);
            if (isday) daysSpan.innerHTML = ('0' + t.days).slice(-2);
            hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
            minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
            secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
             if(t.total<=0){
                clearInterval(timeinterval);
            }
        }
        updateClock(); // чтобы избежать задержки
        var timeinterval = setInterval(updateClock,1000);
    }
    var deadline = '2019-05-09T10:00:00';
    initializeClock("mainSale", deadline, true);    //главная акция

    var deadline_lorem1 = new Date();              //Товар 1 (lorem1)
    deadline_lorem1.setHours(deadline_lorem1.getHours() + 5);
    initializeClock("lorem1", deadline_lorem1, false);

    var deadline_lorem2 = new Date();              //Товар 2 (lorem2)
    deadline_lorem2.setHours(deadline_lorem2.getHours() + 6);
    initializeClock("lorem2", deadline_lorem2, false);


    var deadline_lorem3 = '2018-05-20T07:00:00';       //Товар 3 (lorem3)
    initializeClock("lorem3", deadline_lorem3, false);

    var deadline_lorem4 = '2018-05-20T18:00:00';               //Товар 4 (lorem4)
    initializeClock("lorem4", deadline_lorem4, false);

    var deadline_lorem5 = '2018-05-20T13:00:00';              //Товар 5 (lorem5)
    initializeClock("lorem5", deadline_lorem5, false);






    //-----------------city selection-------------------

$('.select_menu').on('click', function () {
    $('.select_dropdown').fadeToggle();
})

$('.select_dropdown li').on('click', function () {
    var context = this;
    var vtext = $(context).text();
    $('.select_menu span').text(vtext);
    $('.select_dropdown').fadeToggle();
    $('.select_menu img').css('display', 'none');
})

    //-----------------Виджет VK------------------------
    function VK_Widget_Init(){
        document.getElementById('vk_groups').innerHTML = "";
        //var vk_height = document.getElementById('vk_widget').clientHeight;
        //var vk_width = document.getElementById('vk_widget').clientWidth;
        var vk_width = $("#vk_widget").innerWidth();
        var vk_height = $("#vk_widget").innerHeight();
        VK.Widgets.Group("vk_groups", {mode: 0, width: vk_width-20, height: vk_height-20}, 1);
    };
    window.addEventListener('load', VK_Widget_Init, false);
    window.addEventListener('resize', VK_Widget_Init, false);

 //--------Popup для корзины------------------
    var p = new Popup();
    var cart = document.querySelector('.account_cart-cart');
    cart.onclick = function () {
        p.open("Ваша корзина пуста!");
    }
    var close_cart = document.querySelector('.popup_content-close');
    close_cart.onclick = function () {
        p.close();
    }
  //-------------------------------------

    function Popup() {
        var popup = document.querySelector('.popup');
        var popup_content = document.querySelector('.popup_content-p');
        var content = this;
        this.open = function (content) {
            popup.style.display = "block";
            popup_content.innerHTML = content;

        }
        this.close = function (){
            popup.style.display = "none";
        }
    }
})




