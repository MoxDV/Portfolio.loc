$(function () {
    /* Открывает закрывает меню */
    $('#menu-btn').click(function () {
        $('#menu').toggleClass('none');
    });

    // Показывает меню если ширина больше 510px
    function windowSize(){
        //$('.full-name').text($(window).width());
        if ($(window).width() >= '493'){
            $('#menu').removeClass('none');
        } else {
            $('#menu').addClass('none');

        }
    };
    windowSize();
    $(window).resize(windowSize);

    $('#menu').on('click', 'a', function (event) {
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1000);
        windowSize();
    });
});