<?php
global $products;
$orderby = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
$show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
$catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(
	'menu_order' => esc_html__( 'Default sorting', 'sohopro' ),
	'popularity' => esc_html__( 'Sort by popularity', 'sohopro' ),
	'rating'     => esc_html__( 'Sort by average rating', 'sohopro' ),
	'date'       => esc_html__( 'Sort by newness', 'sohopro' ),
	'price'      => esc_html__( 'Sort by price: low to high', 'sohopro' ),
	'price-desc' => esc_html__( 'Sort by price: high to low', 'sohopro' ),
) );

?>
<form class="woocommerce-ordering" method="get">
	<select name="orderby" class="orderby">
		<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
			<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
		<?php endforeach; ?>
	</select>
	<?php wc_query_string_form_fields( null, array( 'orderby', 'submit' ) ); ?>
</form>