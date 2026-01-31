<?php
add_filter('woocommerce_catalog_orderby', 'custom_orderby_options');
function custom_orderby_options($sortby)
{
	$sortby['menu_order'] = 'Сортировать';

	unset($sortby['popularity']);
	unset($sortby['rating']);
	unset($sortby['date']);

	$sortby['year'] = 'По возрастанию года';
	$sortby['year-desc'] = 'По убыванию года';

	return $sortby;
}

add_filter('woocommerce_get_catalog_ordering_args', 'year_order');
function year_order($args)
{
	$orderby_value = isset($_GET['orderby']) ? wc_clean($_GET['orderby']) :
		apply_filters('woocommerce_default_catalog_orderby', get_option('woocommerce_default_catalog_orderby'));

	if ($orderby_value == 'year-desc') {
		$args['orderby'] = 'meta_value_num';
		$args['meta_key'] = '_attribute_pa_god';
		$args['order'] = 'DESC';
	} elseif ($orderby_value == 'year') {
		$args['orderby'] = 'meta_value_num';
		$args['meta_key'] = '_attribute_pa_god';
		$args['order'] = 'ASC';
	}


	return $args;
}

add_action('woocommerce_process_product_meta', 'save_product_attributes_as_meta');
function save_product_attributes_as_meta($post_id)
{
	$product = wc_get_product($post_id);

	$attributes = $product->get_attributes();

	if (!empty($attributes)) {
		foreach ($attributes as $attribute) {
			$attribute_name = $attribute->get_name();
			$attribute_value = $product->get_attribute($attribute_name);

			$meta_key = '_' . 'attribute_' . sanitize_title($attribute_name);

			update_post_meta($post_id, $meta_key, $attribute_value);
		}
	}

}

function theme_preload_product_main_image() {
	if ( ! is_product() ) {
		return;
	}

	global $product;
	if ( ! $product instanceof WC_Product ) {
		return;
	}

	$image_id  = $product->get_image_id();
	$image_url = $image_id ? wp_get_attachment_image_url( $image_id, 'woocommerce_single' ) : '';

	if ( $image_url ) {
		$type = esc_attr( get_post_mime_type( $image_id ) );
		echo '<link rel="preload" as="image" href="' . esc_url( $image_url ) . '" type="' . $type . '">' . "\n";
	}
}
add_action( 'wp_head', 'theme_preload_product_main_image', 1 );
