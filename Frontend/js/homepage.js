var tooltips = [];
function showTooltip(element, tooltipName) {
	if (!(tooltipName in tooltips)) {
		var currentUrl = window.location.href;
		var baseUrl = currentUrl.replace(/[/][^/]+$/, '');
		var tooltipUrl =  baseUrl + '/tooltips.php?tooltip=' + tooltipName;
		(function($){
			$(element).each(function(index, wrapped) {
				tooltips[tooltipName] = new Opentip(wrapped, { ajax: tooltipUrl, cache: true});
			});
			$(element).trigger('mouseover');
		}(jQuery));
	}
}

var tooltipsText = [];
function showTooltipText(element, text) {
	if (!(text in tooltipsText)) {
		(function($){
			$(element).each(function(index, wrapped) {
				tooltipsText[text] = new Opentip(wrapped, text);
			});
			$(element).trigger('mouseover');
		}(jQuery));
	}
}