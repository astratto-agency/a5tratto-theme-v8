<?php

/*
:::::::::::::     * A_SETTINGS A5T-Framework includes
The $a5t_includes array determines the code library included in your theme.
Add or remove files to the array as needed. Supports child theme overrides.
Please note that missing files will produce a fatal error.
*/

$a5t_includes = array(
	'core/plugins.php',                           // Plugins
	'core/init.php',                              // Initial theme setup and constants
	'core/utils.php',                             // Utilities
	// 'core/wrapper.php',                           // Theme wrapper class
	'core/config.php',                            // Configuration
	'core/activation.php',                        // Theme activation
	'core/nav.php',                               // Custom nav modifications
	'core/scripts.php',                           // Scripts and stylesheets
	'core/write.php',                             // Writing something on files
	'core/extras.php',                            // Custom functions
	'core/customizer.php',                        // Customize your layout
	'core/security.php',                          // Some security utils
	'core/admin-customizer.php',                  // Admin customize
	// 'core/woocommerce.php',                    // Customize example funtion for woocommerce
);

// includini in queto file tutti i percorsi presenti nell arraydi a5t_include 
foreach ($a5t_includes as $file) {
	if (!$filepath = locate_template($file)) {
		trigger_error(sprintf(__('Error locating %s for inclusion', 'a5t'), $file), E_USER_ERROR);
	}
	require_once $filepath;
}
unset($file, $filepath);

/**
* Timber starter-theme
* https://github.com/timber/starter-theme
*
* @package  WordPress
* @subpackage  Timber
* @since   Timber 0.1
*/

/**
* If you are installing Timber as a Composer dependency in your theme, you'll need this block
* to load your dependencies and initialize Timber. If you are using Timber via the WordPress.org
* plug-in, you can safely delete this block.
*/
$composer_autoload = __DIR__ . '/vendor/autoload.php';
if ( file_exists( $composer_autoload ) ) {
	require_once $composer_autoload;
	$timber = new Timber\Timber();
}

/**
* This ensures that Timber is loaded and available as a PHP class.
* If not, it gives an error message to help direct developers on where to activate
*/
if ( ! class_exists( 'Timber' ) ) {
	
	add_action(
		'admin_notices',
		function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		}
	);
	
	add_filter(
		'template_include',
		function( $template ) {
			return get_stylesheet_directory() . '/static/no-timber.html';
		}
	);
	return;
}

/**
* Sets the directories (inside your theme) to find .twig files
*/
Timber::$dirname = array( 'templates', 'views' );

/**
* By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
* No prob! Just set this value to true
*/
Timber::$autoescape = false;


