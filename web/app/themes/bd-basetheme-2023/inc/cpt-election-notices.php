<?php // Register Custom Post Type for Election Notice Post with 1 Tax
function cpt_bd_electionnotices()
{
    $labels = array(
        'name' => _x('Election Notice Posts', 'Post Type General Name', 'bd-basetheme-2023'),
        'singular_name' => _x('Election Notice Post', 'Post Type Singular Name', 'bd-basetheme-2023'),
        'menu_name' => __('Election Notice Posts', 'bd-basetheme-2023'),
        'name_admin_bar' => __('Election Notice Post', 'bd-basetheme-2023'),
        'archives' => __('Election Notice Post Archives', 'bd-basetheme-2023'),
        'attributes' => __('Election Notice Post Attributes', 'bd-basetheme-2023'),
        'parent_item_colon' => __('Parent Election Notice Post:', 'bd-basetheme-2023'),
        'all_items' => __('All Election Notice Posts', 'bd-basetheme-2023'),
        'add_new_item' => __('Add New Election Notice Post', 'bd-basetheme-2023'),
        'add_new' => __('Add New', 'bd-basetheme-2023'),
        'new_item' => __('New Election Notice Post', 'bd-basetheme-2023'),
        'edit_item' => __('Edit Election Notice Post', 'bd-basetheme-2023'),
        'update_item' => __('Update Election Notice Post', 'bd-basetheme-2023'),
        'view_item' => __('View Election Notice Post', 'bd-basetheme-2023'),
        'view_items' => __('View Election Notice Posts', 'bd-basetheme-2023'),
        'search_items' => __('Search Election Notice Posts', 'bd-basetheme-2023'),
        'not_found' => __('Not found', 'bd-basetheme-2023'),
        'not_found_in_trash' => __('Not found in Trash', 'bd-basetheme-2023'),
        'featured_image' => __('Featured Image', 'bd-basetheme-2023'),
        'set_featured_image' => __('Set featured image', 'bd-basetheme-2023'),
        'remove_featured_image' => __('Remove featured image', 'bd-basetheme-2023'),
        'use_featured_image' => __('Use as featured image', 'bd-basetheme-2023'),
        'insert_into_item' => __('Insert into Election Notice Post', 'bd-basetheme-2023'),
        'uploaded_to_this_item' => __('Uploaded to this Election Notice Post', 'bd-basetheme-2023'),
        'items_list' => __('Election Notice Posts list', 'bd-basetheme-2023'),
        'items_list_navigation' => __('Election Notice Posts list navigation', 'bd-basetheme-2023'),
        'filter_items_list' => __('Filter Election Notice Posts list', 'bd-basetheme-2023'),
    );
    $args = array(
        'label' => __('Election Notice Post', 'bd-basetheme-2023'),
        'description' => __('Election Notice Post roster for Cornerstone Center for Early Learning', 'bd-basetheme-2023'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'page-attributes'),
        'taxonomies' => array('post_tag'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
        'show_in_rest' => true,
        'rewrite'   => array('slug' => 'election-notices'),
    );
    register_post_type('electionnotice', $args);
}
add_action('init', 'cpt_bd_electionnotices', 0);

// hook into the init action and call create
add_action('init', 'create_electionnotice_posts_tax', 0);


// create a Election Notice Post type tax
function create_electionnotice_posts_tax()
{
    // Add new taxonomy, make it hierarchical (like types)
    $labels = array(
        'name'              => _x('Election Notice Post Categories', 'taxonomy general name', 'textdomain'),
        'post_name'     => _x('Election Notice Post Categories', 'taxonomy Election Notice post name', 'textdomain'),
        'search_items'      => __('Search Election Notice Post Categories', 'textdomain'),
        'all_items'         => __('All Election Notice Categories', 'textdomain'),
        'parent_item'       => __('Parent Election Notice Category', 'textdomain'),
        'parent_item_colon' => __('Parent Election Notice Category:', 'textdomain'),
        'edit_item'         => __('Edit Election Notice Category', 'textdomain'),
        'update_item'       => __('Update Election Notice Category', 'textdomain'),
        'add_new_item'      => __('Add New Election Notice Category', 'textdomain'),
        'new_item_name'     => __('New Election Notice Category', 'textdomain'),
        'menu_name'         => __('Election Notice Categories', 'textdomain'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'election-notice-categories'),
        'show_in_rest' => true,
    );

    register_taxonomy('electionnotice_posts_tax', array('electionnotice'), $args);
}
