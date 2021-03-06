<?php

/* Basic Settings */
add_theme_support( 'post-thumbnails' );

/* Add excerpts to pages */
function add_excerpts_to_pages() {
  add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'add_excerpts_to_pages' );

/* Load Scripts and Styles */
function load_styles() {
  wp_enqueue_style('main-style', get_bloginfo('template_url') . '/assets/main.css', array());
}

function load_scripts() {
  wp_enqueue_script( 'react-app', get_template_directory_uri() . '/assets/main.js', array(), 1.0, true );
}

function load_blocks() {
  wp_register_script(
    'gutenberg-boilerplate-esnext-step01',
    get_template_directory_uri() . '/assets/block.js',
    array( 'wp-blocks', 'wp-element' )
  );
  wp_register_style(
    'gutenberg-boilerplate-esnext-step01',
    get_template_directory_uri() . '/assets/block.css',
    array( 'wp-edit-blocks' )
  );

  register_block_type(
    'gutenberg-boilerplate-esnext/hello-world-step-01', array(
      'editor_script' => 'gutenberg-boilerplate-esnext-step01',
      'style' => 'gutenberg-boilerplate-esnext-step01'
    )
  );
}

add_action('wp_enqueue_scripts', 'load_styles');
add_action('wp_enqueue_scripts', 'load_scripts');
add_action('init', 'load_blocks');

/* Disable the horrible security hole that is password is incorrect message. */
function no_wordpress_errors(){
  return 'Sorry, that username or password was incorrect.';
}
add_filter( 'login_errors', 'no_wordpress_errors' );
