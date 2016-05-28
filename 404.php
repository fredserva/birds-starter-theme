<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package  Birds_Starter_Theme
 * @since    1.0.0
 *
 */

get_header(); ?>
<section class="entry-section">
	<h1 class="page-title"><?php _e( '404', 'birds' ); ?></h1>
	<article class="entry">
		<section class="entry-content">
			<?php _e( 'Page not found', 'birds' ); ?>
		</section>
	</article>
</section>
<?php get_footer(); ?>
