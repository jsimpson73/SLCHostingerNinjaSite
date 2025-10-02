<?php
/**
 * Simpson Leather Craft Theme Functions
 *
 * @package Simpson_Leather_Craft
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Theme setup
 */
function simpson_leather_craft_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1200, 800, true);

    // Add custom image sizes
    add_image_size('simpson-product-thumb', 300, 300, true);
    add_image_size('simpson-product-large', 800, 800, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'simpson-leather-craft'),
        'footer' => esc_html__('Footer Menu', 'simpson-leather-craft'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Add support for WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'simpson_leather_craft_setup');

/**
 * Set the content width in pixels
 */
function simpson_leather_craft_content_width() {
    $GLOBALS['content_width'] = apply_filters('simpson_leather_craft_content_width', 1200);
}
add_action('after_setup_theme', 'simpson_leather_craft_content_width', 0);

/**
 * Register widget areas
 */
function simpson_leather_craft_widgets_init() {
    // Sidebar
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'simpson-leather-craft'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'simpson-leather-craft'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Footer widgets
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name'          => sprintf(esc_html__('Footer Widget %d', 'simpson-leather-craft'), $i),
            'id'            => 'footer-' . $i,
            'description'   => sprintf(esc_html__('Add widgets here to appear in footer column %d.', 'simpson-leather-craft'), $i),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
    }
}
add_action('widgets_init', 'simpson_leather_craft_widgets_init');

/**
 * Enqueue scripts and styles
 */
function simpson_leather_craft_scripts() {
    // Enqueue Google Fonts
    wp_enqueue_style('simpson-google-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@300;400;500;700&display=swap', array(), null);

    // Enqueue Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css', array(), '6.4.2');

    // Enqueue theme stylesheet
    wp_enqueue_style('simpson-leather-craft-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));

    // Enqueue custom styles
    wp_enqueue_style('simpson-custom-style', get_template_directory_uri() . '/assets/css/custom.css', array('simpson-leather-craft-style'), wp_get_theme()->get('Version'));

    // Enqueue jQuery
    wp_enqueue_script('jquery');

    // Enqueue custom scripts
    wp_enqueue_script('simpson-main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), wp_get_theme()->get('Version'), true);

    // Enqueue navigation script
    wp_enqueue_script('simpson-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array('jquery'), wp_get_theme()->get('Version'), true);

    // Localize script for AJAX
    wp_localize_script('simpson-main-js', 'simpson_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('simpson_nonce'),
    ));

    // Enqueue comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'simpson_leather_craft_scripts');

/**
 * Custom template tags
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * WooCommerce customizations
 */
if (class_exists('WooCommerce')) {
    require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Custom functions
 */

/**
 * Add custom body classes
 */
function simpson_leather_craft_body_classes($classes) {
    // Add class if sidebar is active
    if (is_active_sidebar('sidebar-1')) {
        $classes[] = 'has-sidebar';
    }

    // Add class for WooCommerce pages
    if (class_exists('WooCommerce')) {
        if (is_woocommerce() || is_cart() || is_checkout() || is_account_page()) {
            $classes[] = 'woocommerce-page';
        }
    }

    return $classes;
}
add_filter('body_class', 'simpson_leather_craft_body_classes');

/**
 * Change WooCommerce products per page
 */
function simpson_products_per_page() {
    return 12;
}
add_filter('loop_shop_per_page', 'simpson_products_per_page', 20);

/**
 * Customize WooCommerce breadcrumb
 */
function simpson_woocommerce_breadcrumbs() {
    return array(
        'delimiter'   => ' &gt; ',
        'wrap_before' => '<nav class="woocommerce-breadcrumb" aria-label="breadcrumb">',
        'wrap_after'  => '</nav>',
        'before'      => '',
        'after'       => '',
        'home'        => _x('Home', 'breadcrumb', 'simpson-leather-craft'),
    );
}
add_filter('woocommerce_breadcrumb_defaults', 'simpson_woocommerce_breadcrumbs');

/**
 * Add custom excerpt length
 */
function simpson_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'simpson_excerpt_length', 999);

/**
 * Add custom excerpt more
 */
function simpson_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'simpson_excerpt_more');

/**
 * Add featured products shortcode
 */
function simpson_featured_products_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => 4,
        'columns' => 4,
    ), $atts, 'featured_products');

    if (class_exists('WooCommerce')) {
        return do_shortcode('[products limit="' . $atts['limit'] . '" columns="' . $atts['columns'] . '" visibility="featured"]');
    }

    return '';
}
add_shortcode('featured_products', 'simpson_featured_products_shortcode');

/**
 * Add latest products shortcode
 */
function simpson_latest_products_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => 8,
        'columns' => 4,
    ), $atts, 'latest_products');

    if (class_exists('WooCommerce')) {
        return do_shortcode('[products limit="' . $atts['limit'] . '" columns="' . $atts['columns'] . '" orderby="date" order="DESC"]');
    }

    return '';
}
add_shortcode('latest_products', 'simpson_latest_products_shortcode');

/**
 * Customize WooCommerce sale flash
 */
function simpson_custom_sale_flash($html, $post, $product) {
    return '<span class="onsale">Sale!</span>';
}
add_filter('woocommerce_sale_flash', 'simpson_custom_sale_flash', 10, 3);

/**
 * Add custom CSS to admin
 */
function simpson_admin_styles() {
    echo '<style>
        .toplevel_page_woocommerce .wp-menu-image img {
            width: 20px;
            height: auto;
        }
    </style>';
}
add_action('admin_head', 'simpson_admin_styles');

/**
 * Customize login page
 */
function simpson_login_logo() {
    if (has_custom_logo()) {
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
        echo '<style type="text/css">
            #login h1 a, .login h1 a {
                background-image: url(' . esc_url($logo[0]) . ');
                height: 100px;
                width: 320px;
                background-size: contain;
                background-repeat: no-repeat;
                padding-bottom: 30px;
            }
        </style>';
    }
}
add_action('login_enqueue_scripts', 'simpson_login_logo');

/**
 * Change login logo URL
 */
function simpson_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'simpson_login_logo_url');

/**
 * Change login logo title
 */
function simpson_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter('login_headertext', 'simpson_login_logo_url_title');

/**
 * Remove WooCommerce default styles
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Add async/defer to scripts
 */
function simpson_add_async_defer($tag, $handle) {
    // Add handles of scripts you want to defer
    $defer_scripts = array('simpson-main-js', 'simpson-navigation');
    
    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'simpson_add_async_defer', 10, 2);

/**
 * Security: Remove WordPress version
 */
remove_action('wp_head', 'wp_generator');

/**
 * Security: Disable XML-RPC
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Performance: Remove emoji scripts
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');