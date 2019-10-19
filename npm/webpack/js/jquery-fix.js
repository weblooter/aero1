/* jshint esversion: 6 */

/* Makes jQuery available in global */
var $ = require("jquery");
console.log(`jQuery ${$.fn.jquery} is loaded`);
window.$ = $;
window.jQuery = $;
