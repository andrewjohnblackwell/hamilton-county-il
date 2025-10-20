<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Blackwell_Digital_Base_Theme_2023
 */

get_header();
?>
<?php get_template_part('template-parts/module', 'hero-page'); ?>
<main id="primary" class="site-main">
	<div class="container">
		<div class="row d-flex align-items-start my-3">


			<?php if (have_rows('department_sidebar_link_repeater')) : ?>
				<div class="col-md-4">
					<ul class="sidebar-links">
						<?php while (have_rows('department_sidebar_link_repeater')) : the_row(); ?>
							<?php
							$link = get_sub_field('sidebar_link');
							if ($link) :
								$link_url = $link['url'];
								$link_title = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self';
							?>
								<li>
									<a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
										<?php echo esc_html($link_title); ?>
									</a>
								</li>
							<?php endif; ?>
						<?php endwhile; ?>
					</ul>
				</div>
			<?php endif; ?>



			<div class="col-md-8 ps-0 ps-md-5">
				<div class="row">
					<div class="col-md-4"><?php if (get_field('manager_headshot')) : $image = get_field('manager_headshot'); ?>

							<!-- Full size image -->
							<img class="img-fluid manager-headshot" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

						<?php endif; ?>
					</div>
					<div class="col-md-8">
						<?php if (get_field('manager_name')) : ?>
							<h4 class="manager-name mb-3"><?php echo get_field('manager_name'); ?></h4>
						<?php endif; ?>

						<p>
							<?php if (get_field('manager_title')) : ?>
								<span class="d-block manager-title"><?php echo get_field('manager_title'); ?></span>
							<?php endif; ?>

							<?php if (get_field('manager_street_address')) : ?>
								<span class="d-block manager-street">
									<?php echo get_field('manager_street_address'); ?>
								</span>
							<?php endif; ?>

							<?php if (get_field('manager_city_state_zip')) : ?>
								<span class="d-block manager-street"><?php echo get_field('manager_city_state_zip'); ?></span>
							<?php endif; ?>
						</p>

						<div class="row">
							<div class="col-md-6">
								<p class="manager-street">
									<?php if (get_field('manager_phone_number')) : ?>
										<span class="d-block">Phone: <strong><?php echo get_field('manager_phone_number'); ?></strong></span>
									<?php endif; ?>
									<?php if (get_field('manager_email')) : ?>
										<span class="d-block">Email: <strong><?php echo get_field('manager_email'); ?></strong></span>
									<?php endif; ?>
								</p>
							</div>
							<div class="col-md-6">
								<p class="manager-street">
									<?php if (get_field('manager_office_hours')) : ?>
										<span class="d-block">Office Hours: <strong><?php echo get_field('manager_office_hours'); ?></strong></span>
									<?php endif; ?>
									<?php if (get_field('manager_note')) : ?>
										<span class="d-block"><?php echo get_field('manager_note'); ?></span>

									<?php endif; ?>
								</p>
							</div>
						</div>

					</div>
				</div>



			</div>
		</div>



		<?php if (get_field('department_about_section')) : ?>
			<div class="row mb-5">
				<div class="col-md-12">
					<h3>About</h3>
					<p><?php echo get_field('department_about_section'); ?> </p>
				</div>
			</div>
		<?php endif; ?>



		<div class="row">


			<?php if (have_rows('department_link_repeater')) : ?>
				<div class="col-md-6 my-3 my-md-5">
					<h3>Links</h3>
					<?php while (have_rows('department_link_repeater')) : the_row(); ?>

						<?php
						$link = get_sub_field('department_link');
						if ($link) :
							$link_url = $link['url'];
							$link_title = $link['title'];
							$link_target = $link['target'] ? $link['target'] : '_self';
						?>
							<a class="d-block mb-3" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
						<?php endif; ?>

					<?php endwhile; ?>
				</div>
			<?php endif; ?>




			<?php if (have_rows('department_documents_repeater')) : ?>
				<div class="col-md-6 my-3 my-md-5">
					<h3>Documents</h3>
					<?php while (have_rows('department_documents_repeater')) : the_row(); ?>

						<?php
						$file = get_sub_field('department_document');
						if ($file) : ?>
							<a class="d-block mb-3" href="<?php echo $file['url']; ?>"><?php echo $file['title']; ?></a>
						<?php endif; ?>

					<?php endwhile; ?>
				</div>
			<?php endif; ?>

		</div>



		<?php if (have_rows('tax_data_repeater')) : ?>
			<div class="row mb-5">
				<div class="col-md-6 my-3 my-md-5">
					<h3>Tax Data</h3>
					<?php while (have_rows('tax_data_repeater')) : the_row(); ?>

						<?php
						$file = get_sub_field('tax_data_document');
						if ($file) : ?>
							<a class="d-block mb-3" href="<?php echo $file['url']; ?>"><?php echo $file['title']; ?></a>
						<?php endif; ?>

					<?php endwhile; ?>
				</div>
			</div>
		<?php endif; ?>



		<div class="row mb-5">
			<div class="col-md-12">
				<?php
				while (have_posts()) :
					the_post();

					get_template_part('template-parts/content', get_post_type());

				endwhile; // End of the loop.
				?>
			</div>
		</div>

	</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
