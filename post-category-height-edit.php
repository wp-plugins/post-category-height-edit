<?php
/*
Plugin Name: Post Category Height Edit
Description: It is adjustable plugin the height of the category meta box of edit posts screen.
Plugin URI: http://gqevu6bsiz.chicappa.jp
Version: 1.3
Author: gqevu6bsiz
Author URI: http://gqevu6bsiz.chicappa.jp/author/admin/
Text Domain: pche
Domain Path: /
*/

define ('POST_CATEGORY_HEIGHT_EDIT_VER', '1.3');
define ('POST_CATEGORY_HEIGHT_EDIT_SLUG' , 'post-category-height-edit' );


function post_category_height_edit_plugin_action_links( $links , $file ) {

	if( plugin_basename(__FILE__) == $file ) {

		$support_link = '<a href="http://wordpress.org/support/plugin/' . POST_CATEGORY_HEIGHT_EDIT_SLUG . '" target="_blank">' . __( 'Support Forums' ) . '</a>';
		array_unshift( $links, $support_link );

	}

	return $links;

}

if( is_admin() ) {
	
	add_filter( 'plugin_action_links' , 'post_category_height_edit_plugin_action_links' , 10 , 2 );

	add_action('load-post.php', 'post_category_height_edit_is_category_box');
	add_action('load-post-new.php', 'post_category_height_edit_is_category_box');
	
}

function post_category_height_edit_is_category_box() {
	
	global $typenow;
	
	if( empty( $typenow ) )
		return false;
	
	$taxonomies = get_taxonomies( array() , 'objects' );
	
	if( empty( $taxonomies ) )
		return false;
	
	$categories_box_names = array();

	foreach( $taxonomies as $tax ) {
		
		if ( !$tax->show_ui || !$tax->show_in_menu || !in_array( $typenow , (array) $tax->object_type , true ) || !$tax->hierarchical )
			continue;

		$categories_box_names[] = $tax->name;
		
	}
	
	if( empty( $categories_box_names ) )
		return false;
	
	$ReadedJs = array( 'jquery' , 'jquery-ui-resizable' );
	wp_enqueue_script( 'post-category-height-edit' , plugin_dir_url( __FILE__ ).'/post-category-height-edit.js' , $ReadedJs , POST_CATEGORY_HEIGHT_EDIT_VER , true);
	wp_localize_script( 'post-category-height-edit' , 'pche' , $categories_box_names );

	add_action('admin_print_styles-post.php' , 'post_category_height_edit_print_css');
	add_action('admin_print_styles-post-new.php' , 'post_category_height_edit_print_css');

}

function post_category_height_edit_print_css() {
	
	echo '<style>';
	echo '.categorydiv .ui-resizable { position: relative; } ';

	echo '.categorydiv .ui-resizable-e, .categorydiv .ui-resizable-s { display: none; width: 0; height: 0; } ';

	/*
	echo '.categorydiv .ui-resizable-e { cursor: e-resize; width: 7px; height: 100%; right: -5px; top: 0; } ';
	echo '.categorydiv .ui-resizable-s { cursor: s-resize; width: 100%; height: 7px; bottom: -5px; left: 0; } ';
	*/
	echo '.categorydiv .ui-resizable-se { cursor: se-resize; width: 12px; height: 12px; right: 1px; bottom: 1px; display: block; position: absolute; }';
	echo '</style>';

}

