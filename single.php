<?php
/**
 * The template for displaying all single posts and attachments.
 *
 * @package  Birds_Starter_Theme
 * @since    1.0.0
 *
 */

get_header(); ?>
	<section class="entry-section">
		<?php
		if ( have_posts() ) :
			the_post();
			?>
				<article <?php post_class( 'entry' ); ?> id="post-
					<?php the_ID(); ?>" role="article">
						<h3 class="entry-title"><?php the_title(); ?></h3>
						<section class="entry-content">
							<?php the_content(); ?>
						</section>
				</article>
			<?php
		endif;
		?>
		<?php wp_link_pages(); ?>
	</section>
	<?php get_footer(); ?>
