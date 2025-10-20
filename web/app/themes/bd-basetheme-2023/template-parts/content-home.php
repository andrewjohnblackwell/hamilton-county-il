<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blackwell_Digital_Base_Theme_2023
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">

		<?php get_template_part('template-parts/module', 'hero-centered'); ?>
		<?php get_template_part('template-parts/module', 'quicklinks'); ?>
		<?php get_template_part('template-parts/module', 'featured-news'); ?>
		<?php get_template_part('template-parts/module', 'featured-events'); ?>
		<?php get_template_part('template-parts/module', 'alerts'); ?>
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'bd-basetheme-2023'),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->