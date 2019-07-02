(function($){
	$(function(){
		$(".post-gallery-wrap").slick({
            dots: false,
            vertical: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            //fade: true,
            speed: 1000,
            arrows: false,
            infinite: true,
        });  
	}) // End ready function
})(jQuery);