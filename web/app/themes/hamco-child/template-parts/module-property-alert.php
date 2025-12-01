<?php

/**
 * Template part for displaying Property Alert Banner
 *
 * @package HamcoChild
 */

if (get_field('property_alert_enabled', 'options')) : ?>
    <section class="property-alert bg-blue-gray-light py-8 border-t border-b border-gray-200">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">

                <!-- Icon/Emblem -->
                <div class="flex-shrink-0">
                    <div class="w-20 h-20 bg-white rounded-full shadow-md flex items-center justify-center">
                        <i class="fas fa-bell text-hamco-green text-3xl"></i>
                    </div>
                </div>

                <!-- Alert Content -->
                <div class="flex-1 text-center md:text-left">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Property Tax Alert Service</h3>
                    <?php if (get_field('property_alert_text', 'options')) : ?>
                        <p class="text-gray-600">
                            <?php echo esc_html(get_field('property_alert_text', 'options')); ?>
                        </p>
                    <?php else : ?>
                        <p class="text-gray-600">
                            Sign up for our property tax alert service to receive important notifications about your property taxes,
                            payment deadlines, and other tax-related updates directly to your email.
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Call to Action -->
                <div class="flex-shrink-0">
                    <?php
                    $alert_url = get_field('property_alert_url', 'options');
                    if ($alert_url) :
                    ?>
                        <a href="<?php echo esc_url($alert_url); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center text-hamco-green hover:text-green-800 font-semibold transition-colors duration-200 group">
                            Click here for more details
                            <i class="fas fa-external-link-alt ml-2 text-sm group-hover:translate-x-1 transition-transform duration-200"></i>
                        </a>
                    <?php else : ?>
                        <a href="/property-tax-alerts"
                            class="inline-flex items-center text-hamco-green hover:text-green-800 font-semibold transition-colors duration-200 group">
                            Click here for more details
                            <i class="fas fa-external-link-alt ml-2 text-sm group-hover:translate-x-1 transition-transform duration-200"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>