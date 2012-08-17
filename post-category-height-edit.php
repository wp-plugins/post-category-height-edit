<?php
/*
Plugin Name: Post Category Height Edit
Description: Adjust the height of the categories posting.
Plugin URI: http://gqevu6bsiz.chicappa.jp
Version: 1.0.0
Author: gqevu6bsiz
Author URI: http://gqevu6bsiz.chicappa.jp/author/admin/
Text Domain: post-category-height-edit
Domain Path: /
*/
define ('POST_CATEGORY_HEIGHT_EDIT_VER', '1.0.0');
?>
<?php
function post_category_height_edit() {
	global $pagenow;

	if($pagenow == 'post.php' or $pagenow == 'post-new.php') {
		$this_Dir = WP_PLUGIN_URL . '/'.dirname(plugin_basename(__FILE__));
		$ReadedJs = array( 'jquery' , 'jquery-ui-resizable' );
		wp_enqueue_script( 'post-category-height-edit' , $this_Dir.'/post-category-height-edit.js' , $ReadedJs , POST_CATEGORY_HEIGHT_EDIT_VER , true);
	}
}

if ( is_blog_admin() ) {
	add_action('init', 'post_category_height_edit');
}
?>