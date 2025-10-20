<?php

/**
 * Template part for displaying the Featured Events
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blackwell_Digital_Base_Theme_2023
 */

?>
<section class="featured-events py-5 position-relative bkg-cover" style="background-image:url(<?php echo get_field('events_background_image', 'options'); ?>);">
    <div class="bkg-dark-overlay d-md-block"></div>
    <div class="container z-20 position-relative">

        <div class="row">
            <div class="col-md-10 offset-md-1 mb-5 mb-md-5 text-center">
                <h3 class="text-h3 mb-3">Upcoming County Events</h3>
                <p class="d-block quote-bar mt-4"><i class="fa-light fa-calendar-days"></i></p>
                <p class="events-callout mt-4">
                    <?php if (get_field('event_callout_text', 'options')) : ?>
                        <?php echo get_field('event_callout_text', 'options'); ?>
                    <?php endif; ?>
                </p>
            </div>
        </div>


        <div class="row">

            <?php
            $featured_events = get_field('featured_event_one', 'options');
            if ($featured_events) :

            ?>

                <div class="col-md-4 mb-4">
                    <span class="featured-news-img-container mb-4 d-block">
                        <?php echo get_the_post_thumbnail($featured_events->ID, 'full', array('class' => 'img-fluid')); ?>
                    </span>
                    <h4><?php echo esc_html($featured_events->post_title); ?></h4>
                    <span class="d-block featured-meta"><?php echo tribe_get_start_date($featured_events->ID); ?></span>
                    <p class="text-body mb-4"><?php echo get_the_excerpt($featured_events); ?></p>
                    <p>
                        <a class="btn btn-primary" href="<?php the_permalink($featured_events); ?>">Read More</a>
                    </p>
                </div>


            <?php endif; ?>

            <?php
            $featured_events = get_field('featured_event_two', 'options');
            if ($featured_events) :

            ?>

                <div class="col-md-4 mb-4">
                    <span class="featured-news-img-container mb-4 d-block">
                        <?php echo get_the_post_thumbnail($featured_events->ID, 'full', array('class' => 'img-fluid')); ?>
                    </span>
                    <h4><?php echo esc_html($featured_events->post_title); ?></h4>
                    <span class="d-block featured-meta"><?php echo tribe_get_start_date($featured_events->ID); ?></span>
                    <p class="text-body mb-4"><?php echo get_the_excerpt($featured_events); ?></p>
                    <p>
                        <a class="btn btn-primary" href="<?php the_permalink($featured_events); ?>">Read More</a>
                    </p>
                </div>


            <?php endif; ?>

            <?php
            $featured_events = get_field('featured_event_three', 'options');
            if ($featured_events) :

            ?>

                <div class="col-md-4 mb-4">
                    <span class="featured-news-img-container mb-4 d-block">
                        <?php echo get_the_post_thumbnail($featured_events->ID, 'full', array('class' => 'img-fluid')); ?>
                    </span>
                    <h4><?php echo esc_html($featured_events->post_title); ?></h4>
                    <span class="d-block featured-meta"><?php echo tribe_get_start_date($featured_events->ID); ?></span>
                    <p class="text-body mb-4"><?php echo get_the_excerpt($featured_events); ?></p>
                    <p>
                        <a class="btn btn-primary" href="<?php the_permalink($featured_events); ?>">Read More</a>
                    </p>
                </div>


            <?php endif; ?>

        </div>




    </div>

</section>