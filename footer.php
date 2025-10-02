<?php
/**
 * The template for displaying the footer
 *
 * @package Simpson_Leather_Craft
 */
?>

    <footer id="colophon" class="site-footer">
        <div class="container">
            <?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4')) : ?>
                <div class="footer-widgets">
                    <?php
                    for ($i = 1; $i <= 4; $i++) {
                        if (is_active_sidebar('footer-' . $i)) {
                            echo '<div class="footer-widget-area">';
                            dynamic_sidebar('footer-' . $i);
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            <?php endif; ?>

            <div class="site-info">
                <p>
                    &copy; <?php echo date('Y'); ?> 
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <?php bloginfo('name'); ?>
                    </a>. 
                    <?php esc_html_e('All rights reserved.', 'simpson-leather-craft'); ?>
                </p>
                
                <?php if (class_exists('WooCommerce')) : ?>
                    <div class="payment-methods">
                        <i class="fab fa-cc-visa"></i>
                        <i class="fab fa-cc-mastercard"></i>
                        <i class="fab fa-cc-amex"></i>
                        <i class="fab fa-cc-paypal"></i>
                    </div>
                <?php endif; ?>
            </div><!-- .site-info -->
        </div>
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>