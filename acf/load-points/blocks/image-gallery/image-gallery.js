($ => {

	// function changeGallerySlideState() {
	// 	setTimeout(function(){
	// 		$('.gallery .slick-slide').removeClass('alive')
	// 		$('.gallery .slick-current').addClass('alive')
	// 		$('.gallery .slick-current').prev().addClass('alive')
	// 		if($(window).width() > 1400) {
	// 			$('.gallery .slick-current').next().addClass('alive')
	// 		}
	// 	}, 500)
	// }

	$(document).ready( () => {
		$('.gallery').slick({
			slidesToShow: 3,
			centerMode: true,
			infinite: true,
			centerPadding: '100px',
			prevArrow: '.gal-prev',
			nextArrow: '.gal-next',
			draggable: false,
			responsive: [
			    {
					breakpoint: 1400,
					settings: {
						slidesToShow: 2,
					}
			    },
			    {
					breakpoint: 920,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						centerMode: false,
						arrows: false,
						draggable: true,
						prevArrow: false,
						nextArrow: false,
					}
			    }
			]	

		});

		
		// changeGallerySlideState()
		// setSlideVisibility();
		reshapeGallery();
	})



	// $('.gal-prev, .gal-next').on('click', function(){
	// 	changeGallerySlideState()
	// })
	// $('.events_slider-container').on('swipe', function(event, slick, direction){
	// 	changeGallerySlideState()
	// });


	// function setSlideVisibility() {
	//   //Find the visible slides i.e. where aria-hidden="false"
	//   var visibleSlides = $('.gallery .slick-slide[aria-hidden="false"]');
	//   //Make sure all of the visible slides have an opacity of 1
	//   $('.gallery .slick-slide').removeClass('alive')
	//   $(visibleSlides).each(function() {
	//     $(this).addClass('alive');
	//   });
	  
	// }
	// $('.gallery').on('afterChange', function() { 
	//   setSlideVisibility();
	// });



	$(".gallery").on("afterChange", reshapeGallery);
	$(".gallery").on("breakpoint", reshapeGallery);
	$(".gallery").on("init", reshapeGallery);

	function reshapeGallery (event, slick) {
	  var slidesToShow = slick.slickGetOption("slidesToShow");

	  if (slidesToShow % 2 == 0) {
	    // Even number of slides in Slick Carousel is incorrectly offset.
	    // Adjust active slides.
	    slick["$slides"][slick.slickCurrentSlide()].previousElementSibling.classList.add("slick-active")
	    slick["$slides"][slick.slickCurrentSlide()].nextElementSibling.classList.remove("slick-active")
	  }
	}

})(jQuery);
