<?php

/**
 * The template for displaying single department posts
 *
 * @package HamcoChild
 */

get_header();
?>

<?php get_template_part('template-parts/module', 'hero-page'); ?>

<main id="primary" class="site-main">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <!-- Sidebar Navigation -->
            <?php
            $current_id = get_the_ID();
            $parent_id = wp_get_post_parent_id($current_id);

            // Check if this department has child departments
            $child_departments = get_posts([
                'post_type' => 'department',
                'post_parent' => $current_id,
                'post_status' => 'publish',
                'numberposts' => 1
            ]);
            $has_children = !empty($child_departments);

            // Check if this is a child department (has a parent)
            $is_child = !empty($parent_id);

            // Show sidebar if has children OR is a child department
            $show_sidebar = $has_children || $is_child;

            if ($show_sidebar) :
                // Determine which department's children to show
                $sidebar_parent_id = $is_child ? $parent_id : $current_id;

                // Get all sibling/child departments
                $sidebar_departments = get_posts([
                    'post_type' => 'department',
                    'post_parent' => $sidebar_parent_id,
                    'post_status' => 'publish',
                    'numberposts' => -1,
                    'orderby' => 'menu_order title',
                    'order' => 'ASC'
                ]);
            ?>
                <aside class="lg:col-span-1">
                    <nav class="bg-hamco-green rounded-lg shadow-lg sticky top-24 overflow-hidden">
                        <h3 class="text-white font-semibold text-sm px-4 py-3 bg-green-800">
                            Department Links
                        </h3>
                        <ul class="divide-y divide-green-700">
                            <?php if ($is_child) : ?>
                                <li>
                                    <a href="<?php echo get_permalink($parent_id); ?>"
                                        class="sidebar-nav-item flex items-center group text-white px-4 py-3 hover:bg-green-800 bg-green-700"
                                        style="color: white !important;">
                                        <i class="fas fa-home mr-2 text-xs"></i>
                                        <?php echo esc_html(get_the_title($parent_id)); ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php foreach ($sidebar_departments as $dept) :
                                $is_active = ($dept->ID === $current_id);
                            ?>
                                <li>
                                    <a href="<?php echo get_permalink($dept->ID); ?>"
                                        class="sidebar-nav-item flex items-center group text-white px-4 py-3 hover:bg-green-800 <?php echo $is_active ? 'bg-green-900 font-bold' : ''; ?>"
                                        style="color: white !important;">
                                        <i class="fas fa-chevron-right mr-2 text-xs <?php echo $is_active ? 'opacity-100' : 'opacity-50 group-hover:opacity-100'; ?> transition-opacity"></i>
                                        <?php echo esc_html($dept->post_title); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                </aside>
            <?php endif; ?>

            <!-- Main Content -->
            <div class="<?php echo $show_sidebar ? 'lg:col-span-3' : 'lg:col-span-4'; ?>">

                <!-- Department Manager/Head -->
                <?php if (get_field('manager_name')) : ?>
                    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                            <!-- Manager Photo -->
                            <div class="md:col-span-1">
                                <?php if (get_field('manager_headshot')) :
                                    $image = get_field('manager_headshot');
                                ?>
                                    <img src="<?php echo esc_url($image['url']); ?>"
                                        alt="<?php echo esc_attr($image['alt'] ?: get_field('manager_name')); ?>"
                                        class="w-full rounded-lg shadow-md">
                                <?php else : ?>
                                    <div class="aspect-[3/4] bg-gray-200 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-user text-gray-400 text-5xl"></i>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Manager Info -->
                            <div class="md:col-span-2">
                                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                                    <?php echo esc_html(get_field('manager_name')); ?>
                                </h2>

                                <?php if (get_field('manager_title')) : ?>
                                    <p class="text-lg text-gray-600 mb-4">
                                        <?php echo esc_html(get_field('manager_title')); ?>
                                    </p>
                                <?php endif; ?>

                                <div class="space-y-2 text-gray-700">
                                    <?php if (get_field('manager_street_address') || get_field('manager_city_state_zip')) : ?>
                                        <div class="flex items-start">
                                            <i class="fas fa-map-marker-alt text-hamco-green mt-1 mr-3 w-4"></i>
                                            <div>
                                                <?php if (get_field('manager_street_address')) : ?>
                                                    <span class="block"><?php echo esc_html(get_field('manager_street_address')); ?></span>
                                                <?php endif; ?>
                                                <?php if (get_field('manager_city_state_zip')) : ?>
                                                    <span class="block"><?php echo esc_html(get_field('manager_city_state_zip')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (get_field('manager_phone_number')) : ?>
                                        <div class="flex items-center">
                                            <i class="fas fa-phone text-hamco-green mr-3 w-4"></i>
                                            <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', get_field('manager_phone_number')); ?>"
                                                class="text-hamco-green hover:text-green-800 transition-colors duration-200">
                                                <?php echo esc_html(get_field('manager_phone_number')); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (get_field('manager_email')) : ?>
                                        <div class="flex items-center">
                                            <i class="fas fa-envelope text-hamco-green mr-3 w-4"></i>
                                            <a href="mailto:<?php echo esc_attr(get_field('manager_email')); ?>"
                                                class="text-hamco-green hover:text-green-800 transition-colors duration-200">
                                                <?php echo esc_html(get_field('manager_email')); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (get_field('manager_office_hours')) : ?>
                                        <div class="flex items-start">
                                            <i class="fas fa-clock text-hamco-green mt-1 mr-3 w-4"></i>
                                            <div>
                                                <span class="font-semibold">Office Hours:</span>
                                                <span class="block"><?php echo esc_html(get_field('manager_office_hours')); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (get_field('manager_note')) : ?>
                                        <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                                            <p class="text-sm"><?php echo esc_html(get_field('manager_note')); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- About Section -->
                <?php if (get_field('department_about_section')) : ?>
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">About This Department</h2>
                        <div class="prose prose-lg max-w-none text-gray-600">
                            <?php echo wp_kses_post(get_field('department_about_section')); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Department Staff Grid -->
                <?php if (have_rows('department_staff')) : ?>
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Our Staff</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <?php while (have_rows('department_staff')) : the_row(); ?>
                                <div class="staff-card">
                                    <?php
                                    $staff_photo = get_sub_field('staff_photo');
                                    if ($staff_photo) :
                                    ?>
                                        <img src="<?php echo esc_url($staff_photo['sizes']['thumbnail']); ?>"
                                            alt="<?php echo esc_attr(get_sub_field('staff_name')); ?>"
                                            class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                                    <?php else : ?>
                                        <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                                            <i class="fas fa-user text-gray-400 text-3xl"></i>
                                        </div>
                                    <?php endif; ?>

                                    <h3 class="font-semibold text-lg text-center text-gray-800 mb-1">
                                        <?php echo esc_html(get_sub_field('staff_name')); ?>
                                    </h3>

                                    <?php if (get_sub_field('staff_title')) : ?>
                                        <p class="text-gray-600 text-center mb-4">
                                            <?php echo esc_html(get_sub_field('staff_title')); ?>
                                        </p>
                                    <?php endif; ?>

                                    <div class="space-y-2 text-sm">
                                        <?php if (get_sub_field('staff_phone')) : ?>
                                            <div class="flex items-center justify-center">
                                                <i class="fas fa-phone text-hamco-green mr-2"></i>
                                                <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', get_sub_field('staff_phone')); ?>"
                                                    class="text-hamco-green hover:text-green-800">
                                                    <?php echo esc_html(get_sub_field('staff_phone')); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (get_sub_field('staff_fax')) : ?>
                                            <div class="flex items-center justify-center">
                                                <i class="fas fa-fax text-gray-500 mr-2"></i>
                                                <span class="text-gray-600">
                                                    Fax: <?php echo esc_html(get_sub_field('staff_fax')); ?>
                                                </span>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (get_sub_field('staff_email')) : ?>
                                            <div class="flex items-center justify-center">
                                                <i class="fas fa-envelope text-hamco-green mr-2"></i>
                                                <a href="mailto:<?php echo esc_attr(get_sub_field('staff_email')); ?>"
                                                    class="text-hamco-green hover:text-green-800 truncate">
                                                    <?php echo esc_html(get_sub_field('staff_email')); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (get_sub_field('staff_address')) : ?>
                                            <div class="text-center text-gray-600 mt-3">
                                                <?php echo nl2br(esc_html(get_sub_field('staff_address'))); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (get_sub_field('staff_facebook')) : ?>
                                            <div class="text-center mt-4">
                                                <a href="<?php echo esc_url(get_sub_field('staff_facebook')); ?>"
                                                    target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="inline-flex items-center justify-center w-8 h-8 bg-blue-600 hover:bg-blue-700 text-white rounded-full transition-colors duration-200">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Department Links & Documents -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">

                    <!-- Links Section -->
                    <?php if (have_rows('department_link_repeater')) : ?>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Helpful Links</h3>
                            <ul class="space-y-2">
                                <?php while (have_rows('department_link_repeater')) : the_row();
                                    $link = get_sub_field('department_link');
                                    if ($link) :
                                ?>
                                        <li>
                                            <a href="<?php echo esc_url($link['url']); ?>"
                                                target="<?php echo esc_attr($link['target'] ?: '_self'); ?>"
                                                class="flex items-center text-hamco-green hover:text-green-800 transition-colors duration-200 group">
                                                <i class="fas fa-link text-sm mr-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                                                <?php echo esc_html($link['title']); ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Documents Section -->
                    <?php if (have_rows('department_documents_repeater')) : ?>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Documents & Forms</h3>
                            <ul class="space-y-2">
                                <?php while (have_rows('department_documents_repeater')) : the_row();
                                    $file = get_sub_field('department_document');
                                    if ($file) :
                                ?>
                                        <li>
                                            <a href="<?php echo esc_url($file['url']); ?>"
                                                target="_blank"
                                                class="flex items-center text-hamco-green hover:text-green-800 transition-colors duration-200 group">
                                                <i class="fas fa-file-pdf text-sm mr-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                                                <?php echo esc_html($file['title']); ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Tax Data Section -->
                <?php if (have_rows('tax_data_repeater')) : ?>
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Tax Data</h3>
                        <ul class="space-y-2">
                            <?php while (have_rows('tax_data_repeater')) : the_row();
                                $file = get_sub_field('tax_data_document');
                                if ($file) :
                            ?>
                                    <li>
                                        <a href="<?php echo esc_url($file['url']); ?>"
                                            target="_blank"
                                            class="flex items-center text-hamco-green hover:text-green-800 transition-colors duration-200 group">
                                            <i class="fas fa-file-excel text-sm mr-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                                            <?php echo esc_html($file['title']); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Main Content -->
                <?php while (have_posts()) : the_post(); ?>
                    <?php if (get_the_content()) : ?>
                        <div class="prose prose-lg max-w-none">
                            <?php the_content(); ?>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</main><!-- #primary -->

<?php
get_footer();
