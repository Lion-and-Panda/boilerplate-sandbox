<?php
//---------------------  // Load Scripts & Styles //  ---------------------//
function lpbp_scripts_styles() {

//---------------------  // Stylesheets // ---------------------//
wp_enqueue_style( 'style', get_stylesheet_uri() );

//---------------------  // Scripts // ---------------------//
	wp_enqueue_script('theme_custom_js', get_template_directory_uri() . '/includes/js/theme.js', false, false, false);	// get general js for theme
	wp_enqueue_script('theme_menu_js', get_template_directory_uri() . '/includes/js/menu.js', false, false, false);	// scripts for the mobile menu
//---------------------  // Fonts // ---------------------//
	//Adobe Fonts
	//wp_enqueue_style( 'adobe_edge_web_fonts', 'https://use.typekit.net/rcl6gdl.css' );

	//Google Fonts
	wp_enqueue_style( 'google_fonts', 'https://fonts.googleapis.com/css2?family=Roboto&family=Zilla+Slab:ital,wght@0,300;0,700;1,400&display=swap' );

}

//---------------------  // Menu Locations // ---------------------/
add_action( 'wp_enqueue_scripts', 'lpbp_scripts_styles' );
require_once('bulma-navwalker.php');

register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'primary' ),
		'meta' => __( 'Meta Links', 'meta' ),
		'footer_menu' => __( 'Footer Menu', 'footer_menu' ),
) );

//---------------------  // Sidebar Locations // ---------------------/
if ( function_exists('register_sidebars') )

register_sidebar(array(
		'name' => 'Main Sidebar',
		'id' => 'sidebar-main',
		'description' => 'Main sidebar on the blog.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '<div class="text-fade"></div></div>'
));

//---------------------  // Content Width // ---------------------/
if ( ! isset( $content_width ) ) $content_width = 1200;

//---------------------  // Images Sizes // ---------------------/
add_theme_support('post-thumbnails');
set_post_thumbnail_size( 825, 510, true );// Default Thumb
set_post_thumbnail_size( 'reg-feature',1200, 500, true ); // reg

add_image_size('small_thumb', '640', '360', true);
add_image_size('reg-feature', '1000', '850', true);
add_image_size('big-feature', '1400', '686', false);
add_image_size('square', '800', '800', true);

//---------------------  // Advanced Custom fields Setup  // ---------------------/
// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', get_stylesheet_directory() . '/admin/advanced-custom-fields-pro/' );
define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/admin/advanced-custom-fields-pro/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return true; // set to false to hide menu item
}

require get_template_directory() . '/admin/theme-support/acf.php';
require get_template_directory() . '/admin/theme-support/acf-options.php';


//---------------------  // Register ACF Custom Gutenburg Blocks  // ---------------------/
function my_acf_block_render_callback( $block ) {
// convert name ("acf/testimonial") into path friendly slug ("testimonial")
$slug = str_replace('acf/', '', $block['name']);
// include a template part from within the "includes/blocks" folder
		if( file_exists( get_theme_file_path("/includes/blocks/content-{$slug}.php") ) ) {
				include( get_theme_file_path("/includes/blocks/content-{$slug}.php") );
		}
}


//---------------------  // Set Custom Color Palette in Color Picker  // ---------------------/
function acf_input_admin_footer() { ?>
	<script type="text/javascript">
		(function($) {
		acf.add_filter('color_picker_args', function( args, $field ){
			args.palettes = ['#7A0023', '#240B0F', '#8A7932' , '#C9B77D', '#FFE8BA', '#FAF1D5', '#0D0C09', '#4A4A4A' ]
		return args;
		});
		})();
	</script>
	<?php
}
add_action('acf/input/admin_footer', 'acf_input_admin_footer');

//---------------------  // Add SVG Support to theme Only // ---------------------/
// note: this does not affect SVG on Wordpress itself. You will need a plugin to make SVG uploads and usage available in the Media Library
function add_file_types_to_uploads($file_types){
$new_filetypes = array();
$new_filetypes['svg'] = 'image/svg+xml';
$file_types = array_merge($file_types, $new_filetypes );
return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');

//---------------------  // Load jQuery from Google Library // ---------------------/
function replace_jquery() {
	if (!is_admin()) {
		// comment out the next two lines to load the local copy of jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', false, '1.11.3');
		wp_enqueue_script('jquery');
	}
}
add_action('init', 'replace_jquery');

//---------------------  // Write Log // ---------------------/
if ( ! function_exists('write_log')) {
	function write_log ( $log )  {
	   if ( is_array( $log ) || is_object( $log ) ) {
		  error_log( print_r( $log, true ) );
	   } else {
		  error_log( $log );
	   }
	}
}

//---------------------  // woocommerce Support // ---------------------/
function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

//---------------------  // Resource Library // ---------------------/

//register custom post type
require get_template_directory() . '/includes/content/resource-library/post-type-resources.php';
//regiester custom blocks for resource library
require get_template_directory() . '/includes/content/resource-library/register-blocks-resources.php';
//resource library base styles
function resource_styles() {
wp_enqueue_style( 'resources', get_template_directory_uri() . '/includes/content/resource-library/includes/css/resources.css',false,'1.1','all');
}
add_action( 'wp_enqueue_scripts', 'resource_styles' );
