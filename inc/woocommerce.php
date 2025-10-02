<?php
/**
 * WooCommerce Compatibility File
 *
 * @package Simpson_Leather_Craft
 */

/**
 * WooCommerce setup function.
 *
 * @return void
 */
function simpson_woocommerce_setup() {
    add_theme_support(
        'woocommerce',
        array(
            'thumbnail_image_width' => 300,
            'single_image_width'    => 800,
            'product_grid'          => array(
                'default_rows'    => 3,
                'min_rows'        => 1,
                'default_columns' => 4,
                'min_columns'     => 1,
                'max_columns'     => 6,
            ),
        )
    );
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'simpson_woocommerce_setup');

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function simpson_woocommerce_scripts() {
    wp_enqueue_style('simpson-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), wp_get_theme()->get('Version'));

    $font_path   = WC()->plugin_url() . '/assets/fonts/';
    $inline_font = '@font-face {
        font-family: "star";
        src: url("' . $font_path . 'star.eot");
        src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
            url("' . $font_path . 'star.woff") format("woff"),
            url("' . $font_path . 'star.ttf") format("truetype"),
            url("' . $font_path . 'star.svg#star") format("svg");
        font-weight: normal;
        font-style: normal;
    }';

    wp_add_inline_style('simpson-woocommerce-style', $inline_font);
}
add_action('wp_enqueue_scripts', 'simpson_woocommerce_scripts');

/**
 * Disable the default WooCommerce stylesheet.
 *
 * @return array
 */
function simpson_dequeue_styles($enqueue_styles) {
    unset($enqueue_styles['woocommerce-general']);
    unset($enqueue_styles['woocommerce-layout']);
    unset($enqueue_styles['woocommerce-smallscreen']);
    return $enqueue_styles;
}
add_filter('woocommerce_enqueue_styles', 'simpson_dequeue_styles');

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function simpson_woocommerce_active_body_class($classes) {
    $classes[] = 'woocommerce-active';
    return $classes;
}
add_filter('body_class', 'simpson_woocommerce_active_body_class');

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function simpson_woocommerce_products_per_page() {
    return 12;
}
add_filter('loop_shop_per_page', 'simpson_woocommerce_products_per_page');

/**
 * Product gallery thumbnail columns.
 *
 * @return integer number of columns.
 */
function simpson_woocommerce_thumbnail_columns() {
    return 4;
}
add_filter('woocommerce_product_thumbnails_columns', 'simpson_woocommerce_thumbnail_columns');

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function simpson_woocommerce_loop_columns() {
    return 4;
}
add_filter('loop_shop_columns', 'simpson_woocommerce_loop_columns');

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function simpson_woocommerce_related_products_args($args) {
    $defaults = array(
        'posts_per_page' => 4,
        'columns'        => 4,
    );

    $args = wp_parse_args($defaults, $args);

    return $args;
}
add_filter('woocommerce_output_related_products_args', 'simpson_woocommerce_related_products_args');

/**
 * Remove default WooCommerce wrapper.
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

if (!function_exists('simpson_woocommerce_wrapper_before')) {
    /**
     * Before Content.
     *
     * Wraps all WooCommerce content in wrappers which match the theme markup.
     *
     * @return void
     */
    function simpson_woocommerce_wrapper_before() {
        ?>
            <main id="primary" class="site-main">
                <div class="container">
        <?php
    }
}
add_action('woocommerce_before_main_content', 'simpson_woocommerce_wrapper_before');

if (!function_exists('simpson_woocommerce_wrapper_after')) {
    /**
     * After Content.
     *
     * Closes the wrapping divs.
     *
     * @return void
     */
    function simpson_woocommerce_wrapper_after() {
        ?>
                </div>
            </main>
        <?php
    }
}
add_action('woocommerce_after_main_content', 'simpson_woocommerce_wrapper_after');

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * @return string
 */
if (!function_exists('simpson_woocommerce_cart_link_fragment')) {
    /**
     * Cart Fragments.
     *
     * Ensure cart contents update when products are added to the cart via AJAX.
     *
     * @param array $fragments Fragments to refresh via AJAX.
     * @return array Fragments to refresh via AJAX.
     */
    function simpson_woocommerce_cart_link_fragment($fragments) {
        ob_start();
        simpson_woocommerce_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'simpson_woocommerce_cart_link_fragment');

if (!function_exists('simpson_woocommerce_cart_link')) {
    /**
     * Cart Link.
     *
     * Displayed a link to the cart including the number of items present and the cart total.
     *
     * @return void
     */
    function simpson_woocommerce_cart_link() {
        ?>
        <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'simpson-leather-craft'); ?>">
            <i class="fas fa-shopping-cart"></i>
            <?php
            $item_count_text = sprintf(
                /* translators: number of items in the mini cart. */
                _n('%d item', '%d items', WC()->cart->get_cart_contents_count(), 'simpson-leather-craft'),
                WC()->cart->get_cart_contents_count()
            );
            ?>
            <span class="amount"><?php echo wp_kses_data(WC()->cart->get_cart_subtotal()); ?></span> <span class="count"><?php echo esc_html($item_count_text); ?></span>
        </a>
        <?php
    }
}

if (!function_exists('simpson_woocommerce_header_cart')) {
    /**
     * Display Header Cart.
     *
     * @return void
     */
    function simpson_woocommerce_header_cart() {
        if (is_cart()) {
            $class = 'current-menu-item';
        } else {
            $class = '';
        }
        ?>
        <ul id="site-header-cart" class="site-header-cart">
            <li class="<?php echo esc_attr($class); ?>">
                <?php simpson_woocommerce_cart_link(); ?>
            </li>
            <li>
                <?php
                $instance = array(
                    'title' => '',
                );

                the_widget('WC_Widget_Cart', $instance);
                ?>
            </li>
        </ul>
        <?php
    }
}

/**
 * Customize WooCommerce breadcrumb separator
 */
function simpson_change_breadcrumb_delimiter($defaults) {
    $defaults['delimiter'] = ' <span class="separator">&gt;</span> ';
    return $defaults;
}
add_filter('woocommerce_breadcrumb_defaults', 'simpson_change_breadcrumb_delimiter');

/**
 * Customize add to cart button text
 */
function simpson_custom_cart_button_text() {
    return __('Add to Cart', 'simpson-leather-craft');
}
add_filter('woocommerce_product_single_add_to_cart_text', 'simpson_custom_cart_button_text');
add_filter('woocommerce_product_add_to_cart_text', 'simpson_custom_cart_button_text');

/**
 * Change number of upsells output
 */
function simpson_change_upsells_columns($columns) {
    return 4;
}
add_filter('woocommerce_upsell_display_args', function($args) {
    $args['posts_per_page'] = 4;
    $args['columns'] = 4;
    return $args;
});

/**
 * Customize sale badge text
 */
function simpson_custom_sale_text($text, $post, $product) {
    return '<span class="onsale">Sale!</span>';
}
add_filter('woocommerce_sale_flash', 'simpson_custom_sale_text', 10, 3);