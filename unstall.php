<?php // exit if uninstall constant is not defined
if (!defined('WP_UNINSTALL_PLUGIN')) exit;

// delete custom post type posts
//$sliderplugin_args = array('post_type'=>'comment_slider','posts_per_page'=>'-1');
//$sliderplugin_posts = get_posts($sliderplugin_args);
//foreach($sliderplugin_args as $post){
//    wp_delete_post($post->ID,false);
//}