<?php
/**
 * The template for displaying search results
 *
 * @package HamcoChild
 */

get_header();
?>

<?php get_template_part('template-parts/module', 'hero-page'); ?>

<main id="primary" class="site-main">
    <div class="container mx-auto px-4 py-12">
        
        <div class="max-w-4xl mx-auto mb-8">
            <p class="text-gray-600 text-center">
                <?php
                printf(
                    esc_html__('Search results for: %s', 'hamco-child'),
                    '<strong>' . get_search_query() . '</strong>'
                );
                ?>
            </p>
        </div>
        
        <?php if (have_posts()) : ?>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <?php while (have_posts()) : the_post(); ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300'); ?>>
                        
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="block overflow-hidden">
                                <?php the_post_thumbnail('medium_large', array('class' => 'w-full h-48 object-cover hover:scale-105 transition-transform duration-300')); ?>
                            </a>
                        <?php endif; ?>
                        
                        <div class="p-6">
                            <span class="text-hamco-green text-sm font-semibold uppercase">
                                <?php echo get_post_type_object(get_post_type())->labels->singular_name; ?>
                            </span>
                            
                            <h2 class="text-xl font-bold mt-2 mb-3">
                                <a href="<?php the_permalink(); ?>" class="text-gray-800 hover:text-hamco-green transition-colors duration-200">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            
                            <div class="text-gray-600 mb-4">
                                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                            </div>
                            
                            <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-hamco-green hover:text-green-800 font-semibold transition-colors duration-200">
                                Read More
                                <i class="fas fa-arrow-right ml-2 text-sm"></i>
                            </a>
                        </div>
                        
                    </article>
                    
                <?php endwhile; ?>
                
            </div>
            
            <!-- Pagination -->
            <div class="mt-12">
                <?php
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => '<i class="fas fa-chevron-left"></i> Previous',
                    'next_text' => 'Next <i class="fas fa-chevron-right"></i>',
                ));
                ?>
            </div>
            
        <?php else : ?>
            
            <div class="text-center py-12 max-w-2xl mx-auto">
                <i class="fal fa-search text-6xl text-gray-300 mb-6"></i>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">No Results Found</h2>
                <p class="text-gray-600 mb-8">Sorry, no results matched your search. Try different keywords.</p>
                
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="flex max-w-md mx-auto">
                    <input type="search"
                        class="flex-1 px-4 py-3 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-hamco-green"
                        placeholder="Search again..."
                        value="<?php echo get_search_query(); ?>"
                        name="s" />
                    <button type="submit"
                        class="bg-hamco-green hover:bg-green-800 text-white px-6 py-3 rounded-r-lg transition-colors duration-200">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            
        <?php endif; ?>
        
    </div>
</main>

<?php
get_footer();

