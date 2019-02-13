$(function(){
  //----------------Увеличение картинок при клике
    $('.minimized').click(function(event) {
      var i_path = $(this).attr('src');
      $('body').append('<div id="overlay"></div><div id="magnify"><img src="'+i_path+'"><div id="close-popup"><i></i></div></div>');
      $('#magnify').css({
          left: ($(document).width() - $('#magnify').outerWidth())/2,
          // top: ($(document).height() - $('#magnify').outerHeight())/2 upd: 24.10.2016
              top: ($(window).height() - $('#magnify').outerHeight())/2
        });
      $('#overlay, #magnify').fadeIn('fast');
    });  
  /*Скрытие картинок*/  
    $('body').on('click', '#close-popup, #overlay', function(event) {
      event.preventDefault();   
      $('#overlay, #magnify').fadeOut('fast', function() {
        $('#close-popup, #magnify, #overlay').remove();
      });
    });  

  //-----------------------------------Переход по якорям
    var nav_elements = $('.header__nav ul li a');
    nav_elements.on("click", function (e) {        
        var selector = $(this).attr("href");
        var h = $(selector);

        $('html, body').animate({
            scrollTop: h.offset().top
        }, 1500);
    });  

  //---------------------------------Функция показа/скрытия кнопки "вверх"

    function calc_scrooll() {
        if($(this).scrollTop() > 500) {
            $('.button').fadeIn()
        } else {
            $('.button').fadeOut()
        }
    }

  
//   Показ/скрытие кнопки "вверх" при перезагрузке
    calc_scrooll();                             

    //   Отработка прокрутки страницы
    $(window).on('scroll', function () {
        // Показ/скрытие кнопки "вверх" при прокрутке
        calc_scrooll();  
        //Прокрутка окна                          
        var window_scroll = $(this).scrollTop(); 
         console.log(window_scroll);
        //Показ элемента при прокрутке до него
        if(window_scroll > 250) { 
          animateCss('#about__title', 'animated fadeInDown'); 
        };
        if (window_scroll > 350){
          animateCss('#section__my-foto', 'animated fadeInLeft'); 
          animateCss('#section__info', 'animated fadeInRight');
        };
        if (window_scroll > 800){
          animateCss('.service__title', 'animated fadeInDown');           
        };
        if (window_scroll > 900){
          animateCss('.service__slider', 'animated fadeInLeft'); 
        };
        if (window_scroll > 1300){
          animateCss('.portfolio__title', 'animated fadeInDown'); 
        };
        if (window_scroll > 1500){
          animateCss('.portfolio__content', 'animated fadeInRight'); 
        };
        if (window_scroll > 2000){
          animateCss('#contact__title', 'animated fadeInDown'); 
        };
        if (window_scroll > 2100){
          animateCss('#contact__content', 'animated fadeInLeft'); 
        };

    });

//  Отработка клика по кнопке "вверх"
    $('.button').on('click', function () {      
        $('html, body').animate({
            scrollTop: 0
        }, 1000);
    });

    //Анимация на элементе
    function animateCss(element, animationName) {
      const node = $(element);
      node.css('opacity', '1').addClass(animationName); 
    }
      
});