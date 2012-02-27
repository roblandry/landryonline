<?php
/**
 * Twenty Eleven functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyeleven_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 584;

/**
 * Tell WordPress to run twentyeleven_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'twentyeleven_setup' );

if ( ! function_exists( 'twentyeleven_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyeleven_setup() in a child theme, add your own twentyeleven_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, and Post Formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_setup() {

	/* Make Twenty Eleven available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Eleven, use a find and replace
	 * to change 'twentyeleven' to the name of your theme in all the template files.
	 */
	$D = get_bloginfo('stylesheet_directory');
	load_theme_textdomain( 'twentyeleven', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Load up our theme options page and related code.
	require( get_stylesheet_directory() . '/inc/theme-options.php' );

	// Grab Twenty Eleven's Ephemera widget.
	require( get_template_directory() . '/inc/widgets.php' );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'twentyeleven' ) );

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

	// Add support for custom backgrounds
	add_custom_background();

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );

	// The next four constants set how Twenty Eleven supports custom headers.

	// The default header text color
	define( 'HEADER_TEXTCOLOR', '000' );

	// By leaving empty, we allow for random image rotation.
	define( 'HEADER_IMAGE', '' );

	// The height and width of your custom header.
	// Add a filter to twentyeleven_header_image_width and twentyeleven_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyeleven_header_image_width', 650 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyeleven_header_image_height', 280 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be the size of the header image that we just defined
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Add Twenty Eleven's custom image sizes
	add_image_size( 'large-feature', HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true ); // Used for large feature (header) images
	add_image_size( 'small-feature', 500, 300 ); // Used for featured posts if a large-feature doesn't exist

	// Turn on random header image rotation by default.
	add_theme_support( 'custom-header', array( 'random-default' => true ) );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See twentyeleven_admin_header_style(), below.
	add_custom_image_header( 'twentyeleven_header_style', 'twentyeleven_admin_header_style', 'twentyeleven_admin_header_image' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'header1' => array(
			'url' => $D.'/images/headers/header1.jpg',
			'thumbnail_url' => $D.'/images/headers/header1-thumbnail.jpg',
			'description' => __( 'Header1', 'twentyeleven' )
		),
		'header2' => array(
			'url' => $D.'/images/headers/header2.jpg',
			'thumbnail_url' => $D.'/images/headers/header2-thumbnail.jpg',
			'description' => __( 'Header2', 'twentyeleven' )
		),
		'header3' => array(
			'url' => $D.'/images/headers/header3.jpg',
			'thumbnail_url' => $D.'/images/headers/header3-thumbnail.jpg',
			'description' => __( 'Header3', 'twentyeleven' )
		),
		'header4' => array(
			'url' => $D.'/images/headers/header4.jpg',
			'thumbnail_url' => $D.'/images/headers/header4-thumbnail.jpg',
			'description' => __( 'header4', 'twentyeleven' )
		),
		'header5' => array(
			'url' => $D.'/images/headers/header5.jpg',
			'thumbnail_url' => $D.'/images/headers/header5-thumbnail.jpg',
			'description' => __( 'header5', 'twentyeleven' )
		),
		'header6' => array(
			'url' => $D.'/images/headers/header6.jpg',
			'thumbnail_url' => $D.'/images/headers/header6-thumbnail.jpg',
			'description' => __( 'header6', 'twentyeleven' )
		),
		'header7' => array(
			'url' => $D.'/images/headers/header7.jpg',
			'thumbnail_url' => $D.'/images/headers/header7-thumbnail.jpg', 
			'description' => __( 'header7', 'twentyeleven' )
/*		),
		'header8' => array(
			'url' => $D.'/images/headers/header8.jpg',
			'thumbnail_url' => $D.'/images/headers/header8-thumbnail.jpg', */
/*			'description' => __( 'header8', 'twentyeleven' ) */
		)
	) );
}
endif; // twentyeleven_setup


