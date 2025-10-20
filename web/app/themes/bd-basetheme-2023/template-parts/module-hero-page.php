<?php

/**
 * Template part for displaying a page header hero
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blackwell_Digital_Base_Theme_2023
 */

?>
<?php $hero_bkg_image = get_the_post_thumbnail_url(); ?>
<section class="hero-page position-relative bkg-cover section-padding mb-5" style="background-image:url(<?php echo $hero_bkg_image; ?>);?>">
    <div class="bkg-dark-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 text-center z-20">

                <h2 class="text-h2 mb-0"><?php echo the_title(); ?></h2>

            </div>
        </div>
    </div>
</section>