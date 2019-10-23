import Axios from 'axios';
LocalCore.Client.Axios.setDefaultConfig(Axios);
LocalCore.Client.Axios.instance = Axios;

import Qs from 'qs';
LocalCore.Client.Qs.instance = Qs;

import Swal from "sweetalert2";
LocalCore.Client.Swal.instance = Swal;

import $ from 'jquery';
import './js/jquery-fix.js';
import 'imagesloaded';
import 'magnific-popup';
import 'jquery-mask-plugin';
import 'masonry-layout/dist/masonry.pkgd.min.js';
import './js/jquery.slick.min.js';
import './js/jquery.viewportchecker.js';
import './js/jquery.formstyler.js';
import './js/jquery.event.move.js';
import './js/jquery.twentytwenty.js';
import './js/jquery.liMarquee_leftOnly.js';
import './js/jquery.autocolumnlist.js';
import './js/jquery.maskedinput.min.js';
import './js/jquery.idm-tabs.js';

import './js/project.js';
import './js/menu.js';
import './js/slick_init.js';
import './js/viewportchecker_init.js';

import './css/jquery.jscrollpane.css';
import './css/sass/css.scss';

import './localJs/consult-short-form';
import './localJs/form-send-ask';
import './localJs/consult-free-consult';

export {
    $
};