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
		load_theme_textdomain( 'birds', get_template_directory().'/languages' );
		$locale = get_locale();
		$locale_file = get_template_directory()."/languages/$locale.php";
		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}

		add_theme_support( 'menus' );
		require_once( 'inc/menu-walker.php' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

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
		add_theme_support( 'custom-logo', array(
			'height'      => 240,
			'width'       => 240,
			'flex-height' => true,
		) );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'birds' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * @link : https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'status',
			'audio',
			'chat',
		) );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'css/editor-style.css', birds_starter_theme_fonts_url() ) );

		/*
		 * Indicate widget sidebars can use selective refresh in the Customizer.
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

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
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'birds' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'birds' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
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
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
		$lato = _x( 'on', 'Lato font: on or off', 'purplesandpiper' );
		$merriweather = _x( 'on', 'Merriweather font: on or off', 'purplesandpiper' );
		$open_sans = _x( 'on', 'Open Sans font: on or off', 'purplesandpiper' );

		if ( 'off' !== $lato ) {
			$font_families[] = 'Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic';
		}
		if ( 'off' !== $merriweather ) {
			$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
		}
		if ( 'off' !== $open_sans ) {
			$fonts[] = 'Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}
		return $fonts_url;
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

	// Bulma CSS - CSS framework based on Flexbox http://bulma.io
	wp_enqueue_style( 'birds_starter_theme-bulma-css', get_template_directory_uri() . '/inc/vendor/bulma/bulma.css', array(), null );

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

	// Custom Script
	wp_enqueue_script( 'birds_starter_theme-script', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), null, true );

}
add_action( 'wp_enqueue_scripts', 'birds_starter_theme_scripts' );

/**
 * Includes
 */
require locate_template( '/inc/extras/cleanup.php' );						// Cleanup
require locate_template( '/inc/extras/extras.php' );						// Extras
