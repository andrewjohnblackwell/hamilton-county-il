<?php

/**
 * Template part for displaying subpage hero banner
 *
 * @package HamcoChild
 */

// Get hero image - check for featured image first, then ACF field, then default
$hero_image = '';
if (has_post_thumbnail()) {
    $hero_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
} elseif (get_field('hero_background_image')) {
    $image = get_field('hero_background_image');
    $hero_image = is_array($image) ? $image['url'] : $image;
}

// Fallback to default hero image from theme options
if (empty($hero_image)) {
    $default_hero = get_field('default_hero_image', 'options');
    if ($default_hero) {
        $hero_image = is_array($default_hero) ? $default_hero['url'] : $default_hero;
    }
}

// Get page title and subtitle
$page_title = get_field('hero_custom_title') ?: get_the_title();
$page_subtitle = get_field('hero_subtitle');

// For child departments, use the parent department's title
if (get_post_type() === 'department') {
    $parent_id = wp_get_post_parent_id(get_the_ID());
    if ($parent_id) {
        $page_title = get_the_title($parent_id);
        // Optionally show current page as subtitle
        if (empty($page_subtitle)) {
            $page_subtitle = get_the_title();
        }
    }
}

// Get breadcrumbs (function defined in functions.php)
$breadcrumbs = hamco_get_breadcrumbs();
?>

<section class="hero-subpage relative min-h-[20rem] overflow-hidden -mt-36 pt-36 pb-12 z-10">

    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <?php if ($hero_image) : ?>
            <!-- Background Image -->
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                style="background-image: url('<?php echo esc_url($hero_image); ?>');">
            </div>
            <!-- Dark Overlay -->
            <div class="absolute inset-0 bg-slate-900/50"></div>
        <?php else : ?>
            <!-- Fallback Gradient -->
            <div class="absolute inset-0 bg-gradient-to-br from-slate-800 to-slate-900"></div>
        <?php endif; ?>
    </div>

    <!-- Content Container -->
    <div class="relative h-full flex items-center z-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 w-full">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">

                <!-- Page Title Section (Left) -->
                <div class="flex-1">
                    <h1 class="text-4xl lg:text-5xl font-bold text-white uppercase tracking-wide animate-fade-in-up py-6">
                        <?php echo esc_html($page_title); ?>
                    </h1>

                    <?php if ($page_subtitle) : ?>
                        <p class="text-lg text-white/90 mt-2 font-light animate-fade-in-up animation-delay-200">
                            <?php echo esc_html($page_subtitle); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Breadcrumbs (Right) -->
                <?php if (!empty($breadcrumbs) && count($breadcrumbs) > 1) : ?>
                    <nav aria-label="Breadcrumb" class="text-right animate-fade-in-up animation-delay-400">
                        <ol class="inline-flex items-center space-x-2 text-sm uppercase tracking-wider">
                            <?php foreach ($breadcrumbs as $index => $crumb) : ?>
                                <li class="inline-flex items-center">
                                    <?php if ($crumb['current']) : ?>
                                        <span class="text-white font-semibold">
                                            <?php echo esc_html($crumb['title']); ?>
                                        </span>
                                    <?php else : ?>
                                        <a href="<?php echo esc_url($crumb['url']); ?>"
                                            class="text-white/80 hover:text-white transition-colors duration-200">
                                            <?php echo esc_html($crumb['title']); ?>
                                        </a>
                                    <?php endif; ?>

                                    <?php if ($index < count($breadcrumbs) - 1) : ?>
                                        <span class="mx-2 text-white/60">/</span>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ol>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>