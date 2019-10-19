import 'jquery';
(function($, undefined) {
	$(function() {
		if (window.innerWidth > 992) {
		$('.post').addClass("hidden").viewportChecker({
			classToAdd: 'visible animated fadeIn',
			classToRemove: 'hidden'
		});
		$('.post-left').addClass("hidden").viewportChecker({
			classToAdd: 'visible animated fadeInLeft',
			classToRemove: 'hidden'
		});
		$('.post-right').addClass("hidden").viewportChecker({
			classToAdd: 'visible animated fadeInRight',
			classToRemove: 'hidden'
		});
		$('.post-down').addClass("hidden").viewportChecker({
			classToAdd: 'visible animated fadeInDown',
			classToRemove: 'hidden'
		});
		$('.post-up').addClass("hidden").viewportChecker({
			classToAdd: 'visible animated fadeInUp',
			classToRemove: 'hidden'
		});
		/*$('.services-zoom').addClass("hidden").viewportChecker({
			classToAdd: 'visible animated zoomIn sequentialChild',
			classToRemove: 'hidden'
		});*/
		$('.advantages ul').addClass("hidden").viewportChecker({
			classToAdd: 'visible animated zoomIn sequentialChild',
			classToRemove: 'hidden'
		});
		/*$('.descripsion').addClass("hidden").viewportChecker({
			classToAdd: 'visible animated zoomIn sequentialChild',
			classToRemove: 'hidden'
		});*/
		$('.square').addClass("hidden").viewportChecker({
			classToAdd: 'visible animated zoomIn sequentialChild',
			classToRemove: 'hidden'
		});
		$('.fadeup').addClass("hidden").viewportChecker({
			classToAdd: 'visible animated fadeInUp sequentialChild',
			classToRemove: 'hidden'
		});
	}
	}); // end $.ready()
})(jQuery); // end or closure