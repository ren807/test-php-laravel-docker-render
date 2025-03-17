require('./bootstrap');

import $ from 'jquery'
import 'slick-carousel';

$(document).ready(function() {
    let slideCount = $('.slick-slider div').length;

    $('.slick-slider').slick({
        autoplay: true,
        autoplaySpeed: 3000,
        dots: slideCount > 1,
        arrows: true,
        infinite: slideCount > 1,
        slidesToShow: 1,
        slidesToScroll: 1,
    });
});
