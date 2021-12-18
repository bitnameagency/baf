$(document).ready(function() {
	/*Toaster Alert*/
	$.toast({
		heading: '{{ $title }}',
		text: '<p>{{ $text }}</p>',
		position: 'top-right',
		loaderBg:'#3a55b1',
		class: 'jq-toast-primary',
		hideAfter: 3500, 
		stack: 6,
		showHideTransition: 'fade'
	});
	
	/*Owl Carousel*/
	$('#owl_demo_1').owlCarousel({
		items: 1,
		animateOut: 'fadeOut',
		loop: true,
		margin: 10,
		autoplay: true,
		mouseDrag: false,
		dots:false

	});
});
