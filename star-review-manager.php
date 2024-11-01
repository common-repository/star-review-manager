<?php
/**
 * @package   star-review-manager
 * @author    Bram Dekker <bram.dekker.nl@gmail.com>
 * @license   GPL-2.0+
 * @copyright 2015 Bram Dekker
 * @wordpress-plugin
 * Plugin Name: star-review-manager
 * Plugin URI: http://bdekker.eu/star-review-manager
 * Description: Easily set up a review page and manage your reviews using Star Review Manager.  
 * Version: 1.2.2
 * Author: Bram Dekker
 * Author URI: http://bdekker.eu	
 * Text Domain: star-review-manager
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

defined( 'WP_PLUGIN_URL' ) or die( 'Restricted' );

/*general constants*/
define('SRM_URL',WP_PLUGIN_URL.'/star-review-manager');


/* db constants */
define('SRM_DB_USERS','srm_users');
define('SRM_DB_REVIEWS','srm_reviews');
define('SRM_DB_REVIEWCONTAINER', 'srm_container');
define('SRM_DB_CONTAINERRATING', 'srm_containerrating');
define('SRM_DB_RATING', 'srm_rating');


/* buy me a drink */
define('SRM_FREE', true);

require_once(ABSPATH . 'wp-includes/pluggable.php');

require_once('db/db_setup.php');

require_once('classes/class.review.php');
require_once('classes/class.reviewcontainer.php');
require_once('classes/class.user.php');
require_once('admin/admin_menu.php');
require_once('classes/class.messenger.php');

/* views */
require_once('views/view.reviews.php');
require_once('views/view.reviewform.php');


require_once('lib/crud.php');
function ap_action_init()
{
	$path = dirname( plugin_basename( __FILE__ ) ) . '/languages';
	$succes = load_plugin_textdomain( 'star-review-manager', false, $path);
	srm_install_db();
}add_action('init', 'ap_action_init');

/* front-end styles */
function srm_stylesheet() {
	wp_enqueue_style('srm-style', SRM_URL.'/css/frontend-style.css');	
	wp_enqueue_style('srm-custom-style', SRM_URL.'/css/custom-frontend-style.css');	
}add_action('wp_print_styles', 'srm_stylesheet');

/* front-end js */
function srm_js() {
	wp_enqueue_script('jquery');
	wp_register_script('bootstrap',SRM_URL.'/lib/bootstrap/dist/js/bootstrap.js', 'jquery');
}add_action('wp_enqueue_scripts', 'srm_js');

/* admin styles */	
function srm_admin_stylesheet() {
	wp_enqueue_style('srm-style', SRM_URL.'/css/style.css');
	wp_enqueue_style('bootstrap', SRM_URL.'/lib/bootstrap/dist/css/bootstrap.min.css');
	wp_enqueue_style('thickbox');
}add_action('admin_init', 'srm_admin_stylesheet');

/* admin js */ 
function srm_admin_js() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
}add_action('admin_print_scripts', 'srm_admin_js'); 


/* all crud operations on this plugin will link to our crud.php file */	
function srm_parse_crud($req) {
    if (array_key_exists('crud', $req->query_vars)) {
      include('lib/crud.php');
      die();exit();
    }
}add_action('parse_request', 'srm_parse_crud');

function shortcode_handler( $atts ) {
    if(empty($atts) || empty($atts['id'])) return '';
	return get_reviews_html($atts);
}
add_shortcode( 'srm_review', 'shortcode_handler' );

function shortcode_form_handler( $atts ) {
	if(empty($atts) || empty($atts['container_id'])) return '';
	return get_reviewform_html($atts);
}
add_shortcode( 'srm_review_form', 'shortcode_form_handler' );
	
function showDonate() {
	include ('lib/donate.php');
}
	
	
	
 ?>
