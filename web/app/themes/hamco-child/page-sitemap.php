<?php
/**
 * Template Name: Site Map
 *
 * Displays a directory of all pages and content on the site.
 *
 * @package HamcoChild
 */

get_header();
?>

<?php get_template_part('template-parts/module', 'hero-page'); ?>

<main id="primary" class="site-main">
    <div class="container mx-auto px-4 py-12">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            <!-- Pages Section -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fal fa-file-alt text-hamco-green mr-3"></i>
                    Pages
                </h2>
                <ul class="space-y-2 sitemap-list">
                    <?php
                    wp_list_pages(array(
                        'title_li' => '',
                        'sort_column' => 'menu_order, post_title',
                        'exclude' => get_the_ID(), // Exclude current sitemap page
                    ));
                    ?>
                </ul>
            </div>
            
            <!-- Departments Section -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fal fa-building text-hamco-green mr-3"></i>
                    Departments
                </h2>
                <?php
                $departments = get_posts(array(
                    'post_type' => 'department',
                    'posts_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'post_parent' => 0, // Only top-level departments
                ));
                
                if ($departments) : ?>
                    <ul class="space-y-2 sitemap-list">
                        <?php foreach ($departments as $dept) : ?>
                            <li>
                                <a href="<?php echo get_permalink($dept->ID); ?>" class="text-hamco-green hover:text-green-800 transition-colors duration-200">
                                    <?php echo esc_html($dept->post_title); ?>
                                </a>
                                <?php
                                // Get child departments
                                $children = get_posts(array(
                                    'post_type' => 'department',
                                    'posts_per_page' => -1,
                                    'orderby' => 'menu_order title',
                                    'order' => 'ASC',
                                    'post_parent' => $dept->ID,
                                ));
                                
                                if ($children) : ?>
                                    <ul class="ml-6 mt-2 space-y-1">
                                        <?php foreach ($children as $child) : ?>
                                            <li>
                                                <a href="<?php echo get_permalink($child->ID); ?>" class="text-gray-600 hover:text-hamco-green transition-colors duration-200">
                                                    <?php echo esc_html($child->post_title); ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else : ?>
                    <p class="text-gray-600">No departments found.</p>
                <?php endif; ?>
            </div>
            
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mt-12">
            
            <!-- News/Posts Section -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fal fa-newspaper text-hamco-green mr-3"></i>
                    News & Announcements
                </h2>
                <?php
                $posts = get_posts(array(
                    'post_type' => 'post',
                    'posts_per_page' => 10,
                    'orderby' => 'date',
                    'order' => 'DESC',
                ));
                
                if ($posts) : ?>
                    <ul class="space-y-2 sitemap-list">
                        <?php foreach ($posts as $post) : ?>
                            <li>
                                <a href="<?php echo get_permalink($post->ID); ?>" class="text-hamco-green hover:text-green-800 transition-colors duration-200">
                                    <?php echo esc_html($post->post_title); ?>
                                </a>
                                <span class="text-gray-400 text-sm ml-2">
                                    <?php echo get_the_date('M j, Y', $post->ID); ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="inline-block mt-4 text-hamco-green hover:text-green-800 font-semibold">
                        View All News <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                <?php else : ?>
                    <p class="text-gray-600">No posts found.</p>
                <?php endif; ?>
            </div>
            
            <!-- Quick Links Section -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fal fa-link text-hamco-green mr-3"></i>
                    External Resources
                </h2>
                <ul class="space-y-2 sitemap-list">
                    <li>
                        <a href="https://www.judici.com/courts/cases/case_search.jsp?court=IL033025J" target="_blank" rel="noopener" class="text-hamco-green hover:text-green-800 transition-colors duration-200">
                            Online Court Records <i class="fas fa-external-link-alt text-xs ml-1"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://propertyfraudalert.com/ilhamilton" target="_blank" rel="noopener" class="text-hamco-green hover:text-green-800 transition-colors duration-200">
                            Property Fraud Alert <i class="fas fa-external-link-alt text-xs ml-1"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://experience.arcgis.com/experience/1cc65645ea244c7097337d9c350fffcc" target="_blank" rel="noopener" class="text-hamco-green hover:text-green-800 transition-colors duration-200">
                            GIS Mapping <i class="fas fa-external-link-alt text-xs ml-1"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://il1296.cichosting.com/atasportal/" target="_blank" rel="noopener" class="text-hamco-green hover:text-green-800 transition-colors duration-200">
                            Web Tax Portal <i class="fas fa-external-link-alt text-xs ml-1"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mcleansboroil.com/" target="_blank" rel="noopener" class="text-hamco-green hover:text-green-800 transition-colors duration-200">
                            City of McLeansboro <i class="fas fa-external-link-alt text-xs ml-1"></i>
                        </a>
                    </li>
                </ul>
            </div>
            
        </div>
        
        <!-- Contact Information -->
        <div class="mt-12 bg-gray-50 rounded-lg p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fal fa-map-marker-alt text-hamco-green mr-3"></i>
                Contact Information
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h3 class="font-semibold text-gray-800 mb-2">Address</h3>
                    <p class="text-gray-600">
                        <?php echo get_field('street_address', 'options') ?: '100 South Jackson Street'; ?><br>
                        <?php echo get_field('city_state_zip', 'options') ?: 'McLeansboro, IL 62859'; ?>
                    </p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800 mb-2">Phone</h3>
                    <p class="text-gray-600">
                        <?php echo get_field('phone_number', 'options') ?: '(618) 643-2721'; ?>
                    </p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800 mb-2">Hours</h3>
                    <p class="text-gray-600">
                        Monday - Friday: 8:00 AM - 4:00 PM<br>
                        Saturday - Sunday: Closed
                    </p>
                </div>
            </div>
        </div>
        
    </div>
</main><!-- #primary -->

<style>
    .sitemap-list li {
        position: relative;
        padding-left: 1rem;
    }
    .sitemap-list li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0.6em;
        width: 6px;
        height: 6px;
        background-color: #006735;
        border-radius: 50%;
    }
    .sitemap-list ul li::before {
        background-color: #9ca3af;
    }
</style>

<?php
get_footer();

