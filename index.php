<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The_M.X.
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main jgd-grid jgd-grid-wrap" role="main">

		<?php
		if ( have_posts() ) :
			the_posts_navigation( array(
				'prev_text' => __( '<i class="material-icons">arrow_back</i>Previous Posts', 'the-mx' ),
				'next_text' => __( 'Next Posts<i class="material-icons">arrow_forward</i>', 'the-mx' ),
			) );

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation( array(
				'prev_text' => __( '<i class="material-icons">arrow_back</i>Previous Posts', 'the-mx' ),
				'next_text' => __( 'Next Posts<i class="material-icons">arrow_forward</i>', 'the-mx' ),
			) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();