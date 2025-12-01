<?php
/**
 * Add Featured Event and Default Hero fields to Theme Options
 */

if (!defined('ABSPATH')) exit;

add_action('acf/init', function() {
    if (!function_exists('acf_add_local_field_group')) return;
    
    // Featured Events
    acf_add_local_field_group(array(
        'key' => 'group_featured_events_options',
        'title' => 'Featured Events',
        'fields' => array(
            array(
                'key' => 'field_featured_events_tab',
                'label' => 'Featured Events',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_featured_event_one',
                'label' => 'Featured Event',
                'name' => 'featured_event_one',
                'type' => 'post_object',
                'instructions' => 'Select an event to feature on the homepage. Leave empty to hide the events section.',
                'post_type' => array('tribe_events', 'post'),
                'return_format' => 'object',
                'ui' => 1,
                'allow_null' => 1,
            ),
            array(
                'key' => 'field_events_background_image',
                'label' => 'Events Background Image',
                'name' => 'events_background_image',
                'type' => 'image',
                'instructions' => 'Background image for the events section',
                'return_format' => 'url',
                'preview_size' => 'medium',
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
        'menu_order' => 15,
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ));
    
    // Default Hero Image
    acf_add_local_field_group(array(
        'key' => 'group_default_hero_options',
        'title' => 'Default Hero Image',
        'fields' => array(
            array(
                'key' => 'field_default_hero_tab',
                'label' => 'Default Hero',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_default_hero_image',
                'label' => 'Default Hero Background Image',
                'name' => 'default_hero_image',
                'type' => 'image',
                'instructions' => 'This image will be used as the hero background on any page or post that doesn\'t have its own featured image or hero image set.',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
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
        'menu_order' => 5,
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ));
});

