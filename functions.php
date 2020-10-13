<?php
/* Basics */
function iszen_init() {
	load_theme_textdomain( 'sec', get_template_directory() . '/languages' );
	global $content_width;
	if ( ! isset( $content_width ) ) { $content_width = 1920; }
}
add_action( 'wp_enqueue_scripts', 'iszen_init' );

function iszen_register_menus() {
  register_nav_menus(
    array(
      'main-menu' => __( 'Main Menu' ),
    )
  );
}
add_action( 'init', 'iszen_register_menus' );

function iszen_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'mobile', get_template_directory_uri() . '/js/mobile.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'iszen_scripts' );

function iszen_widgets_init() {
	register_sidebar( array (
	'name' => __( 'Sidebar Widget Area', 'iszen' ),
	'id' => 'primary-widget-area',
	'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
	'after_widget' => "</li>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'iszen_widgets_init' );

function iszen_add_search_form($items, $args) {
if( $args->theme_location == 'main-menu' )
        $items .= '<li class="search"><form role="search" method="get" id="searchform" action="'.home_url( '/' ).'"><input type="text" value="cerca nel sito" name="s" id="s" /><input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" /></form></li>';
        return $items;
}
add_filter('wp_nav_menu_items', 'iszen_add_search_form', 10, 2);


function iszen_nested_comment() {
	if ( get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'comment_form_before', 'iszen_nested_comment' );

function iszen_read_more() {
	if ( ! is_admin() ) {
	return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">	&nbsp;&#62;</a>';
	}
}
add_filter( 'the_content_more_link', 'iszen_read_more' );

function iszen_excerpt_more( $more ) {
	if ( ! is_admin() ) {
	global $post;
	return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">	&nbsp;&#62;</a>';
	}
}
add_filter( 'excerpt_more', 'iszen_excerpt_more' );

function iszen_add_google_fonts() {
	wp_enqueue_style( 'iszen_google_fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,700,300', false ); 
	}
add_action( 'wp_enqueue_scripts', 'iszen_add_google_fonts' );

add_theme_support( 'editor-styles' );
add_editor_style( 'style-editor.css' );

add_theme_support( 'post-thumbnails' );


/* Disable the emoji's */

function disable_emojis() {
	 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	 remove_action( 'wp_print_styles', 'print_emoji_styles' );
	 remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
	 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
	 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	 add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

function disable_emojis_tinymce( $plugins ) {
	 if ( is_array( $plugins ) ) {
	 return array_diff( $plugins, array( 'wpemoji' ) );
	 } else {
	 return array();
	 }
}

function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	 if ( 'dns-prefetch' == $relation_type ) {
		 /** This filter is documented in wp-includes/formatting.php */
		 $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	 }
	return $urls;
}

add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );


