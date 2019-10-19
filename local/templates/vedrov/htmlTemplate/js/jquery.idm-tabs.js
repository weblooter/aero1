/*!
 * IDM Tabs plugin
 * Version: 1.0
 * Author: Aleksey Tsygankov
 */
/* global window, document, define, jQuery */
;(function(factory) {
	'use strict';
	if (typeof define === 'function' && define.amd) {
			define(['jquery'], factory);
	} else if (typeof exports !== 'undefined') {
			module.exports = factory(require('jquery'));
	} else {
			factory(jQuery);
	}
}(function($) {
	var IDMTabs = window.Tabs || {};
	IDMTabs = (function(){

		return function(element, settings) {
			var self = this;
		
			self.defaults = {
				tabs: ".tab",
				boxes: ".box",
				active: "active",
				dataTabIndex: "tabIndex",
				activateFirst: true,
				allowBidirectional: false,
				allowDeactivate: false,
			};
	
			self.options = $.extend({}, self.defaults, settings); // объединяем дефолтные и переданные настройки
			self.$tabsContainer = $(element);
			self.$tabs = self.$tabsContainer.find(self.options.tabs);
			self.$boxes = self.$tabsContainer.find(self.options.boxes);
			self.$items = self.$tabs.add(self.$boxes); // табы и боксы обрабатываются одинаково, поэтому объединяем
			
			// проверяем дата-аттрибуты
			if (self.$tabsContainer.data("forceTab")) {
				self.options.forceTab = self.$tabsContainer.data("forceTab");
			}
			
			self.init();
		};
	})();

	IDMTabs.prototype.init = function() {
		var self = this;
		self.$tabsContainer.on("click", self.options.tabs + (self.options.allowBidirectional ? ", " + self.options.boxes : ""), function() {
			self.showTab($(this).data(self.options.dataTabIndex));
		});

		// если включена соответсвующая опция - активируем выбранную или первую табу
		if (self.options.forceTab) {
			self.showTab(self.options.forceTab);
		} else  if (self.options.activateFirst) {
			var firstTabIndex = self.$tabs.eq(0).data(self.options.dataTabIndex);
			self.showTab(firstTabIndex);
		}
	};

	IDMTabs.prototype.getTabsFilter = function(targetTabIndex) {  // функция второго порядка
		var self = this;
		return function() { 
			return $(this).data(self.options.dataTabIndex) === targetTabIndex; 
		}; 
	};
	
	IDMTabs.prototype.getFilteredTabs = function(targetTabIndex, target) {  // функция второго порядка
		var self = this,
			fn = function() { 
				return $(this).data(self.options.dataTabIndex) === targetTabIndex; 
			};
		if (target === undefined) {
			return self.$items.filter(fn);
		} else {
			return target.filter(fn);
		}
	};

	IDMTabs.prototype.showTab = function(targetTabIndex){
		var self = this;
		var $item = self.getFilteredTabs(targetTabIndex);
		// если текущая таба активна
		if ($item.hasClass(self.options.active)) {
			// ... и её можно деактивировать - снимаем актив
			if (self.options.allowDeactivate) {
				$item.removeClass(self.options.active);
			} else {
				// do nothing
			}
		} else {
			// прячем все остальные табы
			self.$items.removeClass(self.options.active);

			// активируем выбранную табу
			var $curTab = self.getFilteredTabs(targetTabIndex, self.$tabs).addClass(self.options.active);
			var $curBox = self.getFilteredTabs(targetTabIndex, self.$boxes).addClass(self.options.active);

			// вызываем событие tabChanged на контейнере для передачи обработки другим комопнентам
			self.$tabsContainer.trigger({
				type: "tabChanged",
				curTab: $curTab,
				curBox: $curBox,
			});
		}
	};

	IDMTabs.prototype.hideTab = function(targetTabIndex){
		var self = this;
		var $item = self.getFilteredTabs(targetTabIndex);
		$item.removeClass(self.options.active);
	};

	$.fn.tabs = function() {
		var _ = this,
			opt = arguments[0],
			args = Array.prototype.slice.call(arguments, 1),
			l = _.length,
			i,
			ret;
		for (i = 0; i < l; i++) {
			if (typeof opt == 'object' || typeof opt == 'undefined') {
				_[i].tabs = new IDMTabs(_[i], opt);
			} else {
				ret = _[i].tabs[opt].apply(_[i].tabs, args);
			}
			if (typeof ret != 'undefined') {
				return ret;
			}
		}
		return _;
	};
}));
// end $.fn.tabs