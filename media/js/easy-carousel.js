jQuery.noConflict();
jQuery(document).ready(function($) {
    var options = Joomla.getOptions('mod_easy_carousel', {});
    $('.easy-carousel').slick({
        infinite: true,
        slidesToShow: options.slidesToShow || 3,
        slidesToScroll: 1,
        autoplay: options.autoplay || true,
        autoplaySpeed: 3000,
        arrows: true,
        dots: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
});