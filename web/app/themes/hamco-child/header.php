<?php

/**
 * The header for Hamilton County Child Theme - Updated with working dropdowns
 *
 * @package HamcoChild
 */
?>
<!doctype html>
<html <?php language_attributes(); ?> class="scroll-smooth">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon-16x16.png">

    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-white text-gray-800 pt-10'); ?>>
    <?php wp_body_open(); ?>

    <div id="page" class="site min-h-screen flex flex-col">
        <a class="skip-link screen-reader-text sr-only focus:not-sr-only focus:absolute focus:top-0 focus:left-0 bg-hamco-green text-white p-4 z-[60]" href="#primary">
            <?php esc_html_e('Skip to content', 'hamco-child'); ?>
        </a>

        <header id="masthead" class="site-header">

            <!-- Utility Bar - Fixed at top -->
            <div class="utility-bar fixed w-full h-10 bg-hamco-green bg-opacity-90 backdrop-blur-sm text-white z-50" style="top: <?php echo is_user_logged_in() ? '32px !important' : '0 !important'; ?>">
                <div class="max-w-7xl mx-auto px-6 lg:px-12 h-full">
                    <div class="flex justify-between items-center h-full">
                        <!-- Left side (optional) -->
                        <div class="hidden lg:block flex-1">
                            <!-- Add optional left content here -->
                        </div>

                        <!-- Right side utility links and search -->
                        <div class="flex items-center space-x-4 ml-auto">
                            <!-- Utility Links -->
                            <div class="hidden md:flex items-center space-x-4">
                                <?php if (have_rows('utility_bar_links', 'options')) : ?>
                                    <?php while (have_rows('utility_bar_links', 'options')) : the_row(); ?>
                                        <a href="<?php the_sub_field('link_url'); ?>"
                                            class="flex items-center text-sm text-white hover:text-green-200 transition-colors duration-200">
                                            <?php if (get_sub_field('icon_class')) : ?>
                                                <i class="fas <?php the_sub_field('icon_class'); ?> mr-2 text-green-200"></i>
                                            <?php endif; ?>
                                            <?php the_sub_field('link_text'); ?>
                                        </a>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <!-- Default utility links -->
                                    <a href="/directory" class="flex items-center text-sm text-white hover:text-green-200 transition-colors duration-200">
                                        <i class="fas fa-phone mr-2 text-green-200"></i>
                                        Directory
                                    </a>
                                    <a href="/calendar" class="flex items-center text-sm text-white hover:text-green-200 transition-colors duration-200">
                                        <i class="fas fa-calendar mr-2 text-green-200"></i>
                                        Calendar
                                    </a>
                                    <a href="https://chesteril.org" target="_blank" rel="noopener"
                                        class="flex items-center text-sm text-white hover:text-green-200 transition-colors duration-200">
                                        <i class="fas fa-map-marker-alt mr-2 text-green-200"></i>
                                        Chester, Illinois
                                    </a>
                                <?php endif; ?>
                            </div>

                            <!-- Search Form -->
                            <form role="search" method="get" class="hidden md:flex items-stretch h-8" action="<?php echo esc_url(home_url('/')); ?>">
                                <label class="sr-only">
                                    <span class="screen-reader-text"><?php echo esc_html_x('Search for:', 'label', 'hamco-child'); ?></span>
                                </label>
                                <input type="search"
                                    class="search-field px-3 bg-white text-gray-800 text-sm rounded-l focus:outline-none focus:ring-2 focus:ring-green-300 w-40 lg:w-64 h-full"
                                    placeholder="<?php echo esc_attr_x('Search…', 'placeholder', 'hamco-child'); ?>"
                                    value="<?php echo get_search_query(); ?>"
                                    name="s" />
                                <button type="submit"
                                    class="search-submit bg-green-800 hover:bg-green-900 px-3 rounded-r transition-all duration-200 h-full">
                                    <i class="fas fa-search text-white"></i>
                                    <span class="screen-reader-text"><?php echo esc_html_x('Search', 'submit button', 'hamco-child'); ?></span>
                                </button>
                            </form>

                            <!-- Mobile menu toggle -->
                            <button class="md:hidden p-1" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                                <i class="fas fa-bars text-white"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Navigation Bar - Sticky below utility bar -->
            <nav class="main-navigation sticky w-full bg-slate-800 bg-opacity-85 backdrop-blur-sm shadow-xl z-40" style="top: <?php echo is_user_logged_in() ? '72px !important' : '40px !important'; ?>">
                <div class="max-w-7xl mx-auto px-6 lg:px-12">
                    <div class="flex justify-between items-center py-3">

                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="<?php echo esc_url(home_url('/')); ?>"
                                class="inline-block max-w-[250px]"
                                title="<?php bloginfo('name'); ?>">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/inline-hamco-logo-color.png"
                                    alt="<?php bloginfo('name'); ?>"
                                    class="max-w-[250px] h-auto"
                                    loading="eager" />
                            </a>
                        </div>

                        <!-- Desktop Menu -->
                        <div class="hidden lg:block">
                            <?php
                            wp_nav_menu(array(
                                'theme_location'  => 'menu-1',
                                'menu_id'         => 'primary-menu',
                                'container'       => false,
                                'menu_class'      => 'flex items-center space-x-2',
                                'fallback_cb'     => false,
                                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'walker'          => new Hamco_Simple_Nav_Walker(),
                            ));
                            ?>
                        </div>

                        <!-- Mobile Menu Button -->
                        <button onclick="document.getElementById('mobile-nav-panel').classList.toggle('hidden')"
                            class="lg:hidden p-2 rounded text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-green-400">
                            <span class="sr-only">Toggle menu</span>
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu Panel -->
                <div id="mobile-nav-panel" class="hidden lg:hidden bg-slate-800/95 backdrop-blur-sm shadow-2xl">
                    <div class="p-4">
                        <?php
                        wp_nav_menu(array(
                            'theme_location'  => 'menu-1',
                            'menu_id'         => 'mobile-menu',
                            'container'       => false,
                            'menu_class'      => 'space-y-2',
                            'fallback_cb'     => false,
                            'walker'          => new Hamco_Mobile_Nav_Walker(),
                        ));
                        ?>
                    </div>
                </div>
            </nav>
        </header><!-- #masthead -->
