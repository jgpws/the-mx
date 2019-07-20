/* Scripts to work with Colorbox */
/* see http://www.jacklmoore.com/colorbox/ */

( function( $ ) {
	
	// If Colorbox is not loaded, do nothing
	if ( !$().colorbox ) {
		return;
	}
	
	if( $( 'body' ).hasClass( 'colorbox' ) && $( 'article' ).hasClass( 'has-gallery' ) ) {
	
		windowWidth = $( window ).width();
		
		/* Jetpack tiled gallery compatible */
		if ( colorboxParams.link_to === 'attachment' && windowWidth >= 600 ) {
			$( '.gallery-icon a, .tiled-gallery-item a' ).colorbox({
				rel: 'gal',
				iframe: 'true',
				innerHeight: '75%',
				innerWidth: '75%',
				opacity: '0.75'
			});
		} else if ( colorboxParams.link_to === 'attachment' && windowWidth < 600 ) {
			$( '.gallery-icon a, .tiled-gallery-item a' ).colorbox({
				rel: 'gal',
				iframe: 'true',
				innerHeight: '75%',
				innerWidth: '100%'
			});
		} else {
			$( '.gallery-icon a, .tiled-gallery-item a' ).colorbox({
				rel:'gal',
				maxHeight: '75%',
				maxWidth: '100%',
				opacity: '0.87'
			});
		}
		
		// disable scrolling on parent document
		$(document).on( 'cbox_open', function() {
			$( 'body' ).css({ overflow: 'hidden' });
		}).on( 'cbox_closed', function() {
			$( 'body' ).css({ overflow: 'auto' });
		});
	
	}
	
} ) (jQuery);