if(jQuery) (function($){
	
	var Pagebakery = {}
	
    $.extend(Pagebakery, {
        layout : function(options) {
            $(body).addClass('pb-base');
        }
    });
	
	$.extend($.fn, Pagebakery);
	
})(jQuery);