

$(document).ready(function() {
   new Swiper('.event-slider', {
		// autoplay: {
		// 	delay: 2000,
		// },
		slidesPerView:1,
		spaceBetween: 15,
		watchOverflow: true,
		navigation: {
			nextEl: " .swiper-button-next.event-next",
			prevEl: ".swiper-button-prev.event-prev",
		},

		breakpoints: {
			320: {
				slidesPerView: 1,
			},
			767: {
				slidesPerView: 2,
			},

			1024: {
				slidesPerView: 3,
			},
		}
	});

	new Swiper('.miami-slider', {
		// autoplay: {
		// 	delay: 2000,
		// },
		slidesPerView:1,
		spaceBetween: 15,
		watchOverflow: true,
		navigation: {
			nextEl: " .swiper-button-next.miami-next",
			prevEl: ".swiper-button-prev.miami-prev",
		},

		breakpoints: {
			320: {
				slidesPerView: 1,
			},
			767: {
				slidesPerView: 2,
			},

			1024: {
				slidesPerView: 3,
			},
		}
	});

	new Swiper('.tab-slider', {
		// autoplay: {
		// 	delay: 2000,
		// },
		slidesPerView:1,
		spaceBetween: 15,
		watchOverflow: true,
		navigation: {
			nextEl: ".swiper-button-next.tab-next",
			prevEl: ".swiper-button-prev.tab-prev",
		},

		breakpoints: {
			767: {
				slidesPerView: 1,
			},

			1024: {
				slidesPerView: 2,
			},
		}
	});

	new Swiper('.boat-slider', {
		// autoplay: {
		// 	delay: 2000,
		// },
		slidesPerView:1,
		spaceBetween: 0,
		watchOverflow: true,
		navigation: {
			nextEl: ".swiper-button-next.boat-next",
			prevEl: ".swiper-button-prev.boat-prev",
		},

		breakpoints: {
			1024: {
				slidesPerView: 1,
			},
		}
	});

	    $('.tabs li:first-child ').addClass('active')
		$('.tabs li a').click(function(e) {
		  e.preventDefault();
		  $('.tabs li').removeClass('active')

		  var tabId = $(this).attr('href');
		  $('.tab-panel').removeClass('active');
		  $(tabId).addClass('active');
		  $('.tabs li').removeClass('active');
		  $(this).parent().addClass('active');
		});

		$(".accordion-item").find(".accordion-content").hide();
		$(".accordion-item:first-child").find(".accordion-content").show();
		$(".accordion-item:first-child").addClass("active");
		// Listen for clicks on accordion items
		$(".accordion-head").click(function () {
			var accordionItem = $(this).parent();
			if (accordionItem.hasClass("active")) {
				accordionItem.removeClass("active");
				accordionItem.find(".accordion-content").slideUp();
			} else {
				$(".accordion-item").removeClass("active");
				$(".accordion-content").slideUp();
				accordionItem.addClass("active");
				accordionItem.find(".accordion-content").slideDown();
			}
	
		});

		$('.switch').toggleClass('add');
		$('.switch').click(function(){
			$('.weather-list').toggleClass('active')
		})
  
		!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');

		
			
			  
});
 
