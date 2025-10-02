<?php
/**
 * Simpson Leather Craft Theme Customizer
 *
 * @package Simpson_Leather_Craft
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function simpson_leather_craft_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'simpson_leather_craft_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'simpson_leather_craft_customize_partial_blogdescription',
            )
        );
    }

    // Hero Section
    $wp_customize->add_section('simpson_hero_section', array(
        'title'    => __('Hero Section', 'simpson-leather-craft'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('hero_title', array(
        'default'           => 'Handcrafted Leather Goods',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('hero_title', array(
        'label'    => __('Hero Title', 'simpson-leather-craft'),
        'section'  => 'simpson_hero_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('hero_subtitle', array(
        'default'           => 'Custom, high-quality leather products made with care and precision',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('hero_subtitle', array(
        'label'    => __('Hero Subtitle', 'simpson-leather-craft'),
        'section'  => 'simpson_hero_section',
        'type'     => 'textarea',
    ));

    $wp_customize->add_setting('hero_background', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_background', array(
        'label'    => __('Hero Background Image', 'simpson-leather-craft'),
        'section'  => 'simpson_hero_section',
        'settings' => 'hero_background',
    )));

    // About Section
    $wp_customize->add_section('simpson_about_section', array(
        'title'    => __('About Section', 'simpson-leather-craft'),
        'priority' => 31,
    ));

    $wp_customize->add_setting('about_title', array(
        'default'           => 'About Simpson Leather Craft',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('about_title', array(
        'label'    => __('About Title', 'simpson-leather-craft'),
        'section'  => 'simpson_about_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('about_content', array(
        'default'           => 'Simpson Leather Craft specializes in handcrafted leather goods made with the highest quality materials and traditional techniques.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('about_content', array(
        'label'    => __('About Content', 'simpson-leather-craft'),
        'section'  => 'simpson_about_section',
        'type'     => 'textarea',
    ));

    $wp_customize->add_setting('about_content_2', array(
        'default'           => 'We also offer digital patterns for leather crafting enthusiasts who want to create their own leather goods at home.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('about_content_2', array(
        'label'    => __('About Content (Paragraph 2)', 'simpson-leather-craft'),
        'section'  => 'simpson_about_section',
        'type'     => 'textarea',
    ));

    $wp_customize->add_setting('about_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_image', array(
        'label'    => __('About Image', 'simpson-leather-craft'),
        'section'  => 'simpson_about_section',
        'settings' => 'about_image',
    )));

    $wp_customize->add_setting('about_page', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('about_page', array(
        'label'    => __('About Page', 'simpson-leather-craft'),
        'section'  => 'simpson_about_section',
        'type'     => 'dropdown-pages',
    ));

    // Contact Information
    $wp_customize->add_section('simpson_contact_section', array(
        'title'    => __('Contact Information', 'simpson-leather-craft'),
        'priority' => 32,
    ));

    $wp_customize->add_setting('contact_email', array(
        'default'           => 'info@simpsonleathercraft.com',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('contact_email', array(
        'label'    => __('Contact Email', 'simpson-leather-craft'),
        'section'  => 'simpson_contact_section',
        'type'     => 'email',
    ));

    $wp_customize->add_setting('contact_phone', array(
        'default'           => '(555) 123-4567',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('contact_phone', array(
        'label'    => __('Contact Phone', 'simpson-leather-craft'),
        'section'  => 'simpson_contact_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('contact_address', array(
        'default'           => 'United States',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('contact_address', array(
        'label'    => __('Contact Address', 'simpson-leather-craft'),
        'section'  => 'simpson_contact_section',
        'type'     => 'textarea',
    ));

    // Social Media
    $wp_customize->add_section('simpson_social_section', array(
        'title'    => __('Social Media', 'simpson-leather-craft'),
        'priority' => 33,
    ));

    $social_networks = array(
        'facebook'  => 'Facebook',
        'instagram' => 'Instagram',
        'twitter'   => 'Twitter',
        'youtube'   => 'YouTube',
        'tiktok'    => 'TikTok',
    );

    foreach ($social_networks as $network => $label) {
        $wp_customize->add_setting('social_' . $network, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control('social_' . $network, array(
            'label'    => $label . ' ' . __('URL', 'simpson-leather-craft'),
            'section'  => 'simpson_social_section',
            'type'     => 'url',
        ));
    }
}
add_action('customize_register', 'simpson_leather_craft_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function simpson_leather_craft_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function simpson_leather_craft_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function simpson_leather_craft_customize_preview_js() {
    wp_enqueue_script('simpson-leather-craft-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), wp_get_theme()->get('Version'), true);
}
add_action('customize_preview_init', 'simpson_leather_craft_customize_preview_js');