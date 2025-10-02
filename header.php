<?php
/**
 * The header for our theme
 *
 * @package Simpson_Leather_Craft
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'simpson-leather-craft'); ?></a>

    <header id="masthead" class="site-header">
        <div class="header-top">
            <div class="container">
                <div class="site-branding">
                    <?php
                    if (has_custom_logo()) :
                        the_custom_logo();
                    else :
                        ?>
                        <h1 class="site-title">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <?php bloginfo('name'); ?>
                            </a>
                        </h1>
                        <?php
                        $simpson_description = get_bloginfo('description', 'display');
                        if ($simpson_description || is_customize_preview()) :
                            ?>
                            <p class="site-description"><?php echo $simpson_description; ?></p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div><!-- .site-branding -->
            </div>
        </div>

        <nav id="site-navigation" class="main-navigation">
            <div class="container">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <i class="fas fa-bars"></i>
                    <span class="screen-reader-text"><?php esc_html_e('Menu', 'simpson-leather-craft'); ?></span>
                </button>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'fallback_cb'    => false,
                    )
                );
                ?>
                
                <?php if (class_exists('WooCommerce')) : ?>
                    <div class="header-cart">
                        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                            <?php
                            $cart_count = WC()->cart->get_cart_contents_count();
                            if ($cart_count > 0) :
                                ?>
                                <span class="cart-count"><?php echo esc_html($cart_count); ?></span>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </nav><!-- #site-navigation -->
    </header><!-- #masthead -->