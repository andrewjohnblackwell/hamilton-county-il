<?php

/**
 * Hamilton County Child Theme Functions
 *
 * @package HamcoChild
 */

/**
 * Enqueue parent and child theme styles
 */
function hamco_child_enqueue_styles()
{
    // Dequeue Bootstrap styles from parent theme
    wp_dequeue_style('bd-basetheme-2023-bootstrap');
    wp_deregister_style('bd-basetheme-2023-bootstrap');

    // Optionally dequeue parent theme styles if not needed
    // Uncomment if you want to completely override parent styles
    // wp_dequeue_style('bd-basetheme-2023-style');

    // Enqueue compiled Tailwind CSS
    wp_enqueue_style(
        'hamco-tailwind',
        get_stylesheet_directory_uri() . '/assets/css/main.css',
        array(),
        filemtime(get_stylesheet_directory() . '/assets/css/main.css')
    );

    // Enqueue child theme metadata (WordPress header only)
    wp_enqueue_style(
        'hamco-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('hamco-tailwind'),
        wp_get_theme()->get('Version')
    );

    // Enqueue Alpine.js for interactive components
    wp_enqueue_script(
        'alpine-js',
        'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js',
        array(),
        '3.13.3',
        true
    );

    // Add defer attribute to Alpine.js
    add_filter('script_loader_tag', function ($tag, $handle) {
        if ($handle === 'alpine-js') {
            return str_replace(' src', ' defer src', $tag);
        }
        return $tag;
    }, 10, 2);

    // Enqueue custom JavaScript for theme functionality
    wp_enqueue_script(
        'hamco-child-scripts',
        get_stylesheet_directory_uri() . '/js/theme.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('wp_enqueue_scripts', 'hamco_child_enqueue_styles', 20);

/**
 * Add Tailwind CSS classes to body
 */
function hamco_child_body_class($classes)
{
    $classes[] = 'font-sans';
    $classes[] = 'text-gray-800';
    return $classes;
}
add_filter('body_class', 'hamco_child_body_class');

/**
 * Register new ACF fields for theme options
 */
function hamco_child_register_acf_fields()
{
    if (function_exists('acf_add_local_field_group')) {

        // Note: Utility Bar Links field group is managed in ACF admin UI

        // Property Alert Settings
        acf_add_local_field_group(array(
            'key' => 'group_property_alert',
            'title' => 'Property Alert Settings',
            'fields' => array(
                array(
                    'key' => 'field_property_alert_enabled',
                    'label' => 'Enable Property Alert',
                    'name' => 'property_alert_enabled',
                    'type' => 'true_false',
                    'default_value' => 0,
                ),
                array(
                    'key' => 'field_property_alert_text',
                    'label' => 'Alert Text',
                    'name' => 'property_alert_text',
                    'type' => 'textarea',
                    'rows' => 3,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_property_alert_enabled',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                    ),
                ),
                array(
                    'key' => 'field_property_alert_url',
                    'label' => 'Alert Link URL',
                    'name' => 'property_alert_url',
                    'type' => 'url',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_property_alert_enabled',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'theme-general-settings',
                    ),
                ),
            ),
        ));

        // Welcome Section
        acf_add_local_field_group(array(
            'key' => 'group_welcome_section',
            'title' => 'Welcome Section',
            'fields' => array(
                array(
                    'key' => 'field_welcome_enabled',
                    'label' => 'Enable Welcome Section',
                    'name' => 'welcome_enabled',
                    'type' => 'true_false',
                    'default_value' => 1,
                ),
                array(
                    'key' => 'field_welcome_heading',
                    'label' => 'Welcome Heading',
                    'name' => 'welcome_heading',
                    'type' => 'text',
                    'default_value' => 'Welcome to Hamilton County',
                ),
                array(
                    'key' => 'field_welcome_content',
                    'label' => 'Welcome Content',
                    'name' => 'welcome_section_content',
                    'type' => 'wysiwyg',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ),
                array(
                    'key' => 'field_welcome_photo',
                    'label' => 'Chairman Photo',
                    'name' => 'welcome_photo',
                    'type' => 'image',
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                ),
                array(
                    'key' => 'field_welcome_cta',
                    'label' => 'Call to Action',
                    'name' => 'welcome_section_cta',
                    'type' => 'link',
                    'return_format' => 'array',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'theme-general-settings',
                    ),
                ),
            ),
        ));

        // Staff Members for Departments
        acf_add_local_field_group(array(
            'key' => 'group_department_staff',
            'title' => 'Department Staff',
            'fields' => array(
                array(
                    'key' => 'field_department_staff',
                    'label' => 'Staff Members',
                    'name' => 'department_staff',
                    'type' => 'repeater',
                    'layout' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_staff_photo',
                            'label' => 'Photo',
                            'name' => 'staff_photo',
                            'type' => 'image',
                            'return_format' => 'array',
                            'preview_size' => 'thumbnail',
                        ),
                        array(
                            'key' => 'field_staff_name',
                            'label' => 'Name',
                            'name' => 'staff_name',
                            'type' => 'text',
                            'required' => 1,
                        ),
                        array(
                            'key' => 'field_staff_title',
                            'label' => 'Title',
                            'name' => 'staff_title',
                            'type' => 'text',
                        ),
                        array(
                            'key' => 'field_staff_phone',
                            'label' => 'Phone',
                            'name' => 'staff_phone',
                            'type' => 'text',
                        ),
                        array(
                            'key' => 'field_staff_fax',
                            'label' => 'Fax',
                            'name' => 'staff_fax',
                            'type' => 'text',
                        ),
                        array(
                            'key' => 'field_staff_email',
                            'label' => 'Email',
                            'name' => 'staff_email',
                            'type' => 'email',
                        ),
                        array(
                            'key' => 'field_staff_address',
                            'label' => 'Address',
                            'name' => 'staff_address',
                            'type' => 'textarea',
                            'rows' => 2,
                        ),
                        array(
                            'key' => 'field_staff_facebook',
                            'label' => 'Facebook URL',
                            'name' => 'staff_facebook',
                            'type' => 'url',
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'department',
                    ),
                ),
            ),
        ));
    }
}
add_action('acf/init', 'hamco_child_register_acf_fields');

