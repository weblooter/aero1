/* jshint -W014*/
(function ($, ymaps, undefined) {
	var zoomLevel2Px = [156367.87, 78183.93, 39091.97, 19545.98, 9772.99, 4886.50, 2443.25, 1221.62, 610.81, 305.41, 152.70, 76.35, 38.18, 19.09, 9.54, 4.77, 2.39, 1.19, 0.60];

	var Coords = function (obj) {
		var self = this;
		self.lat = obj.lat;
		self.lng = obj.lng;
		self.getArray = function (delta) {
			if (!delta || delta.length !== 2) {
				delta = [0, 0];
			}
			return [self.lat + delta[0], self.lng + delta[1]];
		};
	};
	var RoutingMode = { Auto: "auto", Masstransit: "masstransit", Pedestrian: "pedestrian", Bycicle: "bycicle" };

	var defaultMapOptions = {
		mapSelector: "map",
		mapCenterCoords: new Coords({ lat: 55.7990, lng: 37.455678 }),
		mapZoom: 14,
		//markerIcon: './assets/img/metka.png',
		strokeColor: "#ff0000",
		strokeWidth: 3,
		strokeStyle: "solid", // dot, dash, solid ... https://tech.yandex.ru/maps/jsapi/doc/2.1/ref/reference/graphics.style.stroke-docpage/
		marker: {
			//123098, Москва, улица Рогова, 22к3
			mapCenterCoords: new Coords({ lat: 55.796845, lng: 37.455678 }),
			mapZoom: 14,
			markerCoords: new Coords({ lat: 55.796845, lng: 37.455678 }),
			markerTitle: 'Центр пластической хирургии',
			ballonText: '',
		},
		routes: [{
			// м. Щукинская
			from: new Coords({ lat: 55.808827, lng: 37.463772 }),
			mode: RoutingMode.Auto,
			mapZoom: 15,
			mapCenterCoords: new Coords({ lat: 55.803119774144015, lng: 37.45856142321778 })
			// strokeColor: "",
			// strokeWidth: "",
			// strokeStyle: "",
		}, {
			// м. Октябрьское поле
			from: new Coords({ lat: 55.793581, lng: 37.493317 }),
			mode: RoutingMode.Auto,
			mapZoom: 14,
			mapCenterCoords: new Coords({ lat: 55.79439279639106, lng: 37.47156421691891 }),
			// strokeColor: "",
			// strokeWidth: "",
			// strokeStyle: "",
		}, {
			// на автомобиле от ТТК
			from: new Coords({ lat: 55.778426, lng: 37.458259 }),
			mode: RoutingMode.Auto,
			mapZoom: 14,
			mapCenterCoords: new Coords({ lat: 55.78880743794818, lng: 37.45504158715812 }),
			// strokeColor: "",
			// strokeWidth: "",
			// strokeStyle: "",
		}],
	};

	ymaps.ready(function () {
		var mapOptions = $.extend({}, defaultMapOptions, window.localizedMapOptions || {});
		var mapContainer = document.getElementById(mapOptions.mapSelector);
		// инициируем карту
		window.theMap = new ymaps.Map(mapContainer, {
			center: mapOptions.mapCenterCoords.getArray(),
			zoom: mapOptions.mapZoom,
		}, {
			suppressMapOpenBlock: true,
			yandexMapDisablePoiInteractivity: true,
		});
		// отключаем скролл
		theMap.behaviors.disable("scrollZoom");
		// удаляем все контроллы
		["searchControl", /*"zoomControl",*/ "rulerControl", "typeSelector", "geolocationControl", "fullscreenControl", /*"trafficControl"*/]
			.map(function (control) { theMap.controls.remove(control); });
		// делаем карту grayscale
		theMap.panes.get('ground').getElement().style.filter = 'grayscale(100%)';


		// добавляем все метки
		var points = [];
		var fnDrawMarker = function (markerOptions) {
			// инициируем метку
			var point = new ymaps.Placemark(
				markerOptions.markerCoords.getArray(),
				{
					hintContent: markerOptions.markerTitle,
				},
				{
					//preset: 'islands#grayGlyphIcon',
					//iconGlyph: 'Medical',
					//iconGlyphColor: 'gray',
					iconLayout: "default#image",
					iconImageHref: markerOptions.markerIcon || mapOptions.markerIcon,
					iconImageSize: [54, 61],
					iconImageOffset: [-15, -52],
				}
			);

			// добавляем метку
			theMap.geoObjects.add(point);
			points.push(point);
		};
		fnDrawMarker(mapOptions.marker);

		var currentRoute = null;
		var fnDrawRoute = function (routeOptions) { // функция добавления маршрутов к метке по заданным параметрам
			// центруем и зуммируем карту в метку
			theMap.setZoom(routeOptions.mapZoom);
			theMap.setCenter(routeOptions.mapCenterCoords.getArray());

			// var mapBounds = theMap.getBounds();
			// var mapHeight = mapContainer.clientHeight;
			// var $contactsBox = $(".js-map-tabs .box.active");
			// вычисляем разницу между координатами, по пропорции высчитываем видимую область и делим пополам.
			// var deltaCoords = (window.innerWidth <= 992)
			// 	? [(mapBounds[0][0] - mapBounds[1][0]) / mapHeight * ($contactsBox.outerHeight() || 0) / 2, 0]// для мобильных устройств
			// 	: [0, -(mapBounds[0][0] - mapBounds[1][0]) / mapHeight * ($contactsBox.outerWidth() || 0) / 2];// для десктопов остальных
			// затем делаем сдвиг
			//console.log(deltaCoords, markerOptions.mapCenterCoords.getArray(), markerOptions.mapCenterCoords.getArray(deltaCoords))
			// theMap.setCenter(markerOptions.mapCenterCoords.getArray(deltaCoords));

			// удаляем старые маршруты, если были
			if (currentRoute) {
				theMap.geoObjects.remove(currentRoute);
				currentRoute = null;
			}
			if (!routeOptions) {
				return;
			}

			var fnDrawPolilyne = function (routePathCoords) {
				// из массива координат строим ломаунную лииню...
				currentRoute = new ymaps.Polyline(routePathCoords, {}, {
					strokeColor: routeOptions.strokeColor,
					strokeWidth: routeOptions.strokeWidth || mapOptions.strokeWidth,
					strokeStyle: routeOptions.strokeStyle || mapOptions.strokeStyle,
				});
				// и добавляем ломанную на карту
				theMap.geoObjects.add(currentRoute);
			};

			// запрашиваем маршрут от заданной точки начала до текущей метки
			if (!routeOptions.routePathCoords) {
				console.log("load");
				var multiRoute = new ymaps.multiRouter.MultiRoute(
					{
						referencePoints: [routeOptions.from.getArray(), mapOptions.marker.markerCoords.getArray()],
						params: {
							routingMode: routeOptions.mode,
							results: 1,
						}
					},
					{ boundsAutoApply: false, }
				);
				multiRoute.model.events.add("requestsuccess", function (event) {
					routeOptions.routePathCoords = [];
					if (routeOptions.prePoint !== undefined) {
						routePathCoords.push(routeOptions.prePoint.getArray());
					}
					// разбираем полученный маршрут на сегменты, а сегменты - на координаты...
					multiRoute.getRoutes().get(0).getPaths().get(0).getSegments().each(function (segment) {
						var segmentCoords = segment.geometry.getCoordinates();
						// координаты объединяем в массив...
						segmentCoords.map(function (coordsPair) {
							// повторяющиеся координаты пропускаем
							if (routeOptions.routePathCoords.indexOf(coordsPair) === -1) {
								routeOptions.routePathCoords.push(coordsPair);
							}
						});
					});
					fnDrawPolilyne(routeOptions.routePathCoords);
				});
			} else {
				fnDrawPolilyne(routeOptions.routePathCoords);
			}
		};

		$(".js-map-tabs").on("tabChanged", function (event) {
			var routeOptions = mapOptions.routes[event.curTab.index()];
			fnDrawRoute(routeOptions);
		}).tabs({
			dataTabIndex: "mapIndex",
			activateFirst: true,
			active: "active current-menu-item",
		});
	});
})(jQuery, ymaps);