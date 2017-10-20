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

    // Отмечает активный раздел меню
    var menu_selector = "#menu";
    function onScroll(){
        var scroll_top = $(document).scrollTop();
        $(menu_selector + " a").each(function(){
            var hash = $(this).attr("href");
            var target = $(hash);
            if (target.position().top <= scroll_top && target.position().top + target.outerHeight() > scroll_top) {
                $(menu_selector + " a.active").removeClass("active");
                $(this).addClass("active");
            } else {
                $(this).removeClass("active");
            }
        });
    }
    onScroll();
    $(document).on("scroll", onScroll);
    $("a[href^=#]").click(function(e){
        e.preventDefault();

        $(document).off("scroll");
        $(menu_selector + " a.active").removeClass("active");
        $(this).addClass("active");
        var hash = $(this).attr("href");
        var target = $(hash);

        $("html, body").animate({
            scrollTop: target.offset().top
        }, 500, function(){
            window.location.hash = hash;
            $(document).on("scroll", onScroll);
        });

    });
});