$(function () {

    var elements = document.querySelectorAll('.slider img');
    var length = elements.length;
    var i = 0;

    $('.next').on('click', function () {
        var show_elem = $('.slider .show');
        $(this).stop(true,true);
        if (i < length-1) {
            show_elem.animate({left: "-100%"}, 1000 ).removeClass('show');
            show_elem.next().css("left", "100%").animate({left: "0"}, 1000 ).addClass('show');
            i++;
        } else {
            show_elem.animate({left: "-100%"}, 1000 ).removeClass('show');
            elements[0].style.left = "100%";
            $(elements[0]).animate({left: "0"}, 1000 ).addClass('show');
            i = 0;
        }
    });

    $('.prev').on('click', function () {
        var show_elem = $('.slider .show');
        $(this).stop(true,true);
        if(i > 0){
            show_elem.animate({left: "100%"}, 1000 ).removeClass('show');
            show_elem.prev().css("left", "-100%").animate({left: "0"}, 1000 ).addClass('show');
            i--;
        } else {
            show_elem.animate({left: "100%"}, 1000 ).removeClass('show');
            elements[length-1].style.left = "-100%";
            $(elements[length-1]).animate({left: "0"}, 1000 ).addClass('show');
            i = length-1;
        }
    })

})



//console.log("1");