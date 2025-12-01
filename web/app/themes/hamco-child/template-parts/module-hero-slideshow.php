<?php

/**
 * Template part for displaying hero slideshow
 *
 * @package HamcoChild
 */

// Check if we have slides
if (have_rows('hero_slides', 'options')) : ?>
    <section class="hero-slideshow relative overflow-hidden" x-data="heroSlideshow()">
        <div class="relative h-[500px] md:h-[600px]">
            <?php
            $slide_count = 0;
            while (have_rows('hero_slides', 'options')) : the_row();
                $slide_count++;
                $image = get_sub_field('slide_image');
                $title = get_sub_field('slide_title');
                $content = get_sub_field('slide_content');
                $link = get_sub_field('slide_link');
            ?>
                <div class="absolute inset-0 transition-opacity duration-1000"
                    :class="{ 'opacity-100': currentSlide === <?php echo $slide_count; ?>, 'opacity-0': currentSlide !== <?php echo $slide_count; ?> }"
                    x-show="currentSlide === <?php echo $slide_count; ?>">

                    <!-- Slide Image -->
                    <?php if ($image) : ?>
                        <img src="<?php echo esc_url($image['url']); ?>"
                            alt="<?php echo esc_attr($image['alt'] ?: $title); ?>"
                            class="w-full h-full object-cover">
                    <?php else : ?>
                        <div class="w-full h-full bg-gradient-to-br from-hamco-green to-green-800"></div>
                    <?php endif; ?>

                    <!-- Dark Overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-40"></div>

                    <!-- Slide Content -->
                    <div class="absolute inset-0 flex items-center">
                        <div class="container mx-auto px-4">
                            <div class="max-w-3xl">
                                <?php if ($title) : ?>
                                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 animate-fade-in-up">
                                        <?php echo esc_html($title); ?>
                                    </h1>
                                <?php endif; ?>

                                <?php if ($content) : ?>
                                    <p class="text-lg md:text-xl text-gray-200 mb-6 animate-fade-in-up animation-delay-200">
                                        <?php echo esc_html($content); ?>
                                    </p>
                                <?php endif; ?>

                                <?php if ($link) : ?>
                                    <div class="animate-fade-in-up animation-delay-400">
                                        <a href="<?php echo esc_url($link['url']); ?>"
                                            target="<?php echo esc_attr($link['target'] ?: '_self'); ?>"
                                            class="inline-flex items-center bg-hamco-green hover:bg-green-700 text-white font-semibold px-8 py-4 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                                            <?php echo esc_html($link['title']); ?>
                                            <i class="fas fa-arrow-right ml-3"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>

            <!-- Slide Navigation -->
            <?php if ($slide_count > 1) : ?>
                <!-- Previous/Next Buttons -->
                <button @click="previousSlide()"
                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-black bg-opacity-50 hover:bg-opacity-70 text-white p-3 rounded-full transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <button @click="nextSlide()"
                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-black bg-opacity-50 hover:bg-opacity-70 text-white p-3 rounded-full transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white">
                    <i class="fas fa-chevron-right"></i>
                </button>

                <!-- Slide Indicators -->
                <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex space-x-2">
                    <?php for ($i = 1; $i <= $slide_count; $i++) : ?>
                        <button @click="currentSlide = <?php echo $i; ?>"
                            class="w-3 h-3 rounded-full transition-all duration-200"
                            :class="{ 'bg-white w-8': currentSlide === <?php echo $i; ?>, 'bg-white bg-opacity-50': currentSlide !== <?php echo $i; ?> }">
                            <span class="sr-only">Slide <?php echo $i; ?></span>
                        </button>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <script>
        function heroSlideshow() {
            return {
                currentSlide: 1,
                totalSlides: <?php echo $slide_count; ?>,
                autoplayInterval: null,

                init() {
                    this.startAutoplay();
                },

                nextSlide() {
                    this.currentSlide = this.currentSlide >= this.totalSlides ? 1 : this.currentSlide + 1;
                    this.restartAutoplay();
                },

                previousSlide() {
                    this.currentSlide = this.currentSlide <= 1 ? this.totalSlides : this.currentSlide - 1;
                    this.restartAutoplay();
                },

                startAutoplay() {
                    this.autoplayInterval = setInterval(() => {
                        this.nextSlide();
                    }, 6000);
                },

                restartAutoplay() {
                    clearInterval(this.autoplayInterval);
                    this.startAutoplay();
                }
            }
        }
    </script>

<?php else : ?>
    <!-- Fallback to single hero if no slideshow -->
    <?php get_template_part('template-parts/module', 'hero-page'); ?>
<?php endif; ?>