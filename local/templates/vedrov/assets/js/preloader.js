(function(storageKey, timeout){
	// Скрипт отображения экрана предзагрузки. одноразовый.
	var divPreloader = document.getElementById('preloader');
	var oneTimeOnly = divPreloader.dataset.oneTimeOnly !== "false";
	var hidePreloader = (oneTimeOnly && JSON.parse(localStorage.getItem(storageKey))) || false;

	if (hidePreloader) {
		divPreloader.remove();
	} else {
		divPreloader.style.display = 'flex';
		
		var allowHideByTimeout = false;
		var allowHideByTrigger = false;
		var fnHide = function() {
			divPreloader.style.transition = 'none';
			divPreloader.style.animationDuration = '2s';
			divPreloader.classList.add("animated", "fadeOut");

			if (oneTimeOnly !== false) {
				localStorage.setItem(storageKey, true);
			}
			setTimeout(function() { divPreloader.remove(); }, 2000);
		};

		setTimeout(function() { 
			allowHideByTrigger = true;
			// console.log("timeout hidePreloader");
			if (allowHideByTimeout) {
				fnHide();
			}
		}, timeout);

		document.body.addEventListener("hidePreloader", function(){
			allowHideByTimeout = true;
			// console.log("trigger hidePreloader");
			if (allowHideByTrigger) {
				fnHide();
			}
		});
	}
}("hidePreloader", 4500));