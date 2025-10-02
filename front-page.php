<?php
/**
 * The template for displaying the front page
 *
 * @package Simpson_Leather_Craft
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <!-- Hero Section -->
    <section class="hero-section" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg.jpg');">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <h1><?php echo get_theme_mod('hero_title', 'Handcrafted Leather Goods'); ?></h1>
                <p><?php echo get_theme_mod('hero_subtitle', 'Custom, high-quality leather products made with care and precision'); ?></p>
                <div class="hero-buttons">
                    <?php if (class_exists('WooCommerce')) : ?>
                        <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="button button-primary">
                            <?php esc_html_e('Shop Leather Goods', 'simpson-leather-craft'); ?>
                        </a>
                        <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>?product_cat=digital-patterns" class="button button-secondary">
                            <?php esc_html_e('Digital Patterns', 'simpson-leather-craft'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <?php if (class_exists('WooCommerce')) : ?>
        <section class="featured-products-section">
            <div class="container">
                <h2 class="section-title"><?php esc_html_e('Featured Products', 'simpson-leather-craft'); ?></h2>
                <?php echo do_shortcode('[products limit="4" columns="4" visibility="featured"]'); ?>
                <div class="text-center">
                    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="button button-secondary">
                        <?php esc_html_e('View All Products', 'simpson-leather-craft'); ?>
                    </a>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Categories Section -->
    <?php if (class_exists('WooCommerce')) : ?>
        <section class="categories-section">
            <div class="container">
                <h2 class="section-title"><?php esc_html_e('Shop by Category', 'simpson-leather-craft'); ?></h2>
                <div class="category-grid">
                    <?php
                    $product_categories = get_terms(array(
                        'taxonomy' => 'product_cat',
                        'hide_empty' => true,
                        'parent' => 0,
                    ));

                    if (!empty($product_categories) && !is_wp_error($product_categories)) :
                        foreach ($product_categories as $category) :
                            $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                            $image = wp_get_attachment_url($thumbnail_id);
                            ?>
                            <div class="category-card">
                                <a href="<?php echo esc_url(get_term_link($category)); ?>">
                                    <?php if ($image) : ?>
                                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($category->name); ?>">
                                    <?php else : ?>
                                        <img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" alt="<?php echo esc_attr($category->name); ?>">
                                    <?php endif; ?>
                                    <div class="category-info">
                                        <h3><?php echo esc_html($category->name); ?></h3>
                                        <p><?php echo esc_html($category->count); ?> <?php esc_html_e('products', 'simpson-leather-craft'); ?></p>
                                    </div>
                                </a>
                            </div>
                        <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Latest Products Section -->
    <?php if (class_exists('WooCommerce')) : ?>
        <section class="latest-products-section">
            <div class="container">
                <h2 class="section-title"><?php esc_html_e('Latest Products', 'simpson-leather-craft'); ?></h2>
                <?php echo do_shortcode('[products limit="8" columns="4" orderby="date" order="DESC"]'); ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2><?php echo get_theme_mod('about_title', 'About Simpson Leather Craft'); ?></h2>
                    <p><?php echo get_theme_mod('about_content', 'Simpson Leather Craft specializes in handcrafted leather goods made with the highest quality materials and traditional techniques. Each piece is carefully designed and meticulously crafted to ensure durability and timeless style.'); ?></p>
                    <p><?php echo get_theme_mod('about_content_2', 'We also offer digital patterns for leather crafting enthusiasts who want to create their own leather goods at home. Our patterns are detailed and easy to follow, making them perfect for both beginners and experienced crafters.'); ?></p>
                    <?php
                    $about_page_id = get_theme_mod('about_page');
                    if ($about_page_id) :
                        ?>
                        <a href="<?php echo esc_url(get_permalink($about_page_id)); ?>" class="button button-secondary">
                            <?php esc_html_e('Learn More', 'simpson-leather-craft'); ?>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="about-image">
                    <?php
                    $about_image = get_theme_mod('about_image');
                    if ($about_image) :
                        ?>
                        <img src="<?php echo esc_url($about_image); ?>" alt="<?php esc_attr_e('About Simpson Leather Craft', 'simpson-leather-craft'); ?>">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <h2 class="section-title"><?php esc_html_e('What Our Customers Say', 'simpson-leather-craft'); ?></h2>
            <div class="testimonials-slider">
                <?php
                // Get testimonials from customizer or use default
                $testimonials = array(
                    array(
                        'content' => 'The quality of the leather and craftsmanship is exceptional. I\'ve received so many compliments on my wallet!',
                        'author' => 'John D.'
                    ),
                    array(
                        'content' => 'The digital patterns were easy to follow and the results were amazing. Perfect for a beginner like me.',
                        'author' => 'Sarah M.'
                    ),
                    array(
                        'content' => 'The attention to detail is incredible. My custom holster fits perfectly and the leather is beautiful.',
                        'author' => 'Robert T.'
                    ),
                );

                foreach ($testimonials as $testimonial) :
                    ?>
                    <div class="testimonial">
                        <div class="testimonial-content">
                            <p><?php echo esc_html($testimonial['content']); ?></p>
                        </div>
                        <div class="testimonial-author">
                            <p>- <?php echo esc_html($testimonial['author']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <h2><?php esc_html_e('Subscribe to Our Newsletter', 'simpson-leather-craft'); ?></h2>
                <p><?php esc_html_e('Stay updated with our latest products, special offers, and leather crafting tips.', 'simpson-leather-craft'); ?></p>
                <?php
                // You can replace this with a newsletter plugin shortcode
                echo do_shortcode('[newsletter_form]');
                ?>
            </div>
        </div>
    </section>

</main><!-- #main -->

<?php
get_footer();