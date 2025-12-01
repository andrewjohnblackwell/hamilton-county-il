<?php

/**
 * Template part for displaying Quick Links Module
 *
 * @package HamcoChild
 */

if (have_rows('quicklinks_cards', 'options')) : ?>
    <section class="quick-links py-16 bg-gray-50">
        <div class="container mx-auto px-4">

            <h2 class="text-3xl font-bold text-center mb-10 text-gray-800">
                Quick Links
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while (have_rows('quicklinks_cards', 'options')) : the_row();
                    $url = get_sub_field('url');
                ?>
                    <div class="quick-link-card group cursor-pointer"
                        <?php if ($url) : ?>
                        onclick="window.open('<?php echo esc_url($url); ?>', '_blank')"
                        <?php endif; ?>>

                        <!-- Icon -->
                        <?php if (get_sub_field('icon')) : ?>
                            <div class="text-center mb-4">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-white bg-opacity-20 rounded-full group-hover:bg-opacity-30 transition-all duration-300">
                                    <i class="fal <?php echo esc_attr(get_sub_field('icon')); ?> text-3xl" style="color: #006735 !important;"></i>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Title -->
                        <h3 class="text-xl font-semibold mb-3 text-center text-white">
                            <?php echo esc_html(get_sub_field('title')); ?>
                        </h3>

                        <!-- Description -->
                        <?php if (get_sub_field('description')) : ?>
                            <p class="text-center text-white text-opacity-90 mb-4">
                                <?php echo esc_html(get_sub_field('description')); ?>
                            </p>
                        <?php endif; ?>

                        <!-- Arrow -->
                        <?php if ($url) : ?>
                            <div class="text-center">
                                <span class="inline-flex items-center text-white font-medium group-hover:translate-x-1 transition-transform duration-200">
                                    Learn More
                                    <i class="fas fa-arrow-right ml-2 text-sm"></i>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php endif; ?>