<?php

/**
 * The template for displaying all pages
 *
 * @package HamcoChild
 */

get_header();
?>

<?php get_template_part('template-parts/module', 'hero-page'); ?>

<main id="primary" class="site-main">
    <div class="container mx-auto px-4 py-12">
        <?php while (have_posts()) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <?php if (!is_front_page()) : ?>
                    <div class="prose prose-lg max-w-none">
                        <?php the_content(); ?>
                    </div>

                    <?php
                    wp_link_pages(array(
                        'before' => '<div class="page-links mt-8 flex items-center space-x-2"><span class="font-semibold">' . esc_html__('Pages:', 'hamco-child') . '</span>',
                        'after'  => '</div>',
                        'link_before' => '<span class="inline-block px-3 py-1 bg-gray-200 hover:bg-hamco-green hover:text-white transition-colors duration-200 rounded">',
                        'link_after' => '</span>',
                    ));
                    ?>
                <?php endif; ?>

            </article><!-- #post-<?php the_ID(); ?> -->


        <?php endwhile; ?>
    </div>
</main><!-- #main -->

<?php
get_footer();
