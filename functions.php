<?php
/**
 * Magazine Saga functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Magazine_Saga
 */

if ( ! function_exists( 'magazine_saga_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function magazine_saga_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Magazine Saga, use a find and replace
		 * to change 'magazine-saga' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'magazine-saga' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'topbar-menu' => esc_html__( 'Top Bar Menu', 'magazine-saga' ),
			'menu-1' => esc_html__( 'Primary', 'magazine-saga' ),
			'social-nav' => esc_html__( 'Social Nav', 'magazine-saga' ),
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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'magazine_saga_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

        add_image_size( 'magazine-saga-large-img', 850, 600, true );
        add_image_size( 'magazine-saga-small-img', 410, 294, true );
    }
endif;
add_action( 'after_setup_theme', 'magazine_saga_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function magazine_saga_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'magazine_saga_content_width', 640 );
}
add_action( 'after_setup_theme', 'magazine_saga_content_width', 0 );

/**
 * function for google fonts
 */
if (!function_exists('magazine_saga_fonts_url')) :

    /**
     * Return fonts URL.
     *
     * @since 1.0.0
     * @return string Fonts URL.
     */
    function magazine_saga_fonts_url()
    {

        $fonts_url = '';
        $fonts = array();
        $subsets = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Source Serif Pro, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Source Serif Pro font: on or off', 'magazine-saga')) {
            $fonts[] = 'Source+Serif+Pro:400,700';
        }
        /* translators: If there are characters in your language that are not supported by Source Sans Pro, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Source Sans Pro font: on or off', 'magazine-saga')) {
            $fonts[] = 'Source+Sans+Pro:400,400i,700,700i';
        }

        /* translators: If there are characters in your language that are not supported by Libre Franklin, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Libre Franklin font: on or off', 'magazine-saga')) {
            $fonts[] = 'Libre+Franklin:400,600';
        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urldecode(implode('|', $fonts)),
                'subset' => urldecode($subsets),
            ), 'https://fonts.googleapis.com/css');
        }
        return $fonts_url;
    }
endif;

/**
 * Enqueue scripts and styles.
 *
 * @since Magazine Saga 1.0
 *
 */
function magazine_saga_scripts() {

    $min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

    wp_enqueue_style('ionicons', get_template_directory_uri() . '/assets/lib/ionicons/css/ionicons' . $min . '.css');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/lib/bootstrap/css/bootstrap' . $min . '.css');
	wp_enqueue_style('sidr-nav', get_template_directory_uri() . '/assets/lib/sidr/css/jquery.sidr.dark.css');
	wp_enqueue_style('owl', get_template_directory_uri() . '/assets/lib/owlcarousel/css/owl.carousel.css');
    wp_enqueue_style( 'magazine-saga-style', get_stylesheet_uri() );
    $fonts_url = magazine_saga_fonts_url();
    if (!empty($fonts_url)) {
        wp_enqueue_style('magazine-saga-google-fonts', $fonts_url, array(), null);
    }
    wp_enqueue_script( 'magazine-saga-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/lib/bootstrap/js/bootstrap' . $min . '.js', array('jquery'), '', true);
    wp_enqueue_script('owl', get_template_directory_uri() . '/assets/lib/owlcarousel/js/owl.carousel' . $min . '.js', '', '', true);
	wp_enqueue_script('sidr', get_template_directory_uri() . '/assets/lib/sidr/js/jquery.sidr' . $min . '.js', '', '', true);
	wp_enqueue_script('typed', get_template_directory_uri() . '/assets/lib/typed/typed' . $min . '.js', '', '', true);
	wp_enqueue_script('masonry');
	wp_enqueue_script('script', get_template_directory_uri() . '/assets/saga/js/script.js', '', '', true);

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'magazine_saga_scripts' );

/**
 * Enqueue admin scripts and styles.
 *
 * @since Magazine Saga 1.0
 */
function magazine_saga_admin_scripts($hook)
{
    if ('widgets.php' === $hook) {
        wp_enqueue_media();
        wp_enqueue_script('magazine_saga_widgets', get_template_directory_uri() . '/js/widgets.js', array('jquery'), '1.0.0', true);
    }
    wp_enqueue_style('magazime-saga-admin-css', get_template_directory_uri() . '/assets/saga/css/widget-admin.css');

}

add_action('admin_enqueue_scripts', 'magazine_saga_admin_scripts');

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since Magazine Saga 1.0
 *
 */
function magazine_saga_post_nav_background() {
    if ( ! is_single() ) {
        return;
    }

    $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );
    $css      = '';

    if ( is_attachment() && 'attachment' == $previous->post_type ) {
        return;
    }

    if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
        $prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
        $css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
    }

    if ( $next && has_post_thumbnail( $next->ID ) ) {
        $nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
        $css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); border-top: 0; }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
    }

    wp_add_inline_style( 'magazine-saga-style', $css );
}
add_action( 'wp_enqueue_scripts', 'magazine_saga_post_nav_background' );

function magazine_saga_get_customizer_value(){
    global $magazine_saga;
    $magazine_saga = magazine_saga_get_options();
}
add_action('init','magazine_saga_get_customizer_value');

/**
 * Load all required files.
 */
require get_template_directory() . '/inc/init.php';