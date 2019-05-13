<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The_M.X.
 */

if( get_theme_mod( 'the_mx_layout' ) == 'imagegrid' ) {
	the_mx_imagegrid();
} else {
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( 'link' == get_post_format( $post->ID ) ) : ?>
			<header class="entry-header">
				<?php if( is_single() ) {
					the_title( '<h1 class="entry-title"><i class="material-icons">' . esc_html__( 'link', 'the-m-x' ) . '</i>', '</h1>' );
					the_content();
				} else {
					the_title( '<h2 class="entry-title"><i class="material-icons">' . esc_html__( 'link', 'the-m-x' ) . '</i><a href="' . esc_url( the_mx_get_link_url() ) . '">', '</a></h2>' ); ?>
					<p><a href="<?php the_permalink(); ?>"><?php esc_html_e( 'View the full post', 'the-m-x' ); ?></a></p>
				<?php	
				} ?>
			</header><!-- .entry-header -->
		<?php endif; ?>
		<footer class="entry-footer">
			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
						if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
							$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
						}
		
						$time_string = sprintf( $time_string,
							esc_attr( get_the_date( 'c' ) ),
							esc_html( get_the_date() ),
							esc_attr( get_the_modified_date( 'c' ) ),
							esc_html( get_the_modified_date() )
						);
		
						$posted_on = sprintf(
		/* translators: 2: text hiding <span class="screen-reader-text">, 3: </span> closing tag */
							esc_html_x( '%2$sPosted on%3$s%1$s', 'post date', 'the-m-x' ),
							'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>', '<span class="screen-reader-text">', '</span>'
						);
						
						echo '<div class="posted-on"><i class="material-icons">' . esc_html__( 'schedule', 'the-m-x' ) . '</i>' . $posted_on . '</div>'; // WPCS: XSS OK. ?>
				</div><!-- .entry-meta -->
				<?php endif;
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'the-m-x' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<div class="edit-link"><i class="material-icons">' . __( 'mode_edit', 'the-m-x' ) . '</i>',
				'</div>'
			); ?>
		</footer>
	</article><!-- #post-## -->
<?php
}
?>
