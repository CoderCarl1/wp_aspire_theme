<?php
/**
 * ACF Customizations
 *
 * @package      Aspire2Life_custom
 * @author       Carl Davidson
 * @since        1.0.0
 * @license      GNU General Public License v2 or later
 **/

if (!function_exists('aspire_custom_post_social_registration')) {
  add_action('init', 'aspire_custom_post_social_registration');
  add_action('acf/init', 'add_social_acf_fields');
  add_filter('acf/validate_value/type=url', 'aspire_custom_url_validation', 10, 4);

  function aspire_custom_post_social_registration() {
      $args = array(
          'public' => true,
          'menu_icon' => 'dashicons-facebook-alt',
          'label'  => 'Socials',
          'supports' => array('title', 'thumbnail'),
      );
      register_post_type('social', $args);
  }

  function add_social_acf_fields() {
      acf_add_local_field_group(array(
          'key' => 'group_social_fields',
          'title' => 'Social Fields',
          'fields' => array(
              array(
                  'key' => 'field_social_image',
                  'label' => 'Image',
                  'name' => 'social_image',
                  'type' => 'image',
              ),
              array(
                  'key' => 'field_social_url',
                  'label' => 'URL',
                  'name' => 'social_url',
                  'type' => 'url',
              ),
              array(
                  'key' => 'field_social_text',
                  'label' => 'Text',
                  'name' => 'social_text',
                  'type' => 'text',
              ),
          ),
          'location' => array(
              array(
                  array(
                      'param' => 'post_type',
                      'operator' => '==',
                      'value' => 'social',
                  ),
              ),
          ),
      ));
  }

  function aspire_custom_url_validation($valid, $value, $field, $input) {
      // Perform custom URL validation logic
      $parsed_url = parse_url($value);
  
      // Check if the URL is valid and matches the original value after adding "https://"
      if (!isset($parsed_url['scheme']) || empty($parsed_url['scheme']) || esc_url_raw($value) !== $value) {
          $valid = __('Invalid URL: Please enter a valid URL including the protocol (e.g., http:// or https://).', 'text-domain');
      }
  
      return $valid;
  }
}

if (!function_exists('aspire_custom_post_services_registration')) {
  add_action( 'init', 'aspire_custom_post_services_registration' );
  add_action('acf/init', 'add_services_acf_fields');

  function aspire_custom_post_services_registration() {
    $labels = array(
        'name'               => 'Services',
        'singular_name'      => 'Service',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Service',
        'edit_item'          => 'Edit Service',
        'new_item'           => 'New Service',
        'view_item'          => 'View Service',
        'search_items'       => 'Search Services',
        'not_found'          => 'No services found',
        'not_found_in_trash' => 'No services found in Trash',
        'parent_item_colon'  => 'Parent Service:',
        'menu_name'          => 'Services',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'menu_icon'          => 'dashicons-businesswoman',
        'menu_position'      => 5,
        'supports'           => array( 'title', 'thumbnail' ),
    );

    register_post_type( 'service', $args );
  }


  function add_services_acf_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_services_fields',
        'title' => 'Service Fields',
        'fields' => array(
            array(
                'key' => 'field_service_image',
                'label' => 'Image',
                'name' => 'service_image',
                'type' => 'image',
            ),
            array(
                'key' => 'field_service_short_explanation',
                'label' => 'Short Explanation',
                'name' => 'service_short_explanation',
                'type' => 'text',
                'maxlength' => 100,
            ),
            array(
                'key' => 'field_service_detailed_explanation',
                'label' => 'Detailed Explanation',
                'name' => 'service_detailed_explanation',
                'type' => 'wysiwyg',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'service',
                ),
            ),
        ),
    ));
}


}

if (!function_exists('aspire_reorder_dashboard_menu')) {
  add_action('admin_menu', 'aspire_reorder_dashboard_menu');

  function aspire_reorder_dashboard_menu() {
    // Get the global $menu variable
    global $menu;

    // Define the desired menu order
    $menu_order = array(
        'edit.php?post_type=social', // Socials (New post type)
        'edit.php?post_type=service', // Services (New post type)
        'edit.php?post_type=page', // Pages
        'index.php', // Dashboard
        'edit.php', // Posts
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

if (!function_exists('aspire_custom_taxonomy_imagecategory')) {
  // TODO: WIP
  // add_action('init', 'aspire_custom_taxonomy_imagecategory');
  // add_filter('attachment_fields_to_edit', 'display_imagecategories_field', 10, 2);
  // add_filter('attachment_fields_to_save', 'save_imagecategories_field', 10, 2);
  
  function aspire_custom_taxonomy_imagecategory() {
    $labels = array(
        'name'                       => 'Image Categories',
        'singular_name'              => 'Image Category',
        'search_items'               => 'Search Image Category',
        'popular_items'              => 'Popular Image Categories',
        'all_items'                  => 'All Image Categories',
        'edit_item'                  => 'Edit Image Category',
        'update_item'                => 'Update Image Category',
        'add_new_item'               => 'Add New Image Category',
        'new_item_name'              => 'New Image Category Name',
        'separate_items_with_commas' => 'Separate Categories with commas',
        'add_or_remove_items'        => 'Add or remove Categories',
        'choose_from_most_used'      => 'Choose from the most used Categories',
        'not_found'                  => 'No Categories found',
        'menu_name'                  => 'Image Categories',
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'imagecategory'),
    );

    register_taxonomy('imagecategory', 'attachment', $args);
  }

  // Display the custom taxonomy field in the media attachment details
  function display_imagecategories_field($form_fields, $post) {
    $taxonomy = 'imagecategory';

    // Retrieve the current category(s) assigned to the image
    $categories = wp_get_object_terms($post->ID, $taxonomy, array('fields' => 'ids'));

    // Get all available categories from the taxonomy
    $all_categories = get_terms($taxonomy, array('hide_empty' => false));

    // Build the select field options
    $options = '<option value="">' . __('None') . '</option>';
    foreach ($all_categories as $category) {
        $selected = in_array($category->term_id, $categories) ? 'selected="selected"' : '';
        $options .= '<option value="' . $category->term_id . '" ' . $selected . '>' . $category->name . '</option>';
    }

    // Add the select field to the form fields
    $form_fields['imagecategories'] = array(
        'label' => __('Select from existing Categories'),
        'input' => 'html',
        'html'  => '<select name="attachments[' . $post->ID . '][imagecategories][]" multiple="multiple">' . $options . '</select>',
        'helps' => __('Select the categories for the image.'),
    );

    return $form_fields;
  }

  // Save the custom taxonomy field when saving the media attachment
  function save_imagecategories_field($post, $attachment) {
    error_log(print_r($post, true)); // Debug: Check the $post variable
    error_log(print_r($attachment, true)); // Debug: Check the $attachment variable
  
    if (isset($attachment['imagecategories'])) {
        $taxonomy = 'imagecategory';
        $categories = array_map('intval', $attachment['imagecategories']);

        // Set the selected categories for the image
        wp_set_object_terms($post['ID'], $categories, $taxonomy);
    }
    return $post;
  }
}
