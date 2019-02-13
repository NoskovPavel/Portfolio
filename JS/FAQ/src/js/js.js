$(function () {
    var que = $('.que');
    que.on('click', function () {
        var ans = $(this).next();
        $('.ans:visible').not(ans).slideUp(400);
        ans.slideToggle(400);
    })
})