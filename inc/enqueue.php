<?php
/**
 * enqueue scripts for CSS and JS
 *
 * @package      Aspire2Life_custom
 * @author       Carl Davidson
 * @since        1.0.0
 * @license      GNU General Public License v2 or later
 **/


if ( ! function_exists( 'aspire_enqueue_stylesheet' ) ) {
  add_action( 'wp_enqueue_scripts', 'aspire_enqueue_stylesheet', 20 );

  function aspire_enqueue_stylesheet() {
    $version = wp_get_theme()->get( 'Version' );
    if ( false === $version ) {
			$version = time();
		}

    wp_register_style( 'aspire-stylesheet', get_stylesheet_uri(), array(), $version ); 
    wp_enqueue_style( 'aspire-stylesheet' );
    wp_register_style( 'aspire-stylesheet-scss', get_template_directory_uri() . '/assets/css/main.css', false, $version ); 
    wp_enqueue_style( 'aspire-stylesheet-scss' );
  }
}

if ( ! function_exists( 'aspire_add_javascript' ) ) {
  add_action( 'wp_enqueue_scripts', 'aspire_add_javascript' );
  function aspire_add_javascript() {
    $file    = '/assets/js/main.js';
		$version = filemtime( get_template_directory() . $file );

    if ( false === $version ) {
			$version = time();
		}

    wp_enqueue_script(
			'aspire-javascript',
			get_template_directory_uri() . $file,
			false,
			(string) $version,
			true
		);

  }
}