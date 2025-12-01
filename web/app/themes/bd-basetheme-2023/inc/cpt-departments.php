<?php // Register Custom Post Type for Department Post with 1 Tax
function cpt_bd_departments()
{
    $labels = array(
        'name' => _x('Department Posts', 'Post Type General Name', 'bd-basetheme-2023'),
        'singular_name' => _x('Department Post', 'Post Type Singular Name', 'bd-basetheme-2023'),
        'menu_name' => __('Department Posts', 'bd-basetheme-2023'),
        'name_admin_bar' => __('Department Post', 'bd-basetheme-2023'),
        'archives' => __('Department Post Archives', 'bd-basetheme-2023'),
        'attributes' => __('Department Post Attributes', 'bd-basetheme-2023'),
        'parent_item_colon' => __('Parent Department Post:', 'bd-basetheme-2023'),
        'all_items' => __('All Department Posts', 'bd-basetheme-2023'),
        'add_new_item' => __('Add New Department Post', 'bd-basetheme-2023'),
        'add_new' => __('Add New', 'bd-basetheme-2023'),
        'new_item' => __('New Department Post', 'bd-basetheme-2023'),
        'edit_item' => __('Edit Department Post', 'bd-basetheme-2023'),
        'update_item' => __('Update Department Post', 'bd-basetheme-2023'),
        'view_item' => __('View Department Post', 'bd-basetheme-2023'),
        'view_items' => __('View Department Posts', 'bd-basetheme-2023'),
        'search_items' => __('Search Department Posts', 'bd-basetheme-2023'),
        'not_found' => __('Not found', 'bd-basetheme-2023'),
        'not_found_in_trash' => __('Not found in Trash', 'bd-basetheme-2023'),
        'featured_image' => __('Featured Image', 'bd-basetheme-2023'),
        'set_featured_image' => __('Set featured image', 'bd-basetheme-2023'),
        'remove_featured_image' => __('Remove featured image', 'bd-basetheme-2023'),
        'use_featured_image' => __('Use as featured image', 'bd-basetheme-2023'),
        'insert_into_item' => __('Insert into Department Post', 'bd-basetheme-2023'),
        'uploaded_to_this_item' => __('Uploaded to this Department Post', 'bd-basetheme-2023'),
        'items_list' => __('Department Posts list', 'bd-basetheme-2023'),
        'items_list_navigation' => __('Department Posts list navigation', 'bd-basetheme-2023'),
        'filter_items_list' => __('Filter Department Posts list', 'bd-basetheme-2023'),
    );
    $args = array(
        'label' => __('Department Post', 'bd-basetheme-2023'),
        'description' => __('County government departments and offices', 'bd-basetheme-2023'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'page-attributes'),
        'taxonomies' => array('post_tag'),
        'hierarchical' => true,
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
        'rewrite'   => array('slug' => 'departments'),
    );
    register_post_type('department', $args);
}
add_action('init', 'cpt_bd_departments', 0);

// hook into the init action and call create
add_action('init', 'create_department_posts_tax', 0);


// create a Department Post type tax
function create_department_posts_tax()
{
    // Add new taxonomy, make it hierarchical (like types)
    $labels = array(
        'name'              => _x('Department Post Categories', 'taxonomy general name', 'textdomain'),
        'post_name'     => _x('Department Post Categories', 'taxonomy Department post name', 'textdomain'),
        'search_items'      => __('Search Department Post Categories', 'textdomain'),
        'all_items'         => __('All Department Categories', 'textdomain'),
        'parent_item'       => __('Parent Department Category', 'textdomain'),
        'parent_item_colon' => __('Parent Department Category:', 'textdomain'),
        'edit_item'         => __('Edit Department Category', 'textdomain'),
        'update_item'       => __('Update Department Category', 'textdomain'),
        'add_new_item'      => __('Add New Department Category', 'textdomain'),
        'new_item_name'     => __('New Department Category', 'textdomain'),
        'menu_name'         => __('Department Categories', 'textdomain'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'department-categories'),
        'show_in_rest' => true,
    );

    register_taxonomy('department_posts_tax', array('department'), $args);
}
