<?php

class tcs_widget extends WP_Widget{
    public function __construct() {
        parent::__construct('team_commnts_widget','Team comments slider widget',array('description'=>__('A slideshow for Team comments','text_domain')));
    }
    
    public function form($instance){
        if(isset($instance['title'])){
            $title = $instance['title'];
        }else{
            $title = __('Team comments slider','text_domain');
        }
        if(isset($instance['posts_per_page'])){
            $posts_per_page = $instance['posts_per_page'];
        }else{
            $posts_per_page = __('5','text_domain');
        }
        echo "<p>";
        echo "<label for=".  $this->get_field_id('title').">"._e('Title')."</label>";
        echo "<input class='widefat' id=".$this->get_field_id('title')." name=".$this->get_field_name('title')." value='".esc_attr($title)."' type='text'>";
        echo "</p>";
        echo "<p>";
        echo "<label for=".$this->get_field_id('posts_per_page').">"._e('Posts Per Page')."</label>";
        echo "<input class='widefat' id=".$this->get_field_id('posts_per_page')." name=".$this->get_field_name('posts_per_page')." value=".esc_attr($posts_per_page)." type='number'>";
    }
    
    public function update($new_instance,$old_instance){
        $instance = array();
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['posts_per_page'] = strip_tags($new_instance['posts_per_page']);
        return $instance;
    }
    
    public function widget($args,$instance){
        extract($args);
        //title
        $title = apply_filters('widget_title',$instance['title']);
        $posts_per_page = apply_filters('widget_posts_per_page',$instance['posts_per_page']);
        echo $before_widget;
        if(!empty($title)){
            echo $before_title. $title . $after_title;
        }
        if(!empty($posts_per_page)){
            $before_posts_per_page. $posts_per_page . $after_posts_per_page;
        }
        echo tcs_function($posts_per_page);
        echo $after_widget;
    }
    
    
}