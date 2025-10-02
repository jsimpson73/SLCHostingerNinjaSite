/**
 * Navigation JavaScript
 * Handles mobile menu toggle
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        // Mobile menu toggle
        $('.menu-toggle').on('click', function() {
            $(this).toggleClass('toggled');
            $('.main-navigation ul').toggleClass('toggled');
            
            // Update aria-expanded
            var expanded = $(this).attr('aria-expanded') === 'true' || false;
            $(this).attr('aria-expanded', !expanded);
            
            // Toggle icon
            var icon = $(this).find('i');
            if (icon.hasClass('fa-bars')) {
                icon.removeClass('fa-bars').addClass('fa-times');
            } else {
                icon.removeClass('fa-times').addClass('fa-bars');
            }
        });

        // Close mobile menu when clicking outside
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.main-navigation, .menu-toggle').length) {
                $('.menu-toggle').removeClass('toggled');
                $('.main-navigation ul').removeClass('toggled');
                $('.menu-toggle').attr('aria-expanded', 'false');
                $('.menu-toggle i').removeClass('fa-times').addClass('fa-bars');
            }
        });

        // Dropdown menu accessibility
        $('.main-navigation .menu-item-has-children > a').on('focus', function() {
            $(this).siblings('.sub-menu').addClass('toggled');
        });

        $('.main-navigation .menu-item-has-children > a').on('blur', function() {
            $(this).siblings('.sub-menu').removeClass('toggled');
        });
    });

})(jQuery);