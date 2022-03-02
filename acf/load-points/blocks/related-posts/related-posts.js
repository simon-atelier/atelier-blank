($ => {

function mobileOnlyPostSlider() {
	$('.related-slides').slick({
		arrows: false,
		dots: false,
		infinite: false
	});
}
if(window.innerWidth < 920) {
	mobileOnlyPostSlider();
}

		
$(document).ready( () => {
	$(window).resize(function(e){
	    if(window.innerWidth < 920) {
	        if(!$('.related-slides').hasClass('slick-initialized')){
	            mobileOnlyPostSlider();
	        }
	    }else{
	        if($('.related-slides').hasClass('slick-initialized')){
	            $('.related-slides').slick('unslick');
	        }
	    }
	});
})

})(jQuery);