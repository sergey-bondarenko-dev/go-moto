<?php
function smartwp_remove_wp_block_library_css()
{
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
	wp_dequeue_style('wc-blocks-style'); // Remove WooCommerce block CSS
}

add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100);

add_action('wp_head', function () {
	$theme_fonts_uri = get_stylesheet_directory_uri() . '/fonts/';
	?>
	<link rel="preload" href="<?= esc_url($theme_fonts_uri . 'Montserrat-Regular.ttf') ?>"
	      as="font" type="font/ttf" crossorigin>
	<link rel="preload" href="<?= esc_url($theme_fonts_uri . 'Montserrat-SemiBold.ttf') ?>"
	      as="font" type="font/ttf" crossorigin>
	<link rel="preload" href="<?= esc_url($theme_fonts_uri . 'Montserrat-Bold.ttf') ?>"
	      as="font" type="font/ttf" crossorigin>
	<?php
}, 1);
