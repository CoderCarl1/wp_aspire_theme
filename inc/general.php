<?php
/**
 * General Aspire Customizations
 *
 * @package      Aspire2Life_custom
 * @author       Carl Davidson
 * @since        1.0.0
 * @license      GNU General Public License v2 or later
 **/

 if ( ! function_exists( 'aspire_add_navigation' ) ) {
  add_action( 'init', 'aspire_add_navigation' );
  function aspire_add_navigation() {
    $locations = array(
      'primary' => __( 'Top and Sidebar' ),
      'footer' => __( 'Footer Logo and Menu Items' ),

    );
    register_nav_menus( $locations );
  }
}


/** 
 * Admin dashboard cleanup
 *  
*/
if ( ! function_exists( 'aspire_remove_submenus' ) ) {
  add_action( 'admin_menu', 'aspire_remove_submenus', 999);
  function aspire_remove_submenus() {
      remove_submenu_page( 'themes.php', 'nav-menus.php' );
  }
}


if (!function_exists('aspire_reorder_dashboard_menu')) {
  add_action('admin_menu', 'aspire_add_Menus_To_Admin');
  add_action('admin_menu', 'aspire_reorder_dashboard_menu');

  function aspire_add_Menus_To_Admin() {
    add_menu_page(
      'Menus',
      'Menus',
      'edit_theme_options',
      'nav-menus.php',
      '',
      'dashicons-list-view',
      68
   );
  }

  function aspire_reorder_dashboard_menu() {
    // Get the global $menu variable
    global $menu;

    // Define the desired menu order
    $menu_order = array(
        'edit.php?post_type=social', // Socials (New post type)
        'edit.php?post_type=service', // Services (New post type)
        'edit.php?post_type=page', // Pages
        'nav-menus.php', // Menus
        'index.php', // Dashboard
        'edit.php', // Posts
        '',
        'upload.php', // Media
        'edit-comments.php', // Comments
        'themes.php', // Appearance
        'plugins.php', // Plugins
        'users.php', // Users
        'tools.php', // Tools
        'options-general.php', // Settings
    );

    // Create an array to hold the reordered menu items
    $reordered_menu = array();

    // Loop through the menu items and reorder them
    foreach ($menu as $menu_item) {
        // Get the menu slug from the menu item URL
        $menu_slug = remove_query_arg(array('settings-updated', 'updated'), $menu_item[2]);

        // Find the position of the menu item in the desired order
        $position = array_search($menu_slug, $menu_order);

        // If the menu item is found in the desired order, add it to the reordered menu array
        if ($position !== false) {
            $reordered_menu[$position] = $menu_item;
        }
    }

    // Sort the reordered menu items based on the new positions
    ksort($reordered_menu);

    // Reset the menu keys to ensure continuous numerical keys
    $reordered_menu = array_values($reordered_menu);

    // Assign the reordered menu items back to the global $menu variable
    $menu = $reordered_menu;
  }
}