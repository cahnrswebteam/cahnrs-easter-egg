/**
 * CAHNRS Easter Egg
 */

jQuery(function($){

	var title = $( '#easter-egg' ).attr( 'data-title' );

	$( '#easter-egg' ).dialog({
		autoOpen: false,
		draggable: false,
		modal: true,
		title: title,
		resizable: false,
		show: {
			effect: "fade",
			duration: 300
		},
		hide: {
			effect: "fade",
			duration: 300
		},
		open: function( event, ui ) {
			$( '#jacket' ).animate({
    		opacity: 0,
  			}, 300, function() {
  		});
			$( '.ui-widget-overlay' ).bind( 'click', function() {
				$( '#easter-egg' ).dialog( 'close' );
			}); 
		},
		beforeClose: function( event, ui ) {
			$( '#jacket' ).animate({
    		opacity: 1,
  			}, 300, function() {
  		});
		},
	});

	$( 'a[href="#easter-egg"]' ).click(function() {
		$( '#easter-egg' ).dialog( 'open' );
		return false;
	});

	$( 'input:radio[name="quiz-answer"]' ).click(function() {
		if ( $( '#easter-egg-note' ).is( ':hidden' ) ) {
			if ( $(this).val() === '1' ) {
				$( '.correct' ).show();
			} else {
				$( '.incorrect' ).show();
			}
			$( '#easter-egg-note' ).slideDown( 'slow' );
		}
	});

});