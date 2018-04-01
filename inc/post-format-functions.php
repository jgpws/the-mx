<?php
/**
 * The M.X. Post Format functions.
 *
 * @package The_M.X.
 */
 
/**
 * These functions control the display of content when some of the registered post formats are active.
 * The content and excerpts are changed with filters.
 */
function the_mx_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

function the_mx_get_formatted_content() {
	$content = get_the_content( sprintf(
		/* translators: %s: Name of current post. */
		__( 'Continue reading %s...', 'the-mx' ),
		the_title( '<span class="screen-reader-text">"', '"</span>', false )
	) );
	$content = wpautop( $content );
	
	return $content;
}

function the_mx_get_formatted_excerpt() {
	$excerpt = get_the_excerpt();
	$excerpt = wpautop( $excerpt );
	
	return $excerpt;
}

function the_mx_wrap_quote() {
// Adapted from the article Post Formats: Quote, by Justin Tadlock
// see http://justintadlock.com/archives/2012/08/27/post-formats-quote
	
	global $post;
	$content = $post->post_content;
	
	if( has_post_format( 'quote' ) && ( !is_single() || !is_search() ) ) {
		/* Match blockquote elements */
		preg_match( '/<blockquote.*?>/', $content, $matches );
		
		if( empty( $matches ) ) {
			$content = "<blockquote>{$content}</blockquote>";
		} else {
			return $content;
		}
	}
	
	return $content;
}

function the_mx_get_first_video( $post_id ) {
	
	if( has_post_format( 'video' ) ) {
		$post = get_post( $post_id );
		$content = apply_filters( 'the_content', $post->post_content );
		$embeds = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
		
		$first_embed = $embeds[0];
		
		if( !empty( $embeds ) ) {
			return $first_embed;
		}
	}
	
}

/*function the_mx_get_first_media() {
	$content = the_mx_get_formatted_content();
	
	global $post;
	
	// To get oembeds within posts that don't have this filter applied
	// get_the_content literally echoes everything on the page
	// see the answer on this Stack Exchange page - http://wordpress.stackexchange.com/questions/202707/how-to-use-oembeds-on-post-content-during-ajax-requests
	
	if( !is_single() && !is_search() ) {
	
		if( has_post_format( 'image' ) ) {
			
			return the_mx_get_first_image();
			
		} elseif( has_post_format( 'quote' ) ) {
			// Adapted from the article Post Formats: Quote, by Justin Tadlock
			// see http://justintadlock.com/archives/2012/08/27/post-formats-quote
			
			$content = the_mx_get_formatted_content();
			/* Match blockquote elements */
			/*preg_match( '/<blockquote.*?>/', $content, $matches );
			
			if( empty( $matches ) ) {
				$content = "<blockquote>{$content}</blockquote>";
			} else {
				return $content;
			}
		
		return $content;
		
		} else {
			return $content; // Content when media type post format is not chosen
		}
			
	} else {
		return $content; // Content inside Single post
	}
}
add_filter( 'the_content', 'the_mx_get_first_media' );*/

function the_mx_get_first_excerpt_media() {
	$new_excerpt = the_mx_get_formatted_excerpt();
	if( is_search() ) {
		
		if( has_post_format( 'video' ) ) {
			return $new_excerpt;
		} else {
			return $new_excerpt;
		}
		
	}
}
add_filter( 'the_excerpt', 'the_mx_get_first_excerpt_media' );