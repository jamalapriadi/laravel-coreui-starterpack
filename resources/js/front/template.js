(function($) {
	//  Hide Loading Box (Preloader)
	function handlePreloader() {
		$('.preloader').delay(500).fadeOut(500);
    }
	
	//  Update Header Style + Scroll to Top
	function headerStyle() {
		if($('.main-header').length){
			var topHeader = $('.mainmenu-area').innerHeight();
			var windowpos = $(window).scrollTop();
			if (windowpos >= topHeader) {
				$('.scroll-to-top').fadeIn(300);
				$('.socmed-samping').fadeIn(300);
			} else {
				$('.scroll-to-top').fadeOut(300);
				$('.socmed-samping').fadeOut(300);
			}
		}
	}

    //  stickyHeader
	function stickyHeader () {
		if ($('.stricky').length) {
			var strickyScrollPos = 100;
			if($(window).scrollTop() > strickyScrollPos) {
				$('.stricky').removeClass('fadeIn animated');
		      	$('.stricky').addClass('stricky-fixed fadeInDown animated');
			}
			else if($(this).scrollTop() <= strickyScrollPos) {
				$('.stricky').removeClass('stricky-fixed fadeInDown animated');
		      	$('.stricky').addClass('slideIn animated');
			}
		};
	}

	// Scroll to top
    $(document).on("click",".scroll-to-top",function(){
        $('html, body').animate({
           scrollTop: 0
        }, 1000);
    })
    
	//scroll animated
	$('.page-scroll a').on('click', function (event) {
		var $anchor = $(this);
		$('html, body').stop().animate({
			scrollTop: $($anchor.attr('href')).offset().top
		}, 1500, 'easeInOutExpo');
		event.preventDefault();
	});

	$(window).on('scroll', function() {
		stickyHeader();
		headerStyle();
	});

})(window.jQuery);