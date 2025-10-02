# Simpson Leather Craft WordPress Theme

A custom WordPress theme designed specifically for Simpson Leather Craft e-commerce website with full WooCommerce integration.

## Theme Information

- **Theme Name:** Simpson Leather Craft
- **Version:** 1.0.0
- **Author:** Simpson Leather Craft
- **Requires WordPress:** 5.8 or higher
- **Requires PHP:** 7.4 or higher
- **License:** GPL v2 or later

## Features

- **WooCommerce Integration:** Full support for WooCommerce e-commerce functionality
- **Responsive Design:** Mobile-friendly and works on all devices
- **Custom Homepage:** Beautiful homepage with hero section, featured products, categories, and testimonials
- **Product Catalog:** Grid layout for products with hover effects
- **Shopping Cart:** Full cart functionality with quantity controls
- **Checkout:** Streamlined checkout process
- **Theme Customizer:** Easy customization through WordPress Customizer
- **Widget Areas:** Multiple widget areas including sidebar and 4 footer widget areas
- **Navigation Menus:** Support for primary and footer menus
- **Custom Logo:** Upload your own logo
- **Social Media Integration:** Links to your social media profiles
- **SEO Friendly:** Clean code and proper HTML structure
- **Accessibility Ready:** WCAG 2.0 compliant
- **Translation Ready:** Ready for translation to any language

## Installation

### Quick Install

1. Download the theme ZIP file
2. Log in to your WordPress admin panel
3. Go to **Appearance > Themes**
4. Click **Add New** > **Upload Theme**
5. Choose the ZIP file and click **Install Now**
6. Click **Activate**

### Manual Install

1. Extract the theme ZIP file
2. Upload the `simpson-leather-craft` folder to `/wp-content/themes/`
3. Go to **Appearance > Themes** in WordPress admin
4. Activate the Simpson Leather Craft theme

For detailed installation instructions on Hostinger, see [HOSTINGER_WORDPRESS_GUIDE.md](../HOSTINGER_WORDPRESS_GUIDE.md)

## Required Plugins

- **WooCommerce** (required for e-commerce functionality)

## Recommended Plugins

- **Contact Form 7** - For contact forms
- **Yoast SEO** - For search engine optimization
- **WooCommerce PDF Invoices & Packing Slips** - For order invoices
- **MailChimp for WordPress** - For newsletter signup
- **Wordfence Security** - For website security

## Theme Setup

### 1. Install WooCommerce

1. Go to **Plugins > Add New**
2. Search for "WooCommerce"
3. Install and activate
4. Follow the setup wizard

### 2. Configure Theme Settings

Go to **Appearance > Customize** to configure:

- **Site Identity:** Upload logo and set site title
- **Hero Section:** Set hero title, subtitle, and background image
- **About Section:** Configure about content and image
- **Contact Information:** Add email, phone, and address
- **Social Media:** Add social media URLs

### 3. Set Up Menus

1. Go to **Appearance > Menus**
2. Create a "Primary Menu" and assign to Primary Menu location
3. Create a "Footer Menu" and assign to Footer Menu location

### 4. Configure Widgets

Go to **Appearance > Widgets** to add widgets to:
- Sidebar
- Footer Widget 1-4

### 5. Create Pages

Create the following pages:
- Home (set as front page)
- About
- Contact
- Shop (created automatically by WooCommerce)
- Cart (created automatically by WooCommerce)
- Checkout (created automatically by WooCommerce)

### 6. Add Products

1. Go to **Products > Categories** and create categories
2. Go to **Products > Add New** to add products
3. Set product images, prices, and descriptions
4. Assign products to categories

## Theme Customization

### Colors

The theme uses the following color scheme:
- Primary Color: #8b4513 (Saddle Brown)
- Primary Dark: #5e2f0d
- Primary Light: #d2b48c (Tan)
- Accent Color: #f5deb3 (Wheat)

To change colors, edit the CSS variables in `style.css`:

```css
:root {
  --primary-color: #8b4513;
  --primary-dark: #5e2f0d;
  --primary-light: #d2b48c;
  --accent-color: #f5deb3;
}
```

### Fonts

The theme uses:
- Headings: Playfair Display (Google Fonts)
- Body: Roboto (Google Fonts)

### Custom CSS

To add custom CSS:
1. Go to **Appearance > Customize**
2. Click **Additional CSS**
3. Add your custom CSS code

## File Structure

```
simpson-leather-craft/
├── assets/
│   ├── css/
│   │   └── custom.css
│   ├── js/
│   │   ├── customizer.js
│   │   ├── main.js
│   │   └── navigation.js
│   └── images/
├── inc/
│   ├── customizer.php
│   ├── template-tags.php
│   └── woocommerce.php
├── template-parts/
│   ├── content.php
│   ├── content-page.php
│   └── content-none.php
├── woocommerce/
├── footer.php
├── front-page.php
├── functions.php
├── header.php
├── index.php
├── page.php
├── sidebar.php
├── single.php
├── style.css
├── woocommerce.css
└── README.md
```

## Shortcodes

The theme includes custom shortcodes:

### Featured Products
```
[featured_products limit="4" columns="4"]
```

### Latest Products
```
[latest_products limit="8" columns="4"]
```

## Widget Areas

The theme includes the following widget areas:

1. **Sidebar** - Main sidebar for blog posts and pages
2. **Footer Widget 1** - First footer column
3. **Footer Widget 2** - Second footer column
4. **Footer Widget 3** - Third footer column
5. **Footer Widget 4** - Fourth footer column

## Browser Support

The theme is compatible with:
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Opera (latest)
- Mobile browsers (iOS Safari, Android Chrome)

## Changelog

### Version 1.0.0
- Initial release
- WooCommerce integration
- Custom homepage template
- Responsive design
- Theme customizer options
- Widget areas
- Navigation menus

## Support

For support and questions:
- Email: support@simpsonleathercraft.com
- Website: https://simpsonleathercraft.com

## Credits

- Font Awesome icons: https://fontawesome.com/
- Google Fonts: https://fonts.google.com/
- WooCommerce: https://woocommerce.com/

## License

This theme is licensed under the GPL v2 or later.

```
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
```

## Developer Notes

### Hooks and Filters

The theme uses standard WordPress and WooCommerce hooks and filters. Custom hooks can be added in `functions.php`.

### Child Theme

To create a child theme:

1. Create a new folder in `/wp-content/themes/`
2. Name it `simpson-leather-craft-child`
3. Create `style.css` with:

```css
/*
Theme Name: Simpson Leather Craft Child
Template: simpson-leather-craft
*/
```

4. Create `functions.php` with:

```php
<?php
function simpson_child_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'simpson_child_enqueue_styles');
```

5. Activate the child theme

### Customization

For advanced customization, you can:
- Override template files in a child theme
- Use WordPress hooks and filters
- Add custom CSS in the Customizer
- Modify theme files directly (not recommended)

## FAQ

**Q: How do I change the homepage layout?**
A: Edit `front-page.php` or use the WordPress Customizer to modify sections.

**Q: Can I use this theme without WooCommerce?**
A: Yes, but e-commerce features won't work. The theme will function as a regular WordPress theme.

**Q: How do I add more product categories?**
A: Go to **Products > Categories** and add new categories.

**Q: Can I translate this theme?**
A: Yes, the theme is translation-ready. Use a plugin like Loco Translate or WPML.

**Q: How do I update the theme?**
A: Download the new version and upload it through **Appearance > Themes > Add New > Upload Theme**.

## Thank You

Thank you for using the Simpson Leather Craft WordPress theme! We hope it helps you build a successful online store.