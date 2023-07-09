<?php
/**
 * ACF Customizations
 *
 * @package      Aspire2Life_custom
 * @author       Carl Davidson
 * @since        1.0.0
 * @license      GNU General Public License v2 or later
 **/

if ( ! function_exists( 'aspire_theme_support' ) ) {
  add_action( 'after_setup_theme', 'aspire_theme_support' );
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   * @return void
   */
  function aspire_theme_support() {

    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );

    // Enqueue editor styles.
    add_editor_style( 'style.css' );
    
  }

}
