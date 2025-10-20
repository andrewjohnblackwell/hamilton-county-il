<?php

/**
 * Template part for displaying the Hero Slideshow on Pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blackwell_Digital_Base_Theme_2023
 */

?>

<section class="hero-slideshow position-relative">

    <?php // check if the repeater field has rows of data
    if (have_rows('slideshow_repeater', 'options')) : ?>

        <div class="main-carousel" data-flickity='{"lazyLoad": true, "cellAlign": "left", "contain": true, "prevNextButtons": true, "autoPlay": true, "pageDots": false, "imagesLoaded": true}'>

            <?php // loop through the rows of data
            while (have_rows('slideshow_repeater', 'options')) : the_row(); ?>
                <?php if (get_sub_field('slide_background_image')) : ?>
                    <div class="carousel-cell">
                        <!-- <div class="bkg-dark-overlay d-none d-md-block"></div> -->
                        <?php
                        $carousel_image = get_sub_field('slide_background_image');
                        if (!empty($carousel_image)) : ?>

                            <div class="container">

                                <div class="page-text-container">

                                    <?php if (get_sub_field('slide_title')) : ?>
                                        <h2 class="page-title"><?php echo get_sub_field('slide_title'); ?></h2>
                                    <?php endif; ?>

                                    <?php if (get_sub_field('slide_content')) : ?>
                                        <p class="page-description"><?php echo get_sub_field('slide_content'); ?></p>
                                    <?php endif; ?>

                                    <?php
                                    $link = get_sub_field('slide_call_to_action');
                                    if ($link) :
                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                    ?>
                                        <p class="mt-4">
                                            <a class="btn btn-primary" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                                        </p>
                                    <?php endif; ?>


                                </div>

                            </div>

                            <img class="carousel-image page-image" src=" <?php echo esc_url($carousel_image['url']); ?>" alt="<?php echo esc_attr($carousel_image['alt']) ?>" title="<?php echo esc_attr($carousel_image['caption']) ?>" />

                        <?php endif; ?>

                    </div>
                <?php endif; ?>

        <?php endwhile;

            echo '</div>';

        else :

        // no rows found

        endif; ?>

</section>