/**
 * Add theme support for additional features
 */
function hamco_child_theme_setup()
{
    // Add support for wide alignment in Gutenberg
    add_theme_support('align-wide');

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'hamco_child_theme_setup');

/**
 * Modify the main navigation walker for Tailwind classes
 */
function hamco_child_nav_menu_css_class($classes, $item, $args)
{
    if ($args->theme_location == 'menu-1') {
        $classes[] = 'relative';
        $classes[] = 'group';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'hamco_child_nav_menu_css_class', 10, 3);

/**
 * Add Tailwind classes to menu links
 */
function hamco_child_nav_menu_link_attributes($atts, $item, $args)
{
    if ($args->theme_location == 'menu-1') {
        $atts['class'] = 'px-4 py-2 text-gray-700 hover:text-hamco-green transition-colors duration-200 block';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'hamco_child_nav_menu_link_attributes', 10, 3);

/**
 * Custom Navigation Walker for Desktop Menu
 */
class Hamco_Simple_Nav_Walker extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = null)
    {
        if ($depth === 0) {
            $output .= "\n<div class=\"dropdown-menu absolute top-full left-0 mt-0 w-64 bg-white bg-opacity-95 backdrop-blur-sm shadow-2xl rounded-b-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible\" style=\"transition: all 0.3s ease;\">\n";
            $output .= "<ul class=\"py-1 px-1 space-y-0\">\n";
        } else {
            $output .= "\n<ul class=\"ml-4\">\n";
        }
    }

    function end_lvl(&$output, $depth = 0, $args = null)
    {
        if ($depth === 0) {
            $output .= "</ul>\n";
            $output .= "</div>\n";
        } else {
            $output .= "</ul>\n";
        }
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $has_children = in_array('menu-item-has-children', $classes);

        if ($depth === 0) {
            $classes[] = 'relative group';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= '<li' . $class_names . '>';

        $attributes = ! empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        if ($depth === 0) {
            $link_classes = 'dropdown-trigger flex items-center px-3 py-2 text-sm uppercase tracking-wide font-bold text-white hover:text-green-400 transition-colors duration-200 whitespace-nowrap';
        } else {
            $link_classes = 'block px-3 py-2 text-sm font-semibold text-slate-700 hover:text-hamco-green hover:bg-gray-50 transition-all duration-200';
        }

        $attributes .= ' class="' . $link_classes . '"';

        $item_output = '<a' . $attributes . '>';
        $item_output .= apply_filters('the_title', $item->title, $item->ID);

        if ($has_children && $depth === 0) {
            $item_output .= ' <i class="fas fa-chevron-down text-xs ml-1 opacity-60 inline-block"></i>';
        }

        $item_output .= '</a>';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * Custom Navigation Walker for Mobile Menu
 */
class Hamco_Mobile_Nav_Walker extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= "\n<ul class=\"ml-4 mt-2 space-y-1\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);

        $output .= '<li>';

        $attributes = ! empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        if ($depth === 0) {
            $attributes .= ' class="block px-4 py-3 text-white hover:bg-white/10 transition-colors duration-200 text-base uppercase tracking-wide font-bold"';
        } else {
            $attributes .= ' class="block px-6 py-3 text-white/80 hover:text-white transition-colors duration-200 text-base font-semibold"';
        }

        $item_output = '<a' . $attributes . '>';
        $item_output .= apply_filters('the_title', $item->title, $item->ID);

        if ($has_children && $depth === 0) {
            $item_output .= ' <i class="fas fa-chevron-down text-xs ml-2 opacity-60"></i>';
        }

        $item_output .= '</a>';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * Custom Navigation Walker for Footer Menu
 */
class Hamco_Footer_Nav_Walker extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"ml-4 mt-2 space-y-1\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id_attr = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id_attr = $id_attr ? ' id="' . esc_attr($id_attr) . '"' : '';

        $output .= $indent . '<li' . $id_attr . $class_names . '>';

        $attributes = ! empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= ! empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= ! empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= ! empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= ' class="footer-link block"';

        $item_output = $args->before ?? '';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= ($args->link_before ?? '') . apply_filters('the_title', $item->title, $item->ID) . ($args->link_after ?? '');
        $item_output .= '</a>';
        $item_output .= $args->after ?? '';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * Build breadcrumbs array for hero sections
 *
 * @return array Breadcrumb items
 */
function hamco_get_breadcrumbs()
{
    $breadcrumbs = array();

    // Home link
    $breadcrumbs[] = array(
        'title' => 'Home',
        'url' => home_url(),
        'current' => false
    );

    // Parent pages or departments
    if (is_singular()) {
        $post_type = get_post_type();

        // Handle department hierarchy
        if ($post_type === 'department') {
            // Add Departments archive link
            $breadcrumbs[] = array(
                'title' => 'Departments',
                'url' => get_post_type_archive_link('department'),
                'current' => false
            );

            // Add parent departments
            $ancestors = array_reverse(get_post_ancestors(get_the_ID()));
            foreach ($ancestors as $ancestor) {
                $breadcrumbs[] = array(
                    'title' => get_the_title($ancestor),
                    'url' => get_permalink($ancestor),
                    'current' => false
                );
            }
        } elseif (is_page() && !is_front_page()) {
            // Handle page hierarchy
            $ancestors = array_reverse(get_post_ancestors(get_the_ID()));
            foreach ($ancestors as $ancestor) {
                $breadcrumbs[] = array(
                    'title' => get_the_title($ancestor),
                    'url' => get_permalink($ancestor),
                    'current' => false
                );
            }
        }
    }

    // Current page (no link)
    $breadcrumbs[] = array(
        'title' => get_the_title(),
        'url' => '',
        'current' => true
    );

    return $breadcrumbs;
}
