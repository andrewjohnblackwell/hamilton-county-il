<?php

/**
 * Template part for displaying Welcome Section
 *
 * @package HamcoChild
 */

if (get_field('welcome_enabled', 'options')) : ?>
    <section class="welcome-section py-16 bg-blue-gray-light">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">

                <!-- Chairman Photo Column -->
                <div class="order-2 lg:order-1">
                    <?php
                    $photo = get_field('welcome_photo', 'options');
                    if ($photo) :
                    ?>
                        <div class="relative">
                            <img src="<?php echo esc_url($photo['url']); ?>"
                                alt="<?php echo esc_attr($photo['alt'] ?: 'County Chairman'); ?>"
                                class="rounded-lg shadow-xl w-full max-w-md mx-auto lg:mx-0">
                            <!-- Optional decorative element -->
                            <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-hamco-green opacity-20 rounded-lg -z-10"></div>
                        </div>
                    <?php else : ?>
                        <!-- Placeholder if no image -->
                        <div class="bg-gray-300 rounded-lg shadow-xl aspect-[4/5] max-w-md mx-auto lg:mx-0 flex items-center justify-center">
                            <i class="fas fa-user text-gray-400 text-6xl"></i>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Welcome Content Column -->
                <div class="order-1 lg:order-2">
                    <?php if (get_field('welcome_heading', 'options')) : ?>
                        <h2 class="text-3xl lg:text-4xl font-bold mb-6 text-gray-800">
                            <?php echo esc_html(get_field('welcome_heading', 'options')); ?>
                        </h2>
                    <?php else : ?>
                        <h2 class="text-3xl lg:text-4xl font-bold mb-6 text-gray-800">
                            Welcome to Hamilton County
                        </h2>
                    <?php endif; ?>

                    <?php if (get_field('welcome_section_content', 'options')) : ?>
                        <div class="prose prose-lg text-gray-600 mb-8">
                            <?php echo wp_kses_post(get_field('welcome_section_content', 'options')); ?>
                        </div>
                    <?php else : ?>
                        <p class="text-lg text-gray-600 mb-8">
                            Hamilton County is committed to providing excellent services to our residents and businesses.
                            Our dedicated team works tirelessly to maintain the quality of life that makes our county a great place to live, work, and visit.
                        </p>
                    <?php endif; ?>

                    <?php
                    $cta = get_field('welcome_section_cta', 'options');
                    if ($cta) :
                    ?>
                        <a href="<?php echo esc_url($cta['url']); ?>"
                            target="<?php echo esc_attr($cta['target'] ?: '_self'); ?>"
                            class="inline-flex items-center bg-hamco-green hover:bg-green-800 text-white font-semibold px-8 py-4 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <?php echo esc_html($cta['title'] ?: 'LEARN MORE ABOUT US'); ?>
                            <i class="fas fa-arrow-right ml-3"></i>
                        </a>
                    <?php else : ?>
                        <a href="/about"
                            class="inline-flex items-center bg-hamco-green hover:bg-green-800 text-white font-semibold px-8 py-4 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                            LEARN MORE ABOUT US
                            <i class="fas fa-arrow-right ml-3"></i>
                        </a>
                    <?php endif; ?>

                    <!-- Optional: Chairman signature or title -->
                    <?php if (get_field('chairman_name', 'options') || get_field('chairman_title', 'options')) : ?>
                        <div class="mt-8 pt-6 border-t border-gray-300">
                            <?php if (get_field('chairman_name', 'options')) : ?>
                                <p class="font-semibold text-gray-800">
                                    <?php echo esc_html(get_field('chairman_name', 'options')); ?>
                                </p>
                            <?php endif; ?>
                            <?php if (get_field('chairman_title', 'options')) : ?>
                                <p class="text-gray-600">
                                    <?php echo esc_html(get_field('chairman_title', 'options')); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>