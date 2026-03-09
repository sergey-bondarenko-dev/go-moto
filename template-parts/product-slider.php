<?php
$args = wp_parse_args(
	$args,
	array(
		'products' => array(),
		'title_class' => 'fs-18',
		'excerpt_class' => 'fs-14',
		'image_link_class' => null,
		'slider_class' => '',
	)
);

$products = $args['products'];
if ( empty( $products ) || ! is_array( $products ) ) {
	return;
}

$slider_class = trim( 'products-slider ' . $args['slider_class'] );
?>

<div class="products">
	<div class="swiper <?php echo esc_attr( $slider_class ); ?>">
		<div class="swiper-wrapper">
			<?php
			foreach ( $products as $prod ) {
				$product_id = is_array( $prod ) && isset( $prod['id'] ) ? $prod['id'] : $prod;
				$_product   = wc_get_product( $product_id );
				if ( ! $_product ) {
					continue;
				}
				?>
				<div class="swiper-slide product type-product">
					<?php
					get_template_part(
						'template-parts/product-card',
						null,
						[
							'product_id' => $product_id,
							'product' => $_product,
							'title_class' => $args['title_class'],
							'excerpt_class' => $args['excerpt_class'],
							'image_link_class' => null,
						]
					);
					?>
				</div>
			<?php } ?>
		</div>

		<div class="swiper-button-prev"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="20"
				viewBox="0 0 21 20" fill="none">
				<path d="M16.9225 10.6609L7.26745 10.6609L11.0175 14.4109L9.83912 15.5893L4.07745 9.82758L9.83912 4.06592L11.0175 5.24425L7.26745 8.99425H16.9225V10.6609Z"
						fill="#ff9800" />
			</svg></div>
		<div class="swiper-button-next"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="20"
				viewBox="0 0 21 20" fill="none">
				<path d="M4.07745 8.99425L13.7325 8.99425L9.98245 5.24425L11.1608 4.06592L16.9225 9.82758L11.1608 15.5893L9.98245 14.4109L13.7325 10.6609H4.07745L4.07745 8.99425Z"
						fill="#ff9800" />
			</svg></div>
	</div>
</div>
