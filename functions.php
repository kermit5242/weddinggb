<?php

function setup() {
  // Enable features from Soil when plugin is activated
  // https://roots.io/plugins/soil/

  add_theme_support('custom-logo');

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('wedding', get_template_directory() . '/lang');
	
  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage'),
  	'seo_footer' => __( 'Footer Links', 'twentyten' )
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  add_post_type_support( 'page', 'excerpt' );
  
}
add_action('after_setup_theme', 'setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'sage'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer', 'sage'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_front_page(),
    is_page_template('template-custom.php'),
  ]);

  return apply_filters('sage/display_sidebar', $display);
}

/**
 * Theme assets
 */
function assets() {
  wp_enqueue_style('css', get_stylesheet_directory_uri() . '/style.css', false, null);
  wp_enqueue_style('otw-grid', get_stylesheet_directory_uri() . '/css/otw-grid.css', false, null);
  wp_enqueue_style('otw-portfolio-manager', get_stylesheet_directory_uri() . '/css/otw-portfolio-manager.css', false, null);
  wp_enqueue_style('fontawesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css', false, null);
  //wp_enqueue_style('demo', get_stylesheet_directory_uri() . '/css/demo.css', false, null);
  //wp_enqueue_style('default', get_stylesheet_directory_uri() . '/css/default.css', false, null);

  wp_enqueue_script('flexslider', get_stylesheet_directory_uri() . '/js/jquery.flexslider.min.js', ['jquery'], null, true);
  wp_enqueue_script('fancybox', get_stylesheet_directory_uri() . '/js/jquery.fancybox.min.js', ['jquery'], null, true);
  wp_enqueue_script('isotope', get_stylesheet_directory_uri() . '/js/jquery.isotope.min.js', ['jquery'], null, true);
  wp_enqueue_script('app', get_stylesheet_directory_uri() . '/js/script.js', ['jquery'], null, true);

  if (is_rtl()) {
  	wp_enqueue_style('sage/css-rtl', get_stylesheet_directory_uri().'styles/style-rtl.css', false, 'sage/css');
  }  
}
add_action('wp_enqueue_scripts', 'assets', 100);
