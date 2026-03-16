<?php
add_filter( 'woocommerce_catalog_orderby', 'custom_orderby_options' );
function custom_orderby_options( $sortby ) {
	$sortby['menu_order'] = 'Сортировать';

	unset( $sortby['popularity'] );
	unset( $sortby['rating'] );
	unset( $sortby['date'] );

	$sortby['year']      = 'По возрастанию года';
	$sortby['year-desc'] = 'По убыванию года';

	return $sortby;
}

add_filter( 'woocommerce_get_catalog_ordering_args', 'year_order' );
function year_order( $args ) {
	$orderby_value = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) :
		apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );

	if ( $orderby_value == 'year-desc' ) {
		$args['orderby']  = 'meta_value_num';
		$args['meta_key'] = '_attribute_pa_god';
		$args['order']    = 'DESC';
	} elseif ( $orderby_value == 'year' ) {
		$args['orderby']  = 'meta_value_num';
		$args['meta_key'] = '_attribute_pa_god';
		$args['order']    = 'ASC';
	}

	return $args;
}

add_action( 'woocommerce_process_product_meta', 'save_product_attributes_as_meta' );
function save_product_attributes_as_meta( $post_id ) {
	$product = wc_get_product( $post_id );

	$attributes = $product->get_attributes();

	if ( ! empty( $attributes ) ) {
		foreach ( $attributes as $attribute ) {
			$attribute_name  = $attribute->get_name();
			$attribute_value = $product->get_attribute( $attribute_name );

			$meta_key = '_' . 'attribute_' . sanitize_title( $attribute_name );

			update_post_meta( $post_id, $meta_key, $attribute_value );
		}
	}
}

function gomoto_get_product_cat_terms() {
	static $cache = null;

	if ( $cache !== null ) {
		return $cache;
	}

	$cache = array(
		'by_id'   => array(),
		'by_slug' => array(),
	);

	$terms = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => false,
		)
	);

	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return $cache;
	}

	foreach ( $terms as $term ) {
		$cache['by_id'][ $term->term_id ]   = $term;
		$cache['by_slug'][ $term->slug ] = $term;
	}

	return $cache;
}

function gomoto_get_product_categories( $product_id ) {
	static $cache = array();

	$product_id = (int) $product_id;

	if ( $product_id <= 0 ) {
		return array();
	}

	if ( isset( $cache[ $product_id ] ) ) {
		return $cache[ $product_id ];
	}

	$terms = wp_get_post_terms( $product_id, 'product_cat' );

	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		$cache[ $product_id ] = array();

		return $cache[ $product_id ];
	}

	$product_cat_terms = gomoto_get_product_cat_terms();
	$terms_by_id       = $product_cat_terms['by_id'];

	// более вложенные категории будут идти первее
	usort(
		$terms,
		static function ( $left, $right ) use ( $terms_by_id ) {
			$left_depth  = 0;
			$right_depth = 0;
			$parent_id   = (int) $left->parent;

			while ( $parent_id && isset( $terms_by_id[ $parent_id ] ) ) {
				$left_depth++;
				$parent_id = (int) $terms_by_id[ $parent_id ]->parent;
			}

			$parent_id = (int) $right->parent;

			while ( $parent_id && isset( $terms_by_id[ $parent_id ] ) ) {
				$right_depth++;
				$parent_id = (int) $terms_by_id[ $parent_id ]->parent;
			}

			return $right_depth <=> $left_depth;
		}
	);

	$cache[ $product_id ] = $terms;

	return $cache[ $product_id ];
}

