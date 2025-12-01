<?php

/**
 * Advanced Custom Fields
 */

// ACF Options Page - Delayed to avoid WordPress 6.7.0+ translation loading warnings
add_action('acf/init', function () {
	if (function_exists('acf_add_options_page')) {

		acf_add_options_page(array(
			'page_title' 	=> 'General Theme Options',
			'menu_title'	=> 'General Options',
			'menu_slug' 	=> 'theme-general-settings',
			'capability'	=> 'edit_posts',
			'redirect'		=> false,
			'autoload'      => true,
		));
		acf_add_options_sub_page(array(
			'page_title' 	=> 'Home Page Options',
			'menu_title'	=> 'Home Page Options',
			'parent_slug'	=> 'theme-general-settings',
			'autoload'      => true,
		));
	}
});
