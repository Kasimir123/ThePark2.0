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

//Initialize modals
$(document).ready(function(){
	$('.modal-trigger').leanModal();
});

//Custom options for dropdown menus
$('.dropdown-button').dropdown({
    	inDuration: 300,
    	outDuration: 225,
    	constrain_width: false, // Does not change width of dropdown to that of the activator
    	hover: true, // Activate on hover
    	belowOrigin: false // Displays dropdown below the button
    }
);
