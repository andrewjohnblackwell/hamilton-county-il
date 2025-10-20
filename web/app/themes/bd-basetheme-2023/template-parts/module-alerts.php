<?php

/**
 * Template part for displaying the County Alerts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blackwell_Digital_Base_Theme_2023
 */

?>
<section class="county-alerts">
    <div class="container-fluid g-0">
        <div class="row align-items-center d-flex g-0">
            <div class="col-md-6 text-center">
                <iframe src="https://local.nixle.com/signup/widget/g/2795" frameborder="0"></iframe>
            </div>
            <div class="col-md-6 text-white p-5 alert-content bkg-cover" style="background-image:url(<?php echo get_field('alert_background_image', 'options'); ?>);">
                <div>
                    <h3 class="mb-3"><?php if (get_field('alert_title', 'options')) : ?>
                            <?php echo get_field('alert_title', 'options'); ?>
                        <?php endif; ?>
                    </h3>
                    <p><?php if (get_field('alert_content', 'options')) : ?>
                            <?php echo get_field('alert_content', 'options'); ?>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>