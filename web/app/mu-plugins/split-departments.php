<?php
/**
 * Plugin Name: Split Department Into Sub-Departments
 * Description: Adds a Department editor sidebar to split content into child departments.
 * Author: Blackwell Digital
 * Version: 1.0.0
 */

if (!defined('ABSPATH')) exit;

// REST API endpoint for departments
add_action('rest_api_init', function () {
    register_rest_route('split-department/v1', '/run', [
        'methods' => 'POST',
        'permission_callback' => function (\WP_REST_Request $request) {
            $post_id = intval($request->get_param('postId'));
            if (!$post_id) return false;
            
            // Check if user can edit this department
            if (!current_user_can('edit_post', $post_id)) return false;
            
            // Verify nonce
            $nonce = $request->get_header('x-wp-nonce');
            return (bool) wp_verify_nonce($nonce, 'wp_rest');
        },
        'callback' => 'split_department_callback'
    ]);
});

function split_department_callback(\WP_REST_Request $request) {
    $post_id = intval($request->get_param('postId'));
    $status = ($request->get_param('status') === 'draft') ? 'draft' : 'publish';
    $prefix = sanitize_text_field($request->get_param('prefix') ?? '');
    $heading_level = intval($request->get_param('headingLevel') ?? 2);
    $replace_parent = filter_var($request->get_param('replaceParent'), FILTER_VALIDATE_BOOLEAN);
    
    $post = get_post($post_id);
    if (!$post || $post->post_type !== 'department') {
        return new \WP_Error('invalid', 'Invalid department.', ['status' => 400]);
    }
    
    $original_content = (string) $post->post_content;
    $sections = [];
    
    // Helper to push a section
    $push_section = function (&$collector, &$current) {
        if ($current && !empty($current['title']) && !empty($current['content'])) {
            $collector[] = $current;
        }
        $current = null;
    };
    
    // Parse content
    if (function_exists('has_blocks') && has_blocks($post)) {
        // BLOCK EDITOR
        $parsed = parse_blocks($original_content);
        $current = null;
        
        $render_block = function($b){ return render_block($b); };
        
        $walk = function($blocks) use (&$walk, &$current, &$sections, $heading_level, $render_block, $push_section) {
            foreach ($blocks as $b) {
                $bname = $b['blockName'] ?? '';
                if ($bname === 'core/heading') {
                    $level = intval($b['attrs']['level'] ?? 2);
                    $title = trim(wp_strip_all_tags($render_block($b)));
                    if ($level === $heading_level && $title) {
                        $push_section($sections, $current);
                        $current = ['title' => $title, 'content' => ''];
                        continue;
                    }
                }
                if ($current) {
                    $current['content'] .= $render_block($b);
                }
                if (!empty($b['innerBlocks'])) {
                    $walk($b['innerBlocks']);
                }
            }
        };
        
        $walk($parsed);
        if ($current) $sections[] = $current;
        
    } else {
        // CLASSIC EDITOR — split on <hN>
        $h = max(1, min(6, $heading_level));
        $pattern = '/<h' . $h . '[^>]*>(.*?)<\/h' . $h . '>(.*?)(?=(<h' . $h . '[^>]*>.*?<\/h' . $h . '>)|$)/is';
        if (preg_match_all($pattern, $original_content, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $m) {
                $title = trim(wp_strip_all_tags($m[1]));
                $body = trim($m[2]);
                if ($title && $body) {
                    $sections[] = ['title' => $title, 'content' => $body];
                }
            }
        }
    }
    
    if (empty($sections)) {
        return new \WP_Error('no_sections', 'No sections found at the selected heading level.', ['status' => 422]);
    }
    
    // Create child departments
    $child_ids = [];
    
    // Get parent's ACF fields to copy to children
    $parent_hero_image = get_field('hero_image', $post_id);
    $parent_hero_title = get_field('hero_title', $post_id);
    $parent_hero_subtitle = get_field('hero_subtitle', $post_id);
    $parent_manager_name = get_field('manager_name', $post_id);
    $parent_manager_title = get_field('manager_title', $post_id);
    $parent_manager_phone = get_field('manager_phone', $post_id);
    $parent_manager_email = get_field('manager_email', $post_id);
    
    // Get parent's featured image if it exists
    $parent_thumbnail_id = get_post_thumbnail_id($post_id);
    
    foreach ($sections as $idx => $sec) {
        $child_title = $prefix ? ($prefix . $sec['title']) : $sec['title'];
        $new_id = wp_insert_post([
            'post_type' => 'department',
            'post_title' => $child_title,
            'post_status' => $status,
            'post_parent' => $post_id,
            'post_content' => $sec['content'],
            'menu_order' => $idx,
        ], true);
        
        if (is_wp_error($new_id)) continue;
        
        // Copy parent's hero/header fields to child
        if ($parent_hero_image) {
            update_field('hero_image', $parent_hero_image, $new_id);
        }
        if ($parent_hero_title) {
            update_field('hero_title', $parent_hero_title, $new_id);
        }
        if ($parent_hero_subtitle) {
            update_field('hero_subtitle', $parent_hero_subtitle, $new_id);
        }
        
        // Copy manager information if you want sub-departments to inherit it
        if ($parent_manager_name) {
            update_field('manager_name', $parent_manager_name, $new_id);
        }
        if ($parent_manager_title) {
            update_field('manager_title', $parent_manager_title, $new_id);
        }
        if ($parent_manager_phone) {
            update_field('manager_phone', $parent_manager_phone, $new_id);
        }
        if ($parent_manager_email) {
            update_field('manager_email', $parent_manager_email, $new_id);
        }
        
        // Copy featured image if it exists
        if ($parent_thumbnail_id) {
            set_post_thumbnail($new_id, $parent_thumbnail_id);
        }
        
        $child_ids[] = $new_id;
    }
    
    if (empty($child_ids)) {
        return new \WP_Error('create_failed', 'Failed to create child departments.', ['status' => 500]);
    }
    
    // Optionally replace parent content with a TOC
    if ($replace_parent) {
        $links = array_map(function($id){
            return sprintf('<li><a href="%s">%s</a></li>', esc_url(get_permalink($id)), esc_html(get_the_title($id)));
        }, $child_ids);
        
        $toc = "<!-- auto-generated -->\n<h2>Sub-Departments</h2>\n<ul>\n" . implode("\n", $links) . "\n</ul>\n";
        wp_update_post([
            'ID' => $post_id,
            'post_content' => $toc,
        ]);
    }
    
    return new \WP_REST_Response([
        'created' => count($child_ids),
        'childIds' => array_map('intval', $child_ids),
        'replacedParent' => (bool) $replace_parent,
        'status' => $status,
    ], 200);
}

