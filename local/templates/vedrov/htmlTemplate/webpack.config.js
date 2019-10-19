/* jshint esversion: 6 */
const path = require('path');

module.exports = {
	mode: 'production',
  entry: {
		vendors: [ // список всех сторонних библиотек, используемыми на сайте - объединяются в отдельный бандл
			'jquery',
			'./js/jquery-fix.js', // делает jQuery видимым глобально
			'imagesloaded',
			'magnific-popup',
			'jquery-mask-plugin',
			'./node_modules/masonry-layout/dist/masonry.pkgd.min.js',
			'./js/jquery.slick.min.js',
			'./js/jquery.viewportchecker.js',
			'./js/jquery.formstyler.js',
			'./js/jquery.event.move.js',
			'./js/jquery.twentytwenty.js',
			'./js/jquery.liMarquee_leftOnly.js',
			'./js/jquery.autocolumnlist.js',
			'./js/jquery.maskedinput.min.js',
			'./js/jquery.idm-tabs.js',
		],
		app: [ // а здесь подключаются все рабочие скрипты, разработанные для проекта
			"./js/project.js",
			"./js/menu.js",
			"./js/slick_init.js",
			"./js/viewportchecker_init.js",
		],
	},
  output: {
    filename: '_[name].bundle.js', // как называть выходные файлы - _vendors.bundle.js и _app.bundle.js
    path: path.resolve(__dirname, 'js') // в какую папку выгружать - ./js
	},
};