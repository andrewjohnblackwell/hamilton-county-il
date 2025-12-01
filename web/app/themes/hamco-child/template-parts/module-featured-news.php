<?php
/**
 * Template part for displaying Featured News & Events
 * Side by side on desktop, stacked on mobile
 * If no events, shows full width news
 *
 * @package HamcoChild
 */

$featured_post = get_field('featured_news_article', 'options');
$featured_event = get_field('featured_event_one', 'options');
$has_event = !empty($featured_event);

if ($featured_post) : ?>
<section class="featured-news-events py-16 bg-white">
    <div class="container mx-auto px-4">
        
        <div class="grid grid-cols-1 <?php echo $has_event ? 'lg:grid-cols-2' : ''; ?> gap-8 lg:gap-12">
            
            <!-- Featured News Column -->
            <div class="<?php echo !$has_event ? 'max-w-3xl mx-auto px-8 py-8' : ''; ?> text-center">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Featured News</h2>
                    <span class="text-sm text-gray-500 uppercase tracking-wider">
                        <?php echo get_the_date('F j, Y', $featured_post->ID); ?>
                    </span>
                </div>
                
                <!-- Featured Image -->
                <?php if (has_post_thumbnail($featured_post->ID)) : ?>
                    <a href="<?php echo get_permalink($featured_post->ID); ?>" class="block mb-6 overflow-hidden rounded-lg shadow-lg">
                        <?php echo get_the_post_thumbnail($featured_post->ID, 'large', array(
                            'class' => 'w-full h-64 object-cover hover:scale-105 transition-transform duration-300'
                        )); ?>
                    </a>
                <?php endif; ?>
                
                <!-- Title & Excerpt -->
                <h3 class="text-2xl font-bold text-gray-800 mb-4">
                    <a href="<?php echo get_permalink($featured_post->ID); ?>" class="hover:text-hamco-green transition-colors duration-200">
                        <?php echo esc_html($featured_post->post_title); ?>
                    </a>
                </h3>
                
                <div class="prose text-gray-600 mb-6 mx-auto">
                    <?php echo wp_trim_words(get_the_excerpt($featured_post), 40, '...'); ?>
                </div>
                
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="<?php echo get_permalink($featured_post->ID); ?>" 
                       class="inline-flex items-center bg-hamco-green hover:bg-green-800 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-300">
                        Read More
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                    <a href="/news/" 
                       class="inline-flex items-center border-2 border-hamco-green text-hamco-green hover:bg-hamco-green hover:text-white font-semibold px-6 py-3 rounded-lg transition-all duration-300">
                        All News
                    </a>
                </div>
            </div>
            
            <?php if ($has_event) : ?>
            <!-- Featured Event Column -->
            <div>
                <div class="bg-white rounded-xl overflow-hidden shadow-xl h-full border border-gray-200">
                    
                    <!-- Event Image on Top -->
                    <?php if (has_post_thumbnail($featured_event->ID)) : ?>
                        <a href="<?php echo get_permalink($featured_event->ID); ?>" class="block overflow-hidden">
                            <?php echo get_the_post_thumbnail($featured_event->ID, 'large', array(
                                'class' => 'w-full h-64 object-cover hover:scale-105 transition-transform duration-300'
                            )); ?>
                        </a>
                    <?php endif; ?>
                    
                    <!-- Event Content -->
                    <div class="px-8 py-10 lg:px-12 lg:py-14">
                        <div class="text-center mb-8">
                            <h2 class="text-3xl font-bold text-gray-800 mb-3">Upcoming Event</h2>
                            <i class="fal fa-calendar-days text-3xl text-hamco-green"></i>
                        </div>
                        
                        <!-- Event Date -->
                        <?php if (function_exists('tribe_get_start_date')) : ?>
                            <div class="text-hamco-green font-semibold mb-4 text-center">
                                <i class="fal fa-clock mr-2"></i>
                                <?php echo tribe_get_start_date($featured_event->ID); ?>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Event Title -->
                        <h3 class="text-2xl font-bold text-gray-800 mb-5 text-center">
                            <a href="<?php echo get_permalink($featured_event->ID); ?>" class="hover:text-hamco-green transition-colors duration-200">
                                <?php echo esc_html($featured_event->post_title); ?>
                            </a>
                        </h3>
                        
                        <!-- Event Excerpt -->
                        <p class="text-gray-600 mb-8 text-center">
                            <?php echo wp_trim_words(get_the_excerpt($featured_event), 30, '...'); ?>
                        </p>
                        
                        <div class="flex flex-wrap gap-4 justify-center mt-8 mb-8">
                            <a href="<?php echo get_permalink($featured_event->ID); ?>" 
                               class="inline-flex items-center bg-hamco-green hover:bg-green-800 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-300">
                                Event Details
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                            <a href="/events/" 
                               class="inline-flex items-center border-2 border-hamco-green text-hamco-green hover:bg-hamco-green hover:text-white font-semibold px-6 py-3 rounded-lg transition-all duration-300">
                                All Events
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
        </div>
        
    </div>
</section>
<?php endif; ?>

