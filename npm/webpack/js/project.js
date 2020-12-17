(function ($, undefined) {
	window.isSafari = (function () {
		var ua = navigator.userAgent.toLowerCase();
		return ua.match(/(webkit)[ \/]([\w.]+)/) && !ua.match(/(chrome)[ \/]([\w.]+)/);
	})();
	if (isSafari) {
		document.body.classList.add("safari");
	}
	/**
	 *  Скрипт выравнивает высоту передаваемых блоков по самому высокому из них
	 */
	$.fn.ravno = function () {
		var maxH = -1;
		var $cols = $(this).height("auto").each(function () {
			var h = $(this).height();
			maxH = (h > maxH) ? h : maxH;
		});
		$cols.height(maxH);
	};

	/**
	 * Скрипт по клику переключает состояние текущего и целевого объекта, навешивая на них класс active (или любой другой)
	 * @param {string|object} target Цель - может быть задана объектом jQuery или css-селектором
	 * @param {string} [selfClass='active'] - класс, навешиваемый на текущий объект при активации
	 * @param {string} [targetClass='active'] - класс, навешиваемый на целевой объект при активации
	 * @returns {object} jQuery-object
	*/
	$.fn.toggleTarget = function (target, selfClass, targetClass) {
		var $self = this,
			$target = typeof target === "object" ? target : $(target);

		// проверка параметров
		selfClass = selfClass || "active";
		targetClass = targetClass || "active";

		$self.on("click.toggleTarget", function (event) {
			event.preventDefault();
			if ($self.hasClass(selfClass) || $target.hasClass(targetClass)) {
				$self.removeClass(selfClass);
				$target.removeClass(targetClass);
			} else {
				$self.addClass(selfClass);
				$target.addClass(targetClass);
			}
			$(this).trigger("targetToggled", [$self.hasClass(selfClass)]);
		});
		return $self;
	};

	/**
	 * Скрипт делает блоки квадратными устанавливая высоту равной ширине
	 */
	$.fn.squareBox = function () {
		var $self = this;
		var width = $self.outerWidth();
		$self.css({ "height": width + "px" });

		return $self;
	};

	/// ГЛАВНЫЙ ОБРАБОТЧИК DOCUMENT.READY
	$(function () {
		//begin Ravno
		// уравниваем по высоте нужные блоки
		var fnRavno = function () {
			// First we get the viewport height and we multiple it by 1% to get a value for a vh unit
			var vh = window.innerHeight * 0.01;
			// Then we set the value in the --vh custom property to the root of the document
			document.documentElement.style.setProperty('--vh', vh + "px");

			$(".ravno").ravno();
			if (window.innerWidth > 700) {
				$(".blog .blog__item .image").ravno();
			}
			if (window.innerWidth > 992) {
				$(".reviewList .reviewList__item .reviewList__item__text").ravno();
			}
			$(".gallerySquare").each(function () {
				$(this).find(".gallerySquare__item a").squareBox();
			});

			/*if ($.fn.masonry) {
				$('.grid').masonry({
					//gutter: 15,
					columnWidth: '.grid__item',
					itemSelector: '.grid__item',
					percentPosition: true
				});
			} else {
				console.log("$.masonry is not defined!");
			}*/
			// video on main
			var $videos = $(".js-video video");
			if (window.innerWidth > 992) {
				$videos.trigger("play");
				if ($.browser && $.browser.safari) {
					$videos.show();
				}
			} else {
				$videos.trigger("pause");
				if ($.browser && $.browser.safari) {
					$videos.hide();
				}
			}

			var evHidePreloader = new Event("hidePreloader");
			document.body.dispatchEvent(evHidePreloader);
		};
		// активируем fnRavno после загрузки изображений (если подключена соответствующая библиотека), а также при ресайзе окна
		if ($.fn.imagesLoaded) {
			$("#body").imagesLoaded(fnRavno);
		} else {
			$(fnRavno);
		}
		$(window).on("resize", fnRavno);
		// end Ravno

		// Бегущая строка (логотипов партнёров)
		if ($.fn.liMarquee) {
			$('.js-slider-logos').imagesLoaded(function(){
				$('.js-slider-logos').liMarquee({
					direction: 'left',
					loop: -1,
					scrolldelay: 0,
					scrollamount: 50,
					circular: true,
					drag: true
				});
			});
		} else {
			console.log("$.liMarquee is not defined");
		}


		// Form styler
		if ($.fn.styler) {
			$('input, select').not(".styler-ignore").styler({
				selectSearch: true
			});
			$("label a").on("click", function (event) {
				event.stopPropagation();
			});
		} else {
			console.log("$.styler is not defined");
		}


		if ($.fn.autocolumnlist) {
			$('.col2').autocolumnlist({
				columns: 2,
				childSelector: "> p"
			});
		} else {
			console.log("$.autocolumnlist is not defined");
		}

		// body stick
		$(window).on("scroll", function () {
			var target = $(document.body),
				className = 'stickTop';
			if ((window.innerWidth > 992 && window.pageYOffset >= 120) || (window.innerWidth <= 992 && window.pageYOffset >= 50)) {
				target.addClass(className);
			} else {
				target.removeClass(className);
			}
		});

		// ToTop button
		$(window).on("scroll", function () {
			if ($(this).scrollTop() >= 1500) {
				$('#toTop').show();
			} else {
				$('#toTop').hide();
			}
		});
		$('#toTop').on("click", function () {
			$('body,html').animate({ scrollTop: 0 }, 800);
		});

		// LightBox
		if ($.fn.magnificPopup) {
			// Попап для форм (обратная связь и др.)
			$(".formOpener").magnificPopup({
				type: 'inline'
			});
			// Попап для текстовых блоков
			$(".textOpener").magnificPopup({
				type: 'inline',
				mainClass: 'mfp-text-group',
			});
			// Попап для одиночного изображения
			$(".magnific").magnificPopup({
				type: 'image'
			});
			// Попап для фотогалерей в новостях и т.п.
			$('.gallery').magnificPopup({
				delegate: ".gallery__item a",
				type: "image",
				mainClass: 'mfp-img-group',
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					titleSrc: "title"
				}
			});
			// Попап для видео на Youtube
			$(".js-video-popup").magnificPopup({
				type: 'iframe',
				markup: '<div class="mfp-iframe-scaler">' +
					'<div class="mfp-close mfp-close-wht"></div>' +
					'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
					'</div>',
				patterns: {
					youtube: {
						index: 'youtube.com/',
						id: 'v=',
						src: '//www.youtube.com/embed/%id%?autoplay=1'
					},
				},
			});
		} else {
			console.log("$.magnificPopup is not defined");
		}
		// end LightBox

		if ($.mask) {
			$("input.phone, .phone input").mask("+9 999 999-99-99");
		} else {
			console.log("$.mask is not defined!");
		}

		var savedScrollTop = 0;
		$(".js-open-callback-form, .js-close-callback-form")
			.toggleTarget("#callbackForm")
			.on("targetToggled", function (event, isActive) {
				if (isActive) {
					savedScrollTop = $(window).scrollTop();
					$(document.body).addClass("callbackFormActive").css("top", -savedScrollTop + "px");
				} else {
					$(document.body).removeClass("callbackFormActive").css("top", 0);
					$(window).scrollTop(savedScrollTop);
				}
			});
		// при клике ВНЕ #callbackForm - сворачиваем его
		$(document).on("click", function (event) {
			var $target = $(event.target);
			if ($("#callbackForm").hasClass("active") 
				&& !$target.closest("#callbackForm").length 
				&& !$target.is(".js-open-callback-form")
				&& !$target.is(".js-close-callback-form")
			) {
				$(".js-close-callback-form").trigger("click.toggleTarget");
			}
		});


		if ($.fn.tinyscrollbarWrapper) {
			$(".js-tinyscrollbar").tinyscrollbarWrapper();
		} else {
			console.log("$.tinyscrollbarWrapper is not defined!");
		}
		$(".js-open-geo-form, .js-close-geo-form")
			.toggleTarget("#selectCityForm")
			.on("targetToggled", function (event, isActive) {
				if (isActive) {
					savedScrollTop = $(window).scrollTop();
					$(document.body).addClass("selectCityFormActive").css("top", -savedScrollTop + "px");

					var $x = $(".js-tinyscrollbar");
					if ($x.length && $x.data("plugin_tinyscrollbar")) {
						$x.data("plugin_tinyscrollbar").update();
					}
				} else {
					$(document.body).removeClass("selectCityFormActive").css("top", 0);
					$(window).scrollTop(savedScrollTop);
				}
			});
		// при клике ВНЕ #selectCityForm - сворачиваем его
		$(document).on("click", function (event) {
			var $target = $(event.target);
			if ($("#selectCityForm").hasClass("active") 
				&& !$target.closest("#selectCityForm").length 
				&& !$target.is(".js-open-geo-form")
				&& !$target.is(".js-close-geo-form")
			) {
				$(".js-close-geo-form").eq(0).trigger("click.toggleTarget");
			}
		});

		// на странице прайс-листов - разворачиваем подробную таблицу ценообразования
		$(".price__link").each(function () {
			$(this).toggleTarget($(this).next(".price__text"));
		}).on("targetToggled", function (event, isActive) {
			// неактивные элементы сворачиваем
			if (isActive) {
				$(".price__link.active").not(this).each(function () {
					$(this).removeClass("active")
						.next(".price__text").removeClass("active");
				});
			}
		});
		// при клике ВНЕ .price__link и .price__text - сворачиваем их
		$(document).on("click", function (event) {
			var $target = $(event.target);
			if ($(".price__text.active").length && !$target.closest(".price__text.active").length && !$target.is(".price__link.active")) {
				$(".price__link.active").trigger("click.toggleTarget");
			}
		});


		// Проверка в фотогалерее - есть ли 18+
		var $confirmAge = $(".js-confirm-age"); // ссылка на блок запроса подтверждения 18+
		if ($confirmAge.length) {
			var isAgeConfirmed = JSON.parse(sessionStorage.getItem("AgeConfirmed")) || false; // проверяем в сессионном хранилище результат предыдущих проверок 18+
			if (isAgeConfirmed) {
				$confirmAge.remove();
			} else {
				$confirmAge.on("click", function (e) {
					e.preventDefault();
					e.stopPropagation();
					$confirmAge.find(".preview").hide().end().find(".text").addClass("active");
				});

				$confirmAge.find(".js-confirm-age-yes").on("click", function (e) {
					e.preventDefault();
					e.stopPropagation();
					isAgeConfirmed = true;
					sessionStorage.setItem("AgeConfirmed", true);
					$confirmAge.remove();
				});
				$confirmAge.find(".js-confirm-age-no").on("click", function (e) {
					e.preventDefault();
					e.stopPropagation();
					$confirmAge.find(".preview").show().end().find(".text").removeClass("active");
				});
			}
		}
	}); // end $.ready()
})(jQuery); // end or closure


