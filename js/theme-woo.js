jQuery(document).ready(function($) {
	gt3_add_wrapper_tabs();
    gt3_animate_cart();
    gt3_sidebar_products_top();
    gt3_category_accordion();
})

jQuery(window).load(function(){
	"use strict";
	gt3_masonry_shop ();
	if (jQuery(".gt3-animation-wrapper.gt3-anim-product").length) {
		gt3_scroll_animation(jQuery('.gt3-animation-wrapper.gt3-anim-product'), false);
	}
});
jQuery(window).resize(function($){
	setTimeout( resetShopGrid ,100)
})

function gt3_add_wrapper_tabs() {
	jQuery('.woocommerce div.product .woocommerce-tabs ul.tabs li a').wrapInner('<span />');
}
function gt3_masonry_shop () {
    if (jQuery('ul.products').is('.shop_grid_masonry')) {
        jQuery('ul.products.shop_grid_masonry').isotope({
            itemSelector: '.product',
            sortBy: 'original-order',
            percentPosition: true,
                masonry: {
                    columnWidth: 1
                }
        });
    }

	resetShopGrid ();
}
function resetShopGrid () {
	var width = Math.floor(jQuery('.product-default-width').width());
	jQuery('.products.shop_grid_masonry.shop_grid_packery .product').each(function () {
		var margin = jQuery(this).parent().hasClass('gap_default') ? 30 : 0;
		switch (true) {
			case jQuery(this).hasClass('large'):
				jQuery(this).height(Math.floor(width * 0.8) * 2 + margin);
				break;
			case jQuery(this).hasClass('large_vertical'):
				jQuery(this).height(Math.floor(width * 0.8) * 2 + margin);
				break;
			default:
				jQuery(this).height(Math.floor(width * 0.8));
				break;
		}
	})
	jQuery('.products.shop_grid_masonry.shop_grid_packery .product').css('opacity', 1);
	jQuery('.products.shop_grid_masonry.shop_grid_packery .bubblingG').css('opacity', 0);
    if (jQuery('.products.shop_grid_masonry').is('.shop_grid_packery')) {
        jQuery('.products.shop_grid_masonry.shop_grid_packery').isotope('reLayout');
    }
}
function gt3_scroll_animation($el, newItem) {
    var order = 0
      , lastOffsetTop = 0;
    jQuery.each($el, function(index, value) {
        var el = jQuery(this);
        el.imagesLoaded(function() {
            var elOffset = el.offset()
              , windowHeight = jQuery(window).outerHeight()
              , delay = 0
              , offset = 20;
            if (elOffset.top > (windowHeight + offset)) {
                if (order == 0) {
                    lastOffsetTop = elOffset.top;
                } else {
                    if (lastOffsetTop != elOffset.top) {
                        order = 0;
                        lastOffsetTop = elOffset.top;
                    }
                }
                order++;
                index = order;
            }
            delay = index * 0.20;
            el.css({
                'transition-delay': delay + 's'
            });
            el.attr('data-delay', delay);
            el.attr('data-delay', delay);
        });
    });
    $el.appear(function() {
        var el = jQuery(this)
          , windowScrollTop = jQuery(window).scrollTop();
        if (newItem) {
            el.addClass('loaded');
        } else {
            var addLoaded = setTimeout(function() {
                el.addClass('loaded');
            }, 300);
            if (windowScrollTop > 100) {
                clearTimeout(addLoaded);
                el.addClass('loaded');
            }
        }
        var elDur = el.css('transition-duration')
          , elDelay = el.css('transition-delay')
          , timeRemove = elDur.split('s')[0] * 1000 + elDelay.split('s')[0] * 1000 + 4000
          , notRemove = '.wil-progress';
        el.not(notRemove).delay(timeRemove).queue(function() {
            el.removeClass('loaded gt3-anim-product').dequeue();
        });
        el.delay(timeRemove).queue(function() {
            el.css('transition-delay', '');
        });
    }, {
        accX: 0,
        accY: 30
    });
}

