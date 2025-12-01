<?php

/**
 * Template Name: Home Page Template
 *
 * @package HamcoChild
 */

get_header();
?>

<?php
// Use homepage hero if available, otherwise fallback to slideshow
if (file_exists(get_stylesheet_directory() . '/template-parts/module-hero-home.php')) {
    get_template_part('template-parts/module', 'hero-home');
} else {
    get_template_part('template-parts/module', 'hero-slideshow');
}
?>

<main id="primary" class="site-main">

    <?php get_template_part('template-parts/module', 'quicklinks'); ?>

    <?php get_template_part('template-parts/module', 'welcome'); ?>

    <?php get_template_part('template-parts/module', 'property-alert'); ?>

    <?php get_template_part('template-parts/module', 'featured-news'); ?>

    <?php get_template_part('template-parts/module', 'featured-events'); ?>

    <?php get_template_part('template-parts/module', 'alerts'); ?>

    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <?php if (get_the_content()) : ?>
                <section class="page-content py-12">
                    <div class="container mx-auto px-4">
                        <div class="prose prose-lg max-w-none">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>

</main><!-- #primary -->

<?php
get_footer();
