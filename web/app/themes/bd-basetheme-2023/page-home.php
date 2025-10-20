<?php

/**
 * Template Name: Home Page Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blackwell_Digital_Base_Theme_2023
 */

get_header();
?>
<?php get_template_part('template-parts/module', 'hero-slideshow'); ?>
<main id="primary" class="site-main">
	<?php
	while (have_posts()) :
		the_post();

		get_template_part('template-parts/content', 'home');

	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php
get_footer();
