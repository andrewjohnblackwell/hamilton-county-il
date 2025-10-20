<?php

/**
 * Template part for displaying the Hero Centered Block of Text on a Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blackwell_Digital_Base_Theme_2023
 */

?>
<section class="hero-centered section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center">
                <h3 class="text-h3 mb-4"><?php if (get_field('hero_title')) : ?>
                        <?php echo get_field('hero_title'); ?>
                    <?php endif; ?>
                </h3>
                <p class="text-body mb-4"><?php if (get_field('hero_content')) : ?>
                        <?php echo get_field('hero_content'); ?>
                    <?php endif; ?>
                </p>
                <?php
                $link = get_field('hero_call_to_action');
                if ($link) :
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                    <p><a class="btn btn-primary" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>