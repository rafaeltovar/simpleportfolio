$(document).ready(function(){
 
 	$navigation = $('.navbar');
 	
	/* HOME */
	$home = $('#full-screen');
	
	if($home.length > 0) {
		var src = $home.attr('data-image')
	  
		$home.css('background-image', 'url('+src+')')
		$home.fadeIn()
	} else {
		$navigation.fadeIn();
	}
	
	/* GALLERY */
	$gallery = $('#gallery');
	
	if($gallery.length > 0) {
		constrainImage ();
	}
	
});

function constrainImage () {
  var computed_height = (window.innerHeight - 120) - 25
  $('#gallery img').css('max-height', computed_height+'px')
}