<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
require_once(dirname(__FILE__).'/check.php');
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<?php
// 1. After Head start section
if (function_exists('orderStyleJS')) {
    orderStyleJS( 'start' );
}
?>
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<script type="text/javascript">
window.fbAsyncInit = function()
{
    FB.Canvas.setSize();
}
</script>
<?php
// 2. Just before Head close section
if (function_exists('orderStyleJS')) {
    orderStyleJS( 'end' );
}
?>
</head>

<body <?php body_class(); ?>>
    <div id="fb-root"></div>
    <script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script> 
    <script type="text/javascript">

    FB.init({
        appId: '113998568664058', 
        status: true, 
        cookie: true, 
        xfbml: true
    });

    /* Init fb Resize window */
    FB.Canvas.setAutoResize(7);

    </script>
<div id="page" class="hfeed">
	<header id="branding" role="banner">
	<!--Logo and Description-->
		<!--div id="logo">
			<h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/logo-dark-christmas.gif" width="450px" height="110px" alt="LandryOnline" /></a></span></h1>
			<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div-->
			<hgroup>
				<h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
				<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
			</hgroup>
	<!--Header Widget-->
		<div class="header-widget">
			<?php dynamic_sidebar('sidebar-7'); ?>
		</div>
       	<!--TopBar Widget-->
		<div id="topbar-widget">
       			<?php dynamic_sidebar('sidebar-8'); ?>
		</div>
	<div class="nav-banner">
   	<!--Navigation-->
		<nav id="nav" role="navigation" class="imageborder">
       		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
       		</nav>
	<!--Banner-->
		<div id="banner">
		<?php
		$header_image = get_header_image();
		if ( ! empty( $header_image ) ) :
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<div class="imageborder" style="width:<?php echo HEADER_IMAGE_WIDTH; ?>px;height:<?php echo HEADER_IMAGE_HEIGHT; ?>px;background:url() center center no-repeat"><img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>px" height="<?php echo HEADER_IMAGE_HEIGHT; ?>px">
				</div>
			</a>
		<?php endif; ?>
		<?php
       		if ( 'blank' == get_header_textcolor() ) :
			?>
			<div class="only-search<?php if ( ! empty( $header_image ) ) : ?> with-image<?php endif; ?>">
				<?php get_search_form(); ?>
			</div>
		<?php else : ?>
		<?php endif; ?>
		</div>
	</div>
	</header>
	<div id="main">