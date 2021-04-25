<?php
/**
 * Theme functions and definitions
 *
 * @package  Birds_Starter_Theme
 * @since    1.0.0
 *
 */

if ( ! function_exists( 'birds_starter_theme_setup' ) ) :
	function birds_starter_theme_setup() {
		/*
		 * Make theme available for translation.
		 */
		load_theme_textdomain( 'birds', get_template_directory() . '/languages' );
		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}

		add_theme_support( 'menus' );
		require_once( 'inc/class-birds-starter-theme-menu-walker.php' );

		//add_theme_support( 'custom-background', $args );
		//add_theme_support( 'custom-header', $args );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Enable support for custom logo.
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 240,
				'width'       => 240,
				'flex-height' => true,
			)
		);

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'birds' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 * @link : https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'status',
				'audio',
				'chat',
			)
		);

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'css/editor-style.css', birds_starter_theme_fonts_url() ) );

		/*
		 * Indicate widget sidebars can use selective refresh in the Customizer.
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Enable support for a few items to enhance this new Gutenberg editor.
		 */

		// Allows the theme to add to the default set of core block styles
		add_theme_support( 'wp-block-styles' );

		// Allows embedded media to retain its aspect ratio
		add_theme_support( 'responsive-embeds' );

		// Offers the ability to add class names to the image wrapper for those elements that offer wide or full-width images
		add_theme_support( 'align-wide' );

		// Sets the editor font sizes which correspond to editor styles and are available within the block settings where applicable. The defaults are the same as what’s defined in the theme here, but any font sizes or uses could be added in your custom array
		add_theme_support( 'editor-font-sizes', array() );

		// Does the same thing, setting your theme’s main color palette
		add_theme_support( 'editor-color-palette', array() );

	}
endif; // birds_starter_theme_setup
add_action( 'after_setup_theme', 'birds_starter_theme_setup' );


/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 * @global int $content_width
 *
 * @since 1.0.0
 */
function birds_starter_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'birds_starter_theme_content_width', 960 );
}
add_action( 'after_setup_theme', 'birds_starter_theme_content_width', 0 );

/**
 * Registers a widget area.
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since 1.0.0
 */
function birds_starter_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Main Sidebar', 'birds' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'birds' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'birds_starter_theme_widgets_init' );

if ( ! function_exists( 'birds_starter_theme_fonts_url' ) ) :
	/**
	 * Register Google fonts for the theme.
	 * Create your own birds_starter_theme_fonts_url() function to override in a child theme.
	 *
	 * @since 1.0.0
	 */
	function birds_starter_theme_fonts_url() {
		return 'https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,400;1,700;1,900&family=Lora:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&family=Quicksand:wght@300;400;500;700&family=Work+Sans:wght@700;800;900&display=swap';
	}
endif;

/**
 * Handles JavaScript detection.
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since 1.0.0
 */
function birds_starter_theme_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'birds_starter_theme_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function birds_starter_theme_scripts() {
	/**
	 * Theme main stylesheet.
	 */
	wp_enqueue_style( 'birds_starter_theme-style', get_stylesheet_uri() );

	/**
	 * Other stylesheets.
	 */

	// Normalize
	wp_enqueue_style( 'birds_starter_theme-normalize-css', get_template_directory_uri() . '/css/normalize.css', array(), null );

	// Gridlex CSS - https://gridlex.devlint.fr/
	wp_enqueue_style( 'birds_starter_theme-gridlex-css', get_template_directory_uri() . '/inc/vendor/gridlex/gridlex.min.css', array(), null );

	// Google Fonts
	wp_enqueue_style( 'birds_starter_theme-google-fonts', birds_starter_theme_fonts_url(), array(), null );

	// GLightbox Stylesheet
	wp_enqueue_style( 'birds_starter_theme-lightbox-css', get_template_directory_uri() . '/inc/vendor/glightbox/glightbox.min.css', array(), null );

	// Main Stylesheet
	wp_enqueue_style( 'birds_starter_theme-main-css', get_template_directory_uri() . '/css/main.css', array(), null );

	/**
	 * JS scripts.
	 */

	// Load the html5 shiv.
	wp_enqueue_script( 'birds_starter_theme-html5', get_template_directory_uri() . '/js/html5shiv.js', array(), '3.7.3' );
	wp_script_add_data( 'birds_starter_theme-html5', 'conditional', 'lt IE 9' );

	// Skip Link Focus.
	wp_enqueue_script( 'birds_starter_theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), null, true );

	// Comments Reply
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// GLightbox
	wp_enqueue_script( 'birds_starter_theme-lightbox', get_template_directory_uri() . '/inc/vendor/glightbox/glightbox.min.js', array( 'jquery' ), null, true );

	// Custom Script
	wp_enqueue_script( 'birds_starter_theme-script', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), null, true );

}
add_action( 'wp_enqueue_scripts', 'birds_starter_theme_scripts' );

/**
 * Includes
 */
require locate_template( '/inc/extras/cleanup.php' ); // Cleanup
require locate_template( '/inc/extras/extras.php' );  // Extras

/**
 * Minimum Requirements
 */
require locate_template( '/inc/extras/class-minimum-requirements.php' );
$requirements = new Minimum_Requirements( '7.1.1', '5.0', 'Birds Starter Theme', array() );
register_activation_hook( __FILE__, array( $requirements, 'check_compatibility_on_install' ) );
if ( ! $requirements->is_compatible_version() ) {
	add_action( 'admin_notices', array( $requirements, 'load_admin_notices' ) );
	return;
}

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 */
function birds_starter_theme_wp_title( $title, $sep ) {
	global $page;

	if ( is_feed() ) {
		return $title;
	}
	// Add the site name & description.
	$title = html_entity_decode( get_bloginfo( 'name' ) ) . html_entity_decode( $title );
	return $title;
}
add_filter( 'wp_title', 'birds_starter_theme_wp_title', 10, 2 );