/* Cart Count Icon Animation */
function gt3_animate_cart () {
    jQuery.fn.shake = function(intShakes, intDistance, intDuration) {
        this.each(function() {
            for (var x=1; x<=intShakes; x++) {
                jQuery(this).animate({left:(intDistance*-1)}, (((intDuration/intShakes)/4)))
                .animate({left:intDistance}, ((intDuration/intShakes)/2))
                .animate({left:0}, (((intDuration/intShakes)/4)));
            }
        });
        return this;
    };
    jQuery(document.body).on('added_to_cart', function(el, data, params){
        var cart = jQuery("#site-header-cart");
        jQuery('#site-header-cart > li:first-child').shake(3,1.2,300);
        setTimeout(function(){
            cart.addClass("show_cart");
        }, 300);
        setTimeout(function(){
            cart.removeClass("show_cart");
        }, 2800);
    });
}
jQuery( document ).ajaxComplete(function() {
    if( ! jQuery('.gt3-thumbnails-control.slick-slider').length ){
        gt3_thumbnails_slider ();
    }
    var select = jQuery('#yith-quick-view-modal .variations select');
    select.on('change', function(){
        var thumbnails = jQuery('#yith-quick-view-modal .gt3-thumbnails-control');
        var selectEmpty = true;

        select.each(function(){
            var easyzoom = jQuery("#yith-quick-view-content .woocommerce-product-gallery__image").easyZoom();
            var api = easyzoom.data('easyZoom');
            api.teardown();
            api._init();

            if ( this.value !== '') {
                selectEmpty = false;
            }
        });

        if ( selectEmpty ) {
            thumbnails.css({'height':'auto'});
        } else {
            thumbnails.find('.gt3-thumb-control-item:first').trigger( "click" );
            thumbnails.css({'height':'0'});
        }
    })
});
function gt3_thumbnails_slider () {
    var controls_wrapper, slider, slides, slide, item;

    slider = jQuery('#yith-quick-view-content .woocommerce-product-gallery__wrapper');
    slides = slider.find('.woocommerce-product-gallery__image');
    controls_wrapper = jQuery('<div class="gt3-thumbnails-control"></div>');

    for (var i = 0; i < slides.length; i++) {
        slide = slides[i];
        item = '<div class="gt3-thumb-control-item"><img src="' + jQuery(slide).attr( 'data-thumb' ) + '"></div>';
        controls_wrapper.append(item);
    }

    slider.parent().append(controls_wrapper);
    imagesLoaded(slider.parent(), gt3_vertical_thumb );
    jQuery('#yith-quick-view-content .woocommerce-product-gallery__image').easyZoom();
}

function gt3_vertical_thumb (){
    jQuery('#yith-quick-view-content').each(function(){
        var cur_slidesToShow = 1;
        var cur_sliderAutoplay = 4000;
        var cur_fade = true;

        jQuery(this).find('.woocommerce-product-gallery__wrapper').slick({
            slidesToShow: cur_slidesToShow,
            slidesToScroll: cur_slidesToShow,
            autoplay: false,
            autoplaySpeed: cur_sliderAutoplay,
            speed: 500,
            dots: false,
            fade: cur_fade,
            focusOnSelect: true,
            arrows: false,
            infinite: false,
            asNavFor: jQuery(this).find('.gt3-thumbnails-control')
        });
        jQuery(this).find('.gt3-thumbnails-control').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            nextArrow: '<i class="slick-next fa fa-angle-right"></i>',
                prevArrow: '<i class=" slick-prev fa fa-angle-left"></i>',
            asNavFor: jQuery(this).find('.woocommerce-product-gallery__wrapper'),
            dots: false,
            focusOnSelect: true,
            infinite: false,
        })
        var x = jQuery(this).find('.woocommerce-product-gallery')[0];
        jQuery(x).addClass('ready');
    });
}

function gt3_sidebar_products_top(){
    var button = jQuery('.gt3_woocommerce_top_filter_button ');
    var element = jQuery('.gt3_top_sidebar_products');
    if ( jQuery(window).width() < 480) {
        button.on('tap click', function(){
            if (element.hasClass('active')) {
                sidebar_close();
            }else{
                sidebar_open();
            }
        });
    } else {
        button.on('tap click', function(){
            if (element.hasClass('active')) {
                sidebar_close();
            }else{
                sidebar_open();
            }
        });
        jQuery(document).on('mouseup', function (e) {
            if ( element.hasClass('active') && element.has(e.target).length === 0 && button.has(e.target).length === 0 ){
                sidebar_close();
            }
        });
        jQuery(document).keyup(function(e) {
            if (e.keyCode == 27){
                sidebar_close();
            }
        });
    }
    function sidebar_open(){
        button.addClass('active')
        element.addClass('active')
        element.slideDown(300)
    }
    function sidebar_close(){
        button.removeClass('active')
        element.removeClass('active')
        element.slideUp(400)
    }
}

// Category Accordion
function gt3_category_accordion() {
    jQuery('.widget_product_categories').each(function(){
        var elements = jQuery(this).find('.product-categories>li.cat-parent');
        for (var i = 0; i < elements.length; i++) {
            jQuery(elements[i]).append("<span class=\"gt3-button-cat-open\"></span>");
        }
    })
    jQuery(".gt3-button-cat-open").on("click", function () {
        buttonParent = jQuery(this).parent();
        buttonParent.toggleClass('open_list_item');
        if (buttonParent.hasClass('open_list_item')) {
            buttonParent.addClass('active_list_item');
            buttonParent.children('.children').slideDown();
        } else {
            buttonParent.removeClass('active_list_item');
            buttonParent.children('.children').slideUp();
        }
    })
}
