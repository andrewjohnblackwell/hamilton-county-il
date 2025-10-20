<?php // Register Custom Post Type for County Board Meeting with 1 Tax
function cpt_bd_countyboardmeetings()
{
    $labels = array(
        'name' => _x('County Board Meetings', 'Post Type General Name', 'bd-basetheme-2023'),
        'singular_name' => _x('County Board Meeting', 'Post Type Singular Name', 'bd-basetheme-2023'),
        'menu_name' => __('County Board Meetings', 'bd-basetheme-2023'),
        'name_admin_bar' => __('County Board Meeting', 'bd-basetheme-2023'),
        'archives' => __('County Board Meeting Archives', 'bd-basetheme-2023'),
        'attributes' => __('County Board Meeting Attributes', 'bd-basetheme-2023'),
        'parent_item_colon' => __('Parent County Board Meeting:', 'bd-basetheme-2023'),
        'all_items' => __('All County Board Meetings', 'bd-basetheme-2023'),
        'add_new_item' => __('Add New County Board Meeting', 'bd-basetheme-2023'),
        'add_new' => __('Add New', 'bd-basetheme-2023'),
        'new_item' => __('New County Board Meeting', 'bd-basetheme-2023'),
        'edit_item' => __('Edit County Board Meeting', 'bd-basetheme-2023'),
        'update_item' => __('Update County Board Meeting', 'bd-basetheme-2023'),
        'view_item' => __('View County Board Meeting', 'bd-basetheme-2023'),
        'view_items' => __('View County Board Meetings', 'bd-basetheme-2023'),
        'search_items' => __('Search County Board Meetings', 'bd-basetheme-2023'),
        'not_found' => __('Not found', 'bd-basetheme-2023'),
        'not_found_in_trash' => __('Not found in Trash', 'bd-basetheme-2023'),
        'featured_image' => __('Featured Image', 'bd-basetheme-2023'),
        'set_featured_image' => __('Set featured image', 'bd-basetheme-2023'),
        'remove_featured_image' => __('Remove featured image', 'bd-basetheme-2023'),
        'use_featured_image' => __('Use as featured image', 'bd-basetheme-2023'),
        'insert_into_item' => __('Insert into County Board Meeting', 'bd-basetheme-2023'),
        'uploaded_to_this_item' => __('Uploaded to this County Board Meeting', 'bd-basetheme-2023'),
        'items_list' => __('County Board Meetings list', 'bd-basetheme-2023'),
        'items_list_navigation' => __('County Board Meetings list navigation', 'bd-basetheme-2023'),
        'filter_items_list' => __('Filter County Board Meetings list', 'bd-basetheme-2023'),
    );
    $args = array(
        'label' => __('County Board Meeting', 'bd-basetheme-2023'),
        'description' => __('County Board Meeting roster for Cornerstone Center for Early Learning', 'bd-basetheme-2023'),
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
        'rewrite'   => array('slug' => 'county-board-meetings'),
    );
    register_post_type('countyboardmeeting', $args);
}
add_action('init', 'cpt_bd_countyboardmeetings', 0);

// hook into the init action and call create
add_action('init', 'create_countyboardmeeting_posts_tax', 0);


// create a County Board Meeting type tax
function create_countyboardmeeting_posts_tax()
{
    // Add new taxonomy, make it hierarchical (like types)
    $labels = array(
        'name'              => _x('County Board Meeting Categories', 'taxonomy general name', 'textdomain'),
        'post_name'     => _x('County Board Meeting Categories', 'taxonomy County Board Meeting name', 'textdomain'),
        'search_items'      => __('Search County Board Meeting Categories', 'textdomain'),
        'all_items'         => __('All County Board Meeting Categories', 'textdomain'),
        'parent_item'       => __('Parent County Board Meeting Category', 'textdomain'),
        'parent_item_colon' => __('Parent County Board Meeting Category:', 'textdomain'),
        'edit_item'         => __('Edit County Board Meeting Category', 'textdomain'),
        'update_item'       => __('Update County Board Meeting Category', 'textdomain'),
        'add_new_item'      => __('Add New County Board Meeting Category', 'textdomain'),
        'new_item_name'     => __('New County Board Meeting Category', 'textdomain'),
        'menu_name'         => __('County Board Meeting Categories', 'textdomain'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'county-board-meeting-categories'),
        'show_in_rest' => true,
    );

    register_taxonomy('countyboardmeeting_posts_tax', array('countyboardmeeting'), $args);
}
