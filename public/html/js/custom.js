$(".nav-toggle").click(function () {
    if ($(".menu-mobile").hasClass("show-menu")) {
        $(".menu-mobile").removeClass("show-menu");
        $(".common-overlay").removeClass("show");
        $(".menu-mobile .has-sub__menu").removeClass("show-sub__menu");
    } else {
        $(".menu-mobile").addClass("show-menu");
        $(".common-overlay").addClass("show");
    }
});

$(".cancel-menu-mobile").click(function () {
    if ($(".menu-mobile").hasClass("show-menu")) {
        $(".menu-mobile").removeClass("show-menu");
        $(".common-overlay").removeClass("show");
        $(".menu-mobile .has-sub__menu").removeClass("show-sub__menu");
    }
});

$(".menu-mobile .has-sub__menu").click(function () {
    if ($(this).hasClass("show-sub__menu")) {
        $(this).removeClass("show-sub__menu");
    } else {
        $(this).addClass("show-sub__menu");
    }
});
