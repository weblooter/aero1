/*jshint esversion: 6 */
import "tinyscrollbar";

(function ($, undefined) {
	/** Для каждого переданного блока создаёт разметку и вызывает tinyscrollbar
	 * <div class="scrollbar">
	 * 	<div class="track">
	 * 		<div class="thumb">
	 * 			<div class="end"></div>
	 * 		</div>
	 * 	</div>
	 * </div>
	 * <div class="viewport">
	 * 	<div class="overview">
	 * 	{{ CONTENT }}
	 * 	</div>
	 * </div>
	 * @param {object} argOptions - параметры tinyscrollbar, могут быть переданы явно или через data-options='{ JSON-объект }'
	 * @returns jQuery
	 */
	$.fn.tinyscrollbarWrapper = function (argOptions) {
		this.each(function () {
			var $self = $(this);
			if ($self.data("plugin_tinyscrollbar")) {
				return;
			}
			var options = argOptions || $self.data("options") || {};
			$self
				.children().wrapAll("<div class=\"viewport\"><div class=\"overview\"></div></div>").end()
				.prepend($("<div class=\"scrollbar\"><div class=\"track\"><div class=\"thumb\"><div class=\"end\"></div></div></div></div>"))
				.tinyscrollbar(options);
		});
		return this;
	};

	// $(function () {	});
})(jQuery); // end or closure
