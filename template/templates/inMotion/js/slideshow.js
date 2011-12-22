window.addEvent('domready',  function() {
	$$('.slideshow').each(function (slideshow) {
		var slides = slideshow.getElements('.slides li'),
			duration = 400,
			delay = 5000,
			current = 0,
			nextButton = slideshow.getElement('.next'),
			prevButton = slideshow.getElement('.prev'),
			timer = null;
			
		nextButton.addEvent('click', function() {
			next();
		});
		
		prevButton.addEvent('click', function() {
			prev();
		});
			
		slides.set('morph', {
			duration: duration,
			onComplete: function () {
				slides.removeClass('active');
				this.element.addClass('active');
				this.element.setStyle('z-index', null);
			}
		});
		
		next = function() {
			current = current + 1;
			if (current == slides.length)
				current = 0;
				
			showSlide(current);
		};
		
		prev = function() {
			current = current - 1;
			if (current == -1)
				current = slides.length - 1;
				
			showSlide(current);
		};
		
		showSlide = function (index) {
			clearTimeout(timer);
			
			slide = slides[index];
			
			slide.setStyles({
				'z-index': 3,
				'opacity': 0
			});
			
			slide.morph({
				'opacity': 1
			});
			
			timer = next.delay(delay);
		};
		
		
		timer = next.delay(delay);
	});
});