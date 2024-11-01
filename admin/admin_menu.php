<?php
add_action( 'admin_menu', 'plugin_admin_pages' );
add_action('admin_menu', 'notification_bubble_in_admin_menu');

function plugin_admin_pages() {
	add_menu_page( 'manage_reviewcontainers',  __('Manage review instances', 'star-review-manager'), 'manage_options', 'manage_reviewcontainers', 'manage_reviewcontainers', '', 56);
	add_submenu_page('options-general.php', __('Star Manager Review Settings', 'star-review-manager'), __('Star Manager Review Settings', 'star-review-manager'), 'manage_options', 'settings', 'settings');
	add_submenu_page(null, 'Create new review container', __('Create new review container', 'star-review-manager'), 'manage_options', 'new_reviewcontainer', 'new_reviewcontainer');
	add_submenu_page(null, 'Review container settings', __('Review container settings', 'star-review-manager'), 'manage_options', 'reviewcontainer_settings', 'reviewcontainer_settings');
	add_submenu_page(null, 'Manage reviews', __('Manage reviews', 'star-review-manager'), 'manage_options', 'manage_reviews', 'manage_reviews');
	add_submenu_page('manage_reviewcontainers', __('Help', 'star-review-manager'), __('Help', 'star-review-manager'), 'manage_options', 'help', 'help');
}


function manage_reviewcontainers() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	include("manage_reviewcontainers.php");
}

function new_reviewcontainer() {
	include("new_reviewcontainer.php");
}	


function reviewcontainer_settings() {
	include("reviewcontainer_settings.php");
}

function manage_reviews() {
	include ("manage_reviews.php");
}

function settings() {
	include ("settings.php");
}

function help() {
	include ("help.php");
}

function notification_bubble_in_admin_menu() {
	global $menu;
    $pendingreviews = get_pending_reviews();
    $menu[56][0] .= $pendingreviews ? '<span class="update-plugins count-1"><span class="update-count">' . $pendingreviews . __(' pending', 'star-review-manager') . '</span></span>' : '';
}

function get_pending_reviews()
{
    global $wpdb;
    return $wpdb->get_var("SELECT COUNT(*) FROM ". SRM_DB_REVIEWS ." WHERE status=0;");
}

?>