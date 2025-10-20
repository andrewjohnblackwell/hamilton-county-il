<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blackwell_Digital_Base_Theme_2023
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<!--
  _     _            _                 _ _      _ _       _        _
 | |__ | | __ _  ___| | ___      _____| | |  __| (_) __ _| |_ __ _| |
 | '_ \| |/ _` |/ __| |/ \ \ /\ / / _ | | | / _` | |/ _` | __/ _` | |
 | |_) | | (_| | (__|   < \ V  V |  __| | || (_| | | (_| | || (_| | |
 |_.__/|_|\__,_|\___|_|\_\ \_/\_/ \___|_|_(_\__,_|_|\__, |\__\__,_|_|
                                                    |___/
-->

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('template_directory'); ?>/images/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php bloginfo('template_directory'); ?>/images/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_directory'); ?>/images/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo('template_directory'); ?>/images/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/images/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('template_directory'); ?>/images/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('template_directory'); ?>/images/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('template_directory'); ?>/images/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_directory'); ?>/images/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192" href="<?php bloginfo('template_directory'); ?>/images/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('template_directory'); ?>/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php bloginfo('template_directory'); ?>/images/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('template_directory'); ?>/images/favicon-16x16.png">
	<link rel="manifest" href="<?php bloginfo('template_directory'); ?>/images/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php bloginfo('template_directory'); ?>/images/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<!-- FACEBOOK check this with SEO Plugin
	<meta property="og:title" content="">
	<meta property="og:image" content="./assets/images/demo11/logo.png">
	<meta property="og:description" content=""> -->

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'bd-basetheme-2023'); ?></a>

		<header id="masthead" class="site-header mb-4">
			<div class="container">


				<div class="row align-items-center d-flex">
					<div class="col-md-6 text-center text-md-start">
						<a title="<?php get_bloginfo("name"); ?>" class="navbar-brand" rel="home" href="<?php echo esc_url(home_url('/')); ?>"><?php get_template_part('images/inline', 'hamco-logo-color.svg'); ?></a>
					</div>
					<div class="col-md-6 text-center text-md-end">
						<?php if (get_field('text_gov_image', 'options')) : $image = get_field('text_gov_image', 'options'); ?>

							<!-- Full size image -->
							<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

						<?php endif; ?>

					</div>
				</div>

				<div class="row">
					<nav class="col-md-12 navbar navbar-expand-md navbar-light">
						<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#bs4navbar" aria-controls="menu-1" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<?php
						wp_nav_menu([
							'container'       => 'div',
							'container_id'    => 'bs4navbar',
							'theme_location'  => 'menu-1',
							'container_class' => 'collapse navbar-collapse',
							'menu_id'         => 'primary-menu',
							'menu_class'      => 'navbar-nav my-0 mx-auto d-flex justify-content-evenly w-100',
							'depth'           => 3,
							'fallback_cb'     => 'bootstrap_5_wp_nav_menu_walker::fallback',
							'walker'          => new bootstrap_5_wp_nav_menu_walker(),
						]);
						?>
					</nav>
				</div>


			</div>

		</header><!-- #masthead -->