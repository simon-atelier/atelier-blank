($ => {

function mobileOnlySlider() {
	$('.small-slides').slick({
		arrows: false,
		dots: false,
		infinite: false
	});
}
if(window.innerWidth < 920) {
	mobileOnlySlider();
}

		
$(document).ready( () => {
	$(window).resize(function(e){
	    if(window.innerWidth < 920) {
	        if(!$('.small-slides').hasClass('slick-initialized')){
	            mobileOnlySlider();
	        }

	    }else{
	        if($('.small-slides').hasClass('slick-initialized')){
	            $('.small-slides').slick('unslick');
	        }
	    }
	});
})

})(jQuery);

		