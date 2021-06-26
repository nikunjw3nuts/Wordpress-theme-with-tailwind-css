/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/script.js ***!
  \********************************/
jQuery(document).ready(function () {
  var totalpost = jQuery('.totalpostcount').val();
  jQuery('.events_slider.ltr').owlCarousel({
    items: 5,
    loop: jQuery(".events_slider.ltr .evn_block").length > 4 && totalpost > 8 ? true : false,
    margin: 22,
    nav: false,
    dots: false,
    //autoplay: (jQuery(".events_slider.ltr .evn_block").length > 4) ? true: false,
    slideTransition: 'linear',
    smartSpeed: 1000,
    autoplayTimeout: 3000,
    autoplaySpeed: 3000,
    autoplayHoverPause: true,
    responsive: {
      768: {
        items: 3
      },
      992: {
        items: 4
      },
      1200: {
        items: 4
      },
      1400: {
        items: 5
      }
    }
  });
});
/******/ })()
;