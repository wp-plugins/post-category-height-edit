<?php
/*
Plugin Name: Post Category Height Edit
Description: It is adjustable plugin the height of the category meta box of edit posts screen.
Plugin URI: http://gqevu6bsiz.chicappa.jp
Version: 1.2.1
Author: gqevu6bsiz
Author URI: http://gqevu6bsiz.chicappa.jp/author/admin/
Text Domain: pche
Domain Path: /
*/
define ('POST_CATEGORY_HEIGHT_EDIT_VER', '1.2.1');
?>
<?php
function post_category_height_edit() {
	$ReadedJs = array( 'jquery' , 'jquery-ui-resizable' );
	wp_enqueue_script( 'post-category-height-edit' , plugin_dir_url( __FILE__ ).'/post-category-height-edit.js' , $ReadedJs , POST_CATEGORY_HEIGHT_EDIT_VER , true);
}

if ( is_admin() ) {
	add_action('load-post.php', 'post_category_height_edit');
	add_action('load-post-new.php', 'post_category_height_edit');
}


function post_category_height_edit_plugin_action_links( $links , $file ) {
		if( plugin_basename(__FILE__) == $file ) {
			$support_link = '<a href="http://wordpress.org/support/plugin/post-category-height-edit" target="_blank">' . __( 'Support Forums' ) . '</a>';
			array_unshift( $links, $support_link );
		}
		return $links;
}
add_filter( 'plugin_action_links' , 'post_category_height_edit_plugin_action_links' , 10 , 2 );

?>