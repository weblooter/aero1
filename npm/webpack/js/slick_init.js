(function($, undefined) {
	$(function() {
		if ($.fn.slick) {
			var fnSetCounter = function(event, slick, currentSlide, nextSlide) {
				var frames = Math.ceil(slick.slideCount / slick.options.slidesToScroll);
				var currentFrame = (nextSlide || 0) / slick.options.slidesToScroll + 1;
				var $counter = slick.$slider.prev(".counter");
				if (frames === 1) {
					$counter.hide();
					return;
				} else {
					$counter.show();
				}
				if (!$counter.length) {
					$counter = $("<div class=\"counter\" />").insertBefore(slick.$slider);
				}
				$counter.html("<span>" + currentFrame + "</span> / " + frames);
				//console.log(currentFrame, '/', frames, '(',nextSlide, '/', slick.slideCount , ':', slick.options.slidesToScroll, ')');
			};

			var $navContainer = $(".js-slider-video-nav .slide");
			var $indicatorsContainer = $(".js-slider-video-indicator .slide");
			var fnIndicator = function(event, slick, currentSlide, nextSlide) {
				var frames = Math.ceil(slick.slideCount / slick.options.slidesToScroll);
				var currentFrame = (nextSlide || 0) / slick.options.slidesToScroll;
				// console.log(frames, currentFrame);

				$navContainer.removeClass("active")
					.eq(currentFrame).addClass("active");
				$indicatorsContainer.removeClass("active")
					.eq(currentFrame).addClass("active");
			};


			// слайдер на главной
			$(".js-slider-video")
			.on("init beforeChange", fnIndicator)
			.slick({
				autoplay: true,
				autoplaySpeed: 20000,
				fade: true,
				arrows: false,
				pauseOnHover: false,
				speed: 500,
				responsive: [{
					breakpoint: 700,
					settings: {
						autoplaySpeed: 4000,
					}
				}
			]});
			$navContainer.on("click", function() {
				var index = $(this).index();
				console.log(index);
				$(".js-slider-video").slick("slickGoTo", index);
			});


			$(".js-slider-gallery")
			.slick({
				infinite: false,
				slidesToShow: 2,
				slidesToScroll: 1,
				responsive: [{
					breakpoint: 992,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 700,
					settings: {
						autoplay: true,
						autoplaySpeed: 6000,
						slidesToShow: 2,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 415,
					settings: {
						autoplay: true,
						autoplaySpeed: 6000,
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]});

			$(".js-slider-photo")
			.slick({
				infinite: false,
				slidesToShow: 1,
				slidesToScroll: 1
			});


			$('.js-slider-examples-works')
			.on("init beforeChange", fnSetCounter)
			.slick({
				infinite: false,
				slidesToShow: 3,
				slidesToScroll: 3,
				swipe: false,
				responsive: [{
					breakpoint: 992,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				},
				{
					breakpoint: 480,
					settings: {
						autoplay: true,
						autoplaySpeed: 6000,
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]});

			$(".js-slider-examples")
			.on("init beforeChange", function(event) { event.stopPropagation(); }) // отменяем срабатываение наружнего fnSetCounter
			.on("init reinit", function(event, slick) {
				slick.$slider.find(".twentytwenty-container[data-orientation!='vertical']").twentytwenty();
			})
			.slick({
				arrows: false,
				dots: true,
				fade: true,
				pauseOnHover: false,
				swipe: false,
			});



			$('.js-slider-news')
			.on("init", function(event, slick, currentSlide, nextSlide){
				if (slick.options.invert) {
					slick.goTo(slick.slideCount-slick.options.slidesToShow);
				}
			 })
			.slick({
				infinite: false,
				speed: 500,
				slidesToShow: 4,
				slidesToScroll: 1,
				invert: true,
				responsive: [{
					breakpoint: 992,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 700,
					settings: {
						invert: false,
						slidesToShow: 2,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 480,
					settings: {
						invert: false,
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]});

			//отзывы
			$('.js-slider-spec')
			.on("init beforeChange", fnSetCounter)
			.slick({
				infinite: false,
				slidesToShow: 3,
				slidesToScroll: 3,
				responsive: [{
					breakpoint: 740,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]});

			$(".js-tabs.specialists").on("tabChanged", function(event) {
				//console.log(event, "TAB: ", event.curTab, "BOX: ", event.curBox);
				event.curBox.find(".js-slider-spec").slick("resize");
			});

			$('.js-slider-reviews')
			.on("init beforeChange", fnSetCounter)
			.on("init", function(event, slick) {
				// разворачивает текст по кнопке "Подробнее"
				$(slick.$slides).each(function(){
					$(this).find(".more").toggleNext(".text", "active", "active");
				});
			})
			.slick({
				infinite: false,
				slidesToShow: 3,
				slidesToScroll: 3,
				responsive: [{
					breakpoint: 992,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				},
				{
					breakpoint: 600,
					settings: {
						autoplay: true,
						autoplaySpeed: 6000,
						swap: false, // чтобы проще тыкать в звёздочки
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]});


			$(".js-slider-with-nav").each(function(){
				var $self = $(this),
					$slider = $self.find(".js-slider-for"),
					$sliderNav = $self.find(".js-slider-nav");
				$slider.slick({
					arrows: false,
					fade: true,
					asNavFor: $sliderNav
				});
				$sliderNav.slick({
					slidesToShow: 6,
					slidesToScroll: 1,
					asNavFor: $slider,
					focusOnSelect: true
				});
			});


			$('.js-slider-company')
			.on("init beforeChange", fnSetCounter)
			.slick({
				infinite: false,
				slidesToShow: 6,
				slidesToScroll: 6,
				responsive: [{
					breakpoint: 1180,
					settings: {
						arrows: true,
						slidesToShow: 4,
						slidesToScroll: 4
					}
				},
				{
					breakpoint: 600,
					settings: {
						arrows: true,
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]});

			$(".js-slider-gal")	.slick({
				autoplay: true,
				autoplaySpeed: 6000,
				fade: true,
				infinite: true,
				pauseOnHover: false,
				slidesToShow: 1,
				slidesToScroll: 1,
			});

			$(".js-slider-consult")	.slick({
				infinite: false,
				fade: true,
				pauseOnHover: false,
				slidesToShow: 1,
				slidesToScroll: 1,
			});

			$('.catalogSlider').slick({
				infinite: false,
				slidesToShow: 4,
				slidesToScroll: 1,
				responsive: [{
					breakpoint: 992,
					settings: {
						slidesToShow: 3
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 2
					}
				},
				{
					breakpoint: 400,
					settings: {
						slidesToShow: 1
					}
				}
			]
			});


		} else {
			console.log("$.slick is not defined!");
		}
	}); // end $.ready()
})(jQuery); // end or closure