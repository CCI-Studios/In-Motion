window.addEvent('domready', function () {
	var acc, togglers, elements, current;
	
	$$('#leftSidebar .moduletable_vmenu').each(function (menu) {
		togglers = menu.getElements('ul > li.parent > span');
 		elements = menu.getElements('ul > li.parent > span + ul');
	
		current = menu.getElement('ul > li.parent.active > span');
	
		acc = new Fx.Accordion(togglers, elements, {
			show: togglers.indexOf(current),
			opacity: true
		});
	});
});