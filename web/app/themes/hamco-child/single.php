<?php
/**
 * The template for displaying single posts
 *
 * @package HamcoChild
 */

get_header();
?>

<?php get_template_part('template-parts/module', 'hero-page'); ?>

<main id="primary" class="site-main">
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            
            <?php while (have_posts()) : the_post(); ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                    <!-- Post Meta -->
                    <div class="text-center mb-8">
                        <span class="text-gray-500 text-sm uppercase tracking-wider">
                            <?php echo get_the_date(); ?>
                        </span>
                        <?php if (has_category()) : ?>
                            <span class="text-gray-400 mx-2">|</span>
                            <span class="text-hamco-green text-sm">
                                <?php the_category(', '); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Post Content -->
                    <div class="prose prose-lg max-w-none">
                        <?php the_content(); ?>
                    </div>
                    
                    <?php
                    wp_link_pages(array(
                        'before' => '<div class="page-links mt-8 flex items-center space-x-2"><span class="font-semibold">' . esc_html__('Pages:', 'hamco-child') . '</span>',
                        'after'  => '</div>',
                    ));
                    ?>
                    
                    <!-- Post Tags -->
                    <?php if (has_tag()) : ?>
                        <div class="mt-8 pt-8 border-t border-gray-200">
                            <span class="font-semibold text-gray-700">Tags: </span>
                            <?php the_tags('', ', ', ''); ?>
                        </div>
                    <?php endif; ?>
                    
                </article>
                
                <!-- Post Navigation -->
                <nav class="mt-12 pt-8 border-t border-gray-200">
                    <div class="flex justify-between">
                        <div class="flex-1">
                            <?php
                            $prev_post = get_previous_post();
                            if ($prev_post) :
                            ?>
                                <a href="<?php echo get_permalink($prev_post); ?>" class="text-hamco-green hover:text-green-800 transition-colors duration-200">
                                    <span class="text-gray-500 text-sm block mb-1">← Previous</span>
                                    <?php echo esc_html($prev_post->post_title); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="flex-1 text-right">
                            <?php
                            $next_post = get_next_post();
                            if ($next_post) :
                            ?>
                                <a href="<?php echo get_permalink($next_post); ?>" class="text-hamco-green hover:text-green-800 transition-colors duration-200">
                                    <span class="text-gray-500 text-sm block mb-1">Next →</span>
                                    <?php echo esc_html($next_post->post_title); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </nav>
                
            <?php endwhile; ?>
            
        </div>
    </div>
</main>

<?php
get_footer();

