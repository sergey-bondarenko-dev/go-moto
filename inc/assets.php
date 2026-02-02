<?php
function smartwp_remove_wp_block_library_css()
{
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
	wp_dequeue_style('wc-blocks-style'); // Remove WooCommerce block CSS
}

add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100);

add_action('wp_default_scripts', function ($scripts) {
	if (is_admin()) {
		return;
	}

	if (!isset($scripts->registered['jquery'])) {
		return;
	}

	$jquery = $scripts->registered['jquery'];
	if (empty($jquery->deps)) {
		return;
	}

	$jquery->deps = array_diff($jquery->deps, ['jquery-migrate']);
});
