/**
 * Main JavaScript for Simpson Leather Craft theme
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        
        // Smooth scroll for anchor links
        $('a[href*="#"]:not([href="#"])').on('click', function() {
            if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 100
                    }, 1000);
                    return false;
                }
            }
        });

        // Back to top button
        var backToTop = $('<button class="back-to-top" aria-label="Back to top"><i class="fas fa-arrow-up"></i></button>');
        $('body').append(backToTop);

        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 300) {
                backToTop.addClass('show');
            } else {
                backToTop.removeClass('show');
            }
        });

        backToTop.on('click', function() {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });

        // Testimonial slider
        if ($('.testimonials-slider').length) {
            var testimonials = $('.testimonials-slider .testimonial');
            var currentIndex = 0;
            
            // Hide all except first
            testimonials.not(':first').hide();
            
            // Auto-rotate every 5 seconds
            setInterval(function() {
                testimonials.eq(currentIndex).fadeOut(400, function() {
                    currentIndex = (currentIndex + 1) % testimonials.length;
                    testimonials.eq(currentIndex).fadeIn(400);
                });
            }, 5000);
        }

        // Add animation on scroll
        if ($('.animate-on-scroll').length) {
            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        $(entry.target).addClass('animated');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });

            $('.animate-on-scroll').each(function() {
                observer.observe(this);
            });
        }

        // WooCommerce quantity buttons
        if ($('.woocommerce .quantity').length) {
            $('.woocommerce').on('click', '.quantity .plus', function() {
                var $input = $(this).siblings('.qty');
                var val = parseInt($input.val());
                var max = $input.attr('max');
                
                if (!max || val < parseInt(max)) {
                    $input.val(val + 1).trigger('change');
                }
            });

            $('.woocommerce').on('click', '.quantity .minus', function() {
                var $input = $(this).siblings('.qty');
                var val = parseInt($input.val());
                
                if (val > 1) {
                    $input.val(val - 1).trigger('change');
                }
            });
        }

        // Update cart count on AJAX add to cart
        $(document.body).on('added_to_cart', function(event, fragments, cart_hash, $button) {
            // Cart count is automatically updated by WooCommerce fragments
            // Add any custom behavior here if needed
        });

    });

})(jQuery);