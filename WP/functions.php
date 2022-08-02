<?php

add_action('wp_enqueue_scripts', 'theme_styles');
add_action('wp_enqueue_scripts', 'theme_scripts');
add_action('after_setup_theme', 'theme_menu');

function theme_styles() {
  wp_enqueue_style('Roboto', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400&amp;display=swap', array(), null, 'all');
  wp_enqueue_style('libs', get_template_directory_uri() . '/assets/css/libs.min.css');
  wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css');
}

function theme_scripts() {
  wp_deregister_script('jquery');
  wp_enqueue_script('slick', get_template_directory_uri() . '/assets/js/libs.min.js', null, null, true);
  wp_enqueue_script('scripts', get_template_directory_uri() . '/assets/js/scripts.js', null, null, true);
}

function theme_menu() {
  register_nav_menu( 'top', 'Верхнее меню' );
}

add_theme_support('custom-logo');
add_theme_support('post-thumbnails');

remove_filter('the_content', 'wpautop');

add_filter( 'big_image_size_threshold', '__return_false' );
