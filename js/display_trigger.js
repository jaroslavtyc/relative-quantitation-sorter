$('input[class^="display_trigger_name_"]').each(function(index) {
	$(this).change(function(){
		displayTrigger(this);
	});
	$(this).change();
});

function displayTrigger(element) {
	element = $(element);
	var type = $(element).attr('type');
	var name = $(element).attr('name');
	$('input[type="' + type + '"][name="' + name + '"]').each(function(inputIndex) {
		var input = $(this);
		var textClasses = input.attr('class');
		var classes = [];
		if (textClasses.match(/\s/)) {
			classes = textClasses.split(/\s+/);
		} else {
			classes.push(textClasses);
		}
		var triggeringNamesSuffix = [];
		for (classIndex = 0; classIndex < classes.length; classIndex++) {
			if (classes[classIndex].match(/^display_trigger_name_/)) {
				triggeringNamesSuffix.push(classes[classIndex].replace(/^display_trigger_name_/, ''));
			}
		}
		for (nameIndex = 0; nameIndex < triggeringNamesSuffix.length; nameIndex++) {
			var revealedClassSelector = '.display_on_trigger_name_' + triggeringNamesSuffix[nameIndex];
			if ($(input).prop('checked') === true) {
				$(revealedClassSelector).show();
			} else {
				$(revealedClassSelector).hide();
			}
		}
	});
}