<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php bloginfo( 'description' ); ?>">
  <link rel="shortcut icon" href="images/logo.png">
  <?php 
    wp_head(); 
  ?>
</head>
<body class="container">
  <header>
    <nav id="primary-navigation" class="primary-navigation" role="primary navigation">
    <?php 
      wp_nav_menu(
        array(
          'menu' => 'primary',
          'theme_location' => 'primary',
          'fallback_cb' => 'wp_page_menu',
          'container' => '',
          'theme_location' => 'primary',
          'items_wrap' => '<ul class="primary-navigation_list">%3$s</ul>',
          'item_spacing' => 'discard'
        )
      );
    ?>
    </nav>
  </header>