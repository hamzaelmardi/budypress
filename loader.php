<?php
/*
Plugin Name: BuddyPress Docs
Plugin URI: http://github.com/boonebgorges/buddypress-docs
Description: Adds collaborative Docs to BuddyPress
Version: 2.1.6
Author: Boone B Gorges, David Cavins
Author URI: http://boone.gorg.es
Text Domain: buddypress-docs
Domain Path: /languages/
Licence: GPLv3
*/

/*
It's on like Donkey Kong
*/

define( 'BP_DOCS_VERSION', '2.1.6' );

/*
 * BuddyPress Docs introduces a lot of overhead. Unless otherwise specified,
 * don't load the plugin on subsites of an MS install
 */
if ( ! defined( 'BP_DOCS_LOAD_ON_NON_ROOT_BLOG' ) ) {
	define( 'BP_DOCS_LOAD_ON_NON_ROOT_BLOG', false );
}

/**
 * Loads BP Docs files only if BuddyPress is present
 *
 * @package BuddyPress Docs
 * @since 1.0-beta
 */
function bp_docs_init() {

	function ca_theme() {
 wp_enqueue_script( 'capitaine', plugin_dir_url( __FILE__ )  . '/script.js', array( 'jquery' ), '1.0', true );
 wp_localize_script( 'capitaine', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
}
add_action( 'wp_enqueue_scripts', 'ca_theme' );

add_action( 'wp_ajax_insert_theme', 'capitaine_insert_theme' );
add_action( 'wp_ajax_nopriv_insert_theme', 'capitaine_insert_theme' );

function capitaine_insert_theme() {

	echo 'test';
	die();
   
  //  $theme_id = $_POST['STheme'];
    //$doc_id = $_POST['doc_id'];

     //wp_set_post_terms($doc_id, $theme_id, 'theme_doc');

}

add_action( 'wp_ajax_theme_intra', 'capitaine_theme_intra' );
add_action( 'wp_ajax_nopriv_theme_intra', 'capitaine_theme_intra' );

function capitaine_theme_intra() {
	$term_id = $_POST['term_id'];
    $childs = get_terms( array(
			    'taxonomy' => 'theme_doc',
			    'hide_empty' => false,
			    'parent' => $term_id,
			) );
	echo json_encode($childs) ;
    die();

}  




	global $bp_docs;

	if ( is_multisite() && ! bp_is_root_blog() && ( ! BP_DOCS_LOAD_ON_NON_ROOT_BLOG ) ) {
		return;
	}

	require dirname( __FILE__ ) . '/bp-docs.php';
	$bp_docs = new BP_Docs();
}
add_action( 'bp_include', 'bp_docs_init' );