/**
* We're going to configure our theme inside of a subclass of Timber\Site
* You can move this to its own file and include here via php's include("MySite.php")
*/
class StarterSite extends Timber\Site {
	/** Add timber support. */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();
	}
	/** This is where you can register custom post types. */
	public function register_post_types() {
		
	}
	/** This is where you can register custom taxonomies. */
	public function register_taxonomies() {
		
	}
	
	/** This is where you add some context
	*
	* @param string $context context['this'] Being the Twig's {{ this }}.
	*/
	public function add_to_context( $context ) {
		$context['foo']   = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::context();';
		$context['menu']  = new Timber\Menu();
		$context['site']  = $this;
		
		// * A_SETTINGS Site
		$context['home'] = site_url();
		
		// * A_SETTINGS Logo
		
		$custom_logo_id = get_theme_mod('custom_logo');
		$custom_logo_url = wp_get_attachment_image_src($custom_logo_id, 'full');
		$context['custom_logo_url'] = $custom_logo_url;
		
		// * A_SETTINGS Menu
		$context['primary_menu'] = new Timber\Menu('Primary Navigation');
		// $context['footer_menu'] = new Timber\Menu('Footer Navigation 1');
		
		// * A_SETTINGS Theme Dir
		$context['tema_url'] = get_template_directory_uri();
		$context['urltema'] = get_template_directory_uri();
		$context['template_directory_uri'] = get_template_directory_uri();
		$context['stylesheet_directory_uri'] = get_stylesheet_directory_uri();
		
		// * A_SETTINGS Post
		$context['post_title'] = get_the_title();
		
		$context['title'] = get_the_title();
		$context['the_title'] = get_the_title();
		
		if (is_page() || is_single()) {
			$context['post_class'] = get_post_class()[0];
			$context['content'] = get_the_content();
			$context['post_content'] = get_the_content();
			$context['urlpage'] = get_page_link();
			$context['page_link'] = get_page_link();
		}
		$context['imgpage'] = get_the_post_thumbnail_url();
		$context['post_image'] = get_the_post_thumbnail_url();
		$context['intro'] = get_the_excerpt();
		$context['the_excerpt'] = get_the_excerpt();
		
		// * A_SETTINGS Placeholder
		//   https://source.unsplash.com/
		$context['placeholder'] = 'https://source.unsplash.com/';
		
		// * A_SETTINGS Time & Data
		$context['time'] = get_the_time('c');
		$context['date'] = get_the_date();
		
		// * A_SETTINGS User
		$context['author_url'] = get_author_posts_url(get_the_author_meta('ID'));
		$context['author'] = get_the_author();
		
		// * A_SETTINGS User WooCommerce Memberships
		if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
			// $context['memberships'] = $memberships = wc_memberships_get_user_active_memberships(get_current_user_id());
		}
		
		// * A_SETTINGS Footer
		$context['pre_footer'] = Timber::get_widgets('pre_footer');
		$context['footer_col_1'] = Timber::get_widgets('footer_col_1');
		$context['footer_col_2'] = Timber::get_widgets('footer_col_2');
		$context['footer_col_3'] = Timber::get_widgets('footer_col_3');
		$context['footer_col_4'] = Timber::get_widgets('footer_col_4');
		$context['footer_bottom'] = Timber::get_widgets('footer_bottom');
		
		// * A_SETTINGS Sidebar
		$context['sidebar_primary'] = Timber::get_widgets('sidebar_primary');
		
		// * A_SETTINGS Slide
		$context['slider'] = get_field('slider');
		$context['main_container'] = get_theme_mod("a5t_setting_main_container");
		$context['a5t_setting_gototop'] = get_theme_mod("a5t_setting_gototop");
		$context['a5t_setting_butter'] = get_theme_mod("a5t_setting_butter");
		$context['a5t_setting_magic_mouse'] = get_theme_mod("a5t_setting_magic_mouse");
		
		/*
		// * A_SETTINGS Google Fonts
		// Attiva Google Fonts per ogni riga fonts.google.com
		*/
		
		$a5t_setting_google_fonts = get_theme_mod("a5t_setting_google_fonts");
		$google_fonts = explode("\n", $a5t_setting_google_fonts);
		$google_fonts = array_map('trim', $google_fonts); // remove any extra spaces from each element
		$google_fonts = array_filter($google_fonts); // remove any empty elements
		$context['setting_google_fonts'] = $google_fonts;
		$fontNames = array();
		foreach ($google_fonts as $link) {
		    preg_match('/family=([^:]+)/i', $link, $matches);
		    if (isset($matches[1])) {
		        $fontNames[] = $matches[1];
		    }
		}
		$context['setting_google_font_names'] = $fontNames;

		
		// * A_SETTINGS Setting
		$context['setting_intestazione'] = get_theme_mod('a5t_setting_intestazione');
		$context['setting_piva'] = get_theme_mod('a5t_setting_piva');
		$context['setting_rea'] = get_theme_mod('a5t_setting_rea');
		$context['setting_cap_soc'] = get_theme_mod('a5t_setting_cap_soc');
		// indirizzo
		$context['setting_indirizzo_1'] = get_theme_mod('a5t_setting_indirizzo_1');
		$context['setting_indirizzo_2'] = get_theme_mod('a5t_setting_indirizzo_2');
		$context['setting_indirizzo_3'] = get_theme_mod('a5t_setting_indirizzo_3');
		// tel
		$context['setting_tel_1'] = get_theme_mod('a5t_setting_tel_1');
		$context['setting_tel_2'] = get_theme_mod('a5t_setting_tel_2');
		$context['setting_tel_3'] = get_theme_mod('a5t_setting_tel_3');
		$context['setting_fax'] = get_theme_mod('a5t_setting_fax');
		// mail
		$context['setting_mail_1'] = get_theme_mod('a5t_setting_mail_1');
		$context['setting_mail_2'] = get_theme_mod('a5t_setting_mail_2');
		$context['setting_mail_3'] = get_theme_mod('a5t_setting_mail_3');
		// social
		$context['setting_facebook'] = get_theme_mod('a5t_setting_facebook');
		$context['setting_linkedin'] = get_theme_mod('a5t_setting_linkedin');
		$context['setting_instagram'] = get_theme_mod('a5t_setting_instagram');
		
		// * A_SETTINGS WooCommerce 
		if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
			if (WC()->cart->get_cart_contents_count() == 0) {
				$context['carrello'] = '';
			} else {
				$context['carrello'] = '1';
			}
		}
		
		// * A_SETTINGS Google Maps
		$gmaps_api_key = get_theme_mod('a5t_setting_maps');
		$context['google_maps_api'] = 'https://maps.googleapis.com/maps/api/js?key=' . $gmaps_api_key . '&amp;sensor=false&callback=initMap';

		// * A_SETTINGS Google Recaptcha v3		
		function add_recaptcha_lib() {
			$recaptcha_api_key = get_theme_mod('a5t_setting_recaptcha');
			if (!empty($recaptcha_api_key)) {
				echo '<script src="https://www.google.com/recaptcha/api.js?render=' . $recaptcha_api_key . '" async defer></script>';
			}
		}
		add_action('wp_head', 'add_recaptcha_lib');
		
		
		
		// * A_SETTINGS Yoast
		if ( is_plugin_active( 'wordpress-seo/wp-seo.php' ) || is_plugin_active( 'wordpress-seo-premium/wp-seo-premium.php' ) ) {
			$id = get_the_ID();
			$post = get_post($id, ARRAY_A);
			$yoast_title = get_post_meta($id, '_yoast_wpseo_title', true);
			$yoast_desc = get_post_meta($id, '_yoast_wpseo_metadesc', true);
			$metatitle_val = wpseo_replace_vars($yoast_title, $post);
			$metatitle_val = apply_filters('wpseo_title', $metatitle_val);
			$metadesc_val = wpseo_replace_vars($yoast_desc, $post);
			$metadesc_val = apply_filters('wpseo_metadesc', $metadesc_val);
			$context['metatitle'] = $metatitle_val;
			$context['metadesc'] = $metadesc_val;
			if (function_exists('yoast_breadcrumb')) {
				$context['breadcrumbs'] = yoast_breadcrumb('<div id="breadcrumbs" class="breadcrumb">', '</div>', false);
			}
		}
		return $context;
	}
	
	public function theme_supports() {
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
		
		/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				)
		);
			
		/*
			* Enable support for Post Formats.
			*
			* See: https://codex.wordpress.org/Post_Formats
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
				'audio',
				)
			);
			
		add_theme_support( 'menus' );
	}
		
	/** This Would return 'foo bar!'.
	*
	* @param string $text being 'foo', then returned 'foo bar!'.
	*/
	public function myfoo( $text ) {
		$text .= ' bar!';
		return $text;
	}
	
	/** This is where you can add your own functions to twig.
	*
	* @param string $twig get extension.
	*/
	public function add_to_twig( $twig ) {
		$twig->addExtension( new Twig\Extension\StringLoaderExtension() );
		$twig->addFilter( new Twig\TwigFilter( 'myfoo', array( $this, 'myfoo' ) ) );
		return $twig;
	}
 
}
		