function gomoto_product_has_category( $product_id, $category_slug, $include_children = false ) {
	$product_id    = (int) $product_id;
	$category_slug = (string) $category_slug;

	if ( $product_id <= 0 || $category_slug === '' ) {
		return false;
	}

	$product_terms     = gomoto_get_product_categories( $product_id );
	$product_cat_terms = gomoto_get_product_cat_terms();
	$terms_by_id       = $product_cat_terms['by_id'];
	// объект искомой категории
	$category          = $product_cat_terms['by_slug'][ $category_slug ] ?? null;

	if ( empty( $product_terms ) || ! $category ) {
		return false;
	}

	foreach ( $product_terms as $product_term ) {
		$current_term_id = (int) $product_term->term_id;

		if ( $current_term_id === (int) $category->term_id ) {
			return true;
		}

		if ( ! $include_children ) {
			continue;
		}

		$parent_id = (int) $product_term->parent;

		while ( $parent_id && isset( $terms_by_id[ $parent_id ] ) ) {
			if ( $parent_id === (int) $category->term_id ) {
				return true;
			}

			$parent_id = (int) $terms_by_id[ $parent_id ]->parent;
		}
	}

	return false;
}

function gomoto_get_related_product_ids_by_category_tree( $product_id, $limit = 4 ) {
	$product_id = (int) $product_id;
	$limit      = max( 1, (int) $limit );

	if ( $product_id <= 0 ) {
		return array();
	}

	$terms             = gomoto_get_product_categories( $product_id );
	$product_cat_terms = gomoto_get_product_cat_terms();
	$terms_by_id       = $product_cat_terms['by_id'];

	if ( empty( $terms ) ) {
		return array();
	}

	$paths     = array();
	$max_depth = 0;

	foreach ( $terms as $term ) {
		$path      = array( (int) $term->term_id );
		$parent_id = (int) $term->parent;

		while ( $parent_id && isset( $terms_by_id[ $parent_id ] ) ) {
			$path[]    = $parent_id;
			$parent_id = (int) $terms_by_id[ $parent_id ]->parent;
		}

		$paths[]   = $path;
		$max_depth = max( $max_depth, count( $path ) );
	}

	$related_ids        = array();
	$processed_term_ids = array();

	for ( $level = 0; $level < $max_depth && count( $related_ids ) < $limit; $level++ ) {
		foreach ( $paths as $path ) {
			if ( ! isset( $path[ $level ] ) ) {
				continue;
			}

			$term_id = (int) $path[ $level ];

			if ( isset( $processed_term_ids[ $term_id ] ) ) {
				continue;
			}

			$processed_term_ids[ $term_id ] = true;

			$found_ids = get_posts(
				array(
					'post_type'           => 'product',
					'post_status'         => 'publish',
					'fields'              => 'ids',
					'posts_per_page'      => $limit - count( $related_ids ),
					'post__not_in'        => array_merge( array( $product_id ), $related_ids ),
					'orderby'             => 'date',
					'order'               => 'DESC',
					'ignore_sticky_posts' => true,
					'tax_query'           => array(
						array(
							'taxonomy'         => 'product_cat',
							'field'            => 'term_id',
							'terms'            => $term_id,
							'include_children' => false,
						),
					),
				)
			);

			if ( empty( $found_ids ) ) {
				continue;
			}

			$related_ids = array_merge( $related_ids, array_map( 'intval', $found_ids ) );

			if ( count( $related_ids ) >= $limit ) {
				break;
			}
		}
	}

	return array_slice( array_values( array_unique( $related_ids ) ), 0, $limit );
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

add_action(
	'wp_enqueue_scripts',
	function () {

		if ( is_admin() ) {
			return;
		}

		// Корзины нет — отключаем только скрипты добавления в корзину.
		wp_dequeue_script( 'wc-add-to-cart' );
		wp_dequeue_script( 'wc-cart-fragments' );

		// Отключаем все стили WooCommerce на фронтенде.
		wp_dequeue_style( 'woocommerce-general' );
		wp_dequeue_style( 'woocommerce-layout' );
		wp_dequeue_style( 'woocommerce-smallscreen' );
		wp_dequeue_style( 'woocommerce-inline' );
	},
	99
);
