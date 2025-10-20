<?php

/**
 * Advanced Custom Fields
 */

// ACF Options Page
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
