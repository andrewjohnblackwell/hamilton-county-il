<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blackwell_Digital_Base_Theme_2023
 */

?>

<footer id="colophon" class="site-footer">
	<div class="site-info bkg-darkgray-0 pt-5">
		<div class="container pt-md-3 pt-0">

			<div class="row">
				<div class="col-md-3">
					<h6>Departments</h6>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-3',
							'menu_id'        => 'footer-nav-departments',
							'container_class' => 'footer-nav-departments mt-4 mb-5',
							'menu_class'      => 'footer-nav-departments footer-nav list-unstyled m-0 p-0',
						)
					);
					?>
				</div>
				<div class="col-md-3">
					<h6>County Resources</h6>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-2',
							'menu_id'        => 'footer-nav-resources',
							'container_class' => 'footer-nav-resources mt-4 mb-5',
							'menu_class'      => 'footer-nav-resources footer-nav list-unstyled m-0 p-0',
						)
					);
					?>
					<h6>County Calendar</h6>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-4',
							'menu_id'        => 'footer-nav-calendar',
							'container_class' => 'footer-nav-calendar mt-4 mb-5',
							'menu_class'      => 'footer-nav-calendar footer-nav list-unstyled m-0 p-0',
						)
					);
					?>
				</div>
				<div class="col-md-3 footer-upcoming-events">
					<h6>Upcoming Events</h6>




					<?php
					$featured_events = get_field('featured_event_one', 'options');
					if ($featured_events) :

					?>
						<div class="row">
							<div class="col-md-12 mb-2">
								<h4><?php echo esc_html($featured_events->post_title); ?></h4>
								<span class="d-block featured-meta"><?php echo tribe_get_start_date($featured_events->ID); ?></span>
								<p class="text-body mb-2"><?php echo get_the_excerpt($featured_events); ?> <a class="" href="<?php the_permalink($featured_events); ?>">Read More</a>
								</p>
							</div>

						</div>
					<?php endif; ?>

					<?php
					$featured_events = get_field('featured_event_two', 'options');
					if ($featured_events) :

					?>
						<div class="row">
							<div class="col-md-12 mb-2">
								<h4><?php echo esc_html($featured_events->post_title); ?></h4>
								<span class="d-block featured-meta"><?php echo tribe_get_start_date($featured_events->ID); ?></span>
								<p class="text-body mb-2"><?php echo get_the_excerpt($featured_events); ?> <a class="" href="<?php the_permalink($featured_events); ?>">Read More</a>
								</p>
							</div>

						</div>
					<?php endif; ?>

					<?php
					$featured_events = get_field('featured_event_three', 'options');
					if ($featured_events) :

					?>

						<div class="row">
							<div class="col-md-12 mb-2">
								<h4><?php echo esc_html($featured_events->post_title); ?></h4>
								<span class="d-block featured-meta"><?php echo tribe_get_start_date($featured_events->ID); ?></span>
								<p class="text-body mb-2"><?php echo get_the_excerpt($featured_events); ?> <a class="" href="<?php the_permalink($featured_events); ?>">Read More</a>
								</p>
							</div>


						<?php endif; ?>

						</div>


				</div>
				<div class="col-md-3 footer-contact-info">
					<h6>Contact Info</h6>
					<ul class="list-unstyled mt-4">
						<li>
							<p class="mb-0 pb-0"><strong><?php echo get_bloginfo("name"); ?> Courthouse</strong> <br />
								<?php if (get_field('street_address', 'options')) : ?>
									<?php echo get_field('street_address', 'options'); ?> </br>
								<?php endif; ?>
								<?php if (get_field('city_state_zip', 'options')) : ?>
									<?php echo get_field('city_state_zip', 'options'); ?>
								<?php endif; ?>

							</p>
						</li>
						<li>
							<strong>Hours</strong>
							<?php if (have_rows('hours_of_operation_repeater', 'options')) : ?>
								<div class="row">
									<?php while (have_rows('hours_of_operation_repeater', 'options')) : the_row(); ?>
										<div class="col-5">
											<p class="m-0 p-0"><?php the_sub_field('day_of_the_week'); ?></p>
										</div>
										<div class="col-7">
											<p class="m-0 p-0"><?php the_sub_field('hours_of_operation'); ?></p>
										</div>
									<?php endwhile; ?>
								</div>
							<?php endif; ?>

						</li>
						<li>
							<strong>Phone Number</strong>
							<?php if (get_field('phone_number', 'options')) : ?>
								<p><?php echo get_field('phone_number', 'options'); ?></p>
							<?php endif; ?>

						</li>
					</ul>

				</div>
			</div>
		</div>
	</div><!-- .site-info -->

	<div class="copyright bkg-darkgray-1 py-4">
		<div class="container">
			<div class="row align-items-center d-flex">
				<div class="col-md-6 text-md-start text-center">
					<span class="copyright-text d-block">&copy; <?php echo date('Y'); ?> <?php echo get_bloginfo("name"); ?>. All Rights Reserved</span>
				</div>
				<div class="col-md-6 text-md-end text-center">
					<a href="https://www.blackwell.digital"><i class="fa-solid fa-code"></i> Powered by Blackwell Digital</a>
				</div>
			</div>
		</div>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>