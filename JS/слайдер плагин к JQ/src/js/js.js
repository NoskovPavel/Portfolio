$(function() {

    $('.gallery-1 img').mySlider({
            btnPrev: '.gallery-1 .buttons .prev',
            btnNext: '.gallery-1 .buttons .next'
        });

    $('.gallery-2 img').mySlider({
        btnPrev: '.gallery-2 .buttons .prev',
        btnNext: '.gallery-2 .buttons .next',
        auto: true,
        rate: 2000
    });
});



