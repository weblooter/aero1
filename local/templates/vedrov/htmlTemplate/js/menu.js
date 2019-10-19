(function($, undefined) {
	$(document).ready(function() {
		// разворачиваем/сворачиваем мобильное меню с сохранением позиции скролла
		var savedScrollTop = 0;
		$("#nav_dropdown")
			.toggleTarget("#nav_dropdown + .menuTop", "active", "nav-active")
			.on("targetToggled", function(event, isActive) {
				if (isActive) {
					savedScrollTop = $(window).scrollTop();
					$(document.body).addClass("dropdown-menu-active").css("top", -savedScrollTop + "px");
				} else {
					$(document.body).removeClass("dropdown-menu-active").css("top", 0);
					$(window).scrollTop(savedScrollTop);
				}
				$(this).find("+.menuTop li.clicked").removeClass("clicked");
			});

		// Скрипт для обработки TouchEVent по меню (для мобильных устройств)
		$(document).on("click", ".menuTop li", function(event) {
			event.stopPropagation();
			// На маленьком разрешении экрана, а также на устройствах с большим разрешением экрана и мультитачем
			// - при клике на li добавляем класс clicked, чтобы показать подменю.
			// Проверка на TouchEvent и maxTouchPoints необходима, т.к. Chrome даёт ложное поддерживание TouchEvent даже на десктопах!
			// (подразумеваем, что нормальные Touch-устройства имеют мультитач)
			if (window.innerWidth < 992 || (window.innerWidth >= 992 && (window.TouchEvent && navigator.maxTouchPoints > 1))) {
				var $self = $(this),
					$clicked = $(".menuTop li.clicked");
				// если li уже .clicked - выходим из функции и переходим по ссылке
				if ($self.is(".clicked")) {
					return;
				}
				// иначе, если есть li.clicked и он не является родителем текущего li - снимаем со старого li класс clicked
				if ($clicked.length) {
					$clicked.filter(function(i, e){
						return $(e).find($self).length === 0;
					}).removeClass("clicked");
				}
				// если у LI есть вложенное подменю и не установлен класс "clicked" 
				// тогда - разворачиваем вложенное меню
				// иначе - переходим по ссылке
				if ($self.find("> .submenu, > ul").length && !$self.hasClass("clicked") ) {
					event.preventDefault();
					$self.addClass("clicked");
				} 
			}
		});
		
		// при клике ВНЕ меню - сворачиваем его
		$(document).on("click", function(event) {
			var $target = $(event.target);
			if (!$target.is("#nav_dropdown") && !$target.closest(".menuTop").length) {
				if (window.innerWidth < 992 && $("#nav_dropdown").hasClass("active"))  {
					$("#nav_dropdown").trigger("click");
				}
				if (window.innerWidth >= 992 && (window.TouchEvent && navigator.maxTouchPoints > 1)) { 
					event.stopPropagation();
					$(".menuTop li.clicked").removeClass("clicked");
				}
			}
		});
	});
})(jQuery);