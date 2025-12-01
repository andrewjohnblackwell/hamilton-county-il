<?php

/**
 * Template part for displaying homepage hero section
 *
 * @package HamcoChild
 */

// Get hero settings from ACF or defaults
$hero_image = get_field('homepage_hero_image', 'options') ?: get_template_directory_uri() . '/images/hero-default.jpg';
$hero_title = get_field('homepage_hero_title', 'options') ?: get_bloginfo('name');
$hero_subtitle = get_field('homepage_hero_subtitle', 'options') ?: 'Serving the Community Since 1821';
$hero_cta = get_field('homepage_hero_cta', 'options');

?>

<section class="hero-home relative h-[75vh] min-h-[500px] max-h-[700px] flex items-center overflow-hidden -mt-36 pt-36 z-10">

    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <?php if (is_array($hero_image)) : ?>
            <img src="<?php echo esc_url($hero_image['url']); ?>"
                alt="<?php echo esc_attr($hero_image['alt'] ?: $hero_title); ?>"
                class="w-full h-full object-cover">
        <?php else : ?>
            <img src="<?php echo esc_url($hero_image); ?>"
                alt="<?php echo esc_attr($hero_title); ?>"
                class="w-full h-full object-cover">
        <?php endif; ?>
    </div>

    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-slate-900/30 z-0"></div>

    <!-- Content -->
    <div class="relative z-20 w-full">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="max-w-3xl">

                <!-- Hero Title -->
                <h1 class="text-6xl lg:text-7xl xl:text-8xl font-bold text-white mb-6 animate-fade-in-up">
                    <?php echo esc_html($hero_title); ?>
                </h1>

                <!-- Hero Subtitle -->
                <?php if ($hero_subtitle) : ?>
                    <p class="text-2xl lg:text-3xl text-white/90 font-light mb-8 animate-fade-in-up animation-delay-200">
                        <?php echo esc_html($hero_subtitle); ?>
                    </p>
                <?php endif; ?>

                <!-- Call to Action Buttons -->
                <?php if ($hero_cta) : ?>
                    <div class="flex flex-wrap gap-4 animate-fade-in-up animation-delay-400">
                        <a href="<?php echo esc_url($hero_cta['url']); ?>"
                            target="<?php echo esc_attr($hero_cta['target'] ?: '_self'); ?>"
                            class="inline-flex items-center bg-hamco-green hover:bg-green-700 text-white font-semibold px-8 py-4 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <?php echo esc_html($hero_cta['title']); ?>
                            <i class="fas fa-arrow-right ml-3"></i>
                        </a>
                    </div>
                <?php endif; ?>

                <!-- Quick Links (optional) -->
                <?php if (have_rows('hero_quick_links', 'options')) : ?>
                    <div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-4 animate-fade-in-up animation-delay-600">
                        <?php while (have_rows('hero_quick_links', 'options')) : the_row();
                            $link = get_sub_field('link');
                            $icon = get_sub_field('icon');
                        ?>
                            <a href="<?php echo esc_url($link['url']); ?>"
                                target="<?php echo esc_attr($link['target'] ?: '_self'); ?>"
                                class="group bg-white/10 backdrop-blur-sm hover:bg-white/20 rounded-lg p-4 text-center transition-all duration-300">
                                <?php if ($icon) : ?>
                                    <i class="<?php echo esc_attr($icon); ?> text-2xl text-white mb-2"></i>
                                <?php endif; ?>
                                <span class="block text-sm text-white font-medium">
                                    <?php echo esc_html($link['title']); ?>
                                </span>
                            </a>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce z-20">
        <a href="#primary" class="text-white/60 hover:text-white transition-colors duration-200">
            <i class="fas fa-chevron-down text-2xl"></i>
        </a>
    </div>
</section>