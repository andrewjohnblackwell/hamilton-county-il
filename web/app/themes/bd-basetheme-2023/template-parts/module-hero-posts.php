<?php

/**
 * Template part for displaying a post hero image
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blackwell_Digital_Base_Theme_2023
 */

?>

<section class="hero-page position-relative bkg-cover section-padding mb-5" style="background-image:url(<?php echo get_field('posts_hero_featured_image', 'options') ?>);?>">
    <div class="bkg-dark-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 text-center z-20">
                <?php

                if (is_home()) { ?>
                    <h2 class="text-h2 mb-0">County News</h2>
                <?php } elseif (is_single()) { ?>
                    <?php the_title('<h2 class="text-h2 mb-0">', '</h2>'); ?>
                <?php } else { ?>
                    <?php the_archive_title('<h2 class="text-h2 mb-0">', '</h2>'); ?>
                <?php }

                ?>

            </div>
        </div>
    </div>
</section>