function theme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'theme_add_woocommerce_support' );

new StarterSite();

// * A_SETTINGS Allow excertp in page
add_post_type_support('page', 'excerpt');

// * A_SETTINGS gmap
// Method 1: Filter.
function my_acf_google_map_api($api) {
    $api['key'] = get_theme_mod('a5t_setting_maps');
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

// Method 2: Setting.
function my_acf_init() {
    acf_update_setting('google_api_key', get_theme_mod('a5t_setting_maps'));
}
add_action('acf/init', 'my_acf_init');

// * A_SETTINGS Remove the default search var and add a custom one

if ( ! is_admin() ) {
	add_filter('init', function () {
		global $wp; 
		$wp->add_query_var('search_query');
		$wp->remove_query_var('s');
	});
	
	add_filter('request', function ($request) {
		if (isset($_REQUEST['search_query'])) {
			$request['s'] = $_REQUEST['search_query'];
		} 
		return $request;
	});
};

// * A_SETTINGS CF7
// Create post form CF7
// function save_posted_data($posted_data)
// {
//     $form_id = WPCF7_ContactForm::get_current();
//     if ($form_id->id == 'ID_FORM') {
//         $args = array(
//             'post_type' => 'richieste',
//             'post_taxonomy' => 'in-attesa',
//             'post_title' => $posted_data['referentenome'],
//             'post_content' => $posted_data['note'],
//             'post_status' => 'private',
//             'post_author' => $posted_data['userid'],
//         );
//         $post_id = wp_insert_post($args);
//         if (!is_wp_error($post_id)) {
//             $my_post = array(
//                 'ID' => $post_id,
//                 'post_slug' => $post_id,
//                 'post_title' => $posted_data['nomeviaggio'] . " - " . $posted_data['idviaggio'] . " - Rif. " . $posted_data['primoospitenome'] . " " . $posted_data['primoospitecognome']
//             );
//             wp_update_post($my_post);
//             wp_set_object_terms($post_id, 'in-attesa', 'stati');
//             wp_set_post_tags($post_id, $posted_data['concessionariatag']);
//             if (isset($posted_data['concessionaria'])) {
//                 update_post_meta($post_id, 'concessionaria_nome', $posted_data['concessionaria']);
//             }
//             return $posted_data;
//         }
//     }
// }
// 
// add_filter('wpcf7_posted_data', 'save_posted_data');
 
// Add tag referer-page with url of previous page
function getRefererPageForm( $form_tag )
{
	if ( $form_tag['name'] == 'referer-page' ) {
		$form_tag['values'][] = htmlspecialchars($_SERVER['HTTP_REFERER']);
	}
	return $form_tag;
}
if ( !is_admin() ) {
	add_filter( 'wpcf7_form_tag', 'getRefererPageForm' );
}

// Add tag current-page with url of current page
function getCurrentPageForm($form_tag)
{
    global $wp;
    $current_url = home_url(add_query_arg(array(), $wp->request));

    if ($form_tag['name'] == 'current-page') {
        $form_tag['values'][] = htmlspecialchars($current_url);
    }

    return $form_tag;
}

if (!is_admin()) {
    add_filter('wpcf7_form_tag', 'getCurrentPageForm');
}


// This code adds additional MIME types for JSON and SVG files. 
function cc_mime_types($mimes)
{
	$mimes['json'] = 'application/json';
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
