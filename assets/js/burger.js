$(document).ready(function () {
  $(".menu-burger__header").click(function () {
    $(".menu-burger__header").toggleClass("open-menu");
    $(".header__nav").toggleClass("open-menu");
    $("body").toggleClass("noscroll");
  });
  $(".nav-a").click(function (e) {
        $(".menu-burger__header").removeClass("open-menu");
        $(".header__nav").removeClass("open-menu");
        $("body").removeClass("noscroll");
  });
});
