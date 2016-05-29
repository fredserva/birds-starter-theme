<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * @package  Birds_Starter_Theme
 * @since    1.0.3
 *
 */

/**
 * DNS Prefetching
 */
add_action( 'wp_head', 'birds_starter_theme_dns_prefetch', 0 );
function birds_starter_theme_dns_prefetch() {
	$prefetch = 'on';
	echo "\n <!-- DNS Prefetching Start --> \n";
	echo '<meta http-equiv="x-dns-prefetch-control" content="'.$prefetch.'">'."\n";

	if ( 'on' === $prefetch ) {
		$dns_domains = array(
			'//fonts.googleapis.com',
			'//ajax.googleapis.com',
			'//www.google-analytics.com',
			'//0.gravatar.com',
			'//1.gravatar.com',
			'//2.gravatar.com',
		);
		foreach ( $dns_domains as $domain ) {
			if ( ! empty( $domain ) ) {
				echo '<link rel="dns-prefetch" href="'.$domain.'" />'."\n";
			}
		}
		unset( $domain );
	}
	echo "<!-- DNS Prefetching end --> \n";
}

/**
 * Facebook OG Tags And Twitter Cards
 */
add_action( 'wp_head', 'birds_starter_theme_og_metatags', 0 );
function birds_starter_theme_og_metatags() {
	global $post;

	if ( is_single() || is_home() || is_front_page() ) {

		// Make necessary edits here
		$og_type_homepage = 'website'; //Content type of the homepage
		$og_type = 'article'; //Content type of blog posts. Change this to use a different a content type if needed. Eg: profile.
		$fallbackimage = ''; //Add the URL of your fallback image between the quotes or leave it blank if you do not want to use one.
		$twitter_username = ''; //Add your twitter username here between the quotes or leave it blank. Eg: @twitterusername.
		$twitter_card = 'summary'; //Change "summary" to "summary_large_image" if you want to use large image.
		$fb_admin = ''; //Add your facebook ID here between quotes or leave blank if you do not want to use one.

		// Generate post excerpt using custom field if present
		if ( get_post_meta( get_the_ID(), 'description', true ) ) {
			$og_des = get_post_meta( get_the_ID(), 'description', true );
		}
		// If custom field is not present, generate excerpt from post content
		if ( ! get_post_meta( get_the_ID(), 'description', true ) ) {
			$og_des = strip_tags( $post->post_content );
			$og_des = strip_shortcodes( $og_des );
			$og_des = str_replace( array( "\n", "\r", "\t" ), ' ', $og_des );
			$og_des = substr( $og_des, 0, 155 );
			$og_des = $og_des.'...';
		}
		?>
		<meta property="og:url" content="<?php if ( is_home() || is_front_page() ) { echo home_url(); } else { the_permalink(); } ?>"/>
		<meta property="og:title" content="<?php if ( is_home() || is_front_page() ) { bloginfo(); } else { single_post_title( '' ); } ?>" />
		<meta property="og:description" content="<?php if ( is_home() || is_front_page() ) { bloginfo( 'description' ); } else { echo $og_des; } ?>" />
		<meta property="og:type" content="<?php if ( is_home() || is_front_page() ) { echo $og_type_homepage; } else { echo $og_type; } ?>" />
		<?php if ( is_single() && has_post_thumbnail( $post->ID ) ) { ?>
			<meta property="og:image" content="<?php $featured_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false ); echo $featured_img[0]; ?>" />
		<?php } ?>
		<?php if ( '' !== trim( $fallbackimage ) ) { ?>
			<meta property="og:image" content="<?php echo trim( $fallbackimage ); ?>" />
		<?php } ?>
		<meta property="og:site_name" content="<?php bloginfo(); ?>" />
		<?php if ( '' !== trim( $fb_admin ) ) { ?>
			<meta property="fb:admin" content="<?php echo trim( $fb_admin ); ?>" />
		<?php } ?>
		<meta name="twitter:card" content="<?php echo $twitter_card; ?>">
		<?php if ( '' !== trim( $twitter_username ) ) { ?>
			<meta name="twitter:site" content="<?php echo trim( $twitter_username ); ?>" />
		<?php } ?>

<?php
	} else {
		return;
	}
}

/**
 * Adding og prefix
 */
add_filter( 'language_attributes', 'birds_starter_theme_og_tag_prefix' );
function birds_starter_theme_og_tag_prefix( $tagdata ) {
	if ( is_home() || is_front_page() || is_single() ) {
		$tagdata .= ' prefix="og: http://ogp.me/ns#"';
	}
	return $tagdata;
}
