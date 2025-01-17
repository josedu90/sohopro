<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $grid_style, $thumbnail_dim, $animation_class, $hover_style, $hover_style_2;

if ( !empty($hover_style) && $grid_style !== 'grid_packery' ) {
	$hover_style = $hover_style;
}elseif ( !empty($hover_style_2) && $grid_style === 'grid_packery' ) {
	$hover_style = $hover_style_2;
}

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

//woocommerce_before_shop_loop_item
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'gt3_close_wrap_to_thumbnail', 3 );

$gt3_classes = array();

// Get masonry settings
switch ($thumbnail_dim) {
	case 'gt3_912x730':
		array_push( $gt3_classes, 'large' );
		break;
	case 'gt3_442x730':
		array_push( $gt3_classes, 'large_vertical' );
		break;
	default:
		break;
}

?>
<li <?php post_class($gt3_classes); ?>>
	<div class="gt3-animation-wrapper <?php echo (($animation_class)); ?>">
		<div class="gt3-product-thumbnail-wrapper">
			<?php 
			echo woocommerce_show_product_loop_sale_flash();
			do_action('gt3_hot_new_label_product');  // gt3_hot_new_product - 10 
			if ($hover_style !== 'hover_center') : ?>
	        	<div class='gt3_woocommerce-LoopProduct-link-hover'>
					<?php 
            			echo "<div class='gt3_add_to_cart_button'>";
							woocommerce_template_loop_add_to_cart();
						echo "</div>";
						if ( function_exists('gt3_output_wishlist_button') && class_exists( 'YITH_WCWL_Shortcode' )  && get_option('yith_wcwl_enabled') == true ) {
			                gt3_output_wishlist_button();
			            }
			            if ( class_exists('YITH_WCQV_Frontend') && get_option('yith-wcqv-enable') ) {
			                echo do_shortcode( '[yith_quick_view product_id="'.$product->get_id().'"]' );
			            }
            		?>
				</div>
			<?php endif; ?>
			<a href="<?php echo get_the_permalink(); ?>" class="woocommerce-LoopProduct-link">
				<?php
				if ($grid_style !== "grid_packery") {
					do_action('gt3_before_shop_thumbnail', $product, $thumbnail_dim);
					echo woocommerce_get_product_thumbnail($thumbnail_dim);
				} else {
					if ( has_post_thumbnail() ) {
						$url = get_the_post_thumbnail_url(get_the_ID());
					} elseif ( wc_placeholder_img_src() ) {
						$url = wc_placeholder_img_src();
					}
					echo '<span class="gt3-product__packery-thumb" style="background-image:url('.$url.')"></span>';
				}
				?>
			</a>

		</div><!-- gt3-product-thumbnail-wrapper -->
		<div class="gt3-product-info">
			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
			<?php if ($hover_style === 'hover_center') : ?>
	        	<div class='gt3_woocommerce-LoopProduct-link-hover'>
					<?php 
            			echo "<div class='gt3_add_to_cart_button'>";
							woocommerce_template_loop_add_to_cart();
						echo "</div>";
						if ( function_exists('gt3_output_wishlist_button') && class_exists( 'YITH_WCWL_Shortcode' )  && get_option('yith_wcwl_enabled') == true ) {
			                gt3_output_wishlist_button();
			            }
			            if ( class_exists('YITH_WCQV_Frontend') && get_option('yith-wcqv-enable') ) {
			                echo do_shortcode( '[yith_quick_view product_id="'.$product->get_id().'"]' );
			            }
					?>
				</div>
			<?php endif; ?>
		</div><!-- gt3-product-info -->
	</div><!-- gt3-animation-wrapper -->
</li>
