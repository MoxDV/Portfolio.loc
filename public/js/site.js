$(function () {
    /* Открывает закрывает меню */
    $('#menu-btn').click(function () {
        $('#menu').toggleClass('none');
    });

    // Показывает меню если ширина больше 510px
    windowSize();
    function windowSize(){
        //$('.full-name').text($(window).width());
        if ($(window).width() >= '493'){
            $('#menu').removeClass('none');
        } else {
            $('#menu').addClass('none');

        }
    };
    $(window).resize(windowSize); // при изменении размеров
});