<?php

/**
 * Template part for displaying the Quick Links Module
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blackwell_Digital_Base_Theme_2023
 */

?>


<?php if (have_rows('quick_links_repeater', 'options')) : ?>
    <?php $counter = 0; ?>
    <section class="quick-links section-padding">
        <div class="container">
            <div class="row">
                <?php while (have_rows('quick_links_repeater', 'options')) : the_row(); ?>

                    <div class="col-lg-4 text-center mb-5">
                        <div class="circle-card py-5 mx-auto px-4 text-center d-flex align-items-center">
                            <div class="w-100">

                                <span class="fa-stack fa-2x quick-links-icon">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fal <?php the_sub_field('icon'); ?> fa-stack-1x fa-inverse"></i>
                                </span>

                                <h4><?php the_sub_field('title'); ?></h4>
                                <p><?php the_sub_field('content'); ?></p>

                                <?php
                                $link = get_sub_field('call_to_action');
                                if ($link) :
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                    <a class="btn btn-secondary" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <?php $counter++;
                    if ($counter % 3 === 0) : echo '</div><div class="row">';

                    endif; ?>

                <?php endwhile; ?>

                <?php echo '</div>'; ?>

            </div>
        </div>
    </section>

<?php endif; ?>