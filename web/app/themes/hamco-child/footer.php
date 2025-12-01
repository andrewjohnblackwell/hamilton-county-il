<?php

/**
 * The template for displaying the footer
 *
 * @package HamcoChild
 */
?>

<footer id="colophon" class="site-footer bg-navy-dark text-gray-300 mt-auto">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            <!-- Column 1: Courthouse Info -->
            <div>
                <h3 class="text-white font-semibold text-lg mb-4">
                    <?php echo get_bloginfo('name'); ?> Courthouse
                </h3>
                <div class="space-y-3">
                    <?php if (get_field('street_address', 'options') || get_field('city_state_zip', 'options')) : ?>
                        <div>
                            <p class="font-semibold text-white mb-1">Address</p>
                            <?php if (get_field('street_address', 'options')) : ?>
                                <p><?php echo get_field('street_address', 'options'); ?></p>
                            <?php endif; ?>
                            <?php if (get_field('city_state_zip', 'options')) : ?>
                                <p><?php echo get_field('city_state_zip', 'options'); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (have_rows('hours_of_operation_repeater', 'options')) : ?>
                        <div>
                            <p class="font-semibold text-white mb-1">Hours</p>
                            <?php while (have_rows('hours_of_operation_repeater', 'options')) : the_row(); ?>
                                <div class="flex justify-between text-sm">
                                    <span><?php the_sub_field('day_of_the_week'); ?></span>
                                    <span><?php the_sub_field('hours_of_operation'); ?></span>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (get_field('phone_number', 'options')) : ?>
                        <div>
                            <p class="font-semibold text-white mb-1">Phone</p>
                            <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', get_field('phone_number', 'options')); ?>"
                                class="footer-link hover:text-hamco-green">
                                <?php echo get_field('phone_number', 'options'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Column 2: Department Contacts -->
            <div>
                <h3 class="text-white font-semibold text-lg mb-4">Departments</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location'  => 'menu-3',
                    'menu_id'        => 'footer-departments',
                    'container'      => false,
                    'menu_class'     => 'space-y-2',
                    'fallback_cb'    => false,
                    'walker'         => new Hamco_Footer_Nav_Walker(),
                ));
                ?>
            </div>

            <!-- Column 3: Important Links -->
            <div>
                <h3 class="text-white font-semibold text-lg mb-4">Quick Links</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location'  => 'menu-2',
                    'menu_id'        => 'footer-resources',
                    'container'      => false,
                    'menu_class'     => 'space-y-2',
                    'fallback_cb'    => false,
                    'walker'         => new Hamco_Footer_Nav_Walker(),
                ));
                ?>

                <!-- Additional important links -->
                <div class="mt-6 space-y-2">
                    <a href="/holiday-schedule" class="footer-link block">Holiday Schedule</a>
                    <a href="/foia-request" class="footer-link block">FOIA Request Form</a>
                    <a href="/employment" class="footer-link block">Employment Opportunities</a>
                </div>
            </div>

            <!-- Column 4: Upcoming Events or Additional Info -->
            <div>
                <?php
                // Check if we have featured events
                $featured_event_one = get_field('featured_event_one', 'options');
                $featured_event_two = get_field('featured_event_two', 'options');

                if ($featured_event_one || $featured_event_two) :
                ?>
                    <h3 class="text-white font-semibold text-lg mb-4">Upcoming Events</h3>
                    <div class="space-y-4">
                        <?php if ($featured_event_one) : ?>
                            <div class="border-l-2 border-hamco-green pl-3">
                                <h4 class="text-white font-medium">
                                    <?php echo esc_html($featured_event_one->post_title); ?>
                                </h4>
                                <?php if (function_exists('tribe_get_start_date')) : ?>
                                    <p class="text-sm text-gray-400">
                                        <?php echo tribe_get_start_date($featured_event_one->ID); ?>
                                    </p>
                                <?php elseif (get_field('event_date', $featured_event_one->ID)) : ?>
                                    <p class="text-sm text-gray-400">
                                        <?php echo esc_html(get_field('event_date', $featured_event_one->ID)); ?>
                                    </p>
                                <?php endif; ?>
                                <a href="<?php echo get_permalink($featured_event_one); ?>"
                                    class="text-hamco-green hover:text-green-400 text-sm">
                                    Learn More →
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if ($featured_event_two) : ?>
                            <div class="border-l-2 border-hamco-green pl-3">
                                <h4 class="text-white font-medium">
                                    <?php echo esc_html($featured_event_two->post_title); ?>
                                </h4>
                                <?php if (function_exists('tribe_get_start_date')) : ?>
                                    <p class="text-sm text-gray-400">
                                        <?php echo tribe_get_start_date($featured_event_two->ID); ?>
                                    </p>
                                <?php elseif (get_field('event_date', $featured_event_two->ID)) : ?>
                                    <p class="text-sm text-gray-400">
                                        <?php echo esc_html(get_field('event_date', $featured_event_two->ID)); ?>
                                    </p>
                                <?php endif; ?>
                                <a href="<?php echo get_permalink($featured_event_two); ?>"
                                    class="text-hamco-green hover:text-green-400 text-sm">
                                    Learn More →
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else : ?>
                    <h3 class="text-white font-semibold text-lg mb-4">Connect With Us</h3>
                    <div class="space-y-3">
                        <p>Stay informed about Hamilton County news and events.</p>

                        <!-- Social Media Icons -->
                        <div class="flex space-x-4 mt-4">
                            <?php if (get_field('facebook_url', 'options')) : ?>
                                <a href="<?php echo get_field('facebook_url', 'options'); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="text-gray-400 hover:text-white transition-colors duration-200"
                                    aria-label="Facebook">
                                    <i class="fab fa-facebook-f text-xl"></i>
                                </a>
                            <?php endif; ?>

                            <?php if (get_field('twitter_url', 'options')) : ?>
                                <a href="<?php echo get_field('twitter_url', 'options'); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="text-gray-400 hover:text-white transition-colors duration-200"
                                    aria-label="Twitter">
                                    <i class="fab fa-twitter text-xl"></i>
                                </a>
                            <?php endif; ?>

                            <?php if (get_field('youtube_url', 'options')) : ?>
                                <a href="<?php echo get_field('youtube_url', 'options'); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="text-gray-400 hover:text-white transition-colors duration-200"
                                    aria-label="YouTube">
                                    <i class="fab fa-youtube text-xl"></i>
                                </a>
                            <?php endif; ?>
                        </div>

                        <!-- Newsletter Signup -->
                        <?php if (get_field('newsletter_enabled', 'options')) : ?>
                            <div class="mt-6">
                                <p class="text-white font-medium mb-2">Newsletter</p>
                                <form class="flex">
                                    <input type="email"
                                        placeholder="Your email"
                                        class="flex-1 px-3 py-2 bg-gray-800 text-white rounded-l focus:outline-none focus:ring-2 focus:ring-hamco-green">
                                    <button type="submit"
                                        class="bg-hamco-green hover:bg-green-700 text-white px-4 py-2 rounded-r transition-colors duration-200">
                                        Subscribe
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Copyright Bar -->
    <div class="bg-gray-900 py-4">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
                <div class="mb-2 md:mb-0">
                    &copy; <?php echo date('Y'); ?> <?php echo get_bloginfo('name'); ?>. All Rights Reserved.
                </div>
                <div class="flex items-center">
                    <a href="https://www.blackwell.digital"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="footer-link hover:text-white flex items-center">
                        <i class="fas fa-code mr-2"></i> Powered by Blackwell Digital
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>