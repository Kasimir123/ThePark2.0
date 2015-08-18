//Initialize materialize
(function($){
  $(function(){

	$('.button-collapse').sideNav();
	$('.parallax').parallax();

  }); // end of document ready
})(jQuery); // end of jQuery name space

//Initialize masonry
$(document).ready( function() {
	$('.grid').masonry({
	itemSelector: '.grid-item',
	columnWidth: 160,
	isFitWidth: true,
	gutter: 10
	});
});
