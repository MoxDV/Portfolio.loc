$(function () {
    /* Открывает/закрывает меню */
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


    // Меняем активный пункт в списке сайдбара при скролле
    function onActiveMenu() {
        var $sections = $('.section');
        $sections.each(function(i,el){
            var top  = $(el).offset().top-100;
            var bottom = top +$(el).height();
            var scroll = $(window).scrollTop();
            var id = $(el).attr('id');
            if( scroll > top && scroll < bottom){
                $('nav a.active').removeClass('active');
                $('nav a[href="#'+id+'"]').addClass('active');

            }
        })
    }
    onActiveMenu();
    jQuery(window).scroll(function(){ onActiveMenu(); });

    // Плавный переход по странице
    $('.link').click(function (event) {
        // исключаем стандартную реакцию браузера
        event.preventDefault();
        // получем идентификатор блока из атрибута href
        var id  = $(this).attr('href'),
            // находим высоту, на которой расположен блок
            top = $(id).offset().top;

        $('body,html').animate({scrollTop: top}, 1000);
    })
});