if ( ! function_exists( 'twentyeleven_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentyeleven_setup().
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // twentyeleven_admin_header_image

if ( ! function_exists( 'twentyeleven_widgets_init' ) ) :

function twentyeleven_widgets_init() {

	register_widget( 'Twenty_Eleven_Ephemera_Widget' );

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'twentyeleven' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s imageborder">',
		'after_widget' => "</div></aside>",
		'before_title' => '<div class="header_01">',
		'after_title' => '</div><div class="widget_body">',
	) );

	register_sidebar( array(
		'name' => __( 'Showcase Sidebar', 'twentyeleven' ),
		'id' => 'sidebar-2',
		'description' => __( 'The sidebar for the optional Showcase Template', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="header_01">',
		'after_title' => '</div>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area One', 'twentyeleven' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="header_01">',
		'after_title' => '</div>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'twentyeleven' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="header_01">',
		'after_title' => '</div>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'twentyeleven' ),
		'id' => 'sidebar-5',
		'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="header_01">',
		'after_title' => '</div>',
	) );
	register_sidebar( array(
		'name' => __( 'Header', 'twentyeleven' ),
		'id' => 'sidebar-7',
		'description' => __( 'An optional widget area in the Header', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Top Bar', 'twentyeleven' ),
		'id' => 'sidebar-8',
		'description' => __( 'An optional widget area above banner', 'twentyeleven' ),
		'before_widget' => '<td><aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside></td>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'twentyeleven_widgets_init' );
endif; // twentyeleven_widgets_init

if ( ! function_exists( 'twentyeleven_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own twentyeleven_posted_on to override in a child theme
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date updated" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'twentyeleven' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentyeleven' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

function add_markup_pages($output) {
    $output= preg_replace('/page-item/', ' first-page-item page-item', $output, 1);
	$output=substr_replace($output, " last-page-item page-item", strripos($output, "page-item"), strlen("page-item"));
    return $output;
}
add_filter('wp_list_pages', 'add_markup_pages');

function add_first_and_last($output) {
  $output = preg_replace('/class="menu-item/', 'class="first-menu-item menu-item', $output, 1);
  $output = substr_replace($output, 'class="last-menu-item menu-item', strripos($output, 'class="menu-item'), strlen('class="menu-item'));
  return $output;
}
add_filter('wp_nav_menu', 'add_first_and_last');

function yoast_allow_rel() {
  global $allowedtags;
  $allowedtags['a']['rel'] = array ();
}
add_action( 'wp_loaded', 'yoast_allow_rel' );

function yoast_add_google_profile( $contactmethods ) {
  // Add Google Profiles
  $contactmethods['google_profile'] = 'Google Plus+ Profile';
  return $contactmethods;
}
add_filter( 'user_contactmethods', 'yoast_add_google_profile', 10, 1);

/** Enqueue the stylesheet for the current color scheme into the child theme. */
function twentyelevenchild_enqueue_color_scheme() {
    $options = twentyeleven_get_theme_options();
    $color_scheme = $options['color_scheme'];
    if ( 'dark' == $color_scheme )
        wp_enqueue_style( 'dark_child', get_stylesheet_directory_uri() . '/colors/dark.css', array(), null );
    do_action( 'twentyelevenchild_enqueue_color_scheme', 'dark_child' );
}
add_action( 'wp_enqueue_scripts', 'twentyelevenchild_enqueue_color_scheme', 11);

function add_video_wmode_transparent($html, $url, $attr) {

if ( strpos( $html, '<embed src=' ) !== false )
return str_replace( '<embed', '<embed wmode="transparent" ', $html );
elseif ( strpos ( $html, 'feature=oembed' ) !== false )
return str_replace( 'feature=oembed', 'feature=oembed&wmode=opaque', $html );
else
return $html;

}
add_filter( 'embed_oembed_html', 'add_video_wmode_transparent', 10, 3);

/**
* Display navigation to next/previous pages when applicable
*/
function twentyeleven_content_nav( $nav_id ) {
global $wp_query;
 
if ( $wp_query->max_num_pages > 1 ) : ?>
  <nav id="<?php echo $nav_id; ?>">
  <h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
  <div class="nav-previous"><?php next_posts_link( __( '<span>&larr;</span> Older posts', 'twentyeleven' ) ); ?></div>
  <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span>&rarr;</span>', 'twentyeleven' ) ); ?></div>
  </nav><!-- #nav-above -->
<?php endif; 
}

/* Remove version info */
function remove_version() {
  return '';
}
add_filter('the_generator', 'remove_version');

/* Display default wrong user/pass instead
*  if informing which is incorrect */
function wrong_login() {
  return 'Wrong username or password.';
}
add_filter('login_errors', 'wrong_login');

/* add php code in a text widget */
add_filter('widget_text','execute_php',100);
function execute_php($html){
     if(strpos($html,"<"."?php")!==false){
          ob_start();
          eval("?".">".$html);
          $html=ob_get_contents();
          ob_end_clean();
     }
     return $html;
}
?>
