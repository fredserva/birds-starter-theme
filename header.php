<?php
/**
 * The template for displaying the header.
 *
 * @package  Birds_Starter_Theme
 * @since    1.0.0
 *
 */
?>
<!doctype html>
<!--[if lt IE 7 ]> <html class="no-js ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]> <html class="no-js ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]> <html class="no-js ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]> <html class="no-js ie ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

	<title><?php wp_title(); ?></title>

	<meta name="author" content="<?php the_author_meta( 'display_name', 1 ); ?>">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="dns-prefetch" href="//fonts.googleapis.com">
	<link rel="dns-prefetch" href="//ajax.googleapis.com">
	<link rel="dns-prefetch" href="//www.google-analytics.com">

	<?php
	// Comment reply JS
	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}


	// Default theme stylesheet
	wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/style.css' );

	wp_head();
?>
</head>
<body <?php echo body_class(); ?>>
	<header id="header" role="banner">
	</header>
	<section id="content" role="main">
