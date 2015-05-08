<?php
/**
 * @package Universe_Events
 * @version 1.0
 */
/*
Plugin Name: Universe Events
Plugin URI: https://www.universe.com/wordpress
Description: This plugin transforms Universe-links into ready-to-use ticket shopping. Need to sell tickets on your WordPress site? Register your event on Universe.com and get selling quickly! Visitors won't even have to leave your site.
Author: Joshua Kelly
Version: 1.0
Author URI: http://robotfuture.net
*/

// Appends embed.js to the header
function universe_embed_script() {
  wp_register_script( 'universe-script', 'https://www.universe.com/embed.js' );

  // For either a plugin or a theme, you can then enqueue the script:
  wp_enqueue_script( 'universe-script' );
}
add_action( 'wp_enqueue_scripts', 'universe_embed_script' );


function universe_shortcode( $atts, $content) {
  $params = shortcode_atts( array(
    'url' => 'https://universe.desk.com/bad-shortcode'
  ), $atts );

  if ($content === "") {
    $content = "Buy Tickets"; 
  }

  return '<a href="' . $params['url'] . '">' . $content . '</a>';
}
add_shortcode( 'universe', 'universe_shortcode' );


add_action( 'init', 'universe_buttons' );
function universe_buttons() {
    add_filter( 'mce_external_plugins', "universe_add_buttons" );
    add_filter( 'mce_buttons', 'universe_register_buttons' );
}
function universe_add_buttons( $plugin_array ) {
    $plugin_array['universe'] = plugins_url() . '/universe/universe-plugin.js';
    return $plugin_array;
}
function universe_register_buttons( $buttons ) {
    array_push( $buttons, 'universe');
    return $buttons;
}

?>
