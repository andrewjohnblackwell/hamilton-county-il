<?php

/**
 * Template part for displaying the Featured News Article
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blackwell_Digital_Base_Theme_2023
 */

?>
<section class="featured-news my-5">
    <div class="container">


        <?php
        $featured_post = get_field('featured_news_article', 'options');
        if ($featured_post) :

        ?>
            <div class="row">
                <div class="col-md-12 mb-5 mb-md-5 text-center">
                    <h3 class="text-h3">Featured News</h3>
                    <span class="d-block featured-meta"><?php echo get_the_date('F j, Y', $featured_post->ID); ?></span>
                    <p class="d-block quote-bar mt-3"><i class="fa-light fa-tower-cell"></i></p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-4">
                    <span class="featured-news-img-container">
                        <?php echo get_the_post_thumbnail($featured_post->ID, 'full', array('class' => 'img-fluid w-100')); ?>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-start">
                    <h4 class="mb-3"><?php echo esc_html($featured_post->post_title); ?></h4>
                    <p class="text-body mb-4"><?php echo get_the_excerpt($featured_post); ?></p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <p>
                        <a class="btn btn-primary" href="/news/">All Recent News</a>
                    </p>
                </div>
            </div>



        <?php endif; ?>

    </div>

</section>