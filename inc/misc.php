<?php
add_filter( 'wpcf7_autop_or_not', '__return_false' );

remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );

add_filter(
	'body_class',
	function ( $classes ) {
		if ( is_front_page() ) {
			$classes[] = 'front-page';
		}
		return $classes;
	}
);

add_filter(
	'wp_get_attachment_image_attributes',
	function ( $attr ) {
		if ( empty( $attr['class'] ) ) {
			return $attr;
		}

		if ( strpos( $attr['class'], 'custom-logo' ) !== false ) {
			$attr['loading']       = 'eager';
			$attr['fetchpriority'] = 'high';
			$attr['decoding']      = 'async';
		}

		return $attr;
	},
	20
);


// $poster_id  = gomoto_get_the_post_meta('hero_poster');
// $poster_src = wp_get_attachment_url($poster_id);

// add_action('wp_head', function () use ($poster_src) {
//   if (!empty($poster_src)) {
//     echo '<link rel="preload" as="image" href="' . esc_url($poster_src) . '" fetchpriority="high">';
//   }
// }, 1);
