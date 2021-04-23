<?php
/*
Plugin Name: Team Comments Slider
Plugin Slug: team_comments_slider
Plugin URI: 
Description: This is a post slider plugin for Digital marketing consultancy. Use team slider widget or 'team_comments_slider' shortcode to print slider.
Version: 1
Author: Rishni Meemeduma
Author URI: https://github.com/RishniMeemeduma
License: GPL
Copyright: Elliot Condon
*/
define('tcs_slider',true);
function tcs_post_type(){
    register_post_type('comment_slider',array('public'=>true,'label'=>'Team Comments Slider','supports'=>array('thumbnail','editor','title', 'excerpt', 'custom-fields')));
}
add_action('init','tcs_post_type');

add_action( 'init', 'tcs_add_custom_fileds_support_for_cpt', 11 );
function tcs_add_custom_fileds_support_for_cpt() {
    add_post_type_support( 'comment_slider', 'custom-fields' ); // Change cpt to your post type
}

function tcs_scripts(){
    wp_enqueue_script('js',plugins_url('comments_slider/assets/js/jquery-1.11.2.min.js'));
    wp_enqueue_script('bootstrap_js',plugins_url('comments_slider/assets/js/bootstrap.min.js'));
    wp_enqueue_script('owl_carosal_js',plugins_url('comments_slider/assets/js/main.js'));
}
add_action('register_scripts','tcs_scripts');

function tcsr_styles(){
     wp_enqueue_style('bootstrap_css',plugins_url('comments_slider/assets/css/bootstrap.min.css'));
    wp_enqueue_style('owl_carosal_style',plugins_url('comments_slider/assets/css/owl-carousel.css'));
}
add_action('register_styles','tcs_styles');

function tcs_function($posts_per_page=false){
    if(!$posts_per_page){$posts_per_page==5;}
    $args = array('post_type'=>'comment_slider','posts_per_page'=>$posts_per_page);
    $result = '<div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div id="owl-testimonials" class="owl-carousel owl-theme">';
    $loop = new WP_Query($args);
    while($loop->have_posts()):$loop->the_post();
        $result .='<div class="item"><div class="testimonials-item">';
        $result .= apply_filters('the_content',  get_the_content());
            $custom_field = get_post_custom($loop->get_the_id());
            $blogger_name = $custom_field['author'];
            $blogger_title = $custom_field['title'];
            $result .= '<h4>'.implode(',',$blogger_name).'</h4>';
            $result .= '<span>'.implode(',',$blogger_title).'</span>';
        $result.='</div></div>';
        
    endwhile;
    $result.='</div></div></div></div>';
    
    return $result;
}

add_shortcode('team_comments_slider','tcs_function');

require_once plugin_dir_path(__FILE__).'/includes/class_team_slider.php';

function tcs_slider_widget(){
    register_widget('tcs_widget');
}
add_action('widgets_init','tcs_slider_widget');

function tcs_widget_area_for_slider(){
    register_sidebar(array(
        'name'=>'Team comments slider widget',
        'id'=>'team_comments_slider',
        'description'=>'slider',
        'before_widget'=>'',
        'after_widget'=>'',
        'before_title'=>'<h4>',
        'after_title'=>'</h4>'
    ));
}
add_action('widgets_init','tcs_widget_area_for_slider');

/**
 * Initialize the plugin tracker
 *
 * @return void
 */
function appsero_init_tracker_team_memeber_comments_slider_plugin() {

    if ( ! class_exists( 'Appsero\Client' ) ) {
      require_once __DIR__ . '/appsero/src/Client.php';
    }

    $client = new Appsero\Client( 'd8bbde37-fe6b-49dc-a4b6-00f3d3b17e78', 'Team memeber comments slider plugin', __FILE__ );

    // Active insights
    $client->insights()->init();

    // Active automatic updater
//    $client->updater();

}

appsero_init_tracker_team_memeber_comments_slider_plugin();
