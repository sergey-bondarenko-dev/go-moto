<?php
function gomoto_dequeue_unwanted_styles() {
	if ( is_admin() || ( defined( 'IFRAME_REQUEST' ) && IFRAME_REQUEST ) ) {
		return;
	}

	$handles = array(
		'wp-block-library',
		'wp-block-library-theme',
		'wc-blocks-style',
		'wc-block-style',
		'woocommerce-block-style',
		'wc-blocks-vendors-style',
		'cits-custom-fonts',
		'brand',
		'brands',
		'brands-styles',
	);

	foreach ( $handles as $handle ) {
		wp_dequeue_style( $handle );
		wp_deregister_style( $handle );
	}
}

add_action( 'wp_enqueue_scripts', 'gomoto_dequeue_unwanted_styles', 1000 );
add_action( 'wp_print_styles', 'gomoto_dequeue_unwanted_styles', 1000 );

add_action(
	'wp_default_scripts',
	function ( $scripts ) {
		if ( is_admin() ) {
			return;
		}

		if ( ! isset( $scripts->registered['jquery'] ) ) {
			return;
		}

		$jquery = $scripts->registered['jquery'];
		if ( empty( $jquery->deps ) ) {
			return;
		}

		$jquery->deps = array_diff( $jquery->deps, array( 'jquery-migrate' ) );
	}
);

add_action(
	'wp_enqueue_scripts',
	function () {
		if ( is_admin() ) {
			return;
		}

		// Move jQuery to the footer to reduce render-blocking.
		$jquery_url = includes_url( '/js/jquery/jquery.min.js' );

		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', $jquery_url, array(), null, true );
	},
	5
);

add_filter(
	'script_loader_tag',
	function ( $tag, $handle ) {
		if ( is_admin() ) {
			return $tag;
		}

		global $wp_scripts;

		if ( $handle === 'jquery' ) {
			return str_replace( ' src', ' defer src', $tag );
		}

		if ( $handle === 'query-monitor-js' ) {
			return str_replace( ' src', ' defer src', $tag );
		}

		if ( isset( $wp_scripts->registered[ $handle ] ) ) {
			$deps = $wp_scripts->registered[ $handle ]->deps ?? array();
			if ( in_array( 'jquery', $deps, true ) ) {
				return str_replace( ' src', ' defer src', $tag );
			}
		}

		return $tag;
	},
	10,
	2
);