// Enqueue editor script for departments
// Register the script early with proper URL
add_action('init', function() {
    // Get the proper URL for mu-plugins directory
    // In Bedrock: /app/mu-plugins/
    $mu_plugins_url = defined('WPMU_PLUGIN_URL') ? WPMU_PLUGIN_URL : content_url('mu-plugins');
    $script_url = trailingslashit($mu_plugins_url) . 'split-department-editor.js';
    
    wp_register_script(
        'split-department-editor',
        $script_url,
        ['wp-plugins', 'wp-editor', 'wp-edit-post', 'wp-components', 'wp-element', 'wp-data', 'wp-api-fetch', 'wp-i18n'],
        '1.0.3', // Increment version to bust cache
        true
    );
});

// Enqueue for block editor - PRIMARY METHOD
add_action('enqueue_block_editor_assets', function () {
    global $post;
    
    // Multiple ways to check if we're editing a department
    $is_department = false;
    
    if (isset($post) && is_object($post) && $post->post_type === 'department') {
        $is_department = true;
    }
    
    if (!$is_department) {
        $post_id = get_the_ID();
        if ($post_id) {
            $post_obj = get_post($post_id);
            if ($post_obj && $post_obj->post_type === 'department') {
                $is_department = true;
            }
        }
    }
    
    if ($is_department) {
        wp_enqueue_script('split-department-editor');
        
        wp_localize_script('split-department-editor', 'SplitDepartment', [
            'restUrl' => esc_url_raw(rest_url('split-department/v1/run')),
            'nonce' => wp_create_nonce('wp_rest'),
            'debug' => 'Loaded via enqueue_block_editor_assets',
        ]);
    }
}, 999); // High priority to ensure it runs late

// Also try admin_enqueue_scripts as a fallback
add_action('admin_enqueue_scripts', function($hook) {
    global $post_type, $post;
    
    // Only on edit screens
    if (($hook === 'post.php' || $hook === 'post-new.php')) {
        // Check if it's a department post type
        if ($post_type === 'department' || (isset($post) && $post->post_type === 'department')) {
            // Make sure script is enqueued
            if (!wp_script_is('split-department-editor', 'enqueued')) {
                wp_enqueue_script('split-department-editor');
                
                wp_localize_script('split-department-editor', 'SplitDepartment', [
                    'restUrl' => esc_url_raw(rest_url('split-department/v1/run')),
                    'nonce' => wp_create_nonce('wp_rest'),
                    'debug' => 'Loaded via admin_enqueue_scripts',
                ]);
            }
        }
    }
});

// Debug notice removed - plugin is working correctly

/**
 * Helper function for department navigation
 * Render child departments for navigation using menu_order then title.
 *
 * Usage (in a sidebar template):
 *   if (function_exists('bd_list_child_departments')) bd_list_child_departments(get_the_ID());
 */
function bd_list_child_departments($parent_id) {
    $children = get_posts([
        'post_type' => 'department',
        'post_parent' => $parent_id,
        'orderby' => 'menu_order title',
        'order' => 'ASC',
        'post_status' => 'publish',
        'numberposts' => -1
    ]);
    
    if (!$children) return;
    
    echo '<ul class="py-2">';
    foreach ($children as $child) {
        printf(
            '<li><a href="%s" class="sidebar-nav-item flex items-center group text-white px-4 py-3 hover:bg-green-800 transition-colors duration-200" style="color: white !important;">
                <i class="fas fa-chevron-right text-sm mr-2 text-white group-hover:translate-x-1 transition-transform duration-200"></i>
                %s
            </a></li>',
            esc_url(get_permalink($child->ID)),
            esc_html($child->post_title)
        );
    }
    echo '</ul>';
}