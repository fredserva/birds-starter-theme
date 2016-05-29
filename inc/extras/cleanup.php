<?php
/**
 * Some Cleanups
 *
 * @package  Birds_Starter_Theme
 * @since    1.0.1
 *
 */

/**
 * Header
 */
add_action( 'init', 'birds_starter_theme_header_cleanup' );
function birds_starter_theme_header_cleanup() {
	// Windows Live Writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// Relational Links
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// Category feeds
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	// Post and Comment feeds
	remove_action( 'wp_head', 'feed_links', 2 );
	// Really Simple Discovery
	remove_action( 'wp_head', 'rsd_link' );
	// Index link
	remove_action( 'wp_head', 'index_rel_link' );
	// Previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// Start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// WordPress Generator
	remove_action( 'wp_head', 'wp_generator' );
	// REST API Links
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
	remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	remove_action( 'rest_api_init', 'wp_oembed_register_route' );
	remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
	// Emojis
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
}

/**
 * Clean up output of stylesheet <link> tags
 */
add_filter( 'style_loader_tag', 'birds_starter_theme_clean_style_tag' );
function birds_starter_theme_clean_style_tag( $input ) {
	preg_match_all( "!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches );
	// Only display media if it is meaningful
	$media = $matches[3][0] !== '' && $matches[3][0] !== 'all' ? ' media="' . $matches[3][0] . '"' : '';
	return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
}

/**
 * Remove Query Strings from Static Resources
 */
add_filter( 'script_loader_src', 'birds_starter_theme_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'birds_starter_theme_remove_script_version', 15, 1 );
function birds_starter_theme_remove_script_version( $src ) {
	$parts = explode( '?ver', $src );
	return $parts[0];